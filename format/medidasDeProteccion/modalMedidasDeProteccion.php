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

$idVictima = isset($_POST['idVictima']) ? $_POST['idVictima'] : null;
$idTestigo = isset($_POST['idTestigo']) ? $_POST['idTestigo'] : null;

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
		$get_idFiscaliaProcedencia = $medidaData[0][7];
		$get_estatus = $medidaData[0][8];
		$get_idCoorporacion = $medidaData[0][9];
		$a = 1;
		
		$getDataVictimas = getDataVictimas($connMedidas, $idMedida);
		$getDataTestigos = getDataTestigos($connMedidas, $idMedida);


		if ($idVictima == 'undefined') {
			$idVictima = $getDataVictimas[0][0];
		}

		if ($idTestigo == 'undefined') {
			$idTestigo = $getDataTestigos[0][0];
		}

		if ($idVictima != null) {
			$getRegistroVictima = getRegistro($connMedidas, $idVictima);		
			// $fechaAcuerdo = $getRegistroVictima['fechaAcuerdo']->format('Y-m-d\TH:i');
			$getMedidasAplicadas = getMedidasAplicadas($connMedidas, $idVictima);
			$aplicadas = array();

			for ($h = 0; $h < sizeof($getMedidasAplicadas); $h++) {
				$aplicadas[$h] = $getMedidasAplicadas[$h][0];
			}
			$noVictima = sizeof($getDataVictimas);
		}
		else {
			$noVictima = 0;
		}

		if ($idTestigo != null) {
			$getRegistroTestigo = getRegistro($connMedidas, $idTestigo);
			$getMedidasAplicadasTest = getMedidasAplicadas($connMedidas, $idTestigo);
			$aplicadasTest = array();
			for ($e = 0; $e < sizeof($getMedidasAplicadasTest); $e++) {
				$aplicadasTest[$e] = $getMedidasAplicadasTest[$e][0];
			}
			$noTestigo = sizeof($getDataTestigos);
		}
		else {
			$noTestigo = 0;
		}
	} else {
		$a = 0;
		$noVictima = 0;
		$noTestigo = 0;
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
					<div class="col-xs-12 col-md-3">
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
						<div class="col-xs-12 col-sm-12  col-md-3">
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
					<label for="idDelito">Delito: <span class="aste">(*)</span></label>
					<div id="idDelito_div">
						<select 
							class="dataAutocomplet form-control browser-default custom-select" 
							id="idDelito" 
							onchange="validateMedidaVictima('idDelito_div')" 
							<? if ($rolUser == 1 || $rolUser == 3) { ?> disabled <? } ?>>
							<option value="">Seleccione</option>
								<? $delitos = dataDelitosSicap($conSic);
								for ($h = 0; $h < sizeof($delitos); $h++) {
									$idDelito = $delitos[$h][0];
									$delito = $delitos[$h][1]; ?>
									<option class="fontBold" value="<? echo $idDelito; ?>" <? if ($a == 1 && $idDelito == $get_idDelito) { ?> selected <? } ?>><? echo $delito; ?>
							</option>
								<? } ?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--DATOS GENERALES-->
	<!--DATOS DE LA VICTIMA-->
	<div class="panel panel-default fd1" id="datosVictima">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos de la víctima</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="nOficio">Número de oficio: <span class="aste">(*)</span></label>
					<input class="form-control" id="nOficio" type="text"
						value="<? if ($noVictima > 0) {
							echo $getRegistroVictima['nOficio'];
						} ?>"
					>
				</div>			
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="fechaAcuerdo">Fecha del acuerdo: <span class="aste">(*)</span></label>
					<input 
						id="fechaAcuerdo" 
						type="datetime-local" 
						value="<? if ($noVictima > 0) {
							echo $getRegistroVictima['fechaAcuerdo']->format('Y-m-d\TH:i');
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
				<?if($rolUser == 4){ ?>
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="fechaConclusion">Fecha de conclusión: <span class="aste">(*)</span></label>
					<input 
						id="fechaConclu" 
						type="datetime-local" 
						value="<? if ($noVictima > 0) {
								echo $getRegistroVictima['fechaConclusion']->format('Y-m-d\TH:i');
							} ?>"
						name="fechaConclu" 
						onchange="
							validateMedidaOK(this.id)
							validarFechaConclusion(this.id)" 
						onclick="createOptionsDate('fechaAcuerdo', 'fechaConclu')"
						class="fechas form-control gehit" />
				</div>
				<? } ?>					
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="fechaRegistro">Fecha de registro:</label>
					<input 
						class="form-control"						
						id="fechaRegistro" 
						value="<? if ($noVictima > 0) {
							echo $getRegistroVictima['fechaRegistro']->format('Y-m-d\TH:i');
							}
							else {
								echo $fecha;
							} ?>" 
						type="datetime-local" 
						readonly><br>
				</div>							
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
							<option class="fontBold" value="<?= $valor ?>"><? echo $i; ?> Meses</option>
						<? $valor--;
						}
						for ($i = 1; $i <= 100; $i++) {	?>
							<option class="fontBold" value="<?= $i ?>"><? echo $i; ?> Años</option>
						<? } ?>
					</select>
				</div>			
			</div><br>
			<? 
			if ($a == 1 && sizeof($getDataVictimas) > 0) {
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
									$dataCompleted = checkDataContactoCompleted($connMedidas, $getDataVictimas[$h][0], 1);
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
											<center><span onclick="modalDatosMedidaCapturistaInvolucrado(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 0, <? echo $idMedida; ?>, 'victima', <?= $rolUser ?>, '<?= $get_idDelito ?>', <?= $getDataVictimas[$h][0] ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center>
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
		<div id="medidas_seleccionadas">
			<?php
			if ($noVictima > 0 && sizeof($getMedidasAplicadas) > 0) {
				for ($i = 1; $i <= 10; $i++) {
					if(in_array($i, $aplicadas)){ ?>
						<input type="hidden" id="medidaSeleccionada' + <?= $i; ?>'" class="inputMedidaHidden" name="medidaSeleccionada'+ <?= $i; ?> +'" value="<?= $i; ?>"> <?php
					}
				}
			}				
			?>
		</div>
		<div class="panel panel-default fd1" id="medidasProteccionVictima">			
			<div class="panel-body">
				<h5 class="text-on-pannel"><strong>Medidas de protección VICTIMA</strong></h5>
				<div class="col-md-12">
					<?php
					if ($a == 1 && sizeof($getDataVictimas) > 0 ) { ?>
						<div class="col-sm-12 col-md-4">
							<label for="idVictima">Víctima(s)</label>
							<select class="form-control" id="idVictima"
								onchange="reloadModalMDP(<?= $tipoModal ?>, <?= $idEnlace ?>, <?= $idMedida ?>, <?= $typeArch ?>, <?= $typeCheck ?>, this.value, <?= $idTestigo ?> )">
								<?php
								foreach ($getDataVictimas as $victima) { ?>
									<option 
										value="<?= $victima[0] ?>"
										<?php
										if ($victima[0] == $idVictima) { 
											echo 'selected';
										} ?>									
										> <?= $victima[7] ?> 
									</option>
								<? } ?>
							</select>
						</div>
					<? }?>
				</div>				
				<div id="panelMedidasProteccion">
					<?php 
					$numeros = ['uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez'];
					for ($i = 1; $i <= 10 ; $i++) :
						if ($i % 2 != 0) { ?>
						<div class="row"> <?php } ?>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<img
									src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?> <?= ($a == 1 && in_array($i, $aplicadas)) ? 'Fondo' : 'Gris' ?>.png"
									onmouseover="hoverIMG(this, '<?= $numeros[$i - 1] ?>')"
									onmouseout="										
										if(!consultarInputHidden().includes('<?= $i ?>')){
											unhoverIMG(this, '<?= $numeros[$i - 1] ?>');
										}
									"
									<?php
									if ($a == 1 && sizeof($getDataVictimas) > 0 && $rolUser != 1) { ?>
										onclick="
											total = consultarInputHidden().length;
											if (consultarInputHidden().includes('<?= $i ?>')) {
												aplicarMedida(<?= $idVictima ?>, <?= $idEnlace ?>, <?= $idMedida ?>, <?= $i ?>, <?= $get_nuc ?>, 'delete', total, 1)
											} else {
												aplicarMedida(<?= $idVictima ?>, <?= $idEnlace ?>, <?= $idMedida ?>, <?= $i ?>, <?= $get_nuc ?>, 'add', total, 1)
											}
										" <?										
									}
									else {
										if ($rolUser != 1 && $rolUser != 4) { ?>
											onclick="modalDatosMedida(<?= $tipoModal ?>, <?= $idEnlace ?>,<?= $b ?>, <?= $i ?>, <?= $idMedida ?>)" <?
										}
										elseif($rolUser == 4) { ?>
											onclick="
												if(consultarInputHidden().includes('<?= $i ?>')) {
													quitarMedida(this, <?= $i; ?>, '<?= $numeros[$i - 1] ?>');
												}
												else {
													agregarMedida(this, <?= $i; ?>, '<?= $numeros[$i - 1] ?>');
												}
											" <?
										}
									}
									?>
									class="cursorp"
									width="100%"
								>
							</div>
						<?php 
						if ($i % 2 == 0) { ?>
						</div> <br>
						<?php } ?>
					<? endfor; ?>
				</div>
			</div>
		</div>
	<? } ?>
	<? $getDataTestigos = getDataTestigos($connMedidas, $idMedida); 
				if (sizeof($getDataTestigos) > 0){ $banT = 1;}else{$banT = 0;}
	?>																			
	<hr>
	<div class="form-check">
	<input class="form-check-input"<? if($banT == 1){echo "checked"; } ?> <? if($banT == 1){ echo "disabled"; } ?> onchange="toggleCheckboxTestigo(this)" type="checkbox" value="" id="flexCheckDefault" <?php if ($idMedida == 0) { ?> disabled <? } ?>>
  
  
  <label class="form-check-label" for="flexCheckChecked">¡La medida de Proteccion cuenta con Testigos!</label>
