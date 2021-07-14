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
<script src="../public/pages/jquery.analytics_dashboard.init.js"></script>
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
<!-- Select 2  -->
<script src="../public/plugins/select2/select2.min.js"></script>
<script src="../public/plugins/select2/custom-select2.js"></script>
<!-- Init Js -->
<script>
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