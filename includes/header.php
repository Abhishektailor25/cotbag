<!-- Header --> 
<header>
  <nav class="navbar navbar-expand-lg header-light bg-white border-color-extra-medium-gray header-reverse" data-header-hover="light">
    <div class="container-fluid">
      <div class="col-auto"> <a class="navbar-brand" href="<?php echo $Domain; ?>"> 
        <img src="<?php echo $Domain; ?>images/logo.jpg" data-at2x="<?php echo $Domain; ?>images/logo.jpg" alt class="default-logo"> 
        <img src="<?php echo $Domain; ?>images/logo.jpg" data-at2x="<?php echo $Domain; ?>images/logo.jpg" alt class="alt-logo"> 
        <img src="<?php echo $Domain; ?>images/logo.jpg" data-at2x="<?php echo $Domain; ?>images/logo.jpg" alt class="mobile-logo"> </a> 
      </div>
      <div class="col-auto menu-order left-nav ps-60px lg-ps-20px">
        <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation"> <span class="navbar-toggler-line"></span> <span class="navbar-toggler-line"></span> <span class="navbar-toggler-line"></span> <span class="navbar-toggler-line"></span> </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
          <ul class="navbar-nav alt-font">
            <li class="nav-item"><a href="<?php echo $Domain; ?>" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="<?php echo $Domain; ?>about-us" class="nav-link">About</a></li>

             <li class="nav-item dropdown submenu"> <a href="<?php echo $Domain; ?>category" class="nav-link">Products</a> <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink1" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
              <div class="dropdown-menu submenu-content" aria-labelledby="navbarDropdownMenuLink1">
                <div class="d-lg-flex mega-menu m-auto flex-column">
                  <div class="row row-cols-1 row-cols-lg-4 mb-50px md-mb-20px">
                  <?php
                    $menuCategories = $Common->selectcategory();
                    foreach ($menuCategories as $category) {
                        $menuSubcategories = $Common->selectSubCategory($category['id'], 4); 
                        $categoryUrl = $Domain . 'category/' . $Common->seo_friendly_url($category['Url']);
                        echo '<div class="col md-mb-5px">';
                        echo '<ul class="mb-4">';
                        echo '<li class="sub-title"><a class="sub-title" href="' . $categoryUrl . '">' . $category['name'] . '</a></li>';
                        foreach ($menuSubcategories as $subcategory) {
                            $slug = $Domain . 'product/' . $Common->seo_friendly_url($subcategory['slug']);
                            echo '<li class="text-capitalize"><a href="' . $slug . '">' . $subcategory['description'] . ' ' . $subcategory['style'] . '</a></li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                    }
                    ?>

                  </div>
                 </div>
              </div>
            </li>
 
            <li class="nav-item"><a href="<?php echo $Domain; ?>process" class="nav-link">Process</a></li>
            <li class="nav-item"><a href="<?php echo $Domain; ?>quality-policy" class="nav-link">Quality Policy</a></li>
            <li class="nav-item"><a href="<?php echo $Domain; ?>faq" class="nav-link">FAQ's</a></li>
          </ul>
        </div>
      </div>
      <div class="col-auto ms-auto ps-lg-0 d-none d-sm-flex">
        <div class="d-none d-xl-flex me-25px">
          <div class="d-flex align-items-center widget-text fw-600 alt-font"><a href="tel:+919599217114" class="d-inline-block"><span class="d-inline-block align-middle me-10px bg-base-color-transparent h-45px w-45px text-center rounded-circle fs-16 lh-46 text-base-color"><i class="feather icon-feather-phone-outgoing"></i></span><span class="d-none d-xxl-inline-block">+91 95992-17114</span></a></div>
        </div>
        <div class="header-icon">
          <div class="header-button"> <a href="<?php echo $Domain; ?>contact-us" class="btn btn-base-color btn-small btn-round-edge btn-hover-animation-switch"> <span> <span class="btn-text">Get In Touch</span> <span class="btn-icon"><i class="feather icon-feather-arrow-right icon-very-small"></i></span> <span class="btn-icon"><i class="feather icon-feather-arrow-right icon-very-small"></i></span> </span> </a> </div>
        </div>
      </div>
    </div>
  </nav>
</header>
<!-- Header End -->