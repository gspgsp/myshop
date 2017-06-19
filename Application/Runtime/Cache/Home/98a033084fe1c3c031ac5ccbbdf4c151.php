<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php if($seo["cate_name"] != ''): ?><title><?php echo ($seo["title"]); ?>_<?php echo ($seo["cate_name"]); ?> <?php echo ($sys["site_title"]); ?></title>
    <?php else: ?>
        <title><?php echo ($seo["title"]); ?>-<?php echo ($sys["site_title"]); ?></title><?php endif; ?>
    <!-- {if $seo.cate_name}
<title><?php echo ($seo["title"]); ?>_<?php echo ($seo["cate_name"]); ?> <?php echo ($sys["site_title"]); ?></title>
    {else}
    <title><?php echo ($seo["title"]); ?> <?php echo ($sys["site_title"]); ?></title>
    {/if} -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="qc:admins" content="3477461216651041363757" />
<!--<meta property="qc:admins" content="347746133667745354117636" />-->
<meta name="keywords" content="{if $seo.keywords}<?php echo ($seo["keywords"]); ?>{else}<?php echo ($sys["site_keywords"]); ?>{/if}" />
<meta name="description" content="{if $seo.description}<?php echo ($seo["description"]); ?>{else}<?php echo ($sys["site_desc"]); ?>{/if}" />
<!-- <link rel="shortcut icon" href="/Public/Uploads/<?php echo ($sys["site_icon"]); ?>" /> -->
<link rel="stylesheet" type="text/css" href="http://www.myShop.static.com/home/css/common.css"/>
<link rel="stylesheet" type="text/css" href="http://www.myShop.static.com/home/css/mailloffer.css"/>
<style type="text/css">
.copyright img{ display:inline;}
</style>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/layer-v1.8.5/layer.min.js"></script>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/common.js"></script>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/zeroclipboard/ZeroClipboard.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?4808bff4f0276952e006e0f3ec054483";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body>
<!--top begin-->
<div class="top color9 link9">
    <div class="w1220">
        <!--top-lt begin-->
        <ul class="top-lt flt">
            <li>欢迎光临<a href="/">我的塑料网</a>！</li>
            <li class="collect"><a href="javascript:Addme();">收藏本站</a></li>
            <li class="blog"><a target="_blank" href="<?php echo ($sys["weibo"]["link"]); ?>">官方微博</a></li>
            <?php if($_SESSION['userid']> 0): ?><li><a href="/user/myHomeWeb/getMyWeb">我的门户网站</a></li><?php endif; ?>
        </ul>
        <!--top-lt end-->
        <!--top-rt begin-->
        <ul class="top-rt frt">
            {if !empty($auth_info)}
                 <li><?php echo ($auth_info["name"]); ?></li>
                 {else}
                {if $smarty.session.userid > 0 }
                <li><a id="user_name" href="/user"><?php echo ($smarty["session"]["uinfo"]["name"]); ?> 个人中心</a></li>
                <li class="login"><a href="/user/logout"  >退出登录</a></li>
                   {else}
                <li class="login"><a  href="/user/login">您好，请登录</a></li>
                <li><a href="/user/register">免费注册</a></li>
                {/if}
            {/if}

            <!-- <li class="app"><a href="javascript:;">手机网站</a></li> -->
            <li><a href="/page">常见问题</a></li>
            <li><a href="/page?id=5601">联系我们</a></li>
            <li><a href="/page/index/feedBack">意见反馈</a></li>
            <li class="lang"><a href="/">中文</a> | <a href="javascript:;">EN</a></li>
        </ul>
        <!--top-rt end-->
    </div>
