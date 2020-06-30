
			<? 
					include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");
			include("../../../funciones.php");	

					if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"];
 }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
					if($per == 1){ $m1 = "Enero"; $m2 = "Febrero"; $m3 = "Marzo"; $nme = "Enero - Marzo";}
					if($per == 2){ $m1 = "Abril"; $m2 = "Mayo"; $m3 = "Junio"; $nme = "Abril - Junio";}
					if($per == 3){ $m1 = "Julio"; $m2 = "Agosto"; $m3 = "Septiembre"; $nme = "Julio - Septiembre";}
					if($per == 4){ $m1 = "Octubre"; $m2 = "Noviembre"; $m3 = "Diciembre"; $nme = "Octubre - Diciembre";}

					$data = getDAtaQuestion($conn, 1, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 2, $per, $anio, $idUnidad);
					$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
					$envt = $getEnv[0][0]; 
				?>  

				<h5 class="card-title tituloPregunta">Pregunta 1: Número de denuncias, querellas u otros requisitos</h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							¿Cuál es el número de <strong>denuncias, querellas u otros requisitos</strong> equivalentes que se recibieron en la Fiscalía General de la entidad federativa (incluyendo las recibidas en los Centros de Justicia para Mujeres) durante el año 2020.
						</li>
					</ul>
				</div><br><hr><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Denuncias / Querellas / Otros Requisitos Equivalentes</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">1.1</th>
							<td style="text-align: left;">Denuncias</td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p1m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p1m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p1m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p1Tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">1.2</th>
							<td style="text-align: left;">Querellas u otros requisistos equivalentes</td>
							<td><input type="number" value="<? echo $data2[0][0]; ?>" id="p2m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][1]; ?>" id="p2m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][2]; ?>" id="p2m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data2[0][3]; ?>" id="p2Tot" readonly></td>
						</tr>
					</tbody>
				</table><br>
				<div class="botonGuardar">
					<? if($envt == 0){ ?>
					<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest1(1, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button> <? } ?>
				</div>
			