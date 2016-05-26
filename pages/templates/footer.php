    
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.3.0
                </div>
                <strong>Copyright &copy; 2014-<?php echo date('Y'); ?> <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
            </footer>



        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- Sparkline -->
        <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- AdminLTE App -->
        <!--<script src="dist/js/app.min.js" type="text/javascript"></script>-->
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js" type="text/javascript"></script>
        <!-- FLOT CHARTS -->
        <script src="plugins/flot/jquery.flot.min.js" type="text/javascript"></script>

        <script src="plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script><!-- ChartJS 1.0.1 -->
        <script src="plugins/flot/jquery.flot.time.min.js" type="text/javascript"></script><!-- ChartJS 1.0.1 -->
        <script src="plugins/chartjs/Chart.min.js"></script>
        <!-- date-range-picker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>    
        <script>
            $(function () {
                $('.dataTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/French.json"
                    }
                });
                $('input[type="date"]').daterangepicker({
                    timePicker: false,
                    singleDatePicker: true
                });

            });
        </script>
    </body>
</html>
