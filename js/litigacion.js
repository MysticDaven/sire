

function objetoAjax() {
	var xmlhttp = false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}




function cargarMOdalFormatoLit(idEnlace, nombreCompletoMP, idMp, idUnidad, mes, anio) {

	//alert("AQUI"+idEnlace+"-"+nombreCompletoMP+"-"+idMp+"-"+idUnidad+"-"+mes+"-"+anio);

	cont = document.getElementById('contMOdalFormatoLitig');
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/modalFormatoLitigacion.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
			$('#myModaFormato').on('show.bs.modal', function () {

			});
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&idEnlace=" + idEnlace + "&nombreCompletoMP=" + nombreCompletoMP + "&idMp=" + idMp + "&idUnidad=" + idUnidad + "&mes=" + mes + "&anio=" + anio);

}

function cargarMOdalFormatoVerLit(nombreCompletoMP, idMp, idUnidad, mes, anio, idEnlace) {

	cont = document.getElementById('contMOdalFormatoVerLitig');
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/modalFormatoLitigacionVer.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada

		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&idEnlace=" + idEnlace + "&nombreCompletoMP=" + nombreCompletoMP + "&idMp=" + idMp + "&idUnidad=" + idUnidad + "&mes=" + mes + "&anio=" + anio);

}

function cargarMOdalFormatoEditarLit(nombreCompletoMP, idMp, idUnidad, mes, anio) {

	cont = document.getElementById('contMOdalFormatoEditarLitig');
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/modalFormatoLitigacionEditar.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;      //cargar tabla sin nada
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&nombreCompletoMP=" + nombreCompletoMP + "&idMp=" + idMp + "&idUnidad=" + idUnidad + "&mes=" + mes + "&anio=" + anio);

}

function sendDataModalLitigacion(inputCant, estatus, idMp, mes, anio, idUnidad) {


	var cant = document.getElementById(inputCant).value;
	cont = document.getElementById('contmodalnucsLitig');
	if (cant != 0) {
		$('#nuc').focus();
		ajax = objetoAjax();
		ajax.open("POST", "format/litigacion/modalNucsLitig.php");
		ajax.onreadystatechange = function () {
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

				$('#modalNucsLitig').modal('show');
				$('#modalFormatoLitig').modal('hide');
			}
		}
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("&cant=" + cant + "&idMp=" + idMp + "&mes=" + mes + "&anio=" + anio + "&idUnidad=" + idUnidad + "&estatus=" + estatus);

	}

}

function modalsavecloseCmasc() {


	$('#modalFormatoLitig').modal('show');
	$('#modalNucsLitig').modal('hide');

}

function sumJudicialized() {
	cdete = document.getElementById("cdete").value; if (cdete == "") { cdete = 0; } else { cdete = parseInt(document.getElementById("cdete").value); }
	sdete = document.getElementById("sdete").value; if (sdete == "") { sdete = 0; } else { sdete = parseInt(document.getElementById("sdete").value); }
	var final = cdete + sdete;
	document.getElementById("totJudic").value = final;
	sumTotCarpJudTram();
}

