<?php 

include 'funciones/fechas.php';
include 'funciones/funciones.php';

$pagina = str_replace(".php", "", basename($_SERVER['PHP_SELF']));

if($pagina != "login") {
  
  include 'funciones/sesiones.php';

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administración GDLWebCamp</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Font Awesome -->
  <!--<link rel="stylesheet" href="css/font-awesome.min.css">-->
  <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
  <!-- Ionicons -->
  <link rel="stylesheet" href="css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="css/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
  <!-- Datepicker -->
  <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
  <!-- Timepicker -->
  <link rel="stylesheet" href="css/bootstrap-timepicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="css/blue.css">
  <!-- iCheck All -->
  <link rel="stylesheet" href="css/iCheck/all.css">
  <!-- SweetAlert 2 -->
  <link rel="stylesheet" href="css/sweetalert2.min.css">
  <!-- Font Awesome Icon Picker-->
  <link rel="stylesheet" href="css/fontawesome-iconpicker.min.css">
  <!-- Personal -->
  <link rel="stylesheet" href="css/admin.css">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>