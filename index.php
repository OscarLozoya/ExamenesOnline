<?php 
	include_once('app/controladores/sesionCtl.php'); // Archivo con funciones para las sesiones (tipo de usuario)
	if(!empty($_GET))
	{
		switch ($_GET['controlador']) 
		{
			case 'examen':
				require ('app/controladores/examenCtl.php');
				$controlador = new examenCtl();
				break;
			case 'pregunta':
				require ('app/controladores/preguntaCtl.php');
				$controlador = new preguntaCtl();
				break;
			case 'usuario':
				require ('app/controladores/usuarioCtl.php');
				$controlador = new usuarioCtl();
				break;
			case 'slider':
				require ('app/controladores/sliderCtl.php');
				$controlador = new sliderCtl();
				break;
			case 'categoria':
				require('app/controladores/categoriaCtl.php');
				$controlador=new categoriaCtl();
				break;
			default:
				require ('app/controladores/inicioCtl.php');
				$controlador = new inicioCtl();
				break;
		}

		$controlador->ejecutar(); 
	}
	else
	{
		require ('app/controladores/inicioCtl.php');
		$controlador = new inicioCtl();
		$controlador->ejecutar(); 
	}
?>