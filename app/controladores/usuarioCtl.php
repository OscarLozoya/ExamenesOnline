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
			if(isset($_GET['accion']))
			{
				switch($_GET['accion']){
					case 'Alta'://Llamada del administrador para registrar en la plataforma
						$this->Alta();
					  break;
					case 'Registro'://Llamada de un invitado para registrarse en la plataforma
					    $this->Registrar();
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
		/**Requiere documentar
				*/
		public function Alta()
		{
			if(empty($_POST))
			{
				/*Requiere documentar
				*/
				require_once("app/vistas/AdminAbcUser.php");
			}
			else
			{

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
			session_start();
			session_unset();
			session_destroy();
			
			setcookie(session_name(), '', time()-3600);
		}
	}

 ?>