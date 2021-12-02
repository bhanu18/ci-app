<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products</h3>
                        <?php if(session()->get('msg')): ?>
                            <div class="alert alert-success" role="alert"><?php echo session()->get('msg'); ?></div>
                            <?php endif; ?>
                            <div class="card-tools"><a class="btn btn-primary" href="<?php echo site_url('/product/add');?>">Add Product</a></div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="product-table" class="table table-bordered table-hover">
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
                                            class="btn btn-danger" onclick="doDelete(<?php echo $product['ID'];?>)">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                <?php endif; ?>
                            </tbody>
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
    <script>

        function doDelete(id){
            if(confirm('Do you want to delete this product?')){
                $.ajax({
                    url: "<?php echo site_url('product/delete/')?>"+id,
                    dataType: 'json',
                    data:{},
                    success: function(res){

                    }
                });
                alert('The product is deleted');
            }
        }
    </script>