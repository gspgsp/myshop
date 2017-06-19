<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>积分商城-我的塑料网</title>
<link rel="stylesheet" type="text/css" href="http://www.myShop.static.com/home/css/common.css"/>
<link rel="stylesheet" type="text/css" href="http://www.myShop.static.com/home/css/pointshop.css"/>
<style type="text/css">
    
</style>
</head>

<body>
<!--top begin-->
<div class="top">
	<div class="w1200">
    	<!--left begin-->
        <ul class="left flt">
        	<li class="back">返回 <a href="http://www.myplas.com/" target="_blank">我的塑料网首页</a></li>
        	<li>您好，欢迎光临我的塑料网！</li>
            <li><a href="javascript:Addme();">收藏本站</a>｜</li>
            <li><a target="_blank" href="<?php echo ($sys["weibo"]["link"]); ?>">官方微博</a></li>
        </ul>
        <!--left end-->
        <!--right begin-->
        <ul class="right frt">
        {if $smarty.session.userid > 0 }
            <a href="http://www.myplas.com/user" class="mycount"><?php echo ($smarty["session"]["uinfo"]["name"]); ?>个人中心</a>
            <a href="http://www.myplas.com/user/logout" class="loginout">退出登录</a>
        {else}
        	<li class="login"><a href="/user/login">登录</a></li>
            <li class="register"><a href="/user/register">注册</a></li>
        {/if}
            <li class="last" style=" width:240px;">
            	<a href="http://www.myplas.com/page">常见问题</a> -
                <a href="http://www.myplas.com/page?id=16">联系我们</a> -
                <a href="http://www.myplas.com/page?id=17">意见反馈</a> 
                <!-- <a href="/english">ENGLISH</a> -->
            </li>
        </ul>
        <!--right end-->
    </div>
</div>
<!--top end-->
<!--header begin-->
<div class="header">
	<div class="w1200">
    	<div class="logo flt"><a href="/pointshop"><img src="http://www.myShop.static.com/home/img/home/pointshop/logo.png" width="181" height="53"/></a></div>
        <div class="tel frt"><img src="http://www.myShop.static.com/home/img/home/pointshop/tel.jpg" width="188" height="47"/></div>
    </div>
</div>
<!--header end-->

<!--jifen begin-->
<div class="jifen w1200">
	<!--left begin-->
    <div class="left flt">
    	<div class="title">
            <?php if($_SESSION['userid']> 0): ?><span>您好，<?php echo ($_SESSION['uinfo']['con_name']); ?></span>
            <a href="/user/logout">退出</a>
            <?php else: ?>
                <span>请登录</span><?php endif; ?>
        </div>
        <h3>我的积分</h3>
        <?php if($_SESSION['userid']> 0): ?><p id="points"><?php echo ($_SESSION['uinfo']['points']); ?></p>
        <div class="record"><a href="user/myPoints/creditDetail">积分兑换记录</a></div>
        <!--<div class="record"><a href="user/myPoints/getCheckInfo?opVal=2">积分兑换记录</a></div>-->
        <?php else: ?>
        <div class="no-login"><a href="javascript:loginbox('pointshop')">登录</a>后显示积分</div><?php endif; ?>
        <div class="ad"><img src="http://www.myShop.static.com/home/img/home/pointshop/ad.jpg" width="135" height="25"/></div>
    </div>
    <!--left end-->
    <!--banner begin-->
    <div class="banner flt">
        <div class="wrapper">
            <div id="focus">
                <ul>
                    <li>
                        <div style="left:0; top:0; width:698px; height:270px;"><img src="http://www.myShop.static.com/home/img/home/pointshop/banner.jpg" width="698" height="270"/></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--banner end-->
    <!--right begin-->
    <div class="right frt">
    	<!--title begin-->
        <div class="title">
        	<h3>每日签到领积分，不领白不领</h3>
            <ul>
                <?php if(is_array($signDay)): $key = 0; $__LIST__ = $signDay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key % 2 );++$key;?><!-- <?php if(is_array($signDay)): foreach($signDay as $key=>$value): ?>-->
                    <li class="<?php if($value == 1): ?>already<?php endif; ?> <?php if($key == $today): ?>on<?php endif; ?>">
                        <?php if($key == 1): ?>周一<?php elseif($key == 2): ?>周二<?php elseif($key == 3): ?>周三<?php elseif($key == 4): ?>周四<?php elseif($key == 5): ?>周五<?php endif; ?>
                    </li>
                <!--<?php endforeach; endif; ?> --><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <!--title end-->
        <?php if($_SESSION['userid']> 0): ?><div class="sign-on <?php if($signDay[$today] == 1): ?>off<?php else: ?>on<?php endif; ?>"></div>
        <?php else: ?>
            <div class="sign-on  no-login"></div><?php endif; ?>
        <h4>每日签到得积分，连续一周签到积分翻倍</h4>
    </div>
    <!--right end-->
