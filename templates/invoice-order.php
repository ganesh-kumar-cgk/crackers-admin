<!DOCTYPE html>
<html class="no-js" lang="en">
<?php include 'core/config.php' ?>
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>General Purpose Invoice-3</title>
  <link rel="stylesheet" href="assets/invoice/css/style.css">
</head>
<body>
    <?php 
        $oid=$_GET['oid'];
        $oid =str_replace("_", "#", $oid);
        $query="select * from orders where oid='$oid'";
        $sitequery="select * from sitesettings where id=1";
        $siteresult=mysqli_query($conn,$sitequery);
        $sitedetails=mysqli_fetch_assoc($siteresult);
        $result1=mysqli_query($conn,$query);
        $result=mysqli_query($conn,$query);
        $sno=1;
        $details = mysqli_fetch_assoc($result1);
        $pq="select color from pdf_settings where id=1";
        $pr=mysqli_query($conn,$pq);
        $pdf=mysqli_fetch_assoc($pr);
    ?>
    <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="<?php echo $mainurl ?>images/logo/<?php echo $sitedetails['site_logo'] ?>" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right tm_text_right tm_mobile_hide">
              <div class="tm_f50 tm_text_uppercase tm_white_color">Estimate</div>
            </div>
            <div class="tm_shape_bg tm_accent_bg tm_mobile_hide" style="background-color:<?php echo $pdf['color'] ?> !important"></div>
          </div>
          <div class="tm_invoice_info tm_mb25">
            <div class="tm_card_note tm_mobile_hide"><b class="tm_primary_color"> </b> </div>
            <div class="tm_invoice_info_list tm_white_color">
              <p class="tm_invoice_number tm_m0">Invoice No: <b><?php echo $oid ?></b></p>
              <p class="tm_invoice_date tm_m0">Date: <b><?php echo date('jS F Y',strtotime($details['created_on'])); ?></b></p>
            </div>
            <div class="tm_invoice_seperator tm_accent_bg" style="background-color:<?php echo $pdf['color'] ?> !important"></div>
          </div>
          <div class="tm_invoice_head tm_mb10">
            <div class="tm_invoice_left">
              <p class="tm_mb2"><b class="tm_primary_color">Invoice To:</b></p>
              <p>
                <?php echo $details['name']; ?><br>
                <?php echo $details['address'] ?> <br>
                <?php echo $details['email'] ?>
              </p>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <p class="tm_mb2"><b class="tm_primary_color">Pay To:</b></p>
              <p>
                <?php echo $sitedetails['site_name']?><br>
                <?php echo $sitedetails['site_address']?><br>
                <?php echo $sitedetails['site_email']?><br>
              </p>
            </div>
          </div>
          <div class="tm_table tm_style1">
            <div class="">
              <div class="tm_table_responsive">
                <table>
                  <thead>
                    <tr class="tm_accent_bg" style="background-color:<?php echo $pdf['color'] ?> !important">
                      <th class="tm_width_3 tm_semi_bold tm_white_color">Item</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color">Price</th>
                      <th class="tm_width_1 tm_semi_bold tm_white_color">Qty</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        while($row=mysqli_fetch_array($result)){
                            if (1==1) {
                                $name=$row['name'];
                                $address=$row['address'];
                                $email=$row['email'];
                                $address=$row['address'];
                                $overall_mrp=$row['overall_mrp_total'];
                                $overall_sp=$row['overall_total'];   
                            }
                    ?>
                    <tr>
                      <td class="tm_width_3"><?php echo $sno.'.';?><?php echo $row['pname'] ?></td>
                      <td class="tm_width_2"><?php echo '₹'.number_format($row['mrp'],2); ?></td>
                      <td class="tm_width_1"><?php echo $row['quantity'] ?></td>
                      <td class="tm_width_2 tm_text_right"><?php echo '₹'.number_format($row['mrp_total'],2); ?></td>
                    </tr>
                    <?php $sno++;} ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md" style="justify-content:end;">
              <div class="tm_right_footer">
                <table class="tm_mb15">
                  <tbody>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Subtoal</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?php echo '₹'.number_format($overall_mrp,2) ?></td>
                    </tr>
                    <tr class="tm_gray_bg">
                      <td class="tm_width_3 tm_primary_color">Discount (<?php echo $details['discount']; ?>%)</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right">-<?php echo '₹'.number_format($overall_mrp-$overall_mrp*($details['discount']/100),2); ?></td>
                    </tr>
                    <tr class="tm_accent_bg" style="background-color:<?php echo $pdf['color'] ?> !important">
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand Total	</td>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right"><?php echo '₹'.number_format($details['total'],2); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tm_note tm_text_center tm_font_style_normal">
            <hr class="tm_mb15">
            <p class="tm_mb2"><b class="tm_primary_color">Terms & Conditions:</b></p>
            <p class="tm_m0">Thanks For Estimating.</p>
          </div><!-- .tm_note -->
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Print / Save Pdf</span>
        </a>
      </div>
    </div>
  </div>
  <script src="assets/invoice/js/jquery.min.js"></script>
  <script src="assets/invoice/js/jspdf.min.js"></script>
  <script src="assets/invoice/js/html2canvas.min.js"></script>
  <script src="assets/invoice/js/main.js"></script>
</body>
</html>