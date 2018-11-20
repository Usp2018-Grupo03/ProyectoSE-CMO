<?php

include "db.php";

class evaluacion extends Database
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

    public function insert_detallesinpre($id_sintoma, $id_pregunta, $countRows)
    {
        $inserciones = 0;
        for($i=0;$i<$countRows ;$i++){
            $sql = "INSERT INTO detallesinpre (id_sintoma, id_pregunta) VALUES ('$id_sintoma', '$id_pregunta[$i]')";
            $query = mysqli_query($this->con,$sql);
            if($query)
            {
                $inserciones++;
            }
        }
        if($inserciones == $countRows)
        {
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

$obj = new evaluacion;


if(isset($_POST["submit"])){

    $id_sintoma = $_POST['id_sintoma'];
    $id_pregunta = $_POST['id_pregunta'];
    $countRows = count($_POST['id_pregunta']);

    if($obj -> insert_detallesinpre($id_sintoma, $id_pregunta, $countRows))
    {
        header("location:../registrar_evaluacion.php?msg=Registro_exitoso");
    }else{
        echo "error det";
    }
}

if(isset($_GET["delete"])){

    if (!empty($_GET["txt_id"])) $id = $_GET["txt_id"];

    $where = array("id_detallesinpre"=>$id);
    if($obj->delete_record("detallesinpre",$where))
    {
        header("location:../registrar_evaluacion.php?msg=Eliminacion_exitosa");
    }else{
        echo "error";
    }
}
?>