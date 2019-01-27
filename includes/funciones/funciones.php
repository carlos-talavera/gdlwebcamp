<?php

function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0) { // Pasar por referencia implica que los cambios que se hagan dentro de la función, afectarán a las variables originales

  $dias = array(0 => "un_dia", 1 => "pase_completo", 2 => "dos_dias");
  $total_boletos = array_combine($dias, $boletos); // Lifehacks, bueno, combinar dos arrays de la misma cantidad de elementos
  // Usa los valores del primer parámetro como llaves y los valores del segundo, como valores
  $json = array();

  foreach($total_boletos as $clave => $boletos) {

    if((int) $boletos > 0) {

      $json[$clave] = (int) $boletos;

    }

  }

  $camisas = (int) $camisas;

  if($camisas > 0) {

    $json['camisas'] = $camisas;

  }

  $etiquetas = (int) $etiquetas;

  if($etiquetas > 0) {

    $json['etiquetas'] = $etiquetas;

  }

  return json_encode($json);

}

function eventos_json(&$eventos) {

  $eventos_json = array();

  foreach($eventos as $evento) {

    $eventos_json['eventos'][] = $evento;

  }

  return json_encode($eventos_json);

}
