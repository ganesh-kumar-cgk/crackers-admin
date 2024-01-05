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
                font-size:36px;
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
            .shop_title label{
                font-size:36px;
                position:relative;
                left:-12%;
                font-family: 'Black Ops One', cursive;
            }
            .icon{
                margin: 0px 6px 0px 0px;
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
                position: absolute;
                top: 14%;
                left: 25%;
                line-height:1.5;
            }
        </style>
    </head>
    <body>
        <section class='topbar d-flex justify-content-between align-items-center bg-secondary'>
            <div class='logo__container'>
                <img src='https://www.makkalsevaicrackers.com/images/logo.png' class='logo'>
            </div>
            <div class='shop_title text-center'>
                <label class='text-primary'>MAKKAL SEVAI CRACKERS</label>
                <div class='text-white details'>
                    <div class='text-center'>
                        <span><i class='icon fa fa-whatsapp text-green'></i> 918637413971</span>
                        <span><i class='icon fa fa-whatsapp text-green'></i> 918072685689</span>
                    </div>
                    <div>
                        <span><i class='icon fa fa-globe text-white'></i> www.makkalsevaicrackers.com</span>
                        <span><i class='icon fa fa-home text-white'></i>30,Quaide E Millath Street ,Sivakasi 623-123</span>
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
        </section>
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
                <tr>
                    <td style='text-align:center;'>1.</td>
                    <td style='text-align:left;'>Anwar King</td>
                    <td>600</td>
                    <td><span>1</span></td>
                    <td>500</td>
                    <td>10</td>
                    <td>5000</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>