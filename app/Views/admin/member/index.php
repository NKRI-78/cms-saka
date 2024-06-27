<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url('public/assets/css/member.css') ?>">

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
                                        <th id="fullname">Full Name</th>
                                        <th>Action</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>No Member</th>
                                        <th>Province</th>
                                        <th>City</th>
                                        <th>Lanud</th>
                                        <th>Status</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a = 0; ?>
                                    <?php $i = 0; ?>
                                    <?php if ($member != "") { ?>
                                        <?php foreach ($member as $row) : ?>
                                            <tr>
                                                <td><?= $row->fullname ?></td>
                                                <td>
                                                    <div class="send-panel">
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded">
                                                            <a href="<?= base_url("admin/member/edit/$row->user_id") ?>"> <i class="ri-pencil-line text-primary"></i></a>
                                                        </label>
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded">
                                                            <a href="#myModal<?= $a++ ?>" class="trigger-btn" data-toggle="modal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Member"> <i class="ri-delete-bin-line text-primary"></i></a>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><?= $row->phone_number ?></td>
                                                <td><?= $row->email_address ?></td>
                                                <td><?= $row->no_member ?></td>
                                                <td><?= $row->province ?></td>
                                                <td><?= $row->city ?></td>
                                                <td><?= $row->lanud ?></td>
                                                <td>
                                                    <?php switch ($row->status) {
                                                        case "enabled":
                                                            echo "<div class='badge badge-pill badge-success'>paid</div>";
                                                            break;
                                                        case "pending":
                                                            echo "<div class='badge badge-pill badge-danger'>unpaid</div>";
                                                            break;
                                                    }  ?>
                                                </td>
                                                <td><?= $row->address ? $row->address : '-' ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php $b = 0; ?>
                    <?php if ($member != "") { ?>
                        <?php foreach ($member as $row) : ?>
                            <div id="myModal<?= $b++ ?>" class="modal fade">
                                <div class="modal-dialog modal-confirm">
                                    <div class="modal-content">
                                        <div class="modal-header flex-column">
                                            <div class="icon-box">
                                                <i class="material-icons">&#xE5CD;</i>
                                            </div>
                                            <h4 class="modal-title w-100">Apakah Anda Yakin?</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                            <button type="button" onclick="Delete('<?= $row->user_id ?>')" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php } ?>

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

                setInterval(function() {
                    location.reload();
                }, 1000);
            },
            error: function(err) {
                toastr.error('Hapus Member Gagal');
            }
        });
    }
</script>