<?php
		function inicioSesion(){
			if( isset($_SESSION['usuario']) )
				return true;
			return false;
		}
		function esAdmin(){
			if( isset($_SESSION['tipo']) && $_SESSION['tipo'] == '0' )
				return true;
			return false;
		}
		function esModerador(){
			if( isset($_SESSION['tipo']) && $_SESSION['tipo'] == '1' )
				return true;
			return false;
		}
		function esUsuario(){
			if( isset($_SESSION['tipo']) && $_SESSION['tipo'] == '2' )
				return true;
			return false;
		}
		function carga_inicio()
		{
			if(esAdmin())
				require_once('app/vistas/IndexAdmin.php');
			else if(esModerador())
				require_once('app/vistas/IndexMod.php');
			else if(esUsuario())
				require_once('app/vistas/IndexUser.php');
			else
				require_once('app/vistas/index.php');
		}
		function mostrarUsuario($vista)
		{
			$inicio_nombre = strrpos($vista, '<label>');
			$fin_nombre = strrpos($vista, '</label>') + 8;
			$nombre= substr($vista, $inicio_nombre,$fin_nombre-$inicio_nombre);
			if(isset($_SESSION['usuario']))
			{
				$nuevoUsuario=$nombre;
				$diccionario= array('{Nombre_usuario}' => $_SESSION['usuario']);
				$nuevoUsuario=strtr($nuevoUsuario, $diccionario);
				
				$vista = str_replace($nombre, $nuevoUsuario, $vista);
			}
			else
			{
				$vista = str_replace($nombre,'Nombre Usuario', $vista);
			}
			return $vista;
		}
?>