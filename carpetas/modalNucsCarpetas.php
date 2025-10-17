<?
session_start();
include("../Conexiones/Conexion.php");
include("../Conexiones/conexionSicap.php");
include("../funciones.php");
include("../funcioneSicap.php");
include("../funcionesCarpetasV2.php");

if (isset($_POST["idMp"])) {
	$idMp = $_POST["idMp"];
}
if (isset($_POST["mes"])) {
	$mes = $_POST["mes"];
}
if (isset($_POST["anio"])) {
	$anio = $_POST["anio"];
}
if (isset($_POST["estatus"])) {
	$estatus = $_POST["estatus"];
}
if (isset($_POST["idUnidad"])) {
	$idUnidad = $_POST["idUnidad"];
}
if (isset($_POST["deten"])) {
	$deten = $_POST["deten"];
}



$idUsuario = $_SESSION['useridIE'];

$estatusArr = getNameEstReisolicion($conn, $estatus);
$estaNom = $estatusArr[0][0];

$hoy = date("Y-m-d");//Fecha calendario

?>


<div class="modal-header" style="background-color:#3c6084;">
	<center>
		<h4 class="modal-title" style="color:white; font-weight: bold;"> Resolución de Carpeta</h4>
	</center>
</div>


<div class="col-md-12 col-sm-12 col-xs-12 form-group ghost">
	<br>
	<div class="panel panel-default">
		<div class="panel-body " style="padding: 30px;">
			<h5 class="text-on-pannel"><strong> VALIDACIÓN DE NUCS </strong></h5>


			<div id="contDataNucDeterm"></div>


			<div class="row">
				<div class="col-xs-12">

					<?php if ($estatus == 20) {
						$dataCausas = geteCausasExtincionPenal($conn, "'VI'");

					?>
						<div class="col-xs-12">

							<label for="" style="font-size: 18px; font-weight:bold !important;">Causa de extinción de la acción penal </label>

								<select class="fechas form-control redondear" id="causaSeleted">
									<option value="0">SELECCIONA UNA CAUSA</option>
									<?php
									for ($i = 0; $i < sizeof($dataCausas); $i++) {
									?>
										<option value="<?php echo $dataCausas[$i][0]; ?>"><?php echo $dataCausas[$i][1]; ?></option>
									<?php
									}
									?>
								</select><br>

							<?  } ?>

						</div>


						<div class="row mt-3"><br>
							<div class="col-xs-4">

								<label>Estatus :</label>
								<input id="expediente" type="text" value="<? echo $estaNom; ?>" name="expediente" tabindex="0" placeholder="" style="height:38px; font-weight: bold;" class="fechas form-control redondear" disabled />
							</div>

							<div class="col-xs-4">

								<label style="font-weight:bold">Número de Caso *</label>
								<input id="nuc" type="number" name="nuc" value="" tabindex="0" placeholder="Ingresa Número de Caso" style="height:38px; font-weight: bold;" class="fechas form-control redondear" autofocus />
							</div>

							<?php if ($estatus != 22) {   ?>
								<div class="col-xs-4">

									<label style="font-weight:bold">.</label>
									<center><button style="width: 100%;" type="button" id="btnSaveNuc" class="btn btn-success redondear" onclick="saveCarpet(<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatus; ?>, <? echo $idUnidad; ?>, <? echo $deten; ?>)">Agregar NUC</button></center>
								</div>
							<?  } ?>
							<?php if ($estatus == 22) {   ?>
								<div class="col-xs-4">

									<label style="font-weight:bold">.</label>
									<center><button style="width: 100%;" type="button" id="btnSaveNuc" class="btn btn-success redondear" onclick="validateCarpetJudicializade2(<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatus; ?>, <? echo $idUnidad; ?>, <? echo $deten; ?>)">Validar y Guardar NUC</button></center>
								</div>
							<?  } ?>




						</div><br>

						<?php if ($estatus != 1) { ?>
					<div class="row mt-1">

							<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
								<label for="fecha_determinacion"><span class="glyphicon glyphicon-calendar"></span> Fecha de la determinación *:</label><br>
								<input type="date" class="form-control"  id="fecha_determinacion" aria-describedby="sizing-addon1" max="<?echo $hoy; ?>"  >
							</div>

						</div><br>
    <? } ?>


						<div id="contentMotivo">


						</div>


						
						<?php 
						
						if($estatus == 20){

							?>
							<div class="row">
							<br>
							<div id="contTableNucsV2" style="overflow-y: auto; overflow-x: auto; max-height: 500px !important;">
								<table class="table table-striped tblTransparente">
									<thead>
										<tr class="cabezeraTabla">
											<th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
											<th class="col-xs-5 col-sm-5 col-md-2 textCent">Numero Caso </th>
											<th class="col-xs-5 col-sm-5 col-md-2 textCent">Expediente</th>
											<th class="col-xs-5 col-sm-5 col-md-5 textCent">Causa de la extinción penal</th>
											<th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
											
										</tr>
									</thead>
									<tbody>

										<?
										$dataNucsXtipoResolucion = getDataXtipoResolucion($conn, $estatus, $mes, $anio, $idUnidad, $idMp, $deten);
										for ($i = 0; $i < sizeof($dataNucsXtipoResolucion); $i++) {

											$dataCausa = getCausaNucAnioMes($conn,  $dataNucsXtipoResolucion[$i][2]);
										?>
											<tr style="text-align: center !important;">
												<td><? echo $i + 1; ?></td>
												<td><? echo $dataNucsXtipoResolucion[$i][0]; ?></td>
												<td><? echo $dataNucsXtipoResolucion[$i][1]; ?></td>
												<td><? echo $dataCausa[0][1]; ?></td>
												<td>
													<center> <button type="button" onclick="deleteCarpetaResolV2(<? echo $dataNucsXtipoResolucion[$i][2]; ?>,<? echo $idMp; ?>,<? echo $anio; ?>,<? echo $mes; ?>,<? echo $estatus; ?>,<? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center>

												</td>
											</tr>
										<?
										}
										?>
									</tbody>
								</table>
							</div>
							<br>
							<br>
						</div>

							<?php
							
						}else{

							?>
										<div class="row">
							<br>
							<div id="contTableNucsV2" style="overflow-y: auto; overflow-x: auto; max-height: 500px !important;">
								<table class="table table-striped tblTransparente">
									<thead>
										<tr class="cabezeraTabla">
											<th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
											<th class="col-xs-5 col-sm-5 col-md-5 textCent">Numero Caso </th>
											<th class="col-xs-5 col-sm-5 col-md-5 textCent">Expediente</th>
											<th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
										</tr>
									</thead>
									<tbody>

										<?
										$dataNucsXtipoResolucion = getDataXtipoResolucion($conn, $estatus, $mes, $anio, $idUnidad, $idMp, $deten);
										for ($i = 0; $i < sizeof($dataNucsXtipoResolucion); $i++) {
										?>
											<tr style="text-align: center !important;">
												<td><? echo $i + 1; ?></td>
												<td><? echo $dataNucsXtipoResolucion[$i][0]; ?></td>
												<td><? echo $dataNucsXtipoResolucion[$i][1]; ?></td>
												<td>
													<center> <button type="button" onclick="deleteCarpetaResolV2(<? echo $dataNucsXtipoResolucion[$i][2]; ?>,<? echo $idMp; ?>,<? echo $anio; ?>,<? echo $mes; ?>,<? echo $estatus; ?>,<? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center>

												</td>
											</tr>
										<?
										}
										?>
									</tbody>
								</table>
							</div>
							<br>
							<br>
						</div>

							<?php

						}

						?>	



						


				</div>
				<div class="row">
					<!--<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="listoNucs(<? echo $numResolJudi; ?>);">Listo</button></center></div>-->
					<div class="col-xs-12 col-sm-12 col-md-12">
						<center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="modalsavecloseV2(<? echo $idMp; ?>,<? echo $anio; ?>,<? echo $mes; ?>,<? echo $idUnidad; ?>)">Salir</button></center>
					</div>
				</div>
			</div>

		</div>