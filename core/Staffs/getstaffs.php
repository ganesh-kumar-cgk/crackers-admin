<?php 
    include '../config.php';
    
    function getStaffs() {
        global $conn;
        $query = "select * from admin where is_superuser='staff'";
        $result = mysqli_query($conn, $query);
        $rows = "";
        $sno = 1;
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $rows .= '<tr>';
            $rows .= '<td>' . $sno++ . '</td>';
            $rows .= '<td>' . $row['email'] . '</td>';
            $rows .= '<td><input type="password" value="' . $row['password'] . '" class="form-control form-control-sm"/></td>';
            $rows .= '<td class="d-inline-flex gap-3">';
            $rows .= '<input type="password" class="form-control form-control-sm" id="newpass_' . $id . '" />';
            $rows .= '<button onclick="update(' . $id . ')" class="btn btn-sm btn-success">';
            $rows .= '<i class="fa fa-check"></i>';
            $rows .= '</button>';
            $rows .= '<button onclick="deleteStaff(' . $id . ')" class="btn btn-sm btn-danger">';
            $rows .= '<i class="fa fa-trash"></i>';
            $rows .= '</button>';
            $rows .= '</td>';
            $rows .= '</tr>';
        }
        return $rows;
    }
    echo getStaffs();
?>
