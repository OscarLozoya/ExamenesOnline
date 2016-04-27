<?php 
	switch ($_GET['controlador']) 
	{
		case 'examen':
			require ('examenCtl.php');
			$controlador = new examenCtl();
			break;
		case 'pregunta':
			require ('preguntaCtl.php');
			$controlador = new preguntaCtl();
			break;
		case 'usuario':
			require ('usuarioCtl.php');
			$controlador = new usuarioCtl();
			break;
		case 'perfil':
			require ('perfilCtl.php');
			$controlador = new perfilCtl();
			break;
		case 'slider':
			require ('sliderCtl.php');
			$controlador = new sliderCtl();
			break;
		default:
			require ('inicioCtl.php');
			$controlador = new inicioCtl();
			break;
	}

	$controlador->ejecutar(); 
?>