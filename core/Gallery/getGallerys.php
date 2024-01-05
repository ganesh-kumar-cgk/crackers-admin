<?php 
    function getGallerys($tablename){
        global $conn;
        $query="Select * from $tablename";
        $result=mysqli_query($conn,$query);
        if($result){
            return $result;
        }else{
            $error = "Failed Reason: " . mysqli_error($conn);
            $_SESSION['error']=$error;
            echo "<script>location.href=`$prev`;</script>";
        }
    }
?>