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

			$stmt->bind_param("isiii",$categoria,$nombreExamen,$tiempoLimite,$cantidadPreguntas,$calificacionMinima);
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
		if($stmt = $this->driver->prepare("SELECT distinct Usuario, Nombres, Apellido_P, Apellido_M, Universidad 
			FROM Perfil WHERE Usuario like ? OR Nombres like ? OR Apellido_P like ? OR Apellido_M like ?;"))
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
}
?>