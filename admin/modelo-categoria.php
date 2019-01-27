<?php 

require_once '../includes/funciones/bd_conexion.php';
require_once 'funciones/fetch.php';

if(peticion_fetch()) {

    if(!empty($_POST['accion'])) {

        if($_POST['accion'] == 'validar') {

            $nombre = $_POST['categoria'];

            try {

                $query = $conn->query("SELECT * FROM categoria_evento WHERE cat_evento = '{$nombre}'");

                if($query->num_rows > 0) {

                    echo json_encode(array('status' => 'Duplicado'));

                } else {

                    echo json_encode(array('status' => 'No duplicado'));

                }

                $query->close();

            } catch(Exception $e) {

                die("Error: " . $e->getMessage());

            }

        }

        else if($_POST['accion'] == 'crear') {

            $nombre = $_POST['categoria'];
            $icono = $_POST['icono'];

            try {

                $stmt = $conn->prepare("INSERT INTO categoria_evento(cat_evento, icono) VALUES (?, ?)");
                $stmt->bind_param("ss", $nombre, $icono);
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

        }
        
        else if($_POST['accion'] == 'actualizar') {

            $id = (int) $_POST['id'];
            $nombre = $_POST['categoria'];
            $icono = $_POST['icono'];

            try {

                $stmt = $conn->prepare("UPDATE categoria_evento SET cat_evento = ?, icono = ? WHERE id_categoria = ?");
                $stmt->bind_param("ssi", $nombre, $icono, $id);
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

        }

        else if($_POST['accion'] == 'eliminar') {

            if(!empty($_POST['id'])) {

                $id = (int) $_POST['id'];

                try {

                $stmt = $conn->prepare("DELETE FROM categoria_evento WHERE id_categoria = ?");
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

        }

        $conn->close();

    } else {

        header('location: login.php');

    }

} else {

    header('location: login.php');

}