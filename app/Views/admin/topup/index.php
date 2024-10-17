<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<!--  Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Payment Topup</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <!-- <div class="form-row">
                            <div class="col-md-2">
                                <label>Start Date</label>
                                <input type="date" class="form-control" id="start" style="height: 32px;">
                            </div>
                            <div class="col-md-2">
                                <label>End Date</label>
                                <input type="date" class="form-control" id="end" style="height: 32px;">
                            </div>
                            <div class="col-md-2">
                                <label style="color: white;">Submit</label><br>
                                <button onclick="shareTopup()" class="btn dark-icon btn-custom mb-3" style="height: 30px; padding: 2px .75rem !important;"><i class="ri-search-line" style="margin-bottom: 20px;"></i></button>
                            </div>
                        </div> -->
                        <!-- <br> -->
                        <div class="table-responsive">
                            <table class="table" id="shareTopup">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Total Transaction</th>
                                        <th>Date Transaction</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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
<?= view('js/shareTopup'); ?>