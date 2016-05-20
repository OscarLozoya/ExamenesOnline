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
				if(esAdmin()||esModerador())
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
							carga_inicio();
							break;
					}
				}
				else
					carga_inicio();
			}
			else
				carga_inicio();
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