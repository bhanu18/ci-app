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
                    <table id="products" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
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
<script src="<?php echo site_url('/Asset/plugins/jquery/jquery.min.js'); ?>"></script>
<script>
var siteurl = "<?php echo site_url();?>";

function dodelete(id) {
    if (confirm("Do you want to delete the product?")) {
        $.ajax({
            url: siteurl + "product/delete/" + id,
            type: 'post',
            dataType: 'json',
            data: {},
            success: function(response) {

            }
        });
        alert('The Product is deleted');
    }
}

// $(document).ready(function() {
//     $('#products').DataTable({
//         // ajax: {
//         //     url: "<?php //echo site_url('/product/view');?>",
//         //     dataType: "json",
//         // },
//         processing: true,
//         serverSide: true,
//         ajax: "<?php //echo site_url('/product/view');?>",
//     });
// });

$.ajax({
            url: "<?php echo site_url('/product/view');?>",
            dataType: "json",
            success: function(data) {
                //console.log(data);
                $('#products').append("<tbody></tbody>");
                $.each(data, function(index, item) {
                    var prod = "";
                    prod += "<td>" + item.ID + "</td>";
                    prod += "<td>" + item.Name + "</td>";
                    prod += "<td>" + item.Quantity + "</td>";
                    prod += "<td>" + item.Price + "</td>";
                    prod += "<td><a class='btn btn-primary' href=" + siteurl +
                        "product/edit/" + item.ID +
                        ">Edit</a> <a class='btn btn-danger' onclick='dodelete(" + item
                        .ID + ")'>Delete</a> </td>";
                    $('#products').append("<tr>" + prod + "</tr>");
                });
            }
        });
</script>