<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }


 $query1 = "SELECT count(idCuadernoAntecedentes) AS total FROM medidas.cuadernoAntecedentes where idMedida = $idMedida ";
 $stmt1 = sqlsrv_query($connMedidas, $query1);
 while ($row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC )){$total1[0][0]=$row['total'];}

 if ($total1[0][0] > 0) {
  $arreglo[0] = "mod1_OK"; 
 }else{
  $arreglo[0] = "mod1_ISNULL";
 }

 $query2 = "SELECT count(idResolucion) AS total FROM medidas.resoluciones where idMedida = $idMedida ";
 $stmt2 = sqlsrv_query($connMedidas, $query2);
 while ($row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC )){$total2[0][0]=$row2['total'];}

 if ($total2[0][0] > 0) {
  $arreglo[1] = "mod2_OK"; 
 }else{
  $arreglo[1] = "mod2_ISNULL";
 }

 $query3 = "SELECT count(idVictima) AS totalVictimas FROM medidas.victimas where idMedida = $idMedida ";
 $stmt3 = sqlsrv_query($connMedidas, $query3);
 while ($row3 = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC )){$total3[0][0]=$row3['totalVictimas'];}
 $query4 = "SELECT count(idVictima) AS totalCompletadas FROM medidas.victimas where idMedida = $idMedida AND idEntidad > 0 ";
 $stmt4 = sqlsrv_query($connMedidas, $query4);
 while ($row4 = sqlsrv_fetch_array( $stmt4, SQLSRV_FETCH_ASSOC )){$total4[0][0]=$row4['totalCompletadas'];}

 if ($total3[0][0] == $total4[0][0]) {
  $arreglo[2] = "mod3_OK"; 
 }else{
  $arreglo[2] = "mod3_ISNULL";
 }

 $query4 = "SELECT count(imputadoID) AS total FROM medidas.imputados where idMedida = $idMedida ";
 $stmt4 = sqlsrv_query($connMedidas, $query4);
 while ($row4 = sqlsrv_fetch_array( $stmt4, SQLSRV_FETCH_ASSOC )){$total4[0][0]=$row4['total'];}

 if ($total4[0][0] > 0) {
  $arreglo[3] = "mod4_OK"; 
 }else{
  $arreglo[3] = "mod4_ISNULL";
 }

 $query5 = "SELECT count(idConstancia) AS total FROM medidas.constanciaLlamadas where idMedida = $idMedida ";
 $stmt5 = sqlsrv_query($connMedidas, $query5);
 while ($row5 = sqlsrv_fetch_array( $stmt5, SQLSRV_FETCH_ASSOC )){$total5[0][0]=$row5['total'];}

 if ($total5[0][0] > 0) {
  $arreglo[4] = "mod5_OK"; 
 }else{
  $arreglo[4] = "mod5_ISNULL";
 }

  $d = array('first'=>$arreglo[0], 'second'=>$arreglo[1] , 'three'=>$arreglo[2] , 'four'=>$arreglo[3] , 'five'=>$arreglo[4] );
  echo json_encode($d);


?>