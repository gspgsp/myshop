<?php
/**
* 商品订单模型
* 包括增加订单 查看订单信息
*/
namespace Home\Model;
use Think\Model;

class PointsOrderModel extends Model{
	public function __construct() {
		parent::__construct('points_order');
	}
	
}