<?php 
    function latest_order($tablename,$limit){
        global $conn;
        if(!empty($limit) || $limit !=0){
            $query="Select * From $tablename  where status=1 ORDER BY oid DESC LIMIT $limit";   
        }else{
            $query="Select * From $tablename  where status=1 ORDER BY oid DESC LIMIT 10";   
        }
        $result=mysqli_query($conn,$query);
        if($result){
            return $result;
        }else{
            $error = "Failed Reason: " . mysqli_error($conn);
            echo "<script>alert(`$error`);</script>";
        }
    }
?>