<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");
require '../../../vendors/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$dayInicio = isset($_POST['dayInicio']) ? $_POST['dayInicio'] : null;
$monthInicio = isset($_POST['monthInicio']) ? $_POST['monthInicio'] : null;
$yearInicio = isset($_POST['yearInicio']) ? $_POST['yearInicio'] : null;
$dayFinal = isset($_POST['dayFinal']) ? $_POST['dayFinal'] : null;
$monthFinal = isset($_POST['monthFinal']) ? $_POST['monthFinal'] : null;
$yearFinal = isset($_POST['yearFinal']) ? $_POST['yearFinal'] : null;

$idEnlace = isset($_POST['idEnlace']) ? $_POST['idEnlace'] : null;
$rolUser = isset($_POST['rolUser']) ? $_POST['rolUser'] : null;
$fechaReporte = date("d") . '-' . date("m") . '-' . date("Y");

$fechaConsulta = ($dayInicio == $dayFinal && $monthInicio == $monthFinal && $yearInicio == $yearFinal)
    ? str_pad($dayInicio, 2, '0', STR_PAD_LEFT) . '-' . str_pad($monthInicio, 2, '0', STR_PAD_LEFT) . '-' . $yearInicio
    : str_pad($dayInicio, 2, '0', STR_PAD_LEFT) . '-' . str_pad($monthInicio, 2, '0', STR_PAD_LEFT) . '-' . $yearInicio . ' AL ' . str_pad($dayFinal, 2, '0', STR_PAD_LEFT) . '-' . str_pad($monthFinal, 2, '0', STR_PAD_LEFT) . '-' . $yearInicio;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

