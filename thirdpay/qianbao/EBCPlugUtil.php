<?php include ("EBCConfig.php");?>
<?php
/** 签名方式.md5 */
define('sign_type_md5', "MD5");
/** 签名方式.md5.32位 */
define('sign_type_md5_32', "MD5-32");
/** 签名方式.dsa */
define('sign_type_dsa', "DSA");
class EBCPlugUtil {
    //-------------------------------------------------------------------------- 交易.输入
    /**
     * 得到交易数据签名
     * @param partner 合作伙伴ID
     * @param key 合作伙伴密钥
     * @param charset 参数编码字符集
     * @param sign_type 签名方式
     * @param version 交易接入版本号
     * @param out_trade_no 外部交易号
     * @param total_fee 交易总金额
     * @param payment_type 支付类型
     * @param show_url 交易展示URL
     * @param describe 交易描述
     * @param return_url 返回URL
     * @return 交易数据打包后地址
     */
    function getTradeSign($partner, $key, $charset, $sign_type, $version, $out_trade_no, $total_fee, $payment_type, $show_url, $describe, $return_url){
        $sign = "";
        $total_fee = $this->money_format($total_fee);
        try{
            //参数拼接
            $parameters = "?partner=".$partner;//合作伙伴ID
            $parameters = $parameters."&charset=".$charset;//参数编码字符集
            $parameters = $parameters."&sign_type=".$sign_type;//签名方式
            if (!empty($version) && $version != "" && strtoupper($version) != "NULL") {
                $parameters = $parameters."&version=".$version;//交易接入版本号
            }
            $parameters = $parameters."&out_trade_no=".$out_trade_no;//外部交易号
            $parameters = $parameters."&total_fee=".$total_fee;//交易总金额
            if (!empty($payment_type) && $payment_type != "" && strtoupper($payment_type) != "NULL") {
                $parameters = $parameters."&payment_type=".$this->ebc_encode($payment_type);//支付类型
            }
            if (!empty($show_url) && $show_url != "" && strtoupper($show_url) != "NULL") {
                $parameters = $parameters."&show_url=".$this->ebc_encode($show_url);//交易展示URL
            }
            if (!empty($describe) && $describe != "" && strtoupper($describe) != "NULL") {
                $parameters = $parameters."&describe=".$this->ebc_encode($describe);//交易描述
            }
            if (!empty($return_url) && $return_url != "" && strtoupper($return_url) != "NULL") {
                $parameters = $parameters."&return_url=".$this->ebc_encode($return_url);//返回URL
            }
            //签名
            $sign = $this->getSign($sign_type, $key, $parameters);
        } catch (Exception $e) {
            print $e->getMessage();
            exit();
        }
        return $sign;
    }

    /**
     * 得到访问EBC支付网关交易处理的URL地址
     * @param trade_home_url EBC支付网关.交易.地址
     * @param partner 合作伙伴ID
     * @param key 合作伙伴密钥
     * @param charset 参数编码字符集
     * @param sign_type 签名方式
     * @param version 交易接入版本号
     * @param out_trade_no 外部交易号
     * @param total_fee 交易总金额
     * @param payment_type 支付类型
     * @param show_url 交易展示URL
     * @param describe 交易描述
     * @param return_url 返回URL
     * @return 访问EBC支付网关交易处理的URL地址
     */
    function getTradeUrl($trade_home_url, $partner, $key, $charset, $sign_type, $version, $out_trade_no, $total_fee, $payment_type, $show_url, $describe, $return_url) {
        $url = $trade_home_url;//EBC支付网关.交易.地址
        $total_fee = $this->money_format($total_fee);
        try {
            //参数拼接
            $parameters = "?partner=".$partner;//合作伙伴ID
            $parameters = $parameters."&charset=".$charset;//参数编码字符集
            $parameters = $parameters."&sign_type=".$sign_type;//签名方式
            if (!empty($version) && $version != "" && strtoupper($version) != "NULL") {
                $parameters = $parameters."&version=".$version;//交易接入版本号
            }
            $parameters = $parameters."&out_trade_no=".$out_trade_no;//外部交易号
            $parameters = $parameters."&total_fee=".$total_fee;//交易总金额
            if (!empty($payment_type) && $payment_type != "" && strtoupper($payment_type) != "NULL") {
                $parameters = $parameters."&payment_type=".$this->ebc_encode($payment_type);//支付类型
            }
            if (!empty($show_url) && $show_url != "" && strtoupper($show_url) != "NULL") {
                $parameters = $parameters."&show_url=".$this->ebc_encode($show_url);//交易展示URL
            }
            if (!empty($describe) && $describe != "" && strtoupper($describe) != "NULL") {
                $parameters = $parameters."&describe=".$this->ebc_encode($describe);//交易描述
            }
            if (!empty($return_url) && $return_url != "" && strtoupper($return_url) != "NULL") {
                $parameters = $parameters."&return_url=".$this->ebc_encode($return_url);//返回URL
            }
            //交易数据签名
            $sign = $this->getTradeSign($partner, $key, $charset, $sign_type, $version, $out_trade_no, $total_fee, $payment_type, $show_url, $describe, $return_url);
            $parameters = $parameters."&sign=".$this->ebc_encode($sign);
            $url = $url.$parameters;
        } catch (Exception $e) {
            print $e->getMessage();
            exit();
        }
        return $url;
    }

