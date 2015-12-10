<?php

/*
	[UCenter] (C)2001-2009 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: client.php 864 2008-12-11 05:06:20Z monkey $
*/

if(!defined('UC_API')) {
	exit('Access denied');
}

error_reporting(0);

define('IN_UC', TRUE);
define('UC_CLIENT_VERSION', '1.5.0');
define('UC_CLIENT_RELEASE', '20081212');
define('UC_ROOT', substr(__FILE__, 0, -10));		//note �û����Ŀͻ��˵ĸ�Ŀ¼ UC_CLIENTROOT
define('UC_DATADIR', UC_ROOT.'./data/');		//note �û����ĵ���ݻ���Ŀ¼
define('UC_DATAURL', UC_API.'/data');			//note �û����ĵ���� URL
define('UC_API_FUNC', UC_CONNECT == 'mysql' ? 'uc_api_mysql' : 'uc_api_post');
$GLOBALS['uc_controls'] = array();

function uc_addslashes($string, $force = 0, $strip = FALSE) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = uc_addslashes($val, $force, $strip);
			}
		} else {
			$string = addslashes($strip ? stripslashes($string) : $string);
		}
	}
	return $string;
}

if(!function_exists('daddslashes')) {
	function daddslashes($string, $force = 0) {
		return uc_addslashes($string, $force);
	}
}

function uc_stripslashes($string) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(MAGIC_QUOTES_GPC) {
		return stripslashes($string);
	} else {
		return $string;
	}
}

/**
 *  dfopen ��ʽȡָ����ģ��Ͷ��������
 *
 * @param string $module	�����ģ��
 * @param string $action 	����Ķ���
 * @param array $arg		�������ܵķ�ʽ���ͣ�
 * @return string
 */
function uc_api_post($module, $action, $arg = array()) {
	$s = $sep = '';
	foreach($arg as $k => $v) {
		$k = urlencode($k);
		if(is_array($v)) {
			$s2 = $sep2 = '';
			foreach($v as $k2 => $v2) {
				$k2 = urlencode($k2);
				$s2 .= "$sep2{$k}[$k2]=".urlencode(uc_stripslashes($v2));
				$sep2 = '&';
			}
			$s .= $sep.$s2;
		} else {
			$s .= "$sep$k=".urlencode(uc_stripslashes($v));
		}
		$sep = '&';
	}
	$postdata = uc_api_requestdata($module, $action, $s);
	return uc_fopen2(UC_API.'/index.php', 500000, $postdata, '', TRUE, UC_IP, 20);
}

/**
 * ���췢�͸��û����ĵ��������
 *
 * @param string $module	�����ģ��
 * @param string $action	����Ķ���
 * @param string $arg		�������ܵķ�ʽ���ͣ�
 * @param string $extra		���Ӳ�����ʱ�����ܣ�
 * @return string
 */
function uc_api_requestdata($module, $action, $arg='', $extra='') {
	$input = uc_api_input($arg);
	$post = "m=$module&a=$action&inajax=2&release=".UC_CLIENT_RELEASE."&input=$input&appid=".UC_APPID.$extra;
	return $post;
}

function uc_api_url($module, $action, $arg='', $extra='') {
	$url = UC_API.'/index.php?'.uc_api_requestdata($module, $action, $arg, $extra);
	return $url;
}

function uc_api_input($data) {
	$s = urlencode(uc_authcode($data.'&agent='.md5($_SERVER['HTTP_USER_AGENT'])."&time=".time(), 'ENCODE', UC_KEY));
	return $s;
}

/**
 * MYSQL ��ʽȡָ����ģ��Ͷ��������
 *
 * @param string $model		�����ģ��
 * @param string $action	����Ķ���
 * @param string $args		�������ܵķ�ʽ���ͣ�
 * @return mix
 */
function uc_api_mysql($model, $action, $args=array()) {
	global $uc_controls;
	if(empty($uc_controls[$model])) {
		include_once UC_ROOT.'./lib/db.class.php';
		include_once UC_ROOT.'./model/base.php';
		include_once UC_ROOT."./control/$model.php";
		eval("\$uc_controls['$model'] = new {$model}control();");
	}
	if($action{0} != '_') {
		$args = uc_addslashes($args, 1, TRUE);
		$action = 'on'.$action;
		$uc_controls[$model]->input = $args;
		return $uc_controls[$model]->$action($args);
	} else {
		return '';
	}
}

function uc_serialize($arr, $htmlon = 0) {
	include_once UC_ROOT.'./lib/xml.class.php';
	return xml_serialize($arr, $htmlon);
}

