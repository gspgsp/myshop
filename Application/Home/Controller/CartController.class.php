<?php
/**
* 购物车控制器
* @author gsp <[<email address>]>
*/
namespace Home\Controller;
use Think\Model;
use Think\Exception;
class CartController extends HomeBaseController
{
	protected $cartList,$cart;
	public function _initialize(){
		$this->cart = new \MyLib\Cart();
		$this->cartList = $this->cart->getGoods();
		$this->assign('cartList',$this->cartList);
	}
	/**
	 * 进入购物车列表
	 * @return [type] [description]
	 */
	public function index(){
		if(empty($this->userid)) $this->redirect('Login/index');//未登录跳到登录界面
		if(empty($this->cartList)) $this->redirect('Offers/index');//购物车为空就跳到商城报价
		$this->area = D('lib_region')->getRegion(1);//获取配送地点
		$admin = D('CustomerContact')->getAdmin($_SESSION['uinfo']['cu_manageer']);
		$this->assign(array(
			'pay_method'=>L('pay_method'),
			'transport_type'=>L('transport_type'),
			'admin'=>$admin,
			));
		$this->display('index');
	}
	/**
	 * 加载我的购物车
	 * @return [type] [description]
	 */
	public function loadCart(){
		$this->totalNums = $this->cart->getTotalNums();
		$this->totalWeights = $this->cart->getTotalWeights();
		$this->totalPrice = $this->cart->getTotalPrice();
		$this->display('cart');
	}
	/**
	 * 重新设置购物车内容
	 * @author gsp <[<email address>]>
	 */
	public function setCart(){
		if(IS_POST){
			$post = I('post.');
			$data = array(
				'sid'=>$post['id'],
				'number'=>$post['number'],
				'num'=>1,
				);
			if($this->cart->updateCart($data)) $this->json_output(array('err'=>0,'msg'=>'修改成功'));
			$this->json_output(array('err'=>2,'msg'=>'修改失败'));
		}
	}
	/**
	 * 提交订单
	 * @author gsp <[<email address>]>
	 * @return [type] [description]
	 */
	public function addorder(){
		if(empty($this->userid)) $this->redirect('Login/index');//未登录跳到登录界面
		if(IS_POST){
			$data=saddslashes($_POST);
			$contact = D('CustomerContact')->getCustomerContact($this->userid);
			unset($data['num']);
			$data['order_sn'] = 'SO'.genOrderSn();
			$region_name = D('LibRegion')->getRegion($data['delivery_place'])[0]['name'];
			//两种条件下
			if($data['transport_type'] == 1){
				$data['pickup_time'] = strtotime($data['delivery_date']);
				$data['delivery_time']='--';	  //送货日期
				$data['pickup_location']='--';    //配送地点
				$data['delivery_location']='--';  //提货地点
				unset($data['delivery_place']);
				unset($data['delivery_date']);
			}else{
				$data['pickup_time']=strtotime($data['delivery_date']);	    //提货日期
				$data['delivery_time']=strtotime($data['delivery_date']);	//送货日期
				$data['pickup_location']=$region_name.$data['address'];           //配送地点
				$data['delivery_location']=$region_name.$data['address'];         //提货地点
			}
			$data['order_type'] = 1;
			$data['sign_place'] = '网站签约';
			$data['order_source'] = 1;
			$data['remark'] = htmlspecialchars($data['remark']);
			$data['c_id'] = $contact['c_id'];
			$data['user_id'] = $this->user_id;
			$data['customer_manager'] = $_SESSION['uinfo']['cu_manageer'];
			$data['sign_time']=CORE_TIME;
			$data['total_num']=$_SESSION['cart']['total_rows'];
			$data['total_price']=$this->cart->getTotalPrice();	//总金额
			$data['financial_records']=2;
			$data['input_time']=CORE_TIME;	//创建时间
			$data['order_name']=1;	//默认为中晨
			$orderModel = M('order');
			$goods=$this->cart->getGoods(); //购物车列表
			$orderModel->startTrans();
			try{
				if(!$order_id = $orderModel->data($data)->add()) throw new Exception('系统错误。 order:111');
				//将购物车的内容添加到sale_log表中
				$modelName = '';
				$priceName = '';
				foreach ($goods as $key => $value) {
					$modelName .= $value['name'].',';
					$priceName .= $value['price'].',';
					$sale_log = array(
						'o_id'=>$order_id,// 可以通过该id查询到order表的订单信息
						'p_id'=>$value['options']['p_id'],
						'number'=>$value['num'],
						'unit_price'=>$value['price'],
						'input_time'=>time(),
						);
					if(!M('sale_log')->add($sale_log)) throw new  Exception('系统错误。sale_log:110');
				}
			}catch(Exception $e){
				$orderModel->rollback();
				$this->json_output(array('err'=>2,'msg'=>$e->getMessage()));
			}
			$orderModel->commit();
			$this->cart->delAll();//删除购物车内容
			//编辑站内短信息
			$msg = L('msg_template')['order'];
			$msg = sprintf($msg,trim($modelName,','),trim($priceName,','),$order_id);
			D('SysMsg')->sendMsg($this->userid, $msg, 1);
			$_SESSION['order_success']=true;//标识符
			$this->json_output(array('err'=>0,'msg'=>'操作成功'));
		}
	}
}