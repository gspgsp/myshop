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
	
<div class="main-div">
    <form name="main_form" method="POST" action="/index.php/Admin/Privilege/add.html" enctype="multipart/form-data">
        <table cellspacing="1" cellpadding="3" width="100%">
			<tr>
				<td class="label">上级权限：</td>
				<td>
					<select name="parent_id">
						<option value="0">顶级权限</option>
						<?php foreach ($parentData as $k => $v): ?>						<option value="<?php echo $v['id']; ?>"><?php echo str_repeat('-', 8*$v['level']).$v['pri_name']; ?></option>
						<?php endforeach; ?>					</select>
				</td>
			</tr>
            <tr>
                <td class="label">权限名称：</td>
                <td>
                    <input  type="text" name="pri_name" value="" />
                </td>
            </tr>
            <tr>
                <td class="label">模块名称：</td>
                <td>
                    <input  type="text" name="module_name" value="" />
                </td>
            </tr>
            <tr>
                <td class="label">控制器名称：</td>
                <td>
                    <input  type="text" name="controller_name" value="" />
                </td>
            </tr>
            <tr>
                <td class="label">方法名称：</td>
                <td>
                    <input  type="text" name="action_name" value="" />
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
</script>

	<div id="footer">php34</div>
</body>
</html>