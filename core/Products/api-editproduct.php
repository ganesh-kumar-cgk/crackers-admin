<?php 
    include '../config.php';
    
    // print_r($_POST);
    // print_r($_FILES);
    
    
    function uploadimage(){
        if(!empty($_FILES['eimage']['name'])){
            $image_name=$_FILES['eimage']['name'];
            $temp_path=$_FILES['eimage']['tmp_name'];
            $size=$_FILES['eimage']['size'];
            
            $maxFileSize = 2 * 1024 * 1024; // 2MB
            $ext = strtolower(pathinfo($_FILES['eimage']['name'], PATHINFO_EXTENSION));
            $formats = array('jpg','png');
            
            if( $size < $maxFileSize){
                if(in_array($ext, $formats)){
                    $newfilename=uniqid().$ext;
                    $targetDir = "../../../images/products/";
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }
                    $targetFile = $targetDir . $newfilename;
                    if (move_uploaded_file($temp_path, $targetFile)) {
                        return $newfilename;
                    }
                }else{
                    $response=array("message"=>"Unsupported Format upload only (jpeg,png)","status"=>'4');
                    echo json_encode($response);
                    exit();
                }
            }else{
                $response=array("message"=>"File size exceed","status"=>'3');
                echo json_encode($response);
            }
        }else{
            return "no-image";
        }
    }

    
    function editProduct($psno,$pname,$pcat,$ptype,$purl,$mrp,$discount,$pid,$stock){
        global $conn;
        
        $image =uploadimage();
        if($image =='no-image'){
            $image_update = "";
        }else{
            $image_update = ", image='$image'";
        }
        $sp = $mrp - ($mrp * $discount / 100);
        $query = "UPDATE products SET name='$pname', category='$pcat', mrp='$mrp', selling_price='$sp'" . $image_update . ", video='$purl', discount='$discount', status='1', type='$ptype',inventory='$stock' WHERE id='$pid'";
        $result = mysqli_query($conn, $query);
        if($result){
            $response=array("message"=>"Product updated Successfully","status"=>'1');
            echo json_encode($response);
        }else{
            $response=array("message"=>"Something Went Wrong Please Try Again !","status"=>'2');
            echo json_encode($response);
        }
    }
    
    
    $pname=$_POST['pname'];
    $pname = str_replace(array('"', "'", ','), array('&quot;', '&#39;', '&#44;'), $pname);
    $psno=$_POST['psno'];
    $pcategory=$_POST['category'];
    $ptype=$_POST['ptype'];
    $purl=$_POST['purl'];
    $mrp=$_POST['mrp'];
    $pid=$_POST['pid-edit'];
    $discount=$_POST['discount'];
    $stock=$_POST['stock'];
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        editProduct($psno,$pname,$pcategory,$ptype,$purl,$mrp,$discount,$pid,$stock);
    }else{
        $response=array("message"=>"Invalid Method","status"=>"404");
    }
    
?>