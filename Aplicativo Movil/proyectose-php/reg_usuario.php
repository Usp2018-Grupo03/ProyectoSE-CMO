<?PHP
	include_once './conexion.php';
	
	$json=array();
	
	if(isset($_GET["nombres"])&&($_GET["apellidos"])&&($_GET["usuario"])&&($_GET["passwd"])&&($_GET["correo"])&&($_GET["direccion"])){

		$nombres=$_GET['nombres'];
		$apellidos=$_GET['apellidos'];
		$usuario=$_GET['usuario'];
		$passwd=$_GET['passwd'];
		$correo=$_GET['correo'];
		$direccion=$_GET['direccion'];
		
		$conexion=mysqli_connect($host,$username,$password,$db_name);
		
		$consulta="INSERT INTO usuario (usu_nombres, usu_apellidos, usu_rol, usu_usuario, usu_password, usu_correo, usu_direccion, usu_fecha, usu_estado) 
					VALUES ('{$nombres}','{$apellidos}','Paciente','{$usuario}','{$passwd}','{$correo}','{$direccion}','2018-01-01','1')";
		$resultado=mysqli_query($conexion,$consulta);
       
		if($consulta){

		   $consulta="SELECT * FROM usuario  WHERE usu_usuario = '{$usuario}'";
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




