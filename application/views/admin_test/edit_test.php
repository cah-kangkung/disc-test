<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Edit Test</h1>
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
                    <form action="<?php echo site_url() ?>admin_test/edit_test" method="post">

                        <div class="form-group">
                            <label for="price">Harga dalam Rupiah</label>
                            <input type="text" class="form-control" id="price" name="price" value="<?php echo $test['price'] ?>">
                            <?php echo form_error('price', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="duration">Durasi dalam menit</label>
                            <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $test['duration'] ?>">
                            <?php echo form_error('duration', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="mt-5 d-flex">
                            <button type="submit" class="btn btn-primary ml-3">
                                Edit Test
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