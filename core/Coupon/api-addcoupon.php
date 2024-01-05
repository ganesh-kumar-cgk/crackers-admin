<?php 

    include '../config.php';
    
    function is_exists($coupon){
        global $conn;
        $query="select * from tbl_coupon where coupon_code='$coupon'";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result) > 0){
            $response=array(
                    'message'=>'Coupon Code Already Exists ',
                    'status'=>2
            );
            echo json_encode($response);
            return false;
        }
        return true;
    }
    
    
    function add($coupon,$discount,$profit,$owner,$password){
        global $conn;
        $query="Insert into tbl_coupon(coupon_code,discount,profit,owner_name,password) VALUES('$coupon','$discount','$profit','$owner','$password')";
        $result=mysqli_query($conn,$query);
        if($result){
            $response=array(
                    'message'=>'Coupon Added',
                    'status'=>0
            );
            echo json_encode($response);
        }
        else{
            $response=array(
                    'message'=>'Failed',
                    'status'=>1,
                    'reason'=>mysqli_error($conn)
            );
            echo json_encode($response);
        }
    }
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $coupon=$_POST['coupon_code'];
        $discount=$_POST['coupon_discount'];
        $profit=$_POST['profit'];
        $owner=$_POST['owner_name'];
        $password=$_POST['password'];
        if(is_exists($coupon)){
            add($coupon,$discount,$profit,$owner,$password);   
        }
    }
?>