</div>
<!--top end-->
<!--header begin-->
<div class="header">
    <!-- <div class="logo flt"><a href="/"><img src="/Public/Uploads/<?php echo ($sys["site_logo"]); ?>" width="211" height="37"/></a></div> -->
    <div class="logo flt">
        <a href="/"><img src="/Public/Uploads/<?php echo ($sys["site_logo"]); ?>" width="121" height="75" alt="logo"/></a>
    </div>
    <div class="logo-brand flt"><img src="http://www.myShop.static.com/home/img/home/logo2Brand.jpg" width="79" height="32"/></div>
    <!--nav begin-->
    <ul class="nav link3 flt">
        <li ><a href="/offers"  target="_blank" {if $on eq offers} class="hover" {/if} >商城报价</a></li>
        <li><a href="/client"   target="_blank" {if $on_1 eq client} class="hover" {/if}>大户报价</a></li>
        <li><a href="/purchase" target="_blank" {if $on_2 eq purchase} class="hover" {/if}>采购单</a></li>
        <li><a href="/resource" target="_blank" {if $on_3 eq resource} class="hover" {/if}>资源库</a></li>
        <li><a href="http://56.myplas.com/" target="_blank">物流专区</a></li>
        <li><a href="/finance"  target="_blank" {if $on_4 eq finance} class="hover" {/if}>塑料金融</a></li>
        <li><a href="/physical" target="_blank" {if $on_6 eq physical} class="hover" {/if}>物性表</a></li>
        <li style="display:none;"><a href="/article" target="_blank" {if $on_7 eq article} class="hover" {/if}>塑料头条</a></li>
        <li><a href="http://news.myplas.com/" target="_blank">塑料头条</a></li>
        <li><a href="/pointshop" target="_blank">积分商城</a></li>
        <li><a href="/q.html" target="_blank">塑料圈</a></li>
    </ul>
    <!--nav end-->
    <div class="download frt"><a href="/download.html">手机客户端</a></div>
</div>
<!--header end-->


<div class="crumb w1220">
    <h3>商城报价</h3>
    <p>当前位置 - 综合首页 》</p>
    <span>公司报价</span>
</div>
<!--mail-detail begin-->
<div class="mail-detail w1220">
    <h1><?php echo ($info[c_name]); ?></h1>
    <!--other begin-->
    <div class="other">
        <b>主营品种：</b><span><?php echo ($info[com_intro]); ?></span>
        <b>电话：</b><span><?php echo ($info[mobile]); ?></span>
    </div>
    <!--other end-->
    <p class="tips">报价单共下载<span><?php echo ($info[download]); ?></span>次</p>
    <div class="download"><input type="button" value="下载" name="download" data-id="<?php echo ($info[c_id]); ?>"/></div>
    <!--link begin-->
    <div class="link">
        <p>报价单网址：http://www.myplas.com/Offers/<?php echo ($info[c_id]); ?>.html</p>
        <div class="copy" data-clipboard-tex=""> 一键复制链接</div>
    </div>
    <!--link end-->
    <h3>报价信息</h3>
    <!--detail-con begin-->
    <div class="detail-con">
        <ul>
            <li class="detail-title">
                <p class="breed">品种</p> 
                <p class="grade">牌号</p> 
                <p class="factory">厂家</p>   
                <p class="amount">数量(吨)</p> 
                <p class="price">价格（元）/吨</p>
                <p class="area">交货地区</p>
                <p class="storage">实价/可议价</p>
                <p class="time1">现期货</p>
                <p class="time2">发布时间</p>
            </li>
            <?php if(is_array($list)): foreach($list as $key=>$value): ?><li class="detail-li">
                    <p class="breed"><?php echo (witchType($value["product_type"])); ?></p>
                    <p class="grade"><?php echo ($value["model"]); ?></p>
                    <p class="factory"><?php echo ($value["f_name"]); ?></p>
                    <p class="amount"><?php echo (floatval($value["number"])); ?></p>
                    <p class="price">￥<?php echo (floatval($value["unit_price"])); ?></p>
                    <p class="area color-gray"><?php echo ($value["store_house"]); ?></p>
                    <p class="storage color-gray"><?php if($value["bargain"] == 1): ?>可议价<?php else: ?>实价<?php endif; ?></p>
                    <p class="time1 color-gray"><?php if($value["cargo_type"] == 1): ?>现货<?php else: ?>期货<?php endif; ?></p>
                    <p class="time2 color-gray"><?php echo ($value["input_time"]); ?></p>
                </li><?php endforeach; endif; ?>
        </ul>
        <div class="page">
            <?php echo ($pages); ?>
        </div>
    </div>
    <!--detail-con end-->
</div>
<!--mail-detail end-->

