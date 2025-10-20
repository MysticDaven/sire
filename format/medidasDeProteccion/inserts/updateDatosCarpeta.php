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

if (isset($_POST['rolUser'])){ $rolUser = $_POST['rolUser']; }


//SE RECIBE OBJETO ARRAY CON LOS DATOS PRINCIPALES
if (isset($_POST["dataPrincipalArray"])){ 
 $data = json_decode($_POST['dataPrincipalArray'], true); 
 $fechaAcuerdo = $data[3]; 
 $fechaAcuerdo = str_ireplace("'",'',$fechaAcuerdo);


  $fechaAcuerdo=str_ireplace('T',' ',$fechaAcuerdo);
  $fechaAcuerdo2=":00";
  $fechaAcuerdo= $fechaAcuerdo.$fechaAcuerdo2;

  $array_fecha=  explode(' ', $fechaAcuerdo,2) ;
  $fechaConvertida=$array_fecha[0].''.$array_fecha[1].''; 

  $fechaAcuerdo= convierteFecha($array_fecha[0]);
  $fechaAcuerdo.=' '.$array_fecha[1]; 

  $fechaAcuerdo = "'".$fechaAcuerdo."'";

  if($rolUser == 4){
    $fechaConclusion = $data[11]; 
    $fechaConclusion = str_ireplace("'",'',$fechaConclusion);


    $fechaConclusion=str_ireplace('T',' ',$fechaConclusion);
    $fechaConclusion2=":00";
    $fechaConclusion=  $fechaConclusion.$fechaConclusion2;

    $array_fecha1 =  explode(' ', $fechaConclusion,2) ;
    $fechaConvertida=$array_fecha1[0].''.$array_fecha1[1].''; 

    $fechaConclusion= convierteFecha($array_fecha1[0]);
    $fechaConclusion.=' '.$array_fecha1[1]; 

    $fechaConclusion = "'".$fechaConclusion."'";
  }
}

function convierteFecha($fecha){
 $array_fecha=  explode('-', $fecha,3) ;
 $fechaConvertida=$array_fecha[2].'-'.$array_fecha[1].'-'.$array_fecha[0];
 return $fechaConvertida;
} 


if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }

if($idMedida == 0 && $rolUser != 4){

  $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
     
       UPDATE medidas.medidasProteccion SET nuc = '$data[1]', idDelito = $data[2], fechaAcuerdo = $fechaAcuerdo, diaSemana = DATEPART(dw, $fechaAcuerdo), diaMes = DATEPART(day, $fechaAcuerdo), mes = DATEPART(month, $fechaAcuerdo), anio = DATEPART(year, $fechaAcuerdo), idEnlace = $idEnlace, idFiscaliaProcedencia = $data[5] WHERE idMedida = $idMedida

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";

}else{
  $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
     
       UPDATE medidas.medidasProteccion SET idMP = $data[6], idUnidad = $data[9], idFiscalia = $data[10],
       nuc = '$data[1]', idDelito = $data[2], fechaAcuerdo = $fechaAcuerdo, diaSemana = DATEPART(dw, $fechaAcuerdo), diaMes = DATEPART(day, $fechaAcuerdo), mes = DATEPART(month, $fechaAcuerdo), anio = DATEPART(year, $fechaAcuerdo), idEnlace = $idEnlace, idFiscaliaProcedencia = $data[5], fechaConclusion = $fechaConclusion, idCatCoorporacion = $data[13], nOficio = '$data[14]' WHERE idMedida = $idMedida

       UPDATE medidas.cuadernoAntecedentes SET temporalidad = $data[12] , fechaConclusion = $fechaConclusion WHERE idMedida = $idMedida

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";
}

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

?>