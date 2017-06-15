$(function(){
	//验证登录页面表单
	$("#login-form").validate({
		//失去光标的时候也进行验证
		onfocusout:function(element){ 
			$(element).valid(); 
		},     
		rules:{
			//手机号不能为空，并且格式需正确
		    mobilenumber:{
				required:true,
				isMobile:true
				/*remote: {
					url: "check-email.php",     //后台处理程序
					type: "post",               //数据发送方式
					dataType: "json",           //接受数据格式   
					data: {                     //要传递的数据
						username: function() {
							return $("#username").val();
						}
					}
				}*/
			},
			setpwd:{
				required:true,
				minlength:6
			}
		},
		messages:{
	    	mobilenumber:{
				required:"手机号不能为空 "
			},
			setpwd:{
				required:" 请您设置密码",
				minlength:"密码至少6位"
			}	
	    },
		errorPlacement: function(error, element) {                 //提示信息显示的位置
            error.appendTo(element.closest(".login").find(".error-msg .inner"));  
        },
		success:function(label){
		},
		submitHandler:function(form){
		}
	});	
	
	//验证注册页面表单
	$("#reg-form").validate({
		//失去光标的时候也进行验证
		onfocusout:function(element){ 
			$(element).valid(); 
		},     
		rules:{
			//手机号不能为空，并且格式需正确
		    mobilenumber:{
				required:true,
				isMobile:true
				/*remote: {
					url: "check-email.php",     //后台处理程序
					type: "post",               //数据发送方式
					dataType: "json",           //接受数据格式   
					data: {                     //要传递的数据
						username: function() {
							return $("#username").val();
						}
					}
				}*/
			},
			setpwd:"required",
			jyCode:{
				required:true,
				digits:true,
				rangelength:[6,6]
			},
			userName:"required",
			companyName:"required",
			enterprise:"required",
			protocol:"required"
		},
		messages:{
	    	mobilenumber:{
				required:"手机号不能为空"
			},
			setpwd:"请您设置密码",
			jyCode:{
				required:"校验码不能为空",
				digits:"校验码必须是数字",
				rangelength:"校验码为6位"
			},
			userName:"用户名不能为空",
			companyName:"公司名称不能为空",
			enterprise:"请选择企业类型",
			protocol:"请查看并且勾选用户服务协议"	
	    },
		errorPlacement: function(error, element) {                 //提示信息显示的位置
            error.appendTo(element.closest(".tr").find(".error-msg").addClass("icon-alert"));  
        },
		success:function(label){
			label.parent().html("&nbsp;").removeClass("icon-alert");
		},
		submitHandler:function(form){
		}
	});	
	
	//验证忘记密码页面表单
	$("#pwd-form").validate({
		//失去光标的时候也进行验证
		onfocusout:function(element){ 
			$(element).valid(); 
		},     
		rules:{
			//手机号不能为空，并且格式需正确
		    mobilenumber:{
				required:true,
				isMobile:true
				/*remote: {
					url: "check-email.php",     //后台处理程序
					type: "post",               //数据发送方式
					dataType: "json",           //接受数据格式   
					data: {                     //要传递的数据
						username: function() {
							return $("#username").val();
						}
					}
				}*/
			},
			setpwd:{
				required:true,
				minlength:6
			},
			jyCode:{
				required:true,
				digits:true,
				rangelength:[6,6]
			}
		},
		messages:{
	    	mobilenumber:{
				required:"手机号不能为空 "
			},
			setpwd:{
				required:" 请您设置密码",
				minlength:" 密码至少6位"
			},
			jyCode:{
				required:" 校验码不能为空",
				digits:"校验码必须是数字",
				rangelength:"校验码为6位"
			}	
	    },
		errorPlacement: function(error, element) {                 //提示信息显示的位置
            error.appendTo(element.closest(".find-pwd").find(".error-msg .inner"));  
        },
		success:function(label){
		},
		submitHandler:function(form){
		}
	});	
	
	//自定义验证方法,验证手机号的格式
  	$.validator.addMethod("isMobile",function(value,element){  
	   var length = value.length;   
	   var mobile = /^1[3|4|5|7|8][0-9]\d{4,8}$/;   
       return this.optional(element) || (length == 11 && mobile.test(value));       
	  
    },"手机号码格式不正确 ");
	
	//获取校验码
	$(".get-code").bind("click",function(){
		var _this = $(this);
		if(_this.attr("data-bool")=="true") time(_this,60);
		_this.attr("data-bool","false");
	});  
	
	//倒计时
	function time(btn,wait) {
	  if (wait == 0) {
		  btn.removeClass("disabled").addClass("enable").html("获取验证码");
		  btn.attr("data-bool","true");
		  wait = 60;
	  } else {
		  btn.removeClass("enable").addClass("disabled").html(wait+"S后重新获取");
		  wait--;
		  setTimeout(function () {
			  time(btn,wait);
		  },
		  1000)
	  }
	}
});