

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

function sumTIEotorgadas() {
    TIE_intervencion_comunicaciones = document.getElementById("TIE_intervencion_comunicaciones").value; if (TIE_intervencion_comunicaciones == "") { TIE_intervencion_comunicaciones = 0; } else { TIE_intervencion_comunicaciones = parseInt(document.getElementById("TIE_intervencion_comunicaciones").value); }
    TIE_datos_conservados = document.getElementById("TIE_datos_conservados").value; if (TIE_datos_conservados == "") { TIE_datos_conservados = 0; } else { TIE_datos_conservados = parseInt(document.getElementById("TIE_datos_conservados").value); }
    TIE_datos_bancarios = document.getElementById("TIE_datos_bancarios").value; if (TIE_datos_bancarios == "") { TIE_datos_bancarios = 0; } else { TIE_datos_bancarios = parseInt(document.getElementById("TIE_datos_bancarios").value); }

    var final = TIE_intervencion_comunicaciones + TIE_datos_conservados + TIE_datos_bancarios; document.getElementById("TIE_otorgadas").value = final;
}

function sumTIEnegadas() {
    TIEneg_intervencion_comunicaciones = document.getElementById("TIEneg_intervencion_comunicaciones").value; if (TIEneg_intervencion_comunicaciones == "") { TIEneg_intervencion_comunicaciones = 0; } else { TIEneg_intervencion_comunicaciones = parseInt(document.getElementById("TIEneg_intervencion_comunicaciones").value); }
    TIEneg_datos_conservados = document.getElementById("TIEneg_datos_conservados").value; if (TIEneg_datos_conservados == "") { TIEneg_datos_conservados = 0; } else { TIEneg_datos_conservados = parseInt(document.getElementById("TIEneg_datos_conservados").value); }
    TIEneg_datos_bancarios = document.getElementById("TIEneg_datos_bancarios").value; if (TIEneg_datos_bancarios == "") { TIEneg_datos_bancarios = 0; } else { TIEneg_datos_bancarios = parseInt(document.getElementById("TIEneg_datos_bancarios").value); }

    var final = TIEneg_intervencion_comunicaciones + TIEneg_datos_conservados + TIEneg_datos_bancarios; document.getElementById("TIE_negadas").value = final;
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

    SDuno = document.getElementById("SDuno").value; if (SDuno == "") { SDuno = 0; } else { SDuno = parseInt(document.getElementById("SDuno").value); }
    SDunoNu = document.getElementById("valor155").value; if (SDunoNu == "") { SDunoNu = 0; } else { SDunoNu = parseInt(document.getElementById("valor155").value); }



    SDdos = document.getElementById("SDdos").value; if (SDdos == "") { SDdos = 0; } else { SDdos = parseInt(document.getElementById("SDdos").value); }
    SDdosNu = document.getElementById("valor156").value; if (SDdosNu == "") { SDdosNu = 0; } else { SDdosNu = parseInt(document.getElementById("valor156").value); }


    SDtres = document.getElementById("SDtres").value; if (SDtres == "") { SDtres = 0; } else { SDtres = parseInt(document.getElementById("SDtres").value); }
    SDtresNu = document.getElementById("valor157").value; if (SDtresNu == "") { SDtresNu = 0; } else { SDtresNu = parseInt(document.getElementById("valor157").value); }


    SDcuatro = document.getElementById("SDcuatro").value; if (SDcuatro == "") { SDcuatro = 0; } else { SDcuatro = parseInt(document.getElementById("SDcuatro").value); }
    SDcuatroNu = document.getElementById("valor158").value; if (SDcuatroNu == "") { SDcuatroNu = 0; } else { SDcuatroNu = parseInt(document.getElementById("valor158").value); }


    SDcinco = document.getElementById("SDcinco").value; if (SDcinco == "") { SDcinco = 0; } else { SDcinco = parseInt(document.getElementById("SDcinco").value); }
    SDcincoNu = document.getElementById("valor159").value; if (SDcincoNu == "") { SDcincoNu = 0; } else { SDcincoNu = parseInt(document.getElementById("valor159").value); }


    SDseis = document.getElementById("SDseis").value; if (SDseis == "") { SDseis = 0; } else { SDseis = parseInt(document.getElementById("SDseis").value); }
    SDseisNu = document.getElementById("valor160").value; if (SDseisNu == "") { SDseisNu = 0; } else { SDseisNu = parseInt(document.getElementById("valor160").value); }


    SDsiete = document.getElementById("SDsiete").value; if (SDsiete == "") { SDsiete = 0; } else { SDsiete = parseInt(document.getElementById("SDsiete").value); }
    SDsieteNu = document.getElementById("valor161").value; if (SDsieteNu == "") { SDsieteNu = 0; } else { SDsieteNu = parseInt(document.getElementById("valor161").value); }


    SDocho = document.getElementById("SDocho").value; if (SDocho == "") { SDocho = 0; } else { SDocho = parseInt(document.getElementById("SDocho").value); }
    SDochoNu = document.getElementById("valor162").value; if (SDochoNu == "") { SDochoNu = 0; } else { SDochoNu = parseInt(document.getElementById("valor162").value); }


    SDnueve = document.getElementById("SDnueve").value; if (SDnueve == "") { SDnueve = 0; } else { SDnueve = parseInt(document.getElementById("SDnueve").value); }
    SDnueveNu = document.getElementById("valor163").value; if (SDnueveNu == "") { SDnueveNu = 0; } else { SDnueveNu = parseInt(document.getElementById("valor163").value); }


    SDdiez = document.getElementById("SDdiez").value; if (SDdiez == "") { SDdiez = 0; } else { SDdiez = parseInt(document.getElementById("SDdiez").value); }
    SDdiezNu = document.getElementById("valor164").value; if (SDdiezNu == "") { SDdiezNu = 0; } else { SDdiezNu = parseInt(document.getElementById("valor164").value); }

    //totCarpTram_nucs = document.getElementById("totCarpTram_nucs").value; if (totCarpTram_nucs == "") { totCarpTram_nucs = 0; } else { totCarpTram_nucs = parseInt(document.getElementById("totCarpTram_nucs").value); }
    //totCarpTram_nucsNu = document.getElementById("valor165").value; if (totCarpTram_nucsNu == "") { totCarpTram_nucsNu = 0; } else { totCarpTram_nucsNu = parseInt(document.getElementById("valor165").value); }

    audiencia_incial = document.getElementById("audiencia_incial").value; if (audiencia_incial== "") { audiencia_incial = 0; } else { audiencia_incial = parseInt(document.getElementById("audiencia_incial").value); }
    audiencia_incialNu = document.getElementById("valor166").value; if (audiencia_incialNu == "") { audiencia_incialNu = 0; } else { audiencia_incialNu = parseInt(document.getElementById("valor166").value); }

    prueba_anticipada = document.getElementById("prueba_anticipada").value; if (prueba_anticipada== "") { prueba_anticipada = 0; } else { prueba_anticipada = parseInt(document.getElementById("prueba_anticipada").value); }
    prueba_anticipadaNu = document.getElementById("valor167").value; if (prueba_anticipadaNu == "") { prueba_anticipadaNu = 0; } else { prueba_anticipadaNu = parseInt(document.getElementById("valor167").value); }

    escrito_acusacion = document.getElementById("escrito_acusacion").value; if (escrito_acusacion== "") { escrito_acusacion = 0; } else { escrito_acusacion = parseInt(document.getElementById("escrito_acusacion").value); }
    escrito_acusacionNu = document.getElementById("valor168").value; if (escrito_acusacionNu == "") { escrito_acusacionNu = 0; } else { escrito_acusacionNu = parseInt(document.getElementById("valor168").value); }

    investigacion_complementaria = document.getElementById("investigacion_complementaria").value; if (investigacion_complementaria== "") { investigacion_complementaria = 0; } else { investigacion_complementaria = parseInt(document.getElementById("investigacion_complementaria").value); }
    investigacion_complementariaNu = document.getElementById("valor170").value; if (investigacion_complementariaNu == "") { investigacion_complementariaNu = 0; } else { investigacion_complementariaNu = parseInt(document.getElementById("valor170").value); }

    aud_ejecucion_sanciones = document.getElementById("aud_ejecucion_sanciones").value; if (aud_ejecucion_sanciones== "") { aud_ejecucion_sanciones = 0; } else { aud_ejecucion_sanciones = parseInt(document.getElementById("aud_ejecucion_sanciones").value); }
    aud_ejecucion_sancionesNu = document.getElementById("valor171").value; if (aud_ejecucion_sancionesNu == "") { aud_ejecucion_sancionesNu = 0; } else { aud_ejecucion_sancionesNu = parseInt(document.getElementById("valor171").value); }

    ap_revocan_absolutoria = document.getElementById("ap_revocan_absolutoria").value; if (ap_revocan_absolutoria== "") { ap_revocan_absolutoria = 0; } else { ap_revocan_absolutoria = parseInt(document.getElementById("ap_revocan_absolutoria").value); }
    ap_revocan_absolutoriaNu = document.getElementById("valor172").value; if (ap_revocan_absolutoriaNu == "") { ap_revocan_absolutoriaNu = 0; } else { ap_revocan_absolutoriaNu = parseInt(document.getElementById("valor172").value); }

    TIE_intervencion_comunicaciones = document.getElementById("TIE_intervencion_comunicaciones").value; if (TIE_intervencion_comunicaciones== "") { TIE_intervencion_comunicaciones = 0; } else { TIE_intervencion_comunicaciones = parseInt(document.getElementById("TIE_intervencion_comunicaciones").value); }
    TIE_intervencion_comunicacionesNu = document.getElementById("valor173").value; if (TIE_intervencion_comunicacionesNu == "") { TIE_intervencion_comunicacionesNu = 0; } else { TIE_intervencion_comunicacionesNu = parseInt(document.getElementById("valor173").value); }

    TIE_datos_conservados = document.getElementById("TIE_datos_conservados").value; if (TIE_datos_conservados== "") { TIE_datos_conservados = 0; } else { TIE_datos_conservados = parseInt(document.getElementById("TIE_datos_conservados").value); }
    TIE_datos_conservadosNu = document.getElementById("valor175").value; if (TIE_datos_conservadosNu == "") { TIE_datos_conservadosNu = 0; } else { TIE_datos_conservadosNu = parseInt(document.getElementById("valor175").value); }

    TIE_datos_bancarios = document.getElementById("TIE_datos_bancarios").value; if (TIE_datos_bancarios== "") { TIE_datos_bancarios = 0; } else { TIE_datos_bancarios = parseInt(document.getElementById("TIE_datos_bancarios").value); }
    TIE_datos_bancariosNu = document.getElementById("valor176").value; if (TIE_datos_bancariosNu == "") { TIE_datos_bancariosNu = 0; } else { TIE_datos_bancariosNu = parseInt(document.getElementById("valor176").value); }

    TIEneg_intervencion_comunicaciones = document.getElementById("TIEneg_intervencion_comunicaciones").value; if (TIEneg_intervencion_comunicaciones== "") { TIEneg_intervencion_comunicaciones= 0; } else { TIEneg_intervencion_comunicaciones = parseInt(document.getElementById("TIEneg_intervencion_comunicaciones").value); }
    TIEneg_intervencion_comunicacionesNu = document.getElementById("valor178").value; if (TIEneg_intervencion_comunicacionesNu == "") { TIEneg_intervencion_comunicacionesNu = 0; } else { TIEneg_intervencion_comunicacionesNu = parseInt(document.getElementById("valor178").value); }

    TIEneg_datos_conservados = document.getElementById("TIEneg_datos_conservados").value; if (TIEneg_datos_conservados== "") { TIEneg_datos_conservados= 0; } else { TIEneg_datos_conservados = parseInt(document.getElementById("TIEneg_datos_conservados").value); }
    TIEneg_datos_conservadosNu = document.getElementById("valor179").value; if (TIEneg_datos_conservadosNu == "") { TIEneg_datos_conservadosNu = 0; } else { TIEneg_datos_conservadosNu = parseInt(document.getElementById("valor179").value); }

    TIEneg_datos_bancarios = document.getElementById("TIEneg_datos_bancarios").value; if (TIEneg_datos_bancarios== "") { TIEneg_datos_bancarios= 0; } else { TIEneg_datos_bancarios = parseInt(document.getElementById("TIEneg_datos_bancarios").value); }
    TIEneg_datos_bancariosNu = document.getElementById("valor180").value; if (TIEneg_datos_bancariosNu == "") { TIEneg_datos_bancariosNu = 0; } else { TIEneg_datos_bancariosNu = parseInt(document.getElementById("valor180").value); }

    tramite_litigacion = document.getElementById("tramite_litigacion").value; if (tramite_litigacion== "") { tramite_litigacion= 0; } else { tramite_litigacion = parseInt(document.getElementById("tramite_litigacion").value); }
    tramite_litigacionNu = document.getElementById("valor181").value; if (tramite_litigacionNu == "") { tramite_litigacionNu = 0; } else { tramite_litigacionNu = parseInt(document.getElementById("valor181").value); }

    var arrayCamposData = [cdete, sdete, FIsolic, FIotor, FInega, legal, ilegal, aunvinc, mix, MCsol, MCotor, MCnega, ppofic, ppjus, ppanju, exgaeco, emvien, incuval, pssafj, scviind, pcdrclug, pccdper, sindom, steeca, steapl, coloele, rpdmjd, SDpapen, SDpmuImpu, acrep, criopor, termant, acu, citac, Cconc, Cnega, ONapre, ONcomp, DRppa, DRppd, DRppmp, apenoadmi, SDIrev, SDImod, SDIconf, Reproc, MJGorap, MJGorcomp,
        MJCorapre, MJCordcomp, totAudiencias, ACPREaie, ACPREaio, SOALscp, SOALarep, SENabsol, SENmixc, SENsreda, SENnocreda, INCOMdecre, INCOMadmi, ARJnap, ARJnar, ARJncoap, ARJnoc, ARJppmc, ARJtps, ARJrvp, ARJrnscp, ARJnapa, ARJsdpa, ARJemp, ARTEdap, ARTEsd, DSEDrfmp, DSEDmfmp, DSEDcfmp, csjdsm, OSapre, OScomp, medidasProteccion, intervencionTR, tomaMuestras, exhumacion, obDatosReservados,
        intervencionCME, provPrecautoria, cadCustodia, InspLugDis, InspInmuebles, entrevistasTestigos, reconocimientoPer, solInfoPericiales, InfInstiSeg, examenFisPersona, audJuiOral, audFallo, absolutorio, AudIndiSan, procEspecial, audCondenatorio, mecanismosAceleracion, apeamparo, amparoDirecto, amparoIndirecto, auvinc, scpro, proabre, SENcon, SDuno, SDdos, SDtres, SDcuatro, SDcinco, SDseis, SDsiete, SDocho, SDnueve, SDdiez,
        audiencia_incial, prueba_anticipada, escrito_acusacion, investigacion_complementaria, aud_ejecucion_sanciones, ap_revocan_absolutoria, TIE_intervencion_comunicaciones, TIE_datos_conservados, TIE_datos_bancarios, TIEneg_intervencion_comunicaciones, TIEneg_datos_conservados, TIEneg_datos_bancarios, tramite_litigacion];

    var arrayNucsData = [cdeteNu, sdeteNu, FIsolicNu, FIotorNU, FInegaNu, legalNu, ilegalNu, aunvincNu, mixNu, MCsolNu, MCotorNu, MCnegaNu, ppoficNu, ppjusNu, ppanjuNu, exgaecoNu, emvienNu, incuvalNu, pssafjNu, scviindNu, pcdrclugNu, pccdperNu, sindomNu, steecaNu, steaplNu, coloeleNu, rpdmjdNu, SDpapenNu, SDpmuImpuNu, acrepNu, crioporNu, termantNu, acuNu, citacNu, CconcNu, CnegaNu, ONapreNu, ONcompNu, DRppaNu,
        DRppdNu, DRppmpNu, apenoadmiNu, SDIrevNu, SDImodNu, SDIconfNu, ReprocNu, MJGorapNu, MJGorcompNu, MJCorapreNu, MJCordcompNu, totAudienciasNu, ACPREaieNu, ACPREaioNu, SOALscpNu, SOALarepNu, SENabsolNu, SENmixcNu, SENsredaNu, SENnocredaNu, INCOMdecreNu, INCOMadmiNu, ARJnapNu, ARJnarNu, ARJncoapNu, ARJnocNu, ARJppmcNu, ARJtpsNu, ARJrvpNu, ARJrnscpNu, ARJnapaNu, ARJsdpaNu, ARJempNu, ARTEdapNu,
        ARTEsdNu, DSEDrfmpNu, DSEDmfmpNu, DSEDcfmpNu, csjdsmNu, OSapreNu, OScompNu, medidasProteccionNu, intervencionTRNu, tomaMuestrasNu, exhumacionNu, obDatosReservadosNu, intervencionCMENu, provPrecautoriaNu, cadCustodiaNu, InspLugDisNu, InspInmueblesNu, entrevistasTestigosNu, reconocimientoPerNu, solInfoPericialesNu, InfInstiSegNu, examenFisPersonaNu, audJuiOralNu, audFalloNu, absolutorioNu,
        AudIndiSanNu, procEspecialNu, audCondenatorioNu, mecanismosAceleracionNu, apeamparoNu, amparoDirectoNu, amparoIndirectoNu, vincprocesoNU, scprocesoNu, proAbreNu, condenaNu, SDunoNu, SDdosNu, SDtresNu, SDcuatroNu, SDcincoNu, SDseisNu, SDsieteNu, SDochoNu, SDnueveNu, SDdiezNu,
        audiencia_incialNu, prueba_anticipadaNu, escrito_acusacionNu, investigacion_complementariaNu, aud_ejecucion_sancionesNu, ap_revocan_absolutoriaNu, TIE_intervencion_comunicacionesNu, TIE_datos_conservadosNu, TIE_datos_bancariosNu, TIEneg_intervencion_comunicacionesNu, TIEneg_datos_conservadosNu, TIEneg_datos_bancariosNu, tramite_litigacionNu];

    var arrayCheckicon = ["checCdeten", "checSdeten", "checkFIsolic", "checkFIotor", "checkFInega", "checklegal", "checkilegal", "checkaunvinc", "checkmix", "checkMCsol", "checkMCotor", "checkMCnega", "checkppofic", "checkppjus", "checkppanju", "checkexgaeco", "checkemvien", "checkincuval", "checkpssafj", "checkscviind", "checkpcdrclug", "checkpccdper", "checksindom", "checksteeca", "checksteapl", "checkcoloele",
        "checkrpdmjd", "checkSDpapen", "checkSDpmuImpu", "checkCacrep", "checkcriopor", "checktermant", "checkacu", "checkcitac", "checkCconc", "checkCnega", "checkONapre", "checkONcomp", "checkDRppa", "checkDRppd", "checkDRppmp", "checkapenoadmi", "checkSDIrev", "checkSDImod", "checkSDIconf", "checkReproc", "checkMJGorap", "checkMJGorcomp", "checkMJCorapre", "checkMJCordcomp", "checktotAudiencias",
        "checkACPREaie", "checkACPREaio", "checkSOALscp", "checkSOALarep", "checkSENabsol", "checkSENmixc", "checkSENsreda", "checkSENnocreda", "checkINCOMdecre", "checkINCOMadmi", "checkARJnap", "checkARJnar", "checkARJncoap", "checkARJnoc", "checkARJppmc", "checkARJtps", "checkARJrvp", "checkARJrnscp", "checkSARJnapa", "checkARJsdpa", "checkARJemp", "checkARTEdap", "checkARTEsd", "checkDSEDrfmp",
        "checkDSEDmfmp", "checkDSEDcfmp", "checkcsjdsm", "checkOSapre", "checkOScomp", "checkMedidasProteccion", "checkIntervencionTR", "checkTomaMuestras", "checkExhumacion", "checkObDatosReservados", "checkIntervencionCME", "checkProvPrecautoria", "checkCadCustodia", "checkInspLugDis", "checkInspInmuebles", "checkEntrevistasTestigos", "checkReconocimientoPer", "checkSolInfoPericiales",
        "checkInfInstiSeg", "checkExamenFisPersona", "checkAudJuiOral", "checkAudFallo", "checkAbsolutorio", "checkAIDS", "checkProcEspecial", "checkAudCondenatorio", "checkMecanismoAcele", "checkapeamparo", "checkAmparoDirecto", "checkAmparoIndirecto", "checkauvinc", "checkscpro", "checkproabre", "checkSENcon", "checkSDuno", "checkSDdos", "checkSDtres", "checkSDcuatro", "checkSDcinco", "checkSDseis", "checkSDsiete", "checkSDocho", "checkSDnueve", "checkSDdiez",
        "check_audiencia_incial", "check_prueba_anticipada", "check_escrito_acusacion", "check_investigacion_complementaria", "check_aud_ejecucion_sanciones", "check_ap_revocan_absolutoria", "checkTIE_intervencion_comunicaciones", "checkTIE_datos_conservados", "checkTIE_datos_bancarios",
        "check_TIEneg_intervencion_comunicaciones", "checkTIEneg_datos_conservados" , "checkTIEneg_datos_bancarios" , "checkTramite_litigacion"];

    //alert(INCOMdecre+"-"+INCOMdecreNu);

    if (SDpmuImpu == SDpmuImpu && cdete == cdeteNu && sdete == sdeteNu && FIsolic == FIsolicNu && FIotor == FIotorNU && FInega == FInegaNu && legal == legalNu && ilegal == ilegalNu && criopor == crioporNu && aunvinc == aunvincNu
        && mix == mixNu && MCsol == MCsolNu && MCotor == MCotorNu && MCnega == MCnegaNu && ppofic == ppoficNu && ppjus == ppjusNu && ppanju == ppanjuNu && exgaeco == exgaecoNu && emvien == emvienNu && incuval == incuvalNu
        && pssafj == pssafjNu && scviind == scviindNu && pcdrclug == pcdrclugNu && pccdper == pccdperNu && sindom == sindomNu && steeca == steecaNu && steapl == steaplNu && coloele == coloeleNu && rpdmjd == rpdmjdNu
        && SDpapen == SDpapenNu && acrep == acrepNu && termant == termantNu && acu == acuNu && citac == citacNu && Cconc == CconcNu && Cnega == CnegaNu && ONapre == ONapreNu && ONcomp == ONcompNu && DRppa == DRppaNu
        && DRppd == DRppdNu && DRppmp == DRppmpNu && apenoadmi == apenoadmiNu && SDIrev == SDIrevNu && SDImod == SDImodNu && SDIconf == SDIconfNu && Reproc == ReprocNu && MJGorap == MJGorapNu && MJGorcomp == MJGorcompNu
        && MJCorapre == MJCorapreNu && MJCordcomp == MJCordcompNu && totAudiencias == totAudienciasNu && ACPREaie == ACPREaieNu && ACPREaio == ACPREaioNu && SOALscp == SOALscpNu && SOALarep == SOALarepNu && SENabsol == SENabsolNu
        && SENmixc == SENmixcNu && SENsreda == SENsredaNu && SENnocreda == SENnocredaNu && INCOMdecre == INCOMdecreNu && INCOMadmi == INCOMadmiNu && ARJnap == ARJnapNu && ARJnar == ARJnarNu && ARJncoap == ARJncoapNu
        && ARJnoc == ARJnocNu && ARJppmc == ARJppmcNu && ARJtps == ARJtpsNu && ARJrvp == ARJrvpNu && ARJrnscp == ARJrnscpNu && ARJnapa == ARJnapaNu && ARJsdpa == ARJsdpaNu && ARJemp == ARJempNu && ARTEdap == ARTEdapNu
        && ARTEsd == ARTEsdNu && DSEDrfmp == DSEDrfmpNu && DSEDmfmp == DSEDmfmpNu && DSEDcfmp == DSEDcfmpNu && csjdsm == csjdsmNu && auvinc == vincprocesoNU && scpro == scprocesoNu && proabre == proAbreNu && SENcon == condenaNu
        && OSapre == OSapreNu && OScomp == OScompNu && medidasProteccion == medidasProteccionNu && intervencionTR == intervencionTRNu && tomaMuestras == tomaMuestrasNu && exhumacion == exhumacionNu
        && obDatosReservados == obDatosReservadosNu && intervencionCME == intervencionCMENu && provPrecautoria == provPrecautoriaNu && provPrecautoria == provPrecautoriaNu && cadCustodia == cadCustodiaNu
        && InspInmuebles == InspInmueblesNu && entrevistasTestigos == entrevistasTestigosNu && reconocimientoPer == reconocimientoPerNu && solInfoPericiales == solInfoPericialesNu && InfInstiSeg == InfInstiSegNu
        && examenFisPersona == examenFisPersonaNu && audJuiOral == audJuiOralNu && audFallo == audFalloNu && absolutorio == absolutorioNu && AudIndiSan == AudIndiSanNu && procEspecial == procEspecialNu
        && audCondenatorio == audCondenatorioNu && mecanismosAceleracion == mecanismosAceleracionNu && apeamparo == apeamparoNu && amparoDirecto == amparoDirectoNu && InspLugDis == InspLugDisNu
        && SDuno == SDunoNu && SDdos == SDdosNu && SDtres == SDtresNu && SDcuatro == SDcuatroNu && SDcinco == SDcincoNu && SDseis == SDseisNu && SDsiete == SDsieteNu && SDocho == SDochoNu && SDnueve == SDnueveNu && SDdiez == SDdiezNu
        && audiencia_incial == audiencia_incialNu && prueba_anticipada == prueba_anticipadaNu && escrito_acusacion == escrito_acusacionNu && investigacion_complementaria == investigacion_complementariaNu
        && aud_ejecucion_sanciones == aud_ejecucion_sancionesNu && ap_revocan_absolutoria == ap_revocan_absolutoriaNu && TIE_intervencion_comunicaciones == TIE_intervencion_comunicacionesNu && TIE_datos_conservados == TIE_datos_conservadosNu
        && TIE_datos_bancarios == TIE_datos_bancariosNu && TIEneg_intervencion_comunicaciones == TIEneg_intervencion_comunicacionesNu && TIEneg_datos_conservados == TIEneg_datos_conservadosNu && TIEneg_datos_bancarios == TIEneg_datos_bancariosNu
        && tramite_litigacion == tramite_litigacionNu) {
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
        ajax.send("&idUnidad=" + idUnidad + "&idEnlace=" + idEnlace + "&idMp=" + idMp + "&mes=" + mes + "&anio=" + anio + "&cdete=" + cdete + "&sdete=" + sdete + "&FIsolic=" + FIsolic + "&FIotor=" + FIotor + "&FInega=" + FInega + "&auvinc="
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
            + "&AudIndiSan=" + AudIndiSan + "&procEspecial=" + procEspecial + "&audCondenatorio=" + audCondenatorio + "&mecanismosAceleracion=" + mecanismosAceleracion + "&apeamparo=" + apeamparo + "&amparoDirecto=" + amparoDirecto + "&amparoIndirecto=" + amparoIndirecto
            + "&SDuno=" + SDuno + "&SDdos=" + SDdos + "&SDtres=" + SDtres + "&SDcuatro=" + SDcuatro + "&SDcinco=" + SDcinco + "&SDseis=" + SDseis + "&SDsiete=" + SDsiete + "&SDocho=" + SDocho + "&SDnueve=" + SDnueve + "&SDdiez=" + SDdiez
            +  "&audiencia_incial=" + audiencia_incial + "&prueba_anticipada=" + prueba_anticipada + "&escrito_acusacion=" + escrito_acusacion + "&investigacion_complementaria=" + investigacion_complementaria + "&aud_ejecucion_sanciones=" + aud_ejecucion_sanciones
            + "&ap_revocan_absolutoria=" + ap_revocan_absolutoria + "&TIE_intervencion_comunicaciones=" + TIE_intervencion_comunicaciones + "&TIE_datos_conservados=" + TIE_datos_conservados + "&TIE_datos_bancarios=" + TIE_datos_bancarios
            + "&TIEneg_intervencion_comunicaciones=" + TIEneg_intervencion_comunicaciones + "&TIEneg_datos_conservados=" + TIEneg_datos_conservados + "&TIEneg_datos_bancarios=" + TIEneg_datos_bancarios + "&tramite_litigacion=" + tramite_litigacion);

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

function mayus(e) {
    e.value = e.value.toUpperCase();
}

//Función para validar una CURP
function curpValida(curp) {
    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        validado = curp.match(re);

    if (!validado)  //Coincide con el formato general?
        return false;

    //Validar que coincida el dígito verificador
    function digitoVerificador(curp17) {
        //Fuente https://consultas.curp.gob.mx/CurpSP/
        var diccionario = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
            lngSuma = 0.0,
            lngDigito = 0.0;
        for (var i = 0; i < 17; i++)
            lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        lngDigito = 10 - lngSuma % 10;
        if (lngDigito == 10) return 0;
        return lngDigito;
    }

    if (validado[2] != digitoVerificador(validado[1]))
        return false;

    return true; //Validado
}


//Lleva la CURP a mayúsculas para validarlo
function validarInputCURP() {

    curp = document.getElementById('curpImputados').value.toUpperCase();
    if (curpValida(curp)) { // ⬅️ Acá se comprueba
        return true;
    } else {
        return false;
    }

}

function deleteImputado(id, nuc) {
    swal({
            title: "",
            text: "¿Esta seguro de Eliminar el Imputado?",
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

                ajax = objetoAjax();
                ajax.open("POST", "format/litigacion/deleteImputado.php");

                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        var cadCodificadaJSON = ajax.responseText;
                        var objDatos = eval("(" + cadCodificadaJSON + ")");
                        if (objDatos.first == "NO") { swal("", "Hubo un problema favor de revisar.", "Warning"); } else {
                            if (objDatos.first == "SI") {
                                updateTablaImputadosXnuc(nuc);
                            }
                        }
                    }
                }
                ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                ajax.send("&id=" + id + "&nuc=" + nuc);

            }
        });
}

function updateDeterminacionesCarpeta(nuc) {
    cont = document.getElementById('contentTableDeterminaciones');
    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/tableDeterminacionesCarpeta.php");

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            cont.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc);
}

function updateTablaImputadosXnuc(nuc) {
    cont = document.getElementById('contTablaImputadosNuc');
    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/tableImputadosData.php");

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            cont.innerHTML = ajax.responseText;
            updateDeterminacionesCarpeta(nuc);
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc);
}

function limpiarDatosImputado() {
    nom = document.getElementById('nomImpu').value = "";
    paterno = document.getElementById('paternImpu').value = "";
    materno = document.getElementById('maternImpu').value = "";
    curp = document.getElementById('curpImputados').value = "";
    document.getElementById("sexoImp").options.item(0).selected = 'selected';
    edad = document.getElementById('edadImputado').value = "";
}

function guardarImputadoRegistrado(idImputado, nuc) {
    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/saveImputadoRegistradoData.php");

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var cadCodificadaJSON = ajax.responseText;
            var objDatos = eval("(" + cadCodificadaJSON + ")");
            if (objDatos.first == "NO") { swal("", "No se registro el imputado, favor de verificar.", "warning"); } else {
                if (objDatos.first == "SI") {
                    ///// SI SE INSERTO EL IMPUTADO ENTONCES ACTUALIZAR LA TABLA DE IMPUTADOS Y REINICIAR LOS DATOS INGRESADOS
                    swal("", "Se inserto el imputado a la carpeta.", "success");
                    updateTablaImputadosXnuc(nuc);
                    limpiarDatosImputado();
                    salirImputadoRegistrado();
                }
            }
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc + "&idImputado=" + idImputado);
}

function loadModalAddImptadoRegistrado(nuc, curp) {
    cont = document.getElementById('contmodalSeleccionarImputado');
    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/modalNucImputadoRegistrado.php");
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            cont.innerHTML = ajax.responseText;
            $('#modalSeleccionarImputado').modal('show');
            $('#modalFormatImputados').modal('hide');
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc + "&curp=" + curp);
}

function salirImputadoRegistrado() {
    $('#modalSeleccionarImputado').modal('hide');
    $('#modalFormatImputados').modal('show');
}

function salirIngresoImputados() {
    $('#modalNucsLitig').modal('show');
    $('#modalFormatImputados').modal('hide');
}

function guardarDeterminacionImputado(nuc, idEstatus, i, idEstatusNucs) {

    var imputado = document.getElementById("imputadoSeleted" + i).value;

    if (imputado == 0) { swal("", "Debe seleccionar un Imputado para la Determinación.", "warning"); } else {

        ajax = objetoAjax();
        ajax.open("POST", "format/litigacion/saveImputadoDeterminacion.php");

        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var cadCodificadaJSON = ajax.responseText;
                var objDatos = eval("(" + cadCodificadaJSON + ")");

                if (objDatos.first == "NO") { swal("", "No se registro, favor de verificar.", "warning"); } else {
                    if (objDatos.first == "SI") {
                        swal("", "Se guardo exitosamente.", "success");
                        updateTablaImputadosXnuc(nuc);
                    }
                }

            }
        }
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("&nuc=" + nuc + "&idEstatus=" + idEstatus + "&imputado=" + imputado + "&idEstatusNucs=" + idEstatusNucs);
    }

}

