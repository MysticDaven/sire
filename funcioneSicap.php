<? 		

		
		function getIdFiscaliaXmunicipio($conn, $idmunicipio){


			$indice=0;
			$consulta=" SELECT CatFiscaliasID FROM CatMunicipios WHERE CatMunicipiosID = $idmunicipio ";

			$stmt = sqlsrv_query( $conn, $consulta);
			while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				
				$arreglo[$indice][0]=$row['CatFiscaliasID'];				
				$indice++;
				
			}			
			if($indice==0)
			return false;
			else 
			return $arreglo;
		}
	

		function getVictimaDataSicap($conn, $idCarpeta){

			$indice=0;
			$consulta=" SELECT Nombre, Paterno, Materno, Sexo, Edad
FROM Involucrado INNER JOIN VictimaOfendido VO ON VO.InvolucradoID = Involucrado.InvolucradoID WHERE CarpetaID = $idCarpeta AND VO.Victima = 1 ";



			$stmt = sqlsrv_query( $conn, $consulta);
			while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				
				$arreglo[$indice][1]=$row['Nombre'];				
				$arreglo[$indice][2]=$row['Paterno'];				
				$arreglo[$indice][3]=$row['Materno'];				

				$arreglo[$indice][6]=$row['Sexo'];				
				$arreglo[$indice][5]=$row['Edad'];				
				$indice++;
				
			}
			
			if($indice==0)
			return false;
			else 
			return $arreglo;

	}

			

		function getDataDesaparecidos($conn, $mes, $anio){

$fechaini2 = "'01-05-2019 00:00:00'";
$fechafin2 = "'31-05-2019 23:59:59'";


		$query = " SELECT c.CarpetaID, c.NUC, c.Expediente, cme.Nombre, c.FechaInicio, c.FechaComision, c.CatMunicipiosID FROM Carpeta c 
INNER JOIN Delito d ON d.CarpetaID = c.CarpetaID 
INNER JOIN CatModalidadesEstadisticas cme ON cme.CatModalidadesEstadisticasID = d.CatModalidadesID
WHERE d.CatModalidadesID IN (45,274,217)
and c.FechaInicio >= $fechaini2 AND   FechaInicio <= $fechafin2 ";


		$indice = 0;

			$stmt = sqlsrv_query($conn, $query);
			while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
			{
				$arreglo[$indice][0]=$row['CarpetaID'];
				$arreglo[$indice][1]=$row['NUC'];
				$arreglo[$indice][2]=$row['Expediente'];
				$arreglo[$indice][3]=$row['Nombre'];
				$arreglo[$indice][4]=$row['FechaInicio'];
				$arreglo[$indice][5]=$row['FechaComision'];
				$arreglo[$indice][6]=$row['CatMunicipiosID'];
				$indice++;
			}
			if(isset($arreglo)){return $arreglo;}

	}





			function getDataResolReiniciadi($conn, $idCarp, $mes, $anio, $idUnidad){

		$query = " SELECT ResolucionID, CarpetaID, idUnidad, Fechaingreso, EstatusID, AgenteID FROM Resoluciones 
		WHERE ResolucionID IN( SELECT MAX(ResolucionID) FROM Resoluciones WHERE CarpetaID = $idCarp ) ";




		$indice = 0;

			$stmt = sqlsrv_query($conn, $query);
			while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
			{
				$arreglo[$indice][0]=$row['ResolucionID'];
				$arreglo[$indice][1]=$row['CarpetaID'];
				$arreglo[$indice][2]=$row['idUnidad'];
				$arreglo[$indice][3]=$row['EstatusID'];
					$arreglo[$indice][4]=$row['AgenteID'];
				$indice++;
			}
			if(isset($arreglo)){return $arreglo;}

	}

	
		function knowisReinicidaCheckMp($conn, $anio, $mes, $idUnidad, $idMp){

			
			$query = "  SELECT ResolucionID, CarpetaID, EstatusID  FROM Resoluciones WHERE   EstatusID = 1 AND anio = $anio AND mes = $mes AND idUnidad = $idUnidad AND AgenteID = $idMp ";

				$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
				$row_count = sqlsrv_num_rows( $stmt );
					if($row_count > 0){	return true; }else{return false;}

		}	


	function knowisReinicida($conn, $anio, $mes, $idUnidad, $idCarpeta){

			
			$query = " SELECT ResolucionID, CarpetaID, EstatusID  FROM Resoluciones WHERE   EstatusID = 1 AND anio = $anio AND mes = $mes AND idUnidad = $idUnidad AND CarpetaID = $idCarpeta";
			

				$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
				$row_count = sqlsrv_num_rows( $stmt );
					if($row_count > 0){	return true; }else{return false;}

		}


			function getIDresolopen($conn, $anio, $mes, $idUnidad, $idCarpeta)
		{
			$indice=0;
			$consulta="SELECT CarpetaID, EstatusID, idUnidad From Resoluciones WHERE CarpetaID =  $idCarpeta AND EstatusID = 1 AND anio = $anio AND mes = $mes AND idUnidad = $idUnidad";

			//echo $consulta."<br>";

			$stmt = sqlsrv_query( $conn, $consulta);
			while(	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				
				$arreglo[$indice][0]=$row['CarpetaID'];	
				$arreglo[$indice][1]=$row['EstatusID'];	
				$arreglo[$indice][2]=$row['idUnidad'];

				$indice++;				
			}			
			if(isset($arreglo)){return $arreglo;}
		}



	function getEstatusResoluicionName($conn,$idestatus)
		{
			$indice=0;
			$consulta="SELECT Nombre from CatEstatusResoluciones where EstatusID =".$idestatus;

			$stmt = sqlsrv_query( $conn, $consulta);
			while(	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				
				$arreglo[$indice][0]=$row['Nombre'];	

				$indice++;				
			}			
			if(isset($arreglo)){return $arreglo;}
		}


