<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idInvolucrado = isset($_POST['idInvolucrado']) ? $_POST['idInvolucrado'] : null;
$fechaConclusion = isset($_POST['fechaConclusion']) ? $_POST['fechaConclusion'] : null;

$fConclusion = date("Y-m-d H:i:s", strtotime($fechaConclusion));

$query = "
    BEGIN TRANSACTION;
    BEGIN TRY
        -- Actualiza en la primera tabla
        UPDATE r        
        SET r.fechaConclusion = ?
        FROM medidas.registro r
        INNER JOIN medidas.involucrado i ON r.idInvolucrado = i.idInvolucrado
        WHERE i.idInvolucrado = ? AND r.vigente = 1;

        COMMIT;
    END TRY
    BEGIN CATCH
        -- En caso de error, revierte la transacción
        ROLLBACK TRANSACTION;
        -- Lanza el error con un mensaje específico
        DECLARE @ErrorMessage NVARCHAR(4000) = ERROR_MESSAGE();
        DECLARE @ErrorLine INT = ERROR_LINE();
        RAISERROR('Error en la transacción. Mensaje: %s, Línea: %d', 16, 1, @ErrorMessage, @ErrorLine);
    END CATCH;";

$params = [
    [&$fConclusion, SQLSRV_PARAM_IN, null, SQLSRV_SQLTYPE_DATETIME],
    [&$idInvolucrado, SQLSRV_PARAM_IN]
];

$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt) {
    $result = sqlsrv_execute($stmt);
    if ($result) {
        echo json_encode(['first' => 'SI']);
    } else {
        $errors = sqlsrv_errors();
        echo json_encode(['first' => 'NO', 'errors' => $errors]);
    }
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'errors' => $errors]);
}
?>
