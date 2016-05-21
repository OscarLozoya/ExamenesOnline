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
					/*	case 'Registro'://Llamada de un invitado para registrarse en la plataforma
						    $this->Registrar();
						  break;*/
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

		function Registrar()
		{
			if(empty($_POST))
			{
				/*Requiere documentar
				*/
				require_once("app/vistas/Registro.php");
			}
			else{
				
			}
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