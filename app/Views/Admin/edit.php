    <div class="container">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit user</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="<?php echo site_url('user/update');?>" method="Post">
                <div class="card-body">
                    <?php if(isset($users)):?>
                    <?php foreach($users as $user):?>
                    <input hidden type="text" value="<?php echo $user['user_id']; ?>" name="user_id">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                            value="<?php echo $user['firstname'];?>" name="firstname">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                            value="<?php echo $user['lastname'];?>" name="lastname">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                            value="<?php echo $user['email'];?>" name="email">
                    </div>
                    <?php endforeach;?>
                    <?php endif;?>
                    <!-- /.card-body -->
                    <div class="form-group">
                        <label>Select Role</label>
                        <select name="role_id" class="custom-select">
                            <?php if(isset($roles)):?>
                            <?php foreach($roles as $role):?>
                            <option value="<?php echo $role['id'];?>"><?php echo $role['role'];?></option>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Group</label>
                        <select name="group_id" class="form-control">
                            <?php if(isset($groups)):?>
                            <?php foreach($groups as $group):?>
                            <option value="<?php echo $group['id'];?>"><?php echo $group['Group_name'];?>
                            </option>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>