<!doctype html>
<html lang="en">
<?php session_start(); ?>
<?php include 'inc/head.php' ?>
<body class="account-bg">

    <?php include 'inc/loader.php' ?>

    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset !important;">
                        <div class="card-body">
                            <div class="p-3">
                                <h4 class="font-size-18 text-muted mt-2 text-center">Welcome Back !</h4>
                                <p class="text-muted text-info mb-4">Sign in to continue to access of <b class="text-info"><?php echo $_SERVER['HTTP_HOST']?></b>.</p>

                                <form class="form-horizontal" method="post" action="core/Password/login.php">
                                    <?php if(isset($_SESSION['error']) && $_SESSION['error']){?>
                                        <div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                            <strong><?php echo $_SESSION['error']; ?></strong>
                                        </div>
                                    <?php } unset($_SESSION['error']); ?>
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Enter username">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="userpassword"
                                            placeholder="Enter password" name="password" >
                                        <i onclick="show('userpassword')" class="fa fa-eye-slash" style="float: right;position: relative;top: -23px;right: 15px;"></i>
                                    </div>

                                    <div class="mb-3 row mt-4 d-flex justify-content-center">
                                        <div class="col-sm-6 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light"
                                                type="submit">Log In</button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
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
    </script>
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>