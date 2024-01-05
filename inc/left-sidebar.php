<!-- ========== Left Sidebar Start ========== -->

<?php 
    include '../core/config.php';
?>

<div class="vertical-menu" id="left-bar">

<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Main</li>
            <li>
                <a href="index.php" class="waves-effect">
                    <i class="typcn typcn-th-small"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="addbill.php" class="waves-effect">
                    <i class="ti-briefcase"></i>
                    <span>Billing</span>
                </a>
            </li>
            <li>
                <a href="manageorders.php" class="waves-effect">
                    <i class="ti-briefcase"></i>
                    <span>Manage Orders</span>
                </a>
            </li>
            <li>
                <a href="managebills.php">
                    <i class="typcn typcn-th-list-outline"></i>
                    <span>Manage Bills</span>
                </a>
            </li>
            <li>
                <a href="managecategory.php">
                    <i class="typcn typcn-th-list-outline"></i>
                    <span> Manage Category</span>
                </a>
            </li>
            
            <li>
                <a href="manageproduct.php" >
                    <i class="typcn typcn-th-list"></i>
                    <span> Manage Product </span>
                </a>
            </li>
            <?php 
                $q1="select * from panel where page='Gallery'";
                $res1=mysqli_query($conn,$q1);
                $row1=mysqli_fetch_assoc($res1);
                if($row1['status'] == '0'){
            ?>
            <li>
                <a href="managegallery.php">
                    <i class="ti-image"></i>
                    <span> Manage Gallery </span>
                </a>
            </li>
            <li>
                <a href="managecoupons.php">
                    <i class="ti-image"></i>
                    <span> Manage Coupon </span>
                </a>
            </li>
            <li>
                <a href="reports.php">
                    <i class="ti-image"></i>
                    <span> Manage Reports </span>
                </a>
            </li>
            <li>
                <a href="productsupload.php">
                    <i class="ti-image"></i>
                    <span>Upload Bulk Products</span>
                </a>
            </li>
            <?php } ?>
            <?php 
                $q1="select * from panel where page='Banner'";
                $res1=mysqli_query($conn,$q1);
                $row1=mysqli_fetch_assoc($res1);
                if($row1['status'] == '0'){
            ?>
            <li>
                <a href="managebanners.php">
                    <i class="ti-image"></i>
                    <span> Manage Banners </span>
                </a>
            </li>
            <?php } ?>
            <?php 
                $q1="select * from panel where page='Video'";
                $res1=mysqli_query($conn,$q1);
                $row1=mysqli_fetch_assoc($res1);
                if($row1['status'] == '0'){
            ?>
            <li>
                <a href="managevideo.php" >
                    <i class="typcn typcn-video-outline"></i>
                    <span> Manage Video </span>
                </a>
            </li>
            <?php } ?>
            
            <li>
                <a href="managecontactus.php" class="waves-effect">
                    <i class="typcn typcn-mail"></i>
                    <span>Manage Contact Us</span>
                </a>
            </li>
            <li>
                <a href="managepricelist.php" class="waves-effect">
                    <i class="typcn typcn-mail"></i>
                    <span>Manage PriceList</span>
                </a>
            </li>
            <li>
                <a href="managepaymentinfo.php" class="waves-effect">
                    <i class="typcn typcn-mail"></i>
                    <span>Payment Info</span>
                </a>
            </li>


            <li class="menu-title">Extras</li>

            <li>
                <a href="managesite.php" class="waves-effect">
                    <i class="ti-settings"></i>
                    <span>Manage Site Settings</span>
                </a>
            </li>
            <li>
                <a href="managestaffs.php" class="waves-effect">
                    <i class="ti-settings"></i>
                    <span>Manage Staffs</span>
                </a>
            </li>
            
            <li>
                <a href="ranking.php" class="waves-effect">
                    <i class="ti-settings"></i>
                    <span>Manage Ranking</span>
                </a>
            </li>
            <li>
                <a href="managepromotions.php" class="waves-effect">
                    <i class="ti-settings"></i>
                    <span>Promotions</span>
                </a>
            </li>
            <li>
                <a href="panelsettings.php" class="waves-effect">
                    <i class="ti-settings"></i>
                    <span>Manage Panel Settings</span>
                </a>
            </li>

        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>
<!-- Left Sidebar End -->