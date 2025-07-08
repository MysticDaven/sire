<?
session_start();

include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionSicap.php");
include("../../../funciones.php");
include("../../../funcioneSicap.php");
include("../../../funcioneLit.php");

if (isset($_POST["cant"])) { $cant = $_POST["cant"]; }
if (isset($_POST["idMp"])) { $idMp = $_POST["idMp"]; }
if (isset($_POST["mes"])) { $mes = $_POST["mes"]; }
if (isset($_POST["anio"])) { $anio = $_POST["anio"]; }
if (isset($_POST["idUnidad"])) { $idUnidad = $_POST["idUnidad"]; }
if (isset($_POST["estatus"])) { $estatus = $_POST["estatus"]; }

$idUsuario = $_SESSION['useridIE'];

$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
$idEnlace = $enlace[0][0];
$idfisca = $enlace[0][1];

$bandImputado = 0;

$arrayIDSllevanImputado = array(1,	2,	151,	10,	12,	13,	14,	15,	17,	18,	19,	20,	21,	22,	23,	24,	25,	26,	27,	28,	29,	30,	31,	36,	38
,	50,	53,	57,	58,	64,	65,	66,	67,	81,	84,	89,	90,	91,	93,	97,	99,	152,	153,	154,	155,	156,	157,	158,	159,	160,	161,	162,	163,	164, 165);

if(in_array($estatus, $arrayIDSllevanImputado)){
    $bandImputado = 1;
}else{
    $bandImputado = 0;
}


$numestatus = intval($estatus);


$sicaBand = 0;

if ($numestatus == 19 || $numestatus == 15 || $numestatus == 14 || $numestatus == 13) {

    $dataestatusLitSic = getEstatusResoluicionName($conSic, $estatus);
    $tipoestatus = $dataestatusLitSic[0][0];
    $sicaBand = 1;
} else {

    $dataestatusLit = getDataEstatusLitigacion($conn, $estatus);
    $tipoestatus = $dataestatusLit[0][0];
}


//echo $estatus."----".$tipoestatus;

$idUsuario = $_SESSION['useridIE'];


?>
<div class="modal-header" style="background-color:#3c6084;">
    <center>
        <h4 class="modal-title" style="color:white; font-weight: bold;"> VALIDACIÓN DE NUCS </h4>
    </center>
</div>

