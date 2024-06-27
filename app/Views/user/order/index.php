<?php

use Config\Services;

$request = Services::request();
?>

<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<!--  Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Data Order</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "received" ? "active" : "" ?>" href="<?= base_url("/user/order/status/received") ?>">Received</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "packing" ? "active" : "" ?>" href="<?= base_url("/user/order/status/packing") ?>">Packing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "shipping" ? "active" : "" ?>" href="<?= base_url("/user/order/status/shipping") ?>">Shipping</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "delivered" ? "active" : "" ?>" href="<?= base_url("/user/order/status/delivered") ?>">Delivered</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "done" ? "active" : "" ?>" href="<?= base_url("/user/order/status/done") ?>">Done</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "cancelled" ? "active" : "" ?>" href="<?= base_url("/user/order/status/cancelled") ?>">Cancel</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent-2">
                            <div class="tab-pane fade show active">
                                <div class="table-responsive">
                                    <table id="dataOrder" class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">No Invoice</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Buyer</th>
                                                <th scope="col">Delivery Cost</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php if ($order != "NULL") { ?>
                                                <?php foreach ($order as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row->invoiceNo ?></td>
                                                        <td><?= $row->product[0]->name ?></td>
                                                        <td><?= $row->productItems[0]->quantity ?></td>
                                                        <td><?= $row->productItems[0]->price ?></td>
                                                        <td><?= $row->user->fullname ?></td>
                                                        <td><?= $row->deliveryCost->courierName ?></td>
                                                        <td>
                                                            <?php switch ($row->orderStatus) {
                                                                case "DONE":
                                                                    echo "<div class='badge badge-pill badge-success'>Done</div>";
                                                                    break;
                                                                case "CANCELLED":
                                                                    echo "<div class='badge badge-pill badge-danger'>Cancel</div>";
                                                                    break;
                                                                case "RECEIVED":
                                                                    echo "<div class='badge badge-pill badge-primary'>Received</div>";
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

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<?= view('js/userOrder'); ?>