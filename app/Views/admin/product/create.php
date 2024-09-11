<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<style>
    .custom {
        line-height: normal;
        height: 130px !important;
    }

    .dz-error-message {
        display: none !important;
    }

    .dz-error-mark {
        display: none !important;
    }
</style>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Add Product</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" id="app_id" value="<?= $app[0]->id ?>" hidden>
                                    <input type="text" id="store_id" value="<?= $store['id'] ?>" hidden>
                                    <div class="form-group col-md-6">
                                        <label>Title:</label>
                                        <input type="text" class="form-control" id="title" placeholder="Title Product">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Price:</label>
                                        <input type="text" class="form-control" id="price" placeholder="Price Product">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Stock:</label>
                                        <input type="number" class="form-control" id="stock" placeholder="Stock Product">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Weight:</label>
                                        <div style="display: flex;align-items: center; gap: 0.5rem;">
                                            <input type="text" class="form-control" id="weight" placeholder="Weight Product" style="width: 9rem;">
                                            <span style="color: #000;">gram</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Category Product:</label>
                                        <select class="form-control" id="category" name="category">
                                            <option disabled selected>Select Category</option>
                                            <?php foreach ($category as $row) : ?>
                                                <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Caption:</label>
                                        <textarea id="caption" class="form-control custom"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image:</label>
                                        <!-- <input type="file" class="dropify" id="imageProduct" data-height="200" /> -->
                                        <div id="image-dropzone" class="dropzone"></div>
                                    </div>
                                </div>
                                <button type="button" onclick="CreateProduct()" id="createProduct" class="btn btn-custom" style="float: right;">Submit</button><br>
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
<?= view('js/product'); ?>