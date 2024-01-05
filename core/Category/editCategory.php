<?php
    session_start();
    include '../config.php';

    function editCategory($tablename,$cid,$cname,$discount){
        $prev="http://localhost/unobi/admin/managecategory.php";
        global $conn;
        $query="update $tablename set name='$cname', discount='$discount' where id='$cid' ";
        $result=mysqli_query($conn,$query);
        if($result){
            $q1="select * from products where category='$cname'";
            // echo $q1;
            $r1=mysqli_query($conn,$q1);
            while($row=mysqli_fetch_array($r1)){
                $id=$row['id'];
                $sp=$row['mrp']-$row['mrp']*($discount/100);
                $q2="Update products set selling_price='$sp' where id='$id'";
                // echo $q2;
                $r2=mysqli_query($conn,$q2);
            }
            echo true;
        }else{
            echo false;
        }

    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $cid=$_POST['cid'];
        $cname=$_POST['cname'];
        $discount=$_POST['discount'];
        editCategory('category',$cid,$cname,$discount);
    }
?>