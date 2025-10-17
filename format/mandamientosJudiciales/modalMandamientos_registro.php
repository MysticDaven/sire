<?php
include("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionSIMAJ.php");
include("../../funcionesMandamientos.php");

$fecha_actual = date("Y-m-d");
//$fecha_actual=date("d/m/Y");
$fecha = strftime("%Y-%m-%d %H:%M:%S", time());
$anioActual = date("Y");
$hoy = date("Y-m-d"); //Fecha calendario

if (isset($_POST["idEnlace"])) {
	$idEnlace = $_POST["idEnlace"];
}
if (isset($_POST["idUnidad"])) {
	$idUnidad = $_POST["idUnidad"];
}
if (isset($_POST["idfisca"])) {
	$idfisca = $_POST["idfisca"];
}


if (isset($_POST["tipoModal"])) {
	$tipoModal = $_POST["tipoModal"];
}
if (isset($_POST["typeArch"])) {
	$typeArch = $_POST["typeArch"];
}
if (isset($_POST["typeCheck"])) {
	$typeCheck = $_POST["typeCheck"];
}

/*$getRolUser = getRolUser($connMedidas, $idEnlace);
$rolUser = $getRolUser[0][0];*/

if ($typeCheck == 0) {
	$b = 0;
} else {
	if ($typeCheck == 1) {
		$b = 1;
	}
}

if (isset($_POST["ID_MANDAMIENTO_INTERNO"])) {

	$ID_MANDAMIENTO_INTERNO = $_POST["ID_MANDAMIENTO_INTERNO"];


	/********CONSULTAS PARA TRAER LOS ID DE LAS INSERSIONES EN LA BASE DE SIMAJ*******/
	$get_data_Mandamiento = get_data_Mandamiento($conn, $ID_MANDAMIENTO_INTERNO);
	if (sizeof($get_data_Mandamiento) > 0) {
		$GET_ID_MANDAMIENTO_INTERNO  = $get_data_Mandamiento[0][1];
	} else {
		$GET_ID_MANDAMIENTO_INTERNO = 0;
	}

	$get_data_inculpado = get_data_Inculpado_id($conn, $ID_MANDAMIENTO_INTERNO);
	if (sizeof($get_data_inculpado) > 0) {
		$GET_ID_DATOS_INCULPADO  = $get_data_inculpado[0][1];
	} else {
		$GET_ID_DATOS_INCULPADO  = 0;
	}
	/********CONSULTAS PARA TRAER LOS ID DE LAS INSERSIONES EN LA BASE DE SIMAJ*******/

	if ($ID_MANDAMIENTO_INTERNO != 0) {
		$mandamientoData = getData_Mandamiento($conn, $ID_MANDAMIENTO_INTERNO);
		$ID_MANDAMIENTO_INTERNO = $mandamientoData[0][1];
		$ID_MANDAMIENTO = $mandamientoData[0][2];
		$ID_PAIS = $mandamientoData[0][3];
		$ID_ESTADO_EMISOR = $mandamientoData[0][4];
		$ID_MUNICIPIO = $mandamientoData[0][5];
		$FISCALIA = $mandamientoData[0][6];
		$ID_EMISOR = $mandamientoData[0][7];
		$NO_MANDATO = $mandamientoData[0][8];
		$ID_ESTADO_JUZGADO = $mandamientoData[0][9];
		$ID_JUZGADO = $mandamientoData[0][10];
		$NO_CAUSA = $mandamientoData[0][11];
		$OFICIO_JUZGADO = $mandamientoData[0][12];
		$FECHA_OFICIO = $mandamientoData[0][13]->format('Y-m-d');
		$ID_TIPO_CUANTIA = $mandamientoData[0][14];
		$FECHA_LIBRAMIENTO = $mandamientoData[0][15]->format('Y-m-d');
		$ID_FUERO_PROCESO = $mandamientoData[0][16];
		$ID_TIPO_MANDATO = $mandamientoData[0][17];
		$NO_PROCESO = $mandamientoData[0][18];
		$TIPO_INVESTIGACION = $mandamientoData[0][19];
		$NO_AVERIGUACION = $mandamientoData[0][20];
		$CARPETA_INV = $mandamientoData[0][21];
		$FECHA_CAPTURA = $mandamientoData[0][22]->format('Y-m-d');
		$FECHA_RECEPCION = $mandamientoData[0][23]->format('Y-m-d');
		//$FECHA_PRESCRIPCION = $mandamientoData[0][24]->format('Y-m-d');
		$OBSERVACIONES = $mandamientoData[0][25];
		$ID_PROCESO_EXTRADI = $mandamientoData[0][26];
		$ID_TIPO_PROCESO = $mandamientoData[0][27];
		$ACUMULADO_PROCESO = $mandamientoData[0][28];
		$ACUMULADO_AVERIGUACION = $mandamientoData[0][29];
		$EDO_ORDEN = $mandamientoData[0][30];
		$COLABORACION = $mandamientoData[0][31];
		$JUZGADO_COLABORACION = $mandamientoData[0][32];
		$OBSERVACIONES_INT = $mandamientoData[0][33];
		$a = 1;

		$dataFileMandamiento = getFileFromMAndamiento($conn, $ID_MANDAMIENTO_INTERNO);

	} else {
		$a = 0;
		$ID_MANDAMIENTO_INTERNO = 0;
		$COLABORACION = 0;
	}
}

$get_tipo_user = get_tipo_user($idEnlace);

