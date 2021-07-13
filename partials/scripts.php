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
<!-- Required datatable js -->
<script src="../public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../public/plugins/datatables/dataTables.bootstrap5.min.js"></script>
<!-- Buttons examples -->
<script src="../public/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../public/plugins/datatables/buttons.bootstrap5.min.js"></script>
<script src="../public/plugins/datatables/jszip.min.js"></script>
<script src="../public/plugins/datatables/pdfmake.min.js"></script>
<script src="../public/plugins/datatables/vfs_fonts.js"></script>
<script src="../public/plugins/datatables/buttons.html5.min.js"></script>
<script src="../public/plugins/datatables/buttons.print.min.js"></script>
<script src="../public/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="../public/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../public/plugins/datatables/responsive.bootstrap4.min.js"></script>
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