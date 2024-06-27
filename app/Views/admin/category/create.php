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
                            <h4 class="card-title">Add Category</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name Category">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Parent:</label>
                                        <select class="form-control" id="parent" name="parent">
                                            <option>Select Category</option>
                                            <?php foreach ($category as $row) : ?>
                                                <option value="<?= $row->_id ?>"><?= $row->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image:</label>
                                        <input type="file" class="dropify" id="imageCategory" data-height="200"/>
                                    </div>
                                </div>
                                <br><button type="button" onclick="CreateCategory()" id="createCategory" class="btn btn-custom" style="float: right;">Submit</button><br>
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