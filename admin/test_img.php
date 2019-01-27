<?php 

require_once '../includes/funciones/bd_conexion.php';

/*$query = $conn->query("SELECT * FROM admins WHERE id_admin = 1");

while($fila = $query->fetch_assoc()) {

    $foto = $fila['foto_perfil'];

}*/

/* Asignar a la última edición el mismo valor de la fecha de registro, usado cuando se creó el campo de última edición, pues se creó después */
/*
$query = $conn->query("SELECT id_admin, fecha_registro FROM admins");
$fechas = array();
$ids = array();
$contador = 0;

while($fila = $query->fetch_assoc()) {

    $fechas[$contador] = $fila['fecha_registro'];
    $ids[$contador] = $fila['id_admin'];

    $contador++;

}

for($i = 0; $i < count($fechas); $i++) {

    try {

        $conn->query("UPDATE admins SET ult_edicion = '" . $fechas[$i] . "' WHERE id_admin = " . $ids[$i]);

    } catch(Exception $e) {

        echo $e->getMessage() . "<br>";

    }

}
*/

/*$id = 3;
$passNueva = password_hash("charliet1", PASSWORD_BCRYPT, array('cost' => 12));

$stmt = $conn->prepare("UPDATE admins SET password = ? WHERE id_admin = ?");
$stmt->bind_param("si", $passNueva, $id);
$stmt->execute();*/

//$query = $conn->query("DELETE FROM categoria_evento WHERE cat_evento = 'Workshop'");

/* Actualizar el campo de talleres_registrados cambiando las claves por los ID */

/*$registrados = $conn->query("SELECT ID_Registrado, talleres_registrados FROM registrados WHERE ID_Registrado");

while($registrado = $registrados->fetch_assoc()) {

    $array_talleres = json_decode($registrado['talleres_registrados']);
    $talleres_registrados = array();

    foreach($array_talleres as $array_claves) {

        foreach($array_claves as $clave) {

            $claves = $conn->query("SELECT evento_id FROM eventos WHERE clave = '{$clave}'");

            $resultado = $claves->fetch_assoc();

            $talleres_registrados['eventos'][] = $resultado['evento_id'];
        
        }

    }

    $talleres_registrados = json_encode($talleres_registrados);

    $conn->query("UPDATE registrados SET talleres_registrados = '" . $talleres_registrados . "' WHERE ID_Registrado = " . $registrado['ID_Registrado']);

}*/

//$query = $conn->query("ALTER TABLE registrados ADD COLUMN ult_edicion DATE NOT NULL");
//$query2 = $conn->query("UPDATE registrados SET ult_edicion = '" . date("Y-m-d H:i:s") . "'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body>
    <img src="img/admins/<?php echo $foto; ?>" alt="Foto :3">
</body>
</html>