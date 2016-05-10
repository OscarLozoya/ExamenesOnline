/**
*@fileoverviewe Script para validar los formularios de Completar Registro y posible compatibilidad con Perfil
*@autor Oscar Ivan Lozoya Rodriguez
*@version 1.3
*/

/**
*Funcion principal para validar el submit
*/
function Valida_Campos(){
	alert("TROOO");
	var error=true;
	var errorD=true;//Variable para  Datos personales se inicia en true indicando que hay un error por seguridad
	var errorT=true;//Variable para  Telefonos se inicia en true indicando que hay un error por seguridad
	var errorR=true;//Variable para  Redes Sociales se inicia en true indicando que hay un error por seguridad
	var errorA=true;//Variable para  Datos Academicos se inicia en true indicando que hay un error por seguridad
	$('label.Warning').remove();
	errorD = Valida_Datos_Personales();
	errorT = ValidaTelefono();
	errorR = ValidaRedSocial();
	errorA = Valida_Datos_Academicos();
	if(errorD || errorT || errorR || errorA)
		error=true;
	else
		error=false;
	alert("se encontro que error es :" + error);
	alert("se encontro que error (con !)es :" + !error);
	return !error;//Se devuelve lo contrario pues un error=true indica que se encontraron errores y para detener el submit se detiene con false
}

/**
*Verifica que los campos de Nombre, Apellido Paterno y Apellido Materno y Contraseña
*esten escritos y bajo formato aceptable.
*/
function Valida_Datos_Personales(){
	var Nombre=$('input#Name');
	var ApPat=$('input#ApeP');
	var ApMat=$('input#ApeM');
	var password = $('input#passwordUser');
	//Se asume que existe algun error se inicializa en 4 pues son los campos a validar
	var errores=4;
	if(!notEmpty(Nombre.val()))
		MuestraError('label',"*Debes de ingresar tu Nombre",Nombre,"ErrorName");
	else if(!ValidaLetras(Nombre.val()))
		MuestraError('label',"*Caracter No Valido",Nombre,"ErrorName");
	else
		errores--;//No error en este campo se resta la validacion de este.
	if(!notEmpty(ApPat.val()))
		MuestraError('label',"*Debes de ingresar tu Apellido Paterno",ApPat,"ErrorApeP");
	else if(!ValidaLetras(ApPat.val()))
			MuestraError('label',"*Debes de ingresar tu Apellido Paterno",ApPat,"ErrorApeP");
	else
		errores--;
	if(!notEmpty(ApMat.val()))
		MuestraError('label',"*Debes de ingresar tu Apellido Materno",ApMat,"ErrorApeM");
	else if(!ValidaLetras(ApMat.val()))
		MuestraError('label',"*Debes de ingresar tu Apellido Paterno",ApMat,"ErrorApeM");
	else
		errores--;
	if(!notEmpty(password.val()))
		 MuestraError('label','Falta Especificar contraseña',password,'ErrorPromedio');
	else
		 errores--;
	return (errores==0)? false:true;//la bandera sera 0 si los campos no presentan error 
}

/**Falta Documentar
**/
function ValidaTelefono(){
		var errores=0;//Esta bandera aumenta si encuentra algun error
		var Telefono=$('input#Telefono');
		for (var i = 0; i<= Telefono.size()-1; i++) {
			if(!notEmpty(Telefono.eq(i).val())){
				MuestraError('label','No puedes dejar este campo vacio',Telefono.eq(i).parent(),'ErrorTelefono');
				errores++;
			}
			else if(Telefono.eq(i).val().length<8){
				MuestraError('label','Verifica el Telefono',Telefono.eq(i).parent(),'ErrorTelefono');
				errores++;
			}
		};

		return (errores==0)? false:true;//Si la bandera no se modifico regresa false de error no encontrado
}

/* Falta Documentar
*/
function ValidaRedSocial(){
	var errores=0;//Esta bandera aumenta si encuentra algun error
	var URL=$('input#URLred');
	for (var i = 0; i<= URL.size() - 1;  i++) {
		if(!notEmpty(URL.eq(i).val())){
			 MuestraError('label','No puedes dejar este campo vacio',URL.eq(i).parent(),'ErrorRed')
			 errores++;
		}
		else if(!ValidaUrl(URL.eq(i).val())){
				errores++;	
				MuestraError('label','Verifique Formato de la URL',URL.eq(i).parent(),'ErrorRed');
		}		
	};
	return (errores==0)? false:true;//Si la bandera no se modifico regresa false de error no encontrado
}

function Valida_Datos_Academicos(){
	var Universidad = $('input#Universidad');
	var Carrera = $('input#Carrera');
	var Promedio = $('input#Promedio');
	var Tiempo = $('input#Tiempo');
	var errores = 0;//Esta bandera aumenta si encuentra algun error
	if(!notEmpty(Universidad.val())){
		MuestraError('label','No puedes dejar este campo vacio',Universidad,'ErrorUniversidad');
		errores++;
	}
	else if(!ValidaLetras(Universidad.val())){
		errores++;
		MuestraError('label','Solo se aceptan letras',Universidad,'ErrorUniversidad');
	}
	if(!notEmpty(Carrera.val())){
		MuestraError('label','No puedes dejar este campo vacio',Carrera,'ErrorCarrera');
		errores++;
	}
	else if(!ValidaLetras(Carrera.val())){
		errores++;
		MuestraError('label','Solo se aceptan letras',Carrera,'ErrorCarrera');
	}
	if(!notEmpty(Promedio.val())){
		 MuestraError('label','Falta Promedio',Promedio,'ErrorPromedio');
		 errores++;
	}
	if(!notEmpty(Tiempo.val())){
		 MuestraError('label','Falta Especificar',Tiempo,'ErrorPromedio');
		 errores++;
	}
	return (errores==0)?false:true;//Si la bandera no se modifico regresa false de error no encontrado
}

/**Falta documentar
funcion para onchange
*/

function ValidaTiempo(){
	var Tiempo=$('input#Tiempo');
	var Periodo=$('select#OpcTiempo');
	if((Periodo[0].value=='Semestres' && !ValidaUpDown(Tiempo.val(),1,18)) || (Periodo[0].value=='Años' && !ValidaUpDown(Tiempo.val(),1,9)))
     Tiempo.val(1);
}
/*Falta documentar
*/
function CambiaPeriodo(){
	var Tiempo=$('input#Tiempo');
	var Periodo=$('select#OpcTiempo');
	if(Periodo[0].value=='Semestres')
		Tiempo.val(Tiempo.val()*2);
	else
		Tiempo.val(Math.ceil(Tiempo.val()/2));
}
function ValidaProm(){
	var Promedio=$('input#Promedio');
	Elimina_Error('ErrorPromedio');
	if(!ValidaUpDown(Promedio.val(),0,100))
		Promedio.val('0');
}

/*Falta documentar
*/
function Valida_Horario(Inicio,Fin){
	var desde=$('select#'+Inicio);
	var hasta=$('select#'+Fin);
	if(!ValidaHorario(desde.val(),hasta.val()))
		desde[0].value="00:00";

}
/*Falta documentar
*/
function campoNumerico(id){
	var ej=$(id);
	if(!ValidaNumerico(ej.val()))
			ej.val("");

}
/**
*Funcion para insertar elementos HTML para mostrar errores al verificar los parametros.
*@param {String} TipoCont Elemento que se quiere insertar regularmente label.
*@param {String} Mensaje Cadena String que se quiere mostrar como error.
*@param {ElementDOM} DespuesDe Elemento que se toma de referencia para insertar el mensaje despues de este.
*@param {String}  IdElement Id del elemento insertado.
*@return {Void}
*/
function MuestraError(TipoCont,Mensaje,DespuesDE,IdElement){
	var etiq= document.createElement(TipoCont);
	var mns=document.createTextNode(Mensaje);
	etiq.appendChild(mns);
	etiq.setAttribute('id',IdElement);
	etiq.setAttribute('class','Warning');
	etiq.setAttribute('style','display: block');
	document.body.appendChild(etiq);
	DespuesDE.after(etiq);

}
/**
*Funcion para eliminar los elementos que muestrar errores
*@param {String} IdElement Id del elemento a eliminar*
*@return {Void}*/
function Elimina_Error(cad){
	$('#'+cad).remove();
}

/**
*/
function NuevaRedSocial(){
	var NodoPadre=$('div#EspRedSocial');
	var NuevoNodo=NodoPadre.clone();
	NuevoNodo.attr('id','EspRedSocialCopy');
	NuevoNodo.find('#URLred').val('');
	NuevoNodo.find('#BtnMore').addClass('btn-danger');
	NuevoNodo.find('#BtnMore').attr('onclick','EliminarSubNodoURL(this)').attr('data-tooltip','Eliminar Red Social');
	NuevoNodo.find('#iconBtnMore').removeClass('glyphicon-plus').addClass('glyphicon-minus');
	NuevoNodo.find('label.Warning').remove();
	if(NodoPadre.siblings().size()==1)
		NodoPadre.after(NuevoNodo);
	else
		NodoPadre.siblings().last().after(NuevoNodo);
}

/**
*/
function NuevoTelefono(){
	var NP=$('#EspTelefono');
	var NN=NP.clone();
	NN.attr('id','EspTelefonoCopy');
	NN.find('#BtnMoreTel').addClass('btn-danger');
	NN.find('#BtnMoreTel').attr('onclick','EliminarSubNodoTel(this)').attr('data-tooltip','Eliminar Telefono');
	NN.find('#iconBtnMoreTel').removeClass('glyphicon-plus').addClass('glyphicon-minus');
	NN.find('label.Warning').remove();
	NN.find('#Telefono').val('');
	if(NP.siblings().size()==2)
		NP.after(NN);
	else 
		NP.siblings().last().after(NN);
}

/**
*Funcion para eliminar los campos url que no se necesiten
*@param {Elemento} refnod referencia al objeto que lo llamo usando this en su llamada
*/
function EliminarSubNodoURL(refnod){
	 $(refnod).parent().parent().parent().remove();
}

/**
*Funcion para eliminar los campos telefono que no se necesiten
*@param {Elemento} refnod referencia al objeto que lo llamo usando this en su llamada
*/
function EliminarSubNodoTel(refnod){
	 $(refnod).parent().parent().parent().parent().remove();
}