function sumImpoMedCaute() {
	ppofic = document.getElementById("ppofic").value; if (ppofic == "") { ppofic = 0; } else { ppofic = parseInt(document.getElementById("ppofic").value); }
	ppjus = document.getElementById("ppjus").value; if (ppjus == "") { ppjus = 0; } else { ppjus = parseInt(document.getElementById("ppjus").value); }
	ppanju = document.getElementById("ppanju").value; if (ppanju == "") { ppanju = 0; } else { ppanju = parseInt(document.getElementById("ppanju").value); }
	exgaeco = document.getElementById("exgaeco").value; if (exgaeco == "") { exgaeco = 0; } else { exgaeco = parseInt(document.getElementById("exgaeco").value); }
	emvien = document.getElementById("emvien").value; if (emvien == "") { emvien = 0; } else { emvien = parseInt(document.getElementById("emvien").value); }
	incuval = document.getElementById("incuval").value; if (incuval == "") { incuval = 0; } else { incuval = parseInt(document.getElementById("incuval").value); }
	pssafj = document.getElementById("pssafj").value; if (pssafj == "") { pssafj = 0; } else { pssafj = parseInt(document.getElementById("pssafj").value); }
	scviind = document.getElementById("scviind").value; if (scviind == "") { scviind = 0; } else { scviind = parseInt(document.getElementById("scviind").value); }
	pcdrclug = document.getElementById("pcdrclug").value; if (pcdrclug == "") { pcdrclug = 0; } else { pcdrclug = parseInt(document.getElementById("pcdrclug").value); }
	pccdper = document.getElementById("pccdper").value; if (pccdper == "") { pccdper = 0; } else { pccdper = parseInt(document.getElementById("pccdper").value); }
	sindom = document.getElementById("sindom").value; if (sindom == "") { sindom = 0; } else { sindom = parseInt(document.getElementById("sindom").value); }
	steeca = document.getElementById("steeca").value; if (steeca == "") { steeca = 0; } else { steeca = parseInt(document.getElementById("steeca").value); }
	steapl = document.getElementById("steapl").value; if (steapl == "") { steapl = 0; } else { steapl = parseInt(document.getElementById("steapl").value); }
	coloele = document.getElementById("coloele").value; if (coloele == "") { coloele = 0; } else { coloele = parseInt(document.getElementById("coloele").value); }
	rpdmjd = document.getElementById("rpdmjd").value; if (rpdmjd == "") { rpdmjd = 0; } else { rpdmjd = parseInt(document.getElementById("rpdmjd").value); }
	var suma = ppjus + ppanju + exgaeco + emvien + incuval + pssafj + scviind + pcdrclug + pccdper + sindom + ppofic + steeca + steapl + coloele + rpdmjd;
	document.getElementById("IMC").value = suma;

}
function sumsobredecret() {
	SDpapen = document.getElementById("SDpapen").value; if (SDpapen == "") { SDpapen = 0; } else { SDpapen = parseInt(document.getElementById("SDpapen").value); }
	MA = document.getElementById("MA").value; if (MA == "") { MA = 0; } else { MA = parseInt(document.getElementById("MA").value); }
	termant = document.getElementById("termant").value; if (termant == "") { termant = 0; } else { termant = parseInt(document.getElementById("termant").value); }
	SDpmuImpu = document.getElementById("SDpmuImpu").value; if (SDpmuImpu == "") { SDpmuImpu = 0; } else { SDpmuImpu = parseInt(document.getElementById("SDpmuImpu").value); }
	/*NUEVAS VARIABLES AGREGADAS SOLICITADAS POR SENAP
	SDhNoCom = document.getElementById("SDhNoCom").value;  if( SDhNoCom == "" ){ SDhNoCom = 0; }else { SDhNoCom = parseInt(document.getElementById("SDhNoCom").value);  }
	SDnoConDel = document.getElementById("SDnoConDel").value;  if( SDnoConDel == "" ){ SDnoConDel = 0; }else { SDnoConDel = parseInt(document.getElementById("SDnoConDel").value);  }
	SDimExRespPen = document.getElementById("SDimExRespPen").value; if( SDimExRespPen == "" ){ SDimExRespPen = 0; }else { SDimExRespPen = parseInt(document.getElementById("SDimExRespPen").value);  }
	SDNoEleSufAcusa = document.getElementById("SDNoEleSufAcusa").value;  if( SDNoEleSufAcusa == "" ){ SDNoEleSufAcusa = 0; }else { SDNoEleSufAcusa = parseInt(document.getElementById("SDNoEleSufAcusa").value);  }
	SDExtPenal = document.getElementById("SDExtPenal").value;  if( SDExtPenal == "" ){ SDExtPenal = 0; }else { SDExtPenal = parseInt(document.getElementById("SDExtPenal").value);  }
	SDderDeliSigProc = document.getElementById("SDderDeliSigProc").value;  if( SDderDeliSigProc == "" ){ SDderDeliSigProc = 0; }else { SDderDeliSigProc = parseInt(document.getElementById("SDderDeliSigProc").value);  }
	SDsentFirme = document.getElementById("SDsentFirme").value; if( SDsentFirme == "" ){ SDsentFirme = 0; }else { SDsentFirme = parseInt(document.getElementById("SDsentFirme").value);  }
	SDnoVincProc = document.getElementById("SDnoVincProc").value; if( SDnoVincProc == "" ){ SDnoVincProc = 0; }else { SDnoVincProc = parseInt(document.getElementById("SDnoVincProc").value);  }
	SDinCieInvCom = document.getElementById("SDinCieInvCom").value; if( SDinCieInvCom == "" ){ SDinCieInvCom = 0; }else { SDinCieInvCom = parseInt(document.getElementById("SDinCieInvCom").value);  }
	*/
	var final = SDpapen + MA + termant + SDpmuImpu; document.getElementById("SD").value = final;
	sumTotCarpJudTram();
}
function summecanalternat() {
	acrep = document.getElementById("acrep").value; if (acrep == "") { acrep = 0; } else { acrep = parseInt(document.getElementById("acrep").value); }
	scpro = document.getElementById("scpro").value; if (scpro == "") { scpro = 0; } else { scpro = parseInt(document.getElementById("scpro").value); }
	criopor = document.getElementById("criopor").value; if (criopor == "") { criopor = 0; } else { criopor = parseInt(document.getElementById("criopor").value); }
	var final = acrep + scpro + criopor; document.getElementById("MA").value = final; sumsobredecret();
	sumTotCarpJudTram();
}
function sumcateos() {
	Cconc = document.getElementById("Cconc").value; if (Cconc == "") { Cconc = 0; } else { Cconc = parseInt(document.getElementById("Cconc").value); }
	Cnega = document.getElementById("Cnega").value; if (Cnega == "") { Cnega = 0; } else { Cnega = parseInt(document.getElementById("Cnega").value); }
	var final = Cconc + Cnega; document.getElementById("CS").value = final;
}
function sumcordnes() {
	ONapre = document.getElementById("ONapre").value; if (ONapre == "") { ONapre = 0; } else { ONapre = parseInt(document.getElementById("ONapre").value); }
	ONcomp = document.getElementById("ONcomp").value; if (ONcomp == "") { ONcomp = 0; } else { ONcomp = parseInt(document.getElementById("ONcomp").value); }
	var final = ONapre + ONcomp; document.getElementById("ON").value = final;
}
function sumcordnesSoli() {
	OSapre = document.getElementById("OSapre").value; if (OSapre == "") { OSapre = 0; } else { OSapre = parseInt(document.getElementById("OSapre").value); }
	OScomp = document.getElementById("OScomp").value; if (OScomp == "") { OScomp = 0; } else { OScomp = parseInt(document.getElementById("OScomp").value); }
	var final = OSapre + OScomp; document.getElementById("OS").value = final;
}
function sumds() {
	DRppa = document.getElementById("DRppa").value; if (DRppa == "") { DRppa = 0; } else { DRppa = parseInt(document.getElementById("DRppa").value); }
	DRppd = document.getElementById("DRppd").value; if (DRppd == "") { DRppd = 0; } else { DRppd = parseInt(document.getElementById("DRppd").value); }
	DRppmp = document.getElementById("DRppmp").value; if (DRppmp == "") { DRppmp = 0; } else { DRppmp = parseInt(document.getElementById("DRppmp").value); }
	var final = DRppa + DRppd + DRppmp; document.getElementById("DR").value = final;
}
function sumsentedict() {
	SDIrev = document.getElementById("SDIrev").value; if (SDIrev == "") { SDIrev = 0; } else { SDIrev = parseInt(document.getElementById("SDIrev").value); }
	SDImod = document.getElementById("SDImod").value; if (SDImod == "") { SDImod = 0; } else { SDImod = parseInt(document.getElementById("SDImod").value); }
	SDIconf = document.getElementById("SDIconf").value; if (SDIconf == "") { SDIconf = 0; } else { SDIconf = parseInt(document.getElementById("SDIconf").value); }
	var final = SDIrev + SDImod + SDIconf; document.getElementById("SDI").value = final;
}
function sumTotCarpJudTram() {
	tramAnt = document.getElementById("tramAnt").value; if (tramAnt == "") { tramAnt = 0; } else { tramAnt = parseInt(document.getElementById("tramAnt").value); }
	cdete = document.getElementById("cdete").value; if (cdete == "") { cdete = 0; } else { cdete = parseInt(document.getElementById("cdete").value); }
	sdete = document.getElementById("sdete").value; if (sdete == "") { sdete = 0; } else { sdete = parseInt(document.getElementById("sdete").value); }
	INCOMadmi = document.getElementById("INCOMadmi").value; if (INCOMadmi == "") { INCOMadmi = 0; } else { INCOMadmi = parseInt(document.getElementById("INCOMadmi").value); }

	aunvinc = document.getElementById("aunvinc").value; if (aunvinc == "") { aunvinc = 0; } else { aunvinc = parseInt(document.getElementById("aunvinc").value); }
	SDpapen = document.getElementById("SDpapen").value; if (SDpapen == "") { SDpapen = 0; } else { SDpapen = parseInt(document.getElementById("SDpapen").value); }
	SDpmuImpu = document.getElementById("SDpmuImpu").value; if (SDpmuImpu == "") { SDpmuImpu = 0; } else { SDpmuImpu = parseInt(document.getElementById("SDpmuImpu").value); }
	MA = document.getElementById("MA").value; if (MA == "") { MA = 0; } else { MA = parseInt(document.getElementById("MA").value); }
	proabre = document.getElementById("proabre").value; if (proabre == "") { proabre = 0; } else { proabre = parseInt(document.getElementById("proabre").value); }
	acu = document.getElementById("acu").value; if (acu == "") { acu = 0; } else { acu = parseInt(document.getElementById("acu").value); }
	SENcon = document.getElementById("SENcon").value; if (SENcon == "") { SENcon = 0; } else { SENcon = parseInt(document.getElementById("SENcon").value); }
	SENabsol = document.getElementById("SENabsol").value; if (SENabsol == "") { SENabsol = 0; } else { SENabsol = parseInt(document.getElementById("SENabsol").value); }
	SENmixc = document.getElementById("SENmixc").value; if (SENmixc == "") { SENmixc = 0; } else { SENmixc = parseInt(document.getElementById("SENmixc").value); }
	INCOMdecre = document.getElementById("INCOMdecre").value; if (INCOMdecre == "") { INCOMdecre = 0; } else { INCOMdecre = parseInt(document.getElementById("INCOMdecre").value); }
	var suma1 = tramAnt + cdete + sdete + INCOMadmi;
	var suma2 = aunvinc + SDpapen + MA + proabre + acu + SENcon + SENabsol + SENmixc + INCOMdecre + SDpmuImpu;
	var final = suma1 - suma2;
	document.getElementById("totCarjudTram").value = final;
}
function sumManJudGir() {
	MJGorap = document.getElementById("MJGorap").value; if (MJGorap == "") { MJGorap = 0; } else { MJGorap = parseInt(document.getElementById("MJGorap").value); }
	MJGorcomp = document.getElementById("MJGorcomp").value; if (MJGorcomp == "") { MJGorcomp = 0; } else { MJGorcomp = parseInt(document.getElementById("MJGorcomp").value); }
	var final = MJGorap + MJGorcomp; document.getElementById("MJG").value = final;
}
function sumManJudCump() {
	MJCorapre = document.getElementById("MJCorapre").value; if (MJCorapre == "") { MJCorapre = 0; } else { MJCorapre = parseInt(document.getElementById("MJCorapre").value); }
	MJCordcomp = document.getElementById("MJCordcomp").value; if (MJCordcomp == "") { MJCordcomp = 0; } else { MJCordcomp = parseInt(document.getElementById("MJCordcomp").value); }
	var final = MJCorapre + MJCordcomp; document.getElementById("MJC").value = final;
}
function sumAcusaPres() {
	ACPREaie = document.getElementById("ACPREaie").value; if (ACPREaie == "") { ACPREaie = 0; } else { ACPREaie = parseInt(document.getElementById("ACPREaie").value); }
	ACPREaio = document.getElementById("ACPREaio").value; if (ACPREaio == "") { ACPREaio = 0; } else { ACPREaio = parseInt(document.getElementById("ACPREaio").value); }
	var final = ACPREaie + ACPREaio; document.getElementById("ACPRE").value = final;
}
function sumSolAltern() {
	SOALscp = document.getElementById("SOALscp").value; if (SOALscp == "") { SOALscp = 0; } else { SOALscp = parseInt(document.getElementById("SOALscp").value); }
	SOALarep = document.getElementById("SOALarep").value; if (SOALarep == "") { SOALarep = 0; } else { SOALarep = parseInt(document.getElementById("SOALarep").value); }
	var final = SOALscp + SOALarep; document.getElementById("SOAL").value = final;
}
function sumsentencias() {
	SENcon = document.getElementById("SENcon").value; if (SENcon == "") { SENcon = 0; } else { SENcon = parseInt(document.getElementById("SENcon").value); }
	SENabsol = document.getElementById("SENabsol").value; if (SENabsol == "") { SENabsol = 0; } else { SENabsol = parseInt(document.getElementById("SENabsol").value); }
	SENmixc = document.getElementById("SENmixc").value; if (SENmixc == "") { SENmixc = 0; } else { SENmixc = parseInt(document.getElementById("SENmixc").value); }
	SENsreda = document.getElementById("SENsreda").value; if (SENsreda == "") { SENsreda = 0; } else { SENsreda = parseInt(document.getElementById("SENsreda").value); }
	SENnocreda = document.getElementById("SENnocreda").value; if (SENnocreda == "") { SENnocreda = 0; } else { SENnocreda = parseInt(document.getElementById("SENnocreda").value); }
	var final = SENcon + SENabsol + SENmixc + SENsreda + SENnocreda; document.getElementById("SEN").value = final;
	sumTotCarpJudTram();
}
function sumImcompetenc() {
	INCOMdecre = document.getElementById("INCOMdecre").value; if (INCOMdecre == "") { INCOMdecre = 0; } else { INCOMdecre = parseInt(document.getElementById("INCOMdecre").value); }
	INCOMadmi = document.getElementById("INCOMadmi").value; if (INCOMadmi == "") { INCOMadmi = 0; } else { INCOMadmi = parseInt(document.getElementById("INCOMadmi").value); }
	var final = INCOMdecre + INCOMadmi; document.getElementById("INCOM").value = final;
	sumTotCarpJudTram();
}
function sumApelaJuControl() {
	ARJnap = document.getElementById("ARJnap").value; if (ARJnap == "") { ARJnap = 0; } else { ARJnap = parseInt(document.getElementById("ARJnap").value); }
	ARJnar = document.getElementById("ARJnar").value; if (ARJnar == "") { ARJnar = 0; } else { ARJnar = parseInt(document.getElementById("ARJnar").value); }
	ARJncoap = document.getElementById("ARJncoap").value; if (ARJncoap == "") { ARJncoap = 0; } else { ARJncoap = parseInt(document.getElementById("ARJncoap").value); }
	ARJnoc = document.getElementById("ARJnoc").value; if (ARJnoc == "") { ARJnoc = 0; } else { ARJnoc = parseInt(document.getElementById("ARJnoc").value); }
	ARJppmc = document.getElementById("ARJppmc").value; if (ARJppmc == "") { ARJppmc = 0; } else { ARJppmc = parseInt(document.getElementById("ARJppmc").value); }
	ARJtps = document.getElementById("ARJtps").value; if (ARJtps == "") { ARJtps = 0; } else { ARJtps = parseInt(document.getElementById("ARJtps").value); }
	ARJrvp = document.getElementById("ARJrvp").value; if (ARJrvp == "") { ARJrvp = 0; } else { ARJrvp = parseInt(document.getElementById("ARJrvp").value); }
	ARJrnscp = document.getElementById("ARJrnscp").value; if (ARJrnscp == "") { ARJrnscp = 0; } else { ARJrnscp = parseInt(document.getElementById("ARJrnscp").value); }
	ARJnapa = document.getElementById("ARJnapa").value; if (ARJnapa == "") { ARJnapa = 0; } else { ARJnapa = parseInt(document.getElementById("ARJnapa").value); }
	ARJsdpa = document.getElementById("ARJsdpa").value; if (ARJsdpa == "") { ARJsdpa = 0; } else { ARJsdpa = parseInt(document.getElementById("ARJsdpa").value); }
	ARJemp = document.getElementById("ARJemp").value; if (ARJemp == "") { ARJemp = 0; } else { ARJemp = parseInt(document.getElementById("ARJemp").value); }
	var final = ARJnap + ARJnar + ARJncoap + ARJnoc + ARJppmc + ARJtps + ARJrvp + ARJrnscp + ARJnapa + ARJsdpa + ARJemp; document.getElementById("ARJ").value = final;
}
function sumApelacResolTribuEnj() {
	ARTEdap = document.getElementById("ARTEdap").value; if (ARTEdap == "") { ARTEdap = 0; } else { ARTEdap = parseInt(document.getElementById("ARTEdap").value); }
	ARTEsd = document.getElementById("ARTEsd").value; if (ARTEsd == "") { ARTEsd = 0; } else { ARTEsd = parseInt(document.getElementById("ARTEsd").value); }
	var final = ARTEdap + ARTEsd; document.getElementById("ARTE").value = final;
}
function sumSentencDictadas() {
	DSEDrfmp = document.getElementById("DSEDrfmp").value; if (DSEDrfmp == "") { DSEDrfmp = 0; } else { DSEDrfmp = parseInt(document.getElementById("DSEDrfmp").value); }
	DSEDmfmp = document.getElementById("DSEDmfmp").value; if (DSEDmfmp == "") { DSEDmfmp = 0; } else { DSEDmfmp = parseInt(document.getElementById("DSEDmfmp").value); }
	DSEDcfmp = document.getElementById("DSEDcfmp").value; if (DSEDcfmp == "") { DSEDcfmp = 0; } else { DSEDcfmp = parseInt(document.getElementById("DSEDcfmp").value); }
	var final = DSEDrfmp + DSEDmfmp + DSEDcfmp; document.getElementById("DSED").value = final;
}
function sumActInvConJud() {
	intervencionTR = document.getElementById("intervencionTR").value; if (intervencionTR == "") { intervencionTR = 0; } else { intervencionTR = parseInt(document.getElementById("intervencionTR").value); }
	tomaMuestras = document.getElementById("tomaMuestras").value; if (tomaMuestras == "") { tomaMuestras = 0; } else { tomaMuestras = parseInt(document.getElementById("tomaMuestras").value); }
	exhumacion = document.getElementById("exhumacion").value; if (exhumacion == "") { exhumacion = 0; } else { exhumacion = parseInt(document.getElementById("exhumacion").value); }
	obDatosReservados = document.getElementById("obDatosReservados").value; if (obDatosReservados == "") { obDatosReservados = 0; } else { obDatosReservados = parseInt(document.getElementById("obDatosReservados").value); }
	intervencionCME = document.getElementById("intervencionCME").value; if (intervencionCME == "") { intervencionCME = 0; } else { intervencionCME = parseInt(document.getElementById("intervencionCME").value); }
	provPrecautoria = document.getElementById("provPrecautoria").value; if (provPrecautoria == "") { provPrecautoria = 0; } else { provPrecautoria = parseInt(document.getElementById("provPrecautoria").value); }
	var final = intervencionTR + tomaMuestras + exhumacion + obDatosReservados + intervencionCME + provPrecautoria; document.getElementById("AICJ").value = final;
}
function sumActInvSinConJud() {
	cadCustodia = document.getElementById("cadCustodia").value; if (cadCustodia == "") { cadCustodia = 0; } else { cadCustodia = parseInt(document.getElementById("cadCustodia").value); }
	InspLugDis = document.getElementById("InspLugDis").value; if (InspLugDis == "") { InspLugDis = 0; } else { InspLugDis = parseInt(document.getElementById("InspLugDis").value); }
	InspInmuebles = document.getElementById("InspInmuebles").value; if (InspInmuebles == "") { InspInmuebles = 0; } else { InspInmuebles = parseInt(document.getElementById("InspInmuebles").value); }
	entrevistasTestigos = document.getElementById("entrevistasTestigos").value; if (entrevistasTestigos == "") { entrevistasTestigos = 0; } else { entrevistasTestigos = parseInt(document.getElementById("entrevistasTestigos").value); }
	reconocimientoPer = document.getElementById("reconocimientoPer").value; if (reconocimientoPer == "") { reconocimientoPer = 0; } else { reconocimientoPer = parseInt(document.getElementById("reconocimientoPer").value); }
	solInfoPericiales = document.getElementById("solInfoPericiales").value; if (solInfoPericiales == "") { solInfoPericiales = 0; } else { solInfoPericiales = parseInt(document.getElementById("solInfoPericiales").value); }
	InfInstiSeg = document.getElementById("InfInstiSeg").value; if (InfInstiSeg == "") { InfInstiSeg = 0; } else { InfInstiSeg = parseInt(document.getElementById("InfInstiSeg").value); }
	examenFisPersona = document.getElementById("examenFisPersona").value; if (examenFisPersona == "") { examenFisPersona = 0; } else { examenFisPersona = parseInt(document.getElementById("examenFisPersona").value); }
	var final = cadCustodia + InspLugDis + InspInmuebles + entrevistasTestigos + reconocimientoPer + solInfoPericiales + InfInstiSeg + examenFisPersona; document.getElementById("AISCJ").value = final;
}
function sumAmparo() {
	amparoDirecto = document.getElementById("amparoDirecto").value; if (amparoDirecto == "") { amparoDirecto = 0; } else { amparoDirecto = parseInt(document.getElementById("amparoDirecto").value); }
	amparoIndirecto = document.getElementById("amparoIndirecto").value; if (amparoIndirecto == "") { amparoIndirecto = 0; } else { amparoIndirecto = parseInt(document.getElementById("amparoIndirecto").value); }
	var final = amparoDirecto + amparoIndirecto; document.getElementById("amparos").value = final;
}

