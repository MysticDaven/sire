<?php
session_start();

include ("../../Conexiones/Conexion.php");
include ("../../Conexiones/conexionSicap.php");
include ("../../Conexiones/conexionMedidas.php");
include("../../funcionesMedidasProteccion.php");
include("../../funciones.php");		

// PRUEBA

$idUsuario = $_SESSION['useridIE'];

if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

$enlace = getInfoEnlaceUsuarioMedidas($conn, $idUsuario);
$idEnlace = $enlace[0][0];
$idfisca = $enlace[0][1];	

$tipoArchov = get_type_archiveMedidas($conn, $idEnlace);
$tiparchiv = $tipoArchov[0][0];

$getRolUser = getRolUser($connMedidas, $idEnlace);
$rolUser = $getRolUser[0][0];

//Checar carpetas faltantes de asignar al mes
$checkCarpetas = getCarpetasFaltante($connMedidas);
$totalPendientes = $checkCarpetas[0][0];

$idUsuario = $_SESSION['useridIE'];

if(date("l") === "Monday"){ $numeroDia = 1; $diaLetra = "Lunes"; }
if(date("l") === "Tuesday"){ $numeroDia = 2; 	$diaLetra = "Martes";}
if(date("l") === "Wednesday"){ $numeroDia = 3; 	$diaLetra = "Miercoles";}
if(date("l") === "Thursday"){ $numeroDia = 4; 	$diaLetra = "Jueves";}
if(date("l") === "Friday"){ $numeroDia = 5; 	$diaLetra = "Viernes";}
if(date("l") === "Saturday"){ $numeroDia = 6; 	$diaLetra = "Sabado";}
if(date("l") === "Sunday"){ $numeroDia = 7; 	$diaLetra = "Domingo";}
$diames= date("d");
$currentmonth = date("n");
$anio = date("Y");
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$mesNom = Mes_Nombre($currentmonth);

?>

