<!doctype html>
<html lang="en">

<?php include 'inc/head.php' ?>



<body data-sidebar="dark">

<!-- Loader -->
<?php include 'inc/loader.php' ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'inc/header.php' ?>

    <!-- ========== Left Sidebar Start ========== -->
    <?php include 'inc/left-sidebar.php' ?>
    <style>
        .billpage-content{
            padding-top: 91px;
            padding-bottom: 60px;
            margin: 6px -8px;
        }
    </style>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="billpage-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                        <div style="border-radius:50%;position: fixed;right: 15px;">
                            <button class="btn btn-dark waves-effect" onclick="showCart()"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                        </div>
                            <div class="card-body table-responsive">
                                <input type="text" id="search" placeholder="Product Id/Name" class="form-control" id="example-text-input" style="width:20%;"/>
                                <table class="table table-bordered table-sm mt-2" style="width:100%; overflow:auto;">
                                    <thead>
                                        <th>Sno</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $q1 = "SELECT * FROM category";
                                        $r1 = mysqli_query($conn, $q1);
                                        $sno=1;
                                        // Loop through categories
                                        while ($ro1 = mysqli_fetch_array($r1)) {
                                            $categoryName = $ro1['name'];
                                            $q2 = "SELECT * FROM products WHERE category = '$categoryName'";
                                            $r2 = mysqli_query($conn, $q2);
                                            // Check if there are any products in the current category
                                            if (mysqli_num_rows($r2) > 0) {
                                                ?>
                                                <tr>
                                                    <td align="center" colspan="5"><b class="text-primary"><?php echo $categoryName ?></b></td>
                                                </tr>
                                                <?php
                                                // Loop through products in the current category
                                                while ($ro2 = mysqli_fetch_array($r2)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $ro2['serialno']; ?></td>
                                                        <td><?php echo $ro2['name'] ?></td>
                                                        <td><input type="number" min="0" style="width:100px;text-align:center;" value="<?php echo $ro2['mrp'] ?>" /></td>
                                                        <td><input type="number" min="0" name="qty"  onkeyup="calc(this)"  style="width: 40px;text-align: center;border: 1px solid;"></td>
                                                        <td>₹<span class="subtotal">0</span></td>
                                                        <td class="visually-hidden"><?php echo $ro2['selling_price'] ?></td>
                                                        <td class="visually-hidden"><?php echo $ro2['id'] ?></td>
                                                        <td class="visually-hidden"><?php echo $ro2['discount'] ?></td>
                                                    </tr>
                                                    <?php
                                                        $sno++;
                                                        }
                                                    }
                                                }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3">

                    <div class="modal fade" id="CartModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">
                                        Place Order</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <table class="table table-stripped">
                                            <thead>
                                                <th>Sno</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </thead>
                                            <tbody id="cartTable">
                                            </tbody>
                                        </table>
                                        <div>
                                            <label style="position: relative;float: right;">GrandTotal:<span id="gd"></span></label>
                                        </div>
                                        <form method="post" class="mt-5" id="OrderForm" enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Discount</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" name="discount" type="number" min="0" max="100" placeholder="Enter Discount" oninput="applyDiscount(this)"  value="" id="example-text-input" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Name</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" name="name" type="text" placeholder="Enter Name"  value="" id="example-text-input" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Phone No</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" name="phoneno" type="text" placeholder="Enter Phone No"  value="" id="example-text-input" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Email</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" name="email" type="text" placeholder="Enter Email Address"  value="" id="example-text-input" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Address</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" name="address" type="text" placeholder="Enter Address"  value="" id="example-text-input" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Less For</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" name="less_for" type="text" placeholder="Enter Any Negotiation"  value="" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Notes</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" name="notes" type="text" placeholder="Enter Any Notes"  value="" id="example-text-input">
                                                </div>
                                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Place</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>
                <script>
                    var products=[];
                    var overall_mrp_total=0;
                    var overall_sp_total=0;
                    
                    function calc(input){
                        var row = $(input).closest('tr'); // Get the closest row
                        var qty = parseFloat($(input).val()) || 0;
                        // var mrp = parseFloat(row.find('td:eq(2)').text());
                        var mrp = parseFloat(row.find('td:eq(2) input').val()) || 0;
                        var mrp_total=mrp * qty;

                        var sp=parseFloat(row.find('td:eq(5)').text());
                        var sp_total=sp * qty;

                        var p_id=row.find('td:eq(6)').text();
                        var discount=row.find('td:eq(7)').text() || 0;

                        var resultCell = row.find('.subtotal');
                        resultCell.text(mrp_total);
                        
                        var rowData = {
                            sno: row.find('td:eq(0)').text(),
                            productName: row.find('td:eq(1)').text(),
                            mrp_price:mrp,
                            selling_price:sp,
                            selling_total:sp_total,
                            qty: qty,
                            mrp_total: mrp_total,
                            p_id: p_id,
                            discount: discount,
                        };

                        var existingRow = products.find(item => item.p_id === rowData.p_id);
                        if (existingRow) {
                            existingRow.qty = rowData.qty;
                            existingRow.mrp_total = rowData.mrp_total;

                            existingRow.qty = rowData.qty;
                            existingRow.selling_total = rowData.selling_total;


                            if (qty === 0) {
                                products = products.filter(item => item.p_id !== rowData.p_id);
                            }
                        } else {
                            products.push(rowData);
                        }
                        console.log(products);
                    }
                    
                    function showCart(){
                        const grandTotal = products.reduce((total, product) => total + product.mrp_total, 0);
                        const sp_total = products.reduce((total, product) => total + product.selling_total, 0);
                        overall_mrp_total=grandTotal;
                        overall_sp_total=sp_total;
                        if(grandTotal > 0){
                            var modal=$('#CartModal');
                            modal.modal('show');
                            var tblcontent="";
                            for(let i=0;i<products.length;i++){
                                tblcontent += `
                                        <tr>
                                        <td>${i + 1}</td>
                                        <td>${products[i].productName}</td>
                                        <td>₹${products[i].mrp_price}</td>
                                        <td>${products[i].qty}</td>
                                        <td>₹${products[i].mrp_total}</td>
                                        </tr>`;
                            }
                            $('#cartTable').html(tblcontent);
                            $('#gd').text(grandTotal);
                        }
                    }
                    
                    $('#OrderForm').submit(function(e){
                        e.preventDefault();
                        var formData=$(this).serialize();
                        $.ajax({
                            type: "POST",
                            url: "core/Orders/placeorder2.php",
                            data: {
                                formData: formData,
                                products: products,
                                overall_mrp_total:overall_mrp_total,
                                overall_sp_total:overall_sp_total
                            },
                            success: function(response) {
                                console.log(response);
                                location.href=`<?php echo $siteurl ?>invoice-bill.php?oid=${encodeURIComponent(response)}`;
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log("AJAX Error:", textStatus, errorThrown);
                            }
                        });
                    });
                    
                    function applyDiscount(input) {
                        var d=$(input).val();
                        var discount=overall_mrp_total-overall_mrp_total*(Number(d)/100);
                        $('#gd').text(discount);
                    }

                    
                </script>
                <script>
                    $(document).ready(function() {
                        $("#search").on("input", function() {
                            const searchTerm = $(this).val().toLowerCase().trim();
                    
                            $("tbody tr").each(function() {
                                const productName = $(this).find("td:nth-child(2)").text().toLowerCase();
                                const serialNumber = $(this).find("td:nth-child(1)").text().toLowerCase();
                    
                                if (productName.includes(searchTerm) || serialNumber.includes(searchTerm)) {
                                    $(this).show();
                                } else {
                                    $(this).hide();
                                }
                            });
                        });
                    });
                </script>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Footer-->
        <?php include 'inc/footer.php' ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<!-- Right Side Bar-->
<?php include 'inc/right-sidebar.php' ?>
</body>

</html>