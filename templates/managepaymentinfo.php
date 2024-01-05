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
                                    <h4 class="card-title">Manage Payment Info</h4>
                                    <p class="card-title-desc">Beaware to fill the form carefully.We are not responsible for you providing the details.</p>
                                    <div id="response"></div>
                                    <form method="post" enctype="multipart/form-data" id="paymentForm">
                                        <?php 
                                            $query="select * from payment_info ";
                                            $result=mysqli_query($conn,$query);
                                            $row=mysqli_fetch_array($result);
                                        ?>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Bank name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="bank_name" type="text" value="<?php echo $row['bank_name'] ?>" placeholder="Enter Bank Name" id="example-text-input" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Account Holder name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="acc_holder_name" type="text" value="<?php echo $row['acc_holder_name'] ?>" placeholder="Enter Holder Name" id="example-text-input" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Account Number</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="acc_no" type="text" value="<?php echo $row['acc_no'] ?>" placeholder="Enter Account Number" id="example-text-input" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Bank IFSC Code</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="ifsc_code" type="text" value="<?php echo $row['ifsc_code'] ?>" placeholder="Enter Bank IFSC Code" id="example-text-input" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Branch Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="branch_name" type="text" value="<?php echo $row['branch'] ?>" placeholder="Enter Branch Name" id="example-text-input" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Diplay Name in Google Pay</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="display_name" type="text" value="<?php echo $row['display_name'] ?>" placeholder="Enter Name" id="example-text-input" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Google Pay Numbers</label>
                                            <div class="col-sm-10">
                                                <textarea id="textarea" name="gpay" class="form-control" maxlength="225" rows="3" placeholder="Enter Google pay numbers ! Please enter after each mobile number"><?php 
                                                    // print_r($row['gpay_no']); 
                                                    $gpay=json_decode($row['gpay_no'], true);
                                                    if ($gpay !== null) {
                                                        foreach ($gpay as $item) {
                                                            foreach ($item as $key => $value) {
                                                                echo $value."\n";
                                                            }
                                                        }
                                                    } else {
                                                        echo "No Numbers Found";
                                                    }

                                                ?></textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">PhonePay Numbers</label>
                                            <div class="col-sm-10">
                                                <textarea id="textarea" name="phonepay" class="form-control" maxlength="225" rows="3" placeholder="Enter Phone pay numbers ! Please enter after each mobile number"><?php 
                                                    $ppay=json_decode($row['phonepay_no'], true);
                                                    if ($ppay !== null) {
                                                        foreach ($ppay as $item) {
                                                            foreach ($item as $key => $value) {
                                                                echo $value."\n";
                                                            }
                                                        }
                                                    } else {
                                                        echo "No Numbers Found";
                                                    }
                                                ?></textarea>
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
            <script>
                $('#paymentForm').submit(function(e){
                    e.preventDefault() ;
                    var formData=$(this).serialize();
                    $.ajax({
                        url:'core/Payment/upload.php',
                        type:'POST',
                        data:formData,
                        success:function(response){
                            console.log(response);
                            if(response == true){
                                var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                        <strong>Payment Details Updated</strong>
                                        </div>`;
                                $('#response').html(success);
                            }else{
                                var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>Failed Something Went Wrong</strong>
                                    </div>`;
                            $('#response').html(error);
                            }
                        },
                        error:function(error){
                            console.log(error);
                        }
                    });
                    setTimeout(function() {
                        console.log("called");
                        $('#response').empty();
                    }, 5000);
                });
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