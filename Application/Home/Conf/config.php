<?php
return array(
	//'配置项'=>'配置值'
	'HTML_CACHE_ON'     =>    true, // 开启静态缓存
    'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
	'HTML_FILE_SUFFIX'  =>    '.html', // 设置静态缓存文件后缀
	'HTML_CACHE_RULES'  =>     array(  // 定义静态缓存规则
		'Index:index' => array('index', 3600),// 定义格式1 数组方式,Index控制器的index方法
		'Index:goods' => array('{id|goodsdir}/goods_{id}',3600),
	),
);

// 每100个页面放到一个目录下（不要把所有的文件都放到一个目录下）
function goodsdir($id)
{
	return ceil($id/100);  // 计算所在目录的名称
}