<?php
/**
 *  发送短信 站内信 邮件
 * @author gsp <[<email address>]>
 */
// header("Content-type: text/html; charset=utf-8");
// require 'D:/xampp/htdocs/myShop/ThinkPHP/ThinkPHP.php';



$cron = new cronMsg();
$cron->start();

class cronMsg{
	private $otime = 0;
	private $nlimit = 10;
	/**
	 * 初始化数据
	 */
	public function __construct(){
		$this->otime = time();
		$this->nlimit = 20;
	}
	/**
	 *  需要批处理的任务
	 * @access public
	 * @return [type] [description]
	 */
	public function start(){
		for ($i=0; $i < 10; $i++) {//每执行定时任务的时候 循环执行的次数
			$this->_smsSend();
			sleep(3);
		}
	}
	/**
	 * 发送短信
	 * @return [type] [description]
	 */
	private function _smsSend(){
		// echo "test-----------------------";
		// $sms_setting = M('Setting')->getSinSetting('sms');
		$sms = M('log_sms')->field('id,mobile,msg,chanel')->where("status = 0 and stype < 10 and input_time <".time())->limit($this->nlimit)->select();
		// if(empty($sms)) return false;
		// $white_list = preg_split('/\s/', $sms_setting['white_list']);

		foreach ($sms as $key => $value) {
			$status = 1;//发送成功
			$chanel = 0;
			// if(in_array($value['mobile'], $white_list)){
			// 	$status = 2;//白名单不发送
			// 	$chanel = 0;
			// }else{
			// 	$status = 1;//发送成功
			// 	$chanel = 0;
			// }
			// M('log_sms')->where("id = {$value['id']}")->save(array('status'=>$status,'chanel'=>$chanel));
			M('log_sms')->where("id = {$value['id']}")->setField(array('status'=>$status,'chanel'=>$chanel));
		}

	}
}