<div id="contenido" style="">
	<div class="right_col" role="main" style="">
		<div style="" class="x_panel principalPanel" >
			<div class="x_panel panelCabezera">
				<table border="0" class="alwidth">
					<tr>
						<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>								
						<td width="50%">
							<div class="tituloCentralSegu">
								<div class="titulosCabe1">
									<label class="titulo1" style="color: #686D72;">Registro de Medidas de Protección</label>
									<h4><label id="titfisc" class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
							 </div>
							</div>
						</td>
						<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
					</tr>
				</table>
			</div>
			<?if($rolUser == 1 && $totalPendientes > 0){?>
			<!--ALERTA CARPETAS PENDIENTES DE ASIGNAR AL MES-->
	 <div class="alert alert-danger" id="msgAlert">
			<a href="#" class="alert-link" onclick="modalCheckPendientes(<?echo $rolUser; ?>, <?echo $idEnlace; ?>)">Carpetas pendientes por asignar a Ministerio Publico: </a><label><br><?echo $totalPendientes; ?><br></label>
		 </div>
		 <!--ALERTA CARPETAS PENDIENTES DE ASIGNAR AL MES-->
		<? } ?>
			<div class="row pad20">
				<div class="col-xs-6 col-sm-4  col-md-1">
					<label for="heard">Año:</label><br>
					<select id="anio" name="selAnio" tabindex="6" class="form-control redondear selectTranparent" onchange="reloadDaysMonth(<? echo $idEnlace; ?>)" required>
						<?php
					$dataAnio = getDataAnio();
							 for ($i = 0; $i < sizeof($dataAnio); $i++){
							 	$anioCaptura = $dataAnio[$i][0];	?>
							<option value="<? echo $anioCaptura; ?>" selected><? echo $anioCaptura; ?></option>
							<? } ?>
						</select>
				</div>
				<div class="col-xs-6 col-sm-4  col-md-1">
					<label for="heard">Mes:</label><br>
					<div id="contMonth">
						<select id="mesMedidaSelected" name="selMes" tabindex="6"class="form-control redondear selectTranparent" onchange="loadDaysMonth(<? echo $anioCaptura; ?>, <? echo $idEnlace; ?>, 0)" required>
							<?for ($g=1; $g <= 12 ; $g++) {
								if($g == intval($currentmonth)){ ?>
									<option value="<? echo $currentmonth; ?>" selected><? echo $mesNom; ?></option>
							<?}else{?>
								<option value="<? echo $g; ?>" ><? echo $meses[$g-1]; ?></option>
							<? } 
						}?>
					</select>
				</div>
			</div>
			<div class="col-xs-6 col-sm-4  col-md-1">
				<label for="heard">Día:</label><br>
				<div id="contDays">
					<select id="diaSeleted" name="selDia" tabindex="6"class="form-control redondear selectTranparent" onchange="loadDataPuestDay(<? echo $anioCaptura; ?>, <? echo $idEnlace; ?>, 0)" required>
						<option value="0">Todo</option>
						<?$diasNumero = cal_days_in_month(CAL_GREGORIAN, $currentmonth, $anioCaptura);
						for ($t=1; $t <= $diasNumero ; $t++) {
							if($t == $diames){?>
								<option value="<? echo $t; ?>" selected> <? echo "".$diaLetra."-".$diames; ?></option>
								<?}else{
									$fecha = $t."-".$currentmonth."-".$anioCaptura; 
									$nommesa =  getDiaMesnombre($fecha);
								?>
								<option value="<? echo $t; ?>"> <? echo "".$nommesa."-".$t; ?></option>
								<?}
							}?>
						</select>
					</div>
				</div>
				<div class="col-xs-6 col-sm-4  col-md-6">
					<label for="heard">Agente:</label><br>
					<select id="mesCmasc" name="agente" tabindex="6"class="form-control redondear selectTranparent" required>
						<option value="" > Todos </option>
					</select>
				</div>
				<?if($rolUser != 1 ){?>
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label class="transparente">.</label>
					<center><button type="button" data-toggle="modal" href="#medidaDeProteccion" style="white-space: normal;"  onclick="showModalMDP(0, <? echo $idEnlace; ?>,0,<? echo $tiparchiv; ?>, 1);" class="btn btn-success btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-plus-sign"></span> Registrar Nueva Medida de Protección </button></center>
				</div>
			<? } ?>
			</div><br>
			<div class="col-md-6 col-md-offset-3" id="preloaderIMG" hidden>
				<img src="images/cargando.gif"/>
			</div>
			<div style="margin-bottom: 10px" class="col-xs-12 col-sm-12 col-md-12 d-flex justify-content-end pb-5">
				<div class="button-group pb-5">
					<button 
						type="button"
						onclick="showModalReporte(<?php echo $idEnlace; ?>, <?php echo $rolUser; ?>, <?= 1; ?>)" 
						class="btn btn-elegante">
						<span class="glyphicon glyphicon-file"></span> Generar Excel
					</button>
					
					<button 
						type="button"
						onclick="generarPDF(<?php echo $idEnlace; ?>, <?php echo $rolUser; ?>)" 
						class="btn btn-elegante"
						disabled>
						<span class="glyphicon glyphicon-file"></span> Generar PDF
					</button>
				</div>
			</div>
			<table id="gridPolicia" class="display table table-striped table-hover" width="100%" >
				<thead>
					<tr class="cabeceraConsultaPolicia">
						<th class="textCent">Folio</th>
						<th class="textCent10">Agente del Ministerio Público</th>
						<th class="">Nuc</th>
						<th class=" textCent">Victima(s)</th>
						<th class=" textCent">Delito</th>
						<th class=" textCent">Medidas de Protección</th>
						<?if($rolUser != 2 ){?><th class=" textCent">Fecha del acuerdo</th><? }else{ ?> <th class=" textCent">Fecha del registro</th> <? } ?>
						<?if($rolUser == 1){?><th class=" textCent">Capturista</th><? } ?>
						<?if($rolUser != 3 && $rolUser != 4){?><th class="textCent">Carpeta asignada</th><? } ?>
						<th class=" textCent">Resolución</th>
						<?if($rolUser == 1 || $rolUser == 3 || $rolUser == 4){?><th class=" textCent">ESTADO</th><? } ?>
						<th class=" textCent">Acciones</th>
					</tr>
				</thead>
				<tbody id="contentConsulta">
					<?$dataMedidasDia = get_data_medidas_dia($connMedidas, $numeroDia, $diames, 2024, $idfisca, $idEnlace, $currentmonth, $rolUser);
					for ($h=0; $h < sizeof($dataMedidasDia) ; $h++) { 
							$getDataVictimas = getDataVictimas($connMedidas, $dataMedidasDia[$h][0]); 
							$checkEstatus = checkFechaConclusion($dataMedidasDia[$h][19]);
					 ?>
						<tr>
							<td><? echo $dataMedidasDia[$h][0]; ?></td>
							<td><?if($dataMedidasDia[$h][2] != 0){ echo $dataMedidasDia[$h][3];}else{ ?><p style="color: red;">SIN ASIGNAR <? } ?>
							<td><? echo $dataMedidasDia[$h][1]; ?></td>
							<td>
								<? 
									if(sizeof($getDataVictimas) > 0){ 
										for ($j=0; $j < sizeof($getDataVictimas) ; $j++) { ?>
											<? echo $getDataVictimas[$j][7] ?> <?
										}
									}
									else{
										echo 'SIN VICTIMA, VERIFIQUE';
									} 
								?>
							</td>							
							<td><? echo $dataMedidasDia[$h][7]; ?></td>
							<td>
								<?
									$medidasAplicadas = getMedidasAplicadas($connMedidas, $dataMedidasDia[$h][0]);
									if($medidasAplicadas > 0){
										for($i = 0; $i < sizeof($medidasAplicadas); $i++){
											$medidas = getFracciones($connMedidas, $medidasAplicadas[$i][0]);
											echo convertirARomanos($medidasAplicadas[$i][0]).'. '.strval($medidas[0][0]).'<br>';
										}
									}	
									else{
										echo 'No se han registrado Medidas de Protección';
									}
								?>
							</td>							
							<?if($rolUser != 2 ){?> <td><center><? echo $dataMedidasDia[$h][8]; ?><center></td> <? }else{ ?> <td><center><? echo $dataMedidasDia[$h][9]; ?><center></td> <? } ?>
							<?if($rolUser == 1){?><td><center><? echo $dataMedidasDia[$h][18]; ?><center></td><? } ?>
							<?if($rolUser != 3 && $rolUser != 4){?><td><?if($dataMedidasDia[$h][2] != 0){ ?><div class="verdCol" id="circulo"><? }else{ ?> <div class="redCol" id="circulo"> <? } ?></div></td><? } ?>
							<td> 
								<?php
									$idResolucion = getIdResoluciones($connMedidas, $dataMedidasDia[$h][0]);					
									$getDataResolucion = getDataResolucion($connMedidas, $idResolucion[0]);

									$resoluciones = ['ratificada', 'ampliada', 'modificada', 'revocada'];
									$resultado = 'No establecido';
									if($getDataResolucion != null){
										foreach($resoluciones as $resolucion){
											if($getDataResolucion[0][$resolucion] == 1){
												$resultado = ucfirst($resolucion);
												break;
											}						
										}
									}
									echo $resultado;
								?>
							</td>

						 	<?if($rolUser == 1 || $rolUser == 3 || $rolUser == 4){ ?>
							<td>
							<?if($checkEstatus == 'CONCLUIDA'){?>
								<div class="verdCol" id="circulo"></div><center>Concluida</center>
								<? }elseif($checkEstatus == 'ACTIVA'){ ?> 
									<div class="yelloCol" id="circulo"></div><center>Vigente</center>
									<? }elseif($checkEstatus == 'NOTRABAJADA'){ ?>
										<div class="redCol" id="circulo"></div><center>Sin medida aplicada</center>
								<? } ?>
							</td>
						 <? } ?>
							<td><center><label <?if($rolUser == 1){?>class="glyphicon glyphicon-user"<? }else{ ?>class="glyphicon glyphicon-edit" <? } ?> data-toggle="modal" href="#puestdispos" onclick="reloadModalMDP(1, <?echo $idEnlace; ?>, <?echo $dataMedidasDia[$h][0]; ?>, 0, 0, null, null)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;"><?if($rolUser == 1){?> Asignar MP <? }else{ ?> Editar <? } ?> </label></center>
							</td>
						</tr>
						<? } ?>
					</tbody>
				</table><br>
				<div class="x_panel piepanel">
					<div class="piepanel2">
						<div class="piepanel3">
							<div class="piepanel4">
								<label style="color: #686D72;">SISTEMA INTEGRAL DE REGISTRO ESTADISTICO Copyright © Todos los Derechos Reservados</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</body>


