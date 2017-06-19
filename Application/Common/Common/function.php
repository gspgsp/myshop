<?php
/**
 * 防止XLL注入,新的过滤函数
 * @param [type] $[name] [<description>]
 * @return [type] [<description>]
 */
use Think\Upload;
use Think\Image;
function removeXSS($val)
{
    static $obj = null;
    if($obj === null)
    {
        require('./HTMLPurifier/HTMLPurifier.includes.php');
        $config = HTMLPurifier_Config::createDefault();
        // 保留a标签上的target属性
        $config->set('HTML.TargetBlank', TRUE);
        $obj = new HTMLPurifier($config);
    }
    return $obj->purify($val);
}
/**
 * 数组打印
 * @param  [type] $arr [description]
 * @return [type]      [description]
 */
function p($arr){
    header('Content-type:text/html; charset=utf-8');
    echo '<pre style="background:#ccc;border:1px solid #999;border-radius:5px;margin-top:2px;font-size:12px">';
    print_r($arr);
    echo '</pre>';
}
/**
 * type解析
 * @param  [type] $type [description]
 * @return [type]       [description]
 */
function witchType($type){
    $typeStr = L('product_type')[$type];
    return empty($typeStr)?'-':$typeStr;
}
/**
 * 获取选择
 * @param string  $type [description]
 * @param integer $id   [description]
 */
function setOption($type='',$id=1){
    $data=L($type);
    return $data[$id];
}
/**
 * 判断是否为二维数组
 * @return boolean [description]
 */
function isTwoDimension($arr){
    if(is_array($arr)){
        foreach ($arr as $value) {
            if(is_array($value)){
                return 1;
            }else{
                return 0;
            }
        }
    }else{
        return 0;
    }
}
/**
 * 
 *导出为excel
 * @param  array  $data     [description]
 * @param  array  $title    [description]
 * @param  string $filename [description]
 * @return [type]           [description]
 */
