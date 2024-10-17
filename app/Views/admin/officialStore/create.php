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
                            <h4 class="card-title">Create Store</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" id="posCode" hidden>
                                    <input type="hidden" id="latitude" hidden>
                                    <input type="hidden" id="longitude" hidden>

                                    <div class="form-group col-md-12">
                                        <label>Image (Recommendation Size 700 x 525):</label>
                                        <input type="file" class="dropify" id="imageStore" data-height="200" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Name:</label>
                                        <input type="text" class="form-control" id="title" placeholder="Name Store">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email Store">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Phone:</label>
                                        <input type="number" class="form-control" id="phone" placeholder="Phone Store">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Address:</label>
                                        <input type="text" class="form-control" id="pac-input" placeholder="Address Store">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Province:</label>
                                        <select class="form-control" id="province" name="category">
                                            <option disabled selected>Select Province</option>
                                            <?php foreach ($province as $row) : ?>
                                                <option value="<?= htmlspecialchars($row->province_name) ?>">
                                                    <?= htmlspecialchars($row->province_name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>City:</label>
                                        <select class="form-control" id="city" name="category">
                                            <option disabled selected>Select City</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>District:</label>
                                        <select class="form-control" id="district" name="district">
                                            <option disabled selected>Select District</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Subdistrict:</label>
                                        <select class="form-control" id="subdistrict" name="subdistrict">
                                            <option disabled selected>Select Subdistrict</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Description:</label>
                                        <textarea id="description" class="form-control custom" placeholder="Description Store"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div id="map" style="height: 400px; width: 100%;"></div>
                                    </div>
                                </div>
                                <button type="button" onclick="CreateStore()" id="createStore" class="btn btn-custom" style="float: right;">Submit</button><br>
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
<?= view('js/store'); ?>