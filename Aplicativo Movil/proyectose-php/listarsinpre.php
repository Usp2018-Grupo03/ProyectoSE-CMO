<?PHP
	include_once './conexion.php';
	
	$json=array();
	
	if(isset($_GET["id_sintoma"])){
		$id_sintoma = $_GET['id_sintoma'];
		
		$respuesta = array();
		$respuesta["sinpre"] = array();  

		$con = mysqli_connect("$host", "$username", "$password")or die("No se puede conectar al servidor."); 
		mysqli_select_db($con,"$db_name")or die("BD no encontrada.");
		
		$sql="SELECT * FROM `detallesinpre` WHERE id_sintoma = '{$id_sintoma}'";

		mysqli_set_charset($con, "utf8");

		if(!$result = mysqli_query($con, $sql)) die("Error en consulta");
		$result=mysqli_query($con,$sql);
	
		while($row = mysqli_fetch_array($result)){
	
			$tmp = array();
			$tmp["id_pregunta"] = $row["id_pregunta"];
	
			array_push($respuesta["sinpre"], $tmp);
		}
	
		header('Content-Type: application/json');
	
		echo json_encode($respuesta);
	}else{
		
		echo "Parametros no encontrados.";
	}
?>