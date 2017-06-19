<?php
/**
 * Redis 操作，支持 Master/Slave 的负载集群
 *
 * @author gsp
 * @date 2017-03-06
 * 
 */
namespace MyLib;
use Think\Cache\Driver\Redis;

class RedisCluster{
    // 是否使用 M/S 的读写集群方案
    private $_isUseCluster = false;
    // Master 句柄标记
    private $_mn = 0;
    // Slave 句柄标记
    private $_sn = 0;
    // 服务器连接句柄
    private $_linkHandle = array(
        'master'=>null,  // 可以支持多台 Master 默认取第一条
        'slave'=>array(),// 可以有多台 Slave
    );
    /**
     * 构造函数
     *
     * @param boolean $isUseCluster 是否采用 M/S 方案
     */
    public function __construct($isUseCluster=false,$config=array()){
        $this->_isUseCluster = $isUseCluster;
        
        if (!extension_loaded('redis') ) {
            exit("not support: redisd");
        }
        if(!empty($config)) {
            $this->config =  $config;
        }
        //加载全局配置参数
        $_config=C('cache_redis');
        //防止如果$config只配置了一部分的话，还可以用系统的配置文件
        $this->config['host']=!empty($config['host']) ? $config['host'] : $_config['host'];
        $this->config['prefix']=!empty($config['prefix']) ? $config['prefix'] : $_config['prefix'];
        $this->config['expire']=!empty($config['expire']) ? $config['expire'] : $_config['expire'];
        $this->config['requirepass']=!empty($config['requirepass']) ? $config['requirepass'] : $_config['requirepass'];
        $this->config['cluster']=!empty($config['cluster']) ? $config['cluster'] : $_config['cluster'];
        $this->config['timeout']=false;
        
        $_isUseCluster = $this->config['cluster'];
        
        // $arr_host = explode(',', $this->config['host']);
        
        // if(count($arr_host)>0){
        //     foreach ($arr_host as $key => $value){
        //         $arr = explode(':', $value);
        //         $host=$arr[0];
        //         $port = isset($arr[1]) ? intval($arr[1]) : 6379;
        //         $this->connect(array('host'=>$host,'port'=>$port),$this->config['requirepass']);
        //     }
        // }else{
        //     return die("请设置配置文件中的host参数值");
        // }
        $arr_host = explode(':',$this->config['host']);
        if(!empty($arr_host)){
            $host = isset($arr_host[0]) ? $arr_host[0]:'127.0.0.1';
            $port = isset($arr_host[1]) ? intval($arr_host[1]) : 6379;
            $this->connect(array('host'=>$host,'port'=>$port),$this->config['requirepass']);
        }else{
            return die("请设置配置文件中的host参数值");
        }
    }
    /**
     * 连接服务器,注意：这里使用长连接，提高效率，但不会自动关闭
     *
     * @param array $config Redis服务器配置
     * @param boolean $isMaster 当前添加的服务器是否为 Master 服务器
     * @return boolean
     */
    public function connect($config=array('host'=>'127.0.0.1','port'=>6379),$isAuth=""){
        // default port
        if(!isset($config['port'])){
            $config['port'] = 6379;
        }
        $redis = new Redis();
        $ret = $redis->pconnect($config['host'],$config['port']);
        //如果连接Redis失败就自动去掉失败
        if(!$ret) {
            return $ret;
        }
        if(!empty($isAuth)){
            $redis->auth($isAuth);
        }
        if(isset($redis->info()['role'])){
            if($redis->info()['role']=="master"){
                $this->_linkHandle['master'][$this->_mn] =$redis;
                ++$this->_mn;
            }else{
                $this->_linkHandle['slave'][$this->_sn]=$redis;
                ++$this->_sn;
            }
        }else{
            $this->_linkHandle['slave'][$this->_sn]=$redis;
            ++$this->_sn;
        }
        return $ret;
    }
    /**
     * 关闭连接
     *
     * @param int $flag 关闭选择 0:关闭 Master 1:关闭 Slave 2:关闭所有
     * @return boolean
     */
    public function close($flag=2){
        switch($flag){
            // 关闭 Master
            case 0:
                $this->getRedis()->close();
                break;
                // 关闭 Slave
            case 1:
                for($i=0; $i<$this->_sn; ++$i){
                    $this->_linkHandle['slave'][$i]->close();
                }
                break;
                // 关闭所有
            case 1:
                $this->getRedis()->close();
                for($i=0; $i<$this->_sn; ++$i){
                    $this->_linkHandle['slave'][$i]->close();
                }
                break;
        }
        return true;
    }
    /**
     * 得到 Redis 原始对象可以有更多的操作
     *
     * @param boolean $isMaster 返回服务器的类型 true:返回Master false:返回Slave
     * @param boolean $slaveOne 返回的Slave选择 true:负载均衡随机返回一个Slave选择 false:返回所有的Slave选择
     * @return redis object
     */
    public function getRedis($isMaster=true,$slaveOne=true){
        // 是否启用读写分离
        if(!$_isUseCluster){
            return $this->_getMasterRedis();
        }else{
            return $this->_getSlaveRedis();
        }
    }
    /**
     * 写缓存
     *
     * @param string $key 组存KEY
     * @param string $value 缓存值
     * @param int $expire 过期时间， 0:表示无过期时间
     */
    public function set($key, $value, $expire=0){
        // 永不超时
        if($expire == 0){
            $ret = $this->getRedis()->set($key, $value);
        }else{
            $ret = $this->getRedis()->setex($key, $expire, $value);
        }
        return $ret;
    }
    /**
     * 读缓存
     *
     * @param string $key 缓存KEY,支持一次取多个 $key = array('key1','key2')
     * @return string || boolean 失败返回 false, 成功返回字符串
     */
    public function get($key){
        // 是否一次取多个值
        $func = is_array($key) ? 'mGet' : 'get';
        // 没有使用M/S
        if(! $this->_isUseCluster){
            return $this->getRedis()->{$func}($key);
        }
        // 使用了 M/S
        return $this->_getSlaveRedis()->{$func}($key);
    }
    /*
     // magic function
     public function __call($name,$arguments){
     return call_user_func($name,$arguments);
     }
     */
    /**
     * 条件形式设置缓存，如果 key 不存时就设置，存在时设置失败
     *
     * @param string $key 缓存KEY
     * @param string $value 缓存值
     * @return boolean
     */
    public function setnx($key, $value){
        return $this->getRedis()->setnx($key, $value);
    }
    /**
     * 删除缓存
     *
     * @param string || array $key 缓存KEY，支持单个健:"key1" 或多个健:array('key1','key2')
     * @return int 删除的健的数量
     */
    public function remove($key){
        // $key => "key1" || array('key1','key2')
        return $this->getRedis()->delete($key);
    }
    /**
     * 值加加操作,类似 ++$i ,如果 key 不存在时自动设置为 0 后进行加加操作
     *
     * @param string $key 缓存KEY
     * @param int $default 操作时的默认值
     * @return int　操作后的值
     */
    public function incr($key,$default=1){
        if($default == 1){
            return $this->getRedis()->incr($key);
        }else{
            return $this->getRedis()->incrBy($key, $default);
        }
    }
    /**
     * 值减减操作,类似 --$i ,如果 key 不存在时自动设置为 0 后进行减减操作
     *
     * @param string $key 缓存KEY
     * @param int $default 操作时的默认值
     * @return int　操作后的值
     */
    public function decr($key,$default=1){
        if($default == 1){
            return $this->getRedis()->decr($key);
        }else{
            return $this->getRedis()->decrBy($key, $default);
        }
    }
    /**
     * 添空当前数据库
     *
     * @return boolean
     */
    public function clear(){
        return $this->getRedis()->flushDB();
    }
    /* =================== 以下私有方法 =================== */
    /**
     * 随机 HASH 得到 Redis Slave 服务器句柄
     *
     * @return redis object
     */
    private function _getMasterRedis(){
        // 就一台 Master机直接返回
        if($this->_mn <= 1){
            return $this->_linkHandle['master'][0];
        }
        // 随机 Hash 得到 master 的句柄
        $hash = $this->_hashId(mt_rand(), $this->_mn);
        return $this->_linkHandle['master'][$hash];
    }
    /**
     * 随机 HASH 得到 Redis Slave 服务器句柄
     *
     * @return redis object
     */
    private function _getSlaveRedis(){
        // 就一台 Slave 机直接返回
        if($this->_sn <= 1){
            return $this->_linkHandle['slave'][0];
        }
        // 随机 Hash 得到 Slave 的句柄
        $hash = $this->_hashId(mt_rand(), $this->_sn);
        return $this->_linkHandle['slave'][$hash];
    }
    /**
     * 根据ID得到 hash 后 0～m-1 之间的值
     *
     * @param string $id
     * @param int $m
     * @return int
     */
    private function _hashId($id,$m=10)
    {
        //把字符串K转换为 0～m-1 之间的一个值作为对应记录的散列地址
        $k = md5($id);
        $l = strlen($k);
        $b = bin2hex($k);
        $h = 0;
        for($i=0;$i<$l;$i++)
        {
            //相加模式HASH
            $h += substr($b,$i*2,2);
        }
        $hash = ($h*1)%$m;
        return $hash;
    }
    /**
     *  lpush
     */
    public function lpush($key,$value){
        return $this->getRedis()->lPush($key,$value);
    }
    /**
     *  add lpop
     */
    public function lpop($key){
        return $this->getRedis()->lPop($key);
    }
    /**
     *  add rpop
     */
    public function rpop($key){
        return $this->getRedis()->rPop($key);
    } 
    /**
     *  rpush
     */
    public function rpush($key,$value){
        return $this->getRedis()->rPush($key,$value);
    }
    
