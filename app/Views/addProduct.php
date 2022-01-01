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