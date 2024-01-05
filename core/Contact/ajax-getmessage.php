<?php 
    include '../config.php';
    $id=$_POST['id'];
    $query="select * from contactus where id='$id'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);
    $msg=$row['message'];
    if(count($msg) > 0){
        echo $msg;   
    }else{
        echo "Message is Empty !";
    }
?>