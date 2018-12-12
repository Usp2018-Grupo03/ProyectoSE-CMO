<?php
	include_once './conexion.php';

	$respuesta = array();
	$respuesta["diagnostico"] = array();  

	$con = mysqli_connect("$host", "$username", "$password")or die("No se puede conectar al servidor."); 
	mysqli_select_db($con,"$db_name")or die("BD no encontrada.");

	$sql="SELECT * FROM `diagnostico` INNER JOIN usuario on diagnostico.id_usuario=usuario.id_usuario";
	mysqli_set_charset($con, "utf8");

	if(!$result = mysqli_query($con, $sql)) die("Error en consulta");
	$result=mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result)){

		$tmp = array();
		$tmp["dia_porcentaje"] = $row["dia_porcentaje"];
		$tmp["dia_enfermedad"] = $row["dia_enfermedad"];
		$tmp["usu_nombres"] = $row["usu_nombres"];

		array_push($respuesta["diagnostico"], $tmp);
	}

	header('Content-Type: application/json');

	echo json_encode($respuesta);
?>