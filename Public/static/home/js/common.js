function getOs()  
{  
    var OsObject = "";  
   if(navigator.userAgent.indexOf("MSIE")>0) {  
        return "MSIE";  
   }  
   if(isFirefox=navigator.userAgent.indexOf("Firefox")>0){  
        return "Firefox";  
   }  
   if(isSafari=navigator.userAgent.indexOf("Safari")>0) {  
        return "Safari";  
   }   
   if(isCamino=navigator.userAgent.indexOf("Camino")>0){  
        return "Camino";  
   }  
   if(isMozilla=navigator.userAgent.indexOf("Gecko/")>0){  
        return "Gecko";  
   }  
     
}

String.prototype.trim=function(){
  return this.replace(/(^\s*)|(\s*$)/g, "");
}

function loginbox(type){
  $.layer({
      type: 2,
      border: [0],
      title: false,
      fix:true,
      iframe: {src : "/user/login/loginbox?type="+type},
      area: ['360px', '340px']
  });
}

function guanzhu(gid){  
        $.ajax({ 
            type: 'POST', 
            url: "/Index/guanzhu", 
            data: {'gid':gid}, 
            dataType:'text', 
            beforeSend:function(){ 
                // $("#city").append("<a>loading...</a>");//显示加载动画 
            }, 
            success:function(json){ 
                if(json == 1){
                      window.location.reload();
                }else if(json == 0){
                   layer.msg("请先登录!", {
                                shade: [0.8, '#393D49'],
                                icon: 2,
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                          if(url){
                            window.location.href=url;
                          }
                        });   
                }else if(json == 2){
                   layer.msg("您不能关注您自己", {
                    shade: [0.8, '#393D49'],
                                icon: 2,
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    });   
                }
               
            }, 
            error:function(){ 
                alert("数据加载失败"); 
            } 
        }); 
      } 
   
var getLength = function(str, shortUrl) {
    if (true == shortUrl) {
        return Math.ceil(str.replace(/((news|telnet|nttp|file|http|ftp|https):\/\/){1}(([-A-Za-z0-9]+(\.[-A-Za-z0-9]+)*(\.[-A-Za-z]{2,5}))|([0-9]{1,3}(\.[0-9]{1,3}){3}))(:[0-9]*)?(\/[-A-Za-z0-9_\$\.\+\!\*\(\),;:@&=\?\/~\#\%]*)*/ig, 'xxxxxxxxxxxxxxxxxxxx')
                            .replace(/^\s+|\s+$/ig,'').replace(/[^\x00-\xff]/ig,'xx').length/2);
    } else {
        return Math.ceil(str.replace(/^\s+|\s+$/ig,'').replace(/[^\x00-\xff]/ig,'xx').length/2);
    }
};

function ll(str,type,isloaction,url){
    layer.msg(str,2,type,function(){
      if(isloaction){
        window.location.reload();
      }
      if(url){
        window.location.href=url;
      }
  });   
}

function selectAll(id){
   var checklist = document.getElementsByName (id);
     if(document.getElementById("controlAll").checked)
     {
     for(var i=0;i<checklist.length;i++)
     {
        checklist[i].checked = 1;
     } 
   }else{
    for(var j=0;j<checklist.length;j++)
    {
       checklist[j].checked = 0;
    }
   }
}

function onlyNumber(event){
    var keyCode = event.keyCode;
    if(keyCode<48 || keyCode>57){
        event.keyCode = 0;
    }
}

 function sure(tip,url){
          layer.confirm(tip, {
              btn: ['确定','取消'], //按钮
              shade: false //不显示遮罩
          }, function(){
              window.location.href=url;
          }, function(){
              
          });
      }               


function copyUrl()
{
  var clipBoardContent=this.location.href;
  window.clipboardData.setData("Text",clipBoardContent);
  ll("复制成功!",1);
}

function Addme(title, url) {
  url = document.URL;  //你自己的主页地址
  title = "我的塑料网";  //你自己的主页名称
  try {
      window.external.addFavorite(url, title);
  }
catch (e) {
     try {
       window.sidebar.addPanel(title, url, "");
    }
     catch (e) {
         alert("抱歉，您所使用的浏览器无法完成此操作。nn加入收藏失败，请使用Ctrl+D进行添加");
     }
  }
}

 $(".link3 li:last").hover(function (){ 
                        $("#divs").show();
                        $("#divs").hover(function(){
                            $("#divs").show();
                                 },function (){  
                                $("#divs").hide();  
                            });  
                    },function (){  
                        $("#divs").hide();  
                    }); 



