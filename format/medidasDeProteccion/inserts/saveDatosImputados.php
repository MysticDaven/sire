<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/conexionMedidas.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }


//VARIABLES DEL FORMULARIO OBTENIDO
if (isset($_POST['nombreImpu'])){ $nombreImpu = $_POST['nombreImpu']; }
if (isset($_POST['paternoImpu'])){ $paternoImpu = $_POST['paternoImpu']; }
if (isset($_POST['maternoImpu'])){ $maternoImpu = $_POST['maternoImpu']; }
if (isset($_POST['generoImpu'])){ $generoImpu = $_POST['generoImpu']; }
if (isset($_POST['edadImpu'])){ $edadImpu = $_POST['edadImpu']; }

 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
     
       INSERT INTO medidas.involucrado (idMedida, idTipoInvolucrado, nombre, paterno, materno, genero, edad) VALUES($idMedida, 3, '$nombreImpu', '$paternoImpu', '$maternoImpu', $generoImpu, $edadImpu)
       
       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";
 

 $result = sqlsrv_query($connMedidas,$queryTransaction, array(), array( "Scrollable" => 'static' ));
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