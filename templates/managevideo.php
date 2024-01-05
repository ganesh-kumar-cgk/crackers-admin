<!doctype html>
<html lang="en">

<?php session_start() ?>

<?php include 'inc/head.php' ?>

<?php include 'core/config.php' ?>
<?php include 'core/Video/getvideos.php' ?>

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
                                    
                                    <button class="btn btn-light waves-effect" style="position: relative;float: right;" data-bs-toggle="modal" data-bs-target="#AddVideoModel">
                                        Add +
                                    </button>
                                    <h4 class="card-title">Manage Videos</h4>
                                    <p class="card-title-desc">videos will be displayed from current updation of database.</p>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                            </tr>
                                        </thead>

                                        <tbody id="t-container">
                                            <?php echo getVideos('videos'); ?>
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

        <!-- Add Video Modal-->
        <div class="col-sm-6 col-md-4 col-xl-3">

            <div class="modal fade" id="AddVideoModel" tabindex="-1" role="dialog"
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
                            <form method="post" action="core/Video/uploadvideo.php" id="AddVideoForm" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4">Video Url</label>
                                    <div class="col-8">
                                        <input class="form-control" name="url" type="url" placeholder="Enter Youtube Url"  value="" id="example-text-input" required>
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
        $('#AddVideoForm').submit(function(e){
            e.preventDefault();
            var formdata=$(this).serialize();
            $.ajax({
                url:'core/Video/api-addvideo.php',
                method:'POST',
                data:formdata,
                success:function(response){
                    console.log(response);
                    var modal = $('#AddVideoModel');
                    modal.modal('hide');
                    if(response==true){
                        var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>Url Added</strong>
                                        </div>`;
                        $('#response').html(success);
                        $.ajax({
                            type: 'GET',
                            url: "core/Video/api-getvideos.php",
                            success: function(videos) {
                                $('#datatable').DataTable().destroy();
                                
                                $('#t-container').html(videos);

                                // Reinitialize DataTable with the new content
                                $('#datatable').DataTable();
                            }    
                        });
                        setTimeout(function() {
                            console.log("called error");
                            $('#response').empty();
                        }, 5000);
                        $('#AddVideoForm')[0].reset();
                    }
                }
            });
        });
        function deleteProduct(id){
            var result = confirm("Are you sure you want to Delete ?");
            if(result === true){
                $.ajax({
                url:'core/Video/api-deletevideo.php',
                method:'GET',
                data:{'id':id},
                success:function(response){
                    console.log(response);
                    if(response==true){
                        var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>Deleted Success </strong>
                                        </div>`;
                        $('#response').html(success);
                        $.ajax({
                            type: 'GET',
                            url: "core/Video/api-getvideos.php",
                            success: function(videos) {
                                $('#datatable').DataTable().destroy();
                                
                                $('#t-container').html(videos);

                                // Reinitialize DataTable with the new content
                                $('#datatable').DataTable();
                            }    
                        });
                    }
                }
            });   
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