<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Abg Adek Cell | Report</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>


<body>
    <div class="wrapper">
        <section class="invoice">
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <i class="fas fa-globe"></i>Abg Adek Cell.
                        <small class="float-right">Date: <?= date('d/m/Y') ?></small>
                    </h2>
                </div>
            </div>
            <br><br><br>
            <div class="row invoice-info">
                <div class="col-md-12">
                    <h2 class="text-center">Laporan Penjualan</h2><br>
                </div>
                <div class="col-md-6 invoice-col">
                    Tanggal
                    <address>
                        <?php if ($dari) {
                            echo $dari . " - " . $sampai;
                        } else {
                            echo 'All';
                        }
                        ?>
                    </address>
                </div>
                <div class="col-md-6 invoice-col">
                    Outlet
                    <address>
                        <?= ($outlet_id) ? $outlet_id : 'Seleruh Outlet'  ?>
                    </address>
                </div>
                <div class="col-md-6 invoice-col">
                    Item
                    <address>
                        <?= ($item_id) ? $item_id : 'Seleruh Item'  ?>
                    </address>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-nowrap">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Tanggal</th>
                                <th>Outlet</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sum_total = 0; ?>
                            <?php foreach ($transaksi as $key => $value) { ?>
                                <tr>
                                    <td class="text-center"><?= $key + 1 ?></td>
                                    <td><?= $value->no_transaksi ?></td>
                                    <td><?= $value->tanggal ?></td>
                                    <td><?= $value->nama_toko ?></td>
                                    <td><?= $value->nama_item ?></td>
                                    <td><?= $value->quantity ?></td>
                                    <td class="text-right"><?= $value->harga  ?></td>
                                    <?php $total_trans = replace_angka($value->quantity) * replace_angka($value->harga); ?>
                                    <td class="text-right"><?= number_format($total_trans) ?></td>
                                    <td><?= $value->keterangan  ?></td>
                                </tr>
                                <?php $sum_total += $total_trans  ?>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-right" colspan="7">Total</th>
                                <th class="text-right">Rp. <?= number_format($sum_total) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </section>
    </div>

    <script type="text/javascript">
        window.addEventListener("load", window.print());
        window.onafterprint = function(e) {
            closePrintView();
        };

        function closePrintView() {
            window.location.href = '<?= base_url('report/penjualan') ?>';
        }
    </script>
</body>

</html>