<?php 
    include 'config.php';
    
    function createUser($email,$password,$tbname){
        global $conn;
        $query="Insert into $tbname(email,password) Values('$email','$password')";
        $result=mysqli_query($conn,$query);
        if(!$result){
            $error = "Failed Reason: " . mysqli_error($conn);
            echo "<script>alert(`$error`);</script>";
        }
    }
    // create_user('anwarmydheen.l@gmal.com','anwar@123','anwar');

    function insertProduct($tbname,$name,$category,$mrp,$selling_price,$image,$video,$type,$status,$discount){
        global $conn;
        $query="Insert into $tbname(name,category,mrp,selling_price,image,video,type,status,discount) Values('$name','$category','$mrp','$selling_price','$image','$video','$type','$status','$discount')";
        $result=mysqli_query($conn,$query);
        if(!$result){
            $error="Failed Reason:".mysqli_error($conn);
            echo "<script>alert(`$error`);</script>";
        }
    }
    // insertProduct('products','ProductName','ProductCategory','500','350','imagename','videoname','Pkt/Box','1','25');

    function delete($tbname, ...$conditions) {
        global $conn; 
        $table = mysqli_real_escape_string($conn, $tbname);
        if (empty($conditions)) {
            echo "No conditions provided. Delete all records from '$table'.";
            return;
        }
        $where = implode(' AND ', $conditions);
        $query = "DELETE FROM $table WHERE $where";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Error deleting records: " . mysqli_error($conn);
        }
    }
?>