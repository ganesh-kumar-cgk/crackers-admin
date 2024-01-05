<?php 
    session_start();
    if(empty($_SESSION['user'])){
       echo "<script>location.href='login.php'</script>";
    }
    include '../core/config.php';
    $query="select * from sitesettings";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($result);
?>
<header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.php" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/unobi-sm.png" alt="" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/unobi.svg" alt="" height="50">
                        </span>
                    </a>

                    <a href="index.php" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets/images/unobi-sm.png" alt="" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/unobi.svg" alt="" height="50">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="d-none d-sm-block ms-2">
                    <h4 class="page-title font-size-18" id="pgtitle"></h4>
                </div>

            </div>

            <!-- Search input -->
            <div class="search-wrap" id="search-wrap">
                <div class="search-bar">
                    <input class="search-input form-control" placeholder="Search" />
                    <a href="#" class="close-search toggle-search" data-bs-target="#search-wrap">
                        <i class="mdi mdi-close-circle"></i>
                    </a>
                </div>
            </div>

            <div class="d-flex align-items-center">
                
                <div class="" style="background: var(--bs-dash-gradient);padding: 3px 20px;border-radius: 20px;color: white;">
                    <img src="assets/icons/money.svg" alt="wallet" height="30">
                    <label>₹<?php echo (!empty($row['credits'])) ? $row['credits'] : "0"; ?></label>
                </div>
                
                <div class="dropdown d-none d-lg-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block ms-2">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="../images/logo/logo.jpg"
                            alt="Header Avatar">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="updatepassword.php"><i class="dripicons-user font-size-16 align-middle me-2"></i>
                            Update Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="core/Logout/logout.php"><i class="dripicons-exit font-size-16 align-middle me-2"></i>
                            Logout</a>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="mdi mdi-spin mdi-cog"></i>
                    </button>
                </div>

            </div>
        </div>
    </header>
    <script>
        var url = window.location.pathname;
        
        if (url.includes("index")) {
            $('#pgtitle').text("Dashboard");
        }else if(url.includes("manageorders")){
            $('#pgtitle').text("Orders");
        }else if(url.includes("manageproduct.php")){
            $('#pgtitle').text("Products");
        }else if(url.includes("managecategory.php")){
            $('#pgtitle').text("Category");
        }else if(url.includes("addbill")){
            $('#pgtitle').text("Add Bill");
        }else if(url.includes("editbill")){
            $('#pgtitle').text("Edit Bill");
        }else if(url.includes("managebills")){
            $('#pgtitle').text("Bills");
        }else if(url.includes("managegallery")){
            $('#pgtitle').text("Gallery");
        }else if(url.includes("managevideo")){
            $('#pgtitle').text("Videos");
        }else if(url.includes("managesite")){
            $('#pgtitle').text("Site Settings");
        }else if(url.includes("updatepassword")){
            $('#pgtitle').text("Update Password");
        }else if(url.includes("panelsettings")){
            $('#pgtitle').text("Panel Settings");
        }else if(url.includes("managepricelist")){
            $('#pgtitle').text("Manage PriceList");
        }else if(url.includes("managepaymentinfo")){
            $('#pgtitle').text("Payment Info");
        }else if(url.includes("orderedit")){
            $('#pgtitle').text("Edit Estimate");
        }else if(url.includes("managebanners")){
            $('#pgtitle').text("Banners");
        }else if(url.includes("reports")){
            $('#pgtitle').text("Reports");
        }else if(url.includes("productsupload")){
            $('#pgtitle').text("Bulk Upload");
        }else if(url.includes("managecontactus")){
            $('#pgtitle').text("Contact Us");
        }else if(url.includes("managecoupons")){
            $('#pgtitle').text("Coupons");
        }else if(url.includes("managestaffs")){
            $('#pgtitle').text("Staff Management");
        }else if(url.includes("ranking")){
            $('#pgtitle').text("Ranking System");
        }else if(url.includes("managepromotions")){
            $('#pgtitle').text("Promotion");
        }else{
            $('#pgtitle').text("Dashboard");
        }
    </script>
    <script>
        // var state=false;
        // $('#vertical-menu-btn').click(function(e){
        //     console.log(state);
        //     if( state != false){
        //         state=false;
        //         document.getElementById('left-bar').style.display='block';   
        //     }else{
        //         state=true;
        //         document.getElementById('left-bar').style.display='none';   
        //     }
        // });
    </script>