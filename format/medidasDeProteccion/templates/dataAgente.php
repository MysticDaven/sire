<?php
include ("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");	

if (isset($_POST["agentesMP_id"])){ $agentesMP_id = $_POST["agentesMP_id"]; }	
$data = getDataAdscripcion($connMedidas, $agentesMP_id);
$cargo  = 'Agente del Ministerio Publico';
$idFiscalia = $data[0][2];
$nombreFiscalia  = $data[0][3];
?>
<div class="col-xs-12 col-sm-12  col-md-2">
	<label for="idAdscripcion">Área de adscripción :</label>
	<select class="form-control" id="idAdscripcion" disabled>
	<?for ($h=0; $h < sizeof($data); $h++) { 
		$idUnidad = $data[$h][0];	$nombreUnidad = $data[$h][1]; ?>
		<option class="fontBold" value="<? echo $idUnidad; ?>" > <? echo $nombreUnidad; ?> </option>
	<? } ?>
	</select>
</div>	
<div class="col-xs-12 col-sm-12  col-md-2">
	<label for="idCargo">Cargo :</label>
	<select class="form-control" id="idCargo" disabled>
		<option value="1">Agente del Ministerio Publico</option>
	</select>
</div>
<div class="col-xs-12 col-sm-12  col-md-2">
	<label for="idFuncion">Función :</label>
	<select class="form-control" id="idFuncion" disabled>
		<option value="1">Agente</option>
	</select>
</div>
<div class="col-xs-12 col-md-3">
	<label for="idCoorporacion">Coorporación Policial que dará protección: </label>
	<select class="form-control" id="idCoorporacion">
		<option value=null>Seleccione la coorporación</option>
		<?php 
		$getCoorporacion = getCoorporacion($connMedidas);
		foreach($getCoorporacion as $coorporacion){ ?>									
			<option value="<?= $coorporacion['idCatCoorporacion'] ?>"><?= $coorporacion['nombre'] ?></option>
		<?}
		?>
	</select>
</div>

						
					

