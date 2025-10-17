<?
session_start();

include("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionSicap.php");
include("../../funciones.php");
include("../../funcioneSicap.php");
include("../../funcioneLit.php");

if (isset($_POST["cant"])) {
	$cant = $_POST["cant"];
}
if (isset($_POST["idMp"])) {
	$idMp = $_POST["idMp"];
}
if (isset($_POST["mes"])) {
	$mes = $_POST["mes"];
}
if (isset($_POST["anio"])) {
	$anio = $_POST["anio"];
}
if (isset($_POST["idUnidad"])) {
	$idUnidad = $_POST["idUnidad"];
}
if (isset($_POST["estatus"])) {
	$estatus = $_POST["estatus"];
}


$bandImputado = 0;

$arrayIDSllevanImputado = array(1,	2,	151,	10,	12,	13,	14,	15,	17,	18,	19,	20,	21,	22,	23,	24,	25,	26,	27,	28,	29,	30,	31,	36,	38
,	50,	53,	57,	58,	64,	65,	66,	67,	81,	84,	89,	90,	91,	93,	97,	99,	152,	153,	154,	155,	156,	157,	158,	159,	160,	161,	162,	163,	164, 165);

if(in_array($estatus, $arrayIDSllevanImputado)){
	$bandImputado = 1;
}else{
	$bandImputado = 0;
}


$numestatus = intval($estatus);


$sicaBand = 0;

if ($numestatus == 19 || $numestatus == 15 || $numestatus == 14 || $numestatus == 13) {

	$dataestatusLitSic = getEstatusResoluicionName($conSic, $estatus);
	$tipoestatus = $dataestatusLitSic[0][0];
	$sicaBand = 1;
} else {

	$dataestatusLit = getDataEstatusLitigacion($conn, $estatus);
	$tipoestatus = $dataestatusLit[0][0];
}


//echo $estatus."----".$tipoestatus;

$idUsuario = $_SESSION['useridIE'];


?>


<div class="modal-header" style="background-color:#3c6084;">
	<center>
		<h4 class="modal-title" style="color:white; font-weight: bold;"> VALIDACIÓN DE NUCS </h4>
	</center>
</div>



<div>

	<div class="panel-body panelunoLitigacion">
		<!--Solo en los estatus señalados en la siguiente condicional se permitira ingresar NUC o número de averiguación-->
		<? if ($estatus == 154 || $estatus == 66 || $estatus == 67) { ?>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-6 input-group-lg">
					<label for="TIPO_INVESTIGACION"><span class="glyphicon glyphicon-book"></span> Tipo de investigación * :</label><br>
					<select class="form-control" id="TIPO_INVESTIGACION" aria-describedby="sizing-addon1" onchange="tipo_investigacion()">
						<option class="fontBold" value="1" selected>Número Unico de Caso</option>
						<option class="fontBold" value="2">Averiguación Previa</option>
					</select>
				</div>
			</div><br>
		<? } ?>
		<div class="row">
			<div class="col-xs-6">
				<label>Cantidad de Casos :</label>
				<input id="casos" type="text" value="<? echo $cant; ?>" name="casos" value="Expediente" tabindex="0" placeholder="" style="height:38px; font-weight: bold;" class="fechas form-control redondear" disabled />
			</div>
			<div class="col-xs-6">
				<label>Estatus :</label>
				<input id="expediente" type="text" value="<? echo $tipoestatus; ?>" name="expediente" tabindex="0" placeholder="" style="height:38px; font-weight: bold;" class="fechas form-control redondear" disabled />
			</div>
		</div>
		<div id="contDataNucDeterm"></div>

		<div id="div_nuc">
			<div class="row">
				<div class="col-xs-6">
					<label style="font-weight:bold">Número de Caso *</label>
					<input id="nuc" type="number" name="nuc" value="" tabindex="0" onkeyup="<? if ($sicaBand == 1) { ?>  nucFunctionsLit('nuc', <? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatus; ?>, 0, <? echo $idUnidad; ?>); <?  } else {  ?>  nucInserts('nuc', <? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatus; ?>, 0, <? echo $idUnidad; ?>); <? } ?>" placeholder="Ingresa Número de Caso" style="height:38px; font-weight: bold;" class="fechas form-control redondear" autofocus />
				</div>
				<div class="col-xs-6">
					<label style="font-weight:bold">Expediente *</label>
					<div id="expedCont">
						<input id="expediente" type="" name="expediente" value="Expediente" tabindex="0" placeholder="" style="height:38px;" class="fechas form-control redondear" disabled />
					</div>
				</div>
			</div>
		</div>

