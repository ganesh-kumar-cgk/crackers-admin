<?php 

    include '../config.php';
    
    function setRank($category,$id,$rank){
        global $conn;
        $query="SELECT COUNT(*) as count FROM products WHERE category='$category' AND rank = '$rank'";
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
        $query="update products set rank='$rank' where id='$id'";
        $result=mysqli_query($conn,$query);
    }
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        // print_r($_POST);
        setRank($_POST['category'],$_POST['pid'],$_POST['rank']);
    }
?>