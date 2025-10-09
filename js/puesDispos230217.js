var newBrwoser;
var fechaevento;
var newBrwoserFisca;
var newBrwoserMun;
var newBrwoserColo;
var calleInputvehi;

function saveVehicle(idEnlace, typearch, b, tipoActualizacion , idVeicle){

	 var tipoActualizacion = tipoActualizacion;
		var idVeicle = idVeicle;
		

		var selClasific= document.getElementById("selClasific").value; 
		var selFormAsegur= document.getElementById("selFormAsegur").value; 
		var selAdispo= document.getElementById("selAdispo").value; 
		var selDelito= document.getElementById("selDelito").value; 
		var selTipoDelito= document.getElementById("selTipoDelito").value; 

		var newMarca= document.getElementById("newMarca").value;
		var newLinea= document.getElementById("newLinea").value;
		var newTypeMarca= document.getElementById("newTypeMarca").value;

		if(selClasific >= 1 && selFormAsegur >= 1 && selAdispo >= 1 && selDelito >= 1 && selTipoDelito >= 1 && newMarca >= 1 
			&& newLinea >= 1 && newTypeMarca >= 1){			
			
			var newMarca_id= document.getElementById("newMarca").value;
			var newLineas_id= document.getElementById("newLinea").value;
			var newTipo_id= document.getElementById("newTypeMarca").value;

			var nucVehiculo= document.getElementById("nucVehiculo").value;
			var requeridoPorVehi= document.getElementById("requeridoPorVehi").value;
			var colorVehi= document.getElementById("colorVehi").value;
			var modeloVehi= document.getElementById("modeloVehi").value;
			var placaVehi= document.getElementById("placaVehi").value;
			var serieVehi= document.getElementById("serieVehi").value;
			var serieAlVehi= document.getElementById("serieAlVehi").value;
			var motorVehi= document.getElementById("motorVehi").value;
			var motorAlVehi= document.getElementById("motorAlVehi").value;

			var requeOtroCopro= document.getElementById("requeOtroCopro").value;
			var oficioVehi= document.getElementById("oficioVehi").value;
			var observaVehi= document.getElementById("observaVehi").value;


			//// DATA DE LA PUESTA A DISPOSICION /////
			var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
			var tipoMOd= document.getElementById("tipoMOd").value;

			var idMandoPuesta= document.getElementById("idMandoPuesta").value;
			var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
			var fechaevento= document.getElementById("fechaevento").value;
		
			var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
			var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
			var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
			var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
			var calleInputPuesta= document.getElementById("calleInputPuesta").value;
			var numberCallePuesta= document.getElementById("numberCallePuesta").value;
			if(numberCallePuesta == ""){ numberCallePuesta = 0; }
			var cont= document.getElementById("respuestsGUdradoVEhiculo");
			
				var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;

			var puestaDataVehi = Array();
			    puestaDataVehi[0] = idMandoPuesta;   puestaDataVehi[1] = "'"+nucPuestaDisposi+"'"; puestaDataVehi[2] = "'"+fechaevento+"'"; puestaDataVehi[3] =  newBrwosers_id_fisca;
			    puestaDataVehi[4] = newBrwosers_id_mun; puestaDataVehi[5] = newBrwosers_id_colo; puestaDataVehi[6] = codepostalidPeusta; puestaDataVehi[7] = "'"+calleInputPuesta+"'";
			    puestaDataVehi[8] = numberCallePuesta; puestaDataVehi[9] = tipoMOd; puestaDataVehi[10] = uno; puestaDataVehi[11] = dos; puestaDataVehi[12] = tres;
			    puestaDataVehi[13] = cuatro; puestaDataVehi[14] = cinco; puestaDataVehi[15] = narac;

			     var jObject={};  for(i in puestaDataVehi){  jObject[i] = puestaDataVehi[i];   }
			     jObject= JSON.stringify(jObject);

			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/guardarVehicle.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {				

						//cont.innerHTML = ajax.responseText;
						var json = ajax.responseText;
						var obj = eval("(" + json + ")");
						if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
							 if (obj.first == "SI") {                    
								
							 	var obj = eval("(" + json + ")");
							 	swal("", "Vehículo Registrado Exitosamente.", "success");
								//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
								salirVehicle();
								showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);
							 }
						}

					}				
				}

			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idPuestaDisposicion="+idPuestaDisposicion+"&selClasific="+selClasific+"&selFormAsegur="+selFormAsegur+"&nucVehiculo="+nucVehiculo+"&selAdispo="+selAdispo+"&requeridoPorVehi="+requeridoPorVehi+"&selDelito="+selDelito+"&selTipoDelito="+selTipoDelito+"&newMarca_id="+newMarca_id
				+"&newLineas_id="+newLineas_id+"&newTipo_id="+newTipo_id+"&colorVehi="+colorVehi+"&modeloVehi="+modeloVehi+"&placaVehi="+placaVehi+"&serieVehi="+serieVehi+"&serieAlVehi="+serieAlVehi+"&motorVehi="+motorVehi+"&motorAlVehi="+motorAlVehi+"&requeOtroCopro="+requeOtroCopro+"&oficioVehi="+oficioVehi+"&observaVehi="+observaVehi
				+"&jObject="+jObject+"&idEnlace="+idEnlace+"&tipoActualizacion="+tipoActualizacion+"&idVeicle="+idVeicle);


		}else{

				swal("", "Faltan datos por registrar.", "warning");	
		}

}


