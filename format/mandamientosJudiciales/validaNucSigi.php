<?
//include("../../Conexiones/conexionesSigi.php");
include("../../Conexiones/conexionSicap.php");
if(isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }



			$indice=0;

            $consulta="SELECT * FROM Carpeta WHERE NUC = '$nuc' ";
			/*
			$consulta = "SELECT dbo.caso.cNumeroGeneralCaso AS 'caso', NE.cNumeroExpediente  AS 'expediente', Expediente.dFechaCreacion AS 'apertura', uie.cNombreUIE as 'unidad', CDi.catDistrito_id as 'fiscalia', CONCAT(FN.cNombreFuncionario,' ',FN.cApellidoPaternoFuncionario,' ',FN.cApellidoMaternoFuncionario) AS 'funcionario', Valor.cValor as 'estatus' FROM dbo.caso 
			inner join Expediente EX on  dbo.caso.Caso_id = EX.Caso_id	 
			left join CatDiscriminante CDi on EX.catDiscriminante_id = CDi.catDiscriminante_id	   
			left join CatDistrito CDs on CDi.catDistrito_id = CDs.catDistrito_id	   
			left join dbo.Expediente ON Expediente.Caso_id = dbo.Caso.Caso_id	
			left join NumeroExpediente NE on NE.Expediente_id= Expediente.Expediente_id          
			inner join dbo.Valor on NE.Estatus_val = dbo.Valor.Valor_id
			left join dbo.CATUIEspecializada on Expediente.CatUIE_id=dbo.CATUIEspecializada.CatUIE_id	
			INNER join Funcionario FN on NE.iClaveFuncionario = FN.iClaveFuncionario	
			left join dbo.CATUIEspecializada uie on FN.CATUIE_id =uie.CatUIE_id
			where NE.NumeroExpediente_id in (select max(NumeroExpediente_id) from NumeroExpediente where dbo.NumeroExpediente.JerarquiaOrganizacional_id in(10,44) group by Expediente_id)	and cNumeroGeneralCaso = '$nuc' ";*/
			//echo ".......................................................................".$consulta;
			$stmt = sqlsrv_query( $conSic , $consulta);
			while(	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				$arreglo[$indice][0]=$row['NUC'];
				//$arreglo[$indice][1]=$row['expediente'];
				//$arreglo[$indice][2]=$row['apertura']->format('d/m/Y');
				//$arreglo[$indice][3]=$row['unidad'];
				//$arreglo[$indice][4]=$row['fiscalia'];
				//$arreglo[$indice][5]=$row['funcionario'];
				//$arreglo[$indice][6]=$row['estatus'];
				$indice++;
				
			}
			sqlsrv_close( $conSic );
		 $opc[0] = "NO";
   $opc[1] = "SI";
			if($indice==0){
				echo json_encode( array( 'first' => $opc[0] ) );
			}
			else{
				$d =  array( 'first' =>  $opc[1] , 'arrayData' => $arreglo );
				echo json_encode($d);
			}
?>