if($rolUser == 1){
    $query = "
        DECLARE @fechaInicio DATE = DATEFROMPARTS($yearInicio, $monthInicio, $dayInicio);
        DECLARE @fechaFinal DATE = DATEFROMPARTS($yearFinal, $monthFinal, $dayFinal);

        SELECT * FROM (
            SELECT 
            m.idMedida AS folio,
            mp.nombre + ' ' + mp.paterno + ' ' + mp.materno AS nombreMP,
            m.nuc,
            CASE
                WHEN m.nOficio IS NULL THEN 'Desconocido'
                ELSE m.nOficio
            END AS nOficio,
            d.Nombre AS delito,
            cu.nombre AS unidad,
			(
				SELECT
					p.nombre + ' ' + p.paterno + ' ' + p.materno +
						CASE WHEN p.esVictima = 0 THEN ' (Testigo)' ELSE '' END AS nombreVictima,
        
					CASE 
						WHEN p.genero = 1 THEN 'Masculino'
						WHEN p.genero = 2 THEN 'Femenino'
						ELSE 'Desconocido'
					END AS genero,

					p.edad,
					'Mexicana' AS nacionalidad,

					ISNULL(ce.Nombre, 'Desconocido') AS estado,
					ISNULL(cm.Nombre, 'Desconocido') AS municipio

				FROM (
					SELECT
						CASE WHEN v.idVictima IS NOT NULL THEN 1 ELSE 0 END AS esVictima,
						ISNULL(v.nombre, t.nombre) AS nombre,
						ISNULL(v.paterno, t.paterno) AS paterno,
						ISNULL(v.materno, t.materno) AS materno,
						ISNULL(v.genero, t.genero) AS genero,
						ISNULL(v.edad, t.edad) AS edad,
						ISNULL(v.idEntidad, t.idEntidad) AS idEntidad,
						ISNULL(v.idMunicipio, t.idMunicipio) AS idMunicipio
					FROM SIRE.medidas.medidasProteccion m2
					LEFT JOIN SIRE.medidas.victimas v ON v.idMedida = m2.idMedida
					LEFT JOIN SIRE.medidas.testigo t ON t.idMedida = m2.idMedida
					WHERE m2.idMedida = m.idMedida
				) p
				LEFT JOIN PRUEBA.dbo.CatEntidades ce ON ce.EntidadID = p.idEntidad
				LEFT JOIN PRUEBA.dbo.CatMunicipiosPais cm ON cm.MunicipioID = p.idMunicipio
				FOR JSON PATH
			) AS victimas,
			(
				SELECT 
					CASE 
						WHEN EXISTS (
							SELECT 1 
							FROM SIRE.medidas.medidasAplicadas ma 
							WHERE ma.idMedida = m.idMedida
						)
						THEN (
							SELECT COUNT(*) 
							FROM SIRE.medidas.medidasAplicadas ma 
							WHERE ma.idMedida = m.idMedida
						)
						ELSE (
							SELECT COUNT(*) 
							FROM SIRE.medidas.medidasAplicadasTestigo mat 
							WHERE mat.idMedida = m.idMedida
						)
					END
			) AS numeroMedidasAplicadas,
            (
            SELECT
                CASE
                    WHEN EXISTS (
                        SELECT 1 
						FROM SIRE.medidas.medidasAplicadas ma
                        WHERE ma.idMedida = m.idMedida
                    )
                    THEN (
                        SELECT
                            cf.nombre,
                            cf.idCatFraccion AS fraccion
                        FROM SIRE.medidas.medidasAplicadas m2
                        INNER JOIN SIRE.medidas.catFracciones cf ON m2.idCatFraccion = cf.idCatFraccion
                        WHERE m2.idMedida = m.idMedida
                        FOR JSON PATH
                    )
                    ELSE (
                        SELECT
                            cf.nombre,
                            cf.idCatFraccion AS fraccion
                        FROM SIRE.medidas.medidasAplicadasTestigo m2
                        INNER JOIN SIRE.medidas.catFracciones cf ON m2.idCatFraccion = cf.idCatFraccion
                        WHERE m2.idMedida = m.idMedida
                        FOR JSON PATH
                    )
                    END
            ) AS medidasAplicadas,
            ca.temporalidad,
            m.fechaRegistro,
            m.fechaAcuerdo AS inicio,
            m.fechaConclusion AS fin,
            ultimaAmpliacion.ampliacion,
            ultimaAmpliacion.temporalidadPrevia,
            ultimaAmpliacion.temporalidadActual,
            CASE
                WHEN cc.nombre IS NULL THEN 'Desconocido'
                ELSE cc.nombre
            END  AS coorporacion
            FROM SIRE.medidas.medidasProteccion m
            LEFT JOIN SIRE.medidas.mp ON mp.idMp = m.idMP
            INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
            LEFT JOIN SIRE.medidas.cuadernoAntecedentes ca ON ca.idMedida = m.idMedida
            LEFT JOIN SIRE.medidas.resoluciones r ON r.idMedida = m.idMedida
            LEFT JOIN SIRE.medidas.catUnidad cu ON cu.idUnidad = m.idUnidad
            LEFT JOIN SIRE.medidas.catCoorporacion cc ON cc.idCatCoorporacion = m.idCatCoorporacion
            LEFT JOIN (
                SELECT 
                    am.idResolucion,
                    am.ampliacion,
                    am.temporalidadPrevia,
                    am.temporalidadActual,
                    ROW_NUMBER() OVER(PARTITION BY am.idResolucion ORDER BY am.idAmpliada DESC) AS rn
                FROM SIRE.medidas.ampliada as am
            ) AS ultimaAmpliacion ON r.idResolucion = ultimaAmpliacion.idResolucion AND ultimaAmpliacion.rn = 1
            WHERE CAST(m.fechaAcuerdo AS DATE) BETWEEN @fechaInicio AND @fechaFinal
        ) AS subconsulta ORDER BY folio desc;
    ";
}
elseif($rolUser == 4){
    $query = "
        DECLARE @fechaInicio DATE = DATEFROMPARTS($yearInicio, $monthInicio, $dayInicio);
        DECLARE @fechaFinal DATE = DATEFROMPARTS($yearFinal, $monthFinal, $dayFinal);

        SELECT * FROM (
            SELECT 
            m.idMedida AS folio,
            mp.nombre + ' ' + mp.paterno + ' ' + mp.materno AS nombreMP,
            m.nuc,
            CASE
                WHEN m.nOficio IS NULL THEN 'Desconocido'
                ELSE m.nOficio
            END AS nOficio,
            d.Nombre AS delito,
            cu.nombre AS unidad,
			(
				SELECT
					p.nombre + ' ' + p.paterno + ' ' + p.materno +
						CASE WHEN p.esVictima = 0 THEN ' (Testigo)' ELSE '' END AS nombreVictima,
        
					CASE 
						WHEN p.genero = 1 THEN 'Masculino'
						WHEN p.genero = 2 THEN 'Femenino'
						ELSE 'Desconocido'
					END AS genero,

					p.edad,
					'Mexicana' AS nacionalidad,

					ISNULL(ce.Nombre, 'Desconocido') AS estado,
					ISNULL(cm.Nombre, 'Desconocido') AS municipio

				FROM (
					SELECT
						CASE WHEN v.idVictima IS NOT NULL THEN 1 ELSE 0 END AS esVictima,
						ISNULL(v.nombre, t.nombre) AS nombre,
						ISNULL(v.paterno, t.paterno) AS paterno,
						ISNULL(v.materno, t.materno) AS materno,
						ISNULL(v.genero, t.genero) AS genero,
						ISNULL(v.edad, t.edad) AS edad,
						ISNULL(v.idEntidad, t.idEntidad) AS idEntidad,
						ISNULL(v.idMunicipio, t.idMunicipio) AS idMunicipio
					FROM SIRE.medidas.medidasProteccion m2
					LEFT JOIN SIRE.medidas.victimas v ON v.idMedida = m2.idMedida
					LEFT JOIN SIRE.medidas.testigo t ON t.idMedida = m2.idMedida
					WHERE m2.idMedida = m.idMedida
				) p
				LEFT JOIN PRUEBA.dbo.CatEntidades ce ON ce.EntidadID = p.idEntidad
				LEFT JOIN PRUEBA.dbo.CatMunicipiosPais cm ON cm.MunicipioID = p.idMunicipio
				FOR JSON PATH
			) AS victimas,
			(
				SELECT 
					CASE 
						WHEN EXISTS (
							SELECT 1 
							FROM SIRE.medidas.medidasAplicadas ma 
							WHERE ma.idMedida = m.idMedida
						)
						THEN (
							SELECT COUNT(*) 
							FROM SIRE.medidas.medidasAplicadas ma 
							WHERE ma.idMedida = m.idMedida
						)
						ELSE (
							SELECT COUNT(*) 
							FROM SIRE.medidas.medidasAplicadasTestigo mat 
							WHERE mat.idMedida = m.idMedida
						)
					END
			) AS numeroMedidasAplicadas,
            (
            SELECT
                CASE
                    WHEN EXISTS (
                        SELECT 1 
						FROM SIRE.medidas.medidasAplicadas ma
                        WHERE ma.idMedida = m.idMedida
                    )
                    THEN (
                        SELECT
                            cf.nombre,
                            cf.idCatFraccion AS fraccion
                        FROM SIRE.medidas.medidasAplicadas m2
                        INNER JOIN SIRE.medidas.catFracciones cf ON m2.idCatFraccion = cf.idCatFraccion
                        WHERE m2.idMedida = m.idMedida
                        FOR JSON PATH
                    )
                    ELSE (
                        SELECT
                            cf.nombre,
                            cf.idCatFraccion AS fraccion
                        FROM SIRE.medidas.medidasAplicadasTestigo m2
                        INNER JOIN SIRE.medidas.catFracciones cf ON m2.idCatFraccion = cf.idCatFraccion
                        WHERE m2.idMedida = m.idMedida
                        FOR JSON PATH
                    )
                    END
            ) AS medidasAplicadas,
            ca.temporalidad,
            m.fechaRegistro,
            m.fechaAcuerdo AS inicio,
            m.fechaConclusion AS fin,
            ultimaAmpliacion.ampliacion,
            ultimaAmpliacion.temporalidadPrevia,
            ultimaAmpliacion.temporalidadActual,
            CASE
                WHEN cc.nombre IS NULL THEN 'Desconocido'
                ELSE cc.nombre
            END  AS coorporacion
            FROM SIRE.medidas.medidasProteccion m
            LEFT JOIN SIRE.medidas.mp ON mp.idMp = m.idMP
            INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
            LEFT JOIN SIRE.medidas.cuadernoAntecedentes ca ON ca.idMedida = m.idMedida
            LEFT JOIN SIRE.medidas.resoluciones r ON r.idMedida = m.idMedida
            LEFT JOIN SIRE.medidas.catUnidad cu ON cu.idUnidad = m.idUnidad
            LEFT JOIN SIRE.medidas.catCoorporacion cc ON cc.idCatCoorporacion = m.idCatCoorporacion
            LEFT JOIN (
                SELECT 
                    am.idResolucion,
                    am.ampliacion,
                    am.temporalidadPrevia,
                    am.temporalidadActual,
                    ROW_NUMBER() OVER(PARTITION BY am.idResolucion ORDER BY am.idAmpliada DESC) AS rn
                FROM SIRE.medidas.ampliada as am
            ) AS ultimaAmpliacion ON r.idResolucion = ultimaAmpliacion.idResolucion AND ultimaAmpliacion.rn = 1
            WHERE CAST(m.fechaAcuerdo AS DATE) BETWEEN @fechaInicio AND @fechaFinal AND mp.idEnlace = $idEnlace
        ) AS subconsulta ORDER BY folio desc;
    ";
}

