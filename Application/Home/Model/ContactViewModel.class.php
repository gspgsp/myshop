<?php
/**
* 新建联系人视图模型
* @author gsp <[<email address>]>
*/
namespace Home\Model;
use Think\Model\ViewModel;

class ContactViewModel extends ViewModel{
	/**
	 * viewFields属性
	 * @var array
	 */
	public $viewFields = array(
		//'con'=>array('user_id','name','mobile','_type'=>'LEFT','_table'=>"__CUSTOMER_CONTACT__"),
		'con'=>array('user_id'=>'my_uid','name','mobile','_type'=>'LEFT','_table'=>"__CUSTOMER_CONTACT__"),//给user_id取别名，防止被外界知道表的字段名，但是下面的where条件里面还是要用原始的字段名，也可以不取别名，直接使用
		'cus'=>array('c_name','_on'=>'con.c_id = cus.c_id','_type'=>'LEFT','_table'=>"__CUSTOMER__"),
		'ad'=>array('name'=>'adname','mobile'=>'admobile','_on'=>'cus.customer_manager = ad.admin_id','_table'=>"__ADMIN__"),
		'cin'=>array('points','_on'=>'con.user_id = myCin.user_id','_table'=>"__CONTACT_INFO__",'_as'=>'myCin'),//本来默认的字段名cin就是标的别名，这里再给表单独列出一个别名叫myCin
		);
	/**
	 * 获取联系人-视图的方式获取
	 * @param  [int] $userid [description]
	 * @return [type]         [description]
	 */
	public function getContactView($userid){
		if(is_array($userid)){
			$where = "con.user_id in(".implode(',',$userid).")";
		}else{
			$where = "con.user_id = $userid";
		}
		$data = $this->field('my_uid,name,mobile,c_name,adname,admobile,points')->where($where)->select();
		return $data;
	}
}