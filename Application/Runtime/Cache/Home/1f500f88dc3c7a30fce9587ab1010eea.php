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
<link rel="stylesheet" type="text/css" href="http://www.myShop.static.com/home/css/style.css"/>
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
        	<?php if(!empty($auth_info)): ?><li><?php echo ($auth_info["name"]); ?></li>
        	<?php else: ?>
        		<?php if($_SESSION['userid']> 0 ): ?><li><a id="user_name" href="/user"><?php echo ($_SESSION['uinfo']['con_name']); ?> 个人中心</a></li>
                	<li class="login"><a href="/user/logout"  >退出登录</a></li>
        		<?php else: ?>
					<li class="login"><a  href="/user/login">您好，请登录</a></li>
                	<li><a href="/user/register">免费注册</a></li><?php endif; endif; ?>
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
        <li ><a href="/Offers"  target="_blank" {if $on eq offers} class="hover" {/if} >商城报价</a></li>
        <li><a href="/client"   target="_blank" {if $on_1 eq client} class="hover" {/if}>大户报价</a></li>
        <li><a href="/Purchase" target="_blank" {if $on_2 eq purchase} class="hover" {/if}>采购单</a></li>
        <li><a href="/Resource" target="_blank" {if $on_3 eq resource} class="hover" {/if}>资源库</a></li>
        <li><a href="http://56.myplas.com/" target="_blank">物流专区</a></li>
        <li><a href="/finance"  target="_blank" {if $on_4 eq finance} class="hover" {/if}>塑料金融</a></li>
        <li><a href="/physical" target="_blank" {if $on_6 eq physical} class="hover" {/if}>物性表</a></li>
        <li style="display:none;"><a href="/article" target="_blank" {if $on_7 eq article} class="hover" {/if}>塑料头条</a></li>
        <li><a href="http://news.myplas.com/" target="_blank">塑料头条</a></li>
        <li><a href="/points" target="_blank">积分商城</a></li>
        <li><a href="/q.html" target="_blank">塑料圈</a></li>
    </ul>
    <!--nav end-->
    <div class="download frt"><a href="/download.html">手机客户端</a></div>
</div>
<!--header end-->

