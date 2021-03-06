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
<script type="text/javascript" src="http://www.myShop.static.com/home/js/jquery/jquery.validtip.js"></script>
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
        <li><a href="/points" target="_blank">积分商城</a></li>
        <li><a href="/q.html" target="_blank">塑料圈</a></li>
    </ul>
    <!--nav end-->
    <div class="download frt"><a href="/download.html">手机客户端</a></div>
</div>
<!--header end-->


<div class="buy-crumb w1220">首页-商城报价-<?php echo ($title); ?></div>
<!--buy-wrap begin-->
<div class="buy-wrap talk">
    <!--buy-info begin-->
    <form id="talkForm" onSubmit="return false;" method="post" action="">
        <div class="buy-info">
            <div class="buy-title">
                <span>交易员：<?php echo ($data["adname"]); ?>  <?php echo ($data["admobile"]); ?></span>
            </div>
            <table>
            	<tr>
                	<td width="100">公司名称：</td>
                    <td width="208"><?php echo ($data["c_name"]); ?></td>
                    <td width="100">联<i></i>系<i></i>人：</td>
                    <td width="208"><?php echo ($data["name"]); ?></td>
                </tr>
                <tr>
                	<td>联系电话：</td>
                    <td><?php echo ($data["mobile"]); ?></td>
                    <td>现货/期货：</td>
                    <td>
                        <?php if($data["cargo_type"] == 1): ?>现货<?php else: ?>期货<?php endif; ?>
                    </td>
                </tr>
                <tr>
                	<td>交<i></i>货<i></i>地：</td>
                    <td><?php echo ($data["city"]); ?></td>
                    <td>仓<b></b>库：</td>
                    <td><?php echo ($data["store_house"]); ?></td>
                </tr>
                <tr>
                	<td>品<b></b>种：</td>
                    <td><?php echo ($data["product_type"]); ?></td>
                    
                    <td>厂<b></b>家：</td>
                    <td><?php echo ($data["f_name"]); ?></td>
                </tr>
                <tr>
                	<td>牌<b></b>号：</td>
                    <td><?php echo ($data["model"]); ?></td>
                    <td>运输方式<span class="red">*</span>：</td>
                    <td>
                        <select datatype="*" name="ship_type" class="req">
                            <option value="">请选择</option>
                            <?php if(is_array($ship_type)): foreach($ship_type as $key=>$value): ?><option value="<?php echo ($key); ?>"><?php echo ($value); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>配送日期<span class="red">*</span>：</td>
                    <td><input type="text" id="date1" datatype="*"  class="req" name="delivery_date"/></td>
                    <td>配送地点<span class="red">*</span>：</td>
                    <td>
                        <select datatype="*" name="delivery_place" class="req">
                            <option value="">请选择</option>
                            <?php if(is_array($area)): $key = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key % 2 );++$key;?><option value="<?php echo ($value["id"]); ?>"><?php echo ($value["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>数<b></b>量<span class="red">*</span>：</td>
                    <td><input type="text" class="req" id="number" datatype="*" value="<?php echo ($data["number"]); ?>" name="number" data-number="<?php echo ($data["number"]); ?>"/>吨</td>
                    <td>预期价格<span class="red">*</span>：</td>
                    <td><input type="text" class="req" datatype="*" value="<?php echo ($data["unit_price"]); ?>" name="price" data-id="<?php echo ($data["user_id"]); ?>"/>元／吨</td>
                </tr>
            </table>
        </div>
        <div class="remark">
            <div class="remark-lt flt">备注：</div>
            <div class="remark-rt flt"><textarea name="remark"></textarea></div>
        </div>
        <div class="buy-btn">
            <input type="hidden" name="p_id" value="<?php echo ($data["id"]); ?>">
            <input type="hidden" name="user_id" value="<?php echo ($data["user_id"]); ?>">
        	<button onclick="submitFrom()">提交</button>
            <button><a class="btn" href="/Offers">返回</a></button>
            
        </div>
    </form>
    <!--buy-btn end-->
</div>
<script type="text/javascript">
$(function(){
    laydate({
        elem: '#date1',
        event: 'focus',
        min: laydate.now()
    });
})

// var demo=$("#talkForm").Validform({
//     tiptype:function(msg,o,cssctl){
//         if(!o.obj.is("form")){
//             var objtip=o.obj.siblings(".Validform_checktip");
//             cssctl(objtip,o.type);
//             objtip.text(msg);
//         }
//     }
// });

function submitFrom(){
    // if(!demo.check()) return false;
    var num= parseFloat($('#number').val().trim());
    var number=parseFloat($('#number').data('number'));
    if(num>number){
        layer.msg('超过对方求购数量,最多能供货'+number+'吨');
        $("#number").val(number);
        return false;
    }
    if(num<number){
        layer.msg('供货只能为：'+number+'吨');
        $("#number").val(number);
        return false;
    }
    var data=$("#talkForm").serialize();
    $.post('/Talk/addorder',data, function(data){
        if(data.err==0){
            window.location.href="/Talk/msg";
        }else{
            layer.msg(data.msg,2,3);
        }
    },'json');
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
<script type="text/javascript">
    
    function doTalk(id)
    {
        var user=$("#user_name").html();
        if(!user){
            loginbox('offers');
            return;
        }
        window.location.href="/offers/talk?id="+id;
    }
</script>

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
</html>