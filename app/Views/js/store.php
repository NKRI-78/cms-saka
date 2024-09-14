<script>
    let selectedLatitude = parseFloat(document.getElementById("latitude").value) || -6.200000;
    let selectedLongitude = parseFloat(document.getElementById("longitude").value) || 106.816666;

    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: selectedLatitude,
                lng: selectedLongitude
            },
            zoom: 13,
            mapTypeControl: false,
        });

        const marker = new google.maps.Marker({
            position: {
                lat: selectedLatitude,
                lng: selectedLongitude
            },
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true,
        });

        const input = document.getElementById("pac-input");
        const autocomplete = new google.maps.places.Autocomplete(input, {
            fields: ["formatted_address", "geometry", "name"],
            strictBounds: false,
        });

        autocomplete.bindTo("bounds", map);

        const infowindow = new google.maps.InfoWindow();
        const infowindowContent = document.getElementById("infowindow-content");
        infowindow.setContent(infowindowContent);

        autocomplete.addListener("place_changed", () => {
            infowindow.close();
            marker.setVisible(false);

            const place = autocomplete.getPlace();
            if (place.geometry && place.geometry.location) {
                selectedLatitude = place.geometry.location.lat();
                selectedLongitude = place.geometry.location.lng();

                // Set the updated latitude and longitude to input fields
                document.getElementById("latitude").value = selectedLatitude;
                document.getElementById("longitude").value = selectedLongitude;
            }

            selectedLatitude = place.geometry.location.lat();
            selectedLongitude = place.geometry.location.lng();

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            infowindowContent.children["place-name"].textContent = place.name;
            infowindowContent.children["place-address"].textContent = place.formatted_address;
            infowindow.open(map, marker);

            document.getElementById("latitude").value = selectedLatitude;
            document.getElementById("longitude").value = selectedLongitude;
            document.getElementById("pac-input").value = place.formatted_address;
        });

        google.maps.event.addListener(marker, 'dragend', function(event) {
            // const geocoder = new google.maps.Geocoder();
            // const latlng = {
            //     lat: event.latLng.lat(),
            //     lng: event.latLng.lng()
            // };

            // geocoder.geocode({
            //     location: latlng
            // }, (results, status) => {
            //     if (status === 'OK') {
            //         if (results[0]) {
            //             const address = results[0].formatted_address;
            //             const name = results[0].address_components.find(component => component.types.includes('street_address'))?.long_name || 'No name found';

            //             document.getElementById("latitude").value = latlng.lat;
            //             document.getElementById("longitude").value = latlng.lng;
            //             document.getElementById("pac-input").value = address;
            //             infowindowContent.children["place-name"].textContent = name;
            //             infowindowContent.children["place-address"].textContent = address;
            //         } else {
            //             window.alert('No results found');
            //         }
            //     } else {
            //         window.alert('Geocoder failed due to: ' + status);
            //     }
            // });

            selectedLatitude = event.latLng.lat();
            selectedLongitude = event.latLng.lng();

            document.getElementById("latitude").value = selectedLatitude;
            document.getElementById("longitude").value = selectedLongitude;
        });
    }

    // function initMap() {
    //     const map = new google.maps.Map(document.getElementById("map"), {
    //         center: {
    //             lat: selectedLatitude,
    //             lng: selectedLongitude
    //         },
    //         zoom: 13,
    //         mapTypeControl: false,
    //     });

    //     const marker = new google.maps.Marker({
    //         position: {
    //             lat: selectedLatitude,
    //             lng: selectedLongitude
    //         },
    //         map: map,
    //         anchorPoint: new google.maps.Point(0, -29),
    //         draggable: true,
    //     });

    //     const input = document.getElementById("pac-input");
    //     const autocomplete = new google.maps.places.Autocomplete(input, {
    //         fields: ["formatted_address", "geometry", "name"],
    //         strictBounds: false,
    //     });

    //     autocomplete.bindTo("bounds", map);

    //     const infowindow = new google.maps.InfoWindow();
    //     const infowindowContent = document.getElementById("infowindow-content");
    //     infowindow.setContent(infowindowContent);

    //     autocomplete.addListener("place_changed", () => {
    //         infowindow.close();
    //         marker.setVisible(false);

    //         const place = autocomplete.getPlace();
    //         if (!place.geometry || !place.geometry.location) {
    //             window.alert("No details available for input: '" + place.name + "'");
    //             return;
    //         }

    //         selectedLatitude = place.geometry.location.lat();
    //         selectedLongitude = place.geometry.location.lng();

    //         if (place.geometry.viewport) {
    //             map.fitBounds(place.geometry.viewport);
    //         } else {
    //             map.setCenter(place.geometry.location);
    //             map.setZoom(17);
    //         }

    //         marker.setPosition(place.geometry.location);
    //         marker.setVisible(true);

    //         infowindowContent.children["place-name"].textContent = place.name;
    //         infowindowContent.children["place-address"].textContent = place.formatted_address;
    //         infowindow.open(map, marker);

    //         // Update the hidden input fields with new latitude and longitude
    //         document.getElementById("latitude").value = selectedLatitude;
    //         document.getElementById("longitude").value = selectedLongitude;
    //     });

    //     // Listener for when the marker is dragged
    //     google.maps.event.addListener(marker, 'dragend', function(event) {
    //         const geocoder = new google.maps.Geocoder();
    //         const latlng = {
    //             lat: event.latLng.lat(),
    //             lng: event.latLng.lng()
    //         };

    //         geocoder.geocode({
    //             location: latlng
    //         }, (results, status) => {
    //             if (status === 'OK') {
    //                 if (results[0]) {
    //                     const address = results[0].formatted_address;
    //                     const name = results[0].address_components.find(component => component.types.includes('street_address'))?.long_name || 'No name found';

    //                     // Update the hidden input fields with new latitude and longitude
    //                     document.getElementById("latitude").value = latlng.lat;
    //                     document.getElementById("longitude").value = latlng.lng;

    //                     // Update the input field with the new address
    //                     document.getElementById("pac-input").value = address;

    //                     infowindowContent.children["place-name"].textContent = name;
    //                     infowindowContent.children["place-address"].textContent = address;
    //                 } else {
    //                     window.alert('No results found');
    //                 }
    //             } else {
    //                 window.alert('Geocoder failed due to: ' + status);
    //             }
    //         });
    //     });
    // }

    window.onload = initMap;

    $('#province').change(function() {
        var provinceId = $(this).val();

        $('#city').html('<option disabled selected>Select City</option>');

        if (provinceId) {
            $.ajax({
                url: `${baseUrl}/admin/officialStore/getCity`,
                type: 'POST',
                data: {
                    provinceId: provinceId
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
                    $('#posCode').val('');

                    districtResponse.body.map(element => {
                        // $('#subdistrict').append('<option value="' + element.subdistrict_name + '">' + element.subdistrict_name + '</option>');
                        // $('#posCode').append(element.zip_code);
                        $('#subdistrict').append('<option value="' + element.subdistrict_name + '" data-zipcode="' + element.zip_code + '">' + element.subdistrict_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan saat mengambil data kota: ", error);
                }
            });
        }
    });

    $('#subdistrict').change(function() {
        // Ketika subdistrict berubah, ambil zip code dari atribut data-zipcode
        var selectedSubdistrict = $('#subdistrict option:selected');
        var zipCode = selectedSubdistrict.data('zipcode');

        // Isi zip code ke input posCode
        $('#posCode').val(zipCode);
    });

    UpdateStore = async () => {
        let data = new FormData();

        // var productId = uuid.v4();
        var store_id = $("#storeId").val();
        var title = $("#title").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var address = $("#pac-input").val();
        var province = $("#province").val();
        var city = $("#city").val();
        var district = $("#district").val();
        var subdistrict = $("#subdistrict").val();
        var description = $("#description").val();
        var posCode = $("#posCode").val();
        var imageOld = $("#oldImage").val();
        let image = $('#imageStore')[0].files[0];
        var latitude = document.getElementById("latitude").value;
        var longitude = document.getElementById("longitude").value;
        var posCode = $("#posCode").val();

        console.log(latitude, longitude, 'mm');

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
        data.append('latitude', latitude);
        data.append('longitude', longitude);
        data.append('posCode', posCode);

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
                // setInterval(function() {
                //     location.href = `${baseUrl}/admin/officialStore`;
                // }, 1500);
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
        var address = $("#pac-input").val();
        var province = $("#province").val();
        var city = $("#city").val();
        var district = $("#district").val();
        var subdistrict = $("#subdistrict").val();
        var description = $("#description").val();
        var posCode = $("#posCode").val();
        var imageOld = $("#oldImage").val();
        let image = $('#imageStore')[0].files[0];
        var latitude = document.getElementById("latitude").value;
        var longitude = document.getElementById("longitude").value;

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
        data.append('latitude', latitude);
        data.append('longitude', longitude);
        data.append('posCode', posCode);

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

    // window.initMap = initMap;
</script>