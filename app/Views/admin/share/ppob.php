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
                            <h4 class="card-title">PPOB Summary</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="form-row">
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
                                <button onclick="Ppob()" class="btn dark-icon btn-custom mb-3" style="height: 30px; padding: 2px .75rem !important;"><i class="ri-search-line" style="margin-bottom: 20px;"></i></button>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table" id="sharePpob">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Count</th>
                                        <th>Total Sell Price</th>
                                        <th>Total Partner</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Total Count : <br> <span id="totalCount"></span> </th>
                                        <th>Grand Total : <br> <span id="totalSellPrice"></span> </th>
                                        <th>Grand Total : <br> <span id="totalPartner"></span> </th>
                                    </tr>
                                </tfoot>
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
<?= view('js/sharePpob'); ?>