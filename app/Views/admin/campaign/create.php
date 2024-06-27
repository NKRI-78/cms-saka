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
                            <h4 class="card-title">Add Campaign</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Title:</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Title Campaign">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Subtitle:</label>
                                        <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Subtitle Campaign">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Background Color:</label>
                                        <input type="color" class="form-control" id="backgroundColor" name="backgroundColor" placeholder="Background Color Campaign">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Title Background Color:</label>
                                        <input type="color" class="form-control" id="titleBgColor" name="titleBgColor" placeholder="Title Background Color Campaign">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Title Color:</label>
                                        <input type="color" class="form-control" id="titleColor" name="titleColor" placeholder="Title Color Campaign">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Campaign Type:</label>
                                        <input type="text" class="form-control" id="campaignType" name="campaignType" placeholder="Campaign Type Campaign">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Index:</label>
                                        <input type="text" class="form-control" id="index" name="index" placeholder="Index Banner">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Products:</label>
                                        <select multiple="" class="form-control" id="products">
                                        <?php foreach ($product as $row) : ?>
                                                <option value="<?= $row->_id ?>"><?= $row->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Start Date:</label>
                                        <input type="datetime-local" class="form-control" id="startDate">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>End Date:</label>
                                        <input type="datetime-local" class="form-control" id="endDate">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image:</label>
                                        <input type="file" class="dropify" id="imageCampaign" data-height="200" />
                                    </div>
                                </div>
                                <br><button type="button" onclick="CreateCampaign()" id="createCampaign" class="btn btn-custom" style="float: right;">Submit</button><br><br>
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