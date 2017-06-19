<?php
namespace Home\Controller;
class CartController extends HomeBaseController
{
	public function add()
	{
		$cartModel = D('Cart');
		$goodsAttrId = I('post.goods_attr_id');
		if($goodsAttrId)
		{
			// 把属性ID升序排列，因为后台存属性的存量时是升序的，为了能取出库存量
			sort($goodsAttrId);
			$goodsAttrId = implode(',', $goodsAttrId);
		}
		$cartModel->addToCart(I('post.goods_id'), $goodsAttrId, I('post.amount'));
		redirect(U('lst'));
	}
	
	public function lst()
	{
		$cartModel = D('Cart');
		$data = $cartModel->cartList();
		$this->assign('data', $data);
		
		$this->setPageInfo('购物车', '购物车', '购物车', 1, array('cart'), array('cart1'));
		$this->display();
	}
	public function ajaxUpdateData()
	{
		$gid = I('get.gid');
		$gaid = I('get.gaid', '');
		$gn = I('get.gn');
		$cartModel = D('Cart');
		$data = $cartModel->updateData($gid, $gaid, $gn);
		if($data){
			$this->json_output(array('err'=>0,'msg'=>'删除成功'));
		}
	}
}




















