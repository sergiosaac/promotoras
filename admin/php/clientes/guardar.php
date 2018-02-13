<?php 
	include("conexion.php");

	$id = $_POST["id"];	
	$opcion = $_POST["opcion"];

	//obtener el valor de los campos
	if($opcion == "registrar" || $opcion == "modificar"){
		
		$nombre = $_POST["nombre"];
		$contacto = $_POST["contacto"];
		$numerocontacto = $_POST["numerocontacto"];

	}

	$informacion = [];

	switch ( $opcion ) {
		case 'registrar':
			registrar($nombre, $contacto, $numerocontacto,$conexion);
			break;
		case 'modificar':
			modificar($id,$nombre,  $contacto, $numerocontacto, $conexion);
			break;		
		case 'eliminar':
			eliminar($id, $conexion);
			break;
		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;
	}

	

	function registrar($nombre, $contacto, $numerocontacto,$conexion){
		
		//ulitimo registro

		$query = "SELECT * FROM clientes ORDER BY id DESC";
		$resultado = mysqli_query($conexion, $query);

		$ultimoId = mysqli_fetch_assoc($resultado)['id']+1;
		
		$query = "INSERT INTO clientes VALUES( $ultimoId,'$nombre', '$contacto', '$numerocontacto');";
		$resultado = mysqli_query($conexion, $query);	
		
		verificar_resultado($resultado);
		cerrar($conexion);	
	}

	function modificar($id,$nombre, $contacto, $numerocontacto,$conexion){	
		$query= "UPDATE clientes SET 	nombre='$nombre', 
										contacto='$contacto',
										numerocontacto='$numerocontacto'
										

										WHERE id=$id";
		$resultado = mysqli_query($conexion, $query);
		verificar_resultado( $resultado );
		cerrar( $conexion );
	}

	function eliminar($id, $conexion){

		$query = "DELETE FROM clientes WHERE id=$id";

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