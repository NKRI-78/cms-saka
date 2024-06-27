<script>
    var table = $('#sharePpob').DataTable({
        "searching": false,
        "paging": false,
        "ordering": false,
        "info": false,
        "processing": true,
        "language": {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
    });

    Ppob = async () => {
        table.clear().draw();

        let data = new FormData();
        var start = $("#start").val();
        var end = $("#end").val();

        data.append('start', start);
        data.append('end', end);

        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/share/ppob`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);

                $("#totalCount").text(data.count.totalCount);
                $("#totalSellPrice").text("Rp. " + data.count.grandTotalPrice);
                $("#totalPartner").text("Rp. " + data.count.grandPartner);

                var dataRows = data.body.map(element => {

                    return [
                        element.productName ? element.productName : null,
                        element.count ? element.count : 0,
                        element.totalPrice ? "Rp. " + element.totalPrice : 0,
                        element.partner ? "Rp. " + element.partner : 0,
                    ]
                });
                table.rows.add(dataRows).draw();
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    };

    Ppob();
</script>