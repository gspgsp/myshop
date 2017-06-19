<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>add goods </title>
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
	<form action="/admin/goods/add" method="POST" enctype="multipart/form-data">
		商品名称:<input type="text" name="goods_name" /><br/>
		商品价格:<input type="text" name="price" /><br/>
		商品logo:<input type="file" name="logo" /><br/>
		商品描述:<textarea name="goods_desc" id="goods_desc"></textarea><br />
		商品是否上架:
		<input type = "radio" id="up" name="is_on_sale" value="1" checked="checked" /><label for="up">上架</label>
		<input type = "radio" id="down" name="is_on_sale" /><label for="down">下架</label>
		<div style="margin-left: 120px;">
			<input type="submit" value="提交">
		</div>
	</form>
</body>
</html>
<script>
	UE.getEditor('goods_desc', {
	"initialFrameWidth" : "100%",  // 宽
	"initialFrameHeight" : 350,     // 高
	"maximumWords" : 50000             // 最可以输入的字符数
});
</script>