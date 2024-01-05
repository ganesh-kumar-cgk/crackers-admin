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
                                    <button onclick="bulkMsg()" class="btn btn-light waves-effect" target="_blank" style="position: relative;float: right;">
                                        Send Bulk Message
                                    </button>
                                    <h4 class="card-title">Promotion Message</h4>
                                    <p class="card-title-desc">You are the responsible to chat with your customers.</p>
                                    <div id="response"></div>
                                    <div class="mb-3 row ">
                                        <label>Type Your Message</label>
                                        <textarea id="textarea" name="message" class="form-control" maxlength="1250" rows="3" placeholder="Enter Message to whatsapp" required></textarea>
                                    </div>
                                    <div style="width:100%;overflow-x:scroll;">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Name</th>
                                                    <th>Phone Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $query="SELECT DISTINCT name, phone FROM orders;";
                                                    $result=mysqli_query($conn,$query);
                                                    $sno=1;
                                                    $data=array();
                                                    while($row=mysqli_fetch_array($result)){
                                                        $data[] = $row;
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $sno ?></th>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td>
                                                        <button type="button" onclick="send('<?php echo $row['name'] ?>','<?php echo $row['phone'] ?>')" class="btn btn-success waves-effect waves-light">
                                                            <i class="ion ion-logo-whatsapp"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php $sno++; } $contacts=json_encode($data);?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
            <script>
                function send(name,phoneno){
                    var d=$('#textarea').val().length;
                    if(d>0){
                        var welcome="Hello "+name+" We have a short message for you \n";
                        var message = encodeURIComponent(document.getElementById('textarea').value);
                        var url = "https://wa.me/" + phoneno + "?text=" + welcome+message;
                        window.open(url, '_blank', 'width=600, height=400');
                    }else{
                        var error=`<div class="alert alert-danger bg-danger text-white mb-3" role="alert">
                                    <strong>Message Cannot Be Empty Please Type Any Message !</strong>
                                </div>`;
                        $('#response').html(error);
                    }
                    setTimeout(function() {
                        console.log("called");
                        $('#response').empty();
                    }, 5000);
                }
                
                function bulkMsg(){
                    var data=<?php echo $contacts ?> ;
                    var message = encodeURIComponent(document.getElementById('textarea').value);
                     data.forEach(function(item, index) {
                        setTimeout(function() {
                            var url = "https://wa.me/" + item.phone + "?text=" + encodeURIComponent(message);
                            window.open(url, '_blank', 'width=600, height=400');
                        },10000); // Delay each iteration by 10 seconds (10000 milliseconds)
                    });
                }
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