<?php


class Session
{
	
	public static function int()
	{
		if (version_compare(phpversion(), '5.4.0','<')) 
		{
			if (session_id()=='') {
				session_start();
			}
		}
		else
		{
			if (session_status()==PHP_SESSION_NONE) {
				session_start();
			}
		}
	}

	public static function set($key,$val)
	{
		$_SESSION[$key]=$val;

	}
	public static function get($key)
	{
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
		else
			return false;

	}


	public static function checksession()
	{
		if (self::get("login")==false) {
			self::destroy();
			header("Location:login.php");
		}
	}
	public static function checklogin()
	{
		if (self::get("login")==true) {
		
			header("Location:index.php");
		}
	}

	public static function destroy()
	{
		session_destroy();
		session_unset();
		header("Location:login.php");
	}





}

?>