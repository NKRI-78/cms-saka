<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<style>
    .dz-image>img {
        width: 182px;
    }

    .dz-details .dz-size {
        display: none;
    }
</style>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Edit Product</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" id="productId" value="<?= $product->id ?>" hidden>
                                    <!-- <input type="text" id="imageIds" value="<?= $product->medias[0]->path ?>" hidden> -->
                                    <input type="text" id="imageIds" value="<?= htmlspecialchars(json_encode(array_column($product->medias, 'path')), ENT_QUOTES, 'UTF-8') ?>" hidden>
                                    <div class="form-group col-md-6">
                                        <label>Title:</label>
                                        <input type="text" class="form-control" id="title" placeholder="Title Product" value="<?= $product->title ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Price:</label>
                                        <input type="text" class="form-control" id="price" placeholder="Price Product" value="<?= $product->price ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Stock:</label>
                                        <input type="number" class="form-control" id="stock" placeholder="Stock Product" value="<?= $product->stock ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Weight:</label>
                                        <div style="display: flex;align-items: center; gap: 0.5rem;">
                                            <input type="text" class="form-control" id="weight" placeholder="Weight Product" style="width: 9rem;">
                                            <span style="color: #000;">gram</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Category Product:</label>
                                        <select class="form-control" id="category" name="category">
                                            <option disabled selected>Select Category</option>
                                            <?php foreach ($category as $row) : ?>
                                                <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Caption:</label>
                                        <textarea id="caption" class="form-control"><?= $product->caption ?></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image:</label>
                                        <!-- <input type="file" class="dropify" id="imageProduct" data-height="200" data-default-file="<?= $product->medias[0]->path ?>"/> -->
                                        <div id="image-dropzones" class="dropzone"></div>
                                        <input type="text" id="imageId" value="<?= $product->medias[0]->id ?>" hidden />
                                    </div>
                                </div>
                                <button type="button" onclick="UpdateProduct()" id="updateNews" class="btn btn-custom" style="float: right;">Update</button><br>
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
<script>
    Dropzone.autoDiscover = false;

    const imageDropzone = new Dropzone("#image-dropzones", {
        url: `${baseUrl}/admin/product/update`, // Ganti dengan endpoint upload Anda
        maxFiles: 4,
        maxFilesize: 2, // Max filesize in MB
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictRemoveFile: "Remove",
        init: function() {
            let fileIndex = 0;

            const imagePaths = JSON.parse(document.getElementById('imageIds').value);

            console.log(imagePaths, 'aa');

            imagePaths.forEach((path) => {
                const mockFile = {
                    name: path.split('/').pop(),
                    // size: 123456,
                    url: path
                };

                this.emit("addedfile", mockFile);
                this.emit("thumbnail", mockFile, path);
                this.emit("complete", mockFile);
            });

            this.on("success", function(file, response) {
                console.log(file, response, 'aaa')
            });
            this.on("removedfile", function(file) {
                // Panggil API untuk menghapus gambar jika diperlukan
            });

            this.on("addedfile", function(file) {
                if (this.getAcceptedFiles().length > 4) {
                    // Hapus file terakhir yang diupload jika melebihi batas
                    this.removeFile(file);

                    // Tampilkan peringatan menggunakan SweetAlert2
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Anda hanya dapat meng-upload maksimal 4 gambar.',
                    });
                }
            });
        }
    });

    UpdateProduct = async () => {
        let data = new FormData();

        // var productId = uuid.v4();
        var productId = $("#productId").val();
        var title = $("#title").val();
        var price = $("#price").val().replace(/\./g, '');
        var stock = $("#stock").val();
        var weight = $("#weight").val();
        var category = $("#category").val();
        var caption = $("#caption").val();
        var imageOld = $("#imageOld").val();
        // let image = $('#imageProduct')[0].files[0];
        let imageId = $('#imageId').val();

        data.append('productId', productId);
        data.append('title', title);
        data.append('price', price);
        data.append('stock', stock);
        data.append('weight', weight);
        data.append('category', category);
        data.append('caption', caption);
        // data.append('image', image);
        data.append('imageOld', imageOld);
        data.append('imageId', imageId);

        imageDropzone.files.forEach((file, index) => {
            data.append(`images[${index}]`, file);
        });

        $("#updateNews").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/product/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update product success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/product`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateNews").text('Submit');
            }
        });
    }
</script>