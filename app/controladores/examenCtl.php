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
				if(esAdmin()||esModerador())
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
						default:
							carga_inicio();
							break;
					}
				}
				else
				{
					if($_GET['accion']=='vista')
						$this->vista();
					else
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
			//Cargamos los archivos necesarios para la vista 
			$vista=file_get_contents('app/vistas/CrearExamen.php');
			if(esAdmin())
				$menu=file_get_contents('app/vistas/MenuAdmin.php');
			else if (esModerador())
				$menu = file_get_contents('app/vistas/MenuMod.php');
			$header=file_get_contents('app/vistas/Header.php');
			$footer=file_get_contents('app/vistas/Footer.php');

			//Mostramos las categorías que están registradas en la base de datos, esto se hace cada que ingresa a la pagina
			$categoria = $this->modelo->obtenerCategorias();
			$vista = $this->llenarCategoria($categoria,$vista);
			$ultimo = $this->modelo->buscarUltimo();
			$vista = $this->llenarID($ultimo,$vista);

			if(!empty($_POST))
			{
				$categoria = $_POST['categoria'];
				$cantidadPreguntas = $_POST['cantidadPreguntas'];
				$tiempoLimite = $_POST['tiempoLimite'];
				$calificacionMinima = $_POST['calificacionMinima'];
				$nombreExamen = $_POST['nombreExamen'];

				$result = $this->modelo->crear('4', $cantidadPreguntas, $tiempoLimite, $calificacionMinima, $nombreExamen);
				//Si se regresa TRUE de la eliminación mostramos éxito, de lo contrario mostramos lo que nos regrese el modelo
				if($result)
					echo 'Se agrego correctamente';
				else
					echo $result;
			}
			$vista = $header . $menu . $vista . $footer;
			echo $vista;
		}

		function modificar()
		{
			//Cargamos los archivos necesarios para la vista 
			$vista=file_get_contents('app/vistas/CrearExamen.php');
			if(esAdmin())
				$menu=file_get_contents('app/vistas/MenuAdmin.php');
			else if (esModerador())
				$menu = file_get_contents('app/vistas/MenuMod.php');
			$header=file_get_contents('app/vistas/Header.php');
			$footer=file_get_contents('app/vistas/Footer.php');

			//Mostramos las categorías que están registradas en la base de datos, esto se hace cada que ingresa a la pagina
			$categoria = $this->modelo->obtenerCategorias();
			$vista = $this->llenarCategoria($categoria,$vista);
			$ultimo = $this->modelo->buscarUltimo();
			$vista = $this->llenarID($ultimo,$vista);

			if(!empty($_POST))
			{
				$categoria = $_POST['categoria'];
				$cantidadPreguntas = $_POST['cantidadPreguntas'];
				$tiempoLimite = $_POST['tiempoLimite'];
				$calificacionMinima = $_POST['calificacionMinima'];
				$nombreExamen = $_POST['nombreExamen'];

				$result = $this->modelo->crear('4', $cantidadPreguntas, $tiempoLimite, $calificacionMinima, $nombreExamen);
				//Si se regresa TRUE de la eliminación mostramos éxito, de lo contrario mostramos lo que nos regrese el modelo
				if($result)
					echo 'Se agrego correctamente';
				else
					echo $result;
			}
			$vista = $header . $menu . $vista . $footer;
			echo $vista;
		}

		/**
		 *Elimina uno o más exámenes de la base de datos
		*/
		function eliminar()
		{
			//Cargamos los archivos necesarios para la vista 
			$vista=file_get_contents('app/vistas/ModElimExamen.php');
			if(esAdmin())
				$menu=file_get_contents('app/vistas/MenuAdmin.php');
			else if (esModerador())
				$menu = file_get_contents('app/vistas/MenuMod.php');
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
				if($result == 1)
					$vista = str_replace($fila, '<p>Se elimino correctamente</p>', $vista);
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
			$filas='';
			$Diccionario = array(
				'{Categoria}' => 'POO',
				'{No. Pregunta}' => '5',
				'{Total preguntas}' => '8',
				'{Pregunta}' => '¿Nos va a Pasar?',
				'{Respuesta}' => '<form><input type="radio"name="option">Si<br><input type="radio" name="option">No<br></form>',
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
				if(esAdmin())
					$menu=file_get_contents('app/vistas/MenuAdmin.php');
				else if (esModerador())
					$menu = file_get_contents('app/vistas/MenuMod.php');
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
					$vista = str_replace($fila, '<p>No se encontro el examen</p>', $vista);
				}
				$vista = $header.$menu.$vista.$footer;
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
		function llenarID($ID,$vista)
		{
			$inicio_ID= strrpos($vista, '<input id="id"');
			$fin_ID = strrpos($vista, '</div>') + 7;
			$input = substr($vista, $inicio_ID,$fin_ID-$inicio_ID);
			if(isset($ID))
			{
				$nuevoInput = $input;
				$diccionario = array('{ID}' => $ID);
				$nuevoInput = strtr($nuevoInput,$diccionario);

				$vista = str_replace($input, $nuevoInput, $vista);
			}

			else
			{
				$vista = str_replace($input,'', $vista);
			}
			return $vista;
		}
	}
 ?>