<div class="panel-body panelunoLitigacion">
    <div class="row">
            <div class="col-xs-6">
                <label>Cantidad de Casos :</label>
                <input id="casos" type="text" value="<? echo $cant; ?>" name="casos" value="Expediente" tabindex="0" placeholder="" style="height:38px; font-weight: bold;" class="fechas form-control redondear" disabled />
            </div>
            <div class="col-xs-6">
                <label>Estatus :</label>
            <input id="expediente" type="text" value="<? echo $tipoestatus; ?>" name="expediente" tabindex="0" placeholder="" style="height:38px; font-weight: bold;" class="fechas form-control redondear" disabled />
        </div>
    </div>

    <div id="contDataNucDeterm"></div>

    <div id="div_nuc">
        <div class="row">
            <div class="col-xs-6">
                <label style="font-weight:bold">Número de Caso *</label>
                <input id="nuc" type="number" name="nuc" value="" tabindex="0" onkeyup="<? if ($sicaBand == 1) { ?>  nucFunctionsLit('nuc', <? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatus; ?>, 0, <? echo $idUnidad; ?>); <?  } else {  ?>  nucInserts('nuc', <? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatus; ?>, 0, <? echo $idUnidad; ?>); <? } ?>" placeholder="Ingresa Número de Caso" style="height:38px; font-weight: bold;" class="fechas form-control redondear" autofocus />
            </div>
            <div class="col-xs-6">
                <label style="font-weight:bold">Expediente *</label>
                <div id="expedCont">
                    <input id="expediente" type="" name="expediente" value="Expediente" tabindex="0" placeholder="" style="height:38px;" class="fechas form-control redondear" disabled />
                </div>
            </div>
        </div>
    </div>

    <div class="row"><br>

        <div id="contTableNucslitgTramite" style="overflow-y: hidden; overflow-x: hidden; padding: 15px;">

            <table id="gridTramite" class="display table table-striped  table-hover" style="width:100%" >
                <thead>
                <tr class="cabeceraConsultaTramite">
                    <th><input type="checkbox" id="selectAllCarpetas" /></th> <!-- NUEVO -->
                    <th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
                    <th class="col-xs-4 col-sm-4 col-md-4 textCent">NUC </th>
                    <th class="col-xs-6 col-sm-6 col-md-6 textCent">Expediente</th>
                    <th class="col-xs-6 col-sm-6 col-md-6 textCent">Causa Penal</th>
                    <th class="col-xs-6 col-sm-6 col-md-6 textCent">Cuaderno de antecedentes</th>
                    <th class="col-xs-6 col-sm-6 col-md-6 textCent">Cuaderno con algún requerimiento</th>
                    <th class="col-xs-6 col-sm-6 col-md-6 textCent">En archivo en sede judicial</th>
                    <th class="col-xs-6 col-sm-6 col-md-6 textCent">Imputado(s)</th>
                    <th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
                    <th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
                </tr>
                </thead>
                <tbody id="contentConsulta">

               <?

                    //// Obtener las carpetas del Mp
                    $sumador = 0;
                    $carpeAgente = getTramiteAgenteLitigacion($conn, $idMp, $estatus, $mes, $anio, $idUnidad);


                    for ($i = 0; $i < sizeof($carpeAgente); $i++) {

                        $nuc = $carpeAgente[$i][0];
                        $idEstatusNucsThisNUC = $carpeAgente[$i][1]; //se agrego para obtener el idEstatusNucs
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
                                <td class="tdRowMainData negr"><? echo ($sumador + 1); ?></td>
                                <td class="tdRowMainData negr"><? echo $nuc; ?></td>
                                <td class="tdRowMainData negr"><? echo $exp; ?></td>
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
                                <!--SE AGREGO EL BOTON PARA ABRIR EL NUEVO MODAL-->
                                <td class="tdRowMainData">
                                    <button style="width: 100%; height:34%; font-size: 1em;  box-sizing: border-box;" type="button" onclick="sendDataModalImputadosNUC_tramite(<? echo $nuc; ?>, <? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, 181, <? echo $idUnidad; ?>)" class="btn-success btn-sm redondear"><span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Editar </button>
                                </td>
                                <td class="tdRowMainData">
                                    <button style="width: 100%; height:34%; font-size: 1em;  box-sizing: border-box;" type="button" onclick="deleteTramiteCarpeta(<? echo $idEstatusNucsThisNUC; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus ?>, <? echo $nuc; ?>, <? echo $idUnidad; ?>)" class="btn-danger btn-sm redondear"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button>
                                </td>
                            </tr>
                            <?
                            $sumador++;

                    }

                ?>


                </tbody>
            </table>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8">
                    <label><b>Selecciona el nuevo Ministerio Público:</b></label>
                    <select id="nuevoMp" class="form-control redondear">
                        <option value="">Seleccione un Ministerio Público</option>
                        <?php
                        // Rellenar con lista de MPs disponibles
                        $mps = getMpsEnlaceUnidadFormatoMigrarTramite($conn, $idEnlace, 4, $idMp);
                        for ($i = 0; $i < sizeof($mps); $i++) { ?>
                            <option value="<?php echo $mps[$i][4]; ?>"><?php echo $mps[$i][0]." ".$mps[$i][1]." ".$mps[$i][2] ?></option>
                       <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4" style="margin-top: 25px;">
                    <button class="btn btn-success btn-block redondear" onclick="migrarCarpetasSeleccionadas(<? echo $idMp; ?>, <? echo $estatus; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>);">
                        <span class="glyphicon glyphicon-random"></span> Migrar seleccionadas
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="row"><br>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <center><button style="width: 97%;" type="button" class="btn btn-primary redondear" onclick="salirModal_tramite(<?php echo $idMp; ?> , <?php echo $idUnidad ?>)">Salir</button></center>
    </div> <br>
</div><br>
