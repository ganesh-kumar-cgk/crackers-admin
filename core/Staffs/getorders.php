<?php
    
    // Function to fetch products from the database
    function getOrders($tablename="",$billed_by) {
        global $conn;
        if(!empty($tablename)){
            $query = "select  DISTINCT oid,date,name,phone,email,address,grand_total,status from $tablename where billed_by='$billed_by'"; // Change 'products' to your actual table name
            $result = mysqli_query($conn, $query);
            
            $rows = "";
            
            if ($result) {
                $sno=0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $id=$row['oid'];
                    $uid=urlencode($id);
                    $st=$row['status'];
                    $stat="";
                    if ($row['status'] == "1") {
                        $stat = "<span class='badge bg-success'>Ordered</span>";        
                    }
                    if ($row['status'] == "2") {
                        $stat = "<span class='badge bg-success'>Pending</span>";        
                    }
                    if ($row['status'] == "3") {
                        $stat = "<span class='badge bg-success'>Completed</span>";        
                    }
                    if ($row['status'] == "4") {
                        $stat = "<span class='badge bg-success'>Cancel</span>";        
                    } 
                    $rows .= '<tr>';
                    $rows .= '<td>' . $sno++ . '</td>';
                    $rows .= '<td>' . $row['oid'] . '</td>';
                    $rows .= '<td>' . $row['name'] . '</td>';
                    $rows .= '<td>' . $row['phone'] . '</td>';
                    $rows .= '<td>' . $row['email'] . '</td>';
                    $rows .= '<td>' . $row['address'] . '</td>';
                    $rows .= '<td>' . $row['grand_total'] . '</td>';
                    $rows .= '<td>' . $stat . '</td>';
                    $rows .= '<td><a href="invoice-order.php?oid=' . $uid . '"><i class="fa fa-eye text-primary"></i></a></td>';
                    $rows .= '<td>' . $row['date'] . '</td>';
                    $rows .= '</tr>';
                }
                mysqli_free_result($result);
            } else {
                $error = "Failed Reason: " . mysqli_error($conn);
                echo "<script>alert(`$error`);</script>";
            }
            
            return $rows;
        }else{
            $error = "Table Name Cannot be Empty";
            echo "<script>alert(`$error`);</script>";
        }
    }
    // echo getOrders("orders");

?>
