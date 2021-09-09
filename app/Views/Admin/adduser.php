<div class="container">
    <div class="card justify-content-centre">
        <div class="card-header">
            <h3 class="card-title">Add User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?php echo $validation->listErrors(); ?></div>
        <?php endif;?>
        <form action="<?php echo site_url('user/add');?>" method="post">
            <div class="card-body">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="firstname"
                        placeholder="first name" value="">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="lastname"
                        placeholder="last name" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                        placeholder="Enter email" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">password</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" name="password"
                        placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label>Select Role</label>
                    <select class="custom-select" name="role">
                        <?php if(isset($roles)):?>
                        <?php foreach($roles as $role):?>
                        <option value="<?php echo $role['id'];?>"><?php echo $role['role'];?></option>
                        <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select Group</label>
                    <select class="form-control" name="group">
                        <?php if(isset($groups)):?>
                        <?php foreach($groups as $group):?>
                        <option value="<?php echo $group['id'];?>"><?php echo $group['Group_name'];?>
                        </option>
                        <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>