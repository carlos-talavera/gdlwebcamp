<?php

  $conn = new mysqli("", "", "", "");
  $conn->set_charset("UTF8");
  date_default_timezone_set('America/Mexico_City');

  if($conn->connect_error) {

    $error = $conn->connect_error;
    echo $error;

  }
