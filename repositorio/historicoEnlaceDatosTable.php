<?  

	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	




	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }

?>
<table class="table-hover" style="width: 100% !important;">

																		    	 						<tbody style="">
																															<tr style="border: solid 1px !important; ">
																															<td style="background-color: whitesmoke; font-weight: bold; width: 300px !important; padding: 50px !important; border: solid 1px #E4E4E4;" rowspan="2">Agente del Ministerio Público</td>
																															<td style="background-color: #d8d8d8 !important; text-align: center; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2">Existencia Anterior</td>
																															<td style="text-align: center; background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4;" colspan="2">Iniciadas</td> 
																															<td style="background-color: #ccffcc !important; padding: 10px !important; text-align: center; border: solid 1px #E4E4E4;" rowspan="2">Total Iniciadas</td>
																															<td style="background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Reiniciadas</label></td>
																															<td style="background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Recibidas por Otra Unidad</label></td>
																															<td style="background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4; text-align: center;" rowspan="2">Total a Trabajar</td>
																															<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" colspan="2">Judicializadas</td>
																															<td style="background-color: #ccffff; padding: 10px !important; text-align: center; border: solid 1px #E4E4E4;" rowspan="2" >Total Judicializadas</td>
																															<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Abstención de Investigación</label></td>
																															<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Archivo Temporal</label></td>
																															<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">No Ejercicio de la Acción Penal</label></td>
																															<td style="text-align: center; background-color: #ccffff; border: solid 1px #E4E4E4;" colspan="4">Salidas Alternas</td>
																															<td style=" background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Incompetencia</label></td>
																															<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Acumulación</label></td>
																															<td style="background-color: #ccffff; border: solid 1px #E4E4E4; text-align: center;" rowspan="2">Total Resoluciones</td>
																																<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Enviadas a Unidad de Atención Temprana</label></td>
																																<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Enviadas a Unidas de Investigación</label></td>
																																<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Enviadas a Imputado Desconocido</label></td>
																																<td style="background-color: #d8d8d8 !important; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2">Tramite</td>

																															</tr>
																															<tr style="border: solid 1px !important;">
																															<td style="text-align: center; background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Con Detenido</label></td>
																															<td style="text-align: center; background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Sin Detenido</label></td>
																																<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Con Detenido</label></td>
																															<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" ><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Sin Detenido</label></td>
																																	<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Mediación</label></td>
																															<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" ><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Conciliación</label></td>
																																	<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Criterios de Oportunidad</label></td>
																															<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Suspension Condicional del Proceso</label></td>
																															</tr>
																															<? 

																																		$dos2 =0; 	$dos3 = 0;	$dos4 = 0;	$dos5 = 0; $dos6 = 0;	$dos7 = 0;			$dos8 = 0;	$dos9 = 0;	$dos10 = 0;			$dos11 = 0;		$dos12 = 0; 	$dos13 = 0;	$dos14 = 0; 
																																								$dos15 = 0; $dos16 = 0; 			$dos17 = 0;			$dos18 = 0;	$dos19 = 0; 		$dos20 = 0;		$dos21 = 0;	$dos22 = 0;		$dos23 = 0; 	$dos24 = 0; 
																																								$dos25 = 0;

																																			if($idEnlace == 18 || $idEnlace == 22 || $idEnlace == 16 || $idEnlace == 23 || $idEnlace == 19 || $idEnlace == 15 || $idEnlace == 21 || $idEnlace == 17 || $idEnlace == 14){


																																							if($idEnlace == 18){ $unidadedes = "IN(116,117,118,119)"; }
																																							if($idEnlace == 22){ $unidadedes = "IN(120,121,122,123,124,125)"; }
																																							if($idEnlace == 16){ $unidadedes = "IN(108,109,110,111,112,113,114,115)"; }
																																							if($idEnlace == 23){ $unidadedes = "IN(71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,94,95,96,97,98)"; }
																																							if($idEnlace == 19){ $unidadedes = "IN(62,63,64,65,66,67,68,69,70,152,1005,1006)"; }
																																							if($idEnlace == 15){ $unidadedes = "IN(53,54,55,56,57,58,59,60,61,150,151)"; }
																																							if($idEnlace == 21){ $unidadedes = "IN(27,28,29,30,31,32,93,102,103)"; }
																																							if($idEnlace == 17){ $unidadedes = "IN(16,17,18,19,20,21,22,23,24,25,26,153,154)"; }
																																							if($idEnlace == 14){ $unidadedes = "IN(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,92,100,101)"; }

																																							$data = getDataMpsUniMesAnioUnids($conn, $unidadedes, $anio, $mes);	

																																		}else{

																																							$data = getDataMpsUniMesAnio($conn, $idUnidad, $anio, $mes);
																																		}

																																			for( $i=0; $i<sizeof($data); $i++){

																																									$idUnidadese = $data[$i][27];
																																								$naun = getNunidad($conn, $idUnidadese);

																																								$dos2 = $dos2 + $data[$i][2]; $dos3 = $dos3 + $data[$i][3]; 	$dos4 = $dos4 + $data[$i][4]; 	$dos5 = $dos5 + $data[$i][5]; 	$dos6 = $dos6 + $data[$i][6]; 
																																								$dos7 = $dos7 + $data[$i][7]; $dos8 = $dos8 + $data[$i][8]; 	$dos9 = $dos9 + $data[$i][9]; 	$dos10 = $dos10 + $data[$i][10]; 	$dos11 = $dos11 + $data[$i][11]; 
																																								$dos12 = $dos12 + $data[$i][12]; $dos13 = $dos13 + $data[$i][13]; $dos14 = $dos14 + $data[$i][14]; 	$dos15 = $dos15 + $data[$i][15]; $dos16 = $dos16 + $data[$i][16]; 
																																								$dos17 = $dos17 + $data[$i][17]; $dos18 = $dos18 + $data[$i][18]; $dos19 = $dos19 + $data[$i][19]; 	$dos20 = $dos20 + $data[$i][20]; 	$dos21 = $dos21 + $data[$i][21]; 
																																								$dos22 = $dos22 + $data[$i][22]; $dos23 = $dos23 + $data[$i][23]; $dos24 = $dos24 + $data[$i][24]; 	$dos25 = $dos25 + $data[$i][25]; 

																																								$nombre = $data[$i][1];		
																																								?>
																																																<tr style="background-color:rgba(255,255,255,0.8); border: solid 1px #E4E4E4 !important; ">																															
																																																			<td style="width: 300px !important;  padding: 10px !important;  border: solid 1px #E4E4E4 !important;">	<? echo "<label style='font-weight: bold;'>".$nombre."</label><br>".$naun[0][0]; ?></td>
																																																			<td style="font-weight: bold;  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][2]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][3]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][4]; ?></td>
																																																			<td style="font-weight: bold;  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][5]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][6]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][7]; ?></td>
																																																			<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][8]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][9]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][10]; ?></td>
																																																			<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][11]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][12]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][13]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][14]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][15]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][16]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][17]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][18]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][19]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][20]; ?></td>
																																																			<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][21]; ?></td>
																																																			<td style=" border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][22]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][23]; ?></td>
																																																			<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][24]; ?></td>
																																																			<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][25]; ?></td>
																																																</tr>				

																																								<?


																																			}

																																			?>

																																						<tr style="background-color: white !important; border: solid 1px #E4E4E4 !important; ">
																																							
																																									<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	TOTAL </td>
																																									<td style="background-color: #ccffff; padding: 15px !important;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos2; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos3; ?> </td>
																																									<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos4; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos5; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos6; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos7; ?> </td>
																																									<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos8; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos9; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos10; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos11; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos12; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos13; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos14; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos15; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos16; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos17; ?> </td>
																																									<td style="background-color: #ccffff; border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos18; ?> </td>
																																									<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos19; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos20; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos21; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos22; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos23; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos24; ?> </td>
																																									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos25; ?> </td>


																																						</tr>

																																			<?

																															?>


																											

																														</tbody>
																																																					
																									</table>



										



