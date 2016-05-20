<?php 
	/**
	* 
	*/
	class categoriaCtl
	{
		
		function __construct()
		{
			# code...
		}

		function ejecutar()
		{
			if(isset($_GET['accion']))
			{
				if(esAdmin())
				{
					switch ($_GET['accion']) {
						case 'crear':
							$this->crear();
							break;
						case 'eliminar':
							$this->eliminar();
							break;
						case 'modificar':
							$this->modificar();
							break;
						default:
							carga_inicio();
							break;
					}
				}
				else
				{
					carga_inicio();
				}
			}
			else
			{
				carga_inicio();
			}
		}

		function crear()
		{
			if(empty($_POST))
				require_once('app/vistas/AdministrarCategoria.php');
		}

		function eliminar()
		{
			if(empty($_POST))
				require_once('app/vistas/AdministrarCategoria.php');
		}

		function modificar()
		{
			if(empty($_POST))
				require_once('app/vistas/AdministrarCategoria.php');
		}
	}
 ?>