<?= view('layouts/header'); ?>

<body style="background-color: white;">
    <div class="wrapper">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-sm-12 text-center">
                    <div class="iq-error error-500">
                        <img src="<?= base_url('public/assets/images/store.png') ?>" style="width: 390px;" class="img-fluid iq-error-img" alt="">
                        <h2 class="mb-0">Anda Belum Membuka Toko</h2>
                        <p>silahkan membuka toko di aplikasi umart mobile</p>
                        <a class="btn btn-custom mt-3" href="<?= base_url("auth/login") ?>"><i class="ri-home-4-line"></i>Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<?= view('layouts/script'); ?>