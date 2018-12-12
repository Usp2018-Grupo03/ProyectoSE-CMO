<?PHP
	include_once './conexion.php';
	
	$json=array();
	
	if(isset($_GET["enf_nombre"])){
		$enf_nombre = $_GET['enf_nombre'];
		
		$respuesta = array();
		$respuesta["puntaje"] = array();  

		$con = mysqli_connect("$host", "$username", "$password")or die("No se puede conectar al servidor."); 
		mysqli_select_db($con,"$db_name")or die("BD no encontrada.");
		
		$sql="SELECT * FROM `puntaje` WHERE pun_enfermedad = '{$enf_nombre}'";

		mysqli_set_charset($con, "utf8");

		if(!$result = mysqli_query($con, $sql)) die("Error en consulta");
		$result=mysqli_query($con,$sql);
	
		while($row = mysqli_fetch_array($result)){
	
			$tmp = array();
			$tmp["pun_valor"] = $row["pun_valor"];
	
			array_push($respuesta["puntaje"], $tmp);
		}
	
		header('Content-Type: application/json');
	
		echo json_encode($respuesta);
	}else{
		
		echo "Parametros no encontrados.";
	}
?>