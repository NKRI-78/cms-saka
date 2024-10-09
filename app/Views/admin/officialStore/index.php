<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<style>
    .custom {
        line-height: normal;
        height: 130px !important;
    }

    textarea.custom {
        overflow: hidden;
        resize: none;
        min-height: 130px;
        /* Atur tinggi minimal */
        line-height: normal;
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
                                <?php if (session()->get('role') === 'client'): ?>
                                    <form enctype="multipart/form-data">
                                        <div class="row">
                                            <input type="text" id="storeId" value="<?= $store['id'] ?>" hidden>
                                            <input type="text" id="oldImage" value="<?= $store['logo'] ?>" hidden>
                                            <!-- <h5 id="store_id"><?= $store['id'] ?></h5> -->
                                            <input type="text" id="posCode" hidden>
                                            <input type="hidden" id="latitude" value="<?= $store['lat'] ?>" hidden>
                                            <input type="hidden" id="longitude" value="<?= $store['lng'] ?>" hidden>

                                            <div class="form-group col-md-12">
                                                <label>Image (Recommendation Size 700 x 525):</label>
                                                <input type="file" class="dropify" id="imageStore" data-height="200" data-default-file="<?= isset($store['logo']) ? $store['logo'] : '' ?>" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Name:</label>
                                                <input type="text" class="form-control" id="title" placeholder="Name Toko" value="<?= $store['name'] ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Email:</label>
                                                <input type="text" class="form-control" id="email" placeholder="Email Toko" value="<?= $store['email'] ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Phone:</label>
                                                <input type="number" class="form-control" id="phone" placeholder="Phone Toko" value="<?= $store['phone'] ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Address:</label>
                                                <input type="text" class="form-control" id="pac-input" placeholder="Alamat Toko" value="<?= $store['address'] ?>" autocomplete="off">
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
                                                    <?php if (isset($city) && !empty($city)): ?>
                                                        <?php foreach ($city as $row) : ?>
                                                            <option value="<?= htmlspecialchars($row->city_name) ?>" <?= ($row->city_name == htmlspecialchars($store['city'])) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($row->city_name) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <option>No city available</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>District:</label>
                                                <select class="form-control" id="district" name="district">
                                                    <option disabled selected>Select District</option>
                                                    <?php if (isset($district) && !empty($district)): ?>
                                                        <?php foreach ($district as $row) : ?>
                                                            <option value="<?= htmlspecialchars($row->district_name) ?>" <?= ($row->district_name == htmlspecialchars($store['district'])) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($row->district_name) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <option>No district available</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Subdistrict:</label>
                                                <select class="form-control" id="subdistrict" name="subdistrict">
                                                    <option disabled selected>Select Subdistrict</option>
                                                    <?php if (isset($subdistrict) && !empty($subdistrict)): ?>
                                                        <?php foreach ($subdistrict as $row) : ?>
                                                            <option value="<?= htmlspecialchars($row->subdistrict_name) ?>" <?= ($row->subdistrict_name == htmlspecialchars($store['subdistrict'])) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($row->subdistrict_name) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <option>No subdistrict available</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Description:</label>
                                                <textarea id="description" class="form-control custom"><?= $store['description'] ?></textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div id="map" style="height: 400px; width: 100%;"></div>
                                            </div>
                                        </div>
                                        <button type="button" onclick="UpdateStore()" id="updateStore" class="btn btn-custom" style="float: right;">Update</button><br>
                                    </form>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="form-group col-md-12" style="display: flex;gap: 1rem;">
                                            <label>Image:</label>
                                            <img src="<?= isset($store['logo']) ? $store['logo'] : '' ?>" alt="Store Logo" class="img-fluid">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Name:</label>
                                            <p><?= $store['name'] ?></p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email:</label>
                                            <p><?= $store['email'] ?></p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone:</label>
                                            <p><?= $store['phone'] ?></p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Address:</label>
                                            <p><?= $store['address'] ?></p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Province:</label>
                                            <p><?= htmlspecialchars($store['province']) ?></p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>City:</label>
                                            <p><?= htmlspecialchars($store['city']) ?></p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>District:</label>
                                            <p><?= htmlspecialchars($store['district']) ?></p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Subdistrict:</label>
                                            <p><?= htmlspecialchars($store['subdistrict']) ?></p>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Description:</label>
                                            <p><?= $store['description'] ?></p>
                                        </div>
                                        <!-- <div class="form-group col-md-12">
                                            <div id="map" style="height: 400px; width: 100%;"></div>
                                        </div> -->
                                    </div>
                                <?php endif; ?>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('description');

        // Fungsi untuk memperbesar tinggi berdasarkan isi
        textarea.addEventListener('input', function() {
            this.style.height = 'auto'; // Reset tinggi terlebih dahulu
            this.style.height = (this.scrollHeight) + 'px'; // Atur tinggi sesuai dengan scroll height
        });

        // Memastikan textarea disesuaikan saat halaman dimuat
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    });
</script>