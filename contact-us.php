<?php include("functions.php"); ?>
<?php

if(isset($_POST['submit']))
{ 
	$Name = $Common->cleardeta($_POST['Name']);
	$Mobile = $Common->cleardeta($_POST['Mobile']);
	$Email = $Common->cleardeta($_POST['Email']);
	$Message = $Common->cleardeta($_POST['Message']);
	
	if($Name=="")	{
		$error[] = "Provide Name  !";	
	}

	else if($Mobile=="")	{
		$error[] = "Provide  Mobile No. !";	
	}
	
	else if($Message=="")	{
		$error[] = "Provide Message !";	
	}
	
	else if($Email=="")	{
		$error[] = "Provide Email !";	
	}
	
	else if($_SESSION['answerproduct']!= $_REQUEST['answer'])
{
		$error[] = "Wrong Capthca !";	
	}
	
	else
			{ 
			
$enquiry = $Common->addcontact($Name,$Email,$Mobile,$Message);
$Common->redirect('thank-you');
			}
	
	}
  $digit1 = mt_rand(1,9);
    $digit2 = mt_rand(1,9);
    if( mt_rand(0,1) === 1 ) {
            $math = "$digit1 + $digit2";
            $_SESSION['answerproduct'] = $digit1 + $digit2;
    } else {
            $math = "$digit1 + $digit2";
            $_SESSION['answerproduct'] = $digit1 + $digit2;
    }
	?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<?php include('includes/meta-utf.php');  ?>
<title>Cotbages : Contact Us</title>
<link rel="canonical" href="<?php echo $Domain; ?>contact-us"/>
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
        <h1 class="alt-font d-inline-block fw-700 ls-minus-05px text-base-color mb-10px md-mt-50px">Contact Us</h1>
      </div>
      <div class="col-12 breadcrumb breadcrumb-style-01 d-flex justify-content-center">
        <ul>
          <li><a href="<?php echo $Domain; ?>">Home</a></li>
          <li>Contact Us</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- About Us -->

