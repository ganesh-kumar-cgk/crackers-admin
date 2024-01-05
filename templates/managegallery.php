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
                                    <button class="btn btn-light waves-effect" style="position: relative;float: right;" data-bs-toggle="modal" data-bs-target="#AddGalleryModal">
                                        Add +
                                    </button>
                                    <h4 class="card-title">Manage Gallery</h4>
                                    <p class="card-title-desc">Gallery will be displayed from current updation of database.</p>
                                    <div class="row">
                                        <?php 
                                            $query="Select * from gallery ";
                                            $result=mysqli_query($conn,$query);
                                            if(mysqli_num_rows($result) <= 0){
                                                echo "<div class='text-center'><label class='text-danger'>No Gallery Images</label></div>";
                                            }else{
                                                while($row=mysqli_fetch_array($result)){
                                        ?>
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title"><?php echo $row['title']; ?></h4>
                                                    <div>
                                                        <img src="<?php echo $mainurl; ?>images/gallery/<?php echo $row['image'] ?>" class="img-fluid" alt="Responsive image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
            <script>
                function showConfirm(id){
                    console.log(id);
                    var result=confirm("Are you sure to delete ?");
                    if(result === true){
                        location.href="<?php echo $siteurl ?>core/Gallery/deleteGallery.php?id="+id;
                    }
                }
            </script>
            <!-- container-fluid -->
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