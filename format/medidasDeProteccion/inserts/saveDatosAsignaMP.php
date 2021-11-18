<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["idMedida"])){
 if($_POST["idMedida"] != 0) {
  $idMedida = $_POST["idMedida"];
  //$puestaData = get_data_puesta($conn, $idMedidaProteccion);
 }else{  
  $idMedida = 0;
 }
}


//SE RECIBE OBJETO ARRAY CON LOS DATOS PRINCIPALES
if (isset($_POST["dataPrincipalArray"])){ $data = json_decode($_POST['dataPrincipalArray'], true); }


if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }


if($idMedida != 0){
 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
       declare @insertado int
     
       UPDATE medidas.medidasProteccion SET idMP = $data[1], idUnidad = $data[2], idFiscalia = $data[3]
        WHERE idMedida = $idMedida

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";
echo $queryTransaction;
 $result = sqlsrv_query($connMedidas,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";

 if ($result) {
  $arreglo[2] = $idMedida;
  $d = array('first' => $arreglo[1] , 'idMedidaUltimo' => $arreglo[2] );
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }
}
?>