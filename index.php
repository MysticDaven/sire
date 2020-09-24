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
if (isset($_GET["format"])){ $format = $_GET["format"]; }
if (isset($_GET["idUnidadSelect"])){ $idUnidadSelect = $_GET["idUnidadSelect"]; }else{
	$idUnidadSelect = 0;
}

if($format == "PoliciaConsulta"){ $format = 12; }
if($format == "PoliciaAdmin"){ $format = 10; }
if($format == "Policia"){ $format = 9; }
if($format == "CarpetasInvestigacion"){ $format = 1; }
if($format == "Litigacion"){ $format = 4; }
if($format == "Trimestral"){ $format = 11; }
if($format == "Administrador"){ $format = 0; }


$_SESSION['formatis']=$format;

$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
$idEnlace = $enlace[0][0];
$idfisca = $enlace[0][1];

if($idEnlace == 14 || $idEnlace == 15 || $idEnlace == 23 || $idEnlace == 22 || $idEnlace == 17 || $idEnlace == 18 || $idEnlace == 16 || $idEnlace == 19 || $idEnlace == 58 ){

			$unienlaenla = getIdUnidEnlaceFormat($conn, $idEnlace, $format);
			$idEnlaces = $unienlaenla[0][0];

				$unienla = getIdUnidEnlace($conn, $idEnlaces);
			$idUnidEnlac = $unienla[0][0];

}else{

	if($idEnlace != 0){

		$unienla = getIdUnidEnlace($conn, $idEnlace);
			$idUnidEnlac = $unienla[0][0];
		}else{
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
		<link rel="stylesheet" type="text/css" href="css/trimestral.css">

		
		<link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet">	

		<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/formatoCarpetas.css">
		<link rel="stylesheet" type="text/css" href="css/estilosPrincipal.css">
		<link rel="stylesheet" type="text/css" href="css/litigacion.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	<script type="text/javascript">

		function createNew(idPersona, tipoActualizacion) {
		//$("#add-more").hide();
 var idPersona = idPersona;
 var tipoActualizacion = tipoActualizacion;
 if(tipoActualizacion == 0){
	var data = '<tr class="table-row" id="new_row_ajax">' +
	'<td contenteditable="false" id="txt_title" onBlur="addToHiddenField(this,\'id\')" onclick="editRow(this);"></td>' +
	
	'<td contenteditable="true" id="txt_title" onBlur="addToHiddenField(this,\'title\')" onclick="editRow(this);"><select id="textdelitoCometido" name="delitos[]" tabindex="6" class="form-control redondear selectTranparent"><?php while ($delitos = sqlsrv_fetch_array($res1)) { ?><option value="<? echo $delitos['idTipoDelito']; ?>" selected><? echo $delitos['delito']; ?></option><?php } ?></select></td>' +
	
	'<td><input type="hidden" id="title" /><input type="hidden" id="idPers" value="" /> / <a onclick="cancelAdd();" class="ajax-action-links">Cancelar</a></td>' +	
	'</tr>';
}else{
	var data = '<tr class="table-row" id="new_row_ajax">' +
	'<td contenteditable="false" id="txt_title" onBlur="addToHiddenField(this,\'id\')" onclick="editRow(this);"></td>' +
	
	'<td contenteditable="true" id="txt_title" onBlur="addToHiddenField(this,\'title\')" onclick="editRow(this);"><select id="textdelitoCometido" name="delitosAct[]" tabindex="6" class="form-control redondear selectTranparent"><?php while ($delitos = sqlsrv_fetch_array($res2)) { ?><option value="<? echo $delitos['idTipoDelito']; ?>" selected><? echo $delitos['delito']; ?></option><?php } ?></select></td>' +
	
	'<td><input type="hidden" id="title" /><input type="hidden" id="idPers" value="" /><a onclick="agregarDelito();" class="ajax-action-links">Añadir delito</a> / <a onclick="cancelAdd();" class="ajax-action-links">Cancelar</a></td>' +	
	'</tr>';
}
$("#table-body").append(data);
   document.getElementById("idPers").value = idPersona; 

}
				
			 function eliminarCampos(idDelitoPersona){

			 	var idDelitoPersona = idDelitoPersona;
			 	if(idDelitoPersona != 0){
			 
						ajax=objetoAjax();
						ajax.open("POST", "format/puestaDisposicion/deleteDelito.php");
 
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {			
										 var json = ajax.responseText;
													var obj = eval("(" + json + ")");
													if (obj.first == "NO") { swal("", "No se elimino el delito.", "warning"); }else{
														 if (obj.first == "SI") {    															
														 	var obj = eval("(" + json + ")");
														 	swal("", "Registro eliminado exitosamente.", "success");															
														 }
													}
										}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&idDelitoPersona="+idDelitoPersona);
								
			 	}


			 	 $(document).on("click",".remover_campo",function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
               
        });
    }

		</script>

		
		
</head>
<body style="zoom: 83%;" 


<? if ($tipoUser == 1) { 
			if($format == 1){ 	?>  onload="loadtablaFormatos(<? echo $idUnidadSelect; ?>);" <?}	else{			
			/*if($format  == 2){ ?> 	onload="loadtablaFormat(0, 'formatCmasc.php', 'cmasc', <? echo $idEnlace; ?>);" 	<? }*/
			if($format  == 4){ ?>  	onload="loadtablaFormat(0, 'formatLitigacion.php', 'litigacion', <? echo $idEnlace; ?>);" 	<? }
			/*if($format  == 6){ ?>  	onload="loadtablaFormat(0, 'formatDesaparecidos.php', 'desaparecidos', <? echo $idEnlace; ?>);" 	<? }*/
			if($format  == 11){ ?>  onload="loadtablaFormat(<? echo $idUnidEnlac ?>, 'trimestral.php', 'trimestral', <? echo $idEnlace; ?>);" 	<? }
			if($format  == 9){ ?>  	onload="loadtablaFormat(0, 'puestaDisposicion.php', 'puestaDisposicion', <? echo $idEnlace; ?>);" 	<? }
			if($format  == 10){ ?>  onload="loadtablaFormat(0, 'puestaDisposicionSuper.php', 'puestaDisposicion', <? echo $idEnlace; ?>);" 	<? }
			if($format  == 12){ ?>  onload="loadtablaFormat(0, 'puestaDisposicionConsulta.php', 'puestaDisposicion', <? echo $idEnlace; ?>);" 	<? }
	}

} else {   

				if($tipoUser == 3){
										?> onload="cargaContHistoricoEnlaceDatosConsulta(<? echo $idUsuario; ?>, <? echo $idEnlace; ?>, <? echo $format; ?>, <? echo $idUnidEnlac; ?>)" <?
				}else{
							?> onload="loadEnlacesFaltantes();" <?
				}

		 }?> >

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

								if($numOFforms == 1 ){

									?>
									  <li><a href="subIndex.php">Menu Principal</a></li>
									<?

								}


								?>


			




								<li>

								
								<? if($format == 1){ ?>	


								<a onclick="loadtablaFormatos(<? echo $idUnidadSelect; ?>)" href="#">Formato Mensual</a>
								<? }else{ ?>

										<? /*if($format  == 2){ ?><a onclick="loadtablaFormat(0, 'formatCmasc.php', 'cmasc', <? echo $idEnlace; ?>);" href="#">Formato Mensual</a> <? } */?>
										<? if($format  == 4){ ?><a onclick="loadtablaFormat(0, 'formatLitigacion.php', 'litigacion', <? echo $idEnlace; ?>);" href="#">Formato Mensual</a> <? } ?>
										<? /*if($format  == 6){ ?><a onclick="loadtablaFormat(0, 'formatDesaparecidos.php', 'desaparecidos', <? echo $idEnlace; ?>);" href="#">Datos Mensuales</a> <? }*/ ?>
										<? if($format  == 11){ ?><a onclick="loadtablaFormat(<? echo $idUnidEnlac ?>, 'trimestral.php', 'trimestral', <? echo $idEnlace; ?>);" href="#">Formato Mensual</a> <? } ?>
										<? if($format  == 9){ ?><a onclick="loadtablaFormat(0, 'puestaDisposicion.php', 'puestaDisposicion', <? echo $idEnlace; ?>);" href="#">Informe Diario</a> <? } ?>

							
								<? } ?>


								</li>
								


								<? if($format == 1 ){

												?>
																<li><a onclick="cargaContRepositorio(<? echo $idUsuario; ?>, <? echo $format; ?>)" href="#">Repositorio</a></li>
																<!--<li><a onclick="cargaContHistoricoEnlace(<? echo $idUsuario; ?>, <? echo $idEnlace; ?>, <? echo $format; ?>)" href="#">Historico</a></li>-->
																<li><a onclick="cargaContHistoricoEnlaceDatos(<? echo $idUsuario; ?>, <? echo $idEnlace; ?>, <? echo $format; ?>, <? echo $idUnidEnlac; ?>)" href="#">Datos Historico</a></li>
												<?

									} ?>	
						
										<? if($format == 6){

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


												<? if($format == 4){

												?>
																<li><a onclick="cargaContRepositorio(<? echo $idUsuario; ?>, <? echo $format; ?>)" href="#">Repositorio</a></li>
																<li><a onclick="cargaContHistoricoEnlaceDatosLiti(<? echo $idUsuario; ?>, <? echo $idEnlace; ?>, <? echo $format; ?>, <? echo $idUnidEnlac; ?>)" href="#">Datos Historico</a></li>
												<?

									} ?>	

									<? if($format == 11){

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
									<? }else{ if($tipoUser == 2){
																?>
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

																}else{

																		if ($tipoUser == 3) {
																				
																							?>
																											<li><a onclick="cargaContHistoricoEnlaceDatosLiti(<? echo $idUsuario; ?>, <? echo $idEnlace; ?>, <? echo $format; ?>, <? echo $idUnidEnlac; ?>)" href="#">Datos Historico</a></li>
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

	<div id ="contenido">

		<div style="margin: 0 auto; width: 100%; max-height: 780px; overflow-y: scroll;">
				
				<div class="right_col" role="main" style ="background-image: url('');  background-repeat: no-repeat;  background-position: center center; background-size: 100%; background-position-y: 50%;" >

											<? 

														if($format == 6 ){

																			?>															
																						

																										<div ><center><img style="width:300;height:300; margin-top: 12% !important;" src="img/cargando (1).gif"><br><h3 style="color: #757575 ; font-weight: bold; font-family: helvetica;">        Generando Información...</h3></center></div>													
									


																			<?

														}

											?>


				</div>

		</div>

	</div>

		<div class="modal fade bs-example-modal-sm" id="movimientosMp" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 60%; margin-top: 3%;">
																	<div class="modal-content">
																					<div id="contMOdalMovimientoMp">			
																									 
																					</div>
																	</div>				
										</div>												

		</div>

	<div class="modal fade bs-example-modal-sm" id="busquepuestdispos" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 12%;">
																	<div class="modal-content">
																					<div id="contMOdalBusquePueDispo">			
																									 <div class="modal-header" style="background-color:#152F4A;">
																				        <center><h4  style="font-weight: bold; color: white;" class="modal-title">Buscar Puesta a Disposición</h4></center>
																				      </div>
																				      <div class="modal-body">
																				        <p style="color: black;">Ingrese el ID de la Puesta a Disposición.</p>
																				        <input id="idPuestaBusque" type="number" name="" class="form-control" style="text-align: center !important; font-weight: bolder;">
																				        <div id="contPuestaBusque"></div>
																				      </div>
																				      <div class="modal-footer">
																				      							 <div class="row">
																																				<div class="col-xs-12 col-sm-6 col-md-6"><center><button style="width: 88%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Cancelar</button></center></div>
																																					<div class="col-xs-12 col-sm-6 col-md-6"><center><button onclick="buscarPuesta(<? echo $idEnlace; ?>)" style="width: 88%;" type="button" class="btn btn-primary redondear" >Buscar</button></center></div>					  
																																			</div> 
																				      </div>
																					</div>
																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="addMpCatalo" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 45%; margin-top: 15%;">
																	<div class="modal-content">
																					<div id="contMOdalBusquePueDispo">			
																									 <div class="modal-header" style="background-color:#152F4A;">
																				        <center><h4  style="font-weight: bold; color: white;" class="modal-title">Agregar Nuevo Ministerio Público</h4></center>
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
																																				<div class="col-xs-12 col-sm-6 col-md-6"><center><button style="width: 88%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Cancelar</button></center></div>
																																					<div class="col-xs-12 col-sm-6 col-md-6"><center><button onclick="saveMp()" style="width: 88%;" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>					  
																																			</div> 
																				      </div>
																					</div>
																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="addMp" role="dialog" >

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 45%; margin-top: 2%;">
																	<div class="modal-content">
																					<div id="contModAddMps">			
																									 
																					</div>
																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="myModaFormato" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 1%;">

																	<div class="modal-content">

																					<div id="contMOdalFormato"></div>

																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="modalNucs" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 1%;">

																	<div class="modal-content">

																					<div id="contmodalnucs"></div>

																	</div>				
										</div>												

					</div>

<div class="modal fade bs-example-modal-sm" id="modalNucsEdit" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 1%;">

																	<div class="modal-content">

																					<div id="contmodalnucsEdit"></div>

																	</div>				
										</div>												

					</div>


		<div class="modal fade bs-example-modal-sm" id="myModaFormatoVer" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 0.5%;">

																	<div class="modal-content" style="">

																					<div id="contMOdalFormatoVer"></div>

																	</div>				
										</div>												

		</div>
		

		<div class="modal fade bs-example-modal-sm" id="myModaFormatoEditar" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 1%;">

																	<div class="modal-content" style="">

																					<div id="contMOdalFormatoEditar"></div>

																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="myModaSubirArchivoUser" role="dialog">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 8%;">

																	<div class="modal-content" style="">

																					<div id="contMOdalSubirArchivo"></div>

																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="myModaVistaPrevia" role="dialog">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 80%; margin-top: 1%;">

																	<div class="modal-content" style="">

																					<div id="contMOdalVistaPrevia"></div>

																	</div>				
										</div>												

		</div>


		<div class="modal fade bs-example-modal-sm" id="myModaVistaPrevialitigacion" role="dialog">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 55%; margin-top: 1%;">

																	<div class="modal-content" style="">

																					<div id="contMOdalVistaPrevialitigacion"></div>

																	</div>				
										</div>												

		</div>

			<div class="modal fade bs-example-modal-sm" id="myModalUploadAgain" role="dialog">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 8%;">

																	<div class="modal-content" style="">

																					<div id="contMOdalSubirArchivoAgain"></div>

																	</div>				
										</div>												

		</div>
			
			
			<div class="modal fade bs-example-modal-sm" id="myModalVerFormato" role="dialog">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 70%; margin-top: 3%;">

																	<div class="modal-content" style="">												
																						
																								<div class="modal-header" style="background-color:#3f5265;">
																		        <button type="button" class="close" data-dismiss="modal">&times;</button>
																		        <center><h4 class="modal-title" style="color:white; font-weight: bold;">( Ver ) Formato Mensual Estadistico</h4></center>
																		      	</div>

																		      	<div id="contMOdalVerFormato"></div>	

																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="myModalEnlaceMps" role="dialog">
										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 40%; margin-top: 3%;">
																	<div class="modal-content" style="">
																		      	<div id="contMOdalEnlaceMps"></div>	
																	</div>				
										</div>											

		</div>

			<div class="modal fade bs-example-modal-sm" id="myModaRevisarArchivo" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 70%; margin-top: 2%;">

																	<div class="modal-content">

																					<div id="contenidoRevisarArchivo"></div>

																	</div>				
										</div>												

					</div>

					<div class="modal fade bs-example-modal-sm" id="myModalConcluirArchivo" data-dissmiss="modal" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 25%; margin-top: 15%;">

																	<div class="modal-content">

																					<div id="concluirArchivo"></div>

																	</div>				
										</div>												

					</div>


				
					

</div>

		</div>

		<script>

</script>


	<script language="JavaScript" type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/script.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/cmasc.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/litigacion.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/trimestral.js"></script>
			<script language="JavaScript" type="text/javascript" src="js/desapar.js"></script>
				<script language="JavaScript" type="text/javascript" src="js/puesDispos.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!--<script src="vendors/jquery/dist/jquery.min.js"></script>-->
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="build/js/custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="dist/sweetalert.min.js"></script>
<script language="JavaScript" type="text/javascript" src="format/trimestral/pdf/js/function.js"></script>

	    

</body>



