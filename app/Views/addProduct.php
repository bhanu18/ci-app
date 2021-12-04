<div class="container">
    <!-- general form elements -->
    <div class="card card-primary">
    <?php if(session()->get('msg')): ?>
        <div class="alert alert-success" role="alert"> <?php echo session()->get('msg'); ?></div>
        <?php endif; ?>
        <div class="card-header">
            <h3 class="card-title">Add Products</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action='<?php echo site_url('product/add'); ?>' method="Post" onsubmit="validateProduct()">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Quantity</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" name="Quantity" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="Price" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Size</label>
                    <select class="form-control" name="size" id="supplier-select" required>
                        <option value="">Select a Size </option>
                        <?php if($sizes): ?>
                            <?php foreach($sizes as $size): ?>
                                <option value="<?php echo $size['id'];?>"><?php echo $size['size'];?></option>
                             <?php endforeach; ?>
                             <?php endif; ?>   
                    </select>
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

<script>

    function validateProduct(){
        confirm("Do you want to submit the form?");

    }
    </script>    