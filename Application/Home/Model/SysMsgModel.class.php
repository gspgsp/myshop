<?php
/**
*用户站内信模型
*@author gsp <[<email address>]>
*@version [<vector>] [<description>]
*/
namespace Home\Model;
use Think\Model;

class SysMsgModel extends Model{
	/**
	 * 初始化数据库模型
	 */
	public function __construct(){
		parent::__construct('user_msg');
	}
	/**
	 * 发送站内信
	 * @access public
	 * @param int $type 类型:1 系统 2 app 3 微信
	 * @param string $msg 短信内容
	 * @param int $user_id 用户ID
	 * @return bool 返回值
	 * @author gsp <1554680230@qq.com>
	 */
	public function sendMsg($user_id = 0, $msg = '', $type = 1){
		$_data = array(
			'user_id' => $user_id,
			'msg' => $msg,
			'type' =>$type,
			'input_time' =>CORE_TIME,
			);
		return $this->data($_data)->add();
	}
}