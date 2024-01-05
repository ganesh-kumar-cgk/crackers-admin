<?php 
    include '../config.php';
    // print_r($_POST);
    parse_str($_POST['formData'], $formData);
    $overall_mrp_total=$_POST['overall_mrp_total'];
    $overall_sp_total= $_POST['overall_sp_total'];
    
    $name = $formData['name'];
    $phoneNo = $formData['phoneno'];
    $email = $formData['email'];
    $address = $formData['address'];
    $discount_per=$formData['discount'];
    $discount_total=$overall_mrp_total-($overall_mrp_total*($discount_per/100));

    // $name=$_POST['formData']['name'];
    // $email=$_POST['formData']['email'];
    // $phoneno=$_POST['formData']['phoneno'];
    // $address=$_POST['formData']['address'];

    // $products=$_POST['products'];
    // echo count($products);

    $products = $_POST['products'];
    date_default_timezone_set("Asia/Kolkata");
    $date = date("Y-m-d h:i:sa");   
    $oid=generate_oid();
    // Now you can iterate through the products array and access their details
    foreach ($products as $product) {
        $productName = $product['productName'];
        $mrpPrice = $product['mrp_price'];
        $sellingPrice = $product['selling_price'];
        $sellingTotal = $product['selling_total'];
        $qty = $product['qty'];
        $mrpTotal = $product['mrp_total'];
        $p_id=$product['p_id'];
        $overall_mrp_total=$overall_mrp_total;
        $overall_sp_total=$overall_sp_total;
        placeOrder($name,$phoneNo,$email,$address,$oid,$productName,$sellingPrice,$qty,$discount_total,$mrpPrice,$mrpTotal,$p_id,$overall_sp_total,$overall_mrp_total,$discount_per,$date);
    }


    function placeOrder($name,$phone,$email,$address,$oid,$pname,$price,$quantity,$total,$mrp,$mrptotal,$proid,$discount_total,$totalmrproduct,$discount_per,$date){
        global $conn;
        $query = "insert into billing(name,phone,email,address,oid,pname,price,quantity,total,mrp,mrp_total,p_id,overall_total,overall_mrp_total,discount,date) 
        values('$name','$phone','$email','$address','$oid','$pname','$price','$quantity','$total','$mrp','$mrptotal','$proid','$discount_total','$totalmrproduct','$discount_per','$date')";
        $result = mysqli_query($conn,$query);
    }

    function generate_oid(){
        global $conn;
        $query = "select count(distinct(oid)) from billing";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        $oid = $row['count(distinct(oid))'] + 1;
        $oid = date('Y').'#A'.$oid;
        return $oid;
    }
    echo $oid;
?>