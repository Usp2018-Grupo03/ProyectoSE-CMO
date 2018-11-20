<?php
include "validar.php";
include "php/plantilla/header.php";
include "php/evaluacion.php";
?>
<div class="row row-inline-block small-spacing">
    <div class="col-xs-12">
        <div class="box-content">
            <h4 class="box-title">Registrar Evaluación</h4>
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
                            <form action="php/evaluacion.php" method="post">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Síntoma</label>
                                            <button type="button" class="btn btn-block btn-danger waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-1"> Seleccionar Síntoma </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="hidden" id="id_sintoma" name="id_sintoma">
                                            <input id="sin_nombre" type="text" readonly class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Preguntas</label>
                                            <a data-toggle="modal" data-target=".modal-opcion" class="btn btn-block btn-danger waves-effect">Seleccionar Preguntas</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-responsive tbl-opcion">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Descripción</th>
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
                                    <th>Nomnre</th>
                                    <th>Descripción</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $num = 1;
                                $myrow = $obj->fetch_record("detallesinpre 
                                                            INNER JOIN sintoma on detallesinpre.id_sintoma=sintoma.id_sintoma");
                                foreach ($myrow as $row) {
                                    ?>
                                    <tr>
                                        <td><b><?php echo $num; ?></b></td>
                                        <td><b><?php echo $row["sin_nombre"]; ?></b></td>
                                        <td><b><?php echo $row["sin_descripcion"]; ?></b></td>
                                        <td>
                                            <a href="php/evaluacion.php?delete=1&txt_id=<?php echo $row["id_detallesinpre"]; ?>" class="btn btn-xs btn-danger">Eliminar</a>
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

<div class="modal fade" id="boostrapModal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel-1">Buscar</h4>
            </div>
            <div class="modal-body" style="overflow: auto; overflow-y: hidden;">
                <table class="table datatable table-striped table-bordered display" style="width:100%">
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
                    $myrow = $obj->consulta("SELECT * FROM sintoma");
                    foreach ($myrow as $row) {
                        ?>
                        <tr>
                            <td><b><?php echo $row["id_sintoma"]; ?></b></td>
                            <td><b><?php echo $row["sin_nombre"]; ?></b></td>
                            <td><b><?php echo $row["sin_descripcion"]; ?></b></td>
                            <td>
                                <button class="btn btn-info btn-xs btn-seleccionar1">Seleccionar</button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-opcion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
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
                            $myrow = $obj->fetch_record("pregunta");
                            foreach ($myrow as $row) {
                                ?>
                                <tr>
                                    <td><b><?php echo $row["id_pregunta"]; ?></b></td>
                                    <td><b><?php echo $row["pre_titulo"]; ?></b></td>
                                    <td><b><?php echo $row["pre_descripcion"]; ?></b></td>
                                    <td>
                                        <button class="btn btn-primary btn-seleccionar-opcion btn_add_opcion">Seleccionar</button>
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
    $(".btn_add_opcion").on("click", function() {
        var id_opcion = $(this).closest('tr').children()[0].textContent;
        var opc_titulo = $(this).closest('tr').children()[1].textContent;
        var opc_descripcion = $(this).closest('tr').children()[2].textContent;
        if($(".tbl-opcion .copy_"+id_opcion).length == 0)
        {
            var newRow = '<tr class="copy_'+id_opcion+'">'+
            '<td>'+id_opcion+'<input type="hidden" name="id_pregunta[]" value="'+id_opcion+'"></td>'+
            '<td>'+opc_titulo+'<input type="hidden" name="opc_titulo[]" value="'+opc_titulo+'"></td>'+
            '<td>'+opc_descripcion+'<input type="hidden" name="opc_descripcion[]" value="'+opc_descripcion+'"></td>'+
            '<td><button type="button" class="btn btn-danger btn_remove">Eliminar</button></td>'+
            '</tr>';

            $(".tbl-opcion").append(newRow);
        }
    });

    $("body").on("click",".btn_remove", function() {
        $(this).parent().parent().remove();
    });

    $(".btn-seleccionar1").on("click", function() {
        var id_sintoma = $(this).closest('tr').children()[0].textContent;
        var sin_nombre = $(this).closest('tr').children()[1].textContent;

        $("#id_sintoma").val(id_sintoma);
        $("#sin_nombre").val(sin_nombre);
    });

    function ventanaSecundaria (URL, ventana){

        window.open(URL,ventana,"width=900,height=500,s crollbars=NO")
    }
</script>