</div>
<!--jifen end-->
<!--propagate begin-->
<div class="propagate">
	<dl>
    	<img src="http://www.myShop.static.com/home/img/home/pointshop/propagate1.png" width="70" height="70"/>
        <dt>小积分大用处</dt>
        <dd>我的塑料网采购货物送积分可换礼品</dd>
    </dl>
    <dl>
    	<img src="http://www.myShop.static.com/home/img/home/pointshop/propagate2.png" width="70" height="70"/>
        <dt>买货得积分</dt>
        <dd>与我的塑料网成交后自动累计积分，买的多送的多</dd>
    </dl>
    <dl>
    	<img src="http://www.myShop.static.com/home/img/home/pointshop/propagate3.png" width="70" height="70"/>
        <dt>天天领积分</dt>
        <dd>每天轻松点一下连续签到积分翻倍</dd>
    </dl>
    <dl>
    	<img src="http://www.myShop.static.com/home/img/home/pointshop/propagate4.png" width="70" height="70"/>
        <dt>积分兑换全免费</dt>
        <dd>积分商城积分兑换的商品不但免费还免运费奥</dd>
    </dl>
</div>
<!--propagate end-->
<!--classify begin-->
<div class="classify w1200">
	<!--left begin-->
	<div class="left flt">
    	<h3>全部礼品分类</h3>
        <p>CATEGORY</p>
    </div>
    <!--left end-->
    <!--right begin-->
    <div class="right frt">
    	<ul>
        	<a href="getCategory?cate_id=0"><li class="clafy-1" ><span>全部</span></li></a>
            <a href="getCategory?cate_id=1"><li class="clafy-2" ><span>家居</span></li></a>
            <a href="getCategory?cate_id=2"><li class="clafy-3" ><span>数码</span></li></a>
        </ul>
    </div>
    <!--right end-->
</div>
<!--classify end-->
<!--choice-result begin-->
<div class="choice-result">
	<ul class="left flt">
    	<li {if $order=='sort'}class="hover"{/if}><a href="getCategory?sort_f=sort&cate_id=<?php echo ($cate_id); ?>">默认</a>|</li>
        <li {if $order=='points'}class="hover"{/if}><a href="getCategory?sort_f=points&cate_id=<?php echo ($cate_id); ?>">积分从低到高</a>|</li>
    </ul>
</div>
<!--choice-result end-->
<!--result begin-->
<div class="result w1200">
	<ul>
        <?php if(is_array($list)): $key = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key % 2 );++$key;?><li>
            <a href="/pointshop/index/item?id=<?php echo ($value["id"]); ?>"><img src="/Public/Uploads/<?php echo ($value["thumb"]); ?>" width="196" height="194"/></a>
            <h4><?php echo ($value["name"]); ?></h4>
            <div class="opt">
                <p><span><?php echo ($value["points"]); ?></span>积分</p>
                <?php if($_SESSION['userid']> 0): if($_SESSION['uinfo']['points']>= $value['points']): ?><div class="btn orderin" data-gid="<?php echo ($value["id"]); ?>"><a href="javascript:;">立即兑换</a></div>
                    <?php else: ?>
                        <div class="btn disabled">积分不足</div><?php endif; ?>
                <?php else: ?>
                    <div class="btn disabled"><a href="javascript:loginbox('pointshop')">请登录</a></div><?php endif; ?>
            </div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
<!--result end-->
<!--page begin-->
<div class="page">
    <?php echo ($pages); ?>
</div>
<!--page end-->

<!--layer-success begin-->
<div class="layer layer-success">
	<h3>兑换成功</h3>
	<p>如遇问题请拨打客服热线 400-6129-965</p>
	
    <div class="btn close"><a href="javascript:;">关闭</a></div>
