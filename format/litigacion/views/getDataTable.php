<?php
// getTableData.php
header('Content-Type: text/html; charset=utf-8');

include("../../../Conexiones/conexionSicap.php");
include("../../../funcioneSicap.php");
include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");
include("../../../funcioneLit.php");

$idMp = $_POST['idMp'];
$estatus = $_POST['estatus'];
$mes = $_POST['mes'];
$anio = $_POST['anio'];
$idUnidad = $_POST['idUnidad'];

$sumador = 0;
$carpeAgente = getTramiteAgenteLitigacion($conn, $idMp, $estatus, $mes, $anio, $idUnidad);

ob_start();
for ($i = 0; $i < sizeof($carpeAgente); $i++) {
    $nuc = $carpeAgente[$i][0];
    $idEstatusNucsThisNUC = $carpeAgente[$i][1];
    $idMp = $carpeAgente[$i][2];
    $idUnidad = $carpeAgente[$i][3];
    $anio = $carpeAgente[$i][4];
    $mes = $carpeAgente[$i][5];
    $idCarpeta = $carpeAgente[$i][6];

    $nucs = getNucExpSicap($conSic, $idCarpeta);
    $exp = $nucs[0][1];

    // Obtener los datos de tramiteLitigacion
    $datosTramite = getDatosTramiteLitigacion($conn, $idEstatusNucsThisNUC);

    // Obtener los imputados si hay datos del trámite
    $imputados = array();
    if ($datosTramite && isset($datosTramite['idCarpetaTramite'])) {
        $imputados = getImputadosTramite($conn, $datosTramite['idCarpetaTramite']);
    }
    ?>
    <tr>
        <td class="textCent">
            <input type="checkbox" class="tdRowMainData negr checkCarpeta" value="<?php echo $idEstatusNucsThisNUC; ?>">
        </td>
        <td class="tdRowMainData negr"><?php echo ($sumador + 1); ?></td>
        <td class="tdRowMainData negr"><?php echo $nuc; ?></td>
        <td class="tdRowMainData negr"><?php echo $exp; ?></td>
        <td class="tdRowMainData negr">
            <?= ($datosTramite && $datosTramite['causaPenal']) ? $datosTramite['causaPenal'] : 'N/A' ?>
        </td>
        <td class="tdRowMainData negr">
            <?= ($datosTramite && $datosTramite['cuadernoAntecedentes']) ? $datosTramite['cuadernoAntecedentes'] : 'N/A' ?>
        </td>
        <td class="tdRowMainData negr">
            <?= ($datosTramite && $datosTramite['cuadernoConRequerimiento']) ? 'SI' : 'NO' ?>
        </td>
        <td class="tdRowMainData negr">
            <?= ($datosTramite && $datosTramite['archivoEnSedeJudicial']) ? 'SI' : 'NO' ?>
        </td>
        <td class="tdRowMainData negr">
            <?php
            if (!empty($imputados)) {
                echo "<div class='imputados-list'>";
                foreach ($imputados as $imputado) {
                    $nombreCompleto = trim($imputado['nombre'] . ' ' .
                        $imputado['apellidoPaterno'] . ' ' .
                        $imputado['apellidoMaterno']);
                    echo "<div class='imputado-item'>" . htmlspecialchars($nombreCompleto) . "</div>";
                }
                echo "</div>";
            } else {
                echo "Sin imputados registrados";
            }
            ?>
        </td>
        <td class="tdRowMainData">
            <button style="width: 100%; height:34%; font-size: 1em; box-sizing: border-box;"
                    type="button"
                    onclick="sendDataModalImputadosNUC_tramite('<?php echo $nuc; ?>', <?php echo $idMp; ?>, <?php echo $mes; ?>, <?php echo $anio; ?>, 181, <?php echo $idUnidad; ?>)"
                    class="btn-success btn-sm redondear">
                <span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Editar
            </button>
        </td>
        <td class="tdRowMainData">
            <button style="width: 100%; height:34%; font-size: 1em; box-sizing: border-box;"
                    type="button"
                    onclick="deleteTramiteCarpeta(<?php echo $idEstatusNucsThisNUC; ?>, <?php echo $idMp; ?>, <?php echo $anio; ?>, <?php echo $mes; ?>, <?php echo $estatus ?>, '<?php echo $nuc; ?>', <?php echo $idUnidad; ?>)"
                    class="btn-danger btn-sm redondear">
                <span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar
            </button>
        </td>
    </tr>
    <?php
    $sumador++;
}
$html = ob_get_clean();
// Devolver respuesta JSON con el HTML
echo json_encode(['html' => $html]);

?>