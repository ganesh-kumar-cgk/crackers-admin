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
                                    <button class="btn btn-light waves-effect" style="position: relative;float: right;" data-bs-toggle="modal" data-bs-target="#AddStaffModel">
                                        Add +
                                    </button>
                                    <h4 class="card-title">Manage Staffs</h4>
                                    <p class="card-title-desc">videos will be displayed from current updation of database.</p>
                                    <table id="staffTable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>New Password</th>
                                            </tr>
                                        </thead>

                                        <tbody id="t-container">
                                            <?php include 'core/Staffs/getstaffs.php' ?>
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

        <!-- Add Staff Modal-->
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="modal fade" id="AddStaffModel" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">
                                Add Video</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="AddStaffForm" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4">Username</label>
                                    <div class="col-8">
                                        <input class="form-control" name="username" type="text" placeholder="Enter Username"  value="" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4">Password</label>
                                    <div class="col-8">
                                        <input class="form-control" name="password" type="password" placeholder="Enter Password"  value="" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Is Admin</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="is_admin" id="is_admin" required>
                                            <option value="staff">No</option>
                                            <option value="admin">Yes</option>
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
        <script>
        
        $('#AddStaffForm').submit(function(e){
            e.preventDefault();
            var formdata=$(this).serialize();
            $.ajax({
                url:'core/Staffs/api-addstaff.php',
                method:'POST',
                data:formdata,
                success:function(response){
                    var response=JSON.parse(response);
                    var modal = $('#AddStaffModel');
                    modal.modal('hide');
                    if(response.status=='1'){
                        $.ajax({
                            type: 'GET',
                            url: "core/Staffs/getstaffs.php",
                            success: function(staffs) {
                                $('#datatable').DataTable().destroy();
                                
                                $('#t-container').html(staffs);

                                // Reinitialize DataTable with the new content
                                $('#datatable').DataTable();
                            }
                            
                        });
                        var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>${response.message}</strong>
                                        </div>`;
                        $('#response').html(success);
                        setTimeout(function() {
                            console.log("called error");
                            $('#response').empty();
                        }, 5000);
                        $('#AddStaffForm')[0].reset();
                    }else{
                        var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>${response.message}</strong>
                                    </div>`;
                        $('#response').html(error);
                    }
                }
            });
        });
        
        function deleteStaff(id){
            var result = confirm("Are you sure you want to Delete ?");
            if(result === true){
                $.ajax({
                url:'core/Staffs/deletestaffs.php',
                method:'GET',
                data:{'id':id},
                success:function(response){
                    var response=JSON.parse(response);
                    if(response.status=='1'){
                        $.ajax({
                            type: 'GET',
                            url: "core/Staffs/getstaffs.php",
                            success: function(staffs) {
                                $('#datatable').DataTable().destroy();
                                
                                $('#t-container').html(staffs);
    
                                // Reinitialize DataTable with the new content
                                $('#datatable').DataTable();
                            }    
                        });
                        var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>Deleted Success</strong>
                                        </div>`;
                        $('#response').html(success);
                    }else{
                        var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                            <strong>${response.message}</strong>
                        </div>`;
                    }
                }
            });   
            }
        }
        
        function update(id){
            var pass=$('#newpass_'+id).val();
            if(pass.length > 0){
                $.ajax({
                    'url' :'core/Staffs/updatepassword.php',
                    'method':'POST',
                    'data':{'id':id,'password':pass},
                    success:function(response){
                        var response=JSON.parse(response);
                        if(response.status == '1'){
                            var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                    <strong>${response.message}</strong>
                                    </div>`;
                            $('#response').html(success);   
                        }else if(response.status == '2'){
                            var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                    <strong>${response.message}</strong>
                                </div>`;
                            $('#response').html(error);
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
                    },
                });   
            }else{
                $('#newpass_'+id).attr('placeholder','Required');
            }
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