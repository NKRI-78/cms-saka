<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Edit Banner</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <?php foreach ($banner as $row) : ?>
                                    <div class="row">
                                        <input type="text" value="<?= $row->carousel_id ?>" id="bannerId" hidden>
                                        <div class="form-group col-md-6">
                                            <label>Name:</label>
                                            <input type="text" class="form-control" id="name" value="<?= $row->name ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Placement:</label>
                                            <input type="text" class="form-control" id="placement" value="<?= $row->placement ?>">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Image (Recommendation Size 960 x 390):</label>
                                            <input type="file" class="dropify" id="imageBanner" data-default-file="<?= getenv('API_MEDIA') . $row->Media[0]->path ?>" data-height="200" />
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <br><button type="button" onclick="UpdateBanner()" id="updateBanner" class="btn btn-custom" style="float: right;">Update</button><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<?= view('js/admin'); ?>