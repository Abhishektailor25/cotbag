 <!-- Header Menu Area Start Here -->
  <div class="navbar navbar-expand-md header-menu-one bg-light">
    <div class="nav-bar-header-one">
      <div class="header-logo"> <a href="dashboard"> <img src="img/catbags-logo.jpg" alt="logo"> </a> </div>
      <div class="toggle-button sidebar-toggle">
        <button type="button" class="item-link"> <span class="btn-icon-wrap"> <span></span> <span></span> <span></span> </span> </button>
      </div>
    </div>
    <div class="d-md-none mobile-nav-bar">
      <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false"> <i class="far fa-arrow-alt-circle-down"></i> </button>
      <button type="button" class="navbar-toggler sidebar-toggle-mobile"> <i class="fas fa-bars"></i> </button>
    </div>
    <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
      <ul class="navbar-nav">
        <li class="navbar-item header-search-bar">
          <div class="input-group stylish-input-group"><!--<img src="img/big-logo.png" alt="logo">-->
          </div>
        </li>
      </ul>
      <ul class="navbar-nav">
          <li class="navbar-item header-message"> <a class="navbar-nav-link " href="<?php echo $Domain;?>" target="_blank"> <i class="fa fa-globe"></i> </a>
           
        </li>
        <li class="navbar-item dropdown header-admin"> <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"aria-expanded="false">
          <div class="admin-title">
            <h5 class="item-title"><?php echo $UserRow['name']; ?></h5>
            <span>Super Admin</span> </div>
          <div class="admin-img"> <img src="img/figure/admin.jpg" alt="Admin"> </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="item-header">
              <h6 class="item-title"><?php echo $UserRow['name']; ?></h6>
            </div>
            <div class="item-content">
              <ul class="settings-list">
            <!--    <li><a href="dashboard?page=my-profile"><i class="flaticon-user"></i>My Profile</a></li>-->
                 <li><a href="dashboard?page=change-password"><i class="flaticon-gear-loading"></i>Change Password</a></li> 
                <li><a href="basic/logout?logout=true"><i class="flaticon-turn-off"></i>Log Out</a></li>
              </ul>
            </div>
          </div>
        </li>
        
      </ul>
    </div>
  </div>
  <!-- Header Menu Area End Here --> 