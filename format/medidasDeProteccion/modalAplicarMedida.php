<?php
include ("../../Conexiones/Conexion.php");
include ("../../Conexiones/conexionMedidas.php");
include("../../Conexiones/conexionSicap.php");	
include("../../funcionesMedidasProteccion.php");	
$fecha_actual=date("d/m/Y");
$fecha=strftime( "%Y-%m-%d %H:%M:%S", time() );

if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["fraccion"])){ $fraccion = $_POST["fraccion"]; }
if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
$idInvolucrado = isset($_POST["idInvolucrado"]) ? $_POST["idInvolucrado"] : null;
$tipoInvolucrado = isset($_POST['tipoInvolucrado']) ? $_POST['tipoInvolucrado'] : null;
$action = isset($_POST['action']) ? $_POST['action'] : null;
$total = isset($_POST['total']) ? $_POST['total'] : 0;

$getFraccion = getFracciones($connMedidas, $fraccion);
$nombre = $getFraccion[0][0];
?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Aplicar nueva medida de protección</label></center>
</div>
<div class="modal-body">

	<!--DATOS RESOLUCIÓN-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong><?= ($action == 'add') ? 'Nueva' : 'Borrar' ?> medida de protección</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="nuevaMedida">Medida de protección: <span class="aste">(*)</span></label>
					<select class="form-control" id="nuevaMedida" name="nuevaMedida">
					  <option class="fontBold" value="<?echo $fraccion ?>"><?echo $nombre; ?></option>
					</select>
				</div>
			</div><br>
		</div>
	</div>
	<!--DATOS RESOLUCIÓN-->

	
<div class="modal-footer">
	<button type="button" class="btn btn-default" onclick="closeModalAplicarMedida()">Cerrar</button>
	<?php 
	if ($action == 'add') { ?>
		<button type="button" class="btn btn-primary" onclick="saveNuevaMedida(<?= $idInvolucrado ?>, <?echo $idMedida; ?>, <?echo $fraccion; ?>, <?echo $idEnlace; ?>, '<?echo $nuc; ?>', <?= $tipoInvolucrado ?>)">Aplicar</button>
	<? }
	else { ?>
		<button type="button" class="btn btn-danger" onclick="deleteFraccionMedida(<?= $idInvolucrado ?>, <?echo $idMedida; ?>, <?= $idEnlace ?>, <?echo $fraccion; ?>, 'false', <?= $total ?>, <?= $tipoInvolucrado ?>)">Borrar</button>
	<? }?>
</div>

