<script>
    var table = $('#shareTopup').DataTable({
        "searching": false,
        "paging":   false,
        "ordering": false,
        "info":     false
    });

    shareTopup = async () => {
        table.clear().draw();
        let data = new FormData();
        var start = $("#start").val();
        var end = $("#end").val();

        data.append('start', start);
        data.append('end', end);

        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/share/payment-topup`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);

                var dataRows = data.body.map(element => {

                    return [
                        element.remark ? element.remark : "-",
                        element.count ? element.count : 0,
                        element.totalAmount ? "Rp. " + element.totalAmount : 0,
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

    shareTopup();

</script>