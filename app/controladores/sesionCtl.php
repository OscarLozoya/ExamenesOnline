<?php
		
		
		function inicioSesion(){
			if( isset($_SESSION['usuario']) && $_SESSION['estado']=='1' )
				return true;
			return false;
		}

		function esAdmin(){
			if( isset($_SESSION['tipo']) && $_SESSION['tipo'] == '0' && $_SESSION['estado']=='1')
				return true;
			return false;
		}

		function esModerador(){
			if( isset($_SESSION['tipo']) && $_SESSION['tipo'] == '1' && $_SESSION['estado']=='1')
				return true;
			return false;
		}

		function esUsuario(){
			if( isset($_SESSION['tipo']) && $_SESSION['tipo'] == '2' && $_SESSION['estado']=='1')
				return true;
			return false;
		}

		function esNoActivo(){
			if( isset($_SESSION['estado']) && $_SESSION['estado']=='0')
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
				cargarUsuario();
			else if(isset($_SESSION['usuario'])){
				session_unset();
				session_destroy();
				//setcookie(session_name(), '', time()-3600);
				require_once('app/vistas/index.php');
			}	
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

		function cargarUsuario()
		{
			include_once('app/modelos/sesionMdl.php');
			$modelo = new sesionMdl();
			$vista = file_get_contents('app/vistas/IndexUser.php');
			$footer=file_get_contents('app/vistas/Footer.php');
			$header=file_get_contents('app/vistas/Header.php');
			$menu = file_get_contents('app/vistas/MenuUser.php');
			$vista = mostrarUsuario($vista);
			
			$Examenes = $modelo->ExamenesPendientes();
			$ini_Examen = strpos($vista, '{ini_Examen}');
			$fin_Examen = strrpos($vista, '{fin_Examen}')+12;
			$fila = substr($vista, $ini_Examen,$fin_Examen-$ini_Examen);
			$newFila = '';
			$filas = '';
			if(isset($Examenes) && is_array($Examenes))
			{
				foreach ($Examenes as $examen) {
					$newFila = $fila;
					$diccionario = array('{Categoria}' => $examen['Categoria'],
										'{id-examen}' => $examen['ID_Examen'],
										'{Examen}' => $examen['Examen'],
										'{Preguntas}' => $examen['Num_Preguntas'],
										'{Tiempo}' => $examen['Tiempo']);
					$newFila = strtr($newFila, $diccionario);
					$filas .=$newFila;
				}
				$vista = str_replace($fila, $filas, $vista);
				$vista = str_replace('{ini_Examen}', '', $vista);
				$vista = str_replace('{fin_Examen}', '', $vista);
			}
			else
			{
				$vista = str_replace($fila, $Examenes, $vista);
				$vista = str_replace('{ini_Examen}', '', $vista);
				$vista = str_replace('{fin_Examen}', '', $vista);
			}
			$vista = $header.$menu.$vista.$footer;
			echo $vista;
		}
?>