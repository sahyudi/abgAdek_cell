<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Register</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Register Member</li>
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
                        <h3 class="card-title">Register Employee</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="<?= base_url('employee/registration') ?>" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="form-group">Nama</label>
                                    <div class="input-group">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Full name" value="<?= set_value('name') ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-group">No KTP</label>
                                    <div class="input-group">
                                        <input type="text" name="no_ktp" id="no_ktp" class="form-control" placeholder="No KTP" value="<?= set_value('no_ktp') ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-id-card"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_error('no_ktp', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-group mt-3">No HP</label>
                                    <div class="input-group">
                                        <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="No HP" value="<?= set_value('no_hp') ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-phone"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_error('no_hp', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-group mt-3">Alamat</label>
                                    <div class="input-group">
                                        <textarea name="alamat" id="alamat" rows="1" class="form-control"><?= set_value('alamat') ?></textarea>
                                        <!-- <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="No HP" value="<?= set_value('no_hp') ?>"> -->
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-map-marker"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="col-md-6">
                                    <label for="" class="form-group mt-3">E-mail</label>
                                    <div class="input-group ">
                                        <input type="email" name="email" id="email" class="form-control" value="<?= set_value('email') ?>" placeholder="Email">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-group mt-3">Profile</label>
                                    <div class="input-group ">
                                        <input type="file" name="profile" id="profile" class="form-control" placeholder="Profile" value="">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-circle"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_error('profile', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-group mt-3">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-group mt-3">Re Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Retype password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-group mt-3">User Group</label>
                                    <div class="input-group">
                                        <select name="group_id" id="group_id" class="form-control select2">
                                            <option value=""></option>
                                            <?php foreach ($group as $key => $value) { ?>
                                                <option value="<?= $value->id ?>" <?= (set_value('group_id') == $value->id) ? 'selected' : ''; ?>><?= $value->group_name ?></option>
                                            <?php } ?>
                                        </select>
                                        <!-- <input type="password" name="group_id" id="group_id" class="form-control" placeholder="Retype password"> -->
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_error('group_id', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-group mt-3">Outlet</label>
                                    <div class="input-group">
                                        <select name="outlet_id" id="outlet_id" class="form-control select2">
                                            <option value=""></option>
                                            <?php foreach ($outlet as $key => $value) { ?>
                                                <option value="<?= $value->id ?>" <?= (set_value('outlet_id') == $value->id) ? 'selected' : ''; ?>><?= $value->nama ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_error('outlet_id', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div></div>

                        </div>
                        <div class="card-footer">
                            <div class="row mt-3">
                                <div class="col-6">
                                    <a href="<?= base_url('employee') ?>" class="btn btn-danger btn-block">Back</a>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-material">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pendidikan Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('employee/add_pendidikan') ?>" id="form-pendidikan" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="Nama">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Singkatan</label>
                            <input type="text" name="singkatan" id="singkatan" class="form-control form-control-sm" placeholder="Nama">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
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
        $('#form-pendidikan').validate({
            rules: {
                nama: {
                    required: true
                },
            },
            messages: {
                nama: {
                    required: "Please enter a nama.."
                },
                singkatan: {
                    required: "Please enter a singkatan.."
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
        return confirm('Apakah anda yakin akan mengahapus data Golongan darah ??');
    }

    function reset_form() {
        $('#form-pendidikan')[0].reset();
    }

    $('.btn-edit').click(function() {
        const id = $(this).data('id');
        // alert(id);
        $.ajax({
            url: "<?= base_url() . 'employee/get_pendidikan/'; ?>" + id,
            async: false,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#singkatan').val(data.singkatan);
            }
        });
    });
</script>
<!-- /.content-wrapper -->