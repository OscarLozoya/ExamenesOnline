<?php
		
		
		function inicioSesion(){
			if( isset($_SESSION['usuario']) && isset($_SESSION['estado']) && $_SESSION['estado']=='1' )
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
				cargarAdmin();
			else if(esModerador())
				cargarMod();
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

		function devuelveMenu()
		{
			$ruta = null;
			if(esUsuario())
				$ruta = 'app/vistas/MenuUser.php';
			if(esModerador())
				$ruta = 'app/vistas/MenuMod.php';
			if(esAdmin())
				$ruta = 'app/vistas/MenuAdmin.php';
			return $ruta;
		}

		function mostrarUsuario($vista)
		{
			$inicio_nombre = strrpos($vista, '<label>');
			$fin_nombre = strrpos($vista, '</label>') + 8;
			$nombre= substr($vista, $inicio_nombre,$fin_nombre-$inicio_nombre);
			if(isset($_SESSION['usuario']))
			{
				$nuevoUsuario=$nombre;
				$nombre_apellido = $_SESSION['Nombres'].' '.$_SESSION['Apellido_P'];
				$diccionario= array('{Nombre_usuario}' => $nombre_apellido);
				$nuevoUsuario=strtr($nuevoUsuario, $diccionario);
				
				$vista = str_replace($nombre, $nuevoUsuario, $vista);
			}
			else
			{
				$vista = str_replace($nombre,'Nombre Usuario', $vista);
			}
			return $vista;
		}
		function mostrarFoto($vista)
		{
			$iniciaFoto = strrpos($vista, '{iniciaFoto}');
			$finFoto = strrpos($vista, '{terminaFoto}') + 13;
			$Foto = substr($vista, $iniciaFoto,$finFoto-$iniciaFoto);
			if(isset($_SESSION['img_ruta'])&&$_SESSION['img_ruta']!="none"&&$_SESSION['img_ruta']!="")
			{
				$nuevaFoto=$Foto;
				$diccionario = array('{Foto}' => $_SESSION['img_ruta']);
				$nuevaFoto=strtr($nuevaFoto, $diccionario);
				
				$vista = str_replace($Foto, $nuevaFoto, $vista);
			}
			if(($_SESSION['img_ruta']=='none')||($_SESSION['img_ruta']==''))
			{
				$fotoDefecto = 'images/logo_user.gif';
				$nuevaFoto=$Foto;
				$diccionario = array('{Foto}' => $fotoDefecto);
				$nuevaFoto=strtr($nuevaFoto, $diccionario);

				$vista = str_replace($Foto,$nuevaFoto, $vista);
			}

			$vista=str_replace('{iniciaFoto}', '', $vista);
			$vista=str_replace('{terminaFoto}', '', $vista);

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
			$vista = mostrarFoto($vista);

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
			}
			else
			{
				$vista = str_replace($fila, $Examenes, $vista);
			}
			$vista = str_replace('{ini_Examen}', '', $vista);
			$vista = str_replace('{fin_Examen}', '', $vista);
			$vista = $header.$menu.$vista.$footer;
			echo $vista;
		}

		function cargarAdmin()
		{
			include_once('app/modelos/sesionMdl.php');
			$modelo = new sesionMdl();
			$vista = file_get_contents('app/vistas/IndexAdmin.php');
			$footer=file_get_contents('app/vistas/Footer.php');
			$header=file_get_contents('app/vistas/Header.php');
			$menu = file_get_contents('app/vistas/MenuAdmin.php');

			$vista = mostrarUsuario($vista);
			$vista = mostrarFoto($vista);

			$Pendientes = $modelo->respuestasPendientesRevisar();

			$ini_pregunta = strpos($vista, '{ini_pregunta}');
			$fin_pregunta = strpos($vista, '{fin_pregunta}')+14;
			$pregunta = substr($vista, $ini_pregunta,$fin_pregunta-$ini_pregunta);

			$newPregunta = '';
			$preguntas = '';
			if(isset($Pendientes) && is_array($Pendientes))
			{
				foreach ($Pendientes as $pendiente) {
					$newPregunta = $pregunta;
					$diccionario = array('{usuario}' => $pendiente['usuario'],
										'{ID_Examen}' => $pendiente['ID_Examen'],
										'{ID_Pregunta}' => $pendiente['ID_Pregunta'],
										'{pregunta}' => $pendiente['Descripcion'],
										'{respuesta}' => $pendiente['Respuesta']);
					$newPregunta = strtr($newPregunta, $diccionario);
					$preguntas .= $newPregunta;
				}
				$vista = str_replace($pregunta, $preguntas, $vista);
			}
			else
			{
				$vista = str_replace($pregunta, $Pendientes, $vista);
			}
			$vista = str_replace('{ini_pregunta}', '', $vista);
			$vista = str_replace('{fin_pregunta}', '', $vista);
			$vista = $header.$menu.$vista.$footer;
			echo $vista;
		}

		function cargarMod()
		{
			include_once('app/modelos/sesionMdl.php');
			$modelo = new sesionMdl();
			$vista = file_get_contents('app/vistas/IndexMod.php');
			$footer=file_get_contents('app/vistas/Footer.php');
			$header=file_get_contents('app/vistas/Header.php');
			$menu = file_get_contents('app/vistas/MenuMod.php');

			$vista = mostrarUsuario($vista);
			$vista = mostrarFoto($vista);

			$Pendientes = $modelo->respuestasPendientesRevisar();

			$ini_pregunta = strpos($vista, '{ini_pregunta}');
			$fin_pregunta = strpos($vista, '{fin_pregunta}')+14;
			$pregunta = substr($vista, $ini_pregunta,$fin_pregunta-$ini_pregunta);

			$newPregunta = '';
			$preguntas = '';
			if(isset($Pendientes) && is_array($Pendientes))
			{
				foreach ($Pendientes as $pendiente) {
					$newPregunta = $pregunta;
					$diccionario = array('{usuario}' => $pendiente['usuario'],
										'{ID_Examen}' => $pendiente['ID_Examen'],
										'{ID_Pregunta}' => $pendiente['ID_Pregunta'],
										'{pregunta}' => $pendiente['Descripcion'],
										'{respuesta}' => $pendiente['Respuesta']);
					$newPregunta = strtr($newPregunta, $diccionario);
					$preguntas .= $newPregunta;
				}
				$vista = str_replace($pregunta, $preguntas, $vista);
			}
			else
			{
				$vista = str_replace($pregunta, $Pendientes, $vista);
			}
			$vista = str_replace('{ini_pregunta}', '', $vista);
			$vista = str_replace('{fin_pregunta}', '', $vista);
			$vista = $header.$menu.$vista.$footer;
			echo $vista;
		}
?>