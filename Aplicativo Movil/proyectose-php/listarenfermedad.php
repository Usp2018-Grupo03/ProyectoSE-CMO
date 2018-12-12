<?php
	include_once './conexion.php';

	$respuesta = array();
	$respuesta["enfermedad"] = array();  

	$con = mysqli_connect("$host", "$username", "$password")or die("No se puede conectar al servidor."); 
	mysqli_select_db($con,"$db_name")or die("BD no encontrada.");

	$sql="SELECT * FROM `enfermedad`";
	mysqli_set_charset($con, "utf8");

	if(!$result = mysqli_query($con, $sql)) die("Error en consulta");
	$result=mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result)){

		$tmp = array();
		$tmp["id_enfermedad"] = $row["id_enfermedad"];
		$tmp["enf_nombre"] = $row["enf_nombre"];

		array_push($respuesta["enfermedad"], $tmp);
	}

	header('Content-Type: application/json');

	echo json_encode($respuesta);
?>