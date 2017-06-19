/*
=========================================================
    validtip表单验证方法（Validform修正版,Andy@20121120）
=========================================================
//需要验证的表单.form
$(".form").validtip({
	btnSubmit:".submit", //.submit表单下要绑定点击提交表单事件的按钮;form内含有submit按钮该参数可省略;
	btnReset:".reset",//(可选).reset是该表单下要绑定点击重置表单事件的按钮;
	showAllErr:false,//(可选)false时一碰到验证不通过的就停止,显示该元素的错误信息;
	postonce:true, //(可选)开启网速慢时的二次提交防御,true开启，不填则默认关闭;
	ajaxPost:true, //(可选)true使用ajax方式提交表单数据，表单action地址为提交地址;
	rule:{//传入自定义tiprule类型，可以是正则，也可以是函数;
		"z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/,
		"phone":function(value,obj,form,rules){	//value:表单值，obj表单元素，form表单，rules内置正则
			var reg1=rules["mobile"], reg2=/[\d]{7}/, mobile=form.find("[name=mobile]");				
			if(reg1.test(mobile.val())) return true; 
			if(reg2.test(value))return true; 
			return false;
		}
	},
	tiptype:function(error,obj,func){ //自定义错误显示类型
		//error：{type:类型(chking|pass|fail),msg:内容};
		//obj：当前验证的表单元素（或表单）
		//func：显示错误的回调方法
		if(!obj.is("form")){
			var objtip=obj.attr("tipfor") ? $("#"+obj.attr("tipfor")) : obj.parent().find(".vtip_area");
			func(objtip);
		}else{
			var objtip=$("#msgdemo");
			func(objtip);
		}
	},
	usePlugin:{
		datepicker:{},
		passwordstrength:{},
	},
	beforeCheck:function(form){	//在表单提交执行验证之前执行的函数，form参数是当前表单对象。
		//return false 则将不继续执行验证操作;	
	},
	beforeSubmit:function(form){ //在验证成功后，表单提交前执行的函数，form参数是当前表单对象。
		//return false 则表单不会提交;	
	},
	callback:function(data){  //返回数据data是json格式，{"msg":"demo","err":"1"} msg:输出提示信息; err:返回提交数据的状态,是否提交成功(0成功，>0失败)；
		//非ajax方式提交表单时，data传入的是表单对象，回调函数会在表单验证全部通过后执行
	}
});
	
//validtip表单属性：
demo: 
	<input type="text" name="email" tiprule="email" tipdef="请输入常用邮箱" tipcss="vtip_grey" tipmsg="请输入常用邮箱，通过验证后可用于登录和找回密码" tipnull="请填写邮箱"  tiperr="邮箱格式不正确" tipajax="__C__/chkemail" ><span class="vtip_area"></span>
属性说明：
  -tiprule：验证规则，可是内置正则规则，或自定义规则和函数
  -tipdef：表单默认显示文字，聚焦时自动清空
  -tipmsg：聚焦时显示的提醒文字
  -tipnull：未填写时提醒文字
  -tiperr：未通过验证时的提醒文字
  -tipajax：需要ajax验证时的url地址
  -tipfor：指定显示提醒文字的位置；默认为表单同子类/级的vtip_area
*/

