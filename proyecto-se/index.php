<?php
include "validar.php";
include "php/plantilla/header.php";
include "php/grafico.php";
?>

    <div class="row small-spacing">
        <div class="col-lg-6 col-xs-12">
            <div class="box-content card white">
                <h4 class="box-title">Gráfico Estadístico</h4>
                <div class="card-content">

                    <canvas id="myChart" width="300" height="300"></canvas>

                </div>
            </div>
        </div>
    </div>
<?php
include "php/plantilla/footer.php";
?>

<script>

    var randomScalingFactor = function() {
        return Math.round(Math.random() * 255);
    };

    var ctx = document.getElementById("myChart").getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                
                <?php 

                    $myrow = $obj->fetch_record("enfermedad");
                    foreach ($myrow as $row) {

                        ?>'<?php echo $row["enf_nombre"]; ?>',<?php
                    }
                ?>
            ],
            datasets: [{
                label: '# of Votes',
                data: [
                    
                    <?php 

                        $myrow2 = $obj->consulta("SELECT * FROM enfermedad");
                        foreach ($myrow2 as $row2) {
                            
                            
                            $cant = 0;
                            $sql = "select * from diagnosticofinal";
                            $myrow3 = $obj->consulta($sql);
                            foreach ($myrow3 as $row3) {
                                
                                if($row3["dif_enfermedad"]==$row2["enf_nombre"]){

                                    $cant += 1;                                       
                                }
                            }
                            ?>'<?php echo $cant; ?>',<?php
                        }
                    ?>

                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>