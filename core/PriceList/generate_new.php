<?php
include '../config.php';
$sno=1;
$site_query="select * from sitesettings";
$site_result=mysqli_query($conn,$site_query);
$sitedetails=mysqli_fetch_array($site_result);

// print_r($sitedetails);

$logo=$sitedetails['site_logo'];
$site_name=$sitedetails['site_name'];
$contact1=$sitedetails['site_number'];
$contact2=$sitedetails['site_whatsapp_number'];
$address=$sitedetails['site_address'];
$site_offer=$sitedetails['site_discount'];

$html="
    <html>
        <head>
            <link href='https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300;700&display=swap' rel='stylesheet'> 
            <link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link href='https://fonts.googleapis.com/css2?family=Yesteryear&display=swap' rel='stylesheet'>
            <link href='https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap' rel='stylesheet'>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
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
                .pt-5{
                    padding-top:50px;
                }
                .logo__container{
                    width:100px;
                    position: relative;
                    left: 10%;
                }
                .logo__container .logo{
                    width:100%;
                    height:auto;
                }
                .d-flex{
                    display:flex;
                    flex-direction:row;
                }
                .justify-content-between{
                    justify-content:space-between;   
                }
                .align-items-center{
                    align-items:center;
                }
                .d-block{
                    display:block;
                }
                .text-center{
                    text-align:center;
                }
                .text-right{
                    text-align:right;
                }
                .shop_name{
                    font-weight:700;
                    font-size:22px;
                    color:red;
                }
                .bg-secondary{
                    background-color:#1b1e44;
                }
                .lh-2{
                    line-height:2.0;
                }
                .text-white{
                    color:white;
                }
                .topbar{
                    padding: 27px 20px 20px 25px;
                }
                .text-primary{
                    color:#ff3d1a;
                }
                .shop_title{
                    position: absolute;
                    left: 30%;
                }
                .shop_title label{
                    font-size:36px;
                    font-family: 'Black Ops One', cursive;
                }
                .title{
                    font-family: 'Black Ops One', cursive;
                    font-size:22px;
                }
                .text-green{
                    color:green;
                }
                .text-white{
                    color:white;
                }
                .pricelist-container{
                    background: #d33519;
                    position: absolute;
                    right: 10px;
                    top: 30px;
                    padding: 30px 28px;
                    border-top-left-radius: 45%;
                    border-bottom-left-radius: 45%;
                }
                .details{
                    line-height:1.5;
                }
                .icon{
                    margin: 0px 6px 0px 0px;
                }
            </style>
        </head>
    <body>
        <section class='topbar d-flex justify-content-between align-items-center bg-secondary'>
            <div class='logo__container'>";
$html.="<img src='https://refreshtechlabs.com/unobiTech/Unobi/images/logo/$logo' class='logo'>";
$html.=" </div>
            <div class='shop_title'>
                <label class='text-primary'>$site_name</label>
                <div class='text-white details'>
                    <div class='text-center'>
                        <span><i class='icon fa fa-whatsapp text-green'></i>$contact1</span>
                        <span><i class='icon fa fa-whatsapp text-green'></i>$contact2</span>
                    </div>
                    <div>
                        <span><i class='icon fa fa-globe text-white'></i> www.makkalsevaicrackers.com</span>
                        <span><i class='icon fa fa-home text-white'></i>$address</span>
                    </div>
                </div>
            </div>
            <div class='text-right text-white lh-2'>
                <div class='d-block pricelist-container'>
                    <label class='title'>2023 PriceList</label>
                </div>
                <div class='d-block'>
                    <label></label>
                </div>
            </div>
        </section>";
$html.="<table style='margin-top:0px;'>
            <thead>
                <tr>
                    <th>Sno</th>
                    <th>Product</th>
                    <th>MRP</th>
                    <th>Unit</th>
                    <th>Offer Price <br><label>$site_offer%</label></th>
                    <th>Qty</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>";
$q1="SELECT DISTINCT category.name FROM products INNER JOIN category ON products.category = category.name WHERE category.status = '1' ORDER BY category.rank ASC";
$r1=mysqli_query($conn,$q1);
while($ro1=mysqli_fetch_array($r1)){
    $category = $ro1['name'];
    $q2 = "SELECT products.name, products.mrp, products.discount AS product_discount, products.type, products.net_rate, products.status, products.selling_price, category.name AS category_name, category.discount AS category_discount FROM products JOIN category ON products.category = category.name WHERE products.status='1' AND products.category='$category' ORDER BY products.rank ASC;";
    $r2 = mysqli_query($conn,$q2);
    $html.="<tr>
                <td colspan='7' style='background-color:#1B1E44;color:white;text-align:center;'>".$category."</td>
            </tr>";
    while($ro2=mysqli_fetch_array($r2)){
        if(!empty($ro2['product_discount'])){
            if($ro2['net_rate'] == '1'){
                $offerPrice=$ro2['mrp'];
            }else{
                $pdiscount=$ro2['product_discount'];
                $offerPrice=$ro2['mrp']-($pdiscount / 100) * $ro2['mrp'];
            }
        }else if(!empty($ro2['category_discount'])){
            $cdiscount=$ro2['category_discount'];
            $offerPrice=$ro2['mrp']-($cdiscount / 100) * $ro2['mrp'];
        }else{
            $offerPrice=$ro2['mrp']-($site_offer / 100) * $ro2['mrp'];   
        }
        $html.="
                <tr>
                <td style='text-align:center;'>". $sno."</td>
                <td style='text-align:left;'>". $ro2['name'] ."</td>
                <td>". number_format($ro2['mrp'],2) ."</td>
                <td><span>". $ro2['type'] ."</span></td>
                <td>". number_format($offerPrice,2) ."</td>
                <td></td>
                <td></td>
            </tr>";
        $sno++;
    }
}
$html.="</tbody></html>";
echo $html;
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