function saveImputadoData(nom, paterno, materno, curp, sexo, edad, nuc) {

    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/saveImputadoData.php");

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var cadCodificadaJSON = ajax.responseText;
            var objDatos = eval("(" + cadCodificadaJSON + ")");

            if (objDatos.first == "EI") {
                swal("", "Ya se encuentra el Imputado registrado con el CURP " + curp + " en la Carpeta " + nuc + ".", "warning");
            } else {

                if (objDatos.first == "EC") {
                    swal("", "Ya se encuentra el Imputado registrado con el CURP " + curp + ".", "warning");
                    // AQUI LANZAMOS EL MODAL PARA QUE PUEDAN AGREGAR EL IMPUTADO DE UNA LISTA
                    loadModalAddImptadoRegistrado(nuc, curp);
                } else {
                    if (objDatos.first == "NO") { swal("", "No se registro el imputado, favor de verificar.", "warning"); } else {
                        if (objDatos.first == "SI") {
                            ///// SI SE INSERTO EL IMPUTADO ENTONCES ACTUALIZAR LA TABLA DE IMPUTADOS Y REINICIAR LOS DATOS INGRESADOS
                            swal("", "Se inserto el imputado.", "success");
                            updateTablaImputadosXnuc(nuc);
                            limpiarDatosImputado();
                        }
                    }
                }
            }
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc + "&nom=" + nom + "&paterno=" + paterno + "&materno="
        + materno + "&curp=" + curp + "&sexo=" + sexo + "&edad=" + edad);
}

function addImputado(nuc) {

    nom = document.getElementById('nomImpu').value; nom.trim();
    paterno = document.getElementById('paternImpu').value; paterno.trim();
    materno = document.getElementById('maternImpu').value; materno.trim();
    curp = document.getElementById('curpImputados').value; curp.trim();
    sexo = document.getElementById('sexoImp').value;
    edad = document.getElementById('edadImputado').value;

    if (nom == "" || paterno == "" || materno == "" || sexo == "O" || edad == "") {
        swal("", "Faltan datos por capturar.", "warning");
    } else {
        saveImputadoData(nom, paterno, materno, curp, sexo, edad, nuc);
        // if (curp.length < 18 || curp.length > 18) {
        // 	swal("", "La curp debe estar compuesta por 18 caracteres.", "warning");
        // } else {

        // 	if (validarInputCURP()) {
        // 		////// SE HACE EL PROCESO PARA GUARDAR LOS DATOS DEL IMPUTADO EN LA BD
        // 		saveImputadoData(nom, paterno, materno, curp, sexo, edad, nuc);

        // 	} else {
        // 		swal("", "Verifique que la CURP este correcta.", "warning");
        // 	}
        // }
    }
}

function sendDataModalImputadosNUC(nuc) {

    cont = document.getElementById('contmodalImputadosLitig');

    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/modalNucImputadosLitig.php");
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            cont.innerHTML = ajax.responseText;

            $('#modalNucsLitig').modal('hide');
            $('#modalFormatImputados').modal('show');
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc);

}

function llenarImputadosXnuc(nuc, idMp, estatusResolucion, mes, anio, deten, idUnidad) {
    cont = document.getElementById('contentImputadosXnuc');
    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/selectImputadosNUc.php");
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            cont.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc + "&idMp=" + idMp + "&estatusResolucion=" + estatusResolucion + "&mes=" + mes + "&anio=" + anio + "&deten=" + deten + "&idUnidad=" + idUnidad);
}

function checkImputadosXcarpeta(nuc, idMp, estatusResolucion, mes, anio, deten, idUnidad) {

    acc = "existenImputadosNUC";
    ajax = objetoAjax();
    // ajax.open("POST", "formatos/accionesNucs.php");
    ajax.open("POST", "format/litigacion/accionesNucsLit.php");

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var cadCodificadaJSON = ajax.responseText;
            var objDatos = eval("(" + cadCodificadaJSON + ")");
            if (objDatos.first == "NO") {

                /// VALIDAR QUE EL ESTATUS QUE LLEGA AQUI PUEDA CAPTURAR IMPUTADOS SON LOS ESTATUS QUE NO CAPTURAN LA INFORMACION DL IMPUTADO

                const idEstatusNoValidos = [34, 35, 114, 115, 116, 117, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129];


                if (idEstatusNoValidos.includes(estatusResolucion)) {
                    //// SI ES UNO DE ESTOS ESTATUS ENTONCES NO MANDA LA PANTALLA PARA CAPTURA DE NUCS
                    getDatosNucDetermEstlit(nuc, idMp, estatusResolucion, mes, anio, deten, idUnidad, 0);
                } else {
                    ////// SI NO EXISTEN IMPUTADOS ENTONCES SE MANDA LA PANTALLA PARA AGREGAR IMPUTADOS Y RELACIONAR DETERMINACIONES
                    var text0 = "El numero de caso no cuenta con imputados o no se ha asignado el imputado a las determinaciones de la carpeta, favor de ingresar información de los imputados y/o determinaciones.";
                    swal("", text0, "warning");
                    ////LANZAR MODAL DE IMPUTADOS y OCULTAR EL MODAL ACTUAL
                    sendDataModalImputadosNUC(nuc);
                }
            } else {
                if (objDatos.first == "SI") {

                    const idSestatus = [1, 2, 151, 10, 12, 13, 14, 15, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31,
                        36, 38, 50, 53, 57, 58, 64, 65, 66, 67, 81, 84, 89, 90, 91, 93, 97, 99, 152, 153, 154, 155, 156, 157, 158, 159, 160, 161, 162, 163, 164, 165];
                    /////// CUANDO LLEGUE AQUI VALIDAMOS PRIMERO QUE NADA SI EL ESTATUS REQUIERE IMPUTADO

                    /// SI HAY IMPUTADO PARA EL ESTATUS ENTONCES SE LLENAN LOS IMPUTADOS EN EL SELECT Y SE ACTUALIZA
                    if (idSestatus.includes(estatusResolucion)) {
                        // found element
                        llenarImputadosXnuc(nuc, idMp, estatusResolucion, mes, anio, deten, idUnidad);
                    } else {
                        //// SI NO HAY IMPUTADO ENTONCES SE MANDA LA VENTANA NORMAL QUE SE MANDABA
                        getDatosNucDetermEstlit(nuc, idMp, estatusResolucion, mes, anio, deten, idUnidad, 0);
                    }
                    //// SI YA EXISTEN LOS IMPUTADOS REGISTRADOS ENTONCES SE REVISARA SI YA SE TIENE TODAS LAS DETERMINACIONES RELACIONADAS A UN NUC

                }
            }
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc + "&acc=" + acc);
}

function saveDeterminacionXimputado(nuc, idMp, estatusResolucion, mes, anio, deten, idUnidad) {
    ////// AQUI SOLO VAMOS A MANDAR LA INFO DEL IMPUTADO A LA FUNCION getDatosNucDetermEstlit
    var imputadoID = document.getElementById("imputadoSeletedEnv").value;
    var nuc = document.getElementById("nuc").value;

    // ===== INICIA LA NUEVA VALIDACIÓN =====
    if (nuc.length !== 13 && nuc.length !== 15) {
        swal("", "La longitud del NUC debe ser de 13 o 15 caracteres.", "warning");
        return; // Detenemos la ejecución de la función si no es válido
    }

    if (imputadoID == 0) {
        swal("", "Debe seleccionar un imputado para la resolución.", "warning");
    } else {

        /*
        NUEVO
        Estatus que se validaran para no meter imputados repetidos.
        */
        const idEstatusValidaImputados = [154 , 66 , 67 , 153];

        if( idEstatusValidaImputados.includes(estatusResolucion) ){
            acc = "valida_imputado_determinacion";
            ajax = objetoAjax();
            ajax.open("POST", "format/litigacion/accionesNucsLit.php");
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var cadCodificadaJSON = ajax.responseText;
                    var objDatos = eval("(" + cadCodificadaJSON + ")");
                    if(objDatos.tam > 0){
                        var informacion = "";
                        for(i=0; i < objDatos.tam; i++){
                            informacion+="Nombre imputado: " + objDatos.datos[i][2] +  "\n" + "Estatus: " + objDatos.datos[i][1] +  "\n" + "NUC: " + objDatos.datos[i][3] + "\n" + "Expediente: " + objDatos.datos[i][4] + "\n"  + "Ministerio Público: " + objDatos.datos[i][5] + "\n" + "Unidad: " + objDatos.datos[i][6] +  "\n" + "Fiscalía: " + objDatos.datos[i][7] + "\n" + " Mes: " + objDatos.datos[i][8] + " Año: " + objDatos.datos[i][9] + "\n\n Favor de verificar la información.";
                            console.log('aqui: ' + objDatos.datos[i] );
                        }
                        swal("", "El imputado ya cuenta con determinación con los siguientes datos:\n\n "+informacion, "warning");
                    }else{
                        //Si el imputado no se encuentra con alguna determinación indicado en la variable idEstatusValidaImputados , se procede a guardar la información
                        getDatosNucDetermEstlit(nuc, idMp, estatusResolucion, mes, anio, deten, idUnidad, imputadoID);
                    }
                }

            }
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            ajax.send("nuc=" + nuc + "&imputadoID=" + imputadoID + "&acc=" + acc  );
            /*
              NUEVO
              */
        }else{
            //Si no es necesario validar el imputado con la determinación para no repetir, se procede a guardar información
            getDatosNucDetermEstlit(nuc, idMp, estatusResolucion, mes, anio, deten, idUnidad, imputadoID);
        }
    }
}


function checkNucJudiciImputado(estatusResolucion, idMp, mes, anio, deten, idUnidad) {
    acc = "existeNucJudicializado";
    ajax = objetoAjax();
    // ajax.open("POST", "formatos/accionesNucs.php");
    ajax.open("POST", "format/litigacion/accionesNucsLit.php");

    nuc = document.getElementById('nuc').value;

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var cadCodificadaJSON = ajax.responseText;
            var objDatos = eval("(" + cadCodificadaJSON + ")");
            if (objDatos.first == "NO") {
                //// lanzar mensaje de advertencia para que se ingrese como judicializada
                ////// SI EL ESTATUS ES UNA JUDICIALIZADA CON O SIN DETENIDO ENTONCES PUEDO MANDAR EL MODAL PARA
                //CAPTURA DE IMPUTADOS SI NO SE MUESTRA EL MSJ QUE TIENE QUE INGRESAR COMO JUDICIALIZADA
                if (estatusResolucion == 1 || estatusResolucion == 2) {
                    checkImputadosXcarpeta(nuc, idMp, estatusResolucion, mes, anio, deten, idUnidad);
                } else {
                    checkImputadosXcarpeta(nuc, idMp, estatusResolucion, mes, anio, deten, idUnidad);
                    // var text1 = "El numero de caso no se ha judicializado en la plataforma, favor de ingresarlo como judicializado";
                    // swal("", "" + text1 + "", "warning");
                }

            } else {
                if (objDatos.first == "SI") {
                    ///// VALIDAR QUE NO EXISTAN IMPUTADOS YA REGISTRADOS DE LA CARPETA ///////
                    checkImputadosXcarpeta(nuc, idMp, estatusResolucion, mes, anio, deten, idUnidad);
                }
            }
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc + "&acc=" + acc + "&estatusResolucion=" + estatusResolucion);
}


//////////// VALIDA EL NUC INGRESADO SI EXISTE EN SICAP PARA PODER SER INGRESADO A SISTEMA Y SI NO ES ASI HAY QUE INGRESARLO A SICAP PRIMERO /////////////////////
let nucValidationTimer;
function nucInserts(idinput, idMp, mes, anio, estatResolucion, deten, idUnidad) {

    // 1. Limpiamos cualquier temporizador anterior cada vez que se presiona una tecla.
    clearTimeout(nucValidationTimer);

    texto = document.getElementById(idinput).value;
    cantidadinicio = document.getElementById(idinput).value.length;

    // Cortamos el valor si excede el máximo de 15
    if (cantidadinicio > 15) {
        var slice2 = texto.slice(0, -1);
        document.getElementById(idinput).value = slice2;
        return;
    }

    // 2. Lógica de validación condicional
    if (cantidadinicio === 15) {
        // Si la longitud es 15, validamos inmediatamente.

        nuc = document.getElementById('nuc').value;

        acc = "existeNuc";
        ajax = objetoAjax();
        ajax.open("POST", "format/litigacion/accionesNucsLit.php");

        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {

                var cadCodificadaJSON = ajax.responseText;
                var objDatos = eval("(" + cadCodificadaJSON + ")");
                if (objDatos.first == "NO") {
                    getExpediente("expedCont", nuc);
                    swal("", "El numero de caso no existe.", "warning");
                    document.getElementById('nuc').value = '';
                } else {

                    if (objDatos.first == "SI") {

                        if(estatResolucion != 181){
                            ////// VALIDAR SI EL NUC SE ENCUENTRA YA JUDICIALIZADO O NO ///////
                            checkNucJudiciImputado(estatResolucion, idMp, mes, anio, deten, idUnidad);

                            /////// SE EJECUTARA CUANDO YA SE QUIERA INSERTAR EL NUC EN BD DESPUES DE VALIDAR LOS IMPUTADOS
                            // getDatosNucDetermEstlit(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad);
                        }else{
                            sendDataModalImputadosNUC_tramite(nuc , idMp, mes, anio, estatResolucion, idUnidad);
                        }

                    }
                }
            }
        }
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("&nuc=" + nuc + "&acc=" + acc);
    } else if (cantidadinicio === 13) {
        // Si la longitud es 13, esperamos 500ms antes de validar.
        // Si el usuario escribe otro carácter, este temporizador se cancelará.
        nucValidationTimer = setTimeout(() => {

            nuc = document.getElementById('nuc').value;

            acc = "existeNuc";
            ajax = objetoAjax();
            ajax.open("POST", "format/litigacion/accionesNucsLit.php");

            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {

                    var cadCodificadaJSON = ajax.responseText;
                    var objDatos = eval("(" + cadCodificadaJSON + ")");
                    if (objDatos.first == "NO") {
                        getExpediente("expedCont", nuc);
                        swal("", "El numero de caso no existe.", "warning");
                        document.getElementById('nuc').value = '';
                    } else {

                        if (objDatos.first == "SI") {

                            if(estatResolucion != 181){
                                ////// VALIDAR SI EL NUC SE ENCUENTRA YA JUDICIALIZADO O NO ///////
                                checkNucJudiciImputado(estatResolucion, idMp, mes, anio, deten, idUnidad);

                                /////// SE EJECUTARA CUANDO YA SE QUIERA INSERTAR EL NUC EN BD DESPUES DE VALIDAR LOS IMPUTADOS
                                // getDatosNucDetermEstlit(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad);
                            }else{
                                sendDataModalImputadosNUC_tramite(nuc , idMp, mes, anio, estatResolucion, idUnidad);
                            }

                        }
                    }
                }
            }
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            ajax.send("&nuc=" + nuc + "&acc=" + acc);
        }, 500); // 500 milisegundos = medio segundo
    }

}

////////////////////////////////

function getDatosNucDetermEstlit(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad, idImputado) {


    cont = document.getElementById("contDataNucDeterm");
    acc = "getDataNuc";
    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/accionesNucsLit.php");

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {

            cont.innerHTML = ajax.responseText;
            existenuclitigacion(nuc, idMp, estatResolucion, mes, anio, idUnidad, deten, idImputado);
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc + "&acc=" + acc + "&estatResolucion=" + estatResolucion + "&idUnidad=" + idUnidad);
}


///////////////



function existenuclitigacion(nuc, idMp, estatResolucion, mes, anio, idUnidad, deten, idImputado) {



    acc = "existeNuclitigacion";

    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/accionesNucsLit.php");

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {

            var cadCodificadaJSON = ajax.responseText;
            var objDatos = eval("(" + cadCodificadaJSON + ")");

            if (objDatos.first == "judicializado") {
                swal("", "El NUC ya fue judicializado.\n\n Ministerio Público: " + objDatos.nomCompleto + '\n Unidad: ' + objDatos.unidad + ' - ' + objDatos.fiscalia, "warning");
            } else {



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
                            estatResolucion == 129 || estatResolucion == 57 || estatResolucion == 151 || estatResolucion == 154 || estatResolucion == 66 || estatResolucion == 165
                            || estatResolucion == 140 || estatResolucion == 139 || estatResolucion == 141 || estatResolucion == 144
                            || estatResolucion == 145 || estatResolucion == 142) {
                            showModalNucLitInfo2(estatResolucion, nuc, idMp, mes, anio, deten, idUnidad, 1, idImputado);
                        } else if (estatResolucion == 50 || estatResolucion == 53 || estatResolucion == 58 || estatResolucion == 153) {
                            showModalAgregarImputados(estatResolucion, nuc, idMp, mes, anio, deten, idUnidad, idImputado);
                        } else {
                            setTimeout("insertarNucLit(" + idMp + "," + estatResolucion + "," + mes + "," + anio + "," + nuc + "," + deten + "," + idUnidad + ",0,0,0);", 100);
                            // idMp, estatResolucion, mes, anio, nuc, deten, idUnidad, opcInsert, tipo_investigacion, idImputado
                        }

                    } else {

                        if (objDatos.first == "NOjudicializado") {

                            // swal("", "El Número de Caso no se encuentra Judicializado en sistema favor de ingresarlo como judicializado.", "warning");
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
                                estatResolucion == 129 || estatResolucion == 57 || estatResolucion == 151 || estatResolucion == 154 || estatResolucion == 66 || estatResolucion == 165
                                || estatResolucion == 140 || estatResolucion == 139 || estatResolucion == 141 || estatResolucion == 144
                                || estatResolucion == 145 || estatResolucion == 142) {
                                showModalNucLitInfo2(estatResolucion, nuc, idMp, mes, anio, deten, idUnidad, 1, idImputado);
                            } else if (estatResolucion == 50 || estatResolucion == 53 || estatResolucion == 58 || estatResolucion == 153) {
                                showModalAgregarImputados(estatResolucion, nuc, idMp, mes, anio, deten, idUnidad, idImputado);
                            } else {
                                setTimeout("insertarNucLit(" + idMp + "," + estatResolucion + "," + mes + "," + anio + "," + nuc + "," + deten + "," + idUnidad + ",0,0,0);", 100);
                            }

                        } else {

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
                                estatResolucion == 129 || estatResolucion == 57 || estatResolucion == 151 || estatResolucion == 154 || estatResolucion == 66 || estatResolucion == 165
                                || estatResolucion == 140 || estatResolucion == 139 || estatResolucion == 141 || estatResolucion == 144
                                || estatResolucion == 145 || estatResolucion == 142) {
                                showModalNucLitInfo2(estatResolucion, nuc, idMp, mes, anio, deten, idUnidad, 1, idImputado);
                            } else if (estatResolucion == 50 || estatResolucion == 53 || estatResolucion == 58 || estatResolucion == 153) {
                                showModalAgregarImputados(estatResolucion, nuc, idMp, mes, anio, deten, idUnidad, idImputado);
                            } else {
                                setTimeout("insertarNucLit(" + idMp + "," + estatResolucion + "," + mes + "," + anio + "," + nuc + "," + deten + "," + idUnidad + ",0,0,0);", 100);
                            }

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
function insertarNucLit(idMp, estatResolucion, mes, anio, nuc, deten, idUnidad, opcInsert, tipo_investigacion, idImputado) {

    if (tipo_investigacion == 2) { nuc = "'" + nuc + "'"; }
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

                    /*EN caso de ser el estatus de tramite se tiene que realizar nueva consulta para traer el historial de tramite de ese MPy actualizar tabla*/
                    if(estatResolucion == 165){
                        updateTableNucsLiti_tramite(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad);
                    }else{
                        updateTableNucsLiti(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad);
                    }
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
                            setTimeout("insertSentencias_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + "," + idMp + ", " + mes + ", " + anio + "," + tipo_investigacion + ");", 100);
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
                            setTimeout("insertSentencias_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + "," + idMp + ", " + mes + ", " + anio + " , " + tipo_investigacion + ");", 100);
                            break;
                        case 50: case 53: case 58: case 153:
                            setTimeout("insertInputados_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + "," + idMp + ", " + mes + ", " + anio + ");", 100);
                            break;
                        case 165:
                            setTimeout("insertFormMotivosTramiteCarpeta_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + ");", 100);
                            break;
                        case 140: case 139: case 141: case 144: case 145: case 142:
                            setTimeout("insertHorasAudiencia_db(" + objDatos.idEstatusNucs + "," + estatResolucion + "," + nuc + ", " + opcInsert + "," + idMp + ", " + mes + ", " + anio + ", " + idUnidad + ");", 100);
                            break;
                        default:
                            break;
                    }
                }
            }

        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc + "&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes + "&anio=" + anio + "&deten="
        + deten + "&idUnidad=" + idUnidad + "&tipo_investigacion=" + tipo_investigacion + "&idImputado=" + idImputado);

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
function removeDataSenap(idEstatusNucs, estatResolucion, idMp, mes, anio, tipo_investigacion) {
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
        ajax.send("&idEstatusNucs=" + idEstatusNucs + "&estatResolucion=" + estatResolucion + "&tipo_investigacion=" + tipo_investigacion);
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
        || estatResolucion == 50 || estatResolucion == 53 || estatResolucion == 58 || estatResolucion == 153 || estatResolucion == 165
        || estatResolucion == 140 || estatResolucion == 139 || estatResolucion == 141 || estatResolucion == 144 || estatResolucion == 145
        || estatResolucion == 142) {
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

//PRECARGAR TIPO INFORMACION
function tipo_investigacion() {
    var TIPO_INVESTIGACION = document.getElementById('TIPO_INVESTIGACION').value;
    if (TIPO_INVESTIGACION == 1) {
        $('#div_averiguacion').hide();
        $('#div_nuc').show();
        $('#NO_AVERIGUACION').val('');
    } else {
        $('#div_nuc').hide();
        $('#div_averiguacion').show();
        $('#nuc').val('');
    }
}

function averiguacionInserts(idinput, idMp, mes, anio, estatResolucion, deten, idUnidad) {
    NO_AVERIGUACION = document.getElementById('NO_AVERIGUACION').value;

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
        estatResolucion == 129 || estatResolucion == 57 || estatResolucion == 151 || estatResolucion == 154 || estatResolucion == 66) {
        showModalNucLitInfo2(estatResolucion, NO_AVERIGUACION, idMp, mes, anio, deten, idUnidad, 2, 0);
    } else if (estatResolucion == 50 || estatResolucion == 53 || estatResolucion == 58) {
        showModalAgregarImputados(estatResolucion, 'NO_AVERIGUACION', idMp, mes, anio, deten, idUnidad);
    } else {
        insertarNucLit(idMp, estatResolucion, mes, anio, NO_AVERIGUACION, deten, idUnidad, 1, 2);
        //insertarNucLit(idMp,estatResolucion,mes,anio,NO_AVERIGUACION,deten,idUnidad);
    }
}

function deleteResolLit_ave(idEstatusNucs, idMp, anio, mes, estatResolucion, nuc, idUnidad) {


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
                                setTimeout("removeDataSenap(" + idEstatusNucs + "," + estatResolucion + "," + idMp + "," + mes + "," + anio + ",2);", 100);
                            }
                        }

                    }
                }
                ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                ajax.send("&acc=" + acc + "&idEstatusNucs=" + idEstatusNucs + "&idMp=" + idMp + "&anio=" + anio + "&mes=" + mes + "&nuc=" + nuc + "&idUnidad=" + idUnidad + "&estatResolucion=" + estatResolucion + "&tipo_investigacion=2");

            }
        });

}


//Funcion para cargar el modal de carga de excel
function cargarModal_Excel(nuc, idMp, mes, anio, estatResolucion, deten, idUnidad){
    $.ajax({
        type: "POST",
        dataType: "html",
        url: 'format/litigacion/modalCargarExcel.php',
        data: "idMp="+idMp+"&mes="+mes+"&anio="+anio+"&estatResolucion="+estatResolucion+"&idUnidad="+idUnidad,
        success: function(respuesta){
            $('#contmodal_cargaNucsExcel').html( respuesta );
            $('#modal_cargaNucsExcel').modal('show');
            dataTable_iniciar_litigacionCargaExcel();
            $('#modalNucsLitig').modal('hide');
        }
    });
}

/*
//Funcion para cargar el modal de carga de excel
function cargarModal_Excel(nuc, idMp, mes, anio, estatResolucion, deten, idUnidad){


	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/modalCargarExcel.php");

	cont = document.getElementById('contmodal_cargaNucsExcel');
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			$('#modal_cargaNucsExcel').modal('show');
			dataTable_iniciar_litigacionCargaExcel();
			$('#modalNucsLitig').modal('hide');
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send();

}*/


//Función para inicializar la tabla de nucs cargados de excel
function dataTable_iniciar_litigacionCargaExcel(){
    var table = $('#gridPolicia').DataTable();

    table.destroy();


    table=$('#gridPolicia').DataTable({
        retrieve: true,
        "language": {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        scrollY: 400,
        select: true,
        dom: 'Blfrtip',
        lengthMenu: [[10, 25, 50, -1],
            ['10', '25', '50', 'todo']
        ],
        buttons: [{
            extend: 'excel',
            title: '',
            messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
            exportOptions: {
                columns: [ 0, 1, 2]
            }
        },
            {
                extend: 'pdfHtml5',
                title: '',
                orientation: 'landscape',
                messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABJ4AAAC2CAYAAACYo0eiAAAgAElEQVR4XuydBXhUR9uGn7O7cSNOEkJCcIJLcS9a3ArF3d3diru7Q3GKQ4s7xd0tQAKEJMR9M/81s5HdZJPdDeH/Snm3Vz/6sWfPmblnzsgzr0igDxEgAkSACBABIkAEiAARIAJEgAgQASJABIgAEfgGBKRvcE+6JREgAkSACBABIkAEiAARIAJEgAgQASJABIgAEQAJT9QJiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEg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',
                        width: 500,
                        height: 80
                    } );
                }
            }],

        "order": [], // "0" means First column and "desc" is order type;

    } );
}

function closeModalCargarExcel() {
    var idMp = $("#idMp").val();
    var mes = $("#mes").val();
    var anio = $("#anio").val();
    var estatResolucion = $("#estatResolucion").val();
    var idUnidad = $("#idUnidad").val();

    updateTableNucsLiti2(idMp, anio, mes, estatResolucion, nuc, 0, idUnidad);

    $('#modal_cargaNucsExcel').modal('hide');
    $('#modalNucsLitig').modal('show');
}

function cargar_excel(input){

    var archivoInput = document.getElementById('file');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.xlsx)$/i;
    var tamano_m = function(mega){ return Math.pow(2,20) * mega; }
    //Validar formato de archivo permitido: EXCEL
    if(!extPermitidas.exec(archivoRuta)){
        swal("", "Formato de archivo incorrecto. \n Formatos permitidos: xlsx", "warning");
        archivoInput.value = ''; //Para que no se almacene en buffer
    }else{
        if (input.files && input.files[0]) {
            console.log(input.files[0].name);
            var reader = new FileReader();
            var progress = document.getElementById('progreso');
            var etiqueta = document.getElementById('etiqueta');
            //Funcion para barra de progreso
            reader.onprogress = function (ev){
                progress.value = (ev.loaded * 100) / ev.total;
                etiqueta.innerHTML = Math.round(progress.value) + "% Carga completa";
            }
            reader.onload = function (e) {
                $('#imgMando').attr('src', e.target.result); // Renderizamos la imagen
            }
            //Despues de validar y renderizar invocamos a la función para subir imagen al servidor
            //Guardamos datos de la imagen para enviarlos al servidor
            //var myFormData_excel = new FormData($('#filesForm')[0]);
            var myFormData_excel = new FormData();
            myFormData_excel.append('file', input.files[0]);

            console.log('antes de: ' + myFormData_excel);
            leer_excel(myFormData_excel);
        }
    }
}

function leer_excel(myFormData_excel){
    var table = $('#gridPolicia').DataTable();
    var table2 = $('#gridPolicia2').DataTable();
    $("#gridPolicia").hide();
    table.destroy();
    $("#gridPolicia2").hide();
    table2.destroy();
    console.log('entra aca ' + myFormData_excel );
    var cont = 1;
    var cont2 = 1;
    $('.preloaderSelect_NUC').show(); //GIF carga de información
    $('#filesForm').hide(); //GIF carga de información
    $.ajax({
        //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
        url: 'format/litigacion/importar_excel.php',
        type: 'POST',
        contentType: false,
        data : myFormData_excel,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        $('.preloaderSelect_NUC').hide(); //GIF carga de información
        var json = respuesta;
        var obj = eval("(" + json + ")");
        console.log('NUCS VALIDOS: ' + obj.nucs);
        console.log('NUCS INVALIDOS: ' + obj.nucs_invalido);
        var axu = 1;
        $("#gridPolicia").show();

        let	array_data_imputado ;

        for (i = 0; i < obj.longitud; i++) {

            getData_imputados(obj.nucs[i], function(arrayData){
                array_data_imputado = arrayData;
            });

            var html = '<tr>';

            html += '<td>' + cont + '</td>';

            if(axu == 3){
                html += '<td class="tdRowMain"><span class="glyphicon glyphicon-ok spanOK"></span></td>';
            }
            else{
                html += '<td class="tdRowMain"><span class="glyphicon glyphicon-remove spanRemove"></span></td>';
            }

            html += '<td>' + obj.nucs[i] + '</td>';

            if(array_data_imputado == 'SIN IMPUTADO'){
                html += '<td class="td_editar"><center><button type="button" class="editar btn btn-primary btn-lg redondear" data-toggle="modal" href="#editar" ><span class="glyphicon glyphicon-pencil"></span> Capturar </button></center></td>';
            }else{
                html +='<td><select class="imputados select-css"><option value="0">Seleccione el imputado</option>';
                for(k = 0; k < array_data_imputado.length; k++){
                    html += '<option value="'+array_data_imputado[k][0]+'">' + array_data_imputado[k][1]+' '+array_data_imputado[k][2]+' '+array_data_imputado[k][3] + '</option>';
                }
                html += '</select></td>';
            }

            html += '<td><select class="etapa select-css"><option value="0">Seleccione la etapa</option><option value="1">Etapa inicial</option><option value="2">Etapa intermedia</option><option value="3">Etapa de juicio oral</option><option value="4">Etapa cero</option></td>';

            if(array_data_imputado == 'SIN IMPUTADO'){
                html += '<td class="td_guardar_data_imputado"><center><button type="button" class="guardar_data_imputado btn btn-primary btn-lg redondear" ><span class="glyphicon glyphicon-pencil"></span> Guardar  </button></center></td>';
            }else{
                html += '<td class="td_guardar_no_data_imputado"><center><button type="button" class="guardar_no_data_imputado btn btn-primary btn-lg redondear" ><span class="glyphicon glyphicon-pencil"></span> Guardar  </button></center></td>';
            }


            html += '</tr>';

            $("#gridPolicia tbody").append(html);

            cont++;
        }
        for (j = 0; j < obj.longitud_invalido; j++) {
            $("#gridPolicia2 tbody").append('<tr><td>' + cont2 + '</td><td>' + obj.nucs_invalido[j] + '</td></tr>');
            cont2++;
        }
        if( j > 0 ){ $("#gridPolicia2").show(); $("#div_nuc_invalidos").show(); }
        reloadDataTable();
    });

}

function getData_imputados(nuc, my_callback){
    console.log('recibe ' + nuc);
    $.ajax({
        type: "POST",
        dataType: "html",
        async: false,
        url: "format/litigacion/getDataImputados.php",
        data: 'nuc=' + nuc,
        success: function (respuesta) {
            var json = respuesta;
            var obj = eval("(" + json + ")");
            my_callback(obj.imputado); //AQUI
            return obj.imputado;
        }
    });
}

//FUNCION PARA OBTENER LOS DATOS DE LAS COLUMNAS Y EDITAR AL HACER CLIC
var editar = function(tbody, table){
    $(tbody).on("click",".td_editar", function(){

        var rowData = table.rows(this).data().toArray();
        var rowNodes = table.rows(this).nodes().toArray();

        var datos_columna = [];
        for (i = 0; i < rowData.length; i++) {
            let selected_imputado_nombre = $(rowNodes[i]).find("select.imputados option:selected").text();
            let selected_imputado_idLitigacion = $(rowNodes[i]).find("select.imputados option:selected").val();
            let selected_etapa_nombre = $(rowNodes[i]).find("select.etapa option:selected").text();
            let selected_etapa_id = $(rowNodes[i]).find("select.etapa option:selected").val();
            let tempObj = {
                id_registro: rowData[i].id,
                nuc: rowData[i].NUC,
                imputado: selected_imputado_nombre,
                imputado_idLitigacion: selected_imputado_idLitigacion,
                etapa: selected_etapa_nombre,
                etapa_id: selected_etapa_id
            }
            datos_columna.push(tempObj);
        }

        $("#id_registro").val(datos_columna[0].id_registro);
        $("#nuc_label").text(datos_columna[0].nuc);

        console.log(datos_columna[0].id_registro + ' Se ha seleccionado el nuc: ' + datos_columna[0].nuc + ' con el imputado: ' + datos_columna[0].imputado + ' con ID: ' + datos_columna[0].imputado_idLitigacion + ' en la etapa: ' +  datos_columna[0].etapa + ' con id de etapa ' +  datos_columna[0].etapa_id );

        /*USAR EN CASO DE GUARDAR MASIVAMENTE
          var dataArr = [];
          for (i = 0; i < rowData.length; i++) {
            let selected_imputado = $(rowNodes[i]).find("select.imputados option:selected").text();
            let tempObj = {
              nuc: rowData[i].NUC,
              imputado: selected_imputado
            }
            dataArr.push(tempObj);
          }
        */
    })
}


