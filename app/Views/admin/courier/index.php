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
                            <h4 class="card-title">Data Courier</h4>
                        </div>
                        <a href="<?= base_url("/admin/courier/create") ?>" class="btn mb-3 btn-primary" style="margin-top: 15px;"><i class="ri-add-circle-line"></i>Add</a>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="dataCommerceBanner" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Check Price Supported</th>
                                        <th scope="col">Check Resi Supported</th>
                                        <th scope="col">&emsp;&emsp;Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php if ($courier != "NULL") { ?>
                                        <?php foreach ($courier as $row) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row->name ?></td>
                                                <td><?= $row->checkPriceSupported ?></td>
                                                <td><?= $row->checkResiSupported ?></td>
                                                <td>
                                                    <div class="send-panel">
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/admin/courier/edit/' . $row->_id) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Courier"> <i class="ri-edit-line text-primary"></i></a> </label>
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/admin/courier/detail/' . $row->_id) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Courier Service"> <i class="ri-list-check-2 text-primary"></i></a> </label>
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/admin/courier/delete/' . $row->_id) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Courier"> <i class="ri-delete-bin-line text-primary"></i></a> </label>
                                                    </div>
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