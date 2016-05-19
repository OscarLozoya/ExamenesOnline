<?php 
	class UsuarioCtl{

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
					    $this->MostarPerfil();
					  break;
					 case 'MostarPerfil':
					 	$this->MostarPerfil();
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
					 default:
						require_once('app/vistas/IndexUser.php');
						break;
				}
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
		function MostarPerfil()
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
	}

 ?>