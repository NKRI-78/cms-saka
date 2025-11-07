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
                            <h4 class="card-title">Edit Member</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Fullname:</label>
                                        <input type="text" class="form-control" id="fullname" value="<?= $member->fullname ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Address:</label>
                                        <textarea id="address" class="form-control"><?= $member->address ?></textarea>
                                    </div>
                                </div>
                                <button type="button" onclick="UpdateUser('<?= $member->user_id ?>')" id="updateUser" class="btn btn-custom" style="float: right;">Submit</button><br>
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
<script>
    UpdateUser = async (userId) => {
        let data = new FormData();
        var userId = userId;
        let fullname = $('#fullname').val();
        let address = $('#address').val();

        data.append('userId', userId);
        data.append('fullname', fullname);
        data.append('address', address);

        $("#updateUser").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/member/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update member success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/member`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateUser").text('Submit');
            }
        });
    }
</script>