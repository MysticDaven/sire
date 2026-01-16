<?php
include ("../../Conexiones/Conexion.php");
include ("../../Conexiones/conexionMedidas.php");
include ("../../Conexiones/conexionSicap.php");
include("../../funcionesMedidasProteccion.php");	
$fecha_actual=date("d/m/Y");
$fecha=strftime( "%Y-%m-%d %H:%M:%S", time() );
$fecha_input = date("Y-m-d\TH:i", strtotime($fecha));

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["fraccion"])){ $fraccion = $_POST["fraccion"]; }
if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }

if (isset($_POST["tipoModal"])){ $tipoModal = $_POST["tipoModal"]; }

$medidaVictima = isset($_POST['medidaVictima']) ? $_POST['medidaVictima'] : null;
$idInvolucrado = isset($_POST['idInvolucrado']) ? $_POST['idInvolucrado'] : null;

$getRolUser = getRolUser($connMedidas, $idEnlace);
$rolUser = $getRolUser[0][0];

if (isset($_POST["idMedida"])){
	$idMedida = $_POST["idMedida"]; 
	if ($idMedida != 0) {
  		$idMedida = $_POST["idMedida"]; 
		$getDataMedida = get_data_medida($connMedidas, $idMedida);
		$a = 1;
	}else{
		$a = 0;
		$idMedida = 0; 
	}

	$getDataVictimas = getDataVictimas($connMedidas, $idMedida);
	$idVictima = $getDataVictimas[0][0];
	$getDataTestigo = getDataTestigos($connMedidas, $idMedida);
	$idTestigo = $getDataTestigo[0][0];
	$getInvolucrados = getDataInvolucrados($connMedidas, $idMedida);
	$idInvolucrado = $getInvolucrados[0][0];
}

