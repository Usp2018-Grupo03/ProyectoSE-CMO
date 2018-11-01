<?php
include "validar.php";
include "php/plantilla/header.php";
?>

    <div class="row small-spacing">
        <div class="col-lg-6 col-xs-12">
            <div class="box-content card white">
                <h4 class="box-title">Gráficos Estadísticos</h4>
                <div class="card-content">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="img/img1.jpg">
                            </div>
                            <div class="item">
                                <img src="img/img2.jpg">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col-lg-6 col-xs-12 -->
        <!--<div class="col-lg-6 col-xs-12">
            <div class="box-content card white">
                <h4 class="box-title">Presentación</h4>
                <div class="card-content">
                    <form action="php/usuario.php" method="post">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Usuario</label>
                                    <input type="hidden" name="id" value="<?php /*echo $_SESSION["credito_id"];*/?>" readonly>
                                    <input type="text" value="<?php /*echo $_SESSION["credito_usuario"];*/?>" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Contraseña</label>
                                    <input type="text" name="clave" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button type="submit" name="editarusuario" class="btn btn-danger">Editar</button>
                                    <button type="reset" class="btn btn-secondary">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>-->
    </div>
    <!-- /.row -->
    <!-- /.row small-spacing -->
<?php
include "php/plantilla/footer.php";
?>