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
                "data": "category"
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

        myDropzone.files.forEach((file, index) => {
            data.append(`images[${index}]`, file);
        });

        // $("#createProduct").prop('disabled', true);
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
                    // location.href = `${baseUrl}/admin/product`;
                }, 1500);
            },
            error: function(err) {
                console.log(err, response, 'cek');
                toastr.error('something went wrong');
                $("#createProduct").text('Submit');
            }
        });
    }
    // })

    $(document).ready(function() {
        DetailProduct = async (productId) => {
            $("#carouselIndicators").empty();
            $("#carouselInner").empty();
            $("#imageNews").removeAttr("src");

            $('#detailProduct').modal('show');

            await $.ajax({
                type: "GET",
                url: `${baseUrl}/admin/product/detail/${productId}`,
                cache: false,
                contentType: false,
                processData: false,
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
    });


    // Dropzone.autoDiscover = false;

    // const imageDropzone = new Dropzone("#image-dropzone", {
    //     url: `${baseUrl}/admin/product/post`, 
    //     maxFiles: 5,
    //     maxFilesize: 2, 
    //     acceptedFiles: "image/*",
    //     addRemoveLinks: true,
    //     dictRemoveFile: "Remove",
    //     thumbnailWidth: 150, 
    //     thumbnailHeight: 150,
    //     init: function() {

    //         this.on("success", function(file, response) {
    //             console.log(file, response, 'aaa')
    //         });
    //         this.on("removedfile", function(file) {

    //         });

    //         // this.on("addedfile", function(file) {
    //         //     const fileCount = this.getAcceptedFiles().length;

    //         //     if (fileCount > 5) {
    //         //         // Hapus file terakhir yang diupload jika melebihi batas
    //         //         this.removeFile(file);

    //         //         // Tampilkan peringatan menggunakan SweetAlert2
    //         //         Swal.fire({
    //         //             icon: 'warning',
    //         //             title: 'Peringatan',
    //         //             text: 'Anda hanya dapat meng-upload maksimal 5 gambar.',
    //         //         });
    //         //     }
    //         // });

    //         this.on("maxfilesexceeded", function(file) {
    //             // Hapus file terakhir yang diupload jika melebihi batas
    //             this.removeFile(file);

    //             // Tampilkan peringatan menggunakan SweetAlert2
    //             Swal.fire({
    //                 icon: 'warning',
    //                 title: 'Peringatan',
    //                 text: 'Anda hanya dapat meng-upload maksimal 5 gambar.',
    //             });
    //         });
    //     }
    // });

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

    const id = "#kt_dropzonejs_example_3";
    const dropzone = document.querySelector(id);

    // Menyiapkan elemen template preview
    var previewNode = dropzone.querySelector(".dropzone-item");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    // Inisialisasi Dropzone dengan opsi yang diinginkan
    var myDropzone = new Dropzone(id, {
        url: `${baseUrl}/admin/product/post`,
        parallelUploads: 20,
        maxFilesize: 1,
        previewTemplate: previewTemplate,
        previewsContainer: id + " .dropzone-items",
        clickable: id + " .dropzone-select",
        maxFiles: 5
    });

    function updateButtonState() {
        const button = document.getElementById('upload-image-button');
        if (myDropzone.files.length >= 4) {
            button.classList.add('disabled');
            button.style.pointerEvents = 'none';
        } else {
            button.classList.remove('disabled');
            button.style.pointerEvents = 'auto';
        }
    }

    // Menambahkan event listener untuk menampilkan preview gambar
    myDropzone.on("addedfile", function(file) {
        const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
        dropzoneItems.forEach(dropzoneItem => {
            dropzoneItem.style.display = '';
        });

        const totalFiles = myDropzone.files.length;

        // Jika total file lebih dari 5, hapus file yang paling baru ditambahkan
        if (totalFiles > 5) {
            myDropzone.removeFile(file);
            // alert("Jumlah maksimal gambar adalah 5. Gambar terbaru yang ditambahkan akan dihapus.");
        }

        updateButtonState();
    });

    // Event listener untuk mengupdate progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
        const progressBars = dropzone.querySelectorAll('.progress-bar');
        progressBars.forEach(progressBar => {
            progressBar.style.width = progress + "%";
        });
    });

    // Event listener ketika file mulai dikirim
    myDropzone.on("sending", function(file) {
        const progressBars = dropzone.querySelectorAll('.progress-bar');
        progressBars.forEach(progressBar => {
            progressBar.style.opacity = "1";
        });
    });

    // Event listener ketika upload selesai
    myDropzone.on("complete", function(progress) {
        const progressBars = dropzone.querySelectorAll('.dz-complete');

        setTimeout(function() {
            progressBars.forEach(progressBar => {
                progressBar.querySelector('.progress-bar').style.opacity = "0";
                progressBar.querySelector('.progress').style.opacity = "0";
            });
        }, 300);
    });

    // Event listener untuk menampilkan preview gambar
    myDropzone.on("thumbnail", function(file, dataUrl) {
        var dropzoneItem = file.previewElement;
        var imgElement = dropzoneItem.querySelector("img");
        if (imgElement) {
            imgElement.src = dataUrl;
        }
    });

    myDropzone.on("removedfile", function() {
        updateButtonState();
    });

    $('#title').on('input', function() {
        let inputValue = $(this).val();
        let capitalizedValue = inputValue.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
        $(this).val(capitalizedValue);
    });
</script>