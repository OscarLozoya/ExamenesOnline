<?php 
	/**
	* 
	*/
	class categoriaCtl
	{
		
		public $modelo;
			function __construct()
		{
			include_once('app/modelos/categoriaMdl.php');
			$this->modelo=new CategoriaMdl();
		}

		function ejecutar()
		{
			if(isset($_GET['accion']))
			{
				if(esAdmin())
				{
					switch ($_GET['accion']) {
						case 'panel':
							$this->muestraPanel(0);
							break;
						case 'agregar':
							$this->agregar();
							break;
						case 'buscar':
							$this->buscar();
							break;
						case 'eliminar':
							$this->eliminar();
							break;
						case 'modificar':
							$this->modificar();
							break;
						case 'actualizar':
							$this->actualizar();
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
		function buscar(){
			
			$Resultado = null;
			if (isset($_POST['parametro'])) 
			{
				$Parametro = $_POST['parametro'];
				 $Resultado = $this->modelo->buscaCategoria($Parametro);
				 if(isset($Resultado))
				 { 	
					$header = file_get_contents("app/vistas/Header.php"); 
					$menu = file_get_contents(devuelveMenu());
					$vista = file_get_contents("app/vistas/AdministrarCategoria.php");
					$footer = file_get_contents("app/vistas/Footer.php");
					$Ultimo_ID = $this->modelo->buscaUltimo();
					$Notificacion = $this->devNotificacion(0);
					$inicioFila = strrpos($vista, '{inicia_FilaTabla}');
					$finFila = strrpos($vista, '{fin_FilaTabla}')+15;
					$Fila = substr($vista, $inicioFila,$finFila-$inicioFila);
					$newFilas ='';
					foreach ($Resultado as $result) {
						$nodoFila = $Fila;
						$dic = array('{ID_Categoria}' => $result['Id'],
												 '{Nombre}' => $result['Nombre'],
												 '{valorRadio}' => $result['Id'],
												 '{inicia_FilaTabla}' => '',
												 '{fin_FilaTabla}' => ''
							          );
						$nodoFila = strtr($nodoFila,$dic);
						$newFilas .= $nodoFila;
					}
					$vista = str_replace($Fila, $newFilas, $vista);
					$Diccionario = array(	'{valorID}' => $Ultimo_ID,
																'{valorCategoria}' => '',
																'{Notificacion}' =>$Notificacion
															);
				  $vista = strtr($vista,$Diccionario);

				  echo $header.$menu.$vista.$footer;
				 }
				 else
				 	$this->muestraPanel(3);
			}
			else
				 $this->muestraPanel(3);
		}

		function agregar(){
			if(isset($_POST['nombreCategoria']))
			{	
				$NombreCat =$_POST['nombreCategoria'];
				$Resultado = $this->modelo->AgregarCategoria($NombreCat);
				if ($Resultado)
					$this->muestraPanel(1);
				else
					$this->muestraPanel(2);
			}
			else
				$this->muestraPanel(0);
		}
		
		function eliminar()
		{
			if (isset($_POST['categoria'])) 
			{
				$Id_Cat = $_POST['categoria'];
				$Resultado = $this->modelo->eliminaCategoria($Id_Cat);
				if ($Resultado) 
					$this->muestraPanel(4);
				else
					$this->muestraPanel(5);
			}
			else
				$this->muestraPanel(0);
		}

		function modificar()
		{
			if (isset($_POST['categoria'])) 
			{
				$Id_Cat = $_POST['categoria'];
				$Resultado = $this->modelo->buscaCategoriaE($Id_Cat);
				if (isset($Resultado)) 
				{
					$header = file_get_contents("app/vistas/Header.php"); 
					$menu = file_get_contents(devuelveMenu());
					$vista = file_get_contents("app/vistas/AdministrarCategoria.php");
					$footer = file_get_contents("app/vistas/Footer.php");
					
					$Notificacion = $this->devNotificacion(6);
					$inicioFila = strrpos($vista, '{inicia_FilaTabla}');
					$finFila = strrpos($vista, '{fin_FilaTabla}')+15;
					$Fila = substr($vista, $inicioFila,$finFila-$inicioFila);
					$newFilas ='';
					$vista = str_replace($Fila, $newFilas, $vista);
					$Diccionario = array('{inicia_FilaTabla}' => '',
																'{ID_Categoria}' => '',
																'{Nombre}' =>'',
																'{fin_FilaTabla}'=> '',
																'{valorID}' => $Resultado['Id'],
																'{valorCategoria}' => $Resultado['Nombre'],
																'{Notificacion}' =>$Notificacion,
																'<form action="index.php?controlador=categoria&accion=agregar" method="post">' => '<form action="index.php?controlador=categoria&accion=actualizar" method="post">',
																'>Agregar</button>' => '>Actualizar</button>'
															);
					$vista = strtr($vista,$Diccionario);
					echo $header.$menu.$vista.$footer;
				}
				else
					$this->muestraPanel(7);
			}
			else
				$this->muestraPanel(7);
			
		}

		function actualizar(){
			if(isset($_POST['nombreCategoria']))
			{	
				$NombreCat =$_POST['nombreCategoria'];
				$IdCat =$_POST['idCat'];
				$Resultado = $this->modelo->actualizaCategoria($IdCat,$NombreCat);
				if ($Resultado)
					$this->muestraPanel(8);
				else
					$this->muestraPanel(7);
			}
			else
				$this->muestraPanel(7);
		}
		function muestraPanel($tipo)
		{
			if (isset($tipo)) {
				$header = file_get_contents("app/vistas/Header.php"); 
				$menu = file_get_contents(devuelveMenu());
				$vista = file_get_contents("app/vistas/AdministrarCategoria.php");
				$footer = file_get_contents("app/vistas/Footer.php");
				$Ultimo_ID = $this->modelo->buscaUltimo();
				$Notificacion = $this->devNotificacion($tipo);
				$inicioFila = strrpos($vista, '{inicia_FilaTabla}');
				$finFila = strrpos($vista, '{fin_FilaTabla}')+15;
				$Fila = substr($vista, $inicioFila,$finFila-$inicioFila);
				$newFilas ='';
				$vista = str_replace($Fila, $newFilas, $vista);
				$Diccionario = array('{inicia_FilaTabla}' => '',
															'{ID_Categoria}' => '',
															'{Nombre}' =>'',
															'{fin_FilaTabla}'=> '',
															'{valorID}' => $Ultimo_ID,
															'{valorCategoria}' => '',
															'{Notificacion}' =>$Notificacion
														);
				$vista = strtr($vista,$Diccionario);
				echo $header.$menu.$vista.$footer;
			}

		}

		function devNotificacion($tipo)
		{
			$Notificacion = null;
			switch ($tipo) {
				case '0':
					$Notificacion = "";
					break;
				case '1':
					$Notificacion = "<label class='text-center' style='display: block'>Se agrego la Categoria</label>";
					break;
				case '2':
					$Notificacion = "<label class='text-center Warning' style='display: block'>No se agrego la Categoria</label>";
					break;
				case '3':
					$Notificacion = "<label class='text-center Warning' style='display: block'>No se encontraron coincidencias</label>";
					break;
				case '4':
					$Notificacion = "<label class='text-center' style='display: block'>Se elimino la Categoria</label>";
					break;
				case '5':
					$Notificacion = "<label class='text-center Warning' style='display: block'>No se elimino la Categoria</label>";
					break;
				case '6':
					$Notificacion = "<label class='text-center Warning' style='display: block'>Para actualizar es necesario presionar el boton actualizar</label>";
					break;
				case '7':
					$Notificacion = "<label class='text-center Warning' style='display: block'>Ha ocurrido un error</label>";
					break;
				case '8':
					$Notificacion = "<label class='text-center' style='display: block'>Se ha actualizado la categoria</label>";
					break;
				default:
					$Notificacion = null;
					break;
			}
			return $Notificacion;
		}

	}
 ?>