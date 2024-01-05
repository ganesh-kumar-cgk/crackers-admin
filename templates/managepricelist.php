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
                                    <a href="core/PriceList/generate.php" class="btn btn-light waves-effect" target="_blank" style="position: relative;float: right;">
                                        Generate
                                    </a>
                                    <h4 class="card-title">Manage PriceList</h4>
                                    <p class="card-title-desc">Update The Pricelist Or Add New.</p>
                                    <div id="response"></div>
                                    <form method="post" enctype="multipart/form-data" class="col-6" id="priceForm">
                                        <div class="mb-3 row">
                                            <label class="form-label col-sm-2">PriceList</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="pricelist" class="filestyle" data-buttonname="btn-secondary" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-dark waves-effect waves-light">Submit</button>
                                    </form>
                                    <div id="PriceContent">
                                        <?php 
                                            $query="select * from pricelist";
                                            $result=mysqli_query($conn,$query);
                                            if(mysqli_num_rows($result) > 0){
                                                $row=mysqli_fetch_array($result);
                                                $name=$row['pricelist'];
                                        ?>
                                        <div class="mt-2">
                                            <iframe src="<?php echo $mainurl ?>pricelist/<?php echo $name ?>"></iframe>
                                        </div>
                                        <?php } else{
                                        ?>
                                        <div class="mt-2 text-center">
                                            <label class="text-danger">Price list Still Not Uploaded !</label>
                                        </div>
                                        <?php
                                        }?>
                                    </div>
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
            $('#priceForm').submit(function(e){
               e.preventDefault() ;
               var formdata = new FormData(this);
               $.ajax({
                    url:'core/PriceList/api-uploadpricelist.php',
                    method:'POST',
                    // dataType:"JSON",
                    data:formdata,
                    cache:false,
                    processData:false,
                    contentType:false,
                    success:function(response){
                        console.log(response);
                        if(response =="uploaded"){
                            var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>PriceList Updated</strong>
                                        </div>`;
                            $('#response').html(success);
                            $('#PriceContent').load(location.href + ' #PriceContent');
                            console.log("Pricelist uploaded");
                        }else{
                            var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>File size exceeded please upload below 5mb.</strong>
                                    </div>`;
                            $('#response').html(error);
                            console.log("File size exceeded please upload below 5mb");
                        }
                        setTimeout(function() {
                            console.log("called error");
                            $('#response').empty();
                        }, 5000);
                    }
                });
            });
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