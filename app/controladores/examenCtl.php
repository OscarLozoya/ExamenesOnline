<?php 
	/**
	* 
	*/
	class examenCtl{
		
		public $modelo;
		function __construct()
		{
			include_once('app/modelos/examenMdl.php');
			$this->modelo=new ExamenMdl();
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
						if(isset($_GET['response'])=='buscar')
							$this->buscar();
						else
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
			$vista=file_get_contents('app/vistas/ModElimExamen.php');
			$header=file_get_contents('app/vistas/Header.php');
			$footer=file_get_contents('app/vistas/Footer.php');
			if(empty($_POST))
			{
				$categoria = $this->modelo->obtenerCategorias();
				$vista = $this->llenarCategoria($categoria,$vista);
			}
			else
			{
				$ID=$_POST['id'];
				echo $this->$modelo->eliminar($ID);
			}

			$inicio_fila = strrpos($vista,'<tr>');
			$fin_fila = strrpos($vista, '</tr>')+5;
			$fila = substr($vista,$inicio_fila,$fin_fila-$inicio_fila);
			$vista = str_replace($fila, '', $vista);
			
			$vista = $header . $vista . $footer;
			echo $vista;
		}
		/*Vista del examen que esta realizando
		*/
		function vista()
		{
			if(empty($_POST))
				require_once('app/vistas/VistaExamen.php');
		}
		function buscar()
		{
			if(empty($_POST))
				require_once('app/vistas/ModElimExamen.php');
		}

		function llenarCategoria($categoria,$vista)
		{
			$inicio_categoria = strrpos($vista, '<option>');
			$fin_categoria = strrpos($vista, '</option>') + 9;
			$option = substr($vista, $inicio_categoria,$fin_categoria-$inicio_categoria);
			$options = '';
			if(isset($categoria))
			{
				foreach ($categoria as $row) {
					$newOption=$option;
					$diccionario= array('{Categoria}' => $row);
					$newOption=strtr($newOption,$diccionario);
					$options .= $newOption;
				}
				$vista = str_replace($option, $options, $vista);
			}
			else
			{
				$vista = str_replace($option,'', $vista);
			}
			return $vista;
		}
	}
 ?>