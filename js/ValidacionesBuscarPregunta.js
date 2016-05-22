/**
*Busca la pregunta ya sea por el id,descripción o categoria.
*/
function Buscar()
{
	var id=$('input#ID'),
		pregunta=$('input#Pregunta'),
		categoria=$('select#Categoria');
	if(notEmpty(id.val())||notEmpty(pregunta.val())||notEmpty(categoria[0].value))
	{
		return true;
	}
	else
	{
		$('label#MensajeBuscar').css('display','block');
		id.focus();
	}
	return false;
}

/**
*Busca el primer elemento de la tabla que este seleccionado y manda los parametros a la pagina de Crear Examen para poder modificar sus valores.
*/
function ModificarPregunta()
{
	var Pregunta=$('table#Pregunta tbody tr td input'),
		findPregunta=false,
		ID='';
	if(Pregunta.size()>0)
	{
		for (var i = 0; i < Pregunta.size(); i++) {
			if(Pregunta.eq(i).prop("checked"))
			{
				ID=Pregunta.eq(i).parent().parent().children('td')[0].innerHTML;
				window.location="index.php?controlador=pregunta&accion=agregar&ID="+ID;
				findPregunta=true;
			}
		}
		if(!findPregunta)
		{
			$('label#MensajeEliminar').css('display','block');
			Pregunta.focus();
		}
	}
	else
	{
		$('label#MensajeEliminar').css('display','block');
		Pregunta.focus();
	}
}

/**
*Limpia los campos de texto del nombre y el id
*/
function Limpiar()
{
	$('input#Pregunta').val("");
	$('input#ID').val("");
}

/**
*Elimina el Pregunta que esta seleccionado, si no hay ninguo muestra un mensaje en la pagina.
*/
function EliminarPregunta()
{
	var Pregunta=$('table#Pregunta tbody tr td input'),
		findPregunta=false,
		id='';
	if(Pregunta.size()>0)
	{
		for (var i = 0; i < Pregunta.size(); i++) {
			if(Pregunta.eq(i).prop("checked"))
			{
				id+=Pregunta.eq(i).parent().parent().children('td')[0].innerHTML+',';
				findPregunta=true;
			}
		}
		if(!findPregunta)
		{
			$('label#MensajeEliminar').css('display','block');
			Pregunta.focus();
			return false;
		}
		else
		{
			$('input#id-eliminar').val(id);
			return true;
		}
	}
	else
	{
		$('label#MensajeEliminar').css('display','block');
		Pregunta.focus();
		return false;
	}
}