<div class="yabbg" style="width:1200px;margin: 0px auto;">
	<div class="yab">
		<div class="yabl">
			<div class="rmain resource">
				<div class="rel">
					<form name="validateForm1" action="" class="addform" method="post">
						<!--release begin-->
						<div class="release">
							<div class="type">
								<!--left begin-->
								<div class="left">
									<div class="rad cr"> <span class="pay_list_c1 on"></span><input type="radio" name="typ" value="1" checked="checked" class="radioclass"> 我有货，我要卖</div>
									<div class="rad"><span class="pay_list_c1"></span><input type="radio" name="typ" value="0" class="radioclass"> 我求购，我要买</div>
								</div>
								<!--left end-->
								<!--slogan begin-->
								<div class="slogan"><img src="http://www.myShop.static.com/home/img/home/reSlogan.png" width="359" height="16"></div>
								<!--slogan end-->
							</div>
							<!--cont begin-->
							<div class="cont">
								<textarea name="need" class="con" placeholder="请填写真实资源，写清楚：公司名称、你的名字、联系方式、货物以及数量"></textarea>
							</div>
							<!--cont end-->
							<!--release-btn begin-->
							<div class="release-btn">
								<input type="submit" name="button" id="button" value="立即发布">
							</div>
							<!--release-btn end-->
						</div>
						<!--release end-->
					</form>

					<!--search begin-->
					<div class="search">
						<!--search-inner begin-->
						<div class="search-inner">
							<!--left begin-->
							<div class="left">
								<span>
									<?php if($_POST['type']== 2 ): ?><a class="hover" href="/resource">全部<b><?php echo ($countAll); ?></b></a><?php endif; ?>
								</span>
								<span>
									<?php if($_POST['type']== 0 ): ?><a class="hover" href="/resource/index/init?type=0">求购<b><?php echo ($count2); ?></b></a><?php endif; ?>
								</span>
								<span>
									<?php if($_POST['type']== 1 ): ?><a class="hover" href="/resource/index/init?type=1">供应<b><?php echo ($count1); ?></b></a><?php endif; ?>
								</span>
							</div>
							<!--left end-->
							<form action="/resource/index/init" method="get" id="searfm">
								<input type="hidden" name="type" value="<?php echo ($_POST['type']); ?>" />
								<input type="text" name="keyword" id="txt1" value="" placeholder="在<?php echo ($countall); ?>条资源中搜索你需要的...">
								<input type="submit" value="" id="sear">
								<a href="javascript:;" id="refresh" onclick="myrefresh()">刷新</a>

							</form>
						</div>
						<!--search-inner end-->
					</div>
					<!--search end-->
					<div class="list">
						<?php if(is_array($list)): foreach($list as $k=>$v): ?><div class="lists">
							<div class="listl">
								<img width="48" height="48" src="http://q2.qlogo.cn/headimg_dl?bs=qq&amp;dst_uin=<?php echo ($v["user_qq"]); ?>&amp;src_uin=*&amp;fid=*&amp;spec=100&amp;url_enc=0&amp;referer=bu_interface&amp;term_type=PC" alt="用户头像">
								<!-- <p style="color:#ef4923">【求购】</p> -->
							</div>
							<div class="listr">
								<p class="title">
										<span class="name"><?php if(empty($v.user_nick)): echo ($v["realname"]); else: echo ($v["user_nick"]); endif; ?></span>
									<span>
										<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo ($v["user_qq"]); ?>&amp;site=qq&amp;menu=yes"><img src="http://wpa.qq.com/pa?p=2:<?php echo ($v["user_qq"]); ?>:41" border="0" alt="点击咨询" title="点击咨询"></a>
									</span>
									<span class="qq"><a href="javascript:void(0)">QQ:<?php echo ($v["user_qq"]); ?></a></span>
									<span></span><span class="time"><?php echo ($v["input_time"]); ?></span>
								</p>
								<pre style="min-height:50px;overflow:hidden;"><?php echo ($v["content"]); ?></pre>
								<p></p>
							</div>
							<div style="clear:both;"></div>
						</div><?php endforeach; endif; ?>

						<!--page begin-->
						<div class="page">
							<?php echo ($pages); ?>
						</div>
						<!--page end-->
					</div>
				</div>
				<div class="rer">
					<div class="first">
						<?php if($_SESSION['userid']> 0): ?><div class="already-login">
								<h2>我的积分</h2>
								<div class="amount">
									<p style="color: #923b00;"><?php echo ($userinfo["points"]); ?></p>
								</div>
								<?php if(!empty($is_sign)): ?><div class="sign-up-already">已签到</div>
									<?php else: ?>
									<div class="sign-up ">
										<p style="color:#fff;" onclick="qiandao()">签到领积分</p>
									</div><?php endif; ?>
							</div>
						<?php else: ?>
							<div class="no-login">
								<h2>您还没登录</h2>
								<p>登录后才可以发布现货和求购信息</p>
								<div class="info">
									<a class="log" href="/user/register">注册</a>
									<a class="reg" href="javascript:loginbox('resource')"><span></span>登录</a>
								</div>
							</div><?php endif; ?>
						<!-- {if $smarty.session.userid>0}
						<div class="already-login">
							<h2>我的积分</h2>
							<div class="amount">
								<p style="color: #923b00;"><?php echo ($userInfo["points"]); ?></p>
							</div>
							{if $is_sign}
							<div class="sign-up-already">已签到</div>
							{else}
							<div class="sign-up ">
								<p style="color:#fff;" onclick="qiandao()">签到领积分</p>
							</div>
							{/if}
						</div>
						{else}
						<div class="no-login">
							<h2>您还没登录</h2>
							<p>登录后才可以发布现货和求购信息</p>
							<div class="info">
								<a class="log" href="/user/register">注册</a>
								<a class="reg" href="javascript:loginbox('resource')"><span></span>登录</a>
							</div>
						</div>
						{/if} -->
					</div>
					<!--task begin-->
					<h3 class="re-title">每日任务</h3>
					<div class="task">
						<ul>
							<li>
								<div class="num"><img src="http://www.myShop.static.com/home/img/home/re1.png" width="53" height="65"></div>
								<div class="desc">
									<h4>发布一条资源</h4>
									<p>+<?php echo ($points["pub"]); ?> 积分</p>
								</div>
								<?php if(!empty($is_pup)): ?><div class="status yes">已完成</div>
								<?php else: ?>
									<div class="status no">未完成</div><?php endif; ?>
								<!-- {if $is_pup}
								<div class="status yes">已完成</div>
								{else}
								<div class="status no">未完成</div>
								{/if} -->
							</li>
							<li>
								<div class="num"><img src="http://www.myShop.static.com/home/img/home/re2.png" width="53" height="65"></div>
								<div class="desc">
									<h4>每日签到</h4>
									<p>+<?php echo ($points["sign"]); ?> 积分</p>
								</div>
								<?php if(!empty($is_sign)): ?><div class="status yes">已完成</div>
								<?php else: ?>
									<div class="status no">未完成</div><?php endif; ?>
								<!-- {if $is_sign}
								<div class="status yes">已完成</div>
								{else}
								<div class="status no">未完成</div>
								{/if} -->
							</li>
							<li class="last">
								<div class="num"><img src="http://www.myShop.static.com/home/img/home/re3.png" width="53" height="65"></div>
								<div class="desc">
									<h4>搜索一条资源</h4>
									<p>+<?php echo ($points["search"]); ?> 积分</p>
								</div>
								<?php if(!empty($is_search)): ?><div class="status yes">已完成</div>
								<?php else: ?>
									<div class="status no">未完成</div><?php endif; ?>
								<!-- {if $is_search}
								<div class="status yes">已完成</div>
								{else}
								<div class="status no">未完成</div>
								{/if} -->
							</li>
						</ul>
					</div>
					<!--task end-->
					<!--ad begin-->
					<div class="ad ad1">
						<div class="desc">
							<h4>资源库改版</h4>
							<p>每日签到、发布资源得积分</p>
						</div>
						<img src="http://www.myShop.static.com/home/img/home/reAdIcon1.png" width="54" height="54">
					</div>
					<!--ad end-->
					<!--ad begin-->
					<div class="ad ad2">
						<div class="desc">
							<h4>积分有啥用</h4>
							<p>积分可在积分商城兑换礼品</p>
						</div>
						<img src="http://www.myShop.static.com/home/img/home/reAdIcon2.png" width="58" height="58">
					</div>
					<!--ad end-->
					<h3 class="re-title">可能感兴趣的</h3>
					<div class="lis">
							<div class="left">
								<p><?php echo ($info["product_type"]); ?> / <?php echo ($info["model"]); ?> /<?php echo ($info["f_name"]); ?></p>
								<p><?php echo ($info["number"]); ?>吨 <?php echo ($info["cityname"]); ?></p>
							</div>
						<!--left end-->
						<!--right begin-->
							<div class="right">
								<p>￥<span><?php echo ($info["unit_price"]); ?></span></p>
								<div class="interest-btn"><a href="javascript:doTalk(<?php echo ($info["id"]); ?>);">去看看</a></div>
							</div>
						
					</div>
				</div>

			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
	function doTalk(id)
	{
		var user=$("#user_name").html();
		if(!user){
			loginbox('offers');
			return;
		}
		window.location.href="<?php echo U('/Home/Talk/index',array('id'=>$info['id']));?>";
	}

