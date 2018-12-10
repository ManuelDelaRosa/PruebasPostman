<?php
	//require_once('conexion_BD.php');
	//$conexion = new Conexion();

	$conexion = mysqli_connect("localhost", "root", "manuel", "bd_escuela")
							or die(mysql_error());

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$cadena_json=file_get_contents('php://input');//recibe informacion por HTTP, en este caso una cadena JSON	
		$datos=json_decode($cadena_json,true);
					
		$carrera=$datos['c'];

		//$sql = "SELECT * FROM alumnos WHERE carrera LIKE '$carrera'";
		$sql = "SELECT * FROM alumnos";
		$consulta = mysqli_query($conexion, $sql);

		if (mysqli_num_rows($consulta) > 0) {
			$respuesta['alumnos'] = array();
			while ($fila = mysqli_fetch_assoc($consulta)) {
			$alumno = array();

			$alumno["nc"] = $fila["num_Control"];
			$alumno["n"] = $fila["nombre_Alumno"];
			$alumno["pa"] = $fila["primerAp_Alumno"];
			$alumno["sa"] = $fila["segundoAp_Alumno"];
			$alumno["e"] = $fila["edad"];
			$alumno["s"] = $fila["semestre"];
			$alumno["c"] = $fila["carrera"];
			array_push($respuesta["alumnos"], $alumno);
		}
		$respuesta['exito'] = 1;
		echo json_encode($respuesta);
		}else{
		$respuesta['exito'] = 0;
		$respuesta['msj'] = "No hay registros";
		echo json_encode($respuesta);
		}
	}	
?>