<?php 
    session_start();
    if(!empty($_SESSION['user'])){
        unset($_SESSION['user']);
        echo "<script>location.href='../../login.php'</script>";
    }
?>