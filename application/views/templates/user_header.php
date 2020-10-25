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
        <nav class="navbar navbar-expand-lg <?php echo ($this->uri->segment(1) == 'home' || $this->uri->segment(1) == ''  ? 'navbar-dark' : 'navbar-light') ?>">
            <div class="container">
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
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url(); ?>user_auth">Masuk</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>