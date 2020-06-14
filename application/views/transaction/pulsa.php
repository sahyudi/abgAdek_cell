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
                <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Transaksi Pulsa</h3>
                        <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" onclick="reset_form()" data-target="#modal-transPulsa"><i class="fas fa-fw fa-plus"></i> Add Transaksi</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>No Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Operator</th>
                                        <th>No Telp</th>
                                        <th>Nominal</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pulsa as $key => $value) { ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1 ?></td>
                                            <td><?= $value->no_trans ?></td>
                                            <td><?= $value->tgl_trans ?></td>
                                            <td><?= $value->operator ?></td>
                                            <td><?= $value->no_telp ?></td>
                                            <td class="text-right">Rp. <?= $value->nominal  ?></td>
                                            <td class="text-right">Rp. <?= $value->harga  ?></td>
                                            <td class="text-right">
                                                <a href="<?= base_url('transaction/delete_transPulsa/') . $value->id ?>" onclick="return validation()" class="btn btn-danger btn-xs" title="Tombol hapus"><i class="fas fa-fw fa-trash"></i></a>
                                                <a href="#" data-id="<?= $value->id ?>" data-toggle="modal" data-target="#modal-transPulsa" class="btn btn-success btn-edit btn-xs" title="Tombol edit"><i class="fas fa-fw fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-transPulsa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Transfer Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transaction/add_transPulsa') ?>" id="form-transfer" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">No Transaksi</label>
                            <input type="text" name="no_trans" id="no_trans" class="form-control form-control-sm" placeholder="No Transksi ...">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">No Telp</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control form-control-sm" placeholder="No Telp ...">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Nominal</label>
                            <select name="harga_id" id="harga_id" class="form-control form-control-sm select2">
                                <?php foreach ($harga as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->operator . ' - ' . $value->quantity ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="quantity" id="quantity" class="form-control form-control-sm">
                            <input type="hidden" name="operator_id" id="operator_id" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Haraga</label>
                            <input type="text" name="harga" id="harga" class="form-control form-control-sm text-left" placeholder="Nominal ..." data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits':0, 'digitsOptional': false, 'prefix':'', 'placeholder': ''" readonly>
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