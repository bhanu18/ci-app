<div class="row">
    <div class="col-4"></div>
    <div class="col-4 justify-content-center">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="<?php echo site_url('asset/dist/img/user4-128x128.jpg');?>" alt="User profile picture">
                </div>
                <?php if($profile): ?>
                <?php foreach($profile as $user): ?>
                <h3 class="profile-username text-center"><?php echo $user['firstname']; ?></h3>

                <p class="text-muted text-center"><?php echo $user['lastname']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right"><?php echo $user['email']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Role</b> <a class="float-right"><?php echo $user['role']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Group</b> <a class="float-right"><?php echo $user['Group_name']; ?></a>
                    </li>
                </ul>
                <?php endforeach;?>
                <?php endif;?>
                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-4"></div>
</div>