<?php

use Config\Services;

$request = Services::request();

?>
<!-- TOP Nav Bar -->
<div class="iq-top-navbar">
  <div class="iq-navbar-custom">
    <div class="iq-sidebar-logo">
      <div class="top-logo">
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light p-0">
      <div class="navbar-left">
        <div class="iq-search-bar">
          <form action="#" class="searchbox">
            <input type="text" class="text search-input" placeholder="Type here to search...">
            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
            <div class="searchbox-datalink">
              <h6 class="pl-3 pt-3">Pages</h6>
              <ul class="m-0 pl-3 pr-3 pb-3">
                <?php if (session('role') == "user") { ?>
                  <li class="iq-bg-primary-hover rounded"><a href="<?= base_url("user/dashboard") ?>" class="nav-link"><i class="ri-home-4-line pr-2"></i>&nbsp;Dashboard</a></li>
                  <li class="iq-bg-primary-hover rounded"><a href="<?= base_url("user/product") ?>" class="nav-link"><i class="ri-shopping-bag-line pr-2"></i>&nbsp;Product</a></li>
                  <li class="iq-bg-primary-hover rounded"><a href="<?= base_url("user/order") ?>" class="nav-link"><i class="ri-shopping-cart-2-line pr-2"></i>&nbsp;Order</a></li>
                <?php } ?>
                <?php if (session('role') == "admin") { ?>
                  <li class="iq-bg-primary-hover rounded"><a href="<?= base_url("admin/dashboard") ?>" class="nav-link"><i class="ri-home-4-line"></i>&nbsp;Dashboard</a></li>
                  <li class="iq-bg-primary-hover rounded"><a href="<?= base_url("admin/banner") ?>" class="nav-link"><i class="ri-image-line"></i>&nbsp;Banner</a></li>
                  <li class="iq-bg-primary-hover rounded"><a href="<?= base_url("admin/event") ?>" class="nav-link"><i class="ri-calendar-event-line"></i>&nbsp;Event</a></li>
                  <li class="iq-bg-primary-hover rounded"><a href="<?= base_url("admin/news") ?>" class="nav-link"><i class="ri-newspaper-line"></i>&nbsp;News</a></li>
                  <li class="iq-bg-primary-hover rounded"><a href="<?= base_url("admin/member") ?>" class="nav-link"><i class="ri-shield-user-line"></i><span>&nbsp;Member</span></a></li>
                <?php } ?>
              </ul>
            </div>
          </form>
        </div>
      </div>
      <div class="iq-menu-bt align-self-center">
        <div class="wrapper-menu">
          <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
          <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      </div>
      <ul class="navbar-list">
        <li>
          <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center bg-custom rounded">
            <img src="<?= base_url('public/assets/images/man.png') ?>" class="img-fluid rounded mr-3" alt="user">
            <div class="caption">
              <h6 class="mb-0 line-height text-white"><?= session('fullname') ?></h6>
              <span class="font-size-12 text-white">Available</span>
            </div>
          </a>
          <div class="iq-sub-dropdown iq-user-dropdown">
            <div class="iq-card shadow-none m-0">
              <div class="iq-card-body p-0 ">
                <div class="bg-custom p-3">
                  <h5 class="mb-0 text-white line-height"><?= session('fullname') ?></h5>
                  <span class="text-white font-size-12">Available</span>
                </div>
                <div class="d-inline-block w-100 text-center p-3">
                  <a class="bg-custom iq-sign-btn" href="<?= base_url("auth/logout") ?>" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- TOP Nav Bar END -->