function uc_unserialize($s) {
	include_once UC_ROOT.'./lib/xml.class.php';
	return xml_unserialize($s);
}

/**
 * �ַ�����Լ����ܺ���
 *
 * @param string $string	ԭ�Ļ�������
 * @param string $operation	����(ENCODE | DECODE), Ĭ��Ϊ DECODE
 * @param string $key		��Կ
 * @param int $expiry		������Ч��, ����ʱ����Ч�� ��λ �룬0 Ϊ������Ч
 * @return string		������ ԭ�Ļ��� ���� base64_encode ����������
 *
 * @example
 *
 * 	$a = authcode('abc', 'ENCODE', 'key');
 * 	$b = authcode($a, 'DECODE', 'key');  // $b(abc)
 *
 * 	$a = authcode('abc', 'ENCODE', 'key', 3600);
 * 	$b = authcode('abc', 'DECODE', 'key'); // ��һ��Сʱ�ڣ�$b(abc)������ $b Ϊ��
 */
function uc_authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

	$ckey_length = 4;	//note �����Կ���� ȡֵ 0-32;
				//note ���������Կ���������������κι��ɣ�������ԭ�ĺ���Կ��ȫ��ͬ�����ܽ��Ҳ��ÿ�β�ͬ�������ƽ��Ѷȡ�
				//note ȡֵԽ�����ı䶯����Խ�����ı仯 = 16 �� $ckey_length �η�
				//note ����ֵΪ 0 ʱ���򲻲��������Կ

	$key = md5($key ? $key : UC_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}

/**
 *  Զ�̴�URL
 *  @param string $url		�򿪵�url������ http://www.baidu.com/123.htm
 *  @param int $limit		ȡ���ص���ݵĳ���
 *  @param string $post		Ҫ���͵� POST ��ݣ���uid=1&password=1234
 *  @param string $cookie	Ҫģ��� COOKIE ��ݣ���uid=123&auth=a2323sd2323
 *  @param bool $bysocket	TRUE/FALSE �Ƿ�ͨ��SOCKET��
 *  @param string $ip		IP��ַ
 *  @param int $timeout		���ӳ�ʱʱ��
 *  @param bool $block		�Ƿ�Ϊ����ģʽ
 *  @return			ȡ�����ַ�
 */
function uc_fopen2($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE) {
	$__times__ = isset($_GET['__times__']) ? intval($_GET['__times__']) + 1 : 1;
	if($__times__ > 2) {
		return '';
	}
	$url .= (strpos($url, '?') === FALSE ? '?' : '&')."__times__=$__times__";
	return uc_fopen($url, $limit, $post, $cookie, $bysocket, $ip, $timeout, $block);
}

function uc_fopen($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE) {
	$return = '';
	$matches = parse_url($url);
	!isset($matches['host']) && $matches['host'] = '';
	!isset($matches['path']) && $matches['path'] = '';
	!isset($matches['query']) && $matches['query'] = '';
	!isset($matches['port']) && $matches['port'] = '';
	$host = $matches['host'];
	$path = $matches['path'] ? $matches['path'].($matches['query'] ? '?'.$matches['query'] : '') : '/';
	$port = !empty($matches['port']) ? $matches['port'] : 80;
	if($post) {
		$out = "POST $path HTTP/1.0\r\n";
		$out .= "Accept: */*\r\n";
		//$out .= "Referer: $boardurl\r\n";
		$out .= "Accept-Language: zh-cn\r\n";
		$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
		$out .= "Host: $host\r\n";
		$out .= 'Content-Length: '.strlen($post)."\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Cache-Control: no-cache\r\n";
		$out .= "Cookie: $cookie\r\n\r\n";
		$out .= $post;
	} else {
		$out = "GET $path HTTP/1.0\r\n";
		$out .= "Accept: */*\r\n";
		//$out .= "Referer: $boardurl\r\n";
		$out .= "Accept-Language: zh-cn\r\n";
		$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
		$out .= "Host: $host\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Cookie: $cookie\r\n\r\n";
	}
	$fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
	if(!$fp) {
		return '';//note $errstr : $errno \r\n
	} else {
		stream_set_blocking($fp, $block);
		stream_set_timeout($fp, $timeout);
		@fwrite($fp, $out);
		$status = stream_get_meta_data($fp);
		if(!$status['timed_out']) {
			while (!feof($fp)) {
				if(($header = @fgets($fp)) && ($header == "\r\n" ||  $header == "\n")) {
					break;
				}
			}

			$stop = false;
			while(!feof($fp) && !$stop) {
				$data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
				$return .= $data;
				if($limit) {
					$limit -= strlen($data);
					$stop = $limit <= 0;
				}
			}
		}
		@fclose($fp);
		return $return;
	}
}

