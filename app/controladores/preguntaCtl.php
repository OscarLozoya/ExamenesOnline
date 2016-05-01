<?php 
	/**
	* 
	*/
	class preguntaCtl
	{
		
		function __construct()
		{
			# code...
		}

		function ejecutar()
		{
			if(isset($_GET['accion']))
			{
				switch ($_GET['accion']) {
					case 'agregar':
						$this->agregar();
						break;
					case 'buscar':
						$this->buscar();
						break;
					case 'modificar':
						$this->modificar();
						break;
					case 'eliminar':
						$this->eliminar();
						break;
					default:
						require_once('app/vistas/index.php');
						break;
				}
			}
			else
				require_once('app/vistas/index.php');
		}

		function agregar()
		{
			if(empty($_POST))
				require_once('app/vistas/AgregarPregunta.php');
		}

		function buscar()
		{
			if(empty($_POST))
				require_once('app/vistas/BuscarPregunta.php');
		}

		function modificar()
		{
			if(empty($_POST))
				require_once('app/vistas/AgregarPregunta.php');
		}

		function eliminar()
		{
			if(empty($_POST))
				require_once('app/vistas/AgregarPregunta.php');
		}
	}
 ?>