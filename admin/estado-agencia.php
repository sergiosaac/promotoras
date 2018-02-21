<?php

	session_start();


	//helpers

	function importe($importe, $moneda = 10)
	{
		if (intval($moneda) == 10) {
			$importe = number_format($importe, 0, '', '.');
		} else if (intval($moneda) == 1) {
			$importe = number_format($importe, 2, ',', '.');
		}

		return $importe;
	}



	if (!isset($_SESSION['logueado'])) {
		header('Location: ../index.php');
	} 

	require('php/conexion.php');

	$array = array();

	$query = "SELECT * FROM promotoras;";
	$resultado = mysqli_query($conexion, $query);
	
	if( !$resultado )
		die("Error, no se ejecutó la consulta.");
	else{
		$array["data"] = [];//devuelve un arreglo vacio por si no hay registros en la base de datos
		while ( $data = mysqli_fetch_assoc($resultado)){
			$array["promotoras"][] = $data; //array_map("utf8_encode", $data); usar esta función por si no te muestra nada de datos, ya que, hay conflictos con los caracteres raros
		}
	}

	mysqli_free_result( $resultado );

	$promotorasDisponibles = [];
	$promotorasOcupadas = [];

	foreach ($array['promotoras'] as $promotora ) {

		if ($promotora['estado'] == 'Disponible') {
			array_push($promotorasDisponibles, $promotora);
		} else {
			array_push($promotorasOcupadas, $promotora);
		}
	}
	

	//----- EVENTOS


	$query = "SELECT * FROM eventos;";
	$resultado = mysqli_query($conexion, $query);
	
	if( !$resultado )
		die("Error, no se ejecutó la consulta.");
	else{
		$array["data"] = [];//devuelve un arreglo vacio por si no hay registros en la base de datos
		while ( $data = mysqli_fetch_assoc($resultado)){
			
			$data['totalgarpar'] = 1000000000;
			$array["eventos"][] = $data; //array_map("utf8_encode", $data); usar esta función por si no te muestra nada de datos, ya que, hay conflictos con los caracteres raros
		}
	}

	mysqli_free_result( $resultado );

	$eventosPendientes = [];
	$eventosTerminados = [];

	foreach ($array['eventos'] as $evento ) {

		if ($evento['estado'] == 'Terminado') {
			array_push($eventosTerminados, $evento);
		} else {
			array_push($eventosPendientes, $evento);
		}
	}

	//---- CLIENTES

	$query = "SELECT * FROM clientes;";
	$resultado = mysqli_query($conexion, $query);
	
	if( !$resultado )
		die("Error, no se ejecutó la consulta.");
	else{
		$array["data"] = [];//devuelve un arreglo vacio por si no hay registros en la base de datos
		while ( $data = mysqli_fetch_assoc($resultado)){
			$array["clientes"][] = $data; //array_map("utf8_encode", $data); usar esta función por si no te muestra nada de datos, ya que, hay conflictos con los caracteres raros
		}
	}

	mysqli_free_result( $resultado );

	//---COORDINADORES


	$query = "SELECT * FROM coordinadores;";
	$resultado = mysqli_query($conexion, $query);
	
	if( !$resultado )
		die("Error, no se ejecutó la consulta.");
	else{
		$array["data"] = [];//devuelve un arreglo vacio por si no hay registros en la base de datos
		while ( $data = mysqli_fetch_assoc($resultado)){
			$array["coordinadores"][] = $data; //array_map("utf8_encode", $data); usar esta función por si no te muestra nada de datos, ya que, hay conflictos con los caracteres raros
		}
	}

	mysqli_free_result( $resultado );

	mysqli_close( $conexion );

	

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title> Adminsitrador </title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
	<!-- Buttons DataTables -->
	<link rel="stylesheet" href="css/buttons.bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">

