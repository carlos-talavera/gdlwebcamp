<?php

require_once '../includes/funciones/bd_conexion.php';
require_once 'funciones/sesiones.php';
require_once 'funciones/fetch.php';

if(peticion_fetch()) {

    if(!empty($_POST['accion'])) {

        $respuesta = array();

        if($_POST['accion'] == 'validar') {

            if($_POST['extra'] == 'passIguales') {

                $id = $_POST['id'];
                $pass = $_POST['pass'];

                try {

                    $stmt = $conn->query("SELECT password FROM admins WHERE id_admin = {$id}");
                    $resultado = $stmt->fetch_assoc();
                    $hash = $resultado['password'];

                    if(password_verify($pass, $hash)) {

                        $respuesta = array(
                            'validacion' => 'Iguales'
                        );

                    } else {

                        $respuesta = array(
                            'validacion' => 'No iguales'
                        );

                    }

                    $stmt->close();
                    echo json_encode($respuesta);

                } catch(Exception $e) {

                    die("Error: " . $e->getMessage());

                }

            } else {

                $usuario = $_POST['usuario'];

                $query = $conn->query("SELECT * FROM admins WHERE usuario = '$usuario'");

                if($query->num_rows > 0) {

                    echo json_encode(array('status' => 'duplicado'));

                } else {

                    echo json_encode(array('status' => 'no duplicado'));

                }

            }

        } 
        
        else if($_POST['accion'] == 'crear') {

            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $contra = $_POST['password'];
            $pass_hash = password_hash($contra, PASSWORD_BCRYPT, array('cost' => 12));
            $fecha = date('Y-m-d H:i:s');
            $respuesta = array();

            $nombre_imagen = $_FILES['inputFile']['name'][0];
            $tipo_imagen = $_FILES['inputFile']['type'][0];
            $tamagno_imagen = $_FILES['inputFile']['size'][0];

            //Ruta de la carpeta de destino en servidor
            
            if($tamagno_imagen <= 2097152) {

                $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/gdlwebcamp/admin/img/admins/'; //DOCUMENT_ROOT = htdocs en este caso

                if($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/gif") {

                    //Mover la imagen del directorio temporal al directorio escogido

                    if(move_uploaded_file($_FILES['inputFile']['tmp_name'][0], $carpeta_destino . $nombre_imagen)) {

                        try {

                            $stmt = $conn->prepare("INSERT INTO admins(usuario, nombre, password, foto_perfil, fecha_registro, ult_edicion) VALUES (?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("ssssss", $usuario, $nombre, $pass_hash, $nombre_imagen, $fecha, $fecha);
                            $stmt->execute();

                            if($stmt->affected_rows) {

                                $respuesta = array(
                                    'status' => "OK"
                                );

                            } else {

                                $respuesta = array(
                                    'status' => "Error"
                                );

                            }

                            $stmt->close();

                        } catch(Exception $e) {

                            die("Error: " . $e->getMessage());

                        }

                    } else {

                        $respuesta = array(
                            'status' => "No se ha podido subir la imagen al servidor"
                        );

                    }

                } else {

                    $respuesta = array(
                        'status' => "Solo se pueden subir imágenes de los formatos especificados"
                    );

                }

            } else {

                $respuesta = array(
                    'status' => "El tamaño de la imagen es demasiado grande"
                );

            }

            echo json_encode($respuesta);

        }
        
        else if($_POST['accion'] == "actualizar") {

            $id = $_POST['id'];
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $nivel = $_POST['nivel'];
            $fecha = date("Y-m-d h:i:s");
            $respuestas = array();

            try {

                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, ult_edicion = ?, nivel = ? WHERE id_admin = ?");
                $stmt->bind_param("sssii", $usuario, $nombre, $fecha, $nivel, $id);
                $stmt->execute();

                if($stmt->affected_rows > 0) {

                    $respuesta = array(
                        'status' => "OK"
                    );

                } else {

                    $respuesta = array(
                        'status' => $stmt->error_list
                    );

                }

                foreach($respuesta as $clave => $valor) {

                    $respuestas[$clave] = $valor;

                }

                $stmt->close();

                } catch(Exception $e) {

                    die("Error: " . $e->getMessage());

                }

            if(isset($_POST['passNueva'])) {
            
                $passNueva = $_POST['passNueva'];
                $hash = password_hash($passNueva, PASSWORD_BCRYPT, array('cost' => 12));

                try {

                    $stmt = $conn->prepare("UPDATE admins SET password = ? WHERE id_admin = ?");
                    $stmt->bind_param("si", $hash, $id);
                    $stmt->execute();

                    if($stmt->affected_rows > 0) {

                        $respuesta2 = array(
                            'status2' => "OK"
                        );

                    } else {

                        $respuesta2 = array(
                            'status2' => $stmt->error_list
                        );

                    }

                    foreach($respuesta2 as $clave => $valor) {

                        $respuestas[$clave] = $valor;

                    }

                    $stmt->close();

                } catch(Exception $e) {

                    die("Error: " . $e->getMessage());

                }

            }

            if(isset($_FILES['inputFile']['name'][0])) {

                $nombre_imagen = $_FILES['inputFile']['name'][0];
                $tipo_imagen = $_FILES['inputFile']['type'][0];
                $tamagno_imagen = $_FILES['inputFile']['size'][0];

                if($tamagno_imagen <= 2097152) {

                    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/gdlwebcamp/admin/img/admins/'; //DOCUMENT_ROOT = htdocs en este caso

                    if($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/gif") {

                        //Mover la imagen del directorio temporal al directorio escogido

                        if(move_uploaded_file($_FILES['inputFile']['tmp_name'][0], $carpeta_destino . $nombre_imagen)) {

                            try {

                                $stmt = $conn->prepare("UPDATE admins SET foto_perfil = ? WHERE id_admin = ?");
                                $stmt->bind_param("si", $nombre_imagen, $id);
                                $stmt->execute();

                                if($stmt->affected_rows > 0) {

                                    $respuesta3 = array(
                                        'status3' => "OK"
                                    );

                                    if($id == $_SESSION['id']) {

                                        $_SESSION['foto'] = $nombre_imagen;

                                    }

                                } else {

                                    $respuesta3 = array(
                                        'status3' => $stmt->error_list
                                    );

                                }

                                foreach($respuesta3 as $clave => $valor) {

                                    $respuestas[$clave] = $valor;

                                }

                                $stmt->close();

                            } catch(Exception $e) {

                                die("Error: " . $e->getMessage());

                            }

                        } else {

                            $respuestas = array(
                                'status' => "No se ha podido subir la imagen al servidor"
                            );

                        }

                    } else {

                        $respuestas = array(
                            'status' => "Solo se pueden subir imágenes de los formatos especificados"
                        );

                    }

                } else {

                    $respuestas = array(
                        'status' => "El tamaño de la imagen es demasiado grande"
                    );

                }

            }

            echo json_encode($respuestas);

        }

        else if($_POST['accion'] == 'eliminar') {

            if(!empty($_POST['id'])) {

                $id = (int) $_POST['id'];

                try {

                    $stmt = $conn->prepare("DELETE FROM admins WHERE id_admin = ?");
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