<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }


 $query1 = "SELECT count(idMedida) AS total FROM medidas.medidasProteccion where idMedida = $idMedida ";
 $stmt1 = sqlsrv_query($connMedidas, $query1);
 while ($row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC )){$total1[0][0]=$row['total'];}

 if ($total1[0][0] > 0) {
  $arreglo[0] = "mod1_OK"; 
 }else{
  $arreglo[0] = "mod1_ISNULL";
 }

 $query2 = "WITH TotalCount AS (
  SELECT COUNT(*) AS total
  FROM medidas.resoluciones
  WHERE idMedida = $idMedida
)
SELECT 
  tc.total,
  COUNT(DISTINCT am.idAmpliada) AS totalAmpliada,
  COUNT(DISTINCT r.idRatificada) AS totalRatificada,
  COUNT(DISTINCT mo.idModificada) AS totalModificada,
  COUNT(DISTINCT re.idRevocada) AS totalRevocada
FROM TotalCount tc
LEFT JOIN medidas.resoluciones m ON m.idMedida = $idMedida
LEFT JOIN medidas.ampliada am ON am.idResolucion = m.idResolucion
LEFT JOIN medidas.ratificada r ON r.idResolucion = m.idResolucion
LEFT JOIN medidas.modificada mo ON mo.idResolucion = m.idResolucion
LEFT JOIN medidas.revocada re ON re.idResolucion = m.idResolucion
WHERE tc.total > 0
GROUP BY tc.total";

$stmt2 = sqlsrv_query($connMedidas, $query2);
$row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);

if ($row2['total'] > 0) {
  $t = ['totalAmpliada', 'totalRatificada', 'totalModificada', 'totalRevocada'];
  $arreglo[1] = "mod2_ISNULL";
  foreach($t as $total){
      if($row2[$total] > 0){
          $arreglo[1] = "mod2_OK";
          break;
      }
  }
} else {
  $arreglo[1] = "mod2_ISNULL";
}

 $query3 = "SELECT count(idInvolucrado) AS totalVictimas FROM medidas.involucrado where idMedida = $idMedida AND idTipoInvolucrado = 1 ";
 $stmt3 = sqlsrv_query($connMedidas, $query3); 
 while ($row3 = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC )){$total3[0][0]=$row3['totalVictimas'];}

 $query4 = "SELECT count(idInvolucrado) AS totalCompletadas FROM medidas.involucrado where idMedida = $idMedida AND idEntidad > 0 AND idTipoInvolucrado = 1";
 $stmt4 = sqlsrv_query($connMedidas, $query4);
 while ($row4 = sqlsrv_fetch_array( $stmt4, SQLSRV_FETCH_ASSOC )){$total4[0][0]=$row4['totalCompletadas'];}

 if ($total3[0][0] == $total4[0][0]) {
  $arreglo[2] = "mod3_OK"; 
 }else{
  $arreglo[2] = "mod3_ISNULL";
 }

 $query4 = "SELECT count(idInvolucrado) AS total FROM medidas.involucrado where idMedida = $idMedida AND idTipoInvolucrado = 3";
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

 $total6[0][0] = "";
 $totalTest[0][0] = "";
  $query6 = "SELECT
      i.idInvolucrado
    FROM medidas.involucrado i
    LEFT JOIN medidas.involucrado_medidasAplicadas ma ON ma.idInvolucrado = i.idInvolucrado
    WHERE i.idMedida = $idMedida AND i.idTipoInvolucrado = 1 AND ma.idCatFraccion IS NULL";

 $stmt6 = sqlsrv_query($connMedidas, $query6);
 while ($row6 = sqlsrv_fetch_array( $stmt6, SQLSRV_FETCH_ASSOC )){$total6[0][0]=$row6['idInvolucrado'];}

 $query6 = "SELECT
    i.idInvolucrado
  FROM medidas.involucrado i
  LEFT JOIN medidas.involucrado_medidasAplicadas ma ON ma.idInvolucrado = i.idInvolucrado
  WHERE i.idMedida = $idMedida AND i.idTipoInvolucrado = 2 AND ma.idCatFraccion IS NULL";

 $stmt6 = sqlsrv_query($connMedidas, $query6);
 while ($row6 = sqlsrv_fetch_array( $stmt6, SQLSRV_FETCH_ASSOC )){$totalTest[0][0]=$row6['idInvolucrado'];}

 if (!empty($total6[0][0]) || !empty($totalTest[0][0])) {
   $arreglo[5] = $total6[0][0] . "-" . $totalTest[0][0];
 }else{
  $arreglo[5] = "mod6_OK";  
 }

//  $query6 = "SELECT count(idMedidaAplicada) AS total FROM medidas.medidasAplicadas where idMedida = $idMedida ";
//  $stmt6 = sqlsrv_query($connMedidas, $query6);
//  while ($row6 = sqlsrv_fetch_array( $stmt6, SQLSRV_FETCH_ASSOC )){$total6[0][0]=$row6['total'];}
//  $query6 = "SELECT count(idMedidasAplicadasTestigo) AS total FROM medidas.medidasAplicadasTestigo where idMedida = $idMedida";
//  $stmt6 = sqlsrv_query($connMedidas, $query6);
//  while ($row6 = sqlsrv_fetch_array( $stmt6, SQLSRV_FETCH_ASSOC )){$totalTest[0][0]=$row6['total'];}

//  if ($total6[0][0] > 0 || $totalTest[0][0] > 0) {
//   $arreglo[5] = "mod6_OK"; 
//  }else{
//   $arreglo[5] = "mod6_ISNULL";
//  }

 $query7 = "SELECT count(idSeguimiento) AS total FROM medidas.seguimientos where idMedida = $idMedida ";
 $stmt7 = sqlsrv_query($connMedidas, $query7);
 while ($row7 = sqlsrv_fetch_array( $stmt7, SQLSRV_FETCH_ASSOC )){$total7[0][0]=$row7['total'];}

 if ($total7[0][0] > 0) {
  $arreglo[6] = "mod7_OK"; 
 }else{
  $arreglo[6] = "mod7_ISNULL";
 }

 $query8 = "SELECT count(idInvolucrado) AS total FROM medidas.involucrado where idMedida = $idMedida AND idTipoInvolucrado = 2";
 $stmt8 = sqlsrv_query($connMedidas, $query8);
 while ($row8 = sqlsrv_fetch_array( $stmt8, SQLSRV_FETCH_ASSOC )){$total8[0][0]=$row8['total'];}

 $query9 = "SELECT count(idInvolucrado) AS total FROM medidas.involucrado where idMedida = $idMedida AND idEntidad > 0 AND idTipoInvolucrado = 2";
 $stmt9 = sqlsrv_query($connMedidas, $query9);
 while ($row9 = sqlsrv_fetch_array( $stmt9, SQLSRV_FETCH_ASSOC )){$total9[0][0]=$row9['total'];}
 if ($total8[0][0] == $total9[0][0]) {
    $arreglo[7] = "mod8_OK";
 }
 else {
    $arreglo[7] = "mod8_ISNULL";
 }

  $d = array('first'=>$arreglo[0], 'second'=>$arreglo[1] , 'three'=>$arreglo[2] , 'four'=>$arreglo[3] , 'five'=>$arreglo[4] , 'six'=>$arreglo[5], 'seven'=>$arreglo[6], 'eight'=>$arreglo[7]);
  echo json_encode($d);


?>