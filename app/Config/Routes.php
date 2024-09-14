<?php

namespace Config;

$routes = Services::routes();
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
  require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers\Init');
$routes->setDefaultController('InitController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('init', 'InitController::index', ['namespace' => 'App\Controllers\Init']);

$routes->group('auth', function ($routes) {
  $routes->get('login', 'LoginController::index', ['namespace' => 'App\Controllers\Auth']);
  $routes->post('login', 'LoginController::store', ['namespace' => 'App\Controllers\Auth']);
  $routes->get('logout', 'LoginController::logout', ['namespace' => 'App\Controllers\Auth']);
  $routes->post('session', 'LoginController::session', ['namespace' => 'App\Controllers\Auth']);
});

$routes->group('admin', function ($routes) {
  $routes->get('dashboard', 'DashboardController::index', ['namespace' => 'App\Controllers\Admin']);

  $routes->group('banner', function ($routes) {
    $routes->get('/', 'BannerController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'BannerController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'BannerController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'BannerController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'BannerController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'BannerController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('delete/(:any)', 'BannerController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('event', function ($routes) {
    $routes->get('/', 'EventController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'EventController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'EventController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'EventController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'EventController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'EventController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('delete/(:any)', 'EventController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('news', function ($routes) {
    $routes->get('/', 'NewsController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'NewsController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'NewsController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'NewsController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'NewsController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'NewsController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('delete/(:any)', 'NewsController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('member', function ($routes) {
    $routes->get('/', 'MemberController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getData', 'MemberController::getData', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('delete/(:any)', 'MemberController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'MemberController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'MemberController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'MemberController::update', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('scannerjoin', function ($routes) {
    $routes->get('/', 'ScannerjoinController::index', ['namespace' => 'App\Controllers\Admin']);
    // $routes->get('delete/(:any)', 'MemberController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->get('detail/(:any)', 'MemberController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->get('edit/(:any)', 'MemberController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->post('update', 'MemberController::update', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('setting', function ($routes) {
    $routes->get('/', 'SettingController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('change-password', 'SettingController::changePassword', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('broadcast', function ($routes) {
    $routes->get('/', 'BroadcastController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'BroadcastController::post', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('commerce-banner', function ($routes) {
    $routes->get('/', 'CommerceBannerController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'CommerceBannerController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post-commerce-banner', 'CommerceBannerController::postBanner', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'CommerceBannerController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'CommerceBannerController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('delete/(:any)', 'CommerceBannerController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'CommerceBannerController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('campaign', function ($routes) {
    $routes->get('/', 'CampaignController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'CampaignController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'CampaignController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'CampaignController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'CampaignController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('delete/(:any)', 'CampaignController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('category', function ($routes) {
    $routes->get('/', 'CategoryController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'CategoryController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'CategoryController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'CategoryController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'CategoryController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('delete/(:any)', 'CategoryController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'CategoryController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('configuration', function ($routes) {
    $routes->get('/', 'ConfigurationController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit', 'ConfigurationController::edit', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'ConfigurationController::update', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('courier', function ($routes) {
    $routes->get('/', 'CourierController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'CourierController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'CourierController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'CourierController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'CourierController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('delete/(:any)', 'CourierController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'CourierController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create-service/(:any)', 'CourierController::createService/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post-service', 'CourierController::postService', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit-service/(:any)', 'CourierController::editService/$1/$2', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update-service', 'CourierController::updateService', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('delete-service/(:any)', 'CourierController::deleteService/$1/$2', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('share', function ($routes) {
    $routes->get('ppob', 'ShareProfitController::ppob', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('ppob', 'ShareProfitController::ppobPost', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('payment-topup', 'ShareProfitController::topup', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('payment-topup', 'ShareProfitController::topupPost', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('commerce', 'ShareProfitController::commerce', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('commerce', 'ShareProfitController::commercePost', ['namespace' => 'App\Controllers\Admin']);
  });
  
  $routes->group('reportOrder', function ($routes) {
    $routes->get('status/(:any)', 'OrderController::status/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'OrderController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('confirmed', 'OrderController::confirmed', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('courier', function ($routes) {
    $routes->get('/', 'CourierController::index', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('officialStore', function ($routes) {
    $routes->get('/', 'OfficialStoreController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getCity', 'OfficialStoreController::getCity', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getDistrict', 'OfficialStoreController::getDistrict', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getSubdistrict', 'OfficialStoreController::getSubdistrict', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'OfficialStoreController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'OfficialStoreController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'OfficialStoreController::post', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('product', function ($routes) {
    $routes->get('/', 'ProductController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getData', 'ProductController::getData', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'ProductController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'ProductController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'ProductController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'ProductController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'ProductController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('delete/(:any)', 'ProductController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('deleteImage', 'ProductController::deleteImage', ['namespace' => 'App\Controllers\Admin']);
  });
});

$routes->group('user', function ($routes) {
  $routes->get('dashboard', 'DashboardController::index', ['namespace' => 'App\Controllers\User']);
  $routes->get('timestamp', 'DashboardController::timestamp', ['namespace' => 'App\Controllers\User']);
  $routes->get('forbidden', 'DashboardController::forbidden', ['namespace' => 'App\Controllers\User']);

  $routes->group('product', function ($routes) {
    $routes->get('/', 'ProductController::index', ['namespace' => 'App\Controllers\User']);
    $routes->get('create', 'ProductController::create', ['namespace' => 'App\Controllers\User']);
    $routes->post('post-product', 'ProductController::postProduct', ['namespace' => 'App\Controllers\User']);
    $routes->get('detail/(:any)', 'ProductController::detail/$1', ['namespace' => 'App\Controllers\User']);
    $routes->get('edit/(:any)', 'ProductController::edit/$1', ['namespace' => 'App\Controllers\User']);
    $routes->post('update-product', 'ProductController::updateProduct', ['namespace' => 'App\Controllers\User']);
    $routes->post('import-product', 'ProductController::importProduct', ['namespace' => 'App\Controllers\User']);
    $routes->get('template-product', 'ProductController::templateProduct', ['namespace' => 'App\Controllers\User']);
  });

  $routes->group('order', function ($routes) {
    $routes->get('/', 'OrderController::index', ['namespace' => 'App\Controllers\User']);
    $routes->get('status/(:any)', 'OrderController::status/$1', ['namespace' => 'App\Controllers\User']);
  });
});

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
  require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
