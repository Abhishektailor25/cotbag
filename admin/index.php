<?php session_start();
require_once('../config.php');
require_once("classes/class.common.php");
require_once("classes/class.login.php");
$Common=new COMMON();
$GenralSite = $Common->getRows('settings',array('where'=>array('Id'=>1),'limit'=>1,'return_type'=>'single')); 
if($GenralSite['Mode']==1)
	{
	$Domain = $GenralSite['LiveUrl'];
	}
if($GenralSite['Mode']==0)
	{
	$Domain = $GenralSite['DemoUrl'];
	}
$login = new LOGIN();
if($login->is_loggedin()!="")
{
	$login->redirect('dashboard');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']); 
	$upass = strip_tags($_POST['txt_password']);
	@$remember_me = @$_POST["remember_me"];
	$check = $login->doLogin($uname,$upass,@$remember_me); 
	if($check == '1')
	{
	$login->redirect('dashboard');
	}	
	else
	{
		$error = "Wrong Details !";
	}	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/x-icon" href="img/favicon.png"/>
<title><?php echo $GenralSite['Title']; ?> :: Admin Panel</title>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
<link href="assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
<link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
</head>
<body class="form">
<div class="form-container">
  <div class="form-form">
    <div class="form-form-wrap">
      <div class="form-container">
        <div class="form-content">
            <div class="d-flex justify-content-center">
              <img src="img/logo-admin.png" class="img-fluid mb-2 admin-front-logo p-3" alt="logo">
            </div>
          <h2 class="text-center" style="font-size:31px">Sign in <a href="javascript:void()"><span class="brand-name"><?php echo $GenralSite['Title']; ?> </span></a></h2> 
          <form class="text-left" method="post" id="login-form">
            <div class="form">
              <?php if(isset($error)) { ?>
              <div class="alert alert-danger"> <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> ! </div>
              <?php } ?>
              <div id="username-field" class="field-wrapper input">
                <input id="username"  name="txt_uname_email" type="text" value="<?php if(isset($_COOKIE["pausername"])) { echo $_COOKIE["pausername"]; } ?>"  class="form-control" placeholder="Username">
              </div>
              <div id="password-field" class="field-wrapper input mb-2">
                <input id="password" name="txt_password" class="form-control" value="<?php if(isset($_COOKIE["papassword"])) { echo $_COOKIE["papassword"]; } ?>"   type="password"  placeholder="Password">
              </div>
              <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper toggle-pass">
                  <p class="d-inline-block">Show Password</p>
                  <label class="switch s-danger">
                    <input type="checkbox" id="toggle-password" class="d-none">
                    <span class="slider round"></span> </label>
                </div>
                <div class="field-wrapper">
                  <button type="submit"  name="btn-login" class="btn btn-danger" value="">Log In</button>
                </div>
              </div>
               
            </div>
          </form>
          <p class="terms-conditions">© <?php echo date("Y") ?> Ronak Industries. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  <!-- </div>
  <div class="form-image">
    <div class="l-image"> </div>
  </div> -->
</div>
<!-- BEGIN GLOBAL MANDATORY SCRIPTS --> 
<script src="assets/js/libs/jquery-3.1.1.min.js"></script> 
<script src="bootstrap/js/popper.min.js"></script> 
<script src="bootstrap/js/bootstrap.min.js"></script> 
<!-- END GLOBAL MANDATORY SCRIPTS --> 
<script src="assets/js/authentication/form-1.js"></script> 
<!-- /.login-box --> 
</body>
</html>
