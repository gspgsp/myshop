<?php
/**
* 积分商城
* 包括 积兑换 签到
* @author gsp <[<email address>]>
*/
namespace Home\Controller;
use Think\Exception;

class PointsShopController extends HomeBaseController{
	protected $userModel,$pointsBillModel,$pointsSingModel,$signDay,$today,$weekStart;
	/**
	 * 初始化数据
	 * @return [type] [description]
	 */
	public function _initialize(){
		$this->signDay = array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0);
		$this->today = date('w');//星期几
		$this->weekStart = strtotime(date('Y-m-d',time()-((date('w')==0?7:date('w'))-1)*24*3600));//每周一时间
		// $this->cate_id  = I('get.cate_id',0,'int');
		$this->pointsSingModel = D('PointsSign');
		$this->pointsBillModel = D('PointsBill');
	}
	/**
	 * 页面入口
	 * @return [type] [description]
	 */
	public function init(){
		if($singData = D('PointsSign')->getSignData($this->userid)){
			if($singData['sing_time'] > $this->weekStart){//查看周一到周五是否签到过
				$this->signDay = json_decode($singData['sing_status'],true);
			}
		}
		$list = D('PointsGoods')->getPointsGoods();
		$this->assign(array('signDay'=>$this->signDay,'today'=>$this->today,'list'=>$list,'userpoints'=>$_SESSION['uinfo']['points']));
		$this->display('index');
	}
	/**
	 * 获取详细分类
	 * @author gsp <[<email address>]>
	 * @return [type] [description]
	 */
	public function getCategory(){
		$cate_id  = I('get.cate_id',0,'int');
		$sort = I('get.sort_f','sort','string');//默认的sort  points
		$list = D('PointsGoods')->getPointsGoods($cate_id,10,$sort);
		$this->assign(array('list'=>$list,'cate_id'=>$cate_id));
		$this->display('index');
	}
	/**
	 * 检查用户是否登录
	 * @return [type] [description]
	 */
	public function checklogin(){
		if($this->userid <1){
			$this->json_output(array('err'=>1,'msg'=>'请登录'));
		}else{
			$this->json_output(array('err'=>0,'msg'=>'已登录'));
		}
	}
	/**
	 * 获取验证码
	 * @return [type] [description]
	 */
	public function sendmsg(){
		//验证手机
		$mobile = I('post.phone','','string');
		if(!$this->_chkmobile($mobile)){
			$this->error($this->err);
		}
		$sms = D('SysMss');
		//检查注册的限制
		$result=$sms->chkRegLimit($mobile,get_ip());
		if(empty($result)){
			$this->error($sms->getError());
		}
		//请求动态码
		$result=$sms->genDynamicCode($mobile);
		if($result['err']>0){ //请求错误
			$this->error($result['msg']);
		}
		$msg=$result['msg']; //短信内容
		//发送手机动态码
		$sms->send(0,$mobile,$msg,2);
		$this->success('发送成功');
	}
	/**
     * 验证手机号码
     * @access private
     * @return bool
     */
	private function _chkmobile($value=''){
		if(!is_mobile($value)){
			if(empty($value)){
				$this->err='请输入手机号码';
			}else{
				$this->err='错误的手机号码';
			}
			return false;
		}
		return true;
	}
	/**
	 * 添加积分兑换订单
	 * @return [type] [description]
	 */
	public function addMyOrder(){
		$data = I('post.');
		$resVode = D('SysMss')->chkDynamicCode($data['phone'],$data['code']);//检查动态验证码
		if($resVode['err'] > 0) $this->json_output(array('err'=>3,'msg'=>$resVode['msg']));
		if(!is_mobile($data['phone'])) $this->json_output(array('err'=>4,'msg'=>'联系电话格式不正确'));
		$uinfo=D('CustomerContact')->getCustomerContact(intval($this->userid));
		$id=intval($data['gid']);//奖品id
		if(!$goods=D('PointsGoods')->find($id)) $this->json_output(array('err'=>5,'msg'=>'没有找到您要兑换的'));
		if($goods['status']==2) $this->json_output(array('err'=>6,'msg'=>'您兑换的商品已下架'));
        if($goods['num']<=0) $this->json_output(array('err'=>7,'msg'=>'您兑换的商品库存不足'));
    	if($uinfo['quan_points']<$goods['points']) $this->json_output(array('err'=>8,'msg'=>'您的积分不足'));
    	//事物模型
    	$model = D('PointsOrder');
    	//订单数据
    	$_orderData = array(
    		'status' => 1,
            'create_time'   => CORE_TIME,
            'order_id'      => $this->buildOrderId(),
            'goods_id'      => $goods['id'],
            'receiver'      => $data['receiver'],
            'phone'         => $data['phone'],
            'address'       => $data['address'],
            'uid'           => $this->userid,
            'usepoints'     => $goods['points'],
    		);
    	//开启事物
    	$model->startTrans();
    	try{
    		if(!$model->add($_orderData)) throw new Exception('系统错误，无法兑换。code:101');
            if(!D('PointsBill')->decPoints($goods['points'], $this->userid, 1, $goods['id'])) throw new Exception('系统错误，无法兑换。code:102');
    	}catch(Exception $e){
    		$model->rollback();
            $this->json_output(array('err'=>18,'msg'=>$e->getMessage()));
    	}
    	//事物提交
        $model->commit();
        $this->json_output(array('err'=>0,'msg'=>'兑换成功'));
	}
	/**
	 * 生成订单号
	 * @return [type] [description]
	 * array_map('functionName',arry) ord() 函数返回字符串的首个字符的 ASCII 值。
	 */
    protected function buildOrderId(){
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
    /**
     * 签到功能
     * @return [type] [description]
     */
    public function signOn(){
    	if($this->userid < 1) $this->json_output(array('err'=>1,'msg'=>'请登录'));
    	if($this->userid > 0){
    		if(in_array($this->today, array(0,6))) $this->json_output(array('err'=>2,'msg'=>'周一到周五可以签到'));
    		$sign = 50;
    		//当签到表存在用户时
    		if($data = $this->pointsSingModel->where("uid = {$this->userid}")->find()){
    			if($data['sing_time'] < strtotime(date('Y-m-d',time()))){
    				//如果小于本周开始时间，那么就让这一周状态归零
    				if($data['sing_time'] < $this->weekStart){
    					$signStatus = $this->signDay;
    				}else{
    					$signStatus = json_decode($data['sing_status'],true);
    				}
    				$signStatus[$this->today] = 1;//更改签到状态
    				if(array_sum($signStatus) == 5){
    					$sign = intval($sign)*2;
    				}
    				$pbill = array(
    					'sing_status'=>json_encode($signStatus),
    					'sing_time'=>time()
    					);
    				$this->pointsSingModel->startTrans();
    				try {
    					if(!$this->pointsSingModel->where("uid = {$this->userid}")->save($pbill)) throw new Exception("签到状态更新失败,code 110");
    					if(!$this->pointsBillModel->addPoints($sign,$this->userid,1)) throw new Exception("签到积分增加失败,code 111");
    				} catch (Exception $e) {
    					$this->pointsSingModel->rollback();
    					$this->json_output(array('err'=>4,'msg'=>$e->getMessage()));
    				}
    				$this->pointsSingModel->commit();
    				$this->json_output(array('err'=>0,'msg'=>'签到成功'));
    			}else{
    				$this->json_output(array('err'=>3,'msg'=>'今天已经签到过了'));
    			}
    		}else{
			//当签到表不存在用户时
			$this->signDay[$this->today] = 1;
			$data = array(
				'uid'=>$this->userid,
				'sing_status'=>json_encode($this->signDay),
				'sing_time'=>CORE_TIME
				);
			$this->pointsSingModel->startTrans();
			try {
				if(!$this->pointsSingModel->add($data)) throw new Exception("签到状态增加失败,code 112");
				if(!$this->pointsBillModel->addPoints($sign,$this->userid,1)) throw new Exception("签到积分增加失败,code 113");
			} catch (Exception $e) {
				$this->pointsSingModel->rollback();
				$this->json_output(array('err'=>5,'msg'=>$e->getMessage()));
			}
			$this->pointsSingModel->commit();
			$this->json_output(array('err'=>0,'msg'=>'签到成功'));
    		}
    	}else{
    		$this->json_output(array('err'=>6,'msg'=>'签到失败'));
    	}
    }
}