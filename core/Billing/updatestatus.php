<?php 
    session_start();
    include '../config.php';
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $status=$_POST['status'];
        $id=$_POST['id'];
        $id=str_replace('_', '#', $id);

        $query="Update new_billing set status='$status' where oid='$id'";
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
        $q1="select * from new_billing where oid='$oid'";
        $r1=mysqli_query($conn,$q1);
        while($row=mysqli_fetch_array($r1)){
            $items=json_decode($row['order_items'],true);
            foreach($items as $item){
                $pid=$item['p_id'];
                $qty=$item['qty'];
                $query="UPDATE products SET inventory = inventory - $qty WHERE id = '$pid'";
                $result=mysqli_query($conn,$query);      
            }
        }
    }
?>