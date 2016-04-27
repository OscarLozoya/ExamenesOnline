/**
*@fileoverviewe Script para validar los formularios de Completar Registro y posible compatibilidad con Perfil
*@autor Oscar Ivan Lozoya Rodriguez
*@version 1.2
*/

/**
*Verifica que los campos de Nombre, Apellido Paterno y Apellido Materno 
*esten escritos y bajo formato solo letras y algun espacio
*/
function Valida_Campos(){
	var error=true;
	error = Valida_Datos_Personales();
	ValidaTelefono();
	return !error;
}

function Valida_Datos_Personales(){
	var Nombre=$('input#Name');
	var ApPat=$('input#ApeP');
	var ApMat=$('input#ApeM');
	var error=false;
	if(!notEmpty(Nombre.val()))
	{
		Elimina_Error("ErrorName");
		MuestraError('label',"*Debes de ingresar tu Nombre",Nombre,"ErrorName");
		error=true;
	}
	else
	{
		if(!ValidaLetras(Nombre.val())){
			Elimina_Error("ErrorName");
			MuestraError('label',"*Caracter No Valido",Nombre,"ErrorName");
			error=true;
		}

	}
	if(!notEmpty(ApPat.val()))
	{
		Elimina_Error("ErrorApeP");
		MuestraError('label',"*Debes de ingresar tu Apellido Paterno",ApPat,"ErrorApeP");
		error=true;
	}
	else
	{
		if(!ValidaLetras(ApPat.val()))
		{
			Elimina_Error("ErrorApeP");
			MuestraError('label',"*Debes de ingresar tu Apellido Paterno",ApPat,"ErrorApeP");
			error=true;
		}

	}
	if(!notEmpty(ApMat.val()))
	{
		Elimina_Error("ErrorApeM");
		MuestraError('label',"*Debes de ingresar tu Apellido Materno",ApMat,"ErrorApeM");
		error=true;
	}
	else
	{
		if(!ValidaLetras(ApMat.val()))
		{
			Elimina_Error("ErrorApeM");
			MuestraError('label',"*Debes de ingresar tu Apellido Paterno",ApMat,"ErrorApeM");
			error=true;
		}

	}
	return (error)?false:true;//(error==true)?false:true;
}

/**
*Funcion a desarrollar conforme a la validacion general del participante gerarno*/
function ValidaTelefono(){
		var Telefono=$('input#Telefono');
		var Tel=$('#EspTelefono');
		for (var i = Telefono.size() - 1; i >= 0; i--) {
			if(!notEmpty(Telefono.eq(i).val())){
				Elimina_Error('ErrorTelefono');
				MuestraError('label','No puedes dejar este campo vacio',Telefono.eq(i),'ErrorTelefono');
			}
			else{
				ValidaNumerico(Telefono.eq(i).val());
			}
		};
		
		//alert(!notEmpty(Telefono.val()));
		//Telefono.foreach(prueba(Tel));
}

function prueba(id){
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
**/
function EliminarSubNodoURL(onj){
	 $(onj).parent().parent().parent().remove();
}

/**
*/
function EliminarSubNodoTel(onj){
	 $(onj).parent().parent().parent().parent().remove();
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
	if(NodoPadre.siblings().size()==1)
		NodoPadre.after(NuevoNodo);
	else
		NodoPadre.siblings().last().after(NuevoNodo);
}

/**
*/
function NuevoTelefono(){
	var NP=$('div#EspTelefono');
	var NN=NP.clone();
	NN.attr('id','EspTelefonoCopy');
	NN.find('#BtnMoreTel').addClass('btn-danger');
	NN.find('#BtnMoreTel').attr('onclick','EliminarSubNodoTel(this)').attr('data-tooltip','Eliminar Telefono');
	NN.find('#iconBtnMoreTel').removeClass('glyphicon-plus').addClass('glyphicon-minus');
	NN.find('#Telefono').val('');
	if(NP.siblings().size()==2)
		NP.after(NN);
	else 
		NP.siblings().last().after(NN);
}
