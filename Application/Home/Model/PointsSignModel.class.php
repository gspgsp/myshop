<?php
/**
* 用户兑换积分日期模型
* 周一到周五几个时间
*/
namespace Home\Model;
use Think\Model;

class PointsSignModel extends Model{
	/**
	 *  初始化数据库模型
	 */
	public function __construct(){
		parent::__construct('points_sign');
	}
	/**
	 * 获取用户登录时间
	 * @return [type] [description]
	 */
	public function getSignData($userid){
		return $this->where("uid = $userid")->find();
	}
}