</div>
<!--layer-success end-->
<!--layer-form begin-->
<div class="layer layer-form">
    <form method="post" action="" id="orderForm">
        <table border="0">
          <tr>
            <td>收货人：</td>
            <td><input type="text" name="receiver" class="layer-input border-gray receiver" value=""/></td>
          </tr>
          <tr>
            <td>联系电话：</td>
            <td><input type="text" name="phone" class="layer-input border-gray mobile" value=""/></td>
          </tr>
          <tr>
            <td>收货地址：</td> 
            <td><input type="text" name="address" class="layer-input border-gray address" value=""/></td>
          </tr>
          <tr class="code">
            <td>验证码：</td>
            <td class="code-inner">
                <input type="text" name="code" class="layer-input border-gray"/>
                <input type="button" class="get-code enabled" data-boolean="true" value="获取验证码" style="background-color: red;" />
            </td>
          </tr>
          <tr class="msg">
            <td>&nbsp;</td>
            <td><span></span></td>
          </tr>
          <tr>
            <td colspan="2" align="center">
                <input type="hidden" name="gid" id="gid" value="">
                <input type="submit" value="确定" class="btn"/>
                <input type="button" value="关闭" class="btn close"/>
            </td>
          </tr>
        </table>
    </form>
</div>
<!--layer-form end-->
<script type="text/javascript" src="http://www.myShop.static.com/home/js/focus.js"></script>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/layer-v1.8.5/layer.min.js"></script>
<script type="text/javascript" src="http://www.myShop.static.com/home/js/common.js"></script>
<script type="text/javascript">
$(function(){
   
	//签到
	var check = $(".title .on"),
        already = $(".title .already"),
        str = "<span></span>",
        myCount,
        msg = $(".msg span");

	already.append(str);

	$(".sign-on.on").bind("click",function(){
        var _this = $(this);
        $.post('/pointshop/index/signon', function (data){
            if(data.status == 1){
                layer.alert('签到成功, 本次签到获得'+ data.points +'积分。', -1)
                $("#points").html((parseInt($("#points").html()) + data.points));
                _this.removeClass("on").addClass("off");
                check.append(str);
            }else{
                layer.alert(data.msg, -1)
            }
        }, 'json');

	});

	//
	$(".choice-result li.only").bind("click勾选只看我可以选的",function(){
		$(this).find("b").toggleClass("select");
	});


    //登录弹窗
    $(".orderin").bind("click",function(){
        var gid = $(this).data('gid');
        $.post('/Home/PointsShop/checklogin',function(res){
            if(res.err == 1){
                layer.msg(res.msg,1,3,function(){
                    $.layer({
                          type: 2,
                          border: [0],
                          title: false,
                          fix:true,
                          // iframe: {src : "/user/login/loginbox?type="+type},
                          iframe: {src : "/Home/Offers/index"},//登录模块
                          area: ['360px', '340px']
                    });
                });
            }else{
                $.layer({
                    area: ['418px', '308px'],
                    border:[0],
                    type: 1,
                    title:false,
                    page: {dom:'.layer-form'},
                    close:function(){
                        //弹窗关闭，则获取验证码倒数失效,获取验证码按钮恢复
                        clearCount();
                        msg.html("");
                    },
                    success:function(){
                        $('#gid').val(gid);//hidden表单的
                        $(".layer-form .close").bind("click",function(){
                            layer.closeAll();
                            clearCount();
                            msg.html("");
                        });
                    },
                    end:function(){
                        document.getElementById('orderForm').reset();
                    }
                });
            }
        },'json');

    });

	//弹窗中的表单
    var input = $(".layer-form .layer-input"),
        btnSubmit = $(".layer-form form"),
        receiver = $(".receiver"),
        mobile = $(".mobile"),
        address = $(".address"),
        code = $(".code .layer-input"),
        errorStr = "";
    var preg = /^1[0-9]{10}$/;

    input.bind("focus",function(){
        $(this).addClass("border-orge").removeClass("border-gray");
    });
    input.bind("blur",function(){
        $(this).addClass("border-gray").removeClass("border-orge");
    });



    btnSubmit.on("submit",function(){
        //验证收货人
        if(valid(receiver)){
            msg.html("");
        }
        else{
            receiver.focus();
            msg.html("请您输入收货人");
            return false;
        }

        //验证联系电话

        if( valid(mobile) && preg.test(mobile.val()) ){
            msg.html("");
        }
        else{
            mobile.focus();
            msg.html("请您输入联系电话");
            return false;
        }

        //验证收货地址
        if(valid(address)){
            msg.html("");
        }
        else{
            address.focus();
            msg.html("请您输入收货地址");
            return false;
        }
        //验证验证码
        if(valid(code)){
            msg.html("");
        }
        else{
            code.focus();
            msg.html("请您输入验证码");
            return false;
        }

        $.ajax({
             type : "POST",
             url : '/Home/PointsShop/addMyOrder',
             data: btnSubmit.serialize(),
             dataType: 'json',
             success: function(data) {
                if(data.err == 0){
                    // laye.msg(data.msg,1,1);
                    layer.closeAll();
                    var successLayer = 
                    $.layer({
                        area: ['418px', '308px'],
                        type: 1,
                        title:false,
                        page: {dom:'.layer-success'},
                        success:function(){
                            $(".layer-success .close").bind("click",function(){
                                layer.close(successLayer);
                                window.location.reload();
                            });
                        }
                    });
                }else{
                    layer.msg(data.msg,1,3);
                }
             }
         });

        return false;

    });

    //获取验证码
    $(".get-code").bind("click",function(){
        var phone = mobile.val();
        //已经输入了联系电话
        if(valid(mobile) && preg.test(mobile.val()) ){
            //需要修改发送短信接口
           // /api/sms/init type:4
            //'/pointshop/index/sendmsg'  本地短信
            $.post('/Home/PointsShop/sendmsg', {phone:phone }, function (data){
                if(data.err == 0){
                    layer.msg(data.msg,1,1);
                    return;
                }else{
                    layer.msg(data.msg,1,3);
                    return;
                }
            },'json')
            msg.html("");
            time($(this),180);
        }
        //没有输入联系电话
        else{
            mobile.focus();
            msg.html("请您输入联系电话");
            return false;
        }
    });

    function valid(elem){
        var result = "";
        result = (elem.val()=="")?false:true;
        return result;
    }

    function time(btn,wait) {
          if (wait == 0) {
              btn.removeClass("disabled").addClass("enabled").removeAttr("disabled").val("获取验证码");
              wait = 180;
          } else {
              btn.removeClass("enabled").addClass("disabled").attr("disabled","true").val(wait + "秒后再次获取");
              wait--;
              myCount = setTimeout(function () {
                  time(btn,wait);
              },
              1000);
           }
    }
      
    function clearCount(){
        clearTimeout(myCount);
        $(".get-code").removeClass("disabled").addClass("enabled").removeAttr("disabled").val("获取验证码")
    }
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
                    <p><img src="http://www.myShop.static.com/home/img/home/ewmWx.jpg" width="84" height="84"/></p>
                    <span>官方微信</span>
                </li>
                <li>
                    <p><img src="http://www.myShop.static.com/home/img/home/ewmApp.jpg" width="81" height="81"/></p>
                    <span>APP</span>
                </li>
            </ul>
        </div>
    </div>
    <p style="text-align:center;" class="copyright color3"><?php echo ($sys["icp_number"]); ?></p>
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

    <!--<ul>
        <li>
            <img src="http://www.myShop.static.com/home/img/home/cert1.jpg"/>
        </li>
        <li>
            <a href="http://www.shjbzx.cn/" target="_blank">
                <img src="http://www.myShop.static.com/home/img/home/cert2.jpg"/>
            </a>
        </li>
        <li>
            <a id='___szfw_logo___' href='https://credit.szfw.org/CX20160519015265020195.html' target='_blank'>
                <img src="http://www.myShop.static.com/home/img/home/cert.png" border='0' />
            </a>
        </li>
        <li class="last">
            <a href="http://webscan.360.cn/index/checkwebsite/url/www.myplas.com" target="_blank">
                <img border="0" src="http://img.webscan.360.cn/status/pai/hash/11d280d842ae0cda461140c3b62a13a6"/>
            </a>
        </li>
    <!--</ul>-->
</div>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?4808bff4f0276952e006e0f3ec054483";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>

</html>