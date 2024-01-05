<?php
    session_start();
    if($_SERVER['HTTP_HOST'] == "fireflycrackers.com"){
        $dbname="u399040897_fireflycracker";
        $hostname="localhost";
        $username="u399040897_fireflycracker";
        $password="firefly@Crackers.1234";
        $siteurl="https://fireflycrackers.com/demo/ff-admin/";
        $mainurl="https://fireflycrackers.com/demo/";
        $conn = mysqli_connect($hostname, $username, $password, $dbname);
        if(!$conn){
            echo "Failed To Conect:";
        }
    }
?>