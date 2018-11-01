<?php

include "db.php";

class enfermedad extends Database
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
        
        if($query)
        {
            $id = ""; 

            $rs = mysqli_query($this->con, "SELECT id_enfermedad FROM `enfermedad` ORDER BY id_enfermedad DESC LIMIT 1"); 
            
            while ($row = mysqli_fetch_assoc($rs))
            { 
                $id = $row["id_enfermedad"];
            }

            return $id; 
        }
    }

    public function insert_detalleenfermedad($des_grado, $des_observacion, $id_enfermedad, $id_sintoma, $countRows)
    {
        $inserciones = 0;
        for($i=0;$i<$countRows ;$i++){
            $sql = "INSERT INTO detalleenfsin (des_grado, des_observacion, id_enfermedad, id_sintoma) VALUES ('$des_grado[$i]', '$des_observacion[$i]', '$id_enfermedad','$id_sintoma[$i]')";
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

$obj = new enfermedad;


if(isset($_POST["submit"])){

    date_default_timezone_set("America/Lima");

    $myArray = array(
        "enf_nombre" => $_POST["enf_nombre"],
        "enf_descripcion" => $_POST["enf_descripcion"],
        "enf_fecha" => date('Y-m-d'),
        "enf_estado" => 1
    );
    $id_enfermedad = $obj -> insert_record("enfermedad",$myArray);
    if($id_enfermedad > 0){
        
        $des_grado = $_POST['txt_grado'];
        $des_observacion = $_POST['txt_observacion'];
        $id_sintoma = $_POST['txt_sintoma'];
        $countRows = count($_POST['txt_sintoma']);

        if($obj -> insert_detalleenfermedad($des_grado, $des_observacion, $id_enfermedad, $id_sintoma, $countRows))
        {
            header("location:../registrar_enfermedad.php?msg=Registro_exitoso");
        }else{
            echo "error";
        }
    }
}

if(isset($_GET["delete"])){

    if (!empty($_GET["txt_id"])) $id = $_GET["txt_id"];
    else $name = null;

    $where = array("id_enfermedad"=>$id);
    if($obj->delete_record("detalleenfsin",$where))
    {
        if($obj->delete_record("enfermedad",$where))
        {
            header("location:../registrar_enfermedad.php?msg=Eliminacion_exitosa");
        }else{
            echo "error";
        }
    }else{
        echo "error";
    }
}
?>