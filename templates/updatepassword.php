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
                                    <h4 class="card-title">Manage Site</h4>
                                    <p class="card-title-desc">Update The Site Details Now.</p>
                                    <div id="response"></div>
                                    <?php 
                                        $query="select * from admin where id=1";
                                        $result=mysqli_query($conn,$query);
                                        $row=mysqli_fetch_assoc($result);
                                    ?>
                                    <form method="post" id="UpdateForm" enctype="multipart/form-data">                                        
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Old Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="old" name="old_pass" type="password" value="" placeholder="Enter Old Password" id="example-text-input" required>
                                                <i class="fa fa-eye-slash" onclick="show('old')" style="float: right;position: relative;top: -23px;right: 15px;"></i>
                                                <input type="hidden" name="checkpass" id="checkpass" value="<?php echo $row['password'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="new" name="new_pass" type="password" value="" placeholder="Enter New Password" id="example-text-input" required>
                                                <i onclick="show('new')" class="fa fa-eye-slash" style="float: right;position: relative;top: -23px;right: 15px;"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="confirm" name="confirm_pass" type="password" value="" placeholder="Enter Confirm Password" id="example-text-input" required>
                                                <i class="fa fa-eye-slash" onclick="show('confirm')" style="float: right;position: relative;top: -23px;right: 15px;"></i>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-dark waves-effect waves-light">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                            function show(inputId) {
                                var iconElement = document.querySelector('[onclick="show(\'' + inputId + '\')"]');
                                var inputElement = document.getElementById(inputId);
                                if (inputElement.type === "password") {
                                    inputElement.type = "text";
                                    iconElement.classList.remove('fa-eye-slash');
                                    iconElement.classList.add('fa-eye');
                                } else {
                                    inputElement.type = "password";
                                    iconElement.classList.remove('fa-eye');
                                    iconElement.classList.add('fa-eye-slash');
                                }
                            }

                            $('#UpdateForm').submit(function(e){
                                e.preventDefault();
                                var oldpass=$('#old').val();
                                var newpass=$('#new').val();
                                var confirmpass=$('#confirm').val();
                                var checkpass=$('#checkpass').val();
                                if(oldpass != checkpass){
                                    var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>Wrong Old Password</strong>
                                    </div>`;
                                    $('#response').html(error);
                                }
                                
                                if(newpass != confirmpass){
                                    var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                        <strong>Password Miss Match</strong>
                                    </div>`;
                                    $('#response').html(error);
                                }
                                var formData=$(this).serialize();
                                if((oldpass == checkpass) && (newpass == confirmpass)){
                                    $.ajax({
                                        method:'POST',
                                        url:'core/Password/update.php',
                                        data:formData,
                                        success:function(response){
                                            var success=`<div class="alert alert-success bg-success text-white mb-3" role="alert">
                                                        Password Updated
                                                        </div>`;
                                            $('#response').html(success);
                                            $('#UpdateForm')[0].reset();
                                            setTimeout(function() {
                                                location.href="<?php echo $siteurl ?>";
                                                $('#response').empty();
                                            }, 1000);
                                        }
                                    });
                                }
                            });

                        </script>
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