    /**
     * lrange
     */
    public function lrange($key,$start,$end){
        return $this->getRedis()->lrange($key,$start,$end);
    }
    /**
     *  set hash opeation
     */
    public function hset($name,$key,$value){
        if(is_array($value)){
            return $this->getRedis()->hset($name,$key,serialize($value));
        }
        return $this->getRedis()->hset($name,$key,$value);
    }
    /**
     *  get hash opeation
     */
    public function hget($name,$key = null,$serialize=true){
        if($key){
            $row = $this->getRedis()->hget($name,$key);
            if($row && $serialize){
                unserialize($row);
            }
            return $row;
        }
        return $this->getRedis()->hgetAll($name);
    }
    /**
     *  delete hash opeation
     */
    public function hdel($name,$key = null){
        if($key){
            return $this->getRedis()->hdel($name,$key);
        }
        return $this->getRedis()->hdel($name);
    }
    /**
     * Transaction start
     */
    public function multi(){
        return $this->getRedis()->multi();
    }
    /**
     * Transaction send
     */
    public function exec(){
        return $this->getRedis()->exec();
    }
    /**
     * 删除缓存
     * @access public
     * @param string $name 缓存变量名
     * @return boolen
     */
    public function delete($name) {
        return $this->getRedis()->delete($name);
    }
    /**
     * 查询当前redis服务器状态
     *
     * @access  public
     * @return  array
     */
    public function status() {
        return $this->getRedis()->info();
    }
    /**
     * 根据则匹配keys
     * @param  [type] $pattern [description]
     * @return [type]          [description]
     */
    public function keys($pattern){
        if(!empty($pattern)){
            return $this->getRedis()->keys($pattern.'*');
        }else{
            return $this->getRedis()->keys('*');
        }
    }
}// End Class