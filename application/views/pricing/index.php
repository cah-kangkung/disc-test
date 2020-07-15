<section id="pricing">
    <?php if ($this->session->userdata('loggedIn')) : ?>
        <div class="container">
            <?php if ($active_test['status'] == 0) : ?>
                <a href="<?php echo site_url(); ?>payment/checkout" class="btn btn-primary">Bayar</a>
            <?php elseif ($active_test['status'] == 1) : ?>
                <a href="<?php echo site_url(); ?>payment/order_list?filter=1" class="btn btn-primary">Menunggu Pembayaran</a>
            <?php elseif ($active_test['status'] == 2) : ?>
                <a href="<?php echo site_url(); ?>test/start_test" class="btn btn-primary">Pembayaran Terkonfirmasi, silahkan ikuti tes</a>
            <?php elseif ($active_test['status'] == 3) : ?>
                <a href="<?php echo site_url(); ?>test" class="btn btn-primary">Tes sedang berjalan, silahkan lanjutkan</a>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="container">
            <p>Silahkan Login Untuk Mengikuti Tes</p>
            <a href="<?php echo site_url(); ?>user_auth" class="btn btn-primary">Login</a>
        </div>
    <?php endif; ?>
</section>