function ValidaLogin()
{
	var usuario=$('input#usuario');
	if(!notEmpty(usuario.val()))
	{
		usuario.css('background-color','red');
		usuario.attr('placeholder','Ingresa el Usuario');
		return false;
	}
	else
	{
		var contrasena=$('input#contrasena');
		usuario.css('background-color','white');
		if(!notEmpty(contrasena.val()))
		{
			contrasena.css('background-color','red');
			contrasena.attr('placeholder','Ingresa la Contraseña');
			return false;
		}
		else
			return true;
	}
}

function valAgregarCategoria()
{
	var categoria=$('select#categoria');
	if(!notEmpty(categoria[0].value))
		alert("Debes de seleccionar una categoria");
}
function OpcionRespuesta()
{
	var option=$('select#tipo');
	var respuestas=$('div#respuestaOpciones');
	if(option[0].value=='Abierta')		
		respuestas.css('display','none');
	else
		respuestas.css('display','block');
}

function ValidaAgregarPregunta()
{
	var respuestas=$('table#Respuestas');
	
}

function notEmpty(cadena)
{
	if(cadena!="")
		return true;
	else
		return false
}

function ValidaCorreo(correo)
{
	 var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	 if(expr.test(correo))
	 	return true;
	 else
	 	return false;
}

function ValidaUrl(url)
{
	var expr = /^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi;
 	if(expr.test(url))
	 	return true;
	 else
	 	return false;
}

function ValidaHorario(desde,hasta)
{
	if(desde<hasta)
		return true;
	 else
	 	return false;
}