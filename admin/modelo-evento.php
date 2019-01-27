<?php

require_once '../includes/funciones/bd_conexion.php';
require_once 'funciones/fetch.php';

if(peticion_fetch()) {

    if(isset($_POST['accion'])) {

        if($_POST['accion'] == 'validar') {

            $nombre_evento = $_POST['nombre'];
            $query = $conn->query("SELECT * FROM eventos WHERE nombre_evento = '$nombre_evento'");

            if($query->num_rows > 0) {

                echo json_encode(array('status' => 'duplicado'));

            } else {

                echo json_encode(array('status' => 'no duplicado'));

            }

            $query->close();

        }

        else if(!empty($_POST['fecha']) && !empty($_POST['hora'])) {

            $nombre_evento = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            $fecha = str_replace("/", "-", $fecha);
            $hora = $_POST['hora'];
            $hora_space = explode(" ", $hora);
            $fecha_actual = date("Y-m-d h:i:s");

            if($hora_space[1] === "PM") { // Pura lógica juju

                $hora_puntos = explode(":", $hora);
                $hora_puntos[0] = (int) $hora_puntos[0] + 12;
                $hora_space[0] = (String) $hora_puntos[0] . ":" . explode(":", $hora_space[0])[1] . ":00";
                $hora_formateada = $hora_space[0];

            } else {

                $hora_space[0] = "0" . $hora_space[0];
                $hora_space[0] .= ":00";
                $hora_formateada = $hora_space[0];

            }
            
            $categoria = (int) $_POST['categoria'];
            $invitado = (int) $_POST['invitado'];

            if($_POST['accion'] == 'crear') {

                try {

                    $stmt = $conn->prepare("INSERT INTO eventos(nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_inv, ult_edicion) VALUES(?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssiis", $nombre_evento, $fecha, $hora_formateada, $categoria, $invitado, $fecha_actual);
                    $stmt->execute();

                    if($stmt->affected_rows > 0) {

                        $respuesta = array(
                            'status' => "Correcto",
                            'accion' => $_POST['accion']
                        );

                    } else {

                        $respuesta = array(
                            'status' => "Error",
                            'accion' => $_POST['accion']
                        );

                    }

                    $stmt->close();

                    echo json_encode($respuesta);

                } catch(Exception $e) {

                    die("Error: " . $e->getMessage());

                }

            } else if($_POST['accion'] == 'actualizar') {

                $id = $_POST['id'];

                try {

                    $stmt = $conn->prepare("UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, hora_evento = ?, id_cat_evento = ?, id_inv = ?, ult_edicion = ? WHERE evento_id = ?");
                    $stmt->bind_param("sssiisi", $nombre_evento, $fecha, $hora_formateada, $categoria, $invitado, $fecha_actual, $id);
                    $stmt->execute();

                    if($stmt->affected_rows > 0 || $stmt->sqlstate == "00000") {

                        $respuesta = array(
                            'status' => "Correcto",
                            'accion' => $_POST['accion']
                        );

                    } else {

                        $respuesta = array(
                            'status' => "Error",
                            'accion' => $_POST['accion']
                        );

                    }

                    $stmt->close();
                    echo json_encode($respuesta);

                } catch(Exception $e) {

                    die("Error: " . $e->getMessage());

                }

            }

        }

        else if($_POST['accion'] == 'eliminar') {

            if(!empty($_POST['id'])) {

                $id = (int) $_POST['id'];

                try {

                    $stmt = $conn->prepare("DELETE FROM eventos WHERE evento_id = ?");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();

                    if($stmt->affected_rows > 0) {

                        $respuesta = array(
                            'status' => "Correcto",
                            'id_eliminado' => $id
                        );

                    } else {

                        $respuesta = array(
                            'status' => "Error"
                        );

                    }

                    $stmt->close();
                    echo json_encode($respuesta);

                } catch(Exception $e) {

                    die("Error: " . $e->getMessage());

                }

            }

        }

        $conn->close();

    } else {

        header('location: login.php');

    }

} else {

    header('location: login.php');

}