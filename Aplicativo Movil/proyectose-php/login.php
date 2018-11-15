<?PHP
	include_once './conexion.php';
	
	$json=array();
	
	if(isset($_GET["user"]) && isset($_GET["pwd"])){
		$user=$_GET['user'];
		$pwd=$_GET['pwd'];
		
		$conexion=mysqli_connect($host,$username,$password,$db_name);
		
		$consulta="SELECT usu_usuario, usu_password, usu_nombres, usu_apellidos FROM usuario WHERE usu_usuario= '{$user}' AND usu_password = '{$pwd}'";
		$resultado=mysqli_query($conexion,$consulta);

		if($consulta){
		
			if($reg=mysqli_fetch_array($resultado)){
				$json['datos'][]=$reg;
			}
			mysqli_close($conexion);
			echo json_encode($json);
		}else{
			
			echo "Error al ejecutar la consulta.";
		}
	}else{
		
		echo "Parametros no encontrados.";
	}
?>