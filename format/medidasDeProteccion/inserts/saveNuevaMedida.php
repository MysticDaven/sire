<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/conexionMedidas.php");

//////////// ID DEL INVOLUCRADO /////
$idInvolucrado = isset($_POST['idInvolucrado']) ? $_POST['idInvolucrado'] : null;
$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;

//VARIABLES DEL FORMULARIO OBTENIDO
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }
if (isset($_POST['nuc'])){ $nuc = $_POST['nuc']; }

 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
     
       INSERT INTO medidas.involucrado_medidasAplicadas (idInvolucrado, idCatFraccion) VALUES($idInvolucrado, $fraccion)

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