<?php
/**
* 资源库的控制器
* php-5.6.15
* @author gsp <[<email address>]>
*/
namespace Home\Controller;
use MyLib\SphinxClient;
use Think\Exception;

class ResourceController extends HomeBaseController
{
	protected $resourceModel;
	protected $cusContactModel;
	function _initialize(){
		$this->resourceModel = D('Resource');
		$this->cusContactModel = D('CustomerContact');
	}
	// public function test(){
	// 	$conf = C('cache_redis');
	// 	$arr_host = explode(':', $conf['host']);
	// 	p($arr_host);
	// }
	public function test(){
		echo phpinfo();
	}
	/**
	 * 获取资源库的数据
	 * @return [type] [description]
	 */
	public function init(){
		if($userinfo = $this->cusContactModel->getContactByuserid($this->userid)) $this->assign('userinfo',$userinfo);
		//查看积分完成状态
		$poBillModel = M('PointsBill');
		$today = strtotime(date('Y-m-d',time()));
		$this->is_sign=$poBillModel->where("uid={$this->userid} and type=1 and addtime>$today")->find();
		$this->is_pup=$poBillModel->where("uid={$this->userid} and type=9 and addtime>$today")->find();
		$this->is_search=$poBillModel->where("uid={$this->userid} and type=10 and addtime>$today")->find();
		$this->count1 = $this->resourceModel->field('count(*) as count')->where(array('type'=>array('eq',1)))->find()['count'];
		$this->count2 = $this->resourceModel->field('count(*) as count')->where(array('type'=>array('eq',0)))->find()['count'];
		$this->countAll = $this->count1 + $this->count2;
		$this->points = array(
			'search'=>50,
			'pub'=>100,
			'sign'=>50
			);
		// $this->points=D('Setting')->getSinSetting('points')['points_pc'];//查询配置项PC端积分

		$type = I('post.type',2,'int');//（0求购 1现货）
		$keywords = trim(I('post.keywords','','string'));
		if(!empty($keywords)){
			$sc = new SphinxClient();
			$sc->setServer('localhost',9312);
			// $sc->SetMatchMode(SPH_MATCH_PHRASE);
			$res = $sc->Query($keywords);
			if(!empty($res)){
				$ids = array_keys($res['matches']);
				$list = $this->resourceModel->getSearch($ids,$keywords);
			}
		}else{
			$list = $this->resourceModel->getList($type);
		}
		$this->assign(array('pages'=>$list['page'],'list'=>$list['list']));
		$this->info=$this->_getInfo();//可能感兴趣的
		$this->seo = array(
			'title'=>'资源库',
			'keywords'=>'塑料资源，塑料交易信息，塑料原料交易信息',
			'description'=>'我的塑料网资源库栏目运用互联网和大数据基础实时收录海量塑料原料交易信息，免费提供塑料原料交易信息查询',
			'status'=>4
			);
		//qq授权登录
		// $auth_info['name'] = 'gsp';
		// $auth_info['num'] = 123456;
		// $this->assign('auth_info',$auth_info);
		$this->display('index');
	}
	/**
	 * 获取可能感兴趣的产品
	 */
	private function _getInfo(){
		$info =  D('Purchase')->getRecommandInfo($this->userid);
		$arr['id'] = $info['id'];
		$arr['product_type'] = $info['product_type'];
		$arr['model'] = $info['model'];
		$arr['unit_price'] = $info['unit_price'];
		$arr['cityname'] = $info['store_house'];
		$arr['number'] = $info['number'];
		$arr['f_name'] = $info['f_name'];
		return $arr;
	}
	/**
	 *  发布报价或者采购
	 * @return [type] [description]
	 */
	public function release(){
		if($_POST){
			$data = saddslashes($_POST);
			if($this->userid <=0) $this->json_output(array('err'=>1,'msg'=>'请登录'));
			$uinfo=$_SESSION['uinfo'];
			preg_match('/1[34578]\d{9}$/', $data['content'],$arr);
			//匹配手机号,是否为潜在客户
			if(!empty($arr[0])){
				$userid = M('customer_contact')->where("mobile = {$arr[0]}")->getField('user_id');
				if(empty($userid)){
					if(!M('potential_customers')->where("mobile = {$arr[0]}")->getField('id')){
						$po = array(
							'uid'=>$this->userid,
							'mobile'=>$arr[0],
							'status'=>0,
							'input_time'=>CORE_TIME
							);
						M('potential_customers')->add($po);
					}
				}
			}
			//插入数据库，并且发放积分
			$res_data = array(
				'uid'=>$this->userid,
				'type'=>$data['type'],
				'content'=>$data['content'],
				'input_time'=>CORE_TIME,
				'realname'=>$uinfo['name'],
				'user_qq'=>$uinfo['qq'],
				);
			$resourceModel = D('Resource');
			$PointsBill = D('PointsBill');
			$resourceModel->startTrans();
			try {
				if(!$resourceModel->add($res_data)) throw new  Exception('系统错误。resource_log:110');
				$today = strtotime(date('Y-m-d',time()));
				if(!$PointsBill->where("uid={$this->userid} and type=9 and addtime>$today")->find()){
					// $pub = D('Setting')->getSinSetting('points')['points_pc']['pub'];
					$pub = 50;
					if(!$PointsBill->addPoints($pub,$this->userid,9)) throw new  Exception('系统错误。points_bill_log:111');
				}
			} catch (Exception $e) {
				$resourceModel->rollback();
				$this->json_output(array('err'=>2,'msg'=>$e->getMessage()));
			}
			$resourceModel->commit();
			$this->json_output(array('err'=>0,'msg'=>'操作成功'));
		}
	}
}

