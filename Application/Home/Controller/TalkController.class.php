<?php
/**
* 委托洽谈控制器
*/
namespace Home\Controller;
use Think\Controller;

class TalkController extends HomeBaseController
{
	/**
	 * 测试大A和大R方法的不同,结果相同
	 * @return [type] [description]
	 */
	public function test(){
		$obj = A('Home/Offers');
		$data = $obj->getContactView();//可以声明为对象来调用
		// $data = R('Home/offers/getContactView');
		p($data[0]['name']);
	}
	/**
	 * 洽谈首页
	 * @return [type] [description]
	 */
	public function index(){
		if(empty($this->userid)) $this->redirect('Login/index');//未登录跳到登录界面
		$id = I('get.id',0,'int');
		$data = D('Purchase')->getPurchaseInfo($id);
		$this->title = $data['type']==1?'我要供货':'委托洽谈';
		$contact = D('CustomerContact')->getContactByuserid($data['user_id']);
		if(empty($contact)) $contact = array();

		//运输方式
		$this->ship_type = L('ship_type');
		//配送地点
		$this->area = D('LibRegion')->getRegion(1);
		//产品类型
		$product_type = L('product_type');
		$data['product_type'] = $product_type[$data['product_type']];
		$data = $data + $contact;
		// p($data);
		$this->assign('data',$data);
		$this->display('index');
	}
	/**
	 *  添加订单
	 * @return [type] [description]
	 */
	public function addorder(){
		if($_POST){
			$data = saddslashes(I('post.'));
			if($this->userid == $data['user_id']) $this->json_output(array('err'=>2,'msg'=>'采购人和供货人不能相同'));
			if(!$data['price']||!$data['delivery_date']||!$data['p_id']||!$data['delivery_place']||!$data['ship_type']) $this->json_output(array('err'=>3,'msg'=>'信息填写不完整'));
			$p_id=$data['p_id'];
			$model=D('Purchase');
			$purData=$model->getPurchaseInfo($p_id);
			if( !$purData ) $this->json_output(array('err'=>5,'msg'=>'请求错误,信息不存在'));
			$data['p_id']=$p_id;//报价id
			$data['c_id']=$_SESSION['uinfo']['c_id'];//   供货方客户id
			$data['customer_manager']=intval($_SESSION['uinfo']['customer_manager']);//供货方交易员id
			$data['delivery_date']=strtotime($data['delivery_date']);
			$data['delivery_place']=$data['delivery_place'].'|';    //交货地
			$data['ship_type']=$data['ship_type'];
			$data['input_time']=CORE_TIME;
			$data['status']=1;
			$data['user_id']=$this->userid;
			$data['sn']='UO'.genOrderSn();

			M('sale_buy')->add($data);
			//发送站内信
			$name=$purData['type']==1?'采购':'报价';
			$msgType=$purData['type']==1?2:3;
			$msg=L('msg_template')['offers'];
			$msg=sprintf($msg,$name,$purData['id'],$purData['model'],$purData['unit_price'],$_SESSION['uinfo']['name'],$purData['id'],$purData['type']);
			D("SysMsg")->sendMsg($purData['user_id'],$msg,$msgType);
			// p(D("SysMsg")->_sql());
			$_SESSION['order_success']=true;
			$this->json_output(array('err'=>0,'msg'=>'提交成功'));
		}else{
			$this->json_output(array('err'=>4,'msg'=>'请求错误'));
		}
	}
	/**
	 * 
	 * @return [type] [description]
	 */
	public function msg(){
		if(!$_SESSION['order_success'] || $this->userid<=0) $this->redirect('/');
		$_SESSION['order_success']=null;

		$customer_manager=M('admin')->field('admin_id,name,mobile')->where("admin_id = ".intval($_SESSION['uinfo']['cu_manageer'])."")->find();
		$this->assign('customer_manager',$customer_manager);
		$this->display('success');
	}
	public function test1(){
		// sesstion_start();
		$sessionId = session_id();
		p($sessionId);die;
		// p(session_name());die;
		// $url = 'http://www.gsp.com/plasticpczone/index/index?PHPSESSID='.$sessionId;
		// header('Location:' . $url);
		// $array = [1,2,3,1,1,2,2,4,3];
		// $unique_arr = array_unique ( $array );
		// p($unique_arr);
		// $repeat_arr = array_diff_assoc ( $array, $unique_arr );
  //   	p($repeat_arr);
  		// 测试用例 
		// $array = array ( 
		//         'apple', 
		//         'iphone', 
		//         'miui', 
		//         'apple', 
		//         'orange', 
		//         'orange'  
		// ); 
		// $repeat_arr = $this->FetchRepeatMemberInArray ( $array ); 
		// print_r ( $repeat_arr );
	}
	//
	public function FetchRepeatMemberInArray($array) { 
    $len = count ( $array ); 
    $c = 0;
    for($i = 0; $i < $len; $i ++) { 
        for($j = $i + 1; $j < $len; $j ++) { 
            if ($array [$i] == $array [$j]) { 
                $repeat_arr [] = $array [$i]; 
                $c++;
                break; 
            } 
        } 
    } 
	    $repeat_arr['count'] = $c;
	    return $repeat_arr; 
	} 
	public function test2(){
		
		$date = date('Y-m-d H:i:m',strtotime('2 days'));
		p($date);die;

		$sessionId = session_id('3b2qufgojr6cal8m3989o9laa1');
		p($sessionId);
	}
}