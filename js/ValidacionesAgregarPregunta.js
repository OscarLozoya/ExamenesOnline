function valAgregarCategoria()
{
	var categoria=$('select#categoria');
	var mensajeCategoria=$('#MensageCategoria');
	mensajeCategoria.css('display','none');
	if(notEmpty(categoria[0].value))
	{
		$('table#Categorias').append(
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

function valAgregarRespuesta()
{
	var respuesta=$('input#TextoRespuesta');
	var mensajeRespuesta=$('#MensageRespuestas');
	mensajeRespuesta.css('display','none');
	if(notEmpty(respuesta.val()))
	{
		$('table#Respuestas').append(
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
		var contenidoRespuesta=$("#MensageContenidoRespuesta");
		contenidoRespuesta.css('display','block');
		respuesta.focus();
	}
}

function elminarCategoria()
{
	var categorias=$('table#Categorias tbody tr td input');
	for (var i = 0; i < categorias.size(); i++) {
		if(categorias.eq(i).prop("checked"))
			categorias.eq(i).parent().parent().remove();
	}
}

function eliminarRespuesta()
{
	var categorias=$('table#Respuestas tbody tr td input');
	for (var i = 1; i < categorias.size(); i=i+2) {
		if(categorias.eq(i).prop("checked"))
			categorias.eq(i).parent().parent().remove();
	}
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
	var pregunta=$('textarea#Pregunta');
	if(notEmpty(pregunta.val()))
	{
		var option=$('select#tipo');
		var respuestas=$('table#Respuestas tbody tr td input');
		var categorias=$('table#Categorias tbody tr td');
		var CantRespuestas=0;
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
					var mensajeRespuesta=$('#MensageRespuestas');
					mensajeRespuesta.css('display','block');
					respuestas.focus();
				}
				if(CantRespuestas==0)
				{
					var mensajeRespuestaCorrecta=$('#MensageRespuestaCorrecta');
					mensajeRespuestaCorrecta.css('display','block');
					respuesta.focus();
				}
			}
		}
		else
		{
			var mensajeCategoria=$('#MensageCategoria');
			mensajeCategoria.css('display','block');
			$('select#categoria').focus();
		}
	}
	else
	{
		var mensajePregunta=$('#MensagePregunta');
		pregunta.focus();
		mensajePregunta.css('display','block');
	}
}

function CambioPregunta()
{
	var mensajePregunta=$('#MensagePregunta');
	mensajePregunta.css('display','none');
}

function CambioRespuestaCorrecta()
{
	var mensajeRespuestaCorrecta=$('#MensageRespuestaCorrecta');
	mensajeRespuestaCorrecta.css('display','none');
}

function cambioContenidoRespuesta()
{
	var contenidoRespuesta=$("#MensageContenidoRespuesta");
	contenidoRespuesta.css('display','none');
}