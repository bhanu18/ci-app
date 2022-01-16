<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" style="height:128px;"
                            src="<?php getUserProfile(session()->get('user_id')) ?>" alt="User profile picture">
                    </div>
                    <?php if(isset($pro)): ?>
                    <h3 class="profile-username text-center"><?php echo $pro[0]['firstname']; ?></h3>

                    <p class="text-muted text-center"><?php echo $pro[0]['lastname']; ?></p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right"><?php echo $pro[0]['email']; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Role</b> <a class="float-right"><?php echo $pro[0]['role']; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Group</b> <a class="float-right"><?php echo $pro[0]['Group_name']; ?></a>
                        </li>
                    </ul>
                    <?php endif;?>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <?php if(session()->get('msg')): ?>
            <div class="alert alert-success alert-dismissible" role="alert"><?php echo session()->get('msg'); ?></div>
            <?php endif;?>
            <?php if(isset($errors)): ?>
            <div class="alert alert-danger mb-2" role="alert"><?php echo $errors; ?></div>
            <?php endif;?>
            <div class="card card-primary card-outline">
                <!-- <div class="card-header p-2">
                    <ul class="nav nav-pills"> -->
                <!-- <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                <!-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
                <!-- </ul>
                </div> -->
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <!-- <div class="active tab-pane" id="activity">
                            
                        </div> -->
                        <!-- /.tab-pane -->
                        <!-- <div class="tab-pane" id="timeline">

                        </div> -->
                    </div>
                    <!-- /.tab-pane -->

                    <!-- <div class="tab-pane" id="settings"> -->
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?php echo $pro[0]['user_id']; ?>">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">First Name - Last Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="inputName" name="firstname"
                                    placeholder="First Name" value="<?php echo $pro[0]['firstname']; ?>">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="inputName" name="lastname"
                                    placeholder="Last Name" value="<?php echo $pro[0]['lastname']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" readonly placeholder="Email"
                                    value="<?php echo $pro[0]['email']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputFile" class="col-sm-2 col-form-label">Upload Profile image</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="InputFile" name="proimage"
                                            onchange="return fileValidation()">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                    </div>
                                </div> -->
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> I agree to the <a href="#">terms and
                                            conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <a href="<?php echo site_url('user/resetPassword'); ?>" class="btn btn-primary">Change
                                Password</a>
                        </div>
                    </div>
                    <!-- </div> -->
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<script>
function fileValidation() {
    var fileInput = document.getElementById('InputFile');

    var filePath = fileInput.value;

    // Allowing file type
    var allowedExtensions =
        /(\.jpg|\.jpeg|\.png)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Invalid file type');
        fileInput.value = '';
        return false;
    } else {

        // Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(
                        'imagePreview').innerHTML =
                    '<img src="' + e.target.result +
                    '"/>';
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
</script>