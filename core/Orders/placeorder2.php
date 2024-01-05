<?php 
    
    include '../config.php';
    
    // ini_set('display_errors', 1);
    // error_reporting(E_ALL);
    
    // print_r($_POST);
    parse_str($_POST['formData'], $formData);
    $overall_mrp_total=$_POST['overall_mrp_total'];
    $overall_sp_total= $_POST['overall_sp_total'];
    
    $name = $formData['name'];
    $phoneNo = $formData['phoneno'];
    $email = $formData['email'];
    $address = $formData['address'];
    $discount_per=$formData['discount'];
    $notes=$formData['notes'];
    $less_for=$formData['less_for'];
    $discount_total=$overall_mrp_total-($overall_mrp_total*($discount_per/100));

    $products = $_POST['products'];
    date_default_timezone_set("Asia/Kolkata");
    $date = date("Y-m-d h:i:sa");   
    
    $billed_by=$_SESSION['USER'];
    
    if(isset($_POST['oid']) && !empty($_POST['oid'])){
        $oid=$_POST['oid'];
        $pay_link="https://siteurl.com/payment_id/".$oid;
        updateOrder($name,$phoneNo,$email,$address,$oid,json_encode($products),$overall_mrp_total,$discount_per,$discount_total,$date,$billed_by,$notes,$less_for,$pay_link);
    }else{
        $oid=generate_oid();
        $pay_link="https://siteurl.com/payment_id/".$oid;
        makeOrder($name,$phoneNo,$email,$address,$oid,json_encode($products),$overall_mrp_total,$discount_per,$discount_total,$date,$billed_by,$notes,$less_for,$pay_link);
    }    
    
    function makeOrder($name,$phone,$email,$address,$oid,$items,$mrp_total,$discount,$grand_total,$date,$billed_by,$notes,$less_for,$pay_link){
        
        global $conn;
        $query="INSERT INTO new_billing(name,phone,email,address,oid,order_items,mrp_total,discount,grand_total,date,billed_by,notes,less_for,pay_link,status)VALUES('$name','$phone','$email','$address','$oid','$items','$mrp_total','$discount','$grand_total','$date','$billed_by','$notes','$less_for','$pay_link','1')";
        $result=mysqli_query($conn,$query);
        if($result){
            echo $oid;
        }
    }
    
    function updateOrder($name,$phone,$email,$address,$oid,$items,$mrp_total,$discount,$grand_total,$date,$billed_by,$notes,$less_for,$pay_link){
        global $conn;
        $query="UPDATE new_billing set name='$name',phone='$phone',email='$email',address='$address',oid='$oid',order_items='$items',mrp_total='$mrp_total',
                discount='$discount',grand_total='$grand_total',date='$date',billed_by='$billed_by',notes='$notes',less_for='$less_for',pay_link='$pay_link',status='1' where oid='$oid'";
        $result=mysqli_query($conn,$query);
        if($result){
            echo $oid;
        }
    }
    
    function generate_oid(){
        global $conn;
        $query = "select count(distinct(oid)) from new_billing";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        $oid = $row['count(distinct(oid))'] + 1;
        $oid = date('Y').'#A'.$oid;
        return $oid;
    }
    
?>