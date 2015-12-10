<?php

/* PHP SDK
 * @version 2.0.0
 * @author magicsky0@163.com
 * @copyright © 2014, Ctrip Corporation. All rights reserved.
 */

class Token 
{
	protected $_uid;
	protected $_sid;
	protected $_key;
	protected $_stmp;
	protected $_sign;
	protected $_type;
	
	public function __construct( $type, $uid='', $sid='', $key='' )
	{

		
		if( !$uid || !$sid || !$key )
		{

		/*	$tmp = json_decode(file_get_contents($path),TRUE);
			
			if( !array_key_exists('uid', $tmp) || 
				!array_key_exists('sid', $tmp) || 
				!array_key_exists('key', $tmp) )
			{
				trigger_error('data/json文件数据错误',E_USER_ERROR);
			}
			*/
			$uid = $GLOBALS['cfg_ctrip_allianceid'] ? $GLOBALS['cfg_ctrip_allianceid'] : '29976';
			$sid = $GLOBALS['cfg_ctrip_sid'] ? $GLOBALS['cfg_ctrip_sid'] : '469606';
			$key = $GLOBALS['cfg_ctrip_key'] ? $GLOBALS['cfg_ctrip_key'] : '16F7715F-AA5C-4F17-954E-7C5DFAB8A6BC';
		}
		
		$this->verify( $type, $uid, $sid, $key );

	}
	
	public function verify( $type, $uid, $sid, $key )
	{
		$this->_type = $type;
		$this->_uid = $uid;
		$this->_sid = $sid;
		$this->_key = $key;
		list($usec, $sec) = explode(" ", microtime());
		$this->_stmp = $sec;

		$this->_sign = $this->UMD5(
							$this->_stmp
							.$this->_uid
							.$this->UMD5($this->_key)
							.$this->_sid
							.$this->_type
						);
	}
	
	public function UMD5($str)
	{
        $coutw = $str;
        if (strlen($str) > 0) {
            $coutw = strtoupper(md5($str));
        }
        return $coutw;
	}
/*list($usec, $sec) = explode(" ", microtime());
$Timestamp = $sec; //需要计算的时间戳
$SecretKeyMd5 = UMD5($KEYS); //先加密一次
$KeyString = $Timestamp . $AID . $SecretKeyMd5 . $SID . $RequestType;
$Signature = MD5Ext_Strtoupper($KeyString);
$KeyString = $Timestamp . $AID . $SecretKeyMd5 . $SID . $RequestType;
$Signature = MD5Ext_Strtoupper($KeyString);*/
}