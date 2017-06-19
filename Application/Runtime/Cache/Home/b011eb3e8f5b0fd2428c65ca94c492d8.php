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
<link rel="stylesheet" type="text/css" href="http://www.myShop.static.com/home/css/jqtransform.css"/>
<style type="text/css">
.copyright img{ display:inline;}
</style>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/layer-v1.8.5/layer.min.js"></script>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/common.js"></script>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/zeroclipboard/ZeroClipboard.js"></script>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/laydate/laydate.js"></script>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/Validform_v5.3.2_min.js"></script>
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

<div class="buy-wrap">
    <!--buy-process begin-->
    <div class="buy-process">
        <ul>
            <li class="one"><p>1</p><span>商城直营产品选择</span></li>
            <li class="two"><p>2</p><span>物流服务选择</span></li>
            <li class="three"><p>3</p><span>供应链金融服务选择</span></li>
            <li class="four"><p>4</p><span>完成交易</span></li>
        </ul>
        <div class="line"></div>
    </div>
    <!--buy-process end-->
    <form id="cartFrom" method="" action="">
        <!--order-confirm begin-->
        <div class="order-confirm">
            <!--buy-info begin-->
            <div class="buy-info">
                <div class="buy-title">
                    <h2>基本信息</h2>
                    <span>我的交易员：<?php echo ($customer_manager["name"]); ?>  <?php echo ($customer_manager["mobile"]); ?></span>
                </div>
                <table id="table">
                    <tr>
                        <td width="80">客户名称：</td>
                        <td width="200"><?php echo ($smarty["session"]["uinfo"]["c_name"]); ?></td>
                        <td width="80">联<i></i>系<i></i>人：</td>
                        <td width="110"><?php echo ($smarty["session"]["uinfo"]["name"]); ?></td>
                        <td width="80"></td>
                    </tr>
                    <tr>
                        <td>联系电话：</td>
                        <td><?php echo ($smarty["session"]["uinfo"]["mobile"]); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>付款方式<span class="red">*</span>:</td>
                        <td>
                            <select datatype="*" name="pay_method" class="required" id="pay_method">
                                <option value="">请选择</option>
                                {foreach from=$pay_method item=value key=key}
                                <option value="<?php echo ($key); ?>"><?php echo ($value); ?></option>
                                {/foreach}
                            </select>
                        </td>
                        <td>运输方式<span class="red">*</span>:</td>
                        <td>
                            <select datatype="*" id="transport_type" name="transport_type" class="required">
                                <option value="">请选择</option>
                                {foreach from=$transport_type item=value key=key}
                                <option value="<?php echo ($key); ?>"><?php echo ($value); ?></option>
                                {/foreach}
                            </select>
                        </td>
                        <td>配送时间<span class="red">*</span>:</td>
                        <td> <input type="text" id="date3"  datatype="*" name="delivery_date" class="required"/></td>
                    </tr>
                    <tr class="other hide">

                        <td>配送地点<span class="red">*</span>:</td>
                        <td>
                            <select datatype="*" name="delivery_place" class="required" id="delivery_place" >
                                <option value="">请选择</option>
                                {foreach from=$area item=value key=key}
                                <option value="<?php echo ($value["id"]); ?>"><?php echo ($value["name"]); ?></option>
                                {/foreach}
                            </select>
                        </td>
                        <td>详细地址<span class="red">*</span>:</td>
                        <td><input type="text" id="address"  datatype="*" name="address" class="required"  placeholder="详细地址"/></td>
                    </tr>
                </table>
                <!--sly-chn begin-->
                <div class="sly-chn">
                    
                </div>
                <!--sly-chn begin-->
            </div>
            <!--buy-info end-->

        </div>
        <!--order-confirm end-->
        <!--detail begin-->
        <div class="detail" id="load-cart" data-url="/cart/index/loadCart">
			
        </div>
        <div class="remark">
            <!--remark-lt begin-->
            <div class="remark-lt flt">备注：</div>
            <!--remark-lt end-->
            <!--remark-rt begin-->
            <div class="remark-rt flt"><textarea id="remark" placeholder="允许输入35个字符！" name="remark"></textarea></div>
            <!--remark-rt end-->
        </div>
        <!--detail end-->
        <!--buy-btn begin-->
        <div class="buy-btn">
            <button type="submit" >确认下单</button>
            <a href="/offers">返回</a>
        </div>
    </form>
    <!--buy-btn end-->
