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
                                    <div id="response"></div>
                                    
                                    <button class="btn btn-light waves-effect" style="position: relative;float: right;" data-bs-toggle="modal" data-bs-target="#AddVideoModel">
                                        Add +
                                    </button>
                                    <h4 class="card-title">Manage Ranking</h4>
                                    <p class="card-title-desc">Ranking will be displayed from current updation of database.</p>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Category</th>
                                                <th>Rank</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="t-container">
                                            <?php 
                                                $query="Select * from category ORDER BY id DESC";
                                                $result=mysqli_query($conn,$query);
                                                $sno=1;
                                                while($row=mysqli_fetch_array($result)){
                                                    $id=$row['id'];
                                                    $rank=$row['rank'];
                                                    $cat=$row['name'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $sno; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><input id="rank_<?php echo $id ?>" value="<?php echo $rank ?>" class="w-25" type="number" onchange="setRank('<?php echo $id ?>')" /></td>
                                                    <td><a class="btn btn-sm btn-primary " href="ranking-product.php?id=<?php echo $cat ?>" ><i class='fa fa-cog'></i></a></td>
                                                </tr>
                                            <?php $sno++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <script>
            function setRank(id){
                var rank=$('#rank_'+id).val();
                
                $.ajax({
                    url:'core/Ranking/api-setRank-category.php',
                    method:'POST',
                    data:{'cid':id,'rank':rank},
                    success:function(response){
                        if(response != ''){
                            alert(response);
                        }
                        // console.log(response);
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error: " + error); // Debug: Log AJAX errors
                    }
                });
            }
        </script>
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