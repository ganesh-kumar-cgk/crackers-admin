<?php 
    include '../config.php';
    $color=$_POST['color'];
    $id="1";
    $query="Insert into pdf_settings (id,color) Values('$id','$color') ON DUPLICATE KEY UPDATE color = '$color'";
    $result=mysqli_query($conn,$query);
    if($result){
        echo true;
    }else{
        echo false;
    }
?>