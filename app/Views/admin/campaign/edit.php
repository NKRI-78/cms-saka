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
                                <div class="row">
                                    <input type="text" id="bannerId" value="<?= $banner->id ?>" hidden>
                                    <div class="form-group col-md-6">
                                        <label>Action Type:</label>
                                        <input type="text" class="form-control" id="actionType" name="actionType" value="<?= $banner->actionType ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Index:</label>
                                        <input type="text" class="form-control" id="index" name="index" value="<?= $banner->index ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Target Id:</label>
                                        <input type="text" class="form-control" id="targetId" name="targetId" value="<?= $banner->targetId ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image:</label>
                                        <input type="file" class="dropify" id="imageBanner" data-default-file="<?= getenv('IMAGE_URL') . $banner->image->path ?>" data-height="200" />
                                    </div>
                                </div>
                                <br><button type="button" onclick="UpdateBanner()" id="updateBanner" class="btn btn-custom" style="float: right;">Submit</button><br><br>
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