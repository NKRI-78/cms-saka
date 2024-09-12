<script>
    $('#province').change(function() {
        var provinceId = $(this).val();

        $('#city').html('<option disabled selected>Select City</option>');

        if (provinceId) {
            $.ajax({
                url: `${baseUrl}/admin/officialStore/getCity`,
                type: 'POST',
                data: {
                    province_id: provinceId
                },
                success: function(response) {
                    var cities = JSON.parse(response);
                    console.log(cities, 'city');

                    cities.body.map(element => {
                        $('#city').append('<option value="' + element.city_name + '">' + element.city_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan saat mengambil data kota: ", error);
                }
            });
        }
    });

    $('#city').change(function() {

        var cityName = $(this).val();

        $('#district').html('<option disabled selected>Select City</option>');

        if (cityName) {
            $.ajax({
                url: `${baseUrl}/admin/officialStore/getDistrict`,
                type: 'POST',
                data: {
                    city_name: cityName
                },
                success: function(response) {
                    var districtResponse = JSON.parse(response);

                    districtResponse.body.map(element => {
                        $('#district').append('<option value="' + element.district_name + '">' + element.district_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan saat mengambil data kota: ", error);
                }
            });
        }
    });

    $('#district').change(function() {

        var districtName = $(this).val();

        $('#subdistrict').html('<option disabled selected>Select City</option>');

        if (districtName) {
            $.ajax({
                url: `${baseUrl}/admin/officialStore/getSubdistrict`,
                type: 'POST',
                data: {
                    district_name: districtName
                },
                success: function(response) {
                    var districtResponse = JSON.parse(response);

                    districtResponse.body.map(element => {
                        $('#subdistrict').append('<option value="' + element.subdistrict_name + '">' + element.subdistrict_name + '</option>');
                        $('#posCode').append( element.zip_code);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan saat mengambil data kota: ", error);
                }
            });
        }
    });

    UpdateStore = async () => {
        let data = new FormData();

        // var productId = uuid.v4();
        var store_id = $("#storeId").val();
        var title = $("#title").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
        var province = $("#province").val();
        var city = $("#city").val();
        var district = $("#district").val();
        var subdistrict = $("#subdistrict").val();
        var description = $("#description").val();
        var posCode = $("#posCode").val();
        var imageOld = $("#oldImage").val();
        let image = $('#imageStore')[0].files[0];

        data.append('store_id', store_id);
        data.append('title', title);
        data.append('email', email);
        data.append('phone', phone);
        data.append('address', address);
        data.append('province', province);
        data.append('city', city);
        data.append('district', district);
        data.append('subdistrict', subdistrict);
        data.append('description', description);
        data.append('imageOld', imageOld);
        data.append('image', image);

        console.log(data, 'data');

        $("#updateStore").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/officialStore/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update store success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/officialStore`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateStore").text('Submit');
            }
        });
    }

    CreateStore = async () => {
        let data = new FormData();

        var store_id = uuid.v4();
        var title = $("#title").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
        var province = $("#province").val();
        var city = $("#city").val();
        var district = $("#district").val();
        var subdistrict = $("#subdistrict").val();
        var description = $("#description").val();
        var posCode = $("#posCode").val();
        var imageOld = $("#oldImage").val();
        let image = $('#imageStore')[0].files[0];

        data.append('store_id', store_id);
        data.append('title', title);
        data.append('email', email);
        data.append('phone', phone);
        data.append('address', address);
        data.append('province', province);
        data.append('city', city);
        data.append('district', district);
        data.append('subdistrict', subdistrict);
        data.append('description', description);
        data.append('imageOld', imageOld);
        data.append('image', image);

        $("#createStore").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/officialStore/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create store success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/officialStore`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createStore").text('Submit');
            }
        });
    }

    // function DeleteProduct(productId) {
    //     Swal.fire({
    //         title: 'Apakah Anda yakin?',
    //         text: 'Product ini akan dihapus!',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Ya, hapus!',
    //         cancelButtonText: 'Batal'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 type: "post",
    //                 url: `${baseUrl}/admin/product/delete/${productId}`,
    //                 success: function(response) {
    //                     console.log(response, 'delete');
    //                     Swal.fire(
    //                         'Dihapus!',
    //                         'Product berhasil dihapus.',
    //                         'success'
    //                     ).then(() => {
    //                         location.reload();
    //                     });
    //                 },
    //                 error: function(err) {
    //                     // Handle error
    //                     console.error('Error:', err);
    //                 }
    //             });
    //         }
    //     });
    // }

    // const priceInput = document.getElementById('price');

    // priceInput.addEventListener('keyup', function(e) {
    //     let value = this.value.replace(/[^,\d]/g, '');

    //     let parts = value.split(',');
    //     let integerPart = parts[0];
    //     let decimalPart = parts[1];

    //     integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    //     this.value = decimalPart !== undefined ? integerPart + ',' + decimalPart : integerPart;

    //     this.value = this.value;
    //     this.value = 'Rp ' + this.value;
    // });
</script>