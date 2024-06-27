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
                            <h4 class="card-title">Add Product</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name Product">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="price">Price:</label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="Price Product">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="weight">Weight:</label>
                                        <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight Product">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="add2">Stock:</label>
                                        <input type="text" class="form-control" id="stock" name="stock" placeholder="Stock Product">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Description:</label>
                                        <input type="text" class="form-control" id="description" name="description" placeholder="Description Product">
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label>Category:</label>
                                        <select class="form-control" id="category" name="category">
                                            <option>Select Category</option>
                                            <?php foreach ($category as $row) : ?>
                                                <option value="<?= $row->_id ?>"><?= $row->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="condition">Condition:</label>
                                        <input type="text" class="form-control" id="condition" name="condition" placeholder="Condition Produk">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="minOrder">Minimal Order:</label>
                                        <input type="text" class="form-control" id="minOrder" name="minOrder" placeholder="Minimal Order">
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="exampleFormControlFile1">Image Product:</label>
                                        <input type="file" class="form-control-file" id='files' name="files[]" multiple><br>
                                    </div>
                                </div>
                                <button type="button" onclick="CreateProduct()" id="create-product" class="btn btn-custom" style="float: right;">Submit</button><br>
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
<?= view('js/userProduct'); ?>