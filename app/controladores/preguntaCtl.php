<?php 
	/**
	* 
	*/
	class preguntaCtl
	{
		private $modelo;
		function __construct()
		{
			include_once('app/modelos/preguntaMdl.php');
			$this->modelo=new PreguntaMdl();
		}

		function ejecutar()
		{
			if(isset($_GET['accion']))
			{
				if(esAdmin()||esModerador())
				{
					switch ($_GET['accion']) {
						case 'agregar':
							if(isset($_GET['ID']))
								$this->modificar($_GET['ID']);							
							else
								$this->agregar();
							break;
						case 'buscar':
							if(isset($_GET['response'])=='eliminar')
								$this->eliminar();
							else
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
			$vista = file_get_contents('app/vistas/AgregarPregunta.php');
			if(esAdmin())
				$menu=file_get_contents('app/vistas/MenuAdmin.php');
			else if (esModerador())
				$menu = file_get_contents('app/vistas/MenuMod.php');
			$header=file_get_contents('app/vistas/Header.php');
			$footer=file_get_contents('app/vistas/Footer.php');

			$categoria = $this->modelo->obtenerCategorias();
			$vista = $this->llenarCategoria($categoria,$vista);

			$vista=str_replace('{ID_Pregunta}', '', $vista);
			$vista=str_ireplace('{Pregunta}', '', $vista);
			$inicio_fila = strrpos($vista,'{ini_resultado}');
			$fin_fila = strrpos($vista, '{fin_resultado}')+15;
			$fila = substr($vista,$inicio_fila,$fin_fila-$inicio_fila);

			$inicio_categoria = strrpos($vista, '{inicia_Categoria}');
			$fin_categoria = strrpos($vista, '{fin_categoria}')+15;
			$fila_Categoria = substr($vista, $inicio_categoria,$fin_categoria-$inicio_categoria);
			$vista = str_replace($fila_Categoria, '', $vista);

			$inicio_respuesta = strrpos($vista, '{inicia_respuesta}');
			$fin_respuesta = strrpos($vista, '{fin_respuesta}')+15;
			$fila_respuesta = substr($vista, $inicio_respuesta,$fin_respuesta-$inicio_respuesta);
			$vista = str_replace($fila_respuesta, '', $vista);

			if(!empty($_POST))
			{
				$pregunta = $_POST['Pregunta'];
				$categorias = $_POST['id_categorias'];
				$respuesta = $_POST['id_respuestas'];
				$result = $this->modelo->agregar($pregunta,$categorias,$respuesta);
				if($result == 1)
					$vista = str_replace($fila, "Se agrego correctamente", $vista);
				else
					$vista = str_replace($fila, $result, $vista);
			}
			else
			{
				$vista = str_replace($fila, '', $vista);
				$vista = str_replace('{accion}', 'index.php?controlador=pregunta&accion=agregar', $vista);
			}
			$vista = $header . $menu . $vista . $footer;
			echo $vista;
		}

		function buscar()
		{
			$vista = file_get_contents('app/vistas/BuscarPregunta.php');
			if(esAdmin())
				$menu=file_get_contents('app/vistas/MenuAdmin.php');
			else if (esModerador())
				$menu = file_get_contents('app/vistas/MenuMod.php');
			$header=file_get_contents('app/vistas/Header.php');
			$footer=file_get_contents('app/vistas/Footer.php');

			$categoria = $this->modelo->obtenerCategorias();
			$vista = $this->llenarCategoria($categoria,$vista);

			$vista=str_replace('{ID_Pregunta}', '', $vista);
			$vista=str_ireplace('{Pregunta}', '', $vista);
			$inicio_fila = strrpos($vista,'<tr>');
			$fin_fila = strrpos($vista, '</tr>') + 5;
			$fila = substr($vista,$inicio_fila,$fin_fila-$inicio_fila);
			$filas = '';
			if(!empty($_POST))				
			{
				$ID = $_POST['ID'];
				$Pregunta = $_POST['Pregunta'];
				$Categoria = $_POST['Categoria'];
				$result = $this->modelo->buscar($ID,$Pregunta,$Categoria);
				if(isset($result))
				{
					if(is_array($result))
					{
						$newFila = '';
						foreach ($result as $row) {
							$newFila = $fila;
							$diccionario = array('{ID}' => $row['ID'],
												'{Descripcion}' => $row['Descripcion'],
												'{Categoria}' => $row['Categoria']);
							$newFila = strtr($newFila, $diccionario);
							$filas .= $newFila;
						}
						$vista = str_replace($fila, $filas, $vista);
					}
					else
						$vista = str_replace($fila, '<p>'.$result.'</p>', $vista);
				}
				else
					$vista = str_replace($fila, '<p>No se encontro la Pregunta</p>', $vista);
			}
			else
				$vista = str_replace($fila, '', $vista);

			$vista = $header.$menu.$vista.$footer;
			echo $vista;
		}

		function modificar($ID)
		{
			$header=file_get_contents('app/vistas/Header.php');
			$footer=file_get_contents('app/vistas/Footer.php');
			if(esAdmin())
				$menu=file_get_contents('app/vistas/MenuAdmin.php');
			else if (esModerador())
				$menu = file_get_contents('app/vistas/MenuMod.php');
			if(empty($_POST))
			{
				$vista = file_get_contents('app/vistas/AgregarPregunta.php');

				$categoria = $this->modelo->obtenerCategorias();
				$vista = $this->llenarCategoria($categoria,$vista);	
				$vista = str_replace('{ID_Pregunta}', $ID, $vista);
				$vista = str_replace('{accion}', 'index.php?controlador=pregunta&accion=agregar&ID='.$ID, $vista);
				$Pregunta = $this->modelo->obtenerPregunta($ID);
				$vista =str_replace('{Pregunta}', $Pregunta[0]['Descripcion'], $vista);

				$inicio_fila = strrpos($vista,'{ini_resultado}');
				$fin_fila = strrpos($vista, '{fin_resultado}')+15;
				$fila = substr($vista,$inicio_fila,$fin_fila-$inicio_fila);
				$vista = str_replace($fila, '', $vista);

				$inicia_categoria = strrpos($vista, '{inicia_Categoria}');
				$fin_categoria = strrpos($vista, '{fin_categoria}')+15;
				$fila_Categoria = substr($vista, $inicia_categoria,$fin_categoria-$inicia_categoria);
				$CategoriaPregunta = $this->modelo->categoriasPregunta($ID);
				$filas_Categorias = '';
				$id_categorias = '';
				foreach ($CategoriaPregunta as $row) {
					$id_categorias .= $row['ID'].',';
					$newFila = $fila_Categoria;
					$diccionario = array('{ID_Categoria}' => $row['ID'],
										'{Nombre}' => $row['Nombre']);
					$newFila = strtr($newFila,$diccionario);
					$newFila = str_replace('{inicia_Categoria}', '', $newFila);
					$newFila = str_replace('{fin_categoria}', '', $newFila);
					$filas_Categorias .= $newFila;
				}
				$vista = str_replace($fila_Categoria, $filas_Categorias, $vista);
				$vista = str_replace('{id_categorias}', $id_categorias, $vista);

				$inicio_respuesta = strrpos($vista, '{inicia_respuesta}');
				$fin_respuesta = strrpos($vista, '{fin_respuesta}')+15;
				$fila_respuesta = substr($vista, $inicio_respuesta,$fin_respuesta-$inicio_respuesta);
				if($Pregunta[0]['Tipo']==1)
				{
					$filas_Respuesta = '';
					$Respuesta = $this->modelo->respuestasPregunta($ID);
					if(isset($Respuesta))
					{
						foreach ($Respuesta as $row) {
							$newFila = $fila_respuesta;
							if($row['Respuesta'] == 1)
							{
								$diccionario = array('{respuesta}' => $row['Descripcion'],
													'{correcto}' => 'checked');
							}
							else
							{
								$diccionario = array('{respuesta}' => $row['Descripcion'],
													'{correcto}' => '');
							}
							$newFila = strtr($newFila, $diccionario);
							$newFila = str_replace('{inicia_respuesta}', '', $newFila);
							$newFila = str_replace('{fin_respuesta}', '', $newFila);
							$filas_Respuesta .= $newFila;
						}
						$vista = str_replace($fila_respuesta, $filas_Respuesta, $vista);
					}
					else
						$vista = str_replace($fila_respuesta,'', $vista);
				}
				else
					$vista = str_replace($fila_respuesta, '', $vista);			
			}
			else
			{
				$vista = file_get_contents('app/vistas/BuscarPregunta.php');

				$categoria = $this->modelo->obtenerCategorias();
				$vista = $this->llenarCategoria($categoria,$vista);

				$vista=str_replace('{ID_Pregunta}', '', $vista);
				$vista=str_ireplace('{Pregunta}', '', $vista);
				$inicio_fila = strrpos($vista,'<tr>');
				$fin_fila = strrpos($vista, '</tr>') + 5;
				$fila = substr($vista,$inicio_fila,$fin_fila-$inicio_fila);

				$ID = $_GET['ID'];
				$Pregunta = $_POST['Pregunta'];
				$Categoria = $_POST['id_categorias'];
				$Respuesta = $_POST['id_respuestas'];
				$result = $this->modelo->modificarPregunta($ID,$Pregunta,$Categoria,$Respuesta);
				if($result == 1)
					$vista = str_replace($fila, '<p>Se modifico correctamente</p>', $vista);
				else
					$vista = str_replace($fila, $result, $vista);
			}

			$vista = $header.$menu.$vista.$footer;
			echo $vista;
		}

		function eliminar()
		{
			$vista = file_get_contents('app/vistas/BuscarPregunta.php');
			if(esAdmin())
				$menu=file_get_contents('app/vistas/MenuAdmin.php');
			else if (esModerador())
				$menu = file_get_contents('app/vistas/MenuMod.php');
			$header=file_get_contents('app/vistas/Header.php');
			$footer=file_get_contents('app/vistas/Footer.php');

			$categoria = $this->modelo->obtenerCategorias();
			$vista = $this->llenarCategoria($categoria,$vista);

			$vista=str_replace('{ID_Pregunta}', '', $vista);
			$vista=str_ireplace('{Pregunta}', '', $vista);
			$inicio_fila = strrpos($vista,'<tr>');
			$fin_fila = strrpos($vista, '</tr>') + 5;
			$fila = substr($vista,$inicio_fila,$fin_fila-$inicio_fila);

			if(!empty($_POST))
			{
				$ID = '';
				$ID=$_POST['id-eliminar'];
				$result = $this->modelo->eliminar($ID);
				if($result == 1)
					$vista = str_replace($fila, '<p>Se elimino correctamente</p>', $vista);
				else
					$vista = str_replace($fila, $result, $vista);
			}
			else
				$vista = str_replace($fila, '', $vista);

			$vista = $header.$menu.$vista.$footer;
			echo $vista;
		}


		/**
		 *Llena la vista con las categorías obtenidas del modelo
		 *@param $categoria Recibe lo obtenido de la consulta a la base de datos 
		 *@param $vista string con la vista donde se van a sustituir
		 *@return string con la vista sustituida
		*/
		function llenarCategoria($categoria,$vista)
		{
			$inicio_categoria = strrpos($vista, '{inicio_catego}');
			$fin_categoria = strrpos($vista, '{fin_catego}') + 12;
			$option = substr($vista, $inicio_categoria,$fin_categoria-$inicio_categoria);
			$options = '';
			if(isset($categoria))
			{
				foreach ($categoria as $row) {
					$newOption = $option;
					$diccionario = array('{nombre-categoria}' => $row['Nombre'],
											'{id-categoria}' => $row['ID']);
					$newOption = strtr($newOption,$diccionario);
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