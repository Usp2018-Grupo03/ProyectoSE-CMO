<?php
include "validar.php";
include "php/plantilla/header.php";
include "php/grafico.php";
?>
        <div class="row row-inline-block small-spacing">
            <div class="col-xs-12">
                <div class="box-content">
                    <h4 class="box-title">Reporte de Diagnosticos</h4>
                    <div class="row">
                        <div class="col-sm-10 margin-bottom-20">
                            <ul class="nav nav-tabs nav-justified" id="myTabs-justified" role="tablist">
                                <li role="presentation" class="active"><a href="#home-justified" id="home-tab-justified" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Diagnosticos</a></li>
                            </ul>
                            <!-- Formulario de Listar -->
                            <div class="tab-content" id="myTabContent-justified">
                                <div class="tab-pane fade in active" role="tabpanel" id="home-justified" aria-labelledby="home-tab-justified">
                                    <!-- Tabla de Listar -->
                                    <table class="table datatable table-striped table-bordered display" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Enfermedad</th>
                                            <th>Porcentaje</th>
                                            <th>Fecha</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $num = 1;
                                        $myrow = $obj->consulta("SELECT * FROM diagnosticofinal");
                                        foreach ($myrow as $row) {
                                            ?>
                                            <tr>
                                                <td><b><?php echo $num; ?></b></td>
                                                <td><b><?php echo $row["dif_nombre"]; ?></b></td>
                                                <td><b><?php echo $row["dif_enfermedad"]; ?></b></td>
                                                <td><b><?php echo $row["dif_porcentaje"]; ?> %</b></td>
                                                <td><b><?php echo $row["dif_fecha"]; ?></b></td>
                                            </tr>
                                            <?php
                                            $num += 1;
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
    </div><!-- /.main-content -->
</div><!--/#wrapper -->

<?php
include "php/plantilla/footer.php";
?>