<?php
    session_start();
    include '../config.php';
    
    function uploadimage($imagename,$temp_path,$size){
        $prev="http://localhost/unobi/admin/manageproduct.php";
        $maxFileSize = 5 * 1024 * 1024; // 2MB
        // echo "Image Name:".$imagename."<br>";
        // echo "Temp Path:".$temp_path."<br>";
        // echo "Size:".$size."<br>";
        // echo "New Filename :".$newfilename."<br>";

        $fileExt = '.'.strtolower(pathinfo($imagename, PATHINFO_EXTENSION));
        $newfilename=uniqid().$fileExt;
        // echo "Type:".$fileExt."<br>";

        if ($size > $maxFileSize) {
            $_SESSION['error']="File size is too large. Maximum allowed size is 2MB.";
            // echo "<script>location.href=".$prev."</script>";
            echo "<script>location.href=`$prev`;</script>";
        } 
        else {
            $targetDir = "../../uploads/products/";
            $targetFile = $targetDir . $newfilename;
            if (move_uploaded_file($temp_path, $targetFile)) {
                // echo "File uploaded successfully.";
                return $newfilename;
            }
        }
    }

    function ifexists($tablename,$psno){
        global $conn;
        $prev="http://localhost/unobi/admin/manageproduct.php";
        $query="select * from $tablename where serialno='$psno'";
        $result=mysqli_query($conn,$query);
        if ($result && mysqli_num_rows($result) > 0) {
            $_SESSION['error']='Serial Number is already found. Please Try another serial no.';
            echo "<script>location.href=`$prev`;</script>";
            exit();
        } else {
            return false; // Serial number doesn't exist
        }
    }

    function uploadProduct($tablename,$psno,$pname,$pcat,$ptype,$purl,$mrp,$pimage){
        global $conn;   
        $prev="http://localhost/unobi/admin/manageproduct.php";
        $imagename=$pimage['name'];
        $temp_path=$pimage['tmp_name'];
        $size=$pimage['size'];
        $ex=ifexists($tablename,$psno);
        if($ex==false){
            $result=uploadimage($imagename,$temp_path,$size);
            $sp=$mrp-50;
            if(!empty($result)){
                $query="Insert into $tablename(serialno,name,category,mrp,selling_price,image,video,type,status,discount)
                        Values('$psno','$pname','$pcat','$mrp','$sp','$result','$purl','$ptype','1','0')";
                $res=mysqli_query($conn,$query);
                if($res){
                    $_SESSION['success']='Product Added Successfully';
                    echo "<script>location.href=`$prev`;</script>";
                }else{
                    $error = "Failed Reason: " . mysqli_error($conn);
                    $_SESSION['error']=$error;
                    echo "<script>location.href=`$prev`;</script>";
                }
            }
        }
    }

    // print_r($_POST);
    // print_r($_FILES);
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $psno=$_POST['psno'];
        $pname=$_POST['pname'];
        $category=$_POST['category'];
        $ptype=$_POST['ptype'];
        $purl=$_POST['purl'];
        $mrp=$_POST['mrp'];
        $pimage=$_FILES['pimage'];
        uploadProduct('products',$psno,$pname,$category,$ptype,$purl,$mrp,$pimage);
    }else{
        $prev="http://localhost/unobi/admin/manageproduct.php";
        echo "<script>location.href=`$prev`;</script>";
    }
?>