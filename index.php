<?php 
session_start();
if($_SESSION['login']!="ok") header("location:login.php");	
require_once('includes/expense.php');
$expense = new Expense;
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
h2{padding:10px 10px;font-size:14px; font-weight:bold}
label{display:block; width:96%; margin:15px auto 3px auto;text-align:left;color:#636363 }
input,select{ width:96%;height:40px;background-color:#e9e9e9;border:solid 1px #ccc;font-size:100%;outline:none;}
input[type=text]{text-transform:capitalize;}
input[type=submit],input[type=button]{margin-top:25px;font-weight:bold;background-color:#3e3e3e;color:#fff;}
</style>
</head>
<body>
<?php include('header.php');?>

<h2>  <?php echo $expense->GetMonthName( date("m"));?>. Total Expense : <?php echo  $expense->formatRs( $expense->getTotal (date("m"))); ?> Rs</h2>
<form action="list.php" method="post" onSubmit=" return validate()">
	<label for="date">Date</label><input type="date" name="date" id="date" value="<?php echo date("d - m - Y"); ?>"/>
    <label for="type">Type</label>
    <select name="type">
    	<option value="expense" selected >Expense</option>
        <option value="income" >Income</option>
     </select>
	<label for="payee">Payee</label><input name="payee" type="text"  id="payee" />
	<label for="amount">Amount</label><input type="tel" name="amount" id="amount"/>
    <input type="submit" name="save" id="save" value="SAVE">
    <a href="list.php"><input type="button" name="list" id="list" value="LIST"></a>
</form>
<script type="text/javascript">
function validate()
{
  $date=document.getElementById('date').value;
  $payee=document.getElementById('payee').value;
  $amount=document.getElementById('amount').value;
  if($date=="") { alert("Please enter a date."); return false; }
  if($payee=="") { alert("Please enter the payee."); return false; }
  if(int($amount)==0) { alert("Please enter the amount."); return false; }
}
</script>
</body>
</html>