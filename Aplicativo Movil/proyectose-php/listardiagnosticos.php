<?php
	include_once './conexion.php';

	$respuesta = array();
	$respuesta["diagnosticofinal"] = array();  

	$con = mysqli_connect("$host", "$username", "$password")or die("No se puede conectar al servidor."); 
	mysqli_select_db($con,"$db_name")or die("BD no encontrada.");

	$sql="SELECT * FROM `diagnosticofinal`";
	mysqli_set_charset($con, "utf8");

	if(!$result = mysqli_query($con, $sql)) die("Error en consulta");
	$result=mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result)){

		$tmp = array();
		$tmp["id_diagnosticofinal"] = $row["id_diagnosticofinal"];
		$tmp["dif_nombre"] = $row["dif_nombre"];
		$tmp["dif_enfermedad"] = $row["dif_enfermedad"];
		$tmp["dif_porcentaje"] = $row["dif_porcentaje"];
		$tmp["dif_fecha"] = $row["dif_fecha"];

		array_push($respuesta["diagnosticofinal"], $tmp);
	}

	header('Content-Type: application/json');

	echo json_encode($respuesta);
?>