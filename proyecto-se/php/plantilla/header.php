<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>CMO</title>

    <!-- <link rel="icon" href="assets/images/logo.png"> -->
	<!-- Main Styles -->
	<link rel="stylesheet" href="assets/styles/style.min.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="assets/plugin/waves/waves.min.css">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="assets/plugin/sweet-alert/sweetalert.css">

	<!-- Remodal -->
	<link rel="stylesheet" href="assets/plugin/modal/remodal/remodal.css">
	<link rel="stylesheet" href="assets/plugin/modal/remodal/remodal-default-theme.css">

	<!-- Data Tables -->
	<link rel="stylesheet" href="assets/plugin/datatables/media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css">
	
    <!-- Select2 -->
	<link rel="stylesheet" href="assets/plugin/select2/css/select2.min.css">

	<!-- Datepicker -->
	<link rel="stylesheet" href="assets/plugin/datepicker/css/bootstrap-datepicker.min.css">

	<!-- Color Picker -->
	<link rel="stylesheet" href="assets/color-switcher/color-switcher.min.css">
		
    <!-- CAMBIAR COLOR -->
	<link id="custom-color-themes" rel="stylesheet" href="assets/styles/color/red.min.css">
    <style>
        input {
            text-transform: uppercase;
        }
        ::-webkit-input-placeholder { /* WebKit browsers */
            text-transform: none;
        }
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
            text-transform: none;
        }
        ::-moz-placeholder { /* Mozilla Firefox 19+ */
            text-transform: none;
        }
        :-ms-input-placeholder { /* Internet Explorer 10+ */
            text-transform: none;
        }
    </style>
</head>

<body>
<div class="main-menu">
	<header class="header">
		<a href="index.php" class="logo">Sistema Experto</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		<div class="user">
			<a href="#" class="avatar"><img src="https://maxcdn.icons8.com/Share/icon/Users//circled_user_male1600.png" alt=""><span class="status online"></span></a>
			<h5 class="name">Administrador</h5>

			<div class="control-wrap js__drop_down">
				<i class="fa fa-caret-down js__drop_down_button"></i>
				<div class="control-list">
					<div class="control-item"><a href="logout.php"><i class="fa fa-sign-out"></i> Salir</a></div>
				</div>
			</div>
		</div>
	</header>
	<div class="content">

		<div class="navigation">
			<ul class="menu js__accordion">
				<li>
					<a class="waves-effect" href="index.php"><i class="menu-icon fa fa-home"></i><span>Gráficos Estadísticos</span></a>
				</li>
				
			</ul>
			<ul class="menu js__accordion">
				<li class="">
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-plus-square"></i><span>Operaciones</span></a>
					<ul class="sub-menu js__content">
						
						<li><a href="registrar_sintoma.php">Registrar Síntoma</a></li>
						<li><a href="registrar_enfermedad.php">Registrar Enfermedad</a></li>
                        <li><a href="registrar_opcion.php">Registrar Opcion</a></li>
						<li><a href="registrar_pregunta.php">Registrar Pregunta</a></li>
						<li><a href="registrar_evaluacion.php">Registrar Evaluación</a></li>


					</ul>
				</li>
                <li class="">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-bar-chart"></i><span>Reportes</span></a>
                    <ul class="sub-menu js__content">
                        
						<li><a href="reporte_diagnostico.php">Diagnosticos</a></li>

                    </ul>
                </li>
			</ul>
		</div>
	</div>
</div>

<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
	</div>
</div>

<div id="wrapper">
	<div class="main-content">