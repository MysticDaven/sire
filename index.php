<?php
session_start();
include("validar_sesion.php");
include("funciones.php");
include("Conexiones/Conexion.php");
include("sqlPersonas.php");
?>
<?php
$mesactualnumero = date("m");
$idUsuario = $_SESSION['useridIE'];
$tipoUser  = $_SESSION['permisosIE'];
//$idTipArch = $_SESSION['idArchivo'];
if (isset($_GET["format"])) {
	$format = $_GET["format"];
}
if (isset($_GET["idUnidadSelect"])) {
	$idUnidadSelect = $_GET["idUnidadSelect"];
} else {
	$idUnidadSelect = 0;
}



if ($format == "ControlProcesos") {
	$format = 17;
}

if ($format == "PoliciaConsulta") {
	$format = 12;
}
if ($format == "PoliciaAdmin") {
	$format = 10;
}
if ($format == "Policia") {
	$format = 9;
}
if ($format == "CarpetasInvestigacion") {
	$format = 1;
}
if ($format == "Litigacion") {
	$format = 4;
}
if ($format == "Trimestral") {
	$format = 11;
}
if ($format == "Administrador") {
	$format = 0;
}
if ($format == "estadoDeFuerza") {
	$format = 13;
}
if ($format == "Forestales") {
	$format = 14;
}
if ($format == "carpetasJudicializadas") {
	$format = 15;
}
if ($format == "medidasDeProteccion") {
	$format = 16;
}

if ($format == "mandamientosJudiciales") {
	$format = 18;
}
if ($format == "mandamientosJudicialesAdministrador") {
	$format = 19;
}
if ($format == "procesosPenales") {
	$format = 21;
}
if ($format == "Busquedas") {
		$format = 23;
	}

$_SESSION['formatis'] = $format;

$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
$idEnlace = $enlace[0][0];
$idfisca = $enlace[0][1];

////// SI HAY UN ENLACE QUE LLEVE MAS DE UN MODULO DE CAPTURA SE AGREGA AQUI Y SE MODIFICA LA TABLA EN SQL ENLACEFORMATO
////// EN LA TABLA ENLACE FORMATO SE PONEN LOS FORMATOS Y EL idEnlaceLiti DEL ENLACE DE LITIGACION EN SU CASO

if ($idEnlace == 14 || $idEnlace == 15 || $idEnlace == 23 || $idEnlace == 22 || $idEnlace == 17 || $idEnlace == 18 || $idEnlace == 16 || $idEnlace == 19 || $idEnlace == 58 || $idEnlace == 337 || $idEnlace == 26 || $idEnlace == 532) {

	$unienlaenla = getIdUnidEnlaceFormat($conn, $idEnlace, $format);
	$idEnlaces = $unienlaenla[0][0];

	$unienla = getIdUnidEnlace($conn, $idEnlaces);
	$idUnidEnlac = $unienla[0][0];
} else {

	if ($idEnlace != 0) {
		//VALIDAR PRIMERO A LOS ENLACES QUE CAPTURAN SIRE CARPETAS Y LITIGACION CON LOS MISMOS MP 
		if (($idEnlace == 30 || $idEnlace == 28 || $idEnlace == 27) && $format == 4) {

			$unienla = getIdUnidEnlaceMPunidad($conn, $idEnlace);
			$idUnidEnlac = $unienla[0][0];
		} else {

			$unienla = getIdUnidEnlace($conn, $idEnlace);
			$idUnidEnlac = $unienla[0][0];
		}
	} else {
		$idUnidEnlac = 0;
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>SIRE</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="google" value="notranslate">

	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">

	<link rel="icon" href="img/pgje.png" type="imag/ico">
	<link rel="stylesheet" type="text/css" href="css/estilosPrincipal.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Roboto&display=swap" rel="stylesheet">

	<script language="JavaScript" type="text/javascript" src="js/jquery2.1.4.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="css/principal.css">
	<link rel="stylesheet" type="text/css" href="css/puesDispo.css">
	<link rel="stylesheet" type="text/css" href="css/trimestral_20250404.css">
	<link rel="stylesheet" type="text/css" href="css/carpetasJudicializadas.css">


	<link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet">

	<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/formatoCarpetas.css">
	<link rel="stylesheet" type="text/css" href="css/estilosPrincipal.css">
	<link rel="stylesheet" type="text/css" href="css/litigacion.css">
	<link rel="stylesheet" type="text/css" href="css/forestales.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="css/litigacionSENAP.css">
	<link rel="stylesheet" type="text/css" href="css/medidasDeProteccion.css">
	<link rel="stylesheet" type="text/css" href="css/mandamientos.css">
	<link rel="stylesheet" type="text/css" href="css/estadoDeFuerza.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


	<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
	<link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet" />


	<script type="text/javascript">
		function createNew(idPersona, tipoActualizacion) {
			//$("#add-more").hide();
			var idPersona = idPersona;
			var tipoActualizacion = tipoActualizacion;
			if (tipoActualizacion == 0) {
				var data = '<tr class="table-row" id="new_row_ajax">' +
					'<div class="padre"><td contenteditable="false" id="txt_title" onBlur="addToHiddenField(this,\'id\')" onclick="editRow(this);" class="delOpc"></td></div>' +

					'<td contenteditable="true" id="txt_title" onBlur="addToHiddenField(this,\'title\')" onclick="editRow(this);"><select id="textdelitoCometido" name="delitos[]" tabindex="6" class="form-control redondear selectTranparent"><?php while ($delitos = sqlsrv_fetch_array($res1)) { ?><option value="<? echo $delitos['idTipoDelito']; ?>" selected><? echo $delitos['delito']; ?></option><?php } ?></select></td>' +

					'<td><input type="hidden" id="title" /><input type="hidden" id="idPers" value="" /> <a onclick="cancelAdd();" class="ajax-action-links">Cancelar</a></td>' +
					'</tr>';
			} else {
				$("#add-more").hide();
				var data = '<tr class="table-row" id="new_row_ajax">' +
					'<div class="padre"><td contenteditable="false" id="txt_title" onBlur="addToHiddenField(this,\'id\')" onclick="editRow(this);" class="delOpc"></td></div>' +

					'<td contenteditable="true" id="txt_title" onBlur="addToHiddenField(this,\'title\')" onclick="editRow(this);"><select id="textdelitoCometido" name="delitosAct[]" tabindex="6" class="form-control redondear selectTranparent txtDelitoDisable"><?php while ($delitos = sqlsrv_fetch_array($res2)) { ?><option value="<? echo $delitos['idTipoDelito']; ?>" selected><? echo $delitos['delito']; ?></option><?php } ?></select></td>' +

					'<td><input type="hidden" id="title" /><input type="hidden" id="idPers" value="" /><a id="addDelitoSec" onclick="agregarDelito();" class="ajax-action-links">Añadir delito </a> </td></div>' +
					'</tr>';
			}
			$("#table-body").append(data);
			document.getElementById("idPers").value = idPersona;

		}

		function eliminarCampos(idDelitoPersona) {

			var idDelitoPersona = idDelitoPersona;
			if (idDelitoPersona != 0) {

				ajax = objetoAjax();
				ajax.open("POST", "format/puestaDisposicion/deleteDelito.php");

				ajax.onreadystatechange = function() {
					if (ajax.readyState == 4 && ajax.status == 200) {
						var json = ajax.responseText;
						var obj = eval("(" + json + ")");
						if (obj.first == "NO") {
							swal("", "No se elimino el delito.", "warning");
						} else {
							if (obj.first == "SI") {
								var obj = eval("(" + json + ")");
								swal("", "Registro eliminado exitosamente.", "success");
							}
						}
					}
				}
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send("&idDelitoPersona=" + idDelitoPersona);

			}


			$(document).on("click", ".remover_campo", function(e) {
				e.preventDefault();
				$(this).closest('tr').remove();

			});
		}
	</script>



</head>

<body style="zoom: 83%;" <? if ($tipoUser == 1) {
																										if ($format == 1) { 	?> onload="loadCarpetasFormat(<? echo $idUnidadSelect; ?>);" <? } else {
																																																																																				/*if($format  == 2){ ?> 	onload="loadtablaFormat(0, 'formatCmasc.php', 'cmasc', <? echo $idEnlace; ?>);" 	<? }*/
																																																																																				if ($format  == 4) { ?> onload="loadtablaFormat(0, 'formatLitigacion.php', 'litigacion', <? echo $idEnlace; ?>);" <? }
																																																																																																																			/*if($format  == 6){ ?>  	onload="loadtablaFormat(0, 'formatDesaparecidos.php', 'desaparecidos', <? echo $idEnlace; ?>);" 	<? }*/
																																																																																																																			if ($format  == 11) { ?> onload="loadtablaFormat(<? echo $idUnidEnlac ?>, 'trimestral.php', 'trimestral', <? echo $idEnlace; ?>);" <? }
																																																																																																																																				if ($format  == 9) { ?> onload="loadtablaFormat(0, 'puestaDisposicion.php', 'puestaDisposicion', <? echo $idEnlace; ?>);" <? }
																																																																																																																																				if ($format  == 10) { ?> onload="loadtablaFormat(0, 'puestaDisposicionSuper.php', 'puestaDisposicion', <? echo $idEnlace; ?>);" <? }
																																																																																																																																				if ($format  == 12) { ?> onload="loadtablaFormat(0, 'puestaDisposicionConsulta.php', 'puestaDisposicion', <? echo $idEnlace; ?>);" <? }
																																																																																																																																				if ($format  == 13) { ?> onload="loadtablaFormat(0, 'estadoDeFuerza.php', 'estadoDeFuerza', <? echo $idEnlace; ?>);" <? }
																																																																																																																																				if ($format  == 14) { ?> onload="loadtablaFormat(0, 'forestales.php', 'forestales', <? echo $idEnlace; ?>);" <? }
																																																																																																																																				if ($format  == 15) { ?> onload="loadtablaFormat(0, 'carpetasJudicializadas.php', 'carpetasJudicializadas', <? echo $idEnlace; ?>);" <? }
																																																																																																																																						if ($format  == 16) { ?> onload="loadtablaFormat(0, 'medidasDeProteccion.php', 'medidasDeProteccion', <? echo $idEnlace; ?>);" <? }
																																																																																																																																						if ($format  == 18) { ?> onload="loadtablaFormat(0, 'mandamientosJudiciales.php', 'mandamientosJudiciales', <? echo $idEnlace; ?>);" <? }
																																																																																																																																						if ($format  == 19) { ?> onload="loadtablaFormat(0, 'mandamientosJudiciales_administrador.php', 'mandamientosJudiciales', <? echo $idEnlace; ?>);" <? }
                                                                                                                                      if ($format  == 23) { ?> onload="loadtablaFormat(0, 'menu.php', 'Busquedas', <? echo $idEnlace; ?>);" <? }
																																																																																																																																																				if ($format  == 21) { ?> onload="loadtablaFormat(0, 'procesosPenales.php', 'procesosPenales', <? echo $idEnlace; ?>);" <? }
																																																																																																																																																			}
																																																																																																																																																		} else {
																																																																																																																																																			if ($tipoUser == 3) {		?> onload="cargaContHistoricoEnlaceDatosConsulta(<? echo $idUsuario; ?>, <? echo $idEnlace; ?>, <? echo $format; ?>, <? echo $idUnidEnlac; ?>)" <?
																																																																																																																																																																									} else {	?> onload="loadEnlacesFaltantes();" <?	}
																																																																																																																																																																								} ?>>

	<div id="opacity"></div>
	<header>

		<div class="menu">
			<div class="contenedor">
				<div class="logo">Sistema Integral de Registro Estadístico</div>
				<nav>
					<ul>

						<? if ($tipoUser == 1) { 	 ?>


							<?

							$numOFforms = getFormsAccesosEnlace($conn, $idEnlace);

							if ($numOFforms == 1) {

							?>
								<li><a href="subIndex.php">Menu Principal</a></li>
							<?

							}


							?>



							<?



							if ($tipoUser == 1  and $format == 1) {

							?>
								<li style="background-color: #C09F77;  border: solid 2px #C09F77;"><a onclick="loadBiEstadistics(<? echo $idEnlace; ?>)" href="#">BI Estadistícas de Evaluación de Desempeño</a></li>
								<?
							}

							if ($tipoUser == 1 and $format == 4) {
								?>|
								<li style="background-color: #C8C8C8;  border: solid 2px #C8C8C8;"><a style="color:#152F4A !important;" onclick="loadBiEstadisticsLiti(<? echo $idEnlace; ?>)" href="#">BI Estadistícas de Evaluación de Desempeño</a></li>
							<?
							}

							//CARGAR BI POLICIA
							if ($tipoUser == 1 and $format == 12) {
							?>
								<li style="background-color: #C8C8C8;  border: solid 2px #C8C8C8;"><a style="color:#152F4A !important;" onclick="loadBiEstadisticsPolicia(<? echo $idEnlace; ?>)" href="#">BI Estadistícas de Evaluación de Desempeño</a></li>
							<?
							}

							?>

							?>




							<li>


								<? if ($format == 1) { ?>


									<a onclick="loadCarpetasFormat(<? echo $idUnidadSelect; ?>)" href="#">Formato Mensual</a>


								<? } else { ?>

									<? /*if($format  == 2){ ?><a onclick="loadtablaFormat(0, 'formatCmasc.php', 'cmasc', <? echo $idEnlace; ?>);" href="#">Formato Mensual</a> <? } */ ?>
									<? if ($format  == 4) { ?><a onclick="loadtablaFormat(0, 'formatLitigacion.php', 'litigacion', <? echo $idEnlace; ?>);" href="#">Formato Mensual</a> <? } ?>
									<? /*if($format  == 6){ ?><a onclick="loadtablaFormat(0, 'formatDesaparecidos.php', 'desaparecidos', <? echo $idEnlace; ?>);" href="#">Datos Mensuales</a> <? }*/ ?>
									<? if ($format  == 11) { ?><a onclick="loadtablaFormat(<? echo $idUnidEnlac ?>, 'trimestral.php', 'trimestral', <? echo $idEnlace; ?>);" href="#">Formato Mensual</a> <? } ?>
									<? if ($format  == 9) { ?><a onclick="loadtablaFormat(0, 'puestaDisposicion.php', 'puestaDisposicion', <? echo $idEnlace; ?>);" href="#">Informe Diario</a> <? } ?>


								<? } ?>


							</li>



							<? if ($format == 1) {

							?>


								<li><a onclick="cargaContRepositorio(<? echo $idUsuario; ?>, <? echo $format; ?>)" href="#">Repositorio</a></li>
								<!--<li><a onclick="cargaContHistoricoEnlace(<? echo $idUsuario; ?>, <? echo $idEnlace; ?>, <? echo $format; ?>)" href="#">Historico</a></li>-->
								<li><a onclick="cargaContHistoricoEnlaceDatos(<? echo $idUsuario; ?>, <? echo $idEnlace; ?>, <? echo $format; ?>, <? echo $idUnidEnlac; ?>)" href="#">Datos Historico</a></li>
							<?

							} ?>

							<? if ($format == 6) {

							?>
								<li><a onclick="mostrarModalValidadosDesapa(<? echo $idEnlace; ?>" href="#">Datos Validados</a></li>
							<?

							} ?>

							<? if ($format == 10) { ?>


								<li>



									<a href="javascript:;" data-toggle="dropdown" aria-expanded="true">
										<img style="color: white;" class="imagenUserIcon" src="images/ofi2.png" alt="">
										Informes
										<span class=" fa fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">

										<li style="margin-right: 400px !important;"><a style="font-weight: bold !important;" data-toggle="modal" href="#busquepuestdispos">Mensual</a></li><br>
										<li style="margin-right: 400px !important;"><a style="font-weight: bold !important;" data-toggle="modal" href="#busquepuestdispos">Semanal</a></li><br>
										<li style="margin-right: 400px !important;"><a style="font-weight: bold !important;" data-toggle="modal" href="#">Diario</a></li><br>
										<li style="margin-right: 400px !important;"><a style="font-weight: bold !important;" data-toggle="modal" href="#">Vehículos</a></li><br>
										<li><a style="font-weight: bold !important;" data-toggle="modal" href="#">Personas</a></li>
									</ul>


								</li>



								<li>



									<a href="javascript:;" data-toggle="dropdown" aria-expanded="true">
										<img style="color: white;" class="imagenUserIcon" src="images/searche.png" alt="">
										Busquedas
										<span class=" fa fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">

										<li style="margin-right: 180px !important;"><a style="font-weight: bold !important;" data-toggle="modal" href="#busquepuestdispos">Puesta Disposición</a></li><br>
										<li style="margin-right: 180px !important;"><a style="font-weight: bold !important;" data-toggle="modal" href="#">Persona</a></li><br>
										<li style="margin-right: 180px !important;"><a style="font-weight: bold !important;" data-toggle="modal" href="#">Vehículo</a></li><br>
										<li><a style="font-weight: bold !important;" data-toggle="modal" href="#">Defunción</a></li>
									</ul>


								</li>

							<?
								# code...
							} ?>


							<? if ($format == 4) {

							?>
								<li><a onclick="cargaContRepositorio(<? echo $idUsuario; ?>, <? echo $format; ?>)" href="#">Repositorio</a></li>
								<li><a onclick="cargaContHistoricoEnlaceDatosLiti(<? echo $idUsuario; ?>, <? echo $idEnlace; ?>, <? echo $format; ?>, <? echo $idUnidEnlac; ?>)" href="#">Datos Historico</a></li>
							<?

							} ?>

							<? if ($format == 11) {

							?>
								<li><a onclick="cargaContRepositorio(<? echo $idUsuario; ?>, <? echo $format; ?>)" href="#">Repositorio</a></li>
							<?

							} ?>





							<li>

								<a href="javascript:;" data-toggle="dropdown" aria-expanded="false">
									<img class="imagenUserIcon" src="images/default.png" alt="">


									<?php

									echo	$_SESSION['nameIE'];

									?>

									<span class=" fa fa-angle-down"></span>
								</a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">

									<li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>
								</ul>

							</li>
							<? } else {
							if ($tipoUser == 2) {
							?>
								<li>
									<a href="javascript:;" data-toggle="dropdown" aria-expanded="false">Trimestral <span class=" fa fa-angle-down"></span></a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">
										<li style="margin-right: 750px !important;" onclick="loadTrimestralAdmin()"><a style="font-weight: bold !important;">Control de captura trimestral</a></li><br>
										<li style="margin-right: 750px !important;" onclick="loadReporteTrim()"><a style="font-weight: bold !important;">Reporte Trimestral</a></li>
									</ul>
								</li>
								<li><a href="http://189.254.243.115">Reportes Estatales</a></li>
								<li><a onclick="cargaContHistoricoAdmin(<? echo $idUsuario; ?>)" href="#">Historico</a></li>
								<li><a onclick="loadEnlacesFaltantes()" href="#">Enlaces que Capturan</a></li>
								<li><a onclick="cargaContRepositorioAdmin(<? echo $idUsuario; ?>)" href="#">Mis Archivos</a></li>
								<li>

									<a href="javascript:;" data-toggle="dropdown" aria-expanded="false">
										<img class="imagenUserIcon" src="images/default.png" alt="">


										<?php

										echo	$_SESSION['nameIE'];

										?>

										<span class=" fa fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">

										<li style="margin-right: 80px !important;" onclick="loadMpsMovs()"><a style="font-weight: bold !important;">Movimientos MPs</a></li><br>
										<li style="margin-right: 80px !important;"><a style="font-weight: bold !important;" data-toggle="modal" href="#addMpCatalo">Agregar Ministerio Público</a></li><br>
										<hr>
										<li><a style="text-align: center; font-weight: bold;" href="cerrar_sesion.php">Cerrar Sesion</a></li><br>

									</ul>

								</li>

								<?

							} else {

								if ($tipoUser == 3) {

								?>
									/// SE CAMBIO AQUI
									<li><a onclick="cargaContHistoricoEnlaceDatos(<? echo $idUsuario; ?>, <? echo $idEnlace; ?>, 1, <? echo $idUnidEnlac; ?>)" href="#">Datos Historico</a></li>
									<!--<li><a onclick="cargaContHistoricoEnlaceDatosLiti(<? echo $idUsuario; ?>, <? echo $idEnlace; ?>, <? echo $format; ?>, <? echo $idUnidEnlac; ?>)" href="#">Datos Historico</a></li>-->
									<li style="background-color: #C09F77;  border: solid 2px #C09F77;"><a onclick="loadBiEstadistics(<? echo $idEnlace; ?>)" href="#">BI Estadistícas de Evaluación de Desempeño</a></li>
									<li>
										<a href="javascript:;" data-toggle="dropdown" aria-expanded="false">
											<img class="imagenUserIcon" src="images/default.png" alt="">
											<?php
											echo	$_SESSION['nameIE'];
											?>
											<span class=" fa fa-angle-down"></span>
										</a>
										<ul class="dropdown-menu dropdown-usermenu pull-right">

											<li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>
										</ul>

									</li>

						<?
								}
							}
						} ?>


					</ul>


				</nav>
			</div>
		</div>

	</header>

	<div class="principal contenido">

		<div class="" role="">
			<br />

			<div id="contenido">


				<div style="margin: 0 auto; width: 100%; max-height: 780px; overflow-y: scroll;">

					<div class="right_col" role="main" style="background-image: url('');  background-repeat: no-repeat;  background-position: center center; background-size: 100%; background-position-y: 50%;">

						<?

						if ($format == 6) {

						?>


							<div>
								<center><img style="width:300;height:300; margin-top: 12% !important;" src="img/cargando (1).gif"><br>
									<h3 style="color: #757575 ; font-weight: bold; font-family: helvetica;"> Generando Información...</h3>
								</center>
							</div>



						<?

						}

						?>


					</div>

				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="movimientosMp" role="dialog" data-backdrop="static" data-keyboard="false">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 60%; margin-top: 3%;">
					<div class="modal-content">
						<div id="contMOdalMovimientoMp">

						</div>
					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="busquepuestdispos" role="dialog" data-backdrop="static" data-keyboard="false">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 30%; margin-top: 12%;">
					<div class="modal-content">
						<div id="contMOdalBusquePueDispo">
							<div class="modal-header" style="background-color:#152F4A;">
								<center>
									<h4 style="font-weight: bold; color: white;" class="modal-title">Buscar Puesta a Disposición</h4>
								</center>
							</div>
							<div class="modal-body">
								<p style="color: black;">Ingrese el ID de la Puesta a Disposición.</p>
								<input id="idPuestaBusque" type="number" name="" class="form-control" style="text-align: center !important; font-weight: bolder;">
								<div id="contPuestaBusque"></div>
							</div>
							<div class="modal-footer">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<center><button style="width: 88%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Cancelar</button></center>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<center><button onclick="buscarPuesta(<? echo $idEnlace; ?>)" style="width: 88%;" type="button" class="btn btn-primary redondear">Buscar</button></center>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="addMpCatalo" role="dialog" data-backdrop="static" data-keyboard="false">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 45%; margin-top: 15%;">
					<div class="modal-content">
						<div id="contMOdalBusquePueDispo">
							<div class="modal-header" style="background-color:#152F4A;">
								<center>
									<h4 style="font-weight: bold; color: white;" class="modal-title">Agregar Nuevo Ministerio Público</h4>
								</center>
							</div>
							<div class="modal-body">
								<div class="row">


									<div class="col-xs-12 col-md-4">
										<label style="color: black;">Nombre (S) :</label>
										<input id="nameMpAdd" type="text" name="" class="form-control" style=" font-weight: bolder;">
									</div>
									<div class="col-xs-12 col-md-4">
										<label style="color: black;">Apellido Paterno :</label>
										<input id="paternoMpAdd" type="text" name="" class="form-control" style=" font-weight: bolder;">
									</div>
									<div class="col-xs-12 col-md-4">
										<label style="color: black;">Apellido Materno :</label>
										<input id="maternoMpAdd" type="text" name="" class="form-control" style=" font-weight: bolder;">
									</div>

								</div>
							</div>
							<div class="modal-footer">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<center><button style="width: 88%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Cancelar</button></center>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<center><button onclick="saveMp()" style="width: 88%;" type="button" class="btn btn-primary redondear">Guardar</button></center>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="addMp" role="dialog">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 45%; margin-top: 2%;">
					<div class="modal-content">
						<div id="contModAddMps">

						</div>
					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="myModaFormato" role="dialog" data-backdrop="static" data-keyboard="false">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 35%; margin-top: 1%;">

					<div class="modal-content">

						<div id="contMOdalFormato"></div>

					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="modalNucs" role="dialog" data-backdrop="static" data-keyboard="false">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 45%; margin-top: 1%;">

					<div class="modal-content">

						<div id="contmodalnucs"></div>

					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="modalNucsDescargarC" role="dialog" data-backdrop="static" data-keyboard="false">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 40% !important; margin-top: 15%;">

					<div class="modal-content">

						<div id="contmodalnucsDescargarC"></div>

					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="modalNucsEdit" role="dialog" data-backdrop="static" data-keyboard="false">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 30%; margin-top: 1%;">

					<div class="modal-content">

						<div id="contmodalnucsEdit"></div>

					</div>
				</div>

			</div>


			<div class="modal fade bs-example-modal-sm" id="myModaFormatoVer" role="dialog" data-backdrop="static" data-keyboard="false">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 30%; margin-top: 0.5%;">

					<div class="modal-content" style="">

						<div id="contMOdalFormatoVer"></div>

					</div>
				</div>

			</div>


			<div class="modal fade bs-example-modal-sm" id="myModaFormatoEditar" role="dialog" data-backdrop="static" data-keyboard="false">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 30%; margin-top: 1%;">

					<div class="modal-content" style="">

						<div id="contMOdalFormatoEditar"></div>

					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="myModaSubirArchivoUser" role="dialog">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 30%; margin-top: 8%;">

					<div class="modal-content" style="">

						<div id="contMOdalSubirArchivo"></div>

					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="myModaVistaPrevia" role="dialog">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 80%; margin-top: 1%;">

					<div class="modal-content" style="">

						<div id="contMOdalVistaPrevia"></div>

					</div>
				</div>

			</div>


			<div class="modal fade bs-example-modal-sm" id="myModaVistaPrevialitigacion" role="dialog">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 55%; margin-top: 1%;">

					<div class="modal-content" style="">

						<div id="contMOdalVistaPrevialitigacion"></div>

					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="myModalUploadAgain" role="dialog">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 30%; margin-top: 8%;">

					<div class="modal-content" style="">

						<div id="contMOdalSubirArchivoAgain"></div>

					</div>
				</div>

			</div>


			<div class="modal fade bs-example-modal-sm" id="myModalVerFormato" role="dialog">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 70%; margin-top: 3%;">

					<div class="modal-content" style="">

						<div class="modal-header" style="background-color:#3f5265;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<center>
								<h4 class="modal-title" style="color:white; font-weight: bold;">( Ver ) Formato Mensual Estadistico</h4>
							</center>
						</div>

						<div id="contMOdalVerFormato"></div>

					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="myModalEnlaceMps" role="dialog">
				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 40%; margin-top: 3%;">
					<div class="modal-content" style="">
						<div id="contMOdalEnlaceMps"></div>
					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="myModaRevisarArchivo" role="dialog" data-backdrop="static" data-keyboard="false">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 70%; margin-top: 2%;">

					<div class="modal-content">

						<div id="contenidoRevisarArchivo"></div>

					</div>
				</div>

			</div>

			<div class="modal fade bs-example-modal-sm" id="myModalConcluirArchivo" data-dissmiss="modal" role="dialog" data-backdrop="static" data-keyboard="false">

				<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 25%; margin-top: 15%;">

					<div class="modal-content">

						<div id="concluirArchivo"></div>

					</div>
				</div>

			</div>


			<div style="display: none;" id="laodimgmain" class="jm-loadingpage"></div>

   <input type="hidden" value="<?echo $idEnlace; ?>" id="idEnlace_checkStatusDocument">
   <input type="hidden" value="<?echo $format; ?>" id="format_checkStatusDocument">



		</div>

	</div>


	<script language="JavaScript" type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/script_250624.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/scriptCarpetas.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/cmasc.js"></script>
	<!--<script language="JavaScript" type="text/javascript" src="js/litigacion.js"></script>-->
	<script language="JavaScript" type="text/javascript" src="js/litigacion_250708.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/trimestral_20250407.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/desapar.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/procesosPenales.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/puesDispos230217.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<!--<script src="vendors/jquery/dist/jquery.min.js"></script>-->
	<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="build/js/custom.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="dist/sweetalert.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="format/trimestral/pdf/js/function_240624143500.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/forestales.js"></script>
	<!--<script language="JavaScript" type="text/javascript" src="js/litigacionSENAP.js"></script>-->
	<script language="JavaScript" type="text/javascript" src="js/litigacionSENAP_230404.js"></script>
	<script type="text/javascript" src="js/carpetasJudicializadas.js"></script>
	<? if ($format == 16) { ?>
		<script type="text/javascript" src="js/medidasDeProteccion.js"></script>		
		<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
	<? } ?>

	<? if ($format == 18 || $format == 19) { ?><script type="text/javascript" src="js/mandamientosJudiciales_20062022Late.js"></script><? } ?>
	<script language="JavaScript" type="text/javascript" src="js/estadoDeFuerza.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/busquedas.js"></script>


	<!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>-->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

	<script type="text/javascript" src="vendors/select2/dist/js/select2.min.js"></script>


</body>

</html>