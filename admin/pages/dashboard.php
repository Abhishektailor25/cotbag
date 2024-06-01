<body>
<!-- Preloader Start Here -->
<!--<div id="preloader"></div>-->
<!-- Preloader End Here -->
<div id="wrapper" class="wrapper bg-ash">
  <?php include("includes/header.php"); ?>
  <!-- Page Area Start Here -->
  <div class="dashboard-page-one">
   <!-- Sidebar Area Start Here -->
<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
  <div class="mobile-sidebar-header d-md-none">
    <div class="header-logo"> <a href="dashboard"><img src="img/catbags-logo.jpg" alt="logo"></a> </div>
  </div>
  <div class="sidebar-menu-content">
    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
    <li class="nav-item "> <a href="dashboard" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a> </li>

    <li class="nav-item sidebar-nav-item <?php if(isset($_REQUEST['page'])){if($_REQUEST['page']=='colors'){ echo 'active'; }} ?>">
      <a href="#" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i><span>Master</span></a>
      <ul class="nav sub-group-menu <?php if(isset($_REQUEST['page'])){if($_REQUEST['page']=='colors'){ echo 'menu-open'; }} ?>">

          <li class="nav-item <?php if(isset($_REQUEST['page'])){if($_REQUEST['page']=='colors'){ echo 'active'; }} ?>">
              <a href="dashboard?page=colors" class="nav-link"><i class="fa fa-brush"></i><span>Colors</span></a>
          </li>
</ul>
        
    </li>
    <li class="nav-item <?php if(isset($_REQUEST['page'])){if($_REQUEST['page']=='category'){ echo 'active'; }} ?>"> <a href="dashboard?page=category" class="nav-link"><i class="fa fa-image"></i><span>Category</span></a>
      </li>
    <li class="nav-item <?php if(isset($_REQUEST['page'])){if($_REQUEST['page']=='product'){ echo 'active'; }} ?>"> <a href="dashboard?page=product" class="nav-link"><i class="fa fa-image"></i><span>Product</span></a>
      </li>
      <li class="nav-item <?php if(isset($_REQUEST['page'])){if($_REQUEST['page']=='contact-enquiry'){ echo 'active'; }} ?>"> <a href="dashboard?page=contact-enquiry" class="nav-link"><i class="fa fa-question-circle"></i><span>Contact Enquiry</span></a>
      </li>
      <li class="nav-item <?php if(isset($_REQUEST['page'])){if($_REQUEST['page']=='product-enquiry'){ echo 'active'; }} ?>"> <a href="dashboard?page=product-enquiry" class="nav-link"><i class="fa fa-question-circle"></i><span>Product Enquiry</span></a>
      </li>
      
    </ul>
  </div>
</div>
<!-- Sidebar Area End Here -->
    <div class="dashboard-content-one">
      <?php 
			$page = @$_REQUEST['page'];
			switch($page)
			{
				case 'category': include("category.php");
				break;
        case 'product': include("product.php");
				break;
        case 'colors': include("colors.php");
				break;
        case 'product-gallery': include("product-gallery.php");
				break;
        case 'contact-enquiry': include("contact-enquiry.php");
				break;
        case 'product-enquiry': include("product-enquiry.php");
				break;
				case 'change-password': include("basic/change-password.php");
				break;
				default:include("basic/dashboard.php");
				
			}
		 
	 ?>
     <?php if(time() >= $_SESSION['expire']) {unset($_SESSION['sessData']); } ?>
      <!-- Footer Area Start Here -->
      <?php include("includes/footer.php"); ?>
      <!-- Footer Area End Here --> 
    </div>
  </div>
  <!-- Page Area End Here --> 
</div>
<!-- jquery--> 
<script src="js/jquery-3.3.1.min.js"></script> 
<!-- Plugins js --> 
<script src="js/plugins.js"></script> 
<!-- Popper js --> 
<script src="js/popper.min.js"></script> 
<!-- Bootstrap js --> 
<script src="js/bootstrap.min.js"></script> 
<!-- Select 2 Js --> 
<script src="js/select2.min.js"></script> 
<!-- Scroll Up Js --> 
<script src="js/jquery.scrollUp.min.js"></script> 
<!-- Data Table Js --> 
<script src="js/jquery.dataTables.min.js"></script> 
  <!-- Date Picker Js -->
    <script src="js/datepicker.min.js"></script>
<!-- Custom Js --> 
<?php if(!isset($_GET['page'])) { ?>
<!-- Counterup Js --> 
<script src="js/jquery.counterup.min.js"></script> 
<!-- Moment Js --> 
<script src="js/moment.min.js"></script> 
<!-- Waypoints Js --> 
<script src="js/jquery.waypoints.min.js"></script> 
<!-- Scroll Up Js --> 
<script src="js/jquery.scrollUp.min.js"></script> 
<!-- Full Calender Js --> 
<script src="js/fullcalendar.min.js"></script> 
<!-- Chart Js --> 
<script src="js/Chart.min.js"></script> 
<!-- Custom Js --> 
<?php }?>
<script src="js/validate.js"></script>  
<script src="js/additional-methods.min.js"></script> 
<script src="js/main.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script> 
<script src="plugins/daterangepicker/daterangepicker.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
function saveToDatabasepriorityfaculty(editableObj,id) {
 $(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
 $.ajax({
 url: "ajax/edit-faculty-priority.php",
 type: "POST",
 data:'editvalue='+editableObj+'&id='+id,
 success: function(data){
 $(editableObj).css("background","#FDFDFD");
}
});
}
</script>
