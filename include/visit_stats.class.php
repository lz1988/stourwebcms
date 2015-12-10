<?php
if(!defined('SLINEINC')) exit("Request Error!");

class Visit_Stats
{
	var $php_self;
	
	var $referrer;

    var $title;
	
	function __construct($referrer, $php_self,$title)
	{
		$this->php_self = $php_self;
		
		$pos = strpos($this->php_self, '/', 9);
		
		$this->php_self = substr($this->php_self, $pos);
		
		$this->referrer = $referrer;

        $this->title = $title;
		
		//$this->Visit();
	}
	
	
	/**
	 * 统计访问信息
	 *
	 * @access  public
	 * @return  void
	 */
	public function Visit()
	{
		/*是否开启统计(功能关闭状态)
		if (isset($GLOBALS['visit_stats']) && $GLOBALS['visit_stats'] == 'off')
		{
			return;
		}*/
		$time = time();
		/* 检查客户端是否存在访问统计的cookie */
		$visit_times = (!empty($_COOKIE['ST']['visit_times'])) ? intval($_COOKIE['ST']['visit_times']) + 1 : 1;
		setcookie('ST[visit_times]', $visit_times, $time + 86400 * 365, '/');
	
		$browser  = $this->get_user_browser();
		$os       = $this->get_os();
		$ip       = $this->real_ip();
	
		/* 语言 */
		if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		{
			$pos  = strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], ';');
			$lang = addslashes(($pos !== false) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, $pos) : $_SERVER['HTTP_ACCEPT_LANGUAGE']);
		}
		else
		{
			$lang = '';
		}
	
		/* 来源 */
		if (!empty($this->referrer) && strlen($this->referrer) > 9)
		{
			$pos = strpos($this->referrer, '/', 9);
			if ($pos !== false)
			{
				$domain = substr($this->referrer, 0, $pos);
				$path   = substr($this->referrer, $pos);
	
				/* 来源关键字 */
				if (!empty($domain) && !empty($path))
				{
					$keyword = $this->save_searchengine_keyword($domain, $path);
				}
			}
			else
			{
				$domain = $path = '';
			}
		}
		else
		{
			$domain = $path = '';
		}
		
		$Y = date("Y");	
		$M = date("n") < 10 ? "0" . date("n") : date("n");	
		$D = date("j") < 10 ? "0" . date("j") : date("j");	
		$mark = $Y . $M . $D;
		
		//if(!empty($keyword['keywords']))
		//{
			if($this->check_keyword($keyword['searchengine'],$keyword['keywords'],$domain,$path,$this->title))
			{
				$sql = "UPDATE #@__stats SET keynum=keynum+1 where searchengine='$keyword[searchengine]' and keywords='$keyword[keywords]'" . 
				       " and referer_domain='$domain' and referer_path='$path' and webid='0' and timemark='$mark' and title='{$this->title}'";
			}
			else
			{
				$sql = 'INSERT INTO #@__stats ( ' .
							'ip_address, visit_times, browser, system, language, ' .
							'referer_domain, referer_path, access_url, access_time, timemark, searchengine, keywords, keynum, webid,title' .
						') VALUES (' .
							"'$ip', '$visit_times', '$browser', '$os', '$lang', ".
							"'" . addslashes($domain) ."', '" . addslashes($path) ."', '" . addslashes($this->php_self) ."', '" . $time . "', '$mark', '" . 
							$keyword['searchengine'] . "', '" . $keyword['keywords'] . "', '1','0','".$this->title."')";
			}
			$GLOBALS['dsql']->ExecuteNoneQuery($sql);
			//return "ok";
		//}
	}
	
	private function check_keyword($searchengine,$keywords,$referer_domain,$referer_path,$title)
	{
		$Y = date("Y");	
		$M = date("n") < 10 ? "0" . date("n") : date("n");	
		$D = date("j") < 10 ? "0" . date("j") : date("j");	
		$mark = $Y . $M . $D;
		$flag = false;
		$sql = "SELECT 1 FROM #@__stats where searchengine='$searchengine' and keywords='$keywords' and" . 
		       " referer_path='$referer_path' and referer_domain='$referer_domain' and webid='0' and timemark='$mark' and title='$title' limit 1";
		$row = $GLOBALS['dsql']->ExecuteNoneQuery2($sql);
		if($row)
		{
			$flag = true;
		}
		return $flag;
	}
	
	/**
	 * 返回搜索引擎关键字
	 *
	 * @access  public
	 * @return  void
	 */
	private function save_searchengine_keyword($domain, $path)
	{
		$arr = array();
		if (strpos($domain, 'google.com.tw') !== false && preg_match('/q=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'GOOGLE TAIWAN';
			$keywords = urldecode($regs[1]); // google taiwan
		}
		if (strpos($domain, 'google.cn') !== false && preg_match('/q=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'GOOGLE CHINA';
			$keywords = urldecode($regs[1]); // google china
		}
		if (strpos($domain, 'google.com') !== false && preg_match('/q=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'GOOGLE';
			$keywords = urldecode($regs[1]); // google
		}
		elseif (strpos($domain, 'baidu.') !== false && preg_match('/wd=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'BAIDU';
			$keywords = urldecode($regs[1]); // baidu
		}
		elseif (strpos($domain, 'baidu.') !== false && preg_match('/word=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'BAIDU';
			$keywords = urldecode($regs[1]); // baidu
		}
		elseif (strpos($domain, '360.cn') !== false && preg_match('/q=([^&]*)/i', $path, $regs))
		{
			$searchengine = '360SO';
			$keywords = urldecode($regs[1]); // 360
		}
		elseif (strpos($domain, '114.vnet.cn') !== false && preg_match('/kw=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'CT114';
			$keywords = urldecode($regs[1]); // ct114
		}
		elseif (strpos($domain, 'iask.com') !== false && preg_match('/k=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'IASK';
			$keywords = urldecode($regs[1]); // iask
		}
		elseif (strpos($domain, 'soso.com') !== false && preg_match('/w=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'SOSO';
			$keywords = urldecode($regs[1]); // soso
			$keywords = iconv('GB2312', 'UTF-8', $keywords);
		}
		elseif (strpos($domain, 'sogou.com') !== false && preg_match('/query=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'SOGOU';
			$keywords = urldecode($regs[1]); // sogou
			$keywords = iconv('GB2312', 'UTF-8', $keywords);
		}
		elseif (strpos($domain, 'so.163.com') !== false && preg_match('/q=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'NETEASE';
			$keywords = urldecode($regs[1]); // netease
		}
		elseif (strpos($domain, 'yodao.com') !== false && preg_match('/q=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'YODAO';
			$keywords = urldecode($regs[1]); // yodao
		}
		elseif (strpos($domain, 'zhongsou.com') !== false && preg_match('/word=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'ZHONGSOU';
			$keywords = urldecode($regs[1]); // zhongsou
		}
		elseif (strpos($domain, 'search.tom.com') !== false && preg_match('/w=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'TOM';
			$keywords = urldecode($regs[1]); // tom
		}
		elseif (strpos($domain, 'live.com') !== false && preg_match('/q=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'MSLIVE';
			$keywords = urldecode($regs[1]); // MSLIVE
		}
		elseif (strpos($domain, 'tw.search.yahoo.com') !== false && preg_match('/p=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'YAHOO TAIWAN';
			$keywords = urldecode($regs[1]); // yahoo taiwan
		}
		elseif (strpos($domain, 'cn.yahoo.') !== false && preg_match('/p=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'YAHOO CHINA';
			$keywords = urldecode($regs[1]); // yahoo china
		}
		elseif (strpos($domain, 'yahoo.') !== false && preg_match('/p=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'YAHOO';
			$keywords = urldecode($regs[1]); // yahoo
		}
		elseif (strpos($domain, 'msn.com.tw') !== false && preg_match('/q=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'MSN TAIWAN';
			$keywords = urldecode($regs[1]); // msn taiwan
		}
		elseif (strpos($domain, 'msn.com.cn') !== false && preg_match('/q=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'MSN CHINA';
			$keywords = urldecode($regs[1]); // msn china
		}
		elseif (strpos($domain, 'msn.com') !== false && preg_match('/q=([^&]*)/i', $path, $regs))
		{
			$searchengine = 'MSN';
			$keywords = urldecode($regs[1]); // msn
		}
		elseif($domain == $GLOBALS['cfg_basehost'])
		{
			$searchengine = 'INNER'; //内链
			$keywords = ''; // 内链
		}
		else
		{
			$searchengine = 'OTHER'; //外链
			$keywords = ''; // 外链
		}
		
		/*此方法暂弃
		$gb_search = array('YAHOO CHINA', 
						   'TOM', 
						   'ZHONGSOU', 
						   'NETEASE', 
						   'SOGOU', 
						   'SOSO', 
						   'IASK', 
						   'CT114', 
						   'BAIDU', 
						   'OTHER', 
						   'GOOGLE CHINA', 
						   'GOOGLE',
						   'YAHOO',
						   'YODAO');
		*/
		//if (in_array($searchengine, $gb_search))
		//{
			//$keywords = iconv('GBK', 'UTF8', $keywords);
			$arr['searchengine'] = $searchengine;
			$arr['keywords'] = $keywords;
		//}
		return $arr;
	}
	
	
	/**
	 * 获得浏览器名称和版本
	 *
	 * @access  public
	 * @return  string
	 */
	private function get_user_browser()
	{
		if (empty($_SERVER['HTTP_USER_AGENT']))
		{
			return '';
		}
	
		$agent       = $_SERVER['HTTP_USER_AGENT'];
		$browser     = '';
		$browser_ver = '';
	
		if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs))
		{
			$browser     = 'Internet Explorer';
			$browser_ver = $regs[1];
		}
		elseif (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs))
		{
			$browser     = 'FireFox';
			$browser_ver = $regs[1];
		}
		elseif (preg_match('/Maxthon/i', $agent, $regs))
		{
			$browser     = '(Internet Explorer ' .$browser_ver. ') Maxthon';
			$browser_ver = '';
		}
		elseif (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs))
		{
			$browser     = 'Opera';
			$browser_ver = $regs[1];
		}
		elseif (preg_match('/OmniWeb\/(v*)([^\s|;]+)/i', $agent, $regs))
		{
			$browser     = 'OmniWeb';
			$browser_ver = $regs[2];
		}
		elseif (preg_match('/Netscape([\d]*)\/([^\s]+)/i', $agent, $regs))
		{
			$browser     = 'Netscape';
			$browser_ver = $regs[2];
		}
		elseif (preg_match('/safari\/([^\s]+)/i', $agent, $regs))
		{
			$browser     = 'Safari';
			$browser_ver = $regs[1];
		}
		elseif (preg_match('/NetCaptor\s([^\s|;]+)/i', $agent, $regs))
		{
			$browser     = '(Internet Explorer ' .$browser_ver. ') NetCaptor';
			$browser_ver = $regs[1];
		}
		elseif (preg_match('/Lynx\/([^\s]+)/i', $agent, $regs))
		{
			$browser     = 'Lynx';
			$browser_ver = $regs[1];
		}
	
		if (!empty($browser))
		{
		   return addslashes($browser . ' ' . $browser_ver);
		}
		else
		{
			return 'Unknow browser';
		}
	}
	
	/**
	 * 获得客户端的操作系统
	 *
	 * @access  private
	 * @return  void
	 */
	private function get_os()
	{
		if (empty($_SERVER['HTTP_USER_AGENT']))
		{
			return 'Unknown';
		}
	
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		$os    = '';
	
		if (strpos($agent, 'win') !== false)
		{
			if (strpos($agent, 'nt 5.1') !== false)
			{
				$os = 'Windows XP';
			}
			elseif (strpos($agent, 'nt 5.2') !== false)
			{
				$os = 'Windows 2003';
			}
			elseif (strpos($agent, 'nt 5.0') !== false)
			{
				$os = 'Windows 2000';
			}
			elseif (strpos($agent, 'nt 6.0') !== false)
			{
				$os = 'Windows Vista';
			}
			elseif (strpos($agent, 'nt') !== false)
			{
				$os = 'Windows NT';
			}
			elseif (strpos($agent, 'win 9x') !== false && strpos($agent, '4.90') !== false)
			{
				$os = 'Windows ME';
			}
			elseif (strpos($agent, '98') !== false)
			{
				$os = 'Windows 98';
			}
			elseif (strpos($agent, '95') !== false)
			{
				$os = 'Windows 95';
			}
			elseif (strpos($agent, '32') !== false)
			{
				$os = 'Windows 32';
			}
			elseif (strpos($agent, 'ce') !== false)
			{
				$os = 'Windows CE';
			}
		}
		elseif (strpos($agent, 'linux') !== false)
		{
			$os = 'Linux';
		}
		elseif (strpos($agent, 'unix') !== false)
		{
			$os = 'Unix';
		}
		elseif (strpos($agent, 'sun') !== false && strpos($agent, 'os') !== false)
		{
			$os = 'SunOS';
		}
		elseif (strpos($agent, 'ibm') !== false && strpos($agent, 'os') !== false)
		{
			$os = 'IBM OS/2';
		}
		elseif (strpos($agent, 'mac') !== false && strpos($agent, 'pc') !== false)
		{
			$os = 'Macintosh';
		}
		elseif (strpos($agent, 'powerpc') !== false)
		{
			$os = 'PowerPC';
		}
		elseif (strpos($agent, 'aix') !== false)
		{
			$os = 'AIX';
		}
		elseif (strpos($agent, 'hpux') !== false)
		{
			$os = 'HPUX';
		}
		elseif (strpos($agent, 'netbsd') !== false)
		{
			$os = 'NetBSD';
		}
		elseif (strpos($agent, 'bsd') !== false)
		{
			$os = 'BSD';
		}
		elseif (strpos($agent, 'osf1') !== false)
		{
			$os = 'OSF1';
		}
		elseif (strpos($agent, 'irix') !== false)
		{
			$os = 'IRIX';
		}
		elseif (strpos($agent, 'freebsd') !== false)
		{
			$os = 'FreeBSD';
		}
		elseif (strpos($agent, 'teleport') !== false)
		{
			$os = 'teleport';
		}
		elseif (strpos($agent, 'flashget') !== false)
		{
			$os = 'flashget';
		}
		elseif (strpos($agent, 'webzip') !== false)
		{
			$os = 'webzip';
		}
		elseif (strpos($agent, 'offline') !== false)
		{
			$os = 'offline';
		}
		else
		{
			$os = 'Unknown';
		}
	
		return $os;
	}
	
	
	/**
	 * 获得用户的真实IP地址
	 *
	 * @access  public
	 * @return  string
	 */
	private function real_ip()
	{
		static $realip = NULL;
	
		if ($realip !== NULL)
		{
			return $realip;
		}
	
		if (isset($_SERVER))
		{
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
	
				/* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
				foreach ($arr AS $ip)
				{
					$ip = trim($ip);
	
					if ($ip != 'unknown')
					{
						$realip = $ip;
	
						break;
					}
				}
			}
			elseif (isset($_SERVER['HTTP_CLIENT_IP']))
			{
				$realip = $_SERVER['HTTP_CLIENT_IP'];
			}
			else
			{
				if (isset($_SERVER['REMOTE_ADDR']))
				{
					$realip = $_SERVER['REMOTE_ADDR'];
				}
				else
				{
					$realip = '0.0.0.0';
				}
			}
		}
		else
		{
			if (getenv('HTTP_X_FORWARDED_FOR'))
			{
				$realip = getenv('HTTP_X_FORWARDED_FOR');
			}
			elseif (getenv('HTTP_CLIENT_IP'))
			{
				$realip = getenv('HTTP_CLIENT_IP');
			}
			else
			{
				$realip = getenv('REMOTE_ADDR');
			}
		}
	
		preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
		$realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
	
		return $realip;
	}
}
?>