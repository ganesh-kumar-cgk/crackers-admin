

<?php

include '../config.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($conn,$_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
  $searchQuery = " AND (
    name LIKE '%" . $searchValue . "%' OR
    phone LIKE '%" . $searchValue . "%' OR
    address LIKE '%" . $searchValue . "%' OR
    grand_total LIKE '%" . $searchValue . "%' OR
    created_at LIKE '%" . $searchValue . "%' OR
    date LIKE '%" . $searchValue . "%' OR
    oid LIKE '%" . $searchValue . "%' OR
    email LIKE '%" . $searchValue . "%'
    )";
}

## Total number of records without filtering
$sel = mysqli_query($conn,"select count(distinct(oid)) as allcount from new_billing  WHERE status !='5' ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($conn,"select count(distinct(oid)) as allcount from new_billing WHERE status !='5' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select DISTINCT oid,date,name,phone,email,address,grand_total,status,billed_by from new_billing WHERE status !='5' ".$searchQuery." order by ".'oid'." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();
$sno =1;
while ($row = mysqli_fetch_assoc($empRecords)) {
    $id=$row['oid'];
    $uid=urlencode($id);
    $id = str_replace("#","_",$id);
    $st = $row['status'];
    if ($row['status'] == "1") {
        $stat = "<span class='badge bg-success'>Ordered</span><a class='mx-1' onclick=\"showalert('$id','$st')\" style='cursor:pointer;'><i class='ti-settings'></i></a>";        
    }
    if ($row['status'] == "2") {
        $stat = "<span class='badge bg-success'>Pending</span><a class='mx-1' onclick=\"showalert('$id','$st')\" style='cursor:pointer;'><i class='ti-settings'></i></a>";        
    }
    if ($row['status'] == "3") {
        $stat = "<span class='badge bg-success'>Completed</span><a class='mx-1' onclick=\"showalert('$id','$st')\" style='cursor:pointer;'><i class='ti-settings'></i></a>";        
    }
    if ($row['status'] == "4") {
        $stat = "<span class='badge bg-success'>Cancel</span><a class='mx-1' onclick=\"showalert('$id','$st')\" style='cursor:pointer;'><i class='ti-settings'></i></a>";        
    }    
    $oid=$row['oid'];
    $biller=$row['billed_by'];
    $data[] = array( 
      "Sno"=>$sno++,
      "OrderId"=>$row['oid'],
      "Name"=>$row['name'],
      "Phone"=>$row['phone'],
      "Billed_By"=>"<a href='stafforders.php?user=$biller'><i class='fa fa-user'></i>$biller</a>",
      "Address"=>$row['address'],
      "Total"=>number_format($row['grand_total'],2),
      "Status"=>$stat,
      "Action" => '<td>
                        <a href="invoice-bill.php?oid=' . $uid . '" target="_blank"><i class="fa fa-eye text-primary"></i></a>
                        <a href="editbill.php?oid=' . $uid . '" class="mx-1"><i class="fa fa-edit text-primary"></i></a>
                        <a onclick="show(\'' . $oid . '\')"><i class="fa fa-trash"></i></a>
                   </td>',
      "Date"=>$row['date'],
   );
}
## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data,
  "query"=>$empQuery
);

echo json_encode($response);
?>

