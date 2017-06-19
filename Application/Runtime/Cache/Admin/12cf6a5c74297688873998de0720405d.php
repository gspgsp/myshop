<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品列表</title>
	<link href="/Public/datepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" language="javascript" src="/Public/datepicker/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/datepicker/datepicker-zh_cn.js"></script>
</head>
<body>
	<form method="get" action="<?php echo U('Admin/Goods/lst');?>">
		<!-- <input type="hidden" name="p" value="1" /> -->
		商品名称：<input type="text" name="goods_name" value="" /><br /><br/>
		添加时间：<input type="text" id="start_addtime" name="start_addtime" value="" />-<input type="text" id="end_addtime" name="end_addtime" value="" /><br/><br/>
		价　　格：<input type="text" name="start_price" value="" />-<input type="text" name="end_price" value="" /><br />

		上否上架：<input type="radio" name="is_on_sale" value="-1"/>全部
				<input type="radio" name="is_on_sale" value="1"/>是
				<input type="radio" name="is_on_sale" value="0"/>否<br />
		是否删除：<input type="radio" name="is_delete" value="-1"/>全部
				<input type="radio" name="is_delete" value="1"/>是
				<input type="radio" name="is_delete" value="0" />否<br />

		排序方式：<input onclick="parentNode.submit();" type="radio" name="odby" value="id_asc" />根据添加时间升序
				<input onclick="parentNode.submit();" type="radio" name="odby" value="id_desc" />根据添加时间降序
				<input onclick="parentNode.submit();" type="radio" name="odby" value="price_asc" />根据价格升序
				<input onclick="parentNode.submit();" type="radio" name="odby" value="price_desc" />根据价格降序<br />
		<input type="submit" value="搜索" /><br /><br />
		<a href="<?php echo U('Admin/Goods/add');?>">添加新商品</a>
	</form>
	<br />
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="5">
		<tr>
			<th>id</th>
			<th>添加时间</th>
			<th>商品名称</th>
			<th>LOGO</th>
			<th>价格</th>
			<th>描述</th>
			<th>是否上架</th>
			<th>是否删除</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["addtime"]); ?></td>
				<td><?php echo ($vo["goods_name"]); ?></td>
				<td><img src='<?php echo ($vo["sm_logo"]); ?>' /></td>
				<td><?php echo ($vo["price"]); ?></td>
				<td><?php echo ($vo["goods_desc"]); ?></td>
				<td><?php echo ($vo["is_on_sale"]); ?></td>
				<td><?php echo ($vo["is_delete"]); ?></td>
				<td>
					<a href="<?php echo U('Admin/Goods/edit',array('id'=>$vo['id'],'p'=>I('get.p',1,'int')));?>">修改</a>
					<a onclick="return confirm('确认要删除么')" href="<?php echo U('Admin/Goods/delete',array('id'=>$vo['id'],'p'=>I('get.p',1,'int')));?>">删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
		<tr><td colspan="9"><?php echo ($page); ?></td></tr>
	</table>
</body>
</html>
<script>
	$("#start_addtime").datepicker({ dateFormat: "yy-mm-dd" });
	$("#end_addtime").datepicker({ dateFormat: "yy-mm-dd" });
</script>