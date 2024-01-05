<?php 
    session_start();
    
    include '../config.php';
    
    function uploadCategory($tablename="",$cname,$discount){
        global $conn;
        $prev="http://localhost/unobi/admin/managecategory.php";
        if(!empty($tablename)){
            $query="Insert into $tablename(name,discount) Values('$cname','$discount')";
            $result=mysqli_query($conn,$query);
            if($result){
                // $_SESSION['success']='Category Added Successfully';
                // echo "<script>location.href=`$prev`;</script>";
                echo true;
            }else{
                // $error = "Failed Reason: " . mysqli_error($conn);
                // $_SESSION['error']=$error;
                // echo "<script>location.href=`$prev`;</script>";
                echo false;
            }
        }else{
            $error = "Table Name does not be empty";
            echo "<script>alert(`$error`);</script>";
        }
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $cname=$_POST['cname'];
        $discount=$_POST['discount'];
        uploadCategory('category',$cname,$discount);
    }
?>