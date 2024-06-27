<script>
    var table = $('#shareRegis').DataTable({
        "searching": false,
        "paging":   false,
        "ordering": false,
        "info":     false
    });

    shareRegis = async () => {
        table.clear().draw();
        let data = new FormData();
        var start = $("#start").val();
        var end = $("#end").val();

        data.append('start', start);
        data.append('end', end);

        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/share/payment-regis`,
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
                        element.total_referral ? element.total_referral : 0,
                        element.total_partnership ? element.total_partnership : 0,
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

    shareRegis();

</script>