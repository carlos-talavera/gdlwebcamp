<?php

function usuario_autenticado() {

  if(!revisar_usuario()) {

    header('location: login.php?returnURL=' . basename($_SERVER['PHP_SELF']));
    exit();

  }

}

function revisar_usuario() {

  return(isset($_SESSION['usuario']));

}

session_start();
usuario_autenticado();