<?php
    
    // Function to fetch products from the database
    function getcontacts($tablename="") {
        global $conn;
        if(!empty($tablename)){
            $query = "SELECT * FROM $tablename ORDER BY id DESC"; // Change 'products' to your actual table name
            $result = mysqli_query($conn, $query);
            
            $rows = "";
            
            if ($result) {
                $sno=1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $id=$row['id'];
                    $rows .= '<tr>';
                    $rows .= '<td>' . $sno . '</td>';
                    $rows .= '<td>' . $row['name'] . '</td>';
                    $rows .= '<td>' . $row['email'] . '</td>';
                    $rows .= '<td>' . $row['phone'] . '</td>';
                    $rows .= '<td>' . $row['message'] . '</td>';                    
                    $rows .= '</tr>';
                    $sno++;
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
    // getProducts("products");
?>
