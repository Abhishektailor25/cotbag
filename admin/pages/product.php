<?php $table = 'tbl_product_list'; $page = 'dashboard?page=product'; $PageHead = 'Product';
if(isset($_POST['SubmitIt']))
{
	$categoryid = $Common->cleardeta($_POST['categoryid']); 
  $colorid = $Common->cleardeta(implode(',',$_POST['colorid']));
	$name = $Common->cleardeta($_POST['name']);
	$slug = $Common->seo_friendly_url($_POST['name'].'-'.$_POST['style']);
	$style = $Common->cleardeta($_POST['style']);
	$size = $Common->cleardeta($_POST['size']);
	$fabric = $Common->cleardeta($_POST['fabric']);
	$handle = $Common->cleardeta($_POST['handle']);
	$sort_details = $Common->cleardeta($_POST['sort_details']);
	$description = $Common->cleardeta($_POST['description']);
	$product_specification = $Common->cleardeta($_POST['product_specification']);
	$care_instruction = $Common->cleardeta($_POST['care_instruction']);
	$meta_title = $Common->cleardeta($_POST['meta_title']);
	$meta_keyword = $Common->cleardeta($_POST['meta_keyword']);
	$meta_description = $Common->cleardeta($_POST['meta_description']);
	if($_FILES["image"]["name"]!='')
 	{	 
		$Altx = $Common->seo_friendly_url($_POST['name']).'-'.time().'-'.rand(1,10);
	 	$path_parts = $_FILES["image"]["name"];
		$ext = pathinfo($path_parts, PATHINFO_EXTENSION);
		$allowedExtensions = array("jpg","jpeg","gif","png","JPG","JPEG","GIF","PNG");
	 	if (in_array($ext, $allowedExtensions))
		{
			$Banners = cwUpload('image','../uploads/product/view/',''.$Altx.'',TRUE,'../uploads/product/','500','500',TRUE,'../uploads/product/thumb/','100','100');
		}
		else
		{
			$Banners = "Error";
			$Bannerserror = "Only gif, png, jpg files are allowed for Photo"; 
		}
	 }
	 else
	 {
		 $Banners= "";	
		 $Bannerserror = 'Upload Photo';
	 }
	if($name=="")
	{
		$error[] = "Provide ".$PageHead." !";	
	}	 
	else
	{
		try
		{
			$data = array('pid' => $categoryid,'description' => $name,'image' => $Banners,'color'=>$colorid,'style'=>$style,'size'=>$size,'fabric'=>$fabric,'handle'=>$handle,'sort_details'=>$sort_details,'bottom_description'=>$description,'product_specification'=>$product_specification,'care_instruction'=>$care_instruction,'meta_title'=>$meta_title,'meta_keyword'=>$meta_keyword,'meta_description'=>$meta_description,'slug'=>$slug);
			if($Common->insert($table,$data))
			{
				$statusMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$PageHead.' has been added successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
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
if(isset($_POST['EditSubmit']))
{
 	$id = base64_decode($_REQUEST['id'])-1000;
   $categoryid = $Common->cleardeta($_POST['categoryid']); 
   $colorid = $Common->cleardeta(implode(',',$_POST['colorid']));
   $name = $Common->cleardeta($_POST['name']);
   $style = $Common->cleardeta($_POST['style']);
   $size = $Common->cleardeta($_POST['size']);
   $fabric = $Common->cleardeta($_POST['fabric']);
   $handle = $Common->cleardeta($_POST['handle']);
   $sort_details = $Common->cleardeta($_POST['sort_details']);
   $description = $Common->cleardeta($_POST['description']);
   $product_specification = $Common->cleardeta($_POST['product_specification']);
   $care_instruction = $Common->cleardeta($_POST['care_instruction']);
   $meta_title = $Common->cleardeta($_POST['meta_title']);
   $meta_keyword = $Common->cleardeta($_POST['meta_keyword']);
   $meta_description = $Common->cleardeta($_POST['meta_description']);
	 if($_FILES["image"]["name"]!='')
 	{	 
		$Altx = $Common->seo_friendly_url($_POST['name']).'-'.time().'-'.rand(1,10);
	 	$path_parts = $_FILES["image"]["name"];
		$ext = pathinfo($path_parts, PATHINFO_EXTENSION);
		$allowedExtensions = array("jpg","jpeg","gif","png","JPG","JPEG","GIF","PNG");
	 	if (in_array($ext, $allowedExtensions))
		{
			$Banners = cwUpload('image','../uploads/product/view/',''.$Altx.'',TRUE,'../uploads/product/','500','500',TRUE,'../uploads/product/thumb/','100','100');
		}
		else
		{
			$Banners = "Error";
			$Bannerserror = "Only gif, png, jpg files are allowed for Photo"; 
		}
	 }
	 else
	 {
		 $Banners= $_POST['Oldimage'];		
		 $Bannerserror = 'Upload Photo';
	 }
	if($name=="")
	{
		$error[] = "Provide ".$PageHead." !";	
	}	 
	else
	{
		try
		{
      $data = array('pid' => $categoryid,'description' => $name,'image' => $Banners,'color'=>$colorid,'style'=>$style,'size'=>$size,'fabric'=>$fabric,'handle'=>$handle,'sort_details'=>$sort_details,'bottom_description'=>$description,'product_specification'=>$product_specification,'care_instruction'=>$care_instruction,'meta_title'=>$meta_title,'meta_keyword'=>$meta_keyword,'meta_description'=>$meta_description);
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
if (isset($_POST['Active']))
{
	$id=$_POST['selector'];
	$N = count($id);
	for($i=0; $i < $N; $i++)
	{
		$Common->update($table,array('status' => 1),array('id' => $id[$i]));
	}
 	$statusMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">Status Activated successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
	$Common->redirect($page,$statusMsg);
}
if (isset($_POST['InActive']))
{
	$id=$_POST['selector'];
	$N = count($id);
	for($i=0; $i < $N; $i++)
	{
		$Common->update($table,array('status' => 0),array('id' => $id[$i])); 
	}
	$statusMsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">Status Deactivated successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
	$Common->redirect($page,$statusMsg);
}
if (isset($_POST['Delete']))
{
	$id=$_POST['selector'];
	$N = count($id);
	for($i=0; $i < $N; $i++)
	{
		$result =  $Common->delete($table,array('id' => $id[$i]));
	}
	$statusMsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Deleted successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
	$Common->redirect($page,$statusMsg);
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
    <li> <a href="dashboard">Home</a> </li>
    <li>
      <a href="<?php echo $page ?>">All <?php  echo $PageHead; ?></a>
    </li>
    <li>Edit <?php echo $PageHead ?>
    </li>
  </ul>
  <?php }
  else if($_REQUEST['opt']=='add')  { ?>
  <h3 class="col-md-6">All
    <?php  echo $PageHead; ?>
  </h3>
  <ul class="col-md-6 text-right">
    <li> <a href="dashboard">Home</a> </li>
    <li>
      <a href="<?php echo $page ?>">All <?php  echo $PageHead; ?></a>
    </li>
    <li>Add <?php echo $PageHead ?>
    </li>
  </ul>
  <?php }} else{ ?>
  <h3 class="col-md-6">All
    <?php  echo $PageHead; ?>
  </h3>
  <ul class="col-md-6 text-right">
    <li> <a href="dashboard">Home</a> </li>
    <li>All
      <?php  echo $PageHead; ?>
    </li>
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
		$id= base64_decode($_REQUEST['value'])-1000;
		$where = array('id'=>$id);
		$conditions = array('where'=>$where,'limit'=>1,'return_type'=>'single');
		$Data = $Common->getRows($table,$conditions); 
		//print_r($Data);
	
	 ?>
<div class="col-12-xxxl col-12">
    <div class="card height-auto">
      <div class="card-body">
        <div class="heading-layout1">
          <div class="item-title">
            <h3>Edit <?php  echo $PageHead; ?></h3>
          </div>
        </div>
        <form class="new-added-form" action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $_REQUEST['value']; ?>" />
        
          <div class="row">
           <div class="col-xl-6 col-lg-6 col-12 form-group">
              <label>Category <span class="text-danger"> * </span></label>
              <select class="form-control" name="categoryid" required>
                <option value="">Please Select Category *</option>
                <?php  $allCategory = $Common->getRows('tbl_product',array('where'=>array('status'=>'1'),'return_type'=>'all','order_by'=>'id asc'));
			  	      for($bg=0;$bg<count($allCategory);$bg++) {?>
                <option <?php if(isset($error)){ if($categoryid==$allCategory[$bg]['id']){ echo 'selected="selected"';}} else { if($Data['pid']==$allCategory[$bg]['id']){ echo 'selected="selected"';}  } ?> value="<?php echo $allCategory[$bg]['id'] ?>"><?php echo $allCategory[$bg]['name'] ?></option>
                <?php }?>
              </select>
            </div>
          <div class="col-xl-6 col-lg-6 col-12 form-group">
              <label><?php  echo $PageHead; ?> Name <span class="text-danger"> * </span></label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Name*" name="name" value="<?php echo $Data['description'] ?>"  class="form-control" required>
            </div>

            <div class="col-xl-5 col-lg-5 col-6 form-group">
              <label><?php  echo $PageHead; ?> Style <span class="text-danger">*</span></label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Style*" name="style" value="<?php echo $Data['style'] ?>" required class="form-control">
            </div>
            <div class="col-xl-7 col-lg-7 col-6 form-group">
              <label><?php  echo $PageHead; ?> Size <span class="text-danger">*</span></label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Size*" name="size" value="<?php echo $Data['size'] ?>" required class="form-control">
            </div>
            <div class="col-xl-4 col-lg-4 col-6 form-group">
              <label><?php  echo $PageHead; ?> Fabric </label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Fabric*" name="fabric" value="<?php echo $Data['fabric'] ?>" class="form-control">
            </div>
            <div class="col-xl-4 col-lg-4 col-6 form-group">
              <label><?php  echo $PageHead; ?> Handle </label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Handle*" name="handle" value="<?php echo $Data['handle'] ?>" class="form-control">
            </div>
            <div class="col-xl-4 col-lg-4 col-12 form-group">
                <label>Color<span class="text-danger"> * </span></label>
                <select class="form-control select2" name="colorid[]" multiple="multiple">
                    <option value="">Please Select Color</option>
                    <?php
                    $colors = $Common->getRows('colors', array('where' => array('status' => '1'), 'return_type' => 'all', 'order_by' => 'id asc'));
                    foreach ($colors as $color) {
                        if (in_array($color['name'], explode(',', $Data['color']))) {
                            echo '<option value="' . $color['name'] . '" selected>' . $color['name'] . '</option>';
                        } else {
                            echo '<option value="' .$color['name'] . '">' . $color['name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label>Short Description:</label>
                <textarea class="form-control" name="sort_details" placeholder="Short Description"><?php echo $Data['sort_details'] ?></textarea>
              </div>
              <div class="col-xl-12 col-lg-12 col-12 form-group">
                <label> Description </label>
                <textarea name="description" type="text" class="form-control ckeditor" rows="4" cols="50"  placeholder="Description"><?php echo $Data['bottom_description'] ?></textarea>
              </div>
              <div class="col-xl-12 col-lg-12 col-12 form-group">
                <label> Product Specification </label>
                <textarea name="product_specification" type="text" class="form-control ckeditor" rows="4" cols="50"  placeholder="Product Specification"><?php echo $Data['product_specification'] ?></textarea>
              </div>
              <div class="col-xl-12 col-lg-12 col-12 form-group">
                <label> Care & Instruction </label>
                <textarea name="care_instruction" type="text" class="form-control ckeditor" rows="4" cols="50"  placeholder="Product Specification"><?php echo $Data['care_instruction'] ?></textarea>
              </div>


           <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label> Meta Title  <span class="text-danger"> * </span></label>
              <input type="text" placeholder=" Meta Title*" name="meta_title" value="<?php echo $Data['meta_title'] ?>" required class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label> Meta Keyword <span class="text-danger"> * </span></label>
              <input type="text" placeholder=" Meta Keyword*" name="meta_keyword" value="<?php echo $Data['meta_keyword'] ?>" required class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label> Meta Description <span class="text-danger"> * </span></label>
              <input type="text" placeholder="Meta Description*" name="meta_description" value="<?php echo $Data['meta_description'] ?>" required class="form-control">
            </div>

             <div class="col-lg-6 col-12 form-group mg-t-30">
              <label class="text-dark-medium">Image(500 X 500px)
              <?php  if($Data['image']){ ?> 
              <a href="../uploads/product/<?php  echo $Data['image'];  ?>" target="_blank"/>view old photo</a>   
<?php } ?></label>
              <input name="Oldimage" type="hidden" class="form-control-file" value="<?php echo $Data['image']?>" >
                <input name="image" type="file" class="form-control-file"    accept="image/*"/> 
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
<?php 	}
else if($_REQUEST['opt']=='add')  {?>
  <div class="col-12-xxxl col-12">
    <div class="card height-auto">
      <div class="card-body">
        <div class="heading-layout1">
          <div class="item-title">
            <h3>Add New <?php  echo $PageHead; ?></h3>
          </div>
        </div>
        <form class="new-added-form" action="" method="post" enctype="multipart/form-data"> 
          
          <div class="row">
           <div class="col-xl-5 col-lg-5 col-12 form-group">
              <label>Category <span class="text-danger"> * </span></label>
              <select class="form-control" name="categoryid" required>
                <option value="">Please Select Category *</option>
          <?php  $allCategory = $Common->getRows('tbl_product',array('where'=>array('status'=>'1'),'return_type'=>'all','order_by'=>'id asc'));
			  	for($bg=0;$bg<count($allCategory);$bg++) {?>
                <option <?php if(isset($error)){ if($categoryid==$allCategory[$bg]['id']){ echo 'selected="selected"';}  } ?> value="<?php echo $allCategory[$bg]['id'] ?>"><?php echo $allCategory[$bg]['name'] ?></option>
                <?php }?>
              </select>
            </div>
           <div class="col-xl-7 col-lg-7 col-12 form-group">
              <label><?php  echo $PageHead; ?> Name <span class="text-danger"> * </span></label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Name*" name="name" required class="form-control">
            </div>

            <div class="col-xl-5 col-lg-5 col-6 form-group">
              <label><?php  echo $PageHead; ?> Style <span class="text-danger">*</span></label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Style*" name="style" required class="form-control">
            </div>
            <div class="col-xl-7 col-lg-7 col-6 form-group">
              <label><?php  echo $PageHead; ?> Size <span class="text-danger">*</span></label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Size*" name="size" required class="form-control">
            </div>
            <div class="col-xl-4 col-lg-4 col-6 form-group">
              <label><?php  echo $PageHead; ?> Fabric </label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Fabric*" name="fabric" class="form-control">
            </div>
            <div class="col-xl-4 col-lg-4 col-6 form-group">
              <label><?php  echo $PageHead; ?> Handle </label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Handle*" name="handle" class="form-control">
            </div>
            <div class="col-xl-4 col-lg-4 col-12 form-group">
              <label>Color<span class="text-danger"> * </span></label>
              <select class="form-control select2 " multiple="multiple" name="colorid[]">
                <option value="">Please Select Color </option>
          <?php  $colors = $Common->getRows('colors',array('where'=>array('status'=>'1'),'return_type'=>'all','order_by'=>'id asc'));
			  	for($bg=0;$bg<count($colors);$bg++) {?>
                <option value="<?php echo $colors[$bg]['name'] ?>"><?php echo $colors[$bg]['name'] ?></option>
                <?php }?>
              </select>
            </div>

             <div class="form-group col-md-12">
                <label>Short Description:</label>
                <textarea class="form-control" name="sort_details" placeholder="Short Description"></textarea>
              </div>
              <div class="col-xl-12 col-lg-12 col-12 form-group">
                <label> Description </label>
                <textarea name="description" type="text" class="form-control ckeditor" rows="4" cols="50"  placeholder="Description"></textarea>
              </div>
              <div class="col-xl-12 col-lg-12 col-12 form-group">
                <label> Product Specification </label>
                <textarea name="product_specification" type="text" class="form-control ckeditor" rows="4" cols="50"  placeholder="Product Specification"></textarea>
              </div>
              <div class="col-xl-12 col-lg-12 col-12 form-group">
                <label> Care & Instruction </label>
                <textarea name="care_instruction" type="text" class="form-control ckeditor" rows="4" cols="50"  placeholder="Product Specification"></textarea>
              </div>


           <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label> Meta Title  <span class="text-danger"> * </span></label>
              <input type="text" placeholder=" Meta Title*" name="meta_title" required class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label> Meta Keyword <span class="text-danger"> * </span></label>
              <input type="text" placeholder=" Meta Keyword*" name="meta_keyword" required class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label> Meta Description <span class="text-danger"> * </span></label>
              <input type="text" placeholder="Meta Description*" name="meta_description" required class="form-control">
            </div>
            
             <div class="col-lg-6 col-12 form-group mg-t-10">
              <label class="text-dark-medium">Image (500px X 500px)</label>
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
    <div class="card height-auto">
      <div class="card-body">
        <div class="heading-layout1 row">
          <div class="item-title col-md-4 tablehead">
            <h3>All <?php  echo $PageHead; ?>s</h3>
          </div>
          <div class="col-md-8  text-right">
          
          <a href="<?php echo $page; ?>&opt=add"  class="btn-fill-lg radius-30 text-light shadow-blue-dark bg-blue-dark" style="margin:10px;">Add <?php  echo $PageHead; ?></a>
          
          <input type="submit"  class="btn-fill-lg radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" value="Active" name="Active" style="margin:10px;">
          <input type="submit"  class="btn-fill-lg radius-30 text-light shadow-orange-peel bg-orange-peel" value="In Active" name="InActive" style="margin:10px;">
          <input type="submit"  class="btn-fill-lg radius-30 text-light shadow-orange-red bg-orange-red" onclick="return confirm('Are you sure?');" value="Delete" name="Delete" style="margin:10px;"></div>
        </div>
        <div class="table-responsive">
          <table class="table display data-table text-nowrap">
            <thead>
              <tr>
                <th class="sorting_disabled"> <div class="form-check">
                    <input type="checkbox" class="form-check-input checkAll">
                    <label class="form-check-label">ID</label>
                  </div>
                </th>
                <th>Category</th>
                <th>Name</th>
                <th>Image</th>
                <th>Url</th>
                <th>Gallery</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php  
			  $conditions = array('return_type'=>'all');
			  $showall = $Common->getRows($table,$conditions); 		
			if(!empty($showall)){
			for($i=0;$i<count($showall);$i++)
			{  		
        $Category = $Common->getRows('tbl_product',array('where'=>array('id'=>$showall[$i]['pid']),'limit'=>1,'return_type'=>'single'));
			 ?>
              <tr>
                <td><div class="form-check">
                    <input type="checkbox" name="selector[]" value="<?php echo $showall[$i]['id'] ?>" class="form-check-input">
                    <label class="form-check-label">#<?php echo $showall[$i]['id'] ?></label>
                  </div>
                </td>
                <td><?php echo $Category['name'] ?></td> 
                <td><?php echo $showall[$i]['description'] ?></td> 
                <td><img src="../uploads/product/<?php echo $showall[$i]['image'] ?>" class="img-thumbnail" style="height:70px"></td> 
                <td> <a href="<?php echo $Domain . 'product/' . $showall[$i]['slug']; ?>" target="_blank"> <i class="fas fa-2x fa-eye text-dark"></i> </a></td>
                <td><a href="dashboard?page=product-gallery&product_Id=<?php echo $showall[$i]['id'] ?>" class="btn btn-sm btn-success shadow-sm"><i class="fa fa-image fa-2x"></i></a></td>


                <td><?php echo $Common->showstatus($showall[$i]['status']); ?></td>
                <td><a class="dropdown-item" href="<?php echo $page.'&opt=edit&value='.base64_encode(1000+$showall[$i]['id']); ?>"><i class="fas fa-pencil-alt"></i></a></td>
              </tr>
              <?php } }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- All <?php  echo $PageHead; ?>s Area End Here -->
