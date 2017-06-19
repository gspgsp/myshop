<?php
/**
 *  session类
 */
class Session{
    var $name   = 'CY_SSID';
    var $sid    = '';
    var $_ip   = '';

    var $cookie_path   = '/';
    var $cookie_domain = '';
    var $cookie_secure = false;

    var $_expiry = '';
    var $_time = 0;
    var $_life  = 1800; // SESSION 过期时间
	
    var $_md5    = '';
    var $_hash = '5bfa7c';

    public function __construct() {
		$this->_life=C('SESSION_TTL');
    	$this->cookie_path   = C('COOKIE_PATH');
    	$this->cookie_domain   = C('COOKIE_DOMAIN');
    	$this->cookie_secure   = C('COOKIE_SECURE');
    	$this->name   = C('SESSION_NAME');
		
		//注销系统自带的SESSION
        $GLOBALS['_SESSION'] = array();
        $this->_ip = get_ip();
		
		//COOKIE中的sessionid
		$sid='';
        if (!empty($_COOKIE[$this->name])){
            $sid = $_COOKIE[$this->name];
        }
        if ($sid){
			//取前32位做CRC32位校检
            $tmp_sid = substr($sid, 0, 32);
            if ($this->genKey($tmp_sid) == substr($sid, 32)){
                $this->sid = $tmp_sid;
            }else{
                $this->sid = '';
            }
        }

        $this->_time = time();
        if ($this->sid){ //从数据库中取记录到SESSION
            $this->read();
        }else{ //创建新且唯一的sid
            $this->genSid();
			setcookie($this->name, $this->sid.$this->genKey($this->sid), 0, $this->cookie_path, $this->cookie_domain, $this->cookie_secure);
        }
		
		//回调函数:每个页面执行完后更新SESSION并且触发删除超过过期时间的SESSION 
        register_shutdown_function(array(&$this, 'close'));
    }
	
    private function genSid() {
        $this->sid = md5(uniqid(mt_rand(), true));
        return $this->insert();
    }

    //对COOKIE中的sid做CRC32校检
	private function genKey($sid) {
        static $ip = '';
        if ($ip == '')  $ip = substr($this->_ip, 0, strrpos($this->_ip, '.'));
        return sprintf('%08x', crc32((!empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '').$ip.$sid));
    }

    public function getSid(){
        return $this->sid;
    }
}
/**
 *  session Memcache存储类
 */
class SessionMemcache extends Session{
    var $memcache             = NULL; //memcache服务

    /**
     * 构造函数
     * @return void
     */
    public function __construct(){
		//加载全局配置参数
		$config=C('session_memcache');
		
        $this->memcache  = new Memcache;
		foreach(explode(',',$config) as $v) {
			$arr=explode(':',$v);
			$port=isset($arr[1]) ? intval($arr[1]) : 11211;
			$this->memcache->addServer($arr[0], $port);
		}
		
		parent::__construct();
	}


    /**
     * 初始化新增数据 
     * @access protected 
     * @return boolen
     */
    protected function insert(){
		return $this->memcache->set($this->sid, 'a:0:{}', false, $this->_life);
    }

    /**
     * 读取Session 
     * @access protected 
     */
    protected function read() {
        $data = $this->memcache->get($this->sid);
        if ($data === false){
            $this->insert();
            $this->_md5    = $this->_hash;
            $GLOBALS['_SESSION']  = array();
        }else{
            $this->_md5 = md5($data);
			$session=unserialize($data);
			$GLOBALS['_SESSION'] = $session;
        }
    }

    /**
     * 写入Session 
     * @access protected 
     * @return boolen
     */
	protected function write() {
		//取得页面中$_SESSION变量内的值
        $userid  = !empty($GLOBALS['_SESSION']['userid'])  ? intval($GLOBALS['_SESSION']['userid'])  : 0;
        $adminid  = !empty($GLOBALS['_SESSION']['adminid'])  ? intval($GLOBALS['_SESSION']['adminid'])  : 0;
		
		$GLOBALS['_SESSION']['userid']=$userid;
		$GLOBALS['_SESSION']['adminid']=$adminid;
		
        $data  = serialize($GLOBALS['_SESSION']);
        //SESSION的值没有变化则跳出
		if ($this->_md5 == md5($data)) {
            //return true;
        }
		return $this->memcache->set($this->sid, $data, 0, $this->_life);
    }

    /**
     * SESSION的更新和删除过期数据的操作
     * @access public 
     * @return boolen
     */
	public function close(){
        $this->write();
		//Memcache会自动清理
        return true;
    }
	
	/**
     * 清除一个session
     * @return boolen
     */
    public function destroy(){
        $GLOBALS['_SESSION'] = array();
		//setcookie($this->name, $this->sid, 1, $this->cookie_path, $this->cookie_domain, $this->cookie_secure);
		return $this->memcache->delete($this->sid);
    }
}
?>