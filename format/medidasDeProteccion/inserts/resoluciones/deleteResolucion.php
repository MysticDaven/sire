<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idResolucion = isset($_POST['idResolucion']) ? $_POST['idResolucion'] : null;
$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;
$tipoResolucion = isset($_POST['tipoResolucion']) ? $_POST['tipoResolucion'] : null;

switch ($tipoResolucion) {
    case 1:
        
    case 4:
        $query = "DELETE FROM medidas.resolucion WHERE idResolucion = ?";
        break;
    case 2:
        $query = "";
        break;
    case 3:
        $query = "";
        break;
}

$params = [&$idResolucion];

$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt && sqlsrv_execute($stmt)) {
    sqlsrv_commit($connMedidas);
    echo json_encode(['first' => 'SI', 'idMedidaUltimo' => $idMedida]);
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'errors' => $errors]);
}
?>
