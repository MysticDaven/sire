<?php
include ("../../Conexiones/Conexion.php");
include ("../../Conexiones/conexionMedidas.php");
include ("../../Conexiones/conexionSicap.php");
include("../../funcionesMedidasProteccion.php");

$idEnlace = isset($_POST['idEnlace']) ? $_POST['idEnlace'] : null;
$nuc = isset($_POST['nuc']) ? $_POST['nuc'] : null;
$medidaVictima = isset($_POST['medidaVictima']) ? $_POST['medidaVictima'] : null;

$getRolUser = getRolUser($connMedidas, $idEnlace);
$rolUser = $getRolUser[0][0];

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
		$get_fechaRegistro = $medidaData[0][7];
		$get_idEnlace = $medidaData[0][8];
		$get_idFiscaliaProcedencia = $medidaData[0][9];
		$get_estatus = $medidaData[0][11];
		$a = 1;

		if ($medidaVictima === 'false') {
			$getMedidasAplicadas = getMedidasAplicadas($connMedidas, $idMedida);
		}
		else {
			$getMedidasAplicadas = getMedidasAplicadasTest($connMedidas, $idMedida);	
		}

		///// MEDIDAS APLICADAS PARA EL TESTIGO /////
		// $getMedidasAplicadasTest = getMedidasAplicadasTest($connMedidas, $idMedida);
		// $aplicadasTest = array();
		// for ($e = 0; $e < sizeof($getMedidasAplicadasTest); $e++) {
		// 	$aplicadasTest[$e] = $getMedidasAplicadasTest[$e][0];
		// }
		
		// $getMedidasAplicadas = getMedidasAplicadas($connMedidas, $idMedida);
		$aplicadas = array();

		for ($h = 0; $h < sizeof($getMedidasAplicadas); $h++) {
			$aplicadas[$h] = $getMedidasAplicadas[$h][0];
		}

	} else {
		$a = 0;
		$idMedida = 0;
		$causaP = "";
		$bandCausa = 0;
	}
}

$numeros = ['uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez'] ;
$aplicadasM = $aplicadas;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Medidas de Protección</title>
	
</head>
<body>
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Medidas de Protección <?= ($medidaVictima === 'false' ? 'Víctima' : 'Testigo') ?></strong></h5>
			<?php for ($i = 1; $i <= 10; $i++): ?>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<img 
							src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?> <?= in_array($i, $aplicadas) ? 'Fondo' : 'Gris' ?>.png" 
							onmouseover="hoverIMG(this, '<?= $numeros[$i - 1] ?>');" 
							onmouseout="
								var isIn = consultarInputHidden();
								if(!isIn.includes('<?= $i ?>')){
									unhoverIMG(this, '<?= $numeros[$i - 1] ?>');
								}"							
							<?php if (sizeof($getMedidasAplicadas) > 0) {
								$isInArray = in_array($i, $aplicadas); ?>
								onclick="
									var isIn = consultarInputHidden();
									if(isIn.includes('<?= $i ?>')){
										quitarMedida(this, <?= $i; ?>, '<?= $numeros[$i - 1] ?>');
									}
									else{
										agregarMedidaCont(this, <?= $i; ?>, '<?= $numeros[$i - 1] ?>', 'medidas_selected');
									}
									"
							<?php } ?>								
							class="cursorp" width="150%">
						</img>
					</div>
				</div><br>
			<?php endfor; ?>
		</div>
	</div>
	<div id="medidas_selected">
		<?php for ($i = 1; $i <= 10; $i++){
			if(sizeof($getMedidasAplicadas) > 0){
				if(in_array($i, $aplicadas)){ ?>
					<input type="hidden" id="medidaSeleccionada' + <?= $i; ?>'" class="inputMedidaHidden" name="medidaSeleccionada'+ <?= $i; ?> +'" value="<?= $i; ?>"> <?php
				}
			}			
		} ?>
	</div>
</body>
</html>