function uc_app_ls() {
	$return = call_user_func(UC_API_FUNC, 'app', 'ls', array());
	return UC_CONNECT == 'mysql' ? $return : uc_unserialize($return);
}

/**
 * ��� feed
 *
 * @param string $icon			ͼ��
 * @param string $uid			uid
 * @param string $username		�û���
 * @param string $title_template	����ģ��
 * @param array  $title_data		��������
 * @param string $body_template		����ģ��
 * @param array  $body_data		��������
 * @param string $body_general		����
 * @param string $target_ids		����
 * @param array $images		ͼƬ
 * 	��ʽΪ:
 * 		array(
 * 			array('url'=>'http://domain1/1.jpg', 'link'=>'http://domain1'),
 * 			array('url'=>'http://domain2/2.jpg', 'link'=>'http://domain2'),
 * 			array('url'=>'http://domain3/3.jpg', 'link'=>'http://domain3'),
 * 		)
 * 	ʾ��:
 * 		$feed['images'][] = array('url'=>$vthumb1, 'link'=>$vthumb1);
 * 		$feed['images'][] = array('url'=>$vthumb2, 'link'=>$vthumb2);
 * @return int feedid
 */
function uc_feed_add($icon, $uid, $username, $title_template='', $title_data='', $body_template='', $body_data='', $body_general='', $target_ids='', $images = array()) {
	return call_user_func(UC_API_FUNC, 'feed', 'add',
		array(  'icon'=>$icon,
			'appid'=>UC_APPID,
			'uid'=>$uid,
			'username'=>$username,
			'title_template'=>$title_template,
			'title_data'=>$title_data,
			'body_template'=>$body_template,
			'body_data'=>$body_data,
			'body_general'=>$body_general,
			'target_ids'=>$target_ids,
			'image_1'=>$images[0]['url'],
			'image_1_link'=>$images[0]['link'],
			'image_2'=>$images[1]['url'],
			'image_2_link'=>$images[1]['link'],
			'image_3'=>$images[2]['url'],
			'image_3_link'=>$images[2]['link'],
			'image_4'=>$images[3]['url'],
			'image_4_link'=>$images[3]['link']
		)
	);
}

/**
 * ÿ��ȡ������
 *
 * @param int $limit
 * @return array()
 */
function uc_feed_get($limit = 100, $delete = TRUE) {
	$return = call_user_func(UC_API_FUNC, 'feed', 'get', array('limit'=>$limit, 'delete'=>$delete));
	return UC_CONNECT == 'mysql' ? $return : uc_unserialize($return);
}

/**
 * ��Ӻ���
 *
 * @param int $uid		�û�ID
 * @param int $friendid		����ID
 * @return
 * 	>0 �ɹ�
 * 	<=0 ʧ��
 */
function uc_friend_add($uid, $friendid, $comment='') {
	return call_user_func(UC_API_FUNC, 'friend', 'add', array('uid'=>$uid, 'friendid'=>$friendid, 'comment'=>$comment));
}

/**
 * ɾ�����
 *
 * @param int $uid		�û�ID
 * @param array $friendids	����ID
 * @return
 * 	>0 �ɹ�
 * 	<=0 ʧ��,���ߺ����Ѿ�ɾ��
 */
function uc_friend_delete($uid, $friendids) {
	return call_user_func(UC_API_FUNC, 'friend', 'delete', array('uid'=>$uid, 'friendids'=>$friendids));
}

/**
 * ��������
 * @param int $uid		�û�ID
 * @return int
 */
function uc_friend_totalnum($uid, $direction = 0) {
	return call_user_func(UC_API_FUNC, 'friend', 'totalnum', array('uid'=>$uid, 'direction'=>$direction));
}

/**
 * �����б�
 *
 * @param int $uid		�û�ID
 * @param int $page		��ǰҳ
 * @param int $pagesize		ÿҳ��Ŀ��
 * @param int $totalnum		����
 * @param int $direction	Ĭ��Ϊ����. ����:1 , ����:2 , ˫��:3
 * @return array
 */
function uc_friend_ls($uid, $page = 1, $pagesize = 10, $totalnum = 10, $direction = 0) {
	$return = call_user_func(UC_API_FUNC, 'friend', 'ls', array('uid'=>$uid, 'page'=>$page, 'pagesize'=>$pagesize, 'totalnum'=>$totalnum, 'direction'=>$direction));
	return UC_CONNECT == 'mysql' ? $return : uc_unserialize($return);
}

