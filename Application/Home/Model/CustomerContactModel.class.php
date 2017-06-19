<?php
/**
*用户模型
*@author gsp <[<email address>]>
*/
namespace Home\Model;
use Think\Model;

class CustomerContactModel extends Model
{
	/**
	 * 根据user_id 获取用户关联信息信息
	 * @return [type] [description]
	 */
	public function getContactByuserid($userid){
		if(is_array($userid)){
			$where = "con.user_id in(".implode(',',$userid).")";
		}else{
			$where = "con.user_id = {$userid}";
		}
		$model = M('customer_contact')->alias('con')
			->join('__CUSTOMER__ cus on cus.c_id = con.c_id','left')
			->join('__ADMIN__ ad on ad.admin_id = cus.customer_manager','left')
			->join('__CONTACT_INFO__ info on info.user_id = con.user_id')
			->where($where)
			->field('con.user_id,con.name,con.mobile,cus.c_name,ad.name as adname,ad.mobile as admobile,info.points');
		if(is_array($userid)){
			$data = $model->select();
		}else{
			$data = $model->find();
		}
		return $data;
	}
	/**
	 * 获取用户信息
	 * @return [type] [description]
	 */
	public function getUserInfo($userid){
		return $userInfo = M('customer_contact')->alias('con')
		->join('__ADMIN__ ad on ad.admin_id = con.customer_manager','left')
		->join('__CUSTOMER__ cus on cus.c_id = con.c_id','left')
		->join('__CONTACT_INFO__ cin on cin.user_id = con.user_id','left')
		->join('__USER_MSG__ msg on msg.user_id = con.user_id','left')
		->where("con.user_id = $userid")
		->field('con.last_login,con.name as con_name,con.input_time,con.customer_manager as cu_manageer,cus.c_name,cus.identification,ad.mobile,ad.name as ad_name,ad.pic,cin.thumb,cin.thumbqq,cin.points,count(msg.id) as number')
		->find();
	}
	/**
	 * 获取交易员
	 * @return [type] [description]
	 */
	public function getAdmin($admin_id){
		return M('admin')->where("admin_id = $admin_id")->field('admin_id,name,mobile')->find();
	}
	/**
	 *  只获取用户信息
	 * @return [type] [description]
	 */
	public function getCustomerContact($user_id){
		$result = M('customer_contact')->alias('con')
		->join('__CONTACT_INFO__ cin on cin.user_id = con.user_id', 'left')
		->where("con.user_id = $user_id")
		->find();
		return $result;
	}
	/**
	 * 获取用户的详细信息
	 * @param  [type] $user_id [description]
	 * @return array          [description]
	 */
	public function getContactInfo($user_id){
		return $this->find($user_id);
	}
}