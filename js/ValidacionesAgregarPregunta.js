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
	var categoria=$('select#categoria option:selected'),
		mensajeCategoria=$('#MensageCategoria'),
		inputCategorias=$('input#id_categorias'),
		id_categorias=inputCategorias.val();
	mensajeCategoria.css('display','none');
	if(id_categorias=='{id_categorias}')
		id_categorias='';
	if(notEmpty(categoria[0].value))
	{
		$('table#Categorias').append
		(
			$('<tr>').append
			(
				$('<td>').append(categoria[0].value)
			).append(
				$('<td>').append(categoria[0].innerHTML)
			).append(
				$('<td>').append($('<input>').attr('type','checkbox'))
			)
		)
		id_categorias+=categoria[0].value+',';
		inputCategorias.val(id_categorias);
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
		console.log(respuesta.val())
		$('table#Respuestas').append
		(
			$('<tr>').append
			(
				$('<td>').append(respuesta.val())
			).append(
				$('<td>').append($('<input>').attr('type','radio').attr('name','respuesta'))
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
	var categorias=$('table#Categorias tbody tr td input'),
		id_categorias='';
	for (var i = 0; i < categorias.size(); i++) {
		if(categorias.eq(i).prop("checked"))
			categorias.eq(i).parent().parent().remove();
		else
			id_categorias+=categorias.eq(i).parent().parent().children('td')[0].innerHTML+','
	}
	$('input#id_categorias').val(id_categorias);
}

/**
*Obtiene la respuesta que esta seleccionada y la elimina
*/
function eliminarRespuesta()
{
	var respuesta=$('table#Respuestas tbody tr td input');
	for (var i = 1; i < respuesta.size(); i=i+2) {
		if(respuesta.eq(i).prop("checked"))
			respuesta.eq(i).parent().parent().remove();
	}
}

/**
*Oculta o muestra la opción de agregar respuestas de opción multiple. 
*/
function OpcionRespuesta()
{
	var option=$('select#tipo'),
		respuestas=$('div#respuestaOpciones'),
		id_respuestas=$('table#Respuestas tbody tr td input');
	if(option[0].value=='Abierta'){		
		respuestas.css('display','none');
		for (var i = 0; i < id_respuestas.size(); i++) {
			id_respuestas.eq(i).parent().parent().remove();
		}
		$('input#id_respuestas').val("Abierta");
	}
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
			CantRespuestas=0,
			id_respuestas='';
		if(categorias.size()>0)
		{
			if(option[0].value=='Opciones')
			{
				if(respuestas.size()>0)
				{
					for (var i = 0; i <respuestas.size(); i=i+2) {
						id_respuestas+=respuestas.eq(i).parent().parent().children('td')[0].innerHTML+'|';
						if(respuestas.eq(i).prop("checked")==true){
							CantRespuestas=CantRespuestas+1;
							id_respuestas+='1,'
						}
						else
							id_respuestas+='0,'
					}
					$('input#id_respuestas').val(id_respuestas);
				}
				else
				{
					$('#MensageRespuestas').css('display','block');
					respuestas.focus();
					return false;
				}
				
				if(CantRespuestas==0)
				{
					$('#MensageRespuestaCorrecta').css('display','block');
					respuestas.focus();
					return false;
				}
			}
		}
		else
		{
			$('#MensageCategoria').css('display','block');
			$('select#categoria').focus();
			return false;
		}
	}
	else
	{
		$('#MensagePregunta').css('display','block');
		pregunta.focus();
		return false;
	}
	return true;
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