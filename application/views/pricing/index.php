<section>
    <div class="container">
        <?php if ($active_test['status'] == 0) : ?>
            <a href="<?php echo site_url(); ?>payment/checkout" class="btn btn-primary">Bayar</a>
        <?php elseif ($active_test['status'] == 1) : ?>
            <a href="<?php echo site_url(); ?>payment" class="btn btn-primary">Menunggu Pembayaran</a>
        <?php elseif ($active_test['status'] == 2) : ?>
            <a href="" class="btn btn-primary">Pembayaran Terkonfirmasi, silahkan ikuti tes</a>
        <?php elseif ($active_test['status'] == 3) : ?>
            <a href="" class="btn btn-primary">Tes sedang berjalan, silahkan lanjutkan</a>
        <?php endif; ?>
    </div>
</section>