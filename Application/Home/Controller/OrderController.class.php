<?php
namespace Home\Controller;
class OrderController extends HomeBaseController
{
   public $alipayStamp = '';
   public function index(){
   		// $id = I('get.id');// 定单ID
		// 查询这个定单总价是多少
		// $orderModel = M('Order');
		// $tp = $orderModel->field('total_price')->find($id);
		/************ 生成支付宝的按钮 **************/
		require_once("./alipay/alipay.config.php");
		require_once("./alipay/lib/alipay_submit.class.php");
		//支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径 - 我们用来接收支付宝发来的消息的地址
        $notify_url = "http://www.gsplbb.xyz/Home/Order/respond";
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径 - 会员在支付宝当支付成功之后跳转到哪个页面
        $return_url = "http://www.gsplbb.xyz/Home/Order/success";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //卖家支付宝帐户 - 收钱的账号
        $seller_email = '1554680230@qq.com';
        //必填
        //商户订单号 - 本地的定单号 -> 这次支付对应我们本地的哪个定单 $id = 1
        $out_trade_no = 11;
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = '个人订单支付';
        //必填
        //付款金额 - 定单总价$tp['total_price']
        $total_fee = 567;
        //必填
        //订单描述
        $body = '个人订单支付测试';
        //商品展示地址 - 购买的商品的详情页面的地址 -> 定单中所有商品的详情页面
        $show_url = '';
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1
        
        $parameter = array(
				"service" => "create_direct_pay_by_user",
				"partner" => trim($alipay_config['partner']),
				"payment_type"	=> $payment_type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"seller_email"	=> $seller_email,
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"show_url"	=> $show_url,
				"anti_phishing_key"	=> $anti_phishing_key,
				"exter_invoke_ip"	=> $exter_invoke_ip,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);
		$alipaySubmit = new \AlipaySubmit($alipay_config);
		// 生成按钮的HTML代码
		$html_text = $alipaySubmit->buildRequestForm($parameter, "get", "立即支付");

		$this->assign('btn', $html_text);

		$this->setPageInfo('下单成功', '下单成功', '下单成功', 1, array('success'));
		$this->display();
   }
   // 接收支付宝发过来的消息
	public function respond()
	{
		// 执行notify_url.php文件中的代码
		// include('./alipay/notify_url.php');
		require_once("alipay.config.php");
		require_once("lib/alipay_notify.class.php");
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		//验证成功
		if($verify_result) {
			//请在这里加上商户的业务逻辑程序代

			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

			//商户订单号 - 本地的定单号
			$out_trade_no = $_POST['out_trade_no'];

			//支付宝交易号 - 对应的在支付宝服务器上的交易号是多少
			$trade_no = $_POST['trade_no'];

			//交易状态 - 不同的接口会有不同的状态，比如（用的是担保交易：收到货、已到货、已付款等等状态），我们用的是即时到账这个接口，所以只有一个支付成功的状态
			$trade_status = $_POST['trade_status'];

		    if($_POST['trade_status'] == 'TRADE_FINISHED') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序

				// 设置这个定单为已支付的状态
				// $orderModel = D('Admin/Order');
				// $orderModel->setPaid($out_trade_no);
					
				//注意：
				//该种交易状态只在两种情况下出现
				//1、开通了普通即时到账，买家付款成功后。
				//2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

		        //调试用，写文本函数记录程序运行情况是否正常
		        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		    }else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序
						
				//注意：
				//该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。

		        //调试用，写文本函数记录程序运行情况是否正常
		        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		    }

			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
		        
			echo "success";		//请不要修改或删除
			
		}else {
		    //验证失败
		    echo "fail";

		    //调试用，写文本函数记录程序运行情况是否正常
		    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}
	}
	public function success()
	{
		if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		//不管普通或者高级 都执行此处
		//判断该笔订单是否在商户网站中已经做过处理
		//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
		//如果有做过处理，不执行商户的业务程序

		//因为订单有可能已经通过异步进行处理了，所以需要先进行判断订单是否已经处理，如果处理就不再处理直接展示成功页面，如果未处理就处理业务后展示成功页面。
		echo '支付成功！';
		}
	}
}















