<?php
/**
* 
*/
namespace Home\Controller;

class WxController extends HomeBaseController
{
	
	function __construct()
	{
		# code...
	}
	/**
	 * 计算概率函数的算法操作
	 * @param  [type] $proArr [description]
	 * @return [type]         [description]
	 */
	public function get_rand($proArr) {
		$result = '';
		//概率数组的总概率精度   
		$proSum = array_sum($proArr);    
		//概率数组循环   
		foreach ($proArr as $key => $proCur) {
			$randNum = mt_rand(1, $proSum);
			if ($randNum <= $proCur) {
				$result = $key;
				break;
			} else {
				$proSum -= $proCur;
			}
		}
		unset ($proArr);
		return $result;
	}
	/**
	 * 获取中奖的id
	 * @return [type] [description]
	 */
	public function get_parent(){
		$prize_arr = array(
		    '0' => array('id'=>1,'prize'=>1,'v'=>0),
		    '1' => array('id'=>2,'prize'=>0,'v'=>0),
		    '2' => array('id'=>3,'prize'=>0,'v'=>0),
		    '3' => array('id'=>4,'prize'=>1,'v'=>40),
		    '4' => array('id'=>5,'prize'=>1,'v'=>0),
		    '5' => array('id'=>6,'prize'=>1,'v'=>0),
		    '6' => array('id'=>7,'prize'=>1,'v'=>0),
		    '7' => array('id'=>8,'prize'=>1,'v'=>0),
		    '8' => array('id'=>9,'prize'=>0,'v'=>60),
		);
		foreach ($prize_arr as $key => $val) {
		  $arr[$val['id']] = $val['v'];
		}
		$rid = $this->get_rand($arr); //根据概率获取奖项id
		p($rid);
	}
}