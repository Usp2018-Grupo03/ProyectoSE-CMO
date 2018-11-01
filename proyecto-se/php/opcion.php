<?php

include "db.php";

class opcion extends Database
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

    public function insert_record($table,$fileds){
        //"INSERT INTO table_name (, , ) VALUES ('m_name','qty')";
        $sql = "";
        $sql .= "INSERT INTO ".$table;
        $sql .= " (".implode(",", array_keys($fileds)).") VALUES ";
        $sql .= "('".implode("','", array_values($fileds))."')";
        $query = mysqli_query($this->con,$sql);
        if($query){
            return true;
        }

    }
    public function fetch_record($table){
        $sql = "SELECT * FROM ".$table;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }
    public function select_record($table,$where){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            // id = '5' AND m_name = 'something'
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $sql .= "SELECT * FROM ".$table." WHERE ".$condition;
        $query = mysqli_query($this->con,$sql);
        $row = mysqli_fetch_array($query);
        return $row;

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
    public function delete_record($table,$where){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $sql = "DELETE FROM ".$table." WHERE ".$condition;
        if(mysqli_query($this->con,$sql)){
            return true;
        }
    }
}

$obj = new opcion;


if(isset($_POST["submit"])){

    date_default_timezone_set("America/Lima");
    $fecha_registro = date('Y-m-d');

    $estado = 1;

    $myArray = array(
        "opc_titulo" => $_POST["opc_titulo"],
        "opc_descripcion" => $_POST["opc_descripcion"],
        "opc_estado" => $estado,
        "opc_fecha" => $fecha_registro
    );
    if($obj->insert_record("opcion",$myArray)){
        header("location:../registrar_opcion.php?msg=Registro_exitoso");
    }else{
        echo "error";
    }

}

if(isset($_POST["edit"])){
    $id = $_POST["txt_id"];
    $where = array("id_opcion"=>$id);
    $myArray = array(
        "opc_titulo" => $_POST["opc_titulo"],
        "opc_descripcion" => $_POST["opc_descripcion"]
    );
    if($obj->update_record("opcion",$where,$myArray)){
        header("location:../registrar_opcion.php?msg=Actualizacion_exitosa");
    }

}

if(isset($_GET["delete"])){

    if (!empty($_GET["txt_id"])) $id = $_GET["txt_id"];
    else $name = null;

    $where = array("id_opcion"=>$id);
    if($obj->delete_record("opcion",$where)){
        header("location:../registrar_opcion.php?msg=Eliminacion_exitosa");
    }
}
?>