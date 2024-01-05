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
    
    <style>
        .coupon-card{
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        }
        .coupon-card .discount{
            width: 100px;height: 100px;
            border-radius: 50%;
            border: 1px solid;
            background: #0a213a;
            color: white;
        }
        .coupon-card .min{
            color: #113c68;
            font-weight: 900;
            text-align:right !important;
        }
    </style>
    
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="response"></div>
                                    <button class="btn btn-light waves-effect" style="position: relative;float: right;" data-bs-toggle="modal" data-bs-target="#AddCouponModel">
                                        Add +
                                    </button>
                                    <h4 class="card-title">Manage Coupons</h4>
                                    <p class="card-title-desc">Update The Coupons Details Now.</p>
                                    <div class="d-flex flex-row flex-wrap gap-5" id="CouponCards">
                                        <?php 
                                            $query="select * from tbl_coupon";
                                            $result=mysqli_query($conn,$query);
                                            while($row=mysqli_fetch_array($result)){
                                                $id=$row['id'];
                                                $code=$row['coupon_code'];
                                                $profit=$row['profit'];
                                                $name=$row['owner_name'];
                                                $password=$row['password'];
                                        ?>
                                        <div class="card coupon-card">
                                            <div class="d-flex flex-row justify-content-center align-items-center p-3">
                                                <div class="d-flex flex-row justify-content-center align-items-center discount">
                                                    <label class="font-size-24"><?php echo $row['discount'] ?>%</label>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex gap-4">
                                                    <div>
                                                        <label class="text-decoration-underline">Code</label>
                                                        <p><b><?php echo $row['coupon_code'] ?></b></p>
                                                    </div>
                                                    <div>
                                                        <label class="text-decoration-underline">Profit</label>
                                                        <p class="min">₹<?php echo $row['profit'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <label>Owner Name: <?php echo $row['owner_name']; ?></label>
                                                </div>
                                                <div class="">
                                                    <label>Password: <?php echo $row['password'] ?></label>
                                                </div>
                                                <div class="text-center">
                                                    <button onclick="copy('<?php echo $code ?>','<?php echo $name ?>','<?php echo $password ?>','<?php echo $profit ?>')" class="btn btn-dark btn-block"><i class="fa fa-share-alt"></i></button>
                                                </div>
                                            </div>
                                            <div class="position-absolute p-2" style="right:0;">
                                                <button onclick="deletecoupon('<?php echo $id ?>')" type="button" class="btn btn-dark"><i class="fa fa-trash text-danger"></i></button>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-3">
                                    <div class="modal fade" id="AddCouponModel" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">
                                                        Add Coupon</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" id="AddCouponForm" enctype="multipart/form-data">
                                                        <div class="mb-3 row">
                                                            <label class="col-form-label col-sm-4">Coupon Code</label>
                                                            <div class="col-8">
                                                                <input class="form-control" name="coupon_code" type="text" placeholder="Enter Coupon Code"  value="" id="example-text-input" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-form-label col-sm-4">Owner Name:</label>
                                                            <div class="col-8">
                                                                <input class="form-control" name="owner_name" type="text" placeholder="Enter Name"  value="" id="example-text-input" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-form-label col-sm-4">Password:</label>
                                                            <div class="col-8">
                                                                <input class="form-control" name="password" type="password" placeholder="Enter Password"  value="" id="example-text-input" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-form-label col-sm-4">Coupon Discount</label>
                                                            <div class="col-8">
                                                                <input class="form-control" name="coupon_discount" type="text" placeholder="Enter Coupon Discount"  value="" id="example-text-input" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-form-label col-sm-4">Profit</label>
                                                            <div class="col-8">
                                                                <input class="form-control" name="profit" type="text" placeholder="Enter Profit"  value="" id="example-text-input" required>
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
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                
                    $('#AddCouponForm').submit(function(e){
                        e.preventDefault();
                        var formdata=$(this).serialize();
                        $.ajax({
                            url:'core/Coupon/api-addcoupon.php',
                            method:'POST',
                            data:formdata,
                            success:function(response){
                                $('#AddCouponModel').modal('hide');
                                console.log(response);
                                var response=JSON.parse(response);
                                if(response.status == 0){
                                    var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                                    <strong>${response.message}</strong>
                                                </div>`;
                                    $('#response').html(success);
                                    $('#CouponCards').load(location.href + ' #CouponCards');
                                }else{
                                    var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                                <strong>${response.message}</strong>
                                            </div>`;
                                    $('#response').html(error);
                                }
                            },
                            error:function(error){
                                console.log(error);
                            }
                        });
                        setTimeout(function() {
                            console.log("called error");
                            $('#response').empty();
                        }, 5000);
                    });
                    
                    function deletecoupon(id){
                        var confirmation=confirm("Are You Sure to Delete");
                        if(confirmation){
                            $.ajax({
                                url:'core/Coupon/api-deletecoupon.php',
                                method:'POST',
                                data:{'cid':id},
                                success:function(response){
                                    console.log(response);
                                    var response=JSON.parse(response);
                                    if(response.status == 0){
                                        var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                                        <strong>${response.message}</strong>
                                                    </div>`;
                                        $('#response').html(success);
                                        $('#CouponCards').load(location.href + ' #CouponCards');
                                    }else{
                                        var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                                    <strong>${response.message}</strong>
                                                </div>`;
                                        $('#response').html(error);
                                    }
                                },
                                error:function(error){
                                    console.log(error);
                                }
                            });
                            setTimeout(function() {
                                console.log("called error");
                                $('#response').empty();
                            }, 5000);   
                        }
                    }
                    
                    function copy(code,name,password,profit){
                        var msg="Coupon Code:"+code+"\nName:"+name+"\nPassword:"+password+"\nProfit:"+profit;
                        console.log(msg);
                        navigator.clipboard.writeText(msg)
                        .then(function() {
                            alert('Text has been copied to the clipboard');
                        })
                        .catch(function(err) {
                            console.error('Unable to copy', err);
                        });
                    }
                    
                </script>
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