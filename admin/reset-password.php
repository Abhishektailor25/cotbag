<?php session_start();
require_once('../config.php');
require_once("classes/class.common.php");
require_once("classes/class.login.php");
require_once("classes/class.support.php");
include ("../PHPMailer-master/PHPMailerAutoload.php");	
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
$login = new LOGIN();
if($login->is_loggedin()!="")
{
	$login->redirect('dashboard');
}

 if(isset($_REQUEST['token']))
{
@$Token = $_REQUEST['token'];
$stmt = $Common->runQuery("Select * From teachers Where `token` ='$Token'");
		$stmt->execute();
		$fetchss=$stmt->fetch(PDO::FETCH_ASSOC);
 
$id = $fetchss['id'];	
} 
		?>
         <?php
if(isset($_POST['submitform']))
{
 
$newpassword = $_REQUEST['password'];
$id = $_REQUEST['id'];
$stmt = $Common->runQuery("SELECT * FROM teachers WHERE id = $id");
$stmt->execute();
$result=$stmt->fetch(PDO::FETCH_ASSOC);
 

if($result['id']!='')
	{		
	$Name = $result["firstname"];
	$Email = $result['email'];
	$id = $result['id'];
$password  = $_REQUEST['password'];

$token  = uniqid();
$secuirepass  = password_hash($password, PASSWORD_DEFAULT);
 
$stmt = $Common->runQuery("Update teachers Set `password` ='$secuirepass', `sp` ='$password' where `id`='$id'");
$stmt->execute();	
$Sent = $SUPPORT->send_mail_reset_confirm($Name,$Email);

if($Sent == '1'){	
	
	$message = '<h4>Success!</h4> Password successfully changed';
	    	echo "<script>window.setTimeout(function(){ window.location.href = 'index.php';}, 1000);</script>";	
}
}
else
{
$error[] = '<h4>OOPS!</h4> Password Not Changed';	
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
<title>JEPH :: Teacher Panel</title>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
<link href="assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
<link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
<style>
.form-bg{
    background: url(img/img-1.jpg);
    background-size: cover;
    position: relative;
	height:100vh;
}
.form-bg:before{
    content: "";
    width: 100%;
    height: 100%;
    background: radial-gradient(#858585, #000);
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0.8;
}
.form-horizontal{
    padding: 35px 40px 55px 40px;
    background: #44494d;
    border-radius: 5px;
}
.form-horizontal .form-group{
    margin: 0 0 30px 0;
    position: relative;
}
.form-horizontal .form-group:nth-child(5n){ margin-bottom: 20px; }
.form-horizontal .form-group:last-child{ margin: 0; }
.form-horizontal .heading{
    display: block;
    font-size: 28px;
    color: #fff;
    text-transform: capitalize;
    text-align: center;
    margin-bottom: 20px;
}
.form-horizontal .form-control{
    height: 50px;
    background: #33383c;
    border: none;
    box-shadow: none;
    border-radius: 0;
    padding: 0 20px;
    font-size: 16px;
    color: #7f8291;
    position: relative;
    transition: all 0.3s ease 0s;
}
.form-horizontal .form-control:focus{
    box-shadow: none;
    outline: 0 none;
}
.form-horizontal .form-control::-webkit-input-placeholder,
.form-horizontal .form-control::-moz-placeholder,
.form-horizontal .form-control::placeholder{ color: #c4c4c4; }
.form-horizontal .main-checkbox{
    width: 20px;
    height: 20px;
    border: 1px solid #fff;
    float: left;
    margin: 5px 0 0 0;
    position: relative;
}
.form-horizontal .main-checkbox label{
    width: 20px;
    height: 20px;
    position: absolute;
    top: 0;
    left: 0;
    cursor: pointer;
}
.form-horizontal .main-checkbox label:after{
    content: "";
    width: 10px;
    height: 5px;
    position: absolute;
    top: 5px;
    left: 4px;
    border: 3px solid #fff;
    border-top: none;
    border-right: none;
    background: transparent;
    opacity: 0;
    transform: rotate(-45deg);
}
.form-horizontal .main-checkbox input[type=checkbox]{ visibility: hidden; }
.form-horizontal .main-checkbox input[type=checkbox]:checked + label:after{ opacity: 1; }
.form-horizontal .text{
    float: left;
    padding-top: 5px;
    font-size: 15px;
    font-weight: bold;
    color: #8b8b8b;
    line-height: 20px;
    margin-left: 7px;
}
.form-horizontal .forgot-pass{
    width: auto;
    float: right;
    background: transparent;
    font-size: 15px;
    font-weight: bold;
    color: #8b8b8b;
    line-height: 20px;
    text-transform: capitalize;
    padding: 5px 0 0 0;
    margin-top: 0;
    box-shadow: none;
    transition: all 0.3s ease 0s;
}
.form-horizontal .btn,
.form-horizontal .btn:focus{
    width: 100%;
    padding: 12px 30px;
    background: linear-gradient(to right, #e03616, #de0370);
    border: none;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    border-radius: 6px;
    text-transform: uppercase;
}
.form-horizontal .btn:hover{ background: linear-gradient(to right, #de0370, #e03616); }
.form-horizontal .signup{
    display: block;
    padding: 12px 30px;
    font-size: 16px;
    color: #8f8f8f;
    text-transform: capitalize;
    border: 1px solid #8b8b8b;
    border-radius: 6px;
    text-align: center;
    margin-top: 8px;
}
.form-horizontal { 
    margin-top: 150px;
}
@media only screen and (max-width: 479px){
    .form-horizontal{ padding: 40px 20px; }
}
</style>
</head>
<body class="form">
<div class="form-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3"> 
                <form class="form-horizontal" method="post" id="login-form">
                   <?php  if(isset($error))  {   foreach($error as $error){?>
            <div class="alert alert-danger" style="background: #a0705a;padding: 10px;color: #fff;"> &nbsp;<?php echo $error; ?></div>
            <?php }} else if(isset($message)) { ?>
            <div class="alert alert-success" > &nbsp;<?php echo $message; ?></div>
            <?php $Common->redirectwithtime('index.php',3000); }  ?> 
             <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>"> 
                    <span class="heading">Reset Account</span>
                    <div class="form-group">
                    <input type="password" class="form-control" placeholder="******" required name="password" id="password">
                    </div>                     
                    <div class="form-group">                        
                        <a href="index.php" class="forgot-pass">Login Now?</a>
                    </div>
                   <div class="clearfix"></div>
                    <div class="form-group" >
                        <button type="submit" name="submitform" style="margin-top:20px;" class="btn btn-default">Reset Now</button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN GLOBAL MANDATORY SCRIPTS --> 
<script src="assets/js/libs/jquery-3.1.1.min.js"></script> 
<script src="bootstrap/js/popper.min.js"></script> 
<script src="bootstrap/js/bootstrap.min.js"></script> 
<!-- END GLOBAL MANDATORY SCRIPTS --> 
<script src="assets/js/authentication/form-1.js"></script> 
<!-- /.login-box --> 
<script>
jQuery(".onlynumeric").keydown(function (e)
{
	if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || (e.keyCode >= 35 && e.keyCode <= 40)) { return;}
	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {    e.preventDefault(); }
    });	
</script> 
</body>
</html>