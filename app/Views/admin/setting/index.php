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
                            <h4 class="card-title">Password</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Old Password:</label>
                                        <input type="text" class="form-control" id="oldPassword" placeholder="Enter Your Old Password">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>New Password:</label>
                                        <input type="text" class="form-control" id="newPassword" placeholder="Enter Your New Password">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Confirm New Password:</label>
                                        <input type="text" class="form-control" id="confirmNewPassword" placeholder="Enter Your Confirm New Password">
                                    </div>
                                </div>
                                <br><button type="button" onclick="ChangePassword()" id="changePassword" class="btn btn-custom" style="float: right;">Change</button><br>
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