$result = sqlsrv_query($connMedidas, $query, array(), array("Scrollable" => 'static'));

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$arreglo = array();
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    array_push($arreglo, $row);
}

sqlsrv_free_stmt($result);
sqlsrv_close($connMedidas);

$contC = 11;
$keys = ['folio', 'nombreMP', 'nuc', 'nOficio', 'delito','unidad'];
$keysVictima = ['nombreVictima', 'genero', 'edad', 'nacionalidad', 'estado', 'municipio'];
$keysMedida = ['nombre', 'fraccion'];
$keysFechas = ['fechaRegistro', 'inicio', 'fin', 'ampliacion', 'temporalidadActual', 'coorporacion'];

foreach ($arreglo as $registro) {
    $col = 'A';
    foreach ($keys as $key) {
        $sheet->setCellValue($col.(string)($contC), $registro[$key]);
        $col++;
    }
    $victimas = json_decode($registro['victimas'], true);
    if ($victimas !== null) {        
        $aux = $col;        
        foreach($victimas as $victima){
            $col = $aux;            
            foreach($keysVictima as $key){
                if($key == 'edad'){
                    $cell = $sheet->getCell($col.(string)($contC));
                    $cellValue = $cell->getValue();
                    if($victima[$key] <= 0){
                        $v = $victima[$key] * -1;
                        if($v == 0){
                            $v = 'Desconocido';
                        }
                        else{
                            $v = ($v == 1) ? $v . ' mes' : $v . ' meses';
                        }
                        $newValue = $cellValue . "\n" . $v;
                        $sheet->setCellValue($col.(string)($contC), $newValue);
                        $col++;                        
                    }
                    else{
                        $y = ($victima[$key] == 1) ? 'año' : 'años';
                        $newValue = $cellValue . "\n" . $victima[$key] . ' ' . $y;
                        $sheet->setCellValue($col.(string)($contC), $newValue);
                        $col++;
                    }
                }
                else{
                    $cell = $sheet->getCell($col . (string)($contC));
                    $cellValue = $cell->getValue();            
                    $newValue = $cellValue . "\n" . $victima[$key];
                    $sheet->setCellValue($col.(string)($contC), $newValue);
                    $col++;
                }                
            }
        }
    }
    
    $sheet->setCellValue($col.(string)($contC), $registro['numeroMedidasAplicadas']);
    $col++;
    $medidas = json_decode($registro['medidasAplicadas'], true);
    if($medidas !== null){
        $aux = $col;
        foreach($medidas as $medida){
            $col = $aux;
            foreach($keysMedida as $key){
                if($key != 'fraccion'){
                    $cell = $sheet->getCell($col . (string)($contC));
                    $cellValue = $cell->getValue();
                    $newValue = $cellValue . "\n" . $medida[$key];
                    $sheet->setCellValue($col.(string)($contC), $newValue);
                    $col++;
                }
                else{                    
                    $fraccion = $medida[$key] - 1;
                    for($i = 0; $i < $fraccion; $i++){
                        $col++;
                    }
                    $sheet->setCellValue($col.(string)($contC), 'X');
                    $cell = $sheet->getCell('O' . (string)($contC));
                    $cellValue = $cell->getValue();
                    if($cellValue == ''){
                        $sheet->setCellValue('O'.(string)($contC), ' '); 
                    }
                }
            }
        }
    }
    $col = 'Y';
    $sheet->setCellValue($col.(string)($contC), $registro['temporalidad']);
    $col++;
    // if($registro['ampliacion'] != "") {
    //     $sheet->setCellValue($col.(string)($contC), $registro['temporalidadPrevia']);
    //     $col++;
    // }
    // else{
    //     $sheet->setCellValue($col.(string)($contC), $registro['temporalidad']);
    //     $col++;
    // }
    foreach($keysFechas as $key){
        if($key == 'ampliacion'){
            if($registro[$key] === 1){
                $sheet->setCellValue($col.(string)($contC), 'X');
                $col++;
            }
            elseif($registro[$key] == 0){
                $col++;
                $sheet->setCellValue($col.(string)($contC), 'X');          
            }
            else{
                $col++;
            }
            $col++;
            continue;
        }
        if($key == 'temporalidadActual'){
            if($registro[$key] == ''){
                $sheet->setCellValue($col.(string)($contC), 'N/A');
                $col++;
                continue;
            }            
        }     
        $sheet->setCellValue($col.(string)($contC), $registro[$key]);
        $col++;
    }
    $contC++;
}