/**
 * �û�ע��
 *
 * @param string $username 	�û���
 * @param string $password 	����
 * @param string $email		Email
 * @param int $questionid	��ȫ����
 * @param string $answer 	��ȫ���ʴ�
 * @return int
	-1 : �û���Ϸ�
	-2 : ������ע��Ĵ���
	-3 : �û����Ѿ�����
	-4 : email ��ʽ����
	-5 : email ������ע��
	-6 : �� email �Ѿ���ע��
	>1 : ��ʾ�ɹ�����ֵΪ UID
*/
function uc_user_register($username, $password, $email, $questionid = '', $answer = '') {
	return call_user_func(UC_API_FUNC, 'user', 'register', array('username'=>$username, 'password'=>$password, 'email'=>$email, 'questionid'=>$questionid, 'answer'=>$answer));
}

/**
 * �û���½���
 *
 * @param string $username	�û���/uid
 * @param string $password	����
 * @param int $isuid		�Ƿ�Ϊuid
 * @param int $checkques	�Ƿ�ʹ�ü�鰲ȫ�ʴ�
 * @param int $questionid	��ȫ����
 * @param string $answer 	��ȫ���ʴ�
 * @return array (uid/status, username, password, email)
 	�����һ��
 	1  : �ɹ�
	-1 : �û�������,���߱�ɾ��
	-2 : �����
*/
function uc_user_login($username, $password, $isuid = 0, $checkques = 0, $questionid = '', $answer = '') {
	$isuid = intval($isuid);
	$return = call_user_func(UC_API_FUNC, 'user', 'login', array('username'=>$username, 'password'=>$password, 'isuid'=>$isuid, 'checkques'=>$checkques, 'questionid'=>$questionid, 'answer'=>$answer));
	return UC_CONNECT == 'mysql' ? $return : uc_unserialize($return);
}

/**
 * ����ͬ����¼����
 *
 * @param int $uid		�û�ID
 * @return string 		HTML����
 */
function uc_user_synlogin($uid) {
	$uid = intval($uid);
	$return = uc_api_post('user', 'synlogin', array('uid'=>$uid));
	return $return;
}

/**
 * ����ͬ���ǳ�����
 *
 * @return string 		HTML����
 */
function uc_user_synlogout() {
	$return = uc_api_post('user', 'synlogout', array());
	return $return;
}

/**
 * �༭�û�
 *
 * @param string $username	�û���
 * @param string $oldpw		������
 * @param string $newpw		������
 * @param string $email		Email
 * @param int $ignoreoldpw 	�Ƿ���Ծ�����, ���Ծ�����, �򲻽��о�����У��.
 * @param int $questionid	��ȫ����
 * @param string $answer 	��ȫ���ʴ�
 * @return int
 	1  : �޸ĳɹ�
 	0  : û���κ��޸�
  	-1 : �����벻��ȷ
	-4 : email ��ʽ����
	-5 : email ������ע��
	-6 : �� email �Ѿ���ע��
	-7 : û�����κ��޸�
	-8 : �ܱ������û���û��Ȩ���޸�
*/
function uc_user_edit($username, $oldpw, $newpw, $email, $ignoreoldpw = 0, $questionid = '', $answer = '') {
	return call_user_func(UC_API_FUNC, 'user', 'edit', array('username'=>$username, 'oldpw'=>$oldpw, 'newpw'=>$newpw, 'email'=>$email, 'ignoreoldpw'=>$ignoreoldpw, 'questionid'=>$questionid, 'answer'=>$answer));
}

/**
 * ɾ���û�
 *
 * @param string/array $uid	�û��� UID
 * @return int
 	>0 : �ɹ�
 	0 : ʧ��
 */
function uc_user_delete($uid) {
	return call_user_func(UC_API_FUNC, 'user', 'delete', array('uid'=>$uid));
}

/**
 * ɾ���û�ͷ��
 *
 * @param string/array $uid	�û��� UID
 */
function uc_user_deleteavatar($uid) {
	uc_api_post('user', 'deleteavatar', array('uid'=>$uid));
}

/**
 * ����û����Ƿ�Ϊ�Ϸ�
 *
 * @param string $username	�û���
 * @return int
 	 1 : �Ϸ�
	-1 : �û���Ϸ�
	-2 : ��Ҫ����ע��Ĵ���
	-3 : �û����Ѿ�����
 */
function uc_user_checkname($username) {
	return call_user_func(UC_API_FUNC, 'user', 'check_username', array('username'=>$username));
}

