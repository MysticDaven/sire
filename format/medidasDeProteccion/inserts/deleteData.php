<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

if (isset($_POST["moduloID"])){ $moduloID = $_POST["moduloID"]; } 
if (isset($_POST["item_ID"])){ $item_ID = $_POST["item_ID"]; } 
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; } 

if($moduloID == 2){
 $modulo = 'resolucion';
 $queryTransaction = "
                     BEGIN                     
                     BEGIN TRY 
                       BEGIN TRANSACTION
                           SET NOCOUNT ON                                    
                                     DELETE FROM medidas.resoluciones WHERE idResolucion = $item_ID AND idMedida = $idMedida
                               COMMIT
                     END TRY
                     BEGIN CATCH 
                           ROLLBACK TRANSACTION
                           RAISERROR('No se realizo la transaccion',16,1)
                     END CATCH
                     END
                   "; 
}
elseif($moduloID == 3){
 $modulo = 'victima';
 $queryTransaction = "
                     BEGIN                     
                     BEGIN TRY 
                       BEGIN TRANSACTION
                           SET NOCOUNT ON                                    
                                     DELETE FROM medidas.involucrado WHERE idInvolucrado = $item_ID
                                     DELETE FROM medidas.registro WHERE idInvolucrado = $item_ID
                                     DELETE FROM medidas.involucrado_medidasAplicadas WHERE idInvolucrado = $item_ID
                               COMMIT
                     END TRY
                     BEGIN CATCH 
                           ROLLBACK TRANSACTION
                           RAISERROR('No se realizo la transaccion',16,1)
                     END CATCH
                     END
                   "; 
}
elseif($moduloID == 4){
 $modulo = 'imputados';
 $queryTransaction = "
                     BEGIN                     
                     BEGIN TRY 
                       BEGIN TRANSACTION
                           SET NOCOUNT ON                                    
                                     DELETE FROM medidas.involucrado WHERE idInvolucrado = $item_ID AND idMedida = $idMedida
                               COMMIT
                     END TRY
                     BEGIN CATCH 
                           ROLLBACK TRANSACTION
                           RAISERROR('No se realizo la transaccion',16,1)
                     END CATCH
                     END
                   "; 
}
elseif($moduloID == 5){
 $modulo = 'constanciaLlamadas';
 $queryTransaction = "
                     BEGIN                     
                     BEGIN TRY 
                       BEGIN TRANSACTION
                           SET NOCOUNT ON                                    
                                     DELETE FROM medidas.constanciaLlamadas WHERE idConstancia = $item_ID AND idMedida = $idMedida
                               COMMIT
                     END TRY
                     BEGIN CATCH 
                           ROLLBACK TRANSACTION
                           RAISERROR('No se realizo la transaccion',16,1)
                     END CATCH
                     END
                   "; 
}
elseif($moduloID == 6){
 $modulo = 'fracciones';
 $queryTransaction = "
                     BEGIN                     
                     BEGIN TRY 
                       BEGIN TRANSACTION
                           SET NOCOUNT ON                                    
                                     DELETE FROM medidas.involucrado_medidasAplicadas WHERE idMedidaAplicada = $item_ID
                               COMMIT
                     END TRY
                     BEGIN CATCH 
                           ROLLBACK TRANSACTION
                           RAISERROR('No se realizo la transaccion',16,1)
                     END CATCH
                     END
                   "; 
}
elseif($moduloID == 7){
$modulo = 'seguimientoMedidas';
$queryTransaction = "
                        BEGIN                     
                        BEGIN TRY 
                        BEGIN TRANSACTION
                              SET NOCOUNT ON                                    
                                    DELETE FROM medidas.seguimientos WHERE idSeguimiento = $item_ID AND idMedida = $idMedida
                              COMMIT
                        END TRY
                        BEGIN CATCH 
                              ROLLBACK TRANSACTION
                              RAISERROR('No se realizo la transaccion',16,1)
                        END CATCH
                        END
                  ";       
}
elseif ($moduloID == 8) {
      $modulo = 'fracciones';
      $queryTransaction = "      
                        BEGIN                     
                        BEGIN TRY 
                        BEGIN TRANSACTION
                              SET NOCOUNT ON                                    
                                    DELETE FROM medidas.involucrado_medidasAplicadas WHERE idMedidaAplicada = $item_ID
                              COMMIT
                        END TRY
                        BEGIN CATCH 
                              ROLLBACK TRANSACTION
                              RAISERROR('No se realizo la transaccion',16,1)
                        END CATCH
                        END
                  ";
}

      
$result = sqlsrv_query($connMedidas,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
$arreglo[0] = "NO";
$arreglo[1] = "SI";
if ($result) {
 echo json_encode(array('first'=>$arreglo[1], 'modulo' => $modulo ) );
}else{
 echo json_encode(array('first'=>$arreglo[0]));
}

?>