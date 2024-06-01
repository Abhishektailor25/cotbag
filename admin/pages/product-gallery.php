<?php $table = 'product_gallery'; $page = 'dashboard.php?page=product-gallery'; $PageHead = 'gallery Image'; $product_Id = isset($_GET['product_Id']) ? $_GET['product_Id'] : null;


if(isset($_POST['SubmitIt']))
{  
   	$heading = $Common->cleardeta($_POST['heading']);
	$product_Id  = $Common->cleardeta($_POST['product_Id']);
	if($_FILES["image"]["name"]!='')
 	{	 
		$Altx = $Common->seo_friendly_url($_POST['heading']).'-'.time().'-'.rand(1,10);
	 	$path_parts = $_FILES["image"]["name"];
		$ext = pathinfo($path_parts, PATHINFO_EXTENSION);
		$allowedExtensions = array("jpg","jpeg","gif","png","JPG","JPEG","GIF","PNG");
	 	if (in_array($ext, $allowedExtensions))
		{
            $image = cwUpload('image','../uploads/product/gallery/view/',''.$Altx.'',TRUE,'../uploads/product/gallery/','500','500',TRUE,'../uploads/product/gallery/thumb/','100','100');	
    	}
		else
		{
			$image = "Error";
			$imageserror = "Only gif, png, jpg files are allowed for Photo"; 
		}
	 }
	 else
	 {
		 $image= "";	
		 $imageserror = 'Upload image';
	 }

	
	if($heading=="")
	{
		$error[] = "Provide ".$PageHead." !";	
	}	 
	else
	{
		try
		{

			$data = array('heading' => $heading,'image' => $image,'product_Id'=>$product_Id);
   			if($Common->insert($table,$data))
   			{
   				$statusMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$PageHead.' has been added successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
   				$Common->redirect($page.'&product_Id='.$product_Id,$statusMsg);				
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
if(isset($_POST['EditSubmit']))
{
	$id = $_REQUEST['id'];
 	$heading = $Common->cleardeta($_POST['heading']);
	$product_Id = $Common->cleardeta($_POST['product_Id']); 
	
	 if($_FILES["image"]["name"]!='')
 	{	 
		$Altx = $Common->seo_friendly_url($_POST['heading']).'-'.rand(1,10);
	 	$path_parts = $_FILES["image"]["name"];
		$ext = pathinfo($path_parts, PATHINFO_EXTENSION);
		$allowedExtensions = array("jpg","jpeg","gif","png","JPG","JPEG","GIF","PNG");
	 	if (in_array($ext, $allowedExtensions))
		{
            $image = cwUpload('image','../uploads/product/gallery/view/',''.$Altx.'',TRUE,'../uploads/product/gallery/','500','500',TRUE,'../uploads/product/gallery/thumb/','100','100');
           
		}
		else
		{
			$image = "Error";
			$imageerror = "Only gif, png, jpg files are allowed for Photo"; 
		}
	 }
	 else
	 {
		 $image= $_POST['Oldbanner'];		
		 $imagererror = 'Upload Banner';
	 }
	if($heading=="")
	{
		$error[] = "Provide ".$PageHead." !";	
	}	 
	else
	{
		try
		{
			$data = array('heading' => $heading,'image' => $image,'product_Id' => $product_Id);
			$condition = array('id' => $id);
			if($Common->update($table,$data,$condition))
			{
				$statusMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$PageHead.' has been updated successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
				$Common->redirect($page.'&product_Id='.$product_Id,$statusMsg);		
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
if (isset($_POST['Active']))
{
	$product_Id=$_POST['product_Id'];
	$id=$_POST['selector'];
	$N = count($id);
	for($i=0; $i < $N; $i++)
	{
		$Common->update($table,array('status' => 1),array('id' => $id[$i]));
	}
 	$statusMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">Status Activated successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
	$Common->redirect($page.'&product_Id='.$product_Id,$statusMsg);
}
if (isset($_POST['InActive']))
{
	$product_Id=$_POST['product_Id'];
	$id=$_POST['selector'];
	$N = count($id);
	for($i=0; $i < $N; $i++)
	{
		$Common->update($table,array('status' => 0),array('id' => $id[$i])); 
	}
	$statusMsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">Status Deactivated successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
	$Common->redirect($page.'&product_Id='.$product_Id,$statusMsg);
}
if (isset($_POST['Delete']))
{
	$product_Id=$_POST['product_Id'];
	$id=$_POST['selector'];
	$N = count($id);
	for($i=0; $i < $N; $i++)
	{
		$result =  $Common->delete($table,array('id' => $id[$i]));
	}
	$statusMsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Deleted successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
	$Common->redirect($page.'&product_Id='.$product_Id,$statusMsg);
	
}

?>

<!-- Breadcubs Area Start Here -->

<div class="breadcrumbs-area row">
    <?php if(isset($_REQUEST['opt']))
{
  if($_REQUEST['opt']=='edit')  { ?>
    <h3 class="col-md-6">All
        <?php  echo $PageHead; ?>
    </h3>
    <ul class="col-md-6 text-right">
        <li> <a href="dashboard.php">Home</a> </li>
        <li> <a href="dashboard.php?page=product-gallery&product_Id=<?php echo $product_Id   ?>">All <?php  echo $PageHead; ?> </a> </li>
        <li>Gallery Edit </li>
    </ul>
    <?php }
  else if($_REQUEST['opt']=='img_add')  { ?>
    <h3 class="col-md-6">All
        <?php  echo $PageHead; ?>
    </h3>
    <ul class="col-md-6 text-right">
        <li> <a href="dashboard.php">Home</a> </li>
        <li> <a href="dashboard.php?page=product-gallery&product_Id=<?php echo $product_Id ?>">All
                <?php  echo $PageHead; ?>
            </a> </li>
        <li>Add Gallery </li>
    </ul>
    <?php }} else{ ?>
    <h3 class="col-md-6">All  <?php  echo $PageHead; ?>  </h3>
    <ul class="col-md-6 text-right">
        <li> <a href="dashboard.php">Home</a> </li>
        <li> <a href="dashboard.php?page=product">Product</a> </li>
        <li>All <?php  echo $PageHead; ?> </li>
    </ul>
    <?php }?>
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
if(isset($error)){foreach($error as $error){ echo '<div class="col-12"><div class="alert alert-danger"> <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; '.$error.'</div></div>'; } }
if(isset($_REQUEST['opt']))
{
	if($_REQUEST['opt']=='edit')
	{
		$id = $_REQUEST['id'];
		$where = array('id'=>$id);
		$conditions = array('where'=>$where,'limit'=>1,'return_type'=>'single');
		$getData = $Common->getRows($table,$conditions); 
		//print_r($getData);
	
	 ?>
    <div class="col-12-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Edit <?php  echo $PageHead; ?> </h3>
                    </div>
                </div>
                <form class="new-added-form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="product_Id" value="<?php echo $_REQUEST['product_Id']; ?>" />
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label> <?php  echo $PageHead; ?>  heading *</label>
                            <input type="text" placeholder="<?php  echo $PageHead; ?> heading*" name="heading" value="<?php echo $getData['heading'] ?>" class="form-control">
                        </div>
                        <div class="col-lg-6 col-12 form-group mg-t-30">
                            <label class="text-dark-medium">Image (500px X 500px)
                                <?php  if($getData['image']){ ?>
                                <a href="../uploads/product/gallery/<?php  echo $getData['image'];  ?>" target="_blank" />view old Image</a>
                                <?php } ?>
                            </label>
                            <input name="Oldbanner" type="hidden" class="form-control-file" value="<?php echo $getData['image']?>">
                            <input name="image" type="file" class="form-control-file" accept="image/*" />
                            <br />
                            <br />
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
    <?php 	}
else if($_REQUEST['opt']=='img_add')  {?>
    <div class="col-12-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Add New <?php  echo $PageHead; ?> </h3>
                    </div>
                </div>
                <form class="new-added-form" id="formvalidate" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="product_Id" value="<?php echo $product_Id;?>" required class="form-control">
                    <div class="row">
                        <div class="col-6-xxxl col-lg-6 col-12 form-group">
                            <label> heading*</label>
                            <input type="text" placeholder="heading*" name="heading" required class="form-control">
                        </div>

                        <div class="col-lg-4 col-12 form-group mg-t-10">
                            <label class="text-dark-medium">Upload Image* (500px X 500px)</label>
                            <input type="file" name="image" class="form-control-file" required accept="image/*">
                        </div>

                        <div class="col-12 form-group mg-t-8">
                            <button type="submit" name="SubmitIt" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow resetform">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } } ?>
    <div class="col-12-xxxl col-12">
        <form method="post" action="<?php echo $page ?>" id="validateform">
            <input type="hidden" name="product_Id" value="<?php echo $product_Id;?>">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1 row">
                        <div class="item-title col-md-4 tablehead">
                             <h3>All <?php  echo $PageHead; ?></h3>
                        </div>
                        <div class="col-md-8 text-right"> <a href="<?php echo $page; ?>&opt=img_add&product_Id=<?php echo $product_Id;?>"  class="btn-fill-lg radius-30 text-light shadow-blue-dark bg-blue-dark"
                                style="margin:10px;">Add  <?php  echo $PageHead; ?> </a>
                            <input type="submit" class="btn-fill-lg radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" value="Active" name="Active" style="margin:10px;">
                            <input type="submit" class="btn-fill-lg radius-30 text-light shadow-orange-peel bg-orange-peel" value="In Active" name="InActive" style="margin:10px;">
                            <input type="submit" class="btn-fill-lg radius-30 text-light shadow-orange-red bg-orange-red" onclick="return confirm('Are you sure?');" value="Delete" name="Delete"
                                style="margin:10px;">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="sorting_disabled">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkAll">
                                            <label class="form-check-label">ID</label>
                                        </div>
                                    </th>
                                    <th>Image</th>
                                    <th>heading</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php       
		     $conditions = array('where'=>array('product_Id'=>$product_Id),'return_type'=>'all');
			  $showall = $Common->getRows($table,$conditions); 
			if(!empty($showall)){
					$a='1';
			for($i=0;$i<count($showall);$i++)
			{  		
			 ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" name="selector[]" value="<?php echo $showall[$i]['id'] ?>" class="form-check-input">
                                            <label class="form-check-label"><?php echo $a ?></label>
                                        </div>
                                    </td>
                                    <td><img src="../uploads/product/gallery/<?php echo $showall[$i]['image'] ?>" class="img-thumbnail" style="height:70px"></td>
                                    <td><?php echo $showall[$i]['heading'] ?></td>
                                    <td><?php echo $Common->showstatus($showall[$i]['status']); ?></td>
                                    <td><?php echo $Common->showindatendtime($showall[$i]['created']); ?></td>
                                    <td><a class="dropdown-item" href="dashboard.php?page=product-gallery&product_Id=<?php echo $product_Id;?>&opt=edit&id=<?php echo $showall[$i]['id']; ?>"><i
                                                class="fas fa-pencil-alt"></i></a></td>
                                </tr>
                                <?php $a++; } }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- All <?php  echo $PageHead; ?>s Area End Here -->