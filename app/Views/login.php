<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo site_url('/public/Asset/plugins/fontawesome-free/css/all.min.css');?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo site_url('/public/Asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo site_url('/public/Asset/dist/css/adminlte.min.css');?>">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo site_url('user');?>"><b>Admin</b>LTE</a>
        </div>
        <?php if(session()->get('msg')): ?>
        <div class="alert alert-danger mb-2" role="alert"><?php echo session()->get('msg'); ?></div>
        <?php endif;?>
        <?php if(isset($errors)): ?>
        <div class="alert alert-danger mb-2" role="alert"><?php echo $errors; ?></div>
        <?php endif;?>
        <?php if(isset($validation)): ?>
        <div class="alert alert-danger mb-2" role="alert"><?php $validation->listErrors(); ?></div>
        <?php endif;?>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="<?php echo site_url('user/login');?>" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="<?php echo site_url('user/forgotPassword');?>">I forgot my password</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo site_url('/public/Asset/plugins/jquery/jquery.min.js');?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo site_url('/public/Asset/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo site_url('/public/Asset/dist/js/adminlte.min.js');?>"></script>
</body>

</html>