/**
 * ���Email��ַ�Ƿ���ȷ
 *
 * @param string $email		Email
 * @return
 *  	1  : �ɹ�
 * 	-4 : email ��ʽ����
 * 	-5 : email ������ע��
 * 	-6 : �� email �Ѿ���ע��
 */
function uc_user_checkemail($email) {
	return call_user_func(UC_API_FUNC, 'user', 'check_email', array('email'=>$email));
}

/**
 * ��ӱ����û�
 *
 * @param string/array $username �����û���
 * @param string $admin    �����Ĺ���Ա
 * @return
 * 	-1 : ʧ��
 * 	 1 : �ɹ�
 */
function uc_user_addprotected($username, $admin='') {
	return call_user_func(UC_API_FUNC, 'user', 'addprotected', array('username'=>$username, 'admin'=>$admin));
}

/**
 * ɾ���û�
 *
 * @param string/array $username �����û���
 * @return
 * 	-1 : ʧ��
 * 	 1 : �ɹ�
 */
function uc_user_deleteprotected($username) {
	return call_user_func(UC_API_FUNC, 'user', 'deleteprotected', array('username'=>$username));
}

/**
 * �õ��ܱ������û����б�
 *
 * @param empty
 * @return
 * 	�ܵ��������û����б�
 *  	array()
 */
function uc_user_getprotected() {
	$return = call_user_func(UC_API_FUNC, 'user', 'getprotected', array('1'=>1));
	return UC_CONNECT == 'mysql' ? $return : uc_unserialize($return);
}

/**
 * ȡ���û����
 *
 * @param string $username	�û���
 * @param int $isuid	�Ƿ�ΪUID
 * @return array (uid, username, email)
 */
function uc_get_user($username, $isuid=0) {
	$return = call_user_func(UC_API_FUNC, 'user', 'get_user', array('username'=>$username, 'isuid'=>$isuid));
	return UC_CONNECT == 'mysql' ? $return : uc_unserialize($return);
}

/**
 * �û��ϲ����Ĵ���
 *
 * @param string $oldusername	���û���
 * @param string $newusername	���û���
 * @param string $uid		��UID
 * @param string $password	����
 * @param string $email		Email
 * @return int
	-1 : �û���Ϸ�
	-2 : ������ע��Ĵ���
	-3 : �û����Ѿ�����
	>1 : ��ʾ�ɹ�����ֵΪ UID
 */
function uc_user_merge($oldusername, $newusername, $uid, $password, $email) {
	return call_user_func(UC_API_FUNC, 'user', 'merge', array('oldusername'=>$oldusername, 'newusername'=>$newusername, 'uid'=>$uid, 'password'=>$password, 'email'=>$email));
}

/**
 * ��ȥ�ϲ��û���¼
 * @param string $username	�û���
 */
function uc_user_merge_remove($username) {
	return call_user_func(UC_API_FUNC, 'user', 'merge_remove', array('username'=>$username));
}

/**
 * ��ȡָ��Ӧ�õ�ָ���û����ֵ
 * @param int $appid	Ӧ��Id
 * @param int $uid	�û�Id
 * @param int $credit	��ֱ��
 */
function uc_user_getcredit($appid, $uid, $credit) {
	return call_user_func(UC_API_FUNC, 'user', 'getcredit', array('appid'=>$appid, 'uid'=>$uid, 'credit'=>$credit));
}

/**
 * �������Ϣ����
 *
 * @param int $uid	�û�ID
 * @param int $newpm	�Ƿ�ֱ�ӽ���newpm
 */
function uc_pm_location($uid, $newpm = 0) {
	$apiurl = uc_api_url('pm_client', 'ls', "uid=$uid", ($newpm ? '&folder=newbox' : ''));
	@header("Expires: 0");
	@header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
	@header("Pragma: no-cache");
	@header("location: $apiurl");
}

/**
 * ����¶���Ϣ
 *
 * @param  int $uid	�û�ID
 * @param  int $more	��ϸ��Ϣ
 * @return int	 	�Ƿ�����¶���Ϣ
 * 	2	��ϸ	(����Ϣ�����Ϣ�������Ϣʱ��, �����Ϣ����)
 * 	1	��	(����Ϣ�����Ϣ�������Ϣʱ��)
 * 	0	��
 */
function uc_pm_checknew($uid, $more = 0) {
	$return = call_user_func(UC_API_FUNC, 'pm', 'check_newpm', array('uid'=>$uid, 'more'=>$more));
	return (!$more || UC_CONNECT == 'mysql') ? $return : uc_unserialize($return);
}

