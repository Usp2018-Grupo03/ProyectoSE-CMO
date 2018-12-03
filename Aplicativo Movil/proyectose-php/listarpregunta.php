<?php
	include_once './conexion.php';

	$respuesta = array();
	$respuesta["pregunta"] = array();  

	$con = mysqli_connect("$host", "$username", "$password")or die("No se puede conectar al servidor."); 
	mysqli_select_db($con,"$db_name")or die("BD no encontrada.");

	$sql="select * from pregunta where pre_estado = 1";
	mysqli_set_charset($con, "utf8");

	if(!$result = mysqli_query($con, $sql)) die("Error en consulta");
	$result=mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result)){

		$tmp = array();
		$tmp["id_pregunta"] = $row["id_pregunta"];
		$tmp["pre_titulo"] = $row["pre_titulo"];
		$tmp["pre_descripcion"] = $row["pre_descripcion"];
		$tmp["pre_imagen"] = $row["pre_imagen"];
		$tmp["pre_fecha"] = $row["pre_fecha"];
		$tmp["pre_estado"] = $row["pre_estado"];
		$tmp["pre_puntaje"] = $row["pre_puntaje"];

		array_push($respuesta["pregunta"], $tmp);
	}

	header('Content-Type: application/json');

	echo json_encode($respuesta);
?>