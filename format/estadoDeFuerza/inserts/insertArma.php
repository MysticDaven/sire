<?php

header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");
include("../../../funcionesEstadoDeFuerza.php");

if (isset($_POST["jObjectDataGeneralMando"])){ $data = json_decode($_POST['jObjectDataGeneralMando'], true); }

if (isset($_POST['idMando'])){ $idMando = $_POST['idMando']; } //Se recibe idMando 
if (isset($_POST['flag'])){ $flag = $_POST['flag']; }

if (isset($_POST['idArma'])){ $idArma = $_POST['idArma']; } 
if (isset($_POST['cateArma'])){ $cateArma = $_POST['cateArma']; } 
if (isset($_POST['marcaArma'])){ $marcaArma = $_POST['marcaArma']; } 
if (isset($_POST['modeloArma'])){ $modeloArma = $_POST['modeloArma']; }
if (isset($_POST['matriculaArma'])){ $matriculaArma = $_POST['matriculaArma']; }
if (isset($_POST['calibreArma'])){ $calibreArma = $_POST['calibreArma']; }
if (isset($_POST['folioArma'])){ $folioArma = $_POST['folioArma']; }

if($data[9] == false){ $data[9] = 0; } else { $data[9] = 1; } //data[9] obtiene si es comisionado

//Si $idMando == 0 -> indica el registro de un nuevo mando ya que el $idMando y se cre un nuevo registro en la bd
if($idMando == 0){
 $queryTransaction = " 
                      BEGIN                     
                            BEGIN TRY 
                              BEGIN TRANSACTION
                                    SET NOCOUNT ON 

                                      declare @insertado int

                                      INSERT INTO pueDisposi.mando (nombre, paterno, materno, idCargo, idFuncion, idAreaAdscripcion, estatus, sexo, idFiscalia, idSeccion, comisionado, fechaAlta, fechaActualAdscripcion, observaciones) 
                                      VALUES('$data[0]', '$data[1]', '$data[2]', $data[4], $data[5], $data[7], 'BA', $data[3], $data[6], $data[8], $data[9], '$data[10]', '$data[11]', '$data[12]')

                                      select @insertado = @@IDENTITY

                                      INSERT INTO estadoFuerza.armas (idMando, catArma, marca, modelo, matricula, calibre, folio) VALUES(@insertado, $cateArma, '$marcaArma', '$modeloArma', '$matriculaArma', '$calibreArma', '$folioArma')

                                      SELECT MAX(idMando) AS idMando FROM pueDisposi.mando

                                      INSERT INTO estadoFuerza.historialAdscripcion (idMando, idFiscalia, idSeccion, idAreaAdscripcion, fechaAdscripcion) VALUES(@insertado, $data[6], $data[8], $data[7], '$data[11]')
                                                
                                    COMMIT
                            END TRY
                            BEGIN CATCH 
                                  ROLLBACK TRANSACTION
                                  RAISERROR('No se realizo la transaccion',16,1)
                            END CATCH
                            END
                      ";

 $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";
 if($result){
  while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){
   $getLastIdMando = $row['idMando']; //Obtenemos el id del ultimo mando ingresado en la transaccion anterior
  }
  $arreglo[2] = $getLastIdMando;
  $d = array('first' => $arreglo[1] , 'idLastMando' => $arreglo[2]);
  echo json_encode($d);

  //GUARDAMOS LA IMAGEN EN LA BASE DE DATOS Y LA MOVEMOS DE LA CARPETA TMP A FOTOGRAFIAS
  session_start();
  if(isset($_SESSION['tmp_path'])){
   $_SESSION['tmp_path'];
   $_SESSION['nombre_imagen'];
   $extension = end(explode('.', $_SESSION['nombre_imagen']));
   $carpeta_destino = 'fotografias/';

   if( copy($_SESSION['tmp_path'], $carpeta_destino.$getLastIdMando.".".$extension) ){
    $insertFoto = "INSERT INTO estadoFuerza.fotografias (idMando, foto) VALUES($getLastIdMando, '$getLastIdMando.$extension')"; 
    $resultInsertF = sqlsrv_query($conn, $insertFoto, array(), array( "Scrollable" => 'static' ));
    unlink($_SESSION['tmp_path']);
    unset($_SESSION['tmp_path']);
    unset($_SESSION['nombre_imagen']);
   }
  }
 }else{
  echo json_encode(array('first'=>$arreglo[0])); //Si no se realizo la transacción devolver 0 para indicar mensaje de alerta
 }
 /***Si se recibio un valor diferente de 0, indica que existe id de ese mando, por lo tanto es una edición de datos*/
}else if($idMando != 0){
 /*Comprobamos si existe un id del Item a modificar, si existe editamos el Item con el id recibido */
 if($idArma != 0){
  $queryTransaction = " 
                       BEGIN                     
                             BEGIN TRY 
                               BEGIN TRANSACTION
                                     SET NOCOUNT ON 

                                       UPDATE estadoFuerza.armas SET 
                                              catArma = $cateArma,
                                              marca = '$marcaArma',
                                              modelo = '$modeloArma',
                                              matricula = '$matriculaArma',
                                              calibre = '$calibreArma',
                                              folio = '$folioArma'
                                              WHERE idArma = $idArma
                                                 
                                   COMMIT
                             END TRY
                             BEGIN CATCH 
                                   ROLLBACK TRANSACTION
                                   RAISERROR('No se realizo la transaccion',16,1)
                             END CATCH
                             END
                      ";
}else{/*Si no existe id para el item indica que no existe registro en la bd de ese item asi que creamos un nuevo registro*/
  $queryTransaction = " INSERT INTO estadoFuerza.armas (idMando, catArma, marca, modelo, matricula, calibre, folio) VALUES($idMando, $cateArma, '$marcaArma', '$modeloArma', '$matriculaArma', '$calibreArma', '$folioArma')";
}

 $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));

 $arreglo[0] = "NO";
 $arreglo[1] = "SI";
 if ($result) {
  $d = array('first' => $arreglo[1] , 'idLastMando' => $idMando);
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }

}