/**
 * ���Ͷ���Ϣ
 *
 * @param int $fromuid		������uid 0 Ϊϵͳ��Ϣ
 * @param mix $msgto		�ռ��� uid/username ������ŷָ�
 * @param mix $subject		����
 * @param mix $message		����
 * @param int $instantly	�������� 1 ��������(Ĭ��)  0 �������Ϣ���ͽ���
 * @param int $replypid		�ظ�����ϢId
 * @param int $isusername	0 = $msgto Ϊ uid��1 = $msgto Ϊ username
 * @return
 * 	>1	���ͳɹ�������
 * 	0	�ռ��˲�����
 */
function uc_pm_send($fromuid, $msgto, $subject, $message, $instantly = 1, $replypmid = 0, $isusername = 0) {
	if($instantly) {
		$replypmid = @is_numeric($replypmid) ? $replypmid : 0;
		return call_user_func(UC_API_FUNC, 'pm', 'sendpm', array('fromuid'=>$fromuid, 'msgto'=>$msgto, 'subject'=>$subject, 'message'=>$message, 'replypmid'=>$replypmid, 'isusername'=>$isusername));
	} else {
		$fromuid = intval($fromuid);
		$subject = urlencode($subject);
		$msgto = urlencode($msgto);
		$message = urlencode($message);
		$replypmid = @is_numeric($replypmid) ? $replypmid : 0;
		$replyadd = $replypmid ? "&pmid=$replypmid&do=reply" : '';
		$apiurl = uc_api_url('pm_client', 'send', "uid=$fromuid", "&msgto=$msgto&subject=$subject&message=$message$replyadd");
		@header("Expires: 0");
		@header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
		@header("Pragma: no-cache");
		@header("location: ".$apiurl);
	}
}

/**
 * ɾ�����Ϣ
 *
 * @param int $uid		�û�Id
 * @param string $folder	�򿪵�Ŀ¼ inbox=�ռ��䣬outbox=������
 * @param array	$pmids		Ҫɾ�����ϢID����
 * @return
 * 	>0 �ɹ�
 * 	<=0 ʧ��
 */
function uc_pm_delete($uid, $folder, $pmids) {
	return call_user_func(UC_API_FUNC, 'pm', 'delete', array('uid'=>$uid, 'folder'=>$folder, 'pmids'=>$pmids));
}

/**
 * �����û�ɾ�����Ϣ
 *
 * @param int $uid		�û�Id
 * @param array	$uids		Ҫɾ�����Ϣ�û�ID����
 * @return
 * 	>0 �ɹ�
 * 	<=0 ʧ��
 */
function uc_pm_deleteuser($uid, $touids) {
	return call_user_func(UC_API_FUNC, 'pm', 'deleteuser', array('uid'=>$uid, 'touids'=>$touids));
}

/**
 * ����Ѷ�/δ��״̬
 *
 * @param int $uid		�û�Id
 * @param array	$uids		Ҫ����Ѷ�״̬���û�ID����
 * @param array	$pmids		Ҫ����Ѷ�״̬����ϢID����
 * @param int $status		1 �Ѷ� 0 δ��
 */
function uc_pm_readstatus($uid, $uids, $pmids = array(), $status = 0) {
	return call_user_func(UC_API_FUNC, 'pm', 'readstatus', array('uid'=>$uid, 'uids'=>$uids, 'pmids'=>$pmids, 'status'=>$status));
}

/**
 * ��ȡ����Ϣ�б�
 *
 * @param int $uid		�û�Id
 * @param int $page 		��ǰҳ
 * @param int $pagesize 	ÿҳ�����Ŀ��
 * @param string $folder	�򿪵�Ŀ¼ newbox=δ����Ϣ��inbox=�ռ��䣬outbox=������
 * @param string $filter	���˷�ʽ newpm=δ����Ϣ��systempm=ϵͳ��Ϣ��announcepm=������Ϣ
 				$folder		$filter
 				--------------------------
 				newbox
 				inbox		newpm
 						systempm
 						announcepm
 				outbox		newpm
 				searchbox	*
 * @param string $msglen 	��ȡ����Ϣ���ֳ���
 * @return array('count' => ��Ϣ����, 'data' => ����Ϣ���)
 */
function uc_pm_list($uid, $page = 1, $pagesize = 10, $folder = 'inbox', $filter = 'newpm', $msglen = 0) {
	$uid = intval($uid);
	$page = intval($page);
	$pagesize = intval($pagesize);
	$return = call_user_func(UC_API_FUNC, 'pm', 'ls', array('uid'=>$uid, 'page'=>$page, 'pagesize'=>$pagesize, 'folder'=>$folder, 'filter'=>$filter, 'msglen'=>$msglen));
	return UC_CONNECT == 'mysql' ? $return : uc_unserialize($return);
}

