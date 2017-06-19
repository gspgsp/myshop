<?php
/**
*报价采购模型
*@author gsp <[<email address>]>
*/
namespace Home\Model;
use Think\Model;
use Think\Page;

class PurchaseModel extends Model
{
	/**
	 * 获取报价或采购信息的具体信息
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getPurchaseInfo($id){
		if(!empty($id)){
			$result = $this->alias('pur')->join('__PRODUCT__ pro on pro.id = pur.p_id')->join('__FACTORY__ fa on fa.fid = pro.f_id','left')->where("pur.id = $id")->field("pur.*,pro.model,pro.f_id as prof_id,pro.product_type,pro.process_type,pro.status as pro_status,pro.remark as pro_remark,fa.f_name")->find();
		}else{
			return false;
		}
		if(!empty($result)){
			$result['product_type'] = witchType($result['product_type']);
			$result['city'] = M('lib_region')->where("id={$result['provinces']}")->getField('name');
			return $result;
		}else{
			return false;
		}
	}
	/**
	 * 同一个公司下的所有报价相同的c_id
	 * @return [type] [description]
	 */
	public function getPurchaseByUserId($c_id){
		$where="pur.c_id={$c_id} and pur.shelve_type=1 and pur.type=2";
		$purModel = $this->alias('pur')
		->join('__PRODUCT__ pro on pro.id = pur.p_id','left')
		->join('__FACTORY__ fac on fac.fid = pro.f_id','left')
		->join('__LIB_REGION__ reg on reg.id = pur.provinces','left')
		->where($where);
		//分页
		$count = $purModel->count();
		$page = new Page($count,10);
		// $page->setConfig();
		$show = $page->show();
		$list = $this->alias('pur')
		->join('__PRODUCT__ pro on pro.id = pur.p_id','left')
		->join('__FACTORY__ fac on fac.fid = pro.f_id','left')
		->join('__LIB_REGION__ reg on reg.id = pur.provinces','left')
		->where($where)
		->limit($page->firstRow.','.$page->listRows)->order("pur.input_time desc")->field('pro.product_type,pro.model,fac.f_name,pur.number,pur.unit_price,reg.name,pur.cargo_type,pur.bargain,pur.input_time,pur.store_house')
		->select();
		foreach ($list as &$value) {
			// $value['product_type'] = L('product_type')[$value['product_type']];
			$value['input_time'] = date('m-d H:i',$value['input_time']);
			$value['cargo_type'] = L('cargo_type')[$value['cargo_type']];
			$value['bargain'] = L('bargain')[$value['bargain']];
		}
		return array('pages'=>$show,'list'=>$list);
	}
	/**
	 * 获取可能感兴趣的产品
	 * @param  [type] $userid [description]
	 * @return [type]         [description]
	 */
	public function getRecommandInfo($userid){
		$p_id = M('concerned_product')->where("user_id = $userid")->limit(1)->order("input_time desc")->getField("product_id");
		return $this->getPurchaseInfo($p_id);
	}
}