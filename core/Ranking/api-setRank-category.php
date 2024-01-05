<?php 

    include '../config.php';
    
    function setRank($id,$rank){
        global $conn;
        $query="SELECT COUNT(*) as count FROM category WHERE rank = '$rank'";
        $result=mysqli_query($conn,$query);
        if ($result === false) {
            echo "Error: " . mysqli_error($conn);
        } else {
            $row = mysqli_fetch_array($result);
            if($row['count'] > 0){
                echo "Already Rank Exists";
            }else{
                update($id,$rank);
            }
        }
    }
    
    function update($id,$rank){
        global $conn;
        $query="update category set rank='$rank' where id='$id'";
        $result=mysqli_query($conn,$query);
    }
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        setRank($_POST['cid'],$_POST['rank']);
    }
?>