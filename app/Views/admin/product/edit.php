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

    .custom {
        line-height: normal;
        height: 130px !important;
    }

    .dz-error-message {
        display: none !important;
    }

    .dz-error-mark {
        display: none !important;
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
                                    <input type="text" id="imageIds" value="<?= htmlspecialchars(json_encode(array_column($product->medias, 'id')), ENT_QUOTES, 'UTF-8') ?>" hidden>
                                    <input type="text" id="imagePath" value="<?= htmlspecialchars(json_encode(array_column($product->medias, 'path')), ENT_QUOTES, 'UTF-8') ?>" hidden>
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
                                        <textarea id="caption" class="form-control custom"><?= $product->caption ?></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image:</label>
                                        <!-- <input type="file" class="dropify" id="imageProduct" data-height="200" data-default-file="<?= $product->medias[0]->path ?>"/> -->
                                        <div id="image-dropzone" class="dropzone"></div>
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

    const imageDropzone = new Dropzone("#image-dropzone", {
        url: `${baseUrl}/admin/product/update`,
        maxFiles: 5,
        maxFilesize: 2,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictRemoveFile: "Remove",
        init: function() {
            // let fileIndex = 0;

            const imageId = JSON.parse(document.getElementById('imageIds').value);
            const imagePath = JSON.parse(document.getElementById('imagePath').value);

            const imageFiles = imageId.map((id, index) => ({
                id: id,
                path: imagePath[index]
            }));

            imageFiles.forEach((file) => {
                const mockFile = {
                    name: file.path.split('/').pop(),
                    url: file.path,
                    id: file.id
                };

                this.emit("addedfile", mockFile);
                this.emit("thumbnail", mockFile, file.path);
                this.emit("complete", mockFile);
            });

            this.on("success", function(file, response) {
                console.log(file, response, 'aaa')
            });
            this.on("removedfile", function(file) {
                const fileId = file.id;

                deleteImage(fileId);
            });

            this.on("maxfilesexceeded", function(file) {
                this.removeFile(file);

                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Anda hanya dapat meng-upload maksimal 5 gambar.',
                });
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
        // var imageOld = $("#imageOld").val();
        // let image = $('#imageProduct')[0].files[0];
        // let imageId = $('#imageId').val();

        data.append('productId', productId);
        data.append('title', title);
        data.append('price', price);
        data.append('stock', stock);
        data.append('weight', weight);
        data.append('category', category);
        data.append('caption', caption);
        // data.append('image', image);
        // data.append('imageOld', imageOld);
        // data.append('imageId', imageId);

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
                console.log(response, 'edit');
                toastr.success('update product success');
                // setInterval(function() {
                //     location.href = `${baseUrl}/admin/product`;
                // }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateNews").text('Submit');
            }
        });
    }

    function deleteImage(fileId) {
        let data = new FormData();

        let imageId = fileId;

        data.append('imageId', imageId);

        $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/product/deleteImage`,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response, 'aa');
                console.log('Image deleted successfully', response);
            },
            error: function(err) {
                console.error('Error deleting image', err);
            }
        });
    }
</script>