    //-------------------------------------------------------------------------- 交易.通知
    /**
     * 得到交易通知数据签名
     * @param key 合作伙伴密钥
     * @param notify_id 通知ID
     * @param notify_time 通知时间
     * @param charset 参数编码字符集
     * @param sign_type 签名方式
     * @param version 交易接入版本号
     * @param out_trade_no 外部交易号
     * @param total_fee 交易总金额
     * @param payment_type 支付类型
     * @param show_url 交易展示URL
     * @param describe 交易描述
     * @param trade_status 交易状态
     * @param trade_no 交易参考号
     * @param gmt_create 交易创建时间
     * @param gmt_payment 买家付款时间
     * @return 交易通知数据签名
     */
    function getTradeNotifySign($key, $notify_id, $notify_time, $charset, $sign_type, $version, $out_trade_no, $total_fee, $payment_type, $show_url, $describe, $trade_status, $trade_no, $gmt_create, $gmt_payment) {
        $sign = "";
        $total_fee = $this->money_format($total_fee);
        try{
            $parameters = $parameters."&notify_id=".$notify_id;//通知ID
            $parameters = $parameters."&notify_time=".$notify_time;//通知时间
            $parameters = $parameters."&charset=".$charset;//参数编码字符集
            $parameters = $parameters."&sign_type=".$sign_type;//签名方式
            if (!empty($version) && $version != "" && strtoupper($version) != "NULL") {
                $parameters = $parameters."&version=".$version;//交易接入版本号
            }
            $parameters = $parameters."&out_trade_no=".$out_trade_no;//外部交易号
            $parameters = $parameters."&total_fee=".$total_fee;//交易总金额
            if (!empty($payment_type) && $payment_type != "" && strtoupper($payment_type) != "NULL") {
                $parameters = $parameters."&payment_type=".$this->ebc_encode($payment_type);//支付类型
            }
            if (!empty($show_url) && $show_url != "" && strtoupper($show_url) != "NULL") {
                $parameters = $parameters."&show_url=".$this->ebc_encode($show_url);//交易展示URL
            }
            if (!empty($describe) && $describe != "" && strtoupper($describe) != "NULL") {
                $parameters = $parameters."&describe=".$this->ebc_encode($describe);//交易描述
            }
            $parameters = $parameters."&trade_status=".$trade_status;//交易状态
            $parameters = $parameters."&trade_no=".$trade_no;//交易参考号
            $parameters = $parameters."&gmt_create=".$gmt_create;//交易创建时间
            $parameters = $parameters."&gmt_payment=".$gmt_payment;//买家付款时间
            //签名
            $sign = $this->getSign($sign_type, $key, $parameters);
        } catch (Exception $e) {
            print $e->getMessage();
            exit();
        }
        return $sign;
    }

