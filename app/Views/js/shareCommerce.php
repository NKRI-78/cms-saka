<script>
    var table = $('#shareCommerce').DataTable({
        "searching": false,
        "paging":   false,
        "ordering": false,
        "info":     false
    });

    shareCommerce = async () => {
        table.clear().draw();
        let data = new FormData();
        var start = $("#start").val();
        var end = $("#end").val();

        data.append('start', start);
        data.append('end', end);

        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/share/commerce`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);

                var dataRows = data.body.map(element => {

                    return [
                        element.count ? element.count : 0,
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

    shareCommerce();

</script>