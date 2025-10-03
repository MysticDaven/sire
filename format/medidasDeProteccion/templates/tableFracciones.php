<?php
include ("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

$idInvolucrado = isset($_POST['idInvolucrado']) ? $_POST['idInvolucrado'] : null;
$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;
$idEnlace = isset($_POST['idEnlace']) ? $_POST['idEnlace'] : null;

$getDataFracciones = modificarMedidasAplicadasInvolucrado($connMedidas, $idInvolucrado);
$totalFraccAplicadas = sizeof($getDataFracciones);

?>
<?php
if ($totalFraccAplicadas > 0 ) { ?>
<table class="table table-bordered">
    <thead>
        <tr class="cabeceraTablaVictimas">
        <th>#</th>
        <th>Fracción</th>
        <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?for ($h=0; $h < sizeof($getDataFracciones) ; $h++) { ?>
        <tr>
            <td><?echo $getDataFracciones[$h][2] ?></td>
            <td><?echo $getDataFracciones[$h][1] ?></td>
            <td><center><span onclick="deleteItem(6, <?echo $getDataFracciones[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>, <?echo $totalFraccAplicadas ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
        </tr>
    <? } ?>
    </tbody>
</table>
<? }
else { ?>
<div class="panel ponel-default fd1">
    <h2>No hay Medidas de Protección registradas.</h2>
</div>
<div>
    <p style="color: black;">Favor de registrar las Medidas de Protección asociadas.</p>
</div>	
<? } ?>