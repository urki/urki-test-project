<?php
//a small class for database connectivity
class database {
private $db_handle;
private $user_name;
private $password;
private $data_base;
private $host_name;
private $sql;
private $results;

function __construct($host = "localhost", $user, $passwd) {
$this->db_handle = mysql_connect($host, $user, $passwd);
}

function dbSelect($db) {
$this->data_base = $db;
if (!mysql_select_db($this->data_base, $this->db_handle)) {
error_log(mysql_error(), 3, "/phplog.err");
die("Error connecting to Database");
}
}

function executeSql($sql_stmt) {
$this->sql = $sql_stmt;
$this->result = mysql_query($this->sql);
}
function returnResults() {
return $this->result;
}
}

//database variables
$host = "localhost";
$user = "root";
$passwd = "";
$db = "test";
$sql = "SELECT * FROM persons ORDER BY id"; // a query to fetch records from database

$dbObject = new database($host, $user, $passwd);
$dbObject->dbSelect($db);
$dbObject->executeSql($sql);

$res = $dbObject->returnResults(); // result reasource

$newFileName = "NEW1_emp_names.csv"; //file name that you want to create
$fpWrite = fopen($newFileName, "w"); // open file as writable
$nameStr = "";

$rows = mysql_fetch_assoc($res); // fetching associate records

$sStr = "";

//first store the fields name as header of csv in $sStr
foreach($rows as $key=>$val) {
$sStr .= $key.";";
}

//then store all records
do {
$sStr .= "– —–\n"; //to seprate every record
foreach($rows as $key=>$row) {
$sStr .= $row.";";
}
}while($rows = mysql_fetch_assoc($res));

$sStrExp = explode("– —–", $sStr);//separate every record
foreach($sStrExp as $val) {
$sStr2 .= rtrim($val, ";");
}

echo $sStr2;

fwrite($fpWrite, $sStr2); //now write to csv file
fclose($fpWrite);//close file


/*header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="NEW1_emp_names.csv"');
readfile('NEW1_emp_names.csv');*/
?>



