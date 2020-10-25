<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Cetak Laporan</h1>
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
                    <form action="<?php echo site_url() ?>admin_report/generate_report" method="post">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="date_filter" id="filter1" value="option1" checked required>
                                <label class="form-check-label" for="filter1">
                                    Semua
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="date_filter" id="filter2" value="option2" required>
                                <label class="form-check-label" for="filter2">
                                    Pilih Tanggal
                                </label>
                            </div>
                        </div>
                        <div class="form-group date-range" style="display: none;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="date_from">Dari</label>
                                    <input type="date" class="form-control" id="date_from" name="date_from">
                                    <?php echo form_error('date_from', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="date_from">Sampai</label>
                                    <input type="date" class="form-control" id="date_to" name="date_to">
                                    <?php echo form_error('date_to', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <small>*Jika ada yang tidak diisi, akan mengembalikan tgl hari ini</small>
                        </div>
                        <div class="mt-5 d-flex">
                            <a href="<?php echo site_url(); ?>admin_dashboard" class="btn btn-primary ml-auto">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-primary ml-3">
                                Cetak
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