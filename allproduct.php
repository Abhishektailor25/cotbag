<?php include("functions.php"); ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<?php include('includes/meta-utf.php');  ?>  
<title>Cotbages : About Us</title>
<meta name="description" content="">
<?php include('includes/head.php');  ?>  
</head>
<body data-mobile-nav-style="modern">
<!-- Header --> 
<?php include('includes/header.php');  ?>  
<!-- Header End -->

<!-- Banner -->
<section class="breadcrumb-space page-title-center-alignment cover-background top-space-padding " style="background-image: url(<?php echo $Domain ?>images/demo-decor-store-title-bg.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center position-relative page-title-extra-large">
                    <h1 class="alt-font d-inline-block fw-700 ls-minus-05px text-base-color mb-10px md-mt-50px"> All Product</h1>
                </div>
                <div class="col-12 breadcrumb breadcrumb-style-01 d-flex justify-content-center">
                    <ul>
                        <li><a href="<?php echo $Domain; ?>">Home</a></li>
                        <li> All Product</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<!-- Banner Section -->



<!-- Product -->
<section class="">
  <div class="container">
    <div class="row row-cols-1 row-cols-xl-4 row-cols-md-2 justify-content-center" data-anime="{ &quot;el&quot;: &quot;childs&quot;, &quot;translateY&quot;: [30, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 600, &quot;delay&quot;: 0, &quot;staggervalue&quot;: 300, &quot;easing&quot;: &quot;easeOutQuad&quot; }">
      
<?php
    $cottonProduct =  $Common->getRows('tbl_product_list',array('where'=>array('status'=>'1'),'return_type'=>'all','order_by'=>'id desc'));
                 if(!empty($cottonProduct))
                  {
                    $num = @count($cottonProduct);
                    for($a=0;$a<$num;$a++)                    
                    {  
                      $productslug = $Domain.'product/'.$Common->seo_friendly_url($cottonProduct[$a]['slug']);
                      ?>

       <div class="col mb-30px">
        <div class="border-radius-6px overflow-hidden box-shadow-large">
          <div class="image position-relative"> <a href="<?php echo $productslug ?>"> <img src="<?php echo $Domain.'uploads/product/'.$cottonProduct[$a]['image']  ?>" alt="Stripped cotton Bag" class="w-100"> </a>
          <div class="col-auto bg-base-color border-radius-50px ps-15px pe-15px text-uppercase alt-font fw-600 text-white fs-12 lh-24 position-absolute left-20px top-20px"><?php echo $cottonProduct[$a]['style']?> </div>
            
          </div>
          <div class="bg-white">
            <div class="bg-dark p-5px text-center">
              <div class="text-center align-items-center"> <a href="<?php echo $productslug ?>" class="alt-font text-white fw-600 fs-17 me-10px text-capitalize"><?php echo $cottonProduct[$a]['description']?></a> </div>
            
               <!-- <div class="col"> <a href="<?php echo $productslug ?>" class="btn btn-dark-gray btn-very-small btn-round-edge fw-600">View details <span class="btn-icon"><i class="feather icon-feather-arrow-right icon-very-small"></i></span></a> </div> -->
             </div>
           
          </div>
        </div>
      </div>

      <?php   }}?>
      
      
       

      

     

      
     
     
    </div>
  </div>
</section>
<!-- Product End -->







<!-- Footer -->
<?php include('includes/footer.php');  ?>  
<!-- Footer End -->
<!-- Js -->
<?php include('includes/js.php');  ?>  
<!-- Js End -->
</body>
</html>