/**
 * ����δ����Ϣ��ʾ
 *
 * @param int $uid		�û�Id
 */
function uc_pm_ignore($uid) {
	$uid = intval($uid);
	return call_user_func(UC_API_FUNC, 'pm', 'ignore', array('uid'=>$uid));
}

/**
 * ��ȡ����Ϣ����
 *
 * @param int $uid		�û�Id
 * @param int $pmid		��ϢId
 * @param int $touid		��Ϣ�Է��û�Id
 * @param int $daterange	���ڷ�Χ 1=����,2=����,3=ǰ��,4=����,5=����
 * @return array() ����Ϣ��������
 */
function uc_pm_view($uid, $pmid, $touid = 0, $daterange = 1) {
	$uid = intval($uid);
	$touid = intval($touid);
	$pmid = @is_numeric($pmid) ? $pmid : 0;
	$return = call_user_func(UC_API_FUNC, 'pm', 'view', array('uid'=>$uid, 'pmid'=>$pmid, 'touid'=>$touid, 'daterange'=>$daterange));
	return UC_CONNECT == 'mysql' ? $return : uc_unserialize($return);
}

/**
 * ��ȡ��������Ϣ����
 *
 * @param int $uid		�û�Id
 * @param int $pmid		��ϢId
 * @param int $type		0 = ��ȡָ��������Ϣ
 				1 = ��ȡָ���û������������Ϣ
 				2 = ��ȡָ���û��յ��������Ϣ
 * @return array() ����Ϣ��������
 */
function uc_pm_viewnode($uid, $type = 0, $pmid = 0) {
	$uid = intval($uid);
	$pmid = @is_numeric($pmid) ? $pmid : 0;
	$return = call_user_func(UC_API_FUNC, 'pm', 'viewnode', array('uid'=>$uid, 'pmid'=>$pmid, 'type'=>$type));
	return UC_CONNECT == 'mysql' ? $return : uc_unserialize($return);
}

/**
 * ��ȡ����
 *
 * @param int $uid		�û�Id
 * @return string ��������
 */
function uc_pm_blackls_get($uid) {
	$uid = intval($uid);
	return call_user_func(UC_API_FUNC, 'pm', 'blackls_get', array('uid'=>$uid));
}

/**
 * ���ú���
 *
 * @param int $uid		�û�Id
 * @param int $blackls		��������
 */
function uc_pm_blackls_set($uid, $blackls) {
	$uid = intval($uid);
	return call_user_func(UC_API_FUNC, 'pm', 'blackls_set', array('uid'=>$uid, 'blackls'=>$blackls));
}

/**
 * ��Ӻ�����Ŀ
 *
 * @param int $uid		�û�Id
 * @param int $username		�û���
 */
function uc_pm_blackls_add($uid, $username) {
	$uid = intval($uid);
	return call_user_func(UC_API_FUNC, 'pm', 'blackls_add', array('uid'=>$uid, 'username'=>$username));
}

/**
 * ɾ�������Ŀ
 *
 * @param int $uid		�û�Id
 * @param int $username		�û���
 */
function uc_pm_blackls_delete($uid, $username) {
	$uid = intval($uid);
	return call_user_func(UC_API_FUNC, 'pm', 'blackls_delete', array('uid'=>$uid, 'username'=>$username));
}

/**
 * ��ȡ���������
 *
 * @return array()
 */
function uc_domain_ls() {
	$return = call_user_func(UC_API_FUNC, 'domain', 'ls', array('1'=>1));
	return UC_CONNECT == 'mysql' ? $return : uc_unserialize($return);
}

/**
 * ��ֶһ�����
 *
 * @param int $uid		�û�ID
 * @param int $from		ԭ���
 * @param int $to		Ŀ����
 * @param int $toappid		Ŀ��Ӧ��ID
 * @param int $amount		������
 * @return
 *  	1  : �ɹ�
 *	0  : ʧ��
 */
function uc_credit_exchange_request($uid, $from, $to, $toappid, $amount) {
	$uid = intval($uid);
	$from = intval($from);
	$toappid = intval($toappid);
	$to = intval($to);
	$amount = intval($amount);
	return uc_api_post('credit', 'request', array('uid'=>$uid, 'from'=>$from, 'to'=>$to, 'toappid'=>$toappid, 'amount'=>$amount));
}

/**
 * ����ָ�������TAG���
 *
 * @param string $tagname	TAG���
 * @param int $totalnum		������ݵ���Ŀ��
 * @return array() ���л�������飬��������Ϊ��ǰ������Ӧ�õ����TAG���
 */
