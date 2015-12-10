<?php
/**
 * 短消息类
 *
 * @version        $Id: msg.class.php
 * @package        Stourweb.Libraries
 * @copyright      Copyright (c) 2007 - 2014, Inc.
 * @license        http://www.stourweb.com
 * @return         {"Success":true,"Message":null,"Data":35}
 */
class Msg{

    var $userName=''; //用户名
	var $password=''; //密码
	var $sendphone;//发送的手机号
	var $contentprefix;//称昵
	var $content;
	var $apiUrl='http://sms.souxw.com/service/api.ashx?'; //短信接口地址
    var $action;//操作 buysms/sendsms/querysmssendlog/querysmsbuylog/querysmsbalance
    var $data = array();
	function __construct($username,$password)
	{
		$this->userName = $username;
        $this->password = $password;
        $this->data['account'] = $username;
        $this->data['password'] = md5($password);

	}
	
	

	/*
	 * 发送短消息
	 *@param string $phone,接收手机号
	 *@param string $prefix,称呼,如"黄先生",
	 *@param string $content,短信内容,内容长度不超过50个汉字.
	 * */

	public function sendMsg($phone,$prefix,$content)
	{
		$init = array(
            'action'=>'sendsms',
            'telno'=>$phone,
            'contentprefix'=>$prefix,
            'content'=>$content
        );
        $data = array_merge($this->data,$init);//合并数组
        $params = http_build_query($data);//生成参数数组
        $url = $this->apiUrl.$params;

        return $this->http($url);
	}
    /*
     * 查询发送记录接口
     * @param string begindate //发送记录日期 如2014-05-06,表示2014-5-6以后的发送记录
     * */
    public function querySendLog($begindate)
    {
        $init = array(
            'action'=>'querysmssendlog',
            'sendtime'=>$begindate
        );
        $data = array_merge($this->data,$init);//合并数组
        $params = http_build_query($data);//生成参数数组
        $url = $this->apiUrl.$params;
        return $this->http($url);
    }

     /*
      * 查询余额(条数)
      * */
    public function queryBalance()
    {
        $init = array(
            'action'=>'querysmsbalance'
        );
        $data = array_merge($this->data,$init);//合并数组
        $params = http_build_query($data);//生成参数数组
        $url = $this->apiUrl.$params;
        return $this->http($url);
    }

    /*
     * 查询帐户可用余额
     * @param string begindate //充值记录日期 如2014-05-06,表示2014-5-6以后的充值记录
     * */
    public function queryBuyLog($begindate)
    {

        $init = array(
            'action'=>'querysmsbuylog',
            'buytime'=>$begindate
        );
        $data = array_merge($this->data,$init);//合并数组
        $params = http_build_query($data);//生成参数数组
        $url = $this->apiUrl.$params;

        return $this->http($url);
    }
    public function queryFailLog($begindate)
    {
        $init = array(
            'action'=>'querysmssendlog',
            'sendtime'=>$begindate,
            'sendstatus'=>0
        );
        $data = array_merge($this->data,$init);//合并数组
        $params = http_build_query($data);//生成参数数组
        $url = $this->apiUrl.$params;
        return $this->http($url);
    }
    /*
     *
     * 查询系统参数(可购买条数等信息)
     * */
    public function queryServiceInfo()
    {
        $init = array(
            'action'=>'queryservicestatus'
        );
        $data = array_merge($this->data,$init);//合并数组
        $params = http_build_query($data);//生成参数数组
        $url = $this->apiUrl.$params;
        return $this->http($url);
    }



    /*
     * 接口请求函数
     * @param string url
     * @param string postfields,post请求附加字段.
     * @return $response
     * */
    private  function http($url, $postfields='', $method='GET')
    {
        $ci=curl_init();

        curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);

        if($method=='POST')
        {
            curl_setopt($ci, CURLOPT_POST, TRUE);
            if($postfields!='')curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
        }

        curl_setopt($ci, CURLOPT_URL, $url);
        $response=curl_exec($ci);
        curl_close($ci);
        return $response;
    }


}