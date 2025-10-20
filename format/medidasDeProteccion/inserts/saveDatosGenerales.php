<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["idMedida"])) {
  if ($_POST["idMedida"] != 0) {
    $idMedida = $_POST["idMedida"];
    //$puestaData = get_data_puesta($conn, $idMedidaProteccion);
  } else {
    $idMedida = 0;
  }
}

if (isset($_POST['idEnlace'])) {
  $idEnlace = $_POST['idEnlace'];
}
if (isset($_POST['fraccion'])) {
  $fraccion = $_POST['fraccion'];
}
if (isset($_POST['rolUser'])) {
  $rolUser = $_POST['rolUser'];
}

//SE RECIBE OBJETO ARRAY CON LOS DATOS PRINCIPALES
if (isset($_POST["dataPrincipalArray"]) && $idMedida == 0) {
  $data = json_decode($_POST['dataPrincipalArray'], true);
  $fechaAcuerdo = $data[3];
  $fechaAcuerdo = str_ireplace("'", '', $fechaAcuerdo);


  $fechaAcuerdo = str_ireplace('T', ' ', $fechaAcuerdo);
  $fechaAcuerdo2 = ":00";
  $fechaAcuerdo = $fechaAcuerdo . $fechaAcuerdo2;

  $array_fecha =  explode(' ', $fechaAcuerdo, 2);
  $fechaConvertida = $array_fecha[0] . '' . $array_fecha[1] . '';

  $fechaAcuerdo = convierteFecha($array_fecha[0]);
  $fechaAcuerdo .= ' ' . $array_fecha[1];

  $fechaAcuerdo = "'" . $fechaAcuerdo . "'";

  if ($rolUser == 4) {
    $fechaConclusion = $data[16];
    $fechaConclusion = str_ireplace("'", '', $fechaConclusion);


    $fechaConclusion = str_ireplace('T', ' ', $fechaConclusion);
    $fechaConclusion2 = ":00";
    $fechaConclusion = $fechaConclusion . $fechaConclusion2;

    $array_fecha1 =  explode(' ', $fechaConclusion, 2);
    $fechaConvertida = $array_fecha1[0] . '' . $array_fecha1[1] . '';

    $fechaConclusion = convierteFecha($array_fecha1[0]);
    $fechaConclusion .= ' ' . $array_fecha1[1];

    $fechaConclusion = "'" . $fechaConclusion . "'";
  }
}

function convierteFecha($fecha)
{
  $array_fecha =  explode('-', $fecha, 3);
  $fechaConvertida = $array_fecha[2] . '-' . $array_fecha[1] . '-' . $array_fecha[0];
  return $fechaConvertida;
}

if (isset($_POST['dataMedidasAplicadasArray']) && $rolUser == 4) {
  $dataMedidasAplicadas = json_decode($_POST['dataMedidasAplicadasArray'], true);
  $tam = sizeof($dataMedidasAplicadas);
  $aux = 0;
  $consulta = "";
}


if ($idMedida == 0 && $rolUser != 4) {

  $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
       declare @insertado int
     
       INSERT INTO medidas.medidasProteccion VALUES('$data[1]',0,0,0,$data[2], $fechaAcuerdo,GETDATE(), DATEPART(dw, $fechaAcuerdo), DATEPART(day, $fechaAcuerdo), DATEPART(month, $fechaAcuerdo), DATEPART(year, $fechaAcuerdo), $idEnlace, $data[10], 1, '',null)

       select @insertado = @@IDENTITY

       INSERT INTO medidas.victimas(idMedida , nombre, paterno, materno, genero, edad) 
       VALUES(@insertado, '$data[5]', '$data[6]', '$data[7]', $data[8],  $data[9] )   

       SELECT MAX(idMedida) AS id FROM medidas.medidasProteccion

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";

  $result = sqlsrv_query($connMedidas, $queryTransaction, array(), array("Scrollable" => 'static'));
  $arreglo[0] = "NO";
  $arreglo[1] = "SI";

  if ($result) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
      $id = $row['id'];
    }
    $arreglo[2] = $id;
    $d = array('first' => $arreglo[1], 'idMedidaUltimo' => $arreglo[2]);
    echo json_encode($d);
  } else {
    echo json_encode(array('first' => $arreglo[0]));
  }
} elseif ($idMedida == 0 && $rolUser == 4) {
  /* Iniciar la transacción para el usuarion general. */


  if (sqlsrv_begin_transaction($connMedidas) === false) {
    die(print_r(sqlsrv_errors(), true));
  }

  $queryTransaction1 = "BEGIN
                        BEGIN TRY 
                         BEGIN TRANSACTION
                          SET NOCOUNT ON
                            declare @insertado int
                          
                            INSERT INTO medidas.medidasProteccion VALUES('$data[1]',$data[11],$data[14],$data[15],$data[2], $fechaAcuerdo,GETDATE(), DATEPART(dw, $fechaAcuerdo), DATEPART(day, $fechaAcuerdo), DATEPART(month, $fechaAcuerdo), DATEPART(year, $fechaAcuerdo), $idEnlace, $data[10], 1, $fechaConclusion, $data[18], '$data[19]')

                            select @insertado = @@IDENTITY

                            INSERT INTO medidas.victimas(idMedida , nombre, paterno, materno, genero, edad) 
                            VALUES(@insertado, '$data[5]', '$data[6]', '$data[7]', $data[8],  $data[9] )

                            INSERT INTO medidas.cuadernoAntecedentes (idMedida, temporalidad , fechaConclusion) VALUES (@insertado , $data[17] , $fechaConclusion)

                            SELECT MAX(idMedida) AS id FROM medidas.medidasProteccion                      

                            COMMIT
                           END TRY
                          BEGIN CATCH
                         ROLLBACK TRANSACTION
                        RAISERROR('No se realizo la transaccion',16,1)
                       END CATCH
                      END";

  $result1 = sqlsrv_query($connMedidas, $queryTransaction1, array(), array("Scrollable" => 'static'));

  if ($result1) {
    //OBTENEMOS EL ID DE LA MEDIDA REGISTRADA Y EL ID DE LA FISCALIA DEL MP
    while ($row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)) {
      $idMedida = $row['id'];
    }
    //CREAREMOS LAS SENTENCIAS PARA INSERTAR LAS MEDIDAS
    while ($aux < $tam) {
      $consulta = $consulta . "INSERT INTO medidas.medidasAplicadas (idMedida, nuc, idCatFraccion) VALUES ($idMedida, '$data[1]', $dataMedidasAplicadas[$aux]) ";
      $aux++;
    }
  }

  $queryTransaction2 = $consulta;
  $result2 = sqlsrv_query($connMedidas, $queryTransaction2, array(), array("Scrollable" => 'static'));

  $arreglo[0] = "NO";
  $arreglo[1] = "SI";

  /* Si ambas sentencias finalizaran con éxito, consolidar la transacción. */
  /* En caso contrario, revertirla. */
  if ($result1 && $result2) {
    sqlsrv_commit($connMedidas);
    //echo "Transaccion consolidada.<br />";
    $arreglo[2] = $idMedida;
    $d = array('first' => $arreglo[1], 'idMedidaUltimo' => $arreglo[2]);
    echo json_encode($d);
  } else {
    sqlsrv_rollback($connMedidas);
    //echo "Transaccion revertida.<br />";
    echo json_encode(array('first' => $arreglo[0]));
  }
}