function sumResoJuicioOral() {
	audJuiOral = document.getElementById("audJuiOral").value; if (audJuiOral == "") { audJuiOral = 0; } else { audJuiOral = parseInt(document.getElementById("audJuiOral").value); }
	audFallo = document.getElementById("audFallo").value; if (audFallo == "") { audFallo = 0; } else { audFallo = parseInt(document.getElementById("audFallo").value); }
	absolutorio = document.getElementById("absolutorio").value; if (absolutorio == "") { absolutorio = 0; } else { absolutorio = parseInt(document.getElementById("absolutorio").value); }
	AudIndiSan = document.getElementById("AudIndiSan").value; if (AudIndiSan == "") { AudIndiSan = 0; } else { AudIndiSan = parseInt(document.getElementById("AudIndiSan").value); }
	procEspecial = document.getElementById("procEspecial").value; if (procEspecial == "") { procEspecial = 0; } else { procEspecial = parseInt(document.getElementById("procEspecial").value); }
	audCondenatorio = document.getElementById("audCondenatorio").value; if (audCondenatorio == "") { audCondenatorio = 0; } else { audCondenatorio = parseInt(document.getElementById("audCondenatorio").value); }
	var final = audJuiOral + audFallo + absolutorio + AudIndiSan + procEspecial + audCondenatorio; document.getElementById("RESOJuiOral").value = final;
}
//////////////////////////////////////////////////////////////////////////


function validateItsokLiti(idEnlace, mes, anio, idMp, idUnidad) {



	cont = document.getElementById('continputdhidden');
	acc = "validateitok";

	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/accionesNucsLit.php");
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			guardarLitigacion(idEnlace, mes, anio, idMp, idUnidad);
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&acc=" + acc + "&idMp=" + idMp + "&mes=" + mes + "&anio=" + anio + "&idUnidad=" + idUnidad);

}

//////////////////////////////////////////////////////////////////////////

