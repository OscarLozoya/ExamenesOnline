/**
*@fileoverviewe Script para validar la parte de Modificar y crear un Examen
*@autor Gerardo Noé Pérez plascencia
*@version 1.0
*/

/**
*Verifica que los campos se hayan llenado correctamente
*/
function validarExamen()
{
	var errorCategoria = true;
	var errorCantidadPreguntas = true;
	var errorTiempoLimite = true;
	var errorCalificacion = true;
	var errorNombreExamen = true;

	errorCategoria = validaCategoria();
	errorCantidadPreguntas = validaCantidadPreguntas();
	errorTiempoLimite = validaTiempoLimite();
	errorCalificacion = validaCalificacion();
	errorNombreExamen = validaNombreExamen();

	if(errorCategoria||errorCantidadPreguntas||errorCalificacion||errorTiempoLimite||errorNombreExamen)
		error=true;
	else
		error=false;
	return !error;
}
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
function validaCantidadPreguntas()
{
	var cantidad_preguntas=$('#cantidad_preguntas');

	if(!notEmpty(cantidad_preguntas.val()))
	{
		$('#MensajeCantidad').css('display','block');
		return true;
	}
	else
	{
		return false;
	}
}
function validaTiempoLimite()
{
	var tiempo=$('#tiempo');

	if(!notEmpty(tiempo.val()))
	{
		$('#MensajeTiempo').css('display','block');
		return true;
	}
	else
	{
		return false;
	}
}
function validaCalificacion()
{
	var calificacion=$('#calificacion');

	if(!notEmpty(calificacion.val()))
	{
		$('#MensajeCalificacion').css('display','block');
		return true;
	}
	else
	{
		return false;
	}
}
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
*Oculta el mensaje de error de que no ingreso el usuario
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