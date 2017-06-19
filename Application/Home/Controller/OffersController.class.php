<?php
/**
* 新商城报价
* @author gsp <[<email address>]>
*/
namespace Home\Controller;
use Think\Model;
use MyLib\Cart;
// use Org\Util;
class OffersController extends HomeBaseController
{
	protected $cartList,$cart;
	public function _initialize(){
		$this->cart = new Cart();
	}
	/**
	 * 商城报价数据渲染
	 * @return [type] [description]
	 */
	public function index(){
		//获取购物车内容
		// $cart = new \MyLib\Cart();
		$this->cartList = $this->cart->getGoods();
		// p($this->cartList);die;
		$this->assign('cartList',$this->cartList);
		$this->act='offers';
		//筛选条件
		$cityWhere = "pid=1";
		$factoryWhere = "1";
		$where = 'pur.type = 2 and pur.shelve_type =1 and pur.status in (2,3,4)';
		//获取品种
		if($type = I('get.type',0,'int')){
		$seotype = L('product_type')[$type];
		$this->assign('type',$type);
		//获取类型
		$where.=" and pro.product_type = $type";
		//根据type获取省市
		$area_ids = M('purchase')->alias('pur')
			->join('__PRODUCT__ pro on pur.p_id = pro.id','left')
			->field('pur.provinces')
			->group('pur.provinces')
			->where(array('pro.product_type'=>array('eq',$type)))//三种写法，1.字符窜 2.$map['key'] = array(),单表 3.array(key=>array()),多表
			->select();
		foreach ($area_ids as $key => $value) {
			$areaid[$key] = $value['provinces'];
		}
		$areaid = array_unique($areaid);
		$cityWhere = 'id in ('.implode(",",$areaid).')';
		//获取厂家
		$factory_ids = D('BigOffers')->getModelCol('product','product_type ='.$type,'f_id');//只获取某一列,为一个数组
		if(!empty($factory_ids)) $factoryWhere = 'fid in ('.implode(',', $factory_ids).')';
		//获取加工级别
		$process_ids = D('BigOffers')->getModelCol('product','product_type ='.$type,'process_type');
		}
		//其它筛选条件
		if($process = I('get.process',0,'int')){
			$where.=" and pro.process_type=$process";
			$this->assign('process',$process);
			$process_type = L('process_level')[$process];
			$seoprocess = $process_type;
		}
		if($fa = I('get.fa',0,'int')){
			$where.=" and pro.f_id =$fa";
			$this->assign('fa',$fa);
			$seofa = M('factory')->where("fid=$fa")->getField('f_name');
		}
		//搜索操作
		if($key_model = I('get.key_model','','string')){
			$where.=" and pro.model like '%{$key_model}%'";
			$this->assign('key_model',$key_model);
		}
		if($key_name = I('get.key_name','','string')){
			$cids = M('customer')->alias('cus')->join('__PURCHASE__ pur on pur.c_id = cus.c_id','left')->where("cus.c_name like '%{$key_name}%'")->distinct(true)->field('cus.c_id')->select();
			foreach ($cids as $key => $value) {
				$ids[$key] = $value['c_id'];
			}
			$where.=" and pur.c_id in(".implode(',',$ids).")";
		}
		if($union = I('get.union',0,'int')){
			if($union == 1){
				$where.=" and pur.is_union = 1";//自营
			}else if($union == 2){
				$where.=" and pur.is_union = 0";//联营
			}
			$this->assign('union',$union);
		}
		//产品类型
		$product_type=L('product_type');
		$this->assign('product_type',$product_type);
		//加工级别
		$process_level=L('process_level');
		$processList=$process_level;
		$this->assign('processList',$processList);
		//厂家
		$factoryList = M('factory')->where($factoryWhere)->distinct(true)->limit(28)->select();//联动操作
		$this->assign('factoryList',$factoryList);
		//报价列表
		$result = D('BigOffers')->getPurchase($where);
		// p($result['list']);die;
		$this->assign(array('pages'=>$result['page'],'list'=>$result['list']));
		$this->seo = array('title'=>$seotype.' '.$seofa.' '.$seoprocess.' '.'商城报价');
		$this->display('index');
	}
	/**
	 * 添加购物车
	 * @author gsp <[<email address>]>
	 */
	public function addCart(){
		if(IS_POST){
			$id = I('post.id',0,'int');
			$number = I('post.number',0.00,'float');
			$goods = $this->cart->getGoods();
			if(count($goods) >=5) exit(json_encode(array('err'=>1,'msg'=>'最多只能选购5个商品。code:101')));
			foreach ($goods as $key => $value) {//$key极为$sid，$goods二维数组,里面只有一个键$sid
				if($value['id'] == $id) exit(json_encode(array('err'=>2,'msg'=>'不能重复选购。code:101')));
			}
			if(!$selectData = D('Purchase')->getPurchaseInfo($id)) exit(json_encode(array('err'=>3,'msg'=>'所选择的报价单不存在。code:101')));
			$sid = $this->addToCart($selectData);
			$selectData['sid'] = $sid;
			exit(json_encode(array('err'=>0,'msg'=>$selectData)));
		}
	}
	/**
	 * 添加到购物车里，实际上是保存到session中
	 */
	public function addToCart($data){
		$arr = array(
			'id'=>$data['id'],
			'name'=>$data['model'],
			'num'=>1,
			'number'=>$data['number'],
			'price'=>$data['unit_price'],
			'options'=>array(
				'p_id'=>$data['p_id'],
				'product_type'=>$data['product_type'],
				'model'=>$data['model'],
				'f_name'=>$data['f_name'],
				'unit_price'=>$data['unit_price'],
				'city'=>$data['city'],
			),
		);
		return $this->cart->add($arr);
	}
	/**
	 * 删除购物车
	 * @return [type] [description]
	 */
	public function delCart(){
		if(IS_POST){
			$sid = I('post.sid',0,'string');
			$res = $this->cart->del($sid);
			if($res){
				$this->json_output(array('err'=>0,'msg'=>'删除成功'));
			}else{
				$this->json_output(array('err'=>1,'msg'=>'删除失败'));
			}
		}
	}
	/**
	 * 获取公司的报价信息
	 * @return [type] [description]
	 */
	function getCompanyPurchase(){
		if(IS_GET){
			$c_id = I('get.c_id',0,'int');
			if($c_id){
			$info=M('customer')->alias('cus')
				->join('__CUSTOMER_CONTACT__ ct on cus.c_id = ct.c_id','left')
				->field('cus.c_id,ct.user_id,cus.c_name,cus.download,cus.`com_intro`,ct.mobile,ct.is_default')
				->where(array('cus.c_id'=>array('eq',$c_id),'ct.is_default'=>array('eq',1)))
				->find();
			}
			$str=mb_strlen($info['com_intro'],'utf-8');
			if($str<10) {
				$info['com_intro']=empty($info['com_intro'])?'暂无描述':$info['com_intro'];
			}
			if($str>10){
				$info['com_intro']=(mb_substr($info['com_intro'],0,10,'utf-8')).'...';
			}
			//同一个公司下的所有报价
			$list=D('Purchase')->getPurchaseByUserId($c_id);
			$this->assign('pages',$list['pages']);
			$this->assign('list',$list['list']);
			$this->assign('info',$info);
			$this->display('detail');
		}
	}
	/**
	 * 下载对应公司的报价信息
	 * @return [type] [description]
	 */
	public function downLoadCompanyPurchase(){
		if(IS_GET){
			$cid = I('get.cid',0,'int');
			$urls = I('get.urls','','string');
			$info = M('customer')->field('c_id,c_name,download')->where("c_id={$cid}")->find();
			$html = file_get_contents($urls);
			preg_match('/<div[^>]*class="detail-con"[^>]*>(.*?)<\/div>/si', $html, $match);
			$ma = strip_tags($match[0]);
			$aa = str_replace(array(" ","　","\t","\r"),"",$ma);
			$arr = explode("\n",trim($aa));
			$arr1 = array_filter($arr);//排除数组中为空的值
			$arr2 = array_values($arr1);//获取数组中的键值
			array_pop($arr2);//去掉最后一个也就是最上面一个的键值对 pop 弹出
			if(count($arr2)<2) $this->error('数据不存在',$urls);
			$data = $this->detactArray($arr2,9);
			$title = $data[0];
			foreach ($data as $key => $value) {
				if($key >0) $newArr[$key] = $value;
			}
			exportexcel($newArr,$title);//导出为excel
		}
	}
	/**
	 * 拆分数组9个一组
	 * @return [type] [description]
	 */
	public function detactArray($arr,$num){
		for ($i=0; $i < count($arr)/$num; $i++) {
			$tem[$i] = array_slice($arr,$i*$num,$num);
		}
		return $tem;
	}
	/**
	 * 获取联系人-视图的方式获取
	 * @return [type] [description]
	 */
	public function getContactView(){
		$data = D('ContactView')->getContactView($this->userid);
		return $data;
		// p($data);
	}

}