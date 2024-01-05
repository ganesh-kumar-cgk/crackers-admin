<?php 
    // print_r($_POST);
    include '../config.php';
    $start=$_POST['start'];
    $end=$_POST['end'];
    $table=$_POST['table'];
    
    
    if($table == "Product"){
        $query = "SELECT * FROM new_billing WHERE created_at BETWEEN '$start' AND '$end' GROUP BY oid;";
        $result=mysqli_query($conn,$query);
        
        $data=array();
        while($row=mysqli_fetch_array($result)){
            $items=json_decode($row['order_items'],true);
            foreach($items as $item){
                $qty=$item['qty'];
                $name=$item['productName'];
                $data[]=array(
                    "product"=>$name,
                    "qty"=>$qty
                );
            }
        }
        
        $product_quantities = [];
        $totalSum=0;
        // Summing the quantities for each product
        foreach ($data as $item) {
            $product = $item["product"];
            $quantity = $item["qty"];
        
            if (!array_key_exists($product, $product_quantities)) {
                $product_quantities[$product] = ["product" => $product, "qty" => 0];
            }
        
            $product_quantities[$product]["qty"] += $quantity;
            $totalSum+=$quantity;
        }
        
        // Convert associative array to simple array and output the result
        $output = array_values($product_quantities);
        
        
        $response =array(
                'productcontent'=>json_encode($output),
                'total_qty'=>$totalSum
        );
        
        echo json_encode($response);
    }else if($table == "Invoice"){
        $query="Select oid,name,address,email,phone,grand_total from new_billing where created_at BETWEEN '$start' AND '$end' GROUP BY oid";
        $result=mysqli_query($conn,$query);
        $data=array();
        while($row=mysqli_fetch_array($result)){
            $data[]=$row;
        }
        $content=json_encode($data);
        
        $customersQuery = "SELECT COUNT(DISTINCT name) AS distinct_count FROM new_billing where created_at BETWEEN '$start' AND '$end'";
        $cr=mysqli_query($conn,$customersQuery);
        $crow = mysqli_fetch_assoc($cr);
        $customerCount = $crow['distinct_count'];
        
        // $sumQuery = "SELECT SUM(total) AS total_sum FROM orders";
        $sumQuery = "SELECT oid,grand_total FROM new_billing where created_at BETWEEN '$start' AND '$end' GROUP BY oid; ";
        $sumResult = mysqli_query($conn,$sumQuery);
        
        $totalSum=0;
        while($sumrow=mysqli_fetch_array($sumResult)){
            $totalSum+=$sumrow['grand_total'];
        }
        
        $response=array(
                'tblcontent'=>$content,
                'total'=>$totalSum,
                'noc'=>$customerCount
        );
        echo json_encode($response);
    }else{
        $response=array(
            'message'=>"Please Choose Table And Search"
        );
        echo json_encode($response);
    }
    
?>