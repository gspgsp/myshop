<?php
/**
 *微信支付-app控制器
 */
namespace Home\Controller;
use MyLib\WxPay;

class WxPayController extends HomeBaseController{
    protected $wechatPay;
    public function __init(){
        $this->wechatPay = new WxPay();
    }

    public function getPrePayOrder(){
        $orderBody = "test商品";
        $tade_no = "abc_" . time();
        $total_fee = 1;
        $wechatPay = $this->wechatPay;
        $response = $wechatPay->getPrePayOrder($orderBody, $tade_no, $total_fee);

        /**
         *在这里可以将订单信息新增到数据库
         */

        $msg = date("Y-m-d H:i:s")." 下单成功".serialize($response)."\n";
        $msg.=$orderBody."\n";
        $msg.=$tade_no."\n";
        $msg.=$total_fee."\n";
        file_put_contents("./wechatPay.log", $msg, FILE_APPEND | LOCK_EX);


//        p("---response----");
//        p($response);
//        p("---拿到prepayId再次签名----");
        $x = $wechatPay->getOrder($response['prepay_id']);
        $this->json_output(array('err'=>0,'data'=>$x));//拿到prepay_id以后，正式发起支付
//        p($x);

    }

    public function notifySome(){
        $xmlData = file_get_contents('php://input');

        $data = $this->wechatPay->xmlstr_to_array($xmlData);

        ksort($data);
        $buff = '';
        foreach ($data as $k => $v){
            if($k != 'sign'){
                $buff .= $k . '=' . $v . '&';
            }
        }
        $stringSignTemp = $buff . 'key=807066fb67e13b985b591f32d54219b9';//key为证书密钥
        $sign = strtoupper(md5($stringSignTemp));
        if($sign == $data['sign']){//也可以直接根据 $data['return_code'] == 'SUCCESS',来判断交易成功

            /**
             * 成功之后在这里可以将对应订单的状态更新$data['out_trade_no'],订单号查找对应订单
             *
             */
            $msg = date("Y-m-d H:i:s")." 支付通知验签通过\n";
            $msg.=serialize($data)."\n";
            file_put_contents('./wechatPay.log', $msg, FILE_APPEND | LOCK_EX);



            echo '<xml>
              <return_code><![CDATA[SUCCESS]]></return_code>
              <return_msg><![CDATA[OK]]></return_msg>
          </xml>';
            exit();
        }else{
            $msg = date("Y-m-d H:i:s")." 支付通知验签未通过\n";
            echo $msg;
            file_put_contents('./wechatPay.log', $msg, FILE_APPEND | LOCK_EX);
            exit();
        }
    }


    public function closeOrder($out_trade_no=null){
        if(!$tmp = $this->wechatPay->closeOrder($out_trade_no)){
            return array('err'=>1,'msg'=>'商户订单号错误');
        }else{
            if($tmp['return_code'] == 'SUCCESS'){

                // do something  修改数据库状态
                return array('err'=>0,'msg'=>'订单关闭成功');
            }

        }
    }

    public function downloadbill($bill_date = '20140603' ,$bill_type = 'ALL'){
        if(!$tmp = $this->wechatPay->downloadbill($bill_date,$bill_type)){
            return array('err'=>1,'msg'=>'参数错误');
        }else{
            if ($tmp['return_code'] == "FAIL") {
                echo "通信出错：".$tmp["return_msg"];
            }else{
                p("对账单详情<br />");
                $get_data = file_get_contents("php://input");
                p();

            }
        }
    }




}


