<?php 
	include("conexion.php");

	$id = $_POST["id"];	
	$opcion = $_POST["opcion"];

	//obtener el valor de los campos
	if($opcion == "registrar" || $opcion == "modificar"){
		
		$nombre = $_POST["nombre"];
		$apellidos = $_POST["apellidos"];

	}

	$informacion = [];

	switch ( $opcion ) {
		case 'registrar':
			registrar($nombre, $apellidos,$conexion);
			break;
		case 'modificar':
			modificar($id,$nombre, $apellidos, $conexion);
			break;		
		case 'eliminar':
			eliminar($id, $conexion);
			break;
		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;
	}

	

	function registrar($nombre, $apellidos,$conexion){
		
		//ulitimo registro

		$query = "SELECT * FROM coordinadores ORDER BY id DESC";
		$resultado = mysqli_query($conexion, $query);

		$ultimoId = mysqli_fetch_assoc($resultado)['id']+1;
		
		$query = "INSERT INTO coordinadores VALUES( $ultimoId,'$nombre', '$apellidos');";
		$resultado = mysqli_query($conexion, $query);	
		
		verificar_resultado($resultado);
		cerrar($conexion);	
	}

	function modificar($id,$nombre, $apellidos,$conexion){	
		$query= "UPDATE coordinadores SET 	nombre='$nombre', 
										apellidos='$apellidos'
										

										WHERE id=$id";
		$resultado = mysqli_query($conexion, $query);
		verificar_resultado( $resultado );
		cerrar( $conexion );
	}

	function eliminar($id, $conexion){

		$query = "DELETE FROM coordinadores WHERE id=$id";

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