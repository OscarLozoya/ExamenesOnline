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