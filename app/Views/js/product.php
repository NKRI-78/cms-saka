<script>
    // $('#data').DataTable();

    $('#data').DataTable({
        "processing": true,
        "serverSide": true,
        "pagination": true,
        "scrollX": true,
        "fixedColumns": {
            left: 4
        },
        "ajax": {
            "url": `${baseUrl}/admin/product/getData`,
            "dataType": "json",
            "type": "POST"
        },

        "columns": [{
                "data": "no"
            },
            {
                "data": "name"
            },
            {
                "data": "stok"
            },
            {
                "data": "price"
            },
            {
                "data": "action"
            },
        ]
    });

    // $(document).ready(function() {
        CreateProduct = async () => {
            let data = new FormData();

            var productId = uuid.v4();
            var app_id = $("#app_id").val();
            var store_id = $("#store_id").val();
            var title = $("#title").val();
            var price = $("#price").val().replace(/\./g, '');
            var stock = $("#stock").val();
            var weight = $("#weight").val();
            var category = $("#category").val();
            var caption = $("#caption").val();
            // let image = $('#imageProduct')[0].files[0];

            data.append('productId', productId);
            data.append('app_id', app_id);
            data.append('store_id', store_id);
            data.append('title', title);
            data.append('price', price);
            data.append('stock', stock);
            data.append('weight', weight);
            data.append('category', category);
            data.append('caption', caption);
            // data.append('image', image);

            imageDropzone.files.forEach((file, index) => {
                data.append(`images[${index}]`, file);
            });

            $("#createProduct").text('Loading...');
            await $.ajax({
                type: "POST",
                url: `${baseUrl}/admin/product/post`,
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                success: function(response) {
                    toastr.success('create product success');
                    setInterval(function() {
                        location.href = `${baseUrl}/admin/product`;
                    }, 1500);
                },
                error: function(err) {
                    toastr.error('something went wrong');
                    $("#createProduct").text('Submit');
                }
            });
        }
    // })

    $(document).ready(function() {
        DetailProduct = async (productId) => {
            $("#imageNews").removeAttr("src");
            $('#detailProduct').modal('show');
            await $.ajax({
                type: "GET",
                url: `${baseUrl}/admin/product/detail/${productId}`,
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data.data.medias, 'data');

                    if (data.data.medias && data.data.medias.length > 0) {
                        data.data.medias.forEach((media, index) => {
                            const indicatorClass = index === 0 ? 'active' : '';
                            $('#carouselIndicators').append(`<li data-target="#carouselExampleIndicators" data-slide-to="${index}" class="${indicatorClass}"></li>`);

                            const itemClass = index === 0 ? 'carousel-item active' : 'carousel-item';
                            $('#carouselInner').append(`
                            <div class="${itemClass}">
                                <img src="${media.path}" class="d-block w-100" alt="Image" style="object-fit:contain;">
                            </div>
                        `);
                        });
                    } else {
                        $('#carouselInner').append(`
                        <div class="carousel-item active">
                            <img src="../public/assets/images/image-default.png" class="d-block w-100" alt="Default Image" style="object-fit:contain;">
                        </div>
                    `);
                    }

                    $("#contentNews").html(data.data.title);
                },
                error: function(err) {
                    toastr.error('something went wrong');
                }
            });
        }
    })

    Dropzone.autoDiscover = false;

    const imageDropzone = new Dropzone("#image-dropzone", {
        url: `${baseUrl}/admin/product/post`, // Ganti dengan endpoint upload Anda
        maxFiles: 4,
        maxFilesize: 2, // Max filesize in MB
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictRemoveFile: "Remove",
        thumbnailWidth: 150, // Sesuaikan ukuran thumbnail
        thumbnailHeight: 150,
        init: function() {

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

    function DeleteProduct(productId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Product ini akan dihapus!',
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
                    url: `${baseUrl}/admin/product/delete/${productId}`,
                    success: function(response) {
                        console.log(response, 'delete');
                        Swal.fire(
                            'Dihapus!',
                            'Product berhasil dihapus.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(err) {
                        // Handle error
                        console.error('Error:', err);
                    }
                });
            }
        });
    }

    const priceInput = document.getElementById('price');

    priceInput.addEventListener('keyup', function(e) {
        let value = this.value.replace(/[^,\d]/g, '');

        let parts = value.split(',');
        let integerPart = parts[0];
        let decimalPart = parts[1];

        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        this.value = decimalPart !== undefined ? integerPart + ',' + decimalPart : integerPart;

        this.value = this.value;
        // this.value = 'Rp ' + this.value;
    });
</script>