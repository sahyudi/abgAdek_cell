<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Outlet</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Outlet</li>
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
                        <h3 class="card-title">Data Outlet</h3>
                        <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" onclick="reset_form()" data-target="#modal-outlet"><i class="fas fa-fw fa-plus"></i> Add Outlet</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>No Telp</th>
                                        <th>Alamat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($outlet as $key => $value) { ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1 ?></td>
                                            <td><?= $value->nama ?></td>
                                            <td><?= $value->alamat ?></td>
                                            <td><?= $value->no_telp ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('setup/delete_outlet/') . $value->id ?>" onclick="return validation()" class="btn btn-danger btn-xs"><i class="fas fa-fw fa-trash"></i></a>
                                                <a href="#" data-id="<?= $value->id ?>" data-toggle="modal" data-target="#modal-outlet" class="btn btn-success btn-edit btn-xs"><i class="fas fa-fw fa-pencil-alt"></i></a>
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

<div class="modal fade" id="modal-outlet">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Outlet Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('setup/add_outlet') ?>" id="form-outlet" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-xl" placeholder="Nama">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">No Telp.</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control form-control-xl" placeholder="No Telp ...">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control form-control-xl"></textarea>
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
        $('#form-outlet').validate({
            rules: {
                nama: {
                    required: true
                },
                no_telp: {
                    required: true
                },
                alamat: {
                    required: true
                }
            },
            messages: {
                nama: {
                    required: "Please enter a nama.."
                },
                no_telp: {
                    required: "Please enter a No Telp.."
                },
                alamat: {
                    required: "Please enter a alamat"
                }
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
        return confirm('Apakah anda yakin akan mengahapus data outlet ??');
    }

    function reset_form() {
        $('#form-outlet')[0].reset();
        $('.select2').select2('val', '');
    }

    $('.btn-edit').click(function() {
        const id = $(this).data('id');
        // alert(id);
        $.ajax({
            url: "<?= base_url() . 'setup/get_outlet/'; ?>" + id,
            async: false,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#no_telp').val(data.no_telp);
                $('#alamat').val(data.alamat);
            }
        });
    });
</script>
<!-- /.content-wrapper -->