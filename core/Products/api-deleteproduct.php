<?php 
    session_start();
    include '../config.php';
    
    $cid=$_GET['pid'];
    deleteProduct('products',$cid);
    
    function deleteProduct($tablename,$cid){
        global $conn;
        $prev="http://localhost/unobi/admin/managecategory.php";
        $query="Delete from $tablename where id='$cid'";
        $result=mysqli_query($conn,$query);
        if($result){
            // $_SESSION['success']='Catgeory Deleted Successfully';
            // echo "<script>location.href=`$prev`;</script>";
            echo true;
        }else{
            // $error = "Failed Reason: " . mysqli_error($conn);
            // $_SESSION['error']=$error;
            // echo "<script>location.href=`$prev`;</script>";
            echo false;
        }
    }
?>