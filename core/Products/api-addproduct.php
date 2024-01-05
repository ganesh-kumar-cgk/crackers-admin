<?php 
    include '../config.php';
    
    // print_r($_POST);
    // print_r($_FILES);
    
    
    function is_exists($psno){
        global $conn;
        $query="select * from products where serialno='$psno'";
        $result=mysqli_query($conn,$query);
        if ($result && mysqli_num_rows($result) > 0) {
            $response = array("message" => "Serial No Already Exists !","status"=>'2');
            echo json_encode($response);
            return true;
        }else{
            return false;
        }
        
    }
    
    function uploadimage(){
        if(!empty($_FILES['pimage']['name'])){
            $image_name=$_FILES['pimage']['name'];
            $temp_path=$_FILES['pimage']['tmp_name'];
            $size=$_FILES['pimage']['size'];
            
            $maxFileSize = 2 * 1024 * 1024; // 2MB
            $ext = strtolower(pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION));
            $formats = array('jpg', 'png');
            
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
                }
            }else{
                $response=array("message"=>"File size exceed","status"=>'3');
                echo json_encode($response);
            }
        }else{
            return "no-image";
        }
    }
    
    function calc($mrp){
        global $conn;
        $query="select site_discount from sitesettings";
        $result = mysqli_query($conn,$query);
        if($result){
            $row=mysqli_fetch_assoc($result);
            $discount=$row['site_discount'];
            return $mrp - ($mrp * ($discount / 100));
        }
    }
    
    function uploadProduct($pname,$psno,$pcat,$ptype,$video,$stock,$mrp,$net_rate){
        global $conn;
        if(!is_exists($psno)){
            $image=uploadimage();
            if($net_rate == 1){
                $sp= calc($mrp);   
            }else{
                $sp=$mrp;
            }
            $query="Insert into products(serialno,name,category,mrp,selling_price,image,video,type,status,discount,inventory,net_rate)
                    Values('$psno','$pname','$pcat','$mrp','$sp','$image','$video','$ptype','1','0',$stock,$net_rate)";
            $result=mysqli_query($conn,$query);
            if($result){
                $response=array("message"=>"Product Added Successfully","status"=>'1');
                echo json_encode($response);
            }else{
                $response=array("message"=>"Something Went Wrong Please Try Again !","status"=>'5');
                echo json_encode($response);
            }
        }
    }
    
    
    $pname=$_POST['pname'];
    $pname = str_replace(array('"', "'", ','), array('&quot;', '&#39;', '&#44;'), $pname);
    $psno=$_POST['psno'];
    $category=$_POST['category'];
    $ptype=$_POST['ptype'];
    $mrp=$_POST['mrp'];
    $video=$_POST['purl'];
    $stock=$_POST['stock'];
    $net_rate=$_POST['net_rate'];
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        uploadProduct($pname,$psno,$category,$ptype,$video,$stock,$mrp,$net_rate);   
    }else{
        $response=array("message"=>"Invalid Method","status"=>"404");
    }
    
?>