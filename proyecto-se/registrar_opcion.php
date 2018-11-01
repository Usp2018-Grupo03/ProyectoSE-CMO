<?php
include "validar.php";
include "php/plantilla/header.php";
include "php/opcion.php";
?>
<div class="row row-inline-block small-spacing">

    <div class="col-xs-12">
        <div class="box-content">
            <h4 class="box-title">Registrar Opción</h4>
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
                                $where = array("id_opcion"=>$id,);
                                $row = $obj->select_record("opcion",$where);
                        ?>
                            <!-- Formulario de Actualizar -->
                            <form action="php/opcion.php" method="post">

                                <input type="hidden" name="txt_id" value="<?php echo $id; ?>">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input name="opc_titulo" type="text" class="form-control" value="<?php echo $row["opc_titulo"]; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea name="opc_descripcion" class="form-control" required><?php echo $row["opc_descripcion"]; ?></textarea>
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
                            <form action="php/opcion.php" method="post">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input name="opc_titulo" type="text"class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea name="opc_descripcion" class="form-control"></textarea>
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
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $num = 1;
                                $myrow = $obj->fetch_record("opcion");
                                foreach ($myrow as $row) {
                                    ?>
                                    <tr>
                                        <td><b><?php echo $num; ?></b></td>
                                        <td><b><?php echo $row["opc_titulo"]; ?></b></td>
                                        <td><b><?php echo $row["opc_descripcion"]; ?></b></td>
                                        <td>
                                            <a href="registrar_opcion.php?update=1&txt_id=<?php echo $row["id_opcion"]; ?>" class="btn btn-xs btn-info">Editar</a>
                                            <a href="php/opcion.php?delete=1&txt_id=<?php echo $row["id_opcion"]; ?>" class="btn btn-xs btn-danger">Eliminar</a>
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