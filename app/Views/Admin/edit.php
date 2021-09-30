<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quick Example</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <select name="users" onchange="showUser(this.value)"> 
                    <?php if(isset($user)):?>
                        <?php foreach($user as $users):?>
                        <option value="<?php echo $users['user_id']; ?>"><?php echo $users['firstname'];?></option>
                        <?php endforeach;?>
                        <?php endif;?>

                    </select>

                    <form action="<?php echo site_url('user/update');?>" method="post">
                        <div class="card-body">
                            <?php if(isset($users)):?>
                            <?php foreach($users as $user):?>
                                <input hidden type="text" value="<?php echo $user['user_id']; ?>" >
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter email" value="<?php echo $user['firstname'];?>">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter email" value="<?php echo $user['lastname'];?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter email" value="<?php echo $user['email'];?>">
                            </div>

                            <?php endforeach;?>
                            <?php endif;?>
                            <div class="form-group">
                                <label>Select Role</label>
                                <select class="custom-select">
                                    <?php if(isset($roles)):?>
                                    <?php foreach($roles as $role):?>
                                    <option value="<?php echo $role['id'];?>"><?php echo $role['role'];?></option>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Group</label>
                                <?php if(isset($groups)):?>
                                <?php foreach($groups as $group):?>
                                <select multiple="" class="form-control">
                                    <option value="<?php echo $group['id'];?>"><?php echo $group['Group_name'];?>
                                    </option>
                                </select>
                                <?php endforeach;?>
                                <?php endif;?>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>