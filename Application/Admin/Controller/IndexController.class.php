<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller
{	
	protected $where = '';
	protected $adminId = 0;
	public function __construct()
	{	// 先调用父类的构造函数
		parent::__construct();
		$this->adminId = session('id');
		// 验证登录
		if(!$this->adminId)
			redirect(U('Admin/Login/login'));
		// 1. 先获取当前管理员将要访问的页面	 - TP带三个常量
		$url = MODULE_NAME .'/'. CONTROLLER_NAME . '/' . ACTION_NAME;
		// 查询数据库判断当前管理员有没有访问这个页面的权限
		$this->where = 'b.module_name="'.MODULE_NAME.'" AND b.controller_name="'.CONTROLLER_NAME.'" AND b.action_name="'.ACTION_NAME.'"';
		
		// 任何人只要登录了就可以进入后台
		if(CONTROLLER_NAME == 'Index')
			return TRUE;
		
		if($this->adminId == 1)
			$sql = 'SELECT COUNT(*) has FROM php34_privilege b WHERE '.$this->where;
		else
			$sql = 'SELECT COUNT(a.role_id) has
			  FROM php34_role_privilege a
			   LEFT JOIN php34_privilege b ON a.pri_id=b.id
			   LEFT JOIN php34_admin_role c ON a.role_id=c.role_id
			    WHERE c.admin_id='.$this->adminId.' AND '.$this->where;
		$db = M();
		$pri = $db->query($sql);
		if($pri[0]['has'] < 1 && $this->adminId !=1)
			$this->error('无权访问！');
	}
	public function index()
	{	
		$this->display();
	}
	public function menu()
	{	//获取当前管理员的所有权限
		// 取出当前管理员所有的权限
		if($this->adminId == 1)
			$sql = 'SELECT * FROM php34_privilege';
		else 
			$sql = 'SELECT b.* FROM php34_role_privilege a
			   LEFT JOIN php34_privilege b ON a.pri_id=b.id
			   LEFT JOIN php34_admin_role c ON a.role_id=c.role_id
			    WHERE c.admin_id='.$this->adminId;
		$db = M();
		$pri = $db->query($sql);
		$btn = array();
		foreach ($pri as $k => $v) {
			// 找顶级权限
			if($v['parent_id'] == 0)
			{
				// 再循环把这个顶级权限的子权限
				foreach ($pri as $k1 => $v1)
				{
					if($v1['parent_id'] == $v['id'])
					{
						$v['children'][] = $v1;
					}
				}
				$btn[] = $v;//增加字段
			}
		}
		$this->assign('btn',$btn);
		$this->display();
	}
	public function top()
	{
		$this->display();
	}
	public function main()
	{
		$this->display();
	}
	/**
	 * 给前端页面添加按钮功能
	 * @param [type] $rbtn  [description]
	 * @param [type] $title [description]
	 * @param [type] $url   [description]
	 */
	public function setPageBtn($rbtn,$title,$url){
    	$this->assign(array(
        '_page_btn_name' => $rbtn,
        '_page_title' => $title,
        '_url' =>$url,
        ));
 	}
 	public function test(){
 		// 1. 初始化一个cURL会话
        // $ch = curl_init();
        // 2. 设置请求选项, 包括具体的url
        // curl_setopt($ch, CURLOPT_URL, "http://www.gsplbb.xyz:3000");
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_HEADER, 0);
        // 3. 执行一个cURL会话并且获取相关回复
        // $response = curl_exec($ch);
        // echo $response;
        // $curl_info= curl_getinfo($ch);
        // echo "收到的http回复的code为： {$curl_info['http_code']}";
        // 4. 释放cURL句柄,关闭一个cURL会话
        // curl_close($ch);

 		$this->display();
 	}
 	public function getCurlInfo(){
 		//type:微信 weixin,app,pc,所有平台 publish
		// 指明给谁推送，为空表示向所有在线用户推送
		$to_uid = '';
		// 推送的url地址，上线时改成自己的服务器地址
		$push_api_url = "http://www.gsplbb.xyz:3000";
		$post_data = array(
		    'type' => 'weixin',
		    'content' => 'just a test',
		    'to' => 9270,
		);
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $push_api_url );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		// curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_data );
		$return = curl_exec($ch);
		$curl_info= curl_getinfo($ch);
        echo "收到的http回复的code为： {$curl_info['http_code']}";
		curl_close ($ch);
		var_export($return);
 	}
}














