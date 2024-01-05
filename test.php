<?php 
    $pname ='10,000 wala';
    $pname = str_replace(array('"', "'", ','), array('&quot;', '&#39;', '&#44;'), $pname);

    // Display the sanitized input
    echo "<p>Sanitized Product Name: " . $pname . "</p>";
?>