(function($) {
	//类似：定义变量
	$.rules={
		"match":/^(.+?)(\d+)-(\d+)$/,
		"*":/[\w\W]+/,
		"*6-18":/^[\w\W]{6,18}$/,
		"*2-30":/^[\w\W]{2,30}$/,
		"*4":/^[\w\W]{4}$/,
		"n":/^\d+$/,
		"f":function(v){return parseFloat(v);},
		"amount":/^[0-9]{4,6}(\.*?)\d{0,2}$/,
		"n6-16":/^\d{6,16}$/,
		"s":/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]+$/,
		"s4-18":/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{4,18}$/,
		"p":/^[0-9]{6}$/,
		"digit":/^[0-9]{1,20}$/,
		"decimal":/^(\d+\.\d{1,3}|\d+)$/, //只能为数字，且小数点后最多2位
		"mobile":/^(1[34578]\d{9})$/, //(1\d{10}),
		//"phone":/^\d{3}-\d{8}|\d{4}-\{7,8}$/,
		"phone":/^0\d{2,3}-?\d{7,8}$/,
		"mobile_phone":/^(1[34578]\d{9})|\d{3}-\d{8}|\d{4}-\{7,8}$/,
		"email":/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
		"url":/^(\w+:\/\/)?\w+(\.\w+)+.*$/,
		"date":/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/,
		"bank":/^[\u0391-\uFFE5A-Za-z]+$/,
		"passwd":function(val,obj,form,rules,error){//检查密码是否符合规定，排除弱密码
			if(/[\w\W]{8,20}/.test(val)){
				if(!/^password|qwerasdf|iloveyou|(.)\1{7,19}/.test(val)){
					for(var i=1;i<val.length;i++){
						if(Math.abs(val.charCodeAt(i-1)-val.charCodeAt(i)) != 1){
							return true;
						}
					}
				}
				error.msg = "为保障您的账户安全，禁止使用弱密码";
			}
			return false;
		},
		"ipv4":/^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
		"chname" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,6}$/,
		"idcard":function(value,obj,form,rules){	//value:表单值，obj表单元素，form表单，rules内置正则
				var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子  
				var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值.10代表X
				if(isTrueValidateIdCard(value)){
					return true; 
				}else{
					return false;
				}
				function isTrueValidateIdCard(a_numb) {  
					if(a_numb.length<18) return false;
					var a_numb = a_numb.split("");
					var sum = 0; // 声明加权求和变量  
					if (a_numb[17].toLowerCase() == 'x') {  
						a_numb[17] = 10;// 将最后位为x的验证码替换为10方便后续操作  
					}  
					for(var i = 0; i < 17; i++) {  
						sum += Wi[i] * a_numb[i];// 加权求和  
					}  
					valCodePosition = sum % 11;// 得到验证码所位置  
					if (a_numb[17] == ValideCode[valCodePosition]) {  
						return true;  
					} else {  
						return false;  
					}  
				}   
			}
	};
	
	//类似：定义变量
	var error={type:'',msg:''}; //需要显示的错误

	//类似：主类
	var valid=function(form,settings){
		var $form=$(form);
		var rules=$.extend($.rules,settings.rule); //追加规则
		var cache = [];	 //缓存数据

		//对象初始化
		init();
		
		$form.find("[tiprule]").live("mouseover",function(){
			$(this).addClass('tinput_hover');							
		}).live("mouseout",function(){
			$(this).removeClass('tinput_hover');							
		}).live("focusin",function(){
			var $input=$(this).addClass('tinput_focus').removeClass('tinput_error'), tipfor=$input.attr("tipfor"),
				$area=tipfor ?	$("#"+tipfor) : $input.parent().find(".vtip_area");
				$area.removeClass('vtip_fail vtip_pass vtip_load');
				if($input.attr("tipmsg")) $area.text($input.attr("tipmsg"));
		}).live("blur",function(){
			var $input=$(this).removeClass('tinput_focus'),pass=chkValue($input);
			if(!pass){
				$input.addClass("tinput_error");
				show($input);
			}else{
				var value=getValue($input);
				if($input.attr("tipajax") && value!=''){
					if($input[0].status==="posting") return false; 
					
					//显示正在加载查询
					error={type:'chking',msg:settings.onajax};
					show($input);
					
					//检查数据缓存
					var name=$input.attr("name");
					cached = checkCache(name+'_'+value);
					if(cached){
						handleCache($input,cached);
					}else{
						$input[0].status="posting";
						$.ajax({
							type:'POST',
							url:$input.attr("tipajax"),
							data:"value="+value+"&name="+name,
							dataType: "json",
							success:function(data){
								$input[0].status="pass";
								addToCache(name+'_'+value, data);
								handleCache($input,data);
							},
							error: function(){
								$input[0].status="fail";
								$input.addClass("tinput_error");
								error={type:'fail',msg:settings.onerr};
								show($input);
							}
						});
					}
				}else{
					$input.removeClass("tinput_error");
					if(error.type!="ignore"){
						error={type:'pass',msg:settings.onright};
					}
					show($input);
				}				
			}
		});
		
		//初始化
		function init(){
			$form[0].status="normal"; //防止表单多次提交（normal,posting）
			
			//tipdef默认提示信息，点击清空
			$form.find("[tipdef]").each(function(){
				var tipdef=$(this).attr("tipdef"),tipcss=$(this).attr("tipcss");
				if(tipcss===undefined) tipcss='';
				$(this).val(tipdef);
				if(tipcss) $(this).addClass(tipcss);
				$(this).focus(function(){
					if($(this).val()==tipdef){
						$(this).val('');
						if(tipcss) $(this).removeClass(tipcss);
					}					
				}).blur(function(){
					if($(this).val()==''){
						$(this).val(tipdef);
						if(tipcss) $(this).addClass(tipcss);
					}					
				});
			});
			
			//检查元素(密码)是否相同
			$form.find("input[recheck]").each(function(){
				var _input=$(this),_reinput=$form.find("input[name='"+$(this).attr("recheck")+"']");
				_reinput.bind("keyup",function(){
					if(_reinput.val()!= "" && _reinput.val()==_input.val()){
						if(_reinput.attr("tipdef")){
							if(_reinput.attr("tipdef") == _reinput.val()) return false;
						}
						_input.trigger("blur");
					}
				}).bind("blur",function(){
					if(_reinput.val()!=_input.val() && _input.val()!=""){
						if(_input.attr("tipdef")){
							if(_input.attr("tipdef") == _input.val()) return false;
						}
						_input.trigger("blur");
					}
				});
			});
			
			//checkbox和radio追加blur事件
			$form.find(":checkbox[tiprule],:radio[tiprule]").each(function(){
				var _input=$(this),name=_input.attr("name");
				$form.find("[name='"+name+"']").filter(":checkbox,:radio").bind("click",function(){
					//避免多个事件绑定时的取值滞后问题;
					setTimeout(function(){
						_input.trigger("blur");
					},0);
				});
			});
			
			//扩展plugins
			if(settings.plugin){
				plugin();
			}

			//绑定提交按钮
			settings.btnSubmit && $form.find(settings.btnSubmit).bind("click",function(){
				$form.submit();
				return false;
			});
			
			$form.submit(function(){
				var flag=submitInit();
				flag === undefined && (flag=true);
				return flag;
			});

			//重置表单
			$form.find("[type='reset']").add($form.find(settings.btnReset)).bind("click",function(){
				resetInit();
				return false;
			});
		}
		
		//扩展插件
		function plugin(){
			if(settings.plugin.passwordstrength){
				settings.plugin.passwordstrength.show=function($input,msg,type){
					error={type:type,msg:msg};
					show($input);
				};
				$form.find("input[plugin*='passwordStrength']").passwordStrength(settings.plugin.passwordstrength);
			}
		}
		
		//提交表单
		function submitInit(){
			//表单正在提交时点击提交按钮不做反应
			if($form[0].status==="posting") return false;
			
			//在表单提交验证之前：执行的验证
			var beforeCheck=settings.beforeCheck && settings.beforeCheck($form);
			if(beforeCheck===false) return false;
			
			$form.find(".vtip_area").removeClass("vtip_fail");
			//验证字段:是否显示所有表单错误
			if(settings.showAllErr){
				$form.find("[tiprule]").trigger('blur');
				if($form.find(".tinput_error").length>0){
					$form.find(".tinput_error:first").focus();
					return false;	
				}				
			}else{
				var errnum=0;
				$form.find("[tiprule]").each(function(){
					$(this).trigger('blur');
					//验证含有错误
					if($(this).hasClass('tinput_error')){
						errnum++;
						$(this).focus();
						return false;
					}
				});
				if(errnum>0) return false;
			}
			
			//表单提交之前：执行函数
			var beforeSubmit=settings.beforeSubmit && settings.beforeSubmit($form);
			if(beforeSubmit===false) return false;
			$form[0].status="posting";
			
			if(settings.ajaxPost){
				error={type:'chking',msg:settings.onpost};
				show($form);
				
				$.ajax({
					type: "POST",
					dataType:"json",
					url: $form.attr("action"),
					data: $form.serializeArray(),
					success: function(data){
						$form[0].status="normal";
						error={type:data.err?'fail':'pass',msg:data.msg};
						show($form);
						settings.callback && settings.callback(data);						
					},
					error: function(data){
						$form[0].status="normal";
						var msg=data.statusText==="parsererror" ? settings.onerr : settings.onnone;
						error={type:'fail',msg:msg};
						show($form);
					}
				});
			}else{
				if(!settings.postonce){
					$form[0].status="normal";
				}
				return settings.callback && settings.callback($form);
			}
			return false;
		}
		
		//重置表单
		function resetInit(){
			form.reset();
			$form[0].status="normal";
			$form.find(".vtip_area").text("");
			//$form.find(".passwordStrength").children().removeClass("bgStrength");
			$form.find(".vtip_area").removeClass("vtip_fail vtip_pass vtip_load");
			$form.find(".tinput_error").removeClass("tinput_error");
			$form.eq(0).find("input:first").focus();
		}
		
		//获得当前对象的值
		function getValue(obj){
			var name=obj.attr('name'),value='';
			if(obj.is(":radio")){
				value=$form.find(":radio[name='"+name+"']:checked").val();
			}else if(obj.is(":checkbox")){
				value=$form.find(":checkbox[name='"+name+"']:checked").length||"";
			}else{
				value=obj.val();
			}
			value= value===undefined ? "" : value;
			return $.trim(value);
		}
		
		//验证当前表单内容是否合法
		function chkValue(obj){
			var value=getValue(obj);
			
			//忽略验证：为空
			if(obj.attr("ignore")==="ignore" && (value==='' || value===$.trim(obj.attr('tipdef')))){
				error={type:'ignore',msg:''};
				return true;
			}
			
			//待验证规则：追加
			var rule=obj.attr("tiprule"); 
			if(!(rule in rules)){
				var mac=rule.match(rules["match"]);
				if(!mac) return false;
				for(var name in rules){
					var temp=name.match(rules["match"]);
					if(!temp) continue;
					if(mac[1]===temp[1]){
						var str=rules[name].toString(), 
							param=str.match(/\/[mgi]*/g)[1].replace("\/",""),
							regxp=new RegExp("\\{"+temp[2]+","+temp[3]+"\\}","g");
						str=str.replace(/\/[mgi]*/g,"\/").replace(regxp,"{"+mac[2]+","+mac[3]+"}").replace(/^\//,"").replace(/\/$/,"");
						rules[rule]=new RegExp(str,param);
						break;
					}	
				}
			}
			
			//验证类型(对象转成字符串)
			var chkType=Object.prototype.toString.call(rules[rule]);
			error={type:'fail',msg:obj.attr("tiperr") || settings.onwrong};
			if(chkType=="[object RegExp]" || chkType=="[object Function]"){
				if(chkType=="[object RegExp]"){ //-正则表达式
					passed=rules[rule].test(value);
				}else if(chkType=="[object Function]"){ //-正则表达式
					passed=rules[rule](value,obj,$form,rules,error);
				}
				if(passed){
					if(obj.attr("recheck")){ //密码验证时：相同的密码
						var recheck=$form.find("input[name='"+obj.attr("recheck")+"']:first");
						if(value!=recheck.val()){
							return false;
						}
					}
					return true;
				}else{
					return false;
				}
			}
			return false;
		}
		
		//显示结果
		function show(obj){
			if(typeof settings.tiptype == "function"){
				settings.tiptype(error,obj,display);
				return false;
			}
			var tipfor=obj.attr("tipfor"),
				area=tipfor ? $("#"+tipfor) : obj.parent().find(".vtip_area");
			display(area);
		}
		
		//控制显示结果样式
		function display(obj){
			obj.html(error.msg);
			switch(error.type){
				case 'chking':
					obj.removeClass("vtip_pass vtip_fail").addClass("vtip_load");
					break;
				case 'pass':
					obj.removeClass("vtip_fail vtip_load").addClass("vtip_pass");
					break;
				case 'ignore':
					obj.removeClass("vtip_pass vtip_fail vtip_load").html('');
					break;
				default: //fail
					obj.removeClass("vtip_pass vtip_load").addClass("vtip_fail");
			}
		}
		
		//检查缓存是否存在
		function checkCache(name) {
			for (var i = 0; i < cache.length; i++)
				if (cache[i]['name'] == name) {
					return cache[i]['content'];
				}
			return false;
		}
		//加入缓存
		function addToCache(name, content) {
			cache.push({
				name: name,
				content: content
			});
		}
		//处理缓存
		function handleCache($input,data){
			if($.trim(data.err)=="0"){
				$input[0].status="pass";
				$input.removeClass("tinput_error");
				error={type:'pass',msg:settings.onright};
			}else{
				$input[0].status="fail";
				$input.addClass("tinput_error");
				error={type:'fail',msg:data.msg};
			}
			show($input);
		}
	}
	
	//类似：构造函数
	$.fn.validtip=function(options){
        var settings = {
            onfocus: "请输入内容",
            onright: "",
            onwrong: "请输入正确信息",
            onempty: "输入内容为空",
            onajax: "正在检测信息…",
            onpost: "正在提交数据…",
            onerr: "请检查提交地址或返回数据格式是否正确…",
            onnone: "数据提交出错",
			showAllErr:false,//提交表单时是否显示所有错误：false一旦错误则停止检测
            tiptype: "",
			btnReset:'',
			//plugin:{}, //插件
			postonce:false, //二次提交防御
			ajaxPost:false
        };
        options = options || {};
        $.extend(settings, options);
		this.each(function() {
			new valid(this, settings);
		});
		return this;
	};
})(jQuery);


(function($){
	$.fn.passwordStrength=function(settings){
		settings=$.extend({},$.fn.passwordStrength.defaults,settings);
		this.each(function(){
			var $this=$(this),	scores = 0, checkingerror=false, 
				pstrength=$this.parents("form").find(".passwordStrength");
				
			$this.bind("keyup",function(){
				scores = rate($this.val());
				scores>=0 && checkingerror==false && (checkingerror=true);
				/*
				if(checkingerror && ($this.val().length<settings.minLen || $this.val().length>settings.maxLen) ){
					settings.show($this,$this.attr("errormsg"),3);
				}else if(checkingerror){
					//settings.show($this,"",2);
				}*/
				settings.trigger($this,!(scores>=0),scores);
			}).focus(function(){
				pstrength.hide();
			});
			
			//判断密码强度
			function rate(passwd){
				var len = passwd.length, scores;
				if(len >= settings.minLen && len <= settings.maxLen){
					scores = checkStrong(passwd);
				}else{
					scores = -1;
				}
				return scores/4*100;
			}
			
			//密码强度
			function checkStrong(content){
				var modes = 0, len = content.length;
				for(var i = 0;i < len; i++){
					modes |= charMode(content.charCodeAt(i));
				}
				return bitTotal(modes);	
			}
			
			//字符类型
			function charMode(content){
				if(content >= 48 && content <= 57){ // 0-9
					return 1;
				}else if(content >= 65 && content <= 90){ // A-Z
					return 2;
				}else if(content >= 97 && content <= 122){ // a-z
					return 4;
				}else{ // 其它
					return 8;
				}
			}
			
			//计算出当前密码当中一共有多少种模式;
			function bitTotal(num){
				var modes = 0;
				for(var i = 0;i < 4;i++){
					if(num & 1){modes++;}
					num >>>= 1;
				}
				return modes;
			}
		});	
	}
	
	$.fn.passwordStrength.defaults={
		minLen:0,
		maxLen:30,
		trigger:$.noop
	}
})(jQuery);