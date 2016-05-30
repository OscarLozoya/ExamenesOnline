function calificar()
{
	var resultado=$('input#resultado');
	for (var i = 0; i < resultado.size(); i++) {
		if(resultado.eq(i).prop("checked")==true)
		{
			return true;
		}
	}
	return false;
}