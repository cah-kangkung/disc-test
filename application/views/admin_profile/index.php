<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Profil Saya</h1>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <?php if ($this->session->flashdata('danger_alert')) : ?>
                <div class="alert alert-dismissible alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('danger_alert'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success_alert')) : ?>
                <div class="alert alert-dismissible alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('success_alert'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <?php echo form_open_multipart('admin_profile'); ?>
                    <h4>Foto Profil</h4>
                    <hr>
                    <div class="form-group row mb-5">
                        <div class="col-sm-3 mb-3">
                            <img src="<?php echo base_url() . 'assets/img/profile-pictures/' . $user_data['image']; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-4 my-auto">
                            <button type="button" class="btn btn-primary">
                                <input type="file" name="image" id="image">
                            </button>
                        </div>
                    </div>

                    <h4>Informasi</h4>
                    <hr>
                    <div class="form-group row">
                        <label for="full_name" class="col-xl-3 col-form-label">Nama Lengkap</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $user_data['full_name'] ?>">
                            <?php echo form_error('full_name', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-xl-3 col-form-label">Email</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $user_data['email'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_hp" class="col-xl-3 col-form-label">Nomor Seluler</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="+62....." value="<?php echo $user_data['no_hp'] ?>">
                            <?php echo form_error('no_hp', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="birth" class="col-xl-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-lg-9">
                            <input type="date" class="form-control" id="birth" name="birth" value="<?php echo $user_data['birth'] ?>">
                            <?php echo form_error('birth', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sex" class="col-xl-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-lg-9">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sex" name="sex" class="custom-control-input" <?php echo ($user_data['sex'] == 'laki-laki' ? 'checked=""' : '') ?> value="laki-laki">
                                <label class="custom-control-label" for="sex">Laki-laki</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sex2" name="sex" class="custom-control-input" <?php echo ($user_data['sex'] == 'perempuan' ? 'checked=""' : '') ?> value="perempuan">
                                <label class="custom-control-label" for="sex2">Perempuan</label>
                            </div>
                            <?php echo form_error('sex', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="mt-5 d-flex">
                        <a href="<?php echo site_url(); ?>admin_profile/change_password" class="btn btn-primary ml-auto">
                            Change Password
                        </a>
                        <button type="submit" class="btn btn-primary ml-3">
                            Save Changes
                        </button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->