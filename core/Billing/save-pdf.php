<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pdfData'])) {
    $pdfData = $_POST['pdfData'];
    // Decode base64 and save the PDF to your desired location
    $pdfBinary = base64_decode(preg_replace('#^data:application/\w+;base64,#i', '', $pdfData));
    $destination = "../../assets/uploads/pdf/output.pdf"; // Adjust the path
    file_put_contents($destination, $pdfBinary);
    echo "PDF saved to server: " . $destination;
} else {
    echo "Invalid request.";
}
?>
