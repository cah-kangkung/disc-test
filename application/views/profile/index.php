<section>
    <div class="container">

        <h2 class="mb-5">Edit Profile</h2>

        <div class="row">
            <div class="col-lg-8">
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
            <div class="col-lg-8">
                <?php echo form_open_multipart('profile'); ?>

                <h4>Profile Picture</h4>
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

                <h4>Information</h4>
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

                <div class="row mt-5">
                    <div class="col-sm-3 mb-3">
                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                    <div class="col-sm-9">
                        <a href="<?php echo site_url(); ?>profile/change_password" class="btn btn-primary">
                            Change Password
                        </a>
                    </div>
                </div>

                </form>
            </div>
        </div>

    </div>
</section>