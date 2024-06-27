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
                            <h4 class="card-title">Edit Courier</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">

                                <?php foreach($courier as $row) { ?>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Courier Id:</label>
                                        <input type="text" class="form-control" id="courierId" value="<?= $row->_id ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Courier Name:</label>
                                        <input type="text" class="form-control" id="name" value="<?= $row->name ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Check Price Supported:</label>
                                        <select id="checkPriceSupported" class="form-control">
                                            <option value="true" <?= $row->checkPriceSupported == "true" ? "selected" : "" ?>>True</option>
                                            <option value="false" <?= $row->checkPriceSupported == "false" ? "selected" : "" ?>">False</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Check Resi Supported:</label>
                                        <select id="checkResiSupported" class="form-control">
                                            <option value="true" <?= $row->checkPriceSupported == "true" ? "selected" : "" ?>>True</option>
                                            <option value="false" <?= $row->checkPriceSupported == "false" ? "selected" : "" ?>">False</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image:</label>
                                        <input type="file" class="dropify" id="image" data-default-file="<?= getenv('IMAGE_URL') . $row->image ?>" data-height="200"/>
                                    </div>
                                </div>

                                <?php } ?>

                                <br><button type="button" onclick="UpdateCourier()" id="updateCourier" class="btn btn-custom" style="float: right;">Submit</button><br>
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