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
                            <h4 class="card-title">Add News</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Title:</label>
                                        <input type="text" class="form-control" id="title" placeholder="Title News">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Higlight:</label>
                                        <input type="number" class="form-control" id="highlight" placeholder="Higlight News">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image (Recommendation Size 700 x 525):</label>
                                        <input type="file" class="dropify" id="imageNews" data-height="200" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Content:</label>
                                        <div class="form-group">
                                            <textarea id="froalaContent"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="CreateNews()" id="createNews" class="btn btn-custom" style="float: right;">Submit</button><br>
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