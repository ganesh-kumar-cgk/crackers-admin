<?php
    
    // Function to fetch products from the database
    function getProducts($tablename="") {
        global $conn;
        if(!empty($tablename)){
            $query = "SELECT * FROM $tablename ORDER BY id DESC"; // Change 'products' to your actual table name
            $result = mysqli_query($conn, $query);
            
            $rows = "";
            
            if ($result) {
                $sno=1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $id=$row['id'];
                    $sts=$row['status'];
                    
                    $rows .= '<tr>';
                    $rows .= '<td>' . $sno . '</td>';
                    $rows .= '<td>' . $row['serialno'] . '</td>';
                    $rows .= '<td>' . $row['name'] . '</td>';
                    $rows .= '<td>' . $row['category']. $sts . '</td>';
                    $rows .= '<td>' . $row['type'] . '</td>';
                    $rows .= '<td>' . $row['mrp'] . '</td>';
                    $rows .= '<td>
                                <a onclick="openModal(' . $id . ')"><i class="fa fa-edit"></i></a>
                                <a onclick="deleteProduct(' . $id . ')"><i class="fa fa-trash text-danger"></i></a>
                                <input type="checkbox" id="check_' . $id . '" ' . ($sts == '1' ? 'checked' : '') . ' onchange="setStatus(' . $id . ')" />
                            </td>';
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
