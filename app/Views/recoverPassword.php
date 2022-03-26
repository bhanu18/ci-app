<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> A&A Collection| Recover Password</title>

    <?php echo view('styles/styles-admin'); ?>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
        <a href="<?php echo site_url('user');?>"><b>A&A</b> Collection</a>
        </div>
        <?php if(!empty($validation)): ?>
        <div class="alert alert-danger"><?php $validation->listErrors(); ?></div>
        <?php endif;?>
        <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif;?>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">You are only one step a way from your new password, recover your password now.
                </p>
                <?php if(isset($user[0]->token)){?>
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="passConf" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Change password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <?php }else{?>
                    <div class="alert alert-danger">This link has expired</div>
                <?php }?>
                <p class="mt-3 mb-1">
                    <a href="<?php echo site_url('user');?>">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
<!-- REQUIRED SCRIPTS -->
<?php echo view('scripts/scripts-admin'); ?>
</body>
<script>
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

</script> 
</html>