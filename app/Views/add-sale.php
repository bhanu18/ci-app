<div class="container">
    <!-- general form elements -->
    <div class="card card-primary">
        <?php if (session()->get('msg')) : ?>
            <div class="alert alert-success" role="alert"> <?php echo session()->get('msg'); ?></div>
        <?php endif; ?>
        <!-- <div class="card-header">
            <h3 class="card-title">Add Sale</h3>
        </div> -->
        <!-- /.card-header -->
        <!-- form start -->
        <form action='<?php echo site_url('sale/add'); ?>' method="post">
            <!--  <div class="card-body">
                <div class="form-group">
                    <label>Product</label>
                    <select class="form-control" name="product" id="supplier-select" required>
                        <option value="">Select a Product </option>
                        <?php if ($product) : ?>
                            <?php foreach ($product as $products) : ?>
                                <option value="<?php echo $products['ID']; ?>"><?php echo $products['Name']; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
                </div> -->
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
                </div> 
            </div> -->
            <!-- /.card-body -->

            <!-- <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div> -->
        </form>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            add sale
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('sale/insert'); ?>" method="post">
                <div class="row p-2 mt-2 mb-5">
                    <div class="col-6">
                        <label for="" class="form-label">Customer id</label>
                        <input type="text" name="customer_id" id="customer_id" class="form-control">
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Total Price</label>
                        <input type="text" name="total_price" id="" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">

                        <table class="table">
                            <thead>
                                <th>product name</th>
                                <th>Quantity</th>
                                <th>price</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control" name="product[]" id="supplier-select" required>
                                            <option value="">Select a Product </option>
                                            <?php if ($product) : ?>
                                                <?php foreach ($product as $products) : ?>
                                                    <option value="<?php echo $products['ID']; ?>"><?php echo $products['Name']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[]" id="" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="price[]" id="price" class="form-control">
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="add_more(); ">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').on('keyup', function() {
            var total = 0;
            $('input[name="price[]"]').each(function() {
                if ($(this).val() !== '') {
                    total += parseInt($(this).val());
                }
                $('input[name="total_price"]').val(total);
            });
        });
    });

    function add_more(obj) {
        const html = '<tr><td><select class="form-control" name="product[]" id="supplier-select" required><option value="">Select a Product </option><?php if ($product) : ?><?php foreach ($product as $products) : ?><option value="<?php echo $products['ID']; ?>"><?php echo $products['Name']; ?></option><?php endforeach; ?><?php endif; ?></select></td><td><input type="number" name="quantity[]" id="" class="form-control"></td><td><input type="text" name="price[]" id="price" class="form-control"></td><td><a href="javascript:void(0)" onClick="add_more(); "><i class="fas fa-plus-circle"></i> </a> <a href="javascript:void(0)" onClick="remove_row(this);"><i class="fas fa-trash"></i></a></td> </tr>';
        $('.table').append(html);
    }

    function remove_row(obj) {
        $(obj).parent().parent().remove()
    }


    window.onload = function gen_random_number() {
        let num = "";
        const characters = "abcdefghijklmnopqrstuvwxyz012345679";

        for (let i = 1; i <= 7; i++) {
            num += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        // console.log(num);

        document.getElementById('customer_id').value = num;
    }
</script>