//FUNCION PARA INICIALIZAR DATATABLES
function reloadDataTable(){

    var table = $('#gridPolicia').DataTable({

        retrieve: true,
        "language": {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        scrollY: 400,
        select: true,
        dom: 'Blfrtip',
        lengthMenu: [[10, 25, 50, -1],
            ['10', '25', '50', 'todo']
        ],
        "columnDefs": [ { "width": "5%", "targets": [0,1] } , { "width": "30%", "targets": [3] } , { "width": "20%", "targets": [4] }],
        rowId: 'id',
        "columns": [
            { "data": "id" , className: "text-center"},
            { "data": "Capturado?" },
            { "data": "NUC" , className: "text-center"},
            { "data": "IMPUTADO" },
            { "data": "ETAPA" },
            { "data": "ACCIONES" },
        ],
        buttons: [{
            extend: 'excel',
            title: '',
            messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
            exportOptions: {
                columns: [ 0, 1, 2, 3 , 4, 5, 6]
            }
        },
            {
                extend: 'pdfHtml5',
                title: '',
                orientation: 'landscape',
                messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                },
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABJ4AAAC2CAYAAACYo0eiAAAgAElEQVR4XuydBXhUR9uGn7O7cSNOEkJCcIJLcS9a3ArF3d3diru7Q3GKQ4s7xd0tQAKEJMR9M/81s5HdZJPdDeH/Snm3Vz/6sWfPmblnzsgzr0igDxEgAkSACBABIkAEiAARIAJEgAgQASJABIgAEfgGBKRvcE+6JREgAkSACBABIkAEiAARIAJEgAgQASJABIgAEQAJT9QJiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEg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',
                        width: 500,
                        height: 80
                    } );
                }
            }],

        "order": [], // "0" means First column and "desc" is order type;

    } );

    editar("#gridPolicia tbody",table);
    agregar("#gridPolicia tbody",table);
    guardar("#gridPolicia tbody",table);


    table2=$('#gridPolicia2').DataTable({
        retrieve: true,
        "language": {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        scrollY: 400,
        select: true,
        dom: 'Blfrtip',
        lengthMenu: [[10, 25, 50, -1],
            ['10', '25', '50', 'todo']
        ],
        buttons: [{
            extend: 'excel',
            title: '',
            messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
            exportOptions: {
                columns: [ 0, 1, 2, 3 , 4, 5, 6]
            }
        },
            {
                extend: 'pdfHtml5',
                title: '',
                orientation: 'landscape',
                messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                },
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABJ4AAAC2CAYAAACYo0eiAAAgAElEQVR4XuydBXhUR9uGn7O7cSNOEkJCcIJLcS9a3ArF3d3diru7Q3GKQ4s7xd0tQAKEJMR9M/81s5HdZJPdDeH/Snm3Vz/6sWfPmblnzsgzr0igDxEgAkSACBABIkAEiAARIAJEgAgQASJABIgAEfgGBKRvcE+6JREgAkSACBABIkAEiAARIAJEgAgQASJABIgAEQAJT9QJiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT/+CPqBUKlm8UomEhAQwxmBuZqbRLvx7SBLkMhm117+gvagIRIAIEAEiQASIABEgAkSACBABIkAEiIB+BEjI0I9Tll0VHh7BfD9+wrv3vvjoH4AGdWviyPFT+PvcBQQGBkEmk6FVk4Zo3awhFAqFFB0Tw6bNXQJIwPhhA2FsbCTFxsYxn3fvkc3GGo4O9tSGWdY6dCMiQASIABEgAkSACBABIkAEiAARIAJEICsJkGiRlTS13Cs2Lo4FBX2Bk6MD3vl+wNQ5i/Dhkz9iYmNRuGB+TBg+EDMXLsOdB4/Rv0cnnLlwGTfv3Meu9Svg7OQgXbx6nQ0YPQkJygTs2bgCebw8pfe+fqzHkNHo3LoFWjZtSG34jduQbk8EiAARIAJEgAgQASJABIgAESACRIAIZI4AiRaZ45bhr2JiYlhA0Be4uWSX7j18zIaO/x0Lp0+EvZ0tmnfsiXKlS6JFo/rcegmlihWRJs1awO7ef4RJowbj4PGTOHbyLP7cvFoIT/1GTGDvfH3BGIQV1G8tmkjXbt1hvYaNw7KZk1H+p1LUht+gDemWRIAIEAEiQASIABEgAkSACBABIkAEiMDXEyDR4usZJt8hPj6eJSQwnLl4GcvWbkGdGpXRvFF9tOs1CI3q/owBPTpLvYeOYc9evoFCLkcujxxYOX+GtGL9FrZu607Ex8dDrlCga7tf0adLe+n+o8esc7/hcHKwR3RsLMqUKIZZE0dJG7btZOu37caOtUvh5po93TYMj4hgUVHR5I6XhW1MtyICRIAIEAEiQASIABEgAkSACBABIkAE9CdAwpP+rNK9kgtO/9y8jeXrtqBOzaooWqgAegweDWUCQ7WKZZGgVOLFq9c4tGOjNGXOQvbX6QuYPXEU7Oyywd7WFtv3HsDRk2fQs2M7LF27EeXLlMTw/r2EC97ZS1cxsFdXHP7rNKKjo7B+yVxMnDkfsbGxWD53Wobtt/fgUbZy0x+oW70qOv7WAg52ttTeWdDedAsiQASIABEgAkSACBABIkAEiAARIAJEQD8CJEToxyndqx4+ec627NqLq9duoUqFsmj3a1Pky+0lte0xgH36HCAsm/ifYMDmlQvx6OkzzF26CrWrV8VbXz9IYChdvCievfLB5JGD8PjZC/yxZz9aNv4Fp85fRv48Xmj/azPp2MmzbNGqdRgzuB9mLlwOMzMztGvZBLk8c6Jg3jwwMTHWaMvQ0DDWqe9Q/liYGBsjThmPKaOGwLtAPmrzr2xz+jkRIAJEgAgQASJABIgAESACRIAIEAEioB8BEiHUOH15c48po8NglaMQTCwztg6KjIxiJqYmOHH6PMbNmIdWjeqjeBFv3LhzDyMG9MIfew8KAWnkgF7Ytf8Ibtx7iGb1a6FpgzqYt3SNiPdUpFABFMqfB7lzeYAxBhtr63Tbg/vwvXjtAytLC5y/cg0Xr97Ag0ePkd3ZGTMmjICHew6N3+7Yd5DNXrwS6xfPQS5Pd7Tq3AeFCuTHgmnjpYSEBMafJ5fL031eQnwciwh8j6jPb2CTqwRMLLJRX9HvnaKriAARIAJEgAgQASJABIgAESACRIAIEIFEAiQmJIIIfHmT+V7bDwWUiJebwdajKKzd8sHCKRcUxqbJnBISlOzQsZPYtvcARg3sjZLFiki9hoxm9x89hZ2tLWpVq4jeXdvj8dOX6NR3CMYNG4Da1Spj4/Y9wnqpVvXKaZhHx8SyLyHhCAoORWR0DHicqHhlPIyNjGCkkMPUxBh22azhZK8p/kRGRTG/j5/glt2ZW0Al3/fLlxD2a9c+KF6kEGZPHiuFh0ew5p16oWyp4pgyeqi0bN1m9u69Hwb26gIXZyeN8kSH+LPQj68Q9vYBQj68gKWJAlI2d3hUag1jCxvqLzR0EAEiQASIABEgAkSACBABIkAEiAARIAJ6EyAhAUDgq1vM75/9kLE4xMQpYayQw87GHGEyO3jV6AQjUwvBKSY2li1euQ57Dx1HxzYtUKhAXlhZWiJBmYCeQ8agQ+tmqF+rOhav2gAHezu4u7kif24vVCxXOplzTGwce+vnjxv3nuLOoxd4/e4D/INCEBwSjrCICERFxyAuTokExoSbnrGxAhZmprCxsoS9rTVcnOyQL1cOlC5aACW988LWxjJNG/55+Dj7ff4y1KhcHkP7dMO2PfuxZdc+7F6/AsEhIRg0ZgpkMhnsbG3Qp2tHVK9UnmfYE/f58uY+e3thK6wtTBESHi0ssczNjAErV+Sq2hbG5iQ+6f120YVEgAgQASJABIgAESACRIAIEAEiQAR+cAI/vPD0xec+e39lD2QJcYiOjYMkSbAwNYbczgM5yjaFqbVDMqNrt+6wXkPHYeG08TA3N8OQsVNhamqMFfOmY9XGbTh94QqsLS2QL3cudO/QBqWKFxW/DQ2PYHcevsTZf+7ixMUbeOHjh7DwSDBJBkmSAYyB/8P/VH2S/kx6tARJ/KcMkACWoISJkYKLTihdND/qVCmDcsULolBeD3FVWHgEO3T8BA4eP4V3vn6IiopCz85t0aZZY7TvNRB+H/wxd+pY3Lx7HyfPXcKsCaNQxLuA+G2CUsm+vLmL98L6Kw7RMfH8kbAwM4HcPhc8K/8GhUmKddUP/v5Q9YkAESACRIAIEAEiQASIABEgAkSACBCBDAj80MJTmP8b9ubsFsiVUYiKUYlO5lx0sveCZ8VWMDLTtCa6fO0G6zdyIpbNnoLwiCjcf/QEF678A9fszvitRRMcOXFauNVVq1RecH3n5892Hz2P4xeu49L1+4BMkSgucWFJXWgytI9KQoAS/yNJ4P842lqhWrliaFKnEhrWKMctmqTwiAh2+vxlmJqYoGqlcpg2bwkuXLmGPLk8ERQcjJED+yCbtRXilUpcvHodzRrU5ZZaKssnnwfM79o+SHHRiFIT5IxdCsGjQkvIFCoLKfoQASJABIgAESACRIAIEAEiQASIABEgAkQgPQI/rHgQExbE3pzdBEQGIDwqVvCxNDOBkWNuuFf4FUam5mnYhIaFs77DxyEgKAhLZk6BkZEC/UdOhL1tNiyb+zvME+MsvfTxYxt2H8fOw2fgFxAshCHGlGoWTd+gQ3LrKZkcRnIJJb3zoMdvDdDk54owMVEJRI+fvWDtew1G8SIFeZwn/HX6PEoW9RYBzvsMHYtb9x5gy6qFyJ8nd3K9g97cY++u7IGCcWuweOGeZ6KQwzp/RbiVqAdJJvth+883aEG6JREgAkSACBABIkAEiAARIAJEgAgQgf8cgR9SOFDGxbLXZzcjIdgHYRHRKtHJ3ASSlSs8q7aDsXn62eUePH7GBo2ZJLzi4uPj4F0gP8YP7w8XZ2cp8EsoW7PjMNbuPI4PAcEqoYklqLnO/T/0H+6Tl+i+V61sUfTv2BR1q5YR7XzizHm2YuM2ZLOxxsj+vZAnlweGTZyOS//cwKyJo1C9coU0/SHw1W3md3UvwOKT41/J5HJkL9MEDnlU96UPEfjRCERFx7Dj567BxdEe5UoWovfgR+sAVF8iQASIABEgAkSACBABIpABgQ/+gez05dsoXSw/8udy/+H3Cz8kgHc3jrKw5xcRExsvgnjzmE6ShSM8q3WAiZXK1Syjz7OXr9iJMxd5Rjg0rvcz5AqFdPDkJTZj+Xbce/ZWJTYJwSlzH2WCKsaT/KsMiiRhAWVirEDrX6phZO/WyOnqJPl9+MhmLFoBT3c3xMXH48DRExg9qA8a1auVbr0/PbrIPt06JHS0uPgEmJkaIUFmAq+aXWDhQC9R5lqZfvW9EeCJAZ6/eY99f13E8bPX8OCZD1o3qIbVM4boHDO+t7pSeYkAESACRIAIEAEiQASIABEwjEBoWAS7cf8Zjpy5ihOXbuPlG18snzoAHZvX+eH3Cz8cAB67yPfyDiQo4xEbr4SpkQIJchPkqt4RVs65DOYRHBrOpi7ZgjU7jkLJ9aKEzFk4ca0pXsmgZAxWJnLxZ0RMgnCd4/9m+sOtnyQZ8nm6YvLA9mhUq6K42cWr19mA0ZNQ8adSWDJris4HvL9+iIW9vIromDgh1lnyTHfWbshdozMFG89049APvwcCr3z82Jmrd3Di4k2cvHQTUbFKlfssgCqlC+HPVVNgamKs8x36HupKZSQCRIAIEAEiQASIABEgAkTAMAJ3Hr1kpy7dxNGz1/DP7cciiZgqFjPQt30DzBrZ44ffK/xQAGIigtnLE2shRX9BZHQsFHK5cINzK9cCDnlVbmMPHz9lj5+9RKVypZHd2SlDPncfv2TDpq3ElTtPwTJh5cQ3rlxsilMy5HM2RRE3c7GZLZnTAg6WCrwOiMH1N+H453U44uIZuDilkEvIlCGUTA5TYyMM7tIUo3u3hVwuk7bu3MdWb/4DrZo2RNe2v8LMzDTd+irjY9nLM5uREPQaEVGxkEkSzEyMYJW3MtxK1f2h+pFhwxBd/T0SiIuPZ39fuIH9f1/C1VuP8crXX1UN9VhtkgwOtla4eXAlHOxs6B34HhuaykwEiAARIAJEgAgQASJABDJBgFs37TpyDkfPXsWdx6/gHxQKlhRqJzFbvSQ3Qs1yRcRBNU/+lYnH/Gd+8kNV3ufyHhb19g4iomNUGexMjGDuWQo5yzVL5tBvxHh2+dotWFtZoEr5sqhSsSyKeReEo4O9Bqvj566zIdNWwOdDIKCM09khuGjEO2KS+xwXm+QywNHKCBExSliayFExjxUKZDfDT7ks4WZrjKP3g3H6SSjOPwuFqZEMNmZyBEXEIyo2AUYKlYKq8spjQgjS+UlUXpvVroAF4/vAwdZG2n/kL7Z19z5MGT0MhfLnzfAm0SH+7PmJNZDHRSAqOg7GxnIwyQi5anSGVXYvPQqgs4R0ARH4VxAICQ1njXqMw81HPmAJ8UCCMlW5JAgFmDHsWzEZdaqUpv7/r2g5KgQRIAJEgAgQASJABIgAEfj2BF688WXlm/cTe3PG9wppQu1IgFyOvDmz49iGGXBx0tQTvn0J/11P+GE2SyG+T9mr0xvAvda4i52FqRFg4Yx8dXpAbmyWzGHHvoNs1qIVqFT+J1y+ekNYIOXO5YE+XdolB9/eceg0GzJtFULDI1WdTMeHi0PGiS5zgRHxQnxytzVGdhsjtCnjgLAYJbZe/YzHflGoU9gW/Ws6w9naCItPfsTum4GwNpXjt7IOKOxmjoN3g/D4QzR8v8QiMlYJG3OFuF9kjFK/mFAi+LgclUsXxJoZQ+Hu4iR9+vyZOdjZQS5P69MXHhHJAoO+wMPdTTAKfMmDje9GQoIS8coEVXysbDmQ9+dukClUGfToQwT+CwQmzN/A5q/fp3rHhbArQeLiLZd6mRL80CKbpQVmj+mJNg1rUN//LzQ61YEIEAEiQASIABEgAkSACOhBgMd/bdVvCk5dvqs6qFbbLzCuIiQkQGGkQKHc7lg/ezgK5vH4ofcLP0TllXEx7Dl3sQv7gPCoGOFiJ8nl8KzeCdYueaV7D5+wwgXzCfM3nq1qyLjJePbSB/m9PFGvdnW8ePkG9WpVQ4G8eaQt+06wwb8vR1SsNiuItD2Ui04mCgm1C9mgeE5L/PUgGC8+R6NWIWvhUieXy/A5NA5+wXH483YQ5rXyQGkPCxEvKjA8DoN3voGNmQK/FM0mXPLsLBR48SlGCFDGCgkNi9kiKpZh980ABIZz8UmPt4RfIjdCheL5sWnuCLg6O2jtBy9evWGzFq/AR//PWDlvBtxcnMV1r89vZzEfHgiXO7lMBq5XOZVsBOeCabPi6VkauowI/OsIPHj6mpVv1g9MbgwWHwtHOxt+UgHPHE6oUKowiuTPhfxe7sI60iIDN9V/XcWoQESACBABIkAEiAARIAJEgAh8NYFVfxxiQ2dtECKTjMXDycEWrs72KJzPEyUL50OxAl7wyOEMGytLmBj/2EYaP4Tw9PnZP8z/xn7ExinB1UdzU2OYe5RBznJNpPuPnrIlqzcIq6Yu7X6Fo72ddPfBI9a5/3A0b1AHY4cOSGa0/++LrNf4xQiLiNLieqO93/JA3CYKGTqUc0SZXJYwUQAh0QkithN3nfsUFodnn6LxPigW0XEJGFLbRVhDxSshAozPP+GHjyHx8LAzhqejCTzsTcA1rzhlAuwtFYiJY3gfFIM1F/2FeKXQV3jijnoyOSqVKoBNc0chu2NKNj+lMoHtPXgUqzf9AXMLc2HZkdvTA7MnjRGxoaJDA9jzv1ZBxl3uYuOE1VOCsTXy1u0NY3PrH6JPffUoRTf41xOIjollkxZsgsJYgSL5PJHXMwfy5coBS4sUC8l/fSWogESACBABIkAEiAARIAJEgAh8EwKPX/iweWt2I5d7dhQt4AVP9+ziYNrY6McWmbTB/s+LBPExkezJ0WWQooIQHRsPU2MFmLGVEElMLG2l0LAwduTv01i0cgMcHOwwrE93VKtcXpq5cDk7cfYCtq1aJIKMX7h+n7UdNB2BIeF6i04cOAccGZsg4jbVLZxNBBAPi1bC1dYYPoFccIpDAhief4oW35XysEBwpBIJCUwISy8/R+PSi3A4WRvBxkwGK1MFiriZgbvsKWQy+IXE4sSjYJx8FCLiPOkT6km9I0hyBRrX+AlrZ42AmamxFBAYxKYvWIabd+5DmZCAkkULo22Lxhgybip6dGqLjq2biz7z6eEFFnD3qHBb5GW1MDOGdf5qcC1e6z/fp77JqEU3/dcRSEhIEPEBudj6ryscFYgIEAEiQASIABEgAkSACBCB/ykBvl/40YOG69sA//kNFRdIPt85irh4lbWTibERHIrVg3Ohyhp1v3H7Hlu8eiMePH6CX5s2RK1qlYWLWf1a1aV3fv6sYbexePH2k8p/04APd4/jGeomN8qBWCWDhbFcxHZSyGW48zYcPkGxuPg8TIhJPxfKJtzr/nkVLsSqkh6WyJ/dFLd8wnH2WSjyOJqiqLsFCjibwcZcDr/gWCFSOVopMO/vD7j1NkK49Rn0EWKVDIM7N8PUoZ0lv4+fWLseA+Dl6YHBfbth8OjJ6Nu1g/BZjY6Owa/NGooHxMdGs+d/rQYL/4iomDiYGCuQoLBAgV/6w9iCMnwZ1AZ0MREgAkSACBABIkAEiAARIAJEgAgQgf8oAQNViu+LQnx0BHt6fCVk0YGIjI4TLnbMzB556/SEkalFmrqHh0ewvYeOYfn6zfildk1MGD5Qio2LY20HTsfRC7f0yl6XmhDPWFezUDaMrueKO28j8exTFEKjE1AhtxU+hsYgNEqJj6FxwtKJWz09/RiNbBYKyMAQEqWErYURKuS2xJMPUcJ8ysXaCM42xnjpH413X2JQIbc18jmZ4vTTUCw6+QEWJnr72qUUVZLBSKHA2plD0KJeFenkuYts8uyFmD5uBMzNTGFtZYm8ub2kZy9eMUtLS7hmdxLsgl7dYe8v74BSyW22ABMjBewK14RL0Zr/mn716u0H1mfCoizruJIkR/5crlg4oa/ETSsHT1ulkcGAf9+ucXW0bfKzXgx4Gs5nb97j9sMXeOnjh7d+nxDEreoSP8YKBdzdnGBhaoKcbs4izlCuHC7I6eYEKwtzWJib6vUcdQABQcHs3pPXuPPoBd74foTfp0CER0aLS7jVXI7sDnAT/zrCy90F+bxywNbG6qviGL1+/5ENmrwUMXGphVsZ7KzNMXNkd14/g+py/to9NmPlTs0A/5IM/ds3wi81yhl0r4w6yLy1u9nJpKCB4kIJlmYmmDWqB3J7uBr0HB/fT2zg5KWIjk2dCVMGW2szzBzRHR45sht0z6zo3J8Dg9n9p69x++FzfPgchHd+/ggJj1TVVgJyujjBLpsVcrplh4erMwrn90Q2a0tYW5qnW1a/TwGs66i5PPFf1nwkGTxdHQWjbDaWyc89evYftmTzIY1DAd6PeZ8qWkD/bJs8QOT4eetx/9lbETxeVXkZnGytsHbWcBjzVKJqn817/2bbj5w3+DAiPRjpjR2DpixjT1/7pZTJQJo5XRy5KzUK5MmJiiW9v7p/RUXHsv6TFuP9x0CRUVX9w2P+je3XFhVKehvch7kr+6odx9PwHNu3LSqXKWLw/QzEpHF5RGQU6zx8NkIj+Liofwd2z+4Id1dHFC2QG8UL5kYOF0coFGmTdmgr29Y/T7Bth85laX9q06AqOjSvrcFu8NTl7MkrX40+7u5sj1mjusMu2/+vq/yZK3fY7DW79UrSok97SjI5qpctghE9W+vsLwFBIezRCx8xD75+/xFvfT8hIiom+THWlubI7mgLa0sLnoRFzL3c3Zr/nZWlOUxNjNM8Y832I2zv35e0ZDXSp/QZXSPh11+qoHPLeunWa8nGP9nRczfSjBP8YLFp7Qro0aaBTiapSzBg8hL2/M1HA8YeCc4O2eDu4gjvfLlQvKAXPHNkh5mpicHPTl2W9x8+s9uPXuDZ63fw8fXH63cfxIEy//Bxx83ZnscrhXdeTxTMmxO53F2+as2SXmtcuH6PTV+Rat2ho3n5Os7T3Vms3YoXyoMi+T3hYJdNLyYbdh9ju45dytJxoX2TGvitcebW6drmWz5P5nJzxILxfbW+F4b0fr5GGjRlGaJiYlP9TMKSiX2RN1eOZG5RMTGs64g5CAqJSB6n+TxaopAXJg3qmGbOTq8cvh8+szuPX+Lu45d49/EzfD8EIDZetVbl+5ocrk6iT7s42qOAl7two7KxssiwrqNnr2V3nrxOGdskGZztrDF7dE84O9jq1fY85vDYOevwONV47eqYDWtnDhNxifVhGxcfz169/SDq9/z1e7z184ePn3/yT02NjeDm4ijqWDhfLhTMk1Os8/Sdu/QpQ2xcvFj7vn7Pn5ug8RO+xhzd5zdUKVNUr/roeh4Pk8HHB96mD5+9wUf/IPj6BySvRW0szeGa3UHUka+NeJ1dnGzFmlZbki1dz0v6PqMxuEmt8uj5m8pww5DPgElL2HOflDGY9+/C+dwxa2QPvdufP+/m/Wds/IINwkMp6SPJFGjzS5U0awRDypeZaw2GkJmH/K9+E/DiBvt4bS/i4lSTk7GxAk4lGsCxgCoI9v1HT5i7myuy2aQstu7cf8guXr2BqhXLokihAtKCdXvY+AWbwHh6xEzsoCKilahX1BaDa7ng2cdokYF91L63sDCWoVFxW5GVzkQuISaeCSsnmQxwy2YMMyMZfAJjxN9zKyZzExli45n499TjEDzwjcTwuq7I52wKKxO5sHaaecwXFibyzOGWyZHDyQ7HNs6EV04XacKMeezte19sXDZfsJo2fwnbe/A4crg6Y9GMScjlkVPiVk+vTm1AQuh7EWicC3tKU1vkr9MLRmYpG8PMFShrfnX74QtWuc3QxL2D/huI9J4uyYxQwMMR1w+ulC7feshqdx4PqFnB8e8Hd2yAKUM6Z/hu8U359kNnsP/vi7j3+JXIEMh3+CJrmvCX5GWVRJ8TWRFE31P9qVAokM3KAkUK5ELh/F6oVNIbRQp6wc3ZIcOJ4t6Tl+yPA6dx9Ow/eP3uExJ4n5ZkPFdbyjP5I5Kex5iI78UH6SIFvFC+lDdKF8mHMkXzw1HPRVMSx6Wb/2Sj5mxKrJd6O/C6Slg6sRc6tahr0Hi08/AZ1m3cMjCl2gJFpsDsYR3Rp31jg+6VUW/rOGwW23fyBpgycVMiySEpY3Fu50KULJzXoOes2HqADecBCEX7puWwaFwPdP21vkH3/Jo35f7TV2zb/lPYf+IyfD9+Bo9JB8ggieyXSf2Qd7uUPsj/1tzUBIXz50K5EoVQrkRBMXHzcUO9LM9fv2clGvUWfSwzY2eaeskUcHe0xrkdC4fNDIcAACAASURBVHjgxuRnrfzjEBs+e3NK+4j+LEONst7YsWQ8L6tePLmgUqfjCNx+8g4sIVEYlCmQzUyBl+e3pQkIOXbOOrZ423G1535NS/Aiax87yjTqxZ74fE4pk0GPkTTmLkc7a3RoWgs9fmuAHNkd9eKS+nGnLt1ijXpMAHfT1kwbrMqY2r3lz1gwvo/B956/djebuHRXqnYE1s8YjFa/VDP4fgZhSnVxcGgY86z0G+LB66g7c63q5+qsGWytLVGzYkm0bVwTtSuX1ln+8fPWs4VbjmVpf+rfth6mj+im8eyyTfqwR6+59XZKH3extcT5XQv+39M8bztwivWauEJzDP+KhpPkxmhQtTi2LxqXLm+eNGLHYT73XoKPL58HWdp5MJ2518hIAZfEjUqxQnlQoWRBIbAkbSS5qLdmz0mNNcFXVCfxp6rxrE+bunzTqrVeAV9CWK12w/H8XQDAUh3uSHLkcXfAhV2L+GGVzn6oXt6SDXoyfs/kvqKzMprvAF8TVi5TDC3rV0HzelX0FgLUH8PXWbuOnMOhk5fxMeBL4quW8brF1ESBciW98esv1cRzszL5x64jZ1jXsanWHRlyUV/HJUAmyeCVMzvqVyuLjs1ro0DunBm2yciZq9nyHSeydFwY1qUxJg7sYFBfSKpi2vmWfyMTwtjOJePQ4CsP/aYv/4NNX7krZc2bOLbyd+Ds1pkoXTR/crnDIiKZV+W2iOJdPnGc5vPoT4Vz4eiGGTqDOJ//5y7bdugMTpy/jk+Bwao1N1+HJ6+JRQpjjTUxTwjF59GS3vnEmrikdx6UKVYgTR+r0XYou/7QJ2Vskylga26E87sW8ThAerEPC49ktdoNw8NU47WTjRlenN2iU3hQKpXs8Omr2HP8Ak6cv4GwyKiUOibHZdHcZ0gSg42lBX6uVAptGlZH3ao/6VVWXUPDhWv3WN1OoyEpjLSsG2To0Kgqlv8+6KueFR0dww6cvIzdR8/j/D93ERHN1+yJbaq1vqp9PTe8yOnqJNqxQslCQhwu4Z1HJ1/1Ousag3PnUI3BGR3WamNYqkEv9uyd+vqPr6fjsXzKAHRopnmolFEb/HX+Omved4rGelySm2BA27qYNrzrV3HX1fapv/9/fZihhfua6xOU8ewFF0W++IhTLDMTIySYZkOB+v2gMDGX/D8HsN5Dx4rNd/cObVCnRlXExMaiecdeaFC7Jvp26yDdffyS1e80GsEGBBNPXWYuHHk5mGD+rx4Ij07AlqufceTuF3i7mWF4XTfkcjCFu50xnn2MAtcevF3N8Nw/GuExShR2M0dgeLwQoEp7qmI/8f9efe4Tjt//glK5rNCpoiOKuVvg98PvhSBlapQJi6ek5Y1MgeZ1KmDTvFFSSGgYW7N5uzhJatuyCbr0G4aSxYvgvd8H2GWzxdypY0XfCXhxnfld3QulUFEZD6SG7GWawj6P7oX217Svvr+99+QVK9+8fxYKTwqULpwbZ3cskP6585jVaDdCI+YXV5DH9P4VY/q2TffdOnbmHzZh4UY8fukHxpV/IWryGukSxhJvKf5IGkxlYmP5c/liWDdrOBzs0ro58lBFa3YcxuzVu/ApIFS1ERXP1fVM/oxUz1LGo3ABL0zs3w71q5fVa/zgvs/1Oo3CxVuPtcZHk+RG+KVqKWyeP1rnQkG93fcdv8A6DJ8LplSzHpLJsWhcL3Rr/YteZdOnH/Uau4BtPXguZQEhyWBjaSZE2mIFc+v9HM6hQZcxOHfjYboc6lUpga0LxhrEQZ86pL6Gn4At23IASzfvx0feJxL45lqojjr6YVKfUFkDcaGU/zZ3Tld0aVkbg7q0SObx0seXFf+lB1RDg66+rUctZHIUyp0DR9fPgKN9ymnx+t3H2IApq1JtXiVIMhl+H9IJg7qo4tLp+nDhqVmvCbhw41HK6bJMDndnO9w9tjZNm0xdvIXNWrM36zbN6Ywd1VoPZjcevMyCE+/EMUOmQPniecWJqYeBVoac4ZCpy9nqnWktkwRfmQL5PV1wfNMsOKm1kS72/Ptlm/ezkXM2qvFU9bWt80ejaZ1KerWhPs/R55qQsHBWuE5X1Um6GC8N+SSN06qDBCOFDN1b18fEAe1hYZ5+YoJpS7eyGav2ZGl/GtG9BSak2mDW+G0ou3bvuUYfz+fhimMbZ2gkGTGkxpm9dteRs6zLqAWaY3hmb8aHJLkRfq1fic+FWvsLzzw0d81ufAgIMWDMS5oDkwqWMvcayWXo3LwW5icKrdzKYfHmAwbFAdVdXdXzhnZtnu6B1pEzV9lvg2YgXlgUpxprJUlYMu9ePhF1q5Qx6D2q3Gogu/2IW20YFmJCVafEuULih6EMzWpVwIwRXZHDRWUxr+vD58vZq3di4YY/ER4Zo2qv5Hkko/lE87k1yxfDzBHdUCivp17P1VWuP/+6wNoPS7Xu0PWj5O+T5k+ZmJ9yONthQv92GVofTVywkc1bvz9Lx4VxfdtgVO82meKhfb5VHZzUq1oSm+eNyrSFm++nANag8xg88/mYSkBVvQMXdy1ACe+Uw77wyChWtG43fAoMSR6n+Rq8Rrmior+nlz0sODSczVm9E6t3HEVUTLyefUv7+ptnF+dCxdJJ/TT6WMNuY9mZfx6kjG0yOXJmtxdzo77zbnhEFGvcfRz+STVe53Z3xp0jqzMURj4HBbNx8zZg6/6T4FYywoo7+bVJ7/3RnLu4sS4/qJoypBO3BspUf0nq+qNmrWFLt2hapie/FjI5cudwxvHNM+HqpD3Luq5X7MnLt2zSwk04dPqfRHElqb46xorEoYqPV6qDf8A+mxVqli+OheP78KzVetVb1xjMb8L7ZD0DhbwqrQaxW49eaY7BMjlcHWzx15ZZ3CtFr/LxA8OmvSao9uqJ4yg/qBnZvTnGD2iv1z10tYG+3/+/PkzfQmXFdRGf37Knx5YLlzV+omVsJIe9989wKaYyL42NjWOX/rmOjdt34/6jZyhbqjicHO1x684DrFwwHc5OjmjTfyqOnb+VyUk3pRbckmnwzy7oXMkRZ5+G4viDYLz6HI15rTwgl2S4/iYMYdEJopx8kWokrCeZsDqIiUsQ2e64JVNBVzPkdTLFmD/fIiQyAY1L2KK2tw3uvovEkJ1vRKY8PS0vtSNOXKBsnDsSzetWlo6fOstmLlyBP9Yuxtgps1G0cEGUKOKNibMWYP2SOTzTnRQXHcGe/bUSUmSgiPXEg4wr7HMjd/UO/ET8f96//m3C08GTl1mvsQsRGsEXUqndrTLX8/limweIXz9nOEyMNc3/+eJt/PwNWLhhv+rmep/ep1MWbpLHgP0rJ6GWHqf4/C4Xb9xnjXuMR3RMvPZNnCTBwtQUZ7bPg3c+/ReH35vwdOX2I9ao2zhERsemz8HMFKe3zeXWRN/s3eFmyEN+X45Nf55KNLzS16IjnT6RKEDNGtEFfTs0+ZcITyphjC8g/lw5GaWK5NPJ878vPKW0H19wdGhSDYsn9YdCrp8rGP/1uw/+7JcuY/DqHbeY0dZveLZUCZvnjOCWBjqZq/eo/47wlOo9EYtZGVrULo/Fk/vzdMpauZDwlLn5T/1XGQlPs1ftYJMXb1VZcmrtu4Y/n79HE/q2xoheKte+/5Xw1HPsArbt4Nl0BTy+GW/bqBpWTR9i0Dv5dcKTGk/OXKZAhWJ5hduyro03n6PGzl2HlduPfuUcxZ9rBK8cDtizfCLPMmVQ/bX1iK8TnlLdUaaAkVzCzBFd0attI61l+16EJ/5e8YPqI+unZ9o1evmWA2zE7HVgysSDMA3BLmuEJ24l1WX4bBy9cFs1Dhh8sJC2DW2tzHBl7xK4u6aIqv9L4ck/MJh1Hz0XJ6/cV1lfZvbgj6/tuJBX1lscDGdWfPrgH8QadB0NETIg3XWDDGumDcqUC+ij5z6s7eDpePbmg2qPk9n6JjYtn0cqlyqIQ+um6b0+0mcMbtOgCtbMHGbQGKRVeOLllCnQrHZ5rJ89nFts6bwnCU+Gz+8G/+LdtUMs9MUVxMTFQSGTI0FujAINBsLU2j5NA506f4lt3rEXD54+R/+uHdDpt5bSn39fZO0Gz9DDAkB30WLjE+DpYIpJjXIIcei+b5QILD66vhu4i/qwPW/wJTJeuMxVzmsNR0sjnHseirdBMfC0N4VrNgXeBMSgRSl7kRlvyqH3MDOWo1JeK9iaK7Dhkj+O3g+GuXHmrZ2SasEHmaL5PHB88ywkKOPQtsdAtGraAI+ePId/QAAWzZiMk+cuoGaVSrCxthIs/e6eYF8enhbxe/jEo5TkKPjLAJjZ6mdOqptg5q9IV3gSrkSG8+J8Cud2xdU/lxls8fTm/UdWv/NovP0QqF3MTHSzE2a+ap8UV7skyxE1BV+Sgftnb10wGvWqpTWJ3bzvb9Zv0hIolVzl1nJyn+EzhVKlGcNKboQqpQth97KJeseXEgundfsyFnBlckwf2gkDO+tnncJL9r0JT1OXbGGzVvF4JhmcHktyTBuqv5VOZt6M6cu3senLdya6YBnYJ0SXUHP95P+fCzw2lri8b4mG+1a6Fk+ZfPcgkyOXix1Ob5un4WqX3gmsYCNToHrZwtizfJLO2BNZJjwlu8sa1jp8bBnetQkmDuyoMQCka/Ek08OtWgwV2tzEZTAxUeDs9vkGxcHim66Ow+dCKeJfaD9J5C547RpVw8pphm1yvw/hiW9kM5g3xLuh7Z3ip6lydG5RC/PG9tKaYjld4ekr+tPgjo1E0hD1nvhdWDxlts5yIzSpURpbF4zRqPPpy7dY054TEc/bJyF1+yS6FSe52CTCEvNu0niX7O6uRlImg6ujLf7aNAteOVWx/oSr3e4TGQpbydal6o0i3OzTe59V5evbtj6PK5hm/frBP5BVajkQHwOC099ESwrkyemM45tmGuROma7wlNHYk3p+UBcP5ApUK8M3saNgn0E8sUUb9rIx8zYmWoOnHmdSLM401klis6ltrOPvrBwViufD9sXjtVqFGzJSpys86eqz6Y0NMhlMjIywevpgEWM1dVnSFZ50PS+dSvF5ZmT3ZhjfP3NWDrrmWz72Gypw8qIGh4Wzxt3G4cbDV1pcVbPG4kmZkMDGzF6LZVsPJ1oAaetbiaEGUvHTXIenjCFcpOjTtr6IPakec+l/JTzxWJV9xi/CjqMXAKV2C8jkEBvq+4zkcDJpLSb5+9O1+c+YP76v3kKMOr7Dp6+ytoNnIj6OH7anY4EkV6BV3YrCEtuQOEvcsqvd4Om4ePNpYr/RUv6kkCLptmmKFZC4RJJh05zhaFG/qk5Bh1+u3xgsR24+Bm+cBVfntDpEemNQusITJBF2ZdGE3nqFKSHhyZBRPhPXKmOj2dOjyyBFBwnrAh4I2Ni1MDwrteKmdFJoWBgLDgkD99fnvp2mJibw++SPB4+eombVijA2Nka9zqNw/f6LLDkZ46ZtJkYytC3rgKr5rBEWrcT2a58x7pcc4OGnhu/xQV5nU5TxsISLjREO3PmCmz4ReBMYjQbF7FAypzlOPwlBw6J2aFTcDmP/9EEBF3NUy2eNE4+Csf/OF7wOiDE8o51WtqoT6wVje6NHm1+k7XsPsPnL10Imk6NV4/oY2q+HxAfv85euolTxojzwuBQV/Ik9ObQYEuJF4DJuXWbnXROuxfQLsJ2JJtb7J+kJTzbWFnCwtVHFrkkl9GR4c0kmhLlti8ZKV28/YjXbj9Tb1W7Kki1s9mruSpHK0inRYsTawoTHiuA+wHzgFcWIjolFWEQUIqOiERoeKazKeBwVvrnhprPcNLRw3pw4uW0eLFMFGudCV+0OI+Dr/yVtPxbPlOBoa8XdlmBpbpZc7YSEBHwJDUd0dCxfDCAiij9TAuMLdgmY2L+tXsFb+Q35pNCg61g8fM7j5mQguMjkKFnICye3ztXbzex7Ep4Cv4SyBl3HqAJX6+JQ0Asnt+nPQe+XAcDlmw9Y4+4TEBkbm3YDxmNXSRJsrVVBdXnw+qQPf094P4yIikZwaDjCwqPFBlxsomTcmqMi1s8ZBrksxXomPeGJB+blgXpVH73mdXElkyTk83ARCxP1IMgZLoT5/WUyTBvSUcMNUBuzrBKeXJzsuSirEcRRrzbicVzaNkDvdpon39qEJ+7S7OJkx2O6pXu4x/W9mJg4vP/4WWy80lh5SHJMGdweQ7u10qsRuMtux2Ez8effVzO21pRksONCJD8BdtE/jtS/X3iSYG6mGqO5ZXHqQ1XOOzQsEgHBYaqldeqT3cSDjn0rJqKOFpen9ISnr+lPPVvXR7+OKVaIvFjfg/DE5yQevFc9EKpe75BMjgbVymCGWlwrniCmzYBp+Ovi7bRzr0wuRiA+DzrY2Yh5UMS3AxAeGSWSbkRG8rk3QsTXFPMg36AlJIgYZ61/qczHo+T3Z8XWg2z3sQvpCkB8HL335BWi+TyevAGTYGlhKoIWJ837aesqoU3DauiuJUD4ul3H2IDJy1LFxNFyB7kcq383zKJAm/BkbKQQQbx5rBtt70BUdAz8+JqD9/c0c53K8mnW8M5p+mVSie88eiGsKoPDotJaaPNxjDG4OGbjcSa5S5f4WWxcHD4HhsD3U4BYH2kT97jgMrZva4zu/Zte4116/S094Yn3Hx6cOG2fVa0xP34ORFSsUrWOSi1Oy7gw6IQzfyzgSTw0yqdNeOJ9lI//PPmPwe9IYgKWHr8ZHmyeM8lwvpVksDQ3wd+bZxsUhoDfd8eh06zrqPnp9OOsEZ5OX7nDmvWcgDge10RLG/C/y+FsD3tba35QldwFeP8KCYtEdEwMgoLDROxdEQ2VMfAVz+5lE9KM6f8r4Ylz7DZ6gaqfpRJ5+DvA158ebs4iWQxfR/AP31/4BwarXBa1vbdClAd2iBhe5Q1+f7qNmst2HNaRiEWSxN7n4u5FPHSD3s+Yu2YXm7hoa+J8qyk68frKJcYt0WBnYyXWS0mfyKgYMa7z8epzUDAgM05OouCe3Q5nty/Q2/Vc7zFYpsCqaQN53Ee965e+8CR8y+Hu4oCDa6Yin1rQfW1jFwlPeq0gMn9R8LvH7PXZzZAhQQzKXGByrdAadp5FJe56NGbqbNy+/xCmpibC9z0+XgmZXIYR/XuhYtnS0h8HT7Ne4xZleKprSOn4q8Dd50yMJDQpYYfulZ2w/uJnFHe3APdyOHIvCFXyWqNZSTs89IvC0tMf8fJzNMKilCL+k0Iuw+vAaPSo7ARvVwscuf8FrX+yx9MPUZh13A9x8QzhPDC53l1ZR+llchTO646/Ns2GtYUZDhw7gbi4eDSs+zPMzEylT58DWLseA7gIhbo1q0kJSiV7fW4rYv2fCaGPB5SUrF2Qr25vLlhlVakMQZ58rTbhiS8YOzb9GeP6tRUThyFWmTwmGJ+QeHDtSzcesNqdRuslPHHz3ua9J+HyrSeawoMkg4ujLdo1/Rm1K5XmpuB80ktmxjNBfA4MFpOdf9AXvHjtKzLR8QxkN+49RVh0PIZ1bYrJgzql4Txp4SY2d+3etEKHTA4Xh2zo1KIODwSJPB5usLTQjD3yKeALCw2LEAu5R899cOP+M5y8dAvhEZE4s2M+ihXQL7YRz4DSuv80KMXJi9pHBJxWO3mW+KmfHHtXTEL18iX06jPfk/DEA/u16jcV8YmZUpJJpMOB+4LXrFBSLw6GvBgdh85ke/66nHZDIJPDzckOXVvVQ7XyxeCdxzNNnwgJi2CBX0Lh5x+Ax899cP3+M5y6dAufgsKwamr/NJkctQlP/N1rWbcSpg3rIoptyLvH31WeIMI+m7XGiVjGwhPfK8q4UIUDqydrxIdIze2rhSfhaiAJYaxq2WJiXjHkw8eWbFaWPGNWxhZPPB6Ce3Zh5ehkn01kFdX24RvDsPBI3Hr4HCu3Hca1e0813zmZHO0b18DKaYP16mcvfHxZ1V8HIziMxz3StLpMTn6QVBBJhrmje6QR0TLi8W8Xnnjf5RnTlk0ZCCOFPM2Gj/PmGULPXL0Nnjji8cv3acUnmRw85gy3GE0dfySN8CRc34G1M4ejWrms60//euFJkuP3IR25y4UqY64BgwR/h7h4ZGuTsnl//PIta9RtLPw+B2u2Bz+0yechYphUKlNEZHBVf/d4ZsPPQaH4EhIGP/9AvPLxFS6mdx49x/V7T3kwBGyaOxwt6ul3Kp7U94vW685evvuYXBa+OSpfIj+Ob5xp0Ek/vx+P1deizyScunwv1boi8ZVWY8ef06D6T9iyYJRerhn8/mmEJ5kceT1csGXeaDja26QZe/g7wNcql24+wK4jZ3GZx3VMZS3GMw/y8euvzbO0buyGz1jFVvxxBCz1mkEmR/ECXujcsg7KlyjEM8pqWLHyZBZc1Nv31wWRLEOVnEV9jcE3afYiwK+jlliY+o7VWoUnmRyTBrRHh2a10vRZrmPyZnj04g0On/4He46dR3BYZJqxgVu8TR/eGQM6NctYeJIkGMnlwsWmYunCWTbP6Ft/nfOtTIF+7Rtg5si01nnpPYP346Y9J4DHREorVvJfZY3w1LTnBPb3pUQXO/XCiD2PB7q2qovq5YrzzK9pAuH7fgxgIWERIiPc/aevcPX2Y5y6fBu5cjjj9B/zNMYcfuv/hfDE9wv8gPPS7SeJ1k6JlUwU0+tUKS0C7v9UtAByqSWD4dnznr1+L9YKPAHR5dtp47Hy+a92xeLCelzfbHr86TxLYZVfByHgS6he64bpw7pgYGfNdyC9fuPnH8iqtBqID9zaU92SVdRXQq1KJdG5eR2ULJKXZybVeK8io2IYF5z4+M4zivMMeJeuP8C1+y/Qrkk1LJs8kIvrOtdGho/BZbB14Ri9LccyFJ44GJkRmtYqK2KrZdQuJDzpO8Jl8jrfW8dY5MvLIhWyCCpubI28dXrBxDKbFB8fzwaPnYIrN+6gdLHCePnGB94F88E7fz78Uqs6HOztwQWCM9fup534MlmepJ/FxHHLJwmdKzrCycoIuRxNhVq+5PRH9K6WHeW8LPHkY5QIPv7uS6wISh6jZNhzM1BkvJvUMAdKeljg7NMwWJjIsPjkR3wOj8sSF7tUqoAIfLhi6gC0b1pL48XjQdlv3LmPOUtWolTxIpg7RZU95vPTqyzozmERyJ2fiMVLRshXpxfM7fVXrr8Sr9afaxeejDCgfcM02X4Mff7F6/dZnc5j9BKefD9+ZtXaDFGdBCYthiSeAtgO62cN5wtfnQOcevnCIyIZz8hz8eYj1K5UKk2WjI+fuU/1GDx+5ac5kYsAze5Y8ftAlC6Skh1En7pzP+onL9+iQc3yemen6TN+Idv052mNMshkMpEJjU9y0dEpJ7/cZLlv21+0uhNoK9/3JDz1n7iYrd+rme1IcCheAHcevwI/fUk6neIceraui3ljexvUJ3S14aPnb1it9sMTT5LVFuRi0ZUTK34fhJJqgTt13Y9/z8Wle09ei0yHOVJZt2gXnozQtUUtLJrYL8vqpmshLOohN0KNn7yxc9nEdLPcZZXwdHjtNFQpWyzL6pfG4kkmR4Fcbji1ba7eMRfuPHrJmveZhI+fU8YfvhGtXLoQD5KvV1m5MDRi1lrNE2lJQinvvEKgVnf14ffmLrk8RoK+ZvPfg/DErWl2LBmvk9f7j5/ZsGkrVYFONTa/EowVchxcOy1NHJT0hKfDa2egarmsSTPNX4XvQXhaydcezTTXHvqMR9quOXPljgiqGseF4CQhRpKjXPH82DB7GHK6GRYSICg4lD199Q4Pnr1B64Y1YJXq0EZXOYvU7cZevf+kITyVLZYPh9dNMzgoM0+Aw62DvoSqBcGXZMjp4sA3wrj75LXaeoPHUjTBpb2LkdczJSV9RuXVJjx553HHic2zYaMj2DAP4Dx1yRas2n4k0foi6UkqEWHZ5P788EvjXfL7FCjCETx/y4W5lMMqIZrV+AmLJvTVmYqebwRX/3EYY+auV2ULTl5vqR61etrgNIckutpM/fv0hKelE/qicyvdmXl5f+w3cTHe+PprhjGQKVDS2wsH1/yuMa6nsXhKFJ6ObpiOCqUK6xyLDKmbPtfqnG954GNHWxxdPx15dVhhJD1PBGYeOB3xPLaTVqH564WnG/efib7F9yjqYzIXQutWLY1F4/vCLbv+ga15BrXbj14ITwRtFqz/C+Hp8s2HrFH3cSrPiOR5R8VuePeWPBadziy//L2duHAz1u46lijmJB4ySTJkszLHobXTDMrmvHbHETZw6oo064YSBXPjU+AXjT0Rb4uyRfPh7y1z9BJ91u5MvHdicqvkEUYmw9CuLUR9Dcloycf2K7cfw9XZDiUK6ZexOqMxmFtA3nv6RmMM4hmhLxswBusUnhJFNr5fzyjLHQlP+oxumbxGGRvDXpxeDxb8HhHCzc4Yxi7eyFUlxbz2y5cQtmTtRvx56DisrS2wfsk85M7lIQZw7opSv8tYfpJk2HG8jvJyMdbcRIaSOS1gZiQT2ecG/JwdXyLisercJ4ys7wYbUznOPQvFyrP+sDCR4G5nIgKLn38WJkxDpzV1R4Oidlh06oOI+cTF2LvvIuAfFif+Oys/fPPL1e3ti8eJk9lzl66ys5eu4tzFKwgODYOrS3Zhcr5u0Rxkd3aUIgN92fMTayFTRosFnqmxAg7FG8CpYIWsLZiBlUxPeDJE4EjvkYYIT/w0rvgvPVWeRckZBYzQtmHVTPnD68Jw7upd1qT3JMRyl6rkxbYkrLX+XDEpSzfG6ZWFnxBVaz0YfmqbXW4amt/LFfNG90b3MXPxQXynmtj44jKfp4vIFpeUnjqjen4vwhMPrFit9SC8/8TrmmgFI8mQ19MVC8b2Qa9x8/H+U5BaVhY58nhkx7ENhsXj0NUnlm76k42cs04tRhNnLoeTnTUOrJmKIvm9svRdTU946tS0JpZOGZBlz9K5EBadS5WxJKMsd1klPP25cgpqVsw6azVtwlN+T1eDMseFhkWy2h2G48Fz7uqp6oP8b67C8gAAIABJREFUfSuSLyeu7Fuqsy0io2NYi16TcP7GwxTLCkmCpZkpNs4biSUb9mlma0zM/PjnqikoW7ygzvvz8nwPwlP9KqXxx6Kx3GRfZ50CgkJElkRVRpok6zeebVGOoV2bYfJgTSvV9ISnP1dOxc+Vsq4/fQ/C09JJfdG5pe5NvK4xj3+/5+g51mkkz5wXm3K5TI55o3ugV9uGOttRn2foe41SmSAyfWoTnri7REZZD7U9Y/aqnWzKkm1prKgnD+rAE+iAp6XXcO2X5Jg8qB2Gdf9Vr3prE560ZRZNr/5cBOo2cg72/H1FwwJDJSSVwY7FmiLusXP/sFZ9f0eCegYufljmlQOH10/Xa12QVBZVFq2DGsGMudVGmwZVsWbGUL3qr61e6QlPC8f2Qvc2+mXTPXv1DmvWa5KIQau+PrMwMxNuM+VKpIyZ6QlPfM6umoUHHPr2YX3mW75/mDSgLYZ11+3GHR+vZJ2GzcT+U9cyyG759cLTog37EuOGqYlbMjm8cjjj2IYZaQ7O9OWR3nX/C+Fp2rKtbPqKXRpuZ3y+aVqrPDbOHaWXmMPrExEZzVr1m4Kz13hwcjXLbZkC80Z3SzcQfmoW3JKqdf+pOHVFzSJTkmBuYizWDau2Hcbpq3dT3tFEV819KyZzaz6d72jr/lPZoTPX04jUjWr8hI3zRul9QP41bZ3uGDywg3AB/toxWKfwJJa3cuTIbo8j66cht4ebVm4kPH1NK+v4bXSIP3tyZAkkZawqjTcAt5+awqlAOY3G4JZPazfvwLptO1GudAnMGD8ClpaW0rDpK9mKP46mY+6Z+YJHxSWgsJs5Bv+cHWeehCIiJgFjfnGDX0gclpz6gH7VuWmnDHHxCfALjsPaC59w/U0ESntaIJ+zGV74R6FVaXs0LWmHZWc+4c67CHQs74SDd4Ow71bQN7F6MjE2EiakxQvllvqNGM/uP3qKJvVroWrF8rCytMCIidPQ8beWaFK/jpSQoGTP/1oNKcwXYZExsLE0hZFrMXhUSEmvnnl6mf/lv0V4evX2AyvduDdiYlMWGnzxVa9KKfyxeBx33dA5yBpCYcG6PWz8wi2aE7lMjg5Na2LF1EFZ+qz0yrVh9zHWb9JS1ddqYluXFrUwf2xv8ICAh85cSzWxybBj0Vg0rKnbj/x7EZ427TnO+kxYkkZ07NCkBhZP7AceN2f/yaupLOdk2Dp/FJrUzpo08tzFuP2QmTggFneJG7DEkxK+SdFngWhI/+PX/quEJ6G0yGFnYyEsC4oVTOsq+l8Wnr6EhLN6nUbhwXOfVMKTB67sW6JzPLhy8yFr1nsSQiN43BWVtRwfv0oXzo0TW+dg1ortmLGKL3hT4krwzcfoni0xtl87nffn9/uvCU+8TruPnmPdRs3TOMnnXGqWK4K9KyZrCFgkPCWOMJIcWSk8HTx5hbUZNCON5e+wrs3TiH+GjnGGXp+VwhN3BeRWzdw1JHlzKEnC4vzGwRUICApBgy5jEKlm/cDf2TJFcuP4ptl6xVL8WuGJ8+GWJk17TRQueMlWGDxRhJsTLuxcCFu1mEZzVu9ik7mQph4HUybH8sn90bF5bb3GkaQ24VbmVVsPxoeAEA3rslLeucUGzdJC06VZ37bMCuGJP6vnmPls68EzmvO+3AjzR3eHevyl71F44nGCPN2cxP5B1yHilVsPWeMeE0T8yPR9779OeFIqlazLiLnY+/cVNQGaH0ZJmD2qO/q0b2xQ39Knr/x/C09cwONrSdUaLzGOLE8+ZGKEk1tn623Bk1S301dusUbdxquiRCWv343RuXkNLJrQTy93u5v3n4m25TFjU9YNKpfZ09vnYsG6PZiy9I8064YhnZtgyhDNpBipmX8ODGY12w2Hutsy73e21hbCHVBdvNWnvTJzDR+DG3Ybi3/uPdcYg7kdyJV9SxEXp0TdTiMRHpliZWfoGKyP8CTKLlegee0K2DB7hFaBkYSnzLSwnr/54nOf+V76A7FxShEbSQk58jfoD/Ns2SXunvTsxUsUyJsb5uaqSefE2Qtsy859WDxzEoyMTVC2SV+85iawWZRuN6nYPDClp4MJmpeyg4OlEQLD41A0hwVi4hNw7XUEmpe0FQHIs5kpEJ/A0G/ba1x8Hor6RW1RyNVMWD3VL5wN5fJY4uyTMNiay8HFrFOPQ3D5ZZiwoMryj0yB8X1aY1Sf3yS/j5+YFY8/YmGRPEA/fPKcOTnawdFeFaH/Pc8k+PIKomPjYGKkgMwqO/LU6gYj05TfZHkZddzw3yI8fQkJY/W7jMG9J9zsMuUEQSaXo2Oz2ujXoTEK5M6ZZZNfr7EL2NYDpzVO+3jgUn6aVq1c8Sx7Tnr4eUDXX/tNxYnLd1JcVoWJuAw7l6oCMW4/eJp1H8ODIGqeqLSsWxEb547UWcbvQXgSgW37/46/LvHAtomuA5IEhUyG7UvGon61chLfnHYeMTcNh+a1y/MUtjo56PNO8f7XpOcE3HzwUs1iRQaHbFa4uGexQUGg9Xkev+Z/LzwloUuJR8Q3/fWrlsSW+WPSbLz+y8ITD25ft+NIPH71XkN44sLR2R0LdPax8fPWswUbD6SynuAWZB0xuGtL6d6TlyL+U6y6O5NMjmL5PHBs00zYWFnqfMZ/UXjilmJlm/QRsYHUF95F8nlg/+qpGpsyEp6+jfB06+Fz1qjbuFTuaJIITD2qV2v81qimQVmG9B3/tF2XlcLTmat3WIMuYxMfkzjG8Tgs5Ytj9/IJfGOI6r8NTTPmW5gZY/fSiahaTrc7cFYIT7yAjbuPY5pWDzI42lpj/+opKF4oT/LYwMWYbQfPaFhAcIvcE1tmI4+e7oHq3DsOm8n2HL+Usp6XyeHhYo/9q6Yin5e7zjFJWxtmlfB08tJN1qzXZI34l9w6hSeYmD26Z3LZvkvhCSoL4xnDu6B/p6YZcu4xZh7bdvCcjsP+rxOeuAtVs94TceP+C42+xQ+ibhxYAWdHu0z1hYzGgv9v4YnP8dzC9uZDvsZLsawvX6KA8CIwUigMqiPPMvhz22GqWIVqh03VyxURnjCW5ppxYbWxUM1pu9MIyRP7t8OInr9KPPwDj/+kcg1MHMNkcnjnzoFjG2dpxLtNff9rd5+w5r0nIigkxc1YuPiX8cbRDTMMqmtmx/Rz1+6x+p1GJSbJSSl/1dLeYmwzNjaW6nYayS7eeKTRJoaMwekKT0nB45IKL2KMyrBu1jC01JKNj4SnzLayHr97f/MoC356AbFx8eLkR2bhKIQnudxIOnXuIps2fyk2L5+PHG6uUlx8HPv79AVkd3JEiaLe+OvCdbTpPw1x6foZ61GADC7hglJOOxM4WCrEVX2rZxdp7n1D4uBpb4yQKCWM5ZKw1DrzJARPPkXDxkwuXPC+RMajbmFbFHM3x/IzH/ExNE5c9/hDpAiQ/k0+Mjn46dD5nQulmNgYNmbKbHFCkNPdDU4O9sjj5QnX7M6CHw9qFvT6Lntz4Q8REFXiWYslGfI3GAhzW8NiKGRlXf4twhO3OBk9Zx2WbeVBM9VM/hNdgLiZZNWfiqLyT0VQpmgBeObIrteJpDZWPJ0qDzh6+sq9FJFLJoOXmxMOr5/BM1p8ow6TUhqemaZht3EICkk56eCZtbxzu+P8roUiKOjrdx+EFcY77mamNlHyDENndyzgDDIs5/cgPPH+x2NwpOZQ0MsN53cu4lmyJJ/3nxjPounzIUCDg302S5z5Yz4PovrV7fVEBNgdB1//FJc+3h51KpbAvlVTvvr+2vrh/1J44mNihdKFuet0qiDQqgXs0kn90rjyfE/CE3d3ubB7MUyNjfRqu9NXbrM2A37XOHnj7d+ibiVs0iHyctGSi1YPnr/TcBXl2WIv7F4ksqkIdr0n4MJ1vsBKis3CNx/AgdW/o2ZF3QkD/ovCE38vuo6cw3YcOZ9mjOPCk/qmm4SnbyM8cXcPHrj4Ik/soW5Jk5hl0DuvB6qVK4qKJQuLILQ8a6GxkX7vlaFrlawUngZNXcbW7DyudkjK3ThlWDS+N7r+Wl+MC9NXbGPTlm2Hyvw/0aVdboSBHRph2vCuOseOrBKeZizfxn7n5RCbS1V2QB7rjLv/NK6lCscQHRPLmvWaiHPXHiSPM3wjWaFEAfBkGzZWhh9gcsvvcfM3asRY4QlzuLVhhVLeOuv/LYWn1+8+sgZdRuPNh88pgZElOWpXLoGdS8Yn98HvU3jiQY8VKJovJw6u/V0k49HGkq+PeNwljRhlWl+qrxOe+FqTWwe+8f2sYXVXq0JxkejByMgwUUaf9/7/W3ji6y2+1nz3MVBDKOrZpl6m4oVyC6ruo+dh97GLGoeVBbzccGT9DJ0Z30LDIkR5uKu5eogJc1MjnNuxAIXyekp8r9Kyz2Scvpo2OcLupRNQv3rZdN/RQycvs/ZDZiRmKEzMTi5JGNmzFSYM6JCpd1ufdlW/Zsi0FWzVdu4hlXJ4zscsfiA3qEtzUYZlW/azETM1Y2PyA1B9x+A0wpMkIZebM7fYxP3nPqk8RuQiXMmhNdPSuI6S8GRo6xpw/YtT61nMp+eIiYvnG3dYuBeHZyWVn/Hk2QtZQGAgFkybJEzcwyMiWMvOvdG/W2fUr11dGjt3HVu48UCWu9mpF59bPsXFKlEghznWdMgtXO4mH3qH/NnNRNwmhQwIiogXS4QX/jGIjFWK7Hd1vLPBy9EElfJYYdhuHxy+HQS5Ec8EJjMgIbkBIPmlPJictTlOb52HPB4umDBzPm7dfQj/gADkzOEK/4BAmJmaYvWCmfDyzClFh3xmTw4vgozFi6COfGGRo0o7ZHPP3ARvYGm1Xp6e8DSsS1NMShVjw9DnGRLjid/7nzuPxeY/PJqnsk+V8UqkdebpT5QipahXThcULeCFciW8kS+Xm8jgkt7knbrcEVHRrE6HEbj9iAcWTYnnwgMJ71o6IU3WLEPrrc/12l39FBjftw1G9W6TPCnwE8m9f3Hz5yTTYP6VhAVje6LHbxnH3/gehKdFG/aysfM3a2545AqM7tkK49RckLqMmM12HbuUhsOcLDIDv/XguRC31E1+ufAwpHMzTB2asUmzPu1tiPDUq3U9zB3bK8sWBtpiTnCBfNX0ITh/7R62HeAn6GpZFRODnx5YPRWF8qpi+/FPVglPp7bOQ5lihgXuz4hxmhhPkgzu2e0xfXg3kXJe14dnelq/+zhe8UxaqTJJjundWqcr3N8XbghXmUSbe/E4vnBq8nM5bJgzPPkkdf663WzCwq1pTje7tKiNJZP662zv/6rwNH3ZNjZtxQ4N4Yln8Dy0bjoqqm1+0xOeTm2dj5+KZ11/+h5iPG2co/3UVldfT+97Pkb0n7RMe6p2GU+xLYEbjfP3Kb9XDhQrlAflS3jD090ZeT3csmzOzCrhiccP48lKNKzzRZwPO5EdL5e7i3jfbj96zqq1HpIYZDvlRD6/pwtObUubiSs1v6wSnnYePsu6jpyTaNSgEp74eLJy2qDkBDbhkVFio8qtUpLXLXIjNKxeBlsXjNE7Po16HbhVdbfR8zWEJ4VMwt6Vk/FzxVI6xyRt/SmrLJ5CwsJZyz5TRAaxFAsVOX4qlhdH1k2HuZmpKF96wtOZ7fNRwjvFWiyz74ahv0s3xlNqCwy+opXJsHxK/3SDHg+eupyt2fkXWELi+i+5MLzqaplTvzKrHbesqd1hpIbAxa3LevxaD/PH98lUP9DFTZvwlMvNEZf3LuVrfL2fWbfDSHbxFu8jiWsYkRXSGXeOrNZwd3v47A2r22mUxiEnF0Em9G8rrIt0lVfb9yNnrmHLth3WcN3jaw8e/Dunq2aWuNS/53HM+PucGGNCtW6QcYvzUtiyYHTywfrSzfvZqDkb0qwb2jashtUZxGLbduAU6zFmvuqxQtDm4iSwatpgtGvyc6bqawijgC+hrHqbwXj93l/DmsnG0kyIrUnJm1688WU12w1DwBdNV2N9x+A0wpNMjjKF82BU79/AkxSo4uSmJAvicezaNaqO5VMHavQPEp4MaV0Drk2Ij2OPDs6HFB0i3L24OZtd4bpw8q4sOmHXASOYh7srJgxXxbj5EhzCGrfthimjh6BapfKSMAe+yrPZpR4EDSiEHpdy9zouNK1s54XwGCVmHPWFt6s5Xn6OBp8U772PhGs2Y9hbKsRpPf9vJ2sj5HU2RcXcVhixxwfHHgTDhKtU3/QjCXPt/2PvKsCjSLrt6bEoIUAIwd1tcXZhWWRxW9zdHYK7BHd3d1vc3d3dLRAIJCEJcav33ZqZZHokIwksP6/7vf32+zc93V23q6tunTr3nAVje6G9Rujzs58/69p/KBwdHPD42QsULpAPM71Gwt3NTYiNieLAEwsL4KWOKqUcboX/hkfhKt99EDAVBmPAEwFqRfNl51a01hxEHa75VylU+l1dqmYt8ES/mbViOxtL2kucEmbEBl2ju6MdRAUQsBhDO+MoViAXt2mv/EcxA+tW3XYQQ6F4nW74HED2pRo9FrkS9auUwYbZwyH7bhQ59VPQDjMxJG48fCmqe7ZXqbiFcsnCeeL7w9b9p/nkEUs7svHPqkCVskW49lVijhQ/O/BEO7jE6Lp2X1z/TYA4CYeX+S1ffBx2Hj7HOg2dKXLhoQmkYqlC2LpwtEW05sT6MiUBVGsfQ6YJmoMSr6lDOqJ3W9NUeGJKHTt/g4vSJ3ZERkUhZ5aMoh0qY4wn+vYK5MpM5Z7WfHqctl+pbFHUrFjaYCwxmggLMmxbMAqF8mQD6Xz4fSXmnc6ulFyJBn+Xxarpg+J3lpMMPHGRR4H0yWi3yYr2kei/Et1a1kEmj7QG7TMAntQpHE/q1Uld4gfT2pnrgk6aRP7fJWNRo0KpRC/Sdfgstmn/GZ1vWS1muXB8b7RvlOBKdfvRC0aaMoEhZBWuGdtkcmRJn4YvcjO4q0uyTR2/KvC0atsh1pdcfXQ2G+RyJbbOH45alRK0Jw2AJ01/qlO5LDJncDf3mnX+LsBOpeD9Sd9Cmk766YEnCJyBVCB3NivarD6VytYL5c1u0M9oZ737yDnYzsuuTBjHaOdeDYOcxhwnOwWKFcrNnRtp3qWcgdi6Vj+Y5gfJBTwRoNJ91DzNeK4FlBSo/3cZbJ47UgSmN+o5Fueu6ZgC8OFDwLb5o8ihNtG2JBfwdPrybVa/62jNPJ9gJuI1oC0GdFLrgFLeUvqfnmKXK7kSJBRMeYsl1ub674Xyi07DZhm4mK2eNhBNa1e06T0mF/BEfaFV/8k4cIY0ebRl+GpHwqt7FsHFWc3wMgCeiEwkk6FulbLI6GHdPEMu391a1UXGdJa7t+nH1Nh8SyU+vxXMjZv3n4pO15Y+EWNNP5d7pWG8c2OVeMa7gBSO9siRNSPuPn6po/mUNMbTlVuPWNV2QxFH1Syag55tVK/mtIC3qR+YGwMMgCdB3bZ/qpUnINvcz/nfo6NjsP/kZZFjLG0YGgOertx+xGq2H84FrXXbOLZvawzual7k3dgDDZu2ki3cuF9nTSwQSx/nt881Kw3Se8w8tnbXCT1jDRlm06ZyizrxMb//9DWr3WE4/EkHSidvyODmilNbZpuUgZi9cgcbM09no4uqRwDsXjYeVcuX/C7vVDdG2w7Q2mUOYkheQMsmlSlQsUwhbF84llcz0Pn0nXccMh3/Hr2kZwJh2RhsDHgiZ1HSx1uwbjfGzt8kJssIMm42tmHWUNTX0YiVgCeLPjnrT4oI9mNPDy3SOKvFUBkCMv7ZBikzqR0i5i9fw9Zt2YmaVSuhVLEiuH3vES5euYaNy+chlslRpZUn3vkQTVGPjWL9oyT6C2Ix5fFwwIzGWREWFYd/b/ojZ1p7pLCXIzAsBkceBqFcTmc0K+3Gy9bCo+Lw6GM4L8MrnMkRkw99wNEHgXCyo52673vQznbX5tUxe2RPITQsjO09fBwz5i+Fi4sz2rdoiib1asFZM0EyFsdendmIiI9PuFsH6Tw5ZyuOrH80+e6DgKkoGAWe6GRiGAnWxY+AgCGd/sHoPmqxXFuAJ6KvzlqxHbNX/4vQ8CjNoKy7s2OkJbwcT86TRbkQx8vw6lcrj85NaiJLRsNdB6r1LlC1I0K4WGMC8JSUnUNretnFmw9ZzfZD9ZJMJepVKU2OUAZ9oWS97uzxyw8iOm7KFI5cj0q7a2Ds/j878HTp1kNWs90wxNBkGu/cp0StiiWIeWYQhzL/9GLkOqZLS3ZxdsAeK5zBTL2nQ6evsqZ9Jot2Fgl4mjyoA/q2b2jy+1y9/TDrO3G5uDzUWBeVK1GxVEES7o6/llHgiX4ryLgwtTUHfXs9mlfD9GFdLQaeVk7xRIt6lYXFG/aywVNX6LEdBMjklAR1R5fmaiei5ACeePPk1DYrNgUEGY/v2a2zjPZ348CTNdEzci6JDJN196pJ8QscY1ckZ0ra1fvwJVBHJ0UB2q2jMjv9xYSawXhJpGdGYNziCYlb/dK9f1XgacWWg6z/pKUGIsJrp3misY4WgzHgKSn96dSmGUYdBX9+4EktXE/jhOWHelhYM62/UX0L+hsBG8NnrMTGPSfBaIliiY6ndu4F4GCvRL7smdCifmU0r1MJqV1drM5rkgN4ii+BOSJmyNLif//KiQZOZ3yBNHIeYviCVGuNLkez2hWwevrgHwI8WbLoIbHgAtU6IowY4cmUtxgwnvj4rML80d3RsaltronJBTzRe2zZbxIOnbshAp6oFPDhsVXx/csY8GTzuBATifM75qJ4Qcus4o19f4bAkwC5XICXZ0ds2nsCD3kOo91UVQt40yZQ7cpig6epSzaziYu2Gjgy1q1cBrmyZcTcNbtFoAXlvxe2z0ExnWcnllyRGp3h6x8kKi+rXLYIL88kR25qw/lr91gN0kPTK4ka0aMZRvRqZfV3bMm4ZAA88R8JmvzA8ltyNphW/0izdjEGPNHmYp3OY0TxTHbGk2bD6tLOeUYNWrRx8fX7yiq18BTLR8jkyJU5Hc5tn2dQNttl2Cy25eBZUd5A15o7umd8fqYfc3Lwm7J0p8gsh6L675JxXEPWkndk6zn07XYbORvbDl0QgXIECK+dMRiNalYQ3Z/Gvya9vRAZSTIr1o3BxoAnklo4uXEmXxNSGfmVu88MzDNyZ00PYvVrpVUsGYNtjYe1v/uuL8fah0nq+cE+z9nLU2sh48ARQyxkyFujB5zSqkWbSVx8xfrNOH/lOr588SfABO2aN0LzhvWECzcecFqgLiMgqc9j7Pc0fjjZy1AkgyNalnUDgaX3fUKR1lmJlA4KpE2hxLGHX+HhokLRzE74/C0arg5yhETGEXIKD1cldtwIwNXXIfAPjbFgvztprSDgqWq537B76Xjhzv0HrJvnCFSpUB7dO7RClkyGto3vrx9gwS8uccYZAX/K1FmRu3qCUGLSnsb6X5sEnqy/FE+Gx/drg4Fd1ECaLcCT9rbkGDF92Xacv35fnWBrtQ90Jxhjz0i7sTwhF5AzsweGdm+KVvXFtFICngpW64hvYf8N8OQ5cQlbvvWQ2MZYJkf5kgVQ5Y/iIs0duVyGHQfPcJt3fbro0K5NMLpPG5Nj1M8OPA3U1H/riqcT2ENij9X+LGkQh52HzuL+s7d6cVBiUOeGGNevXZLG6iNnr7PGvbz0khLzwNOaHUdYH69lYDE6umRG+qWgUKJSqULYv2qieeDJxm9vcJfGGNvPsHbfFONJCzwRA69prwk4ffW+QcmdRxoXHFk7Dbm1OkXdx+A8F4JMoLVnTpcadw+vNNBc85q/gU1b8a9ZUM5scwUZCGAkS2ddzR/t75IdeCKnG3s7rJsxGHX0FgP6z7pm5xHWd9wixIkSdjlyZE5H5RN8TtIeMpnASxtPXb5jUJbH6fWzE+j1xmLy/w14Wj9jEBrWULOx6TAFPJntP/onaCypD62eghI67FLtaf8LwJPVbdZkQlvmj0S9v9WaQcYO0lrctPckFqzbg4cv3qoZgxbPvTJNiRgjtiq8BrS3yPJb9zmSA3h6/uYDq9xyoFg3UGPc0ad9Q2LHxt+SFv3ePr7YsOcEovWE/91TueDEppnImUVdlmfsSC7Gk6lFz7CujTBKM8dT+WChGp3wLTT58hZTwNPCsT3QvnECW9Oa/va9gSfXFI54cHRVPKvdFPBkzTPzc0k6I4UjF5ouki+HzfmEMeCJM+gWjMKTF28xbv4mgzyjTsVSnMFOWrD0KAQCV2k5EE/fftQDgAXsWDSGs52oPDmeCZbEUruk5OpWx1nzA+PAk61X0/mdCcbT2at3We1Oo/Ty7mQutdOUs13+d0GifWjT3hOsx6j5iOUMMw3DUZAhawZ3dGxWU8MSUreJusTFGw9w/OItvbxBAdLgIiFzYyzTyYs3sclLSLg8waX5RwFPL95+4MCarrC5mhggkL4e6V+JXrTf1yBs2H0c37grcELJsyVjsCngieb3tGlcBWKTNuszEaHhCc55aka8Au0bVeHO2fTdScBTMnx7xi7h//Ime3thGxfbVlAZmp0Ld1Wzd0krUMJBFER7OzshIDCQPX/5GqlcUyJPTvUAvHkf1YvOEy9Mkvk5qbuFRcSiZpFUqFHQlZfO0XHzbQhkAuk1AfnTO2DbNX8Uy+LEP8ijDwORN50DPFIqkcZJwf87CY+/DYjCghMf4aCSg1dcfK9DJkehXFnIJQAKGeMaTwXz54GdnR3CwsIRHhkJgTFkz6YG9z4/vsgC7h3ibB6i9TKHVMhfzxMymdzmiS4pTftZgSdqE4nvXbz5ELuPXcCZy3fw2T8QMbSOEwQw2jHSsSY3FgMaWIhSSayVXm3/iY8vAU+Fa3RGEJW8iErtiLI+4ruW2tFOB5XZPTNIKEyzzPgiX1QGpE6SqByS3GycTLhn/MzAE+3eks7W07efDDXjBDkIgNI/TMWhUJ4sOLFhBlJomIW2fA9Hz91gjXpOMEgIpw3thF5tEvqO/rXX7jzKeo9fYhZcUVvEF8HeFV4jDNtjAAAgAElEQVQ/HfBEbbr7+CVr1H0cPvoF6pXcKVC3YilsnDsScSwOpMH2SwNPNDfK5Zg5vCu66NDdjfUpcmRsN3Aa9p++blh+boK1xmjTR59JIsiQ2tUJx9ZNR/5cCZpa+vf8VYEnYg32mbDYgPG0YeZgNKheXgKehs1JBnkDdRjNAU/aPufj68fOXLnL595rd57CPzCIiyHTyofFM1QTYSLLlXBzccTyKZ5W7a4nB/C0fOtBNmCimEGnbReNw4blt8xIfNWlurNGdEW3RLQUkwt4IjZGvS6jxCxouQojujeJZ5z8fwOe1KV2k3DgDI2vCaV2qVM6497hFf97wNP8kSiYJzso7/lAujM6hjG0Fti1dBwqlFY7KS7ZuI8NmrpcLHrPheTzYu+KSZi5YhumLSdQIcGoIimMp4s3HrBq7YcbMJ5+aKmdLYmbsd/85MBTTGws6zhkBnYd09FujR+gaNyhMUp8GM8bBLimcOJrz6L5cxqsH6cu3cImLtpmADyRm5yt+m2WvqIV2w6y/l7LjOpBmx6DqS+LdcssGYPNAU/0zBPmr2f0vYjWjGTgoFRi1dSBfIPr1KXb7J9ueuXOchWGdmmE0X1Nb/BbGhNrzvtPwABrHtCac30fnWe+Nw8ilsXxMi84pUXuqp2hdEgh3Lhzj+3cdwjD+/fClRu3sGL9FmTOkB7DB/SCe1o3YdrSLcxr4ZbvCjyFR8fBw0WJxiXTIF0KJYpkcuSaTnfeh8LFXgFBYFDIBdzzDkO+dA64+yEMp54EwdVBgVqFXXk5XsGMDth/9yvXd1p/+QtefomEUo7v52wnyOCeOiUOr53Ca3q9Zsxjl67fxtfAr5w2KJMrkCtbZmxasYAWNNzZzu/6DnwLi+SMpziVM/LX7Q+FneVieta8c3PnmgSe4rWUzF0h4e+cttq7RbxQX3Luonz87M+u3H6Em/ef4cHzt3jt/REv3nzggzSDtlSLdJD0kmFBAScHJXYtGYfypQprmH3hrFJLTzx6QS5U2lI79e7B5nmj4GBvu0aFuWgRGNRhCGkVmdDRMHcBnQmKSgf2LBuPyn8UNzpO/czA095jF1nbQdOTJQ7U+KTWrZPGQa2Ow7npQkLZnxyjerfEsO4JYu/6r2fVtsOs36QVhsCTHlBoHfCk1muw5qBvb0CH+vDyNBRCN8d40t6HOxzNWWcwOdOzLPPqj9YN/hZqdRjOzl3X0UORyWE148nasYUYSCo5TmyYLioj0D63aY0ndfltYocawNYpHRdk0HWVSey3j1+8ZVXbkCAriWKaKQc29zJlCkwb3BG925kGOX9V4GnuajIYWCvSMVHQ2LbcK14vkMJnkvFkQ39SKQQcXz8dJYsYipL/TzCerG2zhvG0ac4w/FOtnFWDy/PX79nVO09w88EzPHnljdfvfLgzFGk8xeujaXXSdPo5jXkkFnxs3TSkT5e4fpn2Z0kFnmgDtWaH4bhw85FlpYKJfJf0/NXL/caZKNqSJP3Tkwt42n/yMi8ri6NxRCMETGysOaO6xwPgtFlTsHon0c49PWNSJAJMl9p1Q8emNa3qJ9rYJBfjKSw8kjXv44VTV++JgKdCubPi1OaZ8RtuJhlP1n4jNPbbKXBi44xEy6TMDeWmGE+km9WsTiVh8OSlbMlmYrzr6EnKlWhTvxKWTOwvEAO5WpvBuP34rU7pvxoIXTapH2fwj5q1ms1duyfZgCdaB9A91VUACRpj/Tv8g4kDO9rUD8zFySTjyaoSYsIq9LRgTQBP6lK70T+A8SQgsVK7Z6+82d9thsA/kDRmk5Y3qKtMWmNgF0ONqjW0oTN+EZiOUya9yPWzh6Fh9QQmsbn3ZO3f1WPwMFy4+fiHjMGWAE/EIKzfZTRuPX6l882onSVzZ06HU1tm4cmr96jRbogB+C8BT9b2AL3zfW4fY0FPzyI8Mpon1zKXzMj5dwfIlXbCkjUb2bmLVzB70hh07jsEObJnwfMXr9G6yT9o3ayRQO4Ky7cdTnJHMtYE+i6iYxmq5HdBj4rp8P5rNC6+CEbrsml5J3joE8YdzeyVtBstw7eIGLg5K7njXUwcA4mRk/4TAVB5POyx7KwvMrnaoUwOZxy8/5UDUDGxjLNfkv0gCrdCzpPYUkXzCa269mXOTk4kxo7UqVLi7v1HOH3hMnZvWA57e3sh8P1T9v7sWk7rpt/FKRyRp2YP2LvYLmaYlDaZAp5ILNnB3s6qS9MgOKxbU/RqWz/JpXaJ3Tg6Joa9/+SHt+8/4cVbH9y495RTj5+/+YDwKA07SGdAp+SMhJJXTB3IKanhkVGsXueRuHTrSQK7gzPXMmPfyklkF/0dOgpI1JCL7e3U1Z6wKsLik4kV1LZBFSz2UpsB6B8/K/BkvP7b9kBQHFqacfgwd/V7T17yUmIRNVgmR/NaFbAqEZ0PStyHTF8t2jEnw4NvoaGiUkFrgCcSV3d0ULM9LT3o2+vTpi6GdG9u0BcsBZ5I7L1FXy8cu3jXoB4+q4cbNs0biUmLNuLIuVtJKrVzdnIgpzdLm8bZfSmc7LF9wWgUNlICYczVLqN7aowb0I70mRK9z55jF7D1wFlRMkr6dv3b/4NJgxK3U5+xfBsbt2ATEL/rbHmTDM7UOLEc3zgj3gVP/5xfFXjqMWoOW7/nlIgBkMLJDntXTESZomr9STpMAU+29CcyVtm+YAyKFjDcKf5fAJ6cHOyhUhnujJvugeowrpzqiRp/GRoQWNpzQ8PC+dz7zscXj56/w417T0CukG8++KrZyHpsPtJzG9unFQZ3tcw1KqnA05Xbj7ktPOW4BgtSSxupPU8Q4Ghnxw0/ihcyrvmTXMDTrJXb2Zg56xPKGjVCwKumDeJgBT1SUHAoK9+sH169S3DfpHklWcXFNWDNxjnD0EBHeNea0CUX8OTt48vqdBqJF+98dXQd5ShfIj8fG7TlRaaAJ1vGBXLcImfjgnmy2ZwDmgKeVk31RPO6lQXKuau2GSx20BUE7hh5ced83H/6Cm0HTkd0lI7mmEwO0q2h0s+Uzk7JDjw9f/Oe1eowXCRcT/Ngw2p/YN3MoSL3L2v6QmLnGgOeqIolhZMjF4e35CBQJSQ0HDE6ouimxMVv3H/Gqw3CSUdIB1xLVnFxjdP5ma1zyO3TaB+au3ond3LmJg5JPTSVD6c2zzIot/v3yDnWbuBUtV6fjqvdpIEd0b9jI5v7t7lHpjG4dsfhiNCuxcz9ILG/WzAGWwI80S1Ix6x530kI/BYq1liTydC9ZW1uekN6UKLNZ4nxlJS3p/7t+xsHWPjrqwgOjYCzox1kqXMgV+X2hKQL0+YtYS/fvEXNKhUxb+kqrJg3DTMWLkfxIoXQvUNrof3gaWzH4QvfBXgiUCiloxxr2+dE0SxOmHX0I3bd9sfEf7LA0U6GLKlVeBcQhY+BUVDJZYhlDK6OCs7Ki4iJg6NKhnweDvAOiEJ0HMP0oz5wVskxu2kWDjZ1WPsSV1+F8POS/1BrCu1fOQGVfy8mdO43hJGTXb9u6l2CY6fOsWnzF2P/ljXkdCd8+/SKPTu6lNe6kn5PnMwOuat1hWOaDN9tIEiszcaAJ0pmOjepRnoxVodLA1h9V+DJ2EOFhkewB8/eYPW2Q9hx+JxGpE5zpiCDR5qUOL5xJnJkSS/EEtV16AwOAOm6hTja23Haaikju+BWB8LID958+MTKN+4nsqxVn6a2OTV78M0RnR0SmRzZM7pze+hM6Q3dvn5W4Omdjy8r36Qf/APJSU13t8r2OGTxSIMj66bFCwWajaXeCW8/+LJ/uo7Bs7c+On1CDnLHOLt9LhxMODWRG1QYidTrHN4+X9C45zgRnd5S4InOa1G7AqYP72ptE2CnUsU7hej+2FLgiX5D9uK1O4xEENXa6y4iZXLOCKQk78rdpwlAjTWMJxrzZAI2zh6BP0sXtqp9tPtPCwlijer/0AB40iTpF3bMN8lU0F7jwdPXrFq7oQj6plN2K1PwJP/4phk8yTf2oASeEmvy1qNXBhocNn3LggxKhYzbhJcrWcjoPX9F4CkqOoaVb9wXD19664izy5EtvRtnPJG2mDb+BsCTIHBzEepPFcoUSbb+9NMDT4Ic04d1Rst6la1qM53s5OgAlVJhyWxj0bUJKAoJCwOVxC/esBenr9w1EPotVywf9q+aROOT2fsmFXgaPWcNm71qt6Yv6cyVljJI9RkI5OzVszmG9zTu7JVcwFOLvhPZ/lPXEgB9cgx0UGHbgjHxrD/KcWjD7MqdZ/FADG04kMaoKZ0Xcy9x5dZDrJ/X4oR5WBB4NQQJEFf6vZjZ92Xs+skFPF28cZ/V7DACsTrmIwQqNK35JwiQ0+ohGQBPXM9LTkYt+L14AXMhEP09sXnG0guZA57oOr3HzGdrd58Ul3gKMrSqXwkfPwfg1JV7BvPvXDL6aKE2+khuxtOnLwGMFt33SENTpwQweyZ3nN8+L1GXaEvjon+eAfAkkyOTe2rsXDzWYtfbsPBItOw3ETcfvhJthhkTFycHYmLifPbXcbOWKTCwU0OMH9Depr7eZ+wCtubf46LvNkcmdxxeN82oAy+tPaq2GYKr90jsWteky8bcV5CBVHPU7GDx93r+2n3WpNc4Xl0Tn2fL5GhQ9XdsnDPCpvZa8q5/9BhsKfBEzz5m9ho2ezWJ8uuAfoLAq4+a1KqAXUcvIpSbTmlYfxLwZMkrT/wc76t7WaT3TQSFhHPbSnnaXMhZSS3Ke/jEaTZlziJOny5aKB8G9+6O7gNHoGenNqhdrYrQrPcERrXWFjmdWPmokdFx+COXC8bUyYhLL79hy3V/PPsUjj/zuKBpyTQolc0Z/iExiI6NQ4EMjvgUFMXFxHOkteNglG9wNHK62+O5bwT23AnAnttfkdJBjnq/pULzUmmw9VoA1lz8zMv0vgvpSabAtgUjULtSWcFrxlx24twl1KpaiQvEXbx6E6lTuWDd4jmQy2RCyOe37PnRZZCRtLsgIE5ux3W2nNwyf7eBILHXYQp46tu2LiYP7pykZ0rOUjtrulTHITPY9kPnxCwGyHB6ywyU1uygGx2AZAqM7t0i0dIqa55D/9yVWw+yfl5LjbpCUsJj7lBTZnUPAQqlCksm9EbL+lUMLvCzAk9c02X8IqM70pbFgWIgrgWXK5RYOK4nCTqbD6SRQIeERTACi6hEI0FPQs2wpETIGvtZH19/VqXVQLz75B8/XloDPHVqXBXzxva2qR3G+pA1wBP9fuH6PWzYtJU6ZTTqq9K7oXhwEV7tYQPwdGDlZAIKkq19xoCnvNkycCDSPY2r2fs06j6WHb1ALC5tuwQolUrODmms576ibTaNbWR/TiYR+nR5y/qwIcWeFpG9WtfBNCPOhHTfXxF4unz7EavXaSTC9HahSxTKiT3LvJAqpbNZ4OnAyin4q2zy9af/BeBpqVdftGlY1WzfNjenJOffqZyBWKP3nr5J+Ja4FIEL7h5ekag7pPY5kgI8BQR9Y3U7jcSdp2/0WIjkHGa+pYbzq1pLsXAeKu2aRSxUg6skB/D0/tMXVq3tULz98EXEwKbNssPrpiJPNjX4SmB3hyHTsfsY2Y5rxipBhoweaXB03VRkz2RaBN1U67uOmM027TstAn3pvruWjre53Cy5gKfJizezSYu3ipghNEYO7toYY/smmGiYAp5oE/GPEgUtePPm+4Y1Z1gCPNH80bDHeM0iN2HzjeQTqB/ykkudOTZrejec2jQTHu7qktXkBp4427nfJBy/eEfkQkZ51vZFY1G7Uplkj6Mx4InaeXLTTKTXtNNc3KOiojlTi1zLdA1PjAFPpFvXoPtY7iqo+/38Vbow9q2caHRTK7H7fwsNZ1SadefxGxEQXOa3PDxnTOWSwiBmV249ZHU7j0KYASPT9jGKvokuzapjzuheovu9fPeR1Ww/DB8+B4g2UzOlS4VjG2bYvEmbWEwSG4OpL1mWG+nl92bGYGuAp6DgENaoxzhcvvvUAPijjb+Y2DhNaaIm55WAJ3OfoPm/v7u8i0X73EHgt3C4OBHwlBc5KrbmnZXqMvccOor3Hz6hdbOGCA7+hpXrt6B/j05cZLxh97E4cZlKMHRRWvP3tOSMiOg4tCjthuqFUuKhTziUcgEBoTF45hvB//01NAauTgq4OSlQKIMjSudwhkou8HOvvf4G/5BY+AZHcUZTSkcFFyDP5KrizCgPVxU+BUVj9jEfTgX/HhLe9OFvmDWEC6G+eefNZi1agTfe7/l6JFMGD/Tp0h4F8+XhcQ7182bPjy6HEBfNk6E4mQq5/u4IZ3fbqb2WxNjUOaaAp16taptcAFl6P1uAp7g4xmSEyCXh4DvjS7frodpynNo0Pd4+e8fBs6zD0FkGVrVZMrjhzJY5yV5uR8yY+l1GqYGN+KRRgKO9CqN6t0aRfDmpFM9kq0nw+OLNB5i2fLtGg0czMMqUqFu5FNbPGgal3k72zwg8URwadhuLs9fJQU2bPAvEKMLIXq3ItcxsHC7deoipS7eJ3e1kStSqWIJ2cmze0e/vtZit3H5MpNdE33aV34tg55JxJkug9F/am/e+PCHx9k2Y8K0Bnto3qIKFE/om6RvQfSZrgafIyCjWqOc4nL72wEgZGT2WOCm2WONJw3javXQCqpQzrktmy2efVOBpw+7jrPuoeQllLny9qUDdKqV5mYFKqbac1h40Vw6ZsgxLtxzWGT/UcenRuh5tQCTah2lxQaVJdA19TTGy+CVXJY+0qQ3e/68IPHUaOoNtO3jeQO+kdb2KWDppgCgGphhPu5d64e/yydef/heAp4XjeqFDE9vs7k19Y7QbLzfCKLTmm2zaazw7dO6mSJMnjasz7h9ZiZQpEkBE088Qx36r3RWv3vsmgPYyBcoUzYN9K7xMGmnQ9Q6ducqakjOprt6UIMOfpQphQMdGfNFjFFwiqQ9BhsjoaBKhxcMX7xPADkEGuQy8/MpYiWJyAE/Tl21lExZuFmmP0PhTukgunNg4U1TmNH7uejZjFVmk6+zYy+RYPL432jWyzoWOFuIVmvXHR78gEfBUIGdmHFw92SLQ3th7TA7giRg4FVt4wvujn2ieJ83UrfPVm7zae5sCnvau8MJfZdRi3T/ysAR4ojmkVb9JamMKUcmV3vyqmYuIdTdMh3WX3MATxWfYtBVs4caDevmPHFV+L8qByKSODfrvwBjwZC1zPSQ0nOfVV+89Nws8Ue5J7Kij52+LGEr2dkqu61WsQC6r+srpK7dZXXLJo4bFl+4p0bD675yRp1QYMkt5jDfsF+cNAtC5WS38U7Wc2byBypwHTV6qVy6oqXxYPw0Z0yVItlAfI3fPGw9eGpjmDO/RnPJtq9pryTdkagwmA66xA9pBIZOrx2cjh3Z8nr5sG67qsurNjMHWAE90Wyq5+6fbGCOlgEa+PQl4suS1J37Ouyu7WfSH2zrAUx7kqKhWa4+MjGQRkVGIiIhEWFgYgkNCERkViby5csDJyQlNe43H0Qu3vwvwFBoRi4kNM+OPnC545huOtCmUCImIg4uDDB++RuHOuzCkdlbga1g0jjwI4mV2qRzlePwxHBVyu3C205dvURyUKpjREYHhMSAwSymT0YYVHJQytF31gutIfQ+dJ0oSNs8dJrIp9vnky+zsVEiTSqwXFOr3jj07sgwyFqsDPHWCs7tpN6Okv3nTV/jZgCdaBF66+RDN6lRExbK/WT0whodHsrqdR+LyHdJv0uwkCTKkSuHI6+NJAJ6i8eDZa74bEBAcqgfkyNCuYVXaPbAJwCDnGbfUKQ13Om4/4hNkSDjVl2sEzWUKFC+YA0fXTSM9LbNtpUTxz6b98Yk7j2nbJsDJ3g7ndsxDvhxi1tzPCDxdvfOY/dN1NIJDif6rBp7o+ylWIDuOrptutFRMv/f6fPZjFZr2x8cvOnGAGsQ7u30eCuRSv2NrD7K4JQAiLpYmRu0upFroe3j3ZvG21uau+/6jH6vaZpDNjKf/Gnii9t159ILvDIn6mrGG28B4+tmAJzIu+LvVILz5+EVnLFCX9p3ZOhv5NWOGtvl0fp2OI/D0jY9o55QW2Ge2zEaOLJaVTVdpNZDRTq3uZg4xjjfOHU5J6C8PPNH3NsBrqd6uv7rZi736oV0jMXtRAp40PVCQ43sATxPmb+Blw63++RuF82a3egx99Pwtn3tFY4ZMhmL5c+DYehrbDRlD+kNKUhhPPUfPZet3nxIv5GVyLJnQx2ImrNeCDWzaMtq0SthgpU2Ddg0qY9GEfsnOeKLNuXaDpuOT31cxA1gmx4D2DTBxkFjYeefhc6z94BkGmnQEWO9ZNgHZMnlY9N5oUeo5aQlWbjtiILZcv0oZ0vOz6DrGpoSkAk8EEPSfsBAb9pxUOyhqD5kcGd1dcWjNNOTKmjDG/i8CT9SkBPt2IwLZ2k9dJkeGtMRQmS56t98DeNp56CzrOHSmRlw5If8hLTmvAe3Qu10Dm/oEuUinSeVi8NsfDTxRSEfMWMnmr98vLnGUyVHrr1JYO3MInCwYo+g6/l+DWPO+E3Hp1mPxBqhcAa9+bTCgcxOD9n4JCGS12g/H41cfRMCXq7MDTm2Zjbx6+bupPLNGu6HsvJ55AumcrpkxCE1q/iW675Cpy9iijQcMDFTc06TE2hlDbAJmSfw+KjqGNMkM2mhsDCadP6/+bTGgU2OL+s+SDXvZ4Kkr1M7l8VOe6THYWuCJLuk1XzPO83uYFngXJODJ3HLH/N+9r+1lke9uICgkQl1q55YLOSurS+227drPlq/fwneEBA0mKZfLMWpgH/xVrqzQst9Etvfk1WQHnuIYuOtcscxOqFU4FddsuusdBjdnBfKmt0dKewU8Uqp4iRwBSsSACgyLRVQsQ1onBTKlUiGGAU4qGQeb/ENj8NgnHI8+hiF3OgfuknfHOww334bgc3A06H5J49MYxpkWzjsXjUaNv0oJz1++ZrMXr8Crt978PmVKFEO39q2QwSMdj3Pol7fs6eGlkAlxXOcpVm7HnQV/tlK7/4LxFBAYzKq3HYrHbz7ByV6BUoVzo37VcihfshAxAMzWmfv6fWVz1/yL+Wt3a8YSzYAik6No3qzYt2IStKAQCZS36j8Zh87S7qwO04iLegro1LQmBnVtgszp3RMdLEl34Yt/IG4/fIH9Jy/j6ct3WDd7uCgxovdOdp7Tl+/U2+kQMJpc03oY148w9kV3HzmHbdx7RuR2Qujq1CEd0UcvMTAFPC336otWDZKvTIM/076zOratMpBIJzE39G1eJy/axCYv2Soqa6LnH9GjGUb2VrMvLTl6jprL1u85bRCHiZ7tLJ7g9O9D/adSc0+85busYqczAqz7dWiAnq3rm6WBv3jrw2oRxVnHMtkaxlPXptUxe3RPi2NhLl7WMp601yOXu9Gz12kSABOTsw3AEwGMvxcvkGztSyrjiSek01ey+bQTqTsWyOTwGtAWnp3ESSQtrNoNnoFYXnKYMMaQEOuG2cMtbteCdbvZsBmrDSysW9evZMD2oWc0xXjatXgcqv9VyuL7musvlvw96FsIK1S9k0iMnxLM+pXLYtO8xPUjAoND2I7DZzFi+ip1yYGeq2D6tK64uHOBAevUFPB0dN0M/FEi+fqTMcZTvuwZcW77XIsXJpbE0JJzth88wzoOm6M3R8mxasoANK9XOdne+d3HL1nlVoNAsgdurs4oX7Igud+heKE8SJvaFSmcHBK9Fzk1jZq1BgfP6skxyBRoWrO8SJMnsXbbCjx9+OTHKrf0xHtimcZvysiRNYMb10DMklGdf5k7bj98zgWIdTeISFcoVxYPHFo9BRk9xCYwxhhPhfNk4axprfi1sXuGhUewkxdvY+Dkpfjw+atYaJiYoYLAnZZKFha7Lr5+58N1j7x9E8q4+fXJnKBwbkwb2hW/FciZqLbdG++PbO7aXVi94yhiSZRZW9alERafP6YnOjWrZVG8jLXNFPC0bEJftDZTHvrO5zObsXwb1uw4aljqLVeiee0/sWySJ+mjxj+fKeCJNhpLFlZXGvzIwxLGEz1PZFQUd9o6z92/TAhNyxTo3qImZo3sIWrH9wCe/L4GsUotPPHq/WeDMZkMT0b1akkAbnwObSqmNDf4fvmKS7ce4d/D56gvYu3MobSRI2rDfwE8HT13nTXvMxFRNHfHAxtqx8DmdSpieM8WyJnIxhGNT7cfPcfEBRtx/NIdgzilcHLA3mUTUKZYgimGNk77TlxirQdMVX9zOnlD3UqlsXXBaIv76fItB9iAScsM8oZmtUn7bLDoOhdvPmA12g3TccvUPI0G0Jw5ohv+Ll8i0XmNQGr/r8Hw/vQFpy/dwc4j51CjQinSABbdy/gYLMA1hROOrJuKwnlzWNRGGgP+bNIPfoHkFqwBnxIZg20Bnqjkjlys7zwhTTPTIu8S8JQMI6c3iYu/usotM0lcXJ46O3JWag9BLhfuP3zCrt++C7lCQZRoCDKBi9X+VrggPNzTCl2Gz2Sb959NduCJ0nbqjQQgEdiUNoWKO9p9+RbNnep+y+KEMtmdeevTOCmQ1c0OLvZyKOUyBIbF4GtYLJ58DIedUoanH8Nw/vk3Dj6RXXLH8mlhJxfwLTKOl+1dfR3CS/SS+6Bd6kOr1bol/UeMZ2/fvUfZUsU5e+zC1evIkzM75k+dwCfL4I8v2YtjyzmQRuLiTGGPXNW6wTGVZTtVyf3sPxPjaeW2g6z/hKVgnG2itZRncFQpUShfdhTOkx25s2WCR9pUsLe34yAp/fMlIAivvT/i2PkbePSSaPJiFFstll6VJm8RXfjfw+f4bqOaKqsnci2TgWi/Dar/ify5snDHEQ7KCgKIGejt8xk+nwPw8t0H3Hn4Al++fuN6ENS7Zg3vgm6t6sZ3tK/BIaxe51G4/YgorwnlZSqFnCeoxpyVTL3nfccvsraDpiM6mgZLre2tHGWK5uWaNkoSMtMcRoEnQYZOTaqj6p8lqbzW6tPDJdEAACAASURBVO5EQp+5smZEER13MUuBp6CQUFa/8ygx9VcjBEr2yMULWZ4kHjx9lbUeMAVROs4vtOtTsnBuvrtuq4Cu2qlsM6ALQFCUKCkXZHwBUvOv0sQIgEsKJx5D6hMxMTHw9QvEpy8B3GHx3LV7eu4YSlQpWwR7V3jFv5+Xbz/wshICwxOo2nJUKlsEXZrX5u/GVGmIsRdHzi6pU6bA78ULihY9tgJPBBA07jkel+9QPbypxFgOa0rtaNwb1r0FiuTPaXX/I22pQrmzIZ8eoy05gKdLNx+w+l3HICxCl5EoR5G8WXFk7TR61/HvrfOwmWzrAdKQE5e7rJw8AC2sAAOevn7PqrYaBP8gHZF9QYa0rs64tGsRMuhZ0JsCnvp3aIiyxQpYHU/qQ6Qlkj9nlngmqKUDglHgSSZH8QI54dm5CcidSLfv8m8kNpY7ke4/eRVX7z5R38rACluB4T2aYlQvQxDaFPCUpP6UJ5tB2w2AJ0HGWQej+7aBq4uzVd+kNsa0+CpTNB/SpDJkwyYWc+PAkwxdmtWkclWr3znNG9mzpEcJvbG2z7gFbM1OEsmN1Yx1aiek1CmdaaynRQOyZHRHevfUpFXJH5nmgk+f/fHkpTcOnr4iLtnSNIo25RaO7Yn2FpYF2go88XLZkXPVyWS8MKwSzWr9ieWTxUCFuT7+T9fRTH9RKQhyrJ0xCI1riRkFBsCTIENmjzQY1ac1d9TU/wbof1PecPz8DRw9dx2gWOrPw3IFmlQvh+VTPA3KfOnZyQVyA20+6c9RMjkcVQreL4oXyo2cWTPSPMj7CLmEffzsj0fP3+L4hZt440N6UnFifTpBjvRuKXF221wDgM1czHT/bhR4SiTvoGcLDQvH3cevsPvoBQ2opsdEEGRwsFdi33Iv/FFCbL5gDHgi4G5Er5YokDub1d8rzTPU5/PoGBtY035LgSe65u6jFziDjfIHA+YFMfVdnLhjdv7c4oqI7wE80fNMmLeBTVu5w7DEnkpHABTNl527f2XP7MGNCrR9K+hbCN5/8sf7j5/x9JU37j95pRa1FuRQyYEDqyYZmGb8F8BTvC7T07cGOnD0LaZL7UJ6niiSLzsXONdqEpFT8dsPn3Dn0SscP38dX0P0zFcoRZQr8Fepgti1dIJR4Jd/t3yzNCFvoPFx0bheaNfY8jLZV+8+coa2b0CQqPIhtYsTLv67EFkyJGyWk3ZXk57juWyC4XihHnuq/VmSjLHom4dCIY/v6rSu8vH1w5v3n/i48fDZG8QygYPcuTO7cy0uXSabqTG4VoXi2Dh3pFU5OZkt7DslJrqYGoNtAZ6okQdPXWFtBk1TG1EZ6OeqwyABT9aMfCbO/Xj3BPv66BQio2LgYKeEkDITclZpD4XKQXj45Bl7884b5cuUwrVbd/FHmZKievrh01eyBev36dUjJ8ND8eSXyuEEzlBK66xAWFQcvL9G4X1AJC+PoySW9JuoxC67mx0yuCqhkAn4EhKDV58j8Sk4CuFRcYiJYxyUck+hRPVCriiU0QFuzkpcfxOK1Rc+Iyg8JvlL7QQBDiolTm6ejZyZ3dG2pyf6dm2PiuX/4AuVf/cdYktWb8D+rWvgYG8vBL1/wj6cX89FaXlSoHBA3pq9YZfCUNMjeaKb+FV+FuDp/ccvrG6XkXj25qMhuKlZ9BPAR5klDaC04aWtFWaQc1CAJ826TBX1yMHZN3tXTECpIvlEqCNRulv0nYijF28bt0QnIEkm589D+aEWeIqNYxBkZGXN+IDFKaF84GLg9saVSmHz/FHx9zpx4SZr0nsioqIiE16GxiXsX6qdpw5u4UEUXxIiffqaynw0E5ggg7ODHa/D13XEMgo8aUSi9ReGFt4ecRAwsGMjTPDsEP/MlgJPpy7dYo16TkBUVJQoDlXKFsW/Sy3XUKIf+wcG853pxy/FtGUnBzvsXDQGFWzUdvjs95ULUN59QgK5RsAWTZ+gvkYQH/VBSk5iY+P4u+f9k/qgga24ZcAT77LEurO4RySEkt5NodxZcWDlJKTVEdW2FXiiK1++9YjV6zJKBMiI+oo1jCfND6nvJaa3YqovMsgwsmcLA4ep5ACeiAFJ5XMXbz8xEJffMGs46lVVj+fkTPlX0wEGu3HkZEMlsxl0NBbMfVMkFtxu0FTsPXlNLOgqAHNH9yTwUdQLDIEn9R1sjSf1VQKebLFXNgY8JdZ3db8RPl7qbQ7w38oU3EWSHHrSuxvOhwbAUzL0p6FdmxKgJIqzAfCUxPtQfuPhloo7hf1mpY6IUeApCWM4E+RoXrsCVk4dFN/mizce8LJa2pA0dBlVf6tcs4BmOJp7SfSIgKf4MY9+pssgUAeMxsN82dPj0JqpFusF2QI80Y48zeMHz9wQzYkkFrt2xlBiblk1mq7afoj1nbBEz1VMgYZVy2KDnhuUAfBkQV/h+QrHXHWYD9rBQpDDPY0L/l08jsAjo89NZdC1Oo7gJkEGmqt87tDkQ7FR6s1NXsUgIA4yDioae1c0FtD3N7ZvSwzu2syqeOmPc0aBp0TGKT428JxKYeLZ6McK9GhZCzNHdDd4NgPgyYJ3kNjYTPPM6N6tMLR7c5viYA3wRIL8dTqNNJpvUI7Zqn5FLNPTuqNn/17Ak/fHL6x2x+F46U2sJyP5j0zODagoN+I5uGYzNjZOPX7zjIjnwwmgJo0DY3q1wBC9eP4XwBPFbsv+U6zz8DnqnF1/40Ob89P4xRLaz9N7al98vq+3aSvI+BphhwktODIQ+KvZAL0yZDmypHfjxgBZMljGyNSMu6zL8FnYfviCQd4wY3g39GxdT9RvT1y4xZr3m4hwnU21hP5P3z2NF5p1lWa84OOTZl1FMVLr5mnfqdqBj/LMSr+r5VCMj8H0JwHzRvdAZ71cxlxutOvoBb7BLtayMz4G2wo80TOTXtbyrVRubHxjVQKezL0pC/7++fEl5nN9D+dJkGUqHN24o5rK0UU4eOwUW7tlB/p27YB5S1djSN/uKF0iQWNn7up/2Sgqu0iElmbBI5g8hfJQ+nDzeTigWFYnpFDJ8SEoCkHhsfANisLbgEheYsfiGFRKdeITRTV2jMHdRYmsaexQKJMjCqZ3RGhkDJzs5UjlqMCDD2HYcSMAfiE0UCblCU38llxF0qXGsfUz4OygQPteg7gTYK2qahr8rv2H2coNW7B7wwrY2dkJAa9usS/XdyEkPBL2KgXiVC7IX68/B/++w9OZveTPAjwt3byfDZqy0mDSMtoA/VW5CbSaJ8sCML5fGwzqYjyZohIBEpp7+ynAkOUSf3M9q1M1Rcp4bLkOQSpOy8+VLSN/p7TTsX7vaRG4RZP07JHd0FVjj2v2RemcMHjyMrZ4s7humyZ3ciKcOLBjvBipKeBJzSaz5o4658rkGNihgU3AU+8x89iaXSfFLjVyJWYN6yxiiFn6ZMOmr+BguEgjR65Ez5a1MXVoZ5Eoq6XXpPOIntyst5d6V0tXxFV0ESMxNNUPNTsnFUsVxIHVkxJlPCV0ORtekEyOvNnS4+jaackGPNHz0IJ/Mom5GwELaPfLYsaTqe/JwpdD38ywrk2ITSAKTnIAT/QIK7YeZP25tXjC903fFWdNTPHkAPHCdXvY0Okr40FnOpPOad+wChaOt14Qft2uo6z32IWIo8w9nsGoQKWyhbmgsa72myngyfbvWc0qnTywPfp1aGRVhzMFPPFXmRhqauobkSuQ0smeJ+664Llu1zAFPNnafupPgzo2xLgBarkB7WEKeLIJDebxkCFtqhTYt2KiiClqSbc3BTzZ3Ga5Eo2r/U6lL/Ft7jF6Ltuw95y6VFqzgWLy2Syde2UKODmosG7GYNSsaLkjli3A091HL1jtziPxNShUVJqRk1vBz0dKF0MtksRiT0zUv9sMwWd/XUaBDC7ODji7dY6ICWMKeLLpGxDkfDG/aEJvtGmQuDsrjVWDpiznLkwmDX8sfVd0HpkpVCzJ2WG67E5L+qj+OaaAp0T7rMmcikoDFKhQIj82zhlulDFoCniy+RuRKTCiezNiTFk1JmrjYA3wRL9ZumkfGzRlhUbPSpNXCjLQJtpuvc1E7T2+F/BE1z985hprM3AawnkZtKkyJMtzYhpny5XIj11Lx8HJIWGd818BT7TJNGTqcqwgwEELkhnr6BZ/PzIOxg3q0gjj+onnEu1ll20+wDwnLTXIG1rWqYDlUwZa3c+27j/Fuo6YKyrboziXpzgvmwBHPc3YSYs2sSkkcWEMbNM+pKXtpfNlcvRtWx9Thqidz42OwYIMHhoGZSaPtFa1kXQ0q7cbipfvfBPIBILxMdhW4Imem0wMSJfwERlK6JMWJMaTLcO/4W/8X91hb85vgUIGNVqtckauql3g4JpOePj4GRs5eQa6tm0JAkoK5s+LrJkywDWlCxrXqy3sPXaRtfKc9t2AJ57qMyA6jiFLahVKZ3NGqWzOPBUndzoSICcXuzNPg3kpHXeMS6VCjUKuSOeihEdKJaJjGBcmD46Mwd134bjjHcIFyCNi2HcpsVPnlCSMnIMnlVS+OHjsZNx9+ARF8ucFifLdvv8Q5cqUxPhhnvzD8314lgXcP8YZBJx15pQW+euJ3XuS521bdpWfBXh65f2R7Tt+iXYjOK2T2Bv8SGygNNVEza6FvUqOIV2b8tIPRSJuPTfvP2ODpizDtXvP1RODLc6N8awsToPB6mmeaFq7ovDZL5CVa9wHPqT3o1OvTJRe2gnOl1MsCG7JWyOB7mpthiCGgIB4fQY58uXIyFkXWh0r08CTJXcxcY5MjsGdG2Nc/4QJ1hLGE4mul2/SF96f/EVxcE+VAmR7nD+X9eL6N+4/Y1VbD0YU0dR14pCHwJf10y3eZTfWUhL+HDlrNe4/f6e+ti19QlMuypl6Mjmq/VGEWGmWAU+2vCKZHAVyZuKgZ3Ixnugxgr+FcnCWvg+DjQebgCdbGqcea0kLbISeG0tyAU8ffP1YuUZ98eVrsMiYwM3VBWe2zkL2zOmFWu2HsXM3yJlSyzYUOHN1w+zhqFM5wWnJ0haS4GiFZgPwjnTFdCzSaZFLLl66LE3TwJOld9M/Tw08TRncEX3bN7QqMUwUeLLmcfhuqwz5smfAJM8OqFGxtMnnMA08WXPDhHOpPw3p0hhj9LQqTAJPtt2Gt8/DzRW7l01IRuDJtodRA6mkuZSgBUL6TjsOncOOg2fw3tePM2bEO9xW3IuzbQRkSpea96uGNSpY1a9sAZ64Ft3cDQb6bD1b1cGM4d2suj+1lJiIPUfPw+YDpFuo1X9UfysTBrTDQB3hYJPAkxUh4yX6nOmUguvodGxqmb7SrBXb2aRFmxFFFuA8F7C2dF7NdqB3Xbdyacwf0xvubmIzHGuaoT3XNPBkzdU0z8YY6v9dFlOHdhGVEOleyTTwZM39xOPCqF4tMKxHC6v7Dl3FWuAp6Fso+71Rb7zzTXAXpLGpdoWixLAz6o72PYEnagOJ2I+ZsxZvfUjvkjb4bXAz5xu/araknRw4t20uCumYFvxXwBO171tIKGe7bNx7Ws3govYlsnFotCfxdQaVq8WiX/uGvBTbmK5bbFwca0Su8JfuJWiSCgKtSbjAN7mhW9tTifHP9bi8fUUGJ86O9tizfAJ+LybWPKTqDtJOm7dmF8KjYmwcL9SbKDxeMhmK5s6MU5tn8TabGoPb1q+MJUYYe+baS/PA4ClLsXzbUbNjcFKAJ3qOw2eusuZ9J3EpAP0+IDGezL0pC/7+7dMr9vLkashYjFpsDDLkrNYNKdJlE76FhLAaTdoiPDyC6srh7OyElC4pUKJoYYzw7C3cfPCMVW87RI2CW/uBWvBs2lMIkaXSgbzp7PFbZieUyu4MZzs51xMIiojDC99wXHsdCnuVDHnc7VEhjwu+hsbAPyQGkTFxvEyPtJwIcAqNiuUled/DyU77vJTIkZ39lnnq0irfz1/Yms07cef+Q17/nDtndvTt1h7p0qoR33dX9rCQ19cQERnNRfdUaXMid9VOVg88VoQ00VMp6fyjST+DXf4ezWtixgjrkzbdm5FtZY1OowxE8IyxFrS/o0Xumat3cfTsdVy79xSv3n1AJC9/p/RIzXAzZBupk0L6P/q3oz3VWhdB15a1qV7both+Df7GFq7fix0Hz+Klt6+mFCihhE4cRDWFVP3/6olVYNFEl+W173+XK4H6Vf/gC9W1O4+wXmMXan6u1WRSoAHR9q0QIta9P00itTuOwBVdy1EO1Ancarhuld95m7mG1dDZhrXdSek8nPHUEBM828fHtevw2WwzWaLTjjkdvPRPxUEwbWnJxt3HWTeyrOdHQhzqVymNTXNtc9CJio5mdTuPwsVbj8UuP4IcG2fZNqHrhoZ2Qxas2439J6/gpfcnTYKSWJ9Qsz20/ZBKGtKnTYWcWTOgTNH8vE+U0BE7ffHmPStau6u6jCU5xlQTjCcqHek3cYXIJpnuuWJSf7SsX8Wi7+PSzYesYfex+BZOboRip6EMbinx4OhqA10Dbv29erf4vknoe6YYT3826cdu65ZGkhBl5nQ4vmGG1eBjvwmL2KodpHWjYzhAOjVjetC7A+3CBYdEJLgeyuTInz0DTm+ZY1aA2VTT+4ybz1b/e0JvnFRiWLfGGKUjuL9g7S42fDYtsHVKVZMQT62O3iTPdujf0TLHGe3tCHjKX7UDNyqxbsGrGat5ss+QIa0rucGiT9t/kC1z4jqH3Ilm5a5ka78pxtNfzQawm49eJd8mm4bxtHe5l4HZgrnXt+3AadZpxLxkG8MpX2lS/Q+smTHE4Lv38fVnx85fx4kLN3H3yWuumwgqKY8vtUhk7qUFJgPSuaVE9fIl0bNNPdEi01w7tX+nBUfhmp3VBg8aIJbeU8mCOXFw9SSR/AP9JiwikjtFXX/4Quf7Ued8h9dOQTk9PSBLn4M2bdp4TtWw97TzlRKlC+fA/lWT48V4/2jUh9179s7KviLOV1I62+Pv34uhb/sGKFFELCZu7nmpjH/u6n9x9d5ThFOiZC5P0uYtmnKpQnmyo2W9yujeqm6iguTmnkP377uOnGNth9iSd+iMDXGxKJg7K9o3qkZlOonqw4yetYbNWbcvWceFpDCeDOdbdbtWTu6PFvWMz7ekj7P72CUNwCPwNRD1hwqlixqdn0fMWMXmb6A2axlJ6nuc3zpLpJUZEhbOClbrCL/ABB1B+p7+KlkQu5aNT/SdP3/znvetQ2euqzVMeRmdZTk49QcHlQyZ0qfjG6LV/izFx3ldTaBaHYazczcfJ4xtVC2Q1pXP21ktNAMICQ3nJfI3dMdrmRzZMrjh/uGVibLeaazZtOcElm4+gHtPXmpK6eJ0NMH0qxp0v1sZlHKGEgVz829HX/tN93u49eAZq9tlNAKDwxLyBoEMC9w5GJcyhbNFOZj+Nzhw8hK2dPNhEShI5ZmDOjXAmL5tjLb99OXbbMG6PTh79a5mXaVtr/l1Fb37VCkcyHAJxQvlIiYrav5Vim/81mxnOAbT8+5eOo40pGxqH41tpDFKcjtal2lqn/4YXK5RX3b32duEMdhEHpzYGOY5cTHjJXd6LncEPA3u2ABj+4uF1K0ZD20516aA2XKjH/GbqJCv7MmhhZDFhCEqKobbj6cr2xypshUWYuNi2Z6DR7loccb0HkiTOhXSpErF/61QyAXS4KnfdTSevP5g4+6/dS2kzqaUC8iTzh5FMznxMjpyXLn7ntzq7HnZ3KsvkRygIu0nYkI9/RSON36R3BnvewNOmhU2KYTDs/0/8Bootr2lv8fExDCFQhHfh1hcHHt5ai0iPz9HZHQsVEo5XLKXQpbfrdttti6SiZ9NjKdyTfoaAE/qcqUuSer/pB1Ro+MIA+CJrOmH9zRPY6aFPwnaPX/zHncfv8Y7n09cSPydz2eEkh6FBsAgx7uM6dyQNZMHFx8uUyw/KpQuYtOzv/b+yM5cuYtbj17g+at3eP/RDx98/dSUdn4/AW6pUnKB8wzp0vD75siSAXlyZEKebJniy+so6hERkaztoGk4fPYmEF8vrt7pWDZ5AGdE2fouif0wbOYaERWaarIb1yxHuhb8uiRc2W7IzGRbtPBnlckxqFNjkaNFj1Fz2ab9hq52B1dP4QutqKho1m7QNBw4fd0gDksn9UezOpVsjgPR1AdPWyWOgyBHg6q/2wzs6b8T6hM0Ud97+gYPn72Gr18APvr6q3WPNH0iVUpn7ryYySMtgR0EOiJ7Jg8SBTVpTU4lHcXrdhOJi9vaH7TvhhhPB1ZOFjGe1uw8wvp5LTMEniZ7onldy2M/dclmNmnxVvHup4bxdPvgCoMkduKCjWz6yn+TdUFgbOyo3NKT3XhAwv2aJJwnHhms0pbRxv3MlTused/JXOxWm+yQTlyFUoVQ5rd8mLZ8B2Tc/EBzCHIMJtZMX9sTE0oGG3QbyzdX4kF1QY6i+bLhwKrJJGjNv4/FG/ayYTPXJls8tcDT5EGGjpjm+iEBT0Vqdha52pn7Dd0vY7o0fNzMnysriubLiT9KFLQYoCBHzKnkDJpMwBstwIi9qa/x9HfrQcwou898A42foWE8/btkvNWMpx2HzrJOw/Vc7Wx9Dk1ZKLnM6Wo8Gbvcq3c+7PGLd3j6+j1flPl88sPngEC8+/AZJL7MFUBooejhxt9nziwZUTR/Dv4+9Z1MrXlcWgzSmPjqva8IeCpTNA/2LJtgADzR5hZtwpCKUcL3qsAfxfNix6JxcHF2tGluCQj8xks9nrzSKcEggWuVEtsXjUHFsmoZir+a92e3H722AniSIW1qF5435MmRGYXyZMPvJQqi7G+GLliWxo02YC7feoSLNx7g4fO3XMD/s38gPvkF6CyiKW9x4XNUBvc0yJsrC0oUyk15ErkW2hQjU8+359gF1nawNXmHAJVCgcwZ0/LNu4J5sqNEwVxk1gP3NOYZWOPmrmOz1+xJ1nGBtARt1XgynG81wNMUzyTlOrrxHj17DZu3jtosBp7ObZ2NYgUTtMEIePqtVhf46pSN0rhXuWxRbFs42iKwkZweL958gDuPXuLlWx+8//SFm6jET4GCwMcA99SuyOCRFpk83JArS0bkzcnzYZPO0PW7jmanr94XAU9k6EOVANYATw26jcZVXTa2TI6cmdPh1v5lFsktkJv2pVsPcfnWYzx++RYfPvmBXPn8A4MTNkl12pg5QzpuOFTmt/z4s1ThRN0rKUZTl2xhExdtgQBdp2Q5+rX/h6QxbP72aDOwdqcRxNAU5Q0Fc2XBwdWTRSCf/rdKjH4y+CAReBIPp3caGBwan88qFXJkTk+5bCpk8EiDrBk8kDt7RuTNrn6nqV1d4p/b+BgsR6HcWXj+ogs2Wjqm0Xnk/Fmz/TDcevRKVG6nPwYT453O0c3/jOXBid2bmOdkAPXgubfOGkUtLj6kcyMDeQdr2mHLuTZ3Cltu9r1/Exsby57snwOEBXBxawKeXAtURvoi5ne9SYir1YAp2H9KVwj1+z4xgethkbHI4W6PrhXS4fTTIK7bJBMEPPQJ42V25GLXsFhq7LsbgHNPg2FvJ+eivz/kILqkTIbV0wejUU3zlPKYqAj2ZN8csMhgnryRq5nbbzXhUdD8b79Xe8j1gAZa9aFF+AXu4qYt2bL13mHhkYycVMQMJQG0SNcduCy9Pk2iERFRCA2PEA229nZ2cHK0g7OTY6IldZbeR3vet5AwRvcKj4gEuVpoQQY7OyXVUJP+ikiDRf/6RNnnoJXuxAD1blaGdG4WTfqmnpne2/tPfiRlrXOKwF0ptJM27Qb5+n01rUdlbUD4+QJcXZxEWguf/b+yb6SHpNN/SDCUkhGi4dJigia27xEHYn95f/ySaBxsaqaJHwWHhLGIyEiEh0eKwEiVSgEHOzs4OtjD0cHOohGIFgzkjqixYkqGxxSgVCr4woI2C7QXJBYhAbb63yEBZCmsWJiRNgItPPWvQwK2WTK4GyR5lNB9Jcc2U3poVrfY+NhBwp2RxMTV6X88DunSWD0eUBtpPCThZN3rEXvV0dEeNP7ot59AaCfHpGn00UJfTXpTf8+0kCbLAXLWUSmV/F0GBn9j/pqdZ6tDZ/QH6i6SJpVLPLhl6XXpm6YNALUzpgm9O4OLCfRt8H9s2eX97/qTpVExdZ7ARZ5p0W+sFCOxqyf/GC6QrTnSWVFSFRMby2i8C4+M5Bs+2rmQxnj1eGdvM8BjrO1vP/gy/bmC2OHcUU+vZJ7EmcnqWyxPItDziMB3W94g6YyEEcNTp39T293dXOP7r+HYY+5OAuztVTx/INc7cjo29wtr/h4VHcMINCchYZqnElz1BFiat1hzP2PnhoSGMXJ4tWZcoJzeycmeO6U5OdhbFRMyXElYNCf16dU5TmrXFEiVMoVVz2F6vlVfxtr5NrGW+H8NZoHBunOr+h4EBOuOMbTmo/xIfz6j3JXmLZkVxja0BvwWGobQsEiER9DGb8JBY4C9nYqPBXYq9Xxl7iCGJeXWuvMs5a80byt1NuwTuw7NQ7TGiNRxN6b3p5sHm3sO3b+HR0Tyb57GOnFOAd42aiP1UWtck42NI/SM6dxS0VhsUaxMtYEc7tTfeELeQGsCAscseUYaL0LonYZHcDKKdo3DDb0c7OFA79TRPtE8ytQYnMLZ0WrGuX47ff2+spBQ3bUFSY2aG4ON58Hm+sEX/0AWHEKsNPGaytb1qrn7Jfb3JHWKpNz4e/321ZkNLNznMSKjo2GvVMI+QwFk/6sllZGI2hodEcoIGVeoEhZRU5duYRMXbhaXtXyvB9Vcl/JaWkP9UywVUjoqkNJejg1X/OATGIWuFdw524kc7XbfCuBi5Kofhjqp2R+kUXN225x4VwJiNUVHhHDBdv3QhH/9yB4fWAA54vjutkohQ+aKHZAyo3X06u8ccunyUgSkCEgRkCIgRUCKgBQBKQJSBKQISBGQIiBFQIrAD4rALwc8fbx7gvk/PImobD9UhwAAIABJREFU6FgQnU7m4Ip8dftDrhTv0ge8vsPiYqLhlrtUfAyu3H7ErT/VOk/WChna9sYIzI2KZahd2BV/5XXB5qt+uOMdyllPJCTeorQbIqLjsObiF8SxOP7ff9ghk6Nqud+wZ5lX/E1joyKYz51jyFiyjsFugt/z6+zdpR38GekfJlchT63ecHB1/4EP/cOiI91IioAUASkCUgSkCEgRkCIgRUCKgBQBKQJSBKQISBEwE4FfDhAI/vCUvTmzlpe9EP07Nk5A3po94JQ2ixAXE83Cv35EXGw0Pj+5hKhvAchcuh4nnjmlyYgYJkPF5gNw9+mbH6LzpP9uuLkUI20B9WuJ5eVP4CDOj8Sb4p9LpsCcEV3RtWUdITLYj0WFBiE80Bef7p9EhmLVYeecBkonV9i7pOEP/ObSDhbx7g5CI6PhqFJC5poJuap0gFxlHbVY+mqlCEgRkCIgRUCKgBQBKQJSBKQISBGQIiBFQIqAFIFfIwK/HPAUGRLAnhxcCCE6jNf9EojjXqwmPApVFOJiY1iQ90N8vHsCMSH+iIuNhcLJFWnzV0DaPKUhUyiFGcu2sXELNonEfH/Eq+ZmChxkEt8t3kX9R78pcqpJ7YJj66cjT/ZMQuQ3f+Zz6whCPz1DbFQEFCoHOKbPgwzFasAuRWohJjqSPT+6DELoZ4SGR8LV2QGqzCWQuUz9H/3kP+J1SfeQIiBFQIqAFAEpAlIEpAhIEZAiIEVAioAUASkCUgQsiMAvBwrExkSz12c3Is7/Jb6FRcLZ0Q7yNDmRs1I7CBqhuc9PLrOQR0e4cDbSF0WmUvXiy8YePnvDKrf0REh41A8rt7PgPf3wU8jWsVnt8lg+eWC8QGREsB97cWw50jrGwS9CgVzVusHOWe3KEfL5DXt1cjVYbCRYHCORTKQv0whuuWyzmvzhDZZuKEVAioAUASkCUgSkCEgRkCIgRUCKgBQBKQJSBKQIJHsEfjngiSL08d4pFvToFMIio7izGlM5I3fVLrDXaA19uHGIRUcEQ6VUITIqCtnKNY0Hpcj1p8eoudh68Hzy2rQn+6v7jhcUBNirVNg8bwSqV0jQwArxfcN8bh9Bqsx54f/mATKXaQAnt0y8D326f5p9e3wSwWGRsFcpEatwRJ4a3WHv4vZL9rHvGH3p0lIEpAhIEZAiIEVAioAUASkCUgSkCEgRkCIgReCXicAvCQoQ++bF8VWQIxrRMXGwt1MibbF6SJu3jMDiYtm3Ty/h7JETMplcIDDFLqUblPbO8bE4ffk2a9RjHCKjY/9fsp4EmRzlSxTAwdVTRHa4YQE+jP7m4JpOCPv6iVHAHFJ5CMQye3FsBWKD3nNhdkd7FRRuOZD7706/ZP/6Zb5+qSFSBKQISBGQIiBFQIqAFAEpAlIEpAhIEZAiIEXgO0fglwQGCAghvSEW7IMwLRCSOjtyV+tscXtb95/ENh84B7DY7/wKfrbLC7C3U2H/krGo8ldpi+IV8vkte3Z4MdenInF0hVwOj5L14J7vd4t+/7NFQHoeKQJSBKQISBGQIiBFQIqAFAEpAlIEpAhIEZAiIEUgeSLwywIDVG4X8OA4Zy2RK1wcZMhRvSfkjqmglvE2fchkMly/9xSeE5fgv7GTS56Xa8tVBEGGQnmyYM6onlAq5IlegjoPE2Twu3sEIa+vI1oj5g6lA/LV7stFx215Buk3UgSkCEgRkCIgRUCKgBQBKQJSBKQISBGQIiBFQIrArxGBXxYYCA/0ZU8OLICMRSMmNg4ygUGWqQzgXsAi7SalQgHG2P833In3akEQeMzi4uIS7+WCDAKLRczjQ5BHBSCWyZDCyR4qj0LIUq4xL2X8NT4TqRVSBKQISBGQIiBFQIqAFAEpAlIEpAhIEZAiIEVAioAtEfilgYHX57aw6E8PubudSikHVC7IUqkDMXEAljjriYKpMcGzJa4/1W9UKrv49xwVFWm24RQaAt3MHsR2enIRIU9OISwiAnJyCRTkyFqxDVwz5f+l+5bZ2EgnSBGQIiBFQIqAFAEpAlIEpAhIEZAiIEVAioAUASkC+KXBgSDvR8z7wmbExESDxTHYKeVIXagKPIr8/Uu3W79fv377jt1+8BhZM2ZAid8KJ1vbYyND2dNDi8HCAxARFQMnBxXgnB65q3WBXJkAdknfmRQBKQJSBKQISBGQIiBFQIqAFAEpAlIEpAhIEZAi8P8zAskGQvyM4YsjkfHjK8GC3yM0PAp2SgWY0gl5a/eGysnVorZHRkWxqKgoODk6QqZDgYqJiWGRUVGwU6kQGxeHmJgY2NvZQS5Xl5eFhIay6OgY+g3s7e2gUChA16EyNns7NSgTERHJGBhUSiX/XVxcHAsJDUUsaSXJZXBJkUL0jPT3sPBwfh+FQiH6W0hIKIuOUd/Pzk7Fr6l93hNnL7DDJ8+iRqUKqFrpT36fiMhIDsY5OTmqnyUykj+vo4N9fBvMvVPfh+eY370jiIyK4SWJMkGGjGUawi2PZaLk5q4v/V2KgBQBKQJSBKQISBGQIiBFQIqAFAEpAlIEpAhIEfjfjoBF4Mv/chMDXt9h785v4YLisXEMjnZKpMj9BzKVrGNR22cuWMZOX7yC5g3qok2zhhpQKYyNmzYbL169gWfPLrh9/yFOn7+M8cMGIGvmTFi0ch1OnL2AbyGhUCoVyJ09G1o1bYhtu/cjrVtqjB/qyf+75ygvBAQGYvrY4ZDJ5Zi3dDXOXrpCgBQHqyr+URbdO7ZB5ozp+X03bNvFduw7hDLFi2LkwD78vwV8DWQrN2zBsdPnERgUzAGubFkyYVCvLihZrKjwNTCIDR4zCd9CQ9G/eyf8Xqq48MXPn42cOB3+X4MwrH9PlCpWRJi9aAU7ce4iJo4YhOJFC5mNTVRoIHtycBHkMaGIiIqGg50ScHJD3pq9JLbT//IHIz27FAEpAlIEpAhIEZAiIEVAioAUASkCUgSkCEgRSMYImAUYkvFe/8ml4mJj2IvjKxEb6I3QCGI9yRErKJC7Wjc4uWU22/7eg8ewa3fvw83VBZtXLoCri4tw/vI11m/4eM5eGju0H85dvIazl69hltcIXLt1F9t2H4R7mlQoUiAfAoKC4PvZD62a/IOZC5cja6YM2L5mCb9vnebtme8Xf6xbNBsr1m/B+Ws3kC9nDuTMnoWDWk9fvUXpooWwcIYXiM3UrGNP+Pj6cZCHfpMta2Zh9qLlbMueQ0jl4oziRQohJCQUT56/xNSxw1CyWBHh2OlzbNiEaZDJFahRqTwmjhwsfPL9zDr2HYwvAUEomj8PZk8ajenzl+LIyXOYM2kM/vy9lNm4eF/bx0JfXUVYZDR/r6Sh5VGqAdxyS2yn/6SjSzeVIiBFQIqAFAEpAlIEpAhIEZAiIEVAioAUASkCP2EEzAIMP+EzW/1IQe+fsHfn1iMuNpa7tTk72EGWJgdyVmpHTKNEYzBgxAR27sp1xMXGYPwwT9SrWVUYOm4KO372IlhcLLxGDsKFy9dx7MwFjBvSH8Q++vT5M1bOm45C+fMiKjoakZFR8P3yBa269kMGj3QY2q8HVColRk+eydlNg/p0g9f0eXBzS43VC2bA3c1NeO/zkXX3HIFPn79g76aV+Oj7GfS/qZQuJiYWQ/t2Q6P6tdG4bTd4+3zEklmTUPK3Ivxvwd9CkMo1JZXrCYPGTGJnLlwmqzqkTZ0K65fOhUL+f+3deZBU1d3G8ed292wwAwxr2DdF3BWURRCiQfENooAIAhKFANHIixg3BCSAChgjMYoLBlBQINGAr6AJyiYgsi8OyCLCILsCMywDM93T3Sd1LzA4YYbbfStvVar62xRVlvzOnXM/9/T88dS5v+NXn4GPa8++g7K7fD06oI/27Dug2Z/O04Rxo9WqxQ0XNTn5426za8EUWdGQQuGI46mM6rqk3a8VSE5NiDUV9yJkAAIIIIAAAggggAACCCCAAAIJKJAQIYG96yl72UyFf9iuvPygc1qdfQJb9WadVaVR8xiCp9WyE5pWza7XoAF91e/Rp3Ui71RR8LR85Vp9tnipBvZ7QNM//EgZ6ema9ub4Yj2asvfsNff/5lHl5wdl2ae/2S//maiqV62ibp3u1Ktvv6NWzZrqlbEjnd5Mdg+pQU//XivWrtc7E17WgiXLNGPWXP2izU1avnKNml57tZ4YOEC/evgx2X2iPp89vah31Ll1bIdXdthVuWKmKmaW1/qsLRo74ind1KyJE4LZwZNtUS4jQ9WqVNL273ZpwovPXTR4ihSGzHfzJytq980qCCnJ75Pl86tOm16qUPvKhFhPCfh7gltGAAEEEEAAAQQQQAABBBBAwJNAwgQF+ccOmu8+e1tWuEAFhWGlJgdkJaer4W0DlFq+SqkOg4eOMku/Wu00z65SqaLq1KqpdV9vco4DtJuKn9/xtEyDH+pr92FSUiCgv06eUCx42r13n+nW57cql56uLh3vUFJSkt77YLbTnPzBHl01/o1J9qtxmjh+rDMXuwF4/8FDlLV5i0Y98ztN++ss7di9R3ZkFYlElJaaqjHDn9LYV153djjN/2i63QC92H18+PGnZuwrbyoajThBm3x+dWjXVg/1uV8DHhuiSDiiG5tcp08+XyhjjHyWpVfHjrpo8HRg43xzbMtiBcNhRaNG6WnJSqp+lRq06ZEwa8nTN41BCCCAAAIIIIAAAggggAACCCSgQEKFBQc3LTK5mxc6zbDtoMUOTfyVGqhem16lviI2aMhIs2zFKrVucaPWbcxSMFSoalUqq27tmlq1IUujhzzmvGo3f8mXemHoE5o68+/avjNbzz45yG7k7YRC+w8cdJqFDx46Sg3r1dXUN8bbwZPVuXd/czTnmBNejRw3XuFIWC+OeEaXNKinrd/u1LAXXlJG2TLq2fVuTZg0zQm+mjW5Vlt37NS2Hbv0QPfO2rR1uzZkbdHjA/upXZvWOnU6Xzuzv9cVjS/Vn96crEXLVqh5k2tUMbOCvli+0jkRb+yIIXrupT87DddfHTdKT44Yo+y9+50dXK9d5FW7Ewd3mL1LpytaWKBgOOI0ag/709TojoeUWq708C4Bv1fcMgIIIIAAAggggAACCCCAAAIIOO+PJdAnErZfE5si6+Q+nTwddHb4pCQHVP6yNqrZ5I4SLfo9+rTZ+M02PfPoQ5ry/t90+NgJ3X5zS2VkpGv2PxZoyKABsnsorViXpT+OfFpHc3L1/MuvKWqMMsuXc4KgUDisPj26OqFUzeo/c3ZDpaamqn2XXjqSk6sPprypxV8u18R3ZyoSCTshUU7uMfl8fvskPe0/eFDLVq7XQw/epz49u1kr1qw3g4aOVp3q1dT5zvb689vvOruvKmSkKz+/QAWhoDp3uEOz585Takqy5v39PVUoX856bOgo8+Wa9brr9lu1ZPlK5RcUaOk/Zmn+oqUaNuZlZyWMHz1MbVu3uMAimJdrdi18R8o/qlP5IQUCPsevRrMuqtyIhuIJ9DXiVhFAAAEEEEAAAQQQQAABBBCIWSChgidb5dTRfWbn/EnyR4PKD4ad09hk+VSzRVdVatjkAo+Zs+aYLdt3qE/Prvp68zat2ZCl+7rcqSNHc7Rw6Vfq3qWjdny3S+u+3qw+ve7VpQ3qW59+ttDYu4tO5uUpOSlZDRvUc/oqLfxiuSpWrKAHenRVciCg1ydPc3ZEDXiglypXyrRmz51nvlq9RgXBkNJSUnTzTc3UtlVLvf/BbB05mqsHe3ZV3dq1rNxjJ8xfps1wwq0+Pe/V5q3b9PniZTp+/ISS7J9Xv45dp7Xrv1ajSxrYP8+5r1VrN5iP/zlf9evUUjAUck7Ks/tS2a/hTZw6Q4d+OKz7u3XWpQ3rF3OIhIIme+l0RY7ucnpk2Z/0MikKVLtc9dv0tAOohFtHMX/DKEQAAQQQQAABBBBAAAEEEEAggQUSMjA4/O0qc2DVbOexF4ajSksJKOJLVr22vVWu+iUJaVLad8DuNbVv9RzlZa9RsLDQ6etUNjVZpkxlNWzXV8llyuOVwL9AuHUEEEAAAQQQQAABBBBAAAEELiaQsKHB9ys/Mvm71yo/WKiIMU6/IpOcoXpt71fZyrUT1uXfF8v+DZ+bnC2LFY1EFY5ElWKHdFaSGtzyoDJ+1gAnfr8ggAACCCCAAAIIIIAAAggggECpAgkbHIRD+SZ7yQxFc7J1qiDkNBsvk5qsaEp51b25p9Ir1yrR5nDOMbNy/RZn94/f5495aYUKC1WrelW1anrlBdc9fbrArNm0Xdt27tG+Q0d0Iu+0CgsLZclyTr+rlJmhOjWq6erL6uuqRvWUnJxUdI2cYyfMV+u3qCAYjGs+4UhENapVLnE+527q0OYl5kjWZ/YJewoVRpSS5JexfKp+YydVoa9TzM+eQgQQQAABBBBAAAEEEEAAAQQSVSBhgyf7gYfycs3ORe/Kl3+0qHeRHT4pLVO1b+qu9CoX7nz6cs0mc9+g53XyVIEsmZjXjbH8atfyGs16a1SReaiw0Ez/eKHeen+udu//QXmn82X5Ahf0fDcmKkXDyqxgB1BVdU/7m/XAPe1VuWJ5a03WdtPtkdHKOZ4X13yistS+9fX68I2RJa6BA1kLzdFNC5xALlQYVlLAryS/XxWuuEU1rrstoddNzA+dQgQQQAABBBBAAAEEEEAAAQQSXCDhA4T83EMme8l78gePFw+fUjJUo1lnla95WTGjpauyTJff/t5pTC47EIrxY/mTdEuzKzV30gvO9U7nB80zf/iLJn342ZkrGHPmb2lhltO/25J8fqUl+fTJ5DFqcf3l1qqNW02n34zQiVMFcc3Hvo4dhH389vPF7i8czDeHshYod/tyZyb2Tif7BLvkgF/pDZqr9o0dZfl8Cb9uYnzslCGAAAIIIIAAAggggAACCCCQ0AIECJLyDu8xe5bNlBU6oWAo7LxyZ+c8kbSqqte2l1IzKhY5LVu9ydw7cJSz46l48GQ5uVBpHzt4urXZVZoz6UzQ89LEv5lRr82QMXaA9ZOdU5ZP9g+3/zh5lB3/OKHUmZDL3hHV7JpLNW/qOCUnJVmrv95m7nl4pLPjKZ752MHTbS2v1f+9/VyxWR/duc4cWjtHqX6jglBY9it59sl/abWvV50WneXzB1gzCf0rg5tHAAEEEEAAAQQQQAABBBBAIHYBQoSzVnmH95rdS99XYV6uytVqrHK1Llf5mo0VKFNOPp8/huDp4uh28GTvMLKDnh3Z+0y73k/qyLE8KRo5P9DnV2ZGGed1ujJpqc5rbsdP5mnvgR91qiBctBdq6MPdNeyRXs6cSg+eXBaBz++8ajf7rdHF1kAkXGjyc/Yrd/cmnTr4raKnjyq9/g2q0fROBZKSWS+xf7eoRAABBBBAAAEEEEAAAQQQQCDhBQgSfrIETuceMuGCPKVXrS+f/3zY9NNVcsGOJ8unFtdepmcH9VbA73fCopI+heGwqlbK1FWX1bdemTLLDBs/1enbVPSxLPW99w716/5LVaucqbTUFOdaeafydehIjnZ9f1CLVmzQl2s2aer4IWp6VaOSgyfLUnqZVE0YOUjVq1YsdT6RaFSVM8s78yntW1BwMscUHP9RGdUayE/olPC/LABAAAEEEEAAAQQQQAABBBBAIF4Bgqc4xS4Innx+dfpFc03/8/CYLTv2G2YWrcwq2u1kvz530/WN9dHE0SpbJvWi1zmZd9pkpJcpqrlgx5PlU2a5sto8b7IqlE+PeU5xMlCOAAIIIIAAAggggAACCCCAAAIIuAoQTLgSFS8oKXi6o3UTZxeSvePp3z/2rqWAfSJc4ExvpFOn803zzgOVvf/HM8HT2abhLzzeR4P73uPURCJRY++Qssdazr/bZZbsnt5+n885Zc7+7xJ7PFk+Vcgoo8UzxqtOzaolzsfv9zlj47x1yhFAAAEEEEAAAQQQQAABBBBAAIG4BAgf4uKSSmouXjYtVdWqVCwKiX56yfxgSN1+2UYvPPFrx3rnngOmXa8n9GPOiTPNwC3LOTHug9dH6LbWNzg1X6zcaJ4YM1H5waD8vgvDrIJgSJ1ua6U/PDPAWrf5W9NpwIhizcXtUKpW9ap22FXs7uwgKxQOq/NtrTTu6f48+zifPeUIIIAAAggggAACCCCAAAIIIBCfAOFDfF4lBk/OcXb2aXQlfKxAsrq0u1HTXh7iWGdt22U69H1GOcdPnQ2efCqbmqxPpoxRs2sbOzVzFqwwPQY9J/kCxU+8O3t9KxBQx7ZNNfPV4db6b3aYu/s/e+Gpds58Sni8fr863dpM018ZyrOP89lTjgACCCCAAAIIIIAAAggggAAC8QkQPsTnVUrwVPpFLH+y7uvQWpPGPeFYr8na7uxQOnbyJ8FTWrIWTn9ZV59t9P3p4lXm/sEvKBSOlBw8+QO65/abNPXlIaUHT6VNyedXt/+5We+89BTPPs5nTzkCCCCAAAIIIIAAAggggAACCMQnQPgQn1fJwZPdh6m0HU/+4jueNm75znTsN/z8DiXrzI6nedNeVJMrLz2z42mhvePpecl+zc4+Jc/5Gy2aqRVL8GTP52x/qGK3aDdDZ8dTnE+dcgQQQAABBBBAAAEEEEAAAQQQ8CJA8BSn2gU9nixLdWtWVYefN5fdtDsaNcWuaO9aanFdY93X8VbHekf2PnP7r54q1uMpNTlJs94cqZ+3uM6p+ebb3WbGxwsUDBUqLSVFG7ftVLFT8C4aPFlKTg6oe4efK7NcuiLR84GVfe1I1OiGqxupx11n5sMHAQQQQAABBBBAAAEEEEAAAQQQ+P8SIHyIU7akU+06tL1BH7z++5gsc4+fNC06D9S+H3Ikc+ZUO/vPG6P/V7+6p32J15j+8QLzm+ETZCIhZ7YX3fF09lS7VbNfV60aVWKaU5wElCOAAAIIIIAAAggggAACCCCAAAIxCRBMxMR0vqi04Gnma8PtE+hi8mzTfbBZ981OKRo5EyT5AupxZ1v9ZdzjJY6fOWeh6T/stZiDp8xyZbVuzluqViUzpvnESUA5AggggAACCCCAAAIIIIAAAgggEJMAwURMTBcPnn7ZpqlmvDpcSYFATJ5Pjn3LvDH906Lgye4PlVE2TS8+3V93tWupzPIZxa4zccZc8/jYyTEHT+XKpuqTSWNUp2ZVRe3+UCV8otGo0lJTVKFcekxzjpOJcgQQQAABBBBAAAEEEEAAAQQQQECEDnEugpJ2PMUbPH2xcqPp0HeYHP1zwZDlk88yuuGay1S3RjWll0mTHQ6dPHVaX2/dpZ17DxbVujUX9/t8atSgltMfqrTgye711LrpFfrjsIdZA3GuAcoRQAABBBBAAAEEEEAAAQQQQCA2AUKH2JyKqv4TwVNBQdD0/t04/XPZeplI4fkZ2P2eLP/Z0+jOPRojY7+S92+n2nVu10Lv/Wmotf6bHebu/s+ePyXv3NXsE/Eu9vH51bZpY/3jnXGsgTjXAOUIIIAAAggggAACCCCAAAIIIBCbAKFDbE7/0eDJvti2nXtMt0dGa+f+w2deuftJsFTqlCzLbgjlNBfv8ovmmjZ+SOnBk9t9+fxq3/p6zX5rNGvAzYp/RwABBBBAAAEEEEAAAQQQQAABTwKEDnGyLfpqg+nYf7gsf8qZsMjnV+trG2rulDEx93g69yO3fve9eXb8u1qyepPyC0JOqFRiAHX2/yf5pZ9VqaRbWl6nR3rfrSsb1bO+Wv+Nub33U9K5+cR6Pz6/Wl5dX/Pf/yNrIFYz6hBAAAEEEEAAAQQQQAABBBBAIC4BQoe4uKQd2fvM23/9VMFQodNzycjS1Y3q6tf3dZDf54vbMxKJmi9WbtSXazdp/w9H9eORXJ3KL1AkElFSUpLKpKbYp9OpZrXKuubyhmp53RWqWrlC0c/J3nvITJw5V6fzg+f7RcVwT/a8r7y0jh7qdVfcc47h8pQggAACCCCAAAIIIIAAAggggAACNBf/b1sDBcGQsUMtO3gK+P1KSUlWSnIS4dB/24NiPggggAACCCCAAAIIIIAAAggg4CpAoOFKRAECCCCAAAIIIIAAAggggAACCCCAgBcBgicvaoxBAAEEEEAAAQQQQAABBBBAAAEEEHAVIHhyJaIAAQQQQAABBBBAAAEEEEAAAQQQQMCLAMGTFzXGIIAAAggggAACCCCAAAIIIIAAAgi4ChA8uRJRgAACCCCAAAIIIIAAAggggAACCCDgRYDgyYsaYxBAAAEEEEAAAQQQQAABBBBAAAEEXAUInlyJKEAAAQQQQAABBBBAAAEEEEAAAQQQ8CJA8ORFjTEIIIAAAggggAACCCCAAAIIIIAAAq4CBE+uRBQggAACCCCAAAIIIIAAAggggAACCHgRIHjyosYYBBBAAAEEEEAAAQQQQAABBBBAAAFXAYInVyIKEEAAAQQQQAABBBBAAAEEEEAAAQS8CBA8eVFjDAIIIIAAAggggAACCCCAAAIIIICAqwDBkysRBQgggAACCCCAAAIIIIAAAggggAACXgQInryoMQYBBBBAAAEEEEAAAQQQQAABBBBAwFWA4MmViAIEEEAAAQQQQAABBBBAAAEEEEAAAS8CBE9e1BiDAAIIIIAAAggggAACCCCAAAIIIOAqQPDkSkQBAggggAACCCCAAAIIIIAAAggggIAXAYInL2qMQQABBBBAAAEEEEAAAQQQQAABBBBwFSB4ciWiAAEEEEAAAQQQQAABBBBAAAEEEEDAiwDBkxc1xiCAAAIIIIAAAggggAACCCCAAAIIuAoQPLkSUYAAAggggAACCCCAAAIIIIAAAggg4EWA4MmLGmMQQAABBBBAAAEEEEAAAQQQQAABBFwFCJ5ciShAAAEEEEAAAQQQQAABBBBAAAEEEPAiQPDkRY0xCCCAAAIIIIAAAggggAACCCCAAAKuAgRPrkQUIIAAAggggAACCCCAAAIIIIAAAgh4ESB48qLGGAQQQAABBBBAAAEEEEAAAQQQQAABVwGCJ1ciChBi2ixfAAADiUlEQVRAAAEEEEAAAQQQQAABBBBAAAEEvAgQPHlRYwwCCCCAAAIIIIAAAggggAACCCCAgKsAwZMrEQUIIIAAAggggAACCCCAAAIIIIAAAl4ECJ68qDEGAQQQQAABBBBAAAEEEEAAAQQQQMBVgODJlYgCBBBAAAEEEEAAAQQQQAABBBBAAAEvAgRPXtQYgwACCCCAAAIIIIAAAggggAACCCDgKkDw5EpEAQIIIIAAAggggAACCCCAAAIIIICAFwGCJy9qjEEAAQQQQAABBBBAAAEEEEAAAQQQcBUgeHIlogABBBBAAAEEEEAAAQQQQAABBBBAwIsAwZMXNcYggAACCCCAAAIIIIAAAggggAACCLgKEDy5ElGAAAIIIIAAAggggAACCCCAAAIIIOBFgODJixpjEEAAAQQQQAABBBBAAAEEEEAAAQRcBQieXIkoQAABBBBAAAEEEEAAAQQQQAABBBDwIkDw5EWNMQgggAACCCCAAAIIIIAAAggggAACrgIET65EFCCAAAIIIIAAAggggAACCCCAAAIIeBEgePKixhgEEEAAAQQQQAABBBBAAAEEEEAAAVcBgidXIgoQQAABBBBAAAEEEEAAAQQQQAABBLwIEDx5UWMMAggggAACCCCAAAIIIIAAAggggICrAMGTKxEFCCCAAAIIIIAAAggggAACCCCAAAJeBAievKgxBgEEEEAAAQQQQAABBBBAAAEEEEDAVYDgyZWIAgQQQAABBBBAAAEEEEAAAQQQQAABLwIET17UGIMAAggggAACCCCAAAIIIIAAAggg4CpA8ORKRAECCCCAAAIIIIAAAggggAACCCCAgBcBgicvaoxBAAEEEEAAAQQQQAABBBBAAAEEEHAVIHhyJaIAAQQQQAABBBBAAAEEEEAAAQQQQMCLAMGTFzXGIIAAAggggAACCCCAAAIIIIAAAgi4ChA8uRJRgAACCCCAAAIIIIAAAggggAACCCDgRYDgyYsaYxBAAAEEEEAAAQQQQAABBBBAAAEEXAUInlyJKEAAAQQQQAABBBBAAAEEEEAAAQQQ8CJA8ORFjTEIIIAAAggggAACCCCAAAIIIIAAAq4CBE+uRBQggAACCCCAAAIIIIAAAggggAACCHgRIHjyosYYBBBAAAEEEEAAAQQQQAABBBBAAAFXAYInVyIKEEAAAQQQQAABBBBAAAEEEEAAAQS8CPwLNMvZdSxqXSIAAAAASUVORK5CYII=',
                        width: 500,
                        height: 80
                    } );
                }
            }],

        "order": [], // "0" means First column and "desc" is order type;

    } );
}

