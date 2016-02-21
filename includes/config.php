<?php 
if (defined('DB_HOST')) return; 
if ($_SERVER['HTTP_HOST']=="www.cognitos.in"||$_SERVER['HTTP_HOST']=="cognitos.in")
{
	define('DB_HOST','balan.db.8154292.hostedresource.com');
	define('DB_NAME','balan');
	define('DB_USER','balan');
	define('DB_PASS','Open*this10');
	define('ONLINE','1');
	define('DEBUG','0');
}
else if ($_SERVER['HTTP_HOST']=="www.balsoft.in"||$_SERVER['HTTP_HOST']=="balsoft.in")
{
	define('DB_HOST','localhost');
	define('DB_NAME','balsofti_balsoft');
	define('DB_USER','balsofti_balan');
	define('DB_PASS','openthis');
	define('ONLINE','1');
	define('DEBUG','0');
}
else if($_SERVER['HTTP_HOST']=="192.168.1.3")
{
	define('DB_HOST','localhost');
	define('DB_NAME','expense');
	define('DB_USER','root');
	define('DB_PASS','openthis');
	define('ONLINE','0');
	define('DEBUG',false);

}
else
{
	define('DB_HOST','localhost');
	define('DB_NAME','expense');
	define('DB_USER','root');
	define('DB_PASS','');
	define('ONLINE','0');
	define('DEBUG','0');

}

//echo DB_HOST."<br>".DB_NAME."<br>".DB_USER."<br>".DB_PASS;

define('TITLE','EXPENSE MANAGER');
define('MAXITEM','15');
putenv("TZ=Asia/Calcutta");
?>
