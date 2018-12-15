<?php

class Database
{
    public $con;
    public function __construct(){

        $this->con = mysqli_connect("localhost","root","","proyectose");
        mysqli_set_charset($this->con, "utf8");

    }
}
?>