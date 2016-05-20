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

		/**
		 *Ejecuta la acción correspondiente según el valor recibido  
		*/
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

		/**
		 *Elimina uno o más exámenes de la base de datos
		*/
		function eliminar()
		{
			//Cargamos los archivos necesarios para la vista 
			$vista=file_get_contents('app/vistas/ModElimExamen.php');
			$menu=file_get_contents('app/vistas/MenuAdmin.php');
			$header=file_get_contents('app/vistas/Header.php');
			$footer=file_get_contents('app/vistas/Footer.php');

			//Mostramos las categorías que están registradas en la base de datos, esto se hace cada que ingresa a la pagina
			$categoria = $this->modelo->obtenerCategorias();
			$vista = $this->llenarCategoria($categoria,$vista);

			//Buscamos la fila en la tabla para mostrar posibles mensajes del modelo
			$inicio_fila = strrpos($vista,'<tr>');
			$fin_fila = strrpos($vista, '</tr>')+5;
			$fila = substr($vista,$inicio_fila,$fin_fila-$inicio_fila);


			if(empty($_POST))
			{
				//Si no se recibió nada por POST borramos la fila con las llaves 
				$vista = str_replace($fila, '', $vista);
			}
			else
			{
				$ID = '';
				$ID = $_POST['id-eliminar'];
				$result = $this->modelo->eliminar($ID);
				//Si se regresa TRUE de la eliminación mostramos éxito, de lo contrario mostramos lo que nos regrese el modelo
				if($result)
					$vista = str_replace($fila, 'Se elimino correctamente', $vista);
				else
					$vista = str_replace($fila, $result, $vista);
			}
			$vista = $header . $menu . $vista . $footer;
			echo $vista;
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

		/**
		 *Busca en la base de datos los exámenes que estén guardados y que cumplan con el criterio de busqueda
		*/
		function buscar()
		{
			//Si no se recibe nada por POST mostramos solo la vista
			if(empty($_POST))
				require_once('app/vistas/ModElimExamen.php');
			else
			{
				//Cargamos los archivos necesarios para la vista 
				$vista=file_get_contents('app/vistas/ModElimExamen.php');
				$header=file_get_contents('app/vistas/Header.php');
				$footer=file_get_contents('app/vistas/Footer.php');
				//Guardamos los valores obtenidos por POST 
				$ID = $_POST['id'];
				$Nombre = $_POST['nombre'];
				$Categoria = $_POST['categoria'];
				//Mostramos las categorías que están registradas en la base de datos, esto se hace cada que ingresa a la pagina 
				$categorias = $this->modelo->obtenerCategorias();
				$vista = $this->llenarCategoria($categorias,$vista);
				//Guardamos lo que nos regresó el modelo
				$Examenes = $this->modelo->buscar($ID,$Nombre,$Categoria);
				//Buscamos la fila en la tabla para mostrar lo obtenido del modelo
				$inicio_fila = strrpos($vista,'<tr>');
				$fin_fila = strrpos($vista, '</tr>')+5;
				$fila = substr($vista,$inicio_fila,$fin_fila-$inicio_fila);
				$filas = "";
				//Si nos regresó algo el modelo lo mostramos
				if(isset($Examenes))
				{
					$new_fila="";
					foreach ($Examenes as $row) {
						$new_fila = $fila;
						$diccionario = array('{ID}' => $row['ID'],
											'{Nombre}' => $row['Nombre'],
											'{Categoria}' => $row['Categoria'],
											'{Preguntas}' => $row['Preguntas'],
											'{Tiempo}' => $row['Duracion'],
											'{Calificacion}' => $row['Calificacion']);
						//var_dump($diccionario);
						$new_fila = strtr($new_fila,$diccionario);
						$filas .= $new_fila;
					}
					$vista = str_replace($fila, $filas, $vista);
				}
				else
				{
					//Si no mostramos un mensaje
					$vista = str_replace($fila, 'No se encontro el examen', $vista);

					$vista = str_replace($fila, 'No se encontro el examen', subject);
					echo "error";

				}
				$vista = $header.$vista.$footer;
				echo $vista;
			}
		}

		/**
		 *Llena la vista con las categorías obtenidas del modelo
		 *@param $categoria Recibe lo obtenido de la consulta a la base de datos 
		 *@param $vista string con la vista donde se van a sustituir
		 *@return string con la vista sustituida
		*/
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