function closeModalImputados(){
    $('#editar').modal('hide');
}


//FUNCION PARA OBTENER LOS DATOS DE LAS COLUMNAS Y EDITAR AL HACER CLIC
var agregar = function(tbody, table){
    $('#agregar_imputado').click(function(){
        id_registro = $("#id_registro").val();
        nombre = $("#nombre").val();
        ap_paterno = $("#ap_paterno").val();
        ap_materno = $("#ap_materno").val();
        edad = $("#edad").val();
        id_sexo = $('input[name="id_sexo"]:checked').val();
        curp = $("#curp").val();

        var checkCampos = valida_campos_no_data_imputado();

        if(checkCampos){
            console.log(nombre);

            // Get the id
            var id = id_registro;
            var rowId = '#' + id;

            // Get the current row using the ID
            var row = table.row('#' + id);


            var input_nombre = 'Nombre: <input type="text" id="nombre_row_add_'+ id_registro +'" class="input-css" placeholder="ESPECIFICA EL NOMBRE" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >';
            var input_ap_paterno = 'Paterno: <input type="text" id="paterno_row_add_'+ id_registro +'"  class="input-css" placeholder="ESPECIFICA EL APELLIDO PATERNO" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >';
            var input_ap_materno = 'Materno: <input type="text" id="materno_row_add_'+ id_registro +'" class="input-css" placeholder="ESPECIFICA EL APELLIDO MATERNO" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >';
            var input_edad = 'Edad: <input type="text" id="edad_row_add_'+ id_registro +'" class="input-css" placeholder="ESPECIFICA LA EDAD" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >';
            var input_sexo = 'Sexo:<br><input type="radio" id="id_sexo_row_add_'+ id_registro +'" name="id_sexo_'+id_registro+'" value="M" style="height:25px; width:25px;"><label for="cv_sexo" style="font-size: 20px;">Masculino</label><br><input type="radio" id="id_sexo_row_add_'+ id_registro +'" name="id_sexo_'+id_registro+'" value="F" style="height:25px; width:25px;"><label for="cv_sexo" style="font-size: 20px;">Femenino</label><br>';
            var input_curp = 'CURP: <input type="text" id="curp_row_add_'+ id_registro +'" class="input-css" placeholder="ESPECIFICA EL CURP" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >';


            var html = input_nombre+input_ap_paterno+input_ap_materno+input_edad+input_sexo+input_curp;

            table.cell( rowId, 3 ).data( html );

            console.log(id_sexo);

            $("#nombre_row_add_"+ id_registro).val(nombre);
            $("#paterno_row_add_"+ id_registro).val(ap_paterno);
            $("#materno_row_add_"+ id_registro).val(ap_materno);
            $("#edad_row_add_"+ id_registro).val(edad);
            $("input[name=id_sexo_"+ id_registro + "][value='"+ id_sexo +"']").prop("checked",true);
            $("#curp_row_add_"+ id_registro).val(curp);

            console.log(id);
            console.log('entra aca');
            $("#id_registro").val('');
            $("#nombre").val('');
            $("#ap_paterno").val('');
            $("#ap_materno").val('');
            $("#edad").val('');
            $('input[name="id_sexo"]').prop('checked', false);
            $("#curp").val('');
            closeModalImputados();
        }else{
            swal("", "Faltan campos por registrar, verifique.", "warning");
        }

    });
}

