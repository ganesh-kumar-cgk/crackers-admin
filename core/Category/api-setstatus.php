<?php 
    include '../config.php';
    
    function setStatus($id,$sts){
        global $conn;
        if($sts == 'true'){
            $sts="1";
        }else{
            $sts="0";
        }
        $query="update category set status='$sts' where id='$id'";
        $result=mysqli_query($conn,$query);
        if(!$result){
            echo "Error Occur at setStatus";
        }
    }
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        setStatus($_POST['id'],$_POST['status']);
    }
    
?>