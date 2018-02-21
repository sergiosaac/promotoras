<?php

	session_start();

	if (!isset($_SESSION['logueado'])) {
		header('Location: ../index.php');
	} 

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
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-7">
            
            <div class="list-group">
			  
			  <a href="#" style="padding: 30px;" class="list-group-item active">
			    <h4 style="text-align: center;" class="list-group-item-heading">
			    	Administración general
				</h4>
			  </a>


			  <a href="eventos.php" style="padding: 30px;" class="list-group-item">
			    <h4 class="list-group-item-heading">
			    	<img height="60" width="60" src="https://png.icons8.com/small/540/event-accepted-tentatively.png"> 	Eventos
				</h4>
			  </a>

			  <a href="promotoras.php" style="padding: 30px;" class="list-group-item">
			    <h4 class="list-group-item-heading">
			    	<img height="60" width="60" src="http://www.externateam.com/wp-content/uploads/2016/02/candidatas.png"> 	Promotoras
				</h4>
			  </a>

			  <a href="coordinadores.php" style="padding: 30px;" class="list-group-item">
			    <h4 class="list-group-item-heading">
			    	<img height="60" width="60" src="http://www.unimayor.edu.co/web/uploads/contenidos/docente.png"> 	Coordinadores
				</h4>
			  </a>

			  <a href="clientes.php" style="padding: 30px;" class="list-group-item">
			    <h4 class="list-group-item-heading">
			    	<img height="60" width="60" src="http://www.seidor.com/content/dam/seidor/img/icono-clientes.png"> 	Clientes
				</h4>
			  </a>

			</div>

          </div>

          <div class="col-md-4">
            
            <div class="list-group">
			  
			  <a href="#" style="padding: 30px;" class="list-group-item active">
			    <h4 style="text-align: center;"  class="list-group-item-heading">
			    	Reportes y facturacion 
				</h4>
			  </a>

			  <a href="estado-agencia.php" style="padding: 30px;" class="list-group-item noTodavia">
			    <h4 class="list-group-item-heading">
			    	<img height="60" width="60" src="http://www.teckiosoftware.com/images/icono_reportes.png"> 	Resumen
				</h4>
			  </a>

			  <a href="factura/index.php" style="padding: 30px;" class="list-group-item">
			    <h4 class="list-group-item-heading">
			    	<img height="60" width="60" src="http://es.seaicons.com/wp-content/uploads/2015/10/Billing-icon.png"> 	Crear factura
				</h4>
			  </a>


			</div>

          </div>
          
        </div>

        <hr>

      </div>

      <!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Primeros pasos en su sistema:</h4>
		      </div>
		      <div class="modal-body">
		        <p>Buenas, gracias por utilizar el sistema.</p>
		        <p>
		        	Esta la primera version del sistema, donde estan terminados los ABMS. 
		        	Favor si se pueden cargar datos para tener informacion y hacer las pruebas de las funcionalidades correspondientes.
		        </p>
		        <p>
		        	Cargar las tablas de PROMOTORAS, CLIENTES, COORDINADORES y EVENTOS.
		        </p>
		        <p>
		        	Cualquier cosas favor comunicarse.
		        </p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>

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

	<script type="text/javascript">
		
		$(document).ready(function () {
		    //$("#myModal").modal("show");

		    $('.noTodavia').click(function () {
				//$("#myModal").modal("show");		    	
		    });
		});
		    
	</script>

	
</body>
</html>

