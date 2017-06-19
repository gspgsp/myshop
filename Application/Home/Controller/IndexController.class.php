<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    // public function index(){
    //     // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    //     if(IS_GET){
    //     	// $thisp->assign(array('id'=>I('get.id',0,int),'type'=>I('get.type',0,int)));
    //     	$this->assign('type',I('get.type',0,'int'));
    //     	$this->assign('id',I('get.id',0,'int'));
    //     }
    //     $this->display('index');
    // }
    /**
     * 数据库新建查询，利用mysql函数
     * @return [type] [description]
     */
    public function index(){
    	$cus_con = M('customer_contact')->field('name,mobile')->limit('0,10')->select();
        $this->display('index');
    	// p($cus_con);
    	// $con = mysql_connect('123.56.220.132','root','123456');
    	// if(!$con) die('失败');
    	// mysql_select_db('temp');
    	// // $sql = 'select rand_string(6) as my from dual';
    	// $sql = 'select losal as my from salgrade ';
    	// $res = mysql_query($sql,$con);
    	// if($row = mysql_fetch_assoc($res)){
    	// 	echo $row['my'];
    	// }
    }
    /**
     *  分表技术
     */
    public function addUser(){
    	// $con = mysql_connect('123.56.220.132','root','123456');
    	// if(!$con) die('失败');
    	// mysql_select_db('temp');
    	// $sql = 'insert into uuid values(null)';
    	// if(mysql_query($sql,$con)){
    	// 	$uuid = mysql_insert_id();

    	// }
    }
    public function test(){
        $arr = [1,2,3,4,5,6,7,8];
        $str = createLinkstring($arr);
        p($str);
    }
    public function test2(){
        echo "<img src='/Public/static/home/img/3.jpg'/>";
    }
}