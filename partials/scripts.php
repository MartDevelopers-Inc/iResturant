<!-- JQuerry -->
<script src="../public/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../public/js/bootstrap.bundle.min.js"></script>
<!-- Mentis Menu -->
<script src="../public/js/metismenu.min.js"></script>
<!-- Waves -->
<script src="../public/js/waves.js"></script>
<!-- Feather Icons -->
<script src="../public/js/feather.min.js"></script>
<!-- Simple Bar -->
<script src="../public/js/simplebar.min.js"></script>
<!-- Moment Js -->
<script src="../public/js/moment.js"></script>
<!-- Date Range Picker -->
<script src="../public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Apex Charts -->
<script src="../public/plugins/apex-charts/apexcharts.min.js"></script>
<!-- Vector Map -->
<script src="../public/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../public/plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
<!-- Analytics Dashboard -->
<?php require_once('chart_js.php'); ?>
<!-- App js -->
<script src="../public/js/app.js"></script>
<!-- datatable js  cdns-->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<!-- Leaflet Js -->
<script src="../public/plugins/leaflet/leaflet.js"></script>
<!-- Light Pick -->
<script src="../public/plugins/lightpick/lightpick.js"></script>
<!-- Profile Init -->
<script src="../public/pages/jquery.profile.init.js"></script>
<!-- Light Box -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
<!-- Init Js -->
<!-- Summernote CSS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- File Uploads  -->
<script src="../public/js/bs-custom-file-input.min.js"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
    });

    /* Init Summernote */
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 120,
        });
    });
    $(document).ready(function() {
        $('.table').DataTable();
    });

    $(document).ready(function() {
        $('#export-data-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    /* Print Receipts */
    function printContent(el) {
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>

<!-- Izi Toast Js -->
<script src="../public/plugins/iziToast/iziToast.min.js"></script>
<!-- Init Izi Toast -->
<?php if (isset($success)) { ?>
    <!--This code for injecting success alert-->
    <script>
        iziToast.success({
            title: 'Success',
            position: 'topRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            transitionInMobile: 'fadeInUp',
            transitionOutMobile: 'fadeOutDown',
            message: '<?php echo $success; ?>',
        });
    </script>

<?php } ?>

<?php if (isset($err)) { ?>
    <!--This code for injecting error alert-->
    <script>
        iziToast.error({
            title: 'Error',
            timeout: 10000,
            resetOnHover: true,
            position: 'topRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            transitionInMobile: 'fadeInUp',
            transitionOutMobile: 'fadeOutDown',
            message: '<?php echo $err; ?>',
        });
    </script>

<?php } ?>

<?php if (isset($info)) { ?>
    <!--This code for injecting info alert-->
    <script>
        iziToast.warning({
            title: 'Warning',
            position: 'topLeft',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            transitionIn: 'fadeInUp',
            transitionInMobile: 'fadeInUp',
            transitionOutMobile: 'fadeOutDown',
            message: '<?php echo $info; ?>',
        });
    </script>

<?php }
?>
<script>
    /* Ajax Scripts */
    function GetRoomCategoryID(val) {
        /* Get Room Category ID */
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'RoomCategoryName=' + val,
            success: function(data) {
                //alert(data);
                $('#RoomCategoryID').val(data);
            }
        });

    }

    function GetRoomDetails(val) {
        /* Get Room Number */
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'RoomNumber=' + val,
            success: function(data) {
                //alert(data);
                $('#RoomID').val(data);
            }
        });
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'RoomID=' + val,
            success: function(data) {
                //alert(data);
                $('#RoomCost').val(data);
            }
        });

    }

    function GetClientDetails(val) {
        /* Get Client Details */
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'ClientPhone=' + val,
            success: function(data) {
                //alert(data);
                $('#ClientID').val(data);
            }
        });

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'ClientID=' + val,
            success: function(data) {
                //alert(data);
                $('#ClientEmail').val(data);
            }
        });

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'ClientEmail=' + val,
            success: function(data) {
                //alert(data);
                $('#ClientName').val(data);
            }
        });

    }

    function getCustomerDetails(val) {
        /* Get Client Details */
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'CustomerID=' + val,
            success: function(data) {
                //alert(data);
                $('#CustomerEmail').val(data);
            }
        });

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'CustomerEmail=' + val,
            success: function(data) {
                //alert(data);
                $('#CustomerName').val(data);
            }
        });

    }

    function GetMealCategoryDetails(val) {
        /* Get Meal Category ID */
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'MealCategoryName=' + val,
            success: function(data) {
                //alert(data);
                $('#MealCategoryID').val(data);
            }
        });

    }

    function GetStaffDetails(val) {
        $.ajax({
            /* Staff ID */
            type: "POST",
            url: "ajax.php",
            data: 'StaffNumber=' + val,
            success: function(data) {
                //alert(data);
                $('#StaffId').val(data);
            }
        });
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'StaffId=' + val,
            success: function(data) {
                //alert(data);
                $('#StaffName').val(data);
            }
        });
        $.ajax({
            /* Staff Email */
            type: "POST",
            url: "ajax.php",
            data: 'StaffName=' + val,
            success: function(data) {
                //alert(data);
                $('#StaffEmail').val(data);
            }
        });
        $.ajax({
            /* Staff Phone No */
            type: "POST",
            url: "ajax.php",
            data: 'StaffEmail=' + val,
            success: function(data) {
                //alert(data);
                $('#StaffPhoneNumber').val(data);
            }
        });
    }

    function getMenuDetails(val) {
        /* Get Meal Price */
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'MealID=' + val,
            success: function(data) {
                //alert(data);
                $('#MealPrice').val(data);
            }
        });

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'MealPrice=' + val,
            success: function(data) {
                //alert(data);
                $('#MealName').val(data);
            }
        });

    }
</script>