<?php
session_start();
if(isset($_SESSION['credito_usuario'])){
    header("Location: index.php");
    exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Proyecto SE</title>
    <link rel="stylesheet" href="assets/styles/style.css">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="assets/plugin/waves/waves.min.css">

</head>

<body>

<div id="single-wrapper">
    <form action="php/usuario.php" method="post" class="frm-single">
        <div class="inside">
            <div class="title"><strong>Proyecto SE</div>

            <div class="frm-title">Ingresar</div>

            <div class="frm-input"><input name="usuario" type="text" placeholder="Usuario" class="frm-inp"><i class="fa fa-user frm-ico"></i></div>

            <div class="frm-input"><input name="clave" type="password" placeholder="Clave" class="frm-inp"><i class="fa fa-lock frm-ico"></i></div>

            <div class="clearfix margin-bottom-20">

            </div>

            <button type="submit" name="login" class="frm-submit">Ingresar<i class="fa fa-arrow-circle-right"></i></button>

        </div>
    </form>
</div>

<script src="assets/scripts/jquery.min.js"></script>
<script src="assets/scripts/modernizr.min.js"></script>
<script src="assets/plugin/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugin/nprogress/nprogress.js"></script>
<script src="assets/plugin/waves/waves.min.js"></script>

<script src="assets/scripts/main.min.js"></script>
</body>
</html>