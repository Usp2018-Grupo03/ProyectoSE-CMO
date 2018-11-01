<?php
include "validar.php";
include "php/plantilla/header.php";
include "php/enfermedad.php";
?>
<div class="row row-inline-block small-spacing">
    <div class="col-xs-12">
        <div class="box-content">
            <h4 class="box-title">Registrar Enfermedad</h4>
            <div class="row">
                <div class="col-sm-10 margin-bottom-20">
                    <ul class="nav nav-tabs nav-justified" id="myTabs-justified" role="tablist">
                        
                        <li role="presentation" class="active"><a href="#home-justified" id="home-tab-justified" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Registrar</a></li>
                        <li role="presentation"><a href="#profile-justified" role="tab" id="profile-tab-justified" data-toggle="tab" aria-controls="profile">Listar</a></li>

                    </ul>
                    <!-- Formulario de Registra - Listar -->
                    <div class="tab-content" id="myTabContent-justified">
                        <div class="tab-pane fade in active" role="tabpanel" id="home-justified" aria-labelledby="home-tab-justified">
                       
                            <!-- Formulario de Registrar -->
                            <form action="php/enfermedad.php" method="post">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input name="enf_nombre" type="text"class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea name="enf_descripcion" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Síntomas</label>
                                            <a data-toggle="modal" data-target=".modal-sintoma" class="btn btn-block btn-danger waves-effect">Seleccionar Síntoma</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-responsive tbl-sintoma">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Grado</th>
                                                    <th>Observación</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-danger">Registrar</button>
                                        <button type="reset" class="btn btn-secondary">Limpiar</button>
                                    </div>
                                </div>

                            </form>

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
                                $myrow = $obj->fetch_record("enfermedad");
                                foreach ($myrow as $row) {
                                    ?>
                                    <tr>
                                        <td><b><?php echo $num; ?></b></td>
                                        <td><b><?php echo $row["enf_nombre"]; ?></b></td>
                                        <td><b><?php echo $row["enf_descripcion"]; ?></b></td>
                                        <td>
                                            <!-- <a href="registrar_enfermedad.php?update=1&txt_id=<?php echo $row["id_enfermedad"]; ?>" class="btn btn-xs btn-info">Editar</a> -->
                                            <a href="php/enfermedad.php?delete=1&txt_id=<?php echo $row["id_enfermedad"]; ?>" class="btn btn-xs btn-danger">Eliminar</a>
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
</div>

<div class="modal fade modal-sintoma" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Buscar</h4> 
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $myrow = $obj->fetch_record("sintoma");
                            foreach ($myrow as $row) {
                                ?>
                                <tr>
                                    <td><b><?php echo $row["id_sintoma"]; ?></b></td>
                                    <td><b><?php echo $row["sin_nombre"]; ?></b></td>
                                    <td><b><?php echo $row["sin_descripcion"]; ?></b></td>
                                    <td>
                                        <button class="btn btn-primary btn-seleccionar-sintoma btn_add_sintoma">Seleccionar</button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php
include "php/plantilla/footer.php";
?>

<script>
    $(".btn_add_sintoma").on("click", function() {
        var id_sintoma = $(this).closest('tr').children()[0].textContent;
        var sin_nombre = $(this).closest('tr').children()[1].textContent;
        var sin_descripcion = $(this).closest('tr').children()[2].textContent;
        if($(".tbl-sintoma .copy_"+id_sintoma).length == 0)
        {
            var newRow = '<tr class="copy_'+id_sintoma+'">'+
            '<td>'+id_sintoma+'<input type="hidden" name="txt_sintoma[]" value="'+id_sintoma+'"></td>'+
            '<td>'+sin_nombre+'<input type="hidden" name="sin_nombre[]" value="'+sin_nombre+'"></td>'+
            '<td>'+sin_descripcion+'<input type="hidden" name="sin_descripcion[]" value="'+sin_descripcion+'"></td>'+
            '<td><input type="text" name="txt_grado[]" ></td>'+
            '<td><input type="text" name="txt_observacion[]" ></td>'+
            '<td><button type="button" class="btn btn-danger btn_remove">Eliminar</button></td>'+
            '</tr>';

            $(".tbl-sintoma").append(newRow);
        }
    });

    $("body").on("click",".btn_remove", function() {
        $(this).parent().parent().remove();
    });
</script>