	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	

				if (isset($_POST["newBrwosers_id"])){ $newBrwosers_id = $_POST["newBrwosers_id"]; }	

				$munis = getDataMunicipiosFiscalia($conn, $newBrwosers_id);

	?>


	
				<datalist id="newBrwosersMunVehi">
																				<? 
																					
																							for ($o=0; $o < sizeof($munis); $o++) { 								
																										$idfis = $munis[$o][0];
																										$nombrefis = $munis[$o][1];
																										?>
																												<option style="color: black; font-weight: bold;" value="<? echo $nombrefis; ?>" data-value="<? echo $idfis; ?>" data-id="<? echo $idfis; ?>"></option>
																										<?
																							}

																				 ?>
																</datalist>
												<input class="form-control mandda " onchange="getDataColoniVehi();" list="newBrwosersMunVehi" id="newBrwoserMunVehi" name="newBrwoserMunVehi" type="text"><br>

