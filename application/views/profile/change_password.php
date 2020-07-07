<section>
    <div class="container">

        <h2 class="mb-5">Ubah password</h2>

        <?php if ($this->session->flashdata('success_alert')) : ?>
            <div class="alert alert-success mt-3" role="alert">
                <?php echo $this->session->flashdata('success_alert'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('danger_alert')) : ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $this->session->flashdata('danger_alert'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-6">

                <form action="<?php echo site_url() ?>profile/change_password" method="post">

                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        <?php echo form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="new_password1">Password Baru</label>
                        <input type="password" class="form-control" id="new_password1" name="new_password1">
                        <?php echo form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="new_password2">Ulangi Password baru</label>
                        <input type="password" class="form-control" id="new_password2" name="new_password2">
                        <?php echo form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm-2 mb-3">
                            <a href="<?php echo site_url(); ?>profile" class="btn btn-primary">
                                Back
                            </a>
                        </div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">
                                Save Password
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>