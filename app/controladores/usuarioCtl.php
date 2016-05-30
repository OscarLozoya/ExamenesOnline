<?php 
	/**
	* 
	*/
	class usuarioCtl{
		public $modelo;
		function __construct()
		{
			include_once('app/modelos/usuarioMdl.php');
			$this->modelo=new usuarioMdl();
		}
		public function ejecutar()
		{
			if(inicioSesion())
			{
				if(isset($_GET['accion']))
				{
					if(esAdmin())
					{
						switch ($_GET['accion']) 
						{
							case 'Alta'://Llamada del administrador para registrar en la plataforma
								$this->Alta();
						  break;
							case 'Baja'://Llamada del administrador para eliminar un usuario
							  	$this->Baja();
							  break;
							case 'Modificar'://Llamada del administrador para modificar eltipo de un usuario
							  	$this->Modificar();
							  break;
							case 'Perfil'://Llamada al perfil del administrador
							    if (isset($_GET['response']))
							    	$this->actualizarPerfil();
							    else
							    	$this->MostrarPerfil(1);
							  break;
							case 'salir':
								 	$this->salir();
								 	carga_inicio();
							 	break;
							default://Si existe alguna incongruencia manda al inicio del usuario
								carga_inicio();
								break;
						}
					}
					if(esModerador() || esUsuario())
					{
						switch ($_GET['accion']) 
						{
							case 'Perfil'://Llamada al perfil del usuario
							    if (isset($_GET['response']))
							    	$this->actualizarPerfil();
							    else
							    	$this->MostrarPerfil(1);
							  break;
					  	case 'cambioContrasena':
					 			  $this->cambioContrasena();
					 		  break;
						  case 'detalleExamen'://Solo disponible para usuario normal
						    if(esUsuario())
						 			$this->detalleExamen();
						 		else
						 			carga_inicio();
						 		break;
							case 'salir':
								 	$this->salir();
								 	carga_inicio();
							 	break;
							default://Si existe alguna incongruencia manda al inicio del usuario
								carga_inicio();
								break;
						}
					}
				}
				else //Sentencia else en caso de que no se especifique una acción, nos muestra la página según seea el caso
					carga_inicio();
			}
			else
			{//En caso de que no este logedo o sea un invitado o se un usuario no Activo
				if(isset($_GET['accion']))
				{
					switch ($_GET['accion']) 
					{
						case 'ingresar':
						 		$this->ingresar();
						 	break;
						case 'restablecerContrasena':
					 			$this->restablecerContrasena();
					 		break;
					 	case 'Registro':
					 			$this->Registrar();
					 		break;
					 	case 'completarRegistro':
							 	if (isset($_GET['response'])) 
							 		$this->completarRegistro();
							 	else if (esNoActivo())
							 		$this->actualizarPerfil();
					 		break;
						default:
								carga_inicio();
							break;
					}
				}
				else
					carga_inicio();
			}
		}
		/**Requiere documentar
				*/
		public function Alta()
		{
			if(!isset($_POST['usuario'])||!isset($_POST['correo'])||!isset($_POST['tipo'])) //Comprobar si el formulario para dar de alta ya se lleno, si no es asi muestra la vista para ser completado
			{
				/*Requiere documentar
				*/
				require_once("app/vistas/AdminAbcUser.php");
			}
			else // Si el formulario ya se lleno crea el token y guarda el registro en la base de datos
			{
				$correo = $_POST['usuario'];
				$token = hash("sha256",$correo); //Hace un hash del correo mediante sha256 para genera el token
				$token .= Time(); //Concatena el token con el tiempo al final de la cadena
				$usuario = $_POST['correo'];
				$tipo = $_POST['tipo'];
				$estado = "0";
				$this->modelo->alta($usuario,$correo,$token,$tipo,$estado);
				require_once("app/vistas/AdminAbcUser.php");
			}
		} 

    /**
    *Este apartado pre-registra al usuario que lo solicita y envia un email para que termine de registrarse
    *y cambie su estatus a activo pues si no lo esta no podra ingresar al sistema.
    */
		function Registrar()
		{
			$header = file_get_contents("app/vistas/Header.php");
			$vista = file_get_contents("app/vistas/Registro.php");
			$footer = file_get_contents("app/vistas/Footer.php");
			if(!isset($_POST['Usuario']) || !isset($_POST['correoElectronico']))
			{//Verificacion de que los campos no esten vacios
				$Dic1 = array('{label_exito}' => '<label type="hidden"></label>');//Si estan vacios los campos se muestra la vista y se oculta una label de control
			}
			else if(isset($_POST['Usuario']) || isset($_POST['correoElectronico'])){//Si se reciben datos por POST se ejecuta el proceso de registro recuperando los datos para enviar al modelo
				$Usuario = $_POST['Usuario'];
				$Correo = $_POST['correoElectronico'];
				$Token = hash("sha256",$Correo);
				$Token .=Time();//Se crea el token para enviar por correo
				$Tipo = "2";
				$Estado = "0";
				$result=$this->modelo->registrar($Usuario,$Correo,$Token,$Tipo,$Estado,'none');//Se hace la peticion al modelo para que pre-registre y mande el mail al usuario
			  if ($result)//Según sea el resultado se muestra una label para dar instrucciones al usuario
			  	$Dic1 = array('{label_exito}' => '<label class="col-xs-12"> Para completar tu Registro revisa tu correo electronico</label>');
			  else
			  	$Dic1 = array('{label_exito}' => '<label class="col-xs-12"> El usuario ya fue registrado revisa tu correo o vuelve a intentarlo</label>');
			}
			$vista = strtr($vista, $Dic1);//se reemplaza el cambio en la etiqueta de control
			echo $header.$vista.$footer;//Se muestra la vista
		}

		function Baja()
		{
			if(empty($_POST))
			{
				/*Requiere documentar
				*/
				require_once("app/vistas/AdminAbcUser.php");
			}
			else{
				
			}

		}

		function MostrarPerfil($opc)
		{
			/*if(empty($_POST))
			{*/
				$Usuario = $_SESSION['usuario'];
				$header = file_get_contents("app/vistas/Header.php");
				$menu = file_get_contents(devuelveMenu());
				$vista = file_get_contents("app/vistas/Perfil.php");
				$footer = file_get_contents("app/vistas/Footer.php");
				$DatosPersonales = $this->modelo->recuperaDatosPersonales($Usuario);
				//
				switch ($opc) {
					case '1':
						$ErrorCon = "";
						$Notificacion = "";
						break;
					case '2':
						$ErrorCon = "<label class='Warning' style='display: block'>La contraseña actual no coincide</label>";
						$Notificacion = "<label class='Warning text-center' style='display: block'> No se Actualizo la contraseña</label>";
						break;
					case '3':
					  $ErrorCon = "";
						$Notificacion = "<label class='text-center' style='display: block'>La contraseña fue Actualizada</label>";
						break;
					default:
						$ErrorCon="";
						$Notificacion = "";
						break;
				}
				$Diccionario  = array('{Nombre}' => $DatosPersonales['Nombre'],
															'{ApellidoP}' => $DatosPersonales['Apellido_P'],
															'{ApellidoM}' => $DatosPersonales['Apellido_M'],
															'{valorUniversidad}' => $DatosPersonales['Universidad'],
															'{valorCarrera}' => $DatosPersonales['Carrera'],
															'{valorPromedio}' => $DatosPersonales['Promedio'],
															'{seleccion'.$DatosPersonales['Estado']."}"  => "selected",
															'{selec'.(string)$DatosPersonales['Porcentaje'].'}' => "selected",
															'{TiempoRestante}' => $DatosPersonales['TiempoRestante'],
															'{ErrorContra}'=> $ErrorCon,
															'{Notificacion}'=> $Notificacion,
															'{Nombre Del Usuario}' => $_SESSION['usuario']
														 );
				$Horarios = $this->modelo->recuperaHorario($Usuario);
				$DicHorario = $this->creaHorarios($Horarios);


				$vista = strtr($vista,$Diccionario);
				if(isset($DicHorario))
					$vista = strtr($vista,$DicHorario);

				$Redes = $this->modelo->recuperaRedes($Usuario);
				$vista = $this->creaRedes($Redes,$vista);

				$Telefonos = $this->modelo->recuperaTelefonos($Usuario);
				$vista = $this->creaTelefonos($Telefonos ,$vista);

				echo $header.$menu.$vista.$footer;
				//require_once("app/vistas/Perfil.php");
			/*}
			else
				carga_inicio();*/

		}

		/*
		*
		*/
		function creaHorarios($Horarios)//Crea el Diccionario para sustituir en la vista los horarios del Usuario
		{
			if(isset($Horarios))
			{
				$Diccionario = null;//Esta Variable sera un array del diccionario
				$Dias = array( //Este Arreglo es para controlar los dias que estan registrados y los que no 
												"Lunes" => "Lunes", 
											 "Martes" => "Martes", 
											 "Miercoles" => "Miercoles", 
											 "Jueves" => "Jueves", 
											 "Viernes" => "Viernes", 
											 "Sabado" => "Sabado"
										);
				foreach ($Horarios as $key) //Del arreglo que se pasa como parametro se hacen las iteraciones
				{
					//Se obtiene en cada iteracion los valores para que no exista conflicto
					$ValorDesde = file_get_contents("app/vistas/Valores00.php");
					$ValorHasta = file_get_contents("app/vistas/Valores00.php");
					$DiaConsult = $key['Dia'];//Se Obtiene la llave del Arreglo q se paso como parametro
					if(in_array($DiaConsult, $Dias))//Si el dia (llave) se encuentra dentro del arreglo de Dias se entiende que tiene valor Desde y Hasta Asignados 
					{
						$MiniDics ['{'.$key['Desde'].'}'] =  "selected";//Se hace uso de un MiniDiccionario para poder susbtituir en el texto que se obtuvo 
						$ValorDesde = strtr($ValorDesde,$MiniDics);//Se remplaza la llave en la cadena de valores por un selected que sera interpretado por el select
						unset($MiniDics);//Se Borra el Mini Diccionario ya que este solo debe de contener una llave por iteracion
						$MiniDics2 ['{'.$key['Hasta'].'}'] =  "selected";
						$ValorHasta = strtr($ValorHasta,$MiniDics2);
						unset($MiniDics2);
						unset($Dias[$DiaConsult]);//Se elimina el dia que se encontro para que se reduzca el tamaño del arreglo ya q se ocupara mas adelante 
						//Ya que se remplazo la llave en las cadenas es momento de crear el diccionario que se retorna
						$Diccionario['{Valores'.$DiaConsult.'Desde}'] = $ValorDesde;
						$Diccionario['{Valores'.$DiaConsult.'Hasta}'] = $ValorHasta;
					}
				}
				$ValorDesde = file_get_contents("app/vistas/Valores00.php");
				$ValorHasta = file_get_contents("app/vistas/Valores00.php");
				//Los dias que no se encontraron en la consulta se rellenaran en 00:00 a 24:00 es por esto que se deben de eliminar los encontrados
				foreach ($Dias as $Dia => $val) 
				{
						$Diccionario['{Valores'.$val.'Desde}'] = $ValorDesde;
						$Diccionario['{Valores'.$val.'Hasta}'] = $ValorHasta;

				}
				return $Diccionario;
			}
			else
				return null;
		}

		/**
		*
		*/
		function creaRedes($Redes,$vista)
		{
			$inicioRed = strrpos($vista, '{InicioRedes}');
			$finRed = strrpos($vista, '{FinRedes}') + 10;
			$EspRed= substr($vista, $inicioRed,$finRed-$inicioRed);
			$Urls = '';
   		if(isset($Redes))
			{
				foreach ($Redes as $fila) 
				{
					$NodoRed = $EspRed;
					$Diccionario = array('{valorRed}' => $fila['Url'],
															 '{glyIcon}' => $fila['Icon'],
															 '{idEsp}' => $fila['IdEsp'],
															 '{InicioRedes}' =>'',
															 '{FinRedes}' => '',
															  '{BtnAddRed}' => $fila['ClassBtn'],
																'{BtnRedClick}' => $fila['FunctionBtn'],
																'{toolTipRed}' => $fila['toolTip']
															);
					$NodoRed = strtr($NodoRed,$Diccionario);
					$Urls .= $NodoRed; 
				}
				$vista = str_replace($EspRed, $Urls, $vista);
			}
			else
			{
				$Diccionario = array(
														'{valorRed}' => "",
														'{glyIcon}' => "glyphicon glyphicon-plus",
														'{idEsp}' => "EspRedSocial",
														'{toolTipRed}' => "Agregar otra Red",
														'{BtnAddRed}' => "",
														'{BtnRedClick}' =>"NuevaRedSocial()",
														'{InicioRedes}' =>'',
														'{FinRedes}' => ''
														);

				$NodoRed = $EspRed;
			  $NodoRed = strtr($NodoRed,$Diccionario);
				$vista = str_replace($EspRed, $NodoRed, $vista);
			}
			return $vista;
		}

		function creaTelefonos($Resultados, $vista)
		{
			$inicioTelefono = strpos($vista, "{IniciaEspTelefono}");
			$finTelefono = strpos($vista, "{FinEspTelefono}") + 16;
			$EspTelefono = substr($vista, $inicioTelefono,$finTelefono - $inicioTelefono);
			$newTelefonos = '';
			if (isset($Resultados))
			{
				foreach ($Resultados as $fila) 
				{
					$NodoTel = $EspTelefono;
					$Diccionario = array( '{valorTelefono}' => $fila['Tel'],
																'{glyIconT}' => $fila['Icon'],
																'{idEspTel}' => $fila['IdEsp'],
																'{BtnAddTel}' => $fila['ClassBtn'],
																'{BtnTelClick}'	=> $fila['BtnFunction'],
																'{toolTipTel}' => $fila['toolTip'],
																'{IniciaEspTelefono}' => '',
																'{FinEspTelefono}' => ''
															);
					$NodoTel = strtr($NodoTel,$Diccionario);
					$newTelefonos .= $NodoTel;
				}
				$vista = str_replace($EspTelefono, $newTelefonos, $vista);
			}
			else
			{
				$Diccionario = array( '{valorTelefono}' => "",
																'{glyIconT}' => "glyphicon-plus",
																'{idEspTel}' => "EspTelefono",
																'{BtnAddTel}' => "",
																'{BtnTelClick}'	=> "NuevoTelefono()",
																'{toolTipTel}' => "Agregar otro Número",
																'{IniciaEspTelefono}' => '',
																'{FinEspTelefono}' => ''
															);
				$NodoTel = $EspTelefono;
				$NodoTel = strtr($NodoTel, $Diccionario);
				$vista = str_replace($EspTelefono, $NodoTel, $vista);
			}
			return $vista;
		}

		function cambioContrasena()
		{ 
			$contrasena_actual = $_POST['contrasena_actual'];
			$nueva_contrasena = $_POST['contrasena_confirmacion'];
			if(isset($contrasena_actual) && isset($nueva_contrasena))
			{
				$Usuario = $_SESSION['usuario'];
				$contrasenaBD = $this->modelo->recuperaContrasena($Usuario);
				if(isset($contrasenaBD))
				{
					if ($contrasenaBD == $contrasena_actual) {
						$Resultado = $this->modelo->NuevaContasena($Usuario,$nueva_contrasena);
						if($Resultado)
							$this->MostrarPerfil(3);
						else
							$this->MostrarPerfil(2);
					}
					else
						$this->MostrarPerfil(2);
				}
				else{
							$this->MostrarPerfil(2);
				}

			}
			else{
				$this->MostrarPerfil(2);
			}
		}

		function restablecerContrasena()
		{
			if(empty($_POST))
			{
				/*
				- Requiere documentar
				*/
				require_once("app/vistas/RestContrasena.php");
			}
			else{
				
			}
		}

		function completarRegistro()
		{
			if(isset($_GET['response'])){
				$Token = $_GET['response'];
				$resultado = $this->modelo->comprobarRegistro($Token);
				if(!$resultado){//Si el modelo nos devulve un false podra seguir el proceso de otra manera no sera posible
					require_once("app/vistas/CompletarRegistro.php");
				}
				else
					carga_inicio();
			}
			else
				carga_inicio();
		}

		/**
		*
		*/
		function actualizarPerfil()
		{
			//Se toman todos los valores de los diferentes inputs de la vista completarRegistro/Perfil
			$Usuario = $_SESSION['usuario'];
			if (!empty($_POST)) 
			{
				//Recuperacion de campos para la query de perfil
				$Nombre = $_POST['Nombre'];
				$ApellidoP = $_POST['ApellidoP'];
				$ApellidoM = $_POST['ApellidoM'];
				$Universidad = $_POST['Universidad'];
				$Carrera = $_POST['Carrera'];
				$Promedio = $_POST['Promedio'];
				$Estado = $_POST['Estado'];
				$Porcentaje = $_POST['Porcentaje'];
				$TiempoRestante = $_POST['TiempoRestante'];
				$Lapso = $_POST['Lapso'];
				//Recuperacion de datos para la query de telefono y red social
			  $Telefonos = $_POST["Telefonos"];
				$Redes_Sociales = $_POST['RedSocial'];
/* Nota sobre _POST['Telefonos'] y _POST['RedSocial']
Ambas peticiones son especiales pue spost regresa un array y no solo el ultimo cmapo que coincidio
con esta peticion pues el name de los inputs es Telefonos[] lo que le dice a la variable _POST que 
lo considere como un arreglo y tome todos los que encuentre no solo el ultimo*/		  	
				//Recuperacion de los Datos del Horario
				$LunesDesde = $_POST['LunesDesde'];
				$LunesHasta = $_POST['LunesHasta'];
				$MartesDesde = $_POST['MartesDesde'];
				$MartesHasta = $_POST['MartesHasta'];
				$MiercolesDesde = $_POST['MiercolesDesde'];
				$MiercolesHasta = $_POST['MiercolesHasta'];
				$JuevesDesde = $_POST['JuevesDesde'];
				$JuevesHasta = $_POST['JuevesHasta'];
				$ViernesDesde = $_POST['ViernesDesde'];
				$ViernesHasta = $_POST['ViernesHasta'];
				$SabadoDesde = $_POST['SabadoDesde'];
				$SabadoHasta = $_POST['SabadoHasta'];
				
			//Se eliminan los datos previos de la bd
				$this->modelo->eliminaDatosPerfil($Usuario);
			//Se guardan los resultados de las querys en el array ConsultaRes despues se utiliza la funcion
			 //Esta query solicita que se inserten los cambios que van en la tabla de  Perfil
	      $ConsultaRes[0] = $this->modelo->datosPersonales($Usuario,$Nombre,$ApellidoP,$ApellidoM,$Universidad,$Carrera,$Promedio,$Estado,$Porcentaje,$TiempoRestante,$Lapso);
				//Query Telefono
	      $ConsultaRes[1] = $this->modelo->guardaTelefonos($Usuario,$Telefonos);
				//Query Red(es)
				$ConsultaRes[2] = $this->modelo->guardaRedes($Usuario,$Redes_Sociales);		
			  //Querys Para guardar Horario
				$ConsultaRes[3] = $this->modelo->guardaHorario($Usuario,'Lunes',$LunesDesde,$LunesHasta);
				$ConsultaRes[4] = $this->modelo->guardaHorario($Usuario,'Martes',$MartesDesde,$MartesHasta);
				$ConsultaRes[5] = $this->modelo->guardaHorario($Usuario,'Miercoles',$MiercolesDesde,$MiercolesHasta);
				$ConsultaRes[6] = $this->modelo->guardaHorario($Usuario,'Jueves',$JuevesDesde,$JuevesHasta);
				$ConsultaRes[7] = $this->modelo->guardaHorario($Usuario,'Viernes',$ViernesDesde,$ViernesHasta);
				$ConsultaRes[8] = $this->modelo->guardaHorario($Usuario,'Sabado',$SabadoDesde,$SabadoHasta);
			//	in_array() para buscar un "" que indica que existe un false si es asi se borraran los cambios 
			//	en la bd de ontra manera se aceptan los cambios
				if(in_array("", $ConsultaRes))
					if(esNoActivo())
					   require_once("app/vistas/CompletarRegistro.php");
					else
						echo "La actualizacion no se pudo realizar ni pedo la vida sigue vuele a intentarlo si sale en la presentacion poga un 100";
				else //Si no hay error se procede si es un nuevo usuario o si es uno ya existente
				{
					if (esNoActivo()) 
					{	//usuario Nuevo
						if (isset($_POST['NuevaContrasena'])) 
						{
							$Contrasena = $_POST['NuevaContrasena'];
							$this->modelo->NuevaContasena($Usuario,$Contrasena);
						}
						$this->modelo->actualizaEstatus($Usuario,1);
						$_SESSION['nombre'] = $Nombre." ".$ApellidoP." ".$ApellidoM;
						$_SESSION['estado'] = 1;
//Hace falta esto$_SESSION['img_ruta']
						//carga_inicio();
			  	}
			  	else{
				  	$_SESSION['nombre'] = $Nombre." ".$ApellidoP." ".$ApellidoM;
				  	//carga_inicio();
			  	}
				}
			}
			//carga_inicio();
			$this->MostrarPerfil(1);
		}

		function eventosProximos()
		{
			if(empty($_POST))
			{
				/*
				- Requiere documentar
				*/
				require_once("app/vistas/EventosProximos.php");
			}
			else{
				
			}
		}	

		function detalleExamen()
		{
			$vista = file_get_contents("app/vistas/DetalleExamenes.php");
			$header = file_get_contents("app/vistas/Header.php");
			$menu = file_get_contents(devuelveMenu());
			$footer = file_get_contents("app/vistas/Footer.php"); 

			$inicio_fila = strrpos($vista,'<tr>');
			$fin_fila = strrpos($vista, '</tr>')+5;
			$fila = substr($vista,$inicio_fila,$fin_fila-$inicio_fila);

			$Examenes = $this->modelo->detalleExamen();

			$filas = '';
			$newFila = '';
			if(isset($Examenes)&&is_array($Examenes))
			{
				foreach ($Examenes as $examen) {
					$newFila = $fila;
					$diccionario = array('{Categoria}' => $examen['Categoria'],
										'{Examen}' => $examen['Examen'],
										'{Num_Preguntas}' => $examen['Num_Preguntas'],
										'{Aciertos}' => $examen['Aciertos'],
										'{Estado}' => $examen['Estado'],
										'{Calificacion}' => $examen['Calificacion']);
					$newFila = strtr($newFila, $diccionario);
					$filas .= $newFila;
				}
				$vista = str_replace($fila, $filas, $vista);
			}
			else
				$vista = str_replace($fila, '', $vista);

			$vista = $header.$menu.$vista.$footer;
			echo $vista;
		}
		function ingresar()
		{
			if(empty($_POST))
			{
				carga_inicio();
			}
			else{
				$usuario = $_POST['usuario'];
				$contrasena = $_POST['contrasena'];				
				$registrado = $this->modelo->ingresar($usuario,$contrasena);
				carga_inicio();
			}
		}
		function salir()
		{
			session_unset();
			session_destroy();
			setcookie(session_name(), '', time()-3600);
		}

		
	}
 ?>