//FUNCION PARA GUARDAR LOS DATOS DE LAS COLUMNAS Y EDITAR AL HACER CLIC
var guardar = function(tbody, table){
    $(tbody).on("click","button.guardar_no_data_imputado", function(){

        var ID = $(this).closest('tr').find('td').eq(0).text();
        console.log(ID);

        var idMp = $("#idMp").val();
        var mes = $("#mes").val();
        var anio = $("#anio").val();
        var estatResolucion = $("#estatResolucion").val();
        var idUnidad = $("#idUnidad").val();

        var acc = 'save_no_data_imp';

        var rowData = table.rows('#' + ID).data().toArray();
        var rowNodes = table.rows('#' + ID).nodes().toArray();

        var datos_columna = [];
        for (i = 0; i < rowData.length; i++) {
            let selected_imputado_nombre = $(rowNodes[i]).find("select.imputados option:selected").text();
            let selected_imputado_idLitigacion = $(rowNodes[i]).find("select.imputados option:selected").val();
            let selected_etapa_nombre = $(rowNodes[i]).find("select.etapa option:selected").text();
            let selected_etapa_id = $(rowNodes[i]).find("select.etapa option:selected").val();
            let tempObj = {
                id_registro: rowData[i].id,
                nuc: rowData[i].NUC,
                imputado: selected_imputado_nombre,
                imputado_idLitigacion: selected_imputado_idLitigacion,
                etapa: selected_etapa_nombre,
                etapa_id: selected_etapa_id
            }
            datos_columna.push(tempObj);
        }
        var checkCampos = valida_columna_no_data_imputado(datos_columna[0].nuc, datos_columna[0].imputado_idLitigacion, datos_columna[0].etapa_id);
        if(checkCampos){

            console.log(datos_columna[0].id_registro + ' Se ha seleccionado el nuc: ' + datos_columna[0].nuc + ' con el imputado: ' + datos_columna[0].imputado + ' con ID: ' + datos_columna[0].imputado_idLitigacion + ' en la etapa: ' +  datos_columna[0].etapa + ' con id de etapa ' +  datos_columna[0].etapa_id );
            /*ENVIAMOS INFORMACION PARA INSERTAR*/
            $.ajax({
                type: "POST",
                dataType: 'html',
                url: "format/litigacion/insert_tramite.php",
                data: "acc="+acc+"&nuc="+datos_columna[0].nuc+"&imputado_idLitigacion="+datos_columna[0].imputado_idLitigacion+"&etapa_id="+datos_columna[0].etapa_id+
                    "&idMp="+idMp+"&mes="+mes+"&anio="+anio+"&estatResolucion="+estatResolucion+"&idUnidad="+idUnidad,
                success: function (respuesta) {
                    var json = respuesta;
                    var obj = eval("(" + json + ")");

                    if (obj.first == "NO") { swal("", "El NUC no se ha registrado favor de intentarlo nuevamente.", "Warning"); } else {

                        if (obj.first == "SI") {
                            // Get the id
                            var id = datos_columna[0].id_registro;
                            var rowId = '#' + id;
                            // Get the current row using the ID
                            var row = table.row('#' + id);

                            var checkSave = '<span class="glyphicon glyphicon-ok spanOK"></span>';
                            var html = checkSave;
                            table.cell( rowId, 1 ).data( html );
                            table.cell( rowId, 5 ).data( 'CAPTURADO' );
                            swal("", "Se Registro Correctamente.", "success");
                            //updateTableNucsLiti(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad);
                        }
                    }

                    console.log(obj.carpeta_id);
                }
            });


        }else{
            swal("", "Faltan campos por registrar, verifique.", "warning");
        }

    })

    $(tbody).on("click","button.guardar_data_imputado", function(){

        var ID = $(this).closest('tr').find('td').eq(0).text();
        console.log(ID);

        var idMp = $("#idMp").val();
        var mes = $("#mes").val();
        var anio = $("#anio").val();
        var estatResolucion = $("#estatResolucion").val();
        var idUnidad = $("#idUnidad").val();

        var rowData = table.rows('#' + ID).data().toArray();
        var rowNodes = table.rows('#' + ID).nodes().toArray();

        var acc = 'save_data_imp';

        var datos_columna = [];
        for (i = 0; i < rowData.length; i++) {
            let input_imputado_nombre = $("#nombre_row_add_"+ rowData[i].id).val();
            let input_imputado_ap_paterno = $("#paterno_row_add_"+ rowData[i].id).val();
            let input_imputado_ap_materno = $("#materno_row_add_"+ rowData[i].id).val();
            let input_imputado_edad = $("#edad_row_add_"+ rowData[i].id).val();
            let input_imputado_sexo = $("input[name=id_sexo_"+ rowData[i].id + "]:checked").val();
            let input_imputado_curp = $("#curp_row_add_"+ rowData[i].id).val();
            let selected_etapa_nombre = $(rowNodes[i]).find("select.etapa option:selected").text();
            let selected_etapa_id = $(rowNodes[i]).find("select.etapa option:selected").val();

            let tempObj = {
                id_registro: rowData[i].id,
                nuc: rowData[i].NUC,
                imputado_nombre: input_imputado_nombre,
                imputado_ap_paterno : input_imputado_ap_paterno,
                imputado_ap_materno : input_imputado_ap_materno,
                imputado_edad : input_imputado_edad,
                imputado_sexo : input_imputado_sexo,
                imputado_curp : input_imputado_curp,
                etapa: selected_etapa_nombre,
                etapa_id: selected_etapa_id,
            }
            datos_columna.push(tempObj);
        }

        var checkCampos = valida_campos_data_imputado(datos_columna[0].imputado_nombre, datos_columna[0].imputado_ap_paterno, datos_columna[0].imputado_ap_materno, datos_columna[0].imputado_edad, datos_columna[0].imputado_sexo, datos_columna[0].etapa_id );
        console.log('VER ARRAY: ' + datos_columna[0].imputado_nombre);
        if(checkCampos){

            /*ENVIAMOS INFORMACION PARA INSERTAR*/
            $.ajax({
                type: "POST",
                dataType: 'html',
                url: "format/litigacion/insert_tramite.php",
                data: "acc="+acc+"&nuc="+datos_columna[0].nuc+"&imputado_nombre="+datos_columna[0].imputado_nombre+"&imputado_ap_paterno="+datos_columna[0].imputado_ap_paterno+
                    "&imputado_ap_materno="+datos_columna[0].imputado_ap_materno+"&imputado_edad="+datos_columna[0].imputado_edad+"&imputado_sexo="+datos_columna[0].imputado_sexo+"&imputado_curp="+datos_columna[0].imputado_curp+
                    "&etapa_id="+datos_columna[0].etapa_id+"&idMp="+idMp+"&mes="+mes+"&anio="+anio+"&estatResolucion="+estatResolucion+"&idUnidad="+idUnidad,
                success: function (respuesta) {
                    var json = respuesta;
                    var obj = eval("(" + json + ")");

                    if (obj.first == "NO") { swal("", "El NUC no se ha registrado favor de intentarlo nuevamente.", "Warning"); } else {

                        if (obj.first == "SI") {
                            // Get the id
                            var id = datos_columna[0].id_registro;
                            var rowId = '#' + id;
                            // Get the current row using the ID
                            var row = table.row('#' + id);
                            var checkSave = '<span class="glyphicon glyphicon-ok spanOK"></span>';
                            var html = checkSave;
                            table.cell( rowId, 1 ).data( html );
                            table.cell( rowId, 5 ).data( 'CAPTURADO' );
                            swal("", "Se Registro Correctamente.", "success");
                            //updateTableNucsLiti(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad);
                        }
                    }

                }
            });

        }else{
            swal("", "Faltan campos por registrar, verifique.", "warning");
        }
        console.log(datos_columna[0].id_registro + ' Se ha seleccionado el nuc: ' + datos_columna[0].nuc + ' con el imputado: ' + datos_columna[0].imputado_nombre + ' ' + datos_columna[0].imputado_ap_paterno + ' ' + datos_columna[0].imputado_ap_materno + ' Edad: ' + datos_columna[0].imputado_edad + ' Sexo: ' + datos_columna[0].imputado_sexo + ' CURP: ' + datos_columna[0].imputado_curp + ' en la etapa: ' +  datos_columna[0].etapa + ' con id de etapa ' +  datos_columna[0].etapa_id );
    })
}

