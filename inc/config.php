<?php
require_once 'Zend/Db/Adapter/Pdo/Mysql.php';
require_once 'Zend/Auth/Adapter/DbTable.php';
require_once 'Zend/Db.php';
require_once 'Zend/Auth.php';
require_once 'template.php';
require_once 'html_functions.php';
require_once 'render.php';
require_once 'date.php';
require_once 'string.php';


// Include DAL class for querys
require_once(__DIR__.'/class/DAL.php');
require_once(__DIR__.'/class/myClasses.php');
  
$time= new myClasses();
$dal=new DAL();


   // require_once 'local.php';
$db = Zend_Db::factory('Mysqli', array(
	//'host'     => '127.0.0.1',
        'host'     => 'localhost',
	'username' => 'root',
	'password' => 'uR34Ga87',
	'dbname'   => 'intranet'
	));


$db->query('SET NAMES \'utf8\'');



$auth = Zend_Auth::getInstance(); 
if ($auth->hasIdentity()) { 
	// Identity exists; get it

	$identity = $auth->getIdentity(); 
	$sql = "SELECT id_role,id_person,unit FROM persons where username='$identity'";
	$data =  $db->fetchAll($sql);
	$person_id =  $data[0]["id_person"];
	$role_id =  $data[0]["id_role"];
	$unit = $data[0]["unit"];
		
} else {
	if (!$DO_NOT_REDIRECT)
		header ("location:login.php");
		
}
$BASE_DIR=__DIR__.'/../';
$TEMPLATE_DIR=$BASE_DIR."/templates/";


$ROLE_USER = 10;
$ROLE_EMPLOYED = 40;
$ROLE_ADMIN = 80;
$ROLE_LEADER = 71;
$ROLE_ZALEC =75;
$ROLE_LIST=150;
$NUM_OF_REPORT=4; //število reportov da pošlje, da so vsi zaključeni

function check_role($role_id_param,$url = FALSE) {
	global $role_id;
	
	if ($role_id < $role_id_param) {
		if (!$url)
			header("location:index.php");
		else
			header("location:".$url);
		exit();
	}
	return true;
}