</div><br>
	<!--DATOS DE LA VICTIMA-->
	<div id="panelDeTestigos" <? if($banT == 1){?> style="display:block; " <? }else{ ?>  style="display:none;"   <? } ?>class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos de Testigo en Riesgo</strong></h5>

			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="nOficioTestigo">Número de oficio: <span class="aste">(*)</span></label>
					<input class="form-control" id="nOficioTestigo" type="text" onchange=""
						value="<? if (sizeof($getDataTestigos) > 0) {
							echo $getRegistroTestigo['nOficio'];
						} ?>"
					>
				</div>			
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="fechaAcuerdoTestigo">Fecha del acuerdo: <span class="aste">(*)</span></label>
					<input 
						id="fechaAcuerdoTestigo" 
						type="datetime-local" 
						value="<? if ($noTestigo > 0) {
							echo $getRegistroTestigo['fechaAcuerdo']->format('Y-m-d\TH:i');
						} ?>" 
						onchange="
							validateMedidaOK(this.id), 
							checkDateAcuerdo('<? echo $fecha ?>') " 						
						name="fechaAcuerdoTestigo" 
						class="fechas form-control gehit" 
						min="<? echo $anioActual; ?>-<? echo $m; ?>-01T00:00:00" 
						max="<? echo $hoy; ?>T23:59:59" 
						<? if ($rolUser == 1 || $rolUser == 3) { ?> disabled <? } ?> />
				</div>
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="fechaConclusionTestigo">Fecha de conclusión: <span class="aste">(*)</span></label>
					<input 
						id="fechaConclusionTestigo" 
						type="datetime-local" 
						value="<? if ($noTestigo > 0) {
								echo $getRegistroTestigo['fechaConclusion']->format('Y-m-d\TH:i');
							} ?>"
						name="fechaConclusionTestigo" 
						onchange="
							validateMedidaOK(this.id)
							validarFechaConclusion(this.id)" 
						onclick="createOptionsDate('fechaAcuerdoTestigo', 'fechaConclusionTestigo')"
						class="fechas form-control gehit" />
				</div>				
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="fechaRegistroTestigo">Fecha de registro:</label>
					<input 
						class="form-control"						
						id="fechaRegistroTestigo" 
						value="<? if ($noTestigo > 0) {
							echo $getRegistroTestigo['fechaRegistro']->format('Y-m-d\TH:i');
							}
							else {
								echo $fecha;
							} ?>" 
						type="datetime-local" 
						readonly><br>
				</div>							
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="nombreVicti">Causa:</label>
					<input 
						class="form-control" 
						<?php if ($bandCausa == 1) {
							echo "disabled";
						} ?> 
						value="<?php echo $causaP; ?>" 
						id="causaTest" 
						type="text"
						onchange="validateMedidaOK(this.id)">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="nombreVicti">Nombre (s): <span class="aste">(*)</span></label>
					<input class="form-control" value="" id="nombreTest" type="text" onchange="validateMedidaOK(this.id)">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="paternoVicti">Paterno: <span class="aste">(*)</span></label>
					<input class="form-control" value="" id="paternoTest" type="text" onchange="validateMedidaOK(this.id)">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="maternoVicti">Materno: <span class="aste">(*)</span></label>
					<input class="form-control" value="" id="maternoTest" type="text" onchange="validateMedidaOK(this.id)">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="maternoVicti">Estado Actual <span class="aste">(*)</span></label>
					<select class="form-control" id="estadoTest" onchange="validateMedidaOK(this.id)">
						<option value="">Seleccione</option>
						<option class="fontBold" value="1">Vigente</option>
						<option class="fontBold" value="2">Concluida</option>
					</select>
				</div>
				<div class="col-xs-12 col-sm-12  col-md-1">
					<label for="generoVicti">Género: <span class="aste">(*)</span></label>
					<select class="form-control" id="generoTest" onchange="validateMedidaOK(this.id)">
						<option value="">Seleccione</option>
						<option class="fontBold" value="1">Masculino</option>
						<option class="fontBold" value="2">Femenino</option>
					</select>
				</div>
				<div class="col-xs-12 col-sm-12  col-md-1">
					<label for="edadVictima">Edad: <span class="aste">(*)</span></label>
					<select class="form-control" id="edadTest" onchange="validateMedidaOK(this.id)">
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
										<th>Editar información</th>
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
												<center><span onclick="modalDatosMedidaCapturistaInvolucrado(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 0, <? echo $idMedida; ?>, 'testigo', '', '<?= $get_idDelito ?>', <?= $getDataTestigos[$h][0] ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center>												
											</td>
											<td>
												<center><span onclick="deleteTestigo(<? echo  $getDataTestigos[$h][0]; ?>, <? echo $idMedida; ?>,<? echo $idEnlace; ?>, 1)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center>
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
						<div class="col-md-12">
							<?php
							if ($a == 1 && sizeof($getDataTestigos) > 0 ) { ?>
								<div class="col-sm-12 col-md-4">
									<label for="idTestigo">Testigo(s)</label>
									<select class="form-control" id="idTestigo"
										onchange="reloadModalMDP(<?= $tipoModal ?>, <?= $idEnlace ?>, <?= $idMedida ?>, <?= $typeArch ?>, <?= $typeCheck ?>, <?= $idVictima ?>,  this.value)">
										<?php
										foreach ($getDataTestigos as $testigo) { ?>
											<option 
												value="<?= $testigo[0] ?>"
												<?php
												if ($testigo[0] == $idTestigo) { 
													echo 'selected';
												} ?>
												> <?= $testigo[11] ?> 
											</option>
										<? } ?>
									</select>
								</div>
							<? }?>
						</div>							
						<div id="panelMedidasProteccionTestigo">							
							<?php
							for ($i = 1; $i <= 10; $i++) :
								if ($i % 2 != 0) { ?>
								<div class="row"> <?php } ?>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<img
											src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?> <?= ($a == 1 && $noTestigo > 0 && in_array($i, $aplicadasTest)) ? 'Fondo' : 'Gris' ?>.png"
											onmouseover="hoverIMG(this, '<?= $numeros[$i - 1] ?>')"
											<?php
											if ($noTestigo == 0 || !in_array($i, $aplicadasTest)) { ?>
												onmouseout="unhoverIMG(this, '<?= $numeros[$i - 1] ?>')"
											<? } ?>											
											<?php
											if ($a == 1 && sizeof($getDataTestigos) > 0 && $rolUser != 1) { 
												$action = (in_array($i, $aplicadasTest)) ? 'delete' : 'add'; 
												$total = sizeof($aplicadasTest); ?>
												onclick="aplicarMedida(<?= $idTestigo ?>, <? echo $idEnlace; ?>, <? echo $idMedida; ?>, <?= $i ?>, <? echo $get_nuc; ?>, '<?= $action ?>', <?= $total ?>, 2)"
											<? } ?>
											class="cursorp"
											width="100%"
										>
									</div>
								<?php 
								if ($i % 2 == 0) { ?>
									</div> <br>
								<?php } ?>
							<? endfor; ?>
						</div>						
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
			<button type="button" class="btn btn-primary" onclick="actualizarDatosCarpeta(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 10, <? echo $idMedida; ?>, <? echo $rolUser; ?>, '<?= $get_idDelito ?>')">Actualizar información</button>
		<? } elseif ($rolUser == 1) { ?>
			<button type="button" class="btn btn-primary" onclick="asignar_medida_mp(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $b; ?>, 10, <? echo $idMedida; ?>)">Asignar a Ministerio Publico</button>
		<? } ?>
	</div>