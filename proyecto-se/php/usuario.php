<?php
include "db.php";
session_start();
class usuario extends Database
{
    public function consulta($sql)
    {
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }

    public function update_record($table,$where,$fields){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            // id = '5' AND m_name = 'something'
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        foreach ($fields as $key => $value) {
            //UPDATE table SET m_name = '' , qty = '' WHERE id = '';
            $sql .= $key . "='".$value."', ";
        }
        $sql = substr($sql, 0,-2);
        $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
        if(mysqli_query($this->con,$sql)){
            return true;
        }
    }

    public function login($usuario,$clave){
        $sql = "SELECT * FROM `usuario` WHERE usu_usuario = '".$usuario."' AND usu_password = '".$clave."'";
        $query = mysqli_query($this->con, $sql);
        $filas = mysqli_num_rows($query);
        if ($filas> 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $_SESSION["id_usuario"] = $row["id_usuario"];
                $_SESSION["usu_rol"] = $row["usu_rol"];
                $_SESSION["usu_nombres"] = $row["usu_nombres"];
                $_SESSION["usu_apellidos"] = $row["usu_apellidos"];
            }

        } else {
            echo "0 results";
        }
        return $filas;
    }
}

$obj = new usuario;

if(isset($_POST["login"])){
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    if($obj->login($usuario,$clave)>0)
    {
        $_SESSION['login'] = true;
        header("location:../index.php");
    }else{
        header("location:../login.php?msg=ERROR");
    }
}

if(isset($_POST["editarusuario"])){

    $id = $_POST["id"];
    $where = array("id"=>$id);
    $myArray = array(
        "clave" => $_POST["clave"]
    );
    if($obj->update_record("usuario",$where,$myArray)){
        echo'<script type="text/javascript">
            alert("Actualizacion existosa, saliendo del sistema...");
            </script>';
        header( "refresh:0.2;url=../logout.php" );

    }

}

?>