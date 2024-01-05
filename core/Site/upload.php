<?php 
    // print_r($_POST);
    // print_r($_FILES);
    session_start();
    include '../config.php';

    function uploadimage($imagename,$temp_path,$size){
        $prev="http://localhost/unobi/admin/managesite.php";
        $maxFileSize = 5 * 1024 * 1024; // 2MB
        
        $fileExt = '.'.strtolower(pathinfo($imagename, PATHINFO_EXTENSION));
        $newfilename='logo'.$fileExt;
        

        if ($size > $maxFileSize) {
            $_SESSION['error']="File size is too large. Maximum allowed size is 2MB.";
            // echo "<script>location.href=".$prev."</script>";
            echo "<script>location.href=`$prev`;</script>";
        } 
        else {
            $targetDir = "../../../images/logo/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true); // The third argument 'true' creates parent directories if needed
            }
            $targetFile = $targetDir . $newfilename;
            if (move_uploaded_file($temp_path, $targetFile)) {
                // echo "File uploaded successfully.";
                return $newfilename;
            }
        }
    }

    if($_SERVER['REQUEST_METHOD']==="POST"){
        $prev=$siteurl."managesite.php";
        $site_name=$_POST['site_name'];
        $site_number=$_POST['site_number'];
        $site_whatsapp_number=$_POST['site_whatsapp_number'];
        $site_email=$_POST['site_email'];
        $site_youtube=$_POST['site_youtube'];
        $site_facebook=$_POST['site_facebook'];
        $site_instagram=$_POST['site_instagram'];
        $site_twitter=$_POST['site_twitter'];
        $site_map=$_POST['site_map'];
        $site_discount=$_POST['site_discount'];
        $site_modal_content=$_POST['site_modal_content'];
        $site_gift_minimum_orders=$_POST['site_gift_minimum_orders'];
        $site_minimum_orders=$_POST['site_minimum_orders'];
        $site_address=$_POST['site_address'];
        $imagename=$_FILES['site_logo']['name'];
        $temp_path=$_FILES['site_logo']['tmp_name'];
        $size=$_FILES['site_logo']['size'];
        $id = 1; // The ID you want to check
        if($_FILES['site_logo']['name'] != ""){
            $result=uploadimage($imagename,$temp_path,$size); 
            $query = "INSERT INTO sitesettings (id, site_name, site_number, site_whatsapp_number, site_email, site_youtube, site_facebook, site_instagram, site_twitter, site_map, site_modal_content, site_gift_minimum_orders, site_minimum_orders, site_address, site_logo, site_discount) 
                        VALUES ('$id', '$site_name', '$site_number', '$site_whatsapp_number', '$site_email', '$site_youtube', '$site_facebook', '$site_instagram', '$site_twitter', '$site_map', '$site_modal_content', '$site_gift_minimum_orders', '$site_minimum_orders', '$site_address', '$result', '$site_discount')
                        ON DUPLICATE KEY UPDATE
                        site_name = '$site_name', site_number = '$site_number', site_whatsapp_number = '$site_whatsapp_number', site_email = '$site_email', site_youtube = '$site_youtube', site_facebook = '$site_facebook', site_instagram = '$site_instagram', site_twitter = '$site_twitter', site_map = '$site_map', site_modal_content = '$site_modal_content', site_gift_minimum_orders = '$site_gift_minimum_orders', site_minimum_orders = '$site_minimum_orders', site_address = '$site_address', site_logo = '$result', site_discount = '$site_discount'";
        }else{
             $query = "INSERT INTO sitesettings (id, site_name, site_number, site_whatsapp_number, site_email, site_youtube, site_facebook, site_instagram, site_twitter, site_map, site_modal_content, site_gift_minimum_orders, site_minimum_orders, site_address, site_discount) 
                        VALUES ('$id', '$site_name', '$site_number', '$site_whatsapp_number', '$site_email', '$site_youtube', '$site_facebook', '$site_instagram', '$site_twitter', '$site_map', '$site_modal_content', '$site_gift_minimum_orders', '$site_minimum_orders', '$site_address','$site_discount')
                        ON DUPLICATE KEY UPDATE
                        site_name = '$site_name', site_number = '$site_number', site_whatsapp_number = '$site_whatsapp_number', site_email = '$site_email', site_youtube = '$site_youtube', site_facebook = '$site_facebook', site_instagram = '$site_instagram', site_twitter = '$site_twitter', site_map = '$site_map', site_modal_content = '$site_modal_content', site_gift_minimum_orders = '$site_gift_minimum_orders', site_minimum_orders = '$site_minimum_orders', site_address = '$site_address', site_discount = '$site_discount'";
        }
            $res=mysqli_query($conn,$query);
            if($res){
                $_SESSION['success']='Site Details Updated';
                echo "<script>location.href=`$prev`;</script>";
            }else{
                $error = "Failed Reason: " . mysqli_error($conn);
                $_SESSION['error']=$error;
                echo "<script>location.href=`$prev`;</script>";
            }
    }else{
        $prev="http://localhost/unobi/admin/managesite.php";
        echo "<script>location.href=`$prev`;</script>";
    }
?>