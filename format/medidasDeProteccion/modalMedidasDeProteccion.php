<?php
include("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionMedidas.php");
include("../../Conexiones/conexionSicap.php");
//include("../../funcionesPueDispo.php");	
include("../../funcionesMedidasProteccion.php");
$fecha_actual = date("d/m/Y");
$fecha = strftime("%Y-%m-%d %H:%M:%S", time());
$anioActual = date("Y");
$hoy = date("Y-m-d"); //Fecha calendario
$get_idCoorporacion = 0;

if (isset($_POST["idEnlace"])) {
	$idEnlace = $_POST["idEnlace"];
}

if (isset($_POST["tipoModal"])) {
	$tipoModal = $_POST["tipoModal"];
}
if (isset($_POST["idEnlace"])) {
	$idEnlace = $_POST["idEnlace"];
}
if (isset($_POST["typeArch"])) {
	$typeArch = $_POST["typeArch"];
}
if (isset($_POST["typeCheck"])) {
	$typeCheck = $_POST["typeCheck"];
}

$getRolUser = getRolUser($connMedidas, $idEnlace);
$rolUser = $getRolUser[0][0];

if ($typeCheck == 0) {
	$b = 0;
} else {
	if ($typeCheck == 1) {
		$b = 1;
	}
}

if (isset($_POST["idMedida"])) {
	$idMedida = $_POST["idMedida"];
	if ($idMedida != 0) {
		$idMedida = $idMedida;
		$medidaData = get_data_medida($connMedidas, $idMedida);
		$get_idUnidad  = $medidaData[0][0];
		$get_nuc  = $medidaData[0][1];
		/// OBTENER POR CONSULTA LA CAUSA DEL NUC
		$bandCausa = 0;
		$causaPenal = getCausaPenalNuc($conn, $get_nuc);
		if (sizeof($causaPenal) > 0) {
			$bandCausa = 1;
		}
		$causaP = $causaPenal[0][1];
		$get_idMP  = $medidaData[0][2];
		$get_idUnidad  = $medidaData[0][3];
		$get_idFiscalia  = $medidaData[0][4];
		$get_idDelito = $medidaData[0][5];
		$get_fechaAcuerdo = $medidaData[0][6];
		$get_fechaRegistro = $medidaData[0][7];
		$get_idEnlace = $medidaData[0][8];
		$get_idFiscaliaProcedencia = $medidaData[0][9];
		$get_estatus = $medidaData[0][11];
		$get_idCoorporacion = $medidaData[0][13];
		$get_nOficio = $medidaData[0][14];
		$a = 1;

		///// MEDIDAS APLICADAS PARA EL RESTIGO /////
		$getMedidasAplicadasTest = getMedidasAplicadasTest($connMedidas, $idMedida);
		$aplicadasTest = array();
		for ($e = 0; $e < sizeof($getMedidasAplicadasTest); $e++) {
			$aplicadasTest[$e] = $getMedidasAplicadasTest[$e][0];
		}
		
		$getMedidasAplicadas = getMedidasAplicadas($connMedidas, $idMedida);
		$aplicadas = array();

		for ($h = 0; $h < sizeof($getMedidasAplicadas); $h++) {
			$aplicadas[$h] = $getMedidasAplicadas[$h][0];
		}

	} else {
		$a = 0;
		$idMedida = 0;
		$causaP = "";
		$bandCausa = 0;
	}
}

