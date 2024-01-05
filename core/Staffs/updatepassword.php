<?php 

    include '../config.php';
    
    function updatePassword($id,$password){
        global $conn;
        if($conn){
            $query="update admin SET password='$password' where id='$id'";
            $result=mysqli_query($conn,$query);
            if($result){
                $response=array(
                    'status'=>'1',
                    'message'=>"Updated"
                );
                echo json_encode($response);
            }else{
                $response=array(
                    'status'=>'0',
                    'message'=>"Something went wrong"
                );
                echo json_encode($response);
            }   
        }else{
            $response=array(
                'status'=>'2',
                'message'=>"Connection Error"
            );
            echo json_encode($response);
        }
    }
    updatePassword($_POST['id'],$_POST['password']);
    
?>