function exportexcel($data=array(),$title=array(),$filename='report'){
    header("Content-type:application/octet-stream");//关键1
    header("Accept-Ranges:bytes");
    header("Content-type:application/vnd.ms-excel");//关键2
    header("Content-Disposition:attachment;filename=".$filename.".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    //导出xls 开始
    if (!empty($title)){
        foreach ($title as $k => $v) {
            $title[$k]=iconv("UTF-8", "GB2312",$v);
        }
        $title= implode("\t", $title);
        echo "$title\n";
    }
    if (!empty($data)){
        foreach($data as $key=>$val){
            foreach ($val as $ck => $cv) {
                $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
            }
            $data[$key]=implode("\t", $data[$key]);
        }
        echo implode("\n",$data);
    }
}
/**
 * 返回进过saddslashes格式化以后的数据
 * @param  $string 需要处理的字符串或数组
 * @return mixed
 */
function saddslashes($string){
    if(!is_array($string)) return addslashes($string);
    foreach ($string as $key => $value) $string[$key] = saddslashes($value);
    return $string;
}
/**
 * 生成订单号
 * @author gsp <[<email address>]>
 * @return [string] [description]
 */
function genOrderSn($type = 1){
    $date = date('YmdHim');
    return substr($date,0,8).str_pad($type,4,'0',STR_PAD_RIGHT).substr($date,8,4).str_pad(mt_rand(1000,999999),6,'0',STR_PAD_LEFT);
}
/**
 * 获取客户端IP地址
 * @return ip地址
*/
function get_ip() {
    static $ip = NULL;
    if ($ip !== NULL) return $ip;
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos =  array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip   =  trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0';
    return $ip;
}
/**
 * 保持文件日志(1M切换)
 * @param string $filename 绝对路径文件名
 * @param string $data 日志内容
 */
function wlog($filename='',$data=''){
    if (!is_dir(dirname($filename))){
        mkdir(dirname($filename),0777, true);
    }
    //检测日志文件大小，超过1M则重新生成
    if(is_file($filename) && floor(1024000) <= filesize($filename)){
        rename($filename,dirname($filename).'/'.date("YmdHis").'-'.basename($filename));
    }
    error_log($data,3,$filename);           
}
/**
 * 验证是否为手机号
 * @param  string  $str [description]
 * @return boolean         [description]
 */
function is_mobile($str){
    $pattern = "/^(13|14|15|17|18)\d{9}$/"; 
    return preg_match($pattern,$str); 
}
/**
 * 获取系统的配置项
 * @param  string $key [description]
 * @return [type]      [description]
 */
function getSystemParam($key=''){
    if(!empty($key)){
        return D('Setting')->getSetting()[$key];
    }
}
/**
 * 安全过滤函数
 * @param $string
 * @return string
 */
function safe_replace($string) {
    $string = str_replace('%20','',$string);
    $string = str_replace('%27','',$string);
    $string = str_replace('%2527','',$string);
    $string = str_replace('*','',$string);
    $string = str_replace('"','&quot;',$string);
    $string = str_replace("'",'',$string);
    $string = str_replace('"','',$string);
    $string = str_replace(';','',$string);
    $string = str_replace('<','&lt;',$string);
    $string = str_replace('>','&gt;',$string);
    $string = str_replace("{",'',$string);
    $string = str_replace('}','',$string);
    $string = str_replace('\\','',$string);
    return $string;
}
/**
 * 前台开启session,
 * 导入session类,
 * 获取sid,
 * 定义SESS_ID
 * @return [type] [description]
 */
function startHomeSession(){
    if(empty($_SESSION['SESS_ID'])) $_SESSION['SESS_ID'] = md5(uniqid(mt_rand(), true));
    define('SESS_ID', $_SESSION['SESS_ID']);
}
//获取用户当前uv
function getUV(){
    return cookie::get('_uv');      
}
//产生当前uv
function genUV(){
    return sprintf('%08x', crc32((!empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '').get_ip()));       
}
/**
 * 获取当前请求访问类型
 * @return json 
 */
function get_platform(){
    if (empty($_SERVER['HTTP_USER_AGENT'])){    //当浏览器没有发送访问者的信息的时候
        return array('channel_name'=>'unknow','platform'=>'unknow');
    }
    //判断塑料圈
    if  ((strpos($_SERVER['HTTP_REFERER'], 'plasticzone') !== false)||((strpos(get_url(), 'qapi1') !== false)||(strpos(get_url(), 'plasticzone') !== false))||(preg_match('/(plastic)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))) {
        //判断微信
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return array('channel_name'=>'plastic','platform'=>'weixin');
        }
        //判断ios
        if(preg_match('/(iphone|ipad|ipod)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return array('channel_name'=>'plastic','platform'=>'ios');
        }
        //判断android
        if(preg_match('/(android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return array('channel_name'=>'plastic','platform'=>'android');
        }
        //判断其他则为pc端口
        return array('channel_name'=>'plastic','platform'=>'pc');
    }
    //判断微信
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return array('channel_name'=>'weixin','platform'=>'weixin');
    }
    //判断wap
    if(preg_match('/(wap)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        return array('channel_name'=>'wap','platform'=>'wap');
    }
    //判断ios
    if(preg_match('/(iphone|ipad|ipod)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        return array('channel_name'=>'app','platform'=>'ios');
    }
    //判断android
    if(preg_match('/(android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        return array('channel_name'=>'app','platform'=>'android');
    }
    //如果是pc web就得返回浏览器类型
    if (M('public:common')->is_mobile_request() == false) {
        return array('channel_name'=>'web','platform'=>'pc');
    }
}

/**
 * 获取浏览器版本
 * @return string
 */
 function getBroswer()
{
    $sys = $_SERVER['HTTP_USER_AGENT'];  //获取用户代理字符串
    if (stripos($sys, "Firefox/") > 0) {
        preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
        $exp[0] = "Firefox";
        $exp[1] = $b[1];  //获取火狐浏览器的版本号
    } elseif (stripos($sys, "Maxthon") > 0) {
        preg_match("/Maxthon\/([\d\.]+)/", $sys, $aoyou);
        $exp[0] = "傲游";
        $exp[1] = $aoyou[1];
    } elseif (stripos($sys, "MSIE") > 0) {
        preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
        $exp[0] = "IE";
        $exp[1] = $ie[1];  //获取IE的版本号
    } elseif (stripos($sys, "OPR") > 0) {
        preg_match("/OPR\/([\d\.]+)/", $sys, $opera);
        $exp[0] = "Opera";
        $exp[1] = $opera[1];
    } elseif (stripos($sys, "Edge") > 0) {
        //win10 Edge浏览器 添加了chrome内核标记 在判断Chrome之前匹配
        preg_match("/Edge\/([\d\.]+)/", $sys, $Edge);
        $exp[0] = "Edge";
        $exp[1] = $Edge[1];
    } elseif (stripos($sys, "Chrome") > 0) {
        preg_match("/Chrome\/([\d\.]+)/", $sys, $google);
        $exp[0] = "Chrome";
        $exp[1] = $google[1];  //获取google chrome的版本号
    } elseif (stripos($sys, 'rv:') > 0 && stripos($sys, 'Gecko') > 0) {
        preg_match("/rv:([\d\.]+)/", $sys, $IE);
        $exp[0] = "IE";
        $exp[1] = $IE[1];
    } elseif (stripos($sys, 'Safari') > 0) {
        preg_match("/safari\/([^\s]+)/i", $sys, $safari);
        $exp[0] = "Safari";
        $exp[1] = $safari[1];
    } else {
        $exp[0] = "未知浏览器";
        $exp[1] = "";
    }
    return $exp[0] . '(' . $exp[1] . ')';
}
//获取用户注册来源
function getReferer(){
    //ref,chanel_id
    $ref=cookie::get('_sRef');
    if(isset($_SESSION['_chanel'])){
        $chanel_id=$_SESSION['_chanel'];
    }else{
        $chanel_id=cookie::get('_chanel');
    }
    return array('ref'=>$ref,'chanel_id'=>(int)$chanel_id);     
}


//Orderlist数据表，用于保存用户的购买订单记录；
 /* Orderlist数据表结构；
CREATE TABLE `tb_orderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,购买者userid
  `username` varchar(255) DEFAULT NULL,购买者姓名
  `ordid` varchar(255) DEFAULT NULL,订单号
  `ordtime` int(11) DEFAULT NULL,订单时间
  `productid` int(11) DEFAULT NULL,产品ID
  `ordtitle` varchar(255) DEFAULT NULL,订单标题
  `ordbuynum` int(11) DEFAULT '0',购买数量
  `ordprice` float(10,2) DEFAULT '0.00',产品单价
  `ordfee` float(10,2) DEFAULT '0.00',订单总金额
  `ordstatus` int(11) DEFAULT '0',订单状态
  `payment_type` varchar(255) DEFAULT NULL,支付类型
  `payment_trade_no` varchar(255) DEFAULT NULL,支付接口交易号
  `payment_trade_status` varchar(255) DEFAULT NULL,支付接口返回的交易状态
  `payment_notify_id` varchar(255) DEFAULT NULL,
  `payment_notify_time` varchar(255) DEFAULT NULL,
  `payment_buyer_email` varchar(255) DEFAULT NULL,
  `ordcode` varchar(255) DEFAULT NULL,       //这个字段不需要的，大家看我西面的修正补充部分的说明！
  `isused` int(11) DEFAULT '0',
  `usetime` int(11) DEFAULT NULL,
  `checkuser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
*/
 //在线交易订单支付处理函数
 //函数功能：根据支付接口传回的数据判断该订单是否已经支付成功；
 //返回值：如果订单已经成功支付，返回true，否则返回false；
 function checkorderstatus($ordid){
    $Ord=M('Orderlist');
    $ordstatus=$Ord->where('ordid='.$ordid)->getField('ordstatus');
    if($ordstatus==1){
        return true;
    }else{
        return false;    
    }
 }
 //处理订单函数
 //更新订单状态，写入订单支付后返回的数据
 function orderhandle($parameter){
    $ordid=$parameter['out_trade_no'];
    $data['payment_trade_no']      =$parameter['trade_no'];
    $data['payment_trade_status']  =$parameter['trade_status'];
    $data['payment_notify_id']     =$parameter['notify_id'];
    $data['payment_notify_time']   =$parameter['notify_time'];
    $data['payment_buyer_email']   =$parameter['buyer_email'];
    $data['ordstatus']             =1;
    $Ord=M('Orderlist');
    $Ord->where('ordid='.$ordid)->save($data);
 } 
 /*-----------------------------------
2013.8.13更正
下面这个函数，其实不需要，大家可以把他删掉，
具体看我下面的修正补充部分的说明
------------------------------------*/
 //获取一个随机且唯一的订单号；
 function getordcode(){
    $Ord=M('Orderlist');
    $numbers = range (10,99);
    shuffle ($numbers); 
    $code=array_slice($numbers,0,4); 
    $ordcode=$code[0].$code[1].$code[2].$code[3];
    $oldcode=$Ord->where("ordcode='".$ordcode."'")->getField('ordcode');
    if($oldcode){
        getordcode();
    }else{
        return $ordcode;
    }
 }
 /**
  * 生成缩略图
  * @return [type] [description]
  */
 function createThumbImage($imgName, $dirName, $thumb = array()){
    //补全路径（带后缀）
    if(!empty($dirName) && substr($dirName,-1)!='/'){
        $dirName = $dirName.'/';
    }
    // 上传LOGO
    if(isset($_FILES[$imgName]) && $_FILES[$imgName]['error'] == 0)
    {
        $rootPath = C('IMG_ROOTPATH');
        $upload = new Upload(array(
            'rootPath' => $rootPath,
        ));// 实例化上传类
        $upload->maxSize = (int)C('IMG_SIZE') * 1024 * 1024;// 设置附件上传大小
        $upload->exts = C('IMG_EXTS');// 设置附件上传类型
       /// $upload->rootPath = $rootPath; // 设置附件上传根目录
        $upload->savePath = C('IMG_SAVEPATH'); // 图片二级目录的名称
        // 上传文件 
        $info   =   $upload->upload(array($imgName=>$_FILES[$imgName]));
        if(!$info)
        {
            // 先把上传失败的错误信息存到模型中，由控制器最终再获取这个错误信息并显示
            // $this->error = $upload->getError();
            // return FALSE; // 返回控制器
            return array('err'=>1,'msg'=>$upload->getError());
        }
        else
        {
            $result = array();
            $result['err'] = 0;
            $result['image']['logo'] = $info[$imgName]['savepath'] . $info[$imgName]['savename'];
            // 拼出缩略图的文件名
            if(!empty($thumb)){
                $image = new Image();
                foreach ($thumb as $key => $value) {
                    $result['image']['thumb_'.($key+1)] = $info[$imgName]['savepath'].'thumb_'.($key+1).$info[$imgName]['savename'];
                    // 打开要处理的图片
                    $image->open($rootPath.$result['image']['logo']);
                    $image->thumb($value[0], $value[1])->save($rootPath.$result['image']['thumb_'.($key+1)]);
                }
            }
            return $result;
        }
    }
 }
/**
 * 前端显示图片
 * @param  [type] $logo   [description]
 * @param  [type] $width  [description]
 * @param  [type] $height [description]
 * @return [type]         [description]
 */
function showImage($path,$width,$height){
    $url = C('IMG_URL').$path;
    if($width) $width = 'width = '.$width;
    if($height) $height = 'height = '.$height;
    echo "<img src='$url' $width $height/>";
}
// 删除图片：参数：一维数组：所有要删除的图片的路径
function deleteImage($images)
{
    // 先取出图片所在目录
    $rp = C('IMG_rootPath');
    foreach ($images as $v)
    {
        // @错误抵制符：忽略掉错误,一般在删除文件时都添加上这个
        @unlink($rp . $v);
    }
}
// 判断批量上传的数组中有没有上传至少一张图片
function hasImage($imgName)
{
    foreach ($_FILES[$imgName]['error'] as $v)
    {
        if($v == 0)
            return TRUE;
    }
    return FALSE;
}
/**
 * 自定义从小到大的排序函数
 * @param  [type] $a [description]
 * @param  [type] $b [description]
 * @return [type]    [description]
 */
function attr_id_sort($a, $b)
{
    if ($a['attr_id'] == $b['attr_id'])
        return 0;
    return ($a['attr_id'] < $b['attr_id']) ? -1 : 1;
}
/**
 * 开启邮箱验证
 * @param  [type] $to      [description]
 * @param  [type] $title   [description]
 * @param  [type] $content [description]
 * @return [type]          [description]
 */
function sendMail($to, $title, $content)
{
    // require_once('./vendor/phpmailer/phpmailer/class.phpmailer.php');
    // require_once('./vendor/phpmailer/phpmailer/class.smtp.php');
    $mail = new \PHPMailer();
    // 设置为要发邮件
    $mail->IsSMTP();
    // 是否允许发送HTML代码做为邮件的内容
    $mail->IsHTML(TRUE);
    // 是否需要身份验证
    $mail->SMTPAuth=TRUE;
    $mail->CharSet='UTF-8';
    /*  邮件服务器上的账号是什么 */
    $mail->From=C('MAIL_ADDRESS');
    $mail->FromName=C('MAIL_FROM');
    $mail->Host=C('MAIL_SMTP');
    $mail->Username=C('MAIL_LOGINNAME');
    $mail->Password=C('MAIL_PASSWORD');
    // 发邮件端口号默认25
    $mail->Port = 25;
    // 收件人
    $mail->AddAddress($to);
    // 邮件标题
    $mail->Subject=$title;
    // 邮件内容
    $mail->Body=$content;
    return($mail->Send());
}


