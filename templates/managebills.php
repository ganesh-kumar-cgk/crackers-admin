<!doctype html>
<html lang="en">

<?php session_start() ?>

<?php include 'inc/head.php' ?>

<?php include 'core/config.php' ?>
<?php include 'core/Billing/getbills.php' ?>

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
                            <div id='response'></div>
                            <div class="card-body">
                                    <a href="addbill.php" class="btn btn-dark waves-effect" style="position: relative;float: right;">
                                        Add Bill +
                                    </a>
                                    <div id="response">
                                    </div>
                                    <?php if(isset($_SESSION['error']) && $_SESSION['error']){?>
                                    <div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong><?php echo $_SESSION['error']; ?></strong>
                                    </div>
                                    <?php } unset($_SESSION['error']); ?>

                                    <?php if(isset($_SESSION['success']) && $_SESSION['success']){?>
                                    <div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong><?php echo $_SESSION['success']; ?></strong>
                                    </div>
                                    <?php } unset($_SESSION['success']); ?>
                                    
                                    <h4 class="card-title">Manage Bills</h4>
                                    <p class="card-title-desc">Bills will be displayed from current updation of database.</p>
                                    <table id="billTable"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>OrderId</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Billed By</th>
                                            <th>Address</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="t-container">
                                        
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
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Status</label>
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
        
        <script>
    $(document).ready(function(){
        var tbl=$('#billTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'core/Billing/ajax-getbills.php',
            },
            'columns': [
                { data: 'Sno' },
                { data: 'OrderId' },
                { data: 'Name' },
                { data: 'Phone' },
                { data: 'Billed_By' },
                { data: 'Address' },
                { data: 'Total' },
                { data: 'Status' },
                { data: 'Action' },
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
                    url:"core/Billing/updatestatus.php",
                    data:formdata,
                    success: function(response) {
                        console.log(response);
                        var modal = $('#EditProductModal');
                        modal.modal('hide');
                        if(response == true){
                            $('#billTable').DataTable().ajax.reload();
                            var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>Status Updated</strong>
                                        </div>`;
                            $('#response').html(success);
                            setTimeout(function() {
                                console.log("called error");
                                $('#response').empty();
                            }, 5000);
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
                        'url':'core/Billing/api-deletebill.php',
                        'data':{'id':oid},
                        success:function(response){
                            var response=JSON.parse(response);
                            if(response == '1'){
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
                        }
                    });
                }
            }
            
        </script>
        <!-- End Page-content -->

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