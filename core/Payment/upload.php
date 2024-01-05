<?php 
    include '../config.php';
    
    function upload($bank_name,$acc_holder_name,$acc_no,$ifsc_code,$branch_name,$display_name,$format_gpay,$format_ppay){
        global $conn;
        // $query="Insert Into payment_info(bank_name,acc_no,ifsc_code,acc_holder_name,branch,display_name,gpay_no,phonepay_no) 
        //         Values('$bank_name','$acc_no','$ifsc_code','$acc_holder_name','$branch_name','$display_name','$gpayData','$phonepayData') ";
        // echo $format_gpay;
        // echo $format_ppay;
        
        $query = "INSERT INTO payment_info 
              (id, bank_name, acc_no, ifsc_code, acc_holder_name, branch, display_name, gpay_no, phonepay_no)
          VALUES
              (1, '$bank_name', '$acc_no', '$ifsc_code', '$acc_holder_name', '$branch_name', '$display_name', '$format_gpay', '$format_ppay')
          ON DUPLICATE KEY UPDATE
              bank_name = VALUES(bank_name),
              acc_no = VALUES(acc_no),
              ifsc_code = VALUES(ifsc_code),
              acc_holder_name = VALUES(acc_holder_name),
              branch = VALUES(branch),
              display_name = VALUES(display_name),
              gpay_no = VALUES(gpay_no),
              phonepay_no = VALUES(phonepay_no)";
        // exit();
        $result=mysqli_query($conn,$query);
        if($result){
            echo true;
        }else{
            echo "Failed".mysqli_error($conn);
        }
    }
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $gpay=$_POST['gpay'];
        $glines = explode("\n", $gpay);
        
        $format_gpay = array();

        // Iterate through each line and extract mobile number and display name
        foreach ($glines as $line) {
            // Split the line into mobile number and display name
            list($mobileNumber) = explode(" ", $line);
    
            // Add data to the formatted array
            $format_gpay[] = array(
                "mobile_number" =>str_replace("\r", "", $mobileNumber),
                
            );
        }
        
        $gpay_json = json_encode($format_gpay);
        
        
        $ppay=$_POST['phonepay'];
        $plines = explode("\n", $ppay);
        
        $format_ppay = array();

        // Iterate through each line and extract mobile number and display name
        foreach ($plines as $line) {
            // Split the line into mobile number and display name
            list($mobileNumber) = explode(" ", $line);
    
            // Add data to the formatted array
            $format_ppay[] = array(
                "mobile_number" => str_replace("\r", "", $mobileNumber),
            );
        }
        
        $ppay_json = json_encode($format_ppay);
        // print_r($ppay_json);
        
        $bank_name=$_POST['bank_name'];
        $acc_holder_name=$_POST['acc_holder_name'];
        $acc_no=$_POST['acc_no'];
        $ifsc_code=$_POST['ifsc_code'];
        $branch_name=$_POST['branch_name'];
        $display_name=$_POST['display_name'];
        
        upload($bank_name,$acc_holder_name,$acc_no,$ifsc_code,$branch_name,$display_name,$gpay_json,$ppay_json);
        
    }
?>