function guardarLitigacion(idEnlace, mes, anio, idMp, idUnidad) {


	recibiOtmp = document.getElementById("recibiOtmp").value; if (recibiOtmp == "") { recibiOtmp = 0; } else { recibiOtmp = parseInt(document.getElementById("recibiOtmp").value); }
	cesefunciones = document.getElementById("cesefunciones").value; if (cesefunciones == "") { cesefunciones = 0; } else { cesefunciones = parseInt(document.getElementById("cesefunciones").value); }

	tramAnt = document.getElementById("tramAnt").value; if (tramAnt == "") { tramAnt = 0; } else { tramAnt = parseInt(document.getElementById("tramAnt").value); }
	cdete = document.getElementById("cdete").value; if (cdete == "") { cdete = 0; } else { cdete = parseInt(document.getElementById("cdete").value); }
	cdeteNu = document.getElementById("valor1").value; if (cdeteNu == "") { cdeteNu = 0; } else { cdeteNu = parseInt(document.getElementById("valor1").value); }
	sdete = document.getElementById("sdete").value; if (sdete == "") { sdete = 0; } else { sdete = parseInt(document.getElementById("sdete").value); }
	sdeteNu = document.getElementById("valor2").value; if (sdeteNu == "") { sdeteNu = 0; } else { sdeteNu = parseInt(document.getElementById("valor2").value); }
	FIsolic = document.getElementById("FIsolic").value; if (FIsolic == "") { FIsolic = 0; } else { FIsolic = parseInt(document.getElementById("FIsolic").value); }
	FIsolicNu = document.getElementById("valor3").value; if (FIsolicNu == "") { FIsolicNu = 0; } else { FIsolicNu = parseInt(document.getElementById("valor3").value); }
	FIotor = document.getElementById("FIotor").value; if (FIotor == "") { FIotor = 0; } else { FIotor = parseInt(document.getElementById("FIotor").value); }
	FIotorNU = document.getElementById("valor4").value; if (FIotorNU == "") { FIotorNU = 0; } else { FIotorNU = parseInt(document.getElementById("valor4").value); }
	FInega = document.getElementById("FInega").value; if (FInega == "") { FInega = 0; } else { FInega = parseInt(document.getElementById("FInega").value); }
	FInegaNu = document.getElementById("valor5").value; if (FInegaNu == "") { FInegaNu = 0; } else { FInegaNu = parseInt(document.getElementById("valor5").value); }
	legal = document.getElementById("legal").value; if (legal == "") { legal = 0; } else { legal = parseInt(document.getElementById("legal").value); }
	legalNu = document.getElementById("valor6").value; if (legalNu == "") { legalNu = 0; } else { legalNu = parseInt(document.getElementById("valor6").value); }
	ilegal = document.getElementById("ilegal").value; if (ilegal == "") { ilegal = 0; } else { ilegal = parseInt(document.getElementById("ilegal").value); }
	ilegalNu = document.getElementById("valor7").value; if (ilegalNu == "") { ilegalNu = 0; } else { ilegalNu = parseInt(document.getElementById("valor7").value); }

	auvinc = document.getElementById("auvinc").value; if (auvinc == "") { auvinc = 0; } else { auvinc = parseInt(document.getElementById("auvinc").value); }//////////////////////////////////////////
	//vincproceso = document.getElementById("vincproceso").value; if( vincproceso == "" ){ vincproceso = 0; }else { vincproceso = parseInt(document.getElementById("vincproceso").value); } /////////////////////////////////////////
	vincprocesoNU = document.getElementById("valor151").value; if (vincprocesoNU == "") { vincprocesoNU = 0; } else { vincprocesoNU = parseInt(document.getElementById("valor151").value); }

	aunvinc = document.getElementById("aunvinc").value; if (aunvinc == "") { aunvinc = 0; } else { aunvinc = parseInt(document.getElementById("aunvinc").value); }
	aunvincNu = document.getElementById("valor10").value; if (aunvincNu == "") { aunvincNu = 0; } else { aunvincNu = parseInt(document.getElementById("valor10").value); }
	mix = document.getElementById("mix").value; if (mix == "") { mix = 0; } else { mix = parseInt(document.getElementById("mix").value); }
	mixNu = document.getElementById("valor12").value; if (mixNu == "") { mixNu = 0; } else { mixNu = parseInt(document.getElementById("valor12").value); }
	MCsol = document.getElementById("MCsol").value; if (MCsol == "") { MCsol = 0; } else { MCsol = parseInt(document.getElementById("MCsol").value); }
	MCsolNu = document.getElementById("valor13").value; if (MCsolNu == "") { MCsolNu = 0; } else { MCsolNu = parseInt(document.getElementById("valor13").value); }

	MCotor = document.getElementById("MCotor").value; if (MCotor == "") { MCotor = 0; } else { MCotor = parseInt(document.getElementById("MCotor").value); }
	MCotorNu = document.getElementById("valor14").value; if (MCotorNu == "") { MCotorNu = 0; } else { MCotorNu = parseInt(document.getElementById("valor14").value); }

	MCnega = document.getElementById("MCnega").value; if (MCnega == "") { MCnega = 0; } else { MCnega = parseInt(document.getElementById("MCnega").value); }
	MCnegaNu = document.getElementById("valor15").value; if (MCnegaNu == "") { MCnegaNu = 0; } else { MCnegaNu = parseInt(document.getElementById("valor15").value); }
	ppofic = document.getElementById("ppofic").value; if (ppofic == "") { ppofic = 0; } else { ppofic = parseInt(document.getElementById("ppofic").value); }
	ppoficNu = document.getElementById("valor17").value; if (ppoficNu == "") { ppoficNu = 0; } else { ppoficNu = parseInt(document.getElementById("valor17").value); }
	ppjus = document.getElementById("ppjus").value; if (ppjus == "") { ppjus = 0; } else { ppjus = parseInt(document.getElementById("ppjus").value); }
	ppjusNu = document.getElementById("valor18").value; if (ppjusNu == "") { ppjusNu = 0; } else { ppjusNu = parseInt(document.getElementById("valor18").value); }
	ppanju = document.getElementById("ppanju").value; if (ppanju == "") { ppanju = 0; } else { ppanju = parseInt(document.getElementById("ppanju").value); }
	ppanjuNu = document.getElementById("valor19").value; if (ppanjuNu == "") { ppanjuNu = 0; } else { ppanjuNu = parseInt(document.getElementById("valor19").value); }
	exgaeco = document.getElementById("exgaeco").value; if (exgaeco == "") { exgaeco = 0; } else { exgaeco = parseInt(document.getElementById("exgaeco").value); }
	exgaecoNu = document.getElementById("valor20").value; if (exgaecoNu == "") { exgaecoNu = 0; } else { exgaecoNu = parseInt(document.getElementById("valor20").value); }
	emvien = document.getElementById("emvien").value; if (emvien == "") { emvien = 0; } else { emvien = parseInt(document.getElementById("emvien").value); }
	emvienNu = document.getElementById("valor21").value; if (emvienNu == "") { emvienNu = 0; } else { emvienNu = parseInt(document.getElementById("valor21").value); }
	incuval = document.getElementById("incuval").value; if (incuval == "") { incuval = 0; } else { incuval = parseInt(document.getElementById("incuval").value); }
	incuvalNu = document.getElementById("valor22").value; if (incuvalNu == "") { incuvalNu = 0; } else { incuvalNu = parseInt(document.getElementById("valor22").value); }
	pssafj = document.getElementById("pssafj").value; if (pssafj == "") { pssafj = 0; } else { pssafj = parseInt(document.getElementById("pssafj").value); }
	pssafjNu = document.getElementById("valor23").value; if (pssafjNu == "") { pssafjNu = 0; } else { pssafjNu = parseInt(document.getElementById("valor23").value); }
	scviind = document.getElementById("scviind").value; if (scviind == "") { scviind = 0; } else { scviind = parseInt(document.getElementById("scviind").value); }
	scviindNu = document.getElementById("valor24").value; if (scviindNu == "") { scviindNu = 0; } else { scviindNu = parseInt(document.getElementById("valor24").value); }
	pcdrclug = document.getElementById("pcdrclug").value; if (pcdrclug == "") { pcdrclug = 0; } else { pcdrclug = parseInt(document.getElementById("pcdrclug").value); }
	pcdrclugNu = document.getElementById("valor25").value; if (pcdrclugNu == "") { pcdrclugNu = 0; } else { pcdrclugNu = parseInt(document.getElementById("valor25").value); }
	pccdper = document.getElementById("pccdper").value; if (pccdper == "") { pccdper = 0; } else { pccdper = parseInt(document.getElementById("pccdper").value); }
	pccdperNu = document.getElementById("valor26").value; if (pccdperNu == "") { pccdperNu = 0; } else { pccdperNu = parseInt(document.getElementById("valor26").value); }
	sindom = document.getElementById("sindom").value; if (sindom == "") { sindom = 0; } else { sindom = parseInt(document.getElementById("sindom").value); }
	sindomNu = document.getElementById("valor27").value; if (sindomNu == "") { sindomNu = 0; } else { sindomNu = parseInt(document.getElementById("valor27").value); }
	steeca = document.getElementById("steeca").value; if (steeca == "") { steeca = 0; } else { steeca = parseInt(document.getElementById("steeca").value); }
	steecaNu = document.getElementById("valor28").value; if (steecaNu == "") { steecaNu = 0; } else { steecaNu = parseInt(document.getElementById("valor28").value); }
	steapl = document.getElementById("steapl").value; if (steapl == "") { steapl = 0; } else { steapl = parseInt(document.getElementById("steapl").value); }
	steaplNu = document.getElementById("valor29").value; if (steaplNu == "") { steaplNu = 0; } else { steaplNu = parseInt(document.getElementById("valor29").value); }
	coloele = document.getElementById("coloele").value; if (coloele == "") { coloele = 0; } else { coloele = parseInt(document.getElementById("coloele").value); }
	coloeleNu = document.getElementById("valor30").value; if (coloeleNu == "") { coloeleNu = 0; } else { coloeleNu = parseInt(document.getElementById("valor30").value); }
	rpdmjd = document.getElementById("rpdmjd").value; if (rpdmjd == "") { rpdmjd = 0; } else { rpdmjd = parseInt(document.getElementById("rpdmjd").value); }
	rpdmjdNu = document.getElementById("valor31").value; if (rpdmjdNu == "") { rpdmjdNu = 0; } else { rpdmjdNu = parseInt(document.getElementById("valor31").value); }


	SDpapen = document.getElementById("SDpapen").value; if (SDpapen == "") { SDpapen = 0; } else { SDpapen = parseInt(document.getElementById("SDpapen").value); }
	SDpapenNu = document.getElementById("valor89").value; if (SDpapenNu == "") { SDpapenNu = 0; } else { SDpapenNu = parseInt(document.getElementById("valor89").value); }

	SDpmuImpu = document.getElementById("SDpmuImpu").value; if (SDpmuImpu == "") { SDpmuImpu = 0; } else { SDpmuImpu = parseInt(document.getElementById("SDpmuImpu").value); }
	SDpmuImpuNu = document.getElementById("valor99").value; if (SDpmuImpuNu == "") { SDpmuImpuNu = 0; } else { SDpmuImpuNu = parseInt(document.getElementById("valor99").value); }



	acrep = document.getElementById("acrep").value; if (acrep == "") { acrep = 0; } else { acrep = parseInt(document.getElementById("acrep").value); }
	acrepNu = document.getElementById("valor90").value; if (acrepNu == "") { acrepNu = 0; } else { acrepNu = parseInt(document.getElementById("valor90").value); }

	scpro = document.getElementById("scpro").value; if (scpro == "") { scpro = 0; } else { scpro = parseInt(document.getElementById("scpro").value); }/////////////////////////////////
	//scproceso = document.getElementById("scproceso").value;      if( scproceso == "" ){ scproceso = 0; } else { scproceso = parseInt(document.getElementById("scproceso").value);   }//////////////////////////////////
	scprocesoNu = document.getElementById("valor152").value; if (scprocesoNu == "") { scprocesoNu = 0; } else { scprocesoNu = parseInt(document.getElementById("valor152").value); }


	criopor = document.getElementById("criopor").value; if (criopor == "") { criopor = 0; } else { criopor = parseInt(document.getElementById("criopor").value); }
	crioporNu = document.getElementById("valor91").value; if (crioporNu == "") { crioporNu = 0; } else { crioporNu = parseInt(document.getElementById("valor91").value); }
	termant = document.getElementById("termant").value; if (termant == "") { termant = 0; } else { termant = parseInt(document.getElementById("termant").value); }
	termantNu = document.getElementById("valor93").value; if (termantNu == "") { termantNu = 0; } else { termantNu = parseInt(document.getElementById("valor93").value); }

	proabre = document.getElementById("proabre").value; if (proabre == "") { proabre = 0; } else { proabre = parseInt(document.getElementById("proabre").value); }///////////////////////////////////
	//proAbre = document.getElementById("proAbre").value;   if( proAbre == "" ){ proAbre = 0; } else { proAbre = parseInt(document.getElementById("proAbre").value);  }///////////////////////////////////
	proAbreNu = document.getElementById("valor153").value; if (proAbreNu == "") { proAbreNu = 0; } else { proAbreNu = parseInt(document.getElementById("valor153").value); }

	acu = document.getElementById("acu").value; if (acu == "") { acu = 0; } else { acu = parseInt(document.getElementById("acu").value); }
	acuNu = document.getElementById("valor32").value; if (acuNu == "") { acuNu = 0; } else { acuNu = parseInt(document.getElementById("valor32").value); }
	citac = document.getElementById("citac").value; if (citac == "") { citac = 0; } else { citac = parseInt(document.getElementById("citac").value); }
	citacNu = document.getElementById("valor33").value; if (citacNu == "") { citacNu = 0; } else { citacNu = parseInt(document.getElementById("valor33").value); }
	Cconc = document.getElementById("Cconc").value; if (Cconc == "") { Cconc = 0; } else { Cconc = parseInt(document.getElementById("Cconc").value); }
	CconcNu = document.getElementById("valor34").value; if (CconcNu == "") { CconcNu = 0; } else { CconcNu = parseInt(document.getElementById("valor34").value); }
	Cnega = document.getElementById("Cnega").value; if (Cnega == "") { Cnega = 0; } else { Cnega = parseInt(document.getElementById("Cnega").value); }
	CnegaNu = document.getElementById("valor35").value; if (CnegaNu == "") { CnegaNu = 0; } else { CnegaNu = parseInt(document.getElementById("valor35").value); }
	ONapre = document.getElementById("ONapre").value; if (ONapre == "") { ONapre = 0; } else { ONapre = parseInt(document.getElementById("ONapre").value); }
	ONapreNu = document.getElementById("valor36").value; if (ONapreNu == "") { ONapreNu = 0; } else { ONapreNu = parseInt(document.getElementById("valor36").value); }
	ONcomp = document.getElementById("ONcomp").value; if (ONcomp == "") { ONcomp = 0; } else { ONcomp = parseInt(document.getElementById("ONcomp").value); }
	ONcompNu = document.getElementById("valor38").value; if (ONcompNu == "") { ONcompNu = 0; } else { ONcompNu = parseInt(document.getElementById("valor38").value); }
	DRppa = document.getElementById("DRppa").value; if (DRppa == "") { DRppa = 0; } else { DRppa = parseInt(document.getElementById("DRppa").value); }
	DRppaNu = document.getElementById("valor40").value; if (DRppaNu == "") { DRppaNu = 0; } else { DRppaNu = parseInt(document.getElementById("valor40").value); }
	DRppd = document.getElementById("DRppd").value; if (DRppd == "") { DRppd = 0; } else { DRppd = parseInt(document.getElementById("DRppd").value); }
	DRppdNu = document.getElementById("valor41").value; if (DRppdNu == "") { DRppdNu = 0; } else { DRppdNu = parseInt(document.getElementById("valor41").value); }
	DRppmp = document.getElementById("DRppmp").value; if (DRppmp == "") { DRppmp = 0; } else { DRppmp = parseInt(document.getElementById("DRppmp").value); }
	DRppmpNu = document.getElementById("valor43").value; if (DRppmpNu == "") { DRppmpNu = 0; } else { DRppmpNu = parseInt(document.getElementById("valor43").value); }
	apenoadmi = document.getElementById("apenoadmi").value; if (apenoadmi == "") { apenoadmi = 0; } else { apenoadmi = parseInt(document.getElementById("apenoadmi").value); }
	apenoadmiNu = document.getElementById("valor44").value; if (apenoadmiNu == "") { apenoadmiNu = 0; } else { apenoadmiNu = parseInt(document.getElementById("valor44").value); }
	SDIrev = document.getElementById("SDIrev").value; if (SDIrev == "") { SDIrev = 0; } else { SDIrev = parseInt(document.getElementById("SDIrev").value); }
	SDIrevNu = document.getElementById("valor45").value; if (SDIrevNu == "") { SDIrevNu = 0; } else { SDIrevNu = parseInt(document.getElementById("valor45").value); }
	SDImod = document.getElementById("SDImod").value; if (SDImod == "") { SDImod = 0; } else { SDImod = parseInt(document.getElementById("SDImod").value); }
	SDImodNu = document.getElementById("valor46").value; if (SDImodNu == "") { SDImodNu = 0; } else { SDImodNu = parseInt(document.getElementById("valor46").value); }
	SDIconf = document.getElementById("SDIconf").value; if (SDIconf == "") { SDIconf = 0; } else { SDIconf = parseInt(document.getElementById("SDIconf").value); }
	SDIconfNu = document.getElementById("valor48").value; if (SDIconfNu == "") { SDIconfNu = 0; } else { SDIconfNu = parseInt(document.getElementById("valor48").value); }
	Reproc = document.getElementById("Reproc").value; if (Reproc == "") { Reproc = 0; } else { Reproc = parseInt(document.getElementById("Reproc").value); }
	ReprocNu = document.getElementById("valor49").value; if (ReprocNu == "") { ReprocNu = 0; } else { ReprocNu = parseInt(document.getElementById("valor49").value); }
	MJGorap = document.getElementById("MJGorap").value; if (MJGorap == "") { MJGorap = 0; } else { MJGorap = parseInt(document.getElementById("MJGorap").value); }
	MJGorapNu = document.getElementById("valor50").value; if (MJGorapNu == "") { MJGorapNu = 0; } else { MJGorapNu = parseInt(document.getElementById("valor50").value); }
	MJGorcomp = document.getElementById("MJGorcomp").value; if (MJGorcomp == "") { MJGorcomp = 0; } else { MJGorcomp = parseInt(document.getElementById("MJGorcomp").value); }
	MJGorcompNu = document.getElementById("valor53").value; if (MJGorcompNu == "") { MJGorcompNu = 0; } else { MJGorcompNu = parseInt(document.getElementById("valor53").value); }
	MJCorapre = document.getElementById("MJCorapre").value; if (MJCorapre == "") { MJCorapre = 0; } else { MJCorapre = parseInt(document.getElementById("MJCorapre").value); }
	MJCorapreNu = document.getElementById("valor57").value; if (MJCorapreNu == "") { MJCorapreNu = 0; } else { MJCorapreNu = parseInt(document.getElementById("valor57").value); }
	MJCordcomp = document.getElementById("MJCordcomp").value; if (MJCordcomp == "") { MJCordcomp = 0; } else { MJCordcomp = parseInt(document.getElementById("MJCordcomp").value); }
	MJCordcompNu = document.getElementById("valor58").value; if (MJCordcompNu == "") { MJCordcompNu = 0; } else { MJCordcompNu = parseInt(document.getElementById("valor58").value); }
	totAudiencias = document.getElementById("totAudiencias").value; if (totAudiencias == "") { totAudiencias = 0; } else { totAudiencias = parseInt(document.getElementById("totAudiencias").value); }
	totAudienciasNu = document.getElementById("valor60").value; if (totAudienciasNu == "") { totAudienciasNu = 0; } else { totAudienciasNu = parseInt(document.getElementById("valor60").value); }
	ACPREaie = document.getElementById("ACPREaie").value; if (ACPREaie == "") { ACPREaie = 0; } else { ACPREaie = parseInt(document.getElementById("ACPREaie").value); }
	ACPREaieNu = document.getElementById("valor61").value; if (ACPREaieNu == "") { ACPREaieNu = 0; } else { ACPREaieNu = parseInt(document.getElementById("valor61").value); }
	ACPREaio = document.getElementById("ACPREaio").value; if (ACPREaio == "") { ACPREaio = 0; } else { ACPREaio = parseInt(document.getElementById("ACPREaio").value); }
	ACPREaioNu = document.getElementById("valor63").value; if (ACPREaioNu == "") { ACPREaioNu = 0; } else { ACPREaioNu = parseInt(document.getElementById("valor63").value); }
	SOALscp = document.getElementById("SOALscp").value; if (SOALscp == "") { SOALscp = 0; } else { SOALscp = parseInt(document.getElementById("SOALscp").value); }
	SOALscpNu = document.getElementById("valor64").value; if (SOALscpNu == "") { SOALscpNu = 0; } else { SOALscpNu = parseInt(document.getElementById("valor64").value); }
	SOALarep = document.getElementById("SOALarep").value; if (SOALarep == "") { SOALarep = 0; } else { SOALarep = parseInt(document.getElementById("SOALarep").value); }
	SOALarepNu = document.getElementById("valor65").value; if (SOALarepNu == "") { SOALarepNu = 0; } else { SOALarepNu = parseInt(document.getElementById("valor65").value); }

	SENcon = document.getElementById("SENcon").value; if (SENcon == "") { SENcon = 0; } else { SENcon = parseInt(document.getElementById("SENcon").value); } ////////////////////////////////
	//condena = document.getElementById("condena").value;    if( condena == "" ){ condena = 0; }else { condena = parseInt(document.getElementById("condena").value);  } /////////////////////////////////
	condenaNu = document.getElementById("valor154").value; if (condenaNu == "") { condenaNu = 0; } else { condenaNu = parseInt(document.getElementById("valor154").value); }

	SENabsol = document.getElementById("SENabsol").value; if (SENabsol == "") { SENabsol = 0; } else { SENabsol = parseInt(document.getElementById("SENabsol").value); }
	SENabsolNu = document.getElementById("valor66").value; if (SENabsolNu == "") { SENabsolNu = 0; } else { SENabsolNu = parseInt(document.getElementById("valor66").value); }
	SENmixc = document.getElementById("SENmixc").value; if (SENmixc == "") { SENmixc = 0; } else { SENmixc = parseInt(document.getElementById("SENmixc").value); }
	SENmixcNu = document.getElementById("valor67").value; if (SENmixcNu == "") { SENmixcNu = 0; } else { SENmixcNu = parseInt(document.getElementById("valor67").value); }
	SENsreda = document.getElementById("SENsreda").value; if (SENsreda == "") { SENsreda = 0; } else { SENsreda = parseInt(document.getElementById("SENsreda").value); }
	SENsredaNu = document.getElementById("valor68").value; if (SENsredaNu == "") { SENsredaNu = 0; } else { SENsredaNu = parseInt(document.getElementById("valor68").value); }
	SENnocreda = document.getElementById("SENnocreda").value; if (SENnocreda == "") { SENnocreda = 0; } else { SENnocreda = parseInt(document.getElementById("SENnocreda").value); }
	SENnocredaNu = document.getElementById("valor69").value; if (SENnocredaNu == "") { SENnocredaNu = 0; } else { SENnocredaNu = parseInt(document.getElementById("valor69").value); }

	INCOMdecre = document.getElementById("INCOMdecre").value; if (INCOMdecre == "") { INCOMdecre = 0; } else { INCOMdecre = parseInt(document.getElementById("INCOMdecre").value); }
	INCOMdecreNu = document.getElementById("valor70").value; if (INCOMdecreNu == "") { INCOMdecreNu = 0; } else { INCOMdecreNu = parseInt(document.getElementById("valor70").value); }

	INCOMadmi = document.getElementById("INCOMadmi").value; if (INCOMadmi == "") { INCOMadmi = 0; } else { INCOMadmi = parseInt(document.getElementById("INCOMadmi").value); }
	INCOMadmiNu = document.getElementById("valor71").value; if (INCOMadmiNu == "") { INCOMadmiNu = 0; } else { INCOMadmiNu = parseInt(document.getElementById("valor71").value); }
	ARJnap = document.getElementById("ARJnap").value; if (ARJnap == "") { ARJnap = 0; } else { ARJnap = parseInt(document.getElementById("ARJnap").value); }
	ARJnapNu = document.getElementById("valor72").value; if (ARJnapNu == "") { ARJnapNu = 0; } else { ARJnapNu = parseInt(document.getElementById("valor72").value); }
	ARJnar = document.getElementById("ARJnar").value; if (ARJnar == "") { ARJnar = 0; } else { ARJnar = parseInt(document.getElementById("ARJnar").value); }
	ARJnarNu = document.getElementById("valor73").value; if (ARJnarNu == "") { ARJnarNu = 0; } else { ARJnarNu = parseInt(document.getElementById("valor73").value); }
	ARJncoap = document.getElementById("ARJncoap").value; if (ARJncoap == "") { ARJncoap = 0; } else { ARJncoap = parseInt(document.getElementById("ARJncoap").value); }
	ARJncoapNu = document.getElementById("valor74").value; if (ARJncoapNu == "") { ARJncoapNu = 0; } else { ARJncoapNu = parseInt(document.getElementById("valor74").value); }
	ARJnoc = document.getElementById("ARJnoc").value; if (ARJnoc == "") { ARJnoc = 0; } else { ARJnoc = parseInt(document.getElementById("ARJnoc").value); }
	ARJnocNu = document.getElementById("valor75").value; if (ARJnocNu == "") { ARJnocNu = 0; } else { ARJnocNu = parseInt(document.getElementById("valor75").value); }
	ARJppmc = document.getElementById("ARJppmc").value; if (ARJppmc == "") { ARJppmc = 0; } else { ARJppmc = parseInt(document.getElementById("ARJppmc").value); }
	ARJppmcNu = document.getElementById("valor76").value; if (ARJppmcNu == "") { ARJppmcNu = 0; } else { ARJppmcNu = parseInt(document.getElementById("valor76").value); }
	ARJtps = document.getElementById("ARJtps").value; if (ARJtps == "") { ARJtps = 0; } else { ARJtps = parseInt(document.getElementById("ARJtps").value); }
	ARJtpsNu = document.getElementById("valor77").value; if (ARJtpsNu == "") { ARJtpsNu = 0; } else { ARJtpsNu = parseInt(document.getElementById("valor77").value); }
	ARJrvp = document.getElementById("ARJrvp").value; if (ARJrvp == "") { ARJrvp = 0; } else { ARJrvp = parseInt(document.getElementById("ARJrvp").value); }
	ARJrvpNu = document.getElementById("valor78").value; if (ARJrvpNu == "") { ARJrvpNu = 0; } else { ARJrvpNu = parseInt(document.getElementById("valor78").value); }
	ARJrnscp = document.getElementById("ARJrnscp").value; if (ARJrnscp == "") { ARJrnscp = 0; } else { ARJrnscp = parseInt(document.getElementById("ARJrnscp").value); }
	ARJrnscpNu = document.getElementById("valor79").value; if (ARJrnscpNu == "") { ARJrnscpNu = 0; } else { ARJrnscpNu = parseInt(document.getElementById("valor79").value); }
	ARJnapa = document.getElementById("ARJnapa").value; if (ARJnapa == "") { ARJnapa = 0; } else { ARJnapa = parseInt(document.getElementById("ARJnapa").value); }
	ARJnapaNu = document.getElementById("valor80").value; if (ARJnapaNu == "") { ARJnapaNu = 0; } else { ARJnapaNu = parseInt(document.getElementById("valor80").value); }
	ARJsdpa = document.getElementById("ARJsdpa").value; if (ARJsdpa == "") { ARJsdpa = 0; } else { ARJsdpa = parseInt(document.getElementById("ARJsdpa").value); }
	ARJsdpaNu = document.getElementById("valor81").value; if (ARJsdpaNu == "") { ARJsdpaNu = 0; } else { ARJsdpaNu = parseInt(document.getElementById("valor81").value); }
	ARJemp = document.getElementById("ARJemp").value; if (ARJemp == "") { ARJemp = 0; } else { ARJemp = parseInt(document.getElementById("ARJemp").value); }
	ARJempNu = document.getElementById("valor82").value; if (ARJempNu == "") { ARJempNu = 0; } else { ARJempNu = parseInt(document.getElementById("valor82").value); }
	ARTEdap = document.getElementById("ARTEdap").value; if (ARTEdap == "") { ARTEdap = 0; } else { ARTEdap = parseInt(document.getElementById("ARTEdap").value); }
	ARTEdapNu = document.getElementById("valor83").value; if (ARTEdapNu == "") { ARTEdapNu = 0; } else { ARTEdapNu = parseInt(document.getElementById("valor83").value); }
	ARTEsd = document.getElementById("ARTEsd").value; if (ARTEsd == "") { ARTEsd = 0; } else { ARTEsd = parseInt(document.getElementById("ARTEsd").value); }
	ARTEsdNu = document.getElementById("valor84").value; if (ARTEsdNu == "") { ARTEsdNu = 0; } else { ARTEsdNu = parseInt(document.getElementById("valor84").value); }
	DSEDrfmp = document.getElementById("DSEDrfmp").value; if (DSEDrfmp == "") { DSEDrfmp = 0; } else { DSEDrfmp = parseInt(document.getElementById("DSEDrfmp").value); }
	DSEDrfmpNu = document.getElementById("valor85").value; if (DSEDrfmpNu == "") { DSEDrfmpNu = 0; } else { DSEDrfmpNu = parseInt(document.getElementById("valor85").value); }
	DSEDmfmp = document.getElementById("DSEDmfmp").value; if (DSEDmfmp == "") { DSEDmfmp = 0; } else { DSEDmfmp = parseInt(document.getElementById("DSEDmfmp").value); }
	DSEDmfmpNu = document.getElementById("valor86").value; if (DSEDmfmpNu == "") { DSEDmfmpNu = 0; } else { DSEDmfmpNu = parseInt(document.getElementById("valor86").value); }
	DSEDcfmp = document.getElementById("DSEDcfmp").value; if (DSEDcfmp == "") { DSEDcfmp = 0; } else { DSEDcfmp = parseInt(document.getElementById("DSEDcfmp").value); }
	DSEDcfmpNu = document.getElementById("valor87").value; if (DSEDcfmpNu == "") { DSEDcfmpNu = 0; } else { DSEDcfmpNu = parseInt(document.getElementById("valor87").value); }
	csjdsm = document.getElementById("csjdsm").value; if (csjdsm == "") { csjdsm = 0; } else { csjdsm = parseInt(document.getElementById("csjdsm").value); }
	csjdsmNu = document.getElementById("valor88").value; if (csjdsmNu == "") { csjdsmNu = 0; } else { csjdsmNu = parseInt(document.getElementById("valor88").value); }

	/*Nuevos campos*/
	OSapre = document.getElementById("OSapre").value; if (OSapre == "") { OSapre = 0; } else { OSapre = parseInt(document.getElementById("OSapre").value); }
	OSapreNu = document.getElementById("valor112").value; if (OSapreNu == "") { OSapreNu = 0; } else { OSapreNu = parseInt(document.getElementById("valor112").value); }
	OScomp = document.getElementById("OScomp").value; if (OScomp == "") { OScomp = 0; } else { OScomp = parseInt(document.getElementById("OScomp").value); }
	OScompNu = document.getElementById("valor113").value; if (OScompNu == "") { OScompNu = 0; } else { OScompNu = parseInt(document.getElementById("valor113").value); }
	medidasProteccion = document.getElementById("medidasProteccion").value; if (medidasProteccion == "") { medidasProteccion = 0; } else { medidasProteccion = parseInt(document.getElementById("medidasProteccion").value); }
	medidasProteccionNu = document.getElementById("valor129").value; if (medidasProteccionNu == "") { medidasProteccionNu = 0; } else { medidasProteccionNu = parseInt(document.getElementById("valor129").value); }
	MPV = document.getElementById("MPV").value; if (MPV == "") { MPV = 0; } else { MPV = parseInt(document.getElementById("MPV").value); }
	intervencionTR = document.getElementById("intervencionTR").value; if (intervencionTR == "") { intervencionTR = 0; } else { intervencionTR = parseInt(document.getElementById("intervencionTR").value); }
	intervencionTRNu = document.getElementById("valor114").value; if (intervencionTRNu == "") { intervencionTRNu = 0; } else { intervencionTRNu = parseInt(document.getElementById("valor114").value); }
	tomaMuestras = document.getElementById("tomaMuestras").value; if (tomaMuestras == "") { tomaMuestras = 0; } else { tomaMuestras = parseInt(document.getElementById("tomaMuestras").value); }
	tomaMuestrasNu = document.getElementById("valor115").value; if (tomaMuestrasNu == "") { tomaMuestrasNu = 0; } else { tomaMuestrasNu = parseInt(document.getElementById("valor115").value); }
	exhumacion = document.getElementById("exhumacion").value; if (exhumacion == "") { exhumacion = 0; } else { exhumacion = parseInt(document.getElementById("exhumacion").value); }
	exhumacionNu = document.getElementById("valor116").value; if (exhumacionNu == "") { exhumacionNu = 0; } else { exhumacionNu = parseInt(document.getElementById("valor116").value); }
	obDatosReservados = document.getElementById("obDatosReservados").value; if (obDatosReservados == "") { obDatosReservados = 0; } else { obDatosReservados = parseInt(document.getElementById("obDatosReservados").value); }
	obDatosReservadosNu = document.getElementById("valor117").value; if (obDatosReservadosNu == "") { obDatosReservadosNu = 0; } else { obDatosReservadosNu = parseInt(document.getElementById("valor117").value); }
	intervencionCME = document.getElementById("intervencionCME").value; if (intervencionCME == "") { intervencionCME = 0; } else { intervencionCME = parseInt(document.getElementById("intervencionCME").value); }
	intervencionCMENu = document.getElementById("valor119").value; if (intervencionCMENu == "") { intervencionCMENu = 0; } else { intervencionCMENu = parseInt(document.getElementById("valor119").value); }
	provPrecautoria = document.getElementById("provPrecautoria").value; if (provPrecautoria == "") { provPrecautoria = 0; } else { provPrecautoria = parseInt(document.getElementById("provPrecautoria").value); }
	provPrecautoriaNu = document.getElementById("valor120").value; if (provPrecautoriaNu == "") { provPrecautoriaNu = 0; } else { provPrecautoriaNu = parseInt(document.getElementById("valor120").value); }
	cadCustodia = document.getElementById("cadCustodia").value; if (cadCustodia == "") { cadCustodia = 0; } else { cadCustodia = parseInt(document.getElementById("cadCustodia").value); }
	cadCustodiaNu = document.getElementById("valor121").value; if (cadCustodiaNu == "") { cadCustodiaNu = 0; } else { cadCustodiaNu = parseInt(document.getElementById("valor121").value); }
	InspLugDis = document.getElementById("InspLugDis").value; if (InspLugDis == "") { InspLugDis = 0; } else { InspLugDis = parseInt(document.getElementById("InspLugDis").value); }
	InspLugDisNu = document.getElementById("valor122").value; if (InspLugDisNu == "") { InspLugDisNu = 0; } else { InspLugDisNu = parseInt(document.getElementById("valor122").value); }
	InspInmuebles = document.getElementById("InspInmuebles").value; if (InspInmuebles == "") { InspInmuebles = 0; } else { InspInmuebles = parseInt(document.getElementById("InspInmuebles").value); }
	InspInmueblesNu = document.getElementById("valor123").value; if (InspInmueblesNu == "") { InspInmueblesNu = 0; } else { InspInmueblesNu = parseInt(document.getElementById("valor123").value); }
	entrevistasTestigos = document.getElementById("entrevistasTestigos").value; if (entrevistasTestigos == "") { entrevistasTestigos = 0; } else { entrevistasTestigos = parseInt(document.getElementById("entrevistasTestigos").value); }
	entrevistasTestigosNu = document.getElementById("valor124").value; if (entrevistasTestigosNu == "") { entrevistasTestigosNu = 0; } else { entrevistasTestigosNu = parseInt(document.getElementById("valor124").value); }
	reconocimientoPer = document.getElementById("reconocimientoPer").value; if (reconocimientoPer == "") { reconocimientoPer = 0; } else { reconocimientoPer = parseInt(document.getElementById("reconocimientoPer").value); }
	reconocimientoPerNu = document.getElementById("valor125").value; if (reconocimientoPerNu == "") { reconocimientoPerNu = 0; } else { reconocimientoPerNu = parseInt(document.getElementById("valor125").value); }
	solInfoPericiales = document.getElementById("solInfoPericiales").value; if (solInfoPericiales == "") { solInfoPericiales = 0; } else { solInfoPericiales = parseInt(document.getElementById("solInfoPericiales").value); }
	solInfoPericialesNu = document.getElementById("valor126").value; if (solInfoPericialesNu == "") { solInfoPericialesNu = 0; } else { solInfoPericialesNu = parseInt(document.getElementById("valor126").value); }
	InfInstiSeg = document.getElementById("InfInstiSeg").value; if (InfInstiSeg == "") { InfInstiSeg = 0; } else { InfInstiSeg = parseInt(document.getElementById("InfInstiSeg").value); }
	InfInstiSegNu = document.getElementById("valor127").value; if (InfInstiSegNu == "") { InfInstiSegNu = 0; } else { InfInstiSegNu = parseInt(document.getElementById("valor127").value); }
	examenFisPersona = document.getElementById("examenFisPersona").value; if (examenFisPersona == "") { examenFisPersona = 0; } else { examenFisPersona = parseInt(document.getElementById("examenFisPersona").value); }
	examenFisPersonaNu = document.getElementById("valor128").value; if (examenFisPersonaNu == "") { examenFisPersonaNu = 0; } else { examenFisPersonaNu = parseInt(document.getElementById("valor128").value); }
	audJuiOral = document.getElementById("audJuiOral").value; if (audJuiOral == "") { audJuiOral = 0; } else { audJuiOral = parseInt(document.getElementById("audJuiOral").value); }
	audJuiOralNu = document.getElementById("valor140").value; if (audJuiOralNu == "") { audJuiOralNu = 0; } else { audJuiOralNu = parseInt(document.getElementById("valor140").value); }
	audFallo = document.getElementById("audFallo").value; if (audFallo == "") { audFallo = 0; } else { audFallo = parseInt(document.getElementById("audFallo").value); }
	audFalloNu = document.getElementById("valor139").value; if (audFalloNu == "") { audFalloNu = 0; } else { audFalloNu = parseInt(document.getElementById("valor139").value); }
	absolutorio = document.getElementById("absolutorio").value; if (absolutorio == "") { absolutorio = 0; } else { absolutorio = parseInt(document.getElementById("absolutorio").value); }
	absolutorioNu = document.getElementById("valor141").value; if (absolutorioNu == "") { absolutorioNu = 0; } else { absolutorioNu = parseInt(document.getElementById("valor141").value); }
	AudIndiSan = document.getElementById("AudIndiSan").value; if (AudIndiSan == "") { AudIndiSan = 0; } else { AudIndiSan = parseInt(document.getElementById("AudIndiSan").value); }
	AudIndiSanNu = document.getElementById("valor144").value; if (AudIndiSanNu == "") { AudIndiSanNu = 0; } else { AudIndiSanNu = parseInt(document.getElementById("valor144").value); }
	procEspecial = document.getElementById("procEspecial").value; if (procEspecial == "") { procEspecial = 0; } else { procEspecial = parseInt(document.getElementById("procEspecial").value); }
	procEspecialNu = document.getElementById("valor145").value; if (procEspecialNu == "") { procEspecialNu = 0; } else { procEspecialNu = parseInt(document.getElementById("valor145").value); }
	audCondenatorio = document.getElementById("audCondenatorio").value; if (audCondenatorio == "") { audCondenatorio = 0; } else { audCondenatorio = parseInt(document.getElementById("audCondenatorio").value); }
	audCondenatorioNu = document.getElementById("valor142").value; if (audCondenatorioNu == "") { audCondenatorioNu = 0; } else { audCondenatorioNu = parseInt(document.getElementById("valor142").value); }
	mecanismosAceleracion = document.getElementById("mecanismosAceleracion").value; if (mecanismosAceleracion == "") { mecanismosAceleracion = 0; } else { mecanismosAceleracion = parseInt(document.getElementById("mecanismosAceleracion").value); }
	mecanismosAceleracionNu = document.getElementById("valor146").value; if (mecanismosAceleracionNu == "") { mecanismosAceleracionNu = 0; } else { mecanismosAceleracionNu = parseInt(document.getElementById("valor146").value); }
	apeamparo = document.getElementById("apeamparo").value; if (apeamparo == "") { apeamparo = 0; } else { apeamparo = parseInt(document.getElementById("apeamparo").value); }
	apeamparoNu = document.getElementById("valor147").value; if (apeamparoNu == "") { apeamparoNu = 0; } else { apeamparoNu = parseInt(document.getElementById("valor147").value); }
	amparoDirecto = document.getElementById("amparoDirecto").value; if (amparoDirecto == "") { amparoDirecto = 0; } else { amparoDirecto = parseInt(document.getElementById("amparoDirecto").value); }
	amparoDirectoNu = document.getElementById("valor148").value; if (amparoDirectoNu == "") { amparoDirectoNu = 0; } else { amparoDirectoNu = parseInt(document.getElementById("valor148").value); }
	amparoIndirecto = document.getElementById("amparoIndirecto").value; if (amparoIndirecto == "") { amparoIndirecto = 0; } else { amparoIndirecto = parseInt(document.getElementById("amparoIndirecto").value); }
	amparoIndirectoNu = document.getElementById("valor149").value; if (amparoIndirectoNu == "") { amparoIndirectoNu = 0; } else { amparoIndirectoNu = parseInt(document.getElementById("valor149").value); }

	var arrayCamposData = [cdete, sdete, FIsolic, FIotor, FInega, legal, ilegal, aunvinc, mix, MCsol, MCotor, MCnega, ppofic, ppjus, ppanju, exgaeco, emvien, incuval, pssafj, scviind, pcdrclug, pccdper, sindom, steeca, steapl, coloele, rpdmjd, SDpapen, SDpmuImpu, acrep, criopor, termant, acu, citac, Cconc, Cnega, ONapre, ONcomp, DRppa, DRppd, DRppmp, apenoadmi, SDIrev, SDImod, SDIconf, Reproc, MJGorap, MJGorcomp,
		MJCorapre, MJCordcomp, totAudiencias, ACPREaie, ACPREaio, SOALscp, SOALarep, SENabsol, SENmixc, SENsreda, SENnocreda, INCOMdecre, INCOMadmi, ARJnap, ARJnar, ARJncoap, ARJnoc, ARJppmc, ARJtps, ARJrvp, ARJrnscp, ARJnapa, ARJsdpa, ARJemp, ARTEdap, ARTEsd, DSEDrfmp, DSEDmfmp, DSEDcfmp, csjdsm, OSapre, OScomp, medidasProteccion, intervencionTR, tomaMuestras, exhumacion, obDatosReservados,
		intervencionCME, provPrecautoria, cadCustodia, InspLugDis, InspInmuebles, entrevistasTestigos, reconocimientoPer, solInfoPericiales, InfInstiSeg, examenFisPersona, audJuiOral, audFallo, absolutorio, AudIndiSan, procEspecial, audCondenatorio, mecanismosAceleracion, apeamparo, amparoDirecto, amparoIndirecto, auvinc, scpro, proabre, SENcon];

	var arrayNucsData = [cdeteNu, sdeteNu, FIsolicNu, FIotorNU, FInegaNu, legalNu, ilegalNu, aunvincNu, mixNu, MCsolNu, MCotorNu, MCnegaNu, ppoficNu, ppjusNu, ppanjuNu, exgaecoNu, emvienNu, incuvalNu, pssafjNu, scviindNu, pcdrclugNu, pccdperNu, sindomNu, steecaNu, steaplNu, coloeleNu, rpdmjdNu, SDpapenNu, SDpmuImpuNu, acrepNu, crioporNu, termantNu, acuNu, citacNu, CconcNu, CnegaNu, ONapreNu, ONcompNu, DRppaNu,
		DRppdNu, DRppmpNu, apenoadmiNu, SDIrevNu, SDImodNu, SDIconfNu, ReprocNu, MJGorapNu, MJGorcompNu, MJCorapreNu, MJCordcompNu, totAudienciasNu, ACPREaieNu, ACPREaioNu, SOALscpNu, SOALarepNu, SENabsolNu, SENmixcNu, SENsredaNu, SENnocredaNu, INCOMdecreNu, INCOMadmiNu, ARJnapNu, ARJnarNu, ARJncoapNu, ARJnocNu, ARJppmcNu, ARJtpsNu, ARJrvpNu, ARJrnscpNu, ARJnapaNu, ARJsdpaNu, ARJempNu, ARTEdapNu,
		ARTEsdNu, DSEDrfmpNu, DSEDmfmpNu, DSEDcfmpNu, csjdsmNu, OSapreNu, OScompNu, medidasProteccionNu, intervencionTRNu, tomaMuestrasNu, exhumacionNu, obDatosReservadosNu, intervencionCMENu, provPrecautoriaNu, cadCustodiaNu, InspLugDisNu, InspInmueblesNu, entrevistasTestigosNu, reconocimientoPerNu, solInfoPericialesNu, InfInstiSegNu, examenFisPersonaNu, audJuiOralNu, audFalloNu, absolutorioNu,
		AudIndiSanNu, procEspecialNu, audCondenatorioNu, mecanismosAceleracionNu, apeamparoNu, amparoDirectoNu, amparoIndirectoNu, vincprocesoNU, scprocesoNu, proAbreNu, condenaNu];

	var arrayCheckicon = ["checCdeten", "checSdeten", "checkFIsolic", "checkFIotor", "checkFInega", "checklegal", "checkilegal", "checkaunvinc", "checkmix", "checkMCsol", "checkMCotor", "checkMCnega", "checkppofic", "checkppjus", "checkppanju", "checkexgaeco", "checkemvien", "checkincuval", "checkpssafj", "checkscviind", "checkpcdrclug", "checkpccdper", "checksindom", "checksteeca", "checksteapl", "checkcoloele",
		"checkrpdmjd", "checkSDpapen", "checkSDpmuImpu", "checkCacrep", "checkcriopor", "checktermant", "checkacu", "checkcitac", "checkCconc", "checkCnega", "checkONapre", "checkONcomp", "checkDRppa", "checkDRppd", "checkDRppmp", "checkapenoadmi", "checkSDIrev", "checkSDImod", "checkSDIconf", "checkReproc", "checkMJGorap", "checkMJGorcomp", "checkMJCorapre", "checkMJCordcomp", "checktotAudiencias",
		"checkACPREaie", "checkACPREaio", "checkSOALscp", "checkSOALarep", "checkSENabsol", "checkSENmixc", "checkSENsreda", "checkSENnocreda", "checkINCOMdecre", "checkINCOMadmi", "checkARJnap", "checkARJnar", "checkARJncoap", "checkARJnoc", "checkARJppmc", "checkARJtps", "checkARJrvp", "checkARJrnscp", "checkSARJnapa", "checkARJsdpa", "checkARJemp", "checkARTEdap", "checkARTEsd", "checkDSEDrfmp",
		"checkDSEDmfmp", "checkDSEDcfmp", "checkcsjdsm", "checkOSapre", "checkOScomp", "checkMedidasProteccion", "checkIntervencionTR", "checkTomaMuestras", "checkExhumacion", "checkObDatosReservados", "checkIntervencionCME", "checkProvPrecautoria", "checkCadCustodia", "checkInspLugDis", "checkInspInmuebles", "checkEntrevistasTestigos", "checkReconocimientoPer", "checkSolInfoPericiales",
		"checkInfInstiSeg", "checkExamenFisPersona", "checkAudJuiOral", "checkAudFallo", "checkAbsolutorio", "checkAIDS", "checkProcEspecial", "checkAudCondenatorio", "checkMecanismoAcele", "checkapeamparo", "checkAmparoDirecto", "checkAmparoIndirecto", "checkauvinc", "checkscpro", "checkproabre", "checkSENcon"];

	//alert(INCOMdecre+"-"+INCOMdecreNu);

	if (SDpmuImpu == SDpmuImpu && cdete == cdeteNu && sdete == sdeteNu && FIsolic == FIsolicNu && FIotor == FIotorNU && FInega == FInegaNu && legal == legalNu && ilegal == ilegalNu && criopor == crioporNu && aunvinc == aunvincNu && mix == mixNu && MCsol == MCsolNu && MCotor == MCotorNu && MCnega == MCnegaNu && ppofic == ppoficNu && ppjus == ppjusNu && ppanju == ppanjuNu && exgaeco == exgaecoNu && emvien == emvienNu && incuval == incuvalNu && pssafj == pssafjNu && scviind == scviindNu && pcdrclug == pcdrclugNu && pccdper == pccdperNu && sindom == sindomNu && steeca == steecaNu && steapl == steaplNu && coloele == coloeleNu && rpdmjd == rpdmjdNu && SDpapen == SDpapenNu && acrep == acrepNu && termant == termantNu && acu == acuNu && citac == citacNu && Cconc == CconcNu && Cnega == CnegaNu && ONapre == ONapreNu && ONcomp == ONcompNu && DRppa == DRppaNu && DRppd == DRppdNu && DRppmp == DRppmpNu && apenoadmi == apenoadmiNu && SDIrev == SDIrevNu && SDImod == SDImodNu && SDIconf == SDIconfNu && Reproc == ReprocNu && MJGorap == MJGorapNu && MJGorcomp == MJGorcompNu && MJCorapre == MJCorapreNu && MJCordcomp == MJCordcompNu && totAudiencias == totAudienciasNu && ACPREaie == ACPREaieNu && ACPREaio == ACPREaioNu && SOALscp == SOALscpNu && SOALarep == SOALarepNu && SENabsol == SENabsolNu && SENmixc == SENmixcNu && SENsreda == SENsredaNu && SENnocreda == SENnocredaNu && INCOMdecre == INCOMdecreNu && INCOMadmi == INCOMadmiNu && ARJnap == ARJnapNu && ARJnar == ARJnarNu && ARJncoap == ARJncoapNu && ARJnoc == ARJnocNu && ARJppmc == ARJppmcNu && ARJtps == ARJtpsNu && ARJrvp == ARJrvpNu && ARJrnscp == ARJrnscpNu && ARJnapa == ARJnapaNu && ARJsdpa == ARJsdpaNu && ARJemp == ARJempNu && ARTEdap == ARTEdapNu && ARTEsd == ARTEsdNu && DSEDrfmp == DSEDrfmpNu && DSEDmfmp == DSEDmfmpNu && DSEDcfmp == DSEDcfmpNu && csjdsm == csjdsmNu && auvinc == vincprocesoNU && scpro == scprocesoNu && proabre == proAbreNu && SENcon == condenaNu && OSapre == OSapreNu && OScomp == OScompNu && medidasProteccion == medidasProteccionNu && intervencionTR == intervencionTRNu && tomaMuestras == tomaMuestrasNu && exhumacion == exhumacionNu && obDatosReservados == obDatosReservadosNu && intervencionCME == intervencionCMENu && provPrecautoria == provPrecautoriaNu && provPrecautoria == provPrecautoriaNu && cadCustodia == cadCustodiaNu && InspInmuebles == InspInmueblesNu && entrevistasTestigos == entrevistasTestigosNu && reconocimientoPer == reconocimientoPerNu && solInfoPericiales == solInfoPericialesNu && InfInstiSeg == InfInstiSegNu && examenFisPersona == examenFisPersonaNu && audJuiOral == audJuiOralNu && audFallo == audFalloNu && absolutorio == absolutorioNu && AudIndiSan == AudIndiSanNu && procEspecial == procEspecialNu && audCondenatorio == audCondenatorioNu && mecanismosAceleracion == mecanismosAceleracionNu && apeamparo == apeamparoNu && amparoDirecto == amparoDirectoNu && InspLugDis == InspLugDisNu) {
		//cont = document.getElementById('respuestaGuardalitig');    
		ajax = objetoAjax();
		ajax.open("POST", "format/litigacion/guardarLitigacion.php");
		ajax.onreadystatechange = function () {

			if (ajax.readyState == 4 && ajax.status == 200) {
				//cont.innerHTML = ajax.responseText;
				var json = ajax.responseText;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
					if (obj.first == "SI") {
						swal("", "Se Actualizo Exitosamente.", "success");
						for (x = 0; x < arrayCamposData.length; x++) {
							if (arrayCamposData[x] != arrayNucsData[x]) { cont = document.getElementById(arrayCheckicon[x]); cont.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; } else {
								cont = document.getElementById(arrayCheckicon[x]); cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";
							}
						}
						//if(auvinc  !=  vincproceso){ cont = document.getElementById("checkauvinc");   cont.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont = document.getElementById("checkauvinc");   cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
						//if(scpro  !=  scproceso){ cont = document.getElementById("checkscpro");   cont.innerHTML = "<i style='color:orange; cursor:pointer; ' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont = document.getElementById("checkscpro");   cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
						//if(proabre  !=  proAbre){ cont = document.getElementById("checkproabre");   cont.innerHTML = "<i style='color:orange; cursor:pointer; ' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont = document.getElementById("checkproabre");   cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
						//if(SENcon  !=  condena){ cont = document.getElementById("checkSENcon");   cont.innerHTML = "<i style='color:orange; cursor:pointer; ' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont = document.getElementById("checkSENcon");   cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }

					}
				}
			}

		}

		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("&idUnidad=" + idUnidad + "&idEnlace=" + idEnlace + "&idMp=" + idMp + "&mes=" + mes + "&anio=" + anio + "&tramAnt=" + tramAnt + "&cdete=" + cdete + "&sdete=" + sdete + "&FIsolic=" + FIsolic + "&FIotor=" + FIotor + "&FInega=" + FInega + "&auvinc="
			+ auvinc + "&aunvinc=" + aunvinc + "&mix=" + mix + "&MCsol=" + MCsol + "&MCotor=" + MCotor + "&MCnega=" + MCnega + "&ppofic=" + ppofic + "&ppjus="
			+ ppjus + "&ppanju=" + ppanju + "&exgaeco=" + exgaeco + "&emvien=" + emvien + "&incuval=" + incuval + "&pssafj=" + pssafj + "&scviind="
			+ scviind + "&pcdrclug=" + pcdrclug + "&pccdper=" + pccdper + "&sindom=" + sindom + "&steeca=" + steeca + "&steapl=" + steapl + "&coloele=" + coloele + "&rpdmjd=" + rpdmjd + "&SDpapen=" + SDpapen + "&acrep=" + acrep
			+ "&scpro=" + scpro + "&criopor=" + criopor + "&termant=" + termant + "&proabre=" + proabre + "&acu=" + acu + "&citac=" + citac + "&Cconc=" + Cconc + "&Cnega=" + Cnega + "&ONapre=" + ONapre + "&ONcomp=" + ONcomp
			+ "&DRppa=" + DRppa + "&DRppd=" + DRppd + "&DRppmp=" + DRppmp + "&apenoadmi=" + apenoadmi + "&SDIrev=" + SDIrev + "&SDImod=" + SDImod + "&SDIconf=" + SDIconf + "&Reproc=" + Reproc + "&MJGorap=" + MJGorap + "&MJGorcomp=" + MJGorcomp
			+ "&MJCorapre=" + MJCorapre + "&MJCordcomp=" + MJCordcomp + "&totAudiencias=" + totAudiencias + "&ACPREaie=" + ACPREaie + "&ACPREaio=" + ACPREaio + "&SOALscp=" + SOALscp + "&SOALarep=" + SOALarep + "&SENcon=" + SENcon + "&SENabsol=" + SENabsol + "&SENmixc=" + SENmixc
			+ "&SENsreda=" + SENsreda + "&SENnocreda=" + SENnocreda + "&INCOMdecre=" + INCOMdecre + "&INCOMadmi=" + INCOMadmi + "&ARJnap=" + ARJnap + "&ARJnar=" + ARJnar + "&ARJncoap=" + ARJncoap + "&ARJnoc=" + ARJnoc + "&ARJppmc=" + ARJppmc + "&ARJtps=" + ARJtps
			+ "&ARJrvp=" + ARJrvp + "&ARJrnscp=" + ARJrnscp + "&ARJnapa=" + ARJnapa + "&ARJsdpa=" + ARJsdpa + "&ARJemp=" + ARJemp + "&ARTEdap=" + ARTEdap + "&ARTEsd=" + ARTEsd + "&DSEDrfmp=" + DSEDrfmp + "&DSEDmfmp=" + DSEDmfmp + "&DSEDcfmp=" + DSEDcfmp + "&csjdsm=" + csjdsm + "&legal=" + legal + "&ilegal=" + ilegal + "&SDpmuImpu=" + SDpmuImpu + "&recibiOtmp=" + recibiOtmp + "&cesefunciones=" + cesefunciones
			+ "&OSapre=" + OSapre + "&OScomp=" + OScomp + "&medidasProteccion=" + medidasProteccion + "&MPV=" + MPV + "&intervencionTR=" + intervencionTR + "&tomaMuestras=" + tomaMuestras + "&exhumacion=" + exhumacion + "&obDatosReservados=" + obDatosReservados + "&intervencionCME=" + intervencionCME + "&provPrecautoria=" + provPrecautoria + "&cadCustodia=" + cadCustodia
			+ "&InspLugDis=" + InspLugDis + "&InspInmuebles=" + InspInmuebles + "&entrevistasTestigos=" + entrevistasTestigos + "&reconocimientoPer=" + reconocimientoPer + "&solInfoPericiales=" + solInfoPericiales + "&InfInstiSeg=" + InfInstiSeg + "&examenFisPersona=" + examenFisPersona + "&audJuiOral=" + audJuiOral + "&audFallo=" + audFallo + "&absolutorio=" + absolutorio
			+ "&AudIndiSan=" + AudIndiSan + "&procEspecial=" + procEspecial + "&audCondenatorio=" + audCondenatorio + "&mecanismosAceleracion=" + mecanismosAceleracion + "&apeamparo=" + apeamparo + "&amparoDirecto=" + amparoDirecto + "&amparoIndirecto=" + amparoIndirecto);

	} else {

		swal("", "Los datos no coinciden favor de verificar.", "warning");

		for (x = 0; x < arrayCamposData.length; x++) {

			if (arrayCamposData[x] != arrayNucsData[x]) { cont = document.getElementById(arrayCheckicon[x]); cont.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; } else {
				cont = document.getElementById(arrayCheckicon[x]); cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";
			}
		}

		//if(auvinc  !=  vincproceso){ cont = document.getElementById("checkauvinc");   cont.innerHTML = "<i style='color:orange; cursor:pointer; ' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont = document.getElementById("checkauvinc");   cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
		//if(scpro  !=  scproceso){ cont = document.getElementById("checkscpro");   cont.innerHTML = "<i style='color:orange; cursor:pointer; ' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont = document.getElementById("checkscpro");   cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
		//if(proabre  !=  proAbre){ cont = document.getElementById("checkproabre");   cont.innerHTML = "<i style='color:orange; cursor:pointer; ' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont = document.getElementById("checkproabre");   cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
		//if(SENcon  !=  condena){ cont = document.getElementById("checkSENcon");   cont.innerHTML = "<i style='color:orange; cursor:pointer; ' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont = document.getElementById("checkSENcon");   cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }

	}

}

