<!doctype html>
<html lang="en">

<?php session_start() ?>

<?php include 'inc/head.php' ?>

<?php include 'core/Products/getProducts.php' ?>
<?php include 'core/config.php' ?>
<?php include 'core/Products/getcategoryoptions.php' ?>

<body data-sidebar="dark">

<!-- Loader -->
<?php include 'inc/loader.php' ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'inc/header.php' ?>

    <!-- ========== Left Sidebar Start ========== -->
    <?php include 'inc/left-sidebar.php' ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="response"></div>
                                    <button class="btn btn-light waves-effect" style="position: relative;float: right;" data-bs-toggle="modal" data-bs-target="#AddProductModal">
                                        Add +
                                    </button>
                                    <h4 class="card-title">Manage Products</h4>
                                    <p class="card-title-desc">Products will be displayed from current updation of database.</p>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Serial No</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Mrp</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody id="t-container">
                                            <?php echo getProducts("products"); ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Add Product Modal-->
        <div class="col-sm-6 col-md-4 col-xl-3">

            <div class="modal fade" id="AddProductModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">
                                Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="AddProductForm" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="pname" type="text" placeholder="Enter Product Name"  value="" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product Serial No</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="psno" type="text" placeholder="Enter Product Serial No"  value="" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Category</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="category" id="category" required>
                                            <?php 
                                                $query="select * from category";
                                                $result=mysqli_query($conn,$query);
                                                while($row=mysqli_fetch_array($result)){
                                                    $id=$row['id'];
                                                    $category=$row['name'];
                                                    echo "<option class='option' value='$category'>".$category."</option>";
                                                }
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4">Product Image</label>
                                    <div class="col-8">
                                        <input type="file" name="pimage" id="pimage" class="filestyle" data-buttonname="btn-secondary">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product Type</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="ptype" type="text" value="" placeholder="1 BOX/PKT" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product Video</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="purl" type="url" placeholder="Enter youtube url" value="" id="example-text-input" >
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product MRP</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="mrp" type="number" placeholder="Enter Product MRP" value="" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Stock</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="stock" type="number" placeholder="Enter Product Stock" value="" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Net Rate Apply</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="net_rate" required>
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>

        <!-- Edit Product Modal -->
        <div class="col-sm-6 col-md-4 col-xl-3">

            <div class="modal fade" id="EditProductModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">
                                Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="core/Products/editProduct.php" id="EditProductForm" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="pname" name="pname" type="text" placeholder="Enter Product Name"  value="" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product Serial No</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="psno" id="psno" type="text" placeholder="Enter Product Serial No"  value="" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Category</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" id="category" name="category"  required>
                                            <?php 
                                                $query="select * from category";
                                                $result=mysqli_query($conn,$query);
                                                while($row=mysqli_fetch_array($result)){
                                                    $id=$row['id'];
                                                    $category=$row['name'];
                                                    echo "<option class='option' value='$category'>".$category."</option>";
                                                }
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4">Product Image</label>
                                    <div class="col-8">
                                        <input type="file" name="eimage" placeholder="Choose Image" id="eimage" class="filestyle" data-buttonname="btn-secondary">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4">Preview Image</label>
                                    <div class="col-8 border">
                                        <img id="primage" class="rounded me-2 align-center" alt="200x200" style="width: 200px;" src="" data-holder-rendered="true">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product Type</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="ptype" name="ptype" type="text" value="" placeholder="1 BOX/PKT" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product Video</label>
                                    <div class="col-sm-8">
                                        <input class="form-control"  id="purl" name="purl" type="url" placeholder="Enter youtube url" value="" id="example-text-input">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product MRP</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="mrp" name="mrp" type="number" placeholder="Enter Product MRP" value="" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Stock</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="stock" type="number" placeholder="Enter Product Stock" value="" id="stock" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product Discount</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="discount" name="discount" type="number" placeholder="Enter Product Discount" value="" id="example-text-input" required>
                                        <input type="hidden" name="pid-edit" id="pid-edit" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Net Rate Apply</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="net_rate" id="net_rate" required>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>

        <script>
        
            function openModal(pid) {
                var modal = $('#EditProductModal');
                modal.modal('show');
                $.ajax({
                    url: 'core/Products/api-getProduct.php', 
                    type: 'POST',
                    data: {'pid':pid},
                    success: function(response) {
                        console.log(response);
                        var product=JSON.parse(response);
                        // console.log(product.name);
                        var $tempElement = $('<div>').html(product.name);
                        $('#pname').val($tempElement.text());                        
                        
                        $("#category option").each(function() {
                            if ($(this).text() === product.category) {
                                console.log("Match found");
                                $(this).prop("selected", true);
                                return false; // Exit the loop once the desired option is found
                            }
                        });
                        
                        $("#net_rate option").each(function() {
                            if ($(this).val() === product.net_rate) {
                                console.log("Net rate Match found");
                                $(this).prop("selected", true);
                                return false; // Exit the loop once the desired option is found
                            }
                        });
                        
                        $('#mrp').val(product.mrp);
                        // $('#pimage').val(product.image);
                        siteurl="<?php echo $mainurl ?>";
                        $('#primage').attr('src', siteurl+'images/products/'+product.image);
                        $('#purl').val(product.video);
                        $('#ptype').val(product.type);
                        $('#psno').val(product.serialno);
                        $('#discount').val(product.discount);
                        $('#stock').val(product.inventory);
                        $('#pid-edit').val(product.id);
                    }
                });

            }
            
            function closeModal() {
                var modal = $('#modalId');
                modal.modal('close');
            }
            
            $('#AddProductForm').submit(function(e){
                e.preventDefault();
                console.log("clicked add button");
                var formdata = new FormData(this);
                for (var pair of formdata.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }
                $.ajax({
                    url:'core/Products/api-addproduct.php',
                    method:'POST',
                    // dataType:"JSON",
                    data:formdata,
                    cache:false,
                    processData:false,
                    contentType:false,
                    success:function(response){
                        var modal = $('#AddProductModal');
                        modal.modal('hide');
                        var response=JSON.parse(response);
                        if(response.status == '1'){
                            $.ajax({
                                type: 'GET',
                                url: "core/Products/api-getproducts.php",
                                success: function(products) {
                                    $('#datatable').DataTable().destroy();
                                    
                                    $('#t-container').html(products);
    
                                    // Reinitialize DataTable with the new content
                                    $('#datatable').DataTable();
                                }
                                
                            });
                            var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>${response.message}</strong>
                                        </div>`;
                            $('#response').html(success);
                        }else{
                            var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>${response.message}</strong>
                                    </div>`;
                            $('#response').html(error);
                        }
                        setTimeout(function() {
                            console.log("called success");
                            $('#response').empty();
                        }, 5000);
                    }
                });
            });

            $('#EditProductForm').submit(function(e){
                e.preventDefault();
                console.log("clicked add button");
                var formdata = new FormData(this);
                // console.log("Form Data:");
                // for (var pair of formdata.entries()) {
                //     console.log(pair[0] + ': ' + pair[1]);
                // }
                $.ajax({
                    url:'core/Products/api-editproduct.php',
                    method:'POST',
                    // dataType:"JSON",
                    data:formdata,
                    cache:false,
                    processData:false,
                    contentType:false,
                    success:function(response){
                        console.log(response);
                        var response=JSON.parse(response);
                        var modal = $('#EditProductModal');
                        modal.modal('hide');
                        if(response.status == '1'){
                            $.ajax({
                                type: 'GET',
                                url: "core/Products/api-getproducts.php",
                                success: function(products) {
                                    $('#datatable').DataTable().destroy();
                                    
                                    $('#t-container').html(products);

                                    // Reinitialize DataTable with the new content
                                    $('#datatable').DataTable();
                                }
                            });
                            var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                         <strong>${response.message}</strong>
                                         </div>`;
                            $('#response').html(success);
                            console.log(response.message);
                        }else{
                            var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>${response.message}</strong></div>`;
                            $('#response').html(error);
                            console.log(response.message);
                        }
                        setTimeout(function() {
                            console.log("called error");
                            $('#response').empty();
                        }, 5000);
                    }
                });
            });

            function deleteProduct(id){
                var result = confirm("Are you sure you want to Delete ?");
                if (result === true) {
                    $.ajax({
                    type: 'GET',
                    url:"core/Products/api-deleteproduct.php",
                    data:{'pid':id},
                    success: function(response) {
                        if(response == true){
                            $.ajax({
                                type: 'GET',
                                url: "core/Products/api-getproducts.php",
                                success: function(products) {
                                    $('#datatable').DataTable().destroy();
                                    
                                    $('#t-container').html(products);

                                    // Reinitialize DataTable with the new content
                                    $('#datatable').DataTable();
                                }
                                
                            });
                            var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>Product Deleted</strong>
                                        </div>`;
                            $('#response').html(success);
                            setTimeout(function() {
                                console.log("called success");
                                $('#response').empty();
                            }, 5000);
                        }else{
                            var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>Failed To Delete</strong>
                                    </div>`;
                            $('#response').html(error);
                            setTimeout(function() {
                                console.log("called error");
                                $('#response').empty();
                            }, 5000);
                        }
                    }
                });
                } else {
                    console.log("someting wrong");
                }
            }
            
             function setStatus(id){
                var checkbox = $('#check_' + id);
                var status = checkbox.prop('checked');
                
                $.ajax({
                    method:'POST',
                    url:'core/Products/api-setStatus.php',
                    data:{'status':status,'id':id},
                    success:function(response){
                        console.log(response);
                    }
                });
            }
            
        </script>

        
        <!-- Footer-->
        <?php include 'inc/footer.php' ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<!-- Right Side Bar-->
<?php include 'inc/right-sidebar.php' ?>
</body>

</html>