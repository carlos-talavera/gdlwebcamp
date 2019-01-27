<?php

function peticion_fetch() {

    return isset($_SERVER['HTTP_X_CUSTOM_HEADER']) && $_SERVER['HTTP_X_CUSTOM_HEADER'] === "FetchAPIRequest";

}

?>