<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="buy-crumb w1220">首页-商城报价-订单下达</div>
<!--success begin-->
	<div class="success">
	    <p class="serve color3">您已经下单成功，等待审核订单，您的专属交易员：<span><?php echo ($customer_manager["name"]); ?> <?php echo ($customer_manager["mobile"]); ?></span> 会及时为您服务！</p>
	    <p class="tips">Tips：委托结果可以在“<span>用户中心-联营商城订单</span>”中查看委托详细进展</p>
	    <div class="opt">
	        <a class="flt" href="/">返回首页</a>
	        <a class="frt" href="/user/unionorder">查看订单详细</a>
	    </div>
	</div>
</body>
</html>