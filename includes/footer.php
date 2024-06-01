<!-- Footer -->
<footer class="footer-light bg-gradient-very-light-gray pb-0 pt-3">
  <div class="container">
    <div class="row justify-content-center mt-2 mb-4 sm-mb-35px">
      <div class="col-lg-3 last-paragraph-no-margin md-mb-35px text-center text-lg-start">
        <p class="w-85 lg-w-100">RONAK INDUSTRIES, A highly acclaimed name specializes in the manufacturing and export of a wide variety of shopping bags, canvas bags, Cotton Totes ,cotton canvas bags.</p>
        
      </div>
      <div class="col-6 col-lg-2 col-md-3 sm-mb-25px"> <span class="alt-font fs-18 fw-600 d-block text-dark-gray mb-5px">Company</span>
        <ul>
          <li><a href="<?php echo $Domain; ?>about-us">About us</a></li>
          <li><a href="<?php echo $Domain; ?>why-use-reusable-bag">Why Use Reusable Bag</a></li>
          <li><a href="<?php echo $Domain; ?>contact-us">Contact us</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg-2 col-md-3 sm-mb-25px"> <span class="alt-font fs-18 fw-600 d-block text-dark-gray mb-5px">Resources</span>
        <ul>         
          <li><a href="<?php echo $Domain; ?>process">Process</a></li>
          <li><a href="<?php echo $Domain; ?>quality-policy">Quality Policy</a></li> 
          <li><a href="<?php echo $Domain; ?>faq">FAQ</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg-2 col-md-3"> <span class="alt-font fs-18 fw-600 d-block text-dark-gray mb-5px">Product</span>
      <?php
                    $menuCategories = $Common->selectcategory();
                    foreach ($menuCategories as $category) {
                        $menuSubcategories = $Common->selectSubCategory($category['id'], 4); 
                        $categoryUrl = $Domain . 'category/' . $Common->seo_friendly_url($category['Url']);
						  echo '<ul>';
                        echo '<li><a href="' . $categoryUrl . '">' . $category['name'] . '</a></li>';
                        echo '</ul>';
						if ($category['id'] == 5) {
       								 break;
    						}
						
                    }
                    ?>
        <!--<ul>
           <li><a href="javascript:void(0)">Premium Totes</a></li>
          <li><a href="javascript:void(0)">Classic Totes</a></li>
          <li><a href="javascript:void(0)">Trade Show Totes</a></li>
          <li><a href="javascript:void(0)">Promotional Cotton Bags</a></li>
        </ul>-->
      </div>
      <div class="col-6 col-lg-2 col-md-3"> <span class="alt-font fs-18 fw-600 d-block text-dark-gray mb-10px">Quick Contact</span> <span class="d-block lh-normal">Need support?</span> <a href="mailto:info@cotbags.com" class="text-dark-gray text-decoration-line-bottom lh-22 d-inline-block mb-20px"><span>info@cotbags.com</span></a> <span class="d-block lh-normal">Customer care</span> <a href="tel:+919599217114" class="text-dark-gray text-decoration-line-bottom lh-22 d-inline-block">+91 95992-17114</a>
      <div class="elements-social social-icon-style-02 mt-15px">
          <ul class="small-icon dark">
            <li><a class="facebook" href="https://www.facebook.com/Ronak-Industries-1010506119006409/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
           <li><a class="twitter" href="https://twitter.com/Cotbags2" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
            <li><a class="instagram" href="https://www.instagram.com/cot_bags/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
             <li><a class="pinterest" href="https://in.pinterest.com/coatbags/" target="_blank"><i class="fa-brands fa-pinterest"></i></a></li>
          </ul>
        </div>
    
    </div>

      <div class="col-md-12 ps-5">
        <ul class="footer-navbar xs-lh-normal">
          <li><a href="<?php echo $Domain; ?>shopping-bag-manufacturers-in-india" class="nav-link pb-0">Shopping Bag Manufacturers in India</a></li>
          <li><a href="<?php echo $Domain; ?>promotional-bag-manufacturer-in-india" class="nav-link pb-0">Promotional Bag Manufacturers in India</a></li>
          <li><a href="<?php echo $Domain; ?>grocery-bag-manufacturer-in-india" class="nav-link pb-0">Grocery Bag Manufacturers in India</a></li>
          <li><a href="<?php echo $Domain; ?>cotton-bag-manufacturer-in-usa" class="nav-link ps-0 pt-0">Cotton Bag Manufacturer in USA</a></li>
          <li><a href="<?php echo $Domain; ?>carry-bag-manufacturer-in-india" class="nav-link pt-0">Carry Bag Manufacturer in India</a></li>
          <li><a href="<?php echo $Domain; ?>cotton-bag-manufacturer-in-europe" class="nav-link pt-0">Cotton Bag Manufacturer in Europe</a></li>
        </ul>
      </div>

    </div>

    <div class="row justify-content-center align-items-center">
      <div class="col-12">
        <div class="divider-style-03 divider-style-03-01 border-color-transparent-dark-very-light"></div>
      </div>
      <div class="col-md-6 pt-20px pb-20px sm-pt-0 fs-16 order-2 order-md-1 text-center text-md-start last-paragraph-no-margin">
        <p>© 2024 Ronak Industries. All Rights Reserved</p>
      </div>
      <div class="col-md-6 pt-20px pb-20px sm-pb-10px fs-16 order-1 order-md-2 text-center text-md-end">
        <ul class="footer-navbar xs-lh-normal">
          <li><a href="javascript:void(0)" class="nav-link">Terms and conditions</a></li>
          <li><a href="javascript:void(0)" class="nav-link">Privacy policy</a></li>
        </ul>
      </div>
    </div>
 </div>
</footer>
<!-- Footer End -->

<div class="sticky-wrap z-index-1 d-none d-xl-inline-block"
            data-animation-delay="100" data-shadow-animation="true">
            <div class="elements-social social-icon-style-10">
                <ul class="fs-14">
                    <li class="me-30px"><a class="facebook" href="https://www.facebook.com/Ronak-Industries-1010506119006409/" target="_blank">
                            <i class="fa-brands fa-facebook-f me-10px"></i>
                            <span class="alt-font">Facebook</span>
                        </a>
                    </li>
                    <li class="me-30px">
                        <a class="instagram" href="https://in.pinterest.com/coatbags/" target="_blank">
                            <i class="fa-brands fa-pinterest me-10px"></i>
                            <span class="alt-font">Pinterest</span>
                        </a>
                    </li>
                    <li class="me-30px">
                        <a class="twitter" href="https://twitter.com/Cotbags2" target="_blank">
                            <i class="fa-brands fa-x-twitter me-10px"></i>
                            <span class="alt-font">Twitter</span>
                        </a>
                    </li>
                    <li>
                        <a class="instagram" href="https://www.instagram.com/cot_bags/" target="_blank">
                            <i class="fa-brands fa-instagram me-10px"></i>
                            <span class="alt-font">Instagram</span>
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>

      