<!doctype html>
<html lang="en">

<?php session_start() ?>

<?php include 'inc/head.php' ?>

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
                                    
                                    <h4 class="card-title">Manage Site</h4>
                                    <p class="card-title-desc">Update The Site Details Now.</p>
                                    <form method="post" action="core/Site/upload.php" enctype="multipart/form-data">
                                        <?php 
                                            $query="select * from sitesettings where id=1";
                                            $result=mysqli_query($conn,$query);
                                            $row=mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Site name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="site_name" type="text" value="<?php echo $row['site_name']?>" placeholder="Enter Site Name" id="example-text-input" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Site Number</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="site_number" type="tel" value="<?php echo $row['site_number']?>" placeholder="Enter Phone Number" id="example-text-input" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Whatsapp Number</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="site_whatsapp_number" type="tel" value="<?php echo $row['site_whatsapp_number']?>" placeholder="Enter Whatsapp Number" id="example-text-input" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Site Email</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="site_email" type="email" value="<?php echo $row['site_email']?>" placeholder="Enter Email Address" id="example-text-input" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Youtube Link</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="site_youtube" type="url" value="<?php echo $row['site_youtube']?>" placeholder="Enter Youtube Url" id="example-text-input" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Facebook Link</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="site_facebook" type="url" value="<?php echo $row['site_facebook']?>" placeholder="Enter Facebook Url" id="example-text-input" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Instagram Link</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="site_instagram" type="url" value="<?php echo $row['site_instagram']?>" placeholder="Enter Instagram Url" id="example-text-input" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Twitter Link</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="site_twitter" type="url" value="<?php echo $row['site_twitter']?>" placeholder="Enter Twitter Url" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Site Discount</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="site_discount" type="number" value="<?php echo $row['site_discount']?>" placeholder="Enter Site Discount" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Site Map Url</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="site_map" type="text" value="<?php echo $row['site_map']?>" placeholder="Enter Map Url" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Site Modal Content</label>
                                            <div class="col-sm-10">
                                            <textarea id="textarea" class="form-control" name="site_modal_content" maxlength="500" rows="3" placeholder="Enter Modal Content limit of 225 chars."><?php echo $row['site_modal_content']?></textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="form-label col-sm-2">Site Minimum Order</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="number" name="site_minimum_orders" value="<?php echo $row['site_minimum_orders']?>" placeholder="Enter Minimum Site Order" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Gift Box Minimum Amount</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="number" name="site_gift_minimum_orders" value="<?php echo $row['site_gift_minimum_orders']?>" placeholder="Enter Minium Gift Box " id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="form-label col-sm-2">Site Logo</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="site_logo" class="filestyle" data-buttonname="btn-secondary">
                                                <div class="border border border-primary p-1 w-25 mt-2">
                                                    <img src="<?php echo $mainurl ?>images/logo/logo.jpg" style="width:100%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="form-label col-sm-2">Site Address</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="site_address" value="<?php echo $row['site_address']?>" placeholder="Enter Site Address" id="example-text-input">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-dark waves-effect waves-light">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card" id="statusCard">
                                <div class="card-body col-md-4">
                                    <div id="response"></div>
                                    <table class="table table-striped">
                                        <tbody>
                                            <?php 
                                                $query="select sales from sitesettings";
                                                $result=mysqli_query($conn,$query);
                                                $row=mysqli_fetch_assoc($result);
                                            ?>
                                            <tr>
                                                <td>Sales Status </td>
                                                <td>
                                                    <input type="checkbox" id="Sales-switch" switch="Sales-switch"  <?php echo $row['sales'] == "on" ? 'checked' : ''; ?> >
                                                    <label for="Sales-switch" data-on-label="on" data-off-label="off"></label>  
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <script>
                                    
                                        
                                    $(document).on('change', '#Sales-switch', function() {
                                        sendData($(this).prop('checked'));
                                    });
                                    
                                    
                                     function sendData(status) {
                                        $.ajax({
                                            url: 'core/Site/status.php',
                                            type: 'POST',
                                            data: {'status': status?"on":"off" },
                                            success: function(response) {
                                                console.log(response);
                                                var response=JSON.parse(response);
                                                if(response.status == true){
                                                    var msg=response.message;
                                                    var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                                                        ${msg}
                                                                </div>`;
                                                    $('#response').html(success);
                                                    $('#statusCard').load(location.href + ' #statusCard');
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
                                    }
                                </script>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
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