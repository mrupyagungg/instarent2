<script src="<?= base_url('assets/bundles/libscripts.bundle.js') ?>"></script>
<script src="<?= base_url('assets/bundles/vendorscripts.bundle.js') ?>"></script>
<script src="<?= base_url('assets/bundles/c3.bundle.js') ?>"></script>
<script src="<?= base_url('assets/bundles/jvectormap.bundle.js') ?>"></script> <!-- JVectorMap Plugin Js -->


<!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url('assets/bundles/datatablescripts.bundle.js') ?>"></script>
<script src="<?= base_url('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/jquery-datatable/buttons/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') ?>"></script>

<script src="<?= base_url('assets/js/theme.js') ?>"></script><!-- Custom Js -->
<script src="<?= base_url('assets/js/pages/tables/jquery-datatable.js') ?>"></script>

<script src="<?= base_url('assets/js/theme.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/index.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/todo-js.js') ?>"></script>

<script src="<?= base_url('assets/libs/pace-js/pace.min.js') ?>"></script>
<script src="<?= base_url('assets/notifications/js/notifications.min.js') ?>"></script>
<script src="<?= base_url('assets/notifications/js/notification-custom-script.js') ?>"></script>
<!-- <script src="<?= base_url('assets/libs/flatpickr/flatpickr.min.js') ?>"></script> -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>
<script src="<?= base_url('assets/js/number.js') ?>"></script>

<script>
    $('.dropify').dropify();
    $('#table').dataTable({});
    $("#basic-date").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d"
    });
    $("#basic").flatpickr({
        altInput: true,
        dateFormat: "Y-m-d",
        plugins: [
            new monthSelectPlugin({
                shorthand: true, //defaults to false
                altFormat: "F Y", //defaults to "F Y"
            })
        ]
    });
</script>


<script type="text/javascript">
    <?php if (session()->getFlashdata('success')) { ?>
        Lobibox.notify('info', {
            pauseDelayOnHover: true,
            icon: 'bx bx-check-circle',
            continueDelayOnInactiveTab: false,
            position: 'top center',
            size: 'mini',
            msg: '<?= session()->getFlashdata('success'); ?>'
        });
    <?php } else if (session()->getFlashdata('error')) {  ?>
        Lobibox.notify('error', {
            pauseDelayOnHover: true,
            icon: 'bx bx-x-circle',
            continueDelayOnInactiveTab: false,
            position: 'top center',
            size: 'mini',
            msg: '<?= session()->getFlashdata('error'); ?>'
        });
    <?php } else if (session()->getFlashdata('warning')) {  ?>
        Lobibox.notify('warning', {
            pauseDelayOnHover: true,
            icon: 'bx bx-error',
            continueDelayOnInactiveTab: false,
            position: 'top center',
            size: 'mini',
            msg: '<?= session()->getFlashdata('warning'); ?>'
        });
    <?php } else if (session()->getFlashdata('info')) {  ?>
        Lobibox.notify('info', {
            pauseDelayOnHover: true,
            icon: 'bx bx-info-circle',
            continueDelayOnInactiveTab: false,
            position: 'top center',
            size: 'mini',
            msg: '<?= session()->getFlashdata('info'); ?>'
        });
    <?php } ?>
</script>