<?php 
    include '../config.php';
    function getProduct($tablename,$pid){
        global $conn;
        // echo $pid;
        $query="Select * from $tablename where id='$pid'";
        // echo $query;
        $result=mysqli_query($conn,$query);
        if($result){
            $row=mysqli_fetch_array($result);
            echo json_encode($row);
        }else{
            $error = "Failed Reason: " . mysqli_error($conn);
            echo $error;
        }
    }
    // $result=getProduct("products",164);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        getProduct("products",$_POST['pid']);
    }
?>