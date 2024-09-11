<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<style>
    .custom {
        line-height: normal;
        height: 130px !important;
    }
</style>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Data Store</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <?php if (isset($show_open_store_button) && $show_open_store_button): ?>
                                <div style="display: flex;justify-content: center;">
                                    <a href="<?= base_url("/admin/officialStore/create") ?>" type="button" class="btn btn-primary">Buka Toko</a>
                                </div>
                            <?php else: ?>
                                <form enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="text" id="storeId" value="<?= $store['id'] ?>" hidden>
                                        <input type="text" id="oldImage" value="<?= $store['logo'] ?>" hidden>
                                        <!-- <h5 id="store_id"><?= $store['id'] ?></h5> -->
                                        <input type="text" id="posCode" hidden>
                                        <div class="form-group col-md-6">
                                            <label>Name:</label>
                                            <input type="text" class="form-control" id="title" placeholder="Title Product" value="<?= $store['name'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email:</label>
                                            <input type="text" class="form-control" id="email" placeholder="Price Product" value="<?= $store['email'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone:</label>
                                            <input type="number" class="form-control" id="phone" placeholder="Stock Product" value="<?= $store['phone'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Address:</label>
                                            <input type="text" class="form-control" id="address" placeholder="Weight Product" value="<?= $store['address'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Province:</label>
                                            <select class="form-control" id="province" name="province">
                                                <option disabled selected>Select Province</option>
                                                <?php foreach ($province as $row) : ?>
                                                    <option value="<?= htmlspecialchars($row->province_name) ?>" <?= ($row->province_name == htmlspecialchars($store['province'])) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($row->province_name) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>City:</label>
                                            <select class="form-control" id="city" name="city">
                                                <option disabled selected>Select City</option>
                                                <?php foreach ($citys as $row) : ?>
                                                    <option value="<?= htmlspecialchars($row->city_name) ?>" <?= ($row->city_name == htmlspecialchars($store['city'])) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($row->city_name) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>District:</label>
                                            <select class="form-control" id="district" name="district">
                                                <option disabled selected>Select District</option>
                                                <?php foreach ($district as $row) : ?>
                                                    <option value="<?= htmlspecialchars($row->district_name) ?>" <?= ($row->district_name == htmlspecialchars($store['district'])) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($row->district_name) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Subdistrict:</label>
                                            <select class="form-control" id="subdistrict" name="subdistrict">
                                                <option disabled selected>Select Subdistrict</option>
                                                <?php foreach ($subdistrict as $row) : ?>
                                                    <option value="<?= htmlspecialchars($row->subdistrict_name) ?>" <?= ($row->subdistrict_name == htmlspecialchars($store['subdistrict'])) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($row->subdistrict_name) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Description:</label>
                                            <textarea id="description" class="form-control custom"><?= $store['description'] ?></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Image (Recommendation Size 700 x 525):</label>
                                            <input type="file" class="dropify" id="imageStore" data-height="200" data-default-file="<?= isset($store['logo']) ? $store['logo'] : '' ?>" />
                                        </div>
                                    </div>
                                    <button type="button" onclick="UpdateStore()" id="updateStore" class="btn btn-custom" style="float: right;">Update</button><br>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<?= view('js/store'); ?>