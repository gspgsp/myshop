<?php
return array(
	//'配置项'=>'配置值'
	'CORE_TIME'=>time(),
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => '123.56.220.132', // 服务器地址
	'DB_NAME'   => 'purchase', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '123456', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'php34_', // 数据库表前缀
	'DB_CHARSET'=> 'utf8', // 字符集
	'URL_ROUTER_ON'=>ture,//开启路由
	/*******图片的相关配置********/
	'IMG_SIZE' => '3M',
	'IMG_EXTS' => array('jpg','gif','png','jpeg','bmp'),
	'IMG_ROOTPATH' =>'./Public/Uploads/',
	'IMG_SAVEPATH' =>'Goods/',
	'IMG_URL' =>'/Public/Uploads/',
	/*********系统常量配置*********/
	'TMPL_PARSE_STRING'  =>array(
	'__PUBLIC__' => '/Public',
	'__UPLOAD__' => '/Public/Uploads',
	'__IMG__'=>FILE_URL.'/home/img',
	'__CSS__'=>FILE_URL.'/home/css',
	'__JS__'=>FILE_URL.'/home/js',
	),
	/*********I方法过滤配置*********/
	'DEFAULT_FILTER' =>'trim,removeXSS,htmlspecialchars',
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
	/********* MD5时用来复杂化的 ****************/
	'MD5_KEY' => 'fdsa#@90#_jl329$9lfds!129',
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
	/*********自定义公共类库，命名空间配置*********/
	'AUTOLOAD_NAMESPACE' => array(
		'MyLib' => APP_PATH.'Common/MyLib',
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
	/**************Smarty配置*********************/
	// 'TMPL_ENGINE_TYPE'=>'Smarty',
	// 'TMPL_ENGINE_CONFIG'=>array(
	// 	'plugins_dir'=>'./Application/Smarty/Plugins/',
	// ),
	/************** 发邮件的配置 ***************/
	'MAIL_ADDRESS' => 'gspdss@163.com',   // 发货人的email
	'MAIL_FROM' => 'gspdss',      // 发货人姓名
	'MAIL_SMTP' => 'smtp.163.com',      // 邮件服务器的地址
	'MAIL_LOGINNAME' => 'gspdss',
	'MAIL_PASSWORD' => 'gsp123456',//第三方授权码
	/*************url 模式**********************/
	'URL_MODEL'=>2,
	/*************子域名配置******************/
	'APP_SUB_DOMAIN_DEPLOY'   =>    1, // 开启子域名配置
	'APP_SUB_DOMAIN_RULES'    =>    array(
	's.gsplbb.xyz'        => 'Home',  // s子域名指向Home模块
	),
);