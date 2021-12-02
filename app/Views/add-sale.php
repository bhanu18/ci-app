<div class="container">
    <!-- general form elements -->
    <div class="card card-primary">
        <?php if(session()->get('msg')): ?>
        <div class="alert alert-success" role="alert"> <?php echo session()->get('msg'); ?></div>
        <?php endif; ?>
        <div class="card-header">
            <h3 class="card-title">Add Sale</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action='<?php echo site_url('sale/add'); ?>' method="post">
            <div class="card-body">
                <div class="form-group">
                    <label>Product</label>
                    <select class="form-control" name="product" id="supplier-select" required>
                        <option value="">Select a Product </option>
                        <?php if($product):?>
                        <?php foreach($product as $products):?>
                        <option value="<?php echo $products['ID'];?>" name="product"><?php echo $products['Name'];?>
                        </option>
                        <?php endforeach;?>
                        <?php endif;?>
                    </select>
                    <span id="select-product-error" class="error invalid-feedback">Please select a product</span>
                </div>
                <div class="form-group">
                    <label>Sale Quantity</label>
                    <input type="number" name="quantity" class="form-control" id="" required>
                </div>
                <div class="form-group">
                    <label>Size</label>
                    <input type="text" name="size" class="form-control" id="" required>
                </div>
                <div class="form-group" aria-describedby="price-error">
                    <label>Sale Price</label>
                    <input type="text" name="price" class="form-control" id="" required>
                </div>
                <!-- <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>