//////////// VALIDA EL NUC INGRESADO SI EXISTE EN SICAP PARA PODER SER INGRESADO A SISTEMA Y SI NO ES ASI HAY QUE INGRESARLO A SICAP PRIMERO /////////////////////

function nucInserts(idinput, idMp, mes, anio, estatResolucion, deten, idUnidad) {


	texto = document.getElementById(idinput).value;
	cantidadinicio = document.getElementById(idinput).value.length;

	if (cantidadinicio > 13) {
		var slice2 = texto.slice(0, -1);
		document.getElementById(idinput).value = slice2;
	} else {

		if (cantidadinicio < 13) { } else {
			if (cantidadinicio == 13) {

				nuc = document.getElementById('nuc').value;

				acc = "existeNuc";
				ajax = objetoAjax();
				ajax.open("POST", "format/litigacion/accionesNucsLit.php");

				ajax.onreadystatechange = function () {
					if (ajax.readyState == 4 && ajax.status == 200) {

						var cadCodificadaJSON = ajax.responseText;
						var objDatos = eval("(" + cadCodificadaJSON + ")");


						if (objDatos.first == "NO") { getExpediente("expedCont", nuc); swal("", "El numero de caso no existe 2.", "warning"); } else {

							if (objDatos.first == "SI") {
								getDatosNucDetermEstlit(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad);
							}
						}
					}
				}
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send("&nuc=" + nuc + "&acc=" + acc);

			}
		}
	}
}

