<?php

require_once '../includes/funciones/bd_conexion.php';
require_once 'funciones/fetch.php';

if(peticion_fetch()) {

    if(!empty($_POST['accion'])) {

        if(isset($_POST['nombre'])) {

            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $descripcion = $_POST['descripcion'];

        }

        if($_POST['accion'] == 'crear') {

            $nombre_imagen = $_FILES['inputFile']['name'][0];
            $tipo_imagen = $_FILES['inputFile']['type'][0];
            $tamagno_imagen = (int) $_FILES['inputFile']['size'][0];

            if($tamagno_imagen < 20971520) {

                $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/gdlwebcamp/img/invitados/';

                if($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/gif") {

                    if(move_uploaded_file($_FILES['inputFile']['tmp_name'][0], $carpeta_destino . $nombre_imagen)) {

                        try {

                            $stmt = $conn->prepare("INSERT INTO invitados(nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES (?, ?, ?, ?)");
                            $stmt->bind_param("ssss", $nombre, $apellido, $descripcion, $nombre_imagen);
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

                        } catch(Exception $e) {

                            die("Error: " . $e->getMessage());

                        }

                    } else {

                        echo json_encode(array('status' => "No se ha podido subir la imagen al servidor, consulte al administrador del sitio"));

                    }

                } else {

                    echo json_encode(array('status' => "No se admite ese tipo de imagen"));

                }

            } else {

                echo json_encode(array('status' => "El tamaño de la imagen no puede exceder los 20 MB"));

            }

        }

        else if($_POST['accion'] == 'actualizar') {

            $id = (int) $_POST['id'];
            $respuesta = array();
            $respuesta2 = array();

            try {

                $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ? WHERE invitado_id = ?");
                $stmt->bind_param("sssi", $nombre, $apellido, $descripcion, $id);
                $stmt->execute();

                if($stmt->affected_rows > 0 || $stmt->sqlstate == "00000") {

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

            } catch(Exception $e) {

                die("Error: " . $e->getMessage());

            }

            if(isset($_FILES['inputFile']['name'][0])) {

                $nombre_imagen = $_FILES['inputFile']['name'][0];

                $query = $conn->query("SELECT url_imagen FROM invitados WHERE invitado_id = {$id}");

                if($query->fetch_assoc()['url_imagen'] == $nombre_imagen) {

                    $respuesta['status2'] = 'La imagen no puede ser la misma que la anterior';

                } else {

                    $tipo_imagen = $_FILES['inputFile']['type'][0];
                    $tamagno_imagen = (int) $_FILES['inputFile']['size'][0];

                    if($tamagno_imagen < 20971520) {

                        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/gdlwebcamp/img/invitados/';

                        if($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/gif") {

                            if(move_uploaded_file($_FILES['inputFile']['tmp_name'][0], $carpeta_destino . $nombre_imagen)) {

                                try {

                                    $stmt = $conn->prepare("UPDATE invitados SET url_imagen = ? WHERE invitado_id = ?");
                                    $stmt->bind_param("si", $nombre_imagen, $id);
                                    $stmt->execute();
                                    
                                    if($stmt->affected_rows > 0) {

                                        $respuesta2 = array(
                                            'status2' => 'Correcto'
                                        );

                                    } else {

                                        $respuesta2 = array(
                                            'status2' => 'Error'
                                        );

                                    }

                                    $stmt->close();

                                    foreach($respuesta2 as $clave => $valor) {

                                        $respuesta[$clave] = $valor;

                                    }

                                } catch(Exception $e) {

                                    die("Error: " . $e->getMessage());

                                }

                            } else {

                                echo json_encode(array('status2' => "No se ha podido subir la imagen al servidor, consulte al administrador del sitio"));

                            }

                        } else {

                            echo json_encode(array('status2' => "No se admite ese tipo de imagen"));

                        }

                    } else {

                        echo json_encode(array('status2' => "El tamaño de la imagen no puede exceder los 20 MB"));

                    }

                }

            }

            echo json_encode($respuesta);

        }

        else if($_POST['accion'] == 'eliminar') {

            $id = (int) $_POST['id'];

            try {

                $stmt = $conn->prepare("DELETE FROM invitados WHERE invitado_id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();

                if($stmt->affected_rows) {

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