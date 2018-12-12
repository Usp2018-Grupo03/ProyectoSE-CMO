<?PHP
	include_once './conexion.php';
	
	$json=array();
	
	if(isset($_GET["id_pregunta"])){
		$id_pregunta = $_GET['id_pregunta'];
		
		$respuesta = array();
		$respuesta["temporal"] = array();  

		$con = mysqli_connect("$host", "$username", "$password")or die("No se puede conectar al servidor."); 
		mysqli_select_db($con,"$db_name")or die("BD no encontrada.");
		
		$sql="SELECT * FROM `temporal` WHERE id_pregunta = '{$id_pregunta}' ORDER BY id_temporal DESC LIMIT 1";

		mysqli_set_charset($con, "utf8");

		if(!$result = mysqli_query($con, $sql)) die("Error en consulta");
		$result=mysqli_query($con,$sql);
	
		while($row = mysqli_fetch_array($result)){
	
			$tmp = array();
			$tmp["dpo_puntaje"] = $row["dpo_puntaje"];
	
			array_push($respuesta["temporal"], $tmp);
		}
	
		header('Content-Type: application/json');
	
		echo json_encode($respuesta);
	}else{
		
		echo "Parametros no encontrados.";
	}
?>