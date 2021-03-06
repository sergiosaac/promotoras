<?php 
	include("conexion.php");

	$id = $_POST["id"];	
	$opcion = $_POST["opcion"];

	//obtener el valor de los campos
	if($opcion == "registrar" || $opcion == "modificar"){
		
		$nombre = $_POST["nombre"];
		$apellidos = $_POST["apellidos"];
		$edad = $_POST["edad"];
		$estado = $_POST["estado"];		
	}

	$informacion = [];

	switch ( $opcion ) {
		case 'registrar':
			registrar($nombre, $apellidos, $edad, $estado,$conexion);
			break;
		case 'modificar':
			modificar($id,$nombre, $apellidos, $edad, $estado,$conexion);
			break;		
		case 'eliminar':
			eliminar($id, $conexion);
			break;
		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;
	}

	

	function registrar($nombre, $apellidos, $edad, $estado,$conexion){
		
		//ulitimo registro

		$query = "SELECT * FROM promotoras ORDER BY id DESC";
		$resultado = mysqli_query($conexion, $query);

		$ultimoId = mysqli_fetch_assoc($resultado)['id']+1;
		
		$query = "INSERT INTO promotoras VALUES( $ultimoId,'$nombre', '$apellidos', '$edad', '$estado');";
		$resultado = mysqli_query($conexion, $query);	
		
		verificar_resultado($resultado);
		cerrar($conexion);	
	}

	function modificar($id,$nombre, $apellidos, $edad, $estado,$conexion){	
		$query= "UPDATE promotoras SET 	nombre='$nombre', 
										apellidos='$apellidos', 
										edad='$edad', 
										estado='$estado'

										WHERE id=$id";
		$resultado = mysqli_query($conexion, $query);
		verificar_resultado( $resultado );
		cerrar( $conexion );
	}

	function eliminar($id, $conexion){

		$query = "DELETE FROM promotoras WHERE id=$id";

		$resultado = mysqli_query($conexion, $query);
		verificar_resultado( $resultado );
		cerrar( $conexion );
	}

	function verificar_resultado( $resultado ){
		if( !$resultado )	$informacion["respuesta"] = "ERROR";
		else 	$informacion["respuesta"] = "BIEN";
		echo json_encode( $informacion );
	}

	function cerrar( $conexion ){
		mysqli_close( $conexion );
	}

 ?>