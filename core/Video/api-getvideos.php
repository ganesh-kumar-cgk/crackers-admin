<?php
    include '../config.php';

    function getVideos($tablename) {
        global $conn;
        
        $query = "SELECT * FROM $tablename ORDER BY id DESC"; 
        $result = mysqli_query($conn, $query);
        $rows="";
        if ($result) {
            $sno=1;
            while ($row = mysqli_fetch_array($result)) {
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
            echo $rows;
        }
    }
    getVideos("videos");
?>