////////////////////////////////

function getDatosNucDetermEstlit(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad) {


	cont = document.getElementById("contDataNucDeterm");
	acc = "getDataNuc";
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/accionesNucsLit.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {

			cont.innerHTML = ajax.responseText;
			existenuclitigacion(nuc, idMp, estatResolucion, mes, anio, idUnidad, deten);
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&nuc=" + nuc + "&acc=" + acc + "&estatResolucion=" + estatResolucion + "&idUnidad=" + idUnidad);
}


///////////////



function existenuclitigacion(nuc, idMp, estatResolucion, mes, anio, idUnidad, deten) {



	acc = "existeNuclitigacion"; 

	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/accionesNucsLit.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {

			var cadCodificadaJSON = ajax.responseText;
			var objDatos = eval("(" + cadCodificadaJSON + ")");

			alert(objDatos.first);

			/////// VALIDAR SI EL NUC YA FUE JUDICIALIZADO SI NO SE APLICA LO DEMAS //////////
			if(objDatos.first == "judicializado"){
				swal("", "El NUC ya fue judicializado.\n\n Ministerio Público: "+objDatos.nomCompleto+'\n Unidad: '+objDatos.unidad+' - '+objDatos.fiscalia, "warning");
			}else{

				if (objDatos.first == "NO") { getExpediente("expedCont", nuc); swal("", "El Número de Caso ya se encuentra capturado.", "warning"); } else {

					if (objDatos.first == "SI") {
						getExpedienteLit("expedCont", nuc);
	
						if (estatResolucion == 1 || estatResolucion == 2 || estatResolucion == 3 || estatResolucion == 4 ||
							estatResolucion == 17 || estatResolucion == 18 || estatResolucion == 20 || estatResolucion == 21 ||
							estatResolucion == 22 || estatResolucion == 23 || estatResolucion == 24 || estatResolucion == 25 ||
							estatResolucion == 26 || estatResolucion == 27 || estatResolucion == 28 || estatResolucion == 29 ||
							estatResolucion == 30 || estatResolucion == 31 || estatResolucion == 95 || estatResolucion == 61 ||
							estatResolucion == 63 || estatResolucion == 89 || estatResolucion == 99 || estatResolucion == 101 ||
							estatResolucion == 103 || estatResolucion == 105 || estatResolucion == 106 || estatResolucion == 107 ||
							estatResolucion == 108 || estatResolucion == 109 || estatResolucion == 110 || estatResolucion == 111 ||
							estatResolucion == 64 || estatResolucion == 60 || estatResolucion == 91 || estatResolucion == 65 ||
							estatResolucion == 90 || estatResolucion == 68 ||
							estatResolucion == 129 || estatResolucion == 57 || estatResolucion == 151 || estatResolucion == 154 || estatResolucion == 66
							|| estatResolucion == 140 || estatResolucion == 139 || estatResolucion == 141 || || estatResolucion == 144 
							|| estatResolucion == 145 || estatResolucion == 142) {
							showModalNucLitInfo2(estatResolucion, nuc, idMp, mes, anio, deten, idUnidad);
						} else if (estatResolucion == 50 || estatResolucion == 53 || estatResolucion == 58) {
							showModalAgregarImputados(estatResolucion, nuc, idMp, mes, anio, deten, idUnidad);
						} else {
							setTimeout("insertarNucLit(" + idMp + "," + estatResolucion + "," + mes + "," + anio + "," + nuc + "," + deten + "," + idUnidad + ");", 100);
						}
					}
				}

			}




		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&nuc=" + nuc + "&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes + "&anio=" + anio + "&idUnidad=" + idUnidad);


}


//////////////////////////////////////////

function checkInsertedLit(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad) {

	acc = "checkinsert";
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/accionesNucsLit.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {

			var cadCodificadaJSON = ajax.responseText;
			var objDatos = eval("(" + cadCodificadaJSON + ")");

			if (objDatos.first == "SI") {

				getExpediente("expedCont", nuc);
				//// obtener los datos del MP que determino el NUC 
				var mpnombre = document.getElementById("nombreMpinput").value;
				var nUnidad = document.getElementById("nombreUnidadinput").value;

				//swal("", "<b>El Número de caso se encuentra determinado</b> \n\n Unidad: "+nUnidad+"\n Mp: "+mpnombre, "warning"); 
				swal({
					title: "<h4>El Número de caso se encuentra determinado.</h4>",
					text: "<label style='color:black;'><b>Unidad :</b</label><label style='color:#3c6084;'>" + nUnidad + "</label> \n <label style='color:black;'><b>Mp :</b</label><label style='color:#3c6084;'>" + mpnombre + "</label>",
					html: true
				});

			} else {

				if (objDatos.first == "NO") {

					caninsertlit(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad);

				}
			}

		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&nuc=" + nuc + "&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes + "&anio=" + anio + "&idUnidad=" + idUnidad);

}

///////////////////////////// 

function caninsertlit(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad) {

	acc = "caninsert";
	numcasos = document.getElementById("casos").value;

	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/accionesNucsLit.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {

			var cadCodificadaJSON = ajax.responseText;
			var objDatos = eval("(" + cadCodificadaJSON + ")");

			if (objDatos.first == "NO") { getExpediente("expedCont", nuc); swal("", "Excediste el numero maximo permitido.", "warning"); } else {

				if (objDatos.first == "SI") {
					getExpedienteLit("expedCont", nuc);
					setTimeout("insertarNucLit(" + idMp + "," + estatResolucion + "," + mes + "," + anio + "," + nuc + "," + deten + "," + idUnidad + ");", 100);

				}
			}

		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&nuc=" + nuc + "&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes + "&anio=" + ajaxnio + "&numcasos=" + numcasos + "&deten=" + deten + "&idUnidad=" + idUnidad);

}


///////////////////////////////

function insertarNucLit(idMp, estatResolucion, mes, anio, nuc, deten, idUnidad, opcInsert) {

	acc = "insertNuc";
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/accionesNucsLit.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			//cont.innerHTML = ajax.responseText;

			var cadCodificadaJSON = ajax.responseText;
			var objDatos = eval("(" + cadCodificadaJSON + ")");

			if (objDatos.first == "NO") { swal("", "El NUC ya se encuentra registrado favor de revisar.", "Warning"); } else {

				if (objDatos.first == "SI") {

					swal("", "Se Registro Correctamente.", "success");
					updateTableNucsLiti(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad);
					/*Despues de haber validado la información adicional de SENAP y haber guardado el NUC se extrae el idEstatusNucs para 
							proceder a insertar la informacion del senap en la respectiva tabla dependiendo del idEstatus*/
					switch (estatResolucion) {
						case 1:
						case 2:
							setTimeout("insertFormJudicializada_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
							break;
						case 3:
						case 4:
							setTimeout("insertFormImputacion_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
							break;
						case 17: case 18: case 20: case 21: case 22: case 23: case 24: case 25: case 26: case 27: case 28: case 29: case 30: case 31: case 95:
							setTimeout("insertMedCautelar_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
							break;
						case 61: case 63:
							setTimeout("insertAudienciaIntermedia_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
							break;
						case 89: case 99: case 101: case 103: case 105: case 106: case 107: case 108: case 109: case 110: case 111:
							setTimeout("insertSobreseimientos_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
							break;
						case 64:
							setTimeout("insertSuspCondProc_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
							break;
						case 60:
							setTimeout("insertAudienciasJuicio_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
							break;
						case 91:
							setTimeout("insertCriteriosOportunidad_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
							break;
						case 65: case 90:
							setTimeout("insertAcuerdoReparatorio_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
							break;
						case 66: case 67:
							setTimeout("insertSentencias_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
							break;
						case 68:
							setTimeout("insertReparacionDanios_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
							break;
						case 129:
							setTimeout("insertMedidaProteccion_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + "," + idMp + ", " + mes + ", " + anio + ");", 100);
							break;
						case 57:
							setTimeout("insertFechaCumplimento_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + "," + idMp + ", " + mes + ", " + anio + ");", 100);
							break;
						case 151:
							setTimeout("insertFormAutoVincuProc_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + "," + idMp + ", " + mes + ", " + anio + ");", 100);
							break;
						case 154:
							setTimeout("insertSentencias_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + "," + idMp + ", " + mes + ", " + anio + ");", 100);
							break;
						case 50: case 53: case 58:
							setTimeout("insertInputados_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + "," + idMp + ", " + mes + ", " + anio + ");", 100);
							break;
						default:
							break;
					}
				}
			}

		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&nuc=" + nuc + "&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes + "&anio=" + anio + "&deten=" + deten + "&idUnidad=" + idUnidad);

}


//////////////////////////////////////////////////////

function getExpedienteLit(input, nuc) {

	acc = "getExp";
	cont = document.getElementById(input);
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/accionesNucsLit.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&nuc=" + nuc + "&acc=" + acc);

}

////////////////////////////////////////////


function updateTableNucsLiti(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad) {

	//alert("LLEga el contable nucs");

	acc = "showtable";
	cont = document.getElementById("contTableNucslitg");
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/accionesNucsLit.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			getExpedienteLit("expedCont", nuc);
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes + "&anio=" + anio + "&nuc=" + nuc + "&deten=" + deten + "&idUnidad=" + idUnidad);

}

function deleteResolLit(idEstatusNucs, idMp, anio, mes, estatResolucion, nuc, idUnidad) {


	//	alert("la idEstatusNucs a elimin es : "+idEstatusNucs);
	swal({
		title: "",
		text: "¿Esta seguro de Eliminar?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Eliminar",
		cancelButtonText: "Cancelar",
		closeOnConfirm: true,
		closeOnCancel: true
	},
		function (isConfirm) {
			if (isConfirm) {

				acc = "deleteResol";
				ajax = objetoAjax();
				ajax.open("POST", "format/litigacion/accionesNucsLit.php");

				ajax.onreadystatechange = function () {
					if (ajax.readyState == 4 && ajax.status == 200) {

						var cadCodificadaJSON = ajax.responseText;
						var objDatos = eval("(" + cadCodificadaJSON + ")");

						if (objDatos.first == "NO") { swal("", "Hubo un problema favor de revisar.", "Warning"); } else {

							if (objDatos.first == "SI") {

								//updateTableNucs2(idMp, anio, mes, estatResolucion, nuc, deten);               
								updateTableNucsLiti(idMp, anio, mes, estatResolucion, nuc, 0, idUnidad);
								setTimeout("removeDataSenap(" + idEstatusNucs + "," + estatResolucion + "," + idMp + "," + mes + "," + anio + ");", 100);
							}
						}

					}
				}
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send("&acc=" + acc + "&idEstatusNucs=" + idEstatusNucs + "&idMp=" + idMp + "&anio=" + anio + "&mes=" + mes + "&nuc=" + nuc + "&idUnidad=" + idUnidad + "&estatResolucion=" + estatResolucion);

			}
		});

}

///////////////////////////////////////////

function sendDataModalSicap(inputCant, estatus, deten, idMp, mes, anio, idUnidad) {

	var cant = document.getElementById(inputCant).value;
	cont = document.getElementById('contmodalnucsLitig');
	if (cant != 0) {
		$('#nuc').focus();
		ajax = objetoAjax();
		ajax.open("POST", "format/litigacion/modalNucsLitig.php");
		ajax.onreadystatechange = function () {
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

				$('#modalNucsLitig').modal('show');
				$('#modalFormatoLitig').modal('hide');
			}
		}
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("&cant=" + cant + "&idMp=" + idMp + "&mes=" + mes + "&anio=" + anio + "&idUnidad=" + idUnidad + "&estatus=" + estatus + "&deten=" + deten);

	}
}

function loadtablaFormatos(idUnidad) {


	cont = document.getElementById('contenido');

	ajax = objetoAjax();
	ajax.open("POST", "formatos/formatosAreas.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&idUnidad=" + idUnidad);

}


function cerrarCapturaLit(idEnlace) {

	loadtablaFormat(0, 'formatLitigacion.php', 'litigacion', idEnlace);
}


function mostrarModalValidacionNUcsLit(validado, idlit, mesCapturar, anioCaptura) {


	cont = document.getElementById('contMOdalValidateNucs');

	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/modalValidateNucslit.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&validado=" + validado + "&idlit=" + idlit + "&mesCapturar=" + mesCapturar + "&anioCaptura=" + anioCaptura);

}


function descargarLit(idUnidad, mes, anio, idEnlace) {

	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/descargar.php");

	nombrereporte = "Litigacion-" + idUnidad + "-" + mes + "-" + anio;
	cont = document.getElementById('respuestaDescargarCarpeta');
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			//cont.innerHTML = ajax.responseText;
			document.location.href = "format/litigacion/downloadReport/" + nombrereporte + ".xlsx";
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send('&idUnidad=' + idUnidad + '&mes=' + mes + '&anio=' + anio + '&idEnlace=' + idEnlace);

}

//Funcion para eliminar informacion adicional de SENAP al eliminar el nuc
function removeDataSenap(idEstatusNucs, estatResolucion, idMp, mes, anio) {
	validaDataSenap = validarEstatusShowInfoSica(estatResolucion); //Si el estatusResolucion es de SENAP pocedemos a efectuar la llamada
	if (validaDataSenap) {
		ajax = objetoAjax();
		ajax.open("POST", "format/litigacion/insertSenap/deleteDataSenap.php");

		ajax.onreadystatechange = function () {
			if (ajax.readyState == 4 && ajax.status == 200) {
				if (estatResolucion == 129) { refreshMedProtec(idMp, mes, anio); }
			}
		}
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("&idEstatusNucs=" + idEstatusNucs + "&estatResolucion=" + estatResolucion);
	}
}

//Funcion para validad si el estatus recibido requiere informacion adicional de SENAP
function validarEstatusShowInfoSica(estatResolucion) {

	if (estatResolucion == 1 || estatResolucion == 2 || estatResolucion == 3 || estatResolucion == 4 || estatResolucion == 19 || estatResolucion == 17 || estatResolucion == 18
		|| estatResolucion == 20 || estatResolucion == 21 || estatResolucion == 22 || estatResolucion == 23 || estatResolucion == 24
		|| estatResolucion == 25 || estatResolucion == 26 || estatResolucion == 27 || estatResolucion == 28 || estatResolucion == 29
		|| estatResolucion == 30 || estatResolucion == 31 || estatResolucion == 95 || estatResolucion == 61 || estatResolucion == 63
		|| estatResolucion == 99 || estatResolucion == 89 || estatResolucion == 101 || estatResolucion == 103 || estatResolucion == 105
		|| estatResolucion == 106 || estatResolucion == 89 || estatResolucion == 107 || estatResolucion == 108 || estatResolucion == 109
		|| estatResolucion == 110 || estatResolucion == 111 || estatResolucion == 64 || estatResolucion == 60 || estatResolucion == 14
		|| estatResolucion == 65 || estatResolucion == 66 || estatResolucion == 67 || estatResolucion == 68 || estatResolucion == 90
		|| estatResolucion == 91 || estatResolucion == 129 || estatResolucion == 57 || estatResolucion == 151 || estatResolucion == 154
		|| estatResolucion == 50 || estatResolucion == 53 || estatResolucion == 58) {
		return true;
	}
	else {
		return false;
	}
}




function insertarNucLitJud(idMp, estatResolucion, mes, anio, nuc, deten, idUnidad, idCatModalidadEst) {

	acc = "insertNuc";
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/accionesNucsLit.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			//cont.innerHTML = ajax.responseText;

			var cadCodificadaJSON = ajax.responseText;
			var objDatos = eval("(" + cadCodificadaJSON + ")");

			if (objDatos.first == "NO") { swal("", "El NUC ya se encuentra registrado favor de revisar.", "Warning"); } else {

				if (objDatos.first == "SI") {
					swal("", "Se Registro Correctamente.", "success");
					updateTableNucsLiti(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad);
				}
			}

		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&nuc=" + nuc + "&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes + "&anio=" + anio + "&deten=" + deten + "&idUnidad=" + idUnidad);

}

function openEtapa(evt, etapa) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById(etapa).style.display = "block";
	evt.currentTarget.className += " active";
}

function refreshMedProtec(idMp, mes, anio) {
	$.ajax({
		type: "POST",
		dataType: "html",
		url: "format/litigacion/insertSenap/reloadVictMedidasProteccion.php",
		data: 'mes=' + mes + '&idMp=' + idMp + '&anio=' + anio,
		success: function (respuesta) {
			var json = respuesta;
			var obj = eval("(" + json + ")");
			$('#MPV').val(obj.victimas); //actualizamos el numero de victimas
		}
	});
}