</div>
<script>

    //配送时间
    $(function(){
        laydate({
            elem: '#date3',
            event: 'focus',
            min: laydate.now()
        });
    })
    //显示隐藏
    $('#transport_type').click(function(){
        if($(this).val()==2 ||$(this).val()==3){
            $(".buy-wrap .order-confirm .other").removeClass("hide");
            $(".buy-wrap .order-confirm .other input").addClass("required");
            $(".buy-wrap .order-confirm .other input").val('');
            $(".buy-wrap .order-confirm .other select").addClass("required");
        }else{
            $(".buy-wrap .order-confirm .other").addClass("hide");
            $(".buy-wrap .order-confirm .other input").val('');
        }

    })
    //删除产品
    function delCart(id,that){
//        alert($(that).closest('tr').find('input').val());
//        alert($(that).closest('tr').find('.money').html());
        $.ajax({
            url:'/offers/index/delCart',
            type:'post',
            data:{id:id},
            cache:false,
            dataType:'json',
            async : false,     //设置同异步 false:同步  true:异步
            success:function(data){
                if(data.err==0){
                    $(that).parents('tr').remove();
                    load_cart();
                    if($("#cart .details").size()==0){
                        window.location.href="/offers";
                    }
                }

            }
        })
    }
    function load_cart(){   
        if($('#load-cart').size() > 0){
            $('#load-cart').load($('#load-cart').attr('data-url'));
        }

    }

    var check = function(){
        var rtn = true;
        var   pay_method=$('#pay_method').val();            //支付方式
        var   transport_type=$('#transport_type').val();    //运输方式
        var   date3=$("#date3").val();                      //配送时间
        var   delivery_place=$("#delivery_place").val();    //配送地点
        var   address=$("#address").val();                  //详细地址
        var   remark=$('#remark').val().trim();                   //备注

        if($("#transport_type").val()==1){
            if(pay_method==''){
                layer.msg('支付方式不能为空');
                pay_method.focus();
                rtn = false;
                return rtn;
            }
            if(transport_type==''){
                layer.msg('运输方式不能为空');
                transport_type.focus();
                rtn = false;
                return rtn;
            }
            if(date3==''){
                layer.msg('配送时间不能为空');
                date3.focus();
                rtn = false;
                return rtn;
            }

        }else{
            if(pay_method==''){
                layer.msg('支付方式不能为空');
                pay_method.focus();
                rtn = false;
                return rtn;
            }
            if(transport_type==''){
                layer.msg('运输方式不能为空');
                transport_type.focus();
                rtn = false;
                return rtn;
            }
            if(date3==''){
                layer.msg('配送时间不能为空');
                date3.focus();
                rtn = false;
                return rtn;
            }
            if(delivery_place==''){
                layer.msg('配送地点不能为空');
                delivery_place.focus();
                rtn = false;
                return rtn;
            }
            if(address==''){
                layer.msg('详细地址不能为空');
                address.focus();
                rtn = false;
                return rtn;
            }
        }
        if(remark){
            if(remark.length>35){
                layer.msg('最大允许输入35个字符！');
                return false;
            }
        }

        var arr = new Array();
        //验证购物车中商品有无库存余量
        $("#cart .details").each(function(index,o){
            var obj = new Object();
            obj.id =$(o).attr("data-id");
            obj.model =$(o).find("#data-id").attr("data-id");
            obj.f_name =$(o).find("#data-ids").attr("data-ids");
            obj.amount = $(o).find(".amount input[type='text']").val();
            arr.push(obj);
        });
        var details=JSON.stringify(arr);

        $.ajax({
            url:'/cart/index/error',
            data:{data:details},
            type:'post',
            cache:'false',
            dataType:'json',
            async : false,     //设置同异步 false:同步  true:异步
            success:function(datas){
                console.log(datas);
                if(datas.err==1){
                    var str='<p>牌号:'+datas.msg.model+'</p>'+'<p>厂家:'+datas.msg.f_name+'<br>'+'库存不足</p>';
                    layer.msg(str);
                    rtn = false;
                    return rtn;
                }else{
                    rtn = true;
                    return rtn;
                }
            }
        })
        return rtn;
    }

    $("#cartFrom").submit(function(){

    	
        if($("#transport_type").val()==2 ||$("#transport_type").val()==3){
            $(".other select").addClass("required").attr("datatype","*");
        }else{
            $(".other select").removeClass("required").removeAttr("datatype");
        }
        //检验
        if(!check()) return false;

        var data=$("#cartFrom").serialize();
        $.post('/cart/index/addorder',data,function(data){
            if(data.err==0){
                window.location.href="/cart/index/msg";
            }else{
                layer.msg(data.msg);
            }
        },'json');

        return false;
    });

    $(function(){
        load_cart();
    });
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
		// 	url = "http://www.baidu.com"; //你自己的主页地址
		// 	title = "百度收藏"; //你自己的主页名称
		// 	window.external.AddFavorite(url,title);
		// }
});

BizQQWPA.addCustom({aty: '0', a: '0', nameAccount: 4000677611, selector: 'BizQQWPA'});
</script>
</body>