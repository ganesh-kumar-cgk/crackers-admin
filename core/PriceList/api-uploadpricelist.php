<?php 
    include '../config.php';
    
     function upload($imagename,$temp_path,$size){
         global  $conn;
        $maxFileSize = 5 * 1024 * 1024; // 2MB

        $fileExt = '.'.strtolower(pathinfo($imagename, PATHINFO_EXTENSION));
        $newfilename="pricelist".$fileExt;
        if ($size >= $maxFileSize) {
            echo "exceed";
        } 
        else {
            $targetDir = "../../../pricelist/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true); // The third argument 'true' creates parent directories if needed
            }
            $targetFile = $targetDir . $newfilename;
            if (move_uploaded_file($temp_path, $targetFile)) {
                $id='1';
                $query="Insert into pricelist(id,pricelist) Values('$id','$newfilename')  ON DUPLICATE KEY UPDATE pricelist='$newfilename'";
                $result=mysqli_query($conn,$query);
                if($result){
                    echo "uploaded";
                }else{
                    echo "failed";
                }
            }
        }
     }
     
    
     
     if($_SERVER['REQUEST_METHOD'] === "POST"){
         $image=$_FILES['pricelist'];
         $imagename=$image['name'];
         $temp_path=$image['tmp_name'];
         $size=$image['size'];
         upload($imagename,$temp_path,$size);
     }
?>