<?php 

/**
* 
*/
class ExamenMdl
{
	private $driver;
	function __construct()
	{
		include_once('datos_conexion.inc.php');
		$this->driver=new mysqli($servidor,$usuario,$pass,$bd);
	}
	function conectar()
	{

	}
	function crear($categoria, $cantidadPreguntas, $tiempoLimite, $calificacionMinima, $nombreExamen)
	{
		if($this->driver->connect_errno)
			return false;

		if($stmt = $this->driver->prepare("INSERT INTO Examen (ID_Categoria, Nombre, Duracion, Num_Preguntas, Calificacion_Min ) VALUES(?,?,?,?,?)")) 
		{
			$categoria = $this->driver->real_escape_string($categoria); //Aegurarnos que el usuario no ingrese palabras reservadas
			$nombreExamen = $this->driver->real_escape_string($nombreExamen);
			$tiempoLimite = $this->driver->real_escape_string($tiempoLimite);
			$cantidadPreguntas = $this->driver->real_escape_string($cantidadPreguntas);
			$calificacionMinima = $this->driver->real_escape_string($calificacionMinima);

			if($tiempoLimite >= 60)
			{
				$tiempoHoras = floor($tiempoLimite/60);
				$tiempoMinutos = $tiempoLimite%60;
				$tiempoSegundos = '00';

				$tiempoBD = $tiempoHoras.$tiempoMinutos.$tiempoSegundos;
			}
			else if($tiempoLimite >= 0)
			{
				$tiempoHoras = '00';
				$tiempoMinutos = $tiempoLimite;
				$tiempoSegundos = '00';

				$tiempoBD = $tiempoHoras.$tiempoMinutos.$tiempoSegundos;
			}
			var_dump($tiempoBD);
			$stmt->bind_param("isiii",$categoria,$nombreExamen,$tiempoBD,$cantidadPreguntas,$calificacionMinima);
			if($stmt->execute())
				return true;
			$stmt->close();
		}
		else
			return $stmt->error;
	}

	function modificar()
	{

	}
	/**
	 *Elimina de la base de datos los exámenes con el id que se recibe 
	 *@param string con los ID separados por coma para eliminar
	 *@return mixed
	*/
	function eliminar($ID)
	{
		if($this->driver->connect_errno)
			return false;
		//Spliteamos el string
		$arrayID = explode(',', $ID);
		//por cada id ejecutamos el query de eliminar
		foreach ($arrayID as $id_eliminar) {
			//si el ID no esta vacio, ya que se concatena 1,2, quedaria un indice vacio
			if($id_eliminar != ''){
				if($stmt=$this->driver->prepare("DELETE FROM Examen WHERE ID=?"))
				{
					$id_eliminar = $this->driver->real_escape_string($id_eliminar);
					$stmt->bind_param("i",$id_eliminar);
					//si  hubo un error lo regresa
					if(!$stmt->execute())
						return $stmt->error;
					$stmt->close();
				}
				else
					return $stmt->error;
			}
		}
		
		//Si todo se ejecuto bien regresamos true
		return True;
	}
	function asignar($ID_Usuario,$ID_Examen)
	{
		if($this->driver->connect_errno)
			return false;
		//Spliteamos el string
		$arrayID = explode(',', $ID_Usuario);
		//por cada id ejecutamos el query de eliminar
		foreach ($arrayID as $id_asignar) {
			//si el ID no esta vacio, ya que se concatena 1,2, quedaria un indice vacio
			if($id_asignar != ''){
				if($stmt=$this->driver->prepare("INSERT INTO Resultado_Examen (Usuario,ID_Examen,Calificacion) VALUES(?,?,?)"))
				{
					$id_asignar = $this->driver->real_escape_string($id_asignar);
					$ID_Examen = $this->driver->real_escape_string($ID_Examen);
					$calificacion = -1;
					$stmt->bind_param("sii",$id_asignar,$ID_Examen,$calificacion);
					//si  hubo un error lo regresa
					if(!$stmt->execute())
						return $stmt->error;
					$stmt->close();
				}
				else
					return $stmt->error;
			}
		}
		
		//Si todo se ejecuto bien regresamos true
		return True;
	}

	function vista()
	{

	}

