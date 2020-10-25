<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom-style.css">

    <title>Test - DISC</title>
</head>

<body>

    <header>
        <?php if ($user_data['is_completed'] == 0) : ?>
            <div class="" style="display: flex; width: 100%; color: black; background-color: yellowgreen; justify-content: center; align-items: center; text-align: center; padding: 0.5rem;">
                <small class="m-0">Profil anda belum lengkap. Segera lengkapi profil anda untuk bisa mengikuti tes! <a href="<?php echo site_url(); ?>profile" style="color: blue; text-decoration: underline;">lengkapi</a></small>
            </div>
        <?php endif; ?>

        <nav class="navbar navbar-expand-lg <?php echo ($this->uri->segment(1) == 'home' || $this->uri->segment(1) == ''  ? 'navbar-dark' : 'navbar-light bg-light') ?>">
            <di class="container">
                <a class="navbar-brand" href="<?php echo site_url(); ?>home">PSIKOLOGI STAR</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?php echo ($this->uri->segment(1) == 'home' || $this->uri->segment(1) == ''  ? 'active' : ''); ?>">
                            <a class="nav-link" href="<?php echo site_url(); ?>home">BERANDA</span></a>
                        </li>
                        <li class="nav-item <?php echo ($this->uri->segment(1) == 'disc' ? 'active' : ''); ?>">
                            <a class="nav-link" href="<?php echo site_url(); ?>disc">DISC</a>
                        </li>
                        <li class="nav-item <?php echo ($this->uri->segment(1) == 'pricing' ? 'active' : ''); ?>">
                            <a class="nav-link" href="<?php echo site_url(); ?>pricing">TES</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo base_url(); ?>assets/img/profile-pictures/<?php echo $user_data['image']; ?>" width="30" height="30" class="align-center rounded-circle" alt="">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo site_url(); ?>profile" id="profile" data-userdata="<?php echo $user_data['user_id']; ?>">Profil</a>
                                <a class="dropdown-item" href="<?php echo site_url(); ?>payment/order_list">Pembayaran/Order</a>
                                <a class="dropdown-item" href="<?php echo site_url(); ?>report">Laporan</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo site_url(); ?>user_auth/logout">Keluar</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </di>
        </nav>
    </header>