<?php session_start();  
require_once('config.php');
require_once("classes/class.common.php"); 
require_once("classes/class.support.php");   
include ("PHPMailer-master/PHPMailerAutoload.php");	
$Common=new COMMON();
$SUPPORT=new SUPPORT();
$GenralSite = $Common->getRows('settings',array('where'=>array('Id'=>1),'limit'=>1,'return_type'=>'single')); 
if($GenralSite['Mode']==1)
	{
	$Domain = $GenralSite['LiveUrl'];
	}
if($GenralSite['Mode']==0)
	{
	$Domain = $GenralSite['DemoUrl'];
	}

?>