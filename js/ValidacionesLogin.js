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

function CambioUsuario()
{
	var MensajeUsuario=$('#MensajeUsuario');
	MensajeUsuario.css('display','none');
}

function CambioContrasena()
{
	var MensajeContrasena=$('#MensajeContrasena');
	MensajeContrasena.css('display','none');
}