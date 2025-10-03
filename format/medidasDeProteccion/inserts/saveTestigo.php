<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/conexionMedidas.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }


//VARIABLES DEL FORMULARIO OBTENIDO
if (isset($_POST['nombreTest'])){ $nombreTest = $_POST['nombreTest']; }
if (isset($_POST['paternoTest'])){ $paternoTest = $_POST['paternoTest']; }
if (isset($_POST['maternoTest'])){ $maternoTest = $_POST['maternoTest']; }
if (isset($_POST['estadoTest'])){ $estadoTest = $_POST['estadoTest']; }
if (isset($_POST['causaTest'])){ $causaTest = $_POST['causaTest']; }
if (isset($_POST['observacionesTest'])){ $observacionesTest = $_POST['observacionesTest']; }
$genero = isset($_POST['genero']) ? $_POST['genero'] : null;
$edad = isset($_POST['edad']) ? $_POST['edad'] : null;
$noficio = isset($_POST['nOficio']) ? $_POST['nOficio'] : null;
$fechaAcuerdo = isset($_POST['fechaAcuerdo']) ? $_POST['fechaAcuerdo'] : null;
$fechaConclusion = isset($_POST['fechaConclusion']) ? $_POST['fechaConclusion'] : null;
$temporalidad = isset($_POST['temporalidad']) ? $_POST['temporalidad'] : null;

$fechaAcuerdo = formatear($fechaAcuerdo);
$fechaConclusion = formatear($fechaConclusion);

 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
      DECLARE @idInvolucrado INT;

      -- Insertar involucrado
      INSERT INTO medidas.involucrado (idMedida, idTipoInvolucrado, nombre, paterno, materno, genero, edad) 
      VALUES ($idMedida, 2, '$nombreTest', '$paternoTest', '$maternoTest', $genero, $edad);

      SET @idInvolucrado = SCOPE_IDENTITY();

      -- Insertar registro
      INSERT INTO medidas.registro (idInvolucrado, fechaRegistro, fechaAcuerdo, fechaConclusion, temporalidad, nOficio)
      VALUES (@idInvolucrado, GETDATE(), $fechaAcuerdo, $fechaConclusion, $temporalidad, '$nOficio');

      -- Insertar testigo
      INSERT INTO medidas.testigo_Prueba (idInvolucrado, causa, estado, observaciones)
      VALUES (@idInvolucrado, '$causaTest', $estadoTest, '$observacionesTest');
      
       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";
 
 $result = sqlsrv_query($connMedidas,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
 
  function formatear ($fecha) {
    $fecha = str_ireplace("'", "", $fecha);
    $fecha = str_ireplace('T', ' ', $fecha);
    $fecha .= ":00";
    $array_fecha = explode(' ', $fecha, 2);
    $fechaFinal = convierteFecha($array_fecha[0]);
    $fechaFinal .= " " . $array_fecha[1];
    return "'" . $fechaFinal . "'";
  }

  function convierteFecha ($fecha) {
    $array_fecha = explode('-', $fecha, 3);
    $fechaFinal = $array_fecha[2] . '-' . $array_fecha[1] . '-' . $array_fecha[0];
    return $fechaFinal;
  }

?>