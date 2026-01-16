<?php 
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idInvolucrado = isset($_POST['idInvolucrado']) ? $_POST['idInvolucrado'] : null;
$observacion = isset($_POST['observacion']) ? $_POST['observacion'] : null;
$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;

$query = "
BEGIN
 BEGIN TRY 
  BEGIN TRANSACTION
   SET NOCOUNT ON
    DECLARE @idRegistroPrevio INT

    SELECT @idRegistroPrevio = r.idRegistro
    FROM medidas.registro r
    INNER JOIN medidas.involucrado i ON r.idInvolucrado = i.idInvolucrado
    WHERE i.idInvolucrado = ? AND r.vigente = 1

    INSERT INTO medidas.resolucion (idTipoResolucion, idRegistroPrevio, idRegistroPosterior, observacion, fechaResolucion)
    VALUES (1, @idRegistroPrevio, @idRegistroPrevio, ?, GETDATE())

    COMMIT
  END TRY
  BEGIN CATCH
    ROLLBACK TRANSACTION
    RAISERROR('No se realizo la transaccion', 16, 1)
  END CATCH
END";

$params = array(&$idInvolucrado, &$observacion);
$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt) {
    $result = sqlsrv_execute($stmt);
    if ($result) {
        sqlsrv_commit($connMedidas);
        echo json_encode(['first' => 'SI', 'idMedidaUltimo' => $idMedida]);
    } else {
        sqlsrv_rollback($connMedidas);
        $errors = sqlsrv_errors();
        echo json_encode(['first' => 'NO', 'error' => $errors]);
    }
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'error' => $errors]);
}
?>
