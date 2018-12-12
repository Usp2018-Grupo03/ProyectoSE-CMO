<?PHP
	include_once './conexion.php';
	
	$json=array();
	
	if(isset($_GET["id_pregunta"])){
		$id_pregunta = $_GET['id_pregunta'];
		
		$respuesta = array();
		$respuesta["opcion"] = array();  

		$con = mysqli_connect("$host", "$username", "$password")or die("No se puede conectar al servidor."); 
		mysqli_select_db($con,"$db_name")or die("BD no encontrada.");
		
		$sql="	SELECT detallepreopc.dpo_puntaje, opcion.opc_titulo, detallepreopc.id_pregunta 
				FROM detallepreopc 
				INNER JOIN pregunta on detallepreopc.id_pregunta=pregunta.id_pregunta 
				INNER JOIN opcion on detallepreopc.id_opcion=opcion.id_opcion 
				WHERE detallepreopc.id_pregunta = '{$id_pregunta}'";

		mysqli_set_charset($con, "utf8");

		if(!$result = mysqli_query($con, $sql)) die("Error en consulta");
		$result=mysqli_query($con,$sql);
	
		while($row = mysqli_fetch_array($result)){
	
			$tmp = array();
			$tmp["dpo_puntaje"] = $row["dpo_puntaje"];
			$tmp["opc_titulo"] = $row["opc_titulo"];
			$tmp["id_pregunta"] = $row["id_pregunta"];
	
			array_push($respuesta["opcion"], $tmp);
		}
	
		header('Content-Type: application/json');
	
		echo json_encode($respuesta);
	}else{
		
		echo "Parametros no encontrados.";
	}
?>