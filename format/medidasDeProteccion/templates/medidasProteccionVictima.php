<?php
include ("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

$fecha_actual = date("d/m/Y");
$fecha = strftime("%Y-%m-%d %H:%M:%S", time());
$anioActual = date("Y");
$hoy = date("Y-m-d"); //Fecha calendario
$get_idCoorporacion = 0;

if (isset($_POST["tipoModal"])) {
	$tipoModal = $_POST["tipoModal"];
}
if (isset($_POST["idEnlace"])) {
	$idEnlace = $_POST["idEnlace"];
}
if (isset($_POST["typeArch"])) {
	$typeArch = $_POST["typeArch"];
}
if (isset($_POST["typeCheck"])) {
	$typeCheck = $_POST["typeCheck"];
}

$getRolUser = getRolUser($connMedidas, $idEnlace);
$rolUser = $getRolUser[0][0];

if ($typeCheck == 0) {
	$b = 0;
} else {
	if ($typeCheck == 1) {
		$b = 1;
	}
}

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
		$get_idFiscaliaProcedencia = $medidaData[0][7];
		$get_estatus = $medidaData[0][8];
		$get_idCoorporacion = $medidaData[0][9];
		$a = 1;

		///// MEDIDAS APLICADAS PARA EL RESTIGO /////
		$getMedidasAplicadasTest = getMedidasAplicadasTest($connMedidas, $idMedida);
		$aplicadasTest = array();
		for ($e = 0; $e < sizeof($getMedidasAplicadasTest); $e++) {
			$aplicadasTest[$e] = $getMedidasAplicadasTest[$e][0];
		}
		
		$getMedidasAplicadas = getMedidasAplicadas($connMedidas, $idMedida);
		$aplicadas = array();

		for ($h = 0; $h < sizeof($getMedidasAplicadas); $h++) {
			$aplicadas[$h] = $getMedidasAplicadas[$h][0];
		}
		
		$getDataVictimas = getDataVictimas($connMedidas, $idMedida);

	} else {
		$a = 0;
		$idMedida = 0;
		$causaP = "";
		$bandCausa = 0;
	}
}
?>

<div class="panel-body">
    <h5 class="text-on-pannel"><strong>Medidas de protección VICTIMA</strong></h5>
    <div id="panelMedidasProteccion">
        <?php 
        $numeros = ['uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez'];
        for ($i = 1; $i <= 10 ; $i++) :
            if ($i % 2 != 0) { ?>
            <div class="row"> <?php } ?>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <img
                        src="img/iconosMedidasDeProteccion/iconosMedidas/Medidas <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?> <?= ($a == 1 && in_array($i, $aplicadas)) ? 'Fondo' : 'Gris' ?>.png"
                        onmouseover="hoverIMG(this, '<?= $numeros[$i - 1] ?>')"
                        onmouseout="										
                            if(!consultarInputHidden().includes('<?= $i ?>')){
                                unhoverIMG(this, '<?= $numeros[$i - 1] ?>');
                            }
                        "
                        <?php
                        if ($a == 1 && (sizeof($getMedidasAplicadas) > 0) && $rolUser != 1) { ?>
                            onclick="
                                total = consultarInputHidden().length;
                                if (consultarInputHidden().includes('<?= $i ?>')) {
                                    aplicarMedida(<?= $idEnlace ?>, <?= $idMedida ?>, <?= $i ?>, <?= $get_nuc ?>, 'delete', total)
                                } else {
                                    aplicarMedida(<?= $idEnlace ?>, <?= $idMedida ?>, <?= $i ?>, <?= $get_nuc ?>, 'add', total)
                                }
                            " <?										
                        }
                        else {
                            if ($rolUser != 1 && $rolUser != 4) { ?>
                                onclick="modalDatosMedida(<?= $tipoModal ?>, <?= $idEnlace ?>,<?= $b ?>, <?= $i ?>, <?= $idMedida ?>)" <?
                            }
                            elseif($rolUser == 4) { ?>
                                onclick="
                                    if(consultarInputHidden().includes('<?= $i ?>')) {
                                        quitarMedida(this, <?= $i; ?>, '<?= $numeros[$i - 1] ?>');
                                    }
                                    else {
                                        agregarMedida(this, <?= $i; ?>, '<?= $numeros[$i - 1] ?>');
                                    }
                                " <?
                            }
                        }
                        ?>
                        class="cursorp"
                        width="100%"
                    >
                </div>
            <?php 
            if ($i % 2 == 0) { ?>
            </div> <br>
            <?php } ?>
        <? endfor; ?>
    </div>
</div>