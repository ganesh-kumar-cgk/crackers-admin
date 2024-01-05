

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
   $searchQuery = " and (name like '%".$searchValue."%' or 
        phone like '%".$searchValue."%' or 
        message like '%".$searchValue."%' or         
        created_on like '%".$searchValue."%' or         
        email like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($conn,"select count(distinct(id)) as allcount from contactus");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($conn,"select count(distinct(id)) as allcount from contactus WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from contactus WHERE 1 ".$searchQuery." order by ".'id'." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();
$sno =1;
while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array( 
      "Sno"=>$sno++,
      "Name"=>$row['name'],
      "Email"=>$row['email'],
      "Phone"=>$row['phone'],
      "Message" => '<a onclick="showMessage(\'' . $row['id'] . '\')"><i class="fa fa-eye text-primary"></i></a>',
      "Date"=>$row['created_on'],
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