function get_nuc_sicap ($nuc,$conn)	{			
			
			$consulta="select * from Carpeta where nuc=".$nuc;
			$stmt = sqlsrv_query( $conn, $consulta);
			$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
			
			if($row)
			return true;
			else 
			return  false;
		}


	function get_datos_carpeta_capturado($conn,$nuc)
		{
			$indice=0;
			$consulta="SELECT CarpetaID, NUC, Expediente, fechaCaptura, FechaInicio, FechaComision, Contar from Carpeta where NUC=".$nuc;

			$stmt = sqlsrv_query( $conn, $consulta);
			while(	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				
				$arreglo[$indice][0]=$row['CarpetaID'];	
				$arreglo[$indice][1]=$row['NUC'];	
				$arreglo[$indice][2]=$row['Expediente'];	
				$arreglo[$indice][3]=$row['fechaCaptura'];	
				$arreglo[$indice][4]=$row['FechaInicio'];	
				$arreglo[$indice][5]=$row['FechaComision'];	
				$arreglo[$indice][6]=$row['Contar'];	

				$indice++;				
			}			
			if(isset($arreglo)){return $arreglo;}
		}


/// OBTENGO TODAS LAS CARPETAS DEL AGENTE SEAN DE CUALQUIER ESTATUS PARA SABER CUALES SE SUMAN Y CUALES NO POSTERIORMENTE
function getDistincCarpetasAgenteDetemrn($conn, $idMp, $mes, $anio, $deten){


		$query = " SELECT DISTINCT CarpetaID FROM Resoluciones 
   WHERE AgenteID = $idMp AND mes = $mes AND anio = $anio AND deten = $deten  Group BY CarpetaID, EstatusID, deten ORDER BY CarpetaID DESC";


   $indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['CarpetaID'];
			//$arreglo[$indice][1]=$row['EstatusID'];
			//$arreglo[$indice][2]=$row['deten'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

////// ESTA ES PARA VER SI FUNCIONA CON EL ESTATUS


function getDistincCarpetasAgenteDetemrn20($conn, $idMp, $mes, $anio, $deten, $estatus){


		$query = " SELECT DISTINCT CarpetaID, idUnidad FROM Resoluciones 
   WHERE AgenteID = $idMp AND mes = $mes AND anio = $anio AND deten = $deten AND EstatusID = $estatus  Group BY CarpetaID, idUnidad ORDER BY CarpetaID DESC";
//echo $query."<br><br>";

   $indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['CarpetaID'];
			$arreglo[$indice][1]=$row['idUnidad'];
			//$arreglo[$indice][1]=$row['EstatusID'];
			//$arreglo[$indice][2]=$row['deten'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}


function getDistincCarpetasAgenteLiti($conn, $idMp, $estatus, $mes, $anio, $deten){


		$query = " SELECT ResolucionID, CarpetaID, idUnidad, EstatusID, AgenteID FROM Resoluciones 
   WHERE AgenteID = $idMp AND EstatusID = $estatus AND mes = $mes AND anio = $anio AND deten = $deten  Group BY CarpetaID, ResolucionID, idUnidad, EstatusID, AgenteID";



   		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['ResolucionID'];
			$arreglo[$indice][1]=$row['CarpetaID'];
			$arreglo[$indice][2]=$row['idUnidad'];
			$arreglo[$indice][4]=$row['EstatusID'];
			$arreglo[$indice][5]=$row['AgenteID'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}



function getDistincCarpetasDataUNidReso($conn, $idMp, $estatus, $mes, $anio, $deten){


		$query = " SELECT DISTINCT CarpetaID, idUnidad, ResolucionID FROM Resoluciones 
   WHERE AgenteID = $idMp AND EstatusID = $estatus AND mes = $mes AND anio = $anio AND deten = $deten  Group BY CarpetaID, idUnidad, ResolucionID";

   		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['CarpetaID'];
			$arreglo[$indice][1]=$row['idUnidad'];
			$arreglo[$indice][2]=$row['ResolucionID'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}


function getDistincCarpetasAgente($conn, $idMp, $estatus, $mes, $anio, $deten){


		$query = " SELECT DISTINCT CarpetaID FROM Resoluciones 
   WHERE AgenteID = $idMp AND EstatusID = $estatus AND mes = $mes AND anio = $anio AND deten = $deten  Group BY CarpetaID, idUnidad, ResolucionID";

   		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['CarpetaID'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}


function getDistincCarpetasAgente3($conn, $idMp, $estatus, $mes, $anio, $deten, $idUnidad){


	$query = " SELECT DISTINCT CarpetaID, idUnidad, ResolucionID FROM Resoluciones 
WHERE AgenteID = $idMp AND EstatusID = $estatus AND mes = $mes AND anio = $anio AND deten = $deten AND idUnidad = $idUnidad  Group BY CarpetaID, idUnidad, ResolucionID";



	   $indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CarpetaID'];
		$arreglo[$indice][1]=$row['idUnidad'];
		$arreglo[$indice][2]=$row['ResolucionID'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

//// SIN DETENIDO NI TIPO DE RESOLUCIONE

function getResolucionesMPtotalsic12($conn, $idMp, $mes, $anio){


		$query = " SELECT DISTINCT CarpetaID FROM Resoluciones 
   WHERE AgenteID = $idMp AND mes = $mes AND anio = $anio  Group BY CarpetaID";



   		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['CarpetaID'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

///////////////////// SE TOMA LA ULTIMA DETERMINACION SEA CUAL SEA EL ESTATUS PARA OBTENER LA ULTIMA ////////////////////	
/////////// aplica cuando se va a hacer la consulta para las terminaciones que estan capturadas ////////
function getLastDeterminacionCarpeta($conn, $idCarp){

	$query = " SELECT ResolucionID, CarpetaID, idUnidad, Fechaingreso, EstatusID, AgenteID FROM Resoluciones 
	WHERE ResolucionID IN( SELECT MAX(ResolucionID) FROM Resoluciones WHERE CarpetaID = $idCarp AND EstatusID <> 1) ";



//echo $query."<br>";
	$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['ResolucionID'];
			$arreglo[$indice][1]=$row['CarpetaID'];
			$arreglo[$indice][2]=$row['idUnidad'];
			$arreglo[$indice][3]=$row['EstatusID'];
				$arreglo[$indice][4]=$row['AgenteID'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

/////////////////// PARA OBTENER EL AGENTE DE LA ULTIMA DETERMINACION QUE SE HIZO A UNA CARPETA //////////

function getLastAgentDeterminacionCarpeta($conn, $idCarp, $estatResolucion){

	$query = " SELECT AgenteID, idUnidad FROM Resoluciones 
	WHERE ResolucionID IN( SELECT MAX(ResolucionID) FROM Resoluciones WHERE CarpetaID = $idCarp ) AND EstatusID = $estatResolucion";

	$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['AgenteID'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}


/////////////////// SE TOMA LA ULTIMA DETERMINACION TOMANDO EN CUENTA EL ESTATUS DE LA DETERMINACION //////////
/////// cuando se va a reviar si esta insertado un NUC en la misma unidad con el estus igual 

function getLastDeterminacionCarpetaEsta($conn, $idCarp, $estatResolucion, $mes, $anio){

	$query = " SELECT ResolucionID, CarpetaID, idUnidad, Fechaingreso FROM Resoluciones 
	WHERE ResolucionID IN( SELECT MAX(ResolucionID) FROM Resoluciones WHERE CarpetaID = $idCarp ) AND EstatusID = $estatResolucion AND mes = $mes AND anio = $anio";

	$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['ResolucionID'];
			$arreglo[$indice][1]=$row['CarpetaID'];
			$arreglo[$indice][2]=$row['idUnidad'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

////// OBTIENE DATOS EXTRAS SI SE QUIERE 
function getLastDeterminacionCarpetaEsta2($conn, $idCarp, $estatResolucion){

	$query = " SELECT ResolucionID, CarpetaID, idUnidad, Fechaingreso, AgenteID FROM Resoluciones 
	WHERE ResolucionID IN( SELECT MAX(ResolucionID) FROM Resoluciones WHERE CarpetaID = $idCarp ) AND EstatusID = $estatResolucion";


	$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['ResolucionID'];
			$arreglo[$indice][1]=$row['CarpetaID'];
			$arreglo[$indice][2]=$row['idUnidad'];
			$arreglo[$indice][3]=$row['AgenteID'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}



function getResolucionesMPsic($conn, $idMp, $estatResolucion, $mes, $anio, $deten, $idUnidad){

$query = "SELECT  ResolucionID, CarpetaID FROM Resoluciones WHERE AgenteID = $idMp AND EstatusID = $estatResolucion AND mes = $mes AND anio = $anio AND deten = $deten AND idUnidad = $idUnidad ORDER BY ResolucionID DESC";

/*$query = " SELECT ResolucionID, CarpetaID, idUnidad FROM Resoluciones WHERE ResolucionID IN( SELECT ResolucionID FROM Resoluciones 
   WHERE CarpetaID = 1343 AND Fechaingreso = (SELECT MAX(Fechaingreso) from Resoluciones WHERE CarpetaID = 1343)) AND idUnidad = 30";*/

//ECHO  "<br><br>".$query;

		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['ResolucionID'];
			$arreglo[$indice][1]=$row['CarpetaID'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}


function getNucExpSicap($conn, $idCarp){

	$query = "  SELECT NUC, Expediente  From Carpeta WHERE CarpetaID = $idCarp"; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['NUC'];
		$arreglo[$indice][1]=$row['Expediente'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}	


function getResolucionesMPtotalsic($conn, $idMp, $estatResolucion, $mes, $anio, $deten){

$query23 = "SELECT  ResolucionID, CarpetaID FROM Resoluciones WHERE AgenteID = $idMp AND EstatusID = $estatResolucion AND mes = $mes AND anio = $anio AND deten = $deten ORDER BY ResolucionID DESC";	


 		$stmt = sqlsrv_query($conn, $query23,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		$row_count = sqlsrv_num_rows( $stmt );
		
		if($row_count > 0){
		return $row_count;
	}
	else{return 0;}

}


function getResolucionesMPtotalsicXdeterm($conn, $idMp, $estatResolucion, $mes, $anio, $deten, $idUnidad){


          $carpeAgente =  getDistincCarpetasAgente($conn, $idMp, $estatResolucion, $mes, $anio, $deten);

          $numResol = 0;
          for ($i=0; $i < sizeof($carpeAgente); $i++) { 
            
              $CaepetaId = $carpeAgente[$i][0];
              
              $lastDetermin = getLastDeterminacionCarpeta($conn, $CaepetaId);

              for ($k=0; $k < sizeof($lastDetermin); $k++) { 

                  $idUnidade = $lastDetermin[$k][2];    

                    if ($idUnidad == $idUnidade) {
                          $numResol++;
                    }
              }

          }

		
		if($numResol > 0){
		return $numResol;
	}
	else{return 0;}



}

//// ESTA FUNCION DEBE DE RECIBIR LA UNIDAD EL AGENTE MES ANIO  DETEN Y TIPO DE DETERMINACION QUE SE REQUIERE COMPARAR Y SABER SI SE SUMAN O NO 

function getLAstResolucionesFromAdeterm($conn, $idMp, $estatResolucion, $mes, $anio, $deten, $idUnidad){


		$carpeAgente = getDistincCarpetasAgente($conn, $idMp, $estatResolucion, $mes, $anio, $deten);
		$carpeAgente3 = getDistincCarpetasAgente3($conn, $idMp, $estatResolucion, $mes, $anio, $deten, $idUnidad); //// SE AGREGA EL ID DE UNIDAD PARA QUE SOLO SE BUSQUEN NUCS DE LA UNIDAD EN LA QUE SE ENCUENTRA ACTUALMENTE

	//$carpeAgente =  getDistincCarpetasAgenteDetemrn20($conn, $idMp, $mes, $anio, $deten, $estatResolucion);
	$carpeAgente2 = getDistincCarpetasDataUNidReso($conn, $idMp, $estatResolucion, $mes, $anio, $deten);
	
	$numResol = 0;

          for ($i=0; $i < sizeof($carpeAgente3); $i++) { 
            
              $CaepetaId = $carpeAgente3[$i][0];
              $unid = $carpeAgente3[$i][1];             



              $reinicidassi = knowisReinicida($conn, $anio, $mes, $idUnidad, $CaepetaId);	

																                  		if( $reinicidassi ){   

																                  						$idCarpeta = getIDresolopen($conn, $anio, $mes, $idUnidad, $CaepetaId);													                  							
																																											$idresolu = $idCarpeta[0][0];
																																											$estaResol = $idCarpeta[0][1];
																																											$idunid = $idCarpeta[0][2];

																																												////	if($unid == $unid){	 ///////////// ASI ESTABA Y SALIA BIEN

																																											if($unid == $idunid){ ///// ASI PARECE SER QUE FUNCIONA BIEN TAMBIEN

																																														$numResol++;

																																											}
																																															                  					

																                  		}else{
																																			              $lastDetermin = getLastDeterminacionCarpeta($conn, $CaepetaId);

																																			              for ($k=0; $k < sizeof($lastDetermin); $k++) { 

																																			                  	$idUnidade = $lastDetermin[$k][2];  
																																			                    $estas = $lastDetermin[$k][3]; 
																																			                   $agenteid = $lastDetermin[$k][4];

																																			                    //echo "idUnidade es: ".$idUnidade."y la que lelga es: ".$idUnidad."<br>";


																																			                    if ($idUnidad == $idUnidade && $estas == $estatResolucion AND $idMp == $agenteid) {
																																			                          $numResol++;
																																			                    }
																																			              }




																                  		}
          }
          	if($numResol > 0){
		return $numResol;
	}
	else{return 0;}

} 



function getLAstResolucionesFromAdetermLitigSicap($conn, $idMp, $estatResolucion, $mes, $anio, $deten, $idUnidad){


 $carpeAgente = getDistincCarpetasAgenteLiti($conn, $idMp, $estatResolucion, $mes, $anio, 0);
	$numResol = 0;

          for ($i=0; $i < sizeof($carpeAgente); $i++) { 
            
       
              $idResolMP = $carpeAgente[$i][0];
														$carpid = $carpeAgente[$i][1];
														$idUnidade = $carpeAgente[$i][2];
														$EstatusID = $carpeAgente[$i][4];
														$agenteid = $carpeAgente[$i][5];
              

              $reinicidassi = knowisReinicida($conn, $anio, $mes, $idUnidad, $carpid);	



																                  		if( $reinicidassi ){   


																                  						$idCarpeta = getIDresolopen($conn, $anio, $mes, $idUnidad, $carpid);																                  							

																																											$idresolu = $idCarpeta[0][0];
																																											$estaResol = $idCarpeta[0][1];

																																											if($estatResolucion == $estaResol){

																																														$numResol++;

																																											}																                  					

																                  		}else{    

																																			                    if ($idUnidad == $idUnidade && $EstatusID == $estatResolucion AND $idMp == $agenteid) {
																																			                          $numResol++;
																																			                    }
																																			              




																                  		}
          }
          	if($numResol > 0){
		return $numResol;
	}
	else{return 0;}

} 

function validarEstatusShowInfoSica($estatResolucion){

	if($estatResolucion == 3 || $estatResolucion == 4 || $estatResolucion == 19 || $estatResolucion == 17 || $estatResolucion == 18 || $estatResolucion == 20  || $estatResolucion == 21 || $estatResolucion== 22 || $estatResolucion == 23  || $estatResolucion == 24 || $estatResolucion == 25 || $estatResolucion == 26 || $estatResolucion == 27 || $estatResolucion == 28 || $estatResolucion == 29  || $estatResolucion == 30 || $estatResolucion == 31 || $estatResolucion == 95 || $estatResolucion == 61 || $estatResolucion == 63 || $estatResolucion == 99 || $estatResolucion == 89 || $estatResolucion == 101 || $estatResolucion == 103 || $estatResolucion == 105 || $estatResolucion == 106 || $estatResolucion == 89 || $estatResolucion == 107 || $estatResolucion == 108 || $estatResolucion == 109 || $estatResolucion == 110 || $estatResolucion == 111 || $estatResolucion == 64 || $estatResolucion == 60 || $estatResolucion == 14 || $estatResolucion == 65 || $estatResolucion == 66 || $estatResolucion == 67 || $estatResolucion == 68 || $estatResolucion == 90 || $estatResolucion == 91){
		return True;
	}
	else{
		return False;
	}
}

function getDataDelito($conSic , $idCarpeta){
	$query = "  SELECT d.DelitoID 
													      ,d.CarpetaID
													      ,d.CatDelitosID
													      ,d.CatModalidadesID
														  			,cme.Nombre
																	  ,CASE 
																		   WHEN d.principal = 1 THEN 'PRINCIPAL'
																		   WHEN d.principal = 0 THEN 'SECUNDARIO'
																	   ELSE 'Desconocido' 
																    END as tipoDelito
													  FROM Delito d 
													  INNER JOIN CatModalidadesEstadisticas cme ON cme.CatModalidadesEstadisticasID = d.CatModalidadesID
													  WHERE d.CarpetaID = $idCarpeta"; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['DelitoID'];
		$arreglo[$indice][1]=$row['CarpetaID'];
		$arreglo[$indice][2]=$row['CatDelitosID'];
		$arreglo[$indice][3]=$row['CatModalidadesID'];
		$arreglo[$indice][4]=$row['Nombre'];
		$arreglo[$indice][5]=$row['tipoDelito'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

function getDataDelitoNombre($conSic , $idDelito){
	$query = "  SELECT Nombre FROM CatModalidadesEstadisticas WHERE CatModalidadesEstadisticasID = $idDelito"; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}
