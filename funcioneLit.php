<?

function existeJudicializadaFromNuc($conn, $nuc)
{

	$query = "  SELECT top 1 idEstatusNucs, nuc, mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreCompleto, u.nUnidad as unidad, f.nFiscalia as fiscalia
	FROM estatusNucs 
	INNER JOIN mp ON mp.idMp = estatusNucs.idMp
	INNER JOIN catUnidad u ON u.idUnidad = estatusNucs.idUnidad
	INNER JOIN CatFiscalia f ON f.idFiscalia = u.idFiscalia
	WHERE nuc = '$nuc' AND idEstatus IN(1,2)";

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['idEstatusNucs'];
		$arreglo[$indice][1] = $row['nuc'];
		$arreglo[$indice][2] = $row['nombreCompleto'];
		$arreglo[$indice][3] = $row['unidad'];
		$arreglo[$indice][4] = $row['fiscalia'];

		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getDataDelMp($conn, $idMp)
{

	$query = "Select nombre+' '+paterno+' '+materno AS ministerioPublico FROM mp WHERE idMp = $idMp";
	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['ministerioPublico'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getDatosLitigacionMpUnidad2($conn, $mes, $anio, $idUnidad, $idMp)
{


	if ($idMp == 0) {
		$query = "  SELECT sum([existenciaAnterior]) as 'existenciaAnterior', sum([carpetasJudicializadas]) as 'carpetasJudicializadas', sum([judicializadasConDetenido]) as 'judicializadasConDetenido', sum([judicializadasSinDetenido]) as 'judicializadasSinDetenido', sum([autoDeVinculacion]) as 'autoDeVinculacion', sum([autoDeNoVinculacion]) as 'autoDeNoVinculacion', sum([Mixtos]) as 'Mixtos', sum([imposicionMedidasCautelares]) as 'imposicionMedidasCautelares',
  sum([prisionPreventivaOficiosa]) as 'prisionPreventivaOficiosa', sum([prisionPreventivaJustificada]) as 'prisionPreventivaJustificada', sum([presentacionPeriodicaAnteElJuez]) as 'presentacionPeriodicaAnteElJuez', sum([exhibicionGarantiaEconomica]) as 'exhibicionGarantiaEconomica', sum([embargoDeBienes]) as 'embargoDeBienes', sum([inmovilizacionDeCuentasValores]) as 'inmovilizacionDeCuentasValores',
  sum([prohibicionSalirSinAutorizacionDelJuez]) as 'prohibicionSalirSinAutorizacionDelJuez', sum([sometimientoCuidadoVigilanciaInstitucion]) as 'sometimientoCuidadoVigilanciaInstitucion', sum([prohibicionConcurrirDeterminadasReunionesLugares]) as 'prohibicionConcurrirDeterminadasReunionesLugares', sum([prohibicionConvivirComunicarseDeterminadasPersonas]) as 'prohibicionConvivirComunicarseDeterminadasPersonas',
  sum([separacionInmediataDelDomicilio]) as 'separacionInmediataDelDomicilio', sum([suspensionTemporalEjercicioDelCargo]) as 'suspensionTemporalEjercicioDelCargo', sum([suspensionTemporalActividadProfesionalLaboral]) as 'suspensionTemporalActividadProfesionalLaboral', sum([colocacionLocalizadoresElectronicos]) as 'colocacionLocalizadoresElectronicos', sum([resguardoPropioDomicilioModalidades]) as 'resguardoPropioDomicilioModalidades',
  sum([sobreseimientosDecretados]) as 'sobreseimientosDecretados', sum([sobreseimientosPrescripcionAccionPenal]) as 'sobreseimientosPrescripcionAccionPenal', sum([sobreseimientosMecanismosAlternativos]) as 'sobreseimientosMecanismosAlternativos', sum([sobreseimientosAcuerdoReparatorio]) as 'sobreseimientosAcuerdoReparatorio', sum([sobreseimientosSuspensionCondicionalProceso]) as 'sobreseimientosSuspensionCondicionalProceso',
  sum([sobreseimientosCriterioOportunidad]) as 'sobreseimientosCriterioOportunidad', sum([terminacionAnticipada]) as 'terminacionAnticipada', sum([procedimientosAbreviados]) as 'procedimientosAbreviados', sum([acumulacion]) as 'acumulacion', sum([citaciones]) as 'citaciones', sum([cateosSolilcitados]) as 'cateosSolilcitados', sum([cateosConcedidos]) as 'cateosConcedidos', sum([cateosNegados]) as 'cateosNegados', sum([ordenesNegadas]) as 'ordenesNegadas',
  sum([ordenesNegadasAprehension]) as 'ordenesNegadasAprehension', sum([ordenesNegadasComparecencia]) as 'ordenesNegadasComparecencia', sum([desistimientoDelRecurso]) as 'desistimientoDelRecurso', sum([desistimientoDelRecursoParterAcusado]) as 'desistimientoDelRecursoParterAcusado',sum([desistimientoDelRecursoParteDefensor]) as 'desistimientoDelRecursoParteDefensor', sum([desistimientoDelRecursoMP]) as 'desistimientoDelRecursoMP',
  sum([apelacionesNoAdmitidas]) as 'apelacionesNoAdmitidas', sum([sentenciasDictadas]) as 'sentenciasDictadas', sum([sentenciasDictadasRevoca]) as 'sentenciasDictadasRevoca', sum([sentenciasDictadasModifica]) as 'sentenciasDictadasModifica', sum([sentenciasDictadasConfirma]) as 'sentenciasDictadasConfirma', sum([reposicionProcedimiento]) as 'reposicionProcedimiento', sum([totalJudicializadasTramite]) as 'totalJudicializadasTramite',
  sum([mandamientosJudicialesGirados]) as 'mandamientosJudicialesGirados', sum([MandamientosJudicialesGiradosOrdenesAprehension]) as 'MandamientosJudicialesGiradosOrdenesAprehension', sum([MandamientosJudicialesGiradosOrdenesComparecencia]) as 'MandamientosJudicialesGiradosOrdenesComparecencia',sum([mandamientosJudicialesCumplidos]) as 'mandamientosJudicialesCumplidos',
  sum([MandamientosJudicialesCumplidosOrdenesAprehension]) as 'MandamientosJudicialesCumplidosOrdenesAprehension', sum([MandamientosJudicialesCumplidosOrdenesComparecencia]) as 'MandamientosJudicialesCumplidosOrdenesComparecencia', sum([totalAudiencias]) as 'totalAudiencias', sum([acusacionesPresentadas]) as 'acusacionesPresentadas', sum([audienciaIntermediaEscrita]) as 'audienciaIntermediaEscrita', sum([audienciaIntermediaOral]) as 'audienciaIntermediaOral',
  sum([solucionesAlternas]) as 'solucionesAlternas', sum([solucionesAlternasSuspensionCondicionalProceso]) as 'solucionesAlternasSuspensionCondicionalProceso', sum([solucionesAlternasAcuerdoReparatorio]) as 'solucionesAlternasAcuerdoReparatorio', sum([sentencias]) as 'sentencias', sum([sentenciasCondenatorias]) as 'sentenciasCondenatorias', sum([sentenciasAbsolutorias]) as 'sentenciasAbsolutorias', sum([sentenciasMixtas]) as 'sentenciasMixtas',
  sum([sentenciasCondenaReparacionDanos]) as 'sentenciasCondenaReparacionDanos', sum([sentenciasNoCondenaReparacionDanos]) as 'sentenciasNoCondenaReparacionDanos', sum([incompetencias]) as 'incompetencias', sum([incompetenciasDecretadas]) as 'incompetenciasDecretadas', sum([incompetenciasAdmitidas]) as 'incompetenciasAdmitidas', sum([apelacionesContraResolucionJuezControl]) as 'apelacionesContraResolucionJuezControl',
  sum([apelacionesNegarAnticipoPrueba]) as 'apelacionesNegarAnticipoPrueba', sum([apelacionesNegarAcuerdoReparatorio]) as 'apelacionesNegarAcuerdoReparatorio', sum([apelacionesNegarCancelarOrdenAprehension]) as 'apelacionesNegarCancelarOrdenAprehension', sum([apelacionesNegarOrdenCateo]) as 'apelacionesNegarOrdenCateo', sum([apelacionesProvidenciasPrecautoriasMedidaCautelar]) as 'apelacionesProvidenciasPrecautoriasMedidaCautelar',
  sum([apelacionesQuePonganTerminoAlProcedimiento]) as 'apelacionesQuePonganTerminoAlProcedimiento', sum([apelacionesAutoQueResuelveVinculacionAProceso]) as 'apelacionesAutoQueResuelveVinculacionAProceso', sum([apelacionesQueConcedanRevoquenNieguenSuspension]) as 'apelacionesQueConcedanRevoquenNieguenSuspension', sum([apelacionesNegativaAbrirProcedimientoAbreviado]) as 'apelacionesNegativaAbrirProcedimientoAbreviado',
  sum([apelacionesSetenciaDefinitivaProcedimientoAbreviado]) as 'apelacionesSetenciaDefinitivaProcedimientoAbreviado', sum([apelacionesExcluirMedioPrueba]) as 'apelacionesExcluirMedioPrueba', sum([apelacionesContraResolucionesTribunalEnjuiciamiento]) as 'apelacionesContraResolucionesTribunalEnjuiciamiento', sum([apelacionesDesistimientoAccionPenal]) as 'apelacionesDesistimientoAccionPenal', sum([apelacionesSentenciaDefinitiva]) as 'apelacionesSentenciaDefinitiva',
  sum([deLasSentenciasDictadas]) as 'deLasSentenciasDictadas', sum([revocacionesFavorablesAlMP]) as 'revocacionesFavorablesAlMP', sum([modificacionesFavorablesAlMP]) as 'modificacionesFavorablesAlMP', sum([confirmacionesFavorablesAlMP]) as 'confirmacionesFavorablesAlMP', sum([porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria]) as 'porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria', sum([FormulaImputacion_Soli]) as 'FormulaImputacion_Soli',
  sum([FormulaImputacion_Otorga]) as 'FormulaImputacion_Otorga', sum([FormulaImputacion_Negadas]) as 'FormulaImputacion_Negadas', sum([LegalDetencion]) as 'LegalDetencion', sum([IlegalDetencion]) as 'IlegalDetencion', sum([Med_CautelresSolicitadas]) as 'Med_CautelresSolicitadas',sum([Med_CautelaresNegadas]) as 'Med_CautelaresNegadas', sum([Med_CautelaresOtorgadas]) as 'Med_CautelaresOtorgadas', sum([recibiOtmp]) as 'recibiOtmp', 
  sum([cesefunciones]) as 'cesefunciones', sum([recibiOtmp]) as 'recibiOtmp' , sum([ordenesSolicitadas]) as 'ordenesSolicitadas', sum([ordenesSolicitadasAprehension]) as 'ordenesSolicitadasAprehension', 
  sum([ordenesSolicitadasComparecencia]) as 'ordenesSolicitadasComparecencia', sum([medidasProteccion]) as 'medidasProteccion', sum([totalVictProt]) as 'totalVictProt', sum([actosInvestigacionControlJudicial]) as 'actosInvestigacionControlJudicial', 
  sum([controlJudicialIntervencionTR]) as 'controlJudicialIntervencionTR', sum([controlJudicialTomaMuestras]) as 'controlJudicialTomaMuestras' , sum([controlJudicialExhumacion]) as 'controlJudicialExhumacion', 
  sum([controlJudicialObDatosReservados]) as 'controlJudicialObDatosReservados', sum([controlJudicialIntervencionCME]) as 'controlJudicialIntervencionCME', sum([controlJudicialProvPrecautoria]) as 'controlJudicialProvPrecautoria', 
  sum([actosInvestigacionSinControlJudicial]) as 'actosInvestigacionSinControlJudicial', sum([sinControlJudicialCadCustodia]) as 'sinControlJudicialCadCustodia', sum([sinControlJudicialInspLugDis]) as 'sinControlJudicialInspLugDis', sum([sinControlJudicialInspInmuebles]) as 'sinControlJudicialInspInmuebles', sum([sinControlJudicialEntrevistasTestigos]) as 'sinControlJudicialEntrevistasTestigos', 
  sum([sinControlJudicialReconocimientoPer]) as 'sinControlJudicialReconocimientoPer', sum([sinControlJudicialSolInfoPericiales]) as 'sinControlJudicialSolInfoPericiales', sum([sinControlJudicialInfInstiSeg]) as 'sinControlJudicialInfInstiSeg', sum([sinControlJudicialexamenFisPersona]) as 'sinControlJudicialexamenFisPersona', sum([resolucionesJuicioOral]) as 'resolucionesJuicioOral', 
  sum([audienciaJuicioOral]) as 'audienciaJuicioOral', sum([audienciaFallo]) as 'audienciaFallo', sum([absolutorio]) as 'absolutorio', sum([audienciaIndiviSancion]) as 'audienciaIndiviSancion', 
  sum([procedimientoEspecial]) as 'procedimientoEspecial', sum([audienciaCondenatorio]) as 'audienciaCondenatorio', sum([mecanismosAceleracion]) as 'mecanismosAceleracion', 
  sum([apelacionesAmparo]) as 'apelacionesAmparo', sum([amparos]) as 'amparos', sum([amparoDirecto]) as 'amparoDirecto', sum([amparoIndirecto]) as 'amparoIndirecto',
  sum([SDuno]) as 'SDuno',
  sum([SDdos]) as 'SDdos',
  sum([SDtres]) as 'SDtres',
  sum([SDcuatro]) as 'SDcuatro',
  sum([SDcinco]) as 'SDcinco',
  sum([SDseis]) as 'SDseis',
  sum([SDsiete]) as 'SDsiete',
  sum([SDocho]) as 'SDocho',
  sum([SDnueve]) as 'SDnueve',
  sum([SDdiez]) as 'SDdiez',
  sum([totCarpTram_nucs]) as 'totCarpTram_nucs',
  sum([SobreseimientosMuerteImputado]) as 'SobreseimientosMuerteImputado',
  sum([audienciaIncial]) as 'audienciaIncial',
  sum([pruebaAnticipada]) as 'pruebaAnticipada',
  sum([escritoAcusacion]) as 'escritoAcusacion',
  sum([actosInvComplementaria]) as 'actosInvComplementaria',
  sum([audienciaEjecuSanciones]) as 'audienciaEjecuSanciones',
  sum([apelRevModAbsolutoria]) as 'apelRevModAbsolutoria',
  sum([TIEotorgaIntervensionComuni]) as 'TIEotorgaIntervensionComuni',
  sum([TIEotorgaDatosConservados]) as 'TIEotorgaDatosConservados',
  sum([TIEotorgaDatosBancarios]) as 'TIEotorgaDatosBancarios',
  sum([TIEnegativaIntervencionComuni]) as 'TIEnegativaIntervencionComuni',
  sum([TIEnegativaDatosConservados]) as 'TIEnegativaDatosConservados',
  sum([TIEnegativaDatosBancarios]) as 'TIEnegativaDatosBancarios',
  sum([TIEotorgadas]) as 'TIEotorgadas',
  sum([TIEnegadas]) as 'TIEnegadas',
  sum([tramite_total]) as 'tramite_total'
   FROM Litigacion WHERE idMes = $mes AND idAnio = $anio AND idUnidad = $idUnidad";
	} else {

		$query = "SELECT [existenciaAnterior]
		,[carpetasJudicializadas]
		,[judicializadasConDetenido]
		,[judicializadasSinDetenido]
		,[autoDeVinculacion]
		,[autoDeNoVinculacion]
		,[Mixtos]
		,[imposicionMedidasCautelares]
		,[prisionPreventivaOficiosa]
		,[prisionPreventivaJustificada]
		,[presentacionPeriodicaAnteElJuez]
		,[exhibicionGarantiaEconomica]
		,[embargoDeBienes]
		,[inmovilizacionDeCuentasValores]
		,[prohibicionSalirSinAutorizacionDelJuez]
		,[sometimientoCuidadoVigilanciaInstitucion]
		,[prohibicionConcurrirDeterminadasReunionesLugares]
		,[prohibicionConvivirComunicarseDeterminadasPersonas]
		,[separacionInmediataDelDomicilio]
		,[suspensionTemporalEjercicioDelCargo]
		,[suspensionTemporalActividadProfesionalLaboral]
		,[colocacionLocalizadoresElectronicos]
		,[resguardoPropioDomicilioModalidades]
		,[sobreseimientosDecretados]
		,[sobreseimientosPrescripcionAccionPenal]
		,[SobreseimientosMuerteImputado]
		,[sobreseimientosMecanismosAlternativos]
		,[sobreseimientosAcuerdoReparatorio]
		,[sobreseimientosSuspensionCondicionalProceso]
		,[sobreseimientosCriterioOportunidad]
		,[terminacionAnticipada]
		,[procedimientosAbreviados]
		,[acumulacion]
		,[citaciones]
		,[cateosSolilcitados]
		,[cateosConcedidos]
		,[cateosNegados]
		,[ordenesNegadas]
		,[ordenesNegadasAprehension]
		,[ordenesNegadasComparecencia]
		,[desistimientoDelRecurso]
		,[desistimientoDelRecursoParterAcusado]
		,[desistimientoDelRecursoParteDefensor]
		,[desistimientoDelRecursoMP]
		,[apelacionesNoAdmitidas]
		,[sentenciasDictadas]
		,[sentenciasDictadasRevoca]
		,[sentenciasDictadasModifica]
		,[sentenciasDictadasConfirma]
		,[reposicionProcedimiento]
		,[totalJudicializadasTramite]
		,[mandamientosJudicialesGirados]
		,[MandamientosJudicialesGiradosOrdenesAprehension]
		,[MandamientosJudicialesGiradosOrdenesComparecencia]
		,[mandamientosJudicialesCumplidos]
		,[MandamientosJudicialesCumplidosOrdenesAprehension]
		,[MandamientosJudicialesCumplidosOrdenesComparecencia]
		,[totalAudiencias]
		,[acusacionesPresentadas]
		,[audienciaIntermediaEscrita]
		,[audienciaIntermediaOral]
		,[solucionesAlternas]
		,[solucionesAlternasSuspensionCondicionalProceso]
		,[solucionesAlternasAcuerdoReparatorio]
		,[sentencias]
		,[sentenciasCondenatorias]
		,[sentenciasAbsolutorias]
		,[sentenciasMixtas]
		,[sentenciasCondenaReparacionDanos]
		,[sentenciasNoCondenaReparacionDanos]
		,[incompetencias]
		,[incompetenciasDecretadas]
		,[incompetenciasAdmitidas]
		,[apelacionesContraResolucionJuezControl]
		,[apelacionesNegarAnticipoPrueba]
		,[apelacionesNegarAcuerdoReparatorio]
		,[apelacionesNegarCancelarOrdenAprehension]
		,[apelacionesNegarOrdenCateo]
		,[apelacionesProvidenciasPrecautoriasMedidaCautelar]
		,[apelacionesQuePonganTerminoAlProcedimiento]
		,[apelacionesAutoQueResuelveVinculacionAProceso]
		,[apelacionesQueConcedanRevoquenNieguenSuspension]
		,[apelacionesNegativaAbrirProcedimientoAbreviado]
		,[apelacionesSetenciaDefinitivaProcedimientoAbreviado]
		,[apelacionesExcluirMedioPrueba]
		,[apelacionesContraResolucionesTribunalEnjuiciamiento]
		,[apelacionesDesistimientoAccionPenal]
		,[apelacionesSentenciaDefinitiva]
		,[deLasSentenciasDictadas]
		,[revocacionesFavorablesAlMP]
		,[modificacionesFavorablesAlMP]
		,[confirmacionesFavorablesAlMP]
		,[porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria]
		,[FormulaImputacion_Soli]
		,[FormulaImputacion_Otorga]
		,[FormulaImputacion_Negadas]
		,[LegalDetencion]
		,[IlegalDetencion]
		,[Med_CautelresSolicitadas]
		,[Med_CautelaresNegadas]
		,[Med_CautelaresOtorgadas]
		,[idMp]
		,[cambio]
		,[recibiOtmp]
		,[cesefunciones]
		,[ordenesSolicitadas]
		,[ordenesSolicitadasAprehension]
		,[ordenesSolicitadasComparecencia]
		,[medidasProteccion]
		,[totalVictProt]
		,[actosInvestigacionControlJudicial]
		,[controlJudicialIntervencionTR]
		,[controlJudicialTomaMuestras]
		,[controlJudicialExhumacion]
		,[controlJudicialObDatosReservados]
		,[controlJudicialIntervencionCME]
		,[controlJudicialProvPrecautoria]
		,[actosInvestigacionSinControlJudicial]
		,[sinControlJudicialCadCustodia]
		,[sinControlJudicialInspLugDis]
		,[sinControlJudicialInspInmuebles]
		,[sinControlJudicialEntrevistasTestigos]
		,[sinControlJudicialReconocimientoPer]
		,[sinControlJudicialSolInfoPericiales]
		,[sinControlJudicialInfInstiSeg]
		,[sinControlJudicialexamenFisPersona]
		,[resolucionesJuicioOral]
		,[audienciaJuicioOral]
		,[audienciaFallo]
		,[absolutorio]
		,[audienciaIndiviSancion]
		,[procedimientoEspecial]
		,[audienciaCondenatorio]
		,[mecanismosAceleracion]
		,[apelacionesAmparo]
		,[amparos]
		,[amparoDirecto]
		,[amparoIndirecto]
		,[SDuno]
      ,[SDdos]
      ,[SDtres]
      ,[SDcuatro]
      ,[SDcinco]
      ,[SDseis]
      ,[SDsiete]
      ,[SDocho]
      ,[SDnueve]
      ,[SDdiez]
      ,[totCarpTram_nucs]
,[audienciaIncial]
,[pruebaAnticipada]
,[escritoAcusacion]
,[actosInvComplementaria]
,[audienciaEjecuSanciones]
,[apelRevModAbsolutoria]
,[TIEotorgaIntervensionComuni]
,[TIEotorgaDatosConservados]
,[TIEotorgaDatosBancarios]
,[TIEnegativaIntervencionComuni]
,[TIEnegativaDatosConservados]
,[TIEnegativaDatosBancarios]
,[TIEotorgadas]
,[TIEnegadas]
,[tramite_total]
FROM [ESTADISTICAV2].[dbo].[Litigacion] WHERE idMes = $mes AND idAnio = $anio AND idUnidad = $idUnidad AND idMp = $idMp";
	}


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['existenciaAnterior'];

		$arreglo[$indice][1] = $row['carpetasJudicializadas'];
		$arreglo[$indice][2] = $row['judicializadasConDetenido'];
		$arreglo[$indice][3] = $row['judicializadasSinDetenido'];

		$arreglo[$indice][4] = $row['autoDeVinculacion'];
		$arreglo[$indice][5] = $row['autoDeNoVinculacion'];
		$arreglo[$indice][6] = $row['Mixtos'];

		$arreglo[$indice][7] = $row['imposicionMedidasCautelares'];
		$arreglo[$indice][8] = $row['prisionPreventivaOficiosa'];
		$arreglo[$indice][9] = $row['prisionPreventivaJustificada'];
		$arreglo[$indice][10] = $row['presentacionPeriodicaAnteElJuez'];
		$arreglo[$indice][11] = $row['exhibicionGarantiaEconomica'];
		$arreglo[$indice][12] = $row['embargoDeBienes'];
		$arreglo[$indice][13] = $row['inmovilizacionDeCuentasValores'];
		$arreglo[$indice][14] = $row['prohibicionSalirSinAutorizacionDelJuez'];
		$arreglo[$indice][15] = $row['sometimientoCuidadoVigilanciaInstitucion'];
		$arreglo[$indice][16] = $row['prohibicionConcurrirDeterminadasReunionesLugares'];
		$arreglo[$indice][17] = $row['prohibicionConvivirComunicarseDeterminadasPersonas'];
		$arreglo[$indice][18] = $row['separacionInmediataDelDomicilio'];
		$arreglo[$indice][19] = $row['suspensionTemporalEjercicioDelCargo'];
		$arreglo[$indice][20] = $row['suspensionTemporalActividadProfesionalLaboral'];
		$arreglo[$indice][21] = $row['colocacionLocalizadoresElectronicos'];
		$arreglo[$indice][22] = $row['resguardoPropioDomicilioModalidades'];

		$arreglo[$indice][23] = $row['sobreseimientosDecretados'];
		$arreglo[$indice][24] = $row['sobreseimientosPrescripcionAccionPenal'];
		$arreglo[$indice][25] = $row['sobreseimientosMecanismosAlternativos'];
		$arreglo[$indice][26] = $row['sobreseimientosAcuerdoReparatorio'];
		$arreglo[$indice][27] = $row['sobreseimientosSuspensionCondicionalProceso'];
		$arreglo[$indice][28] = $row['sobreseimientosCriterioOportunidad'];
		$arreglo[$indice][29] = $row['terminacionAnticipada'];
		$arreglo[$indice][30] = $row['procedimientosAbreviados'];
		$arreglo[$indice][31] = $row['acumulacion'];
		$arreglo[$indice][32] = $row['citaciones'];

		$arreglo[$indice][33] = $row['cateosSolilcitados'];
		$arreglo[$indice][34] = $row['cateosConcedidos'];
		$arreglo[$indice][35] = $row['cateosNegados'];

		$arreglo[$indice][36] = $row['ordenesNegadas'];
		$arreglo[$indice][37] = $row['ordenesNegadasAprehension'];
		$arreglo[$indice][38] = $row['ordenesNegadasComparecencia'];

		$arreglo[$indice][39] = $row['desistimientoDelRecurso'];
		$arreglo[$indice][40] = $row['desistimientoDelRecursoParterAcusado'];
		$arreglo[$indice][41] = $row['desistimientoDelRecursoParteDefensor'];
		$arreglo[$indice][42] = $row['desistimientoDelRecursoMP'];

		$arreglo[$indice][43] = $row['apelacionesNoAdmitidas'];

		$arreglo[$indice][44] = $row['sentenciasDictadas'];
		$arreglo[$indice][45] = $row['sentenciasDictadasRevoca'];
		$arreglo[$indice][46] = $row['sentenciasDictadasModifica'];
		$arreglo[$indice][47] = $row['sentenciasDictadasConfirma'];

		$arreglo[$indice][48] = $row['reposicionProcedimiento'];

		$arreglo[$indice][49] = $row['totalJudicializadasTramite'];


		$arreglo[$indice][50] = $row['mandamientosJudicialesGirados'];
		$arreglo[$indice][51] = $row['MandamientosJudicialesGiradosOrdenesAprehension'];
		$arreglo[$indice][52] = $row['MandamientosJudicialesGiradosOrdenesComparecencia'];

		$arreglo[$indice][53] = $row['mandamientosJudicialesCumplidos'];
		$arreglo[$indice][54] = $row['MandamientosJudicialesCumplidosOrdenesAprehension'];
		$arreglo[$indice][55] = $row['MandamientosJudicialesCumplidosOrdenesComparecencia'];

		$arreglo[$indice][56] = $row['totalAudiencias'];

		$arreglo[$indice][99] = $row['acusacionesPresentadas'];
		$arreglo[$indice][57] = $row['audienciaIntermediaEscrita'];
		$arreglo[$indice][58] = $row['audienciaIntermediaOral'];

		$arreglo[$indice][59] = $row['solucionesAlternas'];
		$arreglo[$indice][60] = $row['solucionesAlternasSuspensionCondicionalProceso'];
		$arreglo[$indice][61] = $row['solucionesAlternasAcuerdoReparatorio'];

		$arreglo[$indice][62] = $row['sentencias'];
		$arreglo[$indice][63] = $row['sentenciasCondenatorias'];
		$arreglo[$indice][64] = $row['sentenciasAbsolutorias'];
		$arreglo[$indice][65] = $row['sentenciasMixtas'];
		$arreglo[$indice][66] = $row['sentenciasCondenaReparacionDanos'];
		$arreglo[$indice][67] = $row['sentenciasNoCondenaReparacionDanos'];

		$arreglo[$indice][68] = $row['incompetencias'];
		$arreglo[$indice][69] = $row['incompetenciasDecretadas'];
		$arreglo[$indice][70] = $row['incompetenciasAdmitidas'];

		$arreglo[$indice][71] = $row['apelacionesContraResolucionJuezControl'];
		$arreglo[$indice][72] = $row['apelacionesNegarAnticipoPrueba'];
		$arreglo[$indice][73] = $row['apelacionesNegarAcuerdoReparatorio'];
		$arreglo[$indice][74] = $row['apelacionesNegarCancelarOrdenAprehension'];
		$arreglo[$indice][75] = $row['apelacionesNegarOrdenCateo'];
		$arreglo[$indice][76] = $row['apelacionesProvidenciasPrecautoriasMedidaCautelar'];
		$arreglo[$indice][77] = $row['apelacionesQuePonganTerminoAlProcedimiento'];
		$arreglo[$indice][78] = $row['apelacionesAutoQueResuelveVinculacionAProceso'];
		$arreglo[$indice][79] = $row['apelacionesQueConcedanRevoquenNieguenSuspension'];
		$arreglo[$indice][80] = $row['apelacionesNegativaAbrirProcedimientoAbreviado'];
		$arreglo[$indice][81] = $row['apelacionesSetenciaDefinitivaProcedimientoAbreviado'];
		$arreglo[$indice][82] = $row['apelacionesExcluirMedioPrueba'];

		$arreglo[$indice][83] = $row['apelacionesContraResolucionesTribunalEnjuiciamiento'];
		$arreglo[$indice][84] = $row['apelacionesDesistimientoAccionPenal'];
		$arreglo[$indice][85] = $row['apelacionesSentenciaDefinitiva'];

		$arreglo[$indice][86] = $row['deLasSentenciasDictadas'];
		$arreglo[$indice][87] = $row['revocacionesFavorablesAlMP'];
		$arreglo[$indice][88] = $row['modificacionesFavorablesAlMP'];
		$arreglo[$indice][89] = $row['confirmacionesFavorablesAlMP'];

		$arreglo[$indice][90] = $row['porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria'];

		$arreglo[$indice][91] = $row['FormulaImputacion_Soli'];
		$arreglo[$indice][92] = $row['FormulaImputacion_Otorga'];
		$arreglo[$indice][93] = $row['FormulaImputacion_Negadas'];

		$arreglo[$indice][94] = $row['LegalDetencion'];
		$arreglo[$indice][95] = $row['IlegalDetencion'];

		$arreglo[$indice][96] = $row['Med_CautelresSolicitadas'];
		$arreglo[$indice][97] = $row['Med_CautelaresNegadas'];
		$arreglo[$indice][98] = $row['Med_CautelaresOtorgadas'];
		$arreglo[$indice][100] = $row['recibiOtmp'];
		$arreglo[$indice][101] = $row['cesefunciones'];

		$arreglo[$indice][105] = $row['recibiOtmp'];
		$arreglo[$indice][106] = $row['cesefunciones'];

		$arreglo[$indice][107] = $row['ordenesSolicitadas'];
		$arreglo[$indice][108] = $row['ordenesSolicitadasAprehension'];
		$arreglo[$indice][109] = $row['ordenesSolicitadasComparecencia'];
		$arreglo[$indice][110] = $row['medidasProteccion'];
		$arreglo[$indice][111] = $row['totalVictProt'];
		$arreglo[$indice][112] = $row['actosInvestigacionControlJudicial'];
		$arreglo[$indice][113] = $row['controlJudicialIntervencionTR'];
		$arreglo[$indice][114] = $row['controlJudicialTomaMuestras'];
		$arreglo[$indice][115] = $row['controlJudicialExhumacion'];
		$arreglo[$indice][116] = $row['controlJudicialObDatosReservados'];
		$arreglo[$indice][117] = $row['controlJudicialIntervencionCME'];
		$arreglo[$indice][118] = $row['controlJudicialProvPrecautoria'];
		$arreglo[$indice][119] = $row['actosInvestigacionSinControlJudicial'];
		$arreglo[$indice][120] = $row['sinControlJudicialCadCustodia'];
		$arreglo[$indice][121] = $row['sinControlJudicialInspLugDis'];
		$arreglo[$indice][122] = $row['sinControlJudicialInspInmuebles'];
		$arreglo[$indice][123] = $row['sinControlJudicialEntrevistasTestigos'];
		$arreglo[$indice][124] = $row['sinControlJudicialReconocimientoPer'];
		$arreglo[$indice][125] = $row['sinControlJudicialSolInfoPericiales'];
		$arreglo[$indice][126] = $row['sinControlJudicialInfInstiSeg'];
		$arreglo[$indice][127] = $row['sinControlJudicialexamenFisPersona'];
		$arreglo[$indice][128] = $row['resolucionesJuicioOral'];
		$arreglo[$indice][129] = $row['audienciaJuicioOral'];
		$arreglo[$indice][130] = $row['audienciaFallo'];
		$arreglo[$indice][131] = $row['absolutorio'];
		$arreglo[$indice][132] = $row['audienciaIndiviSancion'];
		$arreglo[$indice][133] = $row['procedimientoEspecial'];
		$arreglo[$indice][134] = $row['audienciaCondenatorio'];
		$arreglo[$indice][135] = $row['mecanismosAceleracion'];
		$arreglo[$indice][136] = $row['apelacionesAmparo'];
		$arreglo[$indice][137] = $row['amparos'];
		$arreglo[$indice][138] = $row['amparoDirecto'];
		$arreglo[$indice][139] = $row['amparoIndirecto'];

		$arreglo[$indice][140] = $row['SDuno'];
		$arreglo[$indice][141] = $row['SDdos'];
		$arreglo[$indice][142] = $row['SDtres'];
		$arreglo[$indice][143] = $row['SDcuatro'];
		$arreglo[$indice][144] = $row['SDcinco'];
		$arreglo[$indice][145] = $row['SDseis'];
		$arreglo[$indice][146] = $row['SDsiete'];
		$arreglo[$indice][147] = $row['SDocho'];
		$arreglo[$indice][148] = $row['SDnueve'];
		$arreglo[$indice][149] = $row['SDdiez'];
		$arreglo[$indice][150] = $row['totCarpTram_nucs'];
		$arreglo[$indice][151] = $row['SobreseimientosMuerteImputado'];

        $arreglo[$indice][152] = $row['audienciaIncial'];
        $arreglo[$indice][153] = $row['pruebaAnticipada'];
        $arreglo[$indice][154] = $row['escritoAcusacion'];
        $arreglo[$indice][155] = $row['actosInvComplementaria'];
        $arreglo[$indice][156] = $row['audienciaEjecuSanciones'];
        $arreglo[$indice][157] = $row['apelRevModAbsolutoria'];
        $arreglo[$indice][158] = $row['TIEotorgaIntervensionComuni'];
        $arreglo[$indice][159] = $row['TIEotorgaDatosConservados'];
        $arreglo[$indice][160] = $row['TIEotorgaDatosBancarios'];
        $arreglo[$indice][161] = $row['TIEnegativaIntervencionComuni'];
        $arreglo[$indice][162] = $row['TIEnegativaDatosConservados'];
        $arreglo[$indice][163] = $row['TIEnegativaDatosBancarios'];
        $arreglo[$indice][164] = $row['TIEotorgadas'];
        $arreglo[$indice][165] = $row['TIEnegadas'];
        $arreglo[$indice][166] = $row['tramite_total'];


		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getNameFiscaEnlace2($conn, $idEnlace)
{

	$query = "  SELECT f.nFiscalia FROM enlace e INNER JOIN CatFiscalia F ON f.idFiscalia = e.idFiscalia WHERE e.idEnlace = $idEnlace";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

		$arreglo[$indice][0] = $row['nFiscalia'];

		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}
////// OBTIENE DATOS EXTRAS SI SE QUIERE 
function getLastDeterminacionCarpetaLitigacion($conn, $nuc, $estatResolucion)
{

	$query = " SELECT idEstatusNucs, nuc, idUnidad, fecha, idmp FROM estatusNucs 
	WHERE idEstatusNucs IN( SELECT MAX(idEstatusNucs) FROM estatusNucs WHERE nuc = $nuc ) AND idEstatus = $estatResolucion ";


	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['idEstatusNucs'];
		$arreglo[$indice][1] = $row['nuc'];
		$arreglo[$indice][2] = $row['idUnidad'];
		$arreglo[$indice][3] = $row['idmp'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

////// OBTIENE LA ULTIMA DETERMINACION DE UNA CARPETA PARA SABER DONDE FUE DONDE SE DETERMINO POR ULTIMA VEZ

function getLastDeterminacionCarpetaLitig($conn, $nuc)
{

	$query = " SELECT idEstatusNucs, nuc, idUnidad, fecha, idEstatus, idCarpeta FROM estatusNucs 
	WHERE idEstatusNucs IN( SELECT MAX(idEstatusNucs) FROM estatusNucs WHERE nuc = '$nuc' ) ";



	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['idEstatusNucs'];
		$arreglo[$indice][1] = $row['nuc'];
		$arreglo[$indice][2] = $row['idUnidad'];
		$arreglo[$indice][3] = $row['idEstatus'];
		$arreglo[$indice][4] = $row['idCarpeta'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getDistincCarpetasAgenteLitigacion($conn, $idMp, $estatus, $mes, $anio, $idUnidad)
{


	if ($estatus == 60 || $estatus == 61 || $estatus == 63 || $estatus == 139) {

		$query = " SELECT nuc, idEstatusNucs FROM estatusNucs WHERE idMp = $idMp AND idEstatus = $estatus AND mes = $mes AND anio = $anio AND idUnidad = $idUnidad";
	} else {
		if ($estatus == 154 || $estatus == 66 || $estatus == 67) {
			$query = " SELECT nuc, idEstatusNucs FROM estatusNucs WHERE idMp = $idMp AND idEstatus = $estatus AND mes = $mes AND anio = $anio AND idUnidad = $idUnidad  union all
																SELECT no_averiguacion , idEstatusAveriguacion FROM estatusAveriguaciones 
					WHERE idMp = $idMp AND mes = $mes AND anio = $anio AND  idEstatus = $estatus AND idUnidad = $idUnidad  ";
		} 
		else if ($estatus == 181 ) {
			$query = " SELECT nuc, idEstatusNucs FROM estatusNucs WHERE idMp = $idMp AND idEstatus = $estatus  ";
		}else {
			$query = " SELECT DISTINCT nuc, idEstatusNucs FROM estatusNucs WHERE idMp = $idMp AND idEstatus = $estatus AND mes = $mes AND anio = $anio AND idUnidad = $idUnidad Group BY nuc , idEstatusNucs";
		}
	}
	//echo $query."<br>";

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);

	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['nuc'];
		$arreglo[$indice][1] = $row['idEstatusNucs'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}


function get_datos_carpeta_capturadoLiti($conn, $nuc)
{
	$indice = 0;
	$consulta = "SELECT CarpetaID, NUC, Expediente, fechaCaptura, FechaInicio, FechaComision, Contar from Carpeta where NUC=" . $nuc;

	$stmt = sqlsrv_query($conn, $consulta);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

		$arreglo[$indice][0] = $row['CarpetaID'];
		$arreglo[$indice][1] = $row['NUC'];
		$arreglo[$indice][2] = $row['Expediente'];
		$arreglo[$indice][3] = $row['fechaCaptura'];
		$arreglo[$indice][4] = $row['FechaInicio'];
		$arreglo[$indice][5] = $row['FechaComision'];
		$arreglo[$indice][6] = $row['Contar'];

		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}



function get_existeCarpetaNucsLiti($conn, $nuc, $anio, $mes, $idMp, $idUnidad, $idEstatus)
{



	$indice = 0;
	$consulta = "SELECT DISTINCT idCarpeta from estatusNucs where nuc = $nuc AND anio = $anio AND mes = $mes AND idMp = $idMp AND idUnidad = $idUnidad AND idEstatus = $idEstatus";


	$stmt = sqlsrv_query($conn, $consulta);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

		$arreglo[$indice][0] = $row['idCarpeta'];

		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}




function getLastDeterminacionCarpetalit($conn, $idCarp)
{

	$query = " SELECT ResolucionID, CarpetaID, idUnidad, Fechaingreso, EstatusID FROM Resoluciones 
	WHERE ResolucionID IN( SELECT MAX(ResolucionID) FROM Resoluciones WHERE CarpetaID = $idCarp ) ";

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['ResolucionID'];
		$arreglo[$indice][1] = $row['CarpetaID'];
		$arreglo[$indice][2] = $row['idUnidad'];
		$arreglo[$indice][3] = $row['EstatusID'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

/////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////

function getDistincCarpetasAgenteDetemrn20Lit($conn, $idMp, $mes, $anio,  $deten,  $estatus, $idUnidad)
{

	if ($estatus == 64 || $estatus == 155 || $estatus == 156 || $estatus == 157 || $estatus == 158 || $estatus == 159 || $estatus == 160 || $estatus == 161 || $estatus == 162 || $estatus == 163 || $estatus == 164 || $estatus == 60 || $estatus == 61 || $estatus == 63 || $estatus == 114 || $estatus == 115 || $estatus == 116 || $estatus == 117 || $estatus == 119 || $estatus == 120 || $estatus == 121 || $estatus == 122 || $estatus == 123 || $estatus == 124 || $estatus == 125 || $estatus == 126 || $estatus == 127 || $estatus == 128 || $estatus == 140 || $estatus == 3 || $estatus == 4 || $estatus == 5  || $estatus == 6 || $estatus == 7 || $estatus == 151 || $estatus == 10 || $estatus == 12 || $estatus == 98 || $estatus == 97  || $estatus == 96 || $estatus == 17 || $estatus == 18 || $estatus == 95 || $estatus == 20 || $estatus == 21 || $estatus == 22 || $estatus == 23 || $estatus == 24 || $estatus == 25 || $estatus == 26 || $estatus == 27 || $estatus == 28 || $estatus == 29 || $estatus == 30 || $estatus == 31 || $estatus == 33 || $estatus == 34 || $estatus == 35 || $estatus == 36 || $estatus == 38 || $estatus == 112 || $estatus == 113 || $estatus == 3 || $estatus == 50 || $estatus == 53 || $estatus == 57 || $estatus == 58 || $estatus == 129 || $estatus == 139 || $estatus == 65 || $estatus == 166 || $estatus == 167 || $estatus == 168 || $estatus == 170 || $estatus == 170 || $estatus == 171 || $estatus == 172 || $estatus == 173 || $estatus == 175 || $estatus == 176 || $estatus == 178 || $estatus == 179 || $estatus == 180 || $estatus == 84) {


		$query = "  SELECT nuc FROM estatusNucs 
			  WHERE idMp = $idMp AND mes = $mes AND anio = $anio AND  idEstatus = $estatus AND idUnidad = $idUnidad";
	} else {

		if ($estatus == 154 || $estatus == 66 || $estatus == 67) {
			$query = "  SELECT nuc FROM estatusNucs 
			  WHERE idMp = $idMp AND mes = $mes AND anio = $anio AND  idEstatus = $estatus AND idUnidad = $idUnidad 
			  union all
																SELECT no_averiguacion FROM estatusAveriguaciones 
					WHERE idMp = $idMp AND mes = $mes AND anio = $anio AND  idEstatus = $estatus AND idUnidad = $idUnidad  ";
		}
		else if ($estatus == 181 ) {
			$query = "  SELECT nuc FROM estatusNucs WHERE idMp = $idMp AND  idEstatus = $estatus AND idUnidad = $idUnidad";
		} else {
			$query = "  SELECT DISTINCT nuc FROM estatusNucs 
			  WHERE idMp = $idMp AND mes = $mes AND anio = $anio AND  idEstatus = $estatus AND idUnidad = $idUnidad  Group BY nuc, idEstatus";
		}
	}
	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['nuc'];
		//$arreglo[$indice][1]=$row['EstatusID'];
		//$arreglo[$indice][2]=$row['deten'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

//////////////////////////// para saber donde se encuentra determninado con el ulitmo estatus del nuc

function getLAstResolucionesFromAdetermLit($conn, $idMp, $estatResolucion, $mes, $anio, $deten, $idUnidad)
{

	include("Conexiones/conexionSicap.php");
	include("Conexiones/Conexion.php");


	$carpeAgente =  getDistincCarpetasAgenteDetemrn20Lit($conn, $idMp, $mes, $anio, 0, $estatResolucion, $idUnidad);

	$numResol = 0;

	for ($i = 0; $i < sizeof($carpeAgente); $i++) {
		$numResol++;
	}

	if ($numResol > 0) {
		return $numResol;
	} else {
		return 0;
	}
}


///////////////////////////////////////////////////////////////


function validarCarpetaCapturadaLiti($conn, $anioCaptura, $mesCapturar, $idMp)
{

	$query = "  SELECT idLitigacion FROM Litigacion WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp";


	//echo $query;
	$stmt = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count = sqlsrv_num_rows($stmt);


	if ($row_count > 0) {
		return 2;
	} else {
		return 1;
	}
}


function validarCarpetaCapturadaLitiUnidad($conn, $anioCaptura, $mesCapturar, $idMp, $idUnidad)
{

	$query = "  SELECT idLitigacion FROM Litigacion WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp AND idUnidad = $idUnidad";
	//echo $query;

	$stmt = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count = sqlsrv_num_rows($stmt);


	if ($row_count > 0) {
		return 2;
	} else {
		return 1;
	}
}


function validarEstatusShowInfo($estatResolucion)
{

	if ($estatResolucion == 1 || $estatResolucion == 2 || $estatResolucion == 3 || $estatResolucion == 4 || $estatResolucion == 19 || $estatResolucion == 17 || $estatResolucion == 18 || $estatResolucion == 20  || $estatResolucion == 21 || $estatResolucion == 22 || $estatResolucion == 23  || $estatResolucion == 24 || $estatResolucion == 25 || $estatResolucion == 26 || $estatResolucion == 27 || $estatResolucion == 28 || $estatResolucion == 29  || $estatResolucion == 30 || $estatResolucion == 31 || $estatResolucion == 95 || $estatResolucion == 61 || $estatResolucion == 63 || $estatResolucion == 99 || $estatResolucion == 89 || $estatResolucion == 101 || $estatResolucion == 103 || $estatResolucion == 105 || $estatResolucion == 106 || $estatResolucion == 89 || $estatResolucion == 107 || $estatResolucion == 108 || $estatResolucion == 109 || $estatResolucion == 110 || $estatResolucion == 111 || $estatResolucion == 64 || $estatResolucion == 60 || $estatResolucion == 14 || $estatResolucion == 65  || $estatResolucion == 68 || $estatResolucion == 90 || $estatResolucion == 91 || $estatResolucion == 129 ||  $estatResolucion == 57 || $estatResolucion == 151 || $estatResolucion == 154 || $estatResolucion == 66 || $estatResolucion == 50 || $estatResolucion == 53 | $estatResolucion == 58 || $estatResolucion == 153 || $estatResolucion == 165 || $estatResolucion == 140 || $estatResolucion == 139 || $estatResolucion == 141 || $estatResolucion == 144 || $estatResolucion == 145 || $estatResolucion == 142) {
		return True;
	} else {
		return False;
	}
}


function getDistincAveriguacionesAgenteLitigacion($conn, $idMp, $estatus, $mes, $anio, $idUnidad)
{


	if ($estatus == 60 || $estatus == 61 || $estatus == 63) {

		$query = " SELECT no_averiguacion, idEstatusAveriguacion FROM estatusAveriguaciones WHERE idMp = $idMp AND idEstatus = $estatus AND mes = $mes AND anio = $anio AND idUnidad = $idUnidad";
	} else {
		$query = " SELECT DISTINCT no_averiguacion, idEstatusAveriguacion FROM estatusAveriguaciones WHERE idMp = $idMp AND idEstatus = $estatus AND mes = $mes AND anio = $anio AND idUnidad = $idUnidad Group BY no_averiguacion , idEstatusAveriguacion";
	}
	//echo $query."<br>";

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);

	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['no_averiguacion'];
		$arreglo[$indice][1] = $row['idEstatusAveriguacion'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}


////// OBTIENE LA ULTIMA DETERMINACION DE UNA CARPETA PARA SABER DONDE FUE DONDE SE DETERMINO POR ULTIMA VEZ

function getCarpetasAgenteLitigacion2($conSic, $idMp, $estatus, $mes, $anio, $idUnidad)
{

	$query = " SELECT nuc, idEstatusNucs FROM estatusNucs WHERE idMp = $idMp AND idEstatus = 165  Group BY nuc , idEstatusNucs";

	$indice = 0;

	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['nuc'];
		$arreglo[$indice][1] = $row['idEstatusNucs'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function valida_imputado_determinacion($conn, $nuc, $imputadoID){
	$query = "SELECT n.idEstatusNucs
																	,e.nombre as estatus
																	,n.nuc
																	,impuDet.idImputadoLitigacion
																	,impu.nombre+' '+impu.paterno+' '+impu.materno as imputado
																	,c.Expediente
																	,mp.nombre+' '+mp.paterno+' '+mp.materno as nombreMP
																	,u.nUnidad AS nombreUnidadLitigacion
																	,f.nFiscalia AS nombreFiscalia
																				,CASE
																				WHEN n.[mes] = 1 THEN 'Enero'
																				WHEN n.[mes] = 2 THEN 'Febrero'
																				WHEN n.[mes] = 3 THEN 'Marzo'
																				WHEN n.[mes] = 4 THEN 'Abril'
																				WHEN n.[mes] = 5 THEN 'Mayo'
																				WHEN n.[mes] = 6 THEN 'Junio'
																				WHEN n.[mes] = 7 THEN 'Julio'
																				WHEN n.[mes] = 8 THEN 'Agosto'
																				WHEN n.[mes] = 9 THEN 'Septiembre'
																				WHEN n.[mes] = 10 THEN 'Octubre'
																				WHEN n.[mes] = 11 THEN 'Noviembre'
																				WHEN n.[mes] = 12 THEN 'Diciembre'
																				ELSE 'Desconocido' 
																				END as nombreMes
																				,n.anio
																	FROM ESTADISTICAV2.dbo.estatusNucs n
																	INNER JOIN dbo.estatus e ON e.idEstatus = n.idEstatus
																	INNER JOIN dbo.mp mp ON mp.idMp = n.idMp
																	INNER JOIN dbo.CatUnidad u ON u.idUnidad = n.idUnidad
																	LEFT JOIN PRUEBA.dbo.Carpeta c on c.CarpetaID = n.idCarpeta
																	LEFT JOIN PRUEBA.dbo.CatUIs unS ON unS.CatUIsID = c.CatUIsID
																	LEFT JOIN dbo.CatFiscalia f ON f.idFiscalia = u.idFiscalia
																	LEFT JOIN dbo.imputadoLitigacionDetermNuc impuDet ON impuDet.idEstatusNucs = n.idEstatusNucs
																	LEFT JOIN dbo.imputadoLitigacion impu ON impu.idImputadoLitigacion = impuDet.idImputadoLitigacion
																	WHERE  impuDet.idImputadoLitigacion = $imputadoID and n.idEstatus IN (154,66,67) 
																	ORDER BY n.mes asc";

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['idEstatusNucs'];
  $arreglo[$indice][1] = $row['estatus'];
  $arreglo[$indice][2] = $row['imputado'];
  $arreglo[$indice][3] = $row['nuc'];
  $arreglo[$indice][4] = $row['Expediente'];
  $arreglo[$indice][5] = $row['nombreMP'];
  $arreglo[$indice][6] = $row['nombreUnidadLitigacion'];
  $arreglo[$indice][7] = $row['nombreFiscalia'];
  $arreglo[$indice][8] = $row['nombreMes'];
  $arreglo[$indice][9] = $row['anio'];

		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getDataMP_documentExcel($conn, $mes, $anio, $idUnidad){
	$query = "SELECT   l.[existenciaAnterior]
																			,l.[carpetasJudicializadas]
																			,l.[judicializadasConDetenido]
																			,l.[judicializadasSinDetenido]
																			,l.[autoDeVinculacion]
																			,l.[autoDeNoVinculacion]
																			,l.[Mixtos]
																			,l.[imposicionMedidasCautelares]
																			,l.[prisionPreventivaOficiosa]
																			,l.[prisionPreventivaJustificada]
																			,l.[presentacionPeriodicaAnteElJuez]
																			,l.[exhibicionGarantiaEconomica]
																			,l.[embargoDeBienes]
																			,l.[inmovilizacionDeCuentasValores]
																			,l.[prohibicionSalirSinAutorizacionDelJuez]
																			,l.[sometimientoCuidadoVigilanciaInstitucion]
																			,l.[prohibicionConcurrirDeterminadasReunionesLugares]
																			,l.[prohibicionConvivirComunicarseDeterminadasPersonas]
																			,l.[separacionInmediataDelDomicilio]
																			,l.[suspensionTemporalEjercicioDelCargo]
																			,l.[suspensionTemporalActividadProfesionalLaboral]
																			,l.[colocacionLocalizadoresElectronicos]
																			,l.[resguardoPropioDomicilioModalidades]
																			,l.[sobreseimientosDecretados]
																			,l.[sobreseimientosPrescripcionAccionPenal]
																			,l.[SobreseimientosMuerteImputado]
																			,l.[sobreseimientosMecanismosAlternativos]
																			,l.[sobreseimientosAcuerdoReparatorio]
																			,l.[sobreseimientosSuspensionCondicionalProceso]
																			,l.[sobreseimientosCriterioOportunidad]
																			,l.[terminacionAnticipada]
																			,l.[procedimientosAbreviados]
																			,l.[acumulacion]
																			,l.[citaciones]
																			,l.[cateosSolilcitados]
																			,l.[cateosConcedidos]
																			,l.[cateosNegados]
																			,l.[ordenesNegadas]
																			,l.[ordenesNegadasAprehension]
																			,l.[ordenesNegadasComparecencia]
																			,l.[desistimientoDelRecurso]
																			,l.[desistimientoDelRecursoParterAcusado]
																			,l.[desistimientoDelRecursoParteDefensor]
																			,l.[desistimientoDelRecursoMP]
																			,l.[apelacionesNoAdmitidas]
																			,l.[sentenciasDictadas]
																			,l.[sentenciasDictadasRevoca]
																			,l.[sentenciasDictadasModifica]
																			,l.[sentenciasDictadasConfirma]
																			,l.[reposicionProcedimiento]
																			,l.[totalJudicializadasTramite]
																			,l.[mandamientosJudicialesGirados]
																			,l.[MandamientosJudicialesGiradosOrdenesAprehension]
																			,l.[MandamientosJudicialesGiradosOrdenesComparecencia]
																			,l.[mandamientosJudicialesCumplidos]
																			,l.[MandamientosJudicialesCumplidosOrdenesAprehension]
																			,l.[MandamientosJudicialesCumplidosOrdenesComparecencia]
																			,l.[totalAudiencias]
																			,l.[acusacionesPresentadas]
																			,l.[audienciaIntermediaEscrita]
																			,l.[audienciaIntermediaOral]
																			,l.[solucionesAlternas]
																			,l.[solucionesAlternasSuspensionCondicionalProceso]
																			,l.[solucionesAlternasAcuerdoReparatorio]
																			,l.[sentencias]
																			,l.[sentenciasCondenatorias]
																			,l.[sentenciasAbsolutorias]
																			,l.[sentenciasMixtas]
																			,l.[sentenciasCondenaReparacionDanos]
																			,l.[sentenciasNoCondenaReparacionDanos]
																			,l.[incompetencias]
																			,l.[incompetenciasDecretadas]
																			,l.[incompetenciasAdmitidas]
																			,l.[apelacionesContraResolucionJuezControl]
																			,l.[apelacionesNegarAnticipoPrueba]
																			,l.[apelacionesNegarAcuerdoReparatorio]
																			,l.[apelacionesNegarCancelarOrdenAprehension]
																			,l.[apelacionesNegarOrdenCateo]
																			,l.[apelacionesProvidenciasPrecautoriasMedidaCautelar]
																			,l.[apelacionesQuePonganTerminoAlProcedimiento]
																			,l.[apelacionesAutoQueResuelveVinculacionAProceso]
																			,l.[apelacionesQueConcedanRevoquenNieguenSuspension]
																			,l.[apelacionesNegativaAbrirProcedimientoAbreviado]
																			,l.[apelacionesSetenciaDefinitivaProcedimientoAbreviado]
																			,l.[apelacionesExcluirMedioPrueba]
																			,l.[apelacionesContraResolucionesTribunalEnjuiciamiento]
																			,l.[apelacionesDesistimientoAccionPenal]
																			,l.[apelacionesSentenciaDefinitiva]
																			,l.[deLasSentenciasDictadas]
																			,l.[revocacionesFavorablesAlMP]
																			,l.[modificacionesFavorablesAlMP]
																			,l.[confirmacionesFavorablesAlMP]
																			,l.[porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria]
																			,l.[FormulaImputacion_Soli]
																			,l.[FormulaImputacion_Otorga]
																			,l.[FormulaImputacion_Negadas]
																			,l.[LegalDetencion]
																			,l.[IlegalDetencion]
																			,l.[Med_CautelresSolicitadas]
																			,l.[Med_CautelaresNegadas]
																			,l.[Med_CautelaresOtorgadas]
																			,l.[idMp]
																			,l.[cambio]
																			,l.[recibiOtmp]
																			,l.[cesefunciones]
																			,l.[ordenesSolicitadas]
																			,l.[ordenesSolicitadasAprehension]
																			,l.[ordenesSolicitadasComparecencia]
																			,l.[medidasProteccion]
																			,l.[totalVictProt]
																			,l.[actosInvestigacionControlJudicial]
																			,l.[controlJudicialIntervencionTR]
																			,l.[controlJudicialTomaMuestras]
																			,l.[controlJudicialExhumacion]
																			,l.[controlJudicialObDatosReservados]
																			,l.[controlJudicialIntervencionCME]
																			,l.[controlJudicialProvPrecautoria]
																			,l.[actosInvestigacionSinControlJudicial]
																			,l.[sinControlJudicialCadCustodia]
																			,l.[sinControlJudicialInspLugDis]
																			,l.[sinControlJudicialInspInmuebles]
																			,l.[sinControlJudicialEntrevistasTestigos]
																			,l.[sinControlJudicialReconocimientoPer]
																			,l.[sinControlJudicialSolInfoPericiales]
																			,l.[sinControlJudicialInfInstiSeg]
																			,l.[sinControlJudicialexamenFisPersona]
																			,l.[resolucionesJuicioOral]
																			,l.[audienciaJuicioOral]
																			,l.[audienciaFallo]
																			,l.[absolutorio]
																			,l.[audienciaIndiviSancion]
																			,l.[procedimientoEspecial]
																			,l.[audienciaCondenatorio]
																			,l.[mecanismosAceleracion]
																			,l.[apelacionesAmparo]
																			,l.[amparos]
																			,l.[amparoDirecto]
																			,l.[amparoIndirecto]
																			,l.[SDuno]
															    ,l.[SDdos]
															    ,l.[SDtres]
																   ,l.[SDcuatro]
																   ,l.[SDcinco]
																	  ,l.[SDseis]
																	  ,l.[SDsiete]
																	  ,l.[SDocho]
																	  ,l.[SDnueve]
																	  ,l.[SDdiez]
																	  ,l.[totCarpTram_nucs]
																	  ,mp.nombre as nombreMP
																	  ,mp.paterno as paternoMP
																	  ,mp.materno as maternoMP
                                                                ,l.[audienciaIncial]
                                                                ,l.[pruebaAnticipada]
                                                                ,l.[escritoAcusacion]
                                                                ,l.[actosInvComplementaria]
                                                                ,l.[audienciaEjecuSanciones]
                                                                ,l.[apelRevModAbsolutoria]
                                                                ,l.[TIEotorgaIntervensionComuni]
                                                                ,l.[TIEotorgaDatosConservados]
                                                                ,l.[TIEotorgaDatosBancarios]
                                                                ,l.[TIEnegativaIntervencionComuni]
                                                                ,l.[TIEnegativaDatosConservados]
                                                                ,l.[TIEnegativaDatosBancarios]
                                                                ,l.[TIEotorgadas]
                                                                ,l.[TIEnegadas]
                                                                ,l.[tramite_total]
		FROM [ESTADISTICAV2].[dbo].[Litigacion] l
		INNER JOIN dbo.mp mp ON mp.idMp = l.idMp
		WHERE l.idUnidad = $idUnidad AND l.idMes = $mes and l.idAnio = $anio";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
  $arreglo[$indice][0] = $row['existenciaAnterior'];

		$arreglo[$indice][1] = $row['carpetasJudicializadas'];
		$arreglo[$indice][2] = $row['judicializadasConDetenido'];
		$arreglo[$indice][3] = $row['judicializadasSinDetenido'];

		$arreglo[$indice][4] = $row['autoDeVinculacion'];
		$arreglo[$indice][5] = $row['autoDeNoVinculacion'];
		$arreglo[$indice][6] = $row['Mixtos'];

		$arreglo[$indice][7] = $row['imposicionMedidasCautelares'];
		$arreglo[$indice][8] = $row['prisionPreventivaOficiosa'];
		$arreglo[$indice][9] = $row['prisionPreventivaJustificada'];
		$arreglo[$indice][10] = $row['presentacionPeriodicaAnteElJuez'];
		$arreglo[$indice][11] = $row['exhibicionGarantiaEconomica'];
		$arreglo[$indice][12] = $row['embargoDeBienes'];
		$arreglo[$indice][13] = $row['inmovilizacionDeCuentasValores'];
		$arreglo[$indice][14] = $row['prohibicionSalirSinAutorizacionDelJuez'];
		$arreglo[$indice][15] = $row['sometimientoCuidadoVigilanciaInstitucion'];
		$arreglo[$indice][16] = $row['prohibicionConcurrirDeterminadasReunionesLugares'];
		$arreglo[$indice][17] = $row['prohibicionConvivirComunicarseDeterminadasPersonas'];
		$arreglo[$indice][18] = $row['separacionInmediataDelDomicilio'];
		$arreglo[$indice][19] = $row['suspensionTemporalEjercicioDelCargo'];
		$arreglo[$indice][20] = $row['suspensionTemporalActividadProfesionalLaboral'];
		$arreglo[$indice][21] = $row['colocacionLocalizadoresElectronicos'];
		$arreglo[$indice][22] = $row['resguardoPropioDomicilioModalidades'];

		$arreglo[$indice][23] = $row['sobreseimientosDecretados'];
		$arreglo[$indice][24] = $row['sobreseimientosPrescripcionAccionPenal'];
		$arreglo[$indice][25] = $row['sobreseimientosMecanismosAlternativos'];
		$arreglo[$indice][26] = $row['sobreseimientosAcuerdoReparatorio'];
		$arreglo[$indice][27] = $row['sobreseimientosSuspensionCondicionalProceso'];
		$arreglo[$indice][28] = $row['sobreseimientosCriterioOportunidad'];
		$arreglo[$indice][29] = $row['terminacionAnticipada'];
		$arreglo[$indice][30] = $row['procedimientosAbreviados'];
		$arreglo[$indice][31] = $row['acumulacion'];
		$arreglo[$indice][32] = $row['citaciones'];

		$arreglo[$indice][33] = $row['cateosSolilcitados'];
		$arreglo[$indice][34] = $row['cateosConcedidos'];
		$arreglo[$indice][35] = $row['cateosNegados'];

		$arreglo[$indice][36] = $row['ordenesNegadas'];
		$arreglo[$indice][37] = $row['ordenesNegadasAprehension'];
		$arreglo[$indice][38] = $row['ordenesNegadasComparecencia'];

		$arreglo[$indice][39] = $row['desistimientoDelRecurso'];
		$arreglo[$indice][40] = $row['desistimientoDelRecursoParterAcusado'];
		$arreglo[$indice][41] = $row['desistimientoDelRecursoParteDefensor'];
		$arreglo[$indice][42] = $row['desistimientoDelRecursoMP'];

		$arreglo[$indice][43] = $row['apelacionesNoAdmitidas'];

		$arreglo[$indice][44] = $row['sentenciasDictadas'];
		$arreglo[$indice][45] = $row['sentenciasDictadasRevoca'];
		$arreglo[$indice][46] = $row['sentenciasDictadasModifica'];
		$arreglo[$indice][47] = $row['sentenciasDictadasConfirma'];

		$arreglo[$indice][48] = $row['reposicionProcedimiento'];

		$arreglo[$indice][49] = $row['totalJudicializadasTramite'];


		$arreglo[$indice][50] = $row['mandamientosJudicialesGirados'];
		$arreglo[$indice][51] = $row['MandamientosJudicialesGiradosOrdenesAprehension'];
		$arreglo[$indice][52] = $row['MandamientosJudicialesGiradosOrdenesComparecencia'];

		$arreglo[$indice][53] = $row['mandamientosJudicialesCumplidos'];
		$arreglo[$indice][54] = $row['MandamientosJudicialesCumplidosOrdenesAprehension'];
		$arreglo[$indice][55] = $row['MandamientosJudicialesCumplidosOrdenesComparecencia'];

		$arreglo[$indice][56] = $row['totalAudiencias'];

		$arreglo[$indice][99] = $row['acusacionesPresentadas'];
		$arreglo[$indice][57] = $row['audienciaIntermediaEscrita'];
		$arreglo[$indice][58] = $row['audienciaIntermediaOral'];

		$arreglo[$indice][59] = $row['solucionesAlternas'];
		$arreglo[$indice][60] = $row['solucionesAlternasSuspensionCondicionalProceso'];
		$arreglo[$indice][61] = $row['solucionesAlternasAcuerdoReparatorio'];

		$arreglo[$indice][62] = $row['sentencias'];
		$arreglo[$indice][63] = $row['sentenciasCondenatorias'];
		$arreglo[$indice][64] = $row['sentenciasAbsolutorias'];
		$arreglo[$indice][65] = $row['sentenciasMixtas'];
		$arreglo[$indice][66] = $row['sentenciasCondenaReparacionDanos'];
		$arreglo[$indice][67] = $row['sentenciasNoCondenaReparacionDanos'];

		$arreglo[$indice][68] = $row['incompetencias'];
		$arreglo[$indice][69] = $row['incompetenciasDecretadas'];
		$arreglo[$indice][70] = $row['incompetenciasAdmitidas'];

		$arreglo[$indice][71] = $row['apelacionesContraResolucionJuezControl'];
		$arreglo[$indice][72] = $row['apelacionesNegarAnticipoPrueba'];
		$arreglo[$indice][73] = $row['apelacionesNegarAcuerdoReparatorio'];
		$arreglo[$indice][74] = $row['apelacionesNegarCancelarOrdenAprehension'];
		$arreglo[$indice][75] = $row['apelacionesNegarOrdenCateo'];
		$arreglo[$indice][76] = $row['apelacionesProvidenciasPrecautoriasMedidaCautelar'];
		$arreglo[$indice][77] = $row['apelacionesQuePonganTerminoAlProcedimiento'];
		$arreglo[$indice][78] = $row['apelacionesAutoQueResuelveVinculacionAProceso'];
		$arreglo[$indice][79] = $row['apelacionesQueConcedanRevoquenNieguenSuspension'];
		$arreglo[$indice][80] = $row['apelacionesNegativaAbrirProcedimientoAbreviado'];
		$arreglo[$indice][81] = $row['apelacionesSetenciaDefinitivaProcedimientoAbreviado'];
		$arreglo[$indice][82] = $row['apelacionesExcluirMedioPrueba'];

		$arreglo[$indice][83] = $row['apelacionesContraResolucionesTribunalEnjuiciamiento'];
		$arreglo[$indice][84] = $row['apelacionesDesistimientoAccionPenal'];
		$arreglo[$indice][85] = $row['apelacionesSentenciaDefinitiva'];

		$arreglo[$indice][86] = $row['deLasSentenciasDictadas'];
		$arreglo[$indice][87] = $row['revocacionesFavorablesAlMP'];
		$arreglo[$indice][88] = $row['modificacionesFavorablesAlMP'];
		$arreglo[$indice][89] = $row['confirmacionesFavorablesAlMP'];

		$arreglo[$indice][90] = $row['porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria'];

		$arreglo[$indice][91] = $row['FormulaImputacion_Soli'];
		$arreglo[$indice][92] = $row['FormulaImputacion_Otorga'];
		$arreglo[$indice][93] = $row['FormulaImputacion_Negadas'];

		$arreglo[$indice][94] = $row['LegalDetencion'];
		$arreglo[$indice][95] = $row['IlegalDetencion'];

		$arreglo[$indice][96] = $row['Med_CautelresSolicitadas'];
		$arreglo[$indice][97] = $row['Med_CautelaresNegadas'];
		$arreglo[$indice][98] = $row['Med_CautelaresOtorgadas'];
		$arreglo[$indice][100] = $row['recibiOtmp'];
		$arreglo[$indice][101] = $row['cesefunciones'];

		$arreglo[$indice][105] = $row['recibiOtmp'];
		$arreglo[$indice][106] = $row['cesefunciones'];

		$arreglo[$indice][107] = $row['ordenesSolicitadas'];
		$arreglo[$indice][108] = $row['ordenesSolicitadasAprehension'];
		$arreglo[$indice][109] = $row['ordenesSolicitadasComparecencia'];
		$arreglo[$indice][110] = $row['medidasProteccion'];
		$arreglo[$indice][111] = $row['totalVictProt'];
		$arreglo[$indice][112] = $row['actosInvestigacionControlJudicial'];
		$arreglo[$indice][113] = $row['controlJudicialIntervencionTR'];
		$arreglo[$indice][114] = $row['controlJudicialTomaMuestras'];
		$arreglo[$indice][115] = $row['controlJudicialExhumacion'];
		$arreglo[$indice][116] = $row['controlJudicialObDatosReservados'];
		$arreglo[$indice][117] = $row['controlJudicialIntervencionCME'];
		$arreglo[$indice][118] = $row['controlJudicialProvPrecautoria'];
		$arreglo[$indice][119] = $row['actosInvestigacionSinControlJudicial'];
		$arreglo[$indice][120] = $row['sinControlJudicialCadCustodia'];
		$arreglo[$indice][121] = $row['sinControlJudicialInspLugDis'];
		$arreglo[$indice][122] = $row['sinControlJudicialInspInmuebles'];
		$arreglo[$indice][123] = $row['sinControlJudicialEntrevistasTestigos'];
		$arreglo[$indice][124] = $row['sinControlJudicialReconocimientoPer'];
		$arreglo[$indice][125] = $row['sinControlJudicialSolInfoPericiales'];
		$arreglo[$indice][126] = $row['sinControlJudicialInfInstiSeg'];
		$arreglo[$indice][127] = $row['sinControlJudicialexamenFisPersona'];
		$arreglo[$indice][128] = $row['resolucionesJuicioOral'];
		$arreglo[$indice][129] = $row['audienciaJuicioOral'];
		$arreglo[$indice][130] = $row['audienciaFallo'];
		$arreglo[$indice][131] = $row['absolutorio'];
		$arreglo[$indice][132] = $row['audienciaIndiviSancion'];
		$arreglo[$indice][133] = $row['procedimientoEspecial'];
		$arreglo[$indice][134] = $row['audienciaCondenatorio'];
		$arreglo[$indice][135] = $row['mecanismosAceleracion'];
		$arreglo[$indice][136] = $row['apelacionesAmparo'];
		$arreglo[$indice][137] = $row['amparos'];
		$arreglo[$indice][138] = $row['amparoDirecto'];
		$arreglo[$indice][139] = $row['amparoIndirecto'];

		$arreglo[$indice][140] = $row['SDuno'];
		$arreglo[$indice][141] = $row['SDdos'];
		$arreglo[$indice][142] = $row['SDtres'];
		$arreglo[$indice][143] = $row['SDcuatro'];
		$arreglo[$indice][144] = $row['SDcinco'];
		$arreglo[$indice][145] = $row['SDseis'];
		$arreglo[$indice][146] = $row['SDsiete'];
		$arreglo[$indice][147] = $row['SDocho'];
		$arreglo[$indice][148] = $row['SDnueve'];
		$arreglo[$indice][149] = $row['SDdiez'];
		$arreglo[$indice][150] = $row['totCarpTram_nucs'];
		$arreglo[$indice][151] = $row['SobreseimientosMuerteImputado'];

		$arreglo[$indice][152] = $row['nombreMP'];
		$arreglo[$indice][153] = $row['paternoMP'];
		$arreglo[$indice][154] = $row['maternoMP'];

        $arreglo[$indice][155] = $row['audienciaIncial'];
        $arreglo[$indice][156] = $row['pruebaAnticipada'];
        $arreglo[$indice][157] = $row['escritoAcusacion'];
        $arreglo[$indice][158] = $row['actosInvComplementaria'];
        $arreglo[$indice][159] = $row['audienciaEjecuSanciones'];
        $arreglo[$indice][160] = $row['apelRevModAbsolutoria'];
        $arreglo[$indice][161] = $row['TIEotorgaIntervensionComuni'];
        $arreglo[$indice][162] = $row['TIEotorgaDatosConservados'];
        $arreglo[$indice][163] = $row['TIEotorgaDatosBancarios'];
        $arreglo[$indice][164] = $row['TIEnegativaIntervencionComuni'];
        $arreglo[$indice][165] = $row['TIEnegativaDatosConservados'];
        $arreglo[$indice][166] = $row['TIEnegativaDatosBancarios'];
        $arreglo[$indice][167] = $row['TIEotorgadas'];
        $arreglo[$indice][168] = $row['TIEnegadas'];
        $arreglo[$indice][169] = $row['tramite_total'];

		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

//Funcion para acortar los nombres de las hojas en excel, logitud maxima 31
function formatTitleSheet($nombreMP, $paternoMP, $maternoMP){
	$nombreCompleto = $nombreMP.' '.$paternoMP.' '.$maternoMP;
	$longitud = strlen($nombreCompleto);
	if($longitud <= 31){
		return $nombreCompleto;
	}else{
		$nombreCompleto2 = $nombreMP.' '.$paternoMP;
		$longitud2 = strlen($nombreCompleto2);
		if($longitud2 <= 31){
			return $nombreCompleto2;
		}else{
			return $nombreMP;
		}
	}
}


function getDataTramite($conn, $nuc){
    // PASO 1: Definición de la función
    // - $conn: Es la conexión a la base de datos
    // - $nuc: Es el número único de caso que vamos a consultar

    // PASO 2: Primera consulta para verificar el estatus
    $queryEstatus = "SELECT TOP 1 idEstatusNucs 
                     FROM estatusNucs 
                     WHERE nuc = ? AND idEstatus = 181 
                     ORDER BY idEstatusNucs DESC";
    // Esta consulta hace lo siguiente:
    // - SELECT TOP 1: Selecciona solo el primer registro
    // - FROM estatusNucs: De la tabla estatusNucs
    // - WHERE nuc = ? AND idEstatus = 181: Filtra por el NUC proporcionado y el estatus 181
    // - ORDER BY idEstatusNucs DESC: Ordena de forma descendente para obtener el más reciente

    // PASO 3: Preparación de parámetros para la primera consulta
    $paramsEstatus = array($nuc);
    // Crea un arreglo con el valor del NUC que se usará como parámetro

    // PASO 4: Ejecutar la primera consulta
    $stmtEstatus = sqlsrv_query($conn, $queryEstatus, $paramsEstatus);

    // PASO 5: Verificar si hubo error en la consulta
    if($stmtEstatus === false) {
        return false;
    }

    // PASO 6: Procesar el resultado de la primera consulta
    if($rowEstatus = sqlsrv_fetch_array($stmtEstatus, SQLSRV_FETCH_ASSOC)) {
        // Si encontró un registro, obtiene el idEstatusNucs
        $idEstatusNucs = $rowEstatus['idEstatusNucs'];

        // PASO 7: Segunda consulta a la tabla de trámites
        $queryTramite = "SELECT * FROM tramiteLitigacion WHERE idEstatusNucs = ?";
        // Esta consulta selecciona todos los campos de tramiteLitigacion
        // donde idEstatusNucs coincida con el obtenido anteriormente

        // PASO 8: Preparación de parámetros para la segunda consulta
        $paramsTramite = array($idEstatusNucs);

        // PASO 9: Ejecutar la segunda consulta
        $stmtTramite = sqlsrv_query($conn, $queryTramite, $paramsTramite);

        // PASO 10: Verificar si hubo error en la segunda consulta
        if($stmtTramite === false) {
            return false;
        }

        // PASO 11: Procesar el resultado de la segunda consulta
        if($rowTramite = sqlsrv_fetch_array($stmtTramite, SQLSRV_FETCH_ASSOC)) {
            // Si encuentra datos, los retorna
            return $rowTramite;
        }
    }

    // PASO 12: Si no se encontró nada, retorna false
    return false;
}

function getDataTramiteImputados($conn, $idCarpetaTramite){

    $queryTramiteImputados = "SELECT * FROM tramiteImputadoLitigacion WHERE idCarpetaTramite = ?";
    $paramsTramiteImputados = array($idCarpetaTramite);
    $stmtTramiteImputados = sqlsrv_query($conn, $queryTramiteImputados, $paramsTramiteImputados);

    if($stmtTramiteImputados === false) {
        return false;
    }

    $imputados = array();
    // Recorremos todas las filas y las guardamos en el array
    while($rowTramiteImputados = sqlsrv_fetch_array($stmtTramiteImputados, SQLSRV_FETCH_ASSOC)) {
        $imputados[] = $rowTramiteImputados;
    }

    return $imputados;

}

function getTramiteAgenteLitigacion($conn, $idMp, $estatus, $mes, $anio, $idUnidad){

    $query = " SELECT * FROM estatusNucs WHERE idMp = $idMp AND idEstatus = $estatus AND idUnidad = $idUnidad ";

    //echo $query."<br>";

    $indice = 0;

    $stmt = sqlsrv_query($conn, $query);

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $arreglo[$indice][0] = $row['nuc'];
        $arreglo[$indice][1] = $row['idEstatusNucs'];
        $arreglo[$indice][2] = $row['idMp'];
        $arreglo[$indice][3] = $row['idUnidad'];
        $arreglo[$indice][4] = $row['anio'];
        $arreglo[$indice][5] = $row['mes'];
        $arreglo[$indice][6] = $row['idCarpeta'];

        $indice++;
    }
    if (isset($arreglo)) {
        return $arreglo;
    }
}


function getDatosTramiteLitigacion($conn, $idEstatusNucs) {
    $query = "SELECT [idCarpetaTramite]
                    ,[idEstatusNucs]
                    ,[causaPenal]
                    ,[cuadernoAntecedentes]
                    ,[cuadernoConRequerimiento]
                    ,[archivoEnSedeJudicial]
              FROM [ESTADISTICAV2].[dbo].[tramiteLitigacion] 
              WHERE [idEstatusNucs] = ?";

    $params = array($idEstatusNucs);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        return false;
    }

    $datos = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    sqlsrv_free_stmt($stmt);

    return $datos;
}

// Creamos la función para obtener los imputados del tramite
function getImputadosTramite($conn, $idCarpetaTramite) {
    $query = "SELECT [idImputadoTramite]
                    ,[nombre]
                    ,[apellidoPaterno]
                    ,[apellidoMaterno]
             FROM [ESTADISTICAV2].[dbo].[tramiteImputadoLitigacion] 
             WHERE [idCarpetaTramite] = ?";

    $params = array($idCarpetaTramite);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        return array();
    }

    $imputados = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $imputados[] = $row;
    }

    sqlsrv_free_stmt($stmt);
    return $imputados;
}