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
        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun</h1>
                            </div>
                            <form class="user" method="post" action="<?php echo site_url(); ?>user_auth/register">
                                <div class="form-group text-left row">
                                    <input type="text" class="form-control form-control-user" id="full_name" name="full_name" placeholder="Nama Lengkap" value="<?php echo set_value('full_name'); ?>">
                                    <?php echo form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group text-left">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                                    <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group text-left row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                        <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-custom btn-block">
                                    Daftar Akun
                                </button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <a class="small" href="<?php echo site_url(); ?>user_auth/forgot_password">Lupa Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?php echo site_url(); ?>user_auth/">Sudah punya akun? masuk...</a>
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