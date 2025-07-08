<?

session_start();
include("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionSicap.php");
include("../../funciones.php");

if (isset($_POST["nombreCompletoMP"])) {
	$nombreCompletoMP = $_POST["nombreCompletoMP"];
}
if (isset($_POST["idMp"])) {
	$idMp = $_POST["idMp"];
}
if (isset($_POST["idUnidad"])) {
	$idUnidad = $_POST["idUnidad"];
}
if (isset($_POST["mes"])) {
	$mes = $_POST["mes"];
}
if (isset($_POST["anio"])) {
	$anio = $_POST["anio"];
}
if (isset($_POST["idEnlace"])) {
	$idEnlace = $_POST["idEnlace"];
}

$datosenlace = getIdFiscaliaEnlace($conn, $idEnlace);
$idFiscalia = $datosenlace[0][0];
$idUsuario = $_SESSION['useridIE'];
$unInfo = getInfoUnidad($conn, $idUnidad);
$nomUnidad = $unInfo[0][1];

$anioAnte = 0;

if ($mes == 1) {
	$mesAnterior = 12;
	$anioAnte = ($anio - 1);
} else {
	$anioAnte = $anio;
	$mesAnterior = ($mes - 1);
}
//// VALIDAR SI LLEGO O SE FUE DE CAMBIO
$cambios = getCambioLitiMpMesAnio($conn, $mes, $anio, $idMp);
$cambio = $cambios[0][0];

/// SE DEJA EL MES ACTUAL POR QUE YA SE CUADRO AL MP EN EL MES QUE SE VA Y DEJA SUS NUMEROS	PRIMERO HAY QUE CUADRAR LOS DATOS EN LA UNIDAD ANTERIRO A LA CUAL PERTENECIO
$totalTramites = getTramiteANteriore($conn, $idMp, $mesAnterior, $idFiscalia, $idUnidad, $anioAnte);

if ($totalTramites) {
	$tramiteAnte = $totalTramites[0][0];

	$bandHabTramite = 0;
} else {
	$tramiteAnte = 0;
	$bandHabTramite = 1;
}
$datalit = getDatosLitigacionMpUnidad($conn, $idMp, $mes, $anio, $idFiscalia, $idUnidad);
if ($datalit) {
	$a = 1;
} else {
	$a = 0;
}

$dataTramite = getCarpetasAgenteLitigacion_totalTramite($conn, $idMp, 181, $mes, $anio, $idUnidad);
$total_tramite = $dataTramite[0][0];




?>