?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Registro de Medida de Protección</label></center>
</div>
<div class="modal-body">
	<!--DATOS GENERALES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos generales</strong></h5>
			<!---INICIA SECCION COORDINADOR Y MP(LECTURA)-->
			<? if ($rolUser == 1 || $rolUser == 3 || $rolUser == 4) {
			  if($rolUser != 4){ ?>
				<input type="hidden" name="nuc" id="nuc" value="<? echo	$get_nuc; ?>"> <? } ?>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="heard">Agente del Ministerio Público: <span class="aste">(*)</span></label><br>
						<div id="agentesMP_id_div">
							<select class="dataAutocomplet form-control browser-default custom-select" onchange="refreshDataAgente()" id="agentesMP_id" locked="locked" name="agentesMP_id" type="text" <? if ($rolUser == 3) { ?> disabled <? } ?>>
								<option></option>
								<? $agentes = getDataMP($connMedidas, $rolUser, $idEnlace);
								for ($h = 0; $h < sizeof($agentes); $h++) {
									$idMP = $agentes[$h][0];
									$nombrecom = $agentes[$h][1]; 
									$idFiscAdscrito = $agentes[$h][3]; ?>
									<option class="fontBold" value="<? echo $idMP; ?>" <? if ($a == 1 && $idMP == $get_idMP) { ?> selected <? } ?>><? echo $nombrecom; ?></option>
								<? } ?>
							</select>
						</div>
					</div>
					<input type="hidden" name="idFiscAdscrito" id="idFiscAdscrito" value="<? echo	$idFiscAdscrito; ?>"> 
					<div id="contDataAgente">
					<? if ( $idMedida != 0) { ?>
						<div class="col-xs-12 col-sm-12  col-md-2">
							<label for="idAdscripcion">Área de adscripción : </label>
							<select class="form-control" id="idAdscripcion" disabled>
								<?$data = getDataAdscripcion($connMedidas, $get_idMP);
								 	$idUnidad = $data[0][0];	$nombreUnidad = $data[0][1]; ?>
									<option class="fontBold" value="<? echo $idUnidad; ?>" > <? echo $nombreUnidad; ?> </option>
								</select>
						</div>
						<? } else { ?>
						<div class="col-xs-12 col-sm-12  col-md-2">
							<label for="idAdscripcion">Área de adscripción : </label>
							 <select class="form-control" id="idAdscripcion" disabled>
									<option class="fontBold" value="0" > </option>
								</select>
						</div>
						<? } ?>
						<div class="col-xs-12 col-sm-12  col-md-2">
							<label for="idCargo">Cargo :</label>
							<select class="form-control" id="idCargo" disabled>
								<option value="<? if ($a == 1) { ?> 1 <? } ?> "> <? if ($a == 1) { ?> Agente del ministerio publico <? } ?></option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-12  col-md-2">
							<label for="idFuncion">Función :</label>
							<select class="form-control" id="idFuncion" disabled>
								<option value="<? if ($a == 1) { ?> 1 <? } ?>"><? if ($a == 1) { ?> Agente <? } ?></option>
							</select>
						</div>
						<div class="col-xs-10 col-sm-10  col-md-3">
							<label for="idCoorporacion">Coorporación Policial que dará protección: </label>
							<select class="form-control" id="idCoorporacion" >
								<option value=null>Seleccione la coorporación</option>
								<?php 
								$getCoorporacion = getCoorporacion($connMedidas);
								foreach($getCoorporacion as $coorporacion){ ?>									
									<option 
										value="<?= $coorporacion['idCatCoorporacion'] ?>"
										<?php
										if($a == 1 && $coorporacion['idCatCoorporacion'] == $get_idCoorporacion){ ?>
											selected
										<? } ?>
									>
										<?= $coorporacion['nombre'] ?>
									</option>
								<?}
								?>
							</select>
						</div>
					</div>
				</div><br>
			<? } ?>
			<!---TERMINA SECCION COORDINADOR-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="nuc">NUC: <span class="aste">(*)</span></label>
					<input class="form-control" value="<? if ($a == 1) {echo $get_nuc;} ?>" maxlength="15" oninput="this.value = this.value.toUpperCase();"  onchange="validateMedidaOK(this.id)" id="nuc" type="text" <? if ($rolUser == 1 || $rolUser == 3) { ?> disabled <? } ?>>
				</div>
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="nOficio">Número de oficio: <span class="aste">(*)</span></label>
					<input class="form-control" id="nOficio" type="text" onchange="validateNOF(this.id)" value="<?php if ($a == 1) echo $get_nOficio; ?>">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="idDelito">Delito: <span class="aste">(*)</span></label>
					<div id="idDelito_div">
						<select class="dataAutocomplet form-control browser-default custom-select" id="idDelito" onchange="validateMedidaOK('idDelito_div')" <? if ($rolUser == 1 || $rolUser == 3) { ?> disabled <? } ?>>
							<option value="">Seleccione</option>
							<? $delitos = dataDelitosSicap($conSic);
							for ($h = 0; $h < sizeof($delitos); $h++) {
								$idDelito = $delitos[$h][0];
								$delito = $delitos[$h][1]; ?>
								<option class="fontBold" value="<? echo $idDelito; ?>" <? if ($a == 1 && $idDelito == $get_idDelito) { ?> selected <? } ?>><? echo $delito; ?></option>
							<? } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="idFiscaliaProc">Fiscalía ó Unidad de procedencia :</label>
					<div id="idFiscaliaProc_div">
						<select class="dataAutocomplet form-control browser-default custom-select" id="idFiscaliaProc" onchange="validateMedidaOK('idFiscaliaProc_div')" <? if ($rolUser == 1 || $rolUser == 3) { ?> disabled <? } ?>>
							<option></option>
							<?php
							$fiscalias = dataFiscalias($connMedidas);
							for ($h = 0; $h < sizeof($fiscalias); $h++) {
								$idFiscalia = $fiscalias[$h][0];
								$nombreFisc = $fiscalias[$h][1]; ?>
								<option class="fontBold" value="<? echo $idFiscalia ?>" <? if ($a == 1 && $idFiscalia == $get_idFiscaliaProcedencia) { ?> selected <? } ?>><? echo $nombreFisc; ?></option>
							<? } ?>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="fechaAcuerdo">Fecha del acuerdo: <span class="aste">(*)</span></label>
					<input 
						id="fechaAcuerdo" 
						type="datetime-local" 
						value="<? if ($a == 1) {
							echo $fechaev = str_ireplace(' ', 'T', $get_fechaAcuerdo);
						} ?>" 
						onchange="
							validateMedidaOK(this.id), 
							checkDateAcuerdo('<? echo $fecha ?>') " 						
						name="fechaAcuerdo" 
						class="fechas form-control gehit" 
						min="<? echo $anioActual; ?>-<? echo $m; ?>-01T00:00:00" 
						max="<? echo $hoy; ?>T23:59:59" 
						<? if ($rolUser == 1 || $rolUser == 3) { ?> disabled <? } ?> />
				</div>
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="fechaRegistro">Fecha de registro:</label>
					<input 
						class="form-control"
						id="fechaRegistro" 
						value="<? if ($a == 1) {
								echo $get_fechaRegistro;
							} else {
								echo $fecha;
							} ?>" 
						type="text" 
						readonly><br>
				</div>
			</div>
		</div>
	</div>
	<!--DATOS GENERALES-->
	<!--DATOS DE LA VICTIMA-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos de la víctima</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="nombreVicti">Nombre: <span class="aste">(*)</span></label>
					<input class="form-control" value="" onchange="validateMedidaOK(this.id)" id="nombreVicti" type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="paternoVicti">Paterno: <span class="aste">(*)</span></label>
					<input class="form-control" value="" onchange="validateMedidaOK(this.id)" id="paternoVicti" type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="maternoVicti">Materno: <span class="aste">(*)</span></label>
					<input class="form-control" value="" onchange="validateMedidaOK(this.id)" id="maternoVicti" type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="generoVicti">Género: <span class="aste">(*)</span></label>
					<select class="form-control" id="generoVicti" onchange="validateMedidaOK(this.id)">
						<option value="">Seleccione</option>
						<option class="fontBold" value="1">Masculino</option>
						<option class="fontBold" value="2">Femenino</option>
					</select>
				</div>
				<div class="col-xs-12 col-sm-12  col-md-1">
					<label for="edadVictima">Edad: <span class="aste">(*)</span></label>
					<select class="form-control" id="edadVictima" onchange="validateMedidaOK(this.id)">
						<option value="">Seleccione</option>
						<option class="fontBold" value="0">Desconocida</option>
						<?php
						$valor = -1;
						for ($i = 1; $i < 12; $i++) {	?>
							<option class="fontBold" value="<? echo $valor ?>"><? echo $i; ?> Meses</option>
						<? $valor--;
						}
						for ($i = 1; $i <= 100; $i++) {	?>
							<option class="fontBold" value="<? echo $i; ?> "><? echo $i; ?> Años</option>
						<? } ?>
					</select>
				</div>
			</div><br>
			<? $getDataVictimas = getDataVictimas($connMedidas, $idMedida);
			if (sizeof($getDataVictimas) > 0) {
				if ($rolUser != 1) { ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12  col-md-3">
							<button type="button" class="btn btn-primary" onclick="agregarVictima(<? echo $idMedida; ?>, <? echo $idEnlace; ?>)">Agregar víctima</button>
						</div>
					</div><? } ?>
				<br>
				<label>Víctima(s)</label>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-12">
						<table class="table table-bordered">
							<thead>
								<tr class="cabeceraTablaVictimas">
									<th>#</th>
									<th>Nombre</th>
									<th>Paterno</th>
									<th>Materno</th>
									<th>Género</th>
									<th>Edad</th>
									<th>Datos de contacto</th>
									<th>Editar información</th>
									<th>Eliminar</th>
								</tr>
							</thead>
							<tbody id="contentTableDataVictimas">
								<? for ($h = 0; $h < sizeof($getDataVictimas); $h++) {
									$totalV = sizeof($getDataVictimas);
									$dataCompleted = checkDataContactoCompleted($connMedidas, $getDataVictimas[$h][0]);
									$checkEdad = checkEdad($getDataVictimas[$h][6]); ?>
									<tr>
										<td><? echo $h + 1 ?></td>
										<td><? echo $getDataVictimas[$h][2]; ?></td>
										<td><? echo $getDataVictimas[$h][3]; ?></td>
										<td><? echo $getDataVictimas[$h][4]; ?></td>
										<td><? echo $getDataVictimas[$h][5]; ?></td>
										<td><? echo abs($getDataVictimas[$h][6]) . ' ' . $checkEdad; ?></td>
										<? if ($dataCompleted[0][0] > 0) { ?>
											<td style="background: green; color: white;">
												<center>Completado</center>
											</td><? } else { ?>
											<td style="background: #FF9A09; color: white;">
												<center>Incompleto</center>
											</td><? } ?>
										<td>
											<center><span onclick="modalDatosMedidaCapturista(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 0, <? echo $idMedida; ?>, 'victima')" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center>
										</td>
										<td>
											<center><span onclick="deleteItemV(3, <? echo $getDataVictimas[$h][0] ?>, <?php echo $idEnlace; ?>,<? echo $idMedida ?>, <? echo $totalV ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center>
										</td>
									</tr>
								<? } ?>
							</tbody>
						</table>
					</div>
				</div>
			<? } ?>
		</div>
	</div>
	<!--DATOS DE LA VICTIMA-->
	<? if ($rolUser == 3 || $rolUser == 1 || $rolUser == 4) { ?>
		<div id="medidas_seleccionadas"></div>
		<div class="panel panel-default fd1">
			<div class="panel-body">
				<h5 class="text-on-pannel"><strong>Medidas de protección VICTIMA</strong></h5>
				<div class="row">
					<div class="col-xs-12 col-sm-6  col-md-6">
						<img 
							<? if ($a == 1 && in_array(1, $aplicadas)) { 
								?> 
									src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 01 Fondo.png" 
								<? 
								} 
								else { 
								?> 
									src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 01 Gris.png" 
									onmouseover="hoverIMG(this, 'uno');" 
									onmouseout="unhoverIMG(this, 'uno')" 
									<? if ($a == 1 && (sizeof($getMedidasAplicadas) > 0) && $rolUser != 1) { 
										?> onclick="aplicarMedida(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 1, <? echo $get_nuc; ?>)" <? 
									} else {
											if ($rolUser != 1 && $rolUser != 4) { 
												?> onclick="modalDatosMedida(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 1, <? echo $idMedida; ?>)" <? }
											elseif($rolUser == 4) { 
												?> onclick="agregarMedida(this, 1 , 'uno')" <? 
											}
									}
								} ?> class="cursorp" width="100%">
					</div>
					
					<div class="col-xs-12 col-sm-6  col-md-6">
						<img <? if ($a == 1 && in_array(2, $aplicadas)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 02 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 02 Gris.png" onmouseover="hoverIMG(this, 'dos');" onmouseout="unhoverIMG(this, 'dos')" <? if ($a == 1 && (sizeof($getMedidasAplicadas) > 0) && $rolUser != 1) { ?> onclick="aplicarMedida(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 2, <? echo $get_nuc; ?>)" <? } else {
							if ($rolUser != 1 && $rolUser != 4) { ?> onclick="modalDatosMedida(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 2, <? echo $idMedida; ?>)" <? }
							elseif($rolUser == 4) { ?> onclick="agregarMedida(this, 2 , 'dos')" <? }
					}
				} ?> class="cursorp" width="100%">
				</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-6  col-md-6">
						<img <? if ($a == 1 && in_array(3, $aplicadas)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 03 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 03 Gris.png" onmouseover="hoverIMG(this, 'tres');" onmouseout="unhoverIMG(this, 'tres')" <? if ($a == 1 && (sizeof($getMedidasAplicadas) > 0) && $rolUser != 1) { ?> onclick="aplicarMedida(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 3, <? echo $get_nuc; ?>)" <? } else {
							if ($rolUser != 1 && $rolUser != 4) { ?> onclick="modalDatosMedida(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 3, <? echo $idMedida; ?>)" <? }
							elseif($rolUser == 4) { ?> onclick="agregarMedida(this, 3 , 'tres')" <? }
					}
				} ?> class="cursorp" width="100%">
					</div>
					<div class="col-xs-12 col-sm-6  col-md-6">
						<img <? if ($a == 1 && in_array(4, $aplicadas)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 04 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 04 Gris.png" onmouseover="hoverIMG(this, 'cuatro');" onmouseout="unhoverIMG(this, 'cuatro')" <? if ($a == 1 && (sizeof($getMedidasAplicadas) > 0) && $rolUser != 1) { ?> onclick="aplicarMedida(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 4, <? echo $get_nuc; ?>)" <? } else{
							if ($rolUser != 1 && $rolUser != 4) { ?> onclick="modalDatosMedida(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 4, <? echo $idMedida; ?>)" <? }
							elseif($rolUser == 4) { ?> onclick="agregarMedida(this, 4 , 'cuatro')" <? }
					}
				} ?> class="cursorp" width="100%">
				</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-6  col-md-6">
						<img <? if ($a == 1 && in_array(5, $aplicadas)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 05 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 05 Gris.png" onmouseover="hoverIMG(this, 'cinco');" onmouseout="unhoverIMG(this, 'cinco')" <? if ($a == 1 && (sizeof($getMedidasAplicadas) > 0) && $rolUser != 1) { ?> onclick="aplicarMedida(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 5, <? echo $get_nuc; ?>)" <? } else {
							if ($rolUser != 1 && $rolUser != 4) { ?> onclick="modalDatosMedida(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 5, <? echo $idMedida; ?>)" <? }
							elseif($rolUser != 1) { ?> onclick="agregarMedida(this, 5 , 'cinco')" <? }
					}
				} ?> class="cursorp" width="100%">
					</div>
					<div class="col-xs-12 col-sm-6  col-md-6">
						<img <? if ($a == 1 && in_array(6, $aplicadas)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 06 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 06 Gris.png" onmouseover="hoverIMG(this, 'seis');" onmouseout="unhoverIMG(this, 'seis')" <? if ($a == 1 && (sizeof($getMedidasAplicadas) > 0) && $rolUser != 1) { ?> onclick="aplicarMedida(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 6, <? echo $get_nuc; ?>)" <? } else {
							if ($rolUser != 1 && $rolUser != 4) { ?> onclick="modalDatosMedida(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 6, <? echo $idMedida; ?>)" <? }
							elseif($rolUser == 4) { ?> onclick="agregarMedida(this, 6 , 'seis')" <? }
					}
				} ?> class="cursorp" width="100%">
				</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-6  col-md-6">
						<img <? if ($a == 1 && in_array(7, $aplicadas)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 07 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 07 Gris.png" onmouseover="hoverIMG(this, 'siete');" onmouseout="unhoverIMG(this, 'siete')" <? if ($a == 1 && (sizeof($getMedidasAplicadas) > 0) && $rolUser != 1) { ?> onclick="aplicarMedida(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 7, <? echo $get_nuc; ?>)" <? } else{
							if ($rolUser != 1 && $rolUser != 4) { ?> onclick="modalDatosMedida(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 7, <? echo $idMedida; ?>)" <? }
							elseif($rolUser == 4) {  ?> onclick="agregarMedida(this, 7 , 'siete')" <? }
					}
				} ?> class="cursorp" width="100%">
					</div>
					<div class="col-xs-12 col-sm-6  col-md-6">
						<img <? if ($a == 1 && in_array(8, $aplicadas)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 08 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 08 Gris.png" onmouseover="hoverIMG(this, 'ocho');" onmouseout="unhoverIMG(this, 'ocho')" <? if ($a == 1 && (sizeof($getMedidasAplicadas) > 0) && $rolUser != 1) { ?> onclick="aplicarMedida(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 8, <? echo $get_nuc; ?>)" <? } else {
							if ($rolUser != 1 && $rolUser != 4) { ?> onclick="modalDatosMedida(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 8, <? echo $idMedida; ?>)" <? }
							elseif($rolUser == 4) { ?> onclick="agregarMedida(this, 8 , 'ocho')" <? }
					}
				} ?> class="cursorp" width="100%">
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-6  col-md-6">
						<img <? if ($a == 1 && in_array(9, $aplicadas)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 09 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 09 Gris.png" onmouseover="hoverIMG(this, 'nueve');" onmouseout="unhoverIMG(this, 'nueve')" <? if ($a == 1 && (sizeof($getMedidasAplicadas) > 0) && $rolUser != 1) { ?> onclick="aplicarMedida(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 9, <? echo $get_nuc; ?>)" <? } else {
							if ($rolUser != 1 && $rolUser != 4) { ?> onclick="modalDatosMedida(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 9, <? echo $idMedida; ?>)" <? }
							elseif($rolUser == 4) { ?> onclick="agregarMedida(this, 9 , 'nueve')" <? }
					}
				} ?> class="cursorp" width="100%">
					</div>
					<div class="col-xs-12 col-sm-6  col-md-6">
						<img <? if ($a == 1 && in_array(10, $aplicadas)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 10 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 10 Gris.png" onmouseover="hoverIMG(this, 'diez');" onmouseout="unhoverIMG(this, 'diez')" <? if ($a == 1 && (sizeof($getMedidasAplicadas) > 0) && $rolUser != 1) { ?> onclick="aplicarMedida(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 10, <? echo $get_nuc; ?>)" <? } else {
							if ($rolUser != 1 && $rolUser != 4) { ?> onclick="modalDatosMedida(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 10, <? echo $idMedida; ?>)" <? }
							elseif($rolUser == 4) { ?> onclick="agregarMedida(this, 10 , 'diez')" <? }	
					}
				} ?> class="cursorp" width="100%">
					</div>
				</div><br>
				<?if($rolUser == 4){ 
					if($a == 1){ 
						 $getFechaConclusion = getDataGenerales($connMedidas, $idMedida, 0, 0);
						 if ($getFechaConclusion[0][3] != null) {
							$fechaConclusion = $getFechaConclusion[0][3]->format('Y-m-d H:i'); 
						  }
						 } ?>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="fechaConclusion">Fecha de conclusión: <span class="aste">(*)</span></label>
						<input 
							id="fechaConclu" 
							type="datetime-local" 
							value="<?if($a == 1){ echo $fechaConclusion; } ?>" 
							name="fechaConclu" 
							onchange="
								validateMedidaOK(this.id)
								validarFechaConclusion(this.id)" 
							onclick="createOptionsDate()"
							class="fechas form-control gehit" />
					</div>
				</div><br>
			<? } ?>
			</div>
		</div>
	<? } ?>
	<? $getDataTestigos = getDataTestigos($connMedidas, $idMedida); 
				if (sizeof($getDataTestigos) > 0){ $banT = 1;}else{$banT = 0;}
	?>																			
	<hr>
	<div class="form-check">
	<input class="form-check-input"<? if($banT == 1){echo "checked"; } ?> <? if($banT == 1){ echo "disabled"; } ?> onchange="toggleCheckboxTestigo(this)" type="checkbox" value="" id="flexCheckDefault">
  
  
  <label class="form-check-label" for="flexCheckChecked">¡La medida de Proteccion cuenta con Testigos!</label>
