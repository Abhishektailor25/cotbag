<?php include("functions.php"); $url = $_REQUEST['Url'];
 $productData = $Common->getRows('tbl_product',array('where'=>array('Url'=>$url),'return_type'=>'single','order_by'=>'id asc'));
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<?php include('includes/meta-utf.php');  ?>
<title><?php echo $productData['MetaTitle'];?></title>
<meta name="description" content="<?php echo $MetaDescription = ($productData['MetaDescription']!='')?$productData['MetaDescription']:$productData['name'];?>">
<meta name="keywords" content="<?php echo $MetaKeywords = ($productData['MetaKeyword']!='')?$productData['MetaKeyword']:$productData['name'];?>">
<meta name="robots" content="index,follow">
<link rel="canonical" href="<?php echo $Domain; ?>category/<?php echo $productData['Url'];?>"/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $productData['MetaTitle'];?>"/>
<meta content="<?php echo $productData['MetaDescription'];?>" property="og:description">
<meta property="og:url" content="<?php echo $Domain; ?>category/<?php echo $productData['Url'];?>"/>
<meta property="og:site_name" content="<?php echo $Domain; ?>"/>
<meta name="twitter:card" content="summary"/>
<meta name="twitter:title" content="<?php echo $productData['MetaTitle'];?>"/>
<meta content="<?php echo $productData['MetaDescription'];?>" name="twitter:description">
<?php include('includes/head.php');  ?>
</head>
<body data-mobile-nav-style="modern">
<!-- Header -->
<?php include('includes/header.php');  ?>
    <!-- Header End -->

    <section class="breadcrumb-space page-title-center-alignment cover-background top-space-padding " style="background-image: url(<?php echo $Domain ?>images/demo-decor-store-title-bg.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center position-relative page-title-extra-large">
                    <h1 class="alt-font d-inline-block fw-700 ls-minus-05px text-base-color mb-10px md-mt-50px"> <?php echo $productData['name']   ?></h1>
                </div>
                <div class="col-12 breadcrumb breadcrumb-style-01 d-flex justify-content-center">
                    <ul>
                        <li><a href="<?php echo $Domain; ?>">Home</a></li>
                        <li> <?php echo $productData['name']   ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us -->

<!-- Product -->
<section class="">
  <div class="container">
    <div class="row row-cols-1 row-cols-xl-4 row-cols-md-2 justify-content-center" data-anime="{ &quot;el&quot;: &quot;childs&quot;, &quot;translateY&quot;: [30, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 600, &quot;delay&quot;: 0, &quot;staggervalue&quot;: 300, &quot;easing&quot;: &quot;easeOutQuad&quot; }">
           <?php $product =  $Common->getRows('tbl_product_list',array('where'=>array('status'=>'1','pid'=>$productData['id']),'return_type'=>'all','order_by'=>'id desc'));
                if(!empty($product))
                  {
                  $num = @count($product);
                  for($i=0;$i<$num;$i++)					
                  {
                    $slug = $Domain.'product/'.$Common->seo_friendly_url($product[$i]['slug']);
                ?>
       <div class="col mb-30px">
        <div class="border-radius-6px overflow-hidden box-shadow-large">
          <div class="image position-relative"> <a href="<?php echo $slug ?>"> <img src="<?php echo $Domain.'uploads/product/'.$product[$i]['image']  ?>" alt="<?php echo $product[$i]['description']; ?>" class="w-100"> </a>
          <div class="col-auto bg-base-color border-radius-50px ps-15px pe-15px text-uppercase alt-font fw-600 text-white fs-12 lh-24 position-absolute left-20px top-20px"><?php echo $product[$i]['style']; ?> </div>
          </div>
          <div class="bg-white">
            <div class="bg-dark p-5px text-center">
              <div class="align-items-center text-center"> <a href="<?php echo $slug ?>" class="alt-font text-white fw-600 fs-17 me-10px text-capitalize"><?php echo $product[$i]['description']; ?></a> </div>
              <!-- <p class="mb-20px text-center"> <?php echo $product[$i]['style']; ?></p> -->
               <!-- <div class="col"> <a href="<?php echo $slug ?>" class="btn btn-dark-gray btn-very-small btn-round-edge fw-600">View details <span class="btn-icon"><i class="feather icon-feather-arrow-right icon-very-small"></i></span></a> </div> -->
             </div>
           
          </div>
        </div>
      </div>
      <?php }}?>
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