<?if($estatus == 165){ ?>
	  <br /> 
			<div class="row">
				<div class="col-xs-6"> 
					<label style="font-weight:bold">Carga NUCS desde archivo Excel</label>

							<button type="button"  onclick="cargarModal_Excel('nuc', <? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatus; ?>, 0, <? echo $idUnidad; ?>)" class="btn btn-danger btn-sm redondear btnCapturarTbl">
								<span class="glyphicon glyphicon-cloud-upload"></span> Cargar Archivo 
							</button>

				</div>
			</div>
<? } ?>

		<div id="div_averiguacion" hidden>
			<div class="row">
				<div class="col-xs-6">
					<label style="font-weight:bold">Número de averiguación *</label>
					<input id="NO_AVERIGUACION" type="text" name="NO_AVERIGUACION" value="" tabindex="0" placeholder="Ingresa Número de Averiguación" style="height:38px; font-weight: bold;" class="fechas form-control redondear" autofocus />
				</div>
				<div class="col-xs-6">
					<label style="font-weight:bold">.</label><br>
					<button style="width: 97%;" type="button" class="btn btn-primary redondear" onclick="averiguacionInserts('nuc', <? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatus; ?>, 0, <? echo $idUnidad; ?>);">Agregar</button>
				</div>
			</div>
		</div>

		<?php if($bandImputado == 1){ ?> 
		<br>
		<div id="contentImputadosXnuc">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<label>Selecciona el Imputado relacionado a la determinación :</label>
				<select id="imputadoSeleted<? echo $i; ?>" name="imputadoSeleted" tabindex="6" class="form-control redondear" style="font-size: 18px !important;" required>
													<option value="0" >Selecciona</option>
													<?
													$dataImputadosNUc = getImputadosXnuc($conn, $nuc);
													for ($k = 0; $k < sizeof($dataImputadosNUc); $k++) {

														if ($guardado[0][3] == $dataImputadosNUc[$k][7]) {
													?>
															<option style="font-weight: bold !important;" selected value="<? echo $dataImputadosNUc[$k][7]; ?>"><? echo $dataImputadosNUc[$k][0] . " " . $dataImputadosNUc[$k][1] . " " . $dataImputadosNUc[$k][2]; ?></option>
														<?
														} else {
														?>
															<option style="font-weight: bold !important;" value="<? echo $dataImputadosNUc[$k][7]; ?>"><? echo $dataImputadosNUc[$k][0] . " " . $dataImputadosNUc[$k][1] . " " . $dataImputadosNUc[$k][2]; ?></option>
													<?
														}
													}
													?>

												</select>
			</div>
		</div></div>
		<?php } ?>

		<div class="row">
			<br>

			<!-- PONER EL HEIGH DE LA TABLA EN AUTO -->


			<?

			if ($sicaBand == 1) {

				//Valida si el status recibido pide informacion adicional para SENAP 
				$validaInfo =  validarEstatusShowInfo($estatus);

			?>
				<div id="contTableNucs" style="overflow-y: hidden; overflow-x: hidden; padding: 15px;">

					<table class="table table-striped tblTransparente">
						<thead>
							<tr class="cabezeraTabla">
								<th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
								<th class="col-xs-4 col-sm-4 col-md-4 textCent">Numero Caso </th>
								<th class="col-xs-6 col-sm-6 col-md-6 textCent">Expediente</th>
								<? if ($validaInfo) { ?><th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th><? } ?>
								<th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
							</tr>
						</thead>
						<tbody>
							<?

							//// Obtener las carpetas del Mp 
							$sumador = 0;
							$carpeAgente = getDistincCarpetasAgenteLiti($conSic, $idMp, $estatus, $mes, $anio, 0);
							$validaInfo =  validarEstatusShowInfo($estatus);

							for ($i = 0; $i < sizeof($carpeAgente); $i++) {

								$idResolMP = $carpeAgente[$i][0];
								$carpid = $carpeAgente[$i][1];
								$idUnidade = $carpeAgente[$i][2];
								$EstatusID = $carpeAgente[$i][4];
								$agenteid = $carpeAgente[$i][5];

								if ($idUnidad == $idUnidade && $estatus == $EstatusID and $idMp == $agenteid) {

									$nucs = getNucExpSicap($conSic, $carpid);
									$nuc = $nucs[0][0];
									$exp = $nucs[0][1];

							?>
									<tr>

										<td class="tdRowMain negr"><? echo ($sumador + 1); ?></td>
										<td class="tdRowMain negr"><? echo $nuc; ?></td>
										<td class="tdRowMain negr"><? echo $exp; ?></td>
										<? if ($validaInfo) { ?>
											<td class="tdRowMain">
												<center><button type="button" onclick="showModalNucLitSicaInfo(<? echo $idResolMP; ?>, <? echo $estatus ?>, <? echo $nuc; ?>)" class="btn btn-success btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Agregar </button></center>
											</td>
										<? } ?>


										<td class="tdRowMain">
											<center><button type="button" onclick="deleteResol(<? echo $idResolMP; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus ?>, <? echo $nuc; ?>, 0, <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center>
										</td>

									</tr>
							<?
									$sumador++;
								}
							}

							?>
						</tbody>
					</table>
				</div>
		</div>
	</div> <br>

	<div class="row">
		<!--<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="listoNucs(<? echo $numResolJudi; ?>);">Listo</button></center></div>-->
		<div class="col-xs-12 col-sm-12 col-md-12">
			<center><button style="width: 95%;" type="button" class="btn btn-primary redondear" onclick="modalsavecloseCmasc()">Salir</button></center>
		</div>
	</div><br>

<?

			} else {
				//Valida si el status recibido pide informacion adicional para SENAP 
				$validaInfo =  validarEstatusShowInfo($estatus);

?>

	<div id="contTableNucslitg" style="overflow-y: hidden; overflow-x: hidden; padding: 15px;">

		<table class="table table-striped tblTransparente">
			<thead>
				<tr class="cabezeraTabla">
					<th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
					<th class="col-xs-4 col-sm-4 col-md-4 textCent">Número Caso </th>
					<th class="col-xs-6 col-sm-6 col-md-6 textCent">Expediente</th>
					<? if ($validaInfo) { ?><th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th><? } ?>
					<th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
				</tr>
			</thead>
			<tbody>

				<?
/*solo para el estatus = 165*/
   if($estatus == 165){ 

   		//// Obtener las carpetas del Mp 
				$sumador = 0;
				$carpeAgente = getCarpetasAgenteLitigacion2($conn, $idMp, $estatus, $mes, $anio, $idUnidad);


				for ($i = 0; $i < sizeof($carpeAgente); $i++) {

					$nuc = $carpeAgente[$i][0];
					$idEstatusNucsThisNUC = $carpeAgente[$i][1]; //se agrego para obtener el idEstatusNucs 
					//// Por cada Carpeta Obtener la Ultima Determinacion que se realizo
					$lastDetermin = getLastDeterminacionCarpetaLitig($conn, $nuc);

					for ($k = 0; $k < sizeof($lastDetermin); $k++) {

						$idEstatusNucs = $lastDetermin[$k][0];
						$nuc = $lastDetermin[$k][1];
						$idUnidade = $lastDetermin[$k][2];
						$EstatusID = $lastDetermin[$k][3];
						$idCarpeta = $lastDetermin[$k][4];


						$nucs = getNucExpSicap($conSic, $idCarpeta);
						$nuc = $nucs[0][0];
						$exp = $nucs[0][1];

				?>
						<tr>

							<td class="tdRowMain negr"><? echo ($sumador + 1); ?></td>
							<td class="tdRowMain negr"><? echo $nuc; ?></td>
							<td class="tdRowMain negr"><? echo $exp; ?></td>
							<!--SE AGREGO EL BOTON PARA ABRIR EL NUEVO MODAL-->
							<? if ($validaInfo) { ?>
								<td class="tdRowMain">
									<center>
										<div class="buttonInfo"><button type="button" onclick="showModalNucLitInfo(<? echo $idEstatusNucsThisNUC; ?>, <? echo $estatus; ?>, <? echo $nuc; ?>, <? echo $idCarpeta; ?>, <? echo $idMp; ?>, <? echo $mes; ?> , <? echo $anio; ?>, 1 )" class="btn btn-success btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Agregar </button></div>
									</center>
								</td>
							<? } ?>
							<td class="tdRowMain">
								<center><button type="button" onclick="deleteResolLit(<? echo $idEstatusNucsThisNUC; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus ?>, <? echo $nuc; ?>, <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center>
							</td>

						</tr>
				<?
						$sumador++;
					}
				}

   }else{

				//// Obtener las carpetas del Mp 
				$sumador = 0;
				$carpeAgente = getDistincCarpetasAgenteLitigacion($conn, $idMp, $estatus, $mes, $anio, $idUnidad);


				for ($i = 0; $i < sizeof($carpeAgente); $i++) {

					$nuc = $carpeAgente[$i][0];
					$idEstatusNucsThisNUC = $carpeAgente[$i][1]; //se agrego para obtener el idEstatusNucs 
					//// Por cada Carpeta Obtener la Ultima Determinacion que se realizo
					$lastDetermin = getLastDeterminacionCarpetaLitig($conn, $nuc);

					for ($k = 0; $k < sizeof($lastDetermin); $k++) {

						$idEstatusNucs = $lastDetermin[$k][0];
						$nuc = $lastDetermin[$k][1];
						$idUnidade = $lastDetermin[$k][2];
						$EstatusID = $lastDetermin[$k][3];
						$idCarpeta = $lastDetermin[$k][4];


						$nucs = getNucExpSicap($conSic, $idCarpeta);
						$nuc = $nucs[0][0];
						$exp = $nucs[0][1];

				?>
						<tr>

							<td class="tdRowMain negr"><? echo ($sumador + 1); ?></td>
							<td class="tdRowMain negr"><? echo $nuc; ?></td>
							<td class="tdRowMain negr"><? echo $exp; ?></td>
							<!--SE AGREGO EL BOTON PARA ABRIR EL NUEVO MODAL-->
							<? if ($validaInfo) { ?>
								<td class="tdRowMain">
									<center>
										<div class="buttonInfo"><button type="button" onclick="showModalNucLitInfo(<? echo $idEstatusNucsThisNUC; ?>, <? echo $estatus; ?>, <? echo $nuc; ?>, <? echo $idCarpeta; ?>, <? echo $idMp; ?>, <? echo $mes; ?> , <? echo $anio; ?>, 1 )" class="btn btn-success btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Agregar </button></div>
									</center>
								</td>
							<? } ?>
							<td class="tdRowMain">
								<center><button type="button" onclick="deleteResolLit(<? echo $idEstatusNucsThisNUC; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus ?>, <? echo $nuc; ?>, <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center>
							</td>

						</tr>
				<?
						$sumador++;
					}
				}

			}/*solo para el estatus = 165*/
				?>


			</tbody>
		</table>

		<? if ($estatus == 154 || $estatus == 66 || $estatus == 67) {

					//TABLA PARA LAS SENTENCIAS
					//// Obtener las carpetas del Mp 
					$sumador = 0;
					$carpeAgente = getDistincAveriguacionesAgenteLitigacion($conn, $idMp, $estatus, $mes, $anio, $idUnidad);

					if (sizeof($carpeAgente) >= 0) {
		?>

				<table class="table table-striped tblTransparente">
					<thead>
						<tr class="cabezeraTabla">
							<th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
							<th class="col-xs-4 col-sm-4 col-md-4 textCent">Número de averiguación </th>
							<th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
							<? if ($validaInfo) { ?><th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th><? } ?>
						</tr>
					</thead>
					<tbody>




						<?


						//// Por cada Carpeta Obtener la Ultima Determinacion que se realizo
						$lastDetermin = getDistincAveriguacionesAgenteLitigacion($conn, $idMp, $estatus, $mes, $anio, $idUnidad);

						for ($k = 0; $k < sizeof($lastDetermin); $k++) {

							$idEstatusNucs = $lastDetermin[$k][1];
							$nuc = $lastDetermin[$k][0];

						?>
							<tr>

								<td class="tdRowMain negr"><? echo ($sumador + 1); ?></td>
								<td class="tdRowMain negr"><? echo $nuc; ?></td>
								<? if ($validaInfo) { ?>
									<td class="tdRowMain">
										<center>
											<div class="buttonInfo"><button type="button" onclick="showModalNucLitInfo(<? echo $idEstatusNucs; ?>, <? echo $estatus; ?>, '<? echo $nuc; ?>', 0,0,0,0, 2)" class="btn btn-success btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Agregar </button></div>
										</center>
									</td>
								<? } ?>
								<td class="tdRowMain">
									<center><button type="button" onclick="deleteResolLit_ave(<? echo $idEstatusNucs; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus ?>, '<? echo $nuc; ?>', <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar</button></center>
								</td>

							</tr>
						<?
							$sumador++;
						}

						?>
					</tbody>
				</table>
		<?           }
				} ?>


	</div>
</div>
</div>


<div class="row"><br>
	<!--<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="listoNucs(<? echo $numResolJudi; ?>);">Listo</button></center></div>-->
	<div class="col-xs-12 col-sm-12 col-md-12">
		<center><button style="width: 97%;" type="button" class="btn btn-primary redondear" onclick="modalsavecloseCmasc()">Salir</button></center>
	</div> <br>
</div><br>
<?


			}




?>