<!-- Section -->
<section class="overflow-hidden pb-50px">
  <div class="container">
    <div class="row justify-content-center align-items-center mb-6 sm-mb-45px">
      <div class="col-xxl-5 col-lg-6 md-mb-50px" data-anime="{ &quot;el&quot;: &quot;childs&quot;, &quot;translateX&quot;: [-50, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 1200, &quot;delay&quot;: 0, &quot;staggervalue&quot;: 150, &quot;easing&quot;: &quot;easeOutQuad&quot; }"> <span class="fs-15 text-uppercase text-base-color fw-600 mb-15px d-block ls-1px">Get in touch with us</span>
        <h3 class="fw-700 text-dark-gray ls-minus-1px mb-50px sm-mb-35px">Do you need help? Contact with us now!</h3>
        <div class="icon-with-text-style-01 mb-30px md-mb-35px">
          <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
            <div class="feature-box-icon me-25px"> <img src="images/demo-marketing-contact-04.jpg" class="h-80px" alt> </div>
            <div class="feature-box-content last-paragraph-no-margin"> <span class="d-block text-dark-gray fw-600 fs-18 ls-minus-05px mb-5px">Our Office Location</span>
              <p class="w-60 md-w-100">H-2, RIICO Industrial Area, Mansarovar,Jaipur - 302020 Rajasthan, India</p>
            </div>
          </div>
        </div>
        <div class="icon-with-text-style-01 mb-30px md-mb-35px">
          <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
            <div class="feature-box-icon me-25px"> <img src="images/demo-marketing-contact-02.jpg" class="h-80px" alt> </div>
            <div class="feature-box-content"> <span class="d-block text-dark-gray fw-600 fs-18 ls-minus-05px mb-5px">Feel free to get in touch?</span>
              <div class="w-100 d-block"> <span class="d-block">Phone: <a href="tel:+919599217114">+91-9599-217-114</a></span> <span class="d-block">Phone: <a href="tel:+911412398712">+91-1412-398-712</a></span> </div>
            </div>
          </div>
        </div>
        <div class="icon-with-text-style-01">
          <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
            <div class="feature-box-icon me-25px"> <img src="images/demo-marketing-contact-03.jpg" class="h-80px" alt> </div>
            <div class="feature-box-content"> <span class="d-block text-dark-gray fw-600 fs-18 ls-minus-05px mb-5px">How can we help you?</span>
              <div class="w-100 d-block"> <a href="mailto:info@cotbags.com"><span>info@cotbags.com</span></a> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mt-6 offset-xxl-1" data-anime="{ &quot;el&quot;: &quot;childs&quot;, &quot;translateX&quot;: [50, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 1200, &quot;delay&quot;: 0, &quot;staggervalue&quot;: 150, &quot;easing&quot;: &quot;easeOutQuad&quot; }">
        <div class="contact-form-style-03 position-relative border-radius-10px bg-white p-60px lg-p-10 box-shadow-double-large ">
        <?php
					if(isset($error))
					{
						foreach($error as $error)
						{
							 ?>
            <div class="alert alert-danger"> <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> </div>
            <?php
						}
					}
					else if(isset($_GET['joined']))
					{
						 ?>
            <div class="alert alert-info"> <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully Added </div>
            <?php
					}
					?>
          <form method="post" id="contact-form">
            <div class="position-relative form-group mb-20px"> <span class="form-icon text-dark-gray"><i class="bi bi-person icon-extra-medium"></i></span>
              <input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control required" type="text" name="Name" placeholder="Enter your Name*" value="<?php if(isset($error)){ echo $Name;}?>" required />
            </div>
            <div class="position-relative form-group mb-20px"> <span class="form-icon text-dark-gray"><i class="bi bi-envelope icon-extra-medium"></i></span>
              <input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control required" type="email" name="Email" placeholder="Enter your Email*" value="<?php if(isset($error)){ echo $Email;}?>" required/>
            </div>

             <div class="position-relative form-group mb-20px"> <span class="form-icon text-dark-gray"><i class="bi bi-phone icon-extra-medium"></i></span>
              <input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control required numeric" type="text" name="Mobile" placeholder="Enter your Mobile No.*" maxlength="10" value="<?php if(isset($error)){ echo $Mobile;}?>" required/>
            </div>

            <div class="position-relative z-index-1 form-group form-textarea mt-15px mb-0">
              <textarea class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control" name="Message" placeholder="Enter your Message" rows="2" ><?php if(isset($error)){ echo $Message;}?></textarea>
              <span class="form-icon text-dark-gray"><i class="bi bi-chat-square-dots icon-extra-medium"></i></span>
            
              <div class="form-results mt-20px d-none"></div>
            </div>
            <div class="position-relative form-group mb-20px"> 
              <input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control numeric" type="text" name="answer" placeholder="Captcha <?php echo $math; ?> =" required="" />
              <?php if(isset($error)){ echo $error;}?>
            </div>
            <button class="btn btn-large btn-dark-gray btn-round-edge btn-box-shadow mb-20px mt-25px w-100" name="submit" type="submit">Send message</button>

          </form>
        </div>
      </div>
    </div>
    <div class="row align-items-center justify-content-center">
      <div class="col-md-auto text-center text-md-end sm-mb-20px" data-anime="{ &quot;translateX&quot;: [-50, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 1200, &quot;delay&quot;: 0, &quot;staggervalue&quot;: 150, &quot;easing&quot;: &quot;easeOutQuad&quot; }">
        <h6 class="text-dark-gray fw-600 mb-0 ls-minus-1px">Connect with social media </h6>
      </div>
      <div class="col-2 d-none d-lg-inline-block" data-anime="{ &quot;translateX&quot;: [0, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 1200, &quot;delay&quot;: 0, &quot;staggervalue&quot;: 150, &quot;easing&quot;: &quot;easeOutQuad&quot; }"> <span class="w-100 h-1px bg-dark-gray opacity-2 d-flex mx-auto"></span> </div>
      <div class="col-md-auto elements-social social-icon-style-04 text-center text-md-start ps-lg-0" data-anime="{ &quot;translateX&quot;: [50, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 1200, &quot;delay&quot;: 0, &quot;staggervalue&quot;: 150, &quot;easing&quot;: &quot;easeOutQuad&quot; }">
        <ul class="large-icon dark">
          <li class="m-0"><a class="facebook" href="https://www.facebook.com/people/Cot-Bags/100069746618384/" target="_blank"><i class="fa-brands fa-facebook-f"></i><span></span></a></li>
          <li class="m-0"><a class="instagram" href="https://www.instagram.com/cot_bags/" target="_blank"><i class="fa-brands fa-instagram"></i><span></span></a></li>
          <li class="m-0"><a class="twitter" href="https://twitter.com/Cotbags2" target="_blank"><i class="fa-brands bi-twitter-x"></i><span></span></a></li>
          <li class="m-0"><a class="instagram" href="https://in.pinterest.com/coatbags/" target="_blank"><i class="fa-brands fa-pinterest"></i><span></span></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- Section End -->

<section class="bg-very-light-gray p-0">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 p-0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7120.783659920454!2d75.777144!3d26.827487!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db58982b6a5bd%3A0xf9ab5e2d31b82217!2sRonak%20Industries!5e0!3m2!1sen!2sus!4v1712900236351!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>
<!-- Footer -->
<?php include('includes/footer.php');  ?>  
<!-- Footer End -->
<!-- Js -->
<?php include('includes/js.php');  ?>  
<script src="<?php echo $Domain; ?>js/validate.js"></script>
<!-- Js End -->
<script>
$('#contact-form').validate({
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
</script>
</body>
</html>