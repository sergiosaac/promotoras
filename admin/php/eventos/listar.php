<?php
	include ("conexion.php");

	$query = "SELECT * FROM eventos";
	$resultado = mysqli_query($conexion, $query);
	
	if( !$resultado )
		die("Error, no se ejecutó la consulta.");
	else{
		$array["data"] = [];//devuelve un arreglo vacio por si no hay registros en la base de datos
		
		while ( $data = mysqli_fetch_assoc($resultado)){
			$array["data"][] = $data; //array_map("utf8_encode", $data); usar esta función por si no te muestra nada de datos, ya que, hay conflictos con los caracteres raros
		}

		foreach ($array['data'] as &$registro) {

			$registro['nombreCliente'] = obtenerCliente($conexion,$registro['id_cliente'])['nombre'];
			$registro['nombrePromotora'] = obtenerPromotora($conexion,$registro['id_promotora'])['nombre']." ".obtenerPromotora($conexion,$registro['id_promotora'])['apellidos'];
			$registro['nombreCoordinador'] = obtenerCoordinador($conexion,$registro['id_coordinador'])['nombre']." ".obtenerCoordinador($conexion,$registro['id_coordinador'])['apellidos'];
		}

		echo json_encode($array);
	}

	mysqli_free_result( $resultado );
	mysqli_close( $conexion );


	// Obtener cosas

	function obtenerCliente($conexion,$id)
	{
		$query = "SELECT * FROM clientes WHERE id=$id";
		$resultado = mysqli_query($conexion, $query);
		return mysqli_fetch_assoc($resultado);
	}

	function obtenerPromotora($conexion,$id)
	{
		$query = "SELECT * FROM promotoras WHERE id=$id";
		$resultado = mysqli_query($conexion, $query);
		return mysqli_fetch_assoc($resultado);
	}

	function obtenerCoordinador($conexion,$id)
	{
		$query = "SELECT * FROM coordinadores WHERE id=$id";
		$resultado = mysqli_query($conexion, $query);
		return mysqli_fetch_assoc($resultado);
	}

	




	// $statement = $db_con->prepare("select * from usuario");
	// $statement->execute();
	// $row = $statement->fetchAll(PDO::FETCH_ASSOC);
	// echo "<pre>";
	// print_r(json_encode($row));
	// echo "</pre>";