function valida_campos_no_data_imputado(){
    nombre = $("#nombre").val();
    ap_paterno = $("#ap_paterno").val();
    ap_materno = $("#ap_materno").val();
    edad = $("#edad").val();
    id_sexo = $('input[name="id_sexo"]:checked').val();
    curp = $("#curp").val();
    console.log('este es el sexo y se pasa validacion ' + id_sexo);
    if(	nombre !== "" && ap_paterno !== "" && ap_materno !== "" && edad !== "" && id_sexo !=undefined){
        return true;
    }else{
        return false;
    }
}

function valida_campos_data_imputado(nombre, ap_paterno, ap_materno, edad, sexo, etapa_id){
    if(	nombre !== "" && ap_paterno !== "" && ap_materno !== "" && edad !== "" && sexo !=undefined && etapa_id != 0){
        return true;
    }else{
        return false;
    }
}

function valida_columna_no_data_imputado(nuc, imputado_idLitigacion, etapa_id){
    if(	nuc !== "" && imputado_idLitigacion != 0 && etapa_id != 0){
        return true;
    }else{
        return false;
    }
}


function updateTableNucsLiti2(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad) {
    acc = "showtable";
    cont = document.getElementById("contTableNucslitg");
    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/accionesNucsLit.php");

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            cont.innerHTML = ajax.responseText;
            //getExpedienteLit("expedCont", nuc);
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes + "&anio=" + anio + "&nuc=" + nuc + "&deten=" + deten + "&idUnidad=" + idUnidad);

}


//funcion para actualizar tabla del estatus tramite 181
function updateTableNucsLiti_tramite(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad) {
    console.log("idMp: " + idMp + " anio: " + anio + " mes: " + mes + " estatResolucion: " + estatResolucion + " nuc: " + nuc + " deten: " + deten + " idUnidad: " + idUnidad  );
    acc = "showtableTramite";
    cont = document.getElementById("contTableNucslitg_tramite");
    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/accionesNucsLit.php");
    $.ajax({
        type: 'POST',
        url: 'format/litigacion/accionesNucsLit.php',
        data: {
            acc: "showtableTramite",
            idMp: idMp,
            estatus: estatResolucion,
            mes: mes,
            anio: anio,
            idUnidad: idUnidad
        },
        dataType: 'json',
        success: function(response) {
            try {
                // Destruir DataTable si existe
                if ($.fn.DataTable.isDataTable('#gridTramite')) {
                    $('#gridTramite').DataTable().destroy();
                }

                // Actualizar el contenido de la tabla
                $('#contentConsulta').html(response.html);

                // Inicializar DataTable inmediatamente ya que el modal está visible
                dataTable_iniciar_tramite();
            } catch (error) {
                console.error('Error al procesar datos:', error);
                swal('Error', 'Error al procesar los datos de la tabla', 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al actualizar la tabla:', error);
            swal('Error', 'Ocurrió un error al actualizar los datos', 'error');
        }
    });

}

function sendDataModalTramite(inputCant, estatus, idMp, mes, anio, idUnidad) {


    var cant = document.getElementById(inputCant).value;
    cont = document.getElementById('contmodal_tramite');
    $('#nuc').focus();
    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/views/modal_tramite.php");
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            cont.innerHTML = ajax.responseText;


            $('#modal_tramite').modal('show');
            $('#modalFormatoLitig').modal('hide');

            // Cuando el modal ya es visible, entonces inicializa DataTables
            $('#modal_tramite').on('shown.bs.modal', function () {

                //Carga evento de los checkBox para migrar carpetas
                document.getElementById("selectAllCarpetas").addEventListener("change", function () {
                    const checkboxes = document.querySelectorAll(".checkCarpeta");
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });

                dataTable_iniciar_tramite();
            });
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&cant=" + cant + "&idMp=" + idMp + "&mes=" + mes + "&anio=" + anio + "&idUnidad=" + idUnidad + "&estatus=" + estatus);

}

function sendDataModalImputadosNUC_tramite(nuc, idMp, mes, anio, estatResolucion, idUnidad) {
    // Primero verificar si el NUC ya está registrado
    $.ajax({
        type: "POST",
        url: "format/litigacion/views/verificarNucRegistrado.php",
        data: {
            nuc: nuc,
            idMp: idMp
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                if (response.existeRegistro) {
                    // Si existe, mostrar alerta con la información
                    const datos = response.datos;
                    swal({
                        title: "NUC ya registrado",
                        html: true,
                        text: `<hr>
                        El NUC <strong>${datos.nuc}</strong> ya se encuentra en trámite con la siguiente información:<br><br>
                        <strong>Estatus:</strong> ${datos.estatus}<br>
                        <strong>MP:</strong> ${datos.nombreMp}<br>
                        <strong>Unidad:</strong> ${datos.unidad}<br>
                        <strong>Fiscalía:</strong> ${datos.fiscalia}<br>
                        <strong>Periodo:</strong> ${datos.mes} ${datos.anio}<br>
                        ${datos.expediente ? `<strong>Expediente:</strong> ${datos.expediente}` : ''}`,
                        type: "warning",
                        button: "Aceptar",
                    });
                } else {
                    // Si no existe, continuar con el proceso normal
                    cont = document.getElementById('contmodalImputadosLitig_tramite');

                    ajax = objetoAjax();
                    ajax.open("POST", "format/litigacion/views/modal_tramite_imputados.php");
                    ajax.onreadystatechange = function () {
                        if (ajax.readyState == 4 && ajax.status == 200) {
                            validacionesTramite();
                            cont.innerHTML = ajax.responseText;

                            $('#modal_tramite').modal('hide');
                            $('#modalFormatImputados_tramite').modal('show');

                            $('#modalFormatImputados_tramite').on('shown.bs.modal', function () {
                                dataTable_iniciar_tramite_imputados();
                            });
                        }
                    }
                    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    ajax.send("&nuc=" + nuc + "&idMp=" + idMp + "&mes=" + mes + "&anio=" + anio +
                        "&estatResolucion=" + estatResolucion + "&idUnidad=" + idUnidad);
                }
            } else {
                swal("Error", "Ocurrió un error al verificar el NUC", "error");
            }
        },
        error: function(xhr, status, error) {
            swal("Error", "Ocurrió un error al verificar el NUC: " + error, "error");
        }
    });
}

function salirIngresoImputados_tramite(idMp, estatResolucion, mes, anio, idUnidad) {

    $('#modal_tramite').modal('show');
    $('#modalFormatImputados_tramite').modal('hide');


    // Actualizar la tabla después de cerrar el modal
    actualizarTablaTramites(idMp, estatResolucion, mes, anio, idUnidad);

}

function saveNucTramite(nuc, idMp, mes, anio, estatResolucion, idUnidad) {

    nomImpu_tramite = document.getElementById('nomImpu_tramite').value; nomImpu_tramite.trim();
    paternImpu_tramite = document.getElementById('paternImpu_tramite').value; paternImpu_tramite.trim();
    maternImpu_tramite = document.getElementById('maternImpu_tramite').value; maternImpu_tramite.trim();
    nuc_tramite = document.getElementById('nuc_tramite').value;
    causaPenalImpu_tramite = document.getElementById('causaPenalImpu_tramite').value; causaPenalImpu_tramite.trim();
    cuadernoImpu_tramite = document.getElementById('cuadernoImpu_tramite').value; cuadernoImpu_tramite.trim();
    requerimientoImpu_tramite = document.getElementById('requerimientoImpu_tramite').value;
    sedeJudicialImpu_tramite = document.getElementById('sedeJudicialImpu_tramite').value;


    if (nomImpu_tramite == "" ||
        paternImpu_tramite == "" ||
        maternImpu_tramite == "" ||
        (causaPenalImpu_tramite === "" && cuadernoImpu_tramite === "") ||
        (causaPenalImpu_tramite !== "" && !validarFormatoCausaPenal(causaPenalImpu_tramite)) ||
        (cuadernoImpu_tramite !== "" && !validarFormatoCuadernotramite(cuadernoImpu_tramite))
    ) {
        swal("", "Faltan datos por capturar.", "warning");
    } else {
        saveCarpetaTramite(nuc, idMp , mes , anio , estatResolucion , idUnidad , nomImpu_tramite , paternImpu_tramite , maternImpu_tramite , causaPenalImpu_tramite , cuadernoImpu_tramite , requerimientoImpu_tramite , sedeJudicialImpu_tramite);
    }
}

//Validaciones de alerta para el formulario de tramite
function validacionesTramite(){

    $(document).ready(function() {
        // Aseguramos que el modal esté cargado
        $('#modalFormatImputados_tramite').on('shown.bs.modal', function () {

            // Agregamos el evento al input
            $('#causaPenalImpu_tramite').on('input', function() {
                // Elimina cualquier carácter que no sea número o /
                let valor = this.value.replace(/[^\d\/]/g, '');

                // Asegura que solo haya una /
                let partes = valor.split('/');
                if (partes.length > 2) {
                    valor = partes[0] + '/' + partes.slice(1).join('');
                }

                // Actualiza el valor del input
                this.value = valor;

                // Muestra u oculta la advertencia
                let labelAdvertencia = $('#advertencia_causa');
                if (this.value.length > 0 && !this.value.includes('/')) {
                    labelAdvertencia.show();
                } else {
                    labelAdvertencia.hide();
                }
            });

            // Agregamos el evento al input
            $('#cuadernoImpu_tramite').on('input', function() {
                // Elimina cualquier carácter que no sea número o /
                let valor = this.value.replace(/[^\d\/]/g, '');

                // Asegura que solo haya una /
                let partes = valor.split('/');
                if (partes.length > 2) {
                    valor = partes[0] + '/' + partes.slice(1).join('');
                }

                // Actualiza el valor del input
                this.value = valor;

                // Muestra u oculta la advertencia
                let labelAdvertencia = $('#advertencia_cuaderno');
                if (this.value.length > 0 && !this.value.includes('/')) {
                    labelAdvertencia.show();
                } else {
                    labelAdvertencia.hide();
                }
            });

            // Agregamos el evento al input de nombre
            $('#nomImpu_tramite').on('blur', function() {
                // Obtener el valor del input y eliminar espacios en blanco al inicio y final
                let valor = $(this).val().trim();
                // Obtener la longitud
                let longitud = valor.length;

                let labelAdvertencia = $('#advertencia_nomImpu_tramite');

                if (longitud === 0) {
                    labelAdvertencia.show();
                } else if (longitud > 3) {
                    labelAdvertencia.hide();
                }


            });

            // Agregamos el evento al input del apellido paterno
            $('#paternImpu_tramite').on('blur', function() {
                // Obtener el valor del input y eliminar espacios en blanco al inicio y final
                let valor = $(this).val().trim();
                // Obtener la longitud
                let longitud = valor.length;

                let labelAdvertencia = $('#advertencia_paternImpu_tramite');

                if (longitud === 0) {
                    labelAdvertencia.show();
                } else if (longitud > 3) {
                    labelAdvertencia.hide();
                }
            });

            // Agregamos el evento al input del apellido materno
            $('#maternImpu_tramite').on('blur', function() {
                // Obtener el valor del input y eliminar espacios en blanco al inicio y final
                let valor = $(this).val().trim();
                // Obtener la longitud
                let longitud = valor.length;

                let labelAdvertencia = $('#advertencia_maternImpu_tramite');

                if (longitud === 0) {
                    labelAdvertencia.show();
                } else if (longitud > 3) {
                    labelAdvertencia.hide();
                }
            });

            // Agregamos el evento al input de nombre
            $('#nomImpu_tramite_add').on('blur', function() {
                // Obtener el valor del input y eliminar espacios en blanco al inicio y final
                let valor = $(this).val().trim();
                // Obtener la longitud
                let longitud = valor.length;

                let labelAdvertencia = $('#advertencia_nomImpu_tramite_add');

                if (longitud === 0) {
                    labelAdvertencia.show();
                } else if (longitud > 3) {
                    labelAdvertencia.hide();
                }


            });

            // Agregamos el evento al input del apellido paterno
            $('#paternImpu_tramite_add').on('blur', function() {
                // Obtener el valor del input y eliminar espacios en blanco al inicio y final
                let valor = $(this).val().trim();
                // Obtener la longitud
                let longitud = valor.length;

                let labelAdvertencia = $('#advertencia_paternImpu_tramite_add');

                if (longitud === 0) {
                    labelAdvertencia.show();
                } else if (longitud > 3) {
                    labelAdvertencia.hide();
                }
            });

            // Agregamos el evento al input del apellido materno
            $('#maternImpu_tramite_add').on('blur', function() {
                // Obtener el valor del input y eliminar espacios en blanco al inicio y final
                let valor = $(this).val().trim();
                // Obtener la longitud
                let longitud = valor.length;

                let labelAdvertencia = $('#advertencia_maternImpu_tramite_add');

                if (longitud === 0) {
                    labelAdvertencia.show();
                } else if (longitud > 3) {
                    labelAdvertencia.hide();
                }
            });


        });
    });
}

//Valida que el formato de la causa penal sea correcto
function validarFormatoCausaPenal(causaPenal) {
    // Verifica que contenga al menos un '/' y números
    return causaPenal.includes('/') && /\d/.test(causaPenal);
}

//Valida que el formato del cuaderno sea correcto
function validarFormatoCuadernotramite(cuadernoImpu_tramite) {
    // Verifica que contenga al menos un '/' y números
    return cuadernoImpu_tramite.includes('/') && /\d/.test(cuadernoImpu_tramite);
}

function saveCarpetaTramite(nuc, idMp , mes , anio , estatResolucion , idUnidad , nomImpu_tramite , paternImpu_tramite , maternImpu_tramite , causaPenalImpu_tramite , cuadernoImpu_tramite , requerimientoImpu_tramite , sedeJudicialImpu_tramite) {

    ajax = objetoAjax();
    ajax.open("POST", "format/litigacion/views/saveDataTramite.php");

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var cadCodificadaJSON = ajax.responseText;
            var objDatos = eval("(" + cadCodificadaJSON + ")");

            if (objDatos.first == "NO") {
                swal("", "El NUC no se ha registrado favor de intentarlo nuevamente.", "Warning");
            } else {
                if (objDatos.first == "SI") {
                    swal("", "Datos de la carpeta en trámite agregados." , "success");
                    // Se lanzara modal de tramite
                    $('#modalFormatImputados_tramite').modal('hide');
                    $('#modal_tramite').modal('show');
                    dataTable_iniciar_tramite();
                    updateTableNucsLiti_tramite(idMp, anio, mes, estatResolucion, nuc, 0, idUnidad);
                }
            }
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&nuc=" + nuc + "&idMp=" +  idMp + "&mes=" + mes + "&anio=" + anio + "&estatResolucion=" + estatResolucion + "&idUnidad=" + idUnidad + "&nomImpu_tramite=" + nomImpu_tramite + "&paternImpu_tramite=" + paternImpu_tramite + "&maternImpu_tramite=" + maternImpu_tramite + "&causaPenalImpu_tramite=" + causaPenalImpu_tramite + "&cuadernoImpu_tramite=" + cuadernoImpu_tramite + "&requerimientoImpu_tramite=" + requerimientoImpu_tramite + "&sedeJudicialImpu_tramite=" + sedeJudicialImpu_tramite);
}

function dataTable_iniciar_tramite(){
    var table = $('#gridTramite').DataTable();
    table.destroy();

    table=$('#gridTramite').DataTable({
        retrieve: true,
        "language": {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        scrollY: 400,
        scrollX: true,
        select: true,
        dom: 'Blfrtip',

        columnDefs: [
            { targets: 0, width: "10px" },   // No
            { targets: 1, width: "50px" },   // No
            { targets: 2, width: "130px" },  // Número de caso
            { targets: 3, width: "150px" },  // Expediente
            { targets: 4, width: "110px" },  // Causa Penal
            { targets: 5, width: "110px" },  // Cuaderno antecedentes
            { targets: 6, width: "80px" },   // Requerimiento (SI/NO)
            { targets: 7, width: "80px" },   // Archivo sede judicial (SI/NO)
            { targets: 8, width: "250px" },  // Imputado(s)
            { targets: 9, width: "70px" },   // Acción 1
            { targets: 10, width: "70px" }    // Acción 2
        ],
        lengthMenu: [[10, 25, 50, -1],
            ['10', '25', '50', 'todo']
        ],
        buttons: [{
            extend: 'excel',
            title: '',
            messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
            exportOptions: {
                columns: [ 1, 2, 3 , 4, 5, 6, 7, 8]
            }
        },
            {
                extend: 'pdfHtml5',
                title: '',
                orientation: 'landscape',
                messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8]
                },
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABJ4AAAC2CAYAAACYo0eiAAAgAElEQVR4XuydBXhUR9uGn7O7cSNOEkJCcIJLcS9a3ArF3d3diru7Q3GKQ4s7xd0tQAKEJMR9M/81s5HdZJPdDeH/Snm3Vz/6sWfPmblnzsgzr0igDxEgAkSACBABIkAEiAARIAJEgAgQASJABIgAEfgGBKRvcE+6JREgAkSACBABIkAEiAARIAJEgAgQASJABIgAEQAJT9QJiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEg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',
                        width: 500,
                        height: 80
                    } );
                }
            }],

        "order": [], // "0" means First column and "desc" is order type;

    } );
}

function salirModal_tramite(idMp , idUnidad) {
    $.ajax({
        url: 'format/litigacion/views/obtener_total_tramite.php',
        type: 'POST',
        data: {
            idMp: idMp,
            idUnidad: idUnidad
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Actualiza el input con el total
                $('#tramite_litigacion').val(response.total);

                // Puedes mostrar un mensaje opcionalmente
                console.log(response.message);
            } else {
                // Muestra mensaje de error del backend
                console.warn(response.message);
                alert("⚠️ " + response.message);
            }

            // Mostrar y ocultar modales
            $('#modalFormatoLitig').modal('show');
            $('#modal_tramite').modal('hide');
        },
        error: function(xhr, status, error) {
            // Error de conexión o formato inválido
            console.error("AJAX error:", status, error);
            alert("❌ Error al consultar el total de trámites. Intenta de nuevo.");

            $('#modalFormatoLitig').modal('show');
            $('#modal_tramite').modal('hide');
        }
    });
}

function dataTable_iniciar_tramite_imputados(){
    var table = $('#gridTramiteImpu').DataTable();
    table.destroy();

    table=$('#gridTramiteImpu').DataTable({
        retrieve: true,
        "language": {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        scrollY: 400,
        scrollX: true,
        select: true,
        dom: 'Blfrtip',

        columnDefs: [
            { targets: 0, width: "50px" },   // No
            { targets: 1, width: "450px" },  // Número de caso
            { targets: 2, width: "70px" },  // Expediente
            { targets: 3, width: "70px" },  // Causa Penal
        ],
        lengthMenu: [[10, 25, 50, -1],
            ['10', '25', '50', 'todo']
        ],
        buttons: [{
            extend: 'excel',
            title: '',
            messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
            exportOptions: {
                columns: [ 0, 1 ]
            }
        },
            {
                extend: 'pdfHtml5',
                title: '',
                orientation: 'landscape',
                messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
                exportOptions: {
                    columns: [ 0, 1 ]
                },
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABJ4AAAC2CAYAAACYo0eiAAAgAElEQVR4XuydBXhUR9uGn7O7cSNOEkJCcIJLcS9a3ArF3d3diru7Q3GKQ4s7xd0tQAKEJMR9M/81s5HdZJPdDeH/Snm3Vz/6sWfPmblnzsgzr0igDxEgAkSACBABIkAEiAARIAJEgAgQASJABIgAEfgGBKRvcE+6JREgAkSACBABIkAEiAARIAJEgAgQASJABIgAEQAJT9QJiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEgAkSACBABIkAEiAAJT9QHiAARIAJEgAgQASJABIgAESACRIAIEAEiQAS+CQESnr4JVropESACRIAIEAEiQASIABEg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',
                        width: 500,
                        height: 80
                    } );
                }
            }],

        "order": [], // "0" means First column and "desc" is order type;

    } );
}

// Función para editar imputado
function editarTramiteImputado(idImputadoTramite) {
    console.log('ID recibido:', idImputadoTramite); // Para depuración

    // Hacer la petición AJAX para obtener los datos del imputado
    $.ajax({
        url: 'format/litigacion/views/obtenerImputadoTramite.php', // Crea este archivo PHP
        type: 'POST',
        data: {
            idImputadoTramite: idImputadoTramite
        },
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                // Llenar los campos con los datos del imputado
                $('#nomImpu_tramite').val(response.data.nombre);
                $('#paternImpu_tramite').val(response.data.paterno);
                $('#maternImpu_tramite').val(response.data.materno);
                $('#idImputadoTramite_edit').val(idImputadoTramite);

                cancelarAgregarImputado(); //Cerramos el div de agregar imputado si previamente se encuentra abierto

                // Mostrar el div de edición
                $('#updateImputado').slideDown();

                // Hacer scroll hacia el div de edición
                $('html, body').animate({
                    scrollTop: $("#updateImputado").offset().top - 20
                }, 500);
            } else {
                alert('Error al obtener los datos del imputado');
            }
        },
        error: function() {
            alert('Error en la conexión');
        }
    });
}

// Función para cancelar la edición
function cancelarEdicion() {
    // Limpiar los campos
    $('#nomImpu_tramite').val('');
    $('#paternImpu_tramite').val('');
    $('#maternImpu_tramite').val('');
    $('#idImputadoTramite_edit').val('');

    // Ocultar el div de edición
    $('#updateImputado').slideUp();
}

// Función para actualizar el imputado
function actualizarImputado() {
    // Validar campos requeridos
    if(!$('#nomImpu_tramite').val() || !$('#paternImpu_tramite').val() || !$('#maternImpu_tramite').val()) {
        swal("", "Todos los campos son requeridos", "warning");
        return;
    }

    // Hacer la petición AJAX para actualizar
    $.ajax({
        url: 'format/litigacion/views/actualizarImputadoTramite.php', // Crea este archivo PHP
        type: 'POST',
        data: {
            idImputadoTramite: $('#idImputadoTramite_edit').val(),
            nombre: $('#nomImpu_tramite').val(),
            paterno: $('#paternImpu_tramite').val(),
            materno: $('#maternImpu_tramite').val(),
            idCarpetaTramite: $('#idCarpetaTramite').val() // Asegúrate de tener este campo

        },
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                // Obtener la tabla actual y destruirla
                $('#gridTramiteImpu').DataTable().destroy();

                // Actualizar el tbody de la tabla
                $('#gridTramiteImpu tbody').html(response.html);

                // Reinicializar DataTable
                dataTable_iniciar_tramite_imputados();

                swal("", "Imputado actualizado correctamente." , "success");

                cancelarEdicion();

            } else {
                alert('Error al actualizar el imputado: ' + response.message);
            }
        },
        error: function() {
            alert('Error en la conexión');
        }
    });
}

function updateNucTramite(idCarpetaTramite) {

    causaPenalImpu_tramite = document.getElementById('causaPenalImpu_tramite').value; causaPenalImpu_tramite.trim();
    cuadernoImpu_tramite = document.getElementById('cuadernoImpu_tramite').value; cuadernoImpu_tramite.trim();
    requerimientoImpu_tramite = document.getElementById('requerimientoImpu_tramite').value;
    sedeJudicialImpu_tramite = document.getElementById('sedeJudicialImpu_tramite').value;


    if (
        (causaPenalImpu_tramite === "" && cuadernoImpu_tramite === "") ||
        (causaPenalImpu_tramite !== "" && !validarFormatoCausaPenal(causaPenalImpu_tramite)) ||
        (cuadernoImpu_tramite !== "" && !validarFormatoCuadernotramite(cuadernoImpu_tramite))
    ) {
        swal("", "Faltan datos por capturar.", "warning");
    } else {
        updateTramite(idCarpetaTramite, causaPenalImpu_tramite , cuadernoImpu_tramite , requerimientoImpu_tramite , sedeJudicialImpu_tramite);
    }
}

function updateTramite(idCarpetaTramite, causaPenalImpu_tramite , cuadernoImpu_tramite , requerimientoImpu_tramite , sedeJudicialImpu_tramite) {
    $.ajax({
        url: 'format/litigacion/views/updateTramite.php', // Crea este archivo PHP
        type: 'POST',
        data: {
            idCarpetaTramite: idCarpetaTramite,
            causaPenalImpu_tramite: causaPenalImpu_tramite,
            cuadernoImpu_tramite: cuadernoImpu_tramite,
            requerimientoImpu_tramite: requerimientoImpu_tramite,
            sedeJudicialImpu_tramite: sedeJudicialImpu_tramite
        },
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                swal("", response.message , "success");
            } else {
                alert('Error al actualizar el trámite: ' + response.message);
            }
        },
        error: function() {
            alert('Error en la conexión');
        }
    });
}

function eliminarTramiteImputado(idImputadoTramite , idCarpetaTramite){
    swal({
        title: "¿Estás seguro?",
        text: "¿Deseas eliminar este imputado?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }, function(isConfirmed) {
        if (isConfirmed) {
            $.ajax({
                url: 'format/litigacion/views/deleteImputado.php',
                type: 'POST',
                data: {
                    idImputadoTramite: idImputadoTramite,
                    idCarpetaTramite: idCarpetaTramite
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {

                        swal("¡Eliminado!", response.message, "success");

                        cancelarEdicion();

                        // Obtener la tabla actual y destruirla
                        $('#gridTramiteImpu').DataTable().destroy();

                        // Actualizar el tbody de la tabla
                        $('#gridTramiteImpu tbody').html(response.html);

                        // Reinicializar DataTable
                        dataTable_iniciar_tramite_imputados();


                    } else {
                        swal("Error", response.message, "error");
                    }
                },
                error: function(xhr, status, error) {
                    swal("Error", "Error en la conexión: " + error, "error");
                }
            });
        }
    });

}

function mostrarFormularioImputado() {

    cancelarEdicion(); //Cerramos el div de edición si previamente se encuentra abierto
    // Mostrar el div de edición con animación
    $('#agregarImputado').slideDown();

    // Hacer scroll hacia el div de edición
    $('html, body').animate({
        scrollTop: $("#agregarImputado").offset().top - 20
    }, 500);

}

function cancelarAgregarImputado() {
    // Limpiar los campos
    $('#nomImpu_tramite_add').val('');
    $('#paternImpu_tramite_add').val('');
    $('#maternImpu_tramite_add').val('');

    // Ocultar el div de edición
    $('#agregarImputado').slideUp();
}

function agregarImputadoTramite() {
    // Validar campos requeridos
    if(!$('#nomImpu_tramite_add').val() || !$('#paternImpu_tramite_add').val() || !$('#maternImpu_tramite_add').val()) {
        swal("", "Todos los campos son requeridos", "warning");
        return;
    }

    // Hacer la petición AJAX para agregar
    $.ajax({
        url: 'format/litigacion/views/agregarImputadoTramite.php', // Crea este archivo PHP
        type: 'POST',
        data: {
            nombre: $('#nomImpu_tramite_add').val(),
            paterno: $('#paternImpu_tramite_add').val(),
            materno: $('#maternImpu_tramite_add').val(),
            idCarpetaTramite: $('#idCarpetaTramite').val() // Asegúrate de tener este campo

        },
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                // Obtener la tabla actual y destruirla
                $('#gridTramiteImpu').DataTable().destroy();

                // Actualizar el tbody de la tabla
                $('#gridTramiteImpu tbody').html(response.html);

                // Reinicializar DataTable
                dataTable_iniciar_tramite_imputados();

                swal("", "Imputado agregado correctamente." , "success");

                cancelarAgregarImputado();

            } else {
                swal("", "Error al agregar el imputado: ", "warning");
            }
        },
        error: function() {
            swal("", "Error en la conexión: ", "warning");
        }
    });
}

function actualizarTablaTramites(idMp, estatResolucion, mes, anio, idUnidad) {
    // Mostrar indicador de carga
    $('#contentConsulta').html('<tr><td colspan="10" class="text-center"><i class="fa fa-spinner fa-spin"></i> Actualizando datos...</td></tr>');

    $.ajax({
        type: 'POST',
        url: 'format/litigacion/views/getDataTable.php',
        data: {
            idMp: idMp,
            estatus: estatResolucion,
            mes: mes,
            anio: anio,
            idUnidad: idUnidad
        },
        dataType: 'json',
        success: function(response) {
            try {
                // Destruir DataTable si existe
                if ($.fn.DataTable.isDataTable('#gridTramite')) {
                    $('#gridTramite').DataTable().destroy();
                }

                // Actualizar el contenido de la tabla
                $('#contentConsulta').html(response.html);

                // Inicializar DataTable inmediatamente ya que el modal está visible
                dataTable_iniciar_tramite();
            } catch (error) {
                //console.error('Error al procesar datos:', error);
                swal('Error', 'Error al procesar los datos de la tabla', 'error');
            }
        },
        error: function(xhr, status, error) {
            //console.error('Error al actualizar la tabla:', error);
            swal('Error', 'Ocurrió un error al actualizar los datos', 'error');
        }
    });

}

function deleteTramiteCarpeta(idEstatusNucs, idMp, anio, mes, estatus, nuc, idUnidad) {

    swal({
        title: "¿Estás seguro?",
        text: "Se eliminará la carpeta con NUC: " + nuc + " y todos sus registros asociados",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }, function(isConfirmed) {
        if (isConfirmed) {
            $.ajax({
                url: 'format/litigacion/views/deleteTramiteCarpeta.php',
                type: 'POST',
                data: {
                    idEstatusNucs: idEstatusNucs
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {

                        swal("¡Eliminado!", "La carpeta ha sido eliminada correctamente.", "success")

                        actualizarTablaTramites(idMp, estatus, mes, anio, idUnidad);

                    } else {
                        swal("Error", response.message || "No se pudo eliminar la carpeta", "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    swal("Error", "Ocurrió un error al eliminar la carpeta", "error");
                }
            });
        }
    });

}

function migrarCarpetasSeleccionadas(idMp, estatus, mes, anio, idUnidad) {
    const nuevoMp = document.getElementById("nuevoMp").value;

    if (!nuevoMp) {
        swal("Advertencia", "Por favor selecciona un nuevo Ministerio Público destino.", "warning");
        return;
    }

    const seleccionadas = [];
    document.querySelectorAll(".checkCarpeta:checked").forEach(cb => {
        seleccionadas.push(cb.value);
    });

    if (seleccionadas.length === 0) {
        swal("Sin selección", "Selecciona al menos una carpeta para migrar.", "info");
        return;
    }

    swal({
        title: "¿Estás seguro?",
        text: `Se migrarán ${seleccionadas.length} carpeta(s) al nuevo MP.`,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, migrar",
        cancelButtonText: "Cancelar"
    }, function(isConfirmed) {
        if (isConfirmed) {
            $.ajax({
                url: 'format/litigacion/views/migrarTramiteCarpeta.php',
                method: 'POST',
                data: {
                    carpetas: seleccionadas,
                    nuevoMp: nuevoMp
                },
                dataType: 'json',
                success: function(response) {
                    swal.close(); // Cierra el swal de confirmación anterior
                    setTimeout(function(){
                        if(response.success){
                            swal("¡Trámite actualizado!" , response.message , "success");
                            actualizarTablaTramites(idMp, estatus, mes, anio, idUnidad);
                        }else{
                            swal("Error", response.message , "error");
                        }
                    },100);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    swal("Error", "Hubo un problema al migrar las carpetas.", "error");
                }
            });
        }
    });
}
