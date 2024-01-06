<?php
    session_start();
    if($_SERVER['HTTP_HOST'] == "fireflycrackers.com"){
        $dbname="u399040897_fireflycracker";
        $hostname="localhost";
        $username="u399040897_fireflycracker";
        $password="firefly@Crackers.1234";
        $siteurl="https://fireflycrackers.com/firefly-admin/";
        $mainurl="https://fireflycrackers.com/demo/";
        $conn = mysqli_connect($hostname, $username, $password, $dbname);
        if(!$conn){
            echo "Failed To Conect:";
        }
    }
    if($_SERVER['HTTP_HOST'] == "divinecrackers.com"){
        $dbname="u399040897_divinecrackers";
        $hostname="localhost";
        $username="u399040897_divinecrackers";
        $password="divine@Crackers.123";
        $siteurl="https://divinecrackers.com/divine-admin-panel/";
        $mainurl="https://divinecrackers.com/demo/";
        $conn = mysqli_connect($hostname, $username, $password, $dbname);
        if(!$conn){
            echo "Failed To Conect:";
        }        
    }
    if($_SERVER['HTTP_HOST'] == "kayatharcrackers.com"){
        $dbname="u399040897_kayathar";
        $hostname="localhost";
        $username="u399040897_kayathar";
        $password="kayathar@4321@2023KK";
        $siteurl="https://kayatharcrackers.com/kayatharad/";
        $mainurl="https://kayatharcrackers.com/demo/";
        $conn = mysqli_connect($hostname, $username, $password, $dbname);
        if(!$conn){
            echo "Failed To Conect:";
        }        
    }
?>