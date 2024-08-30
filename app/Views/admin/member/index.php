<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url('public/assets/css/member.css') ?>">
<style>
.action{
    width: 5.5rem !important;
}
</style>

<!--  Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Data Member</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="member" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th id="fullname">Full Name</th>
                                        <th class="action">Action</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>No Member</th>
                                        <th>Province</th>
                                        <th>City</th>
                                        <th>Lanud</th>
                                        <th>Tanggal Registrasi</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content  -->

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<?= view('js/admin'); ?>

<script>
    function Delete(userId) {
        $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/member/delete/${userId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('Hapus Member Berhasil');

                // setInterval(function() {
                //     location.reload();
                // }, 1000);
            },
            error: function(err) {
                toastr.error('Hapus Member Gagal');
            }
        });
    }
</script>