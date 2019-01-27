<?php

session_start();

if(PHP_SESSION_ACTIVE === true) {

    $_SESSION = null;

}

session_destroy();

header('location: login.php');