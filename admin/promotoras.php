<?php

	session_start();

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
	

	//-----

	

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
	<div class="container">
		
		<div class="row">

		<h3 style="
		    
			border-left:10px solid pink; 
			margin: 20px; padding: 20px;"> 
			<img height="60" width="60" src="http://www.externateam.com/wp-content/uploads/2016/02/candidatas.png">
			Administracion de promotoras 

		</h3>

		<div class="col-md-12">
			<div class="col-md-6">
				<ul class="list-group">
				  <li class="list-group-item list-group-item-success">Disponibles</li>

				  <?php foreach ($promotorasDisponibles as $promotora ) { ?>
				  	<li class="list-group-item"><?= $promotora['nombre'].' '.$promotora['apellidos'] ?></li>
				  <?php } ?>

				</ul>	
			</div>

			<div class="col-md-6">
				<ul class="list-group">
				  <li class="list-group-item list-group-item-warning">Ocupadas</li>
				  
				  <?php foreach ($promotorasOcupadas as $promotora ) { ?>
				  	<li class="list-group-item"><?= $promotora['nombre'].' '.$promotora['apellidos'] ?></li>
				  <?php } ?>

				</ul>
			</div>
		</div>

		<div id="cuadro2" class="col-sm-12 col-md-12 col-lg-12 ocultar">
			<form class="form-horizontal" action="" method="POST">
				<div class="form-group">
					<h3 class="col-sm-offset-2 col-sm-8 text-center">					
					Formulario de Registro de Eventos</h3>
				</div>
				<input type="hidden" id="id" name="id" value="0">
				<input type="hidden" id="opcion" name="opcion" value="registrar">
				
				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombre</label>
					<div class="col-sm-8"><input id="nombre" name="nombre" type="text" class="form-control"  autofocus>
					</div>		
				</div>

				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Apellido</label>
					<div class="col-sm-8"><input id="apellidos" name="apellidos" type="text" class="form-control"  autofocus>
					</div>		
				</div>

				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Edad</label>
					<div class="col-sm-8"><input id="edad" name="edad" type="text" class="form-control"  autofocus>
					</div>		
				</div>

				<div class="form-group">
					<label for="apellidos" class="col-sm-2 control-label">Coordinador encargado</label>
					<div class="col-sm-8">

						<select class="form-control" name="estado" id="estado">
							<option value="Disponible" selected > Disponible </option>
							<option value="Ocupada" > Ocupada </option>
						</select>
					</div>
				</div>

				
				
	
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8">
						<input id="" type="submit" class="btn btn-primary" value="Guardar">
						<input id="btn_listar" type="button" class="btn btn-primary" value="Listar">
					</div>
				</div>
			</form>
			<div class="col-sm-offset-2 col-sm-8">
				<p class="mensaje"></p>
			</div>
			
		</div>
	</div>
	<div class="row">
		<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center"> <small class="mensaje"></small></h3>
			</div>
			<div class="table-responsive col-sm-12">		
				<table id="dt_cliente" class="table table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>								
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Edad</th>
							<th>Estado</th>
							<th></th>											
						</tr>
					</thead>					
				</table>
			</div>			
		</div>		
	</div>
	<div>
		<form id="frmEliminarUsuario" action="" method="POST">
			<input type="hidden" id="id" name="id" value="">
			<input type="hidden" id="opcion" name="opcion" value="eliminar">
			<!-- Modal -->
			<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="modalEliminarLabel">Eliminar Evento</h4>
						</div>
						<div class="modal-body">							
							¿Está seguro de eliminar al evento?<strong data-name=""></strong>
						</div>
						<div class="modal-footer">
							<button type="button" id="eliminar-usuario" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
		</form>
	</div>

	</div>
	
	<script src="js/jquery-1.12.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.js"></script>
	<!--botones DataTables-->	
	<script src="js/dataTables.buttons.min.js"></script>
	<script src="js/buttons.bootstrap.min.js"></script>
	<!--Libreria para exportar Excel-->
	<script src="js/jszip.min.js"></script>
	<!--Librerias para exportar PDF-->
	<script src="js/pdfmake.min.js"></script>
	<script src="js/vfs_fonts.js"></script>
	<!--Librerias para botones de exportación-->
	<script src="js/buttons.html5.min.js"></script>

	<script>		
		$(document).on("ready", function(){
			listar();
			guardar();
			eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

		var guardar = function(){
			$("form").on("submit", function(e){
				e.preventDefault();
				var frm = $(this).serialize();
				$.ajax({
					method: "POST",
					url: "php/promotoras/guardar.php",
					data: frm
				}).done( function( info ){
					console.log( info );
					var json_info = JSON.parse( info );
					mostrar_mensaje( json_info );
					limpiar_datos();
					listar();
				});

				location.reload();
			});


		}

		var eliminar = function(){
			$("#eliminar-usuario").on("click", function(){
				var id = $("#frmEliminarUsuario #id").val(),
					opcion = $("#frmEliminarUsuario #opcion").val();
				$.ajax({
					method:"POST",
					url: "php/promotoras/guardar.php",
					data: {"id": id, "opcion": opcion}
				}).done( function( info ){
					var json_info = JSON.parse( info );
					mostrar_mensaje( json_info );
					limpiar_datos();
					listar();
					location.reload();
				});
			});
		}

		var mostrar_mensaje = function( informacion ){
			var texto = "", color = "";
			if( informacion.respuesta == "BIEN" ){
					texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
					color = "#379911";
			}else if( informacion.respuesta == "ERROR"){
					texto = "<strong>Error</strong>, no se ejecutó la consulta.";
					color = "#C9302C";
			}else if( informacion.respuesta == "EXISTE" ){
					texto = "<strong>Información!</strong> el usuario ya existe.";
					color = "#5b94c5";
			}else if( informacion.respuesta == "VACIO" ){
					texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
					color = "#ddb11d";
			}else if( informacion.respuesta == "OPCION_VACIA" ){
					texto = "<strong>Advertencia!</strong> la opción no existe o esta vacia, recargar la página.";
					color = "#ddb11d";
			}

			$(".mensaje").html( texto ).css({"color": color });
			$(".mensaje").fadeOut(5000, function(){
					$(this).html("");
					$(this).fadeIn(3000);
			});			
		}

		var limpiar_datos = function(){
			$("#horainicio").val("registrar");
			$("#nombre").val("");
			$("#edad").val("").focus();
			$("#apellidos").val("");
			$("#estado").val("");
			
			
		}

		var listar = function(){
				$("#cuadro2").slideUp("slow");
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_cliente").DataTable({
				//"processing": true,
				//"serverSide": true,
				"destroy":true,
				"ajax":{
					"method":"POST",
					"url": "php/promotoras/listar.php"
				},
				"columns":[
					{"data":"nombre"},
					{"data":"apellidos"},
					{"data":"edad"},
					{"data":"estado"},
					{"defaultContent": "<button type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i></button>	<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}	
				],
				"language": idioma_espanol,
				"dom": "<'row'<'form-inline' <'col-sm-offset-5'B>>>"
					 +"<'row' <'form-inline' <'col-sm-1'f>>>"
					 +"<rt>"
					 +"<'row'<'form-inline'"
					 +" <'col-sm-6 col-md-6 col-lg-6'l>"
					 +"<'col-sm-6 col-md-6 col-lg-6'p>>>",
				"buttons":[
					{
						"text": "<i class='fa fa-user-plus'></i>",
						"titleAttr": "Agregar evento",
						"className": "btn btn-success",
						"action": function(){
							agregar_nuevo_usuario();
						}
					},
					{
		                extend:    'excelHtml5',
		                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel'
		         },
		         {
		         	extend: 'csvHtml5',
		         	text: '<i class="fa fa-file-text-o"></i>',
		         	titleAttr: 'CSV'
		         },
		         {
		                extend:    'pdfHtml5',
		                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF'
		         }
				]
			});

			obtener_data_editar("#dt_cliente tbody", table);
			obtener_id_eliminar("#dt_cliente tbody", table);
		}

		var agregar_nuevo_usuario = function(){
			limpiar_datos();
			$("#cuadro2").slideDown("slow");
			$("#cuadro1").slideUp("slow");
		}

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				
				var data = table.row( $(this).parents("tr") ).data();
				
				var id = $("#id").val( data.id ),
				nombre = $("#nombre").val( data.nombre ),
				apellidos = $("#apellidos").val( data.apellidos ),
				edad = $("#edad").val( data.edad ),
				estado = $("#estado").val( data.estado ),

				opcion = $("#opcion").val("modificar");
				
				$("#cuadro2").slideDown("slow");
				$("#cuadro1").slideUp("slow");
			});
		}

		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id = $("#frmEliminarUsuario #id").val( data.id );
			});
		}

		var idioma_espanol = {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}
		
	</script>
</body>
</html>