	/**
	 *Busca un examen en la base de datos dado el ID,Nombre y la Catgeoría
	 *@param ID del examen
	 *@param Nombre del Examen
	 *@param Categoria a la que pertenece el examen
	 *@return array
	*/
	function buscar($ID,$Nombre,$Categoria)
	{
		$array=null;
		if($this->driver->connect_errno)
			return false;
		//Se prepara el Query, los signos ? se sustituyen por las variables
		if($stmt = $this->driver->prepare("SELECT distinct e.ID,e.Nombre, c.Nombre, e.Duracion, e.Num_Preguntas,e.Calificacion_Min 
			FROM Examen e INNER JOIN Categoria c 
			on c.ID = e.ID_Categoria WHERE e.Nombre like ? OR c.Nombre=? OR c.ID = ?;"))
		{
			//Se limpian las variables para evitar inyecciones de SQL
			$ID = $this->driver->real_escape_string($ID);
			$Nombre = $this->driver->real_escape_string($Nombre);
			$Categoria = $this->driver->real_escape_string($Categoria);
			//se agrega los % para usar la función like de SQL
			$parametroNombre='%'.$Nombre.'%';
			//se sustituye los ? por las variables, especificando el tipo de dato, i=integer,s=string, etc.
			$stmt->bind_param("iss",$parametroNombre,$Categoria,$ID);
			//se ejecuta el query
			$stmt->execute();
			//se establecen las variables donde se guardan los resultados de la ejecución, deben de coincidir con el numero de columnas que te devuelve el query
			$stmt->bind_result($ID_Examen,$Nombre_Examen,$Nombre_Categoria,$Duracion,$Num_Preguntas,$Calificacion_Min);
			//se setean las variables con los valores obtenidos, se hace fila por fila, si es que esperan mas
			while ($stmt->fetch()) {
				$array[]= array(
							'ID' => $ID_Examen,
							'Nombre' => $Nombre_Examen,
							'Categoria' => $Nombre_Categoria,
							'Duracion' => $Duracion,
							'Preguntas' => $Num_Preguntas,
							'Calificacion' => $Calificacion_Min);
			}
			$stmt->close();
		}
		//$this->driver->close();
		return $array;
	}
	/**
	 *Obtiene todas las categorias que estan en la base de datos
	 *@return array
	*/
	function obtenerCategorias()
	{
		$array = null;
		if($this->driver->connect_errno)
			return false;
		if($stmt=$this->driver->prepare("SELECT ID,Nombre FROM Categoria"))
		{
			$stmt->execute();
			$stmt->bind_result($ID_Categoria,$Nombre_Categoria);
			while($stmt->fetch())
			{
				$array[] = array('ID_Categoria' => $ID_Categoria, 
								'Nombre_Categoria' => $Nombre_Categoria);
			}
			$stmt->close();
		}
		//$this->driver->close();
		return $array;
	}
	function buscarUltimo()
	{
		$ultimo = '';
		if($this->driver->connect_errno)
			return false;

		if($stmt = $this->driver->prepare("SELECT MAX(ID) FROM Examen")) 
		{
			$stmt->execute();
			$stmt->bind_result($ultimo);
			while($stmt->fetch())
			{
				$ultimo = $ultimo + 1;
			}
			return $ultimo;
			$stmt->close();
		}
		else
			return $ultimo;
	}

	function Examen($ID)
	{
		$array = null;
		if($this->driver->connect_errno)
			return false;
		$DetalleExamen = null;
		$Num_Preguntas = 0;
		$ID_Categoria = 0;
		if($stmt = $this->driver->prepare("SELECT ID_Categoria,Nombre,Duracion,Num_Preguntas,Calificacion_Min 
										FROM Examen
										WHERE ID=?"))
		{
			$ID = $this->driver->real_escape_string($ID);
			$stmt->bind_param("i",$ID);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($ID_Categoria,$Nombre,$Duracion,$Num_Preguntas,$Calificacion_Min);
			$stmt->fetch();
			$DetalleExamen[] = array('Nombre' => $Nombre,
							'Duracion' => $Duracion,
							'Num_Preguntas' => $Num_Preguntas,
							'Calificacion_Min' => $Calificacion_Min,
							'ID_Categoria' => $ID_Categoria);
			$stmt->close();
		}
		else
			return "Error al obtener el examen";

		$Preguntas = null;
		$MaxID = 0;
		if($stmt = $this->driver->prepare("SELECT MAX(ID) FROM Pregunta"))
		{
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($MaxID);
			$stmt->fetch();
			$stmt->close();

		}
		else
			return "Error al obtener el ultimo ID de pregunta";

		for ($i=0; $i < $Num_Preguntas; $i++) 
		{ 
			$ID_Pregunta = rand(1,$MaxID);
			if($stmt = $this->driver->prepare("SELECT p.Descripcion,p.Tipo 
											FROM Pregunta p INNER JOIN Pregunta_Categoria c 
											on c.Id_Pregunta=p.ID 
											WHERE ID=? and c.ID_Categoria=?"))
			{
				$ID_Pregunta = $this->driver->real_escape_string($ID_Pregunta);
				$ID_Categoria = $this->driver->real_escape_string($ID_Categoria);
				$stmt->bind_param("ii",$ID_Pregunta,$ID_Categoria);
				if(!$stmt->execute())
					return $stmt->error;
				$stmt->bind_result($Descripcion,$Tipo);
				if($stmt->fetch())
				{
					$stmt->close();
					if($Tipo==1)
					{
						
						$resp = "";		
						if($stmt2 = $this->driver->prepare("SELECT r.Descripcion 
															FROM Detalle_Pregunta r INNER JOIN Pregunta p
															ON r.ID_Pregunta=p.ID
															WHERE r.ID_Pregunta=?"))
						{
							$ID_Pregunta = $this->driver->real_escape_string($ID_Pregunta);
							$stmt2->bind_param("i",$ID_Pregunta);
							if(!$stmt2->execute())
								return $stmt2->error;
							$stmt2->bind_result($DescripcionRespuesta);
							while ($stmt2->fetch()) {
								$resp .= '<input type="radio" name="'.$i.'"" value="'.$ID_Pregunta.'|'.$DescripcionRespuesta.'">'.$DescripcionRespuesta.'<br>';
							}
							$stmt2->close();
						}
						else
							die("Error en las respuestas");
						$Preguntas[] = array('Descripcion' => ($i+1).'.-'.$Descripcion,
											'Respuesta' => $resp);
					}
					else
						$Preguntas[] = array('Descripcion' => ($i+1).'.-'.$Descripcion,
											'Respuesta' => '<input type="hidden" name="'.$i.'|abierta'.'" value="'.$ID_Pregunta.'" class="form-control RespuestasAbiertas">'.'<input name="'.$i.'"  class="form-control RespuestasAbiertas">');
				}
				else
					$i--;
				
			}
			else
				return "Error al obtener la pregunta";
			
		}

		$array[]=array('Examen' => $DetalleExamen,
						'Preguntas' =>$Preguntas);
		return $array;
	}

	function numPreguntasExamen($ID)
	{
		if($this->driver->connect_errno)
			return false;
		$Num_Preguntas = 0;
		if($stmt = $this->driver->prepare("SELECT Num_Preguntas
										FROM Examen
										WHERE ID=?"))
		{
			$ID = $this->driver->real_escape_string($ID);
			$stmt->bind_param('i',$ID);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($Num_Preguntas);
			$stmt->fetch();
		}
		else
			return 'Error';
		return $Num_Preguntas;
	}

	function guardarResultadoExamen($ID_Examen,$Calificacion)
	{
		if($this->driver->connect_errno)
			return $this->driver->connect_error;
		if($stmt = $this->driver->prepare("UPDATE Resultado_Examen 
											SET Calificacion=?
											WHERE Usuario=? AND ID_Examen=? AND Calificacion=-1"))
		{
			$usuario = $_SESSION['usuario'];
			$usuario = $this->driver->real_escape_string($usuario);
			$ID_Examen = $this->driver->real_escape_string($ID_Examen);
			$Calificacion = $this->driver->real_escape_string($Calificacion);
			$stmt->bind_param("isi",$Calificacion,$usuario,$ID_Examen);
			if(!$stmt->execute())
				return $stmt->error;
			else
				return true;
		}
	}
	function guardarRespuesta($ID_Examen,$ID_Pregunta,$Respuesta,$Resultado)
	{
		if($this->driver->connect_errno)
			return $this->driver->connect_error;
		if($stmt = $this->driver->prepare("INSERT INTO Detalle_Pregunta_Examen
											(Usuario,ID_Examen,ID_Pregunta,Respuesta,Resultado) 
											VALUES (?,?,?,?,?)"))
		{
			$usuario = $_SESSION['usuario'];
			$usuario = $this->driver->real_escape_string($usuario);
			$ID_Examen = $this->driver->real_escape_string($ID_Examen);
			$ID_Pregunta = $this->driver->real_escape_string($ID_Pregunta);
			$Respuesta = $this->driver->real_escape_string($Respuesta);
			$Resultado = $this->driver->real_escape_string($Resultado);
			$stmt->bind_param("siisi",$usuario,$ID_Examen,$ID_Pregunta,$Respuesta,$Resultado);
			if(!$stmt->execute())
				return $stmt->error;
			else
				return true;
		}
	}
	function verRespuesta($ID,$Descripcion)
	{
		$respuesta = null;
		if($this->driver->connect_errno)
			return $this->driver->connect_error;
		if($stmt = $this->driver->prepare("SELECT Respuesta
										FROM Detalle_Pregunta
										WHERE ID_Pregunta=? AND Descripcion=?"))
		{
			$ID = $this->driver->real_escape_string($ID);
			$Descripcion = $this->driver->real_escape_string($Descripcion);
			$stmt->bind_param("is",$ID,$Descripcion);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($respuesta);
			$stmt->fetch();
		}
		return $respuesta;
	}

	/**
	 *Busca un usuario en la base de datos conforme al nombre de usuario, nombre real o apellidos
	 *@param Nombre de usuario
	 *@return array
	*/
	function buscarUsuario($nombreUsuario)
	{
		$array=null;
		if($this->driver->connect_errno)
			return false;
		//Se prepara el Query, los signos ? se sustituyen por las variables
		if($stmt = $this->driver->prepare("SELECT DISTINCT p.Usuario, p.Nombres, p.Apellido_P, p.Apellido_M, p.Universidad 
			FROM Perfil p JOIN Usuario u ON u.Usuario = p.Usuario
			WHERE (p.Usuario LIKE ? OR p.Nombres LIKE ? OR p.Apellido_P LIKE ? OR p.Apellido_M LIKE ?) AND u.Tipo = '2';"))
		{
			//Se limpian las variables para evitar inyecciones de SQL
			$nombreUsuario = $this->driver->real_escape_string($nombreUsuario);
			//se agrega los % para usar la función like de SQL
			$nombreUsuario='%'.$nombreUsuario.'%';
			//se sustituye los ? por las variables, especificando el tipo de dato, i=integer,s=string, etc.
			$stmt->bind_param("ssss",$nombreUsuario,$nombreUsuario,$nombreUsuario,$nombreUsuario);
			//se ejecuta el query
			$stmt->execute();
			//se establecen las variables donde se guardan los resultados de la ejecución, deben de coincidir con el numero de columnas que te devuelve el query
			$stmt->bind_result($Usuario, $Nombres, $Apellido_P, $Apellido_M, $Universidad);
			//se setean las variables con los valores obtenidos, se hace fila por fila, si es que esperan mas
			while ($stmt->fetch()) {
				$array[]= array(
							'Usuario' => $Usuario,
							'Nombres' => $Nombres,
							'Apellido_P' => $Apellido_P,
							'Apellido_M' => $Apellido_M,
							'Universidad' => $Universidad);
			}
			$stmt->close();
		}
		//$this->driver->close();
		return $array;
	}

	function respuestasAbiertas($usuario,$ID_Examen,$ID_Pregunta,$respuesta,$Resultado)
	{
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("UPDATE Detalle_Pregunta_Examen 
											SET Resultado=? 
											WHERE Usuario=? AND ID_Examen=? AND ID_Pregunta=? AND Respuesta=?"))
		{
			$usuario = $this->driver->real_escape_string($usuario);
			$ID_Examen = $this->driver->real_escape_string($ID_Examen);
			$ID_Pregunta = $this->driver->real_escape_string($ID_Pregunta);
			$respuesta = $this->driver->real_escape_string($respuesta);
			$Resultado = $this->driver->real_escape_string($Resultado);
			$stmt->bind_param("isiis",$Resultado,$usuario,$ID_Examen,$ID_Pregunta,$respuesta);
			if(!$stmt->execute())
				return false;
			$stmt->close();
		}
		if($this->actualizarPromedio($usuario,$ID_Examen))
			return true;
		else
			return false;
	}

	function actualizarPromedio($usuario,$ID_Examen)
	{
		$Num_Preguntas = $this->numPreguntasExamen($ID_Examen);
		$correctos = 0;
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("SELECT COUNT(Resultado) 
											FROM Detalle_Pregunta_Examen 
											WHERE Resultado=1 AND Usuario =? AND ID_Examen=?"))
		{
			$usuario = $this->driver->real_escape_string($usuario);
			$ID_Examen = $this->driver->real_escape_string($ID_Examen);
			$stmt->bind_param("si",$usuario,$ID_Examen);
			if(!$stmt->execute())
				return false;
			$stmt->bind_result($correctos);
			$stmt->fetch();
			$stmt->close();
		}
		$Promedio = ($correctos*100)/$Num_Preguntas;
		if($stmt = $this->driver->prepare("UPDATE Resultado_Examen
											SET Calificacion=?
											WHERE Usuario=? AND ID_Examen=?"))
		{
			$usuario = $this->driver->real_escape_string($usuario);
			$ID_Examen = $this->driver->real_escape_string($ID_Examen);
			$Promedio = $this->driver->real_escape_string($Promedio);
			$stmt->bind_param("isi",$Promedio,$usuario,$ID_Examen);
			if(!$stmt->execute())
				return false;
			$stmt->close();
		}
		return true;
	}
}
?>