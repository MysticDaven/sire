<?php
header('Content-Type: application/json');
include("../../../Conexiones/conexionSicap.php");
include("../../../funcioneSicap.php");

include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");
include("../../../funcioneLit.php");

if (!isset($_POST['carpetas']) || !isset($_POST['nuevoMp'])) {
    http_response_code(400);
    echo "Faltan datos";
    exit;
}

$carpetas = $_POST['carpetas'];
$nuevoMp = intval($_POST['nuevoMp']);

foreach ($carpetas as $idCarpeta) {
    $idCarpeta = intval($idCarpeta);
    $sql = "UPDATE estatusNucs SET idMp = ? WHERE idEstatus = 181 AND idEstatusNucs = ?";

    $params = array($nuevoMp, $idCarpeta);
    $stmt = sqlsrv_query($conn, $sql, $params);

    sqlsrv_execute($stmt);
}

if($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Hubo un problema al migrar las carpetas.']);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'Se han migrado las carpetas seleccionadas correctamente.'
]);


?>