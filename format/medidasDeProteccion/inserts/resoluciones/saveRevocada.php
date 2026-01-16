<?php 
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idInvolucrado = isset($_POST['idInvolucrado']) ? $_POST['idInvolucrado'] : null;
$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;
$observacion = isset($_POST['observacion']) ? $_POST['observacion'] : null;
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;

// Convertimos la fecha al formato compatible con SQL Server
$fechaAcuerdo = date("Y-m-d H:i:s", strtotime($fecha));
//echo "Fecha convertida: " . $fechaAcuerdo;


$query = "
BEGIN
 BEGIN TRY 
  BEGIN TRANSACTION
   SET NOCOUNT ON;
    DECLARE @idRegistroPrevio INT

    SELECT @idRegistroPrevio = r.idRegistro
    FROM medidas.registro r
    INNER JOIN medidas.involucrado i ON r.idInvolucrado = i.idInvolucrado
    WHERE i.idInvolucrado = ? AND r.vigente = 1;

    INSERT INTO medidas.resolucion (idTipoResolucion, idRegistroPrevio, idRegistroPosterior, observacion, fechaResolucion)
    VALUES (4, @idRegistroPrevio, @idRegistroPrevio, ?, GETDATE());    

    COMMIT;
  END TRY
  BEGIN CATCH
    ROLLBACK TRANSACTION;
    DECLARE @ErrorMessage NVARCHAR(4000) = ERROR_MESSAGE();
    DECLARE @ErrorLine INT = ERROR_LINE();
    RAISERROR('Error en la transacción. Mensaje: %s, Línea: %d', 16, 1, @ErrorMessage, @ErrorLine);
  END CATCH
END";


$params = array(
    &$idInvolucrado, 
    &$observacion
);

$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt) {
    $result = sqlsrv_execute($stmt);
    if ($result) {
        sqlsrv_commit($connMedidas);
        echo json_encode(['first' => 'SI', 'idMedidaUltimo' => $idMedida]);
    } else {
        $errors = sqlsrv_errors();
        echo json_encode(['first' => 'NO', 'error' => $errors, 'fecha' => $fechaAcuerdo]);
    }
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'error' => $errors, 'fecha' => $fechaAcuerdo]);
}
?>
