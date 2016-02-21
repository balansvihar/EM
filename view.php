<?php 
session_start();
if($_SESSION['login']!="ok") header("location:login.php");	
if($_GET['idx']=="") header("location:index.php");
	require_once('includes/expense.php');
	$expense= new Expense;
	$exp=$expense->getDetails($_GET['idx']);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no" />
<meta name="HandheldFriendly" content="True" />
<title><?php echo $_TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="css/default.css"/>
<style type="text/css">
*{margin:0; padding:0;font-family:Arial, Helvetica, sans-serif;text-align:center}
h1{padding:10px 10px;font-size:14px; text-decoration:underline; color:#3c67c7}
h2{padding:10px 10px;font-size:14px; font-weight:bold}
ul{list-style-type:none;margin-top:15px;border: 1px solid #cbcbcb; width:75%; margin:auto; background-color:#eaeaea;}
li{margin:20px 20px;font-weight:bold;font-size:85%;}
input[type=button]{width:96%; height:40px; border:solid 1px #ccc;font-size:100%;margin-top:25px;font-weight:bold;background-color:#3e3e3e;color:#fff;}
.payee{color:#008103}
.date{color:#636363}
.amount{color:#ff0000}
.delete{margin:20px 20px;font-weight:bold;font-size:85%;color:#ff6000}
.delete a{}
</style>
</head>
<body>
<?php include('header.php');?>
<?php 
$tinc=$expense->getIncomeTotal($_GET['month']);
$texp=$expense->getTotal($_GET['month']);
?>

<h2> <?php echo $expense->GetMonthName($_GET['month']);?>. Total Income : <?php echo  $expense->formatRs( $tinc); ?> Rs</h2>
<h2> <?php echo $expense->GetMonthName($_GET['month']);?>. Total Expense : <?php echo  $expense->formatRs( $texp);?> Rs</h2>
<h2> <?php echo $expense->GetMonthName($_GET['month']);?>. Balance Amount : <?php echo  $expense->formatRs( $tinc-$texp);?> Rs</h2>
<ul>
 <li class="payee">Payee : <?php echo $exp['payee'];?></li>
 <li class="amount">Amount : <?php echo  $expense->formatRs( $exp['amount']);?> Rs</li>
 <li class="date">Date : <?php echo $exp['datee'];?></li>
</ul>
<a href="list.php?month=<?php echo $_GET['month'];?>&page=<?php echo intval( $_GET['page'])+0;?>"><input type="button" name="back" value="BACK"></a>
<a href="edit.php?idx=<?php echo $_GET['idx'];?>&month=<?php echo $_GET['month'];?>&page=<?php echo intval( $_GET['page'])+0;?>"><input type="button" name="back" value="EDIT"></a>
<div class="delete" onClick="cfm()">DELETE</div>
<script type="text/javascript">
function cfm(){ if (confirm("Are you you want to delete?")) window.location="list.php?act=del&page=<?php echo intval( $_GET['page'])+0;?>&idx=<?php echo $_GET['idx'];?>";}
</script>
</body>
</html>