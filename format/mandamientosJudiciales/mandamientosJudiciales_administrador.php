<?php
session_start();

include ("../../Conexiones/Conexion.php");
include ("../../Conexiones/conexionMedidas.php");
include("../../funcionesMedidasProteccion.php");
include("../../funcionesMandamientos.php");
include("../../funciones.php");		

$idUsuario = $_SESSION['useridIE'];

$enlace = getInfoEnlaceUsuarioMandamientos($conn, $idUsuario);
$idEnlace = $enlace[0][0];
$idfisca = $enlace[0][1];	
$idUnidad = $enlace[0][2];	

$tipoArchov = get_type_archiveMandamientos($conn, $idEnlace);
$tiparchiv = $tipoArchov[0][0];

if(date("l") === "Monday"){ $numeroDia = 1; $diaLetra = "Lunes"; }
if(date("l") === "Tuesday"){ $numeroDia = 2; 	$diaLetra = "Martes";}
if(date("l") === "Wednesday"){ $numeroDia = 3; 	$diaLetra = "Miercoles";}
if(date("l") === "Thursday"){ $numeroDia = 4; 	$diaLetra = "Jueves";}
if(date("l") === "Friday"){ $numeroDia = 5; 	$diaLetra = "Viernes";}
if(date("l") === "Saturday"){ $numeroDia = 6; 	$diaLetra = "Sabado";}
if(date("l") === "Sunday"){ $numeroDia = 7; 	$diaLetra = "Domingo";}
$diames= date("d");
$currentmonth = date("n");
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$mesNom = Mes_Nombre($currentmonth);
$getAnios = getDataAnio_Mandamientos();
$anio_actual = date("Y");
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
									<label class="titulo1" style="color: #686D72;">Administrador de Mandamientos Judiciales</label>
									<h4><label id="titfisc" class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
							 </div>
							</div>
						</td>
							<td id="nomostrar" class="imgdgtipeCabezeraPolicia" width="13%" height="125"></td>
					</tr>
				</table>
			</div>
	
			<div class="row pad20">
				<div class="col-xs-6 col-sm-4  col-md-1">
					<label for="heard">Año:</label><br>
					<select id="anio_mandamiento" name="anio_mandamiento" tabindex="6" class="form-control redondear selectTranparent" onchange="reload_table_mandamientos_mes(<? echo $idEnlace; ?>)" required>
      <?for($i=0; $i < sizeof($getAnios); $i++){ ?>
							<option value="<? echo $getAnios[$i]; ?>" <?if($anio_actual == $getAnios[$i]){ ?> selected <? } ?>><? echo $getAnios[$i]; ?></option>
      <? } ?>
						</select>
				</div>
				<div class="col-xs-6 col-sm-4  col-md-1">
					<label for="heard">Mes:</label><br>
					<div id="contMonth">
						<select id="mes_mandamiento" name="mes_mandamiento" tabindex="6"class="form-control redondear selectTranparent" onchange="reload_table_mandamientos_mes(<? echo $idEnlace; ?>)" >
							<?for($i=0; $i < sizeof($meses) ; $i++){ ?>
									<option value="<?echo $i+1; ?>" <?if($mesNom == $meses[$i]){ ?> selected <? } ?> > <?echo $meses[$i];  ?> </option>
							<? } ?>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12  col-md-7">
					<label for="heard">Fiscalia:</label><br>
						<div id="contFiscalia">
							<select id="fiscalia_selecciconada" name="fiscalia_selecciconada" tabindex="6"class="form-control redondear selectTranparent" onchange="reload_table_mandamientos_mes(<? echo $idEnlace; ?>)"  >
								<option value="0" > GENERAL </option>
								<?$data = get_data_enlaceFiscalia($conn);
								  for($i=0; $i < sizeof($data) ; $i++){ ?>
										<option value="<?echo $data[$i][3]; ?>" > <?echo $data[$i][2];  ?> </option>
								<? } ?>
						</select>
					</div>
			</div>
			</div><br>
		<div class="col-md-6 col-md-offset-3" id="preloaderIMG" hidden>
				<img src="images/cargando.gif"/>
			</div>
			<table id="gridPolicia" class="display table table-striped  table-hover" width="100%" >
				<thead>
					<tr class="cabeceraConsultaPolicia">
						<th class="textCent">#</th>
						<th class="textCent10">NUC / AVERIGUACIÓN</th>
						<th class="textCent10">Estado</th>
						<th class="">Tipo Mandamiento</th>
						<th class="">Fecha de captura</th>
						<th class="">Proceso</th>
						<th class="">Nombre del inputado</th>
						<th class="">Fiscalía</th>
						<th class="">Municipio</th>
						<th class="">Acciones</th>
					</tr>
				</thead>
				<tbody id="contentConsulta">
					<?$data = get_data_mandamientos_dia_administrador($conn, $idEnlace, 0, $currentmonth , $anio_actual);
					for ($h=0; $h < sizeof($data) ; $h++) { 
							$inculpado = get_data_inculpado($conn, $data[$h][1]);
					 ?>
						<tr>
							<td><? echo $h+1; ?></td>
							<td><? if($data[$h][11] == 2 ){ echo $data[$h][9]; }else{ echo $data[$h][10]; } ?></td>
							<td><? echo $data[$h][3]; ?></td>
							<td><? echo $data[$h][4]; ?></td>
							<td><? echo $data[$h][8]->format('Y-m-d'); ?></td>
							<td><? echo $data[$h][5]; ?></td>
						 <td><? echo $inculpado[0][5].' '.$inculpado[0][6].' '.$inculpado[0][7]; ?></td>
							<td><? echo $data[$h][6]; ?></td>
							<td><? echo $data[$h][7]; ?></td>
							<td><center><img src="img/editarMandamiento2.png" data-toggle="modal" href="#mandamientos"  onclick="modalMandamientos_registro(0, <? echo $idEnlace; ?>,<? echo $data[$h][1]; ?>,<? echo $tiparchiv; ?>, 1, <?echo $idfisca; ?>, <?echo $idUnidad; ?>);"><!--<img src="img/resumenMandamiento.png"></center>-->
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
		</div>
	</div>


<!-- MODAL REGISTRO DE MANDAMIENTOS JUDICIALES  -->
	<div class="modal fade bs-example-modal-sm" id="mandamientos" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 85%; margin-top: 0.5%;">
			<div class="modal-content" style="">
				<div id="contModalMandamientos_registro">

				</div>
			</div>
		</div>
	</div>
	<!-- MODAL REGISTRO DE MANDAMIENTOS JUDICIALES  -->

	<!-- MODAL REGISTRO DE INCULPADOS  -->
	<div class="modal fade bs-example-modal-sm" id="inculpados" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 65%; margin-top: 0.5%;">
			<div class="modal-content" style="">
				<div id="contModalInculpados_registro">

				</div>
			</div>
		</div>
	</div>
	<!-- MODAL REGISTRO DE INCULPADOS  -->

	<!-- MODAL REGISTRO DE AGRAVIADOS  -->
	<div class="modal fade bs-example-modal-sm" id="agraviados" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 65%; margin-top: 0.5%;">
			<div class="modal-content" style="">
				<div id="contModalAgraviados_registro">

				</div>
			</div>
		</div>
	</div>
	<!--  MODAL REGISTRO DE AGRAVIADOS   -->

		<!-- MODAL CARGANDO INFORMACION  -->
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
										<label>Cargando información</label>
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
	<!-- MODAL CARGANDO INFORMACION -->

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

	<!-- MODAL EDITAR DELITOS  -->
	<div class="modal fade bs-example-modal-sm" id="delitos" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 50%; margin-top: 0.5%;">
			<div class="modal-content" style="">
				<div id="contModalMandamientos_delitos">

				</div>
			</div>
		</div>
	</div>
	<!-- MODAL EDITAR DELITOS  -->

	

</html>