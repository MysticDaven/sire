<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

//VARIABLES DEL FORMULARIO OBTENIDO
if (isset($_POST['nombreImpu'])){ $nombreImpu = $_POST['nombreImpu']; }
if (isset($_POST['paternoImpu'])){ $paternoImpu = $_POST['paternoImpu']; }
if (isset($_POST['maternoImpu'])){ $maternoImpu = $_POST['maternoImpu']; }
if (isset($_POST['generoImpu'])){ $generoImpu = $_POST['generoImpu']; }
if (isset($_POST['edadImpu'])){ $edadImpu = $_POST['edadImpu']; }

if (isset($_POST['idImputado'])){ $idImputado = $_POST['idImputado']; }
if (isset($_POST['idMedida'])){ $idMedida = $_POST['idMedida']; }


  $queryTransaction = "
    BEGIN
     BEGIN TRY
      BEGIN TRANSACTION
       SET NOCOUNT ON

        UPDATE medidas.involucrado SET nombre = '$nombreImpu', paterno = '$paternoImpu', materno = '$maternoImpu', genero = $generoImpu, edad = $edadImpu 
        WHERE idInvolucrado = $idImputado

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
  END";
  
 $result = sqlsrv_query($connMedidas,$queryTransaction, array(), array( "Scrollable" => 'static' ));
 while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){  
  $id=$row['id'];
 }
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";
 $arreglo[2] = $idMedida;
 $d = array('first' => $arreglo[1] , 'idMedidaUltimo' => $arreglo[2]);
 if ($result) {
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }

?>