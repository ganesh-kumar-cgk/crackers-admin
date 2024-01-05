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
                                    <h4 class="card-title">Manage Banners</h4>
                                    <p class="card-title-desc">Banners will be displayed from current updation of database.</p>
                                    <?php 
                                        $query="Select * from banners ";
                                        $result=mysqli_query($conn,$query);
                                        if(mysqli_num_rows($result) <= 0){
                                                echo "<div class='text-center'><label class='text-danger'>No banners Found</label></div>";
                                        }else{
                                    ?>
                                    <div id="carouselExampleCaption" class="carousel slide border border-primary p-2" data-bs-ride="carousel">
                                        <div class="carousel-inner" role="listbox" style="height:400px;">
                                        <?php 
                                            $index=0;
                                            while($row=mysqli_fetch_array($result)){
                                                $id=$row['id'];
                                        ?>
                                            <div class="carousel-item <?php if($index==0) echo 'active' ?>">
                                                <a onclick="showConfirm('<?php echo $id ?>')" class="btn btn-danger float-right" style="right: 2px;position: absolute;"><i class="fa fa-trash"></i></a>
                                                <img src="<?php echo $mainurl ?>images/banners/<?php echo $row['image'] ?>" alt="..." class="img-fluid w-100 mx-auto d-block" style="height:400px;object-fit:cover;background-repeat:no repeat;">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h3 class="text-dark"><?php echo $row['title'] ?></h3>
                                                </div>
                                            </div>
                                            
                                        <?php } ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleCaption" role="button" data-bs-slide="prev" style="position: absolute;left: 30px;">
                                            <img src="assets/images/leftArrow.svg" style="height:50px" />
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next text-dark" href="#carouselExampleCaption" role="button" data-bs-slide="next" style="position: absolute;right: 30px;">
                                            <img src="assets/images/rightArrow.svg" style="height:50px" />
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                        <?php } ?>
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
                        location.href="<?php echo $siteurl ?>core/Banner/delete.php?id="+id;
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
                            <form method="post" action="core/Banner/uploadbanner.php" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4">Image</label>
                                    <div class="col-8">
                                        <input type="file" name="bimage" id="bimage" class="filestyle" data-buttonname="btn-secondary" required>
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