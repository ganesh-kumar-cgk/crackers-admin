<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                ©
                <script>document.write(new Date().getFullYear())</script> Admin Panel<span class="d-none d-sm-inline-block"> -
                    Created <i class="mdi mdi-heart text-danger"></i> By UnobiTech.</span>
            </div>
        </div>
    </div>
</footer>
<script>
// Initialize DataTable with default limits
$(document).ready(function() {
    $('#datatable').DataTable({
        "pageLength": 50, // Default page length
        "lengthMenu": [50, 100], // Set available page lengths
    });
});
</script>