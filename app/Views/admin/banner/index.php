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
                            <h4 class="card-title">Data Banner</h4>
                        </div>
                        <a href="<?= base_url("/admin/banner/create") ?>" class="btn mb-3 btn-primary" style="margin-top: 15px;"><i class="ri-add-circle-line"></i>Add</a>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="data" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Placement</th>
                                        <th scope="col">&emsp;&emsp;Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php if ($banner != "") { ?>
                                        <?php foreach ($banner as $row) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row->name ?></td>
                                                <td><?= $row->placement ?></td>
                                                <td>
                                                    <div class="send-panel">
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/admin/banner/edit/' . $row->carousel_id) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Banner"> <i class="ri-edit-line text-primary"></i></a> </label>
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a onclick="DetailBanner('<?= $row->carousel_id ?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Image"> <i class="ri-list-check-2 text-primary"></i></a> </label>
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/admin/banner/delete/' . $row->carousel_id) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Banner"> <i class="ri-delete-bin-line text-primary"></i></a> </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="modal fade" id="detailBanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Image Banner</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="" class="img-fluid" id="imageBanner" alt="image" style=" width: 100%; height: auto; max-height: 250px;">
                                    </div>
                                </div>
                            </div>
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