//------------------------------------------------DESIGN EXCEL------------------------------------------------------
//-----------IMAGEN DE ENCABEZADO--------------
$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('logo');
$drawing->setDescription('logo');
$drawing->setPath('../../../images/nombre.png');
$drawing->setHeight(150);
$drawing->setWidth(1180);
$drawing->setCoordinates('C1');
$drawing->setWorksheet($sheet);

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('logo');
$drawing->setDescription('logo');
$drawing->setPath('../../../images/dgtipe.png');
$drawing->setHeight(250);
$drawing->setWidth(400);
$drawing->setCoordinates('AB2');
$drawing->setWorksheet($sheet);

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('logo');
$drawing->setDescription('logo');
$drawing->setPath('../../../images/FGE.png');
$drawing->setHeight(160);
$drawing->setWidth(160);
$drawing->setCoordinates('B2');
$drawing->setWorksheet($sheet);
//-------------------------CELDAS----------------------------
$celdas = [
    'C8' => 'Información Obtenida del Sistema Integral de Registro Estadístico (SIRE)',
    'A9' => 'Folio',
    'B9' => 'Agente del Ministerio Público',
    'C9' => 'NUC',
    'D9' => 'No. de Oficio',
    'E9' => 'Delito',
    'F9' => 'Unidad',
    'G9' => 'Víctima(s)',
    'H9' => 'Sexo',
    'I9' => 'Edad',
    'J9' => 'Nacionalidad',
    'K9' => 'Estado',
    'L9' => 'Municipio',
    'M9' => 'Número de Órdenes de Protección',
    'N9' => 'Medidas de Protección Solicitadas',
    'C5' => 'Periodo Correspondiente: ' . $fechaConsulta,
    'C6' => 'Consultado: ' . $fechaReporte,
    'O9' => 'Artículo 137 CNPP.',
    'Y9' => 'Temporalidad',
    'Z9' => 'Fecha del acuerdo',
    'AA9' => 'Inicio',
    'AB9' => 'Fin',
    'AC9' => 'Ampliación',
    'AE9' => 'Temporalidad',
    'AF9' => 'Coorporación Policial',
    'O10' => 'I',
    'P10' => 'II',
    'Q10' => 'III',
    'R10' => 'IV',
    'S10' => 'V',
    'T10' => 'VI',
    'U10' => 'VII',
    'V10' => 'VIII',
    'W10' => 'IX',
    'X10' => 'X',
    'AC10' => 'Sí',
    'AD10' => 'No'    
];

