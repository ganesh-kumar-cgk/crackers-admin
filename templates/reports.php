<!doctype html>
<html lang="en">
<?php session_start() ?>
<?php include 'inc/head.php' ?>

<body data-sidebar="dark">


<!-- Loader -->
<?php include 'inc/loader.php' ?>
<?php include 'core/config.php' ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'inc/header.php' ?>

    <!-- ========== Left Sidebar Start ========== -->
    <?php include 'inc/left-sidebar.php' ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
        <div class="main-content">
         <div class="page-content" style="padding-bottom:160px;">
            <div class="container-fluid">
                <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-body">
                                    <div id="response"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title">Manage Reports</h4>
                                            <p class="card-title-desc">Datas will be displayed from current updation of database.</p>
                                        </div>
                                        <div>
                                            <button class="btn btn-dark" id="btnExport"><i class="fas fa-cloud-download-alt"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-8 d-flex gap-2">
                                            <div>
                                                <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                                    <input type="text" class="form-control" name="start" id="startdate" value="<?php echo date('01 M, Y'); ?>" placeholder="Start Date" />
                                                    <input type="text" class="form-control" name="end" id="enddate" value="<?php echo date('t M,Y'); ?>" placeholder="End Date" />
                                                </div>
                                            </div>
                                            <div>
                                                <select class="form-select" id="table">
                                                    <option disabled selected value="">Choose Table</option>
                                                    <option>Product</option>
                                                    <option>Invoice</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" id="search" class="btn btn-dark"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width:100%;overflow-x:scroll;display:none;" id="InvoiceTable">
                                        <table id="InvoiceTable" class="table table-striped table-bordered dt-responsive nowrap" 
                                            style="border-collapse: collapse; border-spacing: 0; ;">
        
                                            <thead>
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>OrderId</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Contact</th>
                                                    <th>Email</th>
                                                    <th>Total Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody id="InvoiceContent">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="width:100%;overflow-x:scroll;display:none;" id="ProductTable">
                                        <table id="ProductTable" class="table table-striped table-bordered dt-responsive nowrap" 
                                            style="border-collapse: collapse; border-spacing: 0; ;">
        
                                            <thead>
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Product</th>
                                                    <th>Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ProductContent">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
            </div>
            <script>
                $('#search').click(function(e){
                   e.preventDefault();
                   var startdate=$('#startdate').val();
                   var enddate=$('#enddate').val();
                   var table=$('#table').val();
                   var startDateObj = new Date(startdate);
                   var formattedStartDate = formatDateForSQL(startDateObj);
                   
                   var endDateObj = new Date(enddate);
                   var formattedEndDate = formatDateForSQL(endDateObj);
                   
                    //   console.log(formattedStartDate + ' - ' + formattedEndDate);
                    //   console.log(table);
                    
                    if($('#ProductTable').css('display') == 'block' && $('#InvoiceTable').css('display','none')){
                        $('#ProductTable').css('display','none');
                        $('#InvoiceTable').css('display','block');
                    }else if($('#InvoiceTable').css('display') == 'block' && $('#ProdcutTable').css('display','none')){
                        $('#ProductTable').css('display','block');
                        $('#InvoiceTable').css('display','none');
                    }
                    
                
                    $.ajax({
                       url:'core/Report/fetch.php',
                       method:'POST',
                       data:{'start':formattedStartDate,'end':formattedEndDate,table:table},
                       dataType: 'json', // Expected data type
                       success:function(response){
                            console.log(response);
                            if(response.productcontent){
                                $('#InvoiceTable').css('display','none');
                                $('#ProductTable').css('display','block');
                                $('#ProductContent').empty();
                                var data = JSON.parse(response.productcontent); 
                                var tbody=$('#ProductContent');
                                var sno=1;
                                if(data.length > 0){
                                    for(i=0;i<data.length;i++){
                                        var rowData = data[i];
                                        var row = $('<tr>');
                                        var c1=$('<td>').text(sno);
                                        var c2=$('<td>').text(rowData.product);
                                        var c3=$('<td>').text(rowData.qty);
                                        row.append(c1,c2,c3);
                                        tbody.append(row);
                                        sno++;
                                    }
                                    var totalRow=$('<tr>');
                                    var c1=$('<td>').text("");
                                    var c2=$('<td>').text("Total").attr('align','right');
                                    var c3=$('<td>').text(response.total_qty);
                                    totalRow.append(c1,c2,c3);
                                    tbody.append(totalRow);
                                }else{
                                    $('#ProductContent').html("<tr class='text-center' ><td colspan='3'><b>No Data Found</b></td></tr>");
                                }
                            }else if(response.tblcontent){
                                $('#InvoiceTable').css('display','block');
                                $('#ProductTable').css('display','none');
                                $('#InvoiceContent').empty();
                                var data = JSON.parse(response.tblcontent); 
                                $("#InvoiceTable").css("display", "block");
                                $("#ProductTable").css("display", "none");
                                $('#InvoiceContent').empty();
                                if(data.length > 0){
                                    var sno=1;
                                    var tbody=$('#InvoiceContent');
                                    for(i=0;i<data.length;i++){
                                        var rowData = data[i];
                                        var row = $('<tr>');
                                        var cell1 = $('<td>').text(sno);
                                        var cell2 = $('<td>').text(rowData.oid);
                                        var cell3 = $('<td>').text(rowData.name);
                                        var cell4 = $('<td>').text(rowData.address);
                                        var cell5 = $('<td>').text(rowData.phone);
                                        var cell6 = $('<td>').text(rowData.email);
                                        var cell7 = $('<td>').text(rowData.grand_total);
                                        row.append(cell1,cell2,cell3,cell4,cell5,cell6,cell7);
                                        tbody.append(row);
                                        sno++;
                                    }
                                    var totalRow=$('<tr>');
                                    var cell1=$('<td>').text("");
                                    var cell2=$('<td>').text("");
                                    var cell3=$('<td>').text("");
                                    var cell4=$('<td>').text("");
                                    var cell5=$('<td>').text("");
                                    var cell6=$('<td>').text("Total").attr('align','right');
                                    var cell7=$('<td>').text(response.total);
                                    totalRow.append(cell1,cell2,cell3,cell4,cell5,cell6,cell7);
                                
                                    var lastRow=$('<tr>');
                                    var cell1=$('<td>').text("");
                                    var cell2=$('<td>').text("");
                                    var cell3=$('<td>').text("");
                                    var cell4=$('<td>').text("");
                                    var cell5=$('<td>').text("");
                                    var cell6=$('<td>').text("No of Customers").attr('align','right');
                                    var cell7=$('<td>').text(response.noc);
                                    lastRow.append(cell1,cell2,cell3,cell4,cell5,cell6,cell7);
                                    tbody.append(totalRow,lastRow);
                                }else{
                                    $('#InvoiceContent').html("<tr class='text-center' ><td colspan='7'><b>No Data Found</b></td></tr>");
                                }   
                            }else if(response.message){
                                var error=`<div class="alert alert-danger bg-danger text-white mb-0" role="alert">
                                            <strong>Please Choose table and Search</strong>
                                    </div>`;
                                $('#response').html(error);
                                setTimeout(function() {
                                    console.log("called error");
                                    $('#response').empty();
                                }, 2000);
                            }
                       },
                       error:function(error){
                           console.log(error);
                       }
                    });
                
                });
                function formatDateForSQL(dateObj) {
                    var year = dateObj.getFullYear();
                    var month = String(dateObj.getMonth() + 1).padStart(2, '0'); // Month is 0-based
                    var day = String(dateObj.getDate()).padStart(2, '0');
                
                    return year + '-' + month + '-' + day;
                }
            </script>
            
            <script>
                class csvExport {
                      constructor(table, header = true) {
                        this.table = table;
                        this.rows = Array.from(table.querySelectorAll("tr"));
                        if (!header && this.rows[0].querySelectorAll("th").length) {
                          this.rows.shift();
                        }
                        // console.log(this.rows);
                        // console.log(this._longestRow());
                      }

                      exportCsv() {
                        const lines = [];
                        const ncols = this._longestRow();
                        for (const row of this.rows) {
                          let line = "";
                          for (let i = 0; i < ncols; i++) {
                            if (row.children[i] !== undefined) {
                              line += csvExport.safeData(row.children[i]);
                            }
                            line += i !== ncols - 1 ? "," : "";
                          }
                          lines.push(line);
                        }
                        //console.log(lines);
                        return lines.join("\n");
                      }
                      _longestRow() {
                        return this.rows.reduce((length, row) => (row.childElementCount > length ? row.childElementCount : length), 0);
                      }
                      static safeData(td) {
                        let data = td.textContent;
                        //Replace all double quote to two double quotes
                        data = data.replace(/"/g, `""`);
                        //Replace , and \n to double quotes
                        data = /[",\n"]/.test(data) ? `"${data}"` : data;
                        return data;
                      }
                }

                const btnExport = document.querySelector("#btnExport");

                btnExport.addEventListener("click", () => {
                    if($('#InvoiceTable').css('display')=='block'){
                        console.log("Genertaing Invoice Data");
                        const tableElement = document.querySelector("#InvoiceTable");
                        var tbody = document.getElementById("InvoiceContent");
                        var rows = tbody.getElementsByTagName("tr");
                        if(rows.length > 1){
                          const obj = new csvExport(tableElement);
                          const csvData = obj.exportCsv();
                          const blob = new Blob([csvData], { type: "text/csv" });
                          const url = URL.createObjectURL(blob);
                          const a = document.createElement("a");
                          a.href = url;
                          a.download = "invoice.csv";
                          a.click();
                        
                          setTimeout(() => {
                            URL.revokeObjectURL(url);
                          }, 500);   
                        }else{
                            var error=`<div class="alert alert-danger bg-danger text-white mb-0" role="alert">
                                            <strong>No Data To Download</strong>
                                    </div>`;
                            $('#response').html(error);
                            setTimeout(function() {
                                console.log("called error");
                                $('#response').empty();
                            }, 2000);
                        }   
                    }else if($('#ProductTable').css('display')=='block'){
                        const tableElement = document.querySelector("#ProductTable");
                        console.log("Generating Product Data");
                        var tbody = document.getElementById("ProductContent");
                        var rows = tbody.getElementsByTagName("tr");
                        if(rows.length > 1){
                          const obj = new csvExport(tableElement);
                          const csvData = obj.exportCsv();
                          const blob = new Blob([csvData], { type: "text/csv" });
                          const url = URL.createObjectURL(blob);
                          const a = document.createElement("a");
                          a.href = url;
                          a.download = "product.csv";
                          a.click();
                        
                          setTimeout(() => {
                            URL.revokeObjectURL(url);
                          }, 500);   
                        }else{
                            var error=`<div class="alert alert-danger bg-danger text-white mb-1" role="alert">
                                            <strong>No Data To Download</strong>
                                    </div>`;
                            $('#response').html(error);
                            setTimeout(function() {
                                console.log("called error");
                                $('#response').empty();
                            }, 2000);
                        }   
                    }else{
                        var error=`<div class="alert alert-danger bg-danger text-white mb-0" role="alert">
                                            <strong>Please Choose Table And Search</strong>
                                    </div>`;
                        $('#response').html(error);
                        setTimeout(function() {
                            console.log("called error");
                            $('#response').empty();
                        }, 2000);
                    }
                });
            </script>
        </div>
        </div>
    <!-- end main content-->

</div>
<div id="google_translate_element"></div>
<!-- END layout-wrapper -->

<?php include 'inc/right-sidebar.php' ?>

</body>

</html>