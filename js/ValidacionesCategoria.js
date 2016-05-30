/**
*@fileoverviewe Script para validar los formularios Correspondiente al ABC de Categoria
*@autor Oscar Ivan Lozoya Rodriguez
*@version 1.0
*/

/**
*/
function ValidaBusqueda(){
	var enviar = false;
	var BarBusqueda = $('input#inpBusqueda');
	Elimina_Error('ErrorSearch');
	if (!notEmpty(BarBusqueda.val())) 
		MuestraError('label','No se introdujo un argumento de busqueda',BarBusqueda,'ErrorSearch');
	else
		enviar=true;
	return enviar;
}

/**
*/
function ValidaAgregar(){
	var enviar = false;
	var BarAgrega= $('input#inpAgregar');
	Elimina_Error('ErrorAdd');
	if (!notEmpty(BarAgrega.val())) 
		MuestraError('label','Especifique un nombre para la Categoria',BarAgrega,'ErrorAdd');
	else
		enviar=true;
	return enviar;
}
/**
*@param {String} Campo recibe como parametro el Id de un input sin la almoadilla
*@param {String} MensajeError String que contiene un mensaje ha mostrar en caso de error
*/
function ValidaCampoEntrada(Campo,MensajeError){
	var enviar = false;
	var valCampo = $('input#'+Campo);
	console.log(Campo);
	//$('label.Warning').remove();
	Elimina_Error('Error'+Campo);
	if (notEmpty(valCampo.val())) 
		MuestraError('label',MensajeError,valCampo,'Error'+Campo);
	else
		enviar=true;
	return enviar;
}

/**
*Funcion para insertar elementos HTML para mostrar errores al verificar los parametros.
*@param {String} TipoCont Elemento que se quiere insertar regularmente label.
*@param {String} Mensaje Cadena String que se quiere mostrar como error.
*@param {ElementDOM} DespuesDe Elemento que se toma de referencia para insertar el mensaje despues de este.
*@param {String}  IdElement Id del elemento insertado.
*@return {Void}
*/
function MuestraError(TipoCont,Mensaje,DespuesDE,IdElement)
{
	var etiq= document.createElement(TipoCont);
	var mns=document.createTextNode(Mensaje);
	etiq.appendChild(mns);
	etiq.setAttribute('id',IdElement);
	etiq.setAttribute('class','Warning');
	etiq.setAttribute('style','display: block');
	document.body.appendChild(etiq);
	DespuesDE.after(etiq);
}
 function opcSelect(){
 	var R = $('div#esp_botones');
 	Elimina_Error('ErrorSelect');
 	var Probando =$('input:radio[name=categoria]');
  if (Probando.is(':checked'))
  	return true;
  else{
		MuestraError('label','Seleccione una categoria para proceder',R,'ErrorSelect');
  	return false;
  }
 }

 function ValidaEliminar(){
  if (opcSelect()){
  	var Formul = $("#formDefineAccion");
  	Formul.attr("action","index.php?controlador=categoria&accion=eliminar");
 		return true;
 	}
 	else
		return false;
 }
 function ValidaModificar(){
  if (opcSelect()){
  	var Formul = $("#formDefineAccion");
  	Formul.attr("action","index.php?controlador=categoria&accion=modificar");
 		return true;
 	}
 	else
		return false;

 }
/**
*Funcion para eliminar los elementos que muestrar errores
*@param {String} IdElement Id del elemento a eliminar*
*@return {Void}
*/
function Elimina_Error(cad)
{
	$('#'+cad).remove();
}