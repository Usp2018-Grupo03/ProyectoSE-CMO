<?php
	include_once './conexion.php';

	$respuesta = array();
	$respuesta["pregunta"] = array();  

	$con = mysqli_connect("$host", "$username", "$password")or die("No se puede conectar al servidor."); 
	mysqli_select_db($con,"$db_name")or die("BD no encontrada.");

	$sql="DELETE FROM temporal";
	mysqli_set_charset($con, "utf8");

	$sql2="DELETE FROM diagnostico";
	mysqli_set_charset($con, "utf8");

	$sql3="DELETE FROM puntaje";
	mysqli_set_charset($con, "utf8");

	if(!$result = mysqli_query($con, $sql)) die("Error en consulta");
	mysqli_query($con,$sql);

	if(!$result = mysqli_query($con, $sql2)) die("Error en consulta");
	mysqli_query($con,$sql2);

	if(!$result = mysqli_query($con, $sql3)) die("Error en consulta");
	mysqli_query($con,$sql3);

	header('Content-Type: application/json');

	echo json_encode($respuesta);
?>