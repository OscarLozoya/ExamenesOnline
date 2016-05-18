/**
*@fileoverviewe Script para validar la parte de Modificar y crear un Examen
*@autor Gerardo Noé Pérez plascencia
*@version 1.0
*/

/**
*Verifica si hay error en alguna de las validaciones si existe un error el formulario no es procesado
*@returns {Bool} Verdadero si el formulario no contiene error en ninguno de sus campos y falso en caso contrario 
*/
function validarExamen()
{
	var errorCategoria = true; 
	var errorCantidadPreguntas = true;
	var errorTiempoLimite = true;
	var errorCalificacion = true;
	var errorNombreExamen = true;

	errorCategoria = validaCategoria(); //Variable que obtiene el resultado de la validación para categoria
	errorCantidadPreguntas = validaCantidadPreguntas(); //Variable que obtiene el resultado de la validación para la cantidad de preguntas
	errorTiempoLimite = validaTiempoLimite(); //Variable que obtiene el resultado de la validación para el tiempo limite
	errorCalificacion = validaCalificacion(); //Variable que obtiene el resultado de la validación para la calificacion minima
	errorNombreExamen = validaNombreExamen(); //Variable que obtiene el resultado de la validación para el nombre del examen

	if(errorCategoria||errorCantidadPreguntas||errorCalificacion||errorTiempoLimite||errorNombreExamen)
		error=true;
	else
		error=false;
	return !error; //Se niega el resultado de error para poder ser procesado como falso en caso de que se encuentre un error (true)
}
/**
*Verifica que el campo de la categoria tenga un valor, es decir que no sea nulo
*@returns {Bool} Verdadero en caso de que el campo categoria no tenga un valor y falso en caso contrario
*/
function validaCategoria()
{
	var categoria=$('#categoria');

	if(!notEmpty(categoria.val()))
	{
		$('#MensajeCategoria').css('display','block');
		return true;
	}
	else
	{
		return false;
	}
}
/**
*Verifica que el campo de la cantidad de preguntas tenga un valor, es decir que no sea nulo, además de verificar que se encuentre en un rango
*@returns {Bool} Verdadero en caso de que el campo cantidad de preguntas no tenga un valor y falso en caso contrario
*/
function validaCantidadPreguntas()
{
	var cantidad_preguntas=$('#cantidad_preguntas');

	if(!notEmpty(cantidad_preguntas.val()))
	{
		$('#MensajeCantidad').css('display','block');
		return true;
	}
	if(!ValidaUpDown(cantidad_preguntas.val(),1,100))
		cantidad_preguntas.val('1');
	else
	{
		return false;
	}
}
/**
*Verifica que el campo del tiempo limite tenga un valor, es decir que no sea nulo, además de verificar que se encuentre en un rango
*@returns {Bool} Verdadero en caso de que el campo tiempo limite no tenga un valor y falso en caso contrario
*/
function validaTiempoLimite()
{
	var tiempo=$('#tiempo');

	if(!notEmpty(tiempo.val()))
	{
		$('#MensajeTiempo').css('display','block');
		return true;
	}
	if(!ValidaUpDown(tiempo.val(),1,1000))
		tiempo.val('1');
	else
	{
		return false;
	}
}
/**
*Verifica que el campo de la calificación tenga un valor, es decir que no sea nulo, además de verificar que se encuentre en un rango
*@returns {Bool} Verdadero en caso de que el campo calificacion no tenga un valor y falso en caso contrario
*/
function validaCalificacion()
{
	var calificacion=$('#calificacion');

	if(!notEmpty(calificacion.val()))
	{
		$('#MensajeCalificacion').css('display','block');
		return true;
	}
	if(!ValidaUpDown(calificacion.val(),0,100))
		calificacion.val('0');
	else
	{
		return false;
	}
}
/**
*Verifica que el campo nombre de examen tenga un valor, es decir que no sea nulo
*@returns {Bool} Verdadero en caso de que el campo nombre de examen no tenga un valor y falso en caso contrario
*/
function validaNombreExamen()
{
	var nombre=$('#nombre');

	if(!notEmpty(nombre.val()))
	{
		$('#MensajeNombre').css('display','block');
		return true;
	}
	else
	{
		return false;
	}
}
/**
*Funcion que permite ocultar los mensajes de error segun sea el caso
*@param {String} Nombre del campo al que hace referencia el mensaje
*/
function CambioAlgo(cambio)
{
	switch(cambio)
	{
		case 'tiempo': $('#MensajeTiempo').css('display','none');
			break;
		case 'categoria': $('#MensajeCategoria').css('display','none');
			break;
		case 'calificacion': $('#MensajeCalificacion').css('display','none');
			break;
		case 'cantidad': $('#MensajeCantidad').css('display','none');
			break;	
		case 'nombre': $('#MensajeNombre').css('display','none');
			break;	
	}
}

/**
*Verifica si tiene o no parametros la pagina, si los tiene los muestra.
*/
var modificacion=false;

window.onload=function(){
	var parametros=window.location.search.substr(1),
		parametro=parametros.split("&");
	if(parametro.length>1)
	{
		modificacion=true;
		$('input#id').val(parametro[0]);
		$('input#nombre').val(parametro[1].replace(/%20/g," "));
		//$('select#categoria').val(parametro[2]); pendiente ver que pasa con el combobox
		$('input#cantidad_preguntas').val(parametro[3]);
		$('input#tiempo').val(parametro[4]);
		$('input#calificacion').val(parametro[5]);}
}