<!-- <div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Products</h5>

                <p class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the card's
                    content.
                </p>

                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the card's
                    content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div> -->
    <!-- /.card
          /.col-md-6 -->
    <!-- <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title m-0">Featured</h5>
            </div>
            <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Featured</h5>
            </div>
            <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div> -->
    <!-- /.col-md-6 -->
<!-- </div>  -->
<!-- /.row -->
<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products</h3>
                        <?php if(session()->get('msg')): ?>
                            <div class="alert alert-success" role="alert"> <?php echo session()->get('msg'); ?></div>
                            <?php endif; ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Quantiy</th>
                                    <th>Price</th>
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
                                    <!-- <td><a class="btn btn-primary"
                                            href="<?php echo site_url('product/edit/').$product['ID'];?>">Edit</a> <a
                                            class="btn btn-danger"
                                            href="<?php echo site_url('product/delete/').$product['ID'];?>">Delete</a>
                                    </td> -->
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