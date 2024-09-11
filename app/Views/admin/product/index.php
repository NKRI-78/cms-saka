<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<style>
    .carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: black; /* Warna latar belakang */
    border-radius: 50%; /* Jika Anda ingin bentuk bulat */
}

.carousel-control-prev-icon::before,
.carousel-control-next-icon::before {
    color: white; /* Warna ikon */
    font-size: 2rem; /* Ukuran ikon */
}

.carousel-inner img {
    height: 250px;  /* Tinggi default untuk gambar */
    width: 100%;  /* Lebar otomatis menyesuaikan dengan container */
    object-fit: cover;  /* Menyesuaikan gambar untuk mengisi container tanpa merusak proporsi */
}

</style>

<!--  Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Data Product</h4>
                        </div>
                        <a href="<?= base_url("/admin/product/create") ?>" class="btn mb-3 btn-primary" style="margin-top: 15px;"><i class="ri-add-circle-line"></i>Add</a>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="data" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name Product</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">&emsp;Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="iq-card-body">
                    <div class="modal fade" id="detailProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- <img src="" class="img-fluid" id="imageNews" alt="image" style="width: 100%; height: auto; max-height: 250px; object-fit:contain;"> -->
                                    <div id="carouselExampleIndicators" class="carousel slide">
                                        <ol class="carousel-indicators" id="carouselIndicators">
                                            <!-- Indicators will be generated here -->
                                        </ol>
                                        <div class="carousel-inner" id="carouselInner">
                                            <!-- Images will be generated here -->
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    <br><br>
                                    <!-- <div id="contentNews"></div> -->
                                </div>
                            </div>
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
<?= view('js/product'); ?>