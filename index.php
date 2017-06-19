<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
define('SYS_PATH', dirname(__FILE__));
// 定义应用目录
define('APP_PATH','./Application/');
// define('CORE_PATH', SYS_PATH.'/Application/Common/MyLib/');
define('APP_URL','http://www.myshop.com/');
define('FILE_URL', 'http://www.myShop.static.com');

//引入全局配置文件
require SYS_PATH.'/Archive/class/compile.class.php';
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';
// print_r($_SERVER);
// 亲^_^ 后面不需要任何代码了 就是如此简单