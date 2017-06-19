<?php
/**
* 公共发送短信模块
* @author gsp <[<email address>]>
*/
namespace Common\Model;
use Think\Model;

class SysMssModel extends Model
{
	private $channel = 0;
	function __construct(){
		parent::__construct('log_sms');
	}
	/**
	 * 设置发送短信的通道
	 * @author gsp <[<email address>]>
	 */
	public function setChannel($channel){
		$this->channel = $channel;
		return $this;
	}
	/**
	 * 发送短信
	 * @access public
	 * @param int $user_id 用户ID
	 * @param string $mobile 手机号
	 * @param string $msg 短信内容
	 * @param int $stype 类型:1注册2更新密码3支付密码4交易类,8提醒类,10促销类
	 * @param int $input_time 发送时间
     * @return bool
     * @author gsp <[<email address>]>
	 */
	public function send($user_id=0,$mobile='',$msg='',$stype=1,$input_time=0){
		if(!$input_time){
			$input_time = CORE_TIME;
			if($stype == 8){
				if(date('G') > 21){
					$input_time = strtotime("tomorrow 09:10:00");
				}elseif (date('G') < 9) {
					$input_time = strtotime("today 09:10:00");
				}
			}
		}
		$_data = array(
				'user_id'=>(int)$user_id,		 
				'mobile'=>$mobile,		 
				'msg'=>addslashes($msg),		 
				'stype'=>(int)$stype,	
				'input_time'=>$input_time,
				'user_ip'=>get_ip(),
				'chanel'=>$this->channel
			);
		$this->data($_data)->add();
	}
	/**
	 * 产生动态验证码
	 * @param  string  $mobile [description]
	 * @param  integer $stype  [description]
	 * @return [type]          [description]
	 * @author gsp <[<email address>]>
	 */
	public function genDynamicCode($mobile,$stype=0){
		//60秒内不能重复发送
		if(isset($_SESSION['mcode']) && isset($_SESSION['mctime'])){
			if(CORE_TIME-$_SESSION['mctime']<60){
				return array('err'=>1,'msg'=>'动态码已发送成功，请稍候再试');	
			}
			//有效期300秒
			if(strpos($_SESSION['mcode'],$mobile)>0 && (CORE_TIME-$_SESSION['mctime'])<300){
				$mcode=substr($_SESSION['mcode'],0,6);
			}
		}
		if(empty($mcode)){
			$mcode = 123456;
			// $mcode=mt_rand(100820,999560);	
		}
		
		$msg=sprintf(L('sms_template')['dynamic_code'],$mcode);
		
		$_SESSION['mctype']=$stype;
		$_SESSION['mcode']=$mcode.'.'.$mobile;
		$_SESSION['mctime']=CORE_TIME;
		return array('err'=>0,'msg'=>$msg);
	}
	/**
	 * 检查动态验证码
	 * @param  string  $mobile [description]
	 * @param  string  $mcode  [description]
	 * @param  integer $stype  [description]
	 * @return [type]          [description]
	 */
	public function chkDynamicCode($mobile='',$mcode='',$stype=0){
		if(isset($_SESSION['mcode']) && isset($_SESSION['mctime'])){
			if((CORE_TIME-$_SESSION['mctime'])>300){
				return array('err'=>1,'msg'=>'手机动态码已失效');
			}
			if($stype && $stype != $_SESSION['mctype']){
				//return array('err'=>1,'msg'=>'手机动态码不正确'); //这里不用
			}
			wlog(LOG_PATH.'Home/sms/code.log',date("Y-m-d H:i:s")."@".$mcode.'.'.$mobile.' = '.json_encode($_SESSION)."--".get_ip()."\r\n\r\n");

			if($_SESSION['mcode']==$mcode.'.'.$mobile){
				unset($_SESSION['mcode']);
				unset($_SESSION['mctime']);
				return array('err'=>0,'msg'=>'验证通过');
			}
		}
		return array('err'=>1,'msg'=>'手机动态码输入不正确，请重新输入');	
	}
	/*
     * 注册时限制检查
     * @access public
     * @param string $mobile 手机号
     * @return bool
* */
public function chkRegLimit($mobile='',$ip=''){
	    $setting_security = getSystemParam('security');
	    //ip限制
	    $limit=(int)$setting_security['reg']['ip_limit'];
	    if($limit>0){
	        $white = D('WhiteIp')->checkIp($ip);
	        if(empty($white)){ //不在白名单中
	            $exists = M('log_sms')->where("user_ip='$ip' and stype=1 and input_time>".(time()-86400))->count('id');
	            if($exists>=$limit){
	                $this->error='您的请求过于频繁，请与客服联系';
	                return false;
	            }
	        }
	    }
	    //检查手机发送次数:注册
	    $limit=(int)$setting_security['reg']['mobile_limit'];
	    if($limit>0){
	        $num=$this->getSendNum($mobile,1);
	        if($num>=$limit){
	            $this->error='该手机号码已多次获取动态码，如仍未收到，请联系客服';
	            return false;
	        }
	    }
	    return true;
}
/*
 * 检查发送数据[24小时内]
 * @access public
 * @param string $mobile 手机号
 * @param int $stype 类型
 * @return num
 */
public function getSendNum($mobile='',$stype=1){
	$where='input_time>'.(CORE_TIME-86400);
	if($stype){
		$where .= " and stype = $stype";
	}
	if($mobile){
		$where .= " and mobile = '$mobile'";
	}
	//$Model->where("id=%d and username='%s' and xx='%f'",$id,$username,$xx)->select();
	return M('log_sms')->where($where)->count('id');
}
}