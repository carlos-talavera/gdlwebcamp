<?php 

$archivo = basename($_SERVER['PHP_SELF']);
$pagina = str_replace(".php", "", $archivo);

if($pagina !== "login") {

?>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

<?php 

}

?>

  <!-- jQuery 3 -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<!--<script src="js/bootstrap.min.js"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Select2 -->
<script src="js/select2.full.min.js"></script>
<!-- SweetAlert 2 -->
<script src="js/sweetalert2.all.min.js"></script>
<!-- SlimScroll -->
<script src="js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- iCheck -->
<script src="js/icheck.min.js"></script>
<!-- DataTables funciones -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<!-- Datepicker -->
<script src="js/bootstrap-datepicker.min.js"></script>
<!-- Datepicker español -->
<script src="js/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<!-- Timepicker -->
<script src="js/bootstrap-timepicker.min.js"></script>
<!-- Font Awesome Icon Picker -->
<script src="js/fontawesome-iconpicker.min.js"></script>
<!-- Chart JS -->
<script src="js/Chart.js"></script>
<!-- Personal - Llamados a funciones jQuery de los plugins -->
<script src="js/app.js"></script>
<!-- Personal -->
<script src="js/scripts.js"></script>

<?php if($pagina !== "login") :?>

</body>
</html>

<?php endif; ?>