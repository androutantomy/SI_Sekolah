<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.css">
    <script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>One Web Landing</b>
        </div>
        <!-- /.login-logo -->
        <div id="templateData">
            <div class="card">
                <div class="card-body login-card-body" style="border-radius: 30px;">
                    <p class="login-box-msg">Login Terlebih Dahulu</p>

                    <form id="formLogin">
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Isikan Username Anda">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-eye" id="changeIt" style="cursor: pointer;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" id="alert"></div>
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4 loading_gif">
                                <img src="<?= base_url('assets/loading/loading.gif') ?>">
                            </div>
                            <div class="col-4"></div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mb-1">
                        <center><a href="forgot-password.html">Lupa Password</a></center>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <!-- Sweetalert -->
    <script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.loading_gif').hide();

            $('#changeIt').click(function() {
                var type = $('input[name=password]').attr('type');
                if (type == 'password') {
                    $('input[name=password]').removeAttr('type');
                    $('#changeIt').removeAttr('class');
                    $('input[name=password]').attr('type', 'text');
                    $('#changeIt').attr('class', 'fas fa-eye-slash');
                } else {
                    $('input[name=password]').removeAttr('type');
                    $('#changeIt').removeAttr('class');
                    $('input[name=password]').attr('type', 'password');
                    $('#changeIt').attr('class', 'fas fa-eye');
                }
            });
        });

        $('#formLogin').on('submit', (function(e) {
            e.preventDefault();
            $('.loading_gif').show();
            
            $.ajax({
                url: '<?= site_url("Admin/proccLogin") ?>',
                type: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(respon) {
                    if (respon.status == 'berhasil') {
                        $('.loading_gif').hide();
                        window.location.href = '<?= site_url("Dashboard") ?>';
                    } else {
                        swal.fire({
                            title: 'Oops, Terjadi Kesalahan',
                            text: respon.keterangan,
                            showConfirmButton: true,
                            type: 'error',
                        });
                    }
                }
            });
        }));
    </script>

</body>

</html>
