<?php
/**
*前端公共控制器
*@author gsp <[<email address>]>
*@since [version> [<description>]
*/
namespace Home\Controller;
use Think\Controller;
use MyLib\RedisCluster;

class HomeBaseController extends Controller
{
	protected $userid;
	public function __construct(){
		parent::__construct();
		// $_SESSION['userid'] = 9270;
		$contact = D('CustomerContact')->getUserInfo(9270);
		//开启session服务
		startHomeSession();
		//实例化一个redis对象
		$redis = new RedisCluster();
		if(!$redis->get('userid_'.SESS_ID) && !$redis->get('uinfo_'.SESS_ID)){
			//先删除过期的
			$allUidKeys = $redis->keys('userid_*');
			foreach ($allUidKeys as $key => $value) {
				if($redis->get($value) == 9270){
					$str = substr($value,7);
					$redis->delete('uinfo_'.$str);
					$redis->delete($value);
					unset($str);
				}
			}
			//再设置新的
			$redis->set('userid_'.SESS_ID,9270);
			$redis->set('uinfo_'.SESS_ID,json_encode($contact));
		}
		$this->userid = $_SESSION['userid'] = $redis->get('userid_'.SESS_ID);
		$_SESSION['uinfo'] = $redis->get('uinfo_'.SESS_ID);
		/***************************************************************/
		// $this->userid = $_SESSION['userid'];
		// session('uinfo',NULL);
		// if(empty($_SESSION['uinfo'])){
		// 	$_SESSION['uinfo'] = D('CustomerContact')->getUserInfo($_SESSION['userid']);
		// }
		//系统信息:赋值模板
		// $sys = D('Setting')->getSetting();
		// $this->assign('sys',$sys);
	}
	/**
	 * 重写父类的error方法
	 * @param  string $message [description]
	 * @return [type]          [description]
	 */
	protected function error($message='') {
			$this->json_output(array('err'=>1,'msg'=>$message));
    }
    /**
     * 重写父类的success方法
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    protected function success($message='') {
			$this->json_output(array('err'=>0,'msg'=>$message));
    }
}