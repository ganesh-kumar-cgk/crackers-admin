<?php 
    session_start();
    include '../config.php';
    $newpass=$_POST['new_pass'];
    $query="Update admin set password='$newpass' where id=1";
    $result=mysqli_query($conn,$query);
    if($result){
        echo "Password Updated";
        $_SESSION['user']="";
    }else{
        echo "Somethig Went Worng";
    }
?>