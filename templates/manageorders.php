<!doctype html>
<html lang="en">
<?php session_start() ?>
<?php include 'inc/head.php' ?>

<body data-sidebar="dark">


<!-- Loader -->
<?php include 'inc/loader.php' ?>
<?php include 'core/config.php' ?>
<?php include 'core/Orders/getorders.php' ?>
<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'inc/header.php' ?>

    <!-- ========== Left Sidebar Start ========== -->
    <?php include 'inc/left-sidebar.php' ?>
    <!-- Left Sidebar End -->

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
                                    <h4 class="card-title">Manage Reports</h4>
                                    <p class="card-title-desc">Reports will be displayed from current updation of database.</p>
                                    <div style="width:100%;overflow-x:scroll">
                                        <table id="orderTable" class="table table-striped table-bordered dt-responsive nowrap" 
                                            style="border-collapse: collapse; border-spacing: 0; ;">
                                            <thead>
                                                <tr>
                                                    <th style="width:45px!important">Sno</th>
                                                    <th>OrderId</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Action</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Address</th>
                                                    <th>Email</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                
            </div>
        </div>
        </div>
        
        <!-- Edit Product Modal -->
        <div class="col-sm-6 col-md-4 col-xl-3">

            <div class="modal fade" id="EditProductModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">
                                Update Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="StatusForm" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Category</label>
                                    <div class="col-sm-8 ">
                                        <select class="form-select" id="category" name="status"  required>
                                            <option class='option' value="1">Ordered</option>
                                            <option class='option' value="2" >Pending</option>
                                            <option class='option' value="3">Completed</option>
                                            <option class='option' value="4">Canceled</option>
                                        </select>
                                        <input type="hidden" name="id" id="hid"/>
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
        
    <!-- end main content-->

</div>
<div id="google_translate_element"></div>
<!-- END layout-wrapper -->

<script>
    $(document).ready(function(){
    $('#orderTable').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'core/Orders/ajax-getorders.php',
        },
        'columns': [
            { data: 'Sno' },
            { data: 'OrderId' },
            { data: 'Name' },
            { data: 'Phone' },
            { data: 'Action' },
            { data: 'Status' },
            { data: 'Total' },
            { data: 'Address' },
            { data: 'Email' },
            { data: 'Date' },
        ],
        'initComplete': function(settings, json) {
            console.log(json); // Log the response data
        },
        'pageLength': 50, // Default page length
        'lengthMenu': [50, 100], // Set available page lengths
        'order': [[1, 'desc']] // Sort by the second column (index 1) in ascending order (use 'desc' for descending)
    });
    });

</script>

<script>
            function showalert(id,sts){
                var modal = $('#EditProductModal');
                modal.modal('show');
                console.log(id);
                $('#hid').val(id);
            }
            
            $('#StatusForm').submit(function(e){
                e.preventDefault();
                var formdata=$(this).serialize();
                $.ajax({
                    type: 'POST',
                    url:"core/Orders/updatestatus.php",
                    data:formdata,
                    success: function(response) {
                        console.log(response);
                        var modal = $('#EditProductModal');
                        modal.modal('hide');
                        if(response == true){
                            $('#orderTable').DataTable().ajax.reload();
                            var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>Status Updated</strong>
                                        </div>`;
                            $('#response').html(success);
                            setTimeout(function() {
                                console.log("called success");
                                $('#response').empty();
                            }, 2000);
                        }else{
                            var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>Failed To Update</strong>
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
        </script>
        
<script>
    function show(oid){
        var confirmation = window.confirm('Are you sure you want to delete ?');   
        if (confirmation) {
            $.ajax({
                'method':'GET',
                'url':'core/Orders/api-deleteorder.php',
                'data':{'id':oid},
                success:function(response){
                    var response=JSON.parse(response);
                    if(response == '1'){
                        var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                <strong>${response.message}</strong>
                                </div>`;
                        $('#response').html(success);
                        $('#orderTable').DataTable().destroy();
                        $('#orderTable').DataTable();
                    }else{
                        var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                <strong>${response.message}</strong>
                            </div>`;
                        $('#response').html(error);
                    }
                }
            });
        }
    }
    
</script>

<?php include 'inc/right-sidebar.php' ?>

</body>

</html>