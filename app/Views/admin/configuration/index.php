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
                            <h4 class="card-title">Data Configuration</h4>
                        </div>
                    </div>

                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="dataCommerceConfiguration" class="table" class="display nowrap"> 
                                <thead>
                                    <tr>
                                        <th scope="col">Delayed Settlement When Order Completed In Hours</th>
                                        <th scope="col">Expiring Order When No Respond In Hours</th>
                                        <th scope="col">Expiring Transaction When Not Paid In Hours</th>
                                        <th scope="col">Internal Wallet Account</th>
                                        <th scope="col">Product Charge Percentage</th>
                                        <th scope="col">Service Charge</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($configuration != "NULL") { ?>
                                        <?php foreach ($configuration as $row) : ?>
                                            <tr>
                                                <td><?= $row->delayedSettlementWhenOrderCompletedInHours ?></td>
                                                <td><?= $row->expiringOrderWhenNoRespondInHours ?></td>
                                                <td><?= $row->expiringTransactionWhenNotPaidInHours ?></td>
                                                <td><?= $row->internalWalletAccount ?></td>
                                                <td><?= $row->productChargePercentage ?></td>
                                                <td><?= $row->serviceCharge ?></td>
                                                <td>
                                                    <a href="<?= base_url('/admin/configuration/edit') ?>" class="btn btn-primary">Edit <i class="ri-edit-line"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
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
<?= view('js/admin'); ?>