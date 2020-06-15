<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Aksesoris</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Aksesoris</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $jml = $this->db->get('tb_trans_penjualan')->num_rows();
                            ?>
                            <h3><?= ($jml == 0) ? 0 : $jml ?></h3>

                            <p>Penjualan Item</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <a href="#" class="small-box-footer" data-target="#modal-penjualan" data-toggle="modal">Add Transaksi <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            $ready_stock = $this->db->get_where('tb_stock_aksesoris', ['stock !=' => 0])->num_rows();
                            ?>
                            <h3><?= ($ready_stock == 0) ? 0 : $ready_stock ?></h3>
                            <p>Stock</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-fw fa-layer-group"></i>
                        </div>
                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-stock">Add Stock <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            $jml_item = $this->db->get('tb_aksesoris')->num_rows();
                            ?>
                            <h3><?= ($jml_item == 0) ? 0 : $jml_item ?></h3>

                            <p>Item</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-fw fa-boxes"></i>
                        </div>
                        <a href="#" class="small-box-footer">Add Item<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#transaksi" data-toggle="tab">Transaksi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#stock" data-toggle="tab">Stock</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="transaksi">
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
                                                <th>Action</th>
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
                                                    <td class="text-right">
                                                        <a href="<?= base_url('setup/delete_stockAksesoris/') . $value->id ?>" onclick="return validation()" class="btn btn-danger btn-xs"><i class="fas fa-fw fa-trash"></i></a>
                                                        <a href="#" data-id="<?= $value->id ?>" data-toggle="modal" data-target="#modal-aksesoris" class="btn btn-success btn-edit btn-xs"><i class="fas fa-fw fa-pencil-alt"></i></a>
                                                    </td>
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
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="stock">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Barcode</th>
                                                    <th>Nama</th>
                                                    <th>Harga Jual</th>
                                                    <th>Stock</th>
                                                    <th>Update Stock</th>
                                                    <th>keterangan</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($stock as $key => $value) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $key + 1 ?></td>
                                                        <td><?= $value->barcode  ?></td>
                                                        <td><?= $value->nama  ?></td>
                                                        <td class="text-right">Rp. <?= $value->harga_jual  ?></td>
                                                        <td class="text-right"><?= $value->stock  ?></td>
                                                        <td><?= $value->update_at  ?></td>
                                                        <td><?= $value->keterangan  ?></td>
                                                        <td class="text-right">
                                                            <a href="<?= base_url('setup/delete_stockAksesoris/') . $value->id ?>" onclick="return validation()" class="btn btn-danger btn-xs"><i class="fas fa-fw fa-trash"></i></a>
                                                            <a href="#" data-id="<?= $value->id ?>" data-toggle="modal" data-target="#modal-aksesoris" class="btn btn-success btn-edit btn-xs"><i class="fas fa-fw fa-pencil-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-stock">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Stock Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transaction/add_stock') ?>" id="form-transfer" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">No Transaksi</label>
                            <input type="text" name="no_transaksi" id="no_transaksi" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Outlet</label>
                            <select name="outlet_id" id="outlet_id" class="form-control form-control-sm select2">
                                <option value=""></option>
                                <?php foreach ($outlet as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Item</label>
                            <select name="aksesoris" id="aksesoris" class="form-control form-control-sm select2">
                                <option value=""></option>
                                <?php foreach ($item as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->barcode . ' - ' . $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Quantity</label>
                            <input type="text" name="quantity" id="quantity" class="form-control form-control-sm text-left" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits':0, 'digitsOptional': false, 'prefix':'', 'placeholder': ''">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Harga / Quantity</label>
                            <input type="text" name="harga" id="harga" class="form-control form-control-sm text-left" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits':0, 'digitsOptional': false, 'prefix':'', 'placeholder': ''">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class=" form-control form-control-sm"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-penjualan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Penjualan Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transaction/add_penjualan') ?>" id="form-transfer" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">No Transaksi</label>
                            <input type="text" name="no_penjualan" id="no_penjualan" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Tanggal</label>
                            <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" value="<?= date('Y-m-d') ?>" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Outlet</label>
                            <select name="outlet_penjualan" id="outlet_penjualan" class="form-control form-control-sm select2">
                                <option value=""></option>
                                <?php foreach ($outlet as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Item</label>
                            <select name="item_penjualan" id="item_penjualan" class="form-control form-control-sm select2">
                                <option value=""></option>
                                <?php foreach ($item as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->barcode . ' - ' . $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Quantity</label>
                            <input onkeyup="hitung_total()" type="text" name="qty_jual" id="qty_jual" class="form-control form-control-sm text-left" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits':0, 'digitsOptional': false, 'prefix':'', 'placeholder': ''">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Harga / Quantity</label>
                            <input type="text" name="harga_jual" id="harga_jual" class="form-control form-control-sm text-left" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits':0, 'digitsOptional': false, 'prefix':'', 'placeholder': ''" readonly>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Total</label>
                            <input type="text" name="total_jual" id="total_jual" class="form-control form-control-sm text-left" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits':0, 'digitsOptional': false, 'prefix':'', 'placeholder': ''" readonly>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class=" form-control form-control-sm"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('#form-transfer').validate({
            rules: {
                nama: {
                    required: true
                },
                Agama: {
                    required: true
                },
                jenis_kel: {
                    required: true
                },
                no_ktp: {
                    required: true
                },
                no_telp: {
                    required: true
                },
                pendidikan: {
                    required: true
                },
            },
            messages: {
                nama: {
                    required: "Please enter a nama.."
                },
                Agama: {
                    required: "Please enter a Agama.."
                },
                jenis_kel: {
                    required: "Please enter a Jenis Kelamin"
                },
                tgl_lahir: {
                    required: "Please enter a Tanggal Lahir"
                },
                no_telp: {
                    required: "Please enter a no telp"
                },
                no_ktp: {
                    required: "Please enter a no ktp"
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
        $(".table").DataTable({});
        $(":input").inputmask();
    });

    function validation() {
        return confirm('Apakah anda yakin akan mengahapus data transfer ??');
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
            url: "<?= base_url() . 'transaction/get_transfer/'; ?>" + id,
            async: false,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#no_rekening').val(data.no_rekening);
                $('#nominal').val(data.nominal);
                $('#bank').val(data.bank);
                $('#keterangan').val(data.keterangan);
                $('#admin').val(data.admin);
                $('#no_transaksi').val(data.no_transaksi);
            }
        });
    });

    $('#item_penjualan').change(function() {
        const id = $(this).val();
        // alert(id);
        $.ajax({
            url: "<?= base_url() . 'setup/get_aksesoris/'; ?>" + id,
            async: false,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                $('#harga_jual').val(data.harga_jual);
            }
        });
    })

    function hitung_total() {
        const harga = $('#harga_jual').val().replace(/\,/g, '');
        const qty = $('#qty_jual').val().replace(/\,/g, '');
        const total = parseInt(harga) * parseInt(qty);
        $('#total_jual').val(total);
    }
</script>
<!-- /.content-wrapper -->