<?php 
include '../config.php';

$date = date('Y-m-d');

function tdyEstimate(){
    global $conn;
    global $date;
    $query = "SELECT count(distinct(oid)) as count FROM orders WHERE date LIKE '$date%'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    return $row['count'];
}
function tdyGiftbox(){
    global $conn;
    global $date;
    $query = "SELECT count(distinct(oid)) as count FROM boxorders WHERE date LIKE '$date%'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    return $row['count'];
}
function totalProducts(){
    global $conn;
    global $date;
    $query = "SELECT count(*) as count FROM products";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    return $row['count'];
}
function totalBox(){
    global $conn;
    global $date;
    $query = "SELECT count(*) as count FROM box";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    return $row['count'];
}

?>