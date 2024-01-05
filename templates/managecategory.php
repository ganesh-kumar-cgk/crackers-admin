<!doctype html>
<html lang="en">

<?php session_start() ?>

<?php include 'inc/head.php' ?>

<?php include 'core/config.php' ?>

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
                                    
                                    <button class="btn btn-light waves-effect" style="position: relative;float: right;" data-bs-toggle="modal" data-bs-target="#AddCategoryModal">
                                        Add +
                                    </button>
                                    <h4 class="card-title">Manage Category</h4>
                                    <p class="card-title-desc">Category will be displayed from current updation of database.</p>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Name</th>
                                                <th>Created_on</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody id="t-container">
                                            <?php include 'core/Category/api-getcategorys.php' ?>
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

            <div class="modal fade" id="AddCategoryModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">
                                Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="core/Category/uploadCategory.php" id="AddCategoryForm" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Category Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="cname" type="text" placeholder="Enter Category Name"  value="" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Category Discount</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="discount" type="number" value="" placeholder="Enter discount" id="example-text-input" required>
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

            <div class="modal fade" id="EditCategoryModal" tabindex="-1" role="dialog"
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
                            <form method="post" id="EditCategoryForm" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Category Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="cname" id="cname-edit" type="text" placeholder="Enter Category Name"  value="" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Category Discount</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="discount" id="discount-edit" type="number" value="" placeholder="Enter discount" id="example-text-input" required>
                                        <input class="form-control" name="cid" id="cid" type="hidden">
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
            function openModal(cid) {
                var modal = $('#EditCategoryModal');
                modal.modal('show');
                $.ajax({
                    url: 'core/Category/getCategory.php', 
                    type: 'POST',
                    data: {'cid':cid},
                    success: function(response) {
                        console.log(response);
                        var category=JSON.parse(response);
                        $('#cname-edit').val(category.name);
                        $('#cid').val(category.id);
                        $('#discount-edit').val(category.discount);
                    }
                });

            }
            $('#AddCategoryForm').submit(function(e){
                e.preventDefault();
                var formdata=$(this).serialize();
                $.ajax({
                    type: 'POST',
                    url:"core/Category/uploadCategory.php",
                    data:formdata,
                    success: function(response) {
                        var modal = $('#AddCategoryModal');
                        modal.modal('hide');
                        if(response == true){
                            $.ajax({
                                type: 'GET',
                                url: "core/Category/api-getcategorys.php",
                                success: function(categorys) {
                                    $('#datatable').DataTable().destroy();
                                    
                                    $('#t-container').html(categorys);

                                    // Reinitialize DataTable with the new content
                                    $('#datatable').DataTable();
                                }
                                
                            });
                            var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>Category Added</strong>
                                        </div>`;
                            $('#response').html(success);
                            setTimeout(function() {
                                console.log("called success");
                                $('#response').empty();
                            }, 5000);
                        }else{
                            var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>Failed To Insert</strong>
                                    </div>`;
                            $('#response').html(error);
                            setTimeout(function() {
                                console.log("called error");
                                $('#response').empty();
                            }, 5000);
                        }
                    }
                });

            });
            function closeModal() {
                var modal = $('#modalId');
                modal.modal('close');
            }
            function deleteProduct(id){
                var result = confirm("Are you sure you want to Delete ?");
                if(result === true){
                    $.ajax({
                    type: 'GET',
                    url:"core/Category/deleteCategory.php",
                    data:{'cid':id},
                    success: function(response) {
                        if(response == true){
                            $.ajax({
                                type: 'GET',
                                url: "core/Category/api-getcategorys.php",
                                success: function(categorys) {
                                    $('#datatable').DataTable().destroy();
                                    
                                    $('#t-container').html(categorys);

                                    // Reinitialize DataTable with the new content
                                    $('#datatable').DataTable();
                                }
                                
                            });
                            var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>Category Deleted</strong>
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
                }
            }
            
            $('#EditCategoryForm').submit(function(e){
                e.preventDefault();
                var formdata=$(this).serialize();
                $.ajax({
                    type: 'POST',
                    url:"core/Category/editCategory.php",
                    data:formdata,
                    success: function(response) {
                        console.log(response);
                        var modal = $('#EditCategoryModal');
                        modal.modal('hide');
                        if(response == true){
                            $.ajax({
                                type: 'GET',
                                url: "core/Category/api-getcategorys.php",
                                success: function(categorys) {
                                    $('#datatable').DataTable().destroy();
                                    
                                    $('#t-container').html(categorys);

                                    // Reinitialize DataTable with the new content
                                    $('#datatable').DataTable();
                                }
                                
                            });
                            var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>Category Added</strong>
                                        </div>`;
                            $('#response').html(success);
                            setTimeout(function() {
                                console.log("called success");
                                $('#response').empty();
                            }, 5000);
                        }else{
                            var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>Failed To Insert</strong>
                                    </div>`;
                            $('#response').html(error);
                            setTimeout(function() {
                                console.log("called error");
                                $('#response').empty();
                            }, 5000);
                        }
                    }
                });

            });
            
            function setStatus(id){
                var checkbox = $('#check_' + id);
                var status = checkbox.prop('checked');
                
                $.ajax({
                    method:'POST',
                    url:'core/Category/api-setstatus.php',
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