<?php $table = 'colors'; $page = 'dashboard?page=colors'; $PageHead = 'Colors';
if(isset($_POST['SubmitIt']))
{
	$name = $Common->cleardeta($_POST['name']);
	$color_code = $Common->cleardeta($_POST['color_code']);

	if($name=="")
	{
		$error[] = "Provide ".$PageHead." !";	
	}	 
	else
	{
		try
		{
			$data = array('name' => $name,'color_code'=>$color_code);
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
	$name = $Common->cleardeta($_POST['name']);
	$color_code = $Common->cleardeta($_POST['color_code']);
	
	if($name=="")
	{
		$error[] = "Provide ".$PageHead." !";	
	}	 
	else
	{
		try
		{
			$data = array('name' => $name,'color_code'=>$color_code);
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
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label>Color Title:</label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Title:" name="name" value="<?php echo $Data['name'] ?>" required class="form-control">
          </div>
          <div class="form-group col-md-12">
              <label> Color Code:</label>
              <input type="color" class="form-control" name="color_code" value="<?php echo $Data['color_code'] ?>" placeholder="Color Code" required>
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
          <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label>Color Title:</label>
              <input type="text" placeholder="<?php  echo $PageHead; ?> Title:" name="name" required class="form-control">
          </div>
          <div class="form-group col-md-12">
              <label> Color Code:</label>
              <input type="color" class="form-control" name="color_code" placeholder="Color Code" required>
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
            <h3>All <?php  echo $PageHead; ?></h3>
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
                <th>Color</th>
                <th>Color Code</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php  
			  $conditions = array('return_type'=>'all');
        $a=1;
			  $showall = $Common->getRows($table,$conditions); 
			if(!empty($showall)){
			for($i=0;$i<count($showall);$i++)
			{  		
			 ?>
              <tr>
                <td><div class="form-check">
                    <input type="checkbox" name="selector[]" value="<?php echo $showall[$i]['id'] ?>" class="form-check-input">
                    <label class="form-check-label">#<?php echo $a; ?></label>
                  </div>
                </td>
                  <td><?php echo $showall[$i]['name'] ?></td> 
                  <td><span style="background:<?php echo $showall[$i]['color_code'] ?>; height:30px; width:30px; display:inline-block; border:solid 1px #e4e4e4">&nbsp;</span></td>  

                <td><?php echo $Common->showstatus($showall[$i]['status']); ?></td>
                <td><a class="dropdown-item" href="<?php echo $page.'&opt=edit&value='.base64_encode(1000+$showall[$i]['id']); ?>"><i class="fas fa-pencil-alt"></i></a></td>
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
