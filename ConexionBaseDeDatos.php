<?php 
	$con = new mysqli('lugardonde esta','usuario','contraseña','BaseDeDAtos');
	if($con->connect_error){
		die('Ni pedo la vida sigue aqui ya no<div class="col-xs-12 col-md-6 col-md-offset-3">
					<img src="image_404.png" alt="Ponga un 100 por favor">
				</div>');
	}
	$resultquery = $con->query("SELECT * FrOM Usuario");

	if(!$resultquery){
		die('Ha ocurrido un error'.$con->error);
	}
	//var_dump($resultquery);
	echo('<pre>');
	while ($Fila = $resultquery->fetch_array(MYSQLI_ASSOC) ) {
		$usuario[] = $Fila;
	}

	while ($F = $resultquery->fetch_object() ) {
		var_dump("M;AMAMAMAMASMAMSAMSM %s \n",$F->Usuario);
	}
	//Limpiar Variables
	//$dato = 
	//var_dump($usuario);
 ?>
