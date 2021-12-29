<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>A&A Collection | Forgot Password</title>
  
  <?php echo view('styles/styles-admin'); ?>
  
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <a href="<?php echo site_url('user');?>"><b>A&A</b> Collection</a>
  </div>

  <?php if(isset($errors)): ?>
      <div class="alert alert-danger mb-2" role="alert"><?php echo $errors; ?></div>
      <?php endif;?>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="<?php echo site_url('user/verifyUser');?>" method="post">
        <div class="input-group mb-3">
          <input type="email" id="email" class="form-control" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?php echo site_url('user');?>">Login</a>
      </p>
      <!-- <p class="mb-0">
        <a href="<?php echo site_url('user/register');?>" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- REQUIRED SCRIPTS -->
<?php echo view('scripts/scripts-admin'); ?>
<script>

</script>
</body>
</html>