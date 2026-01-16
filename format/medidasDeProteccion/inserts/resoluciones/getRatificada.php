<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idInvolucrado = isset($_POST['idInvolucrado']) ? $_POST['idInvolucrado'] : null;

$query = 
    "SELECT
        r.idResolucion,
        r.idRegistroPrevio,
        r.observacion
    FROM medidas.resolucion r
    INNER JOIN medidas.registro re ON r.idRegistroPrevio = re.idRegistro
    INNER JOIN medidas.involucrado i ON i.idInvolucrado = re.idInvolucrado
    WHERE i.idInvolucrado = ? AND r.idTipoResolucion = 1";

$params = array(&$idInvolucrado);

$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt) {
    $result = sqlsrv_execute($stmt);
    if ($result) {
        $array = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $array[] = $row;
        }
        echo json_encode(['first' => 'SI', 'array' => $array]);
    } else {
        $errors = sqlsrv_errors();
        echo json_encode(['first' => 'NO', 'error' => $errors]);
    }
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'error' => $errors]);
}
?>
