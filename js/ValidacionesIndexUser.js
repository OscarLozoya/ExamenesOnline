function irExamen()
{
	var id_Examen=$("input#id-examen");
	window.location="index.php?controlador=examen&accion=vista&ID="+id_Examen.val();
}