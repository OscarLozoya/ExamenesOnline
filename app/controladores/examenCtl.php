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
							if(isset($_GET['response'])=='buscar')
								$this->buscarUsuario();
							else
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
						case 'calificar':
							$this->calificar();
							break;
						default:
							carga_inicio();
							break;
					}
				}
				else if(esUsuario())
				{
					switch ($_GET['accion']) {
						case 'vista':
							$this->vista();
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
			//Cargamos el menú según sea el tipo de usuario 
			if(esAdmin())
				$menu=file_get_contents('app/vistas/MenuAdmin.php');
			else if(esModerador())
				$menu=file_get_contents('app/vistas/MenuMod.php');
			//Cargamos los archivos necesarios para la vista
			$footer=file_get_contents('app/vistas/Footer.php');
			$header=file_get_contents('app/vistas/Header.php');
			$vista=file_get_contents('app/vistas/CrearExamen.php');

			//Mostramos las categorías que están registradas en la base de datos, esto se hace cada que ingresa a la pagina
			$categoria = $this->modelo->obtenerCategorias();
			$vista = $this->llenarCategoria($categoria,$vista);
			//Buscamos el ID del ultimo elemento para mostrarlo en el campo ID
			$ultimo = $this->modelo->buscarUltimo();
			$vista = $this->llenarID($ultimo,$vista);
			$vista=str_replace('{nombreExamen}', '', $vista);
			$vista=str_replace('{inicio_idExamen}', '', $vista);
			$vista=str_replace('{fin_idExamen}', '', $vista);

			$vista=str_replace('{Usuario}', '', $vista);
			$vista=str_replace('{Nombre}', '', $vista);
			$vista=str_replace('{Apellido Paterno}', '', $vista);
			$vista=str_replace('{Apellido Materno}', '', $vista);
			$vista=str_replace('{Universidad}', '', $vista);
			$vista=str_replace('<td><input name="seleccion" type="checkbox"></td>', '', $vista);

			//Buscamos la fila en la tabla para mostrar posibles mensajes del modelo
			$inicio_fila = strrpos($vista,'<tr>');
			$fin_fila = strrpos($vista, '</tr>')+5;
			$fila = substr($vista,$inicio_fila,$fin_fila-$inicio_fila);

			//Si el usuario ha completado el formulario trabajamos con los datos que ingreso, en caso contrario mostramos el formulario para ser completado
			if(!empty($_POST['nombreExamen']))
			{
				//Obtenemos los valores del formulario y los pasamos a la funcion del modelo para ser trabajados
				$categoria = $_POST['categoria'];
				$cantidadPreguntas = $_POST['cantidadPreguntas'];
				$tiempoLimite = $_POST['tiempoLimite'];
				$calificacionMinima = $_POST['calificacionMinima'];
				$nombreExamen = $_POST['nombreExamen'];

				$result = $this->modelo->crear($categoria, $cantidadPreguntas, $tiempoLimite, $calificacionMinima, $nombreExamen);
				//Si se regresa TRUE de la eliminación mostramos éxito, de lo contrario mostramos el error 

				if(!empty($_POST['id-usuario']))
				{
					$idUsuario = '';
					$idUsuario = $_POST['id-usuario'];

					$result = $this->modelo->asignar($idUsuario,$ultimo);
					//Si se regresa TRUE de la eliminación mostramos éxito, de lo contrario mostramos lo que nos regrese el modelo
					if($result)
						$vista = str_replace($fila, '<p>Se creo y asigno correctamente</p>', $vista);
					else
						$vista = str_replace($fila, $result, $vista);
				}
			}
			//Concatenamos los archivos necesarios para la ventana y mostramos la vista
			$vista = $header . $menu . $vista . $footer;
			echo $vista;
		}

		function modificar()
		{
			//Cargamos los archivos necesarios para la vista 
			$vista=file_get_contents('app/vistas/ModElimExamen.php');
			//Cargamos el menú según sea el tipo de usuario 
				if(esAdmin())
					$menu=file_get_contents('app/vistas/MenuAdmin.php');
				else if(esModerador())
					$menu=file_get_contents('app/vistas/MenuMod.php');
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

		/**
		 *Elimina uno o más exámenes de la base de datos
		*/
		function eliminar()
		{
			//Cargamos los archivos necesarios para la vista 
			$vista=file_get_contents('app/vistas/ModElimExamen.php');
			//Cargamos el menú según sea el tipo de usuario 
			if(esAdmin())
				$menu=file_get_contents('app/vistas/MenuAdmin.php');
			else if(esModerador())
				$menu=file_get_contents('app/vistas/MenuMod.php');
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
			if(empty($_POST))
			{
				$vista = file_get_contents("app/vistas/VistaExamen.php");
				$footer = file_get_contents("app/vistas/Footer.php");
				if(isset($_GET['ID']))
				{
					$IDExamen = $_GET['ID'];
					$Examen = $this->modelo->Examen($IDExamen);
					$DetalleExamen = $Examen[0]['Examen'];
					$Preguntas = $Examen[0]['Preguntas'];
					$vista = str_replace('{Examen}', $DetalleExamen[0]['Nombre'], $vista);
					$vista = str_replace('{Tiempo}', $DetalleExamen[0]['Duracion'], $vista);
					$vista = str_replace('{Total_preguntas}', $DetalleExamen[0]['Num_Preguntas'], $vista);

					$inicio_pregunta = strrpos($vista,'{ini_pregunta}');
					$fin_pregunta = strrpos($vista, '{fin_pregunta}')+14;
					$renglonPregunta = substr($vista, $inicio_pregunta,$fin_pregunta-$inicio_pregunta);
					$TotalPreguntas = '';
					foreach ($Preguntas as $pregunta) {
						$newPregunta = $renglonPregunta;
						$diccionario = array('{Pregunta}' => $pregunta['Descripcion'],
											'{Respuesta}' => $pregunta['Respuesta']);
						$newPregunta = strtr($newPregunta, $diccionario);
						$TotalPreguntas .= $newPregunta;
					}
					$vista = str_replace($renglonPregunta, $TotalPreguntas, $vista);
					$vista = str_replace('{ini_pregunta}', '', $vista);
					$vista = str_replace('{fin_pregunta}', '', $vista);
				}
				else
				{
					carga_inicio();
					return;
				}
				echo $vista.$footer;
			}
			else
			{
				$Respuestas_Correctas = 0;
				if(isset($_GET['ID']))
				{
					$ID = $_GET['ID'];
					$Num_Preguntas = $this->modelo->numPreguntasExamen($ID);
					if(is_numeric($Num_Preguntas) && $Num_Preguntas > 0)
					{
						for ($i=0; $i < $Num_Preguntas ; $i++) { 
							if(isset($_POST[$i.'|abierta']))
							{
								$ID_Pregunta = $_POST[$i.'|abierta'];
								$RespuestaAbierta = $_POST[$i];
								$this->modelo->guardarRespuesta($ID,$ID_Pregunta,$RespuestaAbierta,-1);
							}
							else if(isset($_POST[$i]))
							{
								$respuestai = $_POST[$i];
								$array = explode('|', $respuestai);
								$correcto = $this->modelo->verRespuesta($array[0],$array[1]);
								if($correcto == 1)
									$Respuestas_Correctas++;
								$this->modelo->guardarRespuesta($ID,$array[0],$array[1],$correcto);
							}
						}
						$Promedio = ($Respuestas_Correctas*100)/$Num_Preguntas;
						$this->modelo->guardarResultadoExamen($ID,$Promedio);
					}
					else
						carga_inicio();
				}
				else
				{
					carga_inicio();
					return;
				}
				carga_inicio();

			}

				
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
					$vista = str_replace($fila, '<p>No se encontro el examen</p>', $vista);
				}
				$vista = $header.$vista.$footer;
				echo $vista;
			}
		}
		/**
		 *Busca en la base de datos los usuarios que coincidan con los criterios de busqueda ingresados en los campos de usuario
		*/
		function buscarUsuario()
		{
			//Si no se recibe nada por POST mostramos solo la vista
			if(empty($_POST))
				require_once('app/vistas/CrearExamen.php');
			else
			{
				//Cargamos el menú según sea el tipo de usuario 
				if(esAdmin())
					$menu=file_get_contents('app/vistas/MenuAdmin.php');
				else if(esModerador())
					$menu=file_get_contents('app/vistas/MenuMod.php');
				//Cargamos los archivos necesarios para la vista 
				$vista=file_get_contents('app/vistas/CrearExamen.php');
				$header=file_get_contents('app/vistas/Header.php');
				$footer=file_get_contents('app/vistas/Footer.php');

				$categoria = $this->modelo->obtenerCategorias();
				$vista = $this->llenarCategoria($categoria,$vista);
				//Buscamos el ID del ultimo elemento para mostrarlo en el campo ID
				$ultimo = $this->modelo->buscarUltimo();
				$vista = $this->llenarID($ultimo,$vista);
				$vista=str_replace('{nombreExamen}', '', $vista);
				$vista=str_replace('{inicio_idExamen}', '', $vista);
				$vista=str_replace('{fin_idExamen}', '', $vista);

				//Guardamos los valores obtenidos por POST para el campo de búsqueda
				$nombreUsuario = $_POST['nombreUsuario'];
				//Guardamos lo que nos regresó el modelo
				$Usuarios= $this->modelo->buscarUsuario($nombreUsuario);
				//Buscamos la fila en la tabla para mostrar lo obtenido del modelo
				$inicio_fila = strrpos($vista,'<tr>');
				$fin_fila = strrpos($vista, '</tr>')+5;
				$fila = substr($vista,$inicio_fila,$fin_fila-$inicio_fila);
				$filas = "";
				//Si nos regresó algo el modelo lo mostramos
				if(isset($Usuarios))
				{
					$new_fila="";
					foreach ($Usuarios as $row) {
						$new_fila = $fila;
						$diccionario = array('{Usuario}' => $row['Usuario'],
											'{Nombre}' => $row['Nombres'],
											'{Apellido Paterno}' => $row['Apellido_P'],
											'{Apellido Materno}' => $row['Apellido_M'],
											'{Universidad}' => $row['Universidad']);
						//var_dump($diccionario);
						$new_fila = strtr($new_fila,$diccionario);
						$filas .= $new_fila;
					}
					$vista = str_replace($fila, $filas, $vista);
				}
				else
				{
					//Si no mostramos un mensaje
					$vista = str_replace($fila, '<p>No se encontró el usuario</p>', $vista);
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
			$inicio_categoria = strrpos($vista, '{inicio_categoria}');
			$fin_categoria = strrpos($vista, '{fin_categoria}') + 14;
			$option = substr($vista, $inicio_categoria,$fin_categoria-$inicio_categoria);
			$options = '';
			if(isset($categoria))
			{
				foreach ($categoria as $row) {
					$newOption=$option;
					$diccionario = array('{Categoria}' => $row['Nombre_Categoria'],
											'{ID_Categoria}' => $row['ID_Categoria']);
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
			$inicio_ID= strrpos($vista, '{inicio_idExamen}');
			$fin_ID = strrpos($vista, '{fin_idExamen}') + 14;
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

		function calificar()
		{
			if(!empty($_POST))
			{
				$usuario = $_POST['usuario'];
				$ID_Examen = $_POST['ID_Examen'];
				$ID_Pregunta = $_POST['ID_Pregunta'];
				$respuesta = $_POST['respuesta'];
				$resultado = $_POST['resultado'];
				$this->modelo->respuestasAbiertas($usuario,$ID_Examen,$ID_Pregunta,$respuesta,$resultado);
			}
			carga_inicio();
		}
	}
 ?>

