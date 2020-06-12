<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Harga Pulsa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Harga Pulsa</li>
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
                        <h3 class="card-title">Data Harga Pulsa</h3>
                        <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" onclick="reset_form()" data-target="#modal-operator"><i class="fas fa-fw fa-plus"></i> Add Harga</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Operator</th>
                                        <th>Quantity</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hargaPulsa as $key => $value) { ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1 ?></td>
                                            <td><?= $value->operator  ?></td>
                                            <td class="text-right"><?= $value->quantity  ?></td>
                                            <td class="text-right">Rp. <?= $value->harga  ?></td>
                                            <td class="text-right">
                                                <a href="<?= base_url('setup/delete_hargaPulsa/') . $value->id ?>" onclick="return validation()" class="btn btn-danger btn-xs"><i class="fas fa-fw fa-trash"></i></a>
                                                <a href="#" data-id="<?= $value->id ?>" data-toggle="modal" data-target="#modal-operator" class="btn btn-success btn-edit btn-xs"><i class="fas fa-fw fa-pencil-alt"></i></a>
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

<div class="modal fade" id="modal-operator">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Harga Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('setup/add_hargaPulsa') ?>" id="form-operator" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Operator</label>
                            <select name="operator" id="operator" class="form-control form-control-sm select2">
                                <?php foreach ($operator as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Quantity</label>
                            <input type="text" name="quantity" id="quantity" class="form-control form-control-sm text-left" placeholder="Quantity ..." data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits':0, 'digitsOptional': false, 'prefix':'', 'placeholder': ''">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control form-control-sm text-left" placeholder="Harga ..." data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits':0, 'digitsOptional': false, 'prefix':'', 'placeholder': ''">
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
        $('#form-operator').validate({
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
        return confirm('Apakah anda yakin akan mengahapus data harga ??');
    }

    function reset_form() {
        $('#form-operator')[0].reset();
        $('.select2').select2('val', '');
        // $('#form-operator')[0].reset();
    }

    $('.btn-edit').click(function() {
        const id = $(this).data('id');
        // alert(id);
        $.ajax({
            url: "<?= base_url() . 'setup/get_hargaPulsa/'; ?>" + id,
            async: false,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#operator').select2('val', data.operator_id);
                $('#quantity').val(data.quantity);
                $('#harga').val(data.harga);
            }
        });
    });
</script>
<!-- /.content-wrapper -->