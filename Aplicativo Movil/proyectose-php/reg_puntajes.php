<?PHP
	include_once './conexion.php';
	
	$json=array();
	
	if(isset($_GET["pun_enfermedad"])&&($_GET["pun_valor"])){

		$pun_enfermedad=$_GET['pun_enfermedad'];
		$pun_valor=$_GET['pun_valor'];
		
		$conexion=mysqli_connect($host,$username,$password,$db_name);
		
		$consulta="INSERT INTO puntaje (pun_enfermedad, pun_valor) 
					VALUES ('{$pun_enfermedad}','{$pun_valor}')";
		mysqli_query($conexion,$consulta);
       
	}
	else{   
			
		echo "Parametros no encontrados.";
	}
?>