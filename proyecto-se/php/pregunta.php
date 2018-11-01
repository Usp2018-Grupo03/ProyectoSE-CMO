<?php

include "db.php";

class pregunta extends Database
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

            $rs = mysqli_query($this->con, "SELECT id_pregunta FROM `pregunta` ORDER BY id_pregunta DESC LIMIT 1"); 
            
            while ($row = mysqli_fetch_assoc($rs))
            { 
                $id = $row["id_pregunta"];
            }

            return $id; 
        }
    }

    public function insert_detallepregunta($dpo_puntaje, $id_pregunta, $id_opcion, $countRows)
    {
        $inserciones = 0;
        for($i=0;$i<$countRows ;$i++){
            $sql = "INSERT INTO detallepreopc (dpo_puntaje, id_pregunta, id_opcion) VALUES ('$dpo_puntaje[$i]', '$id_pregunta','$id_opcion[$i]')";
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

$obj = new pregunta;


if(isset($_POST["submit"])){

    date_default_timezone_set("America/Lima");

    $myArray = array(
        "pre_titulo" => $_POST["pre_titulo"],
        "pre_descripcion" => $_POST["pre_descripcion"],
        "pre_imagen" => $_POST["pre_imagen"],
        "pre_puntaje" => $_POST["pre_puntaje"],
        "pre_fecha" => date('Y-m-d'),
        "pre_estado" => 1
    );
    $id_pregunta = $obj -> insert_record("pregunta",$myArray);
    if($id_pregunta > 0){
        
        $dpo_puntaje = $_POST['txt_puntaje'];
        $id_opcion = $_POST['txt_opcion'];
        $countRows = count($_POST['txt_opcion']);

        if($obj -> insert_detallepregunta($dpo_puntaje, $id_pregunta, $id_opcion, $countRows))
        {
            header("location:../registrar_pregunta.php?msg=Registro_exitoso");
        }else{
            echo "error det";
        }
    }
}

if(isset($_GET["delete"])){

    if (!empty($_GET["txt_id"])) $id = $_GET["txt_id"];
    else $name = null;

    $where = array("id_pregunta"=>$id);
    if($obj->delete_record("detallepreopc",$where))
    {
        if($obj->delete_record("pregunta",$where))
        {
            header("location:../registrar_pregunta.php?msg=Eliminacion_exitosa");
        }else{
            echo "error";
        }
    }else{
        echo "error";
    }
}
?>