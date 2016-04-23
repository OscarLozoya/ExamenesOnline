/**
*Verifica si una cadena esta vacia o no.
*@param {String} Cadena a validar
*@returns {Bool} Verdadero si no esta vacia, de lo contrario falso.
*/
function notEmpty(cadena)
{
	if(cadena!="")
		return true;
	else
		return false
}

/**
*Verifica que la cadena tenga el formato de correo
*@param {String} Correo a validar
*@returns {Bool} Verdadero si cumple con el formato, de lo contrario falso.
*/
function ValidaCorreo(correo)
{
	 var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	 if(expr.test(correo))
	 	return true;
	 else
	 	return false;
}


/**
*Verifica que la cadena tenga el formato de url
*@param {String} Correo a validar
*@returns {Bool} Verdadero si cumple con el formato, de lo contrario falso.
*/
function ValidaUrl(url)
{
	var expr = /^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi;
 	if(expr.test(url))
	 	return true;
	 else
	 	return false;
}

/**
*Verifica que la cadena desde sea menor a la de hasta
*@param {String} Hora desde.
*@param {String} Hora hasta.
*@returns {Bool} Verdadero si desde es menor a hasta, de lo contrario falso.
*/
function ValidaHorario(desde,hasta)
{
	if(desde<hasta)
		return true;
	 else
	 	return false;
}

/**
*Verifica que la cadena de entrada contenga solo letras u espacio entre sub cadenas
*@param {String} cadena
*@return {Bool} Verdad si cumple con contener solo letras y espacios entre subcadenas
*/
function ValidaLetras(cadena)
{
	var exp = /^[a-zA-Z\s]*$/;
	if(!cadena.search(exp))
		return true;
	else
		return false;
}


/**
*Verifica que el parametro que recibe este entre el 0 y el 100
*@param {Integer} numero
*@return {Bool} Verdadero si esta en el rango, falso en otro caso
*/
function ValidaUpDown(numero)
{
	if(numero>=0 && numero<=100)
		return true;
	else
		return false;
}