<?php
include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

$idEnlace = isset($_POST['idEnlace']) ? $_POST['idEnlace'] : null;
$checkMedidas = getCheckMedidas($connMedidas, $idEnlace);
?>

<?if(sizeof($checkMedidas) > 0){?>
<div class="alert alert-danger" id="msgAlert">
    <a href="#" class="alert-link" onclick="reloadModalMDP(1, <?= $idEnlace ?>, <?= $checkMedidas[0]['idMedida'] ?>, 0, 0, null, null)">Carpetas pendientes por asignar involucrados: </a><label><br><?= sizeof($checkMedidas); ?><br></label>
</div>			
<? } ?>	