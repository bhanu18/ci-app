<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User</h3>
                        <?php if(session()->get('msg')): ?>
                            <div class="alert alert-success" role="alert"><?php echo session()->get('msg'); ?></div>
                            <?php endif; ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Group_name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($users)):?>
                                <?php foreach($users as $user):?>
                                <tr>
                                    <td><?php echo $user['user_id']; ?> </td>
                                    <td><?php echo $user['firstname']; ?> </td>
                                    <td><?php echo $user['lastname']; ?> </td>
                                    <td><?php echo $user['email']; ?> </td>
                                    <td><?php echo $user['role']; ?> </td>
                                    <td><?php echo $user['Group_name']; ?> </td>
                                    <td><a class="btn btn-primary"
                                            href="<?php echo site_url('user/edit/').$user['user_id'];?>">Edit</a> <a
                                            class="btn btn-danger"
                                            href="<?php echo site_url('user/delete/').$user['user_id'];?>">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                <?php endif; ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Group name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
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