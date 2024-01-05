<?php
include '../config.php';
require '../../dompdf/autoload.inc.php';
$sno=1;
$dompdf =  new Dompdf\Dompdf;
$themeimage_top='makkal-sevai-pricelist-banner.jpg';

$topbar=$siteurl.'img/estimate/'.$themeimage_top;


$site_query="select * from site_settings";
$site_data = json_decode($row["value"], true);
$offer= $site_data['site_discount'];

$html ="
        <html>
        <head>
            <link href='https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300;700&display=swap' rel='stylesheet'> 
            <style>
                * {
                    font-family:  'Open Sans', sans-serif;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th{
                    padding: 5px;
                    font-size:15px;
                    background-color:#d33519;
                    text-align:center;
                    color:white;
                    border: 1px solid #1B1E44;
                }
                td {
                    padding: 5px;
                    text-align: right;
                    border: 1px solid #1B1E44;
                    color:black;
                }
            </style>
        </head>
        <body>
            <center>
              
            </center>
             <img src=$topbar width='100%'/>
            <table style='margin-top:0px;'>
            
                <thead>
               
                    <tr>
                        <th>Sno</th>
                        <th>Product</th>
                        <th>MRP</th>
                        <th>Unit</th>
                        <th>Offer Price <br><label>$offer%</label></th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
    ";
$query = "select distinct(category) from products";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result)){
    $category = $row['category'];
    $q1 = "select * from products where category='$category' AND status='1'";
    $r1 = mysqli_query($conn,$q1);
    $html.="<tr>
                <td colspan='7' style='background-color:#1B1E44;color:white;text-align:center;'>".$category."</td>
            </tr>";
    while($ro1=mysqli_fetch_array($r1)){
        $offerPrice=$ro1['mrp']-($offer / 100) * $ro1['mrp'];
        $html.="
                <tr>
                <td style='text-align:center;'>". $sno."</td>
                <td style='text-align:left;'>". $ro1['name'] ."</td>
                <td>". number_format($ro1['mrp'],2) ."</td>
                <td><span>". $ro1['type'] ."</span></td>
                <td>". number_format($offerPrice,2) ."</td>
                <td></td>
                <td></td>
            </tr>";
        $sno++;
    }
    
}

$html.="</table>
        </body>
        </html>";


$canvas = $dompdf->getCanvas(); 
     
$w = $canvas->get_width(); 
$h = $canvas->get_height(); 
     
$dompdf->set_option('enable_html5_parser', TRUE);	    
$dompdf->loadHtml($html);
$dompdf->set_paper('letter', 'portrait');	    
$dompdf->render();
$pdfOutput = $dompdf->output();
$dompdf->stream('price_list.pdf', array('Attachment' => false));
$filename="makkal_sevai_crackers_price_list.pdf";
file_put_contents('../../../images/'.$filename, $pdfOutput);
exit;

?>