<?
require_once 'Zend/Db/Adapter/Pdo/Mysql.php';
require_once 'Zend/Auth/Adapter/DbTable.php';
require_once 'Zend/Db.php';
require_once 'Zend/Auth.php';
Zend_Auth::getInstance()->clearIdentity(); 

require_once("inc/config.php");

?>