<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="row">
        <div class="col-lg-5">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Soal</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url(); ?>admin_test/add_question" method="post">
                        <div class="form-group row">
                            <label for="influence" class="col-lg-2 col-form-label">Influence *</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="influence" name="influence" rows="2" maxlength="200" autofocus><?php echo set_value('influence'); ?></textarea>
                                <?php echo form_error('influence', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dominant" class="col-lg-2 col-form-label">Dominant *</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="dominant" name="dominant" rows="2" maxlength="200"><?php echo set_value('dominant'); ?></textarea>
                                <?php echo form_error('dominant', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="correct" class="col-lg-2 col-form-label">Correct *</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="correct" name="correct" rows="2" maxlength="200"><?php echo set_value('correct'); ?></textarea>
                                <?php echo form_error('correct', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stable" class="col-lg-2 col-form-label">Stable *</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="stable" name="stable" rows="2" maxlength="200"><?php echo set_value('stable'); ?></textarea>
                                <?php echo form_error('stable', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <small style="color: red;">*maks 200 karakter dan harus diisi</small>
                        <div class="d-flex mt-4">
                            <a href="<?php echo site_url(); ?>admin_test" class="btn btn-secondary ml-auto">Kembali</a>
                            <button type="submit" class="btn btn-primary ml-3">Tambah</button>
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