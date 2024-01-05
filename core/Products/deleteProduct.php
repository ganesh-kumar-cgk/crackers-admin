<?php 
    session_start();
    include '../config.php';
    $pid=$_GET['id'];
    deleteProduct('products',$pid);
    function deleteProduct($tablename,$pid){
        global $conn;
        $prev="http://localhost/unobi/admin/manageproduct.php";
        $query="Delete from $tablename where id='$pid'";
        $result=mysqli_query($conn,$query);
        if($result){
            $_SESSION['success']='Product Deleted Successfully';
            echo "<script>location.href=`$prev`;</script>";
        }else{
            $error = "Failed Reason: " . mysqli_error($conn);
            $_SESSION['error']=$error;
            echo "<script>location.href=`$prev`;</script>";
        }
    }
?>