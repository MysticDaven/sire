
	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	
				$fecha_actual=date("d/m/Y");
				$fecha=strftime( "%Y-%m-%d %H:%M:%S", time() );

				$hoy = date("Y-m-d");//Fecha calendario
				$m = date("m"); 

				$anioActual = date("Y"); 
	

				$d = date("d");
				if($d >= 1 && $d <= 5){ $m = $m-1; }

				if (isset($_POST["tipoModal"])){ $tipoModal = $_POST["tipoModal"]; }
					if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
					if (isset($_POST["typeArch"])){ $typeArch = $_POST["typeArch"]; }
					if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }


					if (isset($_POST["messelected"])){ $messelected = $_POST["messelected"]; }
					if (isset($_POST["diaselected"])){ $diaselected = $_POST["diaselected"]; }
					if (isset($_POST["typeCheck"])){ $typeCheck = $_POST["typeCheck"]; }

				

					if($typeCheck == 0){ $b = 0; }else{ if($typeCheck == 1){ $b = 1; } }

				if (isset($_POST["idPuestaDisposicion"])){ 

						$idPuestaDisposicion = $_POST["idPuestaDisposicion"]; 

						if ($idPuestaDisposicion != 0) {

												$puestaSaveId = $idPuestaDisposicion;												
												$puestaData = get_data_puesta($conn, $idPuestaDisposicion);
												$nombrecompleto = $puestaData[0][0];
												$cargo = $puestaData[0][1];
												$funcion = $puestaData[0][2];
												$areaad = $puestaData[0][3];
												$nuc = $puestaData[0][4];
												$fechaev = $puestaData[0][5];										
												$fechain = $puestaData[0][6];										
												$calle = $puestaData[0][7];
												$numero = $puestaData[0][8];
												$codigop = $puestaData[0][9];
												$fiscalia = $puestaData[0][10];
												$muni = $puestaData[0][11];
												$colo = $puestaData[0][12];
												$uno = $puestaData[0][13];
												$dos = $puestaData[0][14];
												$tres = $puestaData[0][15];
												$cuatro = $puestaData[0][16];
												$cinco = $puestaData[0][17];
												$narra = $puestaData[0][18];
												$getIDMando = $puestaData[0][19];
												$a = 1;

												// OBTENER ID DE MUNICIPIO Y COLONIA APARTIR DE LA PUESTA Y LA FISCALIA

												$dataDire = getDataDireFiscaPuesta($conn, $idPuestaDisposicion);

						}else{  $a = 0;  $puestaSaveId = 0;
								   	$uno = 0;
												$dos = 0;
												$tres = 0;
												$cuatro = 0;
												$cinco = 0;
						 }	
				}	
	?>

 <div class="modal-header" style="background-color:#152F4A;">
 	<center><label style=" color: white; font-weight: bold; font-size: 2rem;">Registro Principal de Actividades</label></center>
 </div>

 <div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoDisposic" >
 	<div class="row"  style="padding: 2%;">

 	
 			<input type="hidden" id="idPuestaDisposicion" value="<? if($tipoModal == 0){ } else if($tipoModal == 1){ echo $puestaSaveId; } ?>" name="idPuestaDisposicion">

 			<div class="row"><!-- ROOWWWWWW MANDOS  -->
 				<div class="col-xs-12 col-sm-12  col-md-4">
 					<label for="heard">Agente responsable : <span class="aste">(Requerido)</span></label><br>	
 					<select class="dataAutocomplet form-control browser-default custom-select" onchange="getData()" id="newBrwosers_id" locked="locked" name="newBrwoser" type="text" <? if($b == 0){ echo "readonly"; } ?> >
 						<option></option>
 						<? $mandos = getDataMandos($conn, "VI");
 					for ($h=0; $h < sizeof($mandos); $h++) { 
 						$idMando = $mandos[$h][6];	$nom = $mandos[$h][0];	$pat = $mandos[$h][1];	$mat = $mandos[$h][2];
 						$nombrecom = $nom." ".$pat." ".$mat; ?>
 						<option style="color: black; font-weight: bold;" value="<? echo $idMando; ?>" <?if($a == 1 && $idMando == $getIDMando ){ ?> selected <? } ?>><? echo $nombrecom; ?></option>
 					<? } ?>
 					</select>
 			</div>
 			<div id="contDataMando">	
 				<div class="col-xs-12 col-sm-12  col-md-3">
 					<label for="heard">Cargo :</label>
 					<input class="form-control mandda gehit" value="<? if($a == 1){ echo $cargo; } ?>"  id="newBrwoser"  type="text" disabled>
 				</div>
 				<div class="col-xs-12 col-sm-12 col-md-2">
 					<label for="heard">Función :</label>
 					<input class="form-control mandda gehit" value="<? if($a == 1){ echo $funcion; } ?>"  id="newBrwoser"  type="text" disabled>
 				</div>
 				<div class="col-xs-12 col-sm-12  col-md-3">
 					<label for="heard">Area de Adscripción :</label>
 					<input class="form-control mandda gehit" value="<? if($a == 1){ echo $areaad; } ?>" id="newBrwoser"  type="text" disabled>
 				</div>
 			</div>
 		</div><!-- ROOWWWWWW MANDOS  --> 

 		<div class="row"><!-- ROOWWWWWW LOCALIDADES  --> 
 			<div class="col-xs-12 col-sm-12  col-md-3">
 				<label for="heard">Nuc :</label>
 				<input class="form-control gehit"  id="nucPuestaDisposi" maxlength="15" oninput="this.value = this.value.toUpperCase();  validateNuc(this)"  type="text" value="<? if($a == 1){ echo $nuc; } ?>" <? if($b == 0){ echo "readonly"; } ?>>
 			</div>
 			<!--CONDICIONAL PARA HABILITAR A DETERMINADO ENLACE -->
 			<?if($idEnlace == 433 || $idEnlace == 124 || $idEnlace == 95 || $idEnlace == 108 || $idEnlace == 127 ){ ?>
 				<div class="col-xs-12 col-sm-12  col-md-2">
	 				<label for="heard">Fecha Evento :</label><span class="aste"> (Requerido)</span>
	 				<div >
	 					<input id="fechaevento" type="datetime-local" value="<? if($a == 1){  echo 	$fechaev=str_ireplace(' ','T',$fechaev); } ?>" name="fechaevento" class="fechas form-control gehit" min="2021-01-01T00:00:00" max="<?echo $hoy; ?>T23:59:59" onchange="checkDateInforme('<?echo $fecha; ?>');" <? if($b == 0){ echo "readonly"; } ?> />	
	 				</div>
 			 </div>
 			<? }else{ ?>
 			<div class="col-xs-12 col-sm-12  col-md-2">
 				<label for="heard">Fecha Evento :</label><span class="aste"> (Requerido)</span>
 				<div >
 					<input id="fechaevento" type="datetime-local" value="<? if($a == 1){  echo 	$fechaev=str_ireplace(' ','T',$fechaev); } ?>" name="fechaevento" class="fechas form-control gehit" min="2021-01-01T00:00:00" max="<?echo $hoy; ?>T23:59:59" onchange="checkDateInforme('<?echo $fecha; ?>');" <? if($b == 0){ echo "readonly"; } ?> />	
 				</div>
 			</div>
 		 <? } ?>
 			<div class="col-xs-12 col-sm-12  col-md-2">
 				<label for="heard">Fiscalía :</label>	<span class="aste">(Requerido)</span>
 					<select class="dataAutocomplet form-control browser-default custom-select" onchange="getDataMunicip()" locked="locked" id="newBrwoserFisca" name="newBrwoserFisca" type="text" <? if($b == 0){ echo "readonly"; } ?> >
 						<option value="" ></option>
 						<?$fiscas = getFiscaliasEnlace($conn, $idEnlace);
				 			for ($o=0; $o < sizeof($fiscas); $o++) { 
				 				$idfis = $fiscas[$o][0];
				 				$nombrefis = $fiscas[$o][1];?>
				 				<option style="color: black; font-weight: bold;" value="<? echo $idfis; ?>" <?if($a == 1 && $idfis == $dataDire[0][0]){?> selected <? } ?> ><?echo $nombrefis; ?></option>
				 			<?}?>
 					</select>
 			</div>
 			<div class="col-xs-12 col-sm-12  col-md-2">
 				<label for="heard">Municipio :</label>	<span class="aste">(Requerido)</span>		
 				<select class="dataAutocomplet form-control browser-default custom-select" onchange="getDataColoni();" locked="locked" id="newBrwoserMun" name="newBrwoserMun" type="text" <? if($b == 0){ echo "readonly"; } ?> >
 						<?if($a == 1){ 
 							$munis = getDataMunicipiosFiscalia($conn, $dataDire[0][0]);
 							for ($o=0; $o < sizeof($munis); $o++) { 
 								$idMuni = $munis[$o][0];
 								$nombreMuni = $munis[$o][1];
 							?>
 							<option value="<?echo $idMuni; ?>" <?if($idMuni == $dataDire[0][1]){?> selected <? } ?> ><? echo $nombreMuni;?></option>
 						<? } 
 					  }  ?>
      
						</select>
 			</div>
 			<div class="col-xs-12 col-sm-12  col-md-3">
 				<label for="heard">Colonia / Localidad :</label>	<span class="aste">(Requerido)</span>
 					<select class="dataAutocomplet form-control browser-default custom-select" onchange="getPOstalCode();" locked="locked" id="newBrwoserColo" name="newBrwoserColo" type="text" <? if($b == 0){ echo "readonly"; } ?> >
 							<?if($a == 1){ 
 									$coloni = getDataColoniMunicipio($conn, $dataDire[0][1]);
 							for ($o=0; $o < sizeof($coloni); $o++) { 	 
 									$idColoni = $coloni[$o][0];
 									$codipos = $coloni[$o][1];
 									$nombre = $coloni[$o][2];
 							?>
 							<option style="color: black; font-weight: bold;" value="<? echo $idColoni; ?>"  <?if($idColoni  == $dataDire[0][2]){?> selected <? } ?> ><? echo $nombre; ?></option>
 						<? } 
 					  }  ?>
						</select>
 			</div>
 		</div><!-- ROOWWWWWW LOCALIDADES  -->

 		<div class="row"><!-- ROOWWWWWW DIRECCION  -->
 			<div class="col-xs-12 col-sm-12  col-md-2">  
 				<label for="heard">Código Postal :</label> <span class="aste">(Requerido)</span>
 				<div id="codepostalid"><input class="form-control"  id="codepostalidPeusta" value="<? if($a == 1){ echo $codigop; } ?>"  type="text" readonly=""></div>
 			</div>
 			<div class="col-xs-12 col-sm-12  col-md-5">
 				<label for="heard">Calle / Carretera / Brecha :</label><span class="aste"> (Requerido)</span><br>
 				<input class="form-control"  id="calleInputPuesta" maxlength="150" onkeypress="return validaInput_puestaDispo(event, 'varchar_letras_numeros)" value="<? if($a == 1){ echo $calle; } ?>" type="text" <? if($b == 0){ echo "readonly"; } ?>>
 			</div>
 			<div class="col-xs-12 col-sm-12  col-md-1">
 				<label for="heard">Número :</label><br>
 				<input class="form-control"  id="numberCallePuesta" value="<? if($a == 1){ echo $numero; } ?>" type="number" <? if($b == 0){ echo "readonly"; } ?>>
 			</div>
 			<div class="col-xs-12 col-sm-12  col-md-4">
 				<label for="heard">Fecha del Informe :</label>
 				<input class="form-control"  id="newBrwoser" value="<? if($a == 0){ echo $fecha; }else{ echo $fechain; } ?>"  type="text" readonly><br>
 			</div>
 		</div><!-- ROOWWWWWW DIRECCION  -->

 		<div class="row" style="margin-left: 10%;"><!-- ROOWWWWWW RELEVANCIAS --> 
 			<div class="col-xs-12 col-sm-2  col-md-2">
 				<div class="demo">
 					<input type="checkbox" id="acepto1" name="acepto1" <? if($uno == 1){ echo "checked"; } ?> <? if($b == 0){ echo "disabled"; } ?>>
 					<label for="acepto1"><span></span>Evento Relevante</label>
 				</div>
 			</div>
 			<div class="col-xs-12 col-sm-2  col-md-2">
 				<div class="demo">
 					<input type="checkbox" id="acepto2" name="acepto2" <? if($dos == 1){ echo "checked"; } ?> <? if($b == 0){ echo "disabled"; } ?>>
 					<label for="acepto2"><span></span>Evento no Relevante</label>
 				</div>
 			</div>
 			<div class="col-xs-12 col-sm-2  col-md-2">
 				<div class="demo">
 					<input type="checkbox" id="acepto3" name="acepto3" <? if($tres == 1){ echo "checked"; } ?> <? if($b == 0){ echo "disabled"; } ?>>
 					<label for="acepto3"><span></span>Mediante Cateo</label>
 				</div>
 			</div>
 			<div class="col-xs-12 col-sm-2 col-md-2">
 				<div class="demo">
 					<input type="checkbox" id="acepto4" name="acepto4" <? if($cuatro == 1){ echo "checked"; } ?> <? if($b == 0){ echo "disabled"; } ?>>
 					<label for="acepto4"><span></span>Mediante Operativo</label>
 				</div>
 			</div>
 			<div class="col-xs-12 col-sm-2  col-md-2">
 				<div class="demo">
 					<input type="checkbox" id="acepto5" name="acepto5" <? if($cinco == 1){ echo "checked"; } ?> <? if($b == 0){ echo "disabled"; } ?>>
 					<label for="acepto5"><span></span>Mediante Recorrido</label>
 				</div>
 			</div>
 			<div class="col-xs-12 col-sm-2  col-md-2">
 				<button class="btnApoyo btn btn-default" onclick="modalPersonalApoyo(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,0,<? echo $b; ?>)" type="submit">Personal de Apoyo</button>
 			</div>
 		</div><!-- ROOWWWWWW RELEVANCIAS  -->

 		<div class="row"><!-- ROOWWWWWW RELEVANCIAS -->
 			<div class="form-group col-md-12">
 				<label for="textObservaciones">Narración:</label>	
 				<textarea id="textNarracion" onkeypress="contCharTextBox()" onclick="contCharTextBox()"  style="resize: none; height: 7vh; " class="form-control rounded-0" rows="2" <? if($b == 0){ echo "readonly"; } ?>><? if($a == 1){ echo $narra; } ?></textarea>
 				<div class="text-right"><span id="caracteres" class="valid-text pt-3"></span></div>
 			</div>
 		</div><!-- ROOWWWWWW RELEVANCIAS  --> 
 		<div>

 		<!-- ROOWWWWWW ICONOS  -->
 		<div class="row" id="contIcones" >
 			<div style="background-color: #FBFBFC; border: solid 1px lightgray;  width: 100%;">
 				<center>
 					<table id="contIons" style="background-color: #FBFBFC;   width: 90%;">
 					<? if($b == 1){ ?>
 						<tr>
 							<td id="veic">	<img src="img/iconosPuestaDispo/Cuadrados/Azul-01.png" onmouseover="hoverv(this, 've');" onmouseout="unhoverv(this, 've')" width="100" height="100" id="imgVeicle" onclick="modalVehicle(0,<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,0,<? echo $b; ?>)" alt="Armas"></td>
								<td >		<img src="img/iconosPuestaDispo/Cuadrados/Azul-02.png" id="imgPerson" width="100" height="100" alt="Armas" class="poicur"  onclick="showmodalPersonas(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, 0,<? echo $b; ?>);" onmouseover="hoverv(this, 'pe');" onmouseout="unhoverv(this, 'pe')"></br></td>
								<td >	<img src="img/iconosPuestaDispo/Cuadrados/Azul-03.png" width="100" height="100" alt="Armas" class="poicur" onclick="modalArmasAseguradas(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, 0,<? echo $b; ?>)" onmouseover="hoverv(this, 'ar');" onmouseout="unhoverv(this, 'ar')"></br></td>
								<td><img src="img/iconosPuestaDispo/Cuadrados/Azul-04.png" onclick="modalDrogas(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,0,<? echo $b; ?>);" width="100" height="100" alt="Armas" class="poicur" onmouseover="hoverv(this, 'dr');" onmouseout="unhoverv(this, 'dr')"></br></td>
								<td><img src="img/iconosPuestaDispo/Cuadrados/Azul-06.png" onclick="modalForestales(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,0,<? echo $b; ?>)" width="100" height="100" alt="Armas" class="poicur" onmouseover="hoverv(this, 'fo');" onmouseout="unhoverv(this, 'fo')"></br></td>
								<td> <img src="img/iconosPuestaDispo/Cuadrados/Azul-07.png" onclick="modalObjetoAsegurado(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,0,<? echo $b; ?>)" width="100" height="100" alt="Armas" class="poicur" onmouseover="hoverv(this, 'he');" onmouseout="unhoverv(this, 'he')"></br></td>
								<td> <img src="img/iconosPuestaDispo/Cuadrados/Azul-08.png" onclick="modalDineroAsegurado(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,0,<? echo $b; ?>);" width="100" height="100" alt="Armas" class="poicur" onmouseover="hoverv(this, 'ma');" onmouseout="unhoverv(this, 'ma')"></br></td>
								<td> <img src="img/iconosPuestaDispo/Cuadrados/Azul-09.png" onclick="modalDefunciones(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,0,<? echo $b; ?>)" width="100" height="100" alt="Armas" class="poicur" onmouseover="hoverv(this, 'en');" onmouseout="unhoverv(this, 'en')"></br></td>
								<td><img src="img/iconosPuestaDispo/Cuadrados/Azul-10.png" onclick="modalTrabajosDeCampo(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,0,<? echo $b; ?>)" width="100" height="100" alt="Armas" class="poicur" onmouseover="hoverv(this, 'in');" onmouseout="unhoverv(this, 'in')"></br></td>
								</tr>
								<? } ?>
							</table>
						</center>
					</div>
				</div>


																							<div class="row" id="generalInfoPuesta">
																								

																										<center><div id="involucrado" class="involucrado">

																											<div id="personalApoyo">
																									  	

																									  				<?  if ($idPuestaDisposicion != 0) {			
																																											
																																											$dataPuestaDIne = get_data_personalApoyo_puesta($conn, $idPuestaDisposicion, 0);																																								
																																											if(sizeof($dataPuestaDIne) > 0){
																																														?>
																																																					<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Personal de Apoyo</label>
																																																							<div class="row" style="padding: 20px;">																														
																																																									<table class="table table-striped">
																																																			  <thead>
																																																			     <tr>
																																																						      <th scope="col">#</th>
																																																						      <th scope="col"><center>Nombre</center></th>
																																																						      <th scope="col"><center>Área de adscripción</center></th>																							      
																																																						      <th scope="col"><center>Cargo</center></th>
																																																						      <th scope="col"><center>Función</center></th>

																																																						         <? if($b == 1){ ?>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <? } ?>
																																																						    </tr>
																																																						</thead>
																																																			  <tbody>
																																														<?
																																																	for ($h=0; $h < sizeof($dataPuestaDIne) ; $h++) { 																																										
																																																?>
																																																				<tr>																																																					
																																																							<td> <? echo ($h+1) ?> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][3]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][5]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][7]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][9]; ?></center> </td>

																																																									<? if($b == 1){ ?>
																																																							<td> <center><span onclick="deleteItemForm(10, <? echo $dataPuestaDIne[$h][0]; ?>, <? echo $idEnlace; ?>, <? echo $idPuestaDisposicion; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
																																																							<td> <center><span onclick="modalPersonalApoyo(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $dataPuestaDIne[$h][0]; ?>,<? echo $b; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center> </td>
																																																						<? } ?>
																																																				</tr>
																																																<?																																														
																																														}
																																														?>
																																																	 </tbody>
																																																		</table>
																																																		</div></center>
																																														<?
																																											}																														
																																					}  
																																					?>	



																									  </div>

																																			<div id="personasInvolucradas">
																																						

																																																<?  if ($idPuestaDisposicion != 0) {					
																																											
																																											$dataPuestaPersonas = get_data_person_puesta($conn, $idPuestaDisposicion, 0);																																								
																																											if(sizeof($dataPuestaPersonas) > 0){
																																														?>
																																																					<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem; padding-top: 2%;">Personas Involucradas</label>
																																																							<div class="row" style="padding: 20px;">																														
																																																									<table class="table table-striped ">
																																																			  <thead>
																																																			     <tr>
																																																						      <th scope="col">#</th>
																																																						      <th scope="col">Nombre Detenido</th>
																																																						      <th scope="col">Alias</th>
																																																						      <th scope="col">Edad</th>
																																																						      <th scope="col">Sexo</th>
																																																						      
																																																						      <? if($b == 1){ ?>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <? } ?>

																																																						    </tr>
																																																						</thead>
																																																			  <tbody>
																																														<?
																																																	for ($h=0; $h < sizeof($dataPuestaPersonas) ; $h++) { 																																										
																																																?>
																																																				<tr>																																																					
																																																							<td> <? echo ($h+1) ?> </td>
																																																							<td> <? echo $dataPuestaPersonas[$h][1]; ?> </td>
																																																							<td> <? echo $dataPuestaPersonas[$h][2]; ?> </td>
																																																							<td> <? echo $dataPuestaPersonas[$h][3]; ?> </td>
																																																							<td> <? echo $dataPuestaPersonas[$h][4]; ?> </td>

																																																							<? if($b == 1){ ?>
																																																							<td> <center><span onclick="deleteItemForm(1, <? echo $dataPuestaPersonas[$h][0]; ?>, <? echo $idEnlace; ?>, <? echo $idPuestaDisposicion; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
																																																							<td> <center><span onclick="showmodalPersonas(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $dataPuestaPersonas[$h][0]; ?>,<? echo $b; ?>);" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center> </td>

																																																						<? } ?>
																																																				</tr>
																																																<?																																														
																																														}
																																														?>
																																																	 </tbody>
																																																		</table>
																																																		</div></center>
																																														<?
																																											}																														
																																					}  
																																					?>																																																																																																	


																																			</div>

																																				<div id="vehiculosInvolucrados">																																																										
																																					<?  if ($idPuestaDisposicion != 0) {					
																																											$dataPuestaVehiculo = get_data_vehi_puesta($conn, $idPuestaDisposicion,0);																																								
																																											if(sizeof($dataPuestaVehiculo) > 0){
																																														?>
																																																					<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Vehículos Involucrados</label>
																																																							<div class="row" style="padding: 20px;">																														
																																																									<table class="table table-striped">
																																																			  <thead>
																																																			     <tr>
																																																						      <th scope="col">#</th>
																																																						      <th scope="col">Clasificación</th>
																																																						      <th scope="col">Aseguramiento</th>
																																																						      <th scope="col">Delito</th>
																																																						      <th scope="col">Tipo Del</th>
																																																						      <th scope="col">Marca</th>
																																																						      <th scope="col">Linea</th>
																																																						      <th scope="col">Tipo</th>
																																																						      <th scope="col">Color</th>
																																																						      <th scope="col">Modelo</th>
																																																						      <th scope="col">Placa</th>
																																																						      <th scope="col">Serie</th>
																																																						      <th scope="col">Motor</th>
																																																						         <? if($b == 1){ ?>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <? } ?>
																																																						    </tr>
																																																						</thead>
																																																			  <tbody>
																																														<?
																																																	for ($h=0; $h < sizeof($dataPuestaVehiculo) ; $h++) { 																																										
																																																?>
																																																				<tr>																																																					
																																																							<td> <? echo ($h+1) ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][1]; ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][2]; ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][3]; ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][4]; ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][5]; ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][6]; ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][7]; ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][8]; ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][9]; ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][10]; ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][11]; ?> </td>
																																																							<td> <? echo $dataPuestaVehiculo[$h][12]; ?> </td>
																																																							<? if($b == 1){ ?>
																																																							<td> <center><span onclick="deleteItemForm(2, <? echo $dataPuestaVehiculo[$h][0]; ?>, <? echo $idEnlace; ?>, <? echo $idPuestaDisposicion; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
																																																							<td> <center><span onclick="modalVehicle(0,<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $dataPuestaVehiculo[$h][0]; ?>,<? echo $b; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center> </td>
																																																									<? } ?>
																																																				</tr>
																																																<?																																														
																																														}
																																														?>
																																																	 </tbody>
																																																		</table>
																																																		</div></center>
																																														<?
																																											}																														
																																					}  
																																					?>																																																																																																																												 																																												
																																							</div>



																																										<div id="armasInvolucradas">																																																										
																																					<?  if ($idPuestaDisposicion != 0) {					
																																											$dataPuestaDrogas= get_data_armas_puesta($conn, $idPuestaDisposicion,0);																																								
																																											if(sizeof($dataPuestaDrogas) > 0){
																																														?>
																																																					<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Armamento Involucrado</label>
																																																							<div class="row" style="padding: 20px;">																														
																																																									<table class="table table-striped">
																																																			  <thead>
																																																			     <tr>
																																																						      <th scope="col">#</th>
																																																						      <th scope="col">Tipo</th>
																																																						      <th scope="col"><center>Marca</center></th>
																																																						      <th scope="col"><center>Calibre</center></th>
																																																						      <th scope="col"><center>Accesorio</center></th>
																																																						      <th scope="col"><center>Marca Cartucho</center></th>
																																																						      <th scope="col"><center>Observaciones</center></th>

																																																						         <? if($b == 1){ ?>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <? } ?>
																																																						    </tr>
																																																						</thead>
																																																			  <tbody>
																																														<?
																																																	for ($h=0; $h < sizeof($dataPuestaDrogas) ; $h++) { 																																										
																																																?>
																																																				<tr>																																																					
																																																							<td> <? echo ($h+1) ?> </td>
																																																							<td> <? echo $dataPuestaDrogas[$h][1] ?> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][2]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][3]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][4]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][5]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][6]; ?></center> </td>

																																																							<? if($b == 1){ ?>
																																																							<td> <center><span onclick="deleteItemForm(3, <? echo $dataPuestaDrogas[$h][0]; ?>, <? echo $idEnlace; ?>, <? echo $idPuestaDisposicion; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
																																																							<td> <center><span onclick="modalArmasAseguradas(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $dataPuestaDrogas[$h][0]; ?>,<? echo $b; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center> </td>
																																																									<? } ?>
																																																				</tr>
																																																<?																																														
																																														}
																																														?>
																																																	 </tbody>
																																																		</table>
																																																		</div></center>
																																														<?
																																											}																														
																																					}  
																																					?>																																																																																																																												 																																												
																																							</div>


																																															<div id="defuncionesInvolucradas">																																																										
																																					<?  if ($idPuestaDisposicion != 0) {					
																																											$dataPuestaDrogas= get_data_defunciones_puesta($conn, $idPuestaDisposicion, 0);																																								
																																											if(sizeof($dataPuestaDrogas) > 0){
																																														?>
																																																					<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Defunciones Involucradas</label>
																																																							<div class="row" style="padding: 20px;">																														
																																																									<table class="table table-striped">
																																																			  <thead>
																																																			     <tr>
																																																						      <th scope="col">#</th>
																																																						      <th scope="col">Nombre Completo</th>
																																																						      <th scope="col"><center>Edad</center></th>
																																																						      <th scope="col"><center>Sexo</center></th>
																																																						      <th scope="col"><center>Causa de Muerte</center></th>
																																																						      <th scope="col"><center>Observaciones</center></th>

																																																						         <? if($b == 1){ ?>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <? } ?>
																																																						    </tr>
																																																						</thead>
																																																			  <tbody>
																																														<?
																																																	for ($h=0; $h < sizeof($dataPuestaDrogas) ; $h++) { 																																										
																																																?>
																																																				<tr>																																																					
																																																							<td> <? echo ($h+1) ?> </td>
																																																							<td> <? echo $dataPuestaDrogas[$h][1]." ".$dataPuestaDrogas[$h][2]." ".$dataPuestaDrogas[$h][3]; ?> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][4]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][5]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][6]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][8]; ?></center> </td>

																																																							<? if($b == 1){ ?>
																																																							<td> <center><span onclick="deleteItemForm(4, <? echo $dataPuestaDrogas[$h][0]; ?>, <? echo $idEnlace; ?>, <? echo $idPuestaDisposicion; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
																																																							<td> <center><span onclick="modalDefunciones(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $dataPuestaDrogas[$h][0]; ?>, <? echo $b; ?> )" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center> </td>
																																																									<? } ?>
																																																				</tr>
																																																<?																																														
																																														}
																																														?>
																																																	 </tbody>
																																																		</table>
																																																		</div></center>
																																														<?
																																											}																														
																																					}  
																																					?>																																																																																																																												 																																												
																																							</div>

																																									<div id="drogasInvolucrados">																																																										
																																					<?  if ($idPuestaDisposicion != 0) {					
																																											$dataPuestaDrogas= get_data_drog_puesta($conn, $idPuestaDisposicion, 0);																																								
																																											if(sizeof($dataPuestaDrogas) > 0){
																																														?>
																																																					<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Drogas Involucradas</label>
																																																							<div class="row" style="padding: 20px;">																														
																																																									<table class="table table-striped">
																																																			  <thead>
																																																			     <tr>
																																																						      <th scope="col">#</th>
																																																						      <th scope="col">Droga</th>
																																																						      <th scope="col"><center>Unidad de medida</center></th>
																																																						      <th scope="col"><center>Producto Químico</center></th>
																																																						      <th scope="col"><center>Gramos</center></th>
																																																						      <th scope="col"><center>Observaciones</center></th>

																																																						        <? if($b == 1){ ?>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <? } ?>
																																																						    </tr>
																																																						</thead>
																																																			  <tbody>
																																														<?
																																																	for ($h=0; $h < sizeof($dataPuestaDrogas) ; $h++) { 																																										
																																																?>
																																																				<tr>																																																					
																																																							<td> <? echo ($h+1) ?> </td>
																																																							<td> <? echo $dataPuestaDrogas[$h][1]; ?> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][4]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][5]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][2]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDrogas[$h][3]; ?></center> </td>

																																																							<? if($b == 1){ ?>
																																																							<td> <center><span onclick="deleteItemForm(5, <? echo $dataPuestaDrogas[$h][0]; ?>, <? echo $idEnlace; ?>, <? echo $idPuestaDisposicion; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
																																																							<td> <center><span onclick="modalDrogas(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $dataPuestaDrogas[$h][0]; ?>,<? echo $b; ?>);" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center> </td>
																																																									<? } ?>
																																																				</tr>
																																																<?																																														
																																														}
																																														?>
																																																	 </tbody>
																																																		</table>
																																																		</div></center>
																																														<?
																																											}																														
																																					}  
																																					?>																																																																																																																												 																																												
																																							</div>

																									  <div id="forestalesInvolucrados">
																									  	

																									  				<?  if ($idPuestaDisposicion != 0) {					
																																											$dataPuestaForesta = get_data_foesta_puesta($conn, $idPuestaDisposicion, 0);																																								
																																											if(sizeof($dataPuestaForesta) > 0){
																																														?>
																																																					<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Forestales Involucrados</label>
																																																							<div class="row" style="padding: 20px;">																														
																																																									<table class="table table-striped">
																																																			  <thead>
																																																			     <tr>
																																																						      <th scope="col">#</th>
																																																						      <th scope="col">Producto Forestal</th>
																																																						      <th scope="col"><center>Volumen</center></th>
																																																						      <th scope="col"><center>Observaciones</center></th>
																																																						        <? if($b == 1){ ?>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <? } ?>
																																																						    </tr>
																																																						</thead>
																																																			  <tbody>
																																														<?
																																																	for ($h=0; $h < sizeof($dataPuestaForesta) ; $h++) { 																																										
																																																?>
																																																				<tr>																																																					
																																																							<td> <? echo ($h+1) ?> </td>
																																																							<td> <? echo $dataPuestaForesta[$h][1]; ?> </td>
																																																							<td> <center><? echo $dataPuestaForesta[$h][2]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaForesta[$h][4]; ?></center> </td>

																																																							<? if($b == 1){ ?>
																																																							<td> <center><span onclick="deleteItemForm(6, <? echo $dataPuestaForesta[$h][0]; ?>, <? echo $idEnlace; ?>, <? echo $idPuestaDisposicion; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
																																																							<td> <center><span onclick="modalForestales(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $dataPuestaForesta[$h][0]; ?>,<? echo $b; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center> </td>
																																																									<? } ?>
																																																				</tr>
																																																<?																																														
																																														}
																																														?>
																																																	 </tbody>
																																																		</table>
																																																		</div></center>
																																														<?
																																											}																														
																																					}  
																																					?>	

																									  </div>

																									  		<div id="dineroInvolucrado">																								  	

																									  				<?  if ($idPuestaDisposicion != 0) {			
																																											
																																											$dataPuestaDIne = get_data_dinero_puesta($conn, $idPuestaDisposicion, 0);																																								
																																											if(sizeof($dataPuestaDIne) > 0){
																																														?>
																																																					<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Moneda Involucrada</label>
																																																							<div class="row" style="padding: 20px;">																														
																																																									<table class="table table-striped">
																																																			  <thead>
																																																			     <tr>
																																																						      <th scope="col">#</th>
																																																						      <th scope="col"><center>Moneda Nacional</center></th>
																																																						      <th scope="col"><center>Moneda Extranjera</center></th>
																																																						      <th scope="col"><center>Divisa</center></th>
																																																						      <th scope="col"><center>Observaciones</center></th>
																																																						        <? if($b == 1){ ?>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <? } ?>
																																																						    </tr>
																																																						</thead>
																																																			  <tbody>
																																														<?
																																																	for ($h=0; $h < sizeof($dataPuestaDIne) ; $h++) { 																																										
																																																?>
																																																				<tr>																																																					
																																																							<td> <? echo ($h+1) ?> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][1]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][2]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][3]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][4]; ?></center> </td>

																																																							<? if($b == 1){ ?>
																																																							<td> <center><span onclick="deleteItemForm(7, <? echo $dataPuestaDIne[$h][0]; ?>, <? echo $idEnlace; ?>, <? echo $idPuestaDisposicion; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
																																																							<td> <center><span onclick="modalDineroAsegurado(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $dataPuestaDIne[$h][0]; ?>,<? echo $b; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center> </td>
																																																									<? } ?>
																																																				</tr>
																																																<?																																														
																																														}
																																														?>
																																																	 </tbody>
																																																		</table>
																																																		</div></center>
																																														<?
																																											}																														
																																					}  
																																					?>	



																									  </div>

																									  	<div id="ObjetosInvilcudaro">
																									  	

																									  				<?  if ($idPuestaDisposicion != 0) {			
																																											
																																											$dataPuestaDIne = get_data_objeto_puesta($conn, $idPuestaDisposicion, 0);																																								
																																											if(sizeof($dataPuestaDIne) > 0){
																																														?>
																																																					<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Objetos Involucrados</label>
																																																							<div class="row" style="padding: 20px;">																														
																																																									<table class="table table-striped">
																																																			  <thead>
																																																			     <tr>
																																																						      <th scope="col">#</th>
																																																						      <th scope="col"><center>Nombre de Objeto</center></th>
																																																						      <th scope="col"><center>Cantidad</center></th>
																																																						      <th scope="col"><center>Observaciones</center></th>

																																																						         <? if($b == 1){ ?>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <? } ?>
																																																						    </tr>
																																																						</thead>
																																																			  <tbody>
																																														<?
																																																	for ($h=0; $h < sizeof($dataPuestaDIne) ; $h++) { 																																										
																																																?>
																																																				<tr>																																																					
																																																							<td> <? echo ($h+1) ?> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][1]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][2]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][3]; ?></center> </td>

																																																							<? if($b == 1){ ?>
																																																							<td> <center><span onclick="deleteItemForm(8, <? echo $dataPuestaDIne[$h][0]; ?>, <? echo $idEnlace; ?>, <? echo $idPuestaDisposicion; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
																																																							<td> <center><span onclick="modalObjetoAsegurado(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>,<? echo $dataPuestaDIne[$h][0]; ?>,<? echo $b; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center> </td>
																																																									<? } ?>
																																																				</tr>
																																																<?																																														
																																														}
																																														?>
																																																	 </tbody>
																																																		</table>
																																																		</div></center>
																																														<?
																																											}																														
																																					}  
																																					?>	



																									  </div>


																									  <div id="trabaCampoInvolucrado">
																									  	

																									  				<?  if ($idPuestaDisposicion != 0) {			
																																											
																																											$dataPuestaDIne = get_data_trabajoCampo_puesta($conn, $idPuestaDisposicion, 0);																																								
																																											if(sizeof($dataPuestaDIne) > 0){
																																														?>
																																																					<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Trabajo de Campo Involucrado</label>
																																																							<div class="row" style="padding: 20px;">																														
																																																									<table class="table table-striped">
																																																			  <thead>
																																																			     <tr>
																																																						      <th scope="col">#</th>
																																																						      <th scope="col"><center>Entrevistas</center></th>
																																																						      <th scope="col"><center>Visitas Domiciliarias</center></th>																							      
																																																						      <th scope="col"><center>Investigaciones Cumplidas</center></th>
																																																						      <th scope="col"><center>Investigaciones Informadas</center></th>
																																																						      <th scope="col"><center>Individualizaciones</center></th>
																																																						      <th scope="col"><center>Solicitud de videos</center></th>
																																																						      <th scope="col"><center>Planimetrías</center></th>
																																																						      <th scope="col"><center>Reconocimiento en fila de persona</center></th>
																																																						      <th scope="col"><center>Reconocimiento de objetos</center></th>
																																																						      <th scope="col"><center>Reconocimiento de fotografías</center></th>
																																																						      <th scope="col"><center>Cadena de custodia</center></th>
																																																						      <th scope="col"><center>Traslados</center></th>
																																																						      <th scope="col"><center>Actos vigentes</center></th>
																																																						      <th scope="col"><center>Observaciones</center></th>

																																																						         <? if($b == 1){ ?>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <th scope="col"><center>Accion</center></th>
																																																						      <? } ?>
																																																						    </tr>
																																																						</thead>
																																																			  <tbody>
																																														<?
																																																	for ($h=0; $h < sizeof($dataPuestaDIne) ; $h++) { 																																										
																																																?>
																																																				<tr>																																																					
																																																							<td> <? echo ($h+1) ?> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][1]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][5]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][2]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][6]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][3]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][7]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][8]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][9]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][10]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][11]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][12]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][13]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][14]; ?></center> </td>
																																																							<td> <center><? echo $dataPuestaDIne[$h][4]; ?></center> </td>

																																																									<? if($b == 1){ ?>
																																																							<td> <center><span onclick="deleteItemForm(9, <? echo $dataPuestaDIne[$h][0]; ?>, <? echo $idEnlace; ?>, <? echo $idPuestaDisposicion; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
																																																							<td> <center><span onclick="modalTrabajosDeCampo(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <? echo $dataPuestaDIne[$h][0]; ?>,<? echo $b; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center> </td>
																																																						<? } ?>
																																																				</tr>
																																																<?																																														
																																														}
																																														?>
																																																	 </tbody>
																																																		</table>
																																																		</div></center>
																																														<?
																																											}																														
																																					}  
																																					?>	



																									  </div>



																									 </center>

																									   
																									  	</div>
																																							


																																				</div>

															
																											</div></center>



																							</div>


													

																


																</div>										

																</div>
																</div>

															</div>
											  

													</div>
											  


										<div class="row">

									<?if($typeArch == 12 && ($idEnlace != 266 && $idEnlace != 233 && $idEnlace != 225  && $idEnlace != 203) ){ ?>
										<div class="col-xs-12 col-sm-12 col-md-12"><center><button  style="width: 95%; background-color: #38537e; font-weight: bolder; color: white;" onclick="closeModalPueDispo()" type="button" class="btn redondear" data-dismiss="modal">Salir</button></center></div>
									<? }else{ if($b == 0){?>
												<div class="col-xs-12 col-sm-12 col-md-12"><center><button  style="width: 95%; background-color: #38537e; font-weight: bolder; color: white;" onclick="closeModalPueDispo()" type="button" class="btn redondear" data-dismiss="modal">Salir</button></center></div>
									<? }else{?> <div class="col-xs-12 col-sm-12 col-md-12"><center><button  style="width: 95%; background-color: #38537e; font-weight: bolder; color: white;" onclick="saveDataPuesta( <? echo $typeArch; ?>, <? echo $anio ?>, <? echo $idEnlace; ?>, 0, <? echo $messelected; ?>, <? echo $diaselected ?>, <? echo $typeCheck; ?> )" type="button" class="btn redondear" data-dismiss="modal">Salir y Guardar Edición</button></center></div> <? } }?>
												  
										</div> 

										<br>

