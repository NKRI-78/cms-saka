<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<!--  Content  -->
<div id="content-page" class="content-page">
  <div class="container-fluid" style="margin-top: 170px;">
    <div class="row">
      <div class="card" style="width: 18rem; margin-top: -11rem; margin-left: 1rem; background-color: #9c8045; height: 10rem;">
        <div class="card-body">
          <h3 class="card-title" style="margin-top: 1.5rem; font-weight:600; color: #fff;">Total Income:</h3>
          <h4 class="card-subtitle mb-2 text-muted" style="font-weight:400; color: #fff !important;"><?= 'Rp.' . number_format($revenue['revenue'], 0, ',', '.') ?></h4>
          <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a> -->
        </div>
      </div>
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