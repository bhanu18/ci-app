<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products</h3>
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
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($products)):?>
                                <?php foreach($products as $product):?>
                                <tr>
                                    <td><?php echo $product['ID']; ?> </td>
                                    <td><?php echo $product['Name']; ?> </td>
                                    <td><?php echo $product['Quantity']; ?> </td>
                                    <td><?php echo $product['Price']; ?> </td>
                                    <td><a class="btn btn-primary"
                                            href="<?php echo site_url('product/edit/').$product['ID'];?>">Edit</a> <a
                                            class="btn btn-danger"
                                            href="<?php echo site_url('product/delete/').$product['ID'];?>">Delete</a>
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