<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Transaksi Pulsa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi Pulsa</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Laporan Penjualan</h3>
                        <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" onclick="reset_form()" data-target="#modal-transPulsa"><i class="fas fa-fw fa-plus"></i> Add Transaksi</a>
                    </div>
                    <!-- /.card-header -->
                    <form action="<?= base_url('report/penjualan') ?>" id="form-transfer" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <input type="hidden" id="id" name="id">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Dari</label>
                                    <input type="date" name="tgl_dari" id="tgl_dari" class="form-control form-control-sm" placeholder="No Transksi ...">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Sampai</label>
                                    <input type="date" name="tgl_sampai" id="tgl_sampai" class="form-control form-control-sm" placeholder="No Telp ...">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Outlet</label>
                                    <select name="outlet" id="outlet" class="form-control form-control-sm select2">
                                        <option value="0">Semua outlet</option>
                                        <?php foreach ($outlet as $key => $value) { ?>
                                            <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Item</label>
                                    <select name="item_id" id="item_id" class="form-control form-control-sm select2">
                                        <option value="0">Semua Item</option>
                                        <?php foreach ($item as $key => $value) { ?>
                                            <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer justify-content-between">
                            <a href="<?= base_url('home') ?>" class="btn btn-default btn-sm float-left">Close</a>
                            <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-fw fa-search"></i> Save</button>
                        </div>
                    </form>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Pencarian</h3>
                        <a href="<?= base_url('report/print_penjualan') ?>" class="btn btn-primary float-right btn-sm"><i class="fas fa-fw fa-print"></i> Print</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row col-6">

                            <div class="form-group col-md-6">
                                <label for="">Dari</label>
                                <div class="">
                                    <?= date('d F Y', strtotime($dari))  ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Sampai</label>
                                <div class="">
                                    <?= date('d F Y', strtotime($sampai)) ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Outlet</label>
                                <div class="">
                                    <?= ($outlet_id == 0) ? 'Semua Outlet' : $outlet_id ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Item</label>
                                <div class="">
                                    <?= ($item_id == 0) ? 'Semua item' : $item_id ?>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if ($transaksi) { ?>
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
                            <?php } else { ?>
                                <div class="alert alert-danger">Data tidak ditemukan</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('#form-transfer').validate({
            rules: {
                nama: {
                    required: true
                },
                no_telp: {
                    required: true
                },
                harga_id: {
                    required: true
                },
            },
            messages: {
                nama: {
                    required: "Please enter a nama.."
                },
                no_telp: {
                    required: "Please enter a no telp"
                },
                harga_id: {
                    required: "Please select nominal"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
    $(document).ready(function() {
        $("#example1").DataTable({});
        $(":input").inputmask();
    });

    function validation() {
        return confirm('Apakah anda yakin akan mengahapus data transaksi pulsa ??');
    }

    function reset_form() {
        $('#form-transfer')[0].reset();
        $('.select2').select2('val', '');
        // $('#form-transfer')[0].reset();
    }

    $('.btn-edit').click(function() {
        const id = $(this).data('id');
        // alert(id);
        $.ajax({
            url: "<?= base_url() . 'transaction/get_transPulsa/'; ?>" + id,
            async: false,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#harga').val(data.harga);
                $('#quantity').val(data.quantity);
                $('#no_telp').val(data.no_telp);
                $('#no_trans').val(data.no_trans);
                $('#harga_id').select2('val', data.harga_id);
                $('#operator_id').val(data.operator_id);
            }
        });
    });

    $('#harga_id').click(function() {
        const id = $(this).val();
        // alert(id);
        $.ajax({
            url: "<?= base_url() . 'transaction/get_hargaPulsa/'; ?>" + id,
            async: false,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                $('#harga').val(data.harga);
                $('#quantity').val(data.quantity);
                $('#operator_id').val(data.operator_id);
            }
        });
    });
</script>
<!-- /.content-wrapper -->