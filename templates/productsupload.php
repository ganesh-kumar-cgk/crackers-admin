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
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title">Products Upload</h4>
                                            <p class="card-title-desc">Be carefull Please Upload Correct Format File.</p>
                                        </div>
                                        <div>
                                            <a href="../admin/assets/csv/sample.csv" download="sample.csv" class="btn btn-dark"><i class="fas fa-cloud-download-alt"></i></a>
                                        </div>
                                    </div>
                                    <form method="post" enctype="multipart/form-data" id="ProductForm">
                                        <div class="d-flex align-items-center row mb-2">
                                            <div class="col-lg-6 col-sm-10">
                                                <label class="form-label">File</label>
                                                <input type="file" name="productlist" class="filestyle" data-buttonname="btn-secondary" required>
                                            </div>
                                            <div class="col-lg-6 col-sm-2 mt-3 position-realtive">
                                                <div id="progress">
                                                    <img src="../admin/assets/upload.gif" style="width:55px; height:35px"/>
                                                    <p style="font-size:10px;">Uploading..</p>
                                                </div>
                                                <div id="complete">
                                                    <span class="badge bg-success">Success</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-dark waves-effect waves-light">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <script>
        $(document).ready(function () {
            $('#progress').hide();
            $('#complete').hide();
            $('#ProductForm').submit(function(e){
               e.preventDefault() ;
               $('#progress').show();
               var formdata = new FormData(this);
               $.ajax({
                    url:'core/Products/api-bulkupload.php',
                    method:'POST',
                    data:formdata,
                    cache:false,
                    processData:false,
                    contentType:false,
                    success:function(response){
                        console.log(response);
                        var response=JSON.parse(response);
                        if(response.status == '1'){
                            $('#progress').hide();
                            $('#complete').show();
                        }else{
                            var error=`<div class="alert alert-danger bg-danger text-white mb-0" role="alert">
                                        <strong>${response.message}</strong>
                                    </div>`;
                            $('#response').html(error);
                        }
                    }
                });
            });
        });
    function updateProgress(status, message) {
        // Update your progress bar or display a message here
        console.log(`Status: ${status}, Message: ${message}`);
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