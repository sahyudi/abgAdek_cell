<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transfer | Invoice</title>
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
    <?php
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Transaksi dengan nomor ' . $print->no_transaksi . ' berhasil !</div>');
    ?>
    <div class="wrapper">
        <section class="invoice">
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <i class="fas fa-globe"></i> Abg Adek Cell.
                        <small class="float-right">Date: <?= date('d/m/Y') ?></small>
                    </h2>
                </div>
            </div>

            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Admin, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Phone: (804) 123-5432<br>
                        Email: info@almasaeedstudio.com
                    </address>
                </div>

                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong><?= $print->nama ?></strong><br>
                        <?= $print->bank ?><br>
                        <?= $print->no_rekening ?><br>
                        Phone: (555) 539-1037<br>
                        Email: john.doe@example.com
                    </address>
                </div>

                <div class="col-sm-4 invoice-col">
                    <b>Invoice <?= $print->no_transaksi ?></b><br>
                    <br>
                    <b>Order ID:</b> 4F3S8J<br>
                    <b>Payment Due:</b> 2/22/2014<br>
                    <b>Account:</b> 968-34567
                </div>
            </div>

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <!-- <th>Bank</th>
                                <th>Rekening Tujuan</th>
                                <th>Nama</th> -->
                                <th>Keterangan</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- <td><?= $print->bank ?></td>
                                <td><?= $print->no_rekening ?></td>
                                <td><?= $print->nama ?></td> -->
                                <td class="text-left"><?= $print->keterangan ?></td>
                                <td class="text-right">Rp. <?= $print->nominal ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                    <p class="lead">Payment :</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Admin:</th>
                                <td class="text-right">Rp. <?= $print->admin ?> </td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td class="text-right">Rp. <?= number_format(replace_angka($print->nominal) + replace_angka($print->admin)) ?></td>
                            </tr>
                            <!-- <tr>
                                <th>Kembali</th>
                                <td class="text-right">Rp. </td>
                            </tr> -->
                        </table>
                    </div>
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
            window.location.href = '<?= base_url('transaction/transfer') ?>';
        }
    </script>
</body>

</html>