?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Registro de Medida de Protección</label></center>
</div>
<div class="modal-body">
	<div class="row">
		<!--MENU DE OPCIONES ASIGNADO A ROLES-->
		<?if($rolUser == 1){
			//Menu Coordinador
			include('templates/template_menuCoordinador.php');
		}elseif($rolUser == 3 || $rolUser == 4){
			//Menu ministerio publico
			include('templates/template_menuMP.php');
		}elseif($rolUser == 2){
			//Menu capturista
			include('templates/template_menuCapturista.php');
		} ?><!--TERMINA MENU DE OPCIONES ASIGNADO A ROLES-->
		<div class="col-xs-12 col-sm-12 col-md-9">
			<!--DATOS GENERALES NUC Y CUADERNO DE ANTECEDENTES-->
			<div class="sectionData" id="datosGenerales">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Datos Generales</strong></h5>
						<div id="contDataCuadernoAntecedentes">
						<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
								 <button type="button" class="btn btn-primary btn-lg" onclick="saveDatosGenerales(<?php echo $idEnlace; ?> , <?php echo $fraccion; ?>, <?echo $idMedida ?> , '<?echo $nuc ?>')">Guardar información </button>
							 </div>
					 </div><br>
						<div class="row">
							<div class="col-xs-12 col-sm-12  col-md-4">
								<label for="nuc">NUC: </label>
								<input class="form-control" value="<? echo $nuc; ?>"  id="nuc"  type="text" disabled>
							</div>
								<div class="col-xs-12 col-sm-12  col-md-4">
									<label for="numAntecedentes">CUADERNO DE ANTECEDENTES: <span class="aste">(*)</span></label>
									<input class="form-control" <?if($fraccion == 1 || $fraccion == 2 || $fraccion == 3){?> disabled <? } ?> value="<?= $getDataMedida[0][10] ?>"  id="numAntecedentes"  type="text">
								</div>								
							</div>
						</div><br>
					</div>
			 </div>
			</div>
			<!--DATOS GENERALES NUC Y CUADERNO DE ANTECEDENTES-->
			<!--DATOS RESOLUCIÓN-->
			<div class="sectionData" id="resolucion">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Resolución</strong></h5>
						<?php
						$registro = getRegistro($connMedidas, $idInvolucrado);
						$fechaConclusion = '';
						$getMedidasAplicadas = getMedidasAplicadas($connMedidas, $idVictima);
						if($getMedidasAplicadas > 0){
							for ($h = 0; $h < sizeof($getMedidasAplicadas); $h++) {
								$aplicadas[$h] = $getMedidasAplicadas[$h][0];
							}
						}
						?>
						<div id="contDataResoluciones">
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">	
									<button 
										type="button" <?if($rolUser != 3 && $rolUser != 4){ ?> disabled <? } ?> 
										class="btn btn-primary btn-lg" 
										onclick="											
											saveDatosResoluciones(<?php echo $idEnlace; ?> , <?echo $idMedida ?>, '<?= $fechaConclusion; ?>', <?= json_encode($aplicadas); ?>, <?= $nuc ?>, <?= '' ?>)
										">Guardar información
									</button>
								</div>
							</div><br>
							<div>
								<div class="column" style="margin-bottom: 30px;">
									<button type="button" class="btn btn-secundary btn-lg" onclick="resolucionesDiv(<?php echo 1; ?>)">Ratificación</button>
									<button type="button" class="btn btn-secundary btn-lg" onclick="resolucionesDiv(<?php echo 2; ?>)">Modificada</button>
									<button type="button" class="btn btn-secundary btn-lg" onclick="resolucionesDiv(<?php echo 3; ?>)">Ampliada</button>
									<button type="button" class="btn btn-secundary btn-lg" onclick="resolucionesDiv(<?php echo 4; ?>)">Revocada</button>
								</div>
								<div class="col-md-12 pd-4">
									<?php
									if (sizeof($getInvolucrados) > 0 ) { ?>
										<div class="col-sm-12 col-md-6">
											<label for="idInvolucrado">Involucrado(s)</label>
											<select class="form-control" id="idInvolucrado"
												onchange="loadResoluciones(this.value, <?= $idMedida ?>, <?= $idEnlace ?>)">
												<?php
												foreach ($getInvolucrados as $involucrado) { ?>
													<option
														value="<?= $involucrado[0] ?>"
														<?php
														if ($involucrado[0] == $idInvolucrado) { 
															echo 'selected';
														} ?>									
														> <?echo $involucrado[2]; if ($involucrado[1] == 1) { echo ' (Víctima)'; } else { echo ' (testigo) '; } ?> 
													</option>
												<? } ?>
											</select>
										</div>
									<? }?>								
								</div>								
								<div id="contResoluciones">
									<div class="sectionData" id="divRatificada">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-2">
												<label for="ratificacion">Ratificación: <span class="aste">(*)</span></label>
												<select class="form-control" id="ratificacion">
													<option value="">Seleccione</option>
													<option class="fontBold" value="1">Sí</option>
													<option class="fontBold" value="0">No</option>
												</select>
											</div>

											<div class="col-xs-12 col-sm-12 col-md-4">
												<label for="observacionRatifica">Observación: <span class="aste">(*)</span></label>
												<input class="form-control" id="observacionRatifica" type="text" value="">
											</div>
										</div>								
										<?php 
										$getRatificada = getRatificada($connMedidas, $idInvolucrado);
										if (sizeof($getRatificada) > 0) { ?>
											<div class="row" style="margin-top: 20px;">
												<div class="col-xs-12">
													<div class="panel panel-default fd1">
														<div class="panel-body">
															<h5 class="text-on-pannel"><strong>Valores previos</strong></h5>
															<table class="table table-bordered">
																<thead>
																	<tr class="cabeceraTablaVictimas">
																		<th>#</th>
																		<th>Medida Ratificada</th>
																		<th>Observaciones</th>
																		<th>Eliminar</th>
																	</tr>
																</thead>
																<tbody>
																	<?php for ($i = 0; $i < sizeof($getRatificada); $i++) { ?>
																		<tr>
																			<td><?php echo $i + 1; ?></td>
																			<td>Sí</td>
																			<td><?php echo $getRatificada[$i]['observacion']; ?></td>
																			<td class="text-center">
																				<span 
																					onclick="deleteResolucion(<?= $getRatificada[$i]['idResolucion'] ?>, <?= $idMedida ?>, <?= $idEnlace ?>, 1)"
																					title="Eliminar" 
																					style="cursor: pointer; color: red; font-size: 18px;" 
																					class="glyphicon glyphicon-trash">
																				</span>
																			</td>
																		</tr>
																	<?php } ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
									<div class="sectionData" id="divModificada">
										<div class="row" style="margin-bottom: 30px;">
											<div class="col-xs-12 col-sm-12 col-md-2">
												<label for="modifica">Modificada: <span class="aste">(*)</span></label>
												<select class="form-control" id="modifica">
													<option value="">Seleccione</option>
													<option class="fontBold" value="1">Si</option>
													<option class="fontBold" value="0">No</option>
												</select>
											</div>
											<div class="col-sm-12 col-md-3">
												<label for="nOficioModificada">Número de oficio: <span class="aste">(*)</span></label>
												<input class="form-control" id="nOficioModificada" type="text"
													value=""
												>											
											</div>										
											<div class="col-xs-12 col-sm-12  col-md-3">
												<label for="temporalidadResMod">Temporalidad: <span class="aste">(*)</span></label>
												<select class="form-control" id="temporalidadResMod" onchange="updateConclusion(this.value, 'Modificada');">
													<option value="">Seleccione</option>
													<?php for ($i=1; $i<=90; $i++){ ?>
														<option class="fontBold" value="<?php echo $i; ?>"><?php echo $i;?> días</option>
													<?php } ?>
												</select>											
											</div>											
											<div class="col-xs-12 col-sm-12 col-md-4">
												<label for="observacionModifica">Observación: </label>
												<input class="form-control" value="" id="observacionModifica" type="text">
											</div>
											<div class="col-xs-12 col-sm-12 col-md-3">
												<label for="fechaInicioModificadaN">Fecha de inicio: <span class="aste">(*)</span></label>
												<input 
													id="fechaInicioModificadaN" 
													type="datetime-local" 
													value="<?= $registro['fechaAcuerdo']->format('Y-m-d\TH:i'); ?>"
													name="fechaResAmpliadaN" 
													onchange="
														validateMedidaOK(this.id);
														updateConclusion(document.getElementById('temporalidadResMod').value, 'Modificada');
													" 
													class="fechas form-control gehit" />
											</div>
											<div class="col-xs-12 col-sm-12 col-md-3">
												<label for="fechaConclusionModificadaN">Fecha de conclusión: <span class="aste">(*)</span></label>
												<input 
													id="fechaConclusionModificadaN" 
													type="datetime-local" 
													value="<?= $registro['fechaConclusion']->format('Y-m-d\TH:i'); ?>" 
													name="fechaConclusionModificadaN" 
													onchange="validateMedidaOK(this.id)" 
													class="fechas form-control gehit"
													disabled/>
											</div>										
											<div class="col-xs-12 col-sm-12 col-md-3">
												<label for="fechaInicioModificada">Fecha de inicio actual </label>
												<input 
													id="fechaInicioModificada" 
													type="datetime-local" 
													value="<?= $registro['fechaAcuerdo']->format('Y-m-d\TH:i'); ?>"
													name="fechaInicioModificada" 
													onchange="validateMedidaOK(this.id)" 
													class="fechas form-control gehit" 
													disabled/>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-3">
												<label for="fechaConclusionModificada">Fecha de conclusión actual </label>
												<input 
													id="fechaConclusionModificada" 
													type="datetime-local" 
													value="<?= $registro['fechaConclusion']->format('Y-m-d\TH:i'); ?>" 
													name="fechaConclusionModificada" 
													onchange="validateMedidaOK(this.id)" 
													class="fechas form-control gehit" 
													disabled/>
											</div>
										</div>
										<div class="panel panel-default fd1" >
											<div class="panel-body">
												<h5 class="text-on-pannel"><strong>Fracciones Actuales</strong></h5>
												<?php $getDataFracciones = modificarMedidasAplicadasInvolucrado($connMedidas, $idInvolucrado);
												if (sizeof($getDataFracciones) > 0) { $totalFraccAplicadas = sizeof($getDataFracciones); ?>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12">
														<table class="table table-bordered">
															<thead>
																<tr class="cabeceraTablaVictimas">
																	<th>#</th>
																	<th>Fracción</th>
																	<th>Acciones</th>
																</tr>
															</thead>
															<tbody>
																<?php for ($h = 0; $h < sizeof($getDataFracciones); $h++) { ?>
																<tr>
																	<td><?php echo $getDataFracciones[$h][2]; ?></td>
																	<td><?php echo $getDataFracciones[$h][1]; ?></td>
																	<td>
																		<center>
																		<span 
																			<?php if($rolUser == 3 || $rolUser == 4) { ?>
																			onclick="
																				ocultarDiv('contTableModifica');
																				modalMedidas(<?php echo $idEnlace; ?>, <?php echo $idMedida; ?>, <?php echo $nuc; ?>, <?= $medidaVictima ?>, <?= $idInvolucrado ?>, 'contModalMedidasModificada')" 
																			<?php } ?>
																			title="Editar" 
																			style="cursor: pointer; color: orange; font-size: 18px;" 
																			class="glyphicon glyphicon-edit">
																		</span>
																		</center>
																	</td>
																</tr>
																<?php } ?>
															</tbody>
														</table>
													</div>
												</div>
												<?php } ?>
											</div>
										</div>
										<div id="contTableModifica">
											<?php 
											$getModificada = getModificada($connMedidas, $idInvolucrado);
											if (sizeof($getModificada) > 0) { ?>
												<div class="row" style="margin-top: 20px;">
													<div class="col-xs-12">
														<div class="panel panel-default fd1">
															<div class="panel-body">
																<h5 class="text-on-pannel"><strong>Valores previos</strong></h5>
																<table class="table table-bordered">
																	<thead>
																		<tr class="cabeceraTablaVictimas">
																			<th>#</th>
																			<th>Medida Modificada</th>
																			<th>Observaciones</th>
																			<th>Fracciones Previas</th>
																			<th>Fracciones Actuales</th>
																			<th>Fecha de Conclusión Previa</th>
																			<th>Fecha de Conclusión Actual</th>
																			<th>Eliminar</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php for ($i = 0; $i < sizeof($getModificada); $i++) { ?>
																			<tr>
																				<td><?php echo $i + 1; ?></td>
																				<td>
																					<?php 
																					echo $getModificada[$i]['modificada'] == 1 ? 'SÍ' : 'NO'; 
																					?>
																				</td>
																				<td><?php echo $getModificada[$i]['observacion']; ?></td>
																				<td><?= $getModificada[$i]['fraccionesPrevias'] ?></td>
																				<td><?= $getModificada[$i]['fraccionesActuales'] ?></td>
																				<td>
																					<?php
																						$fecha = $getModificada[$i]['fechaPrevia'];
																						if($fecha instanceof DateTime){
																							echo $fecha -> format('d/m/Y H:i:s');
																						}
																						else{ echo 'ERROR'; }
																					?>
																				</td>
																				<td>
																					<?php
																						$fecha = $getModificada[$i]['fechaConclusion'];
																						if($fecha instanceof DateTime){
																							echo $fecha -> format('d/m/Y H:i:s');
																						}
																						else{ echo 'ERROR'; }
																					?>
																				</td>
																				<td class="text-center">
																					<span 
																						onclick="deleteResolucion(<?= $getModificada[$i]['idModificada'] ?>, <?= $idMedida ?>, <?= $idEnlace ?>, 'modificada')"
																						title="Eliminar" 
																						style="cursor: pointer; color: red; font-size: 18px;" 
																						class="glyphicon glyphicon-trash">
																					</span>
																				</td>
																			</tr>
																		<?php } ?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											<?php } ?>										
										</div>
										<div id="contModalMedidasModificada">																							
												
										</div>										
									</div>				
									<div class="sectionData" id="divAmpliada">
										<div class="row" style="margin-bottom: 30px;">
											<div class="col-xs-12 col-sm-12  col-md-2">
												<label for="ampliada">Ampliada: <span class="aste">(*)</span></label>
												<select class="form-control" id="ampliada" onchange="disabledItem('ampliada', 'temporalidadRes')">
													<option value="">Seleccione</option>
												<option class="fontBold" value="1">Si</option>
												<option class="fontBold" value="0">No</option>
												</select>
											</div>
											<div class="col-sm-12 col-md-3">
												<label for="nOficioAmpliada">Número de oficio: <span class="aste">(*)</span></label>
												<input class="form-control" id="nOficio" type="text"
													value=""
												>											
											</div>										
											<div class="col-xs-12 col-sm-12  col-md-3">
												<label for="temporalidadRes">Temporalidad: <span class="aste">(*)</span></label>
												<select class="form-control" id="temporalidadRes" onchange="updateConclusion(this.value, 'Ampliada');">
													<option value="">Seleccione</option>
													<?php for ($i=1; $i<=90; $i++){ ?>
														<option class="fontBold" value="<?php echo $i; ?>"><?php echo $i;?> días</option>
													<?php } ?>
												</select>											
											</div>
											<div class="col-xs-12 col-sm-12  col-md-4">
												<label for="observacionAmpliada">Observación: </label>
												<input class="form-control" value=""  id="observacionAmpliada"  type="text">
											</div>
											<div class="col-xs-12 col-sm-12 col-md-3">
												<label for="fechaInicioAmpliadaN">Fecha de inicio: <span class="aste">(*)</span></label>
												<input 
													id="fechaInicioAmpliadaN" 
													type="datetime-local" 
													value="<?= $registro['fechaAcuerdo']->format('Y-m-d\TH:i'); ?>"
													name="fechaResAmpliadaN" 
													onchange="
														validateMedidaOK(this.id);
														updateConclusion(document.getElementById('temporalidadRes').value, 'Ampliada');
													" 
													class="fechas form-control gehit" />
											</div>
											<div class="col-xs-12 col-sm-12 col-md-3">
												<label for="fechaConclusionAmpliadaN">Fecha de conclusión: <span class="aste">(*)</span></label>
												<input 
													id="fechaConclusionAmpliadaN" 
													type="datetime-local" 
													value="<?= $registro['fechaConclusion']->format('Y-m-d\TH:i'); ?>" 
													name="fechaConclusionAmpliadaN" 
													onchange="validateMedidaOK(this.id)" 
													class="fechas form-control gehit"
													disabled/>
											</div>										
											<div class="col-xs-12 col-sm-12 col-md-3">
												<label for="fechaInicioAmpliada">Fecha de inicio actual </label>
												<input 
													id="fechaInicioAmpliada" 
													type="datetime-local" 
													value="<?= $registro['fechaAcuerdo']->format('Y-m-d\TH:i'); ?>"
													name="fechaResAmpliada" 
													onchange="validateMedidaOK(this.id)" 
													class="fechas form-control gehit" 
													disabled/>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-3">
												<label for="fechaConclusionAmpliada">Fecha de conclusión actual </label>
												<input 
													id="fechaConclusionAmpliada" 
													type="datetime-local" 
													value="<?= $registro['fechaConclusion']->format('Y-m-d\TH:i'); ?>" 
													name="fechaConclusionAmpliada" 
													onchange="validateMedidaOK(this.id)" 
													class="fechas form-control gehit" 
													disabled/>
											</div>											
										</div>
										<div class="panel panel-default fd1 pt-4" >
											<div class="panel-body">
												<h5 class="text-on-pannel"><strong>Fracciones Actuales</strong></h5>
												<?php $getDataFracciones = modificarMedidasAplicadasInvolucrado($connMedidas, $idInvolucrado);
												if (sizeof($getDataFracciones) > 0) { $totalFraccAplicadas = sizeof($getDataFracciones); ?>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12">
														<table class="table table-bordered">
															<thead>
																<tr class="cabeceraTablaVictimas">
																	<th>#</th>
																	<th>Fracción</th>
																	<th>Acciones</th>
																</tr>
															</thead>
															<tbody>
																<?php for ($h = 0; $h < sizeof($getDataFracciones); $h++) { ?>
																<tr>
																	<td><?php echo $getDataFracciones[$h][2]; ?></td>
																	<td><?php echo $getDataFracciones[$h][1]; ?></td>
																	<td>
																		<center>
																		<span 
																			<?php if($rolUser == 3 || $rolUser == 4) { ?>
																			onclick="
																				ocultarDiv('contTableAmpliada');
																				modalMedidas(<?php echo $idEnlace; ?>, <?php echo $idMedida; ?>, <?php echo $nuc; ?>, <?= $medidaVictima ?>, <?= $idInvolucrado ?>, 'contModalMedidasAmpliada')" 
																			<?php } ?>
																			title="Editar" 
																			style="cursor: pointer; color: orange; font-size: 18px;" 
																			class="glyphicon glyphicon-edit">
																		</span>
																		</center>
																	</td>
																</tr>
																<?php } ?>
															</tbody>
														</table>
													</div>
												</div>
												<?php } ?>
											</div>
										</div>										
										<div id="contTableAmpliada">
										<?php 
										$getAmpliada = getAmpliada($connMedidas, $idInvolucrado);
										if (sizeof($getAmpliada) > 0) { ?>
											<div class="row" style="margin-top: 20px;">
												<div class="col-xs-12">
													<div class="panel panel-default fd1">
														<div class="panel-body">
															<h5 class="text-on-pannel"><strong>Valores previos</strong></h5>
															<table class="table table-bordered">
																<thead>
																	<tr class="cabeceraTablaVictimas">
																		<th>#</th>
																		<th>Medida Ampliada</th>
																		<th>Observaciones</th>
																		<th>Temporalidad Previa</th>
																		<th>Temporalidad Actual</th>
																		<th>Fecha de Conclusión Previa</th>
																		<th>Fecha de Conclusión Actual</th>
																		<th>Eliminar</th>
																	</tr>
																</thead>
																<tbody>
																	<?php for ($i = 0; $i < sizeof($getAmpliada); $i++) { ?>
																		<tr>
																			<td><?php echo $i + 1; ?></td>
																			<td>
																				<?php 
																				echo $getAmpliada[$i]['ampliacion'] == 1 ? 'SÍ' : 'NO'; 
																				?>
																			</td>
																			<td><?php echo $getAmpliada[$i]['observacion']; ?></td>
																			<td><?= $getAmpliada[$i]['temporalidadPrevia']; ?></td>
																			<td><?= $getAmpliada[$i]['temporalidadActual']; ?></td>
																			<td><?php
																					$fecha = $getAmpliada[$i]['fechaPrevia'];
																					if($fecha instanceof DateTime){
																						$fecha = $fecha -> format('d/m/Y H:i:s');
																						echo $fecha;
																					}
																					else{
																						echo "ERORR";
																					}
																				?>
																			</td>
																			<td>
																				<?php
																					$fecha = $getAmpliada[$i]['fechaConclusion'];
																					if($fecha instanceof DateTime){
																						$fecha = $fecha -> format('d/m/Y H:i:s');
																						echo $fecha;
																					}
																					else{
																						echo "ERORR";
																					}
																				?>
																			</td>
																			<td class="text-center">
																				<span
																					onclick="deleteResolucion(<?= $getAmpliada[$i]['idAmpliada'] ?>, <?= $idMedida ?>, <?= $idEnlace ?>, 'ampliada')"
																					title="Eliminar" 
																					style="cursor: pointer; color: red; font-size: 18px;" 
																					class="glyphicon glyphicon-trash">
																				</span>
																			</td>
																		</tr>
																	<?php } ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
										</div>
										<div id="contModalMedidasAmpliada">

										</div>
									</div>
									<div class="sectionData" id="divRevocada">
										<div class="col-xs-12 col-sm-12  col-md-2">
											<label for="revocada">Revocada: <span class="aste">(*)</span></label>
											<select class="form-control" id="revocada">
												<option value="">Seleccione</option>
											<option class="fontBold" value="1">Si</option>
											<option class="fontBold" value="0">No</option>
											</select>
										</div>
										<div class="col-xs-12 col-sm-12  col-md-4">
											<label for="observacionRevocada">Observación: <span class="aste">(*)</span></label>
											<input class="form-control" value=""  id="observacionRevocada"  type="text">
										</div>
										<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-3">
													<label for="fechaConclusion">Fecha de conclusión: <span class="aste">(*)</span></label>
													<input 
														id="fechaConclusionRevocada" 
														type="datetime-local" 
														value="<?= $fecha_input ?>" 
														name="fechaConclusionRevocada" 
														onchange="validateMedidaOK(this.id)" 
														class="fechas form-control gehit" 
														disabled/>
												</div>
										</div><br>	
										<?php 
										$getRevocada = getRevocada($connMedidas, $idInvolucrado);
										if (sizeof($getRevocada) > 0) { ?>
											<div class="row" style="margin-top: 20px;">
												<div class="col-xs-12">
													<div class="panel panel-default fd1">
														<div class="panel-body">
															<h5 class="text-on-pannel"><strong>Valores previos</strong></h5>
															<table class="table table-bordered">
																<thead>
																	<tr class="cabeceraTablaVictimas">
																		<th>#</th>
																		<th>Medida Revocada</th>
																		<th>Observaciones</th>
																		<th>Fecha en la que fue revocada</th>
																		<th>Eliminar</th>
																	</tr>
																</thead>
																<tbody>
																	<?php for ($i = 0; $i < sizeof($getRevocada); $i++) { ?>
																		<tr>
																			<td><?php echo $i + 1; ?></td>
																			<td>SÍ</td>
																			<td><?php echo $getRevocada[$i]['observacion']; ?></td>
																			<td>
																				<?php
																					$fecha = $getRevocada[$i]['fechaResolucion'];
																					if($fecha instanceof DateTime){
																						echo $fecha -> format('d/m/Y H:i:s');
																					}
																					else{
																						echo 'ERROR';
																					}
																				?>
																			</td>																																			
																			<td class="text-center">
																				<span 
																					onclick="deleteResolucion(<?= $getRevocada[$i]['idResolucion']; ?>, <?= $idMedida ?>, <?= $idEnlace ?>, 4)"
																					title="Eliminar" 
																					style="cursor: pointer; color: red; font-size: 18px;" 
																					class="glyphicon glyphicon-trash">
																				</span>
																			</td>
																		</tr>
																	<?php } ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>																							
									</div>										
								</div>																								
							</div>
						</div></br>							

						<div id="contDataResolucionesEdit">							

						</div></br>
					</div>
				</div> 
			</div>
			<!--DATOS RESOLUCIÓN-->
			<!--DATOS VICTIMA-->
			<div class="sectionData" id="victima">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Datos de la víctima</strong></h5>						
						<?if(sizeof($getDataVictimas) > 0 ) { ?>
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
										<th>Acciones</th>
										<th>Acciones</th>
										</tr>
									</thead>
									<tbody id="contentTableDataVictimas">
									<?for ($h=0; $h < sizeof($getDataVictimas) ; $h++) {
										$totalV = sizeof($getDataVictimas);
										$dataCompleted = checkDataInvolucradoCompleted($connMedidas, $getDataVictimas[$h][0]); 
										$checkEdad = checkEdad($getDataVictimas[$h][6]);?>
										<tr>
											<td><? echo $h + 1 ?></td>
											<td><?echo $getDataVictimas[$h][2]; ?></td>
											<td><?echo $getDataVictimas[$h][3]; ?></td>
											<td><?echo $getDataVictimas[$h][4]; ?></td>
											<td><?echo $getDataVictimas[$h][5]; ?></td>
											<td><?echo abs($getDataVictimas[$h][6]).' '.$checkEdad; ?></td>
											<?if($dataCompleted[0][0] > 0){?>
											<td style="background: green; color: white;"><center>Completado</center></td><? }else{ ?>
											<td style="background: #FF9A09; color: white;"><center>Incompleto</center></td><? } ?>
											<td><center><span onclick="agregarDatosContacto(<?php echo $getDataVictimas[$h][0]; ?> , <?php echo $fraccion; ?>, <?echo $idMedida ?>, <?echo $idEnlace; ?>, 1)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
											<td><center><span onclick="deleteItem(3, <?echo $getDataVictimas[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>, <?echo $totalV ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
										</tr>
									<? } ?>
									</tbody>
							 </table>
							</div>
						</div>
					<? }
					else { ?>
						<div class="panel ponel-default fd1">
							<h2>No hay víctimas registradas</h2>						
						</div>
						<div>
							<p style="color: black;">La presente medida de protección no aplica a víctimas</p>
						</div>						
					<? } ?>
						<!--INICIA DIV OCULTO DATOS VICTIMA-->
						<div id="contDatosVictima">
							
						</div>
						<!--TERMINA DIV OCULTO DATOS VICTIMA-->
					</div>
				</div>
			</div>
			<!--DATOS VICTIMA-->
			<!-- DATOS TESTIGOS -->
			<div class="sectionData" id="testigo" style="display: none;">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Datos de testigos</strong></h5>						
						<?if(sizeof($getDataTestigo) > 0 ) { ?>
						<label>Testigos(s)</label>
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
										<th>Acciones</th>
										<th>Acciones</th>
										</tr>
									</thead>
									<tbody id="contentTableDataVictimas">
									<?for ($h=0; $h < sizeof($getDataTestigo) ; $h++) { 
										$totalV = sizeof($getDataTestigo);
										$dataCompleted = checkDataInvolucradoCompleted($connMedidas, $getDataTestigo[$h][0]); 
										$checkEdad = checkEdad($getDataTestigo[$h][9]);?>
										<tr>
											<td><? echo $h + 1 ?></td>
											<td><?echo $getDataTestigo[$h][4]; ?></td>
											<td><?echo $getDataTestigo[$h][5]; ?></td>
											<td><?echo $getDataTestigo[$h][6]; ?></td>
											<td><?echo $getDataTestigo[$h][10]; ?></td>
											<td><?echo abs($getDataTestigo[$h][9]).' '.$checkEdad; ?></td>
											<?if($dataCompleted[0][0] > 0){?>
											<td style="background: green; color: white;"><center>Completado</center></td><? }else{ ?>
											<td style="background: #FF9A09; color: white;"><center>Incompleto</center></td><? } ?>
											<td><center><span onclick="agregarDatosContacto(<?php echo $getDataTestigo[$h][0]; ?> , <?php echo $fraccion; ?>, <?echo $idMedida ?>, <?echo $idEnlace; ?>, 0)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
											<td><center><span onclick="deleteTestigo(<? echo  $getDataTestigo[$h][0]; ?>, <? echo $idMedida; ?>,<? echo $idEnlace; ?>, 2)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
										</tr>
									<? } ?>
									</tbody>
							 </table>
							</div>
						</div>
					<? }
					else { ?>
						<div class="panel ponel-default fd1">
							<h2>No hay testigos registrados</h2>						
						</div>
						<div>
							<p style="color: black;">Se debe registrar un testigo primeramente.</p>
						</div>						
					<? } ?>
						<!--INICIA DIV OCULTO DATOS TESTIGO-->
						<div id="contDatosTestigo">
							
						</div>
						<!--TERMINA DIV OCULTO DATOS TESTIGO-->
					</div>
				</div>
			</div>
			<!-- DATOS TESTIGOS -->
			<!--DATOS DEL IMPUTADO-->
			<div class="sectionData" id="imputados">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Imputado(s)</strong></h5>
						<div id="contDataImputados">
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3">
									<button type="button" <?if($rolUser == 1){ ?> disabled <? } ?> class="btn btn-primary btn-lg"  onclick="saveDatosImputado(<?php echo $idEnlace; ?> , <?php echo $fraccion; ?>, <?echo $idMedida ?>, <?echo $a; ?>)">Agregar imputado</button>
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="nombreImpu">Nombre: <span class="aste">(*)</span></label>
									<input class="form-control" value=""  id="nombreImpu"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="paternoImpu">Paterno: <span class="aste">(*)</span></label>
									<input class="form-control" value=""  id="paternoImpu"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="maternoImpu">Materno: <span class="aste">(*)</span></label>
									<input class="form-control" value=""  id="maternoImpu"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="generoImpu">Género: <span class="aste">(*)</span></label>
									<select class="form-control" id="generoImpu" name="generoImpu">
										<option value="0" selected>Seleccione</option>
									 <option class="fontBold" value="1" >Masculino</option>
									 <option class="fontBold" value="1" >Femenino</option>
									 <option class="fontBold" value="3" >Desconocido</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-1">
									<label for="edadImpu">Edad: <span class="aste">(*)</span></label>
									<select class="form-control" id="edadImpu">
										<option value="">Seleccione</option>
										<option class="fontBold" value="0">Desconocida</option>
										 <?php for ($i=18; $i<=100; $i++){ ?>
										 	<option class="fontBold" value="<?php echo $i;?>"><?php echo $i;?> Años</option>
										 <?php } ?>
									</select>
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-12 col-sm-12  col-md-12">
								<input type="checkbox" id="acepto" name="acepto" onclick="imputadoDesconocido()" >
								<label for="acepto"><span></span>Desconocido</label>
							</div>
						</div><br>
							<!--INICIA DIV OCULTO DATOS IMPUTADOS-->
						<?$getDataImputados = getDataImputados($connMedidas, $idMedida,0,0); 
						  if(sizeof($getDataImputados) > 0) { 
						  	$totalImpu = sizeof($getDataImputados); ?>
						<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr class="cabeceraTablaVictimas">
											<th>#</th>
											<th>Nombre</th>
											<th>Paterno</th>
											<th>Materno</th>
											<th>Genero</th>
											<th>Edad</th>
											<th>Acciones</th>
											<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
										<?for ($h=0; $h < sizeof($getDataImputados) ; $h++) { 
											$checkEdad = checkEdad($getDataImputados[$h][6])?>
											<tr>
												<td><?echo $h + 1 ?></td>
												<td><?echo $getDataImputados[$h][2] ?></td>
												<td><?echo $getDataImputados[$h][3] ?></td>
												<td><?echo $getDataImputados[$h][4] ?></td>
												<td><?echo $getDataImputados[$h][7] ?></td>
												<td><?echo abs($getDataImputados[$h][6]).' '.$checkEdad; ?></td>
												<td><center><span onclick="editaImputado(<?php echo $idEnlace; ?> , <?php echo $getDataImputados[$h][0]; ?>, <?echo $idMedida ?>, 0)" title="Editar" onclick="" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
												<td><center><span onclick="deleteItem(4, <?echo $getDataImputados[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>, <?echo $totalImpu ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
											</tr>
										<? } ?>
										</tbody>
								 </table>
								</div>
							</div><? } ?></br>
						<!--TERMINA DIV OCULTO DATOS IMPUTADOS-->
					</div>
				</div>
			</div>
			<!--DATOS DEL IMPUTADO-->
			<!--CONSTANCIA DE LLAMADAS-->
			<div class="sectionData" id="constanciaLlamadas">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Constancia de llamadas</strong></h5>
						<div id="contDataConstanciaLlamadas">
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
								<button type="button" class="btn btn-primary btn-lg" <?if($rolUser == 1){ ?> disabled <? } ?> onclick="saveDatosConstanciaLlamadas(<?php echo $idEnlace; ?> , <?php echo $fraccion; ?>, <?echo $idMedida ?>, <?echo $a; ?>)">Guardar información</button>
							 </div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="heard">Fecha y hora: <span class="aste">(*)</span></label>
									<input id="dateConstanciaLlamada" type="datetime-local" value="" name="dateConstanciaLlamada" class="fechas form-control gehit" />
								</div>
								<div class="col-xs-12 col-sm-12  col-md-4">
									<label for="obsConstanciaLlamada">Observaciones: <span class="aste">(*)</span></label>
									<input class="form-control" value=""  id="obsConstanciaLlamada"  type="text">
								</div>
							</div>
					 </div></br>
						<?$getDataConstanciaLlamadas = getDataConstanciaLlamadas($connMedidas, $idMedida,0,0); 
						  if(sizeof($getDataConstanciaLlamadas) > 0) { ?>
						<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr class="cabeceraTablaVictimas">
											<th>#</th>
											<th>Fecha y hora de llamada</th>
											<th>Observaciones</th>
											<th><center>Descargar Constancia<center></th>
											<th>Acciones</th>
											<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
										<?for ($h=0; $h < sizeof($getDataConstanciaLlamadas) ; $h++) { ?>
											<tr>
												<td><?echo $h + 1 ?></td>
												<td><?echo $getDataConstanciaLlamadas[$h][2]->format('Y-m-d H:i A'); ?></td>
												<td><?echo $getDataConstanciaLlamadas[$h][3] ?></td>
												<td><center><span onclick="descargarConstancia(<?php echo $getDataConstanciaLlamadas[$h][0]; ?>, <?echo $idMedida ?>)" title="Editar" style="cursor: pointer; color: green; font-size: 18px;" class="glyphicon glyphicon-download-alt"></span></center></td>
												<td><center><span onclick="editaConstanciaLlamadas(<?php echo $idEnlace; ?> , <?php echo $getDataConstanciaLlamadas[$h][0]; ?>, <?echo $idMedida ?>, 0)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
												<td><center><span onclick="deleteItem(5, <?echo $getDataConstanciaLlamadas[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>, <?echo $totalImpu ?>,0)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
											</tr>
										<? } ?>
										</tbody>
								 </table>
								</div>
							</div><? } ?>
					</div>
				</div>
			</div>
			<!--CONSTANCIA DE LLAMADAS-->
			<!--DATOS FRACCIONES-->
			<div class="sectionData" id="fracciones">
				<?if(sizeof($getDataVictimas) > 0) {
				$getDataFracciones = modificarMedidasAplicadasInvolucrado($connMedidas, $idVictima);
				$totalFraccAplicadas = sizeof($getDataFracciones);?>
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Fracciones Aplicadas a la Víctima</strong></h5>						
						<div class="row">
							<?php
							if (sizeof($getDataVictimas) > 0 ) { ?>
								<div class="col-sm-12 col-md-4">
									<label for="idVictima">Víctima(s)</label>
									<select class="form-control" id="idVictima"
										onchange="updateTableFracciones(this.value, 'tableFraccionesVictima', <?= $idEnlace ?>, <?= $idMedida ?>)">
										<?php
										foreach ($getDataVictimas as $victima) { ?>
											<option 
												value="<?= $victima[0] ?>"
												<?php
												if ($victima[0] == $idInvolucrado) { 
													echo 'selected';
												} ?>									
												> <?= $victima[7] ?> 
											</option>
										<? } ?>
									</select>
								</div>
							<? }?>
							<div class="col-xs-12 col-sm-12  col-md-12" id="tableFraccionesVictima">
								<table class="table table-bordered">
									<thead>
										<tr class="cabeceraTablaVictimas">
										<th>#</th>
										<th>Fracción</th>
										<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
									<?for ($h=0; $h < sizeof($getDataFracciones) ; $h++) { ?>
										<tr>
											<td><?echo $getDataFracciones[$h][2] ?></td>
											<td><?echo $getDataFracciones[$h][1] ?></td>
											<td><center><span onclick="deleteItem(6, <?echo $getDataFracciones[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>, <?echo $totalFraccAplicadas ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
										</tr>
									<? } ?>
									</tbody>
								</table>
							</div>
						</div>						
					</div>
				</div> <? } ?>
				<?php if (sizeof($getDataTestigo) > 0) {
				$getFraccionesTestigo = modificarMedidasAplicadasInvolucrado($connMedidas, $idTestigo);					
				$totalFraccAplicadas = sizeof($getFraccionesTestigo); ?>			
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Fracciones Aplicadas al Testigo</strong></h5>
						<div class="row">
							<?php
							if ($a == 1 && sizeof($getDataTestigo) > 0 ) { ?>
								<div class="col-sm-12 col-md-4">
									<label for="idTestigo">Testigo(s)</label>
									<select class="form-control" id="idTestigo"
										onchange="updateTableFracciones(this.value, 'tableFraccionesTestigo', <?= $idEnlace ?>, <?= $idMedida ?>)">
										<?php
										foreach ($getDataTestigo as $testigo) { ?>
											<option 
												value="<?= $testigo[0] ?>"
												<?php
												if ($testigo[0] == $idInvolucrado) { 
													echo 'selected';
												} ?>									
												> <?= $testigo[11] ?> 
											</option>
										<? } ?>
									</select>
								</div>
							<? }?>														
								<div class="col-xs-12 col-sm-12  col-md-12" id="tableFraccionesTestigo">
									<?php if ($totalFraccAplicadas > 0) { ?>
									<table class="table table-bordered">
										<thead>
											<tr class="cabeceraTablaVictimas">
											<th>#</th>
											<th>Fracción</th>
											<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
										<?for ($h=0; $h < sizeof($getFraccionesTestigo) ; $h++) { ?>
											<tr>
												<td><?echo $getFraccionesTestigo[$h][2] ?></td>
												<td><?echo $getFraccionesTestigo[$h][1] ?></td>
												<td><center><span onclick="deleteItem(8, <?echo $getFraccionesTestigo[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>, <?echo $totalFraccAplicadas ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
											</tr>
										<? } ?>
										</tbody>
									</table>
									<? }
									else { ?>
									<div class="panel ponel-default fd1">
										<h2>No hay Medidas de Protección registradas.</h2>
									</div>
									<div>
										<p style="color: black;">Favor de registrar las Medidas de Protección asociadas.</p>
									</div>	
									<? } ?>
								</div>
						</div>
					</div>
				</div>	<? }?>
			</div>
			<!--DATOS FRACCIONES-->
			<!--SEGUIMIENTO DE LAS MEDIDAS DE PROTECCIÓN-->
			<div class="sectionData" id="seguimientoMedidas">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Seguimiento de Medidas de Protección</strong></h5>
						<div id="contDataSeguimiento">
							<div>
								<form action="" method="POST" enctype="multipart/form-data" id="uploadFile">
									<div>
										<label for="file" >Agregar Seguimiento de las Medidas de Protección: </label>
										<input type="file" name="file" id="fileSeguimiento" accept="application/pdf">
									</div><br>
								</form>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<center><button 
										<?php if($rolUser != 3 && $rolUser != 4) { ?> disabled <?php } ?>
										style="width: 95%;" 
										type="button" 
										class="btn btn-primary btn-lg" 
										onclick="uploadSeguimiento(<?php echo $idMedida; ?>, <?php echo $idEnlace; ?>, '<?= $nuc; ?>')"
										>Subir
									</button></center>
								</div>								
							</div>
						</div>
					</div></br>
					<!-- ----------------------------GET-------------------------------------- -->
					<?$fileSeguimientos = getFileSeguimientos($connMedidas, $idMedida); 
					if(sizeof($fileSeguimientos) > 0) { ?>
						<div class="row">
							<div class="col-xs-12 col-sm-12  col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr class="cabeceraTablaVictimas">
										<th>#</th>
										<th>Nombre del archivo</th>
										<th><center>Descargar Seguimiento<center></th>
										<th>Eliminar</th>
										</tr>
									</thead>
									<tbody>
									<?for ($h=0; $h < sizeof($fileSeguimientos) ; $h++) { ?>
										<tr>
											<td><?echo $h + 1 ?></td>
											<td><?echo $fileSeguimientos[$h][1]; ?></td>
											<td>
												<center>
													<span 
													onclick="descargarSeguimiento(<?php echo $fileSeguimientos[$h][0]; ?>, '<?php echo $fileSeguimientos[$h][2]; ?>')" 
													title="Descargar" 
													style="cursor: pointer; color: green; font-size: 18px;" 
													class="glyphicon glyphicon-download-alt">
													</span>
												</center>
											</td>
											<td>
												<center>
													<span 
														onclick="deleteFile(1, <?echo $fileSeguimientos[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>, '<?php echo $fileSeguimientos[$h][2]; ?>')" 
														title="Eliminar" 
														style="cursor: pointer; color: red; font-size: 18px;" 
														class="glyphicon glyphicon-trash">
													</span>
												</center>
											</td>
										</tr>
									<? } ?>
									</tbody>
								</table>
							</div>
						</div><? } 
					?>
				</div>					  
				</div>
			</div>
			<!--SEGUIMIENTO DE LAS MEDIDAS DE PROTECCIÓN-->			
		</div>
	</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal" onclick="reloadModalMDP(<?echo $tipoModal; ?>, <?echo $idEnlace; ?>, <?echo $idMedida; ?>, 0, 0)">Atras</button>
	<!--<button type="button" class="btn btn-primary">Guardar información</button>-->
</div>