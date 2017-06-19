<?php
/**
* wx开发控制器
*/
namespace Home\Controller;

class WxShareController extends HomeBaseController
{
	protected $AppID,$AppSecret;
	public function __construct(){
		$this->AppID = 'wxe68bcc31549b04c7';
		$this->AppSecret = 'fa6f6f5a95c2127ef10f1d4d20e3c89b';
	}
	//curl获取数据请求
	protected function http($url){
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    $output = curl_exec($ch);//输出内容
	    curl_close($ch);
	    return $output;
	}
	//获取token
	protected function wx_get_token(){
	  //   $_key='weixin_access_token';
	  //   $cache=cache::startMemcache();
	  //   $access_token=$cache->get($_key);
	  //   if(empty($access_token)){
	  //   	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->AppID}&secret={$this->AppSecret}";
			// $result = json_decode($this->http($url), true);
			// if(isset($result['access_token'])){
			// 	$access_token = $result['access_token'];
			// 	$cache->set($_key,$access_token,7000);
			// 	return $access_token;
			// }else{
			// 	return false;
			// }
	  //   }else{
	  //   	return $access_token;
	  //   }
	  $_key='weixin_access_token';
	  $access_token=S($_key);
	  if(empty($access_token)){
	  		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->AppID}&secret={$this->AppSecret}";
			$result = json_decode($this->http($url), true);
			if(isset($result['access_token'])){
				$access_token = $result['access_token'];
				S($_key,$access_token,7000);
				return $access_token;
			}else{
				return false;
			}
	  }else{
	  	return $access_token;
	  }
	}
	//生成随机字符串
	protected function createNonceStr($length = 16){
	  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	  $str = "";
	  for($i = 0; $i < $length; $i++){
	    $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	  }
	  return $str;
	}
	//获取票据
	protected function get_jsapi_ticket(){
		// $_key='weixin_jsapi_ticket';
		// $cache=cache::startMemcache();
	 //    $ticket=$cache->get($_key);
	 //    if(empty($ticket)){
	 //    	$access_token = $this->wx_get_token();
	 //    	$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token={$access_token}";
	 //      	$result = json_decode($this->http($url), true);
	 //      	if(isset($result['ticket'])){
		// 		$ticket = $result['ticket'];
		// 		$cache->set($_key,$ticket,7000);
		// 		return $ticket;
		// 	}else{
		// 		return false;
		// 	}
	 //    }else{
	 //    	return $ticket;
	 //    }
		  $_key='weixin_jsapi_ticket';
		  $ticket=S($_key);
		  if(empty($ticket)){
		  		$access_token = $this->wx_get_token();
	    		$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token={$access_token}";
		      	$result = json_decode($this->http($url), true);
		      	if(isset($result['ticket'])){
					$ticket = $result['ticket'];
					S($_key,$ticket,7000);
					return $ticket;
				}else{
					return false;
				}
		  }else{
		  	return $ticket;
		  }
	}
	//格式化输出字符串
	protected function formatQueryParaMap($paraMap, $urlencode=false){
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v){
		   if (null != $v && "null" != $v && "sign" != $k) {
		       if($urlencode){
		         $v = urlencode($v);
		      }
		      $buff .= $k . "=" . $v . "&";
		   }
		}
		$reqPar;
		if (strlen($buff) > 0) {
		   $reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	//获取url
	protected function get_url(){
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		return $url;
	}
	//获取签名
	public function getSignPackage(){
		$signPackage = array(
			"jsapi_ticket" => $this->get_jsapi_ticket(),
			"noncestr"  => $this->createNonceStr(),
			"timestamp" => time(),
			"url"       => I('targetUrl','','string'),
		);
		$string = $this->formatQueryParaMap($signPackage, false);
		$signPackage['signature'] = sha1($string);
		$signPackage['appId'] = $this->AppID;
		$this->json_output(array('err'=>0,'signPackage'=>$signPackage));
	}
	//curl 获取文件数据
	// public function curl_file($url){
	// 	$ch = curl_init($url);
	// 	curl_setopt($ch, CURLOPT_HEADER, 0);
	// 	curl_setopt($ch, CURLOPT_NOBODY, 0);//只取body头
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//curl_exec执行成功后返回执行的结果；不设置的话，curl_exec执行成功则返回true
	// 	$output = curl_exec($ch);
	// 	curl_close($ch);
	// 	return $output;
	// }
	//每次获取token
	// public function get_ev_token(){
	// 	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->AppID}&secret={$this->AppSecret}";
	// 	$result = json_decode($this->http($url), true);
	// 	return $result['access_token'];
	// }
	//下载语音消息
	// public function downLoadVoice(){
	// 	$this->is_ajax = true;
	// 	$media_id = sget('media_id','s');
	// 	$url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=".$this->get_ev_token()."&media_id=".$media_id;
	// 	$result = $this->curl_file($url);
	// 	if(empty($result)) $this->json_output(array('err'=>2,'msg'=>'请求失败'));
	// 	$timestamp = time();
	// 	if (!file_exists(ROOT_PATH.'../static/myapp/customervoice/')){
 //            mkdir(ROOT_PATH.'../static/myapp/customervoice/');
 //        }
	// 	$ret = file_put_contents(ROOT_PATH.'../static/myapp/customervoice/'.$timestamp.'-read.amr', $result, true);
	// 	if($ret>0) $this->json_output(array('err'=>0,'msg'=>'语音上传成功'));
	// 	$this->json_output(array('err'=>3,'msg'=>'语音上传失败'));
	// }
	//分级遍历文件夹
	// public function getFiles(){
	// 	$this->is_ajax = true;
	// 	$path = sget('path','s');
	// 	$file = array();
	// 	foreach(glob($path) as $afile){
	// 		// if(is_dir($afile)){//此处不能使用
	// 		// 	getFiles($afile.'/*');
	// 		// }else{
	// 		// 	$file[] = $afile;
	// 		// }
	// 		$file[] = $afile;
	// 	}
	// 	$this->json_output(array('err'=>0,'file'=>$file));
	// }
	//从服务器下载音频文件
	// public function downLoadVoFroServer(){
	// 	$this->is_ajax = true;
	// 	$afile = sget('afile','s');
	// 	$file_name = $afile;//将要输出的文件数据
	// 	$file_dir = "http://m.myplas.com/myapp/customervoice/";//服务器地址
	// 	$file = @ fopen($file_dir . $file_name,"r");
	// 	if(!$file){
	// 		$this->json_output(array('err'=>2,'msg'=>'文件找不到'));
	// 	}else{
	// 		Header("Content-type: application/octet-stream");
	// 		Header("Content-Disposition: attachment; filename=" . $file_name);
	// 		while(!feof($file)){//文件指针,指针循环
	// 			$result = fread($file,50000);//从文件指针读出数据
	// 			$this->json_output(array('err'=>0,'msg'=>$result));
	// 		}
	// 		fclose ($file);
	// 	}
	// }
}