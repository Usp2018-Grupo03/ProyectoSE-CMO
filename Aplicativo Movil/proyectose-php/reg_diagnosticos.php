<?PHP
	include_once './conexion.php';
	
	$json=array();
	
	if(isset($_GET["dif_nombre"])&&($_GET["dif_enfermedad"])&&($_GET["dif_porcentaje"])&&($_GET["dif_fecha"])){

		$dif_nombre=$_GET['dif_nombre'];
		$dif_enfermedad=$_GET['dif_enfermedad'];
		$dif_porcentaje=$_GET['dif_porcentaje'];
		$dif_fecha=$_GET['dif_fecha'];
		
		$conexion=mysqli_connect($host,$username,$password,$db_name);
		
		$consulta="INSERT INTO diagnosticofinal (dif_nombre, dif_enfermedad, dif_porcentaje, dif_fecha) 
					VALUES ('{$dif_nombre}','{$dif_enfermedad}','{$dif_porcentaje}','{$dif_fecha}')";

		mysqli_query($conexion,$consulta);
	}
	else{
			
		echo "Parametros no encontrados.";
	}
?>