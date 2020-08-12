<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/fontawesome/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/iCheck/square/purple.css">
    <style type="text/css">
        .kiri {
            background-image: url("<?= base_url(); ?>assets/dist/img/bglogin.jpg");
            background-size: auto;
            background-repeat: no-repeat;
            background-position: center;
            background-color: #7c20db;
            height: 100%;
            margin: 0px;
            padding: 0px;
        }

        .kanan {
            background-color: white;
            height: 100%;
            padding-top: 5%;
        }

        .container-login {
            padding: 7%;
            padding-top: 0;
        }

        .login-logo {}
    </style>
</head>

<body class="hold-transition login-page" style="height: 100%;overflow: hidden;">

    <div class="col-md-7 hidden-xs hidden-sm kiri">
    </div>
    <div class="col-md-5 col-xs-12 kanan">
        <div class="login-logo">
            <h1><?= $this->config->item('sitename') ?></h1>
        </div>
        <div class="container-login ">
            <p class="login-box-msg">Registrasi Akun</p>
            <div id="infoMessage" style="color: red"><?php echo $message; ?></div>
            <form class="form" action="<?= site_url('register/insert');?>" method="post">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" required  class="form-control" name="nama" id="nama" placeholder="Nama Lengkap">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" required  class="form-control" id="notelp" name="notelp" placeholder="No Telepon">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" required  class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">JK</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                    <button type="submit" name="submit"  class="btn bg-blue pull-right" >Submit</button>
            </form>

        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="<?= base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?= base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/bootstrap-show-password/bootstrap-show-password.min.js"></script>

    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'icheckbox_flat-green',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
</body>

</html>