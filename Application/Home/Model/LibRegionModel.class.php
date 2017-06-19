<?php
/**
*购物车模型
*@author gsp <[<email address>]>
*/
namespace Home\Model;
use Think\Model;

class LibRegionModel extends Model
{
	/**
	 * 获取地区
	 * @param  integer $pid [description]
	 * @return [type]       [description]
	 */
	public function getRegion($pid = 0){
		if($pid >1){
			$where = array('id'=>array('eq',$pid));
		}else{
			$where = array('pid'=>array('eq',$pid));
		}
		return $this->field('id,name')->where($where)->select();

	}
}