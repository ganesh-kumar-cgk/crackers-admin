<?php 
    
    include '../config.php';
    
    function deletebill($id){
        global $conn;
        $query="update billing set status='5' where oid='$id'";
        // echo $query;
        $result=mysqli_query($conn,$query);
        if(!$result){
            $response=array(
                'status'=>'0',
                'message'=>'Failed to delete',
                'reason'=>mysqli_error($conn)
            );
            echo json_encode($response);
        }else{
            $response=array(
                'status'=>'1',
                'message'=>'Deleted'
            );
            echo json_encode($response);
        }
    }
    deletebill($_GET['id']);
    // print_r($_GET);
?>