</head>
<body>

	<?php require 'header.php'; ?>
	<div class="">
		
		<div class="row">

		<h3 style="
		    
			
			margin: 20px; padding: 20px;
			text-align: center;"> 
			<img height="60" width="60" src="http://www.teckiosoftware.com/images/icono_reportes.png">
			Estado rápido de agencia 

		</h3>

		<div class="col-md-12">
			<hr>
			<div class="col-md-4">
				<h3> <span class="glyphicon glyphicon-user"></span> Promotoras</h3>
				<ul class="list-group">
				  <li class="list-group-item list-group-item-success">Disponibles <strong>(<?= count($promotorasDisponibles) ?>)</strong> </li>

				  <?php foreach ($promotorasDisponibles as $promotora ) { ?>
				  	<li class="list-group-item"><?= $promotora['nombre'].' '.$promotora['apellidos'] ?></li>
				  <?php } ?>

				  <li class="list-group-item list-group-item-warning">Ocupadas <strong>(<?= count($promotorasOcupadas) ?>)</strong></li>

				  <?php foreach ($promotorasOcupadas as $promotora ) { ?>
				  	<li class="list-group-item"><?= $promotora['nombre'].' '.$promotora['apellidos'] ?></li>
				  <?php } ?>

				</ul>
			</div>

			<div class="col-md-4">
				<h3> <span class="glyphicon glyphicon-folder-open"></span> Eventos</h3>
				
				<ul class="list-group">
				  <li class="list-group-item list-group-item-danger">Pendientes  <strong>(<?= count($eventosPendientes) ?>)</strong></li>

				  <?php foreach ($eventosPendientes as $evento ) { ?>

				  	<?php 
				  		$evento_modal_id = str_replace(' ','_',strtolower($evento['nombreevento'].$evento['id'])); 
				  	?>
				  	
				  	<li class="list-group-item" >
				  		 <p>  <?= $evento['nombreevento'] ?> <a href="#!"> <span id="<?= $evento_modal_id ?>disparador" class="glyphicon glyphicon-zoom-in"></span> </a> </p> 
				  	</li>
				  	<!-- Modal -->
					<div id="<?= $evento_modal_id ?>" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Detalles de evento:</h4>
					      </div>
					      <div class="modal-body">
					        <div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-heading"><strong> <?= $evento['nombreevento'] ?> </strong></div>

							  <!-- Table -->
							  <table class="table table-bordered">
							    <thead>
							      <tr>
							        <th>Item</th>
							        <th>Montos</th>
							      </tr>
							    </thead>
							    <tbody>
							      <tr>
							        <td>Pago a promotora</td>
							        <td><?= importe($evento['pagopromotora'])  ?> Gs. </td>
							      </tr>
							      <tr>
							        <td>Pago a coordinador</td>
							        <td><?= importe($evento['pagocoordinador'])  ?> Gs. </td>
							      </tr>
							      <tr>
							        <td>Costo para el cliente</td>
							        <td><?= importe($evento['costomarca'])  ?> Gs. </td>
							      </tr>


							    </tbody>
							  </table>
							</div>

							<br>

							  <table class="table table-bordered">
							    
							    <tbody>
							      <tr>
							        <td><strong> Total a invertir </strong></td>
							        <td><?= importe(intval($evento['pagopromotora'])+intval($evento['pagocoordinador'])) ?> Gs. </td>
							      </tr>

							      <tr>
							        <td><strong> Total a cobrar </strong></td>
							        <td><?= importe($evento['costomarca']) ?> Gs. </td>
							      </tr>

							    </tbody>
							  </table>

					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div>
					    </div>

					  </div>
					</div>

				  <?php } ?>

				  <li class="list-group-item list-group-item-warning">Terminados <strong>(<?= count($eventosTerminados) ?>)</strong></li>

				  <?php foreach ($eventosTerminados as $evento ) { ?>
				  	<li class="list-group-item">
				  		<?= $evento['nombreevento'] ?>
				  	</li>
				  <?php } ?>
				</ul>
			</div>


			<div class="col-md-4">
				<h3> 
					<span class="glyphicon glyphicon-calendar"></span> Coordinadores <strong> (<?= count($array['coordinadores']) ?>) </strong> y Clientes	<strong> (<?= count($array['clientes']) ?>) </strong>
				</h3>

				<ul class="list-group">
					<?php foreach ($array['coordinadores'] as $coordinadore ) { ?>
						<li class="list-group-item"> <?= $coordinadore['nombre'].' '.$coordinadore['apellidos'] ?> </li>	
					<?php } ?>
				</ul>

				<hr>

				<ul class="list-group">
					<?php foreach ($array['clientes'] as $cliente ) { ?>
						<li class="list-group-item"> <?= $cliente['nombre'] ?> </li>	
					<?php } ?>
				</ul>

			</div>

		</div>


	</div>
	<script src="js/jquery-1.12.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">


		<?php foreach ($eventosPendientes as $evento ) { ?>

	  	<?php 
	  		$evento_modal_id = str_replace(' ','_',strtolower($evento['nombreevento'].$evento['id'])); 
	  	?>

	  	$(document).ready(function () {

		    $('#<?= $evento_modal_id.'disparador' ?>').click(function () {
				$("#<?= $evento_modal_id ?>").modal("show");		    	
		    });
		});

		<?php } ?>

		    
	</script>
	
	
</body>
</html>