function uc_tag_get($tagname, $nums = 0) {
	$return = call_user_func(UC_API_FUNC, 'tag', 'gettag', array('tagname'=>$tagname, 'nums'=>$nums));
	return UC_CONNECT == 'mysql' ? $return : uc_unserialize($return);
}

/**
 * �޸�ͷ��
 *
 * @param	int		$uid	�û�ID
 * @param	string	$type	ͷ������ real OR virtual Ĭ��Ϊ virtual
 * @return	string
 */
function uc_avatar($uid, $type = 'virtual', $returnhtml = 1) {
	$uid = intval($uid);
	$uc_input = uc_api_input("uid=$uid");
	$uc_avatarflash = UC_API.'/images/camera.swf?inajax=1&appid='.UC_APPID.'&input='.$uc_input.'&agent='.md5($_SERVER['HTTP_USER_AGENT']).'&ucapi='.urlencode(UC_API).'&avatartype='.$type;
	if($returnhtml) {
		return '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="447" height="477" id="mycamera" align="middle">
			<param name="allowScriptAccess" value="always" />
			<param name="scale" value="exactfit" />
			<param name="wmode" value="transparent" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="movie" value="'.$uc_avatarflash.'" />
			<param name="menu" value="false" />
			<embed src="'.$uc_avatarflash.'" quality="high" bgcolor="#ffffff" width="447" height="477" name="mycamera" align="middle" allowScriptAccess="always" allowFullScreen="false" scale="exactfit"  wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</object>';
	} else {
		return array(
			'width', '447',
			'height', '477',
			'scale', 'exactfit',
			'src', $uc_avatarflash,
			'id', 'mycamera',
			'name', 'mycamera',
			'quality','high',
			'bgcolor','#ffffff',
			'wmode','transparent',
			'menu', 'false',
			'swLiveConnect', 'true',
			'allowScriptAccess', 'always'
		);
	}
}

/**
 * �ʼ�����
 *
 * @param	string	$uids		�û���id������ö���(,)����
 * @param	string	$emails		�ʼ���ַ������ö��Ÿ���
 * @param	string	$subject	�ʼ�����
 * @param	string	$message	�ʼ�����
 * @param	string	$charset	�ʼ��ַ���ѡ����Ĭ��Ϊgbk
 * @param	boolean	$htmlon		�Ƿ�html��ʽ�����ʼ�����ѡ����Ĭ��Ϊ��
 * @param	integer $level		�ʼ����𣬿�ѡ����ȡֵ0-127��Ĭ��Ϊ1��Խ���͵����ȼ�Խ�ߣ�Ϊ0ʱ����⣬ֱ�ӷ��ͣ���Ӱ�쵱ǰ����ٶȣ�����
 * @return	integer
 *		=0 : ʧ��
 *		>0 : �ɹ������ز����¼��id������Ƕ����򷵻����һ����¼��id����level����0���򷵻�1
 */
function uc_mail_queue($uids, $emails, $subject, $message, $frommail = '', $charset = 'gbk', $htmlon = FALSE, $level = 1) {
	return call_user_func(UC_API_FUNC, 'mail', 'add', array('uids' => $uids, 'emails' => $emails, 'subject' => $subject, 'message' => $message, 'frommail' => $frommail, 'charset' => $charset, 'htmlon' => $htmlon, 'level' => $level));
}

/**
 * ����Ƿ����ָ��ͷ��
 * @param	integer		$uid	�û�id
 * @param	string		$size	ͷ��ߴ磬ȡֵ��Χ(big,middle,small)��Ĭ��Ϊ middle
 * @param	string		$type	ͷ�����ͣ�ȡֵ��Χ(virtual,real)��Ĭ��Ϊvirtual
 * @return	boolean
 *		true : ͷ�����
 *		false: ͷ�񲻴���
 */
function uc_check_avatar($uid, $size = 'middle', $type = 'virtual') {
	$url = UC_API."/avatar.php?uid=$uid&size=$size&type=$type&check_file_exists=1";
	$res = @file_get_contents($url);
	if($res == 1) {
		return 1;
	} else {
		return 0;
	}
}

/**
 * ���uc_server����ݿ�汾�ͳ���汾
 * @return mixd
 *		array('db' => 'xxx', 'file' => 'xxx');
 *		null �޷����õ��ӿ�
 *		string �ļ��汾����1.5
 */
function uc_check_version() {
	$return = uc_api_post('version', 'check', array());
	$data = uc_unserialize($return);
	return is_array($data) ? $data : $return;
}

?>