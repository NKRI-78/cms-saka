<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<!--  Content  -->
<div id="content-page" class="content-page">
  <div class="container-fluid" style="margin-top: 170px;">
    <div class="row">
      <div class="col-sm-12">
        <div class="wrapper"><br>
          <div class="row justify-content-center">
            <div class="col-sm-12 text-center">
              <div class="iq-comingsoon-info">
                <a href="">
                  <img src="<?= base_url('public/assets/images/Logo_Saka.png') ?>" class="img-fluid w-25" alt="">
                </a>
                <h3></h3>
                <h2 class="mt-4 mb-1">Welcome To, SAKA Dashboard</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Content  -->

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<?= view('js/userDashboard'); ?>