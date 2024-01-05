<?php
    session_start();
    include '../config.php';
    
    function uploadimage($imagename,$temp_path,$size){
        $prev="http://localhost/unobi/admin/manageproduct.php";
        $maxFileSize = 5 * 1024 * 1024; // 2MB

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

    function uploadProduct($tablename,$psno,$pname,$pcat,$ptype,$purl,$mrp,$pimage,$discount,$pid){
        global $conn;   
        $prev="http://localhost/unobi/admin/manageproduct.php";
        $imagename=$pimage['name'];
        $temp_path=$pimage['tmp_name'];
        $temp_path=$pimage['tmp_name'];
        $size=$pimage['size'];
        $result=uploadimage($imagename,$temp_path,$size);
        $sp=$mrp-($mrp*$discount/100);
        if(!empty($result)){
            $query="Update $tablename SET name='$pname',serialno='$psno',category='$pcat',mrp='$mrp',selling_price='$sp',image='$result'
                    ,video='$purl',discount='$discount',status='1',type='$ptype' where id= '$pid'";
            $res=mysqli_query($conn,$query);
            if($res){
                $_SESSION['success']='Product Updated Successfully';
                echo "<script>location.href=`$prev`;</script>";
            }else{
                $error = "Failed Reason: " . mysqli_error($conn);
                $_SESSION['error']=$error;
                echo "<script>location.href=`$prev`;</script>";
            }
        }
        
    }

    // print_r($_POST);
    // print_r($_FILES);
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $pname=$_POST['pname'];
        $psno=$_POST['psno'];
        $category=$_POST['category'];
        $ptype=$_POST['ptype'];
        $purl=$_POST['purl'];
        $mrp=$_POST['mrp'];
        $pimage=$_FILES['eimage'];
        $discount=$_POST['discount'];
        $pid=$_POST['pid-edit'];
        uploadProduct('products',$psno,$pname,$category,$ptype,$purl,$mrp,$pimage,$discount,$pid);
    }else{
        $prev="http://localhost/unobi/admin/manageproduct.php";
        echo "<script>location.href=`$prev`;</script>";
    }
?>