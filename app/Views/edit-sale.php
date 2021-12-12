<div class="container">
    <!-- general form elements -->
    <div class="card card-primary">
        <?php if(session()->get('msg')): ?>
        <div class="alert alert-success" role="alert"> <?php echo session()->get('msg'); ?></div>
        <?php endif; ?>
        <div class="card-header">
            <h3 class="card-title">Edit Sale</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action='<?php echo site_url('sale/update'); ?>' method="post">
        <?php if($sales): 
            foreach($sales as $sale):?>
            <div class="card-body">
                <div class="form-group">
                    <label>Product</label>
                    <select class="form-control" name="product" id="supplier-select" readonly>
                        <option value=""><?php echo $sale['name'];?></option>
                        <?php if($product):?>
                        <?php foreach($product as $products):?>
                            <?php $hide=""; ?>
                            <?php if($sale['name'] == $products['Name']): ?>
                                <?php $hide = "style='display:none;'" ?>
                                <?php endif; ?>
                        <option <?php echo $hide; ?>value="<?php echo $products['ID'];?>" name="product"><?php echo $products['Name'];?> </option>
                        <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
                <input type="hidden" name="sale-id" value="<?php echo $sale['sale_id'];?>">
                <div class="form-group">
                    <label>Date</label>
                    <input type="text" readonly name="Date" class="form-control" id=""  value="<?php echo $sale['date'];?>">
                </div>
                <div class="form-group">
                    <label>Sale Quantity</label>
                    <input type="number" name="quantity" class="form-control" id=""  value="<?php echo $sale['sale_quantity'];?>">
                </div>
                <div class="form-group">
                    <label>Size</label>
                    <input type="text" readonly name="size" class="form-control" id=""  value="<?php echo $sale['size'];?>">
                </div>
                <div class="form-group">
                    <label>Sale Price</label>
                    <input type="text" name="price" class="form-control" id=""  value="<?php echo $sale['sale_price'];?>">
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

<?php endforeach; ?>
<?php endif;?>