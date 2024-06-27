<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-body">
                        <div class="row">
                            <div class="col-md-6 iq-item-product-left">
                                <div class="iq-image-container">
                                    <div class="iq-product-cover d-flex justify-content-center">
                                        <?php if ($product[0]->pictures !== null) { ?>
                                            <?php foreach ($product as $row) : ?>
                                                <img src="<?= getenv('IMAGE_URL') . $row->pictures[0]->path ?>" alt="product-image" class="img-fluid" style="height: 260px !important;">
                                            <?php endforeach; ?>
                                        <?php } else { ?>
                                            <img src="<?= base_url('public/assets/images/image-default.png') ?>" alt="product-image" class="img-fluid" style="height: 260px !important;">
                                        <?php } ?>
                                    </div>
                                    <div class="iq-additional_slider">
                                        <ul id="product-additional-slider" class="d-flex m-0 p-0">
                                            <?php if ($product[0]->pictures !== null) { ?>
                                                <?php foreach ($product[0]->pictures as $row) : ?>
                                                    <li><img src="<?= getenv('IMAGE_URL') . $row->path ?>" alt="product-image" class="img-fluid"></li>
                                                <?php endforeach; ?>
                                            <?php } else { ?>
                                                <li><img src="<?= base_url('public/assets/images/image-default.png') ?>" alt="product-image" class="img-fluid"></li>
                                                <li><img src="<?= base_url('public/assets/images/image-default.png') ?>" alt="product-image" class="img-fluid"></li>
                                                <li><img src="<?= base_url('public/assets/images/image-default.png') ?>" alt="product-image" class="img-fluid"></li>
                                                <li><img src="<?= base_url('public/assets/images/image-default.png') ?>" alt="product-image" class="img-fluid"></li>
                                                <li><img src="<?= base_url('public/assets/images/image-default.png') ?>" alt="product-image" class="img-fluid"></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 iq-item-product-right">
                                <div class="product-additional-details">
                                    <?php foreach ($product as $row) : ?>
                                        <h3 class="productpage_title"><?= $row->name ?></h3>
                                        <div class="product-descriptio">
                                            <p><?= $row->description ?></p>
                                        </div>
                                        <div class="product-price">
                                            <div class="regular-price"><b> Rp.<?= $row->price ?></b></div>
                                        </div>
                                        <div class="shipping">
                                            <p class="mb-0">Condition: <span><?= $row->condition ?></span></p>
                                        </div>
                                        <div class="stock">
                                            <p>Miniminal Order: <span><?= $row->minOrder ?></span></p>
                                        </div>
                                        <div class="shipping">
                                            <p>Weight: <span><?= $row->weight ?></span></p>
                                        </div>
                                        <div class="shipping">
                                            <p>Stock: <span><?= $row->stock ?></span></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<?= view('js/userProduct'); ?>