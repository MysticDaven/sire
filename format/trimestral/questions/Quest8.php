<? 
					include ("../../../Conexiones/Conexion.php");
			  include("../../../funcioneTrimes.php");

					if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
					if($per == 1){ $m1 = "Enero"; $m2 = "Febrero"; $m3 = "Marzo"; $nme = "Enero - Marzo";}
					if($per == 2){ $m1 = "Abril"; $m2 = "Mayo"; $m3 = "Junio"; $nme = "Abril - Junio";}
					if($per == 3){ $m1 = "Julio"; $m2 = "Agosto"; $m3 = "Septiembre"; $nme = "Julio - Septiembre";}
					if($per == 4){ $m1 = "Octubre"; $m2 = "Noviembre"; $m3 = "Diciembre"; $nme = "Octubre - Diciembre";}

					$data = getDAtaQuestion($conn, 34, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 35, $per, $anio, $idUnidad);
					$data3 = getDAtaQuestion($conn, 36, $per, $anio, $idUnidad);
					$data4 = getDAtaQuestion($conn, 37, $per, $anio, $idUnidad);
					$data5 = getDAtaQuestion($conn, 38, $per, $anio, $idUnidad);
					$data6 = getDAtaQuestion($conn, 39, $per, $anio, $idUnidad);
					$data7 = getDAtaQuestion($conn, 40, $per, $anio, $idUnidad);
					$data8 = getDAtaQuestion($conn, 41, $per, $anio, $idUnidad);
					$data9 = getDAtaQuestion($conn, 42, $per, $anio, $idUnidad);
					$data10 = getDAtaQuestion($conn, 43, $per, $anio, $idUnidad);
					$data11 = getDAtaQuestion($conn, 44, $per, $anio, $idUnidad);
					$data12 = getDAtaQuestion($conn, 45, $per, $anio, $idUnidad);
					$data13 = getDAtaQuestion($conn, 46, $per, $anio, $idUnidad);
					$data14 = getDAtaQuestion($conn, 47, $per, $anio, $idUnidad);
				?>

				<h5 class="card-title tituloPregunta">Pregunta 8: Procedimientos y Estatus 2020</h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							<strong>¿Cuántos procedimientos</strong> se han generado de las vinculaciones a proceso derivadas de las carpetas de investigación iniciadas en 2020 y en qué estatus se encuentran dentro de los rubros señalados, conforme los registros de la Procuraduria General de Justicia o Fiscalía General de la entidad federativa en los cortes referidos?
						</li>
					</ul>
				</div><br><hr>
				<div class="botonAyuda">
					<button type="button" class="btn btn-primary" id="guardarPregunta" onclick="showModalAyuda(8)">Ayuda</button>
				</div><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Estatus de las Vinculaciones a Proceso derivadas de las CII en 2020</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">8.1</th>
							<td style="text-align: left;">En tramite ante el Juez de Control (sin incluir los que se encuentran en trámite por suspensión condicional, por acuerdos reparatorios o por procedimiento abreviado)</td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p34m1"></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p34m2"></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p34m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p34tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.2</th>
							<td style="text-align: left;">Determinados por criterio de oportunidad</td>
							<td><input type="number" value="<? echo $data2[0][0]; ?>" id="p35m1"></td>
							<td><input type="number" value="<? echo $data2[0][1]; ?>" id="p35m2"></td>
							<td><input type="number" value="<? echo $data2[0][2]; ?>" id="p35m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data2[0][3]; ?>" id="p35tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.3</th>
							<td style="text-align: left;">En trámite por suspensión condicional del proceso aprobada por el Juez de Control (en proceso de cumplimiento)</td>
							<td><input type="number" value="<? echo $data3[0][0]; ?>" id="p36m1"></td>
							<td><input type="number" value="<? echo $data3[0][1]; ?>" id="p36m2"></td>
							<td><input type="number" value="<? echo $data3[0][2]; ?>" id="p36m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data3[0][3]; ?>" id="p36tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.4</th>
							<td style="text-align: left;">Cumplida la suspensión condicional del proceso</td>
							<td><input type="number" value="<? echo $data4[0][0]; ?>" id="p37m1"></td>
							<td><input type="number" value="<? echo $data4[0][1]; ?>" id="p37m2"></td>
							<td><input type="number" value="<? echo $data4[0][2]; ?>" id="p37m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data4[0][3]; ?>" id="p37tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.5</th>
							<td style="text-align: left;">Resueltos por otras causas de sobreseimiento (sin incluir criterio de oportunidad ni los cumplidos por suspension condicional o por acuerdo reparatorio)</td>
							<td><input type="number" value="<? echo $data5[0][0]; ?>" id="p38m1"></td>
							<td><input type="number" value="<? echo $data5[0][1]; ?>" id="p38m2"></td>
							<td><input type="number" value="<? echo $data5[0][2]; ?>" id="p38m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data5[0][3]; ?>" id="p38tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.6</th>
							<td style="text-align: left;">En tramite de procedimiento abreviado</td>
							<td><input type="number" value="<? echo $data6[0][0]; ?>" id="p39m1"></td>
							<td><input type="number" value="<? echo $data6[0][1]; ?>" id="p39m2"></td>
							<td><input type="number" value="<? echo $data6[0][2]; ?>" id="p39m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data6[0][3]; ?>" id="p39tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.7</th>
							<td style="text-align: left;">Resueltos por procedimiento abreviado</td>
							<td><input type="number" value="<? echo $data7[0][0]; ?>" id="p40m1"></td>
							<td><input type="number" value="<? echo $data7[0][1]; ?>" id="p40m2"></td>
							<td><input type="number" value="<? echo $data7[0][2]; ?>" id="p40m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data7[0][3]; ?>" id="p40tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.8</th>
							<td style="text-align: left;">En trámite ante el Tribunal de Enjuiciamiento (en juicio)</td>
							<td><input type="number" value="<? echo $data8[0][0]; ?>" id="p41m1"></td>
							<td><input type="number" value="<? echo $data8[0][1]; ?>" id="p41m2"></td>
							<td><input type="number" value="<? echo $data8[0][2]; ?>" id="p41m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data8[0][3]; ?>" id="p41tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.9</th>
							<td style="text-align: left;">Resueltos por juicio oral</td>
							<td><input type="number" value="<? echo $data9[0][0]; ?>" id="p42m1"></td>
							<td><input type="number" value="<? echo $data9[0][1]; ?>" id="p42m2"></td>
							<td><input type="number" value="<? echo $data9[0][2]; ?>" id="p42m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data9[0][3]; ?>" id="p42tot" readonly></td>
						</tr>
						<tr>
							<td colspan="6" style="background-color: #7C8B9E; font-size: 20px;"><strong>DERIVADOS A MECANISMOS ALTERNATIVOS (DESPUES DE LA VINCULACIÓN A PROCESO)</strong></td>
						</tr>
						<tr>
							<th scope="row">8.10</th>
							<td style="text-align: left;">En trámite en el OEMASC sin acuerdo reparatorio</td>
							<td><input type="number" value="<? echo $data10[0][0]; ?>" id="p43m1"></td>
							<td><input type="number" value="<? echo $data10[0][1]; ?>" id="p43m2"></td>
							<td><input type="number" value="<? echo $data10[0][2]; ?>" id="p43m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data10[0][3]; ?>" id="p43tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.11</th>
							<td style="text-align: left;">En trámite en el OEMASC con acuerdo reparatorio firmado (en proceso de cumplimiento)</td>
							<td><input type="number" value="<? echo $data11[0][0]; ?>" id="p44m1"></td>
							<td><input type="number" value="<? echo $data11[0][1]; ?>" id="p44m2"></td>
							<td><input type="number" value="<? echo $data11[0][2]; ?>" id="p44m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data11[0][3]; ?>" id="p44tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.12</th>
							<td style="text-align: left;">Resueltos (cumplidos) en OEMASC por mediación</td>
							<td><input type="number" value="<? echo $data12[0][0]; ?>" id="p45m1"></td>
							<td><input type="number" value="<? echo $data12[0][1]; ?>" id="p45m2"></td>
							<td><input type="number" value="<? echo $data12[0][2]; ?>" id="p45m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data12[0][3]; ?>" id="p45tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.13</th>
							<td style="text-align: left;">Resueltos (cumplidos) en OEMASC por conciliación</td>
							<td><input type="number" value="<? echo $data13[0][0]; ?>" id="p46m1"></td>
							<td><input type="number" value="<? echo $data13[0][1]; ?>" id="p46m2"></td>
							<td><input type="number" value="<? echo $data13[0][2]; ?>" id="p46m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data13[0][3]; ?>" id="p46tot" readonly></td>
						</tr>
							<tr>
							<th scope="row">8.14</th>
							<td style="text-align: left;">Resueltos (cumplidos) en el OEMASC por acuerdo reparatorio por junta restaurativa</td>
							<td><input type="number" value="<? echo $data14[0][0]; ?>" id="p47m1"></td>
							<td><input type="number" value="<? echo $data14[0][1]; ?>" id="p47m2"></td>
							<td><input type="number" value="<? echo $data14[0][2]; ?>" id="p47m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data14[0][3]; ?>" id="p47tot" readonly></td>
						</tr>
					</tbody>
				</table><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 <img src="images/warning.png"  class="imgWarning" alt="">
							 	Nota.- La suma de los datos proporcionados en esta pregunta (reactivos 8.1 al 8.14) deberá ser igual o mayor al dato proporcionado en el reactivo 7.11 (procedimientos vinculados a proceso).
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 En caso de que se realicen acuerdos reparatorios a través del OEMASC dependiente de la Procuraduria o Fiscalá por que no se cuenta con OEMASC dependiente del Poder Judicial, deberá registrarse en este apartado.
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
								Si a la fecha de corte de una carpeta de investigación tiene más de un procedimiento en el Órgano Jurisdiccional después de la vinculación a proceso, se deberá registrar casa uno de éstos aun cuando se trate de la misma carpeta de investrigación.
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="botonGuardar">
					<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest8(8, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button>
				</div>
		