    //-------------------------------------------------------------------------- 退款.输入
    /**
     * 得到退款数据签名
     * @param partner 合作伙伴ID
     * @param key 合作伙伴密钥
     * @param charset 参数编码字符集
     * @param sign_type 签名方式
     * @param version 退款接入版本号
     * @param trade_no 交易参考号
     * @param out_refund_no 外部退款号
     * @param total_fee 退款总金额
     * @param describe 退款描述
     * @param return_url 返回URL
     * @return 退款数据签名
     */
    function getRefundSign($partner, $key, $charset, $sign_type, $version, $trade_no, $out_refund_no, $total_fee, $describe, $return_url) {
        $sign = "";
        $total_fee = $this->money_format($total_fee);
        try {
            //参数拼接
            $parameters = "?partner=".$partner;//合作伙伴ID
            $parameters = $parameters."&charset=".$charset;//参数编码字符集
            $parameters = $parameters."&sign_type=".$sign_type;//签名方式
            if (!empty($version) && $version != "" && strtoupper($version) != "NULL") {
                $parameters = $parameters."&version=".$version;//退款接入版本号
            }
            $parameters = $parameters."&trade_no=".$trade_no;//交易参考号
            $parameters = $parameters."&out_refund_no=".$out_refund_no;//外部退款号
            $parameters = $parameters."&total_fee=".$total_fee;//退款总金额
            if (!empty($describe) && $describe != "" && strtoupper($describe) != "NULL") {
                $parameters = $parameters."&describe=".$this->ebc_encode($describe);//退款描述
            }
            if (!empty($return_url) && $return_url != "" && strtoupper($return_url) != "NULL") {
                $parameters = $parameters."&return_url=".$this->ebc_encode($return_url);//返回URL
            }
            //签名
            $sign = $this->getSign($sign_type, $key, $parameters);
        } catch (Exception $e) {
            print $e->getMessage();
            exit();
        }
        return $sign;
    }

    /**
     * 得到访问EBC支付网关退款处理的URL地址
     * @param refund_home_url EBC支付网关.退款.地址
     * @param partner 合作伙伴ID
     * @param key 合作伙伴密钥
     * @param charset 参数编码字符集
     * @param sign_type 签名方式
     * @param version 退款接入版本号
     * @param trade_no 交易参考号
     * @param out_refund_no 外部退款号
     * @param total_fee 退款总金额
     * @param describe 退款描述
     * @param return_url 返回URL
     * @return 访问EBC支付网关退款处理的URL地址
     */
    function getRefundUrl($refund_home_url, $partner, $key, $charset, $sign_type, $version, $trade_no, $out_refund_no, $total_fee, $describe, $return_url) {
        $url = $refund_home_url;
        $total_fee = $this->money_format($total_fee);
        try {
            //参数拼接
            $parameters = "?partner=".$partner;//合作伙伴ID
            $parameters = $parameters."&charset=".$charset;//参数编码字符集
            $parameters = $parameters."&sign_type=".$sign_type;//签名方式
            if (!empty($version) && $version != "" && strtoupper($version) != "NULL") {
                $parameters = $parameters."&version=".$version;//退款接入版本号
            }
            $parameters = $parameters."&trade_no=".$trade_no;//交易参考号
            $parameters = $parameters."&out_refund_no=".$out_refund_no;//外部退款号
            $parameters = $parameters."&total_fee=".$total_fee;//退款总金额
            if (!empty($describe) && $describe != "" && strtoupper($describe) != "NULL") {
                $parameters = $parameters."&describe=".$this->ebc_encode($describe);//退款描述
            }
            if (!empty($return_url) && $return_url != "" && strtoupper($return_url) != "NULL") {
                $parameters = $parameters."&return_url=".$this->ebc_encode($return_url);//返回URL
            }
            //退款数据签名
            $sign = $this->getRefundSign($partner, $key, $charset, $sign_type, $version, $trade_no, $out_refund_no, $total_fee, $describe, $return_url);
            $parameters = $parameters."&sign=".$this->ebc_encode($sign);
            $url = $url.$parameters;
        } catch (Exception $e) {
            print $e->getMessage();
            exit();
        }
        return $url;
    }

