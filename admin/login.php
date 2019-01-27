<?php 

include_once 'templates/header.php';

session_start();

if(!empty($_SESSION)) {

  header('location: dashboard.php');

} else {

?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../index.php"><b>GDL</b>WebCamp</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Introduce tus datos para iniciar sesión</p>

    <form action="#" name="login-admin" id="login-admin">
      <div class="form-group has-feedback">
        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> <span class="remember-me-login">Recuérdame</span>
              <input type="hidden" id="returnURL" value=<?php if(isset($_GET['returnURL'])) {

                echo $_GET['returnURL'];

              } else {
                
                echo "";
                
              }?>>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <input type="submit" class="btn btn-primary btn-block btn-flat" name="btnLogin" id="btnLogin" value="Iniciar Sesión">
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php

include_once 'templates/footer.php';

?>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

<?php } ?>