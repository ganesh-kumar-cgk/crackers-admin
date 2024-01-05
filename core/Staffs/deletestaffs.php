<?php 
    
    include '../config.php';
    
    function deleteStaff($id){
        global $conn;
        if($conn){
            $query="delete from admin where id='$id'";
            $result=mysqli_query($conn,$query);
            if($result){
                $response=array(
                    'status'=>'1',
                    'message'=>"Staff Deleted"
                );
                echo json_encode($response);
            }else{
                $response=array(
                    'status'=>'0',
                    'message'=>"Something Went Wrong"
                );
                echo json_encode($response);
            }   
        }
    }
    
    deleteStaff($_GET['id']);
        
?>