<script>
    //一键复制链接
    var client = new ZeroClipboard( $(".copy") );
    var clipBoardContent=this.location.href;
        client.on('copy', function (event) {
            event.clipboardData.setData('text/plain', clipBoardContent);
            layer.msg('复制成功',1,1);
    });
    var button = $('input[name="download"]'),c_id = button.data('id'),urls = window.location.href;
    button.on('click',function(){
        window.location.href ="/Home/Offers/downLoadCompanyPurchase?cid="+c_id+"&urls="+urls;
        // window.location.href ='<?php echo U("/Home/Offers/downLoadCompanyPurchase",array("cid"=>"'+c_id+'"));?>';
    });

</script>

<!--footer end-->

<div class="renzheng">
    <ul>
        {foreach from=$Partner item=value key=key}
        <li>
            <a href="<?php echo ($value["url"]); ?>" target="_blank">
                <img border="0" src="/Public/Uploads/<?php echo ($value["img"]); ?>"/>
            </a>
        </li>
        {/foreach}
    </ul>
</div>
<script charset="utf-8" src="http://wpa.b.qq.com/cgi/wpa.php"></script>
<!--zt-contact begin-->

<div class="zt-contact">
    <ul>
        <li class="opt">
            <div id="BizQQWPA">
                <div class="zt-slide bg-gray">在线咨询</div>
                <div class="zt-mouseover icon-qq bg-gray"></div>
            </div>
        </li>
        <li>
            <div class="ewm bg-gray"><img src="http://www.myShop.static.com/home/img/home/zt-wx-ewm.jpg" width="200" height="200"></div>
            <div class="icon-ewm icon-wx bg-gray"></div>
        </li>
        <li>
            <div class="ewm bg-gray"><img src="http://www.myShop.static.com/home/img/home/zt-ios-ewm.png" width="200" height="200"></div>
            <div class="icon-ewm icon-ios bg-gray"></div>
        </li>
        <li class="opt">
            <a href="/page/index/feedBack">
                <div class="zt-slide bg-gray">意见反馈</div>
                <div class="zt-mouseover icon-suggest bg-gray"></div>
            </a>
        </li>
        <li class="go-top"></li>
    </ul>
</div>
<script>
$(function(){
     var ztContact = $(".zt-contact");
        ztContact.find(".icon-qq").bind("mouseover",function(){
            $(this).closest("li").find(".zt-slide").removeClass("bg-gray").addClass("bg-orge");
            $(this).removeClass("bg-gray").addClass("bg-orge");
            $(this).closest("li").find(".zt-slide").stop().animate({
                "left":"0px"
            });
        });
        ztContact.find(".opt").bind("mouseleave",function(){

            $(this).find(".zt-slide").removeClass("bg-orge").addClass("bg-gray");
            $(this).find(".zt-mouseover").removeClass("bg-orge").addClass("bg-gray");
            $(this).find(".zt-slide").stop().animate({
                "left":"60px"
            });
        });
        ztContact.find(".icon-suggest").bind("mouseover",function(){
            $(this).closest("li").find(".zt-slide").removeClass("bg-gray").addClass("bg-orge");
            $(this).removeClass("bg-gray").addClass("bg-orge");
            $(this).closest("li").find(".zt-slide").stop().animate({
                "left":"0px"
            });
        });
        ztContact.find(".icon-ewm").bind("mouseover",function(){
            $(this).prev(".ewm").show();
            $(this).removeClass("bg-gray").addClass("bg-orge");
        });

        ztContact.find(".icon-ewm").bind("mouseleave",function(){
            $(this).prev(".ewm").hide();
            $(this).removeClass("bg-orge").addClass("bg-gray");
        });

        //返回顶部
        $(".go-top").bind("click",function(){
            $('html,body').animate({'scrollTop':0},300,function(){
                $(".go-top").hide();
            });
        });

        $(window).bind("scroll",function(){
            if($(window).scrollTop()>=300){
                $(".go-top").show();
            }
            if($(window).scrollTop()<300){
                $(".go-top").hide();
            }
        });
        //收藏本站
        // function Addme(){
        //  url = "http://www.baidu.com"; //你自己的主页地址
        //  title = "百度收藏"; //你自己的主页名称
        //  window.external.AddFavorite(url,title);
        // }
});

BizQQWPA.addCustom({aty: '0', a: '0', nameAccount: 4000677611, selector: 'BizQQWPA'});
</script>
</body>