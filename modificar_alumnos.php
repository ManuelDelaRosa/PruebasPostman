<?php
/*$conexion = mysqli_connect("localhost", "root", "manuel", "bd_escuela")
							or die(mysql_error());*/
							//localhost
	if(!($conexion =mysqli_connect('127.0.0.1', 'root','manuel','bd_escuela')))
			die("Fallo en la conexion!!!!!, ERROR".mysqli_connect_error());


	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$cadena_json=file_get_contents('php://input');//recibe informacion por HTTP, en este caso una cadena JSON

		$datos=json_decode($cadena_json,true);

		$nc=$datos['nc'];
		$n=$datos['n'];
		$pa=$datos['pa'];
		$sa=$datos['sa'];
		$e=$datos['e'];
		$s=$datos['s'];
		$c=$datos['c'];

		$sql = "UPDATE  alumnos  SET nombre_Alumno='$n',primerAp_Alumno ='$pa',segundoAp_Alumno='$sa',
		edad=$e,semestre=$s,carrera='$c' WHERE num_Control ='$nc'";
		//echo json_encode($sql);

		$consulta = mysqli_query($conexion, $sql);
		
		if ($consulta) {
				$respuesta['exito']=1;
				$respuesta['msj']='Actualizacion correcta';
				echo json_encode($respuesta);
		}else{
				$respuesta['exito']=0;
				$respuesta['msj']='Error en la inserccion';
				echo json_encode($respuesta);
		}

	}//if


?>