<?php

    include_once '../includes/funciones/bd_conexion.php';

    $sql = "SELECT COUNT(*) as cantidad, fecha_registro FROM registrados GROUP BY DATE(fecha_registro) ORDER BY fecha_registro ASC";
    $query = $conn->query($sql);
    $arreglo_registros = array();

    while($resultado = $query->fetch_assoc()) {

        $resultado['fecha_registro'] = date('Y-m-d', strtotime($resultado['fecha_registro']));

        $registro['fecha'] = $resultado['fecha_registro'];
        $registro['cantidad'] = $resultado['cantidad'];
        
        $arreglo_registros[] = $registro;
        
    }
    
    echo json_encode($arreglo_registros);

?>