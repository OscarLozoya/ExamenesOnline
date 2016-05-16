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
			/*if(empty($_POST))
				require_once('app/vistas/VistaExamen.php');*/

			$vista = file_get_contents("app/vistas/VistaExamen.php");
			$footer = file_get_contents("app/vistas/Footer.php");
			$inicia_fila = strrpos($vista,'<tr>');
			$termina_fila = strrpos($vista,'</tr>')+5;
			$fila = substr($vista,$inicia_fila,$termina_fila-$inicia_fila);

			$Diccionario = array(
				'{Categoria}' => 'POO',
				'{No. Pregunta}' => '5',
				'{Total preguntas}' => '8',
				'{Pregunta}' => '¿Nos va a Pasar?',
				'{Respuesta}' => '<form><input type="radio">Si<br><input type="radio">No<br></form>',
				 );
			for ($i=1; $i <=9; $i+=3) { 
				$new_fila = $fila;
				$Diccionario_Tabla = array(
					'{Pregunta 1}' => $i,
					'{Pregunta 2}' => $i+1,
					'{Pregunta 3}' => $i+2, );
				$new_fila = strtr($new_fila, $Diccionario_Tabla);
				$filas.=$new_fila;
			}
			$vista= strtr($vista,$Diccionario);
			$vista= str_replace($fila,$filas,$vista);

			echo $vista.$footer;	
		}

	}
 ?>