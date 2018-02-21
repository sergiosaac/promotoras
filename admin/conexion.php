<?php
	$server = "localhost";
	$user = "root";
	$password = "root";//poner tu propia contraseña, si tienes una.
	$bd = "abmpromotoras";

	$conexion = mysqli_connect($server, $user, $password, $bd);
	
	if (!$conexion){ 
		die('Error de Conexión: ' . mysqli_connect_errno());	
	}



	function archivo($data)
	{
		$file = fopen("archivo.txt", "r");

		while(!feof($file)) {

			echo fgets($file). json_encode($data);

		}

		fclose($file);
	}