function getDataLinea(){


		//var newMarca= document.getElementById("newMarca").value; 		
		var newBrwosers_id= document.getElementById("newMarca").value;	

		cont = document.getElementById('newLinea');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/dataLinea.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function salirVehicle(){
		$('#puestdisposVehic').modal('hide');
		$('#puestdispos').modal('show'); 

		var link = document.getElementById("imgVeicle");
		link.removeAttribute("href");
	    link.removeAttribute("data-toggle");	
}

function showmodalPueDispo(tipoModal, idEnlace, idPuestaDisposicion, typeArch, typeCheck){
anio = document.getElementById("anioCmasc").value;
	var messelected= document.getElementById("mesPuestaSelected").value;
		var diaselected= document.getElementById("diaSeleted").value; 	

    cont = document.getElementById('contMOdalPuedispos');
	ajax=objetoAjax();
	ajax.open("POST", "format/puestaDisposicion/modalPuestaDisposicion.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;	
			$('.dataAutocomplet').select2({
																																	    width: '100%',
																																	    placeholder: "Seleccione",
                                     allowClear: false
																																	});
			$('#busquepuestdispos').modal('hide');	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&typeArch="+typeArch+"&anio="+anio+"&messelected="+messelected+"&diaselected="+diaselected+"&typeCheck="+typeCheck);
}

function saveDataPuesta(typearch, anio, idEnlace, camMes, messelected, diaselected, typeche){

 if(typeche == 1){

 					idPuesta = document.getElementById("idPuestaDisposicion").value;
			if(idPuesta != ""){


				var validar = validateDataPuesta();	

					if(validar){

											/////////// DATOS DE LOS DATALIST /////////////
											//var newBrwosers_id = $("#newBrwoser").val();
											var obj = document.getElementById("newBrwosers_id").value;

											//var newBrwosers_id_fisca = $("#newBrwoserFisca").val();
											var obj2 = document.getElementById("newBrwoserFisca").value;

											//var newBrwosers_id_mun = $("#newBrwoserMun").val();
											var obj3 = document.getElementById("newBrwoserMun").value;

											//var newBrwosers_id_colo = $("#newBrwoserColo").val(); document.getElementById("#newBrwoserColo").value;
											var obj4 = document.getElementById("newBrwoserColo").value;
											/////////// DATOS DE LOS DATALIST /////////////

											/////// CONDICION DE QUE ESTE BIEN CAPTURADOS LOS DATALIST ////////
												if(obj != null && obj.length > 0){
													if(obj2  != null && obj2.length > 0){	
														if(obj3 != null && obj3.length > 0){
															if(obj4 != null && obj4.length > 0){
																				var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
																				var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
																				var numberCallePuesta= document.getElementById("numberCallePuesta").value;
																				if(numberCallePuesta == ""){ numberCallePuesta = 0; }
																				var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuat = document.getElementById("acepto4").checked;
																			 var cinc = document.getElementById("acepto5").checked;
																			 var naracion= document.getElementById("textNarracion").value;

																			 var puestaData = Array();
															    puestaData[0] = obj;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  obj2;
															    puestaData[4] = obj3; puestaData[5] = obj4; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
															    puestaData[8] = numberCallePuesta; 

															    puestaData[10] = uno; puestaData[11] = dos; puestaData[12] = tres; puestaData[13] = cuat; puestaData[14] = cinc; puestaData[15] = naracion;

															     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
															     jObject= JSON.stringify(jObject);

																					ajax=objetoAjax();
																					ajax.open("POST", "format/puestaDisposicion/updateDataPuesta.php");

																					ajax.onreadystatechange = function(){
																						if (ajax.readyState == 4 && ajax.status == 200) {

																										var json = ajax.responseText;
																														var obj = eval("(" + json + ")");
																														if (obj.first == "NO") { swal("", "No se actualizo verifique los datos.", "warning"); }else{
																															 if (obj.first == "SI") {                    
																																
																															 		$('#puestdispos').modal('hide');
																																		swal("", "Datos actualizados correctamente.", "success");
																																		loadDataPuestDayCurrent(anio, idEnlace, camMes, messelected, diaselected);
																															 }
																														}																							
																						}
																					}
																					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
																					ajax.send("&idPuesta="+idPuesta+"&jObject="+jObject);

																		}else{ swal("", "La Colonia ingresada es incorrecta.", "warning"); }

																		}else{ swal("", "El Municipio ingresado es incorrecto.", "warning"); }

																}else{ swal("", "La Fiscalía ingresada es incorrecta.", "warning"); }

												}else{
															swal("", "El Mando ingresado es incorrecto.", "warning");
												}				
												/////// CONDICION DE QUE ESTE BIEN CAPTURADOS LOS DATALIST ////////			

									}else{
											swal("", "Datos Incompletos.", "warning");
									}		

			}else{
					$('#puestdispos').modal('hide');
					loadDataPuestDayCurrent(anio, idEnlace, camMes, messelected, diaselected);
			}

	}else{
				if(typeche == 0){
								$('#puestdispos').modal('hide');
				}
	}

			
		}


function validateDataPuesta(){

		newBrwoser= document.getElementById("newBrwosers_id").value;
 		fechaevento= document.getElementById("fechaevento").value; 		
 		newBrwoserFisca= document.getElementById("newBrwoserFisca").value;
 		newBrwoserMun= document.getElementById("newBrwoserMun").value;
 		newBrwoserColo= document.getElementById("newBrwoserColo").value;
 		calleInputPuesta= document.getElementById("calleInputPuesta").value;


 		if(newBrwoser != "" && fechaevento != "" && newBrwoserFisca != "" && newBrwoserMun != "" && newBrwoserColo != "" && calleInputPuesta != ""){ 
			return true;
		}else{ 	return false;  }					

}



function modalVehicle(typeForm,tipoMOd, idEnlace, idVeicle, b){
 		
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	
	if(idPuestaDisposicion == ""){

			var validar = validateDataPuesta();	
			//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
			if(validar){

						//var newBrwosers_id_colo= document.querySelector("#newBrwosersColo"  + " option[value='" + newBrwoserColo+ "']").dataset.id;	
/*
						var newBrwosers_id = $("#newBrwoser").val();
						var obj = $("#newBrwosers").find("option[value='" + newBrwosers_id + "']").attr('data-id');*/
						var obj = document.getElementById("newBrwosers_id").value;

						//var newBrwosers_id_fisca = $("#newBrwoserFisca").val();
							var obj2 = document.getElementById("newBrwoserFisca").value;

							//var newBrwosers_id_mun = $("#newBrwoserMun").val();
							var obj3 = document.getElementById("newBrwoserMun").value;

							//var newBrwosers_id_colo = $("#newBrwoserColo").val(); document.getElementById("#newBrwoserColo").value;
							var obj4 = document.getElementById("newBrwoserColo").value;

						if(obj != null && obj.length > 0){

										if(obj2  != null && obj2.length > 0){

												if(obj3 != null && obj3.length > 0){

														if(obj4 != null && obj4.length > 0){


																	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
																	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
																	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
																	if(numberCallePuesta == ""){ numberCallePuesta = 0; }

																var link = document.getElementById("imgVeicle");	
															    // Changing the href attribute value
															    link.setAttribute("href", "#puestdisposVehic");
															    link.setAttribute("data-toggle", "modal");		


															     var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuat = document.getElementById("acepto4").checked;
																			 var cinc = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;


															    var puestaData = Array();
															    puestaData[0] = obj;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  obj2;
															    puestaData[4] = obj3; puestaData[5] = obj4; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
															    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd;

															    puestaData[10] = uno; puestaData[11] = dos; puestaData[12] = tres; puestaData[13] = cuat; puestaData[14] = cinc; puestaData[15] = naracion;

															     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
															     jObject= JSON.stringify(jObject);
																			
																				cont = document.getElementById('contMOdalPuedisposVehic');
																				ajax=objetoAjax();
																				ajax.open("POST", "format/puestaDisposicion/modalVehicle.php");
																				ajax.onreadystatechange = function(){
																					if (ajax.readyState == 4 && ajax.status == 200) {
																						cont.innerHTML = ajax.responseText;		
																						$(".dataAutocomplet").select2({ width: '100%', placeholder: "Seleccione", allowClear: false });		
																						$('#puestdispos').modal('hide'); 
																						$('#puestdisposVehic').modal('show');
																					}
																				}
																				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
																				ajax.send("&idVeicle="+idVeicle+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b+"&typeForm="+typeForm);


														}else{ swal("", "La Colonia ingresada es incorrecta.", "warning"); }

												}else{ swal("", "El Municipio ingresado es incorrecto.", "warning"); }

										}else{ swal("", "La Fiscalía ingresada es incorrecta.", "warning"); }

						}else{
									swal("", "El Mando ingresado es incorrecto.", "warning");
						}				

			}else{ 

				swal("", "Faltan datos por registrar.", "warning");
			}	
	 		
 		}else if(idPuestaDisposicion != ""){  ////////////////////// SI EL TIPO MODAL ES UNO QUIERE DECIR QUE YA HAY UNA PUESTA /////////////////////


 				var link = document.getElementById("imgVeicle");	
			    // Changing the href attribute value
			    link.setAttribute("href", "#puestdisposVehic");
			    link.setAttribute("data-toggle", "modal");				
			
				cont = document.getElementById('contMOdalPuedisposVehic');
				ajax=objetoAjax();
				ajax.open("POST", "format/puestaDisposicion/modalVehicle.php");
				ajax.onreadystatechange = function(){
					if (ajax.readyState == 4 && ajax.status == 200) {
						cont.innerHTML = ajax.responseText;			
						$(".dataAutocomplet").select2({ width: '100%', placeholder: "Seleccione", allowClear: false });			
						$('#puestdispos').modal('hide'); 
						$('#puestdisposVehic').modal('show');
					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax.send("&idVeicle="+idVeicle+"&typeForm="+typeForm+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

 		}
   
}


function getData(){

/*
		var newBrwoser= document.getElementById("newBrwosers_id").value;
 		var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;*/
		var newBrwosers_id= document.getElementById("newBrwosers_id").value;		

		cont = document.getElementById('contDataMando');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/dataMando.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function getDataMunicip(){


		 /*newBrwoserFisca= document.getElementById("newBrwoserFisca").value;
 		var newBrwoser_val= document.querySelector("#newBrwosersFis"  + " option[value='" + newBrwoserFisca+ "']").dataset.value;*/
		var newBrwosers_id= document.getElementById("newBrwoserFisca").value;	

		cont = document.getElementById('newBrwoserMun');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/munciData.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function getDataMunicipVehi(){


		var newBrwoserFiscaVehi= document.getElementById("newBrwoserFiscaVehi").value;
 		var newBrwoser_val= document.querySelector("#newBrwosersFisVehi"  + " option[value='" + newBrwoserFiscaVehi+ "']").dataset.value;
		var newBrwosers_id= document.querySelector("#newBrwosersFisVehi"  + " option[value='" + newBrwoserFiscaVehi+ "']").dataset.id;		

		cont = document.getElementById('munciDataVehi');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/munciDataVehi.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function getDataMuniciPerson(){


		var newBrwoserFiscaPerson= document.getElementById("newBrwoserFiscaPerson").value;
 		var newBrwoser_val= document.querySelector("#newBrwosersFisPerson"  + " option[value='" + newBrwoserFiscaPerson+ "']").dataset.value;
		var newBrwosers_id= document.querySelector("#newBrwosersFisPerson"  + " option[value='" + newBrwoserFiscaPerson+ "']").dataset.id;		

		cont = document.getElementById('munciDataPerson');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/munciDataPerson.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}



function getDataColoni(){

/*
		var newBrwoserMun= document.getElementById("newBrwoserMun").value;
 		var newBrwoser_val= document.querySelector("#newBrwosersMun"  + " option[value='" + newBrwoserMun+ "']").dataset.value;*/
		var newBrwosers_id= document.getElementById("newBrwoserMun").value;	

		cont = document.getElementById('newBrwoserColo');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/coloniData.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}
function getDataColoniVehi(){


		var newBrwoserMunVehi= document.getElementById("newBrwoserMunVehi").value; 		
		var newBrwosers_id= document.querySelector("#newBrwosersMunVehi"  + " option[value='" + newBrwoserMunVehi+ "']").dataset.id;		

		cont = document.getElementById('coloniDataVehi');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/coloniDataVehi.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function getDataColoniPerson(){


		var newBrwoserMunPerson= document.getElementById("newBrwoserMunPerson").value; 		
		var newBrwosers_id= document.querySelector("#newBrwosersMunPerson"  + " option[value='" + newBrwoserMunPerson+ "']").dataset.id;		

		cont = document.getElementById('coloniDataPerson');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/coloniDataPerson.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function getPOstalCode(){

		var newBrwosers_id= document.getElementById("newBrwoserColo").value;
		cont = document.getElementById('codepostalid');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/codePOstalData.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}


////////////////////////////////////// MODAL PERSONAS //////////////////////////////////////

function showmodalPersonas(tipoMOd, idEnlace, idPersona, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////

					/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	
	if(idPuestaDisposicion == ""){

			var validar = validateDataPuesta();	
			//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
			if(validar){


						/*var newBrwosers_id= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;	*/
						var newBrwosers_id = document.getElementById("newBrwosers_id").value;
						var newBrwosers_id_fisca=  document.getElementById("newBrwoserFisca").value;
						var newBrwosers_id_mun= document.getElementById("newBrwoserMun").value;
						var newBrwosers_id_colo= document.getElementById("newBrwoserColo").value;
						
					var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
					var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
					var numberCallePuesta= document.getElementById("numberCallePuesta").value;
					 if(numberCallePuesta ==""){ numberCallePuesta = 0; }

					 var uno = document.getElementById("acepto1").checked;
					 var dos = document.getElementById("acepto2").checked;
					 var tres = document.getElementById("acepto3").checked;
					 var cuat = document.getElementById("acepto4").checked;
					 var cinc = document.getElementById("acepto5").checked;

					 var naracion= document.getElementById("textNarracion").value;
					


				var link = document.getElementById("imgPerson");	
			    // Changing the href attribute value
			    link.setAttribute("href", "#modalPersonas");
			    link.setAttribute("data-toggle", "modal");		

			    var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd;

			    puestaData[10] = uno; puestaData[11] = dos; puestaData[12] = tres; puestaData[13] = cuat; puestaData[14] = cinc; puestaData[15] = naracion;

			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);
			
				cont = document.getElementById('contModalPersonas');
				ajax=objetoAjax();
				ajax.open("POST", "format/puestaDisposicion/modalPersonas.php");
				ajax.onreadystatechange = function(){
					if (ajax.readyState == 4 && ajax.status == 200) {
						cont.innerHTML = ajax.responseText;			
						$(".dataAutocomplet").select2({ width: '100%', placeholder: "Seleccione", allowClear: false });	
						$('#puestdispos').modal('hide'); 
						$('#modalPersonas').modal('show');
					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax.send("&idPersona="+idPersona+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);

			}else{ 
				swal("", "Faltan datos por registrar.", "warning");
			}	
	 		
 		}else if(idPuestaDisposicion != ""){  ////////////////////// SI EL TIPO MODAL ES UNO QUIERE DECIR QUE YA HAY UNA PUESTA /////////////////////

 							
 				var link = document.getElementById("imgPerson");	
			    // Changing the href attribute value
			    link.setAttribute("href", "#modalPersonas");
			    link.setAttribute("data-toggle", "modal");				
			
				cont = document.getElementById('contModalPersonas');
				ajax=objetoAjax();
				ajax.open("POST", "format/puestaDisposicion/modalPersonas.php");
				ajax.onreadystatechange = function(){
					if (ajax.readyState == 4 && ajax.status == 200) {
						cont.innerHTML = ajax.responseText;	
						$(".dataAutocomplet").select2({ width: '100%', placeholder: "Seleccione", allowClear: false });				
						$('#puestdispos').modal('hide'); 
						$('#modalPersonas').modal('show');
					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax.send("&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&idPersona="+idPersona+"&b="+b);

 		}


}

function closemodalPersonas(){
  x = 0;
	 $('#puestdispos').modal('show'); 
	 $('#modalPersonas').modal('hide');
}

function hoverv(element, t){


			if(t == "ve"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-13.png');} 
			if(t == "pe"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-14.png');} 
			if(t == "ar"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-15.png');} 
			if(t == "dr"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-16.png');} 
			if(t == "op"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-17.png');} 
			if(t == "fo"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-18.png');} 
			if(t == "he"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-19.png');} 
			if(t == "ma"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-20.png');} 
			if(t == "en"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-21.png');} 
			if(t == "in"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-22.png');} 
			if(t == "ind"){element.setAttribute('src','img/iconosPuestaDispo/Cuadrados/Color-23.png');} 
			if(t == "ap"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-24.png');} 

}

function unhoverv(element, t){


			 if(t == "ve"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-01.png');}
			  if(t == "pe"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-02.png');}
			   if(t == "ar"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-03.png');}
			    if(t == "dr"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-04.png');}
			     if(t == "op"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-05.png');}
			      if(t == "fo"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-06.png');}
			       if(t == "he"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-07.png');}
			        if(t == "ma"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-08.png');}
			         if(t == "en"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-09.png');}
			          if(t == "in"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-10.png');}
			           if(t == "ind"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-11.png');}
			            if(t == "ap"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-12.png');}

}






////////////////////////////////////// MODAL PERSONAS //////////////////////////////////////



function registrarPersona(idEnlace, tipoActualizacion, tipoArch, b, idPersona){
	
	var idEnlace = idEnlace;
	var tipoActualizacion = tipoActualizacion;
	var idPersona = idPersona;

 var textNombre = $("#textNombre").val();
	var textApPaterno = $("#textApPaterno").val();
	var textApMaterno = $("#textApMaterno").val();
	var textEdad = $("#textEdad").val();
	var textSexo = $("#textSexo").val();
	//var fechaDetencion = moment($("#fechaDetencion").val(), 'YYYY/MM/DD'); 
 var textCatDelitos = $("#textTipoDelito").val(); 
 var textDisposicionDe = $("#textDisposicionDe").val();

//Para verificar si el usuario agrego un delito secundario
 if ( document.getElementById( "textdelitoCometido" ) ) { 
 	var arrDelitos = document.getElementsByName("delitos[]"); 
 }else{
 		var arrDelitos = 0;
 }



    if(textNombre!= "" && textApPaterno != "" && textApMaterno != ""  && textEdad  != "" 
			&& textSexo != "" && textCatDelitos != "" && textInvFlag != 0 && textDisposicionDe != 0 ){

	/*Obtener datos del formulario*/

	var textAlias = $("#textAlias").val();


	//var textBandas = $("#textBandas").val();
	//var textOrgCriminal = $("#textOrgCriminal").val();
	//var textAgraviado = $("#textAgraviado").val();
	var textInvFlag = $("#textInvFlag").val();
	var textBandaSolitario = $("#textBandaSolitario").val();
	//var textAvPP = $("#textAvPP").val();
	//var textNumBas = $("#textNumBas").val();
	var textRequerido = $("#textRequerido").val();
	var textOficio = $("#textOficio").val();
	var textTipoDelitoId = $("#textTipoDelito").val(); 
	var textObservaciones = $("#textObservaciones").val();
	var jObjectDelitos = {};
 
 

	//// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
			var tipoMOd= document.getElementById("tipoMOd").value;

			var idMandoPuesta= document.getElementById("idMandoPuesta").value;
			var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
			var fechaevento= document.getElementById("fechaevento").value;
		

			var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
			var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
			var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;

			var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
			var calleInputPuesta= document.getElementById("calleInputPuesta").value;
			var numberCallePuesta= document.getElementById("numberCallePuesta").value;
			if(numberCallePuesta == ""){ numberCallePuesta = 0; }
			var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;

			var cont= document.getElementById("");
			

			var puestaDataVehi = Array();
			    puestaDataVehi[0] = idMandoPuesta;   puestaDataVehi[1] = "'"+nucPuestaDisposi+"'"; puestaDataVehi[2] = "'"+fechaevento+"'"; puestaDataVehi[3] =  newBrwosers_id_fisca;
			    puestaDataVehi[4] = newBrwosers_id_mun; puestaDataVehi[5] = newBrwosers_id_colo; puestaDataVehi[6] = codepostalidPeusta; puestaDataVehi[7] = "'"+calleInputPuesta+"'";
			    puestaDataVehi[8] = numberCallePuesta; puestaDataVehi[9] = tipoMOd; puestaDataVehi[10] = uno; puestaDataVehi[11] = dos; puestaDataVehi[12] = tres;
			    puestaDataVehi[13] = cuatro; puestaDataVehi[14] = cinco; puestaDataVehi[15] = narac;

			     var jObject={};  for(i in puestaDataVehi){  jObject[i] = puestaDataVehi[i];   }
			     jObject= JSON.stringify(jObject);
    //// DATA DE LA PUESTA A DISPOSICION /////

    /// DATA DE DELITOS ///
	for(i=0;i<arrDelitos.length;i++){ jObjectDelitos[i] = arrDelitos[i].value; }
	jObjectDelitos = JSON.stringify(jObjectDelitos);
  	/// DATA DE DELITOS ///


	 $.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroPersonas.php",
        data: "nombre="+textNombre+"&ap_paterno="+textApPaterno+"&ap_materno="+textApMaterno+"&alias="+textAlias+"&edad="+textEdad+'&sexo='+textSexo+
              "&inv_flag="+textInvFlag+"&banda_solitario="+textBandaSolitario+
              "&DisposicionDe="+textDisposicionDe+"&requerido="+textRequerido+"&oficio="+textOficio+"&tipoDelitoId="+textTipoDelitoId+
         "&observaciones="+textObservaciones+"&arrayDelitos="+jObjectDelitos+"&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idPersona="+idPersona,
        success: function(resp){
            
        					//$('#respuesta').html(resp);
            	var json = resp;
													var obj = eval("(" + json + ")");
													if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
														 if (obj.first == "SI") {                    
															
														 	var obj = eval("(" + json + ")");
														 	swal("", "Persona Registrada Exitosamente.", "success");
															//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
															closemodalPersonas();
															showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, tipoArch, b);

														 }
													}


        }
    });
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/////////////////////////// ELIMINAR UN ITEM DE ALGUN FORMULARIO /////////////////////////////////


function deleteItemForm(form, idItem, idEnlace, idPuestaDisposicion){

				swal({
			title: "Estas seguro de Eliminar?",
    text: "Se eliminara por completo el registro de la Base de Datos!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si. Eliminar',
    cancelButtonText: "No, Cancelar"
				
			},
			function(isConfirm){
				if (isConfirm) {

						ajax=objetoAjax();
						ajax.open("POST", "format/puestaDisposicion/deleteItemForm.php");

						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {			
											var json = ajax.responseText;
													var obj = eval("(" + json + ")");
													if (obj.first == "NO") { swal("", "No se elimino verifique los datos.", "warning"); }else{
														 if (obj.first == "SI") {    															
														 	var obj = eval("(" + json + ")");
														 	swal("", "Registro eliminado exitosamente.", "success");															
															 showmodalPueDispo(1, idEnlace, idPuestaDisposicion, 0, 1);
														 }
													}
										}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&form="+form+"&idItem="+idItem+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion);

					
				}
			});	
					

}


//// FORESTALES /////

function modalForestales(tipoMOd, idEnlace, idForestales, be){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var validar = validateDataPuesta();	
	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////

	 if(idPuestaDisposicion == ""  ){

	 			if(validar){
		/*Obtener id mando*/
		/*
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;*/

		var newBrwosers_id = document.getElementById("newBrwosers_id").value;

		var newBrwosers_id_fisca=  document.getElementById("newBrwoserFisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwoserMun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwoserColo").value;
							
		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }
		

		var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;
																			


		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; 

			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuatro; puestaData[15] = cinco; puestaData[16] = naracion;


			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }

			     jObject= JSON.stringify(jObject);

	
	    /*Validamos si ha llenado el formulario*/    
	    if(idPuestaDisposicion == ""  ){

			    	cont = document.getElementById('contModalForestales2');
								ajax=objetoAjax();
								ajax.open("POST", "format/puestaDisposicion/modalForestales.php");

								ajax.onreadystatechange = function(){
									if (ajax.readyState == 4 && ajax.status == 200) {
										cont.innerHTML = ajax.responseText;

										$('#puestdispos').modal('hide'); 
										$('#modalForestales').modal('show');
									}
								}
								ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
								ajax.send("&idForestales="+idForestales+"&jObject="+jObject+"&idEnlace="+idEnlace+"&be="+be);
							   
		    }else{

		    				if(idPuestaDisposicion  != "" ){

		    								cont = document.getElementById('contModalForestales2');
														ajax=objetoAjax();
														ajax.open("POST", "format/puestaDisposicion/modalForestales.php");

														ajax.onreadystatechange = function(){
															if (ajax.readyState == 4 && ajax.status == 200) {
																cont.innerHTML = ajax.responseText;

																$('#puestdispos').modal('hide'); 
																$('#modalForestales').modal('show');
															}
														}
														ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
														ajax.send("&idForestales="+idForestales+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&be="+be);

		    				}

		    }

		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	

	 }else{

		    				if(idPuestaDisposicion  != "" ){

		    								cont = document.getElementById('contModalForestales2');
														ajax=objetoAjax();
														ajax.open("POST", "format/puestaDisposicion/modalForestales.php");

														ajax.onreadystatechange = function(){
															if (ajax.readyState == 4 && ajax.status == 200) {
																cont.innerHTML = ajax.responseText;

																$('#puestdispos').modal('hide'); 
																$('#modalForestales').modal('show');
															}
														}
														ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
														ajax.send("&idForestales="+idForestales+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&be="+be);

		    				}

		    }


	
}

function closemodalForestales(){
	 $('#puestdispos').modal('show'); 
	 $('#modalForestales').modal('hide');
}


/// registrar forestales ///
	
		function registrarForestales(idEnlace, typearch, b, tipoActualizacion , idForestales){
				
				/// VALIDACIONES ///
				var idEnlace = idEnlace;				
				var tipoActualizacion = tipoActualizacion;
					var idForestales = idForestales;
		


				var textCatMadera = $("#textCatMadera").val();
				var objMadera = $("#listaCatMadera").find("option[value='" + textCatMadera + "']").attr('data-id');

				if(objMadera != null && objMadera.length > 0){

			 var textVolumen = $("#textVolumen").val();

				    /// VALIDACIONES ///
				if( textVolumen != "" ){

					var textObservaciones = $("#textObservacionesForest").val();
					//// DATA DE LA PUESTA A DISPOSICION /////
					var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
					var tipoMOd= document.getElementById("tipoMOd").value;

					var idMandoPuesta = document.getElementById("idMandoPuesta").value;
					var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
					var fechaevento= document.getElementById("fechaevento").value;
					var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
					var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
					var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
					var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
					var calleInputPuesta= document.getElementById("calleInputPuesta").value;
					var numberCallePuesta= document.getElementById("numberCallePuesta").value;
					if(numberCallePuesta == ""){ numberCallePuesta = 0; }


				var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;



					var puestaDataPersona = Array();
							    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
							    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
							    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;


							     var jObject={};  
							     for(i in puestaDataPersona){  
							     	jObject[i] = puestaDataPersona[i];   
							     }
							     jObject = JSON.stringify(jObject);
				    //// DATA DE LA PUESTA A DISPOSICION /////

					 $.ajax({
				        type: "POST",
				        dataType: 'html',
				        url: "format/puestaDisposicion/registroForestales.php",
				        data: "catMadera_id="+objMadera+"&volumen="+textVolumen+"&observaciones="+textObservaciones+"&jObject="+jObject+"&idEnlace="+idEnlace+
				               "&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idForestales="+idForestales,
				        success: function(resp){
				           
				        			var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Producto Forestal Registrado Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalForestales();
																	
																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}
				        }
				    });
					}else{
						swal("", "Faltan datos por registrar.", "warning");
					}


				}else{		swal("", "El genero seleccionado es incorrecto.", "warning"); }		

}

/// registrar forestales ///



////////////////////////////////////// MODAL DROGAS //////////////////////////////////////


function modalDrogas(tipoMOd, idEnlace, idDroga, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	
	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////

	if(idPuestaDisposicion == ""){

					if(validar){
		/*Obtener id mando*/
		/*
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;*/

		var newBrwosers_id = document.getElementById("newBrwosers_id").value;

		var newBrwosers_id_fisca=  document.getElementById("newBrwoserFisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwoserMun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwoserColo").value;
							
		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

		  var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;

		

		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd;


			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuatro; puestaData[15] = cinco; puestaData[16] = naracion;


			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);

	    	cont = document.getElementById('contModalDrogas');
			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/modalDrogas.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;

					$('#puestdispos').modal('hide'); 
					$('#modalDrogase').modal('show');
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idDroga="+idDroga+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
		    
		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	

	}else if(idPuestaDisposicion != ""){ 


					  	cont = document.getElementById('contModalDrogas');
								ajax=objetoAjax();
								ajax.open("POST", "format/puestaDisposicion/modalDrogas.php");

								ajax.onreadystatechange = function(){
									if (ajax.readyState == 4 && ajax.status == 200) {
										cont.innerHTML = ajax.responseText;

										$('#puestdispos').modal('hide'); 
										$('#modalDrogase').modal('show');
									}
								}
								ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
								ajax.send("&idDroga="+idDroga+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	}


}

function closemodalDrogas(){
	 $('#puestdispos').modal('show'); 
	 $('#modalDrogase').modal('hide');
}

//// registrar drogas


function registrarDrogas(idEnlace, typearch, b,  tipoActualizacion , idDroga){
	/// VALIDACIONES ///
	var idEnlace = idEnlace;
	var tipoActualizacion = tipoActualizacion;
	var idDroga = idDroga;

    ///Obtener datos del formulario///

var textCatDroga = $("#textCatDroga").val();
var objDroga = $("#listaCatDroga").find("option[value='" + textCatDroga + "']").attr('data-id');

if(objDroga != null && objDroga.length > 0){

					var textKilogramos = $("#textKilogramos").val();
					var textCatUnidadMedida = $("#textCatUnidadMedida").val();
					var textCatProductoQuimico = $("#textCatProductoQuimico").val();
										    /// VALIDACIONES ///
						if(textKilogramos != "" && textCatUnidadMedida != 0 &&  textCatProductoQuimico != 0){

						
						var textObservaciones = $("#textObservacionesDrog").val();

							//// DATA DE LA PUESTA A DISPOSICION /////
							var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
							var tipoMOd= document.getElementById("tipoMOd").value;

							var idMandoPuesta = document.getElementById("idMandoPuesta").value;
							var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
							var fechaevento= document.getElementById("fechaevento").value;
							var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
							var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
							var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
							var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
							var calleInputPuesta= document.getElementById("calleInputPuesta").value;
							var numberCallePuesta= document.getElementById("numberCallePuesta").value;
							if(numberCallePuesta == ""){ numberCallePuesta = 0; }
																				var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;


							var puestaDataPersona = Array();
									    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
									    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
									    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = naracion;


									     var jObject={};  
									     for(i in puestaDataPersona){  
									     	jObject[i] = puestaDataPersona[i];   
									     }
									     jObject = JSON.stringify(jObject);
						    //// DATA DE LA PUESTA A DISPOSICION /////

							 $.ajax({
						        type: "POST",
						        dataType: 'html',
						        url: "format/puestaDisposicion/registroDrogas.php",
						        data: "catDroga_id="+objDroga+"&kilogramos="+textKilogramos+"&observaciones="+textObservaciones+"&jObject="+jObject+"&idEnlace="+idEnlace+
						               "&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idDroga="+idDroga+"&idCatUnidadMedida="+textCatUnidadMedida+
						               "&idCatProductoQuimico="+textCatProductoQuimico,
						        success: function(resp){
						            var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Droga Registrada Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalDrogas();
																	
																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}
						        }
						    });
							}else{
								swal("", "Faltan datos por registrar.", "warning");
							}


}else{ swal("", "La droga seleccionada es incorrecta.", "warning"); }

var textKilogramos = $("#textKilogramos").val();




}

////////////////////////////////////// MODAL DROGAS //////////////////////////////////////


////////////////////////////////////// MODAL OBJETO ASEGURADO //////////////////////////////////////


function modalObjetoAsegurado(tipoMOd, idEnlace, idObjeto, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	

	if(idPuestaDisposicion == ""  ){


	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
	if(validar){
		/*Obtener id mando*/
		/*
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;*/

		var newBrwosers_id = document.getElementById("newBrwosers_id").value;

		var newBrwosers_id_fisca=  document.getElementById("newBrwoserFisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwoserMun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwoserColo").value;
							
		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

			var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuat = document.getElementById("acepto4").checked;
																			 var cinc = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;

		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; 

			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuat; puestaData[15] = cinc; puestaData[16] = naracion;

			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);

	
	    /*Validamos si ha llenado el formulario*/    
	    if(idPuestaDisposicion == ""  ){
	    	cont = document.getElementById('contModalObjetoAsegurado');
			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/modalObjetoAsegurado.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;

					$('#puestdispos').modal('hide'); 
					$('#modalObjetoAsegurado').modal('show');
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idObjeto="+idObjeto+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
		    }
		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	
}else{


					if(idPuestaDisposicion != ""){


	 														cont = document.getElementById('contModalObjetoAsegurado');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalObjetoAsegurado.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;

												$('#puestdispos').modal('hide'); 
												$('#modalObjetoAsegurado').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idObjeto="+idObjeto+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	 						}


}




}


///////////////// REGISTRO OBJETO ASEGURADO //////////



function registroObjetoAsegurado(idEnlace, typearch, b, tipoActualizacion , idObjeto){

	
	/// VALIDACIONES ///
	var idEnlace = idEnlace;
var tipoActualizacion = tipoActualizacion;
	var idObjeto = idObjeto;
	

	var textObservaciones = $("#textObservacionesObjAsegurados").val();

	//// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var tipoMOd= document.getElementById("tipoMOd").value;

	var idMandoPuesta = document.getElementById("idMandoPuesta").value;
	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
	var fechaevento= document.getElementById("fechaevento").value;
	var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
	var calleInputPuesta= document.getElementById("calleInputPuesta").value;
	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
	if(numberCallePuesta == ""){ numberCallePuesta = 0; }

var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;



	var puestaDataPersona = Array();
			    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
			    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
			    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;			   


			     var jObject={};  
			     for(i in puestaDataPersona){  
			     	jObject[i] = puestaDataPersona[i];   
			     }
			     jObject = JSON.stringify(jObject);
 //// DATA DE LA PUESTA A DISPOSICION /////


var herramienta = document.getElementById("herramientas").value;
var textCant = document.getElementById("textCantidad").value; 
var textDispoObj = document.getElementById("textDispoObj").value;
if(herramienta != "" && textCant != ""  && textDispoObj != ""){
			$.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroObjetoAsegurado.php",
        data: "textObservaciones="+textObservaciones+"&herramienta="+herramienta+"&textCant="+textCant+"&textDispoObj="+textDispoObj+"&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idObjeto="+idObjeto,
        success: function(resp){
            var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Objeto Registrado Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalObjetoAsegurado();

																		showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}
        }
    });
		}else{
				swal("", "Faltan datos por registrar.", "warning");
		}

		}




function closemodalObjetoAsegurado(){
	 $('#puestdispos').modal('show'); 
	 $('#modalObjetoAsegurado').modal('hide');
}

//////////////////////// AGREGAR CAMPOS HERRAMIENTAS ASEGURADAS ////////////////////////////
var y = 0;
var campos_max2 = 9;   //max de 10 campos
function agregarHerramienta(){
	if (y < campos_max2) {
		$('#herramientas_aseguradas').append('<div class="uno">\<div class="form-group col-md-6"><label for="textHerramienta">Herramienta asegurada<span class="aste">(*)</span></label>\<input type="text" class="form-control" id="herramientas" name="herramientas[]"></div><div class="form-group col-md-6"> <label for="textCantidad">Cantidad<span class="aste">(*)</span></label>\<a onclick="eliminarHerramienta();" class="remover_herramienta">Remover</a>\<input type="number" class="form-control" id="textCantidadHerramienta" name="cantidad[]"></div>\</div>');
		y++;
	}
}

function eliminarHerramienta(){
	$('#herramientas_aseguradas').on("click",".remover_herramienta",function(e) {
    e.preventDefault();
    $(this).parent('div').parent().remove();
  }); y--;
}

////////////////////////////////////// MODAL OBJETO ASEGURADO //////////////////////////////////////




///////////////////// MODAL DINERO ASEGURADO /////////////////////





function modalDineroAsegurado(tipoMOd, idEnlace, idDinero, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	
	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////

	 if(idPuestaDisposicion == ""  ){


	 		if(validar){
									/*Obtener id mando*/
									/*
									var newBrwoser= document.getElementById("newBrwoser").value;
								 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
									var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;*/

									var newBrwosers_id = document.getElementById("newBrwosers_id").value;

								var newBrwosers_id_fisca=  document.getElementById("newBrwoserFisca").value;
								var newBrwosers_id_mun= document.getElementById("newBrwoserMun").value;
								var newBrwosers_id_colo= document.getElementById("newBrwoserColo").value;
																					
									var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
									var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
									var numberCallePuesta= document.getElementById("numberCallePuesta").value;
									 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

									var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuat = document.getElementById("acepto4").checked;
																			 var cinc = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;


									var puestaData = Array();
										    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
										    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
										    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; 

										    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    							puestaData[14] = cuat; puestaData[15] = cinc; puestaData[16] = naracion;


										     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
										     jObject= JSON.stringify(jObject);

								
								    /*Validamos si ha llenado el formulario*/    
								    if(idPuestaDisposicion == ""  ){
								    	cont = document.getElementById('contModalDineroAsegurado');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalDineroAsegurado.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;

												$('#puestdispos').modal('hide'); 
												$('#modalDineroAsegurado').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idDinero="+idDinero+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
									    }
									}else{ 
										swal("", "Faltan datos por registrar.", "warning");
									}	
	 }else{

	 						if(idPuestaDisposicion != ""){


	 								cont = document.getElementById('contModalDineroAsegurado');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalDineroAsegurado.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;

												$('#puestdispos').modal('hide'); 
												$('#modalDineroAsegurado').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idDinero="+idDinero+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	 						}

	 }



}

function closemodalDineroAsegurado(){
	 $('#puestdispos').modal('show'); 
	 $('#modalDineroAsegurado').modal('hide');


}


//// REGISTRO DINERO ///


function registroDineroAsegurado(idEnlace, typearch, b, tipoActualizacion , idDineroAsegurado){
	/// VALIDACIONES ///
	var idEnlace = idEnlace;
var tipoActualizacion = tipoActualizacion;
	var idDineroAsegurado = idDineroAsegurado;
	

	/*Obtener datos del formulario*/
	var textMon_nal = $("#textMon_nal").val();
	var textMon_ext = $("#textMon_ext").val();
	var textDivisa = $("#textDivisa").val();
	var textObservaciones = $("#textObservacionesDinero").val();
	var textDispoDinero = $("#textDispoDinero").val();

//Si los campos de moneda van vacios ponerlos a cero//
			if(textMon_nal == ""){ textMon_nal = 0; }
			if(textMon_ext == ""){ textMon_ext = 0; }

///Validar campos vacios///
if((textMon_nal > 0 || textMon_ext > 0) && textDispoDinero != "" ){
	
 //// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var tipoMOd= document.getElementById("tipoMOd").value;
	var idMandoPuesta = document.getElementById("idMandoPuesta").value;
	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
	var fechaevento= document.getElementById("fechaevento").value;
	var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
	var calleInputPuesta= document.getElementById("calleInputPuesta").value;
	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
	if(numberCallePuesta == ""){ numberCallePuesta = 0; }
	var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;


	var puestaDataPersona = Array();
			    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
			    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
			    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;


			     var jObject={};  
			     for(i in puestaDataPersona){  
			     	jObject[i] = puestaDataPersona[i];   
			     }
			     jObject = JSON.stringify(jObject);
 //// DATA DE LA PUESTA A DISPOSICION /////

				
			$.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroDineroAsegurado.php",
        data: "textMon_nal="+textMon_nal+"&textMon_ext="+textMon_ext+"&textDivisa="+textDivisa+"&textObservaciones="+textObservaciones+
              "&textDispoDinero="+textDispoDinero+"&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+
              "&idDineroAsegurado="+idDineroAsegurado,
        success: function(resp){
            
        					var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Dinero Registrado Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalDineroAsegurado();

																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}

        }
    });
		}else{
			swal("", "Agregue al menos una cantidad.", "warning");
		}
}


/////////////////////////// VALIDA DIVISA EXTRANJERA //////////////////////////////////////
function validaDivisa() {
  var x = document.getElementById("textMon_ext").value;
  document.getElementById("textMon_ext").blur(); /*Elimina el foco del input*/
  if(x == ""){
  	 $("#textDivisa").prop("disabled", true);
     $("#textDivisa option[value='0']").attr("selected",true);
  }else{
  	if(x != 0){
  		var intervalo;
	  	clearInterval(intervalo);
	    intervalo = setInterval(function(){
	        $("#textDivisa").prop("disabled", false );
	        $("#textDivisa option[value='0']").attr("selected",false);
	        clearInterval(intervalo);
	    }, 100);
	}
  }
}
/////////////////////////// VALIDA DIVISA EXTRANJERA //////////////////////////////////////



///////////////////// MODAL DINERO ASEGURADO /////////////////////





////////////////////////////////////// MODAL DEFUNCIONES //////////////////////////////////////


function modalDefunciones(tipoMOd, idEnlace, idDefuncion, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	

	if(idPuestaDisposicion == ""  ){
	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
	if(validar){
		/*Obtener id mando*/
		/*
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;
		*/

		var newBrwosers_id = document.getElementById("newBrwosers_id").value;

		var newBrwosers_id_fisca=  document.getElementById("newBrwoserFisca").value;
		var newBrwosers_id_mun= document.getElementById("newBrwoserMun").value;
		var newBrwosers_id_colo= document.getElementById("newBrwoserColo").value;
								
		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

		

var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var narac= document.getElementById("textNarracion").value;




		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; 

			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuatro; puestaData[15] = cinco; puestaData[16] = narac;


			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);

	
	    /*Validamos si ha llenado el formulario*/    
	    if(idPuestaDisposicion == ""  ){
	    	cont = document.getElementById('contModalDefunciones');
			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/modalDefunciones.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;

					$('#puestdispos').modal('hide'); 
					$('#modalDefunciones').modal('show');
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idDefuncion="+idDefuncion+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
		    }
		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	

	}else{



					if(idPuestaDisposicion != ""){


	 								cont = document.getElementById('contModalDefunciones');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalDefunciones.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;

												$('#puestdispos').modal('hide'); 
												$('#modalDefunciones').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idDefuncion="+idDefuncion+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	 						}


	}
}

function closemodalDefunciones(){
	 $('#puestdispos').modal('show'); 
	 $('#modalDefunciones').modal('hide');
}



function registroDefunciones(idEnlace, typearch, b, tipoActualizacion , idDefuncion){
	/// VALIDACIONES ///
	var idEnlace = idEnlace;
var tipoActualizacion = tipoActualizacion;
	var idDefuncion = idDefuncion;
	

	/*Obtener datos del formulario*/
	var textNombre = $("#textNombreDef").val();
	var textAp_paterno = $("#textAp_paternoDef").val();
	var textAp_materno = $("#textAp_maternoDef").val();
	var textSexo = $("#textSexoDef").val();
 var textCatCausaMuerte_id = document.getElementById("textCatCausaMuerte").value;

///Validar campos vacios///
if(textSexo != 0 && textCatCausaMuerte_id != 0 && textNombre != "" && textAp_paterno != "" && textAp_materno != ""){
 /*Obtener datos del formulario*/
	var textEdad = $("#textEdadDef").val(); 
	if(textEdad == ""){ textEdad = 0;}
	var textObservaciones = $("#textObservacionesDefun").val();
	
 //// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var tipoMOd= document.getElementById("tipoMOd").value;
	var idMandoPuesta = document.getElementById("idMandoPuesta").value;
	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
	var fechaevento= document.getElementById("fechaevento").value;
	var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
	var calleInputPuesta= document.getElementById("calleInputPuesta").value;
	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

	var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;



	var puestaDataPersona = Array();
			    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
			    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
			    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd;

			    puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;


			     var jObject={};  
			     for(i in puestaDataPersona){  
			     	jObject[i] = puestaDataPersona[i];   
			     }
			     jObject = JSON.stringify(jObject);
 //// DATA DE LA PUESTA A DISPOSICION /////

				
			$.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroDefunciones.php",
        data: "textNombre="+textNombre+"&textAp_paterno="+textAp_paterno+"&textAp_materno="+textAp_materno+"&textSexo="+textSexo+"&textEdad="+textEdad+
              "&textCatCausaMuerte_id="+textCatCausaMuerte_id+"&textObservaciones="+textObservaciones+"&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idDefuncion="+idDefuncion,
        success: function(resp){
            			var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Defuncion Registrada Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalDefunciones();

																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}
        }
    });
		}else{
			swal("", "Faltan datos por registrar..", "warning");
		}
}


function defuncionDesconocido(){
	if( $('#acepto').prop('checked') ) {
		document.getElementById("textNombreDef").disabled = true;
		document.getElementById("textAp_paternoDef").disabled = true;
		document.getElementById("textAp_maternoDef").disabled = true;
		document.getElementById("textEdadDef").disabled = true;
		$("#textNombreDef").val("Desconocido");
		$("#textAp_paternoDef").val("Desconocido");
		$("#textAp_maternoDef").val("Desconocido");
		document.getElementById("textSexoDef").options.item(3).selected = 'selected';
		$("#textEdadDef").val('');
	}else{
		document.getElementById("textNombreDef").disabled = false;
		document.getElementById("textAp_paternoDef").disabled = false;
		document.getElementById("textAp_maternoDef").disabled = false;
		document.getElementById("textEdadDef").disabled = false;
		$("#textNombreDef").val("");
		$("#textAp_paternoDef").val("");
		$("#textAp_maternoDef").val("");
		document.getElementById("textSexoDef").options.item(0).selected = 'selected';
		$("#textEdadDef").val("");
	}
}


////////////////////////////////////// MODAL DEFUNCIONES //////////////////////////////////////




////////////////////////////////////// MODAL TRABAJOS DE CAMPO //////////////////////////////////////


function modalTrabajosDeCampo(tipoMOd, idEnlace, idTrabajoCampo, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	

	if(idPuestaDisposicion == ""  ){

	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
	if(validar){
		/*Obtener id mando*/
		/*
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;*/

		var newBrwosers_id = document.getElementById("newBrwosers_id").value;

		var newBrwosers_id_fisca=  document.getElementById("newBrwoserFisca").value;
		var newBrwosers_id_mun= document.getElementById("newBrwoserMun").value;
		var newBrwosers_id_colo= document.getElementById("newBrwoserColo").value;

		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

																				var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var narac= document.getElementById("textNarracion").value;




		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; 

			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuatro; puestaData[15] = cinco; puestaData[16] = narac;


			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);

	
	    /*Validamos si ha llenado el formulario*/    
	    if(idPuestaDisposicion == ""  ){
	    	cont = document.getElementById('contModalTrabajosDeCampo');
			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/modalTrabajosDeCampo.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;

					$('#puestdispos').modal('hide'); 
					$('#modalTrabajosDeCampo').modal('show');
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idTrabajoCampo="+idTrabajoCampo+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
		    }
		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	

	}else{



					if(idPuestaDisposicion != ""){


	 								cont = document.getElementById('contModalTrabajosDeCampo');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalTrabajosDeCampo.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;

												$('#puestdispos').modal('hide'); 
												$('#modalTrabajosDeCampo').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idTrabajoCampo="+idTrabajoCampo+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	 						}


	}
}

function closemodalTrabajosDeCampo(){
	 $('#puestdispos').modal('show'); 
	 $('#modalTrabajosDeCampo').modal('hide');
}


function registroTrabajosDeCampo(idEnlace, typearch, b, tipoActualizacion , idTrabajoCampo){
	/// VALIDACIONES ///
	var idEnlace = idEnlace;

	var tipoActualizacion = tipoActualizacion;
	var idTrabajoCampo = idTrabajoCampo;
	

	/*Obtener datos del formulario*/
	var textEntrevistas = $("#textEntrevistas").val(); if(textEntrevistas == "") {textEntrevistas = 0; }
	var textVisitasDomiciliarias = $("#textVisitasDomiciliarias").val(); if(textVisitasDomiciliarias == "") {textVisitasDomiciliarias = 0; }
	var textInvestigacionesCumplidas = $("#textInvestigacionesCumplidas").val(); if(textInvestigacionesCumplidas == "") {textInvestigacionesCumplidas = 0; }
	var textInvestigacionesInformadas = $("#textInvestigacionesInformadas").val(); if(textInvestigacionesInformadas == "") {textInvestigacionesInformadas = 0; }
	var textIndividuaciones = $("#textIndividuaciones").val(); if(textIndividuaciones == "") {textIndividuaciones = 0; }
	var solicitudVideos = $("#solicitudVideos").val(); if(solicitudVideos == "") {solicitudVideos = 0; }
	var planimetrias = $("#planimetrias").val(); if(planimetrias == "") {planimetrias = 0; }
	var recPersonas = $("#recPersonas").val(); if(recPersonas == "") {recPersonas = 0; }
	var recObjetos = $("#recObjetos").val(); if(recObjetos == "") {recObjetos = 0; }
	var recFotografias = $("#recFotografias").val(); if(recFotografias == "") {recFotografias = 0; }
 var textObservaciones = $("#textObservacionesTrabCampo").val();

 var cadena_custodia = $("#cadena_custodia").val(); if(cadena_custodia == "") {cadena_custodia = 0; }
 	var traslados = $("#traslados").val(); if(traslados == "") {traslados = 0; }
 	var actos_vigentes = $("#actos_vigentes").val(); if(actos_vigentes == "") {actos_vigentes = 0; }

 totalTrabajo = parseInt(textEntrevistas) + parseInt(textVisitasDomiciliarias) + parseInt(textInvestigacionesCumplidas) + parseInt(textInvestigacionesInformadas) +
                 parseInt(textIndividuaciones) + parseInt(solicitudVideos) + parseInt(planimetrias) + parseInt(recPersonas) + parseInt(recObjetos) + 
                 parseInt(recFotografias) + parseInt(cadena_custodia) + parseInt(traslados) + parseInt(actos_vigentes);

 //// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var tipoMOd= document.getElementById("tipoMOd").value;
	var idMandoPuesta = document.getElementById("idMandoPuesta").value;
	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
	var fechaevento= document.getElementById("fechaevento").value;
	var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
	var calleInputPuesta= document.getElementById("calleInputPuesta").value;
	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		if(numberCallePuesta == ""){ numberCallePuesta = 0; }
	var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;



	var puestaDataPersona = Array();
			    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
			    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
			    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;


			     var jObject={};  
			     for(i in puestaDataPersona){  
			     	jObject[i] = puestaDataPersona[i];   
			     }
			     jObject = JSON.stringify(jObject);
 //// DATA DE LA PUESTA A DISPOSICION /////

	if(totalTrabajo > 0 || idEnlace == 95){	
			$.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroTrabajosDeCampo.php",
        data: "textEntrevistas="+textEntrevistas+"&textVisitasDomiciliarias="+textVisitasDomiciliarias+"&textInvestigacionesCumplidas="+textInvestigacionesCumplidas+
              "&textInvestigacionesInformadas="+textInvestigacionesInformadas+"&textIndividuaciones="+textIndividuaciones+"&solicitudVideos="+solicitudVideos+
              "&planimetrias="+planimetrias+"&recPersonas="+recPersonas+"&recObjetos="+recObjetos+"&recFotografias="+recFotografias+"&textObservaciones="+textObservaciones+"&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idTrabajoCampo="+idTrabajoCampo+
              "&cadena_custodia="+cadena_custodia+"&traslados="+traslados+"&actos_vigentes="+actos_vigentes,
        success: function(resp){
            

        					var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Trabajo de Campo Registrado Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalTrabajosDeCampo();

																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}

        }
    });
		}else{
			swal("", "Información no valida, debe ingresar al menos un indicador.", "warning");
		}
}

////////////////////////////////////// MODAL TRABAJOS DE CAMPO  //////////////////////////////////////
////////////////////////////////////// MODAL ARMAS ASEGURADAS //////////////////////////////////////


function modalArmasAseguradas(tipoMOd, idEnlace, idArma, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	

	if(idPuestaDisposicion == ""  ){
	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
	if(validar){
		/*Obtener id mando*/
		/*
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;*/

		var newBrwosers_id = document.getElementById("newBrwosers_id").value;

	var newBrwosers_id_fisca=  document.getElementById("newBrwoserFisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwoserMun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwoserColo").value;
							
		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

		var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var narac= document.getElementById("textNarracion").value;

		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; 

			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuatro; puestaData[15] = cinco; puestaData[16] = narac;

			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);

	
	    /*Validamos si ha llenado el formulario*/    
	    if(idPuestaDisposicion == ""  ){
	    	cont = document.getElementById('contModalArmasAseguradas');
			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/modalArmasAseguradas.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;
     $(".dataAutocomplet").select2({ width: '100%', placeholder: "Seleccione", allowClear: false });
					$('#puestdispos').modal('hide'); 
					$('#modalArmasAseguradas').modal('show');
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idArma="+idArma+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
		    }
		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	

	}else{


								if(idPuestaDisposicion != ""){


	 								cont = document.getElementById('contModalArmasAseguradas');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalArmasAseguradas.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;
            $(".dataAutocomplet").select2({ width: '100%', placeholder: "Seleccione", allowClear: false });
												$('#puestdispos').modal('hide'); 
												$('#modalArmasAseguradas').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idArma="+idArma+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	 						}


	}

}

function closemodalArmasAseguradas(){
	 $('#puestdispos').modal('show'); 
	 $('#modalArmasAseguradas').modal('hide');
}


function registroArmasAseguradas(idEnlace, tipoArch, b, tipoActualizacion , idArma){
	/// VALIDACIONES ///
	var idEnlace = idEnlace;
	var tipoActualizacion = tipoActualizacion;
	var idArma = idArma;

 var textCatTipoArma = document.getElementById("textCatTipoArma").value;
 if(textCatTipoArma != ""){
 	
 var textCatTipoArma_id = document.getElementById("textCatTipoArma").value;
 
 /*MARCA ARMA*/
 var textCatMarcaArma = document.getElementById("textCatMarcaArma").value;
 if(textCatMarcaArma == ""){
 	var textCatMarcaArma_id = 1;
 }else{
 	var textCatMarcaArma_id = document.getElementById("textCatMarcaArma").value;
 }
 /*CALIBRE*/
 var textCatCalibre = document.getElementById("textCatCalibre").value;
 if(textCatCalibre == ""){
 	var textCatCalibre_id = 1;
 }else{
 	var textCatCalibre_id = document.getElementById("textCatCalibre").value;
 }

 /*ACCESORIO ARMA*/
 var textCatAccesorioArma = document.getElementById("textCatAccesorioArma").value;
 if(textCatAccesorioArma == ""){
 	var textCatAccesorioArma_id = 1;
 }else{
 	var textCatAccesorioArma_id = document.getElementById("textCatAccesorioArma").value;
 }
 /*MARCA CARTUCHOS*/
 var textCatMarcaCartuchos = document.getElementById("textCatMarcaCartuchos").value;
 if(textCatMarcaCartuchos == ""){
 	textCatMarcaCartuchos_id = 1;
 }else{
 	var textCatMarcaCartuchos_id = document.getElementById("textCatMarcaCartuchos").value;
 }
 

 var textObservaciones = $("#textObservacionesArmas").val();

 var textMatricula = document.getElementById("textMatricula").value;

 //// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var tipoMOd= document.getElementById("tipoMOd").value;
	var idMandoPuesta = document.getElementById("idMandoPuesta").value;
	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
	var fechaevento= document.getElementById("fechaevento").value;
	var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
	var calleInputPuesta= document.getElementById("calleInputPuesta").value;
	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		if(numberCallePuesta == ""){ numberCallePuesta = 0; }

	var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;


	var puestaDataPersona = Array();
			    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
			    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
			    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;


			     var jObject={};  
			     for(i in puestaDataPersona){  
			     	jObject[i] = puestaDataPersona[i];   
			     }
			     jObject = JSON.stringify(jObject);
 //// DATA DE LA PUESTA A DISPOSICION /////

				
			$.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroArmasAseguradas.php",
        data: "textCatTipoArma_id="+textCatTipoArma_id+"&textCatMarcaArma_id="+textCatMarcaArma_id+"&textCatCalibre_id="+textCatCalibre_id+
              "&textCatAccesorioArma_id="+textCatAccesorioArma_id+"&textCatMarcaCartuchos_id="+textCatMarcaCartuchos_id+"&textObservaciones="+textObservaciones+
              "&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+
              "&idArma="+idArma+"&textMatricula="+textMatricula,
        success: function(resp){
            

        								var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Arma Registrada Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalArmasAseguradas();

																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, tipoArch, b);

																 }
															}


        }
    });
		}else{
			swal("", "Agregue al menos un tipo de arma.", "warning");
		}

}



////////////////////////////////////// MODAL ARMAS ASEGURADAS  //////////////////////////////////////




function loadDaysMonth(anio, idEnlace, camMes){


		var messelected= document.getElementById("mesPuestaSelected").value;
		var anio= document.getElementById("anioCmasc").value;
		console.log('año es: '+ anio); 		

		cont = document.getElementById('contDays');
		ajax=objetoAjax();

		ajax.open("POST", "format/puestaDisposicion/daysContentSelect.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

					//// RECARGAR CONSULTA DE PUESTAS EN EL MES SELECCIONADO Y PRIMER DIA DEL MES CORRESPONDIENTE
					loadDataPuestDay(anio, idEnlace, camMes);

			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&messelected="+messelected+"&anio="+anio+"&idEnlace="+idEnlace);

}

function reloadDaysMonth(idEnlace){


		var anio = document.getElementById("anioCmasc").value; 
		var messelected = document.getElementById("mesPuestaSelected").value; 		

		cont = document.getElementById('contDays');
		ajax=objetoAjax();

		ajax.open("POST", "format/puestaDisposicion/daysContentSelect.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

					//// RECARGAR CONSULTA DE PUESTAS EN EL MES SELECCIONADO Y PRIMER DIA DEL MES CORRESPONDIENTE
				loadDataPuestDay(anio, idEnlace, 1);
				setTimeout("reloadMonth("+anio+","+idEnlace+","+ messelected+");",100);
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&messelected="+messelected+"&anio="+anio+"&idEnlace="+idEnlace);

}

function reloadMonth(anio, idEnlace,  messelected){
 		
		cont = document.getElementById('contMonth');
		ajax=objetoAjax();

		ajax.open("POST", "format/puestaDisposicion/reloadSelectMonth.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

					//// RECARGAR CONSULTA DE PUESTAS EN EL MES SELECCIONADO Y PRIMER DIA DEL MES CORRESPONDIENTE
				loadDataPuestDay(anio, idEnlace, 1);

			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&messelected="+messelected+"&anio="+anio+"&idEnlace="+idEnlace);

}


function loadDataPuestaSelected(anio, idEnlace, messelected, camMes){

		cont = document.getElementById('tablePuestasData');
		ajax=objetoAjax();

		ajax.open("POST", "format/puestaDisposicion/dataPuestaSelected.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&messelected="+messelected+"&anio="+anio+"&idEnlace="+idEnlace+"&camMes="+camMes);

}

function loadDataPuestDay(anio, idEnlace, camMes){

		var messelected= document.getElementById("mesPuestaSelected").value;
		var diaselected= document.getElementById("diaSeleted").value; 	

	$('#preloaderIMG').show();
 var table = $('#gridPolicia').DataTable();
 $("#gridPolicia").hide();
 table.destroy();
 //$('#preloader').append('<label>Cargando datos...</label><div class="progress"><div class="indeterminate"></div></div>');
 $.ajax({
  type: "POST",
  dataType: 'html',
  url:'format/puestaDisposicion/dataPuestaSelected.php',
  data: "messelected="+messelected+"&anio="+anio+"&idEnlace="+idEnlace+"&diaselected="+diaselected+"&camMes="+camMes,
  success: function(resp){
  	 $('#preloaderIMG').hide();
    $("#gridPolicia").show();
    $("#gridPolicia tbody").html(resp);
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                }
       },
       {
          extend: 'pdfHtml5',
          title: '',
          orientation: 'landscape',
          messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
          exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
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
 });

}

function loadDataPuestDayCurrent(anio, idEnlace, camMes, messelected, diaselected){

 var table = $('#gridPolicia').DataTable();
 $("#gridPolicia").hide();
 table.destroy();
 //$('#preloader').append('<label>Cargando datos...</label><div class="progress"><div class="indeterminate"></div></div>');
 $.ajax({
  type: "POST",
  dataType: 'html',
  url:'format/puestaDisposicion/dataPuestaSelected.php',
  data: "messelected="+messelected+"&anio="+anio+"&idEnlace="+idEnlace+"&diaselected="+diaselected+"&camMes="+camMes,
  success: function(resp){

    $("#gridPolicia").show();
    $("#gridPolicia tbody").html(resp);
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                }
       },
       {
          extend: 'pdfHtml5',
          title: '',
          orientation: 'landscape',
          messageTop: 'Información obtenida del Sistema Integral de Registro Estadístico (SIRE).',
          exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
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
 });

}

function buscarPuesta(idEnlace){

		cont = document.getElementById('contPuestaBusque');
		idPuesta = document.getElementById('idPuestaBusque').value;
		ajax=objetoAjax();

		ajax.open("POST", "format/puestaDisposicion/busquedaPuesta.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&idPuesta="+idPuesta+"&idEnlace="+idEnlace);

}



function cancelAdd() {
	$("#add-more").show();
	$(document).on("click",".ajax-action-links",function(e) {
		e.preventDefault();
		$(this).closest('tr').remove();
		});
}
function editRow(editableObj) {
  $(editableObj).css("background","#FFF");
}

function saveToDatabase(editableObj,column,id) {
  $(editableObj).css("background","#FFF url(cargando.gif) no-repeat right");
  $.ajax({
    url: "editar.php",
    type: "POST",
    data:'column='+column+'&editval='+$(editableObj).text()+'&id='+id,
    success: function(data){
      $(editableObj).css("background","#FDFDFD");
    }
  });
}

function agregarDelito() {
	var jObjectDelitos = {};
	var idPersona = idPersona;
	var idPers = $("#idPers").val();
 var arrDelitos = document.getElementsByName("delitosAct[]");
 	for(i=0;i<arrDelitos.length;i++){ jObjectDelitos[i] = arrDelitos[i].value; }
	//jObjectDelitos = JSON.stringify(jObjectDelitos);
  //alert("ID DE PERSONA: " +  idPers + "ID DELITO" +jObjectDelitos[arrDelitos.length-1]);

  	ajax=objetoAjax();
						ajax.open("POST", "format/puestaDisposicion/actualizarDelito.php");
 
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {		
								//$("#table-body").append(data);
										 var json = ajax.responseText;
										 	 $("#add-more").show();	
													var obj = eval("(" + json + ")");
													if (obj.first == "NO") { swal("", "No se agrego el delito, verifique si no se agregó anteriormente", "warning"); }else{
														 if (obj.first == "SI") {   		
														 $("#addDelitoSec").remove();		
														 $(".txtDelitoDisable").prop("disabled", true);	
														 	var obj = eval("(" + json + ")");
														 	swal("", "Delito agregado exitosamente.", "success");															
														 }
													}
										}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("idPers="+idPers+"&arrDelitosAct="+jObjectDelitos[arrDelitos.length-1]);



/*
	  $.ajax({
		url: "format/puestaDisposicion/actualizarDelito.php",
		type: "POST",
		data:'idPers='+idPers,
		success: function(data){
			 $("#add-more").show();	

			
		  $("#new_row_ajax").remove();
		  $("#add-more").show();		  
		  $("#table-body").append(data);
		}
	  });
*/
}

function addToHiddenField(addColumn,hiddenField) {

	var columnValue = $(addColumn).text();
	$("#"+hiddenField).val(columnValue);
}

function deleteRecord(id) {
	if(confirm("Esta seguro de eliminar el registro?")) {
		$.ajax({
			url: "borrar.php",
			type: "POST",
			data:'id='+id,
			success: function(data){
			  $("#table-row-"+id).remove();
			}
		});
	}
}

/*
$(document).ready( function () {
  var table = $('#example').DataTable();
} );
*/

/******+ADMINISTRACION MANDOS******/

function getDataMandosTableAdm(filtroBusqueda){
	switch (filtroBusqueda){
		case 'busqMando' :
			var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
			var newBrwosers_id= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;		
		break;
		case 'busqAreaAdscr' :
		document.getElementById("newBrwoser").value = "";	
			var newBrwosers_id = 0;
		break;
	}

	 var areaAdsc = document.getElementById("areaAdsc").value;
		cont = document.getElementById('tablePuestasDataMandoBody');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/dataMandoTableAdm.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id+"&filtroBusqueda="+filtroBusqueda+"&areaAdsc="+areaAdsc);

}

function showModalEditarMando(idMando){
	cont = document.getElementById('contModalModuloAdministracion');
	ajax=objetoAjax();
	ajax.open("POST", "format/puestaDisposicion/modalModuloAdministracion.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			$('#modalModuloAdministracion').modal('show');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idMando="+idMando);
}

function closeModalEditarMando(){
	$('#modalModuloAdministracion').modal('hide');
}

function closeModalEditarMando(){
	$('#modalModuloAdministracionADDMando').modal('hide');
}

function actualizarMandos(idMando){
	var getNombreMando = document.getElementById("admNombreMando").value;
	var getApPaterno = document.getElementById("admApPaterno").value;
	var getApMaterno = document.getElementById("admApMaterno").value;
	var idCargo = document.getElementById("admCargo").value;
	var idFuncion = document.getElementById("admFuncion").value;
	var idAreaAdscripcion = document.getElementById("admAreaAdscripcion").value;
	var getEstatusMando = document.getElementById("admEstatusMando").value;
 document.getElementById("newBrwoser").value = "";

	if(getNombreMando != "" && getApPaterno != "" && getApMaterno && idCargo != 0 && idFuncion != 0 && idAreaAdscripcion != 0 && getEstatusMando != 0){
		cont = document.getElementById('tablePuestasDataMandoBody');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/admActualizarMandos.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				$('#modalModuloAdministracion').modal('hide');
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&getNombreMando="+getNombreMando+"&getApPaterno="+getApPaterno+"&getApMaterno="+getApMaterno+"&idCargo="+idCargo+"&idFuncion="+idFuncion+
			          "&idAreaAdscripcion="+idAreaAdscripcion+"&idMando="+idMando+"&getEstatusMando="+getEstatusMando);
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function showModalNuevoMando(idMando){
	cont = document.getElementById('contModalModuloAdministracionADDMando');
	ajax=objetoAjax();
	ajax.open("POST", "format/puestaDisposicion/modalModuloAdministracionADDMando.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			$('#modalModuloAdministracionADDMando').modal('show');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idMando="+idMando);
}

function agregarMando(){
 var getNombreMando = document.getElementById("addNombreMando").value;
	var getApPaterno = document.getElementById("addApPaterno").value;
	var getApMaterno = document.getElementById("addApMaterno").value;
	var idCargo = document.getElementById("addCargo").value;
	var idFuncion = document.getElementById("addFuncion").value;
	var idAreaAdscripcion = document.getElementById("addAreaAdscripcion").value;

 if(getNombreMando != "" && getApPaterno != "" && getApMaterno && idCargo != 0 && idFuncion != 0 && idAreaAdscripcion != 0){
 	cont = document.getElementById('tablePuestasDataMandoBody');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/admAgregarNuevoMando.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				$('#modalModuloAdministracionADDMando').modal('hide');
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&getNombreMando="+getNombreMando+"&getApPaterno="+getApPaterno+"&getApMaterno="+getApMaterno+"&idCargo="+idCargo+"&idFuncion="+idFuncion+
			          "&idAreaAdscripcion="+idAreaAdscripcion);
 }else{
 	swal("", "Faltan datos por registrar.", "warning");
 }
}                      

function getDataMandosdataList(){
	cont = document.getElementById('newBrwosers');
	ajax=objetoAjax();
	ajax.open("POST", "format/puestaDisposicion/admGetDataMandosdataList.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send();
}


function downloadExcelReport() {

	var month = document.getElementById('mesPuestaSelected').value;
	var year = document.getElementById('anioCmasc').value;
	
	var data = [];

	generalDataFiscalias(month, year, data);

}

function generalDataFiscalias(month, year, data) {


	$.ajax({  
		type: "POST",  
		url: "format/puestaDisposicion/excel/service/get_data_fiscalias.php", 
		data: "month="+month+
			"&year="+year,
		success: function(response){
			data['general_data'] = response;
			arrestedsByFiscalia(month, year, data);
		}  
	});

}

function arrestedsByFiscalia(month, year, data) {

	$.ajax({  
		type: "POST",  
		url: "format/puestaDisposicion/excel/service/get_count_arresteds_by_crime_and_fiscalia.php", 
		data: "month="+month+
			"&year="+year,
		success: function(response){
			data['arresteds_by_fiscalia'] = response;
			drugsByFiscalia(month, year, data);
		}  
	});

}

function drugsByFiscalia(month, year, data) {

	$.ajax({  
		type: "POST",  
		url: "format/puestaDisposicion/excel/service/get_count_drugs_by_drug_type_and_fiscalia.php", 
		data: "month="+month+
			"&year="+year,
		success: function(response){
			data['drugs_by_fiscalia'] = response;
			weaponsByFiscalia(month, year, data);
		}  
	});

}

function weaponsByFiscalia(month, year, data) {

	$.ajax({  
		type: "POST",  
		url: "format/puestaDisposicion/excel/service/get_count_weapons_by_weapon_type_and_fiscalia.php", 
		data: "month="+month+
			"&year="+year,
		success: function(response){
			data['weapons_by_fiscalia'] = response;
			injunctionsByFiscalia(month, year, data);
		}  
	});

}

/*
function vehiclesByFiscalia(month, year, data) {

	$.ajax({  
		type: "POST",  
		url: "format/puestaDisposicion/excel/service/get_count_vehicles_by_vehicle_type_and_fiscalia.php", 
		data: "month="+month+
			"&year="+year,
		success: function(response){
			data['vehicles_by_fiscalia'] = response;
			injunctionsByFiscalia(month, year, data);
		}  
	});

}
*/

function injunctionsByFiscalia(month, year, data) {

	$.ajax({  
		type: "POST",  
		url: "format/puestaDisposicion/excel/service/get_count_injunctions_by_crime_and_fiscalia.php", 
		data: "month="+month+
			"&year="+year,
		success: function(response){
			data['injunctions_by_fiscalia'] = response;
			bandsByFiscalia(month, year, data);
		}  
	});

}

function bandsByFiscalia(month, year, data) {

	$.ajax({  
		type: "POST",  
		url: "format/puestaDisposicion/excel/service/get_count_bands_by_crime_and_fiscalia.php", 
		data: "month="+month+
			"&year="+year,
		success: function(response){
			data['bands_by_fiscalia'] = response;
			vehiclesByFiscalia(month, year, data);
		}  
	});

}

function vehiclesByFiscalia(month, year, data) {

	$.ajax({  
		type: "POST",  
		url: "format/puestaDisposicion/excel/service/get_count_vehicle_data_by_fiscalia.php", 
		data: "month="+month+
			"&year="+year,
		success: function(response){
			data['vehicle_data_by_fiscalia'] = response;
			motociclesByFiscalia(month, year, data);
		}  
	});

}

function motociclesByFiscalia(month, year, data) {

	$.ajax({  
		type: "POST",  
		url: "format/puestaDisposicion/excel/service/get_count_motocicle_data_by_fiscalia.php", 
		data: "month="+month+
			"&year="+year,
		success: function(response){
			data['motocicle_data_by_fiscalia'] = response;
			createExcelReport(month, year, data);
		}  
	});

}

function createExcelReport(month, year, data) {

	$.ajax({
		type: "POST",
		dataType: 'json',
		url: "format/puestaDisposicion/excel/report.php",
		data: "month="+month+
			"&year="+year+
			"&general_data="+data.general_data+
			"&arresteds_by_fiscalia="+data.arresteds_by_fiscalia+
			"&drugs_by_fiscalia="+data.drugs_by_fiscalia+
			"&weapons_by_fiscalia="+data.weapons_by_fiscalia+
			//"&vehicles_by_fiscalia="+data.vehicles_by_fiscalia+
			"&injunctions_by_fiscalia="+data.injunctions_by_fiscalia+
			"&bands_by_fiscalia="+data.bands_by_fiscalia+
			"&vehicle_data_by_fiscalia="+data.vehicle_data_by_fiscalia+
			"&motocicle_data_by_fiscalia="+data.motocicle_data_by_fiscalia,
	   	}).done(function(data){
		  var $a = $("<a>");
		  $a.attr("href",data.file);
		  $("body").append($a);
		  $a.attr("download","reporte.xlsx");
		  $a[0].click();
		  $a.remove();
	});

}
//Valida texto de la narracion
function contCharTextBox() {
  var limit = 5000;
  $("#textNarracion").attr('maxlength', limit);
  var init = $("#textNarracion").val().length;
  
  if(init<limit){
    init++;
    $('#caracteres').text("Máximo 5000 caracteres:" + init); 
  }
}


//Validar campo NUC
function validateNuc(object){
	if (object.value.length > object.maxLength){
		object.value = object.value.slice(0, object.maxLength)
	}
}


function closeModalPueDispo(){
	$('#puestdispos').modal('hide');
}

function checkDateInforme(fecha){
	var fechaEvento = document.getElementById("fechaevento").value; 
	if(Date.parse(fecha) < Date.parse(fechaEvento)){
		swal("", "La fecha del evento no puede ser mayor a la fecha del informe.", "warning");	
		document.getElementById("fechaevento").value = ''; 
	}
}

//Funcion para validar cuando el tipo de automovil es un remolque, accesorio o agroindustriales no se requerira ingresar marca
function checkClasificacion(){
	var selClasific = document.getElementById("selClasific").value; 
	var flag = 0;
	if(selClasific == 5 || selClasific == 6 || selClasific == 7 ){
			$("#newMarca").select2();
	 	$('#newMarca').val('141').trigger('change.select2');
	 	$("#newMarca").prop("disabled", true);
	 	$("#newLinea").select2();
	 	$('#newLinea').val('945').trigger('change.select2');
	 	$("#newLinea").prop("disabled", true);
	 	$("#newTypeMarca").select2();
	 	$('#newTypeMarca').val('130').trigger('change.select2');
	 	$("#newTypeMarca").prop("disabled", true);
	 	flag = 1;
	}else{
		if($('#newMarca').is(':disabled')){
    $("#newMarca").select2();
				$("#newMarca").prop("disabled", false);
				$('#newMarca').val('1').trigger('change.select2');
				$("#newLinea").prop("disabled", false);
				$("#newTypeMarca").prop("disabled", false);
				$('#newTypeMarca').val('1').trigger('change.select2');
			}
	}
}

////////////////////////////////////// MODAL PERSONAL DE APOYO //////////////////////////////////////


function modalPersonalApoyo(tipoMOd, idEnlace, personalApoyo_id, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	

	if(idPuestaDisposicion == ""  ){

	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
	if(validar){

		var newBrwosers_id = document.getElementById("newBrwosers_id").value;

		var newBrwosers_id_fisca=  document.getElementById("newBrwoserFisca").value;
		var newBrwosers_id_mun= document.getElementById("newBrwoserMun").value;
		var newBrwosers_id_colo= document.getElementById("newBrwoserColo").value;

		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

		 var uno = document.getElementById("acepto1").checked;
			var dos = document.getElementById("acepto2").checked;
			var tres = document.getElementById("acepto3").checked;
		 var cuatro = document.getElementById("acepto4").checked;
			var cinco = document.getElementById("acepto5").checked;
			var narac= document.getElementById("textNarracion").value;




		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; 

			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuatro; puestaData[15] = cinco; puestaData[16] = narac;


			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);

	
	    /*Validamos si ha llenado el formulario*/    
	    if(idPuestaDisposicion == ""  ){
	    	cont = document.getElementById('contModalPersonalApoyo');
			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/modalPersonalApoyo.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;
						$('.dataAutocomplet').select2({
																																	    width: '100%',
																																	    placeholder: "Seleccione",
                                     allowClear: false
																																	});
					$('#puestdispos').modal('hide'); 
					$('#modalPersonalApoyo').modal('show');
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&personalApoyo_id="+personalApoyo_id+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
		    }
		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	

	}else{



					if(idPuestaDisposicion != ""){


	 								cont = document.getElementById('contModalPersonalApoyo');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalPersonalApoyo.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;
													$('.dataAutocomplet').select2({
																																	    width: '100%',
																																	    placeholder: "Seleccione",
                                     allowClear: false
																																	});
												$('#puestdispos').modal('hide'); 
												$('#modalPersonalApoyo').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&personalApoyo_id="+personalApoyo_id+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	 						}


	}
}

function closemodalPersonalApoyo(){
	 $('#puestdispos').modal('show'); 
	 $('#modalPersonalApoyo').modal('hide');
}

function getDataPersonalApoyo(){
		var mando_ID = document.getElementById("mando_ID").value;		

		cont = document.getElementById('contDataPersonalApoyo');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/dataPersonalApoyo.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&mando_ID="+mando_ID);

}

///////////////// REGISTRO OBJETO ASEGURADO //////////



function registroPersonalApoyo(idEnlace, typearch, b, tipoActualizacion , personalApoyo_id){

	
	/// VALIDACIONES ///
	var idEnlace = idEnlace;
var tipoActualizacion = tipoActualizacion;
	var personalApoyo_id = personalApoyo_id;
	

	var mando_ID = $("#mando_ID").val();
	var cargoPersonalApoyo = $("#cargoPersonalApoyo").val();
	var funcionPersonalApoyo = $("#funcionPersonalApoyo").val();
	var adscPersonalApoyo = $("#adscPersonalApoyo").val();

	if(mando_ID != "" && cargoPersonalApoyo != "" && funcionPersonalApoyo != "" && adscPersonalApoyo != "" ){

	//// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var tipoMOd= document.getElementById("tipoMOd").value;

	var idMandoPuesta = document.getElementById("idMandoPuesta").value;
	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
	var fechaevento= document.getElementById("fechaevento").value;
	var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
	var calleInputPuesta= document.getElementById("calleInputPuesta").value;
	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
	if(numberCallePuesta == ""){ numberCallePuesta = 0; }

var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;



	var puestaDataPersona = Array();
			    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
			    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
			    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;			   


			     var jObject={};  
			     for(i in puestaDataPersona){  
			     	jObject[i] = puestaDataPersona[i];   
			     }
			     jObject = JSON.stringify(jObject);
 //// DATA DE LA PUESTA A DISPOSICION /////

					
			$.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroPersonalApoyo.php",
        data: "mando_ID="+mando_ID+"&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&personalApoyo_id="+personalApoyo_id,
        success: function(resp){
            var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Personal de apoyo registrado exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalPersonalApoyo();

																		showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}
        }
    });
		}else{
			swal("", "Faltan datos por ingresar.", "warning");
		}

		}

//FUNCION PARA VALIDAR LOS CAMPOS, varchar, int
function validaInput_puestaDispo(e, tipo) {
    var key = e.keyCode || e.which;
    var tecla = String.fromCharCode(key).toLowerCase();
    if(tipo == 'varchar_letras'){ var letras = "abcdefghijklmnopqrstuvwxyz"; }
    if(tipo == 'varchar_letras_numeros'){ var letras = "abcdefghijklmnopqrstuvwxyz1234567890.,/"; }
    if(tipo == 'int'){ var letras = "1234567890"; }

    var especiales = [8, 37, 39, 46, 110, 32];
    var tecla_especial = false;

    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true; 
        break;
      }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      return false;
    }

    if (e.length > e.maxLength){
    	e.value = e.value.slice(0, e.maxLength)
    }
  }