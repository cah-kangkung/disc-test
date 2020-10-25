<section>
    <div class=" container">
        <h2 class="mb-5">
            Pembayaran
        </h2>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card shadow py-4">
                            <form action="<?php echo site_url(); ?>payment/checkout" method="post">
                                <div class=" container transfer-container mb-4">
                                    <h5>Pilih Bank Tujuan</h5>
                                    <?php foreach ($payment_destinations as $destination) : ?>
                                        <div class="radio-wrap">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="payment_destination<?php echo $destination['id'] ?>" name="payment_destination" value="<?php echo $destination['id'] ?>" checked>
                                                <label class="custom-control-label" style="display: block;" for="payment_destination<?php echo $destination['id'] ?>"><?php echo $destination['bank']; ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="radio-wrap">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customRadio" disabled>
                                            <label class="custom-control-label" style="display: block;" for="customRadio">Lebih banyak bank, segera!</label>
                                        </div>
                                    </div>
                                    <div class="radio-wrap">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customRadio" disabled>
                                            <label class="custom-control-label" style="display: block;" for="customRadio">Lebih banyak bank, segera!</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="container checkout-price-container" style="background-color: rgba(0, 0, 0, 0.05); padding: 15px;">
                                    <input type="hidden" name="test_id" value="<?php echo $test['test_id'] ?>">
                                    <h5>Detail Harga</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p style="font-weight: 400;">Tes <?php echo $test['name'] ?></p>
                                        </div>
                                        <div class="col-sm-6" style="text-align: right;">
                                            <p style="font-weight: 400;">Rp <?php echo $test['price'] ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p style="font-weight: 500;">Total</p>
                                        </div>
                                        <div class="col-sm-6" style="text-align: right;">
                                            <p style="font-weight: 500;">Rp <?php echo $test['price'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container mt-5">
                                    <div class="alert alert-info">
                                        <h4 class="alert-heading">Perhatian!</h4>
                                        <p class="mb-0">Silahkan isi data rekening pengirim untuk mempercepat proses verifikasi</p>
                                    </div>
                                    <p></p>
                                    <div class="form-group">
                                        <label for="bank">Bank</label>
                                        <input type="text" class="form-control" id="bank" name="bank" value="<?php echo set_value('bank'); ?>">
                                        <?php echo form_error('bank', '<span class="badge badge-pill badge-danger mt-2 ml-2">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_account_number">Nomor Rekening</label>
                                        <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" value="<?php echo set_value('bank_account_number'); ?>">
                                        <?php echo form_error('bank_account_number', '<span class="badge badge-pill badge-danger mt-2 ml-2">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_account_name">Nama Pengirim</label>
                                        <input type="text" class="form-control" id="bank_account_name" name="bank_account_name" value="<?php echo set_value('bank_account_name'); ?>">
                                        <?php echo form_error('bank_account_name', '<span class="badge badge-pill badge-danger mt-2 ml-2">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row" style="padding: 15px 15px 0 15px;">
                                    </div>
                                    <div class="row" style="padding: 0 15px;">
                                        <button type="submit" style="width: 100%; text-transform: none;" class="btn btn-primary btn-custom">Bayar dengan Bank Transfer <i class="fas fa-lock"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-lg-3"">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>