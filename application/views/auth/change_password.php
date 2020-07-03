<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom-style.css">

    <title><?php echo $title; ?></title>
</head>

<body id="auth-body">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Silahkan Masuk</h1>
                                    </div>

                                    <?php if ($this->session->flashdata('danger_alert')) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $this->session->flashdata('danger_alert'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($this->session->flashdata('success_alert')) : ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php echo $this->session->flashdata('success_alert'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <form class="user" method="post" action="<?php echo site_url(); ?>user_auth/change_password">
                                        <div class="form-group text-left">
                                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password Baru">
                                            <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group text-left">
                                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                                            <?php echo form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-custom btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>