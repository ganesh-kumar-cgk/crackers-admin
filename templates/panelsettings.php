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
                                    <h4 class="card-title">Manage Panel</h4>
                                    <p class="card-title-desc">Site will be affected please carefull.</p>
                                    <div id="response">
                                        
                                    </div>
                                    <div class="col-6">
                                        <table class="table table-striped">
                                            <tbody>
                                                <?php 
                                                    $query="select * from panel";
                                                    $result=mysqli_query($conn,$query);
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['page'] ?></td>
                                                    <td>
                                                        <?php 
                                                            if($row['status'] == 0){
                                                        ?>
                                                        <input type="checkbox" id="<?php echo $row['page'] ?>-switch" switch="<?php echo $row['page'] ?>" checked="">
                                                        <label for="<?php echo $row['page'] ?>-switch" data-on-label="On" data-off-label="Off"></label>   
                                                        <?php }else {?>
                                                        <input type="checkbox" id="<?php echo $row['page'] ?>-switch" switch="<?php echo $row['page'] ?>">
                                                        <label for="<?php echo $row['page'] ?>-switch" data-on-label="Off" data-off-label="On"></label>
                                                        <?php } ?>

                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td>
                                                        Pdf Color
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-4">
                                                            <input type="text" class="form-control" id="colorpicker-showinput-intial">
                                                            <button class="btn btn-dark"><i class="ion ion-md-done-all" onclick="setColor()"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
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
            <!-- container-fluid -->
        
            <script>
                $(document).ready(function() {
                    $('#Banner-switch').on('change', function() {
                        // console.log("Changed Banner");
                        // console.log($(this).prop('checked'));
                        // console.log($(this).attr('switch'));
                        sendData($(this).attr('switch'),$(this).prop('checked'));
                    });
                
                    $('#Gallery-switch').on('change', function() {
                        // console.log("Changed Gallery");
                        // console.log($(this).prop('checked'));
                        // console.log($(this).attr('switch'));
                        sendData($(this).attr('switch'),$(this).prop('checked'));
                    });
                    
                    $('#Video-switch').on('change', function() {
                        // console.log("Changed Gallery");
                        // console.log($(this).prop('checked'));
                        // console.log($(this).attr('switch'));
                        sendData($(this).attr('switch'),$(this).prop('checked'));
                    });
                    
                    function sendData(page, status) {
                        console.log(page, status);
                        $.ajax({
                            url: 'core/Panel/change.php',
                            type: 'POST',
                            data: { 'page': page, 'status': status },
                            success: function(response) {
                                console.log(response);
                                if(response == true){
                                    var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                                        Status Updated
                                                </div>`;
                                    $('#response').html(success);
                                    $('#left-bar').load(location.href + ' #left-bar');
                                }else{
                                    var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>Failed To Update</strong>
                                    </div>`;
                                    $('#response').html(error);
                                }
                            },
                            error: function(error) {
                                console.error('Error:', error);
                            }
                            
                        });
                        setTimeout(function() {
                            console.log("called");
                            $('#response').empty();
                        }, 2000);
                    }
                });
            </script>    
            <script>
                function setColor(){
                    var color=$('#colorpicker-showinput-intial').val();
                    $.ajax({
                        url:'core/Panel/setcolor.php' ,
                        method:'POST',
                        data:{'color':color},
                        success:function(response){
                            if(response == true){
                                var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>Updated</strong>
                                    </div>`;
                                $('#response').html(success);
                            }else{
                                var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>Failed</strong>
                                    </div>`;
                                $('#response').html(error);
                            }
                        }
                    });
                    setTimeout(function() {
                        console.log("called error");
                        $('#response').empty();
                    }, 5000);
                }
            </script>
        </div>
        <!-- End Page-content -->

        <!-- Add Gallery Modal-->
        <div class="col-sm-6 col-md-4 col-xl-3">

            <div class="modal fade" id="AddGalleryModal" tabindex="-1" role="dialog"
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
                            <form method="post" action="core/Gallery/uploadGallery.php" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Image Title</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="gname" type="text" placeholder="Enter Image title"  value="" id="example-text-input" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4">Image</label>
                                    <div class="col-8">
                                        <input type="file" name="gimage" id="gimage" class="filestyle" data-buttonname="btn-secondary" required>
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