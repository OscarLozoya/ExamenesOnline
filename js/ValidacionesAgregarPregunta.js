/**
*@fileoverviewe Script para validar la parte de Modificar y Eliminar un Examen
*@autor José Alberto Suárez Carrillo
*@version 1.0
*/

/**
*Verifica que se selecciono una categoria del select y lo agrega a la tabla
*/
function valAgregarCategoria()
{
	var categoria=$('select#categoria'),
		mensajeCategoria=$('#MensageCategoria');
	mensajeCategoria.css('display','none');
	if(notEmpty(categoria[0].value))
	{
		$('table#Categorias').append
		(
			$('<tr>').append
			(
				$('<td>').append('02')
			).append(
				$('<td>').append(categoria[0].value)
			).append(
				$('<td>').append($('<input>').attr('type','checkbox'))
			)
		)
		return false;
	}
}

/**
*Verifica que se escribio la respuesta y la agrega a la tabla
*/
function valAgregarRespuesta()
{
	var respuesta=$('input#TextoRespuesta'),
		mensajeRespuesta=$('#MensageRespuestas');
	mensajeRespuesta.css('display','none');
	if(notEmpty(respuesta.val()))
	{
		$('table#Respuestas').append
		(
			$('<tr>').append
			(
				$('<td>').append(respuesta.val())
			).append(
				$('<td>').append($('<input>').attr('type','checkbox'))
			).append(
				$('<td>').append($('<input>').attr('type','checkbox'))
			)
		)
		respuesta.attr("value","");
	}
	else
	{
		$("#MensageContenidoRespuesta").css('display','block');;
		respuesta.focus();
	}
}

/**
*Obtiene la categoria que esta seleccionada y la elimina
*/
function elminarCategoria()
{
	var categorias=$('table#Categorias tbody tr td input');
	for (var i = 0; i < categorias.size(); i++) {
		if(categorias.eq(i).prop("checked"))
			categorias.eq(i).parent().parent().remove();
	}
}

/**
*Obtiene la respuesta que esta seleccionada y la elimina
*/
function eliminarRespuesta()
{
	var categorias=$('table#Respuestas tbody tr td input');
	for (var i = 1; i < categorias.size(); i=i+2) {
		if(categorias.eq(i).prop("checked"))
			categorias.eq(i).parent().parent().remove();
	}
}

/**
*Oculta o muestra la opción de agregar respuestas de opción multiple. 
*/
function OpcionRespuesta()
{
	var option=$('select#tipo'),
		respuestas=$('div#respuestaOpciones');
	if(option[0].value=='Abierta')		
		respuestas.css('display','none');
	else
		respuestas.css('display','block');
}

/**
*Verifica que la pregunta este escrita, que tenga almenos una categoria y que si es de opción mulltiple, tenga almenos una respuesta correcta.
*/
function ValidaAgregarPregunta()
{
	var pregunta=$('textarea#Pregunta');
	if(notEmpty(pregunta.val()))
	{
		var option=$('select#tipo'),
			respuestas=$('table#Respuestas tbody tr td input'),
			categorias=$('table#Categorias tbody tr td'),
			CantRespuestas=0;
		if(categorias.size()>0)
		{
			if(option[0].value=='Opciones')
			{
				if(respuestas.size()>0)
				{
					for (var i = 0; i <respuestas.size(); i=i+2) {
						if(respuestas.eq(i).prop("checked")==true)
							CantRespuestas=CantRespuestas+1;
					}
				}
				else
				{
					$('#MensageRespuestas').css('display','block');
					respuestas.focus();
				}
				if(CantRespuestas==0)
				{
					$('#MensageRespuestaCorrecta').css('display','block');
					respuesta.focus();
				}
			}
		}
		else
		{
			$('#MensageCategoria').css('display','block');
			$('select#categoria').focus();
		}
	}
	else
	{
		$('#MensagePregunta').css('display','block');
		pregunta.focus();
	}
}

/**
*Oculta el mensaje de error cuando no se escribe la pregunta
*/
function CambioPregunta()
{
	$('#MensagePregunta').css('display','none');
}

/**
*Oculta el mensaje de error cuando no tiene una respuesta correcta seleccionada
*/
function CambioRespuestaCorrecta()
{
	$('#MensageRespuestaCorrecta').css('display','none');
}

/**
*Oculta el error cuando no se ha escrito la respuesta
*/
function cambioContenidoRespuesta()
{
	$("#MensageContenidoRespuesta").css('display','none');
}