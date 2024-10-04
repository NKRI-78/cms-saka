<?php

use Config\Services;
use PHPUnit\Util\Color;

$request = Services::request();
?>

<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>
<?= date_default_timezone_set('Asia/Jakarta'); ?>
<!-- <style>
    .styleModal {
        padding-right: 147px !important;
    }
</style> -->

<!--  Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Data Report Order</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                            <!-- <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "received" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/received") ?>">Received</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "confirmed" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/confirmed") ?>">Confirmed</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "packing" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/packing") ?>">Packing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "shipping" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/shipping") ?>">Shipping</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "delivered" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/delivered") ?>">Delivered</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "done" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/done") ?>">Done</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "cancelled" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/cancelled") ?>">Cancel</a>
                            </li>
                        </ul>
                        <!-- <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-status="WAITING_PAYMENT" onclick="sendStatus(this)">Waiting Payment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-status="PAID" onclick="sendStatus(this)">Paid</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-status="ON_PROCESS" onclick="sendStatus(this)">On Process</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-status="DELIVERED" onclick="sendStatus(this)">Delivered</a>
                            </li>
                        </ul> -->
                        <div class="tab-content" id="myTabContent-2">
                            <div class="tab-pane fade show active">
                                <div class="table-responsive">
                                    <table id="dataOrder" class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">No Invoice</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">No Resi</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Buyer</th>
                                                <th scope="col">Payment</th>
                                                <th scope="col">Expedition</th>
                                                <th scope="col">Shipping Costs</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Purchase Date</th>
                                                <!-- <th scope="col">Delivery Cost</th> -->
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php if ($order != "") { ?>
                                                <?php foreach ($order as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['invoice'] ?></td>
                                                        <td>
                                                            <!-- Menampilkan nama produk ke bawah -->
                                                            <ul style="margin-left: -2.5rem;">
                                                                <?php foreach ($row['items'] as $item) : ?>
                                                                    <li>
                                                                        <?= $item['product']['title'] ?> (Qty: <?= $item['qty'] ?>)
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </td>
                                                        <td><?= $row['waybill'] ?></td>
                                                        <td><?= 'Rp ' . number_format($row['total_price'], 0, ',', '.') ?></td>
                                                        <td><?= $row['buyer']['fullname'] ?></td>
                                                        <td><?= $row['payment_code'] ?></td>
                                                        <td><?= $row['items'][0]['courier_id'] ?></td>
                                                        <td><?= 'Rp ' . number_format($row['items'][0]['courier_price'], 0, ',', '.') ?></td>
                                                        <td>
                                                            <?php switch ($row['order_status']) {
                                                                case "DONE":
                                                                    echo "<div class='badge badge-pill badge-success'>Done</div>";
                                                                    break;
                                                                case "REFUND":
                                                                    echo "<div class='badge badge-pill badge-danger'>Cancel</div>";
                                                                    break;
                                                                case "PAID":
                                                                    echo "<div class='badge badge-pill' style='background-Color: #007bff; color: #fff;'>On Process</div>";
                                                                    break;
                                                                case "PACKING":
                                                                    echo "<div class='badge badge-pill badge-warning'>Packing</div>";
                                                                    break;
                                                                case "SHIPPING":
                                                                    echo "<div class='badge badge-pill badge-info'>Shipping</div>";
                                                                    break;
                                                                case "DELIVERED":
                                                                    echo "<div class='badge badge-pill badge-secondary'>Delivered</div>";
                                                                    break;
                                                            }  ?>
                                                        </td>
                                                        <td><?= date('j F Y, H:i:s', strtotime($row['created_at'])) ?></td>
                                                        <td>
                                                            <?php if ($row['order_status'] == 'PAID') { ?>
                                                                <a onclick="ConfirmedProduct('<?= $row['transaction_id'] ?>' , '<?= $row['buyer']['id'] ?>', this)" class="btn mb-3 btn-success confirmedProduct" style="color: #fff;">Confirmed</a>
                                                            <?php } ?>
                                                            <a onclick="DetailProduct('<?= $row['transaction_id'] ?>')" class="btn mb-3 btn-primary" style="color: #fff;">Detail</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content  -->

<div class="iq-card-body">
    <div class="modal fade styleModal" id="detailProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="display: flex; justify-content: flex-end">
                        <button class="btn btn-info" id="download-detail" style="background-color: #1230AE !important;">
                            Download
                        </button>
                    </div>
                    <div id="detail-product-ss">
                        <h4 style="font-weight: bold;">Kurir</h4>
                        <h5 style="display: flex;justify-content: space-between;">Nama <span id="namaEkspedisi"></span></h5>
                        <h5 style="display: flex;justify-content: space-between;">Layanan <span id="layananEkspedisi"></span></h5>
                        <h5 style="display: flex;justify-content: space-between;">Biaya <span id="biayaEkspedisi"></span></h5>
                        <div style="text-align: center;">
                            <svg id="barcodeResi"></svg>
                        </div>
                        <h5 style="display: flex;justify-content: space-between;">No Resi <span id="resi" style="color: #6C48C5; font-weight: 700;"></span></h5>
                        <div style="display: flex; gap: 6rem;">
                            <h5 style="font-weight: bold;">Pengirim</h5>
                            <div>
                                <h6 id="nameStore"></h6>
                                <p id="addressStore" style="color: #000;"></p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 6rem;">
                            <h5 style="font-weight: bold;">Penerima</h5>
                            <div style="margin-left: -2px;">
                                <h6 id="nameBuyer"></h6>
                                <p id="addressBuyer" style="color: #000;"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<?= view('js/admin'); ?>
<script>
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var formatted = ribuan.join('.').split('').reverse().join('');
        return `Rp ${formatted}`;
    }

    DetailProduct = async (transactionId) => {

        $("#productContainer").empty();
        $("#imageNews").removeAttr("src");
        $('#detailProduct').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/reportOrder/detail/${transactionId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                let data = JSON.parse(response);

                let dataRows = data.body.map(element => {
                    console.log(element, 'data');
                    // let date = moment(element.created_at).format('DD MMMM YYYY, HH:mm');
                    // let orderItemPrice = formatRupiah(element.items[0].product.price);
                    // let productHtml = `
                    //     <div class="product">
                    //         <div class="section-satu">
                    //             <div class="image-product">
                    //                 <img class="img-product" src="${element.items[0].product.medias[0].path !== null ? element.items[0].product.medias[0].path : baseUrl + '/public/assets/images/image-default.png'}" alt="image">
                    //             </div>
                    //             <div class="text-product">
                    //                 <label class="text-product">${element.items[0].product.title !== null ? element.items[0].product.title : "Produk tidak ada"}</label><br>
                    //                 <label class="text-product">${element.items[0].qty} x ${orderItemPrice}</label><br>
                    //             </div>
                    //         </div>
                    //         <div class="section-dua">
                    //             <h5>Total Harga</h5>
                    //             <label class="label">${orderItemPrice}</label>
                    //         </div>
                    //     </div>
                    // `;

                    // $("#invoice").html(element.invoice);
                    // $("#purchaseDate").html(date);
                    // $("#productContainer").append(productHtml);
                    // $("#name").html(element.buyer.fullname);
                    // $("#email").html(element.buyer.email_address);
                    // $("#payment").html(element.payment_code);
                    // $("#courier").html(element.items[0].courier_id);
                    // $("#costs").html(formatRupiah(element.items[0].courier_price));

                    let noResi = element.waybill;

                    $("#namaEkspedisi").html(element.courier_id);
                    $("#layananEkspedisi").html(element.courier_service);
                    $("#biayaEkspedisi").html(formatRupiah(element.courier_price));
                    $("#resi").html(noResi);
                    $("#nameStore").html(element.seller.fullname);
                    $("#addressStore").html(element.seller.address);
                    $("#nameBuyer").html(element.buyer.fullname);
                    $("#addressBuyer").html(element.buyer.address);

                    JsBarcode("#barcodeResi", noResi, {
                        format: "CODE128",
                        lineColor: "#000",
                        width: 2,
                        height: 50,
                        displayValue: false
                    });
                });
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    ConfirmedProduct = async (transactionId, buyerId, el) => {
        let data = new FormData();

        data.append('transactionId', transactionId);
        data.append('buyerId', buyerId);

        $(el).text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/reportOrder/confirmed`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update store success');
                // setInterval(function() {
                //     location.href = `${baseUrl}/admin/officialStore`;
                // }, 1500);
                setTimeout(function() {
                    location.reload();
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $(el).text('Confirmed');
            }
        });
    }

    document.querySelector("#download-detail").addEventListener("click", function() {
        this.style.display = 'none';

        html2canvas(document.querySelector("#detailProduct .modal-content")).then(function(canvas) {
            var link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'detail_transaction.png';
            link.click();

            setTimeout(() => {
                document.querySelector("#download-detail").style.display = 'inline-block';
            }, 100);
        });
    });
</script>