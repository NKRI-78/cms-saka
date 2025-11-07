<script>
    $('#data').DataTable();
    $("#joinmember").DataTable({
        order: [
            [2, 'asc']
        ],
    });
    $('#detailJoin').DataTable({
        "pageLength": 100,
    });

    $('#dataCommerceConfiguration').DataTable({
        "scrollX": true
    });

    let tabelMember = $('#member').DataTable({
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'print'
        ],
    });

    async function Data() {

        tabelMember.clear().draw();

        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/member/getData`,
            cache: false,
            contentType: false,
            processData: false,
            data: false,
            success: function(response) {
                var res = JSON.parse(response);
                var no = 1;

                var dataRows = res.body.map(element => {

                    return [
                        no++,
                        element.fullname ? element.fullname : "-",
                        `<div class="send-panel"> 
                            <label class="ml-2 mb-0 iq-bg-primary rounded"><a href="${baseUrl}/admin/member/edit/${element.user_id}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Event"><i class="ri-edit-line text-primary"></i></a></label>&nbsp;
                            <label class="ml-2 mb-0 iq-bg-primary rounded"> <a onclick="DeleteMember('${element.user_id}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Event"> <i class="ri-delete-bin-line text-primary"></i></a></label>
                        </div>`,
                        element.phone_number ? element.phone_number : "-",
                        element.email_address ? element.email_address : "-",
                        element.no_member ? element.no_member : "-",
                        element.province ? element.province : "-",
                        element.city ? element.city : "-",
                        element.lanud ? element.lanud : "-",
                        element.created ? moment(element.created).format('D MMMM YYYY') : "-",
                        element.address ? element.address : "-",
                    ]
                });

                tabelMember.rows.add(dataRows).draw();
            },
            error: function(err) {
                $(".loader-table").css({
                    "display": "none"
                });
                console.log(err);
            }
        });
    }

    Data()

    function DeleteMember(userId) {
        console.log('delete');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Member ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: `${baseUrl}/admin/member/delete/${userId}`,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    success: function(response) {
                        toastr.success('Hapus Member Berhasil');
                        location.reload();
                    },
                    error: function(err) {
                        toastr.error('Hapus Member Gagal');
                    }
                });
            }
        });
    }

    CreateBanner = async () => {
        let data = new FormData();
        var name = $("#name").val();
        var placement = $("#placement").val();
        let image = $('#imageBanner')[0].files[0];

        data.append('name', name);
        data.append('placement', placement);
        data.append('image', image);

        $("#createBanner").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/banner/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create banner success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/banner`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createBanner").text('Submit');
            }
        });
    }

    DetailBanner = async (bannerId) => {
        $("#imageBanner").removeAttr("src");
        $('#detailBanner').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/banner/detail/${bannerId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);
                $("#imageBanner").attr('src', `${data.data[0].Media[0].path}`);
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    UpdateBanner = async () => {
        let data = new FormData();
        var bannerId = $("#bannerId").val();
        var name = $("#name").val();
        var placement = $("#placement").val();
        let image = $('#imageBanner')[0].files[0];

        data.append('bannerId', bannerId);
        data.append('name', name);
        data.append('placement', placement);
        data.append('image', image);

        $("#updateBanner").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/banner/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update banner success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/banner`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateBanner").text('Update');
            }
        });
    }

    CreateEvent = async () => {
        let data = new FormData();
        var start = $("#start").val();
        var end = $("#end").val();
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        var description = $("#description").val();
        let picture = $('#picture')[0].files[0];
        var location = $("#location").val();
        var summary = $("#summary").val();
        var shareNews = "false";

        if (summary == "") {
            return toastr.error('summary tidak boleh kosong');
        }

        if (description == "") {
            return toastr.error('description tidak boleh kosong');
        }

        data.append('start', start);
        data.append('end', end);
        data.append('startDate', startDate);
        data.append('endDate', endDate);
        data.append('description', description);
        data.append('picture', picture);
        data.append('location', location);
        data.append('summary', summary);
        data.append('shareNews', shareNews);

        $("#createEvent").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/event/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create event success');
                setInterval(function() {
                    window.top.location.href = `${baseUrl}/admin/event`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createEvent").text('Submit');
            }
        });
    }

    UpdateEvent = async () => {
        let data = new FormData();
        var eventId = $("#eventId").val();
        var start = $("#start").val();
        var end = $("#end").val();
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        var description = $("#description").val();
        let picture = $('#picture')[0].files[0];
        var location = $("#location").val();
        var summary = $("#summary").val();

        data.append('eventId', eventId);
        data.append('start', start);
        data.append('end', end);
        data.append('startDate', startDate);
        data.append('endDate', endDate);
        data.append('description', description);
        data.append('picture', picture);
        data.append('location', location);
        data.append('summary', summary);

        $("#updateEvent").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/event/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update event success');
                setInterval(function() {
                    window.top.location.href = `${baseUrl}/admin/event`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateEvent").text('Update');
            }
        });
    }

    DetailEvent = async (eventId) => {
        $("#imageEvent").removeAttr("src");
        $('#detailEvent').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/event/detail/${eventId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);

                $("#imageEvent").attr('src', `${data.data[0].Media[0].path}`);
                $("#eventDate").html(data.data[0].event_date);
                $("#startEnd").html(data.data[0].start + " - " + data.data[0].end);
                $("#description").html(data.data[0].description);
                $("#location").html(data.data[0].location);
                $("#summary").html(data.data[0].summary);
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    CreateNews = async () => {
        let data = new FormData();
        var title = $("#title").val();
        var highlight = $("#highlight").val();
        let image = $('#imageNews')[0].files[0];
        let content = $("#froalaContent").val();

        data.append('title', title);
        data.append('highlight', highlight);
        data.append('image', image);
        data.append('content', content);

        $("#createNews").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/news/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create news success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/news`;
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createNews").text('Submit');
            }
        });
    }

    UpdateNews = async () => {
        let data = new FormData();
        var newsId = $("#newsId").val();
        var title = $("#title").val();
        var highlight = $("#highlight").val();
        let image = $('#imageNews')[0].files[0];
        let content = $("#froalaContent").val();

        data.append('newsId', newsId);
        data.append('title', title);
        data.append('highlight', highlight);
        data.append('image', image);
        data.append('content', content);

        $("#updateNews").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/news/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update news success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/news`;
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateNews").text('Update');
            }
        });
    }


    DetailNews = async (newsId) => {
        $("#imageNews").removeAttr("src");
        $('#detailNews').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/news/detail/${newsId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);

                $("#imageNews").attr('src', `${data.data[0].Media[0].path}`);
                $("#contentNews").html(data.data[0].content);
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    Broadcast = async () => {
        let data = new FormData();
        var title = $("#title").val();
        var message = $("#message").val();

        if (title == "") {
            toastr.warning('title cannot be empty!');
            return
        }

        if (message == "") {
            toastr.warning('message cannot be empty!');
            return
        }

        data.append('title', title);
        data.append('message', message);

        $("#broadcast").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/broadcast/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('send broadcast success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#broadcast").text('Submit');
            }
        });
    }

    $('#dataCommerceBanner').DataTable();
    $('#dataOrder').DataTable({
        scrollX: true,
    });
    $('#dataCampaign').DataTable();

    CreateCommerceBanner = async () => {
        let data = new FormData();
        var actionType = $("#actionType").val();
        var index = $("#index").val();
        var targetId = $("#targetId").val();
        let image = $('#imageBanner')[0].files[0];

        data.append('actionType', actionType);
        data.append('index', index);
        data.append('targetId', targetId);
        data.append('image', image);

        $("#createBanner").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/commerce-banner/post-commerce-banner`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create banner success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createBanner").text('Submit');
            }
        });
    }

    DetailCommerceBanner = async (bannerId) => {
        $("#imageBanner").removeAttr("src");
        $('#detailBanner').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/commerce-banner/detail/${bannerId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);
                $("#imageBanner").attr('src', `${imageUrl + data.data.image.path}`);
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    UpdateCommerceBanner = async () => {
        let data = new FormData();
        var bannerId = $("#bannerId").val();
        var actionType = $("#actionType").val();
        var index = $("#index").val();
        var targetId = $("#targetId").val();
        let image = $('#imageBanner')[0].files[0];

        data.append('bannerId', bannerId);
        data.append('actionType', actionType);
        data.append('index', index);
        data.append('targetId', targetId);
        data.append('image', image);

        $("#updateBanner").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/commerce-banner/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update banner success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateBanner").text('Submit');
            }
        });
    }

    CreateCampaign = async () => {
        let data = new FormData();
        var index = $("#index").val();
        var title = $("#title").val();
        var subtitle = $("#subtitle").val();
        var backgroundColor = $("#backgroundColor").val();
        var titleColor = $("#titleColor").val();
        var titleBgColor = $("#titleBgColor").val();
        var campaignType = $("#campaignType").val();
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        let image = $("#imageCampaign")[0].files[0];
        var products = $('#products').val();

        data.append('index', index);
        data.append('image', image);
        data.append('title', title);
        data.append('subtitle', subtitle);
        data.append('backgroundColor', backgroundColor);
        data.append('titleBgColor', titleBgColor);
        data.append('titleColor', titleColor);
        data.append('campaignType', campaignType);
        data.append('startDate', startDate);
        data.append('endDate', endDate);
        data.append('products', products);

        $("#createCampaign").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/campaign/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create campaign success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createCampaign").text('Submit');
            }
        });
    }

    function capitalizeWords(str) {
        return str.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
    }

    // document.getElementById('nameCategory').addEventListener('input', function() {
    //     this.value = capitalizeWords(this.value);
    // });

    CreateCategory = async () => {
        let data = new FormData();
        var name = $("#nameCategory").val();
        // var parent = $("#parent").val();
        // let image = $('#imageCategory')[0].files[0];

        data.append('name', name);
        // data.append('parent', parent);
        // data.append('image', image);

        $("#createCategory").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/category/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create category success');
                setInterval(function() {
                    // location.reload();
                    window.top.location.href = `${baseUrl}/admin/category`;
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createCategory").text('Submit');
            }
        });
    }

    UpdateCategory = async () => {
        let data = new FormData();
        var categoryId = $("#categoryId").val();
        var name = $("#name").val();
        var parent = $("#parent").val();
        let image = $('#imageCategory')[0].files[0];

        data.append('categoryId', categoryId);
        data.append('name', name);
        data.append('parent', parent);
        data.append('image', image);

        $("#updateCategory").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/category/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update category success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateCategory").text('Submit');
            }
        });
    }

    DetailCategory = async (categoryId) => {
        $("#imageCategory").removeAttr("src");
        $('#detailCategory').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/category/detail/${categoryId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);
                $("#imageCategory").attr('src', `${imageUrl + data.data[0].picture.path}`);
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    UpdateConfiguration = async () => {
        let data = new FormData();
        var configId = $("#configId").val();
        var delayedSettlementWhenOrderCompletedInHours = $("#delayedSettlementWhenOrderCompletedInHours").val();
        var expiringOrderWhenNoRespondInHours = $("#expiringOrderWhenNoRespondInHours").val();
        var expiringTransactionWhenNotPaidInHours = $("#expiringTransactionWhenNotPaidInHours").val();
        var internalWalletAccount = $("#internalWalletAccount").val();
        var productChargePercentage = $("#productChargePercentage").val();
        var serviceCharge = $("#serviceCharge").val();

        data.append('configId', configId);
        data.append('delayedSettlementWhenOrderCompletedInHours', delayedSettlementWhenOrderCompletedInHours);
        data.append('expiringOrderWhenNoRespondInHours', expiringOrderWhenNoRespondInHours);
        data.append('expiringTransactionWhenNotPaidInHours', expiringTransactionWhenNotPaidInHours);
        data.append('internalWalletAccount', internalWalletAccount);
        data.append('productChargePercentage', productChargePercentage);
        data.append('serviceCharge', serviceCharge);

        $("#updateConfiguration").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/configuration/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update configuration success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateConfiguration").text('Submit');
            }
        });
    }

    CreateCourier = async () => {
        let data = new FormData();
        var courierId = $("#courierId").val();
        var checkPriceSupported = $("#checkPriceSupported").val();
        var checkResiSupported = $("#checkResiSupported").val();
        var name = $("#name").val();
        let image = $('#image')[0].files[0];

        data.append('name', name);
        data.append('courierId', courierId);
        data.append('checkPriceSupported', checkPriceSupported);
        data.append('checkResiSupported', checkResiSupported);
        data.append('image', image);

        $("#createCourier").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/courier/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create courier success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createCourier").text('Submit');
            }
        });
    }

    UpdateCourier = async () => {
        let data = new FormData();
        var courierId = $("#courierId").val();
        var checkPriceSupported = $("#checkPriceSupported").val();
        var checkResiSupported = $("#checkResiSupported").val();
        var name = $("#name").val();
        let image = $('#image')[0].files[0];

        data.append('name', name);
        data.append('courierId', courierId);
        data.append('checkPriceSupported', checkPriceSupported);
        data.append('checkResiSupported', checkResiSupported);
        data.append('image', image);

        $("#updateCourier").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/courier/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update courier success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateCourier").text('Submit');
            }
        });
    }

    CreateCourierService = async () => {
        let data = new FormData();
        var courierId = $("#courierId").val();
        var name = $("#name").val();
        var code = $("#code").val();
        var type = $("#type").val();
        var minWeight = $("#minWeight").val();
        var estimateDays = $("#estimateDays").val();

        data.append('courierId', courierId);
        data.append('name', name);
        data.append('code', code);
        data.append('type', type);
        data.append('minWeight', minWeight);
        data.append('estimateDays', estimateDays);

        $("#createCourierService").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/courier/post-service`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create courier service success');
                setInterval(function() {
                    location.reload();
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createCourierService").text('Submit');
            }
        });
    }

    UpdateCourierService = async () => {
        let data = new FormData();
        var courierServiceId = $("#courierServiceId").val();
        var courierId = $("#courierId").val();
        var name = $("#name").val();
        var code = $("#code").val();
        var type = $("#type").val();
        var minWeight = $("#minWeight").val();
        var estimateDays = $("#estimateDays").val();

        data.append('courierServiceId', courierServiceId);
        data.append('courierId', courierId);
        data.append('name', name);
        data.append('code', code);
        data.append('type', type);
        data.append('minWeight', minWeight);
        data.append('estimateDays', estimateDays);

        $("#updateCourierService").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/courier/update-service`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update courier service success');
                setInterval(function() {
                    location.reload();
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateCourierService").text('Submit');
            }
        });
    }

    ChangePassword = async () => {
        let data = new FormData();
        var oldPassword = $("#oldPassword").val();
        var newPassword = $("#newPassword").val();
        var confirmNewPassword = $("#confirmNewPassword").val();

        data.append('oldPassword', oldPassword);
        data.append('newPassword', newPassword);
        data.append('confirmNewPassword', confirmNewPassword);

        $("#changePassword").text('Loading...');

        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/setting/change-password`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('change password success');
                setInterval(function() {
                    location.reload();
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#changePassword").text('Submit');
            }
        });
    }
</script>