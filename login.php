<?php 
session_start();

require_once('includes/expense.php');
$expense = new Expense;
if(($_SERVER['REQUEST_METHOD']=='POST') && ($_POST['username']!="") && ($_POST['password']!="") )
{
	if( $expense->validUser($_POST['username'] , $_POST['password'] )==true)
	{
		$_SESSION['login']="ok";
		$_SESSION['username']=$_POST['username'];
		header("location:index.php");		
	}
	else
	{
		$invalid=true;
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no" />
<meta name="HandheldFriendly" content="True" />
<title><?php echo $_TITLE; ?></title>
<style type="text/css">
*{margin:0; padding:0;font-family:Arial, Helvetica, sans-serif;text-align:center}
h1{padding:10px 10px;font-size:14px; text-decoration:underline; color:#3c67c7}
h2{padding:10px 10px;font-size:14px; font-weight:bold; color:#f00;}
label{display:block; width:96%; margin:15px auto 3px auto;text-align:left;color:#636363 }
input{text-align:center;width:96%;height:40px;background-color:#e9e9e9;border:solid 1px #ccc;font-size:100%;outline:none;}
input[type=submit]{margin-top:25px;font-weight:bold;background-color:#3e3e3e;color:#fff;}
</style>
</head>
<body>
<?php include('header.php');?>
<?php if($invalid) echo'<h2> Invalid User !</h2>';?>
<?php
if(!preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
{
?>
<h2> Please view this page in mobile! </h2>

<?php } ?>
<form action="login.php" method="post" onSubmit=" return validate()">
<label for="username">User Name</label><input name="username" type="text" id="username"/>
    <label for="password">Password</label><input name="password" type="password"  id="password" />
  <input type="submit" name="login" id="login" value="Login">
</form>
<script type="text/javascript">
function validate()
{
  $username=document.getElementById('username').value;
  $password=document.getElementById('password').value;
  if($username=="") { alert("Please enter a username."); return false; }
  if($password=="") { alert("Please enter the password."); return false; }
}
</script>
</body>
</html>