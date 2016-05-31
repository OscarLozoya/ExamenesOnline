/**
*@fileoverview Script para validar el formulario para restablecer contrasena
*@autor Pérez Plascencia Gerardo Noé
*@version 1.0
*/

/**
*Verifica que el campo correo no este vacio y este en un formato adecuado
*/
function ValidacionCorreo()
{
	var correo=$('#CorreoElec');
	if(notEmpty(correo.val()))
	{
			return true;
	}
	else
	{
		var MensajeCorreo=$("#MensajeCorreo");
			MensajeCorreo.css('display','block');
			return false;
	}
}
/**
*Limpiar caja de texto del correo electronico
*/
function Cancelar()
{
	window.location="index.php";
	$('input#CorreoElec').val('');	
}
/**
*Oculta el mensaje de error de que no ingreso el correo
*/
function CambioCorreo()
{
	$('#MensajeCorreo').css('display','none');
}
function ValidaPassword()
{
	var Contrasena = $('input#contrasena_nueva');
	var ContrasenaConf = $('input#contrasena_confirmacion');
	var error = false;
	Elimina_Error('ErrorContra');
	if(!notEmpty(Contrasena.val()) || !notEmpty(ContrasenaConf.val()))
			MuestraError('label','Falta Especificar su contraseña',ContrasenaConf,'ErrorContra');
	else
		{
			if(Contrasena.val() == ContrasenaConf.val())
				error = true;
			else
				MuestraError('label','Las contraseñas no coinciden favor de verificar ',ContrasenaConf,'ErrorContra');
		}
	return error;
}

/**
*Funcion para insertar elementos HTML para mostrar errores al verificar los parametros.
*@param {String} TipoCont Elemento que se quiere insertar regularmente label.
*@param {String} Mensaje Cadena String que se quiere mostrar como error.
*@param {ElementDOM} DespuesDe Elemento que se toma de referencia para insertar el mensaje despues de este.
*@param {String}  IdElement Id del elemento insertado.
*@return {Void}
*/
function MuestraError(TipoCont,Mensaje,DespuesDE,IdElement)
{
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
function Elimina_Error(cad)
{
	$('#'+cad).remove();
}