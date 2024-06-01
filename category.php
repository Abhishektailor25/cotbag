<?php include("functions.php"); ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<?php include('includes/meta-utf.php');  ?>
<title>Cotbages</title>
<meta name="description" content="">
<?php include('includes/head.php');  ?>
</head>
<body data-mobile-nav-style="modern">
<!-- Header -->
<?php include('includes/header.php');  ?>
<!-- Header End -->

<section class="breadcrumb-space page-title-center-alignment cover-background top-space-padding" style="background-image: url(images/demo-decor-store-title-bg.jpg)">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center position-relative page-title-extra-large">
        <h1 class="alt-font d-inline-block fw-700 ls-minus-05px text-base-color mb-10px md-mt-50px">Category</h1>
      </div>
      <div class="col-12 breadcrumb breadcrumb-style-01 d-flex justify-content-center">
        <ul>
          <li><a href="<?php echo $Domain; ?>">Home</a></li>
          <li>Category</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- About Us -->

         <section class="pt-3 sm-pt-50px">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 justify-content-center"
                    data-anime="{ &quot;el&quot;: &quot;childs&quot;, &quot;translateY&quot;: [50, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 1200, &quot;delay&quot;: 0, &quot;staggervalue&quot;: 150, &quot;easing&quot;: &quot;easeOutQuad&quot; }">
                    <?php
                      $Menucategory = $Common->selectcategory();
                      for($menu=0;$menu<count($Menucategory);$menu++){
                         $MenuSubcategory = $Common->selectSubCategory($category['id'],4);
                         $url = $Domain.'category/'.$Common->seo_friendly_url($Menucategory[$menu]['Url']); ?>
                    <div class="col mb-30px">
                        <div class="box-shadow-extra-large services-box-style-01 hover-box last-paragraph-no-margin border-radius-4px overflow-hidden">
                           <a href="<?php echo $url ?>">
                             <div class="position-relative box-image">
                                <img src="<?php echo $Domain.'uploads/category/'.$Menucategory[$menu]['Image']  ?>" alt>
                            </div>
                            </a>
                            <div class="bg-white">
                                <div class="bg-dark p-5px text-center">
                                    <a href="<?php echo $url ?> " class="d-inline-block fs-19 primary-font fw-500 text-white mb-5px"><?php echo $Menucategory[$menu]['name'] ?></a>
                                    <!-- <div class="col"> <a href="<?php echo $url ?>" class="btn btn-dark-gray btn-very-small btn-round-edge fw-600">View <span class="btn-icon"><i class="feather icon-feather-arrow-right icon-very-small"></i></span></a> </div> -->

                                  </div>

                            </div>
                        </div>
                    </div>
                   <?php }  ?>
                </div>
            </div>
        </section>



<!-- Footer -->
<?php include('includes/footer.php');  ?>  
<!-- Footer End -->
<!-- Js -->
<?php include('includes/js.php');  ?>  
<!-- Js End -->
</body>
</html>