<!-- MODAL REGISTRO DE MEDIDA DE PROTECCION  -->
	<div class="modal fade bs-example-modal-sm" id="medidaDeProteccion" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 85%; margin-top: 0.5%;">
			<div class="modal-content" style="">
				<div id="contModalMedidasDeProteccion">

				</div>
			</div>
		</div>
	</div>
<!-- MODAL REGISTRO DE MEDIDA DE PROTECCION  -->

<!-- MODAL INFORMACIÓN DE USUARIO  -->
<div class="modal fade bs-example-modal-sm" id="medidaDeProteccion" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 85%; margin-top: 0.5%;">
			<div class="modal-content" style="">
				<div id="contModalInfo">

				</div>
			</div>
		</div>
	</div>
<!-- MODAL INFORMACIÓN DE USUARIO  -->

<!-- MODAL GENERAR REPORTE DE MEDIDA DE PROTECCION  -->
<div class="modal fade bs-example-modal-sm" id="generarReporte" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 45%; margin-top: 15%;">
			<div class="modal-content" style="">
				<div id="contGenerarReporte">
					
				</div>
			</div>
		</div>
	</div>
<!-- MODAL GENERAR REPORTE DE MEDIDA DE PROTECCION  -->

<!-- MODAL REGISTRO DE INFORMACION GENERAL DE MEDIDA DE PROTECCION  -->
 <div class="modal fade bs-example-modal-sm" id="infoGeneralMedida" role="dialog" data-backdrop="static" data-keyboard="false">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 85%; margin-top: 3.4%;">
			<div class="modal-content" style="">
				<div id="contModalInfoGeneralMedida">

				</div>
			</div>
		</div>
	</div>
	<!-- MODAL REGISTRO DE INFORMACION GENERAL DE MEDIDA DE PROTECCION  -->

		<!-- MODAL CARGANDO INFORMACION SIGI -->
 <div class="modal fade bs-example-modal-sm" id="cargandoInfo" role="dialog" data-backdrop="static" data-keyboard="false">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 20%; margin-top: 10%;">
			<div class="modal-content" style="">
				<div id="contModalCargandoInfo">
					<div class="modal-header">
				<h4 class="modal-title">Validando NUC...</h4>
			</div>
			<div class="modal-body">
				<div class="row">
									<div class="col-md-12 col-sm-12 col-md-offset-4">
										<img src="img/cargandoInfoMedidas.gif"  class="cursorp" >
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-md-offset-3">
										<label>Cargando información de SIGI</label>
									</div>
								</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL CARGANDO INFORMACION SIGI -->

	<!-- MODAL CARGANDO INFORMACION SIGI -->
 <div class="modal fade bs-example-modal-sm" id="cargandoInfoModal" role="dialog" data-backdrop="static" data-keyboard="false">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 20%; margin-top: 10%;">
			<div class="modal-content" style="">
				<div id="contModalCargandoInfoModal">
					<div class="modal-header">
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="row">
									<div class="col-md-12 col-sm-12 col-md-offset-4">
										<img src="img/cargandoInfoMedidas.gif"  class="cursorp" >
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-md-offset-3">
										<label>Cargando información...</label>
									</div>
								</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL CARGANDO INFORMACION SIGI -->

	<!-- MODAL REGISTRO DE INFORMACION GENERAL DE MEDIDA DE PROTECCION  -->
 <div class="modal fade bs-example-modal-sm" id="aplicarMedida" role="dialog" data-backdrop="static" data-keyboard="false">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 50%; margin-top: 3.4%;">
			<div class="modal-content" style="">
				<div id="contModalAplicarMedida">

				</div>
			</div>
		</div>
	</div>
	<div class="modal fade bs-example-modal-sm" id="aplicarMedidaTestigo" role="dialog" data-backdrop="static" data-keyboard="false">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 50%; margin-top: 3.4%;">
			<div class="modal-content" style="">
				<div id="contModalAplicarMedidaTestigo">

				</div>
			</div>
		</div>
	</div>
	<!-- MODAL REGISTRO DE INFORMACION GENERAL DE MEDIDA DE PROTECCION  -->

	<!-- MODAL CARPETAS PENDIENTES DE ASIGNAR A MP  -->
 <div class="modal fade bs-example-modal-sm" id="carpetasPendientes" role="dialog" data-backdrop="static" data-keyboard="false">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 45%; margin-top: 3.4%;">
			<div class="modal-content" style="">
				<div id="contModalCarpetasPendientes">

				</div>
			</div>
		</div>
	</div>
	<!-- MODAL CARPETAS PENDIENTES DE ASIGNAR A MP  -->

</html>