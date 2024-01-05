<?php
    include '../config.php';
    
    function getCategorys($tablename){
        global $conn;
        $query="Select *from $tablename ORDER BY id DESC";
        $result=mysqli_query($conn,$query);
        if($result){
            $rows="";
            $sno=1;
            while($row=mysqli_fetch_array($result)){
                $id=$row['id'];
                $sts=$row['status'];
                $rows .= '<tr>';
                $rows .= '<td>' . $sno . '</td>';
                $rows .= '<td>' . $row['name'] . '</td>';
                $rows .= '<td>' . $row['created_on'] . '</td>';
                $rows .= '<td>
                            <a onclick="openModal(' . $id . ')"><i class="fa fa-edit"></i></a>
                            <a onclick="deleteProduct('.$id.')" ><i class="fa fa-trash text-danger"></i></a>
                            <input type="checkbox" id="check_' . $id . '" ' . ($sts == '1' ? 'checked' : '') . ' onchange="setStatus(' . $id . ')" />
                          </td>';
                $rows .= '</tr>';
                $sno++;
            }
            echo $rows;
        }else{
            $error = "Failed Reason: " . mysqli_error($conn);
            echo "<script>alert(`$error`);</script>";
        }
    }
    getCategorys('category');
?>