    //-------------------------------------------------------------------------- 退款.通知
    /**
     * 得到退款通知数据签名
     * @param key 合作伙伴密钥
     * @param notify_id 通知ID
     * @param notify_time 通知时间
     * @param charset 参数编码字符集
     * @param sign_type 签名方式
     * @param version 退款接入版本号
     * @param trade_no 交易参考号
     * @param out_refund_no 外部退款号
     * @param total_fee 退款总金额
     * @param describe 退款描述
     * @param refund_status 退款状态
     * @param refund_no 退款参考号
     * @param refund_create 退款创建时间
     * @param refund_finish 退款完成时间
     * @return 退款通知数据签名
     */
    function getRefundNotifySign($key, $notify_id, $notify_time, $charset, $sign_type, $version, $trade_no, $out_refund_no, $total_fee, $describe, $refund_status, $refund_no, $refund_create, $refund_finish) {
        $sign = "";
        $total_fee = $this->money_format($total_fee);
        try {
            $parameters = $parameters."&notify_id=".$notify_id;//通知ID
            $parameters = $parameters."&notify_time=".$notify_time;//通知时间
            $parameters = $parameters."&charset=".$charset;//参数编码字符集
            $parameters = $parameters."&sign_type=".$sign_type;//签名方式
            if (!empty($version) && $version != "" && strtoupper($version) != "NULL") {
                $parameters = $parameters."&version=".$version;//交易接入版本号
            }
            $parameters = $parameters."&trade_no=".$trade_no;//交易参考号
            $parameters = $parameters."&out_refund_no=".$out_refund_no;//外部退款号
            $parameters = $parameters."&total_fee=".$total_fee;//退款总金额
            if (!empty($describe) && $describe != "" && strtoupper($describe) != "NULL") {
                $parameters = $parameters."&describe=".$this->ebc_encode($describe);//退款描述
            }
            $parameters = $parameters."&refund_status=".$refund_status;//退款状态
            $parameters = $parameters."&refund_no=".$refund_no;//退款参考号
            $parameters = $parameters."&refund_create=".$refund_create;//退款创建时间
            $parameters = $parameters."&refund_finish=".$refund_finish;//退款完成时间
            //签名
            $sign = $this->getSign($sign_type, $key, $parameters);
        } catch (Exception $e) {
            print $e->getMessage();
            exit();
        }
        return $sign;
    }
    
    //-------------------------------------------------------------------------- 签名
    /** 得到对参数串进行的签名 */
    function getSign($sign_type, $key, $parameters) {
        $this->p(">>>>>>> getSign >>>>>>>>  sign_type=".$sign_type);
        //p(">>>>>>> getSign >>>>>>>>        key=".$key);
        $this->p(">>>>>>> getSign >>>>>>>> parameters=".$parameters);
        $sign = "";
        try {
            //参数签名
            if (strtoupper(sign_type_md5) == strtoupper($sign_type)) {
                //$sign = base64_encode(md5($parameters.$key));
            } else if (strtoupper(sign_type_md5_32) == strtoupper($sign_type)) {
                $md5 = md5($parameters.$key);
                $sign = base64_encode($md5);
            }
        } catch (Exception $e) {
            print $e->getMessage();
            exit();
        }
        $this->p(">>>>>>> getSign >>>>>>>>       sign=".$sign);
        return $sign;
    }

    //-------------------------------------------------------------------------- 辅助方法
    /** 日志输出 */
    function p($msg) {
        if ("DEBUG" == strtoupper($ebc_log_level)) {
            echo $msg."<br>";
        }
    }

    /** 字符encode */
	function ebc_encode($str) {
        $this->p(">>>>>>> ebc_encode >>>>>>>> 1 str=".$str);
        $str = $url.urlencode($str);
        $this->p(">>>>>>> ebc_encode >>>>>>>> 2 str=".$str);
        $arr = array("%5C%22" => "%22", "%5C%27" => "%27", "%5C%5C" => "%5C", "%2A" => "*");
        $str = strtr($str, $arr);
        $this->p(">>>>>>> ebc_encode >>>>>>>> 3 str=".$str);
        return $str;
    }

    /** 格式化金额 */
    function money_format($money){
        return str_replace(",","",number_format(str_replace(",","",$money),2));
    }
}
?>