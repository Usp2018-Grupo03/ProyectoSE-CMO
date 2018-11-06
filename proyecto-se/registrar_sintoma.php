<?php
include "validar.php";
include "php/plantilla/header.php";
include "php/sintoma.php";
?>
<div class="row row-inline-block small-spacing">

    <div class="col-xs-12">
        <div class="box-content">
            <h4 class="box-title">Registrar Síntoma</h4>
            <div class="row">
                <div class="col-sm-10 margin-bottom-20">
                    <ul class="nav nav-tabs nav-justified" id="myTabs-justified" role="tablist">
                        
                        <li role="presentation" class="active"><a href="#home-justified" id="home-tab-justified" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Registrar</a></li>
                        <li role="presentation"><a href="#profile-justified" role="tab" id="profile-tab-justified" data-toggle="tab" aria-controls="profile">Listar</a></li>

                    </ul>
                    <!-- Formulario de Registra - Actualizar - Listar -->
                    <div class="tab-content" id="myTabContent-justified">
                        <div class="tab-pane fade in active" role="tabpanel" id="home-justified" aria-labelledby="home-tab-justified">
                       
                        <?php
                            if(isset($_GET["update"])){
                                
                                if (!empty($_GET["txt_id"])) $id = $_GET["txt_id"];
                                else $id = null;
                                $where = array("id_sintoma"=>$id,);
                                $row = $obj->select_record("sintoma",$where);
                        ?>
                            <!-- Formulario de Actualizar -->
                            <form action="php/sintoma.php" method="post">

                                <input type="hidden" name="txt_id" value="<?php echo $id; ?>">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input name="sin_nombre" type="text" class="form-control" value="<?php echo $row["sin_nombre"]; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea name="sin_descripcion" class="form-control" required><?php echo $row["sin_descripcion"]; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="edit" class="btn btn-primary">Actualizar</button>
                                        <button type="reset" class="btn btn-secondary">Limpiar</button>
                                    </div>
                                </div>

                            </form>

                        <?php
                            }else{
                        ?>
                            <!-- Formulario de Registrar -->
                            <form action="php/sintoma.php" method="post">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input name="sin_nombre" type="text"class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea name="sin_descripcion" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-danger">Registrar</button>
                                        <button type="reset" class="btn btn-secondary">Limpiar</button>
                                    </div>
                                </div>

                            </form>

                        <?php
                            }
                        ?>

                        </div>

                        <!-- Tabla de Listar -->
                        <div class="tab-pane fade" role="tabpanel" id="profile-justified" aria-labelledby="profile-tab-justified">
                            
                            <table class="table datatable table-striped table-bordered display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $num = 1;
                                $myrow = $obj->fetch_record("sintoma");
                                foreach ($myrow as $row) {
                                    ?>
                                    <tr>
                                        <td><b><?php echo $num; ?></b></td>
                                        <td><b><?php echo $row["sin_nombre"]; ?></b></td>
                                        <td><b><?php echo $row["sin_descripcion"]; ?></b></td>
                                        <td>
                                            <a href="registrar_sintoma.php?update=1&txt_id=<?php echo $row["id_sintoma"]; ?>" class="btn btn-xs btn-info">Editar</a>
                                            <a href="php/sintoma.php?delete=1&txt_id=<?php echo $row["id_sintoma"]; ?>" class="btn btn-xs btn-danger">Eliminar</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $num = $num + 1;
                                }
                                ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</div>

</div>
<!-- /.main-content -->
</div><!--/#wrapper -->

<?php
include "php/plantilla/footer.php";
?>