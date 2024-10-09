<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<!--  Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Data Category</h4>
                        </div>
                        <?php if (session()->get('role') === 'client'): ?>
                            <a href="<?= base_url("/admin/category/create") ?>" class="btn mb-3 btn-primary" style="margin-top: 15px;"><i class="ri-add-circle-line"></i>Add</a>
                        <?php endif; ?>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="dataCommerceBanner" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <!-- <th scope="col">File Name</th> -->
                                        <?php if (session()->get('role') === 'client'): ?>
                                            <th scope="col">&emsp;&emsp;Action</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php if ($category != "NULL") { ?>
                                        <?php foreach ($category as $row) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row->name ?></td>
                                                <?php if (session()->get('role') === 'client'): ?>
                                                    <td>
                                                        <div class="send-panel">
                                                            <label class="ml-2 mb-0 iq-bg-primary rounded"> <a onclick="DeleteCategory('<?= $row->id ?>')" data-toggle="tooltip" data-placement="top" title="Delete Category" data-original-title="Delete Category"> <i class="ri-delete-bin-line text-primary"></i></a> </label>
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="modal fade" id="detailCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Image Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="" class="img-fluid" id="imageCategory" alt="image" style=" width: 100%; height: auto; max-height: 250px;">
                                    </div>
                                </div>
                            </div>
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
<?= view('js/admin'); ?>
<script>
    function DeleteCategory(categoryId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Category ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: `${baseUrl}/admin/category/delete/${categoryId}`,
                    success: function(response, textStatus, xhr) {
                        if (xhr.status === 200) {
                            Swal.fire(
                                'Dihapus!',
                                'Category berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 400) {
                            Swal.fire({
                                title: 'Tidak Dapat Dihapus!',
                                text: 'Ada produk yang menggunakan kategori ini.',
                                icon: 'error',
                                timer: 3000, // 3 detik
                                timerProgressBar: true,
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan. Silakan coba lagi.',
                                'error'
                            );
                        }
                        console.error('Error:', xhr);
                    }
                });
            }
        });
    }
</script>