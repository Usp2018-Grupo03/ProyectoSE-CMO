<?PHP
	include_once './conexion.php';
	
	$json=array();
	
	if(isset($_GET["dpo_puntaje"])&&($_GET["id_pregunta"])){

		$dpo_puntaje=$_GET['dpo_puntaje'];
		$id_pregunta=$_GET['id_pregunta'];
		
		$conexion=mysqli_connect($host,$username,$password,$db_name);
		
		$consulta="INSERT INTO temporal (dpo_puntaje, id_pregunta) 
					VALUES ('{$dpo_puntaje}','{$id_pregunta}')";
		$resultado=mysqli_query($conexion,$consulta);
       
		if($consulta){

		   $consulta="SELECT * FROM temporal  WHERE id_pregunta = '{$id_pregunta}'";
		   $resultado=mysqli_query($conexion,$consulta);

			if($reg=mysqli_fetch_array($resultado)){
				$json['datos'][]=$reg;
			}

			mysqli_close($conexion);
			echo json_encode($json);
		}else{

			echo "Error al ejecutar la consulta.";
		}
	}
	else{   
			
		echo "Parametros no encontrados.";
	}
?>