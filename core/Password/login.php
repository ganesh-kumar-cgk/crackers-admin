<?php 
    // print_r($_POST);
    session_start();
    include '../config.php';
    function checkPassword($username,$password){
        global $conn;
        global $siteurl;
        $query="select * from admin where id=1";
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);
        if($username == $row['email'] && $password == $row['password']){
            $_SESSION['user']=$row['id'];
            $_SESSION['USER']=$row['email'];
            $_SESSION['USER_STATUS']=$row['is_superuser'];
            echo "<script>location.href='/demo/ff-admin/';</script>";
        }else{
            $_SESSION['error']='Invalid Credentials';
            echo "<script>location.href='/demo/ff-admin/login.php';</script>";
        }
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['username'];
        $password=$_POST['password'];
        checkPassword($username,$password);
    }else{
        echo "<script>alert('Invlaid Method')</script>";
    }
?>