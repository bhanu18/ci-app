<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sales</h3>
                    <?php if(session()->get('msg')): ?>
                    <div class="alert alert-success" role="alert"><?php echo session()->get('msg'); ?></div>
                    <?php endif; ?>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($sale):?>
                            <?php foreach($sale as $sales):?>
                            <tr>
                                <td><?php echo $sales['sale_id'];?></td>
                                <td><?php echo $sales['name'];?></td>
                                <td><?php echo $sales['date'];?></td>
                                <td><?php echo $sales['sale_quantity'];?></td>
                                <td><?php echo $sales['sale_price'];?></td>
                                <td><a href="<?php echo base_url('sale/edit/'.$sales['sale_id']);?>"
                                        class="btn btn-primary">edit</a>
                                    <a href="<?php echo base_url('sale/delete/'.$sales['sale_id']);?>"
                                        class="btn btn-danger">delete</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <?php endif;?>
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