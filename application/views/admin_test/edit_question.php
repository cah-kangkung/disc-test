<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Soal</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url(); ?>admin_test/edit_question/<?php echo $question['question_id'] ?>" method="post">
                        <div class="form-group row">
                            <label for="influence" class="col-lg-3 col-form-label">Influence *</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" id="influence" name="influence" rows="2" maxlength="200" autofocus><?php echo $question['influence'] ?></textarea>
                                <?php echo form_error('influence', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dominance" class="col-lg-3 col-form-label">Dominance *</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" id="dominance" name="dominance" rows="2" maxlength="200"><?php echo $question['dominance'] ?></textarea>
                                <?php echo form_error('dominance', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="compliance" class="col-lg-3 col-form-label">Compliance *</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" id="compliance" name="compliance" rows="2" maxlength="200"><?php echo $question['compliance'] ?></textarea>
                                <?php echo form_error('compliance', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="steadiness" class="col-lg-3 col-form-label">steadiness *</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" id="steadiness" name="steadiness" rows="2" maxlength="200"><?php echo $question['steadiness'] ?></textarea>
                                <?php echo form_error('steadiness', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <small style="color: red;">*maks 200 karakter dan harus diisi</small>
                        <div class="d-flex mt-4">
                            <a href="<?php echo site_url(); ?>admin_test" class="btn btn-secondary ml-auto">Kembali</a>
                            <button type="submit" class="btn btn-primary ml-3">Edit</button>
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