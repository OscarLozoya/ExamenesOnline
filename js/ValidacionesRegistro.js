/**
*Script para validar el formulario para restablecer contrasena
*@autor Pérez Plascencia Gerardo Noé
*@version 1.0
*/

/**
*Verifica que el campo correo no este vacio y este en un formato adecuado
*/
function ValidaRegistro()
{
	var usuario=$('input#NomUser');
	if(!notEmpty(usuario.val()))
	{
		var MensajeUsuario=$('#MensajeUsuario');
		MensajeUsuario.css('display','block');
		return false;
	}
	else
	{
		var correo=$('input#CorreoElec');
		
		if(!notEmpty(correo.val()))
		{
			var MensajeContrasena=$('#MensajeCorreo');
			MensajeContrasena.css('display','block');
			return false;
		}
		else
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
	}
}
/**
*Limpiar caja de texto del correo electronico y usuario
*/
function Cancelar()
{
	$('input#CorreoElec').val('');	
	$('input#CorreoElec').val('');
}
/**
*Oculta el mensaje de error de que no ingreso el nombre de usuario
*/
function CambioUsuario()
{
	$('#MensajeUsuario').css('display','none');
}
/**
*Oculta el mensaje de error sobre el correo incorrecto
*/
function CambioCorreo()
{
	$('#MensajeCorreo').css('display','none');
}