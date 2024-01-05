<!doctype html>
<html lang="en">

<?php include 'inc/head.php' ?>

<?php include 'core/OrdersAction/latestOrder.php' ?>
<?php include 'core/Today/today.php' ?>

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
                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-info mt-2"><?php echo(tdyEstimate()); ?></h3> Today Estimate
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-primary mt-2"><?php echo(tdyEstimate()); ?></h3> Today Estimate
                            </div>
                        </div>
                </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-purple mt-2"><?php echo(totalProducts()); ?></h3> Total Products
                            </div>
                        </div>
                </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-danger mt-2"><?php echo(totalBox()); ?></h3> Total Box
                            </div>
                        </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Latest Orders</h4>
                                <div class="table-responsive">
                                    <table class="table mt-4 mb-0 table-centered table-nowrap">
                                        
                                        <tbody>
                                        <?php 
                                            $lo=latest_order("orders",10);
                                            while($row=mysqli_fetch_array($lo)){
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['oid'] ?>
                                                </td>
                                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i>
                                                    <?php if($row['status']=='1'){echo "Ordered";} ?></td>
                                                <td>
                                                    <a href="tel:<?php echo $row['phone'] ?>" class="text-dark"><?php echo $row['phone'] ?> </a>
                                                    <p class="m-0 text-muted">Contact</p>
                                                </td>
                                                <td>
                                                    <?php echo '₹ '.number_format($row['overall_total'],2) ?>
                                                    <p class="m-0 text-muted">Amount</p>
                                                </td>
                                                <td>
                                                    <?php echo $row['date'] ?>
                                                    <p class="m-0 text-muted">Date</p>
                                                </td>
                                                <td>
                                                    <a type="button"
                                                        href="invoice-estimate.php?oid=<?php echo urlencode($row['oid']) ?>" class="btn btn-secondary btn-sm waves-effect" target="_blank">View</a>
                                                </td>
                                            </tr>
                                        <?php 
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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