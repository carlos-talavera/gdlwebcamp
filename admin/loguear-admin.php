<?php

require_once '../includes/funciones/bd_conexion.php';
require_once 'funciones/fetch.php';

if(peticion_fetch()) {

    if(!empty($_POST['usuario']) && !empty($_POST['pass'])) {

        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];

        $stmt = $conn->prepare("SELECT * FROM admins WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id, $usuario_bd, $nombre, $hash, $foto, $fecha_reg, $ult_edicion, $nivel);

        if($stmt->affected_rows) {
                    
            $existe = $stmt->fetch();

            if($existe) {

                if(password_verify($pass, $hash)) {

                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['usuario'] = $usuario_bd;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['foto'] = $foto;
                    $_SESSION['fecha_reg'] = $fecha_reg;
                    $_SESSION['nivel'] = $nivel;

                    $respuesta = array(
                        'status' => "OK",
                        'user' => $usuario_bd
                    );

                } else {

                    $respuesta = array(
                        'status' => "Datos incorrectos"
                    );

                }

            } else {

                $respuesta = array(
                    'status' => 'No existe'
                );

            }

        }

        $stmt->close();
        $conn->close();

        echo json_encode($respuesta);

    }

} else {

    header('location: login.php');

}