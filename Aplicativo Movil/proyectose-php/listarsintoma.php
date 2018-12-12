<?PHP
	include_once './conexion.php';
	
	$json=array();
	
	if(isset($_GET["id_enfermedad"])){
		$id_enfermedad = $_GET['id_enfermedad'];
		
		$respuesta = array();
		$respuesta["sintoma"] = array();  

		$con = mysqli_connect("$host", "$username", "$password")or die("No se puede conectar al servidor."); 
		mysqli_select_db($con,"$db_name")or die("BD no encontrada.");
		
		$sql="SELECT * FROM `detalleenfsin` WHERE id_enfermedad = '{$id_enfermedad}'";

		mysqli_set_charset($con, "utf8");

		if(!$result = mysqli_query($con, $sql)) die("Error en consulta");
		$result=mysqli_query($con,$sql);
	
		while($row = mysqli_fetch_array($result)){
	
			$tmp = array();
			$tmp["id_sintoma"] = $row["id_sintoma"];
	
			array_push($respuesta["sintoma"], $tmp);
		}
	
		header('Content-Type: application/json');
	
		echo json_encode($respuesta);
	}else{
		
		echo "Parametros no encontrados.";
	}
?>