<?php

function fechas($fecha) {

    $fecha = explode(" ", $fecha);
    $fecha = $fecha[0];
    $fecha = explode("-", $fecha);
    $year = $fecha[0];

    switch($fecha[1]) {

        case "01": $mes = "Enero";
        break;
        
        case "02": $mes = "Febrero";
        break;

        case "03": $mes = "Marzo";
        break;

        case "04": $mes = "Abril";
        break;

        case "05": $mes = "Mayo";
        break;

        case "06": $mes = "Junio";
        break;

        case "07": $mes = "Julio";
        break;

        case "08": $mes = "Agosto";
        break;

        case "09": $mes = "Septiembre";
        break;

        case "10": $mes = "Octubre";
        break;

        case "11": $mes = "Noviembre";
        break;

        case "12": $mes = "Diciembre";
        break;

    }

    return $mes . " de " . $year;

}