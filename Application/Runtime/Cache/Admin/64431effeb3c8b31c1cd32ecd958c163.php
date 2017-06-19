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
	
<!-- 搜索 -->
<div class="form-div search_form_div">
    <form method="GET" name="search_form">
		<p>
			角色名称：
	   		<input type="text" name="role_name" size="30" value="<?php echo I('get.role_name'); ?>" />
		</p>
		<p><input type="submit" value=" 搜索 " class="button" /></p>
    </form>
</div>
<!-- 列表 -->
<div class="list-div" id="listDiv">
	<table cellpadding="3" cellspacing="1">
    	<tr>
            <th >角色名称</th>
            <th >权限名称</th>
			<th width="60">操作</th>
        </tr>
        <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr class="tron">
				<td><?php echo ($v['role_name']); ?></td>
				<td><?php echo ($v['pri_name']); ?></td>
		        <td align="center">
		        	<a href="<?php echo U('edit',array('id'=>$v['id'],'p'=>I('get.p')));?>" title="编辑">编辑</a> |
	                <a href="<?php echo U('delete',array('id'=>$v['id'],'p'=>I('get.p')));?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
		        </td>
	        </tr><?php endforeach; endif; ?>
		<?php if(preg_match('/\d/', $data['page'])): ?>  
        <tr><td align="right" nowrap="true" colspan="3" height="30"><?php echo $page; ?></td></tr> 
        <?php endif; ?> 
	</table>
</div>
<script>
</script>

	<div id="footer">php34</div>
</body>
</html>