?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Registro de Mandamientos Judiciales </label></center>
</div>
<div class="modal-body panel_registroMandamientos">
	<!--DATOS GENERALES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos generales</strong></h5>
			<div class="row" hidden>
				<div class="col-xs-12 col-sm-12  col-md-3 col-md-offset-10 input-group-lg">
					<div class="checkbox">
						<h4><label><input type="checkbox" id="colaboracion" onchange="reload_juzgados()" <? if ($a == 1 && $COLABORACION == 1) { ?> checked <? } ?>><a>Es una colaboración</a></label></h4>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
					<label for="FECHA_CAPTURA"><span class="glyphicon glyphicon-calendar"></span> Fecha de captura:</label><br>
					<input type="text" class="form-control" id="FECHA_CAPTURA" placeholder="Username" aria-describedby="sizing-addon1" disabled value="<? if ($a == 1) {
						echo $FECHA_CAPTURA;
						} else {
							echo $fecha_actual;
						} ?>">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="ID_PAIS"><span class="glyphicon glyphicon-globe"></span> Pais de la información:</label><br>
						<select class="form-control" id="ID_PAIS">
							<? $nacionalidades = getNacionalidades($connSIMAJ);
							for ($i = 0; $i < sizeof($nacionalidades); $i++) {
								$cv_nacionalidad = $nacionalidades[$i][0];
								$pais = $nacionalidades[$i][2]; ?>
								<option class="fontBold" value="<? echo $cv_nacionalidad; ?>" <? if ($a == 0 && $cv_nacionalidad == 82) { ?> selected <? } elseif ($a == 1 && $cv_nacionalidad == $ID_PAIS) {  ?> selected <? } ?>><? echo $pais; ?></option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="ID_ESTADO_EMISOR"><span class="glyphicon glyphicon-map-marker"></span> Entidad *:</label><br>
						<select class="form-control" id="ID_ESTADO_EMISOR" onchange="reloadMunicipios(),validateCampo_OK(this.id)">
							<option class="fontBold" value="">Seleccione la entidad</option>
							<? $entidades = getEntidades($connSIMAJ);
							for ($i = 0; $i < sizeof($entidades); $i++) {
								$cv_entidad = $entidades[$i][0];
								$entidad = $entidades[$i][1]; ?>
								<option class="fontBold" value="<? echo $cv_entidad; ?>" <? if ($a == 0 && $cv_entidad == 16) { ?> selected <? } elseif ($a == 1 && $cv_entidad == $ID_ESTADO_EMISOR) { ?> selected <? } ?>><? echo $entidad; ?></option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="ID_MUNICIPIO"><span class="glyphicon glyphicon-map-marker"></span> Municipio:</label><br>
						<div class="preloaderSelect_Municipios" hidden>Cargando datos...<img width="50px" src="img/loaderData.gif"></div>
						<select class="form-control" id="ID_MUNICIPIO" onchange="reloadFiscaliaRegional(),validateCampo_OK(this.id)">
							<option class="fontBold" value="">Seleccione el municipio</option>
							<? if ($a == 0) {
								$municipios = getMunicipios($connSIMAJ, $cv_entidad = 16);
							} elseif ($a == 1) {
								$municipios = getMunicipios($connSIMAJ, $ID_ESTADO_EMISOR);
							}
							for ($i = 0; $i < sizeof($municipios); $i++) {
								$cv_municipio = $municipios[$i][0];
								$municipio = $municipios[$i][1]; ?>
								<option class="fontBold" value="<? echo $cv_municipio; ?>" <? if ($a == 1 && $cv_municipio == $ID_MUNICIPIO) { ?> selected <? } ?>><? echo $municipio; ?></option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-6 input-group-lg">
						<label for="ID_EMISOR"><span class="glyphicon glyphicon-home"></span> Institución de la información:</label><br>
						<select class="form-control" id="ID_EMISOR">
							<? $emisor = getEmisor($connSIMAJ);
							for ($i = 0; $i < sizeof($emisor); $i++) {
								$id_emisor = $emisor[$i][1];
								$tipo = $emisor[$i][2]; ?>
								<option class="fontBold" value="<? echo $id_emisor; ?>" <? if ($a == 0 && $id_emisor == 24) { ?>selected <? } elseif ($a == 1 && $id_emisor == $ID_EMISOR) { ?> selected <? } ?>><? echo $tipo; ?></option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12  col-md-6 input-group-lg">
						<label for="FISCALIA"><span class="glyphicon glyphicon-asterisk"></span> Fiscalia regional:</label><br>
						<div class="preloaderSelect_FisRegional" hidden>Cargando datos...<img width="50px" src="img/loaderData.gif"></div>
						<select class="form-control" id="FISCALIA" onchange="validateCampo_OK(this.id)">
							<? if ($a == 0) { ?>
								<option value="0">Seleccione primero el municipio</option>
							<? } elseif ($a == 1) { ?>
								<option class="fontBold" value="">Seleccione la fiscalía regional</option>
								<? $fiscaliaRegional = getFiscaliaRegional($connSIMAJ, $ID_MUNICIPIO);
								if (sizeof($fiscaliaRegional) > 0) {
									for ($i = 0; $i < sizeof($fiscaliaRegional); $i++) {
										$id = $fiscaliaRegional[$i][0];
										$nom_fis = $fiscaliaRegional[$i][1]; ?>
										<option class="fontBold" value="<? echo $id; ?>" <? if ($id == $FISCALIA) { ?> selected <? } ?>><? echo $nom_fis; ?></option>
									<? }
								} else { ?>
									<option class="fontBold" value="0" selected>NO ESPECIFICADO</option>
								<? }
							} ?>
						</select>
					</div>
				</div><br><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="ID_TIPO_MANDATO">Tipo de mandamiento *:</label><br>
						<select class="form-control" id="ID_TIPO_MANDATO" onchange="validateCampo_OK(this.id)">
							<option class="fontBold" value="">Seleccione un mandamiento</option>
							<? $mandato = getMandamiento($connSIMAJ);
							for ($i = 0; $i < sizeof($mandato); $i++) {
								$cv_mandato = $mandato[$i][0];
								$tipo = $mandato[$i][1]; ?>
								<option class="fontBold" value="<? echo $cv_mandato; ?>" <? if ($a == 1 && $cv_mandato == $ID_TIPO_MANDATO) { ?> selected <? } ?>><? echo $tipo; ?></option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="NO_MANDATO"><span class="glyphicon glyphicon-exclamation-sign"></span> No. de mandato *:</label><br>
						<input type="text" class="form-control" id="NO_MANDATO" placeholder="ESPECIFICA EL NO. DE MANDATO *" maxlength="30" aria-describedby="sizing-addon1" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " onkeypress="return validaInput(event, 'mandato')" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
							echo $NO_MANDATO;
						} ?>">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="ID_TIPO_PROCESO"><span class="glyphicon glyphicon-list-alt"></span> Tipo de proceso *:</label><br>
						<select class="form-control" id="ID_TIPO_PROCESO" onchange="validateCampo_OK(this.id)">
							<option class="fontBold" value="">Seleccione un tipo de proceso</option>
							<? $proceso = getProceso($connSIMAJ);
							for ($i = 0; $i < sizeof($proceso); $i++) {
								$cv_tipo_proceso = $proceso[$i][0];
								$tipo = $proceso[$i][1]; ?>
								<option class="fontBold" value="<? echo $cv_tipo_proceso; ?>" <? if ($a == 1 && $cv_tipo_proceso == $ID_TIPO_PROCESO) { ?>selected <? } ?>><? echo $tipo; ?></option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="EDO_ORDEN">Estado del mandamiento:</label><br>
						<select class="form-control" id="EDO_ORDEN" disabled>
							<? $estatus = getEstadoMandamiento($connSIMAJ);
							for ($i = 0; $i < sizeof($estatus); $i++) {
								$cv_est_act_man = $estatus[$i][0];
								$tipo = $estatus[$i][1]; ?>
								<option class="fontBold" value="<? echo $cv_est_act_man; ?>" <? if ($a == 0 && $cv_est_act_man == 6) { ?> selected <? } elseif ($a == 1 && $cv_est_act_man == $EDO_ORDEN) { ?> selected <? } ?>><? echo $tipo; ?></option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="FECHA_RECEPCION"><span class="glyphicon glyphicon-calendar"></span> Fecha de recepción *:</label><br>
						<input type="date" class="form-control" id="FECHA_RECEPCION" aria-describedby="sizing-addon1" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
							echo $FECHA_RECEPCION;
						} ?>">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-2 input-group-lg">
						<label for="FECHA_OFICIO"><span class="glyphicon glyphicon-calendar"></span> Fecha del oficio :</label><br>
						<input type="date" class="form-control" id="FECHA_OFICIO" aria-describedby="sizing-addon1" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
							echo $FECHA_OFICIO;
						} ?>">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-2 input-group-lg">
						<label for="ID_TIPO_CUANTIA"><span class="glyphicon glyphicon-exclamation-sign"></span> Tipo cuantia *:</label><br>
						<select class="form-control" id="ID_TIPO_CUANTIA" onchange="validateCampo_OK(this.id)" disabled>
							<option class="fontBold" value="">Seleccione el tipo</option>
							<? $cuantia = getTipoCuantia($connSIMAJ);
							for ($i = 0; $i < sizeof($cuantia); $i++) {
								$cv_tipo_cuantia = $cuantia[$i][0];
								$tipo = $cuantia[$i][1]; ?>
								<option class="fontBold" value="<? echo $cv_tipo_cuantia; ?>" <? if ($a == 0 && $cv_tipo_cuantia == 9999) { ?>selected <? } elseif ($a == 1 && $cv_tipo_cuantia == $ID_TIPO_CUANTIA) { ?> selected <? } ?>><? echo $tipo; ?></option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12  col-md-2 input-group-lg">
						<label for="ID_FUERO_PROCESO">Fuero:</label><br>
						<select class="form-control" id="ID_FUERO_PROCESO" onchange="validateCampo_OK(this.id)" disabled>
							<option class="fontBold" value="">Seleccione el fuero</option>
							<? $fuero = getFuero($connSIMAJ);
							for ($i = 0; $i < sizeof($fuero); $i++) {
								$cv_fuero = $fuero[$i][0];
								$tipo = $fuero[$i][1]; ?>
								<option class="fontBold" value="<? echo $cv_fuero; ?>" <? if ($a == 0 && $cv_fuero == 1) { ?>selected <? } elseif ($a == 1 && $cv_fuero == $ID_FUERO_PROCESO) { ?> selected <? } ?>><? echo $tipo; ?></option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="ID_PROCESO_EXTRADI"><span class="glyphicon glyphicon-plane"></span> Proceso de extradición *:</label><br>
						<select class="form-control" id="ID_PROCESO_EXTRADI" onchange="validateCampo_OK(this.id)" disabled>
							<option class="fontBold" value="">Seleccione si hubo proceso</option>
							<? $extradicion = getProcesoExtradicion($connSIMAJ);
							for ($i = 0; $i < sizeof($extradicion); $i++) {
								$cv_extradicion = $extradicion[$i][0];
								$tipo = $extradicion[$i][1]; ?>
								<option class="fontBold" value="<? echo $cv_extradicion; ?>" <? if ($a == 0 && $cv_extradicion == 2) { ?> selected <? } elseif ($a == 1 && $cv_extradicion == $ID_PROCESO_EXTRADI) { ?> selected <? } ?>><? echo $tipo; ?></option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="ID_ESTADO_JUZGADO"><span class="glyphicon glyphicon-map-marker"></span> Entidad de la información *:</label><br>
						<select class="form-control" id="ID_ESTADO_JUZGADO" onchange="reload_juzgados(),validateCampo_OK(this.id)" disabled>
							<option class="fontBold" value="">Seleccione la entidad</option>
							<? $entidades_juzgado = getEntidades($connSIMAJ);
							for ($i = 0; $i < sizeof($entidades_juzgado); $i++) {
								$cv_entidad_juzgado = $entidades_juzgado[$i][0];
								$entidad_juzgado = $entidades_juzgado[$i][1]; ?>
								<option class="fontBold" value="<? echo $cv_entidad_juzgado; ?>" <? if ($a == 0 && $cv_entidad_juzgado == 16) { ?> selected <? } elseif ($a == 1 && $cv_entidad_juzgado == $ID_ESTADO_JUZGADO) { ?> selected <? } ?>><? echo $entidad_juzgado; ?></option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg" id="div_juzgadoColab" <? if ($COLABORACION == 0) { ?>hidden <? } ?>> <!--OCULTO MIENTRAS COLABORACION = FALSE-->
						<label for="JUZGADO_COLABORACION">Juzgado* :</label><br>
						<input type="text" class="form-control" id="JUZGADO_COLABORACION" placeholder="ESPECIFICA EL JUZGADO *" aria-describedby="sizing-addon1" maxlength="30" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " onkeypress="return validaInput(event, 'varchar')" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
							echo $JUZGADO_COLABORACION;
						} ?>">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg" id="div_juzgado" <? if ($COLABORACION == 1) { ?>hidden <? } ?>> <!--VISIBLE MIENTRAS COLABORACION = FALSE-->
						<label for="ID_JUZGADO">Juzgado* :</label><br>
						<div class="preloaderSelect_Juzgados" hidden>Cargando datos...<img width="50px" src="img/loaderData.gif"></div>
						<select class="form-control" id="ID_JUZGADO" onchange="validateCampo_OK(this.id)">
							<? if ($a == 0) { ?>
								<option class="fontBold" value="">Seleccione la entidad del juzgado</option>
								<? $juzgado = getJuzgado($connSIMAJ, $id_juzgado = 16);
								for ($i = 0; $i < sizeof($juzgado); $i++) {
									$cv_juzgado = $juzgado[$i][0];
									$descrip_juzgado = $juzgado[$i][2]; ?>
									<option class="fontBold" value="<? echo $cv_juzgado; ?>" <? if ($cv_juzgado == 1036) { ?> selected <? } ?>><? echo $descrip_juzgado; ?></option>
								<? }
							} elseif ($a == 1) { ?>
								<? $juzgado  = getJuzgado($connSIMAJ, $ID_ESTADO_JUZGADO);
								if (sizeof($juzgado) > 0) {
									for ($i = 0; $i < sizeof($juzgado); $i++) {
										$cv_juzgado = $juzgado[$i][0];
										$descrip_juzgado = $juzgado[$i][2]; ?>
										<option class="fontBold" value="<? echo $cv_juzgado; ?>" <? if ($cv_juzgado == $ID_JUZGADO) { ?> selected <? } ?>><? echo $descrip_juzgado; ?></option>
									<? }
								} else { ?>
									<option class="fontBold" value="0">NO ESPECIFICADO</option>
								<? }
							} ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="OFICIO_JUZGADO"> # No. de oficio del juzgado * :</label><br>
						<input type="text" class="form-control" id="OFICIO_JUZGADO" placeholder="ESPECIFICA EL NO. DE OFICIO DEL JUZGADO" maxlength="30" aria-describedby="sizing-addon1" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " onkeypress="return validaInput(event, 'varchar')" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
							echo $OFICIO_JUZGADO;
						} ?>">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="FECHA_PRESCRIPCION"><span class="glyphicon glyphicon-calendar"></span> Fecha de prescripción:</label><br>
						<input type="date" class="form-control" id="FECHA_PRESCRIPCION" aria-describedby="sizing-addon1" onchange="validateCampo_OK(this.id)" value="" disabled>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="NO_CAUSA"># No. causa :</label><br>
						<input type="text" class="form-control" id="NO_CAUSA" placeholder="ESPECIFICA EL NO. DE CAUSA *" maxlength="30" aria-describedby="sizing-addon1" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " onkeypress="return validaInput(event, 'no_causa')" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
							echo $NO_CAUSA;
						} ?>">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="NO_PROCESO"># No. de proceso :</label><br>
						<input type="text" class="form-control" id="NO_PROCESO" placeholder="ESPECIFICA EL NO. DE PROCESO *" maxlength="30" aria-describedby="sizing-addon1" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " onkeypress="return validaInput(event, 'proceso')" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
							echo $NO_PROCESO;
						} ?>">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<label for="FECHA_LIBRAMIENTO"><span class="glyphicon glyphicon-calendar"></span> Fecha de libramiento:</label><br>
						<input type="date" class="form-control" id="FECHA_LIBRAMIENTO" aria-describedby="sizing-addon1" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
							echo $FECHA_LIBRAMIENTO;
						} ?>">
					</div>
				</div><br>
				<div class="row">
					<? if ($idEnlace == 3530) { ?> 
						<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
							<label for="TIPO_INVESTIGACION"><span class="glyphicon glyphicon-book"></span> Tipo de investigación * :</label><br>
							<select class="form-control" id="TIPO_INVESTIGACION" aria-describedby="sizing-addon1" id="tipo_investigacion" onchange="reloadTipoInvestigacion()">
								<option class="fontBold" value="1" <? if ($a == 1 && $TIPO_INVESTIGACION == 1) { ?> selected <? } ?>>Averiguación Previa</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg" id="div_nuc_averiguacion">
							<label for="NO_AVERIGUACION"><span class="glyphicon glyphicon-certificate"></span> No. de averiguación :</label><br>
							<input type="text" id="NO_AVERIGUACION" class="form-control" placeholder="ESPECIFICA EL NO. DE AVERIGUACIÓN PREVIA*" aria-describedby="sizing-addon1" maxlength="15" oninput="validateNucs(this)" type="number" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
								echo $NO_AVERIGUACION;
							} ?>">
						</div>
						<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg" id="div_nuc" hidden>
							<label for="nuc"><span class="glyphicon glyphicon-certificate"></span> NUC :</label><br>
							<div class="preloaderSelect_NUC" hidden>Validando NUC, espere un momento...<img width="50px" src="img/loaderData.gif"></div>
							<input type="number" id="nuc" class="form-control" placeholder="ESPECIFICA EL NUC*" aria-describedby="sizing-addon1" maxlength="13" oninput="validateNucs(this)" type="number" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
								echo $CARPETA_INV;
							} ?>">
						</div>
					<? } else { ?>
						<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
							<label for="TIPO_INVESTIGACION"><span class="glyphicon glyphicon-book"></span> Tipo de investigación * :</label><br>
							<select class="form-control" id="TIPO_INVESTIGACION" aria-describedby="sizing-addon1" id="tipo_investigacion" onchange="reloadTipoInvestigacion(), saveAvButton()">
								<option class="fontBold" value="1" <? if ($a == 1 && $TIPO_INVESTIGACION == 1) { ?> selected <? } ?>>Averiguación Previa</option>
								<option class="fontBold" value="2" <? if ($a == 0) { ?> selected <? } elseif ($a == 1 && $TIPO_INVESTIGACION == 2) { ?> selected <? } ?>>Número Unico de Caso</option>
							</select>
							</div><? $hide_show_av = 'hidden';
							$hide_show_nuc = '';
							if ($a == 1 && $TIPO_INVESTIGACION == 1) {
								$hide_show_av = '';
								$hide_show_nuc = 'hidden';
							} ?>
							<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg" id="div_nuc_averiguacion" <? echo $hide_show_av; ?>>
								<label for="NO_AVERIGUACION"><span class="glyphicon glyphicon-certificate"></span> No. de averiguación :</label><br>
								<input type="text" id="NO_AVERIGUACION" class="form-control" placeholder="ESPECIFICA EL NO. DE AVERIGUACIÓN PREVIA*" aria-describedby="sizing-addon1" maxlength="15" oninput="validateNucs(this)" type="number" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
									echo $NO_AVERIGUACION;
								} ?>">
								</div><? if ($a == 1 && $TIPO_INVESTIGACION == 2) {
									$hide_show_nuc = '';
								} ?>
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg" id="div_nuc" <? echo $hide_show_nuc; ?>>
									<label for="nuc"><span class="glyphicon glyphicon-certificate"></span> NUC :</label><br>
									<div class="preloaderSelect_NUC" hidden>Validando NUC, espere un momento...<img width="50px" src="img/loaderData.gif"></div>
									<input type="text" id="nuc" class="form-control" placeholder="ESPECIFICA EL NUC*" aria-describedby="sizing-addon1" maxlength="15" oninput="this.value = this.value.toUpperCase(); validateNucs(this)" type="number" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
										echo $CARPETA_INV;
									} ?>">
								</div>
							<? } ?>
						</div><br>
						<div class="row" hidden>
							<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
								<div class="checkbox" id="acumulacion" onchange="exist_acum(<? echo $a; ?>)">
									<h3><label data-toggle="collapse" data-target="#collapseExample"><input type="checkbox" <? if ($a == 1 && ($ACUMULADO_PROCESO != '' ||
									$ACUMULADO_AVERIGUACION != '')) { ?> checked <? } ?>><a>Hay acumulación</a></label></h3>
								</div>
							</div>
						</div><br>
						<div <? if ($a == 1 && ($ACUMULADO_PROCESO != '' || $ACUMULADO_AVERIGUACION != '')) { ?> class="collapse in show" <? } else { ?> class="collapse" <? } ?> id="collapseExample">
							<div class="well">
								<div class="row">
									<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
										<label for="ACUMULADO_PROCESO"># No. de acumulación (proceso) :</label><br>
										<input type="text" class="form-control" id="ACUMULADO_PROCESO" placeholder="ESPECIFICA EL NO. DE ACUMULACIÓN (PROCESO)" aria-describedby="sizing-addon1" maxlength="30" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " onkeypress="return validaInput(event, 'acumulados')" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
											echo $ACUMULADO_PROCESO;
										} ?>">
									</div>
									<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
										<label for="ACUMULADO_AVERIGUACION"># No. de acumulación (averiguación) :</label><br>
										<input type="text" class="form-control" id="ACUMULADO_AVERIGUACION" placeholder="ESPECIFICA EL NO. DE ACUMULACIÓN (AVERIGUACION)" aria-describedby="sizing-addon1" maxlength="30" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " onkeypress="return validaInput(event, 'acumulados')" onchange="validateCampo_OK(this.id)" value="<? if ($a == 1) {
											echo $ACUMULADO_AVERIGUACION;
										} ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12  col-md-12 ">
								<label for="OBSERVACIONES">Observaciones Plataforma:</label>
								<textarea class="form-control" id="OBSERVACIONES" rows="3" aria-describedby="sizing-addon1" placeholder="ESPECIFICA LA OBSERVACION PLATAFORMA" maxlength="100" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "> <? if ($a == 1) {
									echo $OBSERVACIONES;
								} ?> </textarea>
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-12 col-sm-12  col-md-12 ">
								<label for="OBSERVACIONES_INT">Observaciones Mandamientos:</label>
								<textarea class="form-control" id="OBSERVACIONES_INT" rows="3" aria-describedby="sizing-addon1" placeholder="ESPECIFICA LA OBSERVACION MANDAMIENTOS" maxlength="4000" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "> <? if ($a == 1) {
									echo $OBSERVACIONES_INT;
								} ?> </textarea>
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-12 col-sm-12  col-md-12 ">
								<label for="OBSERVACIONES">Archivo Mandamiento:</label>
								<input type="file" class="form-group form-control" id="customFile"  value = "documentos/26374_mandamiento_0_347_1000.pdf" />
								<? if($a == 1){
									?>
									<input type="text" id="type_update" value="1" hidden>
									<input type="text" id="idFileTexMandamiento" value="<?php echo $dataFileMandamiento[0][1]; ?>" readonly>
									<a href="format/mandamientosJudiciales/<?php echo $dataFileMandamiento[0][1]; ?>" download>Descargar Archivo</a>
									<?
								}else{ ?>
									<input type="text" id="type_update" value="0" hidden>
								<? } ?>
							</div>
						</div><br>
						<hr>
						<div class="row">
							<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
								<? $existe_inculpado = get_data_inculpado($conn, $ID_MANDAMIENTO_INTERNO); ?>
								<div class="checkbox">
									<h4><label data-toggle="collapse" data-target="#collapseDataInculpados"><input type="checkbox" <? if ($a == 1 && sizeof($existe_inculpado) > 0) { ?> checked <? } ?>><a>Existen datos del inculpado</a></label></h4>
								</div>
							</div>
						</div><br>
						<div <? if ($a == 1 && sizeof($existe_inculpado) > 0) { ?>class="collapse in show" <? } else { ?> class="collapse" <? } ?> id="collapseDataInculpados">
							<div class="well">
								<div class="row">
									<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">DATOS GENERALES DEL INCULPADO (S)</h3>
											</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-xs-12 col-sm-12  col-md-4">
														<? if (sizeof($existe_inculpado) == 0) {
															?>
															<div id="div_button_averiguacion_imputado" hidden>
																<button type="button" class="btn btn-primary btn-lg" href="#inculpados" onclick="showModal_inculpados_av(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $ID_MANDAMIENTO_INTERNO; ?>, 1)"><span class="glyphicon glyphicon-plus"></span> Agregar inculpado </button>
															</div>
															<div id="div_button_nuc_imputado">
																<button type="button" class="btn btn-primary btn-lg" href="#inculpados" onclick="showModal_inculpados(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $ID_MANDAMIENTO_INTERNO; ?>, 2)"><span class="glyphicon glyphicon-plus"></span> Agregar inculpado</button>
															</div>
														<? } ?>
													</div>
												</div><br>
												<div class="row">
													<div class="col-xs-12 col-sm-12  col-md-12">
														<table class="table table-bordered">
															<thead>
																<tr class="cabeceraTablaVictimas">
																	<th>#</th>
																	<th>Nombre</th>
																	<th>Apellido Paterno</th>
																	<th>Apellido Materno</th>
																	<th>Edad</th>
																	<th>Estatura</th>
																	<th>Peso</th>
																	<th>Tatuajes</th>
																	<th>Sexo</th>
																	<th>Usa anteojos</th>
																	<th>Nacionalidad</th>
																	<th>CURP</th>
																	<th>Observaciones</th>
																	<th>Fecha Observación</th>
																	<th>Acciones</th>
																</tr>
															</thead>
															<? $getData_inculpado = get_data_inculpado($conn, $ID_MANDAMIENTO_INTERNO);
															if (sizeof($getData_inculpado) > 0) { ?>
																<tbody>
																	<? for ($h = 0; $h < sizeof($getData_inculpado); $h++) { ?>
																		<tr>
																			<th>
																				<center>1</center>
																			</th>
																			<th>
																				<center><? echo $getData_inculpado[$h][5]; ?></center>
																			</th>
																			<th>
																				<center><? echo $getData_inculpado[$h][6]; ?></center>
																			</th>
																			<th>
																				<center><? echo $getData_inculpado[$h][7]; ?></center>
																			</th>
																			<th>
																				<center><? echo $getData_inculpado[$h][8]; ?></center>
																			</th>
																			<th>
																				<center><? echo $getData_inculpado[$h][9]; ?></center>
																			</th>
																			<th>
																				<center><? echo $getData_inculpado[$h][10]; ?></center>
																			</th>
																			<th>
																				<center><? if ($getData_inculpado[$h][11] == 'Si') {
																					echo 'SI';
																				} else {
																					echo 'NO';
																				}  ?></center>
																			</th>
																			<th>
																				<center><? if ($getData_inculpado[$h][12] == 'M') {
																					echo 'MASCULINO';
																				} else {
																					echo 'FEMENINO';
																				}  ?></center>
																			</th>
																			<th>
																				<center><? if ($getData_inculpado[$h][13] == 'N') {
																					echo 'NO';
																				} else {
																					echo 'SI';
																				}  ?></center>
																			</th>
																			<th>
																				<center><? echo $getData_inculpado[$h][15]; ?></center>
																			</th>
																			<th>
																				<center><? echo $getData_inculpado[$h][16]; ?></center>
																			</th>
																			<th>
																				<center><? echo $getData_inculpado[$h][17]; ?></center>
																			</th>
																			<th>
																				<center><? echo $getData_inculpado[$h][18]->format('Y-m-d'); ?></center>
																			</th>
																			<td> <? if ($get_tipo_user != 1) { ?> <center>
																				<center><img src="img/editarMandamiento2.png" data-toggle="modal" href="#mandamientos" onclick="showEditar_mandamiento_inculpado(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $ID_MANDAMIENTO_INTERNO; ?>);"></center><? } ?></td>
																			</tr>
																		<? } ?>
																	</tbody>
																<? } ?>
															</table>
														</div>
													</div></br>
									<!--
							 <div class="row">
										<div class="col-xs-12 col-sm-12  col-md-3">
											<label for="heard"><span class="glyphicon glyphicon-user"></span> ALIAS DEL INCULPADO (S)</label>
											<table class="table table-bordered">
												<thead>
													<tr class="cabeceraTablaVictimas">
														<th>#</th>
														<th>Alias</th>
														<th>Es principal</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th>1</th>
														<th>Sin Alias</th>
														<th>N/E</th>
													</tr>
												</tbody>
										 </table>
										</div>
										<div class="col-xs-12 col-sm-12  col-md-9">
											<label for="heard"><span class="glyphicon glyphicon-home"></span> DOMICILIO DEL INCULPADO (S)</label>
											<table class="table table-bordered">
												<thead>
													<tr class="cabeceraTablaVictimas">
														<th>#</th>
														<th>Pais</th>
														<th>Estado</th>
														<th>Municipio</th>
														<th>Calle</th>
														<th>Num ext</th>
														<th>Num int</th>
														<th>Colonia</th>
														<th>Codigo postal</th>
														<th>Teléfono</th>
														<th>Observaciones</th>
														<th>Es principal</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th>1</th>
														<th>MEXICO</th>
														<th>MICHOACAN</th>
														<th>MORELIA</th>
														<th>CADIZ</th>
														<th>22</th>
														<th>N/E</th>
														<th>PASEO DE LA CASTAÑEDA</th>
														<th>58106</th>
														<th>000000000</th>
														<th>NINGUNA</th>
														<th>SI</th>
													</tr>
												</tbody>
										 </table>
										</div>
									</div></br>-->
								</div>
								<div class="panel-footer">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
					<? $existen_delitos = get_data_delitos($conn, $ID_MANDAMIENTO_INTERNO); ?>
					<div class="checkbox">
						<h4><label data-toggle="collapse" data-target="#collapseDataDelitos"><input type="checkbox" <? if ($a == 1 && sizeof($existen_delitos) > 0) { ?> checked <? } ?>><a>Existen delitos</a></label></h4>
					</div>
				</div>
			</div><br>
			<div <? if ($a == 1 && sizeof($existen_delitos) > 0) { ?>class="collapse in show" <? } else { ?> class="collapse" <? } ?> id="collapseDataDelitos">
				<div class="well">
					<div class="row">
						<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
							<div class="panel panel-success">
								<div class="panel-heading">
									<h3 class="panel-title">DELITOS</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
											<label for="ID_DELITO"><span class="glyphicon glyphicon-list-alt"></span> Delito</label><br>
											<select class="form-control" id="ID_DELITO" onchange="reload_modalidad(),validateCampo_OK(this.id)">
												<option class="fontBold" value="">Seleccione un delito</option>
												<? $delitos = getCatDelitos($connSIMAJ);
												for ($i = 0; $i < sizeof($delitos); $i++) {
													$cv_delito = $delitos[$i][0];
													$descrip_delito = $delitos[$i][2]; ?>
													<option class="fontBold" value="<? echo $cv_delito; ?>"><? echo $descrip_delito; ?></option>
												<? } ?>
											</select>
										</div>
									</div><br>
									<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
											<label for="ID_DATOS_INCULPADO"><span class="glyphicon glyphicon-user"></span> Inculpados</label><br>
											<select class="form-control" id="ID_DATOS_INCULPADO" onchange="validateCampo_OK(this.id)">
												<option value="">Seleccione un inculpado</option>
												<? $getData_inculpado_delito = get_data_inculpado($conn, $ID_MANDAMIENTO_INTERNO);
												if (sizeof($getData_inculpado_delito) > 0) { ?>
													<option value="<? echo $getData_inculpado_delito[0][1]; ?>" <? if ($a == 1) { ?> selected <? } ?>><? echo $getData_inculpado_delito[0][5] . ' ' . $getData_inculpado_delito[0][6] . ' ' . $getData_inculpado_delito[0][7] ?></option>
												<? } ?>
											</select>
										</div>
									</div><br>
									<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-6 input-group-lg">
											<label for="ID_MODALIDAD">Modalidad</label><br>
											<select class="form-control" id="ID_MODALIDAD" onchange="validateCampo_OK(this.id)">
												<option value="">Seleccione primero un delito</option>
											</select>
										</div>
										<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
											<label for="ES_PRINCIPAL">Es principal</label><br>
											<input type="radio" id="ES_PRINCIPAL" name="ES_PRINCIPAL" value="1" style="height:25px; width:25px;">
											<label for="ES_PRINCIPAL" style="font-size: 20px;">Si</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<input type="radio" id="ES_PRINCIPAL" name="ES_PRINCIPAL" value="0" checked style="height:25px; width:25px;">
											<label for="ES_PRINCIPAL" style="font-size: 20px;">No</label>
										</div>
										<? if ($get_tipo_user != 1) { ?>
											<div class="col-xs-12 col-sm-12  col-md-3">
												<button type="button" id="btn_Agregar_Delito" class="btn btn-primary btn-lg" style="width: 100%;" onclick="agregar_delito(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $ID_MANDAMIENTO_INTERNO; ?> , <? echo $GET_ID_MANDAMIENTO_INTERNO; ?>, <? echo $GET_ID_DATOS_INCULPADO; ?>)"><span class="glyphicon glyphicon-plus"></span> Agregar delito</button>
											</div>
										<? } ?>
									</div><br>
									<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-12">
											<table class="table table-bordered">
												<thead>
													<tr class="cabeceraTablaVictimas">
														<th>#</th>
														<th>Inculpado</th>
														<th>Delito</th>
														<th>Modalidad</th>
														<th>Es principal</th>
														<th>Acciones</th>
													</tr>
												</thead>
												<? $getData_Delitos = get_data_delitos($conn, $ID_MANDAMIENTO_INTERNO);
												if (sizeof($getData_Delitos) > 0) { ?>
													<tbody>
														<? for ($h = 0; $h < sizeof($getData_Delitos); $h++) { ?>
															<tr>
																<th>
																	<center><? echo $h + 1 ?></center>
																</th>
																<th>
																	<center><? echo $getData_Delitos[$h][4]; ?></center>
																</th>
																<th>
																	<center><? echo $getData_Delitos[$h][9]; ?></center>
																</th>
																<th>
																	<center><? echo $getData_Delitos[$h][11]; ?></center>
																</th>
																<th>
																	<center><? echo $getData_Delitos[$h][13]; ?></center>
																</th>
																<th><? if ($get_tipo_user != 1) { ?><center>
																	<center><img src="img/editarMandamiento2.png" data-toggle="modal" href="#mandamientos" onclick="editar_delito(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $getData_Delitos[$h][1]; ?> , <? echo $getData_Delitos[$h][2]; ?>);"><img src="img/eliminar.png" onclick="elimiar_delito(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $getData_Delitos[$h][1]; ?> , <? echo $getData_Delitos[$h][2]; ?> , <? echo sizeof($existen_delitos); ?>);"></center><? } ?></th>
																</tr>
															<? } ?>
														</tbody>
													<? } ?>
												</table>
											</div>
										</div></br>
									</div>
									<div class="panel-footer">

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
						<? $existen_agraviados = get_data_agraviados($conn, $ID_MANDAMIENTO_INTERNO, 0); ?>
						<div class="checkbox">
							<h4><label data-toggle="collapse" data-target="#collapseDataAgraviados"><input type="checkbox" <? if ($a == 1 && sizeof($existen_agraviados) > 0) { ?> checked <? } ?>><a>Existen los datos del agraviado (s)</a></label></h4>
						</div>
					</div>
				</div><br>
				<div <? if ($a == 1 && sizeof($existen_agraviados) > 0) { ?>class="collapse in show" <? } else { ?> class="collapse" <? } ?> id="collapseDataAgraviados">
					<div class="well">
						<div class="row">
							<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
								<div class="panel panel-warning">
									<div class="panel-heading">
										<h3 class="panel-title">DATOS DEL AGRAVIADO (S) </h3>
									</div>
									<div class="panel-body">
										<? if ($get_tipo_user != 1) { ?>
											<div class="row">
												<div class="col-xs-12 col-sm-12  col-md-3">
													<div id="div_button_averiguacion_agraviados" <? echo $hide_show_av; ?>>
														<button type="button" href="#agraviados" class="btn btn-primary btn-lg" style="width: 100%;" onclick="showModal_agraviados_av(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $ID_MANDAMIENTO_INTERNO; ?> , 0 , 0)"><span class="glyphicon glyphicon-plus"></span> Agregar agraviado</button>
													</div>
													<div id="div_button_nuc_agraviados" <? echo $hide_show_nuc; ?>>
														<button type="button" href="#agraviados" class="btn btn-primary btn-lg" style="width: 100%;" onclick="showModal_agraviados(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $ID_MANDAMIENTO_INTERNO; ?> , 0 , 0)"><span class="glyphicon glyphicon-plus"></span> Agregar agraviado</button>
													</div>
												</div>
											</div>
										<? } ?>
										<br>
										<div class="row">
											<div class="col-xs-12 col-sm-12  col-md-12">
												<label for="heard"><span class="glyphicon glyphicon-user"></span> DATOS GENERALES DEL AGRAVIADO (S)</label>
												<table class="table table-bordered">
													<thead>
														<tr class="cabeceraTablaVictimas">
															<th>#</th>
															<th>Nombre</th>
															<th>Apellido Paterno</th>
															<th>Apellido Materno</th>
															<th>Es principal</th>
															<th>Acciones</th>
														</tr>
													</thead>
													<? $getData_Agraviados = get_data_agraviados($conn, $ID_MANDAMIENTO_INTERNO, 0);
													if (sizeof($getData_Agraviados) > 0) { ?>
														<tbody>
															<? for ($h = 0; $h < sizeof($getData_Agraviados); $h++) { ?>
																<tr>
																	<th>
																		<center><? echo $h + 1; ?></center>
																	</th>
																	<th>
																		<center><? echo $getData_Agraviados[$h][5]; ?></center>
																	</th>
																	<th>
																		<center><? echo $getData_Agraviados[$h][6]; ?></center>
																	</th>
																	<th>
																		<center><? echo $getData_Agraviados[$h][7]; ?></center>
																	</th>
																	<th>
																		<center><? echo $getData_Agraviados[$h][9]; ?></center>
																	</th>
																	<td><? if ($get_tipo_user != 1) { ?><center><img src="img/editarMandamiento2.png" data-toggle="modal" href="#mandamientos" onclick="showEditar_mandamiento_agraviado(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $getData_Agraviados[$h][1]; ?> , <? echo $ID_MANDAMIENTO_INTERNO; ?> , 1);"><img src="img/eliminar.png" onclick="elimiar_agraviado(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $getData_Agraviados[$h][1]; ?> , <? echo $getData_Agraviados[$h][2]; ?>);"></center><? } ?></td>
																</tr>
															<? } ?>
														</tbody>
													<? } ?>
												</table>
											</div>
										</div></br>
									<!--
							  <div class="row">
										<div class="col-xs-12 col-sm-12  col-md-12">
											<label for="heard"><span class="glyphicon glyphicon-home"></span> DOMICILIO DEL AGRAVIADO (S)</label>
											<table class="table table-bordered">
												<thead>
													<tr class="cabeceraTablaVictimas">
														<th>#</th>
														<th>Pais</th>
														<th>Estado</th>
														<th>Municipio</th>
														<th>Calle</th>
														<th>Num ext</th>
														<th>Num int</th>
														<th>Colonia</th>
														<th>Codigo postal</th>
														<th>Teléfono</th>
														<th>Observaciones</th>
														<th>Es principal</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th>1</th>
														<th>MEXICO</th>
														<th>MICHOACAN</th>
														<th>MORELIA</th>
														<th>CADIZ</th>
														<th>20</th>
														<th>N/E</th>
														<th>MARTIN CASTREJON</th>
														<th>58146</th>
														<th>000000000</th>
														<th>NINGUNA</th>
														<th>SI</th>
													</tr>
												</tbody>
										 </table>
										</div>
									</div>-->
								</div>
								<div class="panel-footer">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--DATOS GENERALES-->

	<? if ($get_tipo_user != 1) { ?>
		<div class="modal-footer">
			<div class="row">

				<div class="col-xs-12 col-sm-12  col-md-6 col-md-offset-3" id="div_button_averiguacion" <? echo $hide_show_av; ?>>
					<div class="col-xs-12 col-sm-12  col-md-6 col-md-offset-3">
						<button type="button" class="btn btn-primary btn-lg" style="width: 100%;" onclick="guardar_mandamiento_av(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $ID_MANDAMIENTO_INTERNO; ?> , <? echo sizeof($existe_inculpado);  ?>)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar información </button>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12  col-md-6 col-md-offset-3" id="div_button_nuc" <? echo $hide_show_nuc; ?>>
					<div class="col-xs-12 col-sm-12  col-md-6 col-md-offset-3">
						<button type="button" class="btn btn-primary btn-lg" style="width: 100%;" onclick="guardar_mandamiento(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?> , <? echo $idfisca; ?> , <? echo $ID_MANDAMIENTO_INTERNO; ?> , <? echo sizeof($existe_inculpado);  ?>, <? echo 	$GET_ID_MANDAMIENTO_INTERNO; ?>)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar información</button>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12  col-md-3">
					<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="closeModal_mandamientos(<? echo $idEnlace; ?>,<? echo $idfisca; ?>, <? echo $idUnidad; ?>)">Cerrar</button>
				</div>
			</div>
		</div>
	<? } else { ?>
		<div class="modal-footer">
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<button type="button" class="btn btn-default btn-lg" style="width: 100%;" data-dismiss="modal" onclick="close_modal_mandamientos_no_update(<? echo $idEnlace; ?>,<? echo $idfisca; ?>, <? echo $idUnidad; ?>)">Cerrar</button>
				</div>
			</div>
		</div>
		<? } ?>