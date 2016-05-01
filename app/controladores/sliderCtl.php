<?php 
	/**
	* 
	*/
	class sliderCtl
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
						require_once('app/vistas/index.php');
						break;
				}
			}
		}

		function crear()
		{
			if(empty($_POST))
				require_once('app/vistas/AdminSlide.php');
		}

		function eliminar()
		{
			if(empty($_POST))
				require_once('app/vistas/AdminSlide.php');
		}

		function modificar()
		{
			if(empty($_POST))
				require_once('app/vistas/AdminSlide.php');
		}
	}
 ?>