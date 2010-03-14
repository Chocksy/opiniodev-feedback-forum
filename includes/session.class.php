<?php
class session
{
	static function add_param($name, $value)
	{
		//session_register($name);
		$_SESSION[$name] = $value;
		//session_write_close();
	}
	static function get_param($name)
	{
		if (isset($_SESSION[$name]))
		{
			return $_SESSION[$name];
		}
		else
		{
			return false;
		}
	}
 
	static function delete_param($name)
	{
		$_SESSION[$name] = "";
		//session_unregister($name);
	}
 
	static function destroy()
	{
		$_SESSION = array();
		session_destroy();
	}
 
	static function check()
	{
		if (config::session_timeout == 0)
		{
			return (isset($_SESSION['ss_fprint'])
			&& $_SESSION['ss_fprint'] == self::_Fingerprint() && ($_SERVER['HTTP_REFFERER'] != '' ? (strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) !== false ? true : false) : true));
		}
		else
		{
			$date = date('m/d/Y H:i');
			if (intval(strtotime($date)) < intval(self::get_param('timeout')))
			{
				self::add_param('timeout', intval(strtotime($date)) + (60*intval(config::session_timeout)));
				return (isset($_SESSION['ss_fprint'])
				&& $_SESSION['ss_fprint'] == self::_Fingerprint() && ($_SERVER['HTTP_REFFERER'] != '' ? (strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) !== false ? true : false) : true));
			}
			else
			{
				return false;
			}
		}
	}
 
	static function start_secure_session()
	{
		self::add_param('ss_fprint', self::_Fingerprint());
		self::_regenerate_id();
 
		if (config::session_timeout > 0)
		{
			$date = date('m/d/Y H:i');
			self::add_param('timeout', intval(strtotime($date)) + (60*intval(config::session_timeout)));
 
		}
	}
 
	private function _Fingerprint()
	{
		$fingerprint = config::session_salt;
		if (config::check_browser)
		{
			$fingerprint .= $_SERVER['HTTP_USER_AGENT'];
		}
		if (config::check_ip_blocks)
		{
			$num_blocks = abs(intval(config::check_ip_blocks));
			if ($num_blocks > 4)
			{
				$num_blocks = 4;
			}
			$blocks = explode('.', $_SERVER['REMOTE_ADDR']);
			for ($i=0; $i<$num_blocks; $i++)
			{
				$fingerprint .= $blocks[$i] . '.';
			}
		}
		self::_regenerate_id();
		return md5($fingerprint);
	}
 
	private static function _regenerate_id()
	{
		session_regenerate_id();
	}
}
?>