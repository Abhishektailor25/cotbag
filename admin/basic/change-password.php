<?php 
$table = 'admin';
$page = 'dashboard?page=change-password';

if(isset($_POST['EditSubmit']))
{ 
	$Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
	$CurrentPassword = $_POST['CurrentPassword'];
	$SP = $_POST['Password']; 
	$OldData = $Common->getRows($table,array('select'=>'password','where'=>array('id'=>$Id),'limit'=>1,'return_type'=>'single'));
	$OldPassword = $OldData['password']; 
	if($Password=="")
	{
		$error[] = "Provide Heading !";	
	}
	else if(!password_verify($CurrentPassword,$OldPassword))
	{
		$error[] = "Old Password Not Matched !";	
	}	 
	else
	{
		try
		{
			$data = array('password' => $Password);
			$condition = array('id' => $Id);
			if($Common->update($table,$data,$condition))
			{
				$statusMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">Password has been updated successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
				$Common->redirect($page,$statusMsg);		
			}
			else
			{
				 $statusMsg = 'Something went wrong, please try again.'; 
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}		
} 
?>

<!-- Breadcubs Area Start Here -->

<div class="breadcrumbs-area row">
  <h3 class="col-md-6">Change Password</h3>
  <ul class="col-md-6 text-right">
    <li> <a href="dashboard">Home</a> </li>
    <li>Change Password</li>
  </ul>
</div>
<!-- Breadcubs Area End Here --> 
<!-- All Subjects Area Start Here -->
<div class="row">
 <?php // Get data from session 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
// Get status from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg'];  
	echo '<div class="col-12">'.$statusMsg.'</div>';  
}
$where = array('Id'=>$Id);
$conditions = array('where'=>$where,'limit'=>1,'return_type'=>'single');
$Data = $Common->getRows($table,$conditions); 
	
	 ?>
<div class="col-4-xxxl col-12">
    <div class="card height-auto">
      <div class="card-body">
        <div class="heading-layout1">
          <div class="item-title">
            <h3>Change Password</h3>
          </div>
        </div>
         <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
            <div class="alert alert-danger"> <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> </div>
            <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
            <div class="alert alert-info"> <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here </div>
            <?php
			}
			?>
        <form class="new-added-form" action="<?php echo $page ?>" method="post" id="updatepassword"> 
          <div class="row">
          <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label>Current Password *</label>
              <input type="password" placeholder="Enter Current Password" value="" name="CurrentPassword" required class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label>Enter New Password *</label>
              <input type="password" placeholder="Enter New Password" id="password" value="" name="Password" required class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label>Confirm New Password *</label>
              <input type="password" placeholder="Confirm New Password" value="" name="ConfirmPassword" required class="form-control">
            </div>
            <div class="col-12 form-group mg-t-8">
              <button type="submit" name="EditSubmit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
              <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow resetform">Reset</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- All Subjects Area End Here -->