//------------------------STYLES---------------------
$styleEncabezado = [
    'font' =>[
        'bold' => true,
        'size' => 14,
        'color' =>[
            'argb' => 'FFFFFF'
        ]
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => '152f4a',
        ],
    ],
    'borders' => [
        'inside' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => 'FFFFFF'],
        ],
    ],
];

$styleFormato = [
    'font' => [
        'bold' => true,
        'size' => 16,
        'color' => [
            'argb' => '000000'
        ]
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'FFFFFF'
        ]
    ],
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '152f4a']            
        ]
    ]
];

$styleContent = [
    'font' => [
        'size' => 12
    ],
    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        // 'wrapText' => true
    ]
];

$mergeCells = [
    'A9:A10', 'B9:B10', 'C9:C10', 'D9:D10', 'E9:E10', 'F9:F10', 'G9:G10', 'H9:H10', 
    'I9:I10', 'J9:J10', 'K9:K10', 'L9:L10', 'M9:M10', 'N9:N10', 'O9:X9', 'Y9:Y10', 'Z9:Z10',
    'AA9:AA10', 'AB9:AB10', 'AC9:AD9', 'A1:B7', 'Z1:AF7', 'AE9:AE10', 'AF9:AF10'
];

$cellFracciones = ['D', 'H', 'I', 'J', 'K', 'L', 'M', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'AC', 'AD', 'AE', 'AF'];

