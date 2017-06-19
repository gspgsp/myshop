<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理中心</title>
	<meta name="robots" content="noindex, nofollow">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
	<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
	<link href="/Public/datepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" language="javascript" src="/Public/datepicker/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/datepicker/datepicker_zh-cn.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/tron.js"></script>
</head>
<body>
	<h1>
	    <span class="action-span"><a href="<?php echo ($_url); ?>"><?php echo ($_page_btn_name); ?></a></span>
	    <span class="action-span1"><a href="#">管理中心</a></span>
	    <span id="search_id" class="action-span1"> - <?php echo ($_page_title); ?> </span>
	    <div style="clear:both"></div>
	</h1>
	<!--  渲染页面 -->
	
<!-- 列表 -->
<div class="list-div" id="listDiv">
	<table cellpadding="3" cellspacing="1">
    	<tr>
            <th >类型名称</th>
			<th width="120">操作</th>
        </tr>
		<?php foreach ($data as $k => $v): ?>            
			<tr class="tron">
				<td><?php echo $v['type_name']; ?></td>
		        <td align="center">
		        	<a href="<?php echo U('Admin/Attribute/lst?type_id='.$v['id']); ?>" title="属性列表">属性列表</a> |
		        	<a href="<?php echo U('edit?id='.$v['id'].'&p='.I('get.p')); ?>" title="编辑">编辑</a> |
	                <a href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p')); ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
		        </td>
	        </tr>
        <?php endforeach; ?> 
		<?php if(preg_match('/\d/', $page)): ?>  
        <tr><td align="right" nowrap="true" colspan="99" height="30"><?php echo $page; ?></td></tr> 
        <?php endif; ?> 
	</table>
</div>
<script>
</script>

	<div id="footer">php34</div>
</body>
</html>