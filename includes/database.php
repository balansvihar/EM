<?php
require_once("config.php");
class Database{
	
	private $connection;
	public $last_query;
	public $record;
	function __construct() {
		putenv("TZ=Asia/Calcutta");
    	$this->open();
		
  }

	public function open() {
		$this->connection = mysql_connect(DB_HOST, DB_USER, DB_PASS)or die("Database connection failed: ". mysql_error());
		mysql_select_db(DB_NAME, $this->connection) or die("Database selection failed: ". mysql_error());
	}

	public function close() {
		if(isset($this->connection)) {
			mysql_close($this->connection);
			unset($this->connection);
		}
	}

	public function query($sql) {
		$this->last_query = $sql;
		$result = mysql_query($sql, $this->connection)or die( "Database query failed: ".$sql." " . mysql_error() );
		return $result;
	}
	
   public function select($table, $where = null, $order = null, $rows = '*'){
	  $sql = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
            $sql .= ' WHERE '.$where;
        if($order != null)
            $sql .= ' ORDER BY '.$order;
			if (DEBUG) echo $sql;
	  $rs = $this->query($sql);
	  $row = mysql_fetch_array($rs);
 	  $feilds = $this->query("show columns from $table");
		while($feild_row = mysql_fetch_array($feilds)){
			$tmpvar= $feild_row['Field'];
			$this->record[$tmpvar]=$row[$tmpvar];

		}
  }
  
     public function selectAll($table, $where = null, $order = null, $rows = '*'){
	  $sql = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
            $sql .= ' WHERE '.$where;
        if($order != null)
            $sql .= ' ORDER BY '.$order;
			if (DEBUG) echo $sql;
	  $rs = $this->query($sql);
	 // $row = mysql_fetch_array($rs);
      return $rs;
		
  }
	
   public function save($table)  {
 	  $feilds = $this->query("show columns from $table");
	  $sql="INSERT INTO $table ( ";
		while($feild_row = mysql_fetch_array($feilds)){
			$fld= $feild_row['Field'];
			$sql.="`$fld` ,";
		} 
		$sql=substr($sql,0,strlen($sql)-3);
		$sql.="`) VALUES (";
		$feilds = $this->query("show columns from $table");
		while($feild_row = mysql_fetch_array($feilds)){
			$tmpvar= $feild_row['Field'];
			$val=safe($this->record[$tmpvar]);
			$sql.="'$val' ,";
		}  
		$sql=substr($sql,0,strlen($sql)-2);
		$sql.=" )";
  		if (DEBUG) echo $sql;
		return $this->query($sql);
}


   public function update($table,$where)  {

	  $feilds = $this->query("show columns from $table");
	  $sql="UPDATE $table SET   ";
		while($feild_row = mysql_fetch_array($feilds)){
			$fld= $feild_row['Field'];

			if ($this->record[$fld]!="")
			    $sql.="`$fld` = '". safe($this->record[$fld]) . "', " ;
			
		} 
		$sql=substr($sql,0,strlen($sql)-2);
		$sql.=" WHERE $where";
		if (DEBUG) echo $sql;
		return $this->query($sql);

}
	
   public function delete($table,$where)  {
	   $value=safe($value);
	   $sql="DELETE FROM $table WHERE $where";
	   if (DEBUG) echo $sql;
	return $this->query($sql);
	   
}
	public function sumcol($table,$feild,$where=""){
	 $sql= ($where=="") ? "SELECT SUM($feild) FROM $table" : "SELECT SUM($feild) FROM $table WHERE $where"; 
	  $rs = $this->query($sql);
	  $row = mysql_fetch_array($rs);
	  if (DEBUG) echo $sql;
	  return $row["SUM($feild)"];
	}
	
	public function recCount($table,$where=""){
	 $sql= ($where=="") ? "SELECT * FROM $table" : "SELECT * FROM $table WHERE $where"; 
	  $rs = $this->query($sql);
	  return mysql_num_rows($rs);
	}

  public function clear()
  {
	unset($this->record);
  }
}// End Class Database

function safe($sql) {
 return addslashes($sql);
}


/*

$db= new Database;
$rs = $db->query("SELECT * FROM tab");
while($row = mysql_fetch_array($rs))
{
 echo $row['name']."<br>";
}

*/

/*
 $db=new Database;
 $db->select("users","userid","balan@capeconsultancy.com");
 echo $db->record['email'];

 
  */
  
/*$db=new Database;
$db->select("users","userid='balan@capeconsultancy.com'");
echo $db->record['name'];*/
?>