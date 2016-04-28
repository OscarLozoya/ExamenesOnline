/**
*Script para validar el formulario para restablecer contrasena
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
		if(ValidaCorreo(correo.val()))
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
	$('input#CorreoElec').val('');	
}
/**
*Oculta el mensaje de error de que no ingreso el correo
*/
function CambioCorreo()
{
	$('#MensajeCorreo').css('display','none');
}
