<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Group name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($users)):?>
                                <?php foreach($users as $user):?>
                                <tr>
                                    <td><?php echo $user['firstname']; ?> </td>
                                    <td><?php echo $user['lastname']; ?> </td>
                                    <td><?php echo $user['email']; ?> </td>
                                    <td><?php echo $user['role']; ?> </td>
                                    <td><?php echo $user['Group_name']; ?> </td>
                                    <td><a class="btn btn-primary"
                                            href="<?php echo site_url('admin/edit/').$user['user_id'];?>">Edit</a> <a
                                            class="btn btn-danger"
                                            href="<?php echo site_url('admin/delete/').$user['user_id'];?>">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Group name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php if(isset($validation)):?>
                      <div class="alert alert-primary"><?php echo $validation->listErrors(); ?></div>
                      <?php endif;?>
                    <form action="<?php echo site_url('Admin/addUser');?>" method="post">
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add User Group</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo site_url('Admin/addUser');?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Group Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter email" value="">
                            </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add User Roles</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo site_url('Admin/addgroup');?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter email" value="">
                            </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
        </div>
</section>
<!-- /.content -->
</div>