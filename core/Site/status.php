<?php 
    include  '../config.php';
    
    function statusChange($status){
        global $conn;
        $query="update sitesettings set sales='$status'";
        $result=mysqli_query($conn,$query);
        if($result){
            $response=array('message'=>'Status Change To '.$status,'status'=>true);
            echo json_encode($response);
        }else{
            $response=array('message'=>'Failed','status'=>false);
            echo json_encode($response);
        }
    }
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $status=$_POST['status'];
        statusChange($status);
    }
?>