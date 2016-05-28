/**
*@fileoverviewe Script para validar la parte de Modificar y Eliminar un Examen
*@autor José Alberto Suárez Carrillo
*@version 1.0
*/

/**
*Limpia los campos de texto del nombre y el id
*/
function Limpiar()
{
	$('input#nombre').val("");
	$('input#id').val("");
}

/**
*Busca el examen ya sea por el id,nombre o categoria.
*/
function Buscar()
{
	var id=$('input#nombre'),
		nombre=$('input#id'),
		categoria=$('select#categoria');
	if(notEmpty(id.val())||notEmpty(nombre.val())||notEmpty(categoria[0].value))
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
*Elimina el examen que esta seleccionado, si no hay ninguo muestra un mensaje en la pagina.
*/
function EliminarExamen()
{
	var examen=$('table#examen tbody tr td input'),
		findExamen=false,
		id='';
	if(examen.size()>0)
	{
		for (var i = 0; i < examen.size(); i++) {
			if(examen.eq(i).prop("checked"))
			{
				id+=examen.eq(i).parent().parent().children('td')[0].innerHTML+',';
				findExamen=true;
			}
		}
		if(!findExamen)
		{
			$('label#MensajeEliminar').css('display','block');
			examen.focus();
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
		examen.focus();
		return false;
	}
}

/**
*Oculta el mensaje de error cuando quiere buscar algun examen.
*/
function CambioControl()
{
	$('label#MensajeBuscar').css('display','none');
}

/**
*Oculta el mensaje de error cuando quiere eliminar un examen.
*/
function CambioExamen()
{
	$('label#MensajeEliminar').css('display','none');
}

/**
*Busca el primer elemento de la tabla que este seleccionado y manda los parametros a la pagina de Crear Examen para poder modificar sus valores.
*/
function ModificarExamen()
{
	var examen=$('table#examen tbody tr td input'),
		findExamen=false,
		ID='';
	if(examen.size()>0)
	{
		for (var i = 0; i < examen.size(); i++) {
			if(examen.eq(i).prop("checked"))
			{
				ID=examen.eq(i).parent().parent().children('td')[0].innerHTML;
				window.location="index.php?controlador=examen&accion=crear&ID="+ID;
				findExamen=true;
			}
		}
		if(!findExamen)
		{
			$('label#MensajeEliminar').css('display','block');
			examen.focus();
		}
	}
	else
	{
		$('label#MensajeEliminar').css('display','block');
		examen.focus();
	}
}