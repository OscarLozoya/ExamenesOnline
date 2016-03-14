function ValidaCorreo(correo)
{
	 var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	 if(!expr.test(correo))
	 	console.log("mal correo");
}

function ValidaUrl(url)
{
	var expr = /^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi;
 	if(!expr.test(url))
	 	console.log("mal url");
}

function ValidaHorario(desde,hasta)
{
	if(desde>hasta)
		console.log("desde mayor a hasta");
}