<?php

    session_start();
    include '../config.php';

    function uploadimage($imagename,$temp_path,$size){
        global $siteurl;
        $prev=$siteurl."managegallery.php";
        $maxFileSize = 5 * 1024 * 1024; // 2MB

        $fileExt = '.'.strtolower(pathinfo($imagename, PATHINFO_EXTENSION));
        $newfilename=uniqid().$fileExt;

        if ($size > $maxFileSize) {
            $_SESSION['error']="File size is too large. Maximum allowed size is 2MB.";
            echo "<script>location.href=`$prev`;</script>";
        } 
        else {
            $targetDir = "../../../images/gallery/";
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

    function uploadGallery($tablename,$gname,$gimage){
        global $conn;
        global $siteurl;
        $prev=$siteurl."managegallery.php";
        $imagename=$gimage['name'];
        $temp_path=$gimage['tmp_name'];
        $size=$gimage['size'];
        $result=uploadimage($imagename,$temp_path,$size);
        if(!empty($result)){
            $query="Insert into $tablename(title,image) Values('$gname','$result')";
            $res=mysqli_query($conn,$query);
            if($res){
                $_SESSION['success']='Image Added Successfully';
                echo "<script>location.href=`$prev`;</script>";
            }else{
                $error = "Failed Reason: " . mysqli_error($conn);
                $_SESSION['error']=$error;
                echo "<script>location.href=`$prev`;</script>";
            }
        }
    }


    if($_SERVER['REQUEST_METHOD']==="POST"){
        $gname=$_POST['gname'];
        $gimage=$_FILES['gimage'];
        uploadGallery('gallery',$gname,$gimage);
    }
?>