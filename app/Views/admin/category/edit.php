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
                            <h4 class="card-title">Edit Category</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <?php foreach ($category as $row) : ?>
                                    <div class="row">
                                        <input type="text" id="categoryId" value="<?= $row->_id ?>" hidden>
                                        <div class="form-group col-md-6">
                                            <label>Name:</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?= $row->name ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php
                                            $categoryId = "";
                                            if (isset($row->parent->{'$id'})) {
                                                $categoryId = $row->parent->{'$id'};
                                            }
                                            ?>
                                            <label>Parent:</label>
                                            <select class="form-control" id="parent" name="parent">
                                                <option>Select Category</option>
                                                <?php foreach ($all as $all) : ?>
                                                    <option value="<?= $all->_id ?>" <?php if ($all->_id == $categoryId) echo "selected" ?>><?= $all->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php foreach ($category as $row) : ?>
                                        <div class="form-group col-md-12">
                                            <label>Image:</label>
                                            <input type="file" class="dropify" id="imageCategory" data-default-file="<?= getenv('IMAGE_URL') . $row->picture->path ?>" data-height="200" />
                                        </div>
                                    <?php endforeach; ?>
                                    </div>
                                    <br><button type="button" onclick="UpdateCategory()" id="updateCategory" class="btn btn-custom" style="float: right;">Submit</button><br>
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