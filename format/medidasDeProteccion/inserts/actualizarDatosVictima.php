<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/conexionMedidas.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }

$idInvolucrado = isset($_POST['idInvolucrado'])	 ? $_POST['idInvolucrado'] : null;

//VARIABLES DEL FORMULARIO OBTENIDO
if (isset($_POST['nombreVictiEdita'])){ $nombreVictiEdita = $_POST['nombreVictiEdita']; }
if (isset($_POST['paternoVictiEdita'])){ $paternoVictiEdita = $_POST['paternoVictiEdita']; }
if (isset($_POST['maternoVictiEdita'])){ $maternoVictiEdita = $_POST['maternoVictiEdita']; }
if (isset($_POST['generoVictiEdita'])){ $generoVictiEdita = $_POST['generoVictiEdita']; }
if (isset($_POST['edadVictimaEdita'])){ $edadVictimaEdita = $_POST['edadVictimaEdita']; }

if (isset($_POST['entidad'])){ $entidad = $_POST['entidad']; }
if (isset($_POST['municipio'])){ $municipio = $_POST['municipio']; }
if (isset($_POST['colonia'])){ $colonia = $_POST['colonia']; }
if (isset($_POST['calle'])){ $calle = $_POST['calle']; }
if (isset($_POST['numero'])){ $numero = $_POST['numero']; }
if (isset($_POST['telefonoUno'])){ $telefonoUno = $_POST['telefonoUno']; }
if (isset($_POST['telefonoDos'])){ $telefonoDos = $_POST['telefonoDos']; }
if (isset($_POST['codigoPostal'])){ $codigoPostal = $_POST['codigoPostal']; }
if (isset($_POST['correoElectronico'])){ $correoElectronico = $_POST['correoElectronico']; }

 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
      
       UPDATE medidas.involucrado SET 
        nombre = '$nombreVictiEdita', 
        paterno = '$paternoVictiEdita',
        materno = '$maternoVictiEdita',
        genero = $generoVictiEdita,
        edad = $edadVictimaEdita, 
        idEntidad = $entidad, 
        idMunicipio = $municipio,
        colonia = '$colonia',
        calle = '$calle',
        numero = '$numero',
        telefono1 = '$telefonoUno',
        telefono2 = '$telefonoDos',
        codigoPostal = $codigoPostal,
        correo = '$correoElectronico'
        WHERE idInvolucrado = $idInvolucrado

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