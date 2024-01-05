<?php 
    include '../config.php';
    
    function delete_coupon($id){
        global $conn;
        $query="delete from tbl_coupon where id='$id'";
        $result=mysqli_query($conn,$query);
        if($result){
            $response=array(
                    'message'=>'Deleted Success',
                    'status'=>0
            );
            echo json_encode($response);
        }else{
            $response=array(
                    'message'=>'Failed',
                    'status'=>1,
                    'reason'=>mysqli_error($conn)
            );
            echo json_encode($response);
        }
    }
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        delete_coupon($_POST['cid']);
    }
?>