<div class="modal-header" style="background-color:#132C45;">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<center>
		<h4 class="modal-title" style="color:white; font-weight: bold;"> <? echo $nomUnidad; ?> </h4>
	</center><br>
	<center>
		<h5 class="modal-title" style="color:white; font-weight: ;"> <? echo $nombreCompletoMP; ?> </h5>
	</center>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoLitigacion" style="background-color:#f5eee5 !important;"><br>

	<div class="row" style="padding:0 !important; margin:0 !important;">
		<div class="col-md-2 col-sm-2 col-xs-12">
			<button type="button" class="btn w-100" style=" height: 75px; width:100% !important; color: white; background-color: #132C45 !important; opacity:0.8;" onclick="openEtapa(event, 'inicio')"><strong>A- Inicio</strong></button>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12">
			<button type="button" class="btn" style="background-color: #548687 !important; color: white; height: 75px; width:100% !important; opacity:0.8;" onclick="openEtapa(event, 'etapaInicial')"><strong>1- Etapa inicial</strong></button>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12">
			<button type="button" class="btn" style=" height: 75px; width:100% !important; color: white;  background-color: #8599B1 !important; opacity:0.8;" onclick="openEtapa(event, 'etapaIntermedia')"><strong>2- Etapa intermedia</strong></button>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12">
			<button type="button" class="btn" style="background-color: #7C6D8D !important; color: white; height: 75px; width:100% !important; opacity:0.8;" onclick="openEtapa(event, 'juicioOral')"><strong>3- Juicio oral</strong></button>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12">
			<button type="button" class="btn" style="height: 75px; width:100% !important; color: white; background-color: #9B6A6C !important; opacity:0.8;" onclick="openEtapa(event, 'salidasAlternas')"><strong>B- Salidas alternas y/o<br> terminación anticipada</strong></button>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12">
			<button type="button" class="btn w-100" style="height: 75px; width:100% !important; color: white; background-color: #CDA176 !important; opacity:0.8;" onclick="openEtapa(event, 'irnsetapaProc')"><strong>C- Incidentes y/o<br> recursos no sujetos <br> a etapa procesal</strong></button>
		</div>
	</div>

	<div class="row" style="padding: 25px;">

		<div class="row" id="litigation-form-container">
			<!-- PANTALLA INICIO -->
			<div id="inicio" class="tabcontent">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-default fd1" style="">
                            <div class="panel-body">
                                <h5 class="text-on-pannel"><strong> TRÁMITE </strong></h5>
                                <div class="iconiput">
                                    <input type="number" placeholder="cantidad" class="first" id="tramite_litigacion" value="<?echo $total_tramite; ?>" readonly/>
                                    <span onclick="sendDataModalTramite('tramite_litigacion',181,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkTramite_litigacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                </div>
                                <!--
                                <h5 class="text-on-pannel"><strong> Existencia Anterior </strong></h5>
                                <input class="form-control input-md redondear fdesv" id="tramAnt" type="number"
                                       value="<? if ($bandHabTramite == 1) {
                                           echo $tramiteAnte;
                                       } else {
                                           echo $tramiteAnte;
                                       } ?>" readonly onblur="sumTotCarpJudTram(event)">-->
                            </div>
						</div>
						<div class="panel panel-default fd1">
							<div class="panel-body">
								<h5 class="text-on-pannel"><strong> Recibidas </strong></h5>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<label class="colorLetras" for="inputlg">Recibidas por Otro Ministerio Público :</label>
										<div id="recibOmp"><input class="form-control input-md redondear fdesv" id="recibiOtmp" value="<? if ($a == 1) {
																																																																																																										echo $datalit[0][100];
																																																																																																									} else {
																																																																																																										echo 0;
																																																																																																									} ?>" type="number"><br></div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12">
										<label class="colorLetras" for="inputlg">Carpetas judicializadas :</label>
										<div id="totalJudicializadas"><input class="form-control input-md redondear fdesv" id="totJudic" value="<? if ($a == 1) {
																																																																																																																			echo  $datalit[0][1];
																																																																																																																		} else {
																																																																																																																			echo 0;
																																																																																																																		} ?>" type="number" readonly=""></div>
									</div>
								</div><br>
								<div class="row">
									<div class="col-xs-6">
										<label class="colorLetras" for="inputlg">Con Detenido :</label>
										<div class="iconiput">
											<input type="number" placeholder="cantidad" value="<? if ($a == 1) {
																																																															echo  $datalit[0][2];
																																																														} ?>" class="first" onblur="sumJudicialized(event)" id="cdete" />
											<span onclick="sendDataModalLitigacion('cdete',1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
												<div id="checCdeten"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>
									</div>
									<div class="col-xs-6">
										<label class="colorLetras" for="inputlg">Sin Detenido :</label>
										<div class="iconiput">
											<input type="number" placeholder="cantidad" value="<? if ($a == 1) {
																																																															echo  $datalit[0][3];
																																																														} ?>" class="first" onblur="sumJudicialized(event)" id="sdete" />
											<span onclick="sendDataModalLitigacion('sdete',2,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
												<div id="checSdeten"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- PANTALLA INICIO -->

			<!-- PANTALLA ETAPA INICIAL  -->
			<div id="etapaInicial" class="tabcontent">
				<div style=" padding: 5px; opacity: 0.9;">
					<div style="background-color: #548687; padding: 4px; color: white; text-align: center; font-size: xx-large; ">Etapa inicial judicializada
					</div><br>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Formulaciones de Imputación </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Solicitadas :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="FIsolic" value="<? if ($a == 1) {
																																																																																									echo  $datalit[0][91];
																																																																																								} else {
																																																																																									echo 0;
																																																																																								} ?>" />
										<span onclick="sendDataModalLitigacion('FIsolic',3,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkFIsolic"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Otorgadas :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="FIotor" value="<? if ($a == 1) {
																																																																																								echo  $datalit[0][92];
																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('FIotor',4,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkFIotor"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Negadas :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="FInega" value="<? if ($a == 1) {
																																																																																								echo  $datalit[0][93];
																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('FInega',5,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkFInega"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Control de la Detención </strong></h5>
							<div class="row">
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Legal :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="sumJudicialized(event)" id="legal" value="<? if ($a == 1) {
																																																																																																																							echo  $datalit[0][94];
																																																																																																																						} ?>" />
										<span onclick="sendDataModalLitigacion('legal',6,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checklegal"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Ilegal :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="sumJudicialized(event)" id="ilegal" value="<? if ($a == 1) {
																																																																																																																								echo  $datalit[0][95];
																																																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('ilegal',7,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkilegal"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Vinculación a Proceso </strong></h5>
							<div class="row">

								<div class="col-xs-4">

									<label class="colorLetras" for="inputlg">Auto de vinculación :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="auvinc" onblur="sumTotCarpJudTram(event);" value="<? if ($a == 1) {
																																																																																																																											echo  $datalit[0][4];
																																																																																																																										} ?>" />
										<span onclick="sendDataModalLitigacion('auvinc',151,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkauvinc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>

								</div>


								<div class="col-xs-4">
									<label class="colorLetras" for="inputlg">Auto de no vinculación :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="aunvinc" onblur="sumTotCarpJudTram(event);" value="<? if ($a == 1) {
																																																																																																																												echo  $datalit[0][5];
																																																																																																																											} ?>" />
										<span onclick="sendDataModalLitigacion('aunvinc',10,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkaunvinc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>



								<div class="col-xs-4">
									<label class="colorLetras" for="inputlg">Mixtos :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="mix" value="<? if ($a == 1) {
																																																																																					echo  $datalit[0][6];
																																																																																				} ?>" />
										<span onclick="sendDataModalLitigacion('mix',12,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkmix"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Medidas Cautelares </strong></h5>
							<div class="row">
								<div class="col-xs-12">
									<div class="row">
										<div class="col-xs-4">
											<label class="colorLetras" for="inputlg">Solicitadas :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="MCsol" value="<? if ($a == 1) {
																																																																																									echo  $datalit[0][96];
																																																																																								} ?>" />
												<span onclick="sendDataModalLitigacion('MCsol',98,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkMCsol"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-4">
											<label class="colorLetras" for="inputlg">Otorgadas :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="MCotor" value="<? if ($a == 1) {
																																																																																										echo  $datalit[0][98];
																																																																																									} ?>" />
												<span onclick="sendDataModalLitigacion('MCotor',97,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkMCotor"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-4">
											<label class="colorLetras" for="inputlg">Negadas :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="MCnega" value="<? if ($a == 1) {
																																																																																										echo  $datalit[0][97];
																																																																																									} ?>" />
												<span onclick="sendDataModalLitigacion('MCnega',96,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkMCnega"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="colorLetras" for="inputlg">Imposición de medidas cautelares :</label>
											<div id="totalJudicializadas"><input class="form-control input-md redondear fdesv" id="IMC" value="<? if ($a == 1) {
																																																																																																															echo  $datalit[0][7];
																																																																																																														} else {
																																																																																																															echo 0;
																																																																																																														} ?>" type="number" readonly="">
											</div>
										</div>
									</div><br>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">Prisión preventiva oficiosa :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="ppofic" value="<? if ($a == 1) {
																																																																																																																					echo  $datalit[0][8];
																																																																																																																				} ?>" />
												<span onclick="sendDataModalLitigacion('ppofic',17,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkppofic"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">Prisión preventiva justificada :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="ppjus" value="<? if ($a == 1) {
																																																																																																																				echo  $datalit[0][9];
																																																																																																																			} ?>" />
												<span onclick="sendDataModalLitigacion('ppjus',18,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkppjus"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">Presentación periódica ante el juez :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="ppanju" value="<? if ($a == 1) {
																																																																																																																					echo  $datalit[0][10];
																																																																																																																				} ?>" />
												<span onclick="sendDataModalLitigacion('ppanju',95,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkppanju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">La exhibición de una garantía económica :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="exgaeco" value="<? if ($a == 1) {
																																																																																																																						echo  $datalit[0][11];
																																																																																																																					} ?>" />
												<span onclick="sendDataModalLitigacion('exgaeco',20,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkexgaeco"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">El embargo de bienes :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="emvien" value="<? if ($a == 1) {
																																																																																																																					echo  $datalit[0][12];
																																																																																																																				} ?>" />
												<span onclick="sendDataModalLitigacion('emvien',21,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkemvien"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">La inmovilización de cuentas y demás valores :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="incuval" value="<? if ($a == 1) {
																																																																																																																						echo  $datalit[0][13];
																																																																																																																					} ?>" />
												<span onclick="sendDataModalLitigacion('incuval',22,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkincuval"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">La prohibición de salir sin autorización que fije el juez :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="pssafj" value="<? if ($a == 1) {
																																																																																																																					echo  $datalit[0][14];
																																																																																																																				} ?>" />
												<span onclick="sendDataModalLitigacion('pssafj',23,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkpssafj"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">El sometimiento al cuidado o vigilancia o institución determinada :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="scviind" value="<? if ($a == 1) {
																																																																																																																						echo  $datalit[0][15];
																																																																																																																					} ?>" />
												<span onclick="sendDataModalLitigacion('scviind',24,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkscviind"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">La prohibición de concurrir a determinadas reuniones o ciertos lugares :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="pcdrclug" value="<? if ($a == 1) {
																																																																																																																							echo  $datalit[0][16];
																																																																																																																						} ?>" />
												<span onclick="sendDataModalLitigacion('pcdrclug',25,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkpcdrclug"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">La prohibición de convivir o comunicarse con determinadas personas :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="pccdper" value="<? if ($a == 1) {
																																																																																																																						echo  $datalit[0][17];
																																																																																																																					} ?>" />
												<span onclick="sendDataModalLitigacion('pccdper',26,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkpccdper"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">La separación inmediata del domicilio :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="sindom" value="<? if ($a == 1) {
																																																																																																																					echo  $datalit[0][18];
																																																																																																																				} ?>" />
												<span onclick="sendDataModalLitigacion('sindom',27,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checksindom"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">La suspensión temporal en el ejercicio del cargo :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="steeca" value="<? if ($a == 1) {
																																																																																																																					echo  $datalit[0][19];
																																																																																																																				} ?>" />
												<span onclick="sendDataModalLitigacion('steeca',28,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checksteeca"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">La suspensión temporal en actividad profesional o laboral :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="steapl" value="<? if ($a == 1) {
																																																																																																																					echo  $datalit[0][20];
																																																																																																																				} ?>" />
												<span onclick="sendDataModalLitigacion('steapl',29,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checksteapl"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">La colocación de localizadores electrónicos :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="coloele" value="<? if ($a == 1) {
																																																																																																																						echo  $datalit[0][21];
																																																																																																																					} ?>" />
												<span onclick="sendDataModalLitigacion('coloele',30,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkcoloele"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label class="colorLetras" for="inputlg">El resguardo en su propio domicilio con las modalidades que el juez disponga :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="rpdmjd" value="<? if ($a == 1) {
																																																																																																																					echo  $datalit[0][22];
																																																																																																																				} ?>" />
												<span onclick="sendDataModalLitigacion('rpdmjd',31,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkrpdmjd"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-4">
											<hr>
											<label class="colorLetras" for="inputlg">Citaciones :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="citac" value="<? if ($a == 1) {
																																																																																									echo  $datalit[0][32];
																																																																																								} ?>" />
												<span onclick="sendDataModalLitigacion('citac',33,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkcitac"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Cateos </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Cateos solicitados :</label>
									<input type="number" placeholder="" value="<? if ($a == 1) {
																																																					echo  $datalit[0][33];
																																																				} else {
																																																					echo 0;
																																																				} ?>" disabled="" class="first" id="CS" />
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Cateos concedidos :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="Cconc" onblur="sumcateos(event)" value="<? if ($a == 1) {
																																																																																																																	echo  $datalit[0][34];
																																																																																																																} ?>" />
										<span onclick="sendDataModalLitigacion('Cconc',34,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkCconc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Cateos negados :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="Cnega" onblur="sumcateos(event)" value="<? if ($a == 1) {
																																																																																																																	echo  $datalit[0][35];
																																																																																																																} ?>" />
										<span onclick="sendDataModalLitigacion('Cnega',35,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkCnega"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Ordenes </strong></h5>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <label class="colorLetras" for="inputlg">Ordenes solicitadas :</label>
                                    <input type="number" value="<? if ($a == 1) {
                                        echo  $datalit[0][102];
                                    } else {
                                        echo 0;
                                    } ?>" placeholder="" disabled="" class="first" id="OS" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <label class="colorLetras" for="inputlg">Aprehensión :</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="OSapre" onblur="sumcordnesSoli(event)" value="<? if ($a == 1) {
                                            echo  $datalit[0][103];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('OSapre',112,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkOSapre"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <label class="colorLetras" for="inputlg">Comparecencia :</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="OScomp" onblur="sumcordnesSoli(event)" value="<? if ($a == 1) {
                                            echo  $datalit[0][104];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('OScomp',113,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkOScomp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>
                            </div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Ordenes negadas :</label>
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][36];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="ON" />
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Aprehensión :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ONapre" onblur="sumcordnes(event)" value="<? if ($a == 1) {
																																																																																																																			echo  $datalit[0][37];
																																																																																																																		} ?>" />
										<span onclick="sendDataModalLitigacion('ONapre',36,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkONapre"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Comparecencia :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ONcomp" onblur="sumcordnes(event)" value="<? if ($a == 1) {
																																																																																																																			echo  $datalit[0][38];
																																																																																																																		} ?>" />
										<span onclick="sendDataModalLitigacion('ONcomp',38,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkONcomp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Mandamientos judiciales girados </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Girados :</label>
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][50];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="MJG" />
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Ordenes de aprehensión :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="MJGorap" onblur="sumManJudGir(event)" value="<? if ($a == 1) {
																																																																																																																						echo  $datalit[0][51];
																																																																																																																					} ?>" />
										<span onclick="sendDataModalLitigacion('MJGorap',50,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkMJGorap"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Ordenes de comparecencia :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="MJGorcomp" onblur="sumManJudGir(event)" value="<? if ($a == 1) {
																																																																																																																								echo  $datalit[0][52];
																																																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('MJGorcomp',53,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkMJGorcomp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Mandamientos judiciales cumplidos </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Cumplidos :</label>
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][53];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="MJC" />
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Ordenes de aprehensión :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="MJCorapre" onblur="sumManJudCump(event)" value="<? if ($a == 1) {
																																																																																																																									echo  $datalit[0][54];
																																																																																																																								} ?>" />
										<span onclick="sendDataModalLitigacion('MJCorapre',57,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkMJCorapre"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Ordenes de comparecencia :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="MJCordcomp" onblur="sumManJudCump(event)" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][55];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('MJCordcomp',58,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkMJCordcomp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Medidas de protección </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-3">
									<? $getTotalVic = getDataMedidasProteccionMP($conn, $idMp, $mes, $anio, $idUnidad); ?>
									<label class="colorLetras" for="inputlg">Total de víctimas de protección :</label>
									<input type="number" value="<? echo $getTotalVic[0][0]; ?>" placeholder="" disabled="" class="first" id="MPV" />
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Medidas de protección :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="medidasProteccion" value="<? if ($a == 1) {
																																																																																																			echo  $datalit[0][105];
																																																																																																		} ?>" />
										<span onclick="sendDataModalLitigacion('medidasProteccion',129,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkMedidasProteccion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>

                    <!--AUDIENCIA INICIAL-->
                    <div class="panel panel-default fd1">
                        <div class="panel-body">
                            <h5 class="text-on-pannel"><strong> Audiencias iniciales </strong></h5>
                            <div class="row">

                                <div class="col-xs-4">
                                    <label class="colorLetras" for="inputlg">Audiencia inicial :</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="audiencia_incial" onblur="sumTotCarpJudTram(event);" value="<? if ($a == 1) {
                                            echo  $datalit[0][147];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('audiencia_incial',166,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="check_audiencia_incial"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--PRUEBA ANTICIPADA-->
                    <div class="panel panel-default fd1">
                        <div class="panel-body">
                            <h5 class="text-on-pannel"><strong> Pruebas anticipadas </strong></h5>
                            <div class="row">

                                <div class="col-xs-4">
                                    <label class="colorLetras" for="inputlg">Prueba anticipada :</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="prueba_anticipada" onblur="sumTotCarpJudTram(event);" value="<? if ($a == 1) {
                                            echo  $datalit[0][148];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('prueba_anticipada',167,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="check_prueba_anticipada"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--ESCRITO DE ACUSACION-->
                    <div class="panel panel-default fd1">
                        <div class="panel-body">
                            <h5 class="text-on-pannel"><strong> Escritos de acusación </strong></h5>
                            <div class="row">

                                <div class="col-xs-4">
                                    <label class="colorLetras" for="inputlg">Escrito de acusación :</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="escrito_acusacion" onblur="sumTotCarpJudTram(event);" value="<? if ($a == 1) {
                                            echo  $datalit[0][149];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('escrito_acusacion',168,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="check_escrito_acusacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--Actos de investigación complementaria-->
                    <div class="panel panel-default fd1">
                        <div class="panel-body">
                            <h5 class="text-on-pannel"><strong> Actos de investigación complementaria </strong></h5>
                            <div class="row">

                                <div class="col-xs-4">
                                    <label class="colorLetras" for="inputlg">Actos de investigación complementaria :</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="investigacion_complementaria" onblur="sumTotCarpJudTram(event);" value="<? if ($a == 1) {
                                            echo  $datalit[0][150];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('investigacion_complementaria',170,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="check_investigacion_complementaria"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--TECNICAS DE INVESTIGACION ESPECIALES-->
                    <div class="panel panel-default fd1">
                        <div class="panel-body">
                            <h5 class="text-on-pannel"><strong> Técnicas de investigación especiales </strong></h5>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label class="colorLetras" for="inputlg">Otorgadas :</label>
                                    <input type="number" value="<? if ($a == 1) {
                                        echo  $datalit[0][159];
                                    } else {
                                        echo 0;
                                    } ?>" placeholder="" disabled="" class="first" id="TIE_otorgadas" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label class="colorLetras" for="inputlg">Intervención de comunicaciones privadas :</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="TIE_intervencion_comunicaciones" onblur="sumTIEotorgadas(event)" value="<? if ($a == 1) {
                                            echo  $datalit[0][153];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('TIE_intervencion_comunicaciones',173,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkTIE_intervencion_comunicaciones"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label class="colorLetras" for="inputlg">Datos conservados</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="TIE_datos_conservados" onblur="sumTIEotorgadas(event)" value="<? if ($a == 1) {
                                            echo $datalit[0][154];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('TIE_datos_conservados',175,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkTIE_datos_conservados"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label class="colorLetras" for="inputlg">Datos bancarios :</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="TIE_datos_bancarios" onblur="sumTIEotorgadas(event)" value="<? if ($a == 1) {
                                            echo $datalit[0][155];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('TIE_datos_bancarios',176,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkTIE_datos_bancarios"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label class="colorLetras" for="inputlg">Negadas :</label>
                                    <input type="number" value="<? if ($a == 1) {
                                        echo  $datalit[0][160];
                                    } else {
                                        echo 0;
                                    } ?>" placeholder="" disabled="" class="first" id="TIE_negadas" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label class="colorLetras" for="inputlg">Intervención de comunicaciones privadas :</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="TIEneg_intervencion_comunicaciones" onblur="sumTIEnegadas(event)" value="<? if ($a == 1) {
                                            echo  $datalit[0][156];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('TIEneg_intervencion_comunicaciones',178,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="check_TIEneg_intervencion_comunicaciones"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label class="colorLetras" for="inputlg">Datos conservados</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="TIEneg_datos_conservados" onblur="sumTIEnegadas(event)" value="<? if ($a == 1) {
                                            echo $datalit[0][157];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('TIEneg_datos_conservados',179,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkTIEneg_datos_conservados"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label class="colorLetras" for="inputlg">Datos bancarios :</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="TIEneg_datos_bancarios" onblur="sumTIEnegadas(event)" value="<? if ($a == 1) {
                                            echo $datalit[0][158];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('TIEneg_datos_bancarios',180,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkTIEneg_datos_bancarios"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

					<!--Actos de investigación con control judicial NUEVO-->
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Actos de investigación CON control judicial </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-3">
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][107];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="AICJ" />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Intervención en tiempo real :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="intervencionTR" onblur="sumActInvConJud(event)" value="<? if ($a == 1) {
																																																																																																																																echo  $datalit[0][108];
																																																																																																																															} ?>" />
										<span onclick="sendDataModalLitigacion('intervencionTR',114,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkIntervencionTR"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Toma de muestras</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="tomaMuestras" onblur="sumActInvConJud(event)" value="<? if ($a == 1) {
																																																																																																																														echo $datalit[0][109];
																																																																																																																													} ?>" />
										<span onclick="sendDataModalLitigacion('tomaMuestras',115,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkTomaMuestras"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Exhumación :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="exhumacion" onblur="sumActInvConJud(event)" value="<? if ($a == 1) {
																																																																																																																												echo $datalit[0][110];
																																																																																																																											} ?>" />
										<span onclick="sendDataModalLitigacion('exhumacion',116,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkExhumacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Obtención de datos reservados :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="obDatosReservados" onblur="sumActInvConJud(event)" value="<? if ($a == 1) {
																																																																																																																																			echo $datalit[0][111];
																																																																																																																																		} ?>" />
										<span onclick="sendDataModalLitigacion('obDatosReservados',117,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkObDatosReservados"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Intervención de comunicación en su modalidad de extracción :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="intervencionCME" onblur="sumActInvConJud(event)" value="<? if ($a == 1) {
																																																																																																																																	echo $datalit[0][112];
																																																																																																																																} ?>" />
										<span onclick="sendDataModalLitigacion('intervencionCME',119,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkIntervencionCME"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">La providencia precautoria (embargo de bienes e inmovilizacion de cuentas bancarias)</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="provPrecautoria" onblur="sumActInvConJud(event)" value="<? if ($a == 1) {
																																																																																																																																	echo $datalit[0][113];
																																																																																																																																} ?>" />
										<span onclick="sendDataModalLitigacion('provPrecautoria',120,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkProvPrecautoria"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Actos de investigación con control judicial NUEVO-->
					<!--Actos de investigación SIN control judicial NUEVO-->
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Actos de investigación SIN control judicial </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-3">
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][114];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="AISCJ" />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Cadena de custodia :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="cadCustodia" onblur="sumActInvSinConJud(event)" value="<? if ($a == 1) {
																																																																																																																																echo $datalit[0][115];
																																																																																																																															} ?>" />
										<span onclick="sendDataModalLitigacion('cadCustodia',121,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkCadCustodia"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Inspección de lugar distinto a hechos :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="InspLugDis" onblur="sumActInvSinConJud(event)" value="<? if ($a == 1) {
																																																																																																																															echo $datalit[0][116];
																																																																																																																														} ?>" />
										<span onclick="sendDataModalLitigacion('InspLugDis',122,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkInspLugDis"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Inspección de inmuebles :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="InspInmuebles" onblur="sumActInvSinConJud(event)" value="<? if ($a == 1) {
																																																																																																																																		echo $datalit[0][117];
																																																																																																																																	} ?>" />
										<span onclick="sendDataModalLitigacion('InspInmuebles',123,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkInspInmuebles"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Entrevistas entre testigos :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="entrevistasTestigos" onblur="sumActInvSinConJud(event)" value="<? if ($a == 1) {
																																																																																																																																								echo $datalit[0][118];
																																																																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('entrevistasTestigos',124,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkEntrevistasTestigos"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Reconocimiento entre personas :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="reconocimientoPer" onblur="sumActInvSinConJud(event)" value="<? if ($a == 1) {
																																																																																																																																						echo $datalit[0][119];
																																																																																																																																					} ?>" />
										<span onclick="sendDataModalLitigacion('reconocimientoPer',125,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkReconocimientoPer"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Solicitud de informes periciales :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="solInfoPericiales" onblur="sumActInvSinConJud(event)" value="<? if ($a == 1) {
																																																																																																																																						echo $datalit[0][120];
																																																																																																																																					} ?>" />
										<span onclick="sendDataModalLitigacion('solInfoPericiales',126,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSolInfoPericiales"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Solicitud de información de Institutos de Seguridad :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="InfInstiSeg" onblur="sumActInvSinConJud(event)" value="<? if ($a == 1) {
																																																																																																																																echo $datalit[0][121];
																																																																																																																															} ?>" />
										<span onclick="sendDataModalLitigacion('InfInstiSeg',127,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkInfInstiSeg"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label class="colorLetras" for="inputlg">Reconocimiento o examen físico de persona :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="examenFisPersona" onblur="sumActInvSinConJud(event)" value="<? if ($a == 1) {
																																																																																																																																					echo $datalit[0][122];
																																																																																																																																				} ?>" />
										<span onclick="sendDataModalLitigacion('examenFisPersona',128,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkExamenFisPersona"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Actos de investigación SIN control judicial NUEVO-->
				</div>
			</div>
			<!-- PANTALLA ETAPA INICIAL  -->

			<!--	PANTALLA ETAPA INTERMEDIA-->
			<div id="etapaIntermedia" class="tabcontent">
				<div style="padding: 0px; opacity: 0.9;">
					<div style="background-color: #8599B1; padding: 10px; color: white; text-align: center; font-size: xx-large;">Etapa intermedia</div><br>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Acusaciones presentadas </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Total :</label>
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][99];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="ACPRE" />
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Audiencia intermedia escrita :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ACPREaie" onblur="sumAcusaPres(event)" value="<? if ($a == 1) {
																																																																																																																							echo  $datalit[0][57];
																																																																																																																						} ?>" />
										<span onclick="sendDataModalLitigacion('ACPREaie',61,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkACPREaie"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Audiencia intermedia oral :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ACPREaio" onblur="sumAcusaPres(event)" value="<? if ($a == 1) {
																																																																																																																							echo  $datalit[0][58];
																																																																																																																						} ?>" />
										<span onclick="sendDataModalLitigacion('ACPREaio',63,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkACPREaio"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--	PANTALLA ETAPA INTERMEDIA-->

			<!--PANTALLA JUICIO ORAL-->
			<div id="juicioOral" class="tabcontent">
				<div style="opacity: 0.9;">
					<div style="background-color: #7C6D8D; padding: 10px; color: white; text-align: center; font-size: xx-large;">Juicio Oral</div><br>
					<!--Audiencias de Juicio Oral-->
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Resoluciones de Juicio Oral </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<input type="number" value="<? if ($a == 1) {
																																						echo $datalit[0][123];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="RESOJuiOral" />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Audiencia de juicio oral :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="audJuiOral" onblur="sumResoJuicioOral(event)" value="<? if ($a == 1) {
																																																																																																																														echo  $datalit[0][124];
																																																																																																																													} ?>" />
										<span onclick="sendDataModalLitigacion('audJuiOral',140,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkAudJuiOral"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Audiencia de fallo :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="audFallo" onblur="sumResoJuicioOral(event)" value="<? if ($a == 1) {
																																																																																																																												echo  $datalit[0][125];
																																																																																																																											} ?>" />
										<span onclick="sendDataModalLitigacion('audFallo',139,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkAudFallo"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Absolutorio :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="absolutorio" onblur="sumResoJuicioOral(event)" value="<? if ($a == 1) {
																																																																																																																															echo  $datalit[0][126];
																																																																																																																														} ?>" />
										<span onclick="sendDataModalLitigacion('absolutorio',141,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkAbsolutorio"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Audiencia de individualización de sanción :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="AudIndiSan" onblur="sumResoJuicioOral(event)" value="<? if ($a == 1) {
																																																																																																																														echo  $datalit[0][127];
																																																																																																																													} ?>" />
										<span onclick="sendDataModalLitigacion('AudIndiSan',144,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkAIDS"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Procedimiento especial :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="procEspecial" onblur="sumResoJuicioOral(event)" value="<? if ($a == 1) {
																																																																																																																																echo  $datalit[0][128];
																																																																																																																															} ?>" />
										<span onclick="sendDataModalLitigacion('procEspecial',145,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkProcEspecial"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Condenatorio :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="audCondenatorio" onblur="sumResoJuicioOral(event)" value="<? if ($a == 1) {
																																																																																																																																			echo  $datalit[0][129];
																																																																																																																																		} ?>" />
										<span onclick="sendDataModalLitigacion('audCondenatorio',142,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkAudCondenatorio"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <label class="colorLetras" for="inputlg">Audiencia de ejecución de sanciones:</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="aud_ejecucion_sanciones" onblur="sumResoJuicioOral(event)" value="<? if ($a == 1) {
                                            echo  $datalit[0][151];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('aud_ejecucion_sanciones',171,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="check_aud_ejecucion_sanciones"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
					<!--Audiencias de Juicio Oral-->
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Sentencias </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][62];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="SEN" />
								</div>
							</div>
							<div class="row">


								<div class="col-xs-4">
									<label class="colorLetras" for="inputlg">Condenatorias :</label>
									<div class="iconiput">
										<!-- Enviar a sicap  --> <input type="number" placeholder="cantidad" class="first" id="SENcon" onblur="sumsentencias(event)" value="<? if ($a == 1) {
																																																																																																																																															echo  $datalit[0][63];
																																																																																																																																														} ?>" />
										<span onclick="sendDataModalLitigacion('SENcon',154,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSENcon"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>

									</div>

								</div>


								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Absolutorias :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="SENabsol" onblur="sumsentencias(event)" value="<? if ($a == 1) {
																																																																																																																								echo  $datalit[0][64];
																																																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('SENabsol',66,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSENabsol"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Mixtas :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="SENmixc" onblur="sumsentencias(event)" value="<? if ($a == 1) {
																																																																																																																							echo  $datalit[0][65];
																																																																																																																						} ?>" />
										<span onclick="sendDataModalLitigacion('SENmixc',67,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSENmixc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Se condena reparación del daños :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="SENsreda" onblur="sumsentencias(event)" value="<? if ($a == 1) {
																																																																																																																								echo  $datalit[0][66];
																																																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('SENsreda',68,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSENsreda"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">No se condena reparación del daño :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="SENnocreda" onblur="sumsentencias(event)" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][67];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('SENnocreda',69,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSENnocreda"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<label class="colorLetras" for="inputlg">Total de audiencias :</label>
							<div class="iconiput">
								<input type="number" placeholder="cantidad" class="first" id="totAudiencias" value="<? if ($a == 1) {
																																																																																													echo  $datalit[0][56];
																																																																																												} ?>" />
								<span onclick="sendDataModalLitigacion('totAudiencias',60,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
									<div id="checktotAudiencias"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
								</span>
							</div>
						</div>
					</div><br>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> De las sentencias dictadas </strong></h5>
							<div class="row">
								<div class="col-xs-12">
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][86];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="DSED" />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-4">
									<label class="colorLetras" for="inputlg">Revocaciones favorables al Ministerio Publico :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="DSEDrfmp" onblur="sumSentencDictadas(event)" value="<? if ($a == 1) {
																																																																																																																													echo  $datalit[0][87];
																																																																																																																												} ?>" />
										<span onclick="sendDataModalLitigacion('DSEDrfmp',85,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkDSEDrfmp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-4">
									<label class="colorLetras" for="inputlg">Modificaciones favorables al Ministerio Publico :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="DSEDmfmp" onblur="sumSentencDictadas(event)" value="<? if ($a == 1) {
																																																																																																																													echo  $datalit[0][88];
																																																																																																																												} ?>" />
										<span onclick="sendDataModalLitigacion('DSEDmfmp',86,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkDSEDmfmp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-4">
									<label class="colorLetras" for="inputlg">Confirmaciones favorables al Ministerio Publico :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="DSEDcfmp" onblur="sumSentencDictadas(event)" value="<? if ($a == 1) {
																																																																																																																													echo  $datalit[0][89];
																																																																																																																												} ?>" />
										<span onclick="sendDataModalLitigacion('DSEDcfmp',87,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkDSEDcfmp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--PANTALLA JUICIO ORAL-->

			<!--PANTALLA SALIDAS ALTERNAS-->
			<div id="salidasAlternas" class="tabcontent">
				<div style=" padding: 5px; opacity: 0.9;">
					<div style="background-color: #9B6A6C;padding: 10px; color: white; text-align: center; font-size: xx-large;">Salidas alternas y/o terminación anticipada</div><br>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Soluciones alternas </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Soluciones alternas :</label>
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][59];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="SOAL" />
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Suspensión condicional del proceso :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="SOALscp" onblur="sumSolAltern(event)" value="<? if ($a == 1) {
																																																																																																																						echo  $datalit[0][60];
																																																																																																																					} ?>" />
										<span onclick="sendDataModalLitigacion('SOALscp',64,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSOALscp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Acuerdo reparatorio :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="SOALarep" onblur="sumSolAltern(event)" value="<? if ($a == 1) {
																																																																																																																							echo  $datalit[0][61];
																																																																																																																						} ?>" />
										<span onclick="sendDataModalLitigacion('SOALarep',65,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSOALarep"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Procedimientos Abreviados </strong></h5>
							<div class="row">

								<div class="col-xs-12">
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="proabre" onblur="sumTotCarpJudTram(event)" value="<? if ($a == 1) {
																																																																																																																											echo  $datalit[0][30];
																																																																																																																										} ?>" />
										<!-- Enviar a sicap  --> <span onclick="sendDataModalLitigacion('proabre',153,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkproabre"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>

									</div>
								</div>



							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Mecanismos de aceleración </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Mecanismos de aceleración :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="mecanismosAceleracion" onblur="" value="<? if ($a == 1) {
																																																																																																																	echo  $datalit[0][130];
																																																																																																																} ?>" /> <span onclick="sendDataModalLitigacion('mecanismosAceleracion',146,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkMecanismoAcele"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--PANTALLA SALIDAS ALTERNAS-->

			<!--PANTALLA INCIDENTES Y/O RECURSOS NO SUJETOS A ETAPA PROCESAL-->
			<div id="irnsetapaProc" class="tabcontent">
				<div style="padding: 5px; opacity: 0.9;">
					<div style="background-color: #CDA176;padding: 10px; color: white; text-align: center; font-size: xx-large;">Incidentes y/o recursos no sujetos a etapa procesal</div><br>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Apelaciones contra resolución del juez de control </strong></h5>
							<div class="row">
								<div class="col-xs-12">
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][71];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="ARJ" />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6">
									<label class="colorLetras" for="inputlg">Negar anticipo de prueba :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARJnap" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][72];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('ARJnap',72,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARJnap"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6">
									<label class="colorLetras" for="inputlg">Negar acuerdo reparatorio :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARJnar" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][73];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('ARJnar',73,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARJnar"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6">
									<label class="colorLetras" for="inputlg">Negar o cancelar orden de aprehensión :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARJncoap" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
																																																																																																																												echo  $datalit[0][74];
																																																																																																																											} ?>" />
										<span onclick="sendDataModalLitigacion('ARJncoap',74,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARJncoap"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6">
									<label class="colorLetras" for="inputlg">Negar orden de cateo :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARJnoc" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][75];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('ARJnoc',75,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARJnoc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6">
									<label class="colorLetras" for="inputlg">Providencias precautorias o medida cautelar :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARJppmc" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
																																																																																																																											echo  $datalit[0][76];
																																																																																																																										} ?>" />
										<span onclick="sendDataModalLitigacion('ARJppmc',76,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARJppmc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6">
									<label class="colorLetras" for="inputlg">Las que pongan termino al procedimiento o lo suspendan:</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARJtps" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][77];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('ARJtps',77,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARJtps"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6">
									<label class="colorLetras" for="inputlg">auto que resuelve la vinculación a proceso :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARJrvp" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][78];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('ARJrvp',78,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARJrvp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6">
									<label class="colorLetras" for="inputlg">Las que concedan, revoquen o nieguen la suspensión condicional del proceso:</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARJrnscp" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
																																																																																																																												echo  $datalit[0][79];
																																																																																																																											} ?>" />
										<span onclick="sendDataModalLitigacion('ARJrnscp',79,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARJrnscp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6">
									<label class="colorLetras" for="inputlg">Negativa de abrir el procedimiento abreviado :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARJnapa" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
																																																																																																																											echo  $datalit[0][80];
																																																																																																																										} ?>" />
										<span onclick="sendDataModalLitigacion('ARJnapa',80,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSARJnapa"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6">
									<label class="colorLetras" for="inputlg">Sentencia definitiva en el procedimiento abreviado:</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARJsdpa" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
																																																																																																																											echo  $datalit[0][81];
																																																																																																																										} ?>" />
										<span onclick="sendDataModalLitigacion('ARJsdpa',81,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARJsdpa"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6">
									<label class="colorLetras" for="inputlg">Excluir algún medio de prueba :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARJemp" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][82];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('ARJemp',82,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARJemp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label class="colorLetras" for="inputlg">Apelaciones que revocan o modifican las absolutorias :</label>
                                    <div class="iconiput">
                                        <input type="number" placeholder="cantidad" class="first" id="ap_revocan_absolutoria" onblur="sumApelaJuControl(event)" value="<? if ($a == 1) {
                                            echo  $datalit[0][152];
                                        } ?>" />
                                        <span onclick="sendDataModalLitigacion('ap_revocan_absolutoria',172,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="check_ap_revocan_absolutoria"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Apelaciones no admitidas :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="apenoadmi" value="<? if ($a == 1) {
																																																																																											echo  $datalit[0][43];
																																																																																										} ?>" />
										<span onclick="sendDataModalLitigacion('apenoadmi',44,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkapenoadmi"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Apelaciones por amparo :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="apeamparo" value="<? if ($a == 1) {
																																																																																											echo  $datalit[0][131];
																																																																																										} ?>" />
										<span onclick="sendDataModalLitigacion('apeamparo',147,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkapeamparo"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Amparos </strong></h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Total :</label>
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][132];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="amparos" />
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Amparo directo :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="amparoDirecto" onblur="sumAmparo(event)" value="<? if ($a == 1) {
																																																																																																																									echo  $datalit[0][133];
																																																																																																																								} ?>" />
										<span onclick="sendDataModalLitigacion('amparoDirecto',148,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkAmparoDirecto"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label class="colorLetras" for="inputlg">Amparo indirecto :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="amparoIndirecto" onblur="sumAmparo(event)" value="<? if ($a == 1) {
																																																																																																																											echo  $datalit[0][134];
																																																																																																																										} ?>" />
										<span onclick="sendDataModalLitigacion('amparoIndirecto',149,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkAmparoIndirecto"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Apelaciones contra resoluciones del tribunal de enjuiciamiento </strong></h5>
							<div class="row">
								<div class="col-xs-12">
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][83];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" disabled="" class="first" id="ARTE" />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Desistimiento de la acción penal :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARTEdap" onblur="sumApelacResolTribuEnj(event)" value="<? if ($a == 1) {
																																																																																																																																echo  $datalit[0][84];
																																																																																																																															} ?>" />
										<span onclick="sendDataModalLitigacion('ARTEdap',83,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARTEdap"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Sentencia definitiva :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="ARTEsd" onblur="sumApelacResolTribuEnj(event)" value="<? if ($a == 1) {
																																																																																																																															echo  $datalit[0][85];
																																																																																																																														} ?>" />
										<span onclick="sendDataModalLitigacion('ARTEsd',84,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkARTEsd"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Sobreseimientos Decretados</strong></h5>
							<div class="row">
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Cuando el Ministerio Público formule conclusiones no acusatorias, con autorización expresa del subprocurador de justicia respectivo</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="" id="SDuno" value="<? if ($a == 1) {
																																																																																																																								echo  $datalit[0][136];
																																																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('SDuno',155,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSDuno"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Cuando se acredite la existencia de alguna causa que extinga la acción penal</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="" id="SDdos" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][137];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('SDdos',156,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSDdos"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Cuando no se hubiere dictado auto de formal prisión o de sujeción a proceso y aparezca que el hecho que motiva la acusación no es delictuoso, o cuando, habiéndose agotado la averiguación, se compruebe que no existió el hecho delictivo que la motivó</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="" id="SDtres" value="<? if ($a == 1) {
																																																																																																																								echo  $datalit[0][138];
																																																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('SDtres',157,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSDtres"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Cuando el ofendido o su representante legal se desista de la querella</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="" id="SDcuatro" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][139];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('SDcuatro',158,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSDcuatro"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Cuando se acredite plenamente que el inculpado es menor de dieciséis años. Si esto ocurre, el juez lo pondrá de inmediato a disposición del consejo tutelar que debe conocer del asunto, al que remitirá el expediente o copia certificada de las actuaciones</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="" id="SDcinco" value="<? if ($a == 1) {
																																																																																																																								echo  $datalit[0][140];
																																																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('SDcinco',159,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSDcinco"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Cuando resulte evidente que se sigue proceso contra determinado inculpado por error de persona</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="" id="SDseis" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][141];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('SDseis',160,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSDseis"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Cuando exista sentencia ejecutoria en relación a los mismos hechos</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="" id="SDsiete" value="<? if ($a == 1) {
																																																																																																																								echo  $datalit[0][142];
																																																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('SDsiete',161,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSDsiete"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Cuando, observándose lo dispuesto por el último párrafo del artículo 249, se haya decretado la libertad por falta de pruebas para procesar o por desvanecimiento de datos</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="" id="SDocho" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][143];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('SDocho',162,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSDocho"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Cuando esté plenamente probada en favor del inculpado alguna causa excluyente de incriminación</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="" id="SDnueve" value="<? if ($a == 1) {
																																																																																																																								echo  $datalit[0][144];
																																																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('SDnueve',163,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSDnueve"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Cuando esté debidamente acreditada en autos alguna otra causa de inimputabilidad en favordel procesado</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onblur="" id="SDdiez" value="<? if ($a == 1) {
																																																																																																																										echo  $datalit[0][145];
																																																																																																																									} ?>" />
										<span onclick="sendDataModalLitigacion('SDdiez',164,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkSDdiez"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>

						</div>
					</div>



					<div class="panel panel-default fd1">
						<div class="panel-body">
							<!-- <h5 class="text-on-pannel"><strong> Sobreseimientos Decretados </strong></h5> -->
							<div id="contSobreseimientosAnterior">
								<div class="row">
									<div class="col-xs-12 d-lg-none">
										<input type="number" placeholder="" value="<? if ($a == 1) {
																																																						echo  $datalit[0][23];
																																																					} else {
																																																						echo 0;
																																																					} ?>" disabled="" class="first" id="SD" />
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<label class="colorLetras" for="inputlg">Prescripción de la acción penal :</label>
										<div class="iconiput">
											<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDpapen" value="<? if ($a == 1) {
																																																																																																																									echo  $datalit[0][24];
																																																																																																																								} ?>" />
											<span onclick="sendDataModalLitigacion('SDpapen',89,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
												<div id="checkSDpapen"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>
									</div>
									<div class="col-xs-6">
										<label class="colorLetras" for="inputlg">Por Muerte del Imputado :</label>
										<div class="iconiput">
											<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDpmuImpu" value="<? if ($a == 1) {
																																																																																																																											echo  $datalit[0][99];
																																																																																																																										} ?>" />
											<span onclick="sendDataModalLitigacion('SDpmuImpu',99,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
												<div id="checkSDpmuImpu"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Por mecanismos alternativos :</label>
										<input type="number" placeholder="" disabled="" class="first" id="MA" value="<? if ($a == 1) {
																																																																																								echo  $datalit[0][25];
																																																																																							} else {
																																																																																								echo 0;
																																																																																							} ?>" />
									</div>
								</div><br>
								<div class="row">
									<div class="col-xs-6">
										<label class="colorLetras" for="inputlg">Acuerdo reparatorio : :</label>
										<div class="iconiput">
											<input type="number" placeholder="cantidad" class="first" onblur="summecanalternat(event)" id="acrep" value="<? if ($a == 1) {
																																																																																																																									echo  $datalit[0][26];
																																																																																																																								} ?>" />
											<span onclick="sendDataModalLitigacion('acrep',90,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
												<div id="checkCacrep"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>
									</div>



									<div class="col-xs-6">
										<label class="colorLetras" for="inputlg">Suspensión condicional del proceso :</label>
										<div class="iconiput">
											<input type="number" placeholder="cantidad" class="first" onblur="summecanalternat(event)" id="scpro" value="<? if ($a == 1) {
																																																																																																																									echo  $datalit[0][27];
																																																																																																																								} ?>" />
											<!-- Enviar a sicap  --> <span onclick="sendDataModalLitigacion('scpro',152,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
												<div id="checkscpro"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>

										</div>

									</div>


								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<label class="colorLetras" for="inputlg">Criterio de oportunidad :</label>
										<div class="iconiput">
											<input type="number" placeholder="cantidad" class="first" onblur="summecanalternat(event)" id="criopor" value="<? if ($a == 1) {
																																																																																																																											echo  $datalit[0][28];
																																																																																																																										} ?>" />
											<span onclick="sendDataModalLitigacion('criopor',91,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
												<div id="checkcriopor"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-4">
										<label class="colorLetras" for="inputlg">Terminación anticipada :</label>
										<div class="iconiput">
											<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="termant" value="<? if ($a == 1) {
																																																																																																																									echo  $datalit[0][29];
																																																																																																																								} ?>" />
											<span onclick="sendDataModalLitigacion('termant',93,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
												<div id="checktermant"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4">
										<label class="colorLetras" for="inputlg">Acumulación :</label>
										<div class="iconiput">
											<input type="number" placeholder="cantidad" class="first" id="acu" onblur="sumTotCarpJudTram(event)" value="<? if ($a == 1) {
																																																																																																																								echo  $datalit[0][31];
																																																																																																																							} ?>" />
											<span onclick="sendDataModalLitigacion('acu',32,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
												<div id="checkacu"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default fd1">
								<div class="panel-body">
									<h5 class="text-on-pannel"><strong> Incompetencia </strong></h5>
									<div class="row">
										<div class="col-xs-12">
											<input type="number" value="<? if ($a == 1) {
																																								echo  $datalit[0][68];
																																							} else {
																																								echo 0;
																																							} ?>" placeholder="" disabled="" class="first" id="INCOM" />
										</div>
									</div>
									<div class="row">
										<div class="col-xs-6">
											<label class="colorLetras" for="inputlg">Decretadas :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="INCOMdecre" onblur="sumImcompetenc(event)" value="<? if ($a == 1) {
																																																																																																																													echo  $datalit[0][69];
																																																																																																																												} ?>" />
												<span onclick="sendDataModalLitigacion('INCOMdecre',70,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkINCOMdecre"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-6">
											<label class="colorLetras" for="inputlg">Admitidas :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="INCOMadmi" onblur="sumImcompetenc(event)" value="<? if ($a == 1) {
																																																																																																																												echo  $datalit[0][70];
																																																																																																																											} ?>" />
												<span onclick="sendDataModalLitigacion('INCOMadmi',71,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkINCOMadmi"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default fd1">
								<div class="panel-body">
									<h5 class="text-on-pannel"><strong> Desistimiento del recurso </strong></h5>
									<div class="row">
										<div class="col-xs-12">
											<input type="number" placeholder="" value="<? if ($a == 1) {
																																																							echo  $datalit[0][39];
																																																						} else {
																																																							echo 0;
																																																						} ?>" disabled="" class="first" id="DR" />
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label class="colorLetras" for="inputlg">Por parte del acusado :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="DRppa" onblur="sumds(event)" value="<? if ($a == 1) {
																																																																																																															echo  $datalit[0][40];
																																																																																																														} ?>" />
												<span onclick="sendDataModalLitigacion('DRppa',40,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkDRppa"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-4">
											<label class="colorLetras" for="inputlg">Por parte del defensor :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="DRppd" onblur="sumds(event)" value="<? if ($a == 1) {
																																																																																																															echo  $datalit[0][41];
																																																																																																														} ?>" />
												<span onclick="sendDataModalLitigacion('DRppd',41,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkDRppd"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-4">
											<label class="colorLetras" for="inputlg">Por parte del ministerio publico :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="DRppmp" onblur="sumds(event)" value="<? if ($a == 1) {
																																																																																																																echo  $datalit[0][42];
																																																																																																															} ?>" />
												<span onclick="sendDataModalLitigacion('DRppmp',43,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkDRppmp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default fd1">
								<div class="panel-body">
									<h5 class="text-on-pannel"><strong> Sentencias dictadas </strong></h5>
									<div class="row">
										<div class="col-xs-12">
											<input type="number" placeholder="" value="<? if ($a == 1) {
																																																							echo  $datalit[0][44];
																																																						} else {
																																																							echo 0;
																																																						} ?>" disabled="" class="first" id="SDI" />
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label class="colorLetras" for="inputlg">Revoca :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="SDIrev" onblur="sumsentedict(event)" value="<? if ($a == 1) {
																																																																																																																							echo  $datalit[0][45];
																																																																																																																						} ?>" />
												<span onclick="sendDataModalLitigacion('SDIrev',45,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkSDIrev"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-4">
											<label class="colorLetras" for="inputlg">Modifica :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="SDImod" onblur="sumsentedict(event)" value="<? if ($a == 1) {
																																																																																																																							echo  $datalit[0][46];
																																																																																																																						} ?>" />
												<span onclick="sendDataModalLitigacion('SDImod',46,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkSDImod"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
										<div class="col-xs-4">
											<label class="colorLetras" for="inputlg">Confirma :</label>
											<div class="iconiput">
												<input type="number" placeholder="cantidad" class="first" id="SDIconf" onblur="sumsentedict(event)" value="<? if ($a == 1) {
																																																																																																																								echo  $datalit[0][47];
																																																																																																																							} ?>" />
												<span onclick="sendDataModalLitigacion('SDIconf',48,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
													<div id="checkSDIconf"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg">Reposición del procedimiento :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="Reproc" value="<? if ($a == 1) {
																																																																																								echo  $datalit[0][48];
																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('Reproc',49,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkReproc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg"> Por cambio de situación jurídica declarados sin materia :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="csjdsm" value="<? if ($a == 1) {
																																																																																								echo  $datalit[0][90];
																																																																																							} ?>" />
										<span onclick="sendDataModalLitigacion('csjdsm',88,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkcsjdsm"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg"> Canalizadas por cese de funciones del Ministerio Público :</label>
									<input type="number" placeholder="" class="first" id="cesefunciones" value="<? if ($a == 1) {
																																																																																						echo  $datalit[0][101];
																																																																																					} ?>" />
								</div>
							</div>
							
							<div class="row" hidden="true">
								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg">Total de carpetas judicializadas en tramite:</label>
									<input type="number" value="<? if ($a == 1) {
																																						echo  $datalit[0][49];
																																					} else {
																																						echo 0;
																																					} ?>" placeholder="" class="first" disabled="true" id="totCarjudTram" />
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg"> Total de carpetas judicializadas en tramite :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" id="totCarpTram_nucs" value="<?echo $total_tramite; ?>" />
										<span onclick="sendDataModalLitigacion('totCarpTram_nucs',165,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checktotCarpTram_nucs"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>
							</div>


						</div>
					</div>
				</div>
			</div>
			<!--PANTALLA INCIDENTES Y/O RECURSOS NO SUJETOS A ETAPA PROCESAL-->
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div id="continputdhidden">

</div>

<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6">
		<center><button style="width: 85%;" type="button" class="btn btn-primary redondear" onclick="validateItsokLiti(<? echo $idEnlace; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idMp; ?>, <? echo $idUnidad; ?>)">Guardar</button></center>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6">
		<center><button style="width: 85%;" type="button" class="btn btn-default redondear" onclick="cerrarCapturaLit(<? echo $idEnlace; ?>)" data-dismiss="modal">Salir</button></center>
	</div>
</div><br>

<div id="respuestaGuardado"></div>

