<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/conexionMedidas.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;


//VARIABLES DEL FORMULARIO OBTENIDO
$nombreVicti = isset($_POST['nombreVicti']) ? $_POST['nombreVicti'] : null;
$paternoVicti = isset($_POST['paternoVicti']) ? $_POST['paternoVicti'] : null;
$maternoVicti = isset($_POST['maternoVicti']) ? $_POST['maternoVicti'] : null;
$generoVicti = isset($_POST['generoVicti']) ? $_POST['generoVicti'] : null;
$edadVictima = isset($_POST['edadVictima']) ? $_POST['edadVictima'] : null;

// Recibir valores del POST
$fechaAcuerdo    = isset($_POST['fechaAcuerdo']) ? $_POST['fechaAcuerdo'] : null;
$fechaConclusion = isset($_POST['fechaConclusion']) ? $_POST['fechaConclusion'] : null;
$temporalidad    = isset($_POST['temporalidad']) ? $_POST['temporalidad'] : null;
$nOficio         = isset($_POST['nOficio']) ? $_POST['nOficio'] : null;

$fechaAcuerdo = formatear($fechaAcuerdo);
$fechaConclusion = formatear($fechaConclusion);

$queryTransaction = "
BEGIN
   BEGIN TRY
      BEGIN TRANSACTION
         SET NOCOUNT ON;

         DECLARE @idInvolucrado INT;

         -- Insertar involucrado
         INSERT INTO medidas.involucrado
         (idMedida, idTipoInvolucrado, nombre, paterno, materno, genero, edad)
         VALUES ($idMedida, 1, '$nombreVicti', '$paternoVicti', '$maternoVicti', $generoVicti, $edadVictima);

         SET @idInvolucrado = SCOPE_IDENTITY();

         -- Insertar registro
         INSERT INTO medidas.registro
         (idInvolucrado, fechaRegistro, fechaAcuerdo, fechaConclusion, temporalidad, nOficio)
         VALUES (@idInvolucrado, GETDATE(), $fechaAcuerdo, $fechaConclusion, $temporalidad, '$nOficio');

      COMMIT TRANSACTION;
   END TRY
   BEGIN CATCH
      ROLLBACK TRANSACTION;

      DECLARE @ErrorMessage NVARCHAR(4000);
      DECLARE @ErrorSeverity INT;
      DECLARE @ErrorState INT;

      SELECT 
         @ErrorMessage = ERROR_MESSAGE(),
         @ErrorSeverity = ERROR_SEVERITY(),
         @ErrorState = ERROR_STATE();

      RAISERROR (@ErrorMessage, @ErrorSeverity, @ErrorState);
   END CATCH
END";
 
echo $queryTransaction; 

$result = sqlsrv_query($connMedidas, $queryTransaction);

if ($result === false) {
    echo "<pre>";
    print_r(sqlsrv_errors());
    echo "</pre>";
}

function formatear ($fecha) {
  $fecha = str_ireplace("'", "", $fecha);
  $fecha = str_ireplace('T', ' ', $fecha);
  $fecha .= ":00";
  $array_fecha  = explode(' ', $fecha, 2);
  $fechaConvertida = $array_fecha[0] . '' . $array_fecha[1] . '';
  $fechaFinal = convierteFecha($array_fecha[0]);
  $fechaFinal .= ' ' . $array_fecha[1];
  return "'" . $fechaFinal . "'";
}

function convierteFecha($fecha) {
  $array_fecha = explode('-', $fecha, 3);
  $fechaFinal = $array_fecha[2] . '-' . $array_fecha[1] . '-' . $array_fecha[0];
  return $fechaFinal;
}

?>