<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Transfer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Transfer</li>
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
                        <h3 class="card-title">Data Transfer</h3>
                        <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" onclick="reset_form()" data-target="#modal-trasnfer"><i class="fas fa-fw fa-plus"></i> Add Transfer</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>No Transaksi</th>
                                        <th>Bank</th>
                                        <th>Nama</th>
                                        <th>Rekening</th>
                                        <th>Nominal</th>
                                        <th>Biaya Admin</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transfer as $key => $value) { ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1 ?></td>
                                            <td><?= $value->no_transaksi ?></td>
                                            <td><?= $value->bank ?></td>
                                            <td><?= $value->nama ?></td>
                                            <td><?= $value->no_rekening ?></td>
                                            <td class="text-right">Rp. <?= $value->nominal  ?></td>
                                            <td class="text-right">Rp. <?= $value->admin  ?></td>
                                            <td><?= $value->keterangan ?></td>
                                            <td class="text-right">
                                                <a href="<?= base_url('transaction/print_transfer/') . $value->id ?>" class="btn btn-default btn-xs"><i class="fas fa-fw fa-print" title="Tombol print"></i></a>
                                                <a href="<?= base_url('transaction/delete_aksesoris/') . $value->id ?>" onclick="return validation()" class="btn btn-danger btn-xs" title="Tombol hapus"><i class="fas fa-fw fa-trash"></i></a>
                                                <a href="#" data-id="<?= $value->id ?>" data-toggle="modal" data-target="#modal-trasnfer" class="btn btn-success btn-edit btn-xs" title="Tombol edit"><i class="fas fa-fw fa-pencil-alt"></i></a>
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

<div class="modal fade" id="modal-trasnfer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Transfer Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transaction/add_transfer') ?>" id="form-transfer" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">No Transaksi</label>
                            <input type="text" name="no_transaksi" id="no_transaksi" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Bank</label>
                            <input type="text" name="bank" id="bank" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Rekening Tujuan</label>
                            <input type="text" name="no_rekening" id="no_rekening" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Nominal</label>
                            <input type="text" name="nominal" id="nominal" class="form-control form-control-sm text-left" placeholder="Nominal ..." data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits':0, 'digitsOptional': false, 'prefix':'', 'placeholder': ''">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Biaya Admin</label>
                            <input type="text" name="admin" id="admin" class="form-control form-control-sm text-left" placeholder="Nominal ..." data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits':0, 'digitsOptional': false, 'prefix':'', 'placeholder': ''">
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
        $("#example1").DataTable({});
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
</script>
<!-- /.content-wrapper -->