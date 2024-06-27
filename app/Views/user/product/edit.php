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
                            <h4 class="card-title">Edit Product</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-in fo">
                            <form>
                                <?php foreach ($product as $row) : ?>
                                    <div class="row">
                                        <input type="text" id="productId" value="<?= $row->_id ?>" hidden>
                                        <div class="form-group col-md-6">
                                            <label for="name">Name:</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?= $row->name ?>" placeholder="Name Product">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="price">Price:</label>
                                            <input type="text" class="form-control" id="price" name="price" value="<?= $row->price ?>" placeholder="Price Product">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="weight">Weight:</label>
                                            <input type="text" class="form-control" id="weight" name="weight" value="<?= $row->weight ?>" placeholder="Weight Product">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="add2">Stock:</label>
                                            <input type="text" class="form-control" id="stock" name="stock" value="<?= $row->stock ?>" placeholder="Stock Product">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description">Description:</label>
                                            <input type="text" class="form-control" id="description" name="description" value="<?= $row->description ?>" placeholder="Description Product">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <?php $categoryId = $row->category->{'$id'}; ?>
                                            <label for="category">Category:</label>
                                            <select class="form-control" id="category" name="category">
                                                <?php foreach ($category as $cat) : ?>
                                                    <option value="<?= $cat->_id ?>" <?php if ($cat->_id == $categoryId) echo "selected" ?>><?= $cat->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php foreach ($product as $row) : ?>
                                        <div class="form-group col-md-6">
                                            <label for="condition">Condition:</label>
                                            <input type="text" class="form-control" id="condition" name="condition" value="<?= $row->condition ?>" placeholder="Condition Produk">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="minOrder">Minimal Order:</label>
                                            <input type="text" class="form-control" id="minOrder" name="minOrder" value="<?= $row->minOrder ?>" placeholder="Minimal Order">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="exampleFormControlFile1">Image Product:</label>
                                            <input type="file" class="form-control-file" id='files' name="files[]" multiple><br>
                                        </div>
                                        <?php if ($row->pictures !== null) { ?>
                                            <?php foreach ($product[0]->pictures as $row) : ?>
                                                <img src="<?= getenv('IMAGE_URL') . $row->path ?>" width="100px;" height="100px" class="rounded ml-3" alt="Responsive image">
                                            <?php endforeach; ?>
                                        <?php } ?>
                                    </div>
                                <?php endforeach; ?>
                                <br><button type="button" onclick="UpdateProduct()" id="create-product" class="btn btn-custom" style="float: right;">Update</button><br>
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