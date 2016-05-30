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
			$Parametro = $_POST['parametro'];
			$Resultado = null;
			if (isset($Parametro)) 
			{
				 $Resultado = $this->modelo->buscaCategoria($Parametro);
				 var_dump($Resultado);
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
			$NombreCat =$_POST['nombreCategoria'];
			if(isset($NombreCat))
			{	
				$Resultado = $this->modelo->AgregarCategoria($NombreCat);
				if ($Resultado)
					$this->muestraPanel(1);
				else
					$this->muestraPanel(2);
			}
			else
				$this->muestraPanel(0);
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

		function muestraPanel($tipo)
		{
			if (isset($tipo)) {
				$header = file_get_contents("app/vistas/Header.php"); 
				$menu = file_get_contents(devuelveMenu());
				$vista = file_get_contents("app/vistas/AdministrarCategoria.php");
				$footer = file_get_contents("app/vistas/Footer.php");
				$Ultimo_ID = $this->modelo->buscaUltimo();
				$Notificacion = $this->devNotificacion($tipo);
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
				default:
					$Notificacion = null;
					break;
			}
			return $Notificacion;
		}

	}
 ?>