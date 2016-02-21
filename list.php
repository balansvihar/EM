<?php
session_start();
if($_SESSION['login']!="ok") header("location:login.php");	
require_once('includes/expense.php');
$expense= new Expense;

if ($_SERVER['REQUEST_METHOD']=='POST')
{
	$datee = explode("-",$_POST['date']);
	$_POST['datee']= trim($datee[2]).'-'.trim($datee[1]).'-'.trim($datee[0]);
	$_GET['month']=trim($datee[1]);
	

	if($_POST['id']=="")	$expense->saveExp($_POST); else $expense->editExp($_POST);

}
if($_GET['act']=='del' && $_GET['idx']!='')
{
	$expense->deleteExp($_GET['idx']);
}

$_GET['month']=($_GET['month']=="")? $_GET['month']=date('m'):$_GET['month'];
$_GET['month']=str_pad($_GET['month'], 2, "0", STR_PlAD_LEFT);

?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no" />
<meta name="HandheldFriendly" content="True" />
<title><?php echo TITLE;?></title>
<link rel="stylesheet" type="text/css" href="css/default.css"/>
<style type="text/css">
*{margin:0; padding:0;font-family:Arial, Helvetica, sans-serif;text-align:center}
h1{padding:10px 10px;font-size:14px; text-decoration:underline; color:#3c67c7}
h2{padding:10px 10px;font-size:14px; font-weight:bold}
.addexp a{margin-bottom:25px; display:block; font-size:90%; color:#3c67c7;font-weight:bold; }
ul{list-style-type:none;margin-top:15px;}
li{width:99%; height:50px;padding-top:16px;outline:none;}
li a{text-decoration:none;outline:none;}
li:hover{background-color:#ffe9b4 !important;}
li:nth-child(odd){background-color:#eaeaea; border:solid 1px #cbcbcb}
.payee{width:65%; float:left; height:30px; color:#008103; font-weight:bold; font-size:90%; padding-top: 10px;}
.date{font-weight:bold; font-size:75%; color:#636363; height:25px; ; }
.income{color:#000 !important}
.amount{font-weight:bold; font-size:85%; color:#ff0000; ;}
.nav a{margin-top:25px; display:block; font-size:90%; color:#3c67c7;font-weight:bold; width:33%; float:left}
.norec{font-size:14px;}
select{width:98%; height:40px; font-size:100%; margin-top:15px; }
</style>
</head>
<body>
<?php include('header.php');?>
<h2>Total Expense : <?php if($_GET['month']!=0) echo  $expense->formatRs( $expense->getTotal($_GET['month'])); else echo  $expense->formatRs( $expense->getAllTotal());?> Rs</h2>
 <div class="addexp"><a href="index.php" >ADD EXPENSE</a></div>
<?php if($_GET['month']!=0) {?>
<ul>
<?php 
$rs=$expense->listExpense($_GET['month'],$_GET['page']);
while($row = mysql_fetch_array($rs))
{$rec++;
?>
 <li>
 	<a href="view.php?month=<?php echo $_GET['month'];?>&page=<?php echo $_GET['page'];?>&idx=<?php echo $row['id'];?>">
    	<div class="payee <?php if($row['type']=='income') echo 'income';?>"><?php echo $row['payee'];?><?php if($row['type']=='income') echo ' [Income]';?></div>
        <div class="date"><?php echo date("d-m-Y", strtotime($row['datee']));?></div>
        <div class="amount"><?php echo $expense->formatRs( $row['amount']);?> Rs</div>
    </a>
 </li>   
<?php } ?>

</ul>
<?php if($rec==0) {?>
<div class="norec">No Records Found.</div>
<?php }?>

<?php } else { ?>
<ul>
<?php for($i=1;$i<=12; $i++) {?>

 <li>
 	<a href="list.php?month=<?php echo $i;?>">
    <div class="payee"><?php echo $expense->GetMonthFullName($i);?></div><div class="amount"><?php echo  $expense->formatRs( $expense->getTotal($i)); ?> Rs</div>
 	</a>
 </li>

<?php } ?>
</ul>
<?php } ?>

<div class="nav">

    <a href="list.php?month=<?php echo $_GET['month'];?>&page=<?php echo $_GET['page']-1; ?>">
    	<?php if($_GET['page']!=0) echo '&lt;&lt;PREV'; ?>
    </a> 
    
    <a href="index.php">ADD EXPENSE</a>
    <a href="list.php?month=<?php echo $_GET['month'];?>&page=<?php echo $_GET['page']+1; ?>">
    	<?php if($expense->isNext($_GET['month'],$_GET['page'])) echo 'NEXT&gt;&gt;'; ?>
    </a>
</div>
<select name="month" onChange="window.location='list.php?month='+this.value">
 <option value="0">All</option>
  <option value="0" disabled >---</option>
<?php for($i=1;$i<=12; $i++) {?>
  <option value="<?php echo $i;?>" <?php if($_GET['month']==$i) echo 'selected="selected" '; ?>><?php echo $expense->GetMonthName($i);?></option>
<?php } ?>
</select>

</body>
</html>
