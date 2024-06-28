<?php

use Config\Services;

$request = Services::request();

?>
<!-- loader Start -->
<div id="loading">
  <div id="loading-center">
  </div>
</div>
<!-- loader END -->
<!-- Wrapper Start -->
<div class="wrapper">
  <!-- Sidebar  -->
  <div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
      <a href="">
        <img src="<?= base_url('public/assets/images/Logo_Saka.png') ?>" class="img-fluid" alt="">
        <span>SAKA</span>
      </a>
      <div class="iq-menu-bt-sidebar">
        <div class="iq-menu-bt align-self-center">
          <div class="wrapper-menu">
            <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
            <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
          </div>
        </div>
      </div>
    </div>

    <?php if (session('role') == "admin") { ?>
      <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
          <ul id="iq-sidebar-toggle" class="iq-menu">
            <li class="<?= $request->uri->getSegment(2) == "dashboard" ? "active" : "" ?>">
              <a href="<?= base_url("admin/dashboard") ?>" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Dashboard</span></a>
            </li>
            <li class="<?= $request->uri->getSegment(2) == "banner" ? "active" : ($request->uri->getSegment(2) == "news" ? "active" : ($request->uri->getSegment(2) == "event" ? "active" : "")) ?>">
              <a href="#content" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="true"><i class="ri-edit-line"></i><span>Content</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
              <ul id="content" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                <li class="<?= $request->uri->getSegment(2) == "banner" ? "active" : "" ?>"><a href="<?= base_url("admin/banner") ?>"><i class="ri-image-line"></i>Banner</a></li>
                <li class="<?= $request->uri->getSegment(2) == "event" ? "active" : "" ?>"><a href="<?= base_url("admin/event") ?>"><i class="ri-calendar-event-line"></i>Event</a></li>
                <li class="<?= $request->uri->getSegment(2) == "news" ? "active" : "" ?>"><a href="<?= base_url("admin/news") ?>"><i class="ri-newspaper-line"></i>News</a></li>
              </ul>
            </li>
            <!-- <li class="<?= $request->uri->getSegment(2) == "commerce-banner" ? "active" : ($request->uri->getSegment(2) == "category" ? "active" : ($request->uri->getSegment(2) == "campaign" ? "active" : ($request->uri->getSegment(2) == "reportOrder" ? "active" : ($request->uri->getSegment(2) == "configuration" ? "active" : ($request->uri->getSegment(2) == "courier" ? "active" : ""))))) ?>">
              <a href="#commerce" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="true"><i class="ri-store-2-line"></i><span>Commerce</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
              <ul id="commerce" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                <li class="<?= $request->uri->getSegment(2) == "commerce-banner" ? "active" : "" ?>"><a href="<?= base_url("admin/commerce-banner") ?>"><i class="ri-image-line"></i>Commerce Banner</a></li>
                <li class="<?= $request->uri->getSegment(2) == "category" ? "active" : "" ?>"><a href="<?= base_url("admin/category") ?>"><i class="ri-list-check"></i>Category</a></li>
                <li class="<?= $request->uri->getSegment(2) == "campaign" ? "active" : "" ?>"><a href="<?= base_url("admin/campaign") ?>"><i class="ri-settings-3-line"></i>Campaign</a></li>
                <li class="<?= $request->uri->getSegment(2) == "reportOrder" ? "active" : "" ?>"><a href="<?= base_url("admin/reportOrder/status/received") ?>"><i class="ri-file-text-line"></i>Report Order</a></li>
                <li class="<?= $request->uri->getSegment(2) == "configuration" ? "active" : "" ?>"><a href="<?= base_url("admin/configuration") ?>"><i class="ri-sound-module-line"></i>Configuration</a></li>
                <li class="<?= $request->uri->getSegment(2) == "courier" ? "active" : "" ?>"><a href="<?= base_url("admin/courier") ?>"><i class="ri-truck-line"></i>Courier</a></li>
              </ul>
            </li> -->
            <li class="<?= $request->uri->getSegment(2) == "broadcast" ? "active" : "" ?>" style="margin-top:10px;">
              <a href="<?= base_url("admin/broadcast") ?>" class="iq-waves-effect"><i class="ri-broadcast-fill"></i><span>Broadcast</span></a>
            </li>
            <li class="<?= $request->uri->getSegment(2) == "member" ? "active" : "" ?>" style="margin-top:10px;">
              <a href="<?= base_url("admin/member") ?>" class="iq-waves-effect"><i class="ri-shield-user-line"></i><span>Member</span></a>
            </li>
            <li class="<?= $request->uri->getSegment(2) == "member" ? "active" : "" ?>" style="margin-top:10px;">
              <a href="<?= base_url("admin/scannerjoin") ?>" class="iq-waves-effect"><i class="ri-user-follow-line"></i><span>Scanner Join</span></a>
            </li>
            <li class="<?= $request->uri->getSegment(2) == "setting" ? "active" : "" ?>" style="margin-top:10px;">
              <a href="<?= base_url("admin/setting") ?>" class="iq-waves-effect"><i class="ri-settings-3-line"></i><span>Setting</span></a>
            </li>
          </ul>
        </nav>
        <div class="p-3"></div>
      </div>
    <?php } ?>

    <?php if (session('role') == "client") { ?>
      <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
          <ul id="iq-sidebar-toggle" class="iq-menu">
            <li class="<?= $request->uri->getSegment(2) == "dashboard" ? "active" : "" ?>">
              <a href="<?= base_url("admin/dashboard") ?>" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Dashboard</span></a>
            </li>
            <li class="<?= $request->uri->getSegment(2) == "banner" ? "active" : ($request->uri->getSegment(2) == "news" ? "active" : ($request->uri->getSegment(2) == "event" ? "active" : "")) ?>">
              <a href="#content" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="true"><i class="ri-edit-line"></i><span>Content</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
              <ul id="content" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                <li class="<?= $request->uri->getSegment(2) == "event" ? "active" : "" ?>"><a href="<?= base_url("admin/event") ?>"><i class="ri-calendar-event-line"></i>Event</a></li>
                <li class="<?= $request->uri->getSegment(2) == "news" ? "active" : "" ?>"><a href="<?= base_url("admin/news") ?>"><i class="ri-newspaper-line"></i>News</a></li>
              </ul>
            </li>
            <li class="<?= $request->uri->getSegment(2) == "commerce-banner" ? "active" : ($request->uri->getSegment(2) == "category" ? "active" : ($request->uri->getSegment(2) == "campaign" ? "active" : ($request->uri->getSegment(2) == "reportOrder" ? "active" : ($request->uri->getSegment(2) == "configuration" ? "active" : ($request->uri->getSegment(2) == "courier" ? "active" : ""))))) ?>">
              <a href="#commerce" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="true"><i class="ri-store-2-line"></i><span>Commerce</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
              <ul id="commerce" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                <li class="<?= $request->uri->getSegment(2) == "category" ? "active" : "" ?>"><a href="<?= base_url("admin/category") ?>"><i class="ri-list-check"></i>Category</a></li>
                <li class="<?= $request->uri->getSegment(2) == "reportOrder" ? "active" : "" ?>"><a href="<?= base_url("admin/reportOrder/status/received") ?>"><i class="ri-file-text-line"></i>Report Order</a></li>
              </ul>
            </li>
            <li class="<?= $request->uri->getSegment(3) == "ppob" ? "active" : ($request->uri->getSegment(3) == "payment-regis" ? "active" : ($request->uri->getSegment(3) == "payment-topup" ? "active" : ($request->uri->getSegment(3) == "commerce" ? "active" : ""))) ?>">
              <a href="#share" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="true"><i class="ri-share-line"></i><span>Share profit</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
              <ul id="share" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                <li class="<?= $request->uri->getSegment(3) == "ppob" ? "active" : "" ?>"><a href="<?= base_url("admin/share/ppob") ?>" class="iq-waves-effect"><i class="ri-shopping-cart-2-line"></i><span>Ppob</span></a></li>
                <li class="<?= $request->uri->getSegment(3) == "payment-topup" ? "active" : "" ?>"><a href="<?= base_url("admin/share/payment-topup") ?>" class="iq-waves-effect"><i class="ri-share-circle-line"></i><span>Topup</span></a></li>
                <li class="<?= $request->uri->getSegment(3) == "commerce" ? "active" : "" ?>"><a href="<?= base_url("admin/share/commerce") ?>" class="iq-waves-effect"><i class="ri-shopping-bag-line"></i><span>Jual Beli</span></a></li>
              </ul>
            </li>
            <li class="<?= $request->uri->getSegment(2) == "broadcast" ? "active" : "" ?>" style="margin-top:10px;">
              <a href="<?= base_url("admin/broadcast") ?>" class="iq-waves-effect"><i class="ri-broadcast-fill"></i><span>Broadcast</span></a>
            </li>
            <li class="<?= $request->uri->getSegment(2) == "member" ? "active" : "" ?>" style="margin-top:10px;">
              <a href="<?= base_url("admin/member") ?>" class="iq-waves-effect"><i class="ri-shield-user-line"></i><span>Member</span></a>
            </li>
            <li class="<?= $request->uri->getSegment(2) == "member" ? "active" : "" ?>" style="margin-top:10px;">
              <a href="<?= base_url("admin/scannerjoin") ?>" class="iq-waves-effect"><i class="ri-user-follow-line"></i><span>Scanner Join</span></a>
            </li>
            <li class="<?= $request->uri->getSegment(2) == "setting" ? "active" : "" ?>" style="margin-top:10px;">
              <a href="<?= base_url("admin/setting") ?>" class="iq-waves-effect"><i class="ri-settings-3-line"></i><span>Setting</span></a>
            </li>
          </ul>
        </nav>
        <div class="p-3"></div>
      </div>
    <?php } ?>
  </div>
</div>
<!-- Wrapper END -->