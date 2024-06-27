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
                            <h4 class="card-title">Add Courier Service</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" id="courierId" value="<?= $courierId ?>" hidden>
                                    <div class="form-group col-md-6">
                                        <label>Name:</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Code:</label>
                                        <input type="text" class="form-control" id="code" placeholder="Code">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Type:</label>
                                        <input type="text" class="form-control" id="type" placeholder="Type">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Min Weight:</label>
                                        <input type="number" class="form-control" id="minWeight" placeholder="Min Weight">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Estimate Days:</label>
                                        <input type="text" class="form-control" id="estimateDays" placeholder="Estimate Days">
                                    </div>
                                </div>
                                <br><button type="button" onclick="CreateCourierService()" id="createCourierService" class="btn btn-custom" style="float: right;">Submit</button><br>
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