$cellWidth = [
    'A' => 48,
    'B' => 250,
    'C' => 120,
    'D' => 120,
    'E' => 350,
    'F' => 350,
    'G' => 410,
    'H' => 82,
    'I' => 68,
    'J' => 112,
    'K' => 158,
    'L' => 138,
    'M' => 74,
    'N' => 600,
    'O' => 31,
    'P' => 31,
    'Q' => 31,
    'R' => 31,
    'S' => 31,
    'T' => 31,
    'U' => 31,
    'V' => 31,
    'W' => 31,
    'X' => 31,
    'Y' => 154,
    'Z' => 154,
    'AA' => 154,
    'AB' => 154,
    'AC' => 45,
    'AD' => 45,
    'AE' => 154,
    'AF' => 180
];

foreach ($cellWidth as $cell => $width) {
    $sheet->getColumnDimension($cell)->setWidth($width * 0.15);
}

foreach ($celdas as $celda => $valor) {
    $sheet->setCellValue($celda, $valor);        
    //$columna = preg_replace('/[0-9]+/', '', $celda);
    //$sheet->getColumnDimension($columna)->setAutoSize(true);
}
$total = count($arreglo) + 10;

$sheet->getStyle('A9:AF10')->applyFromArray($styleEncabezado);
$sheet->getStyle('A1:AF8')->applyFromArray($styleFormato);
$sheet->getStyle('A11:AF' . $total)->applyFromArray($styleContent);
$sheet->getStyle('A9:AF' . $total)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// $sheet->getStyle('A8')->getFont()->setBold(true)->setSize(24);
// $sheet->getStyle('A8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

for($i = 11; $i <= $total; $i++){
    if($i % 2 == 0){
        $sheet->getStyle('A'.$i.':'.'AF'.$i)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('c5d9f1');
    }
}

foreach ($mergeCells as $range) {
    $sheet->mergeCells($range);
}

for ($i = 0; $i <= $total; $i++) {
    foreach ($cellFracciones as $cell) {
        $sheet->getStyle($cell . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }
}

//------------------------------------------WRITE EXCEL----------------------------------
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="GeneratedFile.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
ob_start();
$writer->save('php://output');
$xlsData = ob_get_contents();
ob_end_clean();

$response =  array(
        'op' => 'ok',
        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
    );

file_put_contents("GeneratedFile.xlsx", $xlsData);

die(json_encode($response));
?>