<?php
	//require_once('conexion_BD.php');
	//$conexion = new Conexion();

	$conexion = mysqli_connect("localhost", "root", "manuel", "bd_escuela")
							or die(mysql_error());

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$cadena_json=file_get_contents('php://input');//recibe informacion por HTTP, en este caso una cadena JSON	
		$datos=json_decode($cadena_json,true);
					
		$num_Control=$datos['nc'];

		$sql = "DELETE FROM alumnos WHERE num_Control = '$num_Control'";
		$consulta = mysqli_query($conexion, $sql);

		
		if ($consulta) {
			$respuesta['exito'] = 1;
			$respuesta['msj'] = "Eliminado correctamente";
			echo json_encode($respuesta);
			}else{
			$respuesta['exito'] = 0;
			$respuesta['msj'] = "No hay registros";
			echo json_encode($respuesta);
		}
	}	
?>