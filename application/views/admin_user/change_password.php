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
                    <form action="<?php echo site_url() ?>admin_user/change_password" method="post">

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
                        <div class="mt-5 d-flex">
                            <a href="<?php echo site_url(); ?>admin_user/profile" class="btn btn-primary ml-auto">
                                Back
                            </a>
                            <button type="submit" class="btn btn-primary ml-3">
                                Save Password
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