<?php 
    include '../config.php';
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        global $conn;
        $page=$_POST['page'];
        $status=$_POST['status'];
        if($status == 'false'){
            $status=1;
        }else{
            $status=0;
        }
        $query="Update panel set status='$status' where page='$page'";
        $result=mysqli_query($conn,$query);
        if($result){
            echo true;
        }else{
            echo false;
        }
    }
?>