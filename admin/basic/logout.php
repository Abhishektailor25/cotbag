<?php session_start(); require_once('../../config.php'); require_once("../classes/class.common.php"); require_once '../classes/class.login.php';	
$Common=new COMMON();$LOGIN = new LOGIN();
	if($LOGIN->is_loggedin()!="")
	{
		$Common->redirect('../index');
	}
	if($_GET['logout']=="true")
	{
		$LOGIN->doLogout();
		$Common->redirect('../index');
	}