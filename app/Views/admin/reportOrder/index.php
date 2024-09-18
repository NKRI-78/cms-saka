<?php

use Config\Services;
use PHPUnit\Util\Color;

$request = Services::request();
?>

<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>
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
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "cancelled" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/cancelled") ?>">Cancel</a>
                            </li> -->
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
                                                <th scope="col">Price</th>
                                                <th scope="col">Status</th>
                                                <!-- <th scope="col">Qty</th> -->
                                                <!-- <th scope="col">Buyer</th> -->
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
                                                        <td><?= 'Rp ' . number_format($row['total_price'], 0, ',', '.') ?></td>
                                                        <td>
                                                            <?php switch ($row['order_status']) {
                                                                case "DONE":
                                                                    echo "<div class='badge badge-pill badge-success'>Done</div>";
                                                                    break;
                                                                case "CANCELLED":
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 style="font-weight:bold">Invoice: <span id="invoice" style="font-weight: 700 !important;color: #8b44ed;"></span></h5>
                    <h5 style="font-weight:bold">Tanggal Pembelian: <span id="purchaseDate" style="font-weight: normal !important;"></span></h5>
                    <h5 style="font-weight:bold">No Resi: <span id="resi" style="font-weight: normal !important;"></span></h5>
                    <div class="product-container" id="productContainer">

                    </div>
                    <h5 style="font-weight: bold;">Buyer Information</h5>
                    <h6>Name: <span id="name"></span></h6>
                    <h6>Email: <span id="email"></span></h6>
                    <h6>Payment Method: <span id="payment"></span></h6>
                    <h5 style="font-weight: bold; margin-top: 0.5rem;">Shipping Information</h5>
                    <h6>Courier: <span id="courier"></span></h6>
                    <h6>Shipping Costs: <span id="costs"></span></h6>
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
                    let date = moment(element.created_at).format('DD MMMM YYYY, HH:mm');
                    let orderItemPrice = formatRupiah(element.items[0].product.price);
                    let productHtml = `
                        <div class="product">
                            <div class="section-satu">
                                <div class="image-product">
                                    <img class="img-product" src="${element.items[0].product.medias[0].path !== null ? element.items[0].product.medias[0].path : baseUrl + '/public/assets/images/image-default.png'}" alt="image">
                                </div>
                                <div class="text-product">
                                    <label class="text-product">${element.items[0].product.title !== null ? element.items[0].product.title : "Produk tidak ada"}</label><br>
                                    <label class="text-product">${element.items[0].qty} x ${orderItemPrice}</label><br>
                                </div>
                            </div>
                            <div class="section-dua">
                                <h5>Total Harga</h5>
                                <label class="label">${orderItemPrice}</label>
                            </div>
                        </div>
                    `;

                    $("#invoice").html(element.invoice);
                    $("#purchaseDate").html(date);
                    $("#productContainer").append(productHtml);
                    $("#name").html(element.buyer.fullname);
                    $("#email").html(element.buyer.email_address);
                    $("#payment").html(element.payment_code);
                    $("#courier").html(element.items[0].courier_id);
                    $("#costs").html(formatRupiah(element.items[0].courier_price));
                    $("#resi").html(element.waybill);
                });
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    ConfirmedProduct = async (transactionId, buyerId, el) => {
        let data = new FormData();

        // let transactionId = transactionId;

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
                    // location.reload();
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $(el).text('Confirmed');
            }
        });
    }
</script>