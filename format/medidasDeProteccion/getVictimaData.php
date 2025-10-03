<?php
header('Content-Type: application/json; charset=utf-8');
include("../../Conexiones/conexionMedidas.php");
include("../../funcionesMedidasProteccion.php");

$idVictima = isset($_POST['idVictima']) ? $_POST['idVictima'] : null;

$query = "
SELECT	
	r.nOficio,
	r.fechaAcuerdo,
	r.fechaConclusion,
	r.fechaRegistro,
	i.nombre,
	i.paterno,
	i.materno,
	i.genero,
	i.edad
FROM medidas.involucrado i
INNER JOIN medidas.registro r ON r.idInvolucrado = i.idInvolucrado
WHERE i.idInvolucrado = ?
";

$params = array(&$idVictima);

$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt) {
    $result = sqlsrv_execute($stmt);
    if ($result) {
        $array = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        echo json_encode(['success' => true, 'array' => $array]);
    } else {
        $errors = sqlsrv_errors();
        echo json_encode(['success' => false, 'error' => $errors]);
    }
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['success' => false, 'error' => $errors]);

}

?>