<?php 
	class UsuarioCtl{
		public function ejecutar(){
			switch($_GET['accion']){
				case 'Alta'://Llamada del administrador para registrar en la plataforma
					$this->Alta();
				  break;
				case 'Registro'://Llamada de un invitado para registrarse en la plataforma
				    Registrar();
				  break;
				case 'Baja'://Llamada del administrador para eliminar un usuario
				  	Baja();
				  break;
				case 'Perfil'://Llamada al perfil de otro usuario sin opcion a modificar
				    ConsultarPerfil();
				  break;
				case 'Modificar'://Llamada al perfil del usuario que esta logeado
				    MostarPerfil();
				  break;
			}
		}
		/**Requiere documentar
				*/
		public function Alta(){
			if(empty($_POST)){
				/*Requiere documentar
				*/
				require_once("AdminAbcUser.php");
			}
			else{

			}
		} 
		function Registrar(){
			if(empty($_POST)){
				/*Requiere documentar
				*/
				require_once("Vista/Registro.php");
			}
			else{
				
			}
		}

		function Baja(){
			if(empty($_POST)){
				/*Requiere documentar
				*/
				require_once("Vista/AdminAbcUser.php");
			}
			else{
				
			}

		}
		function ConsultarPerfil(){
			if(empty($_POST)){
				/*Requiere documentar
				*/
				require_once("Vista/Perfil.php");
			}
			else{
				
			}

		}
		function MostarPerfil(){
			if(empty($_POST)){
				/*
				- Requiere documentar
				*/
				require_once("Vista/Perfil.php");
			}
			else{
				
			}

		}	}

 ?>