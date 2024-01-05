<?php

    function getOptions($tablename){
        global $conn;
        $query="Select *from $tablename";
        $result=mysqli_query($conn,$query);
        if($result){
            
        }
        else{
            $error = "Failed Reason: " . mysqli_error($conn);
            echo "<script>alert(`$error`);</script>";
        }
    }
?>