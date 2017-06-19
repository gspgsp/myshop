String.prototype.trim = function(){
	return this.replace(/(^\s*)|(\s*$)/g, "");
}
String.prototype.replaceAll  = function(s1,s2){    
	return this.replace(new RegExp(s1,"gm"),s2);    
}
jQuery.prototype.serializeObject=function(){  
	var obj=new Object();  
	$.each(this.serializeArray(),function(index,param){ 
		if(param.name in obj){  
			  
		}else{  
			obj[param.name]=param.value;  
		}  
	});  
	return obj;  
};  

utils = {
	integer:/^[-\+]?\d+$/, 
	float:/^[-\+]?\d+(\.\d+)?$/,
	qq:/^[1-9]\d{4,10}$/,
	english:/^[A-Za-z]+$/,
	chinese:/^[\u0391-\uFFE5]+$/,
	hasChinese : /^([a-zA-Z]*[\u0391-\uFFE5][a-zA-Z]*)+$/, //931-65509
	email: /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
	zip:/^[0-9]\d{5}$/, 
	url : /^http[s]?:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/,
	
	english_num: /(^[a-zA-Z0-9])+$/,
	ch_en:/^([a-zA-Z\u4E00-\u9FFF])+$/,
	password:/^[a-zA-Z\-0-9\_.^()#@!`~%>\|{}\[\]*?=+'";:,\\\/$&]{3,32}$/,
	mobile: /^(1[34578]\d{9})$/, //(1\d{10})
	tel:/^[\s]*((1\d{10})|(0\d{2,4}\-){1}[1-9]{1}\d{6,9}(\-\d{1,5})?)[\s]*$/, 
	idcard:/^(\s)*(\d{15}|\d{18}|\d{7}x)(\s)*$/i, 
	unsafe : /^(([A-Z]*|[a-z]*|\d*|[-_\~!@#\$%\^&\*\.\(\)\[\]\{\}<>\?\\\/\'\"]*)|.{0,5})$|\s/,
	time:/^(00|01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23):[0-5]?[0-9]$/,


	isInt : function (s){
		return this.integer.test(s);
	},
	isFloat : function (s){
		return this.float.test(s);
	},
	isEmail : function (s){
		return this.email.test(s);
	},
	isZip : function (s){
		return this.zip.test(s);
	},
	isNumber : function (s){
		var reg = /^[\d|\.|,]+$/;
		return reg.test(s);
	},
	isMobile : function (s){
		return this.mobile.test(s);
	},
	isDateTime : function(s) {
		var reg = /^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}$/;
		return reg.test(s);
	},
	
	//是否具有相同字符
	isRepeat : function(s){
		var temp = s.charAt(0);
		for(var i = 0; i < s.length;i++){
			if(temp != s.charAt(i)){
				return false;
			} 
		} 
		return true;
	},

	//顺序序列
	isOrder:function(s){
		for(var i = 1; i < s.length;i++){
		if(s.charCodeAt(i-1) + 1 != s.charCodeAt(i)){
				return false;
			} 
		} 
		return true;
	},

	//顺序序列
	isReverseOrder:function(s){
		for(var i = 1; i < s.length;i++){
		if(s.charCodeAt(i-1) - 1 != s.charCodeAt(i)){
				return false;
			} 
		} 
		return true;
	},

	//检查字符串是否为空
	isEmpty:function (s){
		if (s == null || s.length <= 0 || s.trim() == ""){
			return true;
		}
		return false;
	},
	
	//html
	htmlEncode : function(s) {
		return s.replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
	}

};

//去除字符串前后空格
utils.trim=function(s) {
	if(typeof(s) == "string") {
		return s.replace(/(^\s*)|(\s*$)/g, "");
	}else{
		return s;
	}
}

//取字符长度（有第二个参数：中文字符为两个字节）
utils.strlen=function(s,isChinese) {
	if(isChinese===undefined) {
		return s.length;
	}
	return (''+s).replace(/[^\x0000-\xFF00]/gi,'**').length;
}

//双字节转单字符字节
utils.D2S=function (s) {
	var result='';
	for(i=0; i < s.length; i++) {
		code = s.charCodeAt(i);
		if(code == 12290) {
			result += String.fromCharCode(46);
		}else if (code == 183) {
			result += String.fromCharCode(64);
		}else if(code >= 65281 && code<65373) {
			result += String.fromCharCode(s.charCodeAt(i)-65248);
		}else{
			result += s.charAt(i);
		}
	}
	return utils.trim(result);
}

//验证数字(支持16进制)
utils.isDigits=function(s) {
	s = s.toString();
	var validChars = "0123456789";
	var startFrom = 0;
	if (s.substring(0, 2) == "0x") {
		validChars = "0123456789abcdefABCDEF";
		startFrom = 2;
	} else if (s.charAt(0) == "0") {
		validChars = "01234567";
		startFrom = 1;
	} else if (s.charAt(0) == "-") {
		startFrom = 1;
	}
	for (var n = startFrom; n < s.length; n++) {
		if (validChars.indexOf(s.substring(n, n+1)) == -1) return false;
	}
	return true;
}

//转成x.00价格
utils.format_price=function(x) {
	var f_x = parseFloat(x);  
	if (isNaN(f_x))  return false; 	
	var f_x = Math.round(x*100)/100;  
	var s_x = f_x.toString();  
	var pos_decimal = s_x.indexOf('.');  
	if (pos_decimal < 0) {  
		pos_decimal = s_x.length;  
		s_x += '.';  
	}  
	while (s_x.length <= pos_decimal + 2) {  
		s_x += '0';  
	}  
	return s_x;  
}

//jquery加载ajax
utils.ajax=function(url,params,callback,mode,resType) {
	url += (url.indexOf("?") === - 1 ? "?" : "&") + "ajtime="+Math.random();
	mode = typeof(mode) === "string" && mode.toUpperCase() === "GET" ? "GET" : "POST";
	resType = typeof(resType) === "string" && ((resType = resType.toUpperCase()) === "JSON" || resType === "XML") ? resType : "TEXT";
	
	$.ajax({type: mode,	url: url,  data: params, dataType: resType, timeout: 9000,
		error:function(XMLHttpRequest, textStatus, errorThrown) {
			if(textStatus=="timeout") {
				data={error:'01',content:'访问超时'};
			}else{
				data={error:'02',content:XMLHttpRequest.responseText};
			}
			if(typeof(callback) === "function") {
				callback.call(this,data);
			}else{
				alert(data.content);
				return false;
			}
		},
		success: function(data) {
			if(typeof(callback) === "function") {
				callback.call(this,data);
			}
		}
	});
}

utils.cookie = {
	set:function(name,value){
		var Days = 365,exp  = new Date(); //new Date("December 31, 9998");
		exp.setTime(exp.getTime() + Days*24*60*60);
		document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
	},
	get:function(name){
		var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
		if(arr=document.cookie.match(reg)) 
			return unescape(arr[2]);
		else 
			return null;
	},
	del:function(name){
		var exp = new Date(),_cookie=utils.cookie.get(name);
		exp.setTime(exp.getTime() - 1);
		if(_cookie!=null) 
				document.cookie= name + "="+_cookie+";expires="+exp.toGMTString();
	}
}

//检查日期是否合法
utils.isValidDate = function (day, month, year) {
	if (month < 1 || month > 12) {
		return false;
	}
	if (day < 1 || day > 31) {
		return false;
	}
	if ((month == 4 || month == 6 || month == 9 || month == 11) && (day == 31)) {
		return false;
	}
	if (month == 2) {
		var leap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
		if (day>29 || (day == 29 && !leap)) {
			return false;
		}
	}
	return true;
}

//获取浏览器
utils.getBrowser=function(){
	if (window.navigator.userAgent.indexOf("Safari")>=0 && navigator.userAgent.toLowerCase().indexOf("version") >= 0) {
		cBrowser = "safari";
	} else if (window.navigator.userAgent.indexOf("Chrome")>=0) {
		cBrowser = "chrome";
	} else if (navigator.userAgent.toLowerCase().indexOf('msie')>=0) {
		cBrowser = "ie";
	} else if (navigator.userAgent.toLowerCase().indexOf('firefox')>=0) {
		cBrowser = "firefox"; 
	} else if (navigator.userAgent.toLowerCase().indexOf('opera')>=0) {
		cBrowser = "opera";
	} 
	return cBrowser;
}

//获取URL地址中的参数
utils.query = function(s) {
    var reg = new RegExp("(^|&)" + s + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) {
        return unescape(r[2]);
    }
    return null;
}
