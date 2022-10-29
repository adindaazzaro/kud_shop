<!-- jQuery -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/moment/moment.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/inputmask/jquery.inputmask.min.js"></script>

    <script type="text/javascript" src="{{asset('/')}}assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="{{asset('/')}}assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script type="text/javascript" src="{{asset('/')}}assets/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script type="text/javascript" src="{{asset('/')}}assets/dist/js/pages/dashboard.js"></script> --}}
    <!-- DataTables  & Plugins -->
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/jszip/jszip.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/dist/js/image-live.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/dist/js/custom.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/izitoast/js/iziToast.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/jquery-multiple-upload-image/dist/image-uploader.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/plugins/autonumeric/autoNumeric.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        $('[data-mask]').inputmask();
    </script>

    