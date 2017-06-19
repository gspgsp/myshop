<?php
/**
*商城报价模型
*@author gsp <[<email address>]>
*/
namespace Home\Model;
use Think\Model;
use Think\Page;

class BigOffersModel extends Model
{
	/**
	 * 获取列数组
	 * @param  [type] $model [description]
	 * @param  [type] $col   [description]
	 * @return [type]        [description]
	 */
	public function getModelCol($model,$where,$col){
		$result = M($model)->where($where)->distinct(true)->getField($col,true);
		return empty($result)?array():$result;
	}
	/**
	 * 获取报价
	 * @param  string $where [description]
	 * @return [type]        [description]
	 */
	public function getPurchase($where='1'){
		//分页
		$purModel = M('purchase')->alias('pur')
			->join('__PRODUCT__ pro on pro.id = pur.p_id','left')
			->join('__FACTORY__ fac on fac.fid = pro.f_id','left')
			->where($where);
		$count = $purModel->count();
		$page = new Page($count,10);
		$show = $page->show();
		$list = M('purchase')->alias('pur')
			->join('__PRODUCT__ pro on pro.id = pur.p_id','left')
			->join('__FACTORY__ fac on fac.fid = pro.f_id','left')
			->where($where)->limit($page->firstRow.','.$page->listRows)->order("pur.input_time desc")->field("pur.id,pur.supply_count,pur.bargain,pur.user_id,pur.shelve_type,pur.is_union,pur.unit_price,pur.c_id,pur.number,pur.status,pur.cargo_type,pur.period,pur.input_time,pur.type,pro.model,pro.f_id,pro.product_type,pro.process_type,fac.f_name,pur.store_house")->select();
		foreach ($list as &$value) {
			$value['store_house'] = mb_strlen($value['store_house'],'utf-8')>4?mb_substr($value['store_house'], 0,3,'utf-8').'....':$value['store_house'];
			$value['input_time'] = date('Y-m-d',$value['input_time']);
			$value['cus_man'] = $this->getCusMan($value['user_id']);
			$value['customer'] = $this->getAdminCustomer($value['is_union'],$value['user_id']);
		}
		// p(M('purchase')->getLastSql());
		return array('page'=>$show,'list'=>$list);
	}
	/**
	 * 获取交易员
	 * @return int [description]
	 */
	public function getCusMan($user_id){
		$cus_man = M('customer_contact')->where("user_id=$user_id")->getField("customer_manager");
		return empty($cus_man)?0:$cus_man;
	}
	/**
	 * 获取交易员具体信息以及公司信息
	 * @return [type] [description]
	 */
	public function getAdminCustomer($is_union,$user_id){
		switch ($is_union) {
			case 0://联营
				$data = D('CustomerContact')->getContactByuserid($user_id);
				return isTwoDimension($data)>0?$data[0]:$data;
			case 1://自营
				$data = M('purchase')->alias('pur')->join('__ADMIN__ ad on ad.admin_id = pur.customer_manager')->field('ad.name,ad.mobile')->find();
				return $data+array('c_name'=>'商城自营');
			default:
				# code...
				break;
		}
	}
}