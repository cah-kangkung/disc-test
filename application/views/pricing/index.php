<section id="pricing">
    <?php if ($this->session->userdata('loggedIn')) : ?>
        <div class="container">

            <?php if ($active_test['status'] == 0) : ?>
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <div class="image-wrapper">
                            <img src="<?php echo base_url(); ?>assets/img/payment.png" height="270" alt="Bayar">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-wrapper">
                            <h1 class="mb-3">Ikuti Test DISC</h1>
                            <p>Tes Kepribadian DISC membagi kepribadian manusia menjadi 4 macam: Dominance, Influence, Steadiness dan Compliance.</p>
                            <a href="<?php echo site_url(); ?>payment/checkout" class="btn btn-primary">Bayar</a>
                        </div>
                    </div>
                </div>

            <?php elseif ($active_test['status'] == 1) : ?>
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <div class="image-wrapper">
                            <img src="<?php echo base_url(); ?>assets/img/waiting.jpeg" height="270" alt="Menunggu Pembayaran">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-wrapper">
                            <h1 class="mb-3">Menunggu Pembayaran</h1>
                            <p>Segera selesaikan transaksi untuk dapat mengikuti tes</p>
                            <a href="<?php echo site_url(); ?>payment/order_list?filter=1" class="btn btn-primary">Pembayaran</a>
                        </div>
                    </div>
                </div>
            <?php elseif ($active_test['status'] == 2) : ?>
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <div class="image-wrapper">
                            <img src="<?php echo base_url(); ?>assets/img/active.png" height="270" alt="Menunggu Pembayaran">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-wrapper">
                            <h1 class="mb-3">Pembayaran Terkonfirmasi</h1>
                            <p>Pembayaran sudah dikonfirmasi, silahkan ikuti tes</p>
                            <a href="<?php echo site_url(); ?>test/start_test" class="btn btn-primary">Ikuti Tes</a>
                        </div>
                    </div>
                </div>
            <?php elseif ($active_test['status'] == 3) : ?>
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <div class="image-wrapper">
                            <img src="<?php echo base_url(); ?>assets/img/active.png" height="270" alt="Menunggu Pembayaran">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-wrapper">
                            <h1 class="mb-3">Tes Sedang Berjalan</h1>
                            <p>Lanjutkan sebelum waktu 30 menit habis</p>
                            <a href="<?php echo site_url(); ?>test" class="btn btn-primary">Lanjutkan</a>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="container">
            <p>Silahkan Login Untuk Mengikuti Tes</p>
            <a href="<?php echo site_url(); ?>user_auth" class="btn btn-primary">Login</a>
        </div>
    <?php endif; ?>
</section>