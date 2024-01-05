<?php
    
    function getVideos($tablename="") {
        global $conn;
        if(!empty($tablename)){
            $query = "SELECT * FROM $tablename ORDER BY id DESC"; // Change 'products' to your actual table name
            $result = mysqli_query($conn, $query);
            $pattern = '/(?:youtube.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=|youtu.be\/|\/))(?P<id>[\w-]{11}))/i';
            $rows = "";
            if ($result) {
                $sno=1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $id=$row['id'];
                    $rows .= '<tr>';
                    $rows .= '<td>' . $sno++ . '</td>';
                    $video_id='';
                    if ((preg_match('/\/shorts\/([^\/?]+)/i', $row['url'], $matches)) or (preg_match('/[?&]v=([^&]+)/', $row['url'], $matches))) {
                        $video_id = $matches[1];
                    }
                    $embed_code = '<iframe width="250" height="150" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
                    $rows .= '<td>' . $embed_code . '</td>';
                    $rows .= '<td><a onclick="deleteProduct('.$id.')" ><i class="fa fa-trash text-danger"></i></a></td>';

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
    // getProducts("products");
?>
