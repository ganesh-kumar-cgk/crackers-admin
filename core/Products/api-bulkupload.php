<?php 
    include '../config.php';
    
    function is_valid(){
        $ext = strtolower(pathinfo($_FILES['productlist']['name'], PATHINFO_EXTENSION));
        $formats = array('csv');
        if(in_array($ext,$formats)){
            return true;
        }else{
            $response=array('message'=>"Invalid File Format Only csv accepted",'status'=>"2");
            echo json_encode($response);
        }
    }
    
    if(is_valid()){
        $file_path = $_FILES['productlist']['tmp_name']; 
        $fp = fopen($file_path, 'r');
        if ($fp !== false) {
            $first_row = true;
            
            while (($data = fgetcsv($fp)) !== false) {
                if ($first_row) {
                    $first_row = false;
                    continue;
                }   
                
                $psno=$data[1];
                $pname = str_replace(array('"', "'", ','), array('&quot;', '&#39;', '&#44;'), $data[2]);
                $pcat=$data[3];
                $mrp=$data[4];
                $sp=$data[5];
                $image=$data[6];
                $video=$data[7];
                $ptype=$data[8];
                $created_on=$data[9];
                $stock=$data[10];
                $status=$data[11];
                $discount=$data[12];
                $query="Insert into products(serialno,name,category,mrp,selling_price,image,video,type,created_on,status,discount,inventory)
                    Values('$psno','$pname','$pcat','$mrp','$sp','$image','$video','$ptype','$created_on','$status','$discount',$stock)";
                $result=mysqli_query($conn,$query);
            }
    
            fclose($fp);
    
            $response = array('message' => "Completed.", 'status' => "1");
            echo json_encode($response);
        } else {
            // Handle the case where the file couldn't be opened
            $response = array('message' => "Failed to open the CSV file.", 'status' => "3");
            echo json_encode($response);
        }
    }
?>