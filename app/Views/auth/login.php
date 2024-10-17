<?= view('layouts/header'); ?>

<!-- loader  -->
<div id="loading">
  <div id="loading-center">
  </div>
</div>
<!-- loader END -->

<!-- Content  -->
<section class="sign-in-page" style="padding-top: 23px;">
  <div class="container bg-white mt-5 p-0">
    <div class="row no-gutters">
      <div class="col-sm-6 align-self-center">
        <div class="sign-in-from">
          <h1 class="mb-0">Sign in</h1>
          <p>Enter your username and password to access admin panel.</p>
          <form class="mt-4">
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" id="phone_number" class="form-control mb-0" placeholder="Enter Username">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" id="password" class="form-control mb-0 form-control-password" placeholder="Password">
            </div>
            <div class="form-group">
              <input type="checkbox" class="form-checkbox"> Show password
            </div>
            <div class="d-inline-block w-100">
              <button type="button" id="login" class="btn btn-custom float-right" onclick="Login()">Sign in</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-sm-6 text-center">
        <div class="sign-in-detail text-white">
          <a class="sign-in-logo mb-5" href="#"><img src="<?= base_url('public/assets/images/Logo_Saka.png') ?>" class="img-fluid" alt="logo"></a>
          <div data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
            <div class="item">
              <img src="<?= base_url('public/assets/images/login/1.png') ?>" class="img-fluid mb-4" alt="logo">
              <h4 class="mb-1 text-white">Manage your dashboard</h4>
              <p>It is a long established fact that a reader will be distracted by the readable content.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Content  -->

<?= view('layouts/script'); ?>
<?= view('js/login'); ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('.form-checkbox').click(function() {
      if ($(this).is(':checked')) {
        $('.form-control-password').attr('type', 'text');
      } else {
        $('.form-control-password').attr('type', 'password');
      }
    });
  });
</script>