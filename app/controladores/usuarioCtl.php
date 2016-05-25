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
							case 'verPerfil'://Llamada al perfil de otro usuario sin opcion a modificar antes 'Perfil'
							    $this->ConsultarPerfil();
							  break;
							case 'MostarPerfil'://Llamada al perfil del administrador
							    $this->MostrarPerfil();
							  break;
							case 'ModificarPerfil':
							 		$this->ModificarPerfil();//Guarda en la BD los campos del perfil modificados se acciona con el boton de actualizar campos
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
							case 'verPerfil'://Llamada al perfil de otro usuario sin opcion a modificar antes 'Perfil'
						    $this->ConsultarPerfil();
						    break;
							case 'MostarPerfil'://Llamada al perfil del usuario
							    $this->MostrarPerfil();
							  break;
							case 'ModificarPerfil':
							 		$this->ModificarPerfil();//Guarda en la BD los campos del perfil modificados se acciona con el boton de actualizar campos
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
						case 'cambioContrasena':
					 			$this->cambioContrasena();
					 		break;
					 	case 'Registro':
					 			$this->Registrar();
					 		break;
					 	case 'completarRegistro':
							 	if (isset($_GET['response'])) {
							 		$this->completarRegistro();
							 	}
							 	else if (esNoActivo()){
							 		$this->actualizarPerfil();
							 	} 
							 		
							 	else
							 		echo "Algo anda mal en usuarioCTL";
							 	/*else
							 		carga_inicio()*/
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
			//	echo '<p>Se agrego el usuario<p>';
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
				echo $result=$this->modelo->registrar($Usuario,$Correo,$Token,$Tipo,$Estado,'none');//Se hace la peticion al modelo para que pre-registre y mande el mail al usuario
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
		function ConsultarPerfil()
		{
			if(empty($_POST))
			{
				/*Requiere documentar
				*/
				require_once("app/vistas/Perfil.php");
			}
			else{
				
			}
		}

		function MostrarPerfil()
		{
			if(empty($_POST))
			{
				/*
				- Requiere documentar
				*/
				require_once("app/vistas/Perfil.php");
			}
			else{
				
			}

		}

		function cambioContrasena()
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
			//Se toman todos los valores de los diferentes imputs de la vista completarRegistro/Perfil
			$Usuario = $_SESSION['usuario'];
			if (!empty($_POST)) 
			{
				echo var_dump($_SESSION);
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
				//Esta query solicita que se inserten los cambios que van en la tabla de  Perfil
			  $DatosPersonalesAcademicos = $this->modelo->datosPersonales($Usuario,$Nombre,$ApellidoP,$ApellidoM,$Universidad,$Carrera,$Promedio,$Estado,$Porcentaje,$TiempoRestante,$Lapso);
			  //Recuperacion de datos para la query de telefono y red social
			  foreach ($_POST as $Tel ) {
			  	$Telefonos = $Tel.',';
			  }
				//$Telefonos = $_POST['Telefonos'];
				$Redes_Sociales = $_POST['RedSocial'];
				//Query Telefono(s)
				$this->modelo->guardaTelefonos($Usuario,$Telefonos);
				//Query Red(es)
				//Recuperacion de datos para las querys de los telefonos
			  carga_inicio();
			}
			
		/*$Lunesdesde = $_POST['Lunesdesde'];
			$Luneshasta = $_POST['Luneshasta'];
			$Martesdesde = $_POST['Martesdesde'];
			$Marteshasta = $_POST['Marteshasta'];
			$Miercolesdesde = $_POST['Miercolesdesde'];
			$Miercoleshasta = $_POST['Miercoleshasta'];
			$Juevesdesde = $_POST['Juevesdesde'];
			$Jueveshasta = $_POST['Jueveshasta'];
			$Viernesdesde = $_POST['Viernesdesde'];
			$Vierneshasta = $_POST['Vierneshasta'];
			$Sabadodesde = $_POST['Sabadodesde'];
			$Sabadohasta = $_POST['Sabadohasta'];*/
			//Ejecucion de Query de Datos Personales
			
			//Querys para guardar los horarios
			/*$this->modelo->guardaHorario($Usuario,'Lunes',$Lunesdesde,$Luneshasta);
			$this->modelo->guardaHorario($Usuario,'Martes',$Martesdesde,$Marteshasta);
			$this->modelo->guardaHorario($Usuario,'Miercoles',$Miercolesdesde,$Miercoleshasta);
			$this->modelo->guardaHorario($Usuario,'Jueves',$Juevesdesde,$Jueveshasta);
			$this->modelo->guardaHorario($Usuario,'Viernes',$Viernesdesde,$Vierneshasta);
			$this->modelo->guardaHorario($Usuario,'Sabado',$Sabadodesde,$Sabadohasta);*/
			//Query para Guardar los Telefonos
		//	$this->modelo->guardaTelefonos($Usuario,$Telefonos);
			//Query para Guardar las Redes Sociales
		//	$this->modelo->guardaRedes($Usuario,$Telefonos);
			/*if ($DatosPersonalesAcademicos) {
				$this->modelo->actualizaEstatus($Usuario,'1');
				//carga_inicio();
			}
			else
				echo "VALIO VERGA ALGO ";*/
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
			if(empty($_POST))
			{
				/*
				- Requiere documentar
				*/
				require_once("app/vistas/DetalleExamenes.php");
			}
			else{
				
			}
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