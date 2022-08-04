<div class="container">
    <!-- general form elements -->
    <div class="card card-primary">
        <?php if(session()->get('msg')): ?>
        <div class="alert alert-success" role="alert"> <?php echo session()->get('msg'); ?></div>
        <?php endif; ?>
        <div class="card-header">
            <h3 class="card-title">Edit Products</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action='<?php echo site_url('product/update'); ?>' method="Post">
                <input type="hidden" class="form-control" id="exampleInputEmail1" name="ID"
                        value="<?php echo $product['ID'];?>">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="Name"
                        value="<?php echo $product['Name'];?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Quantity</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" name="Quantity"
                        value="<?php echo $product['Quantity'];?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Cost Price</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="Cost_Price"
                        value="<?php // echo $product['Cost_Price'];?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="Price"
                        value="<?php echo $product['Price'];?>">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>