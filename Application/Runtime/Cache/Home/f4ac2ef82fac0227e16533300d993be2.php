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
        <li><a href="/points" target="_blank">积分商城</a></li>
        <li><a href="/q.html" target="_blank">塑料圈</a></li>
    </ul>
    <!--nav end-->
    <div class="download frt"><a href="/download.html">手机客户端</a></div>
</div>
<!--header end-->


<div class="crumb w1220">
    <h3>商城报价</h3>
    <p>当前位置 - 综合首页 -</p>
    <span>商城报价</span>
</div>
<style type="text/css">
    .mall-offer .filter-other li .filter-sel a.current{color:#fff; background:#fc6621; border-radius:3px;}
</style>

<!-- {insert_js files='/home/touch/socialUtils.js'} -->
<div class="mall-offer w1220">
    <!--left begin-->
    <div class="left">
        <!--filter-wrap begin-->
        <div class="filter-wrap link3">
            <!-- <div class="filter-already">
                <a href="javascript:;">全部</a>
            </div> -->
                <ul id="screen" class="filter-other">
                    <li>
                        <div class="filter-name">品种</div>
                        <div class="filter-sel">
                            <a class="m <?php if($type == ""): ?>current<?php endif; ?>" data-key="type" data-val="" href="javascript:;">全部</a>
                            <?php if(is_array($product_type)): foreach($product_type as $k=>$vo): ?><a class="m <?php if($type == $k): ?>current<?php endif; ?>" data-key="type" data-val="<?php echo ($k); ?>"  href="javascript:;"><?php echo ($vo); ?></a><?php endforeach; endif; ?>
                        </div>
                    </li>
                    <li>
                        <div class="filter-name">应用</div>
                        <!--filter-sel begin-->
                        <div class="filter-sel">
                            <a class="m <?php if($process == 0): ?>current<?php endif; ?>" data-key="process" data-val="" href="javascript:;">全部</a>
                            <?php if(is_array($processList)): foreach($processList as $k=>$vo): ?><a class="m <?php if($process == $k): ?>current<?php endif; ?>" data-key="process" data-val="<?php echo ($k); ?>"  href="javascript:;"><?php echo ($vo); ?></a><?php endforeach; endif; ?>
                        </div>
                        <!--filter-sel end-->
                    </li>
                    <!--factory begin-->
                    <li class="factory">
                        <div class="filter-name">厂家</div>
                         <!--filter-sel begin-->
                        <div class="filter-sel limit-height">
                            <a class="m <?php if($fa == 0): ?>current<?php endif; ?>" data-key="fa" data-val="" href="javascript:;">全部</a>
                            <?php if(is_array($factoryList)): foreach($factoryList as $k=>$vo): ?><a class="m <?php if($fa == $vo.fid): ?>current<?php endif; ?>" data-key="fa" data-val="<?php echo ($vo["fid"]); ?>"  href="javascript:;"><?php echo ($vo["f_name"]); ?></a><?php endforeach; endif; ?>
                        </div>
                        <!--filter-sel end-->
                         <!--filter-more begin-->
                        <div class="filter-more">展开呗</div>
                        <!--filter-more end-->
                    </li>
                    <!--factory end-->
                </ul>
                <div class="search">
                <form method="get" action="/Offers" id="searchForm">
                    <span>牌号：</span><input type="text" name="key_model" value="<?php echo ($key_model); ?>" class="import"/>
                    <span>公司名称：</span><input type="text" name="key_name" value="<?php echo ($key_name); ?>" class="import"/>
                    <input type="checkbox" class="check" <?php if($union == 1): ?>checked<?php endif; ?> name="union" value="1" id="check1"/><label for="check1">商城自营</label>
                    <input type="checkbox" class="check" <?php if($union == 2): ?>checked<?php endif; ?> name="union" value="2" id="check2"/><label for="check2">商城联营</label>
                    <input type="checkbox" class="check" {if $cargotype==1 }checked{/if} name="cargo_type" value="1" id="check3"/><label for="check3">现货</label>
                    <input type="checkbox" class="check" {if $cargotype==2 }checked{/if} name="cargo_type" value="2" id="check4"/><label for="check4">期货</label>
                    <span>报价周期：</span>
                    <select name="cycle">
                        <option value="">不限</option>
                        {foreach from=$period item=value key=key}
                        <option {if $cycle==$key}selected{/if} value="<?php echo ($key); ?>"><?php echo ($value); ?></option>
                        {/foreach}
                    </select>
                    <button>搜索</button>
                    <input type="hidden" name="type" id="type" value="<?php echo ($type); ?>">
                    <input type="hidden" name="process" id="process" value="<?php echo ($process); ?>">
                    <input type="hidden" name="ct" id="ct" value="<?php echo ($ct); ?>">
                    <input type="hidden" name="fa" id="fa" value="<?php echo ($fa); ?>">
                </form>
                </div>
            
        </div>
        <ul class="result">
            <li class="result-title">
                <div class="brand">品种</div>
                <div class="grade">牌号</div>
                <div class="level">加工级别</div>
                <div class="xian-qi">现期</div>
                <div class="factory">厂家</div>
                <div class="amount">数量</div>
                <div class="price">价格</div>
                <!-- <div class="change">涨跌</div> -->
                <div class="address">地区</div>
                <div class="place">交货地</div>
                <div class="company">公司</div>
                <div class="time">更新时间</div>
                <div class="opt">操作</div>
            </li>
            <?php if(is_array($list)): foreach($list as $key=>$value): if($value["is_union"] == 0): ?><!-- 联营 -->
                    <li class="result-con">
                        <div class="brand"><?php echo (witchType($value["product_type"])); ?></div>
                        <div class="grade"><?php echo ($value["model"]); ?></div>
                        <div class="level"><?php echo (setOption("process_level",$value["process_type"])); ?></div>
                        <div class="xian-qi <?php if($value["cargo_type"] == 1): ?>xian<?php else: ?> qi<?php endif; ?>"><span></span></div>
                        <div class="factory"><?php echo ($value["f_name"]); ?></div>
                        <div class="amount"><?php echo ($value["number"]); ?></div>
                        <div class="price"><i>￥</i><span><?php echo (floatval($value["unit_price"])); ?></span><?php if($value["bargain"] == 1): ?><b class="price1">议价</b><?php else: ?><b class="price2">实价</b><?php endif; ?></div>
                        <!-- <div class="change tie"><b></b><span>100</span></div> -->
                        <div class="address"><?php echo ($value["area"]); ?></div>
                        <div class="place"><?php echo ($value["store_house"]); ?></div>
                        <?php if($value["cus_man"] != '0'): ?><div class="company">
                            <span><?php echo ($value["customer"]["c_name"]); ?></span>
                            <div class="company-detail">
                                <h5><a href="/Offers/<?php echo ($value["c_id"]); ?>.html" target="_blank"><?php echo ($value["customer"]["c_name"]); ?></a></h5>
                                <p>交易员:<?php echo ($value["customer"]["adname"]); ?> <?php echo ($value["customer"]["admobile"]); ?></p>
                                <p>联系我时，请说是在我的塑料网看到的，谢谢！</p>
                            </div>
                            <b></b>
                        </div>
                        <?php else: ?>
                        <div class="company">
                            <span><?php echo ($value["customer"]["c_name"]); ?></span>
                            <div class="company-detail">
                                <h5><a target="_blank"><?php echo ($value["customer"]["c_name"]); ?></a></h5>
                                <p>交易员:<?php echo ($value["customer"]["adname"]); ?> <?php echo ($value["customer"]["admobile"]); ?></p>
                                <p>联系我时，请说是在我的塑料网看到的，谢谢！</p>
                            </div>
                            <b></b>
                        </div><?php endif; ?>
                        <div class="time"><?php echo ($value["input_time"]); ?></div>
                        <?php if($value["cus_man"] != '0'): ?><div class="opt">
                                <a href="javascript:doTalk(<?php echo ($value["id"]); ?>);">委托洽谈</a>
                            </div><?php endif; ?>
                    </li>
                <?php else: ?>
                    <!-- 自营 -->
                    <li class="result-con">
                        <div class="brand"><?php echo (witchType($value["product_type"])); ?></div>
                        <div class="grade"><?php echo ($value["model"]); ?></div>
                        <div class="level"><?php echo (setOption("process_level",$value["process_type"])); ?></div>
                        <div class="xian-qi {if $value.cargo_type==1}xian{else}qi{/if}"><span></span></div>
                        <div class="factory"><?php echo ($value["f_name"]); ?></div>
                        <div class="amount"><?php echo (floatval($value["number"])); ?></div>
                        <div class="price"><i>￥</i><span><?php echo (floatval($value["unit_price"])); ?></span><?php if($value["bargain"] == 1): ?><b class="price1">议价</b><?php else: ?><b class="price2">实价</b><?php endif; ?></div>
                        <!-- <div class="change tie"><b></b><span>100</span></div> -->
                        <div class="address"><?php echo ($value["area"]); ?></div>
                        <div class="place"><?php echo ($value["store_house"]); ?></div>
                        <div class="company">
                            <span><?php echo ($value["customer"]["c_name"]); ?></span>
                            <div class="company-detail">
                                <h5><?php echo ($value["customer"]["c_name"]); ?></h5>
                                <p><?php echo ($value["customer"]["name"]); ?> <?php echo ($value["customer"]["mobile"]); ?></p>
                                <p>联系我时，请说是在我的塑料网看到的，谢谢！</p>
                            </div>
                            <b></b>
                        </div>
                        <div class="time"><?php echo ($value["input_time"]); ?></div>
                        <div class="opt"><a onClick="select_cart(<?php echo ($value["id"]); ?>,<?php echo ($value["number"]); ?>);" href="javascript:;">选购</a></div>
                    </li><?php endif; endforeach; endif; ?>
        </ul>
        <div class="page">
            <?php echo ($pages); ?>
        </div>
        <!--result end-->
    </div>
    <!--left end-->
    <!--right begin-->
    <div class="right">
        <h3>商城自营已选购产品列表</h3>
        <ul class="cart" id="cart">
            <?php if(is_array($cartList)): foreach($cartList as $key=>$value): ?><li>
                    <p><span><?php echo ($value["options"]["product_type"]); ?></span><span><?php echo ($value["options"]["model"]); ?></span><span><?php echo ($value["options"]["f_name"]); ?></span></p>
                    <p><span><?php echo ($value["options"]["unit_price"]); ?></span><span><?php echo ($value["options"]["city"]); ?></span></p>
                    <div class="pin"></div>
                    <div class="close" onClick="delCart('<?php echo ($key); ?>',this)">删除</div>
                </li><?php endforeach; endif; ?>

        </ul>
        <a href="javascript:doCart();" class="order">下单</a>
        <div class="tips">
            <h4>友情提示：</h4>
            大宗商品价格及库存即时变化，
            为了确保您的选购，请尽快下
            单！
        </div>
    </div>
    <!--right end-->
</div>


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
        window.location.href="/talk/index?id="+id;
    }

    function doCart()
    {
        var size=$("#cart li").size();
        if(!size){
            layer.msg('请先选购商品');
            return;
        }
        // var user=$("#user_name").html();
        // if(!user){
        //     loginbox('offers');
        //     return;
        // }
        window.location.href="/cart";
    }


    $(function(){

        //点击地区和品种列表提交表单
        $("#screen").find(".m").on("click",function()
        {
          $("#"+$(this).data("key")).val($(this).data("val"));
          $("#searchForm").submit();
        });


        // 单选
        $("input[name='cargo_type']").click(function(){
            if(!$(this).is(':checked')){
                $(this).attr('checked',false);
            }else{
                $("input[name='cargo_type']").attr('checked',false);
                $(this).attr('checked',true);
            }
        });

        $("input[name='union']").click(function(){
            if(!$(this).is(':checked')){
                $(this).attr('checked',false);
            }else{
                $("input[name='union']").attr('checked',false);
                $(this).attr('checked',true);
            }
        });



        //展开收起地区
        // var area = $(".area"),
        //     area1 = area.find(".area1"),
        //     area2 = area.find(".area2");
        // area.find(".filter-more").bind("click",function(){
        //     if(area1.hasClass("hide")){
        //         $(this).html("展开");
        //         area1.removeClass("hide");
        //         area2.addClass("hide");
        //     }
        //     else{
        //         $(this).html("收起");
        //         area1.addClass("hide");
        //         area2.removeClass("hide");
        //     }
        // });
        
        //展开收起厂家
        var factory = $('.factory');
        var filter_sel = factory.find('.filter-sel');
        factory.find('.filter-more').on('click',function(){
            if(filter_sel.hasClass('limit-height')){
                $(this).html('收起来');
                filter_sel.removeClass('limit-height');
            }else{
                $(this).html('展开呗');
                filter_sel.addClass('limit-height');
            }
        });
        // var factory = $(".factory"),
        //     filterSel = factory.find(".filter-sel");
        // factory.find(".filter-more").bind("click",function(){
        //     if(filterSel.hasClass("limit-height")){
        //         $(this).html("收起");
        //         filterSel.removeClass("limit-height");
        //     }
        //     else{
        //         $(this).html("展开");
        //         filterSel.addClass("limit-height");
        //     }
        // });
        
        //删除已选购的产品
        // var closeProduct = $(".cart li .close");
        // closeProduct.bind("click",function(){
        //  $(this).parent().remove();
        // });
        
    });
    // 选购
    function select_cart(id,number){

        $.post('/Home/Offers/addCart',{id:id,number:number},function(data){
            console.log(data.err);
            if(data.err==0){
                var html='<li><p><span>'+data.msg.product_type+'</span><span>'+data.msg.model+'</span><span>'+data.msg.f_name+'</span></p><p><span>'+data.msg.unit_price+'</span><span>'+data.msg.city+'</span></p><div class="pin"></div><div class="close" onClick="delCart(\''+data.msg.sid+'\',this)"></div></li>';
                $("#cart").append(html);
            }else{
                layer.msg(data.msg,1,3);
                return;
            }
        },'json');
    }
    

    // function delCart(id,that){
    //     $.post('/offers/index/delCart',{id:id},function(data){
    //         if(data.err==0){
    //             $(that).parent().remove();
    //         }
    //     },'json');
    // }
    function delCart(sid,that){
        $.post('/Home/Offers/delCart',{sid:sid},function(res){
            if(res.err == 0){
                layer.msg(res.msg,1,1);
                $(that).parent().remove();
            }else{
                layer.msg(res.msg,1,3);
            }
        },'json');
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