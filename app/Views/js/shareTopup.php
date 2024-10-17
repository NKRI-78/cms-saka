<script>
    var table = $('#shareTopup').DataTable({
        "searching": false,
        "paging":   true,
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
            url: `${baseUrl}/admin/topup/getData`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);
                let no = 1;

                // fillter berdasarkan tanggal
                data.body.data.sort((a, b) => {
                    return new Date(b.created_at) - new Date(a.created_at);
                });

                var dataRows = data.body.data.map(element => {

                    let statusText = "";

                    switch(element.payment_status) {
                        case 'WAITING_PAYMENT':
                            statusText = `<h5><span class="badge badge-secondary">Menunggu Pembayaran</span></h5>`;
                            break;
                        case 'PAID':
                            statusText = `<h5><span class="badge badge-success">Pembayaran Berhasil</span></h5>`;
                            break;
                        default:
                            statusText = "Status Tidak Diketahui";
                            break;
                    }

                    return [
                        no++,
                        element.user ? capitalizeWords(element.user.fullname) : "-",
                        element.gross_amount ? formatRupiah(element.gross_amount) : 0,
                        element.created_at ? moment(element.created_at).format('DD MMMM YYYY') : "-",
                        element.payment_code ? capitalizeWords(element.payment_code) : "-",
                        statusText
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

    function capitalizeWords(str) {
        return str.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
    }

    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0 // Menentukan jumlah desimal
        }).format(value);
    }

</script>