</div><br>
	<!--DATOS DE LA VICTIMA-->
	<div id="panelDeTestigos" <? if($banT == 1){?> style="display:block; " <? }else{ ?>  style="display:none;"   <? } ?>class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos de Testigo en Riesgo</strong></h5>

			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="nombreVicti">Causa:</label>
					<input 
						class="form-control" 
						<?php if ($bandCausa == 1) {
							echo "disabled";
						} ?> 
						value="<?php echo $causaP; ?>" 
						id="causaTest" 
						type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="nombreVicti">Nombre (s): <span class="aste">(*)</span></label>
					<input class="form-control" value="" id="nombreTest" type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="paternoVicti">Paterno: <span class="aste">(*)</span></label>
					<input class="form-control" value="" id="paternoTest" type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="maternoVicti">Materno: <span class="aste">(*)</span></label>
					<input class="form-control" value="" id="maternoTest" type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="maternoVicti">Estado Actual <span class="aste">(*)</span></label>
					<select class="form-control" id="estadoTest">
						<option value="0">Seleccione</option>
						<option class="fontBold" value="1">Vigente</option>
						<option class="fontBold" value="2">Concluida</option>
					</select>
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<div class="form-group purple-border">
						<label for="exampleFormControlTextarea4">Observaciones: </label>
						<textarea class="form-control" style="min-width: 100%" id="observacionesTest" rows="3"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<button type="button" class="btn btn-primary" onclick="addTestigo(<? echo $idMedida; ?>, <? echo $idEnlace; ?>)">Agregar Testigo</button>
				</div>
			</div><br>

			<? $getDataTestigos = getDataTestigos($connMedidas, $idMedida);
			$countTestigos = sizeof($getDataTestigos);
			if (sizeof($getDataTestigos) > 0) {
				if ($rolUser != 1) { ?>
				<? } ?>

				<label>Testigos(s)</label>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-12">

						<div id="contenidoTablaTestigos">
							<table class="table table-bordered">
								<thead>
									<tr class="cabeceraTablaVictimas">
										<th>#</th>
										<th>Nombre</th>
										<th>Paterno</th>
										<th>Materno</th>
										<th>Causa Penal</th>
										<th>Estado Actual Medida</th>
										<th>Observaciones</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody id="contentTableDataTestigos">
									<? for ($h = 0; $h < sizeof($getDataTestigos); $h++) { ?>
										<tr>
											<td><? echo $h + 1 ?></td>
											<td><? echo $getDataTestigos[$h][4]; ?></td>
											<td><? echo $getDataTestigos[$h][5]; ?></td>
											<td><? echo $getDataTestigos[$h][6]; ?></td>
											<td><? echo $getDataTestigos[$h][3]; ?></td>
											<td><label style="font-weight: bold !important;"><? echo $getDataTestigos[$h][7]; ?></label></td>
											<td><? echo $getDataTestigos[$h][8]; ?></td>
											<td>
												<center><span onclick="deleteTestigo(<? echo  $getDataTestigos[$h][0]; ?>, <? echo $idMedida; ?>,<? echo $idEnlace; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center>
											</td>
										</tr>
									<? } ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>
			<? } ?>

			<? if ($rolUser == 3 || $rolUser == 1 || $rolUser == 4) { ?>
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Medidas de protección TESTIGO</strong></h5>
						<div class="row">
							<div class="col-xs-12 col-sm-6  col-md-6">
								<img <? if ($a == 1 && in_array(1, $aplicadasTest)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 01 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 01 Gris.png" onmouseover="hoverIMG(this, 'uno');" onmouseout="unhoverIMG(this, 'uno')" <? if ($a == 1 && $rolUser != 1) { ?> onclick="aplicarMedidaTestigo(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 1, <? echo $get_nuc; ?>,<? echo $countTestigos; ?>)" <? } } ?> class="cursorp" width="100%">
							</div>
							<div class="col-xs-12 col-sm-6  col-md-6">
								<img <? if ($a == 1 && in_array(2, $aplicadasTest)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 02 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 02 Gris.png" onmouseover="hoverIMG(this, 'dos');" onmouseout="unhoverIMG(this, 'dos')" <? if ($a == 1 && $rolUser != 1) { ?> onclick="aplicarMedidaTestigo(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 2, <? echo $get_nuc; ?>,<? echo $countTestigos; ?>)" <? } } ?> class="cursorp" width="100%">
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-12 col-sm-6  col-md-6">
								<img <? if ($a == 1 && in_array(3, $aplicadasTest)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 03 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 03 Gris.png" onmouseover="hoverIMG(this, 'tres');" onmouseout="unhoverIMG(this, 'tres')" <? if ($a == 1 && $rolUser != 1) { ?> onclick="aplicarMedidaTestigo(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 3, <? echo $get_nuc; ?>,<? echo $countTestigos; ?>)" <? } } ?> class="cursorp" width="100%">
							</div>
							<div class="col-xs-12 col-sm-6  col-md-6">
								<img <? if ($a == 1 && in_array(4, $aplicadasTest)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 04 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 04 Gris.png" onmouseover="hoverIMG(this, 'cuatro');" onmouseout="unhoverIMG(this, 'cuatro')" <? if ($a == 1 && $rolUser != 1) { ?> onclick="aplicarMedidaTestigo(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 4, <? echo $get_nuc; ?>,<? echo $countTestigos; ?>)" <? } } ?> class="cursorp" width="100%">
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-12 col-sm-6  col-md-6">
								<img <? if ($a == 1 && in_array(5, $aplicadasTest)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 05 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 05 Gris.png" onmouseover="hoverIMG(this, 'cinco');" onmouseout="unhoverIMG(this, 'cinco')" <? if ($a == 1 && $rolUser != 1) { ?> onclick="aplicarMedidaTestigo(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 5, <? echo $get_nuc; ?>,<? echo $countTestigos; ?>)" <? } } ?> class="cursorp" width="100%">
							</div>
							<div class="col-xs-12 col-sm-6  col-md-6">
								<img <? if ($a == 1 && in_array(6, $aplicadasTest)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 06 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 06 Gris.png" onmouseover="hoverIMG(this, 'seis');" onmouseout="unhoverIMG(this, 'seis')" <? if ($a == 1 && $rolUser != 1) { ?> onclick="aplicarMedidaTestigo(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 6, <? echo $get_nuc; ?>,<? echo $countTestigos; ?>)" <? } } ?> class="cursorp" width="100%">
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-12 col-sm-6  col-md-6">
								<img <? if ($a == 1 && in_array(7, $aplicadasTest)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 07 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 07 Gris.png" onmouseover="hoverIMG(this, 'siete');" onmouseout="unhoverIMG(this, 'siete')" <? if ($a == 1 && $rolUser != 1) { ?> onclick="aplicarMedidaTestigo(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 7, <? echo $get_nuc; ?>,<? echo $countTestigos; ?>)" <? } } ?> class="cursorp" width="100%">
							</div>
							<div class="col-xs-12 col-sm-6  col-md-6">
								<img <? if ($a == 1 && in_array(8, $aplicadasTest)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 08 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 08 Gris.png" onmouseover="hoverIMG(this, 'ocho');" onmouseout="unhoverIMG(this, 'ocho')" <? if ($a == 1  && $rolUser != 1) { ?> onclick="aplicarMedidaTestigo(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 8, <? echo $get_nuc; ?>,<? echo $countTestigos; ?>)" <? } } ?> class="cursorp" width="100%">
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-12 col-sm-6  col-md-6">
								<img <? if ($a == 1 && in_array(9, $aplicadasTest)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 09 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 09 Gris.png" onmouseover="hoverIMG(this, 'nueve');" onmouseout="unhoverIMG(this, 'nueve')" <? if ($a == 1 && $rolUser != 1) { ?> onclick="aplicarMedidaTestigo(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 9, <? echo $get_nuc; ?>,<? echo $countTestigos; ?>)" <? } } ?> class="cursorp" width="100%">
							</div>
							<div class="col-xs-12 col-sm-6  col-md-6">
								<img <? if ($a == 1 && in_array(10, $aplicadasTest)) { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 10 Fondo.png" <? } else { ?> src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas 10 Gris.png" onmouseover="hoverIMG(this, 'diez');" onmouseout="unhoverIMG(this, 'diez')" <?  if ($a == 1 && $rolUser != 1) { ?> onclick="aplicarMedidaTestigo(<? echo $idEnlace; ?>, <? echo $idMedida; ?>, 10, <? echo $get_nuc; ?>,<? echo $countTestigos; ?>)" <? }	} ?> class="cursorp" width="100%">
							</div>
						</div><br>
					</div>
				</div>
			<? } ?>




		</div>
	</div>
	<!--DATOS DE LA VICTIMA-->




	<div class="modal-footer row">
		<?php 
			if ($rolUser == 1) { ?>
				<div class="text-start col-sm-1">
					<button class="btn btn-danger" onclick="deleteMedida(<?= $idMedida ?>, <?= $idEnlace ?>, <?= $rolUser ?>)">Borrar Medida de Protección</button>
				</div>
			<?php } 
		?>	
		<button type="button" class="btn btn-default"  onclick="closeModalMDP(<? echo $anioActual; ?>, <? echo $idEnlace; ?>, 0, <? echo $rolUser; ?>, <?= $get_idCoorporacion ?> )">Cerrar</button>
		<!-- data-dismiss="modal" Se eliminó temporal Botón cerrar -->
		<? if ( ($rolUser == 2 && $idMedida == 0) || ($rolUser == 4 && $idMedida == 0 ) ) { ?>
			<button type="button" class="btn btn-primary" onclick="modalDatosMedidaCapturista(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 10, <? echo $idMedida; ?>,0, <? echo $rolUser; ?>)">Guardar información</button>
		<? } elseif ( ($rolUser == 2  && $idMedida != 0) || ($rolUser == 4  && $idMedida != 0) ) { ?>			
			<button type="button" class="btn btn-primary" onclick="actualizarDatosCarpeta(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 10, <? echo $idMedida; ?>, <? echo $rolUser; ?>)">Actualizar información</button>
		<? } elseif ($rolUser == 1) { ?>
			<button type="button" class="btn btn-primary" onclick="asignar_medida_mp(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 10, <? echo $idMedida; ?>)">Asignar a Ministerio Publico</button>
		<? } ?>
	</div>