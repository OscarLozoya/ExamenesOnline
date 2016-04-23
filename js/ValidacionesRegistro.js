/**
*@fileoverviewe Script para validar los formularios de Completar Registro y posible compatibilidad con Perfil
*@autor Oscar Ivan Lozoya Rodriguez
*@version 1.2
*/

/**
*Verifica que los campos de Nombre, Apellido Paterno y Apellido Materno 
*esten escritos y bajo formato solo letras y algun espacio
*/
function Valida_Campos_Nombres(){
	var error=true;
	error = Valida_Datos_Personales();
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