$('.radioclass').click(function(event) {
	// $(this).attr({'checked': 'checked'});
	$(this).prop('checked','checked');//attr也可以
	$(this).parents('.rad').siblings().find('.radioclass').removeAttr('checked');
	$(this).siblings('span').addClass('on').parent('div').addClass('cr');
	$(this).parents('.rad').siblings('div').removeClass('cr').find('span').removeClass('on');
	var i = $(this).parents('.rad').index();
	if(i==0){
		$('.con').attr('placeholder','请填写真实资源，写清楚，公司名称，你的名字，联系方式，和货物以及数量');
	}else{
		$('.con').attr('placeholder','填写你的求购内容让别人方便给你报价');
	}
});
//需求出入框
$('.con').focus(function(){
	c = $('.con').attr('placeholder');
	$(this).attr('placeholder','')
})
$('.con').blur(function(){
	$(this).attr('placeholder',c)
})
//提交发布
$('.addform').submit(function(){
	var content = $('.con').val().trim(),type = $('input[name="typ"]:checked').val();
	if(content == ''){
		layer.msg('请填写发布内容',1,3);
		return false;
	}
	$.ajax({
		url:'release',
		type:'post',
		data:{content:content,type:type},
		dataType:'json',
		// async:false,//同步
		success:function(res){
			if(res.err > 0){
				if(res.err == 1){
					loginbox('resource');//从resource登陆
				}else{
					layer.msg(res.msg,1,3);
				}
			}else{
				layer.msg(res.msg,1,1);
			}
		},
		error:function(){
			layer.msg('错误啦',1,3);
			return false;
		}
	})
})
// $(".addform").submit(function(){
// 	var content = $('.con').val().trim();
// 	var type=$('input[name="typ"]:checked').val();
// 	if(content == ''){
// 		layer.msg('请填写发布内容');
// 		return false;
// 	}
// 	$.post('/resource/index/release', {content:content,type:type}, function (data){
// 		if(data.err>0){
// 			if(data.err==1){
// 				loginbox('resource');
// 			}else{
// 				layer.msg(data.msg);
// 			}
// 		}else{
// 			layer.msg('发布成功');
// 			window.location.reload();
// 		}
// 	},'json')
// 	return false;
// })
	//签到
function qiandao(){
    $.post("<?php echo U('/Home/PointsShop/signOn');?>", function (res){
		if(res.err==1){
			loginbox('pointshop');
		}else if(res.err == 0){
			layer.msg(res.msg,1,1,function(){
				window.location.reload();
			});
		}else{
			layer.msg(res.msg,1,3);
		}

    },'json');
}
function myrefresh(){
	window.location.reload();
}
</script>



<!--footer begin-->
<div class="footer">
    <div class="w1220">
        <div class="left link3 flt">
            <ul>
                {foreach from=$footer item=value}
                <li>
                    <h4><?php echo ($value["cate_name"]); ?></h4>
                    {foreach from=$value.son item=v}
                    <p><a href="/page/<?php echo ($v["id"]); ?>.html"><?php echo ($v["title"]); ?></a></p>
                    {/foreach}
                </li>
                {/foreach}
            </ul>



        </div>
        <div class="right frt">
            <ul class="ewm color3">
                <li>
                    <p><img src="/Public/Uploads/<?php echo ($sys["weixin"]["qrcode"]); ?>" width="84" height="84"/></p>
                    <span>官方微信</span>
                </li>
                <li>
                    <p><img src="/Public/Uploads/<?php echo ($sys["app"]["itemtips"]["icon"]); ?>" width="81" height="81"/></p>
                    <span><?php echo ($sys["app"]["itemtips"]["text"]); ?></span>
                </li>
            </ul>
        </div>
    </div>
    <p style="text-align:center;" class="copyright color3"><?php echo ($sys["icp_number"]); ?>
    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1259304101'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1259304101%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
</p>
</div>
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
<!--zt-contact end-->
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