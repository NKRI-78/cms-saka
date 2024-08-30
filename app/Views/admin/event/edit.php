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
                            <h4 class="card-title">Edit Event</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" id="eventId" value="<?= $event[0]->event_id ?>" hidden>
                                    <div class="form-group col-md-12">
                                        <label>Title:</label>
                                        <input type="text" class="form-control" id="summary" value="<?= $event[0]->summary ?>">
                                        <!-- <textarea id="summary" class="form-control"><?= $event[0]->summary ?></textarea> -->
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Event Date:</label>
                                        <input type="date" class="form-control" id="eventDate" value="<?= $event[0]->event_date ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Start:</label>
                                        <input type="time" class="form-control" id="start" value="<?= $event[0]->start ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>End:</label>
                                        <input type="time" class="form-control" id="end" value="<?= $event[0]->end ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Picture (Recommendation Size 700 x 525):</label>
                                        <input type="file" class="dropify" id="picture" data-default-file="<?= isset($event[0]->Media[0]->path) ? $event[0]->Media[0]->path : "" ?>" data-height="200" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Location:</label>
                                        <textarea id="location" class="form-control"><?= $event[0]->location ?></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Description:</label>
                                        <textarea id="description" class="form-control"><?= $event[0]->description ?></textarea>
                                    </div>
                                </div>
                                <button type="button" onclick="UpdateEvent()" id="updateEvent" class="btn btn-custom" style="float: right;">Update</button><br>
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