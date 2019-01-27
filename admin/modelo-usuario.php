<?php

require_once '../includes/funciones/bd_conexion.php';
require_once 'funciones/fetch.php';

if(peticion_fetch()) {

    if(!empty($_POST['accion'])) {

        if($_POST['accion'] == 'validarEmail') {

            $email = $_POST['email'];

            try {

                $query = $conn->query("SELECT email_registrado FROM registrados WHERE email_registrado = '{$email}'");

                if($query->num_rows > 0) {

                    $respuesta = array(
                        'status' => 'Duplicado'
                    );

                } else {

                    $respuesta = array(
                        'status' => 'No duplicado'
                    );

                }

                $query->close();

                echo json_encode($respuesta);

            } catch(Exception $e) {

                die("Error: " . $e->getMessage());

            }

        }

        if(!empty($_POST['nombre'])) {

            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $articulos = $_POST['articulos'];
            $talleres = json_encode($_POST['registro']);
            $regalo = (int) $_POST['regalo'];
            $total = (double) $_POST['total'];
            $pagado = (int) $_POST['pagado'];
            $fecha = date("Y-m-d H:i:s");

        }

        if($_POST['accion'] == 'crear') {

            try {
                
                $stmt = $conn->prepare("INSERT INTO registrados(nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado, pagado, ult_edicion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssidis", $nombre, $apellido, $email, $fecha, $articulos, $talleres, $regalo, $total, $pagado, $fecha);
                $stmt->execute();

                if($stmt->affected_rows > 0) {

                    $respuesta = array(
                        'status' => 'Correcto',
                        'accion' => $_POST['accion']
                    );

                } else {

                    $respuesta = array(
                        'status' => 'Error'
                    );

                }

                $stmt->close();

                echo json_encode($respuesta);

            } catch (Exception $e) {
                
                die("Error: " . $e->getMessage());

            }

        }

        else if($_POST['accion'] == 'actualizar') {

            $id = (int) $_POST['id'];

            try {

                $stmt = $conn->prepare("UPDATE registrados SET nombre_registrado = ?, apellido_registrado = ?, email_registrado = ?, pases_articulos = ?, talleres_registrados = ?, regalo = ?, total_pagado = ?, pagado = ?, ult_edicion = ? WHERE ID_Registrado = ?");
                $stmt->bind_param("sssssiiisi", $nombre, $apellido, $email, $articulos, $talleres, $regalo, $total, $pagado, $fecha, $id);
                $stmt->execute();

                if($stmt->affected_rows > 0 || $stmt->sql_state == '00000') {

                    $respuesta = array(
                        'status' => 'Correcto',
                        'accion' => $_POST['accion']
                    );

                } else {

                    $respuesta = array(
                        'status' => 'Error'
                    );

                }

                $stmt->close();
                
                echo json_encode($respuesta);

            } catch(Exception $e) {

                die("Error: " . $e->getMessage());

            }

        }

        else if($_POST['accion'] == 'eliminar') {

            $id = (int) $_POST['id'];

            try {

                $stmt = $conn->prepare("DELETE FROM registrados WHERE ID_Registrado = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();

                if($stmt->affected_rows > 0) {

                    $respuesta = array(
                        'status' => 'Correcto',
                        'id_eliminado' => $id
                    );

                } else {

                    $respuesta = array(
                        'status' => 'Error'
                    );

                }

                $stmt->close();

                echo json_encode($respuesta);

            } catch(Exception $e) {

                die("Error: " . $e->getMessage());

            }

        }

        $conn->close();

    } else {

        header('location: login.php');

    }

} else {

    header('location: login.php');

}