<?php 
	/**
	* 
	*/
	class examenCtl{
		
		public $modelo;
		function __construct()
		{
			//include('modelo/examenBss.php');
			//$this->modelo=new ExamenBss();
		}

		function ejecutar()
		{
			if(isset($_GET['accion']))
			{
				switch ($_GET['accion']) {
					case 'crear':
						$this->crear();
						break;
					case 'modificar':
						$this->modificar();
						break;
					case 'eliminar':
						$this->eliminar();
						break;
					case 'vista':
						$this->vista();
						break;
					default:
						require_once('app/vistas/index.php');
						break;
				}
			}
			else
			{
				require_once('app/vistas/index.php');
			}
		}

		function crear()
		{
			if(empty($_POST))
				require_once('app/vistas/CrearExamen.php');
		}

		function modificar()
		{
			if(empty($_POST))
				require_once('app/vistas/ModElimExamen.php');
		}

		function eliminar()
		{
			if(empty($_POST))
				require_once('app/vistas/ModElimExamen.php');
		}
		/*Vista del examen que esta realizando
		*/
		function vista()
		{
			if(empty($_POST))
				require_once('app/vistas/VistaExamen.php');
		}

	}
 ?>