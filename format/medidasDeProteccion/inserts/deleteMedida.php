<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");

$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;

$query = "
    BEGIN TRY
	BEGIN TRANSACTION;

	SET NOCOUNT ON;
        DECLARE @idResolucion INT;
        DECLARE @idMedida INT = ?;
        
        SELECT @idResolucion = idResolucion FROM medidas.resoluciones WHERE idMedida = @idMedida;
        DELETE FROM medidas.ratificada WHERE idResolucion = @idResolucion;
        DELETE FROM medidas.ampliada  WHERE idResolucion = @idResolucion;
        DELETE FROM medidas.modificada WHERE idResolucion = @idResolucion;
        DELETE FROM medidas.revocada WHERE idResolucion = @idResolucion;
        DELETE FROM medidas.imputados WHERE idMedida = @idMedida;
        DELETE FROM medidas.victimas WHERE idMedida = @idMedida;
        DELETE FROM medidas.cuadernoAntecedentes WHERE idMedida = @idMedida;
        DELETE FROM medidas.medidasAplicadas WHERE idMedida = @idMedida;
        DELETE FROM medidas.constanciaLlamadas WHERE idMedida = @idMedida;
        DELETE FROM medidas.testigo WHERE idMedida = @idMedida;
        DELETE FROM medidas.medidasAplicadasTestigo WHERE idMedida = @idMedida;
        DELETE FROM medidas.resoluciones WHERE idMedida = @idMedida;
        DELETE FROM medidas.medidasProteccion WHERE idMedida = @idMedida;

        COMMIT;
    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        THROW;
    END CATCH;	
";

$params = array(&$idMedida);
$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt && sqlsrv_execute($stmt)) {
    echo json_encode(['success' => true]);
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['success' => false, 'error' => $errors]);
}

?>