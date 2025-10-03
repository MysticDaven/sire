<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

$idInvolucrado = isset($_POST['idInvolucrado']) ? $_POST['idInvolucrado'] : null;
if (isset($_POST["idMedida"])) {
	$idMedida = $_POST["idMedida"];
}

$modulo = 'testigo';

$queryTransaction = "
  BEGIN TRY
    BEGIN TRANSACTION
        SET NOCOUNT ON;

        DECLARE @idInvolucrado INT = $idInvolucrado;

        DELETE FROM medidas.involucrado_medidasAplicadas WHERE idInvolucrado = @idInvolucrado;
        DELETE FROM medidas.testigo_Prueba WHERE idInvolucrado = @idInvolucrado;
        DELETE FROM medidas.registro WHERE idInvolucrado = @idInvolucrado;
        DELETE FROM medidas.involucrado WHERE idInvolucrado = @idInvolucrado;

    COMMIT TRANSACTION;
  END TRY
  BEGIN CATCH
      ROLLBACK TRANSACTION;

      -- Opcional: registrar el error
      DECLARE @ErrorMessage NVARCHAR(4000) = ERROR_MESSAGE();
      RAISERROR(@ErrorMessage, 16, 1);
  END CATCH
";

$result = sqlsrv_query($connMedidas, $queryTransaction, array(), array("Scrollable" => 'static'));
$arreglo[0] = "NO";
$arreglo[1] = "SI";
if ($result) {
	echo json_encode(array('first' => $arreglo[1], 'modulo' => $modulo));
} else {
	echo json_encode(array('first' => $arreglo[0]));
}
