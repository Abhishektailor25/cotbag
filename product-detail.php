<?php include("functions.php"); $slug = $_REQUEST['slug']; 
$productData = $Common->getRows('tbl_product_list',array('where'=>array('slug'=>$slug),'return_type'=>'single','order_by'=>'id asc'));
if(empty($productData)) {
  echo "No product slug available.";
  exit;
}
$categoryData = $Common->getRows('tbl_product',array('where'=>array('id'=>$productData['pid']),'return_type'=>'single','order_by'=>'id asc'));
?>
 <?php
if(isset($_POST['submit']))
{ 
  
	$Name = $Common->cleardeta($_POST['Name']);
	$Email = $Common->cleardeta($_POST['Email']);
	$Mobile = $Common->cleardeta($_POST['Mobile']);
	$Product_style = $Common->cleardeta($_POST['Product_style']);
	$Description = $Common->cleardeta($_POST['Description']);
		if($Name=="")	{
			$error[] = "Provide Name  !";	
		}
		else if($Email  == '')
		{
		$error[] = 'Enter Email';
		}
		
		else if($Mobile == '')
		{
		$error[] = 'Enter Mobile';
		}
		else if(!preg_match('/^\d{10}$/',$Mobile)) // phone number is not valid
		{
		$error[] = "Enter Correct Mobile Number !";
		}
		
	else if($_SESSION['answerproduct2']!= $_REQUEST['answer'])
    {
		$error[] = "Wrong Capthca !";	
	}
	else
	{ 
    $enquiry = $Common->addenquiry($Name,$Email,$Mobile,$Product_style,$Description);
    $Common->redirect_other($Domain.'thank-you');

	 }
	}

$digit1 = mt_rand(1,9);
  $digit2 = mt_rand(1,9);
  if( mt_rand(0,1) === 1 ) {
   $math2 = "$digit1 + $digit2";
   $_SESSION['answerproduct2'] = $digit1 + $digit2;
  } else {
          $math2 = "$digit1 + $digit2";
          $_SESSION['answerproduct2'] = $digit1 + $digit2;
  }
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<?php include('includes/meta-utf.php');  ?> 
<title>Ronak Industries :: <?php echo $productData['description']; ?> <?php echo $productData['style']; ?></title>
<link rel="canonical" href="<?php echo $Domain; ?>product/<?php echo $productData['slug'];?>"/>
<?php include('includes/head.php');  ?>  
</head>
<body data-mobile-nav-style="modern">
<!-- Header --> 
<?php include('includes/header.php');  ?>  
<!-- Header End -->

<section class="top-space-margin border-top border-color-extra-medium-gray pt-20px pb-10px ps-35px pe-35px lg-ps-25px lg-pe-25px md-ps-15px md-pe-15px sm-ps-0 sm-pe-0" style="background-image: url(<?php echo $Domain ?>images/demo-decor-store-title-bg.jpg)">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 breadcrumb breadcrumb-style-01 fs-15 alt-font">
        <ul>
          <li><a href="<?php echo $Domain  ?>">Home</a></li>
          <li><a href="<?php echo $Domain.'category/'.$Common->seo_friendly_url($categoryData['Url']);  ?>"><?php echo $categoryData['name']   ?> </a></li>
          <li class="text-capitalize"><?php echo $productData['description']  ?><?php echo ' '  ?><?php echo $productData['style']  ?></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="pt-30px md-pt-30px pb-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 pe-50px md-pe-15px md-mb-40px">
        <div class="row overflow-hidden position-relative">
          <div class="col-12 col-lg-10 position-relative order-lg-2 product-image ps-30px md-ps-15px">
            <div class="swiper product-image-slider" data-slider-options="{ &quot;spaceBetween&quot;: 10, &quot;loop&quot;: true, &quot;autoplay&quot;: { &quot;delay&quot;: 2000, &quot;disableOnInteraction&quot;: false }, &quot;watchOverflow&quot;: true, &quot;navigation&quot;: { &quot;nextEl&quot;: &quot;.slider-product-next&quot;, &quot;prevEl&quot;: &quot;.slider-product-prev&quot; }, &quot;thumbs&quot;: { &quot;swiper&quot;: { &quot;el&quot;: &quot;.product-image-thumb&quot;, &quot;slidesPerView&quot;: &quot;auto&quot;, &quot;spaceBetween&quot;: 15, &quot;direction&quot;: &quot;vertical&quot;, &quot;navigation&quot;: { &quot;nextEl&quot;: &quot;.swiper-thumb-next&quot;, &quot;prevEl&quot;: &quot;.swiper-thumb-prev&quot; } } } }" data-thumb-slider-md-direction="horizontal">
            <div class="swiper-wrapper">
              <div class="swiper-slide gallery-box active">
                  <a href="<?php echo $Domain ?>uploads/product/<?php echo $productData['image']; ?>" data-group="lightbox-gallery" title="<?php echo $productData['description']; ?>">
                      <img class="w-100" src="<?php echo $Domain ?>uploads/product/<?php echo $productData['image']; ?>" alt="<?php echo $productData['description']; ?>">
                  </a>
              </div>

                  <?php 
                  $product_gallery = $Common->getRows('product_gallery', array('where' => array('status' => '1', 'product_Id' => $productData['id']),'return_type' => 'all','order_by' => 'id desc'));
                  if (!empty($product_gallery)) {
                      foreach ($product_gallery as $gallery_item) {
                  ?>
                          <div class="swiper-slide gallery-box">
                              <a href="<?php echo $Domain ?>uploads/product/gallery/<?php echo $gallery_item['image']; ?>" data-group="lightbox-gallery" title="<?php echo $productData['description']; ?>">
                                  <img class="w-100" src="<?php echo $Domain ?>uploads/product/gallery/<?php echo $gallery_item['image']; ?>" alt="<?php echo $productData['description']; ?>">
                              </a>
                          </div>
                  <?php
                      }
                  }
                  ?>
          </div>
            </div>
          </div>
    <div class="col-12 col-lg-2 order-lg-1 position-relative single-product-thumb">
    <div class="swiper-container product-image-thumb slider-vertical">
        <div class="swiper-wrapper">
            <?php 
            ?>
            <div class="swiper-slide active">
                <img class="w-100" src="<?php echo $Domain ?>uploads/product/<?php echo $productData['image']; ?>" alt="<?php echo $productData['description']; ?>">
            </div>
            <?php 
            $product_gallery = $Common->getRows('product_gallery', array('where' => array('status' => '1', 'product_Id' => $productData['id']), 'return_type' => 'all','order_by' => 'id desc' ));
            if (!empty($product_gallery)) {
                foreach ($product_gallery as $gallery_item) {
            ?>
                    <div class="swiper-slide">
                        <img class="w-100" src="<?php echo $Domain ?>uploads/product/gallery/thumb/<?php echo $gallery_item['image']; ?>" alt="<?php echo $productData['description']; ?>">
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
        </div>
      </div>
      <div class="col-lg-6 product-info">
        <h5 class="alt-font text-dark-gray fw-600 mb-10px text-capitalize text-dark"><?php echo $productData['description']; ?></h5>
        <div class="d-block d-sm-flex align-items-center mb-20px">
         
          <a href="javascript:void(0)" class=" text-dark-gray fw-500 section-link xs-me-0"></a>
          <div><span class="text-dark-gray fw-500">Style No: </span><?php echo $productData['style']; ?></div>
        </div>
        <p><?php echo $productData['sort_details']; ?></p>
        <table class="table table-hover table-striped">
                    <tbody>
                    <tr>
                                <th scope="row" class="fw-600 fs-16 w-20">Style</th>
                                <td><?php echo $productData['style']  ?></td>
                            </tr>
                            <?php if($productData['size']!='') { ?>
                            <tr>
                                <th scope="row" class="fw-600 fs-16">Size </th>
                                <td><?php echo $productData['size']  ?></td>
                            </tr>
                            <?php } if($productData['fabric']!='') { ?>
                            <tr>
                                <th scope="row" class="fw-600 fs-16">Fabric</th>
                                <td><?php echo $productData['fabric']  ?></td>
                            </tr>
                            <?php } if($productData['handle']!='') {   ?>
                            <tr>
                                <th scope="row" class="fw-600 fs-16">Handle</th>
                                <td><?php echo $productData['handle']  ?></td>
                            </tr>
                            <?php } if($productData['color']!='') {   ?>
                            <tr>
                                <th scope="row" class="fw-600 fs-16">Colour</th>
                                <td><?php echo $productData['color']  ?> or any custom colour available</td>
                            </tr>
                            <?php }  ?>
                    </tbody>
                  </table>

       
      <div class="d-flex align-items-center flex-column flex-sm-row mb-20px position-relative">
          <a href="#contact-form" class="btn btn-cart btn-extra-large btn-switch-text btn-box-shadow btn-none-transform btn-dark-gray left-icon border-radius-5px me-15px xs-me-0 order-3 order-sm-2 popup-with-form">
              <span> <span><i class="feather icon-feather-shopping-bag"></i></span> <span class="btn-double-text ls-0px flex-shrink-0" data-text="Ask for Price">Ask for Price</span> </span> </a>
      </div>
        
        <div class="mb-20px h-1px w-100 bg-extra-medium-gray d-block"></div>
        <div class="row mb-15px">
          <div class="col-12 icon-with-text-style-08 mb-10px">
            <div class="feature-box feature-box-left-icon d-inline-flex align-middle">
              <div class="feature-box-icon me-10px"> <i class="feather icon-feather-archive top-8px position-relative align-middle text-dark-gray"></i> </div>
              <div class="feature-box-content"> <span><a href="<?php echo $Domain.'category/'.$Common->seo_friendly_url($categoryData['Url']);  ?>"><span class="alt-font text-dark-gray fw-500">Category:</span> <?php echo $categoryData['name']   ?> </span></a> </div>
            </div>
          </div>
        </div>
       </div>
    </div>
  </div>
</section>

<!-- Tab Content -->
<section id="tab" class="pb-20px pt-4 sm-pt-40px">
  <div class="container">
    <div class="row">
      <div class="col-12 tab-style-04">
        <ul class="nav nav-tabs border-0 justify-content-center alt-font fs-20">
        <?php if(!empty($productData['bottom_description'])) { ?>
          <li class="nav-item"><a data-bs-toggle="tab" href="#tab_five1" class="nav-link ">Description<span class="tab-border bg-dark-gray"></span></a></li>
          <?php } ?>
          <?php if(!empty($productData['product_specification'])) { ?>
          <li class="nav-item"><a class="nav-link " data-bs-toggle="tab" href="#tab_five2">Product Specification<span class="tab-border bg-dark-gray"></span></a></li>
          <?php } ?>
          <?php if(!empty($productData['care_instruction'])) { ?>
          <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab_five3">Care & Instruction<span class="tab-border bg-dark-gray"></span></a></li>
          <?php } ?>
        </ul>
        <div class="mb-5 h-1px w-100 bg-extra-medium-gray sm-mt-10px xs-mb-8"></div>
        <div class="tab-content">
          <!-- Tab Content 1 -->
          <div class="tab-pane fade in " id="tab_five1">
            <div class="row align-items-center justify-content-center mb-5 sm-mb-10">
              <div class="col-lg-12 md-mb-40px">
              <div class="forlist text-dark"><?php echo $productData['bottom_description'] ?></div>
                
              </div>
            </div>
          </div>
            <!-- Tab Content 1 End -->

            <!-- Tab Content 2 --> 
          <div class="tab-pane fade in " id="tab_five2">
          <div class="forlist text-dark"><?php echo $productData['product_specification'] ?></div>
          </div>
           <!-- Tab Content 2 End -->

          <!-- Tab Content 3 -->
          <div class="tab-pane fade in active show" id="tab_five3">
            <div class="row">
              <div class="col-md-12 last-paragraph-no-margin sm-mb-30px">
             <div class="instruction-content">   
             <div class="forlist text-dark"><?php echo $productData['care_instruction'] ?></div>
            </div>
              </div>
             
            </div>
          </div>
          <!-- Tab Content 3 End -->
         
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Tab Content End -->

<!-- Related Product -->
<section class="overflow-hidden position-relative bg-gradient-very-light-gray">
  <div class="container">
    <div class="row align-items-center mb-5 sm-mb-30px text-center text-lg-start" data-anime="{ &quot;el&quot;: &quot;childs&quot;, &quot;translateY&quot;: [30, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 600, &quot;delay&quot;:0, &quot;staggervalue&quot;: 300, &quot;easing&quot;: &quot;easeOutQuad&quot; }">
      <div class="col-lg-9 md-mb-30px">
        <h4 class="alt-font text-dark-gray fw-600 ls-minus-2px mb-0">You may also like</h4>
      </div>
      
      <div class="col-xl-3 col-lg-3 d-flex justify-content-end">
        <div class="slider-one-slide-prev-1 icon-small text-dark-gray swiper-button-prev slider-navigation-style-04 bg-white box-shadow-large"><i class="fa-solid fa-arrow-left"></i></div>
        <div class="slider-one-slide-next-1 icon-small text-dark-gray swiper-button-next slider-navigation-style-04 bg-white box-shadow-large"><i class="fa-solid fa-arrow-right"></i></div>
      </div>
    </div>
    <div class="row align-items-center" data-anime="{ &quot;opacity&quot;: [0,1], &quot;duration&quot;: 600, &quot;delay&quot;:0, &quot;staggervalue&quot;: 300, &quot;easing&quot;: &quot;easeOutQuad&quot; }">
      <div class="col-12">
        <div class="outside-box-right-0 sm-outside-box-right-0">
          <div class="swiper slider-one-slide" data-slider-options="{ &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 30, &quot;loop&quot;: true, &quot;navigation&quot;: { &quot;nextEl&quot;: &quot;.slider-one-slide-next-1&quot;, &quot;prevEl&quot;: &quot;.slider-one-slide-prev-1&quot; }, &quot;autoplay&quot;: { &quot;delay&quot;: 4000, &quot;disableOnInteraction&quot;: false }, &quot;keyboard&quot;: { &quot;enabled&quot;: true, &quot;onlyInViewport&quot;: true }, &quot;breakpoints&quot;: { &quot;1200&quot;: { &quot;slidesPerView&quot;: 4 }, &quot;992&quot;: { &quot;slidesPerView&quot;: 4 }, &quot;768&quot;: { &quot;slidesPerView&quot;: 2 }, &quot;320&quot;: { &quot;slidesPerView&quot;: 1 } }, &quot;effect&quot;: &quot;slide&quot; }">
            <div class="swiper-wrapper">

            <?php $AllProduct = $Common->getreletedproduct($productData['pid'],$productData['id']);
              if (!empty($AllProduct)) {
				for($prod=0;$prod<count($AllProduct);$prod++)
				{
          $slug = $Domain.'product/'.$Common->seo_friendly_url($AllProduct[$prod]['slug']);
				 ?>

              <div class="swiper-slide">
                <div class="col mb-30px">
                  <div class="border-radius-6px overflow-hidden box-shadow-large">
                    <div class="image position-relative"> <a href="<?php echo $slug  ?>"> <img src="<?php echo $Domain ?>uploads/product/<?php echo $AllProduct[$prod]['image'] ?>" alt="Cargo Tote"> </a>
                      <div class="col-auto bg-base-color border-radius-50px ps-15px pe-15px text-uppercase alt-font fw-600 text-white fs-12 lh-24 position-absolute left-20px top-20px"><?php echo $AllProduct[$prod]['style'] ?>  </div>
                    </div>
                    <div class="bg-white">
                      <div class="bg-dark p-5px text-center">
                        <div class="align-items-center text-center"> <a href="<?php echo $slug  ?>" class="alt-font text-white fw-600 fs-17 me-10px text-capitalize"><?php echo $AllProduct[$prod]['description'] ?></a> </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } }?>
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Related Product End -->

<!-- Footer -->
<?php include('includes/footer.php');  ?>  
<!-- Footer End -->

<!-- Js -->
<?php include('includes/js.php');  ?>  
<script src="<?php echo $Domain; ?>js/validate.js"></script>
<!-- Js End -->

</body>
</html>
<!-- product enq -->

<!-- enquier form -->
<div id="contact-form"  class="container p-0 contact-form-style-01 position-relative mfp-hide contact-form-enquiry">
    <div class="row g-0">
        <div class="col-lg-5 cover-background md-h-600px xs-h-400px" style="background-image:url('<?php echo $Domain ?>images/about-3.webp');"></div>
        <div class="col-lg-7">
            <div class="p-3 lg-p-10 bg-white">
                <h6 class="d-inline-block alt-font fw-600 text-dark-gray ls-minus0px fs-20">Ask  Price  For  <?php echo $productData['description']; ?><?php echo ' ' ?><?php echo $productData['style']; ?></h6>
               
            <div class="alert alert-danger" id="captchaError" style="display: none;"> Wrong Captha  </div>
            
                <form id="quoteform" method="post">
                    <div class="position-relative form-group mb-20px">
                        <span class="form-icon"><i class="bi bi-emoji-smile"></i></span>
                        <input type="text" name="Name" class="form-control required" value="<?php if(isset($error)){ echo $Name;}?>"  placeholder="Enter your Full Name*" required />
                    </div>
                    <div class="position-relative form-group mb-20px">
                        <span class="form-icon"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="Email" value="<?php if(isset($error)){ echo $Email;}?>" class="form-control required" placeholder="Enter your Email id*" required >
                    </div>
                    <div class="position-relative form-group mb-20px">
                        <span class="form-icon"><i class="bi bi-telephone-outbound"></i></span>
                        <input type="text" name="Mobile" class="form-control numeric required" value="<?php if(isset($error)){ echo $Mobile;}?>" placeholder="Your Mobile Number"  maxlength="10" required />
                    </div>
                    <div class="position-relative form-group form-textarea mb-20px">
                        <span class="form-icon"><i class="bi bi-chat-square-dots"></i></span>
                        <textarea placeholder="Description" name="Description"  class="form-control" rows="2">"I am interested in <?php echo $productData['description']; ?> (<?php echo $productData['style']; ?>). Please send details & quotations."</textarea>
                        <input type="hidden" name="Product_style" value="<?php echo $productData['description']; ?> (<?php echo $productData['style']; ?>)" class="input-name form-control" placeholder="Product_style" data-bv-field="contact_name" required>

                    </div>
                    <div class="position-relative form-group mb-20px">
                        <input type="text" name="answer" id="captcha" class="form-control numeric required" placeholder="Captcha What's <?php echo $math2; ?> ="  required/>
                        
                    </div>
                    <button class="btn btn-medium btn-base-color btn-box-shadow btn-round-edge w-100 mt-20px" name="submit" id="submitBtn" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
  $('#quoteform').validate({
    rules: {
        Name: {
            required: true,
            minlength: 3,
        },
		 
        Email: {
            email: true,
            required: true,
        },
        Mobile: {
            required: true,
            number: true,
            minlength: 10,
        },
    },
});
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("submitBtn").addEventListener("click", function(event) {
        var captchaInput = document.getElementById("captcha").value;
        if (captchaInput != "<?php echo $_SESSION['answerproduct2']; ?>") {
            event.preventDefault(); 
            document.getElementById("captchaError").style.display = "block";
        } else {
            document.getElementById("captchaError").style.display = "none";
        }
    });
});


</script>