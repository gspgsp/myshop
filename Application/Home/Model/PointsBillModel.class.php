<?php
/**
* 积分兑换记录模型
* 包括积分的增加 和 减少
* @author gsp <[<email address>]>
*/
namespace Home\Model;
use Think\Model;

class PointsBillModel extends Model
{
	function __construct()
	{
		parent::__construct('points_bill');
	}
	/**
	 * 减少积分
	 * @param  integer $points  [description]
	 * @param  integer $uid  [description]
	 * @param  integer $type [description]
	 * @param  integer $gid  [description]
	 * @return boolean        [description]
	 */
	public function decPoints($points =0, $uid =0, $type =0,$gid =0){
		if($result = D('CustomerContact')->getContactInfo($uid)){
			if(!M('contact_info')->where("user_id = $uid")->setDec('points',$points)) return false;
			if(!D('PointsGoods')->where("id = $gid")->setDec('num',1)) return false;
			$_order = array(
				'addtime'=>CORE_TIME,
				'uid'=>$uid,
				'points'=>-$points,
				'type'=>$type,
				'gid'=>$gid
				);
			if(!$this->data($_order)->add()) return false;
			return true;
		}else{
			return false;
		}
	}
	/**
	 * 增加用户积分
	 * @param integer $points [description]
	 * @param integer $uid    [description]
	 * @param integer $type   [description]
	 * @param integer $source [description]
	 */
	public function addPoints($points =0, $uid =0, $type =0,$source =0){
		$con_inf = M('contact_info');
		if( $info=$con_inf->where("user_id=$uid")->find() ){
			if($source == 1){//塑料圈的积分
				if(!$con_inf->where("user_id=$uid")->setInc('quan_points',$points)) return false;
				if(!$this->add( array('addtime' => time(), 'uid' => $uid, 'points' => $points, 'type' => $type) )) return false;
				return true;
			}elseif ($source == 0) {//pc 或app
				if(!$con_inf->where("user_id=$uid")->setInc('points',$points)) return false;
				if(!$this->add( array('addtime' => time(), 'uid' => $uid, 'points' => $points, 'type' => $type) )) return false;
				return true;
			}
		}else{
			return false;
		}
	}
}