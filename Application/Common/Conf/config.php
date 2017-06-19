<?php
return array(
	//'配置项'=>'配置值'
	'CORE_TIME'=>time(),
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => '123.56.220.132', // 服务器地址
	'DB_NAME'   => 'my', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '123456', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'p2p_', // 数据库表前缀
	'DB_CHARSET'=> 'utf8', // 字符集
	'URL_ROUTER_ON'=>ture,//开启路由
	'URL_ROUTE_RULES' => array(
		'Index/:id\d/:type\d$' => 'Index/index?id=:1&type=:2',
		'/^Offers\/([0-9]+)$/'=>'Home/Offers/getCompanyPurchase?c_id=:1',
		'/^cart$/'=>'Home/Cart/index',
		'/^Offers$/'=>'Home/Offers/index',
		'/^points$/'=>'Home/PointsShop/init',
		// 'index/:name$' => 'Index/index',
		// '/^getCategory\/([0-9]+)$/'=>'Home/PointsShop/getCategory?cate_id=:1',
		),
	/*******图片的相关配置********/
	'IMG_SIZE' => '3M',
	'IMG_EXTS' => array('jpg','gif','png','jpeg','bmp'),
	'IMG_ROOTPATH' =>'./Public/Uploads/',
	'IMG_SAVEPATH' =>'Goods/',
	/*********系统常量配置*********/
	'TMPL_PARSE_STRING'  =>array(
	'__PUBLIC__' => '/Public',
	'__UPLOAD__' => '/Public/Uploads',
	'__IMG__'=>FILE_URL.'/home/img',
	'__CSS__'=>FILE_URL.'/home/css',
	'__JS__'=>FILE_URL.'/home/js',
	),
	/*********I方法过滤配置*********/
	'DEFAULT_FILTER' =>'trim,removeXSS',
	/*********语言包配置*********/
	'LANG_SWITCH_ON'=>true,    //开启语言包功能
    'LANG_AUTO_DETECT'=> true, // 自动侦测语言 开启多语言功能后有效
    'DEFAULT_LANG' => 'zh-cn', // 默认语言
    'LANG_LIST'=> 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'=> 'l', // 默认语言切换变量
    /*********memcache缓存配置*********/
    //缓存方式
	'DATA_CACHE_TYPE' => 'Memcache',
	//v\ 缓存服务器地址
	'MEMCACHE_HOST'   => 'tcp://127.0.0.1:11211',
	//指定默认的缓存时长为3600 秒,没有会出错
	'DATA_CACHE_TIME' => '3600',
	/*********session配置*********/
	'SESSION_OPTIONS' => array(
	'expire'=>3600,//过期时间为3600
	),
	/*********自定义公共类库，命名空间配置*********/
	'AUTOLOAD_NAMESPACE' => array(
		'MyLib' => APP_PATH.'Common/MyLib',
	),
	/*********模板渲染配置*********/
	// 'LAYOUT_ON'=>true,
	// 'LAYOUT_NAME'=>'Public/main_layout',
	// 'TMPL_LAYOUT_ITEM'=>'{__CONTENT__}',
	// 'TMPL_CACHE_ON' => false,
	// 'HTML_CACHE_ON'   => false,   // 默认关闭静态缓存
	/************配置访问模块***************/
	'MODULE_ALLOW_LIST'    =>    array('Home','Admin'),
	'DEFAULT_MODULE'       =>    'Home',  // 默认模块
	'APP_USE_NAMESPACE' => true, // 应用类库是否使用命名空间 3.2.1新增
	'APP_SUB_DOMAIN_DEPLOY' => 1, // 是否开启子域名部署
	/*********自定义配置函数不仅仅是TP自带的function.php，就有了Corefunction.php Md5function.php*******/
	"LOAD_EXT_FILE"         =>'Corefunction,Md5function',
	/*********阿里云支付配置文件**************/
	'alipay_config'=>array(
       'partner' =>'2088702742257392',   //这里是你在成功申请支付宝接口后获取到的PID；
	    'key'=>'s1gktk3yxmv5i73iv2h66unz29xvt4zd',//这里是你在成功申请支付宝接口后获取到的Key
	    'sign_type'=>strtoupper('MD5'),
	    'input_charset'=> strtolower('utf-8'),
	    'cacert'=> getcwd().'\\cacert.pem',
	    'transport'=> 'http',
  	),
  	'alipay'   =>array(
		 //这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
		 'seller_email'=>'1554680230@qq.com',
		 //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
		 'notify_url'=>'http://www.myshop.com/Home/Pay/notifyurl', 
		 //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
		 'return_url'=>'http://www.myshop.com/Home/Pay/returnurl',
		 //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
		 'successpage'=>'User/myorder?ordtype=payed',   
		 //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
		 'errorpage'=>'User/myorder?ordtype=unpay', 
	 ),
  	//redis缓存设置
	'cache_redis' => array (
		'host' => '127.0.0.1:6379',
		'requirepass' => 'wdslw123',
		'pconnect' => false,
		'prefix' => 'p2p_',
		'expire' => 3600, //数据缓存有效期 3600 秒
		'cluster'=>false,//自己加的,是否用主从
	),
);