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
					if(esAdmin()||esModerador()||esUsuario())
					{
					switch($_GET['accion']){
						case 'Alta'://Llamada del administrador para registrar en la plataforma
							$this->Alta();
						  break;
						case 'Baja'://Llamada del administrador para eliminar un usuario
						  	$this->Baja();
						  break;
						case 'Perfil'://Llamada al perfil de otro usuario sin opcion a modificar
						    $this->ConsultarPerfil();
						  break;
						case 'Modificar'://Llamada al perfil del usuario que esta logeado
						    $this->MostrarPerfil();
						  break;
						 case 'MostarPerfil':
						 	$this->MostrarPerfil();
						 	break;
						 case 'cambioContrasena':
						 	$this->cambioContrasena();
						 	break;
						 case 'completarRegistro':
						 	$this->completarRegistro();
						 	break;
						 case 'eventosProximos':
						 	$this->eventosProximos();
						 	break;
						 case 'detalleExamen':
						 	$this->detalleExamen();
						 	break;
						 case 'ingresar':
						 	$this->ingresar();
						 	break;
						 case 'salir':
						 	$this->salir();
						 	carga_inicio();
						 	break;
						 default:
							carga_inicio();
							break;
					}
				}
				else //Sentencia else en caso de que no sea un administrador, moderador o usuario, nos muestra la página de inicio segun sea el caso
					carga_inicio();
				}
				else //Sentencia else en caso de que no se especifique una acción, nos muestra la página según seea el caso
					carga_inicio();
			}
			else if($_GET['accion']=='Registro')//Llamada de un invitado para registrarse en la plataforma
						    $this->Registrar();
			else //Sentencia else en caso de que no haya una sesion iniciada, para comprobar los datos e iniciar su sesion
				$this->ingresar();
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
				echo '<p>Se agrego el usuario<p>';
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
				$Tipo = "0";
				$Estado = "0";
				$result=$this->modelo->registrar($Usuario,$Correo,$Token,$Tipo,$Estado);//Se hace la peticion al modelo para que pre-registre y mande el mail al usuario
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
			if(empty($_POST))
			{
				/*
				- Requiere documentar
				*/
				require_once("app/vistas/CompletarRegistro.php");
			}
			else{
				
			}
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