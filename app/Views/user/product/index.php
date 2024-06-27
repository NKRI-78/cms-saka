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
                            <h4 class="card-title">Data Product</h4>
                        </div>
                        <div class="send-panel">
                            <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/user/product/create') ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Product"> <i class="ri-add-circle-line text-primary"></i></a> </label>
                            <label class="ml-2 mb-0 iq-bg-primary rounded"> <a data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Import Product"> <i class="ri-attachment-line text-primary"></i></a> </label>
                            <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/user/product/template-product') ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Template Product"> <i class="ri-file-download-line text-primary"></i></a> </label>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="dataProduct" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Condition</th>
                                        <th scope="col">Min Order</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php if($product != "NULL") { ?>
                                    <?php foreach ($product as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row->name ?></td>
                                            <td><?= $row->price ?></td>
                                            <td><?= $row->weight ?></td>
                                            <td><?= $row->stock ?></td>
                                            <td><?= $row->condition ?></td>
                                            <td><?= $row->minOrder ?></td>
                                            <td>
                                                <div class="send-panel">
                                                    <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/user/product/edit/' . $row->_id) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Product"> <i class="ri-edit-line text-primary"></i></a> </label>
                                                    <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url('/user/product/detail/' . $row->_id) ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Product"> <i class="ri-shopping-bag-3-line text-primary"></i></a> </label>
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
                <div class="iq-card-body">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label>Category:</label>
                                                <select class="form-control" id="category" name="category">
                                                    <option value="null">Select Category</option>
                                                    <?php foreach ($category as $row) : ?>
                                                        <option value="<?= $row->_id ?>"><?= $row->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="exampleFormControlFile1">File:</label>
                                                <input type="file" class="form-control-file" id='file' name="file"><br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" onclick="ImportProduct()" id="import-product" class="btn btn-custom">Import</button>
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
<?= view('js/userProduct'); ?>