<?php session_start(); require_once('../config.php'); require_once("classes/class.common.php"); require_once 'classes/class.login.php';
require_once 'classes/class.support.php'; 
//include ("../PHPMailer-master/PHPMailerAutoload.php");	
$Common=new COMMON();
$LOGIN = new LOGIN();	
$SUPPORT = new SUPPORT();	
$GenralSite = $Common->getRows('settings',array('where'=>array('Id'=>1),'limit'=>1,'return_type'=>'single')); 
if($GenralSite['Mode']==1)
	{
	$Domain = $GenralSite['LiveUrl'];
	}
if($GenralSite['Mode']==0)
	{
	$Domain = $GenralSite['DemoUrl'];
	}
	if(!$LOGIN->is_loggedin())
	{		
		 $LOGIN->redirect($Domain);
	}
$Id = $_SESSION['pasessid'];	

$UserRow=$Common->getRows('admin',array('where'=>array('id'=>$Id),'limit'=>1,'return_type'=>'single'));?>
<?php include("support/thumb.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="robots" content="noindex">
<meta name="googlebot" content="noindex">
<title><?php echo $GenralSite['Title']; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="img/favicon.png"/> 
<!-- Normalize CSS -->
<link rel="stylesheet" href="css/normalize.css">
<!-- Main CSS -->
<link rel="stylesheet" href="css/main.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Fontawesome CSS -->
<link rel="stylesheet" href="css/all.min.css">
<!-- Flaticon CSS -->
<link rel="stylesheet" href="fonts/flaticon.css">
<!-- Full Calender CSS -->
<link rel="stylesheet" href="css/fullcalendar.min.css">
<!-- Animate CSS -->
<link rel="stylesheet" href="css/animate.min.css">
<!-- Select 2 CSS -->
<?php if(isset($_GET['page'])) { ?>
<link rel="stylesheet" href="css/select2.min.css">
<!-- Data Table CSS -->
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<!-- Date Picker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<?php }?>
<!-- Custom CSS -->
<link rel="stylesheet" href="style.css">
<!-- Modernize js -->
<script src="js/modernizr-3.6.0.min.js"></script>
<script>
	 $(".select2").select2();
</script>
</head>
<?php
if($Id!='')
{
	require_once("pages/dashboard.php");	
}
 ?>

</body>
</html>