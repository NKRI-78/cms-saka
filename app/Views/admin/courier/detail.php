<?php

use Config\Services;

$request = Services::request();

?>
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
                            <h4 class="card-title">Data Courier Service</h4>
                        </div>
                        <a href="<?= base_url("/admin/courier/create-service") . "/"  . $request->uri->getSegment(4) ?>" class="btn mb-3 btn-primary" style="margin-top: 15px;"><i class="ri-add-circle-line"></i>Add</a>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="dataCommerceBanner" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Estimate Days</th>
                                        <th scope="col">Min Weight</th>
                                        <th scope="col">Type</th>
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
                                                <td><?= $row->code ?></td>
                                                <td><?= $row->estimateDays ?></td>
                                                <td><?= $row->minWeight ?></td>
                                                <td><?= $row->type ?></td>
                                                <td>
                                                    <div class="send-panel">
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/admin/courier/edit-service/' . $row->_id . "/" . $request->uri->getSegment(4)) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Courier"> <i class="ri-edit-line text-primary"></i></a> </label>
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/admin/courier/delete-service/' . $row->_id) . "/" . $request->uri->getSegment(4) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Courier"> <i class="ri-delete-bin-line text-primary"></i></a> </label>
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