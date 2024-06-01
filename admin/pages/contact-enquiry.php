<?php $table = 'contact_us'; $page = 'dashboard?page=contact-enquiry'; $PageHead = 'Contact Enquiry';

?>

<!-- Breadcubs Area Start Here -->

<div class="breadcrumbs-area row">
  <?php if(isset($_REQUEST['opt']))
{
  if($_REQUEST['opt']=='view')  { ?>
 
  <h3 class="col-md-6">All
    <?php  echo $PageHead; ?>
  </h3>
  <ul class="col-md-6 text-right">
    <li> <a href="dashboard">Home</a> </li>
     <li> <a href="<?php echo $page; ?>"><?php echo $PageHead; ?></a> </li>
    <li>All
      <?php  echo $PageHead; ?>
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
  <?php 
if(isset($_REQUEST['opt']))
{
  if($_REQUEST['opt']=='view')  {
	
	$id= base64_decode($_REQUEST['value'])-1000;
		$where = array('id'=>$id);
		$conditions = array('where'=>$where,'limit'=>1,'return_type'=>'single');
		$Data = $Common->getRows($table,$conditions); 
		
		/*$country = ($Data['country']!='') ? $Common->getRows('country',array('where'=>array('id'=>$Data['country']),'limit'=>1,'return_type'=>'single')) : ""; 
		$state = ($Data['state']!='') ? $Common->getRows('state',array('where'=>array('id'=>$Data['state']),'limit'=>1,'return_type'=>'single')) : ""; */
	?>
   <div class="col-12-xxxl col-12">
    <form method="post" action="<?php echo $page ?>" id="validateform">
      <div class="card height-auto">
        <div class="card-body">
          <div class="heading-layout1 row">
            
            <div class="col-md-12 table-responsive">  
            
<table  class="table table-bordered table-striped" width="100%">
          <tr>
            <th>Message</th>
            <td><?php echo $Data['Message']; ?></td>
            
          </tr>
         
         
		    
        </table>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <?php } } else { ?>
  <div class="col-12-xxxl col-12">
    <form method="post" action="<?php echo $page ?>" id="validateform">
      <div class="card height-auto">
        <div class="card-body">
          <div class="heading-layout1 row">
            <div class="item-title col-md-4 tablehead">
              <h3>All <?php echo $PageHead; ?>s</h3>
            </div>
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Message</th>
                  <!-- <th>Message</th> -->
                  <th>Created</th>
                </tr>
              </thead>
              <tbody>
                <?php  
			  $conditions = array('return_type'=>'all');
			  $showall = $Common->getRows($table,$conditions); 
			if(!empty($showall)){
			for($i=0;$i<count($showall);$i++)
			{
				
			 ?>
                <tr>
                  <td><div class="form-check">
                      <input type="checkbox" name="selector[]" value="<?php echo $showall[$i]['Id'] ?>" class="form-check-input">
                      <label class="form-check-label">#<?php echo $showall[$i]['Id'] ?></label>
                    </div></td>
                  <td><?php echo $showall[$i]['Name']; ?></td>
                 <td><?php echo $showall[$i]['Email']; ?></td>
                  <td><?php echo $showall[$i]['Mobile']; ?></td>
                  <!-- <td><?php echo $showall[$i]['Message']; ?></td> -->
                  <td><a class="dropdown-item btn-green" href="<?php echo $page.'&opt=view&value='.base64_encode(1000+$showall[$i]['Id']); ?>"><i class="fas fa-2x fa-eye"></i></a></td>
                  <td><?php echo $Common->showindatendtime($showall[$i]['CreateDate']); ?></td>
                  
                </tr>
                <?php } }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </form>
  </div>
  <?php }?>
</div>
<!-- All <?php  echo $PageHead; ?>s Area End Here --> 
