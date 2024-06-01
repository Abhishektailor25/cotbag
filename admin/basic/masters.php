<?php if(isset($_REQUEST['type'])){
$MasterDetails =  $Common->getRows('masters_types',array('where'=>array('url'=>$_REQUEST['type']),'limit'=>1,'return_type'=>'single')); }
$MasterId = $MasterDetails['id'];
$table = 'masters';
$page = 'dashboard?page=master&type='.$_REQUEST['type'];
if(isset($_POST['SubmitIt']))
{
	$Heading = $Common->cleardeta($_POST['Heading']); 	
	if($Heading=="")
	{
		$error[] = "Provide Heading !";	
	}	 
	else
	{
		try
		{
			$data = array('master_type_id' => $MasterId,'heading' => $Heading);
			if($Common->insert($table,$data))
			{
				$statusMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$MasterDetails['heading'].' has been added successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
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
 	$id = base64_decode($_REQUEST['id'])-1000;;
	$Heading = $Common->cleardeta($_POST['Heading']); 	
	if($Heading=="")
	{
		$error[] = "Provide Heading !";	
	}	 
	else
	{
		try
		{
			$data = array('heading' => $Heading);
			$condition = array('id' => $id);
			if($Common->update($table,$data,$condition))
			{
				$statusMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$MasterDetails['heading'].' has been updated successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';				
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
  <h3 class="col-md-6">All <?php echo $MasterDetails['heading']; ?></h3>
  <ul class="col-md-6 text-right">
    <li> <a href="dashboard">Home</a> </li>
    <li>Master</li>
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
if(isset($_REQUEST['opt']))
{
	if($_REQUEST['opt']=='edit')
	{
		$id= base64_decode($_REQUEST['value'])-1000;
		$where = array('id'=>$id);
		$conditions = array('where'=>$where,'limit'=>1,'return_type'=>'single');
		$Data = $Common->getRows($table,$conditions); 
	
	 ?>
<div class="col-4-xxxl col-12">
    <div class="card height-auto">
      <div class="card-body">
        <div class="heading-layout1">
          <div class="item-title">
            <h3>Edit  <?php echo $MasterDetails['heading']; ?></h3>
          </div>
        </div>
        <form class="new-added-form" action="<?php echo $page ?>" method="post">
          <input type="hidden" name="id" value="<?php echo $_REQUEST['value']; ?>" />
          <div class="row">
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label><?php echo $MasterDetails['heading']; ?> Name *</label>
              <input type="text" placeholder="<?php echo $MasterDetails['heading']; ?> Name" value="<?php echo $Data['heading']; ?>" name="Heading" required class="form-control">
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
}
else {?>
  <div class="col-4-xxxl col-12">
    <div class="card height-auto">
      <div class="card-body">
        <div class="heading-layout1">
          <div class="item-title">
            <h3>Add New <?php echo $MasterDetails['heading']; ?></h3>
          </div>
        </div>
        <form class="new-added-form" action="<?php echo $page ?>" method="post">
          <input type="hidden" name="MasterId" value="<?php echo $MasterDetails['id']; ?>" />
          <div class="row">
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
              <label><?php echo $MasterDetails['heading']; ?> Name *</label>
              <input type="text" placeholder="<?php echo $MasterDetails['heading']; ?> Name" name="Heading" required class="form-control">
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
  <?php } ?>
  <div class="col-8-xxxl col-12">
   <form method="post" action="<?php echo $page ?>" id="validateform">    
    <div class="card height-auto">
      <div class="card-body">
        <div class="heading-layout1 row">
          <div class="item-title col-md-4 tablehead">
            <h3>All <?php echo $MasterDetails['heading']; ?></h3>
          </div>
          <div class="col-md-8  text-right"><input type="submit"  class="btn-fill-lg radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" value="Active" name="Active" style="margin:10px;">
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
                <th>Heading</th>
                <th>Status</th>
                <th>Created</th>
                <th>Modified</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php  
			  $conditions = array('where'=>array('master_type_id'=>$MasterDetails['id']),'return_type'=>'all');
			  $showall = $Common->getRows($table,$conditions); 
			//$showall = $Common->select_all_data_by_given_order_by_status('masters','master_type_id',$MasterDetails['id'],'id','Asc');
			if(!empty($showall)){
			for($i=0;$i<count($showall);$i++)
			{				 

			 ?>
              <tr>
                <td><div class="form-check">
                    <input type="checkbox" name="selector[]" value="<?php echo $showall[$i]['id'] ?>" class="form-check-input">
                    <label class="form-check-label">#<?php echo $showall[$i]['id'] ?></label>
                  </div></td>
                <td><?php echo $showall[$i]['heading'] ?></td>
                <td><?php echo $Common->showstatus($showall[$i]['status']); ?></td>
                <td><?php echo $Common->showindatendtime($showall[$i]['created']); ?></td>
                <td><?php echo $Common->showindatendtime($showall[$i]['modified']); ?></td>
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
<!-- All Subjects Area End Here -->
