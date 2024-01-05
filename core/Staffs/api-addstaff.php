<?php 

    include '../config.php';
    
    function addstaff($username,$password,$is_admin){
        global $conn;
        $query="Insert Into admin(email,password,is_superuser,is_active) Values('$username','$password','$is_admin','inactive')";
        $result=mysqli_query($conn,$query);
        if($result){
            $response=array(
                'status'=>'1',
                'message'=>"Staff Created"
            );
            echo json_encode($response);
        }else{
            $response=array(
                'status'=>'0',
                'message'=>"Failed To Created"
            );
            echo json_encode($response);
        }
    }
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        addStaff($_POST['username'],$_POST['password'],$_POST['is_admin']);   
    }
    // print_r($_POST);
?>