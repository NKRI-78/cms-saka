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
                            <h4 class="card-title">Add Event</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Event Date:</label>
                                        <input type="date" class="form-control" id="eventDate" placeholder="Event Date">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Start:</label>
                                        <input type="time" class="form-control" id="start">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>End:</label>
                                        <input type="time" class="form-control" id="end">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Picture (Recommendation Size 700 x 525):</label>
                                        <input type="file" class="dropify" id="picture" data-height="200" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Location:</label>
                                        <textarea id="location" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Summary:</label>
                                        <textarea id="summary" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Description:</label>
                                        <textarea id="description" class="form-control"></textarea>
                                    </div>
                                    <!-- <div class="form-group col-md-12">
                                        <label>Share News:</label>
                                        <select id="shareNews" class="form-control">
                                            <option value="">Select</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div> -->
                                </div>
                                <button type="button" onclick="CreateEvent()" id="createEvent" class="btn btn-custom" style="float: right;">Submit</button><br>
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