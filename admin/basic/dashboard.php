<!-- Breadcubs Area Start Here -->
<div class="breadcrumbs-area">
  <h3><?php echo $UserRow['name']; ?> Dashboard</h3>
  <ul>
    <li> <a href="dashboard">Home</a> </li>
    <li>Dashboard</li>
  </ul>
</div>
<!-- Breadcubs Area End Here --> 
 <div class="row">
    <!-- Dashboard summery Start Here -->
    <div class="col-12 col-4-xxxl">
        <div class="row">
            
           <div class="col-6-xxxl col-lg-3 col-sm-6 col-12">
                <a href="dashboard?page=contact-enquiry">
                <div class="dashboard-summery-two">
                    <div class="item-icon bg-light-blue">
                        <i class="fa fa-question-circle"></i>
                    </div>
                    <div class="item-content">
                        <div class="item-number"><span class="counter" data-num="<?php echo count($Common->getRows('contact_us',array('return_type'=>'all','order_by'=>'id asc'))) ?>"><?php echo count($Common->getRows('contact_us',array('return_type'=>'all','order_by'=>'id asc'))) ?></span></div>
                        <div class="item-title">Total Contact Enquiry </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-6-xxxl col-lg-3 col-sm-6 col-12">
                <a href="dashboard?page=product-enquiry">
                <div class="dashboard-summery-two">
                    <div class="item-icon bg-light-blue">
                        <i class="fa fa-question-circle"></i>
                    </div>
                    <div class="item-content">
                        <div class="item-number"><span class="counter" data-num="<?php echo count($Common->getRows('enquiry_popup',array('return_type'=>'all','order_by'=>'id asc'))) ?>"><?php echo count($Common->getRows('enquiry_popup',array('return_type'=>'all','order_by'=>'id asc'))) ?></span></div>
                        <div class="item-title">Total Product Enquiry </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-6-xxxl col-lg-3 col-sm-6 col-12">
                <a href="dashboard?page=category">
                <div class="dashboard-summery-two">
                    <div class="item-icon bg-light-blue">
                        <i class="fa fa-image text-blue"></i>
                    </div>
                    <div class="item-content">
                        <div class="item-number"><span class="counter" data-num="<?php echo count($Common->getRows('tbl_product',array('return_type'=>'all','order_by'=>'id asc'))) ?>"><?php echo count($Common->getRows('tbl_product',array('return_type'=>'all','order_by'=>'id asc'))) ?></span></div>
                        <div class="item-title">Total Category</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-6-xxxl col-lg-3 col-sm-6 col-12">
                <a href="dashboard?page=product">
                <div class="dashboard-summery-two">
                    <div class="item-icon bg-light-blue">
                        <i class="fa fa-image text-blue"></i>
                    </div>
                    <div class="item-content">
                        <div class="item-number"><span class="counter" data-num="<?php echo count($Common->getRows('tbl_product_list',array('return_type'=>'all','order_by'=>'id asc'))) ?>"><?php echo count($Common->getRows('tbl_product_list',array('return_type'=>'all','order_by'=>'id asc'))) ?></span></div>
                        <div class="item-title">Total Product</div>
                    </div>
                </div>
                </a>
            </div>
        


        </div>
    </div>
    <!-- Dashboard summery End Here -->
</div>
                
                 