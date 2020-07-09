<section>
    <div class="container">
        <?php if (!$active_test) : ?>
            <a href="<?php echo site_url(); ?>payment/checkout" class="btn btn-primary">Bayar</a>
        <?php elseif ($active_test['status'] == 2) : ?>
            <a href="">Pembayaran Terkonfirmasi, silahkan ikuti tes</a>
        <?php elseif ($active_test['status'] == 3) : ?>
            <a href="">Tes sedang berjalan, silahkan lanjutkan</a>
        <?php endif; ?>
    </div>
</section>