<?php 
	include("conexion.php");

	$idusuario = $_POST["idusuario"];	
	$opcion = $_POST["opcion"];

	if($opcion == "registrar" || $opcion == "modificar"){//obtener el valor de los campos
		$horainicio = $_POST["horainicio"];
		$horafin = $_POST["horafin"];
		$fecha = $_POST["fecha"];
		$estado = $_POST["estado"];
		$id_cliente = $_POST["id_cliente"];
		$costomarca = $_POST["costomarca"];
		$pagopromotora = $_POST["pagopromotora"];
		$pagocoordinador = $_POST["pagocoordinador"];
		$logistica = $_POST["logistica"];
		$nombreevento = $_POST["nombreevento"];
		$id_promotora = $_POST["id_promotora"];
		$id_coordinador = $_POST["id_coordinador"];

		//opa
		$id_promotora = implode(",", $_POST["id_promotora"]);

	}


	$informacion = [];

	switch ( $opcion ) {
		case 'registrar':
				if( $horainicio != "" && $horafin != "" && $fecha != "" ){
					//no igual nomas
					$existe = 0;
					if( $existe > 0 ){
						$informacion["respuesta"] = "EXISTE";
						echo json_encode($informacion);
					}else{
						registrar($horainicio, $horafin, $fecha, $estado, $id_cliente, $costomarca, 
						$pagopromotora, $pagocoordinador, $logistica, $nombreevento,$conexion,$id_promotora,$id_coordinador);
					}									
				}else{
					$informacion["respuesta"] = "VACIO";
					echo json_encode($informacion);
				}
			break;
		case 'modificar':
			modificar($idusuario,$horainicio, $horafin, $fecha, $estado, $id_cliente, $costomarca, 
			$pagopromotora, $pagocoordinador, $logistica, $nombreevento,$conexion,$id_promotora,$id_coordinador);
			break;		
		case 'eliminar':
			eliminar($idusuario, $conexion);
			break;
		default:
			$informacion["respuesta"] = "OPCION_VACIA";
			echo json_encode($informacion);
			break;
	}

	function existe_usuario($dni, $conexion){
		$query = "SELECT idusuario FROM usuario WHERE dni = '$dni';";
		$resultado = mysqli_query($conexion, $query);
		$existe_usuario = mysqli_num_rows( $resultado );
		return $existe_usuario;
	}

	function registrar($horainicio, $horafin, $fecha, $estado, $id_cliente, $costomarca, $pagopromotora, $pagocoordinador, $logistica, $nombreevento,$conexion,$id_promotora,$id_coordinador){
		
		//ulitimo registro

		$query = "SELECT * FROM eventos ORDER BY id DESC";
		$resultado = mysqli_query($conexion, $query);

		$ultimoId = mysqli_fetch_assoc($resultado)['id']+1;
		
		$query = "INSERT INTO eventos VALUES( $ultimoId,'$horainicio', '$horafin', '$fecha', '$estado', '$id_cliente', '$costomarca', '$pagopromotora', '$pagocoordinador', '$logistica', '$nombreevento', '$id_promotora', '$id_coordinador');";
		$resultado = mysqli_query($conexion, $query);	
		
		verificar_resultado($resultado);
		cerrar($conexion);
		
	}

	function modificar($idusuario,$horainicio, $horafin, $fecha, $estado, $id_cliente, $costomarca, $pagopromotora, $pagocoordinador, $logistica, $nombreevento,$conexion,$id_promotora,$id_coordinador){	
		$query= "UPDATE eventos SET 	horainicio='$horainicio', 
										horafin='$horafin', 
										estado='$estado', 
										id_cliente='$id_cliente', 
										costomarca='$costomarca', 
										pagopromotora='$pagopromotora', 
										pagocoordinador='$pagocoordinador', 
										logistica='$logistica', 
										nombreevento='$nombreevento', 
										fecha='$fecha',
										id_promotora='$id_promotora',
										id_coordinador='$id_coordinador' 
								WHERE   id=$idusuario";
		$resultado = mysqli_query($conexion, $query);
		verificar_resultado( $resultado );
		cerrar( $conexion );
	}

	function eliminar($idusuario, $conexion){

		$query = "DELETE FROM eventos WHERE id=$idusuario";

		//$query = "UPDATE eventos SET estado = 0 WHERE idusuario = $idusuario";
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