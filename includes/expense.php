<?php include('database.php');

class Expense extends Database 
{
function validUser($username,$password)
{
	$this->select("login","username='$username' AND password='$password'");
	if($username == $this->record['username']) 
		return true;
	else
		return false;
}
 function saveExp($rec)
 {
	 $this->record=$rec;
	 $this->record['payee']=ucwords($this->record['payee']) ;
	 $this->record['username']=$_SESSION['username'];
	 $this->save('expense');
	 return mysql_insert_id();
 }
 function editExp($rec)
 {
	 $this->record=$rec;
	 $this->record['payee']=ucwords($this->record['payee']) ;
	 $this->record['username']=$_SESSION['username'];
	 $this->update('expense',"id='$rec[id]'");
	 return mysql_insert_id();
 }
 function formatDate($mysqldate)
 {
	$strtime = strtotime($mysqldate);
	return date("d - m - Y", $strtime);

 }
 
 function listExpense($month,$page)
 {
	
	$listno= MAXITEM;
	$page=$listno * $page;
	$month=($month=="") ? '1' : $month ;
	$month=str_pad($month, 2, "0", STR_PlAD_LEFT);
	
	$page=($page=="") ? '0' : $page ;

	return  $this->selectAll("expense", "MONTH(datee) = '$month' AND username='$_SESSION[username]' ORDER BY datee DESC LIMIT $page , $listno");

 }
 function getDetails($idx)
 {
	$this->select("expense","id=$idx AND username='$_SESSION[username]'");
 	return $this->record;
 }
function formatRs($amount)
{
	$amount=strrev($amount);
	for($i=0;$i<=strlen($amount);$i++)
	{
		$rs.=(substr($amount, $i,1));
		if($cnt==2 && $i!==strlen($amount) && strlen($amount)!=($i+1))
		{
			$rs.=','; 
			$cnt=0; 
		}
		
	 $cnt++;
	}
	return strrev($rs);
}
 function getTotal($month)
 {
	$amount=$this->sumcol("expense","amount","MONTH(datee) = '$month'  AND username='$_SESSION[username]' AND type='expense' ");

	return intval($amount);
 }
 function getIncomeTotal($month)
 {
	$amount=$this->sumcol("expense","amount","MONTH(datee) = '$month'  AND username='$_SESSION[username]' AND type='income' ");

	return intval($amount);
 }
 function getAllTotal()
 {
	$amount=$this->sumcol("expense","amount","username='$_SESSION[username]' AND type='expense' ");

	return $this->formatRs(intval($amount));
 }
 function deleteExp($idx)
 {
	 $this->delete("expense","id=$idx  AND username='$_SESSION[username]' ");
 }
 function GetMonthName($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);
    return date("M", $timestamp);
}
 
 function GetMonthFullName($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);
    return date("F", $timestamp);
}
 
 function isNext($month,$page)
 {	
	 $recount=$this->recCount('expense',"MONTH(datee) = '$month' AND username='$_SESSION[username]'  AND type='expense' ");
	 return ((floor($recount/MAXITEM)-$page));
 }
}/*

$str="02-11-2011";
echo date("d-m-Y", strtotime($str));
*/
?>