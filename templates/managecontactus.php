<!doctype html>
<html lang="en">

<?php session_start() ?>

<?php include 'inc/head.php' ?>

<?php include 'core/config.php' ?>
<?php include 'core/Contactus/getcontacts.php' ?>

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
                                
                                    <h4 class="card-title">Manage Contactus</h4>
                                    <p class="card-title-desc">Messages will be displayed from current updation of database.</p>
                                    
                                    
                                    <table id="contactTable"
                                        class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
    
                                        <tbody>
                                        </tbody>
                                    </table>
                                    

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="MessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="message"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                $(document).ready(function(){
                    $('#contactTable').DataTable({
                        'processing': true,
                        'serverSide': true,
                        'serverMethod': 'post',
                        'ajax': {
                            'url': 'core/Contact/ajax-getcontacts.php',
                        },
                        'columns': [
                            { data: 'Sno' },
                            { data: 'Name' },
                            { data: 'Email' },
                            { data: 'Phone' },
                            { data: 'Message' },
                            { data: 'Date' },
                        ],
                        'initComplete': function(settings, json) {
                            console.log(json); // Log the response data
                        }
                    });
                });
                function showMessage(id){
                    $('#MessageModal').modal('show');
                    $('#message').text(message);
                    
                    $.ajax({
                        url:'core/Contact/ajax-getmessage.php',
                        method:'POST',
                        data:{'id':id},
                        success:function(response){
                            $('#message').text(response);
                        },
                        error:function(error){
                            console.log(error);
                        }
                    });
                    
                }
            </script>
            <!-- container-fluid -->
        </div>
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
