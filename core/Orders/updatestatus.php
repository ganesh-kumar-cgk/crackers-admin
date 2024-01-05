<?php 
    include '../config.php';
    
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $status=$_POST['status'];
        $id=$_POST['id'];
        $id=str_replace('_', '#', $id);
        $prev="http://localhost/unobi/admin/manageorders.php";
        $query="Update orders set status='$status' where oid='$id'";
        
        $result=mysqli_query($conn,$query);
        
        if($result){
            if($status == "3"){
                stock_maintain($id);
            }
            echo true;
        }else{
            echo "Failed Reason".mysqli_error($conn);
        }
        
    }
    
    function stock_maintain($oid){
        global $conn;
        $q1="select * from orders where oid='$oid'";
        $r1=mysqli_query($conn,$q1);
        while($ro1=mysqli_fetch_array($r1)){
            $p_id=$ro1['p_id'];
            $qty=$ro1['quantity'];
            $query="UPDATE products SET stock = stock - $qty WHERE id = '$p_id'";
            $result=mysqli_query($conn,$query);   
        }
    }
?>