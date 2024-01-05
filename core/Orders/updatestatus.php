<?php 
    include '../config.php';
    
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $status=$_POST['status'];
        $id=$_POST['id'];
        $id=str_replace('_', '#', $id);
        $prev="http://localhost/unobi/admin/manageorders.php";
        $query="Update orders_2024 set status='$status' where timestamp='$id'";
        
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
        $q1="select * from orders_2024 where timestamp='$oid'";
        $r1=mysqli_query($conn,$q1);
        while($ro1=mysqli_fetch_array($r1)){
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