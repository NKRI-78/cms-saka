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
                            <h4 class="card-title">Edit Configuration</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <?php foreach ($configuration as $row) : ?>
                                    <div class="row">
                                        <input type="text" id="configId" value="<?= $row->_id ?>" hidden>
                                        <div class="form-group col-md-6">
                                            <label>Delayed Settlement When Order Completed In Hours:</label>
                                            <input type="text" class="form-control" id="delayedSettlementWhenOrderCompletedInHours" value="<?= $row->delayedSettlementWhenOrderCompletedInHours ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Expiring Order When No Respond In Hours:</label>
                                            <input type="text" class="form-control" id="expiringOrderWhenNoRespondInHours" value="<?= $row->expiringOrderWhenNoRespondInHours ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Expiring Transaction When Not Paid In Hours:</label>
                                            <input type="text" class="form-control" id="expiringTransactionWhenNotPaidInHours" value="<?= $row->expiringTransactionWhenNotPaidInHours ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Internal Wallet Account:</label>
                                            <input type="text" class="form-control" id="internalWalletAccount" value="<?= $row->internalWalletAccount ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Product Charge Percentage:</label>
                                            <input type="text" class="form-control" id="productChargePercentage" value="<?= $row->productChargePercentage ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Service Charge:</label>
                                            <input type="text" class="form-control" id="serviceCharge" value="<?= $row->serviceCharge ?>">
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <br><button type="button" onclick="UpdateConfiguration()" id="updateConfiguration" class="btn btn-custom" style="float: right;">Submit</button><br>
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