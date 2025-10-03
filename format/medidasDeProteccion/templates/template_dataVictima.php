<?php
include ("../../../Conexiones/conexionMedidas.php");
include ("../../../Conexiones/conexionSicap.php");
include("../../../funcionesMedidasProteccion.php");	

if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }	
$idInvolucrado = isset($_POST['idInvolucrado'])	 ? $_POST['idInvolucrado'] : null;
if (isset($_POST["fraccion"])){ $fraccion = $_POST["fraccion"]; }	
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
$section = isset($_POST['section']) ? $_POST['section'] : null;

$data = getDataInvolucrado ($connMedidas, $idInvolucrado); 
$nombre  = $data[0][2];
$paterno  = $data[0][3];
$materno  = $data[0][4];
$genero  = $data[0][5];
$edad  = $data[0][7];
$getEntidadID = $data[0][8];
$getMunicipioID = $data[0][10];
$nombreMunicipio = $data[0][11];
$colonia = $data[0][12];
$calle = $data[0][13];
$numero = $data[0][14];
$telefono1 = $data[0][15];
$telefono2 = $data[0][16];
$codigoPostal = $data[0][17];
$correo = $data[0][18];
?>
       <div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="nombreVictiEdita">Nombre: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $nombre; ?>"  id="nombreVictiEdita"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="paternoVictiEdita">Paterno: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $paterno; ?>"  id="paternoVictiEdita"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="maternoVictiEdita">Materno: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $materno; ?>"  id="maternoVictiEdita"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="generoVictiEdita">Género: <span class="aste">(*)</span></label>
									<select class="form-control" id="generoVictiEdita">
										 <option value="">Seleccione</option>
									  <option class="fontBold" value="1" <?if($genero == 1){ ?> selected <? } ?> >Masculino</option>
									  <option class="fontBold" value="2" <?if($genero == 2){ ?> selected <? } ?> >Femenino</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-1">
									<label for="edadVictimaEdita">Edad: <span class="aste">(*)</span></label>
									<select class="form-control" id="edadVictimaEdita">
										 <option value="0">Seleccione</option>		
										 <option class="fontBold" value="0">Desconocida</option>		
											<?php 
											$valor=-1;
											for ($i=1; $i<12; $i++){	?>
												<option class="fontBold" value="<? echo $valor ?>" <?if($i == $edad){ ?> selected <? } ?> ><? echo $i; ?> Meses</option>
											<? $valor--;}
											for ($i=1; $i<=100; $i++){	?>
												<option class="fontBold" value="<? echo $i; ?>" <?if($i == $edad){ ?> selected <? } ?> ><?echo $i; ?> Años</option>
											<? } ?>
									</select>
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12">
									<h4>Datos de residencia y contacto: <h4>
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="entidad">Entidad federativa:<span class="aste">(*)</span></label>
									<select class="dataAutocomplet form-control browser-default custom-select" onchange="reloadDataMunicipios()" id="entidad" locked="locked" name="entidad" type="text" <? if($b == 0){ echo "readonly"; } ?> >
										<option></option>
				 					<? $entidades = getDataEntidades($conSic);
				 					for ($h=0; $h < sizeof($entidades ); $h++) { 
				 						$idEntidad = $entidades[$h][0];	$nombre = $entidades[$h][1]; ?>
				 					<option class="fontBold" value="<? echo $idEntidad ; ?>"  <?if($idEntidad == $getEntidadID){ ?> selected <? } ?> ><? echo $nombre; ?></option>
				 					<? } ?>
				 				</select>
								</div>
								<div id="contDataMunicipios">
									<div class="col-xs-12 col-sm-12  col-md-3">
										<label for="municipio">Municipio: <span class="aste">(*)</span></label>
										<select class="dataAutocomplet form-control browser-default custom-select" id="municipio">
										<?$data = getDataMunicipios($conSic, $getEntidadID);
												$idMunicipio  = $data[0][0];
												$nombre = $data[0][1];
										 for ($h=0; $h < sizeof($data); $h++) { 
											$idMunicipio = $data[$h][0];	$nombre = $data[$h][1]; ?>
											<option class="fontBold" value="<? echo $idMunicipio; ?>" <?if($idMunicipio == $getMunicipioID){ ?> selected <? } ?> > <? echo $nombre; ?> </option>
										<? } ?>
										</select>
									</div>	
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="colonia">Colonia: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $colonia; ?>"  id="colonia"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="calle">Calle: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $calle; ?>"  id="calle"  type="text">
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-1">
									<label for="numero">Número: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $numero; ?>"  id="numero"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="codigoPostal">Código Postal: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $codigoPostal; ?>"  id="codigoPostal"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="telefonoUno">Télefono 1: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $telefono1; ?>"  id="telefonoUno"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="telefonoDos">Télefono 2: </label>
									<input class="form-control mandda gehit" value="<?echo $telefono2; ?>"  id="telefonoDos"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="correoElectronico">Correo electrónico: </label>
									<input class="form-control mandda gehit" value="<?echo $correo; ?>"  id="correoElectronico"  type="text">
								</div>
							</div></br>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" onclick="actualizarDatosInvolucrado(<?php echo $idEnlace; ?> , <?php echo $fraccion; ?>, <?echo $idMedida ?>, <?echo $idInvolucrado; ?>, <?= $section ?>)">Actualizar información</button>
							</div>

