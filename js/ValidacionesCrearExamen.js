var modificacion=false;
/**
*Verifica si tiene o no parametros la pagina, si los tiene los muestra.
*/
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