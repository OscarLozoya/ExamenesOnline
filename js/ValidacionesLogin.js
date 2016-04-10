/**
*@fileoverviewe Script para validar la parte de Modificar y Eliminar un Examen
*@autor José Alberto Suárez Carrillo
*@version 1.0
*/

/**
*Verifica que el usuario y la contraseña esten escritos
*/
function ValidaLogin()
{
	var usuario=$('input#usuario');
	if(!notEmpty(usuario.val()))
	{
		var MensajeUsuario=$('#MensajeUsuario');
		MensajeUsuario.css('display','block');
		return false;
	}
	else
	{
		var contrasena=$('input#contrasena');
		usuario.css('background-color','white');
		if(!notEmpty(contrasena.val()))
		{
			var MensajeContrasena=$('#MensajeContrasena');
			MensajeContrasena.css('display','block');
			return false;
		}
		else
			return true;
	}
}

/**
*Oculta el mensaje de error de que no ingreso el usuario
*/
function CambioUsuario()
{
	$('#MensajeUsuario').css('display','none');
}

/**
*Oculta el mensaje de error cuando no ingreso la contraseña
*/
function CambioContrasena()
{
	$('#MensajeContrasena').css('display','none');
}