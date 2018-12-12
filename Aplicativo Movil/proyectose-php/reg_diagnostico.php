<?PHP
	include_once './conexion.php';
	
	$json=array();
	
	if(isset($_GET["dia_porcentaje"])&&($_GET["id_usuario"])&&($_GET["id_enfermedad"])){

		$dia_porcentaje=$_GET['dia_porcentaje'];
		$id_usuario=$_GET['id_usuario'];
		$dia_enfermedad=$_GET['id_enfermedad'];
		
		$conexion=mysqli_connect($host,$username,$password,$db_name);
		
		$consulta="INSERT INTO diagnostico (dia_porcentaje, id_usuario, dia_enfermedad) 
					VALUES ('{$dia_porcentaje}','{$id_usuario}','{$dia_enfermedad}')";
		mysqli_query($conexion,$consulta);
       
	}
	else{   
			
		echo "Parametros no encontrados.";
	}
?>