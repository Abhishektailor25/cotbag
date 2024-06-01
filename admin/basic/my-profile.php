<?php 
$table = 'admin';  $PageHead = 'admin'; $page = 'dashboard?page=my-profile';

if(isset($_POST['EditSubmit']))
{  
	$id = $Common->cleardeta($_POST['id']);
	$firstname = $Common->cleardeta($_POST['firstname']);
	$lastname = $Common->cleardeta($_POST['lastname']);
	$gender = $Common->cleardeta($_POST['gender']); 
	$dob = $Common->cleardeta($_POST['dob']);
	//$employeeid = $Common->cleardeta($_POST['employeeid']);
	$bloodgroup = $Common->cleardeta($_POST['bloodgroup']);	
	$religion = $Common->cleardeta($_POST['religion']);	
	/*$email = $Common->cleardeta($_POST['email']);	
	$mobile = $Common->cleardeta($_POST['mobile']);	
	$altermobile = $Common->cleardeta($_POST['altermobile']);
	$address = $Common->cleardeta($_POST['address']);
	$maritalstatus = $Common->cleardeta($_POST['maritalstatus']);
	$bio = $Common->cleardeta($_POST['bio']);*/
	if($_FILES["Photo"]["name"]!='')
 	{	 
		$Altx = $Common->seo_friendly_url($_POST['firstname']).'-'.time().'-'.rand(1,10);
	 	$path_parts = $_FILES["Photo"]["name"];
		$ext = pathinfo($path_parts, PATHINFO_EXTENSION);
		$allowedExtensions = array("jpg","jpeg","gif","png","JPG","JPEG","GIF","PNG");
	 	if (in_array($ext, $allowedExtensions))
		{
			$Banners = cwUpload('Photo','../uploads/photo/',''.$Altx.'',TRUE,'../uploads/photo/thumb/','280','330');
		}
		else
		{
			$Banners = "Error";
			$Bannerserror = "Only gif, png, jpg files are allowed for Photo"; 
		}
	 }
	 else
	 {
		 $Banners= $_POST['OldPhoto'];		
		 $Bannerserror = 'Upload Photo';
	 }
	 
	if($firstname=="")
	{
		$error[] = "Provide Name !";	
	}	 
	else if($Banners=="" || $Banners=='Error')
	{
		$error[] = $Bannerserror;	
	}
	 
	else
	{
		try
		{
			$dob = date('Y-m-d',strtotime($dob));
			$data = array('firstname' => $firstname, 'lastname' => $lastname, 'gender' => $gender, 'dob' => $dob, 'bloodgroup' => $bloodgroup, 'religion' => $religion,  'photo' => $Banners);
			$condition = array('id' => $id);
			if($Common->update($table,$data,$condition))
			{
				$statusMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$PageHead.' has been updated successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
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
  <h3 class="col-md-6">My Profile</h3>
  <ul class="col-md-6 text-right">
    <li> <a href="dashboard">Home</a> </li>
    <li>My Profile</li>
  </ul>
</div>
<!-- Breadcubs Area End Here --> 
<!-- All Subjects Area Start Here -->
<div class="row">
 <?php  
$where = array('Id'=>$Id);
$conditions = array('where'=>$where,'limit'=>1,'return_type'=>'single');
$Data = $Common->getRows($table,$conditions); 
$Gender = $Common->getRows('masters',array('where'=>array('id'=>$Data['gender']),'limit'=>1,'return_type'=>'single'));	
$Blood = ($Data['bloodgroup']!='') ? $Common->getRows('masters',array('where'=>array('id'=>$Data['bloodgroup']),'limit'=>1,'return_type'=>'single')) : ""; 				
$Religion = ($Data['religion']!='') ? $Common->getRows('masters',array('where'=>array('id'=>$Data['religion']),'limit'=>1,'return_type'=>'single')) : ""; 
	 ?> 
<div class="col-8-xxxl col-xl-7">
    <div class="card account-settings-box">
        <div class="card-body">
            
            <div class="user-details-box">
                <div class="item-img">
                    <img src="../uploads/photo/thumb/<?php echo $Data['photo'];?>" alt="<?php echo $Data['firstname'];?>" class="img-responsive" onerror="this.src = 'img/figure/user.jpg';" style="width:250px; height:250px;">
                </div>
                <div class="item-content">
                    <div class="info-table table-responsive">
                        <table class="table text-nowrap">
                            <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td class="font-medium text-dark-medium"><?php echo $Data['firstname'].' '.$Data['lastname'];?></td>
                                </tr>
                                
                                <tr>
                                    <td>Gender:</td>
                                    <td class="font-medium text-dark-medium"><?php echo $Gender['heading'];?></td>
                                </tr>
                               
                                <tr>
                                    <td>Date Of Birth:</td>
                                    <td class="font-medium text-dark-medium"><?php echo date('d-M-Y',strtotime($Data['dob']));?></td>
                                </tr>
                                <tr>
                                    <td>Religion:</td>
                                    <td class="font-medium text-dark-medium"><?php echo $Religion['heading'];?></td>
                                </tr>
                                   <tr>
                                    <td>E-mail:</td>
                                    <td class="font-medium text-dark-medium"><?php echo $Data['email'];?></td>
                                </tr> 
                                <tr>
                                    <td>Phone:</td>
                                    <td class="font-medium text-dark-medium"><?php echo $Data['mobile'];?>, <?php echo $Data['alternatemobile'];?> </td>
                                </tr>
                               <tr>
                                    <td>Marital Status:</td>
                                    <td class="font-medium text-dark-medium"><?php echo $Data['maritalstatus'];?></td>
                                </tr>
                                <?php if($Data['maritalstatus']=='Yes') { ?>
                                 <tr>
                                    <td>Spouse Name:</td>
                                    <td class="font-medium text-dark-medium"><?php echo $Data['spousename'];?></td>
                                </tr>
                                <?php }?>
                                 <tr>
                                    <td>Blood Group:</td>
                                    <td class="font-medium text-dark-medium"><?php echo $Blood['heading'];?></td>
                                </tr>
                                  <tr>
                                    <td>Address:</td>
                                    <td class="font-medium text-dark-medium"><?php echo $Data['address'];?></td>
                                </tr>
                                 <tr>
                                    <td>Bio:</td>
                                    <td class="font-medium text-dark-medium"><?php echo $Data['bio'];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-4-xxxl col-xl-5">
        <div class="card account-settings-box height-auto">
            <div class="card-body">
                <div class="heading-layout1 mg-b-20">
                    <div class="item-title">
                        <h3>Edit</h3>
                    </div> 
                </div>
                   <div class="all-user-box">
                    <?php
					$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
// Get status from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg'];  
	echo '<div class="col-12">'.$statusMsg.'</div>';  
}
if(isset($error)){foreach($error as $error){ echo '<div class="col-12"><div class="alert alert-danger"> <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; '.$error.'</div></div>'; } }?>
        <form class="new-added-form" action="<?php echo $page ?>" method="post" id="updatepassword" enctype="multipart/form-data"> 
        <input type="hidden"  value="<?php  echo $TeacherId; ?>" name="id" class="form-control">
          <div class="row">
          <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label>First Name *</label>
              <input type="text" placeholder="Enter First Name" value="<?php if(isset($error)){ echo $firstname;} else { echo $Data['firstname'];} ?>" name="firstname" required class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label>Last Name *</label>
              <input type="text" placeholder="Enter Last Name" value="<?php if(isset($error)){ echo $lastname;} else { echo $Data['lastname'];} ?>" name="lastname" required class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label>Gender *</label>
             <select class="form-control" name="gender" required>
                <option value="">Please Select Gender *</option>
                  <?php  $allGender = $Common->getRows('masters',array('where'=>array('master_type_id'=>3,'status'=>'1'),'return_type'=>'all','order_by'=>'id asc'));
			  	for($g=0;$g<count($allGender);$g++) {?>
                <option <?php if(isset($error)){ if($gender==$allGender[$g]['id']){ echo 'selected="selected"';}  } else { if($Data['gender']==$allGender[$g]['id']){ echo 'selected="selected"';}  } ?> value="<?php echo $allGender[$g]['id'] ?>"><?php echo $allGender[$g]['heading'] ?></option>
                <?php }?>
              </select>
            </div> 
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label>Date Of Birth *</label>
              <input type="text" name="dob" placeholder="dd/mm/yyyy" class="form-control air-datepicker" value="<?php if(isset($error)){ echo $dob;}else { echo date('d/m/Y',strtotime($Data['dob']));}  ?>">
              <i class="far fa-calendar-alt"></i> 
            </div> 
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label>Blood Group *</label>
              <select class="form-control" name="bloodgroup" required>
                <option value="">Please Select Group *</option>
                <?php  $allBg = $Common->getRows('masters',array('where'=>array('master_type_id'=>10,'status'=>'1'),'return_type'=>'all','order_by'=>'id asc'));
			  	for($bg=0;$bg<count($allBg);$bg++) {?>
                <option <?php if(isset($error)){ if($bloodgroup==$allBg[$bg]['id']){ echo 'selected="selected"';}  } else { if($Data['bloodgroup']==$allBg[$bg]['id']){ echo 'selected="selected"';}  } ?> value="<?php echo $allBg[$bg]['id'] ?>"><?php echo $allBg[$bg]['heading'] ?></option>
                <?php }?>
              </select>
            </div>
              <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label>Religion *</label>
              <select class="form-control" name="religion" required>
                <option value="">Please Select Religion *</option>
                 <?php  $allReligion = $Common->getRows('masters',array('where'=>array('master_type_id'=>5,'status'=>'1'),'return_type'=>'all','order_by'=>'id asc'));
			  	for($r=0;$r<count($allReligion);$r++) {?>
                <option <?php if(isset($error)){ if($religion==$allReligion[$r]['id']){ echo 'selected="selected"';}  } else { if($Data['religion']==$allReligion[$r]['id']){ echo 'selected="selected"';}  } ?> value="<?php echo $allReligion[$r]['id'] ?>"><?php echo $allReligion[$r]['heading'] ?></option>
                <?php }?>
              </select>
            </div>
             <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label class="text-dark-medium">Upload Photo (280px X 330px) 
              <?php  if($Data['photo']){ ?> 
              <a href="../uploads/photo/thumb/<?php  echo $Data['photo'];  ?>" target="_blank"/>view old photo</a>    
<?php } ?></label>  
              <input name="OldPhoto" type="hidden" class="form-control-file" value="<?php echo $Data['photo']?>" >
                <input name="Photo" type="file" class="form-control-file"    accept="image/*"/> 
              <br/> <br/>
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
                </div>
<!-- All Subjects Area End Here -->
