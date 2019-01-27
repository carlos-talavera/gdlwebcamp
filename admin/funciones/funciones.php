<?php

include_once '../includes/funciones/bd_conexion.php'; // Como se llama desde otra página, debe usarse la ruta como si se estuviera en esa página

function cat_inv($tipo = null) {

    global $conn;

    if($tipo == "categoria") {

        $queryCat = $conn->query("SELECT id_categoria, cat_evento FROM categoria_evento");
        $categorias = array();
        $idsCat = array();
        $contadorCat = 0;

        while($registro = $queryCat->fetch_assoc()) {

            $idsCat[$contadorCat] = $registro['id_categoria'];
            $categorias[$contadorCat] = $registro['cat_evento'];
            $contadorCat++;

        }

        $arrays_combinados[0] = $idsCat;
        $arrays_combinados[1] = $categorias;

        return $arrays_combinados;

    }

    else if($tipo == "invitado") {

        $queryInv = $conn->query("SELECT invitado_id, nombre_invitado, apellido_invitado FROM invitados");
        $invitados = array();
        $idsInv = array();
        $contadorInv = 0;

        while($registro = $queryInv->fetch_assoc()) {

            $idsInv[$contadorInv] = $registro['invitado_id'];
            $invitados[$contadorInv] = $registro['nombre_invitado'] . " " . $registro['apellido_invitado'];
            $contadorInv++;

        }

        $arrays_combinados[0] = $idsInv;
        $arrays_combinados[1] = $invitados;

        return $arrays_combinados;

    } else {

        echo "Error: No se ha especificado el tipo";

    }

}