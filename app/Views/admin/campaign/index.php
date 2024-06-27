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
                            <h4 class="card-title">Data Campaign</h4>
                        </div>
                        <a href="<?= base_url("/admin/campaign/create") ?>" class="btn mb-3 btn-primary" style="margin-top: 15px;"><i class="ri-add-circle-line"></i>Add</a>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="dataCampaign" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Index</th>
                                        <th scope="col">Subtitle</th>
                                        <th scope="col">campaignType</th>
                                        <th scope="col">&emsp;&emsp;Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php if ($campaign != "") { ?>
                                        <?php foreach ($campaign as $row) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row->title ?></td>
                                                <td><?= $row->index ?></td>
                                                <td><?= $row->subtitle ?></td>
                                                <td><?= $row->campaignType ?></td>
                                                <td>
                                                    <div class="send-panel">
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/admin/campaign/edit/' . $row->id) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Campaign"> <i class="ri-edit-line text-primary"></i></a> </label>
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/admin/campaign/detail/' . $row->id) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Campaign"> <i class="ri-list-check-2 text-primary"></i></a> </label>
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/admin/campaign/delete/' . $row->id) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Campaign"> <i class="ri-delete-bin-line text-primary"></i></a> </label>
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