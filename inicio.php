<?php
session_start(); 
$_SESSION['locale']  = "matrizss.php";
if(!isset($_SESSION['tp_usr'])){
  echo '
  <script>
      window.location="index.php"
  </script>
  ';
}
include('databases_utilities.php');
mysqli_set_charset( $mysqli, 'utf8');
// Check connection

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Secretaría de Salud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

</head>

<body>

    <?php require_once('header.php'); ?> 

    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="page-title m-0">Resumen</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                            <?php
                                /**Query a base de datos**/
                                $expedientes = null;
                                $proveedores = null;
                                $escaneos = null;
                                $egresos = null;

                                $query="SELECT COUNT(DISTINCT(contrato)) as contratos FROM matriz_control";
                                if( $resultado = mysqli_query($mysqli, $query) or die()){         
                                    $expedientes = mysqli_fetch_assoc($resultado);
                                } 

                                $query="SELECT COUNT(DISTINCT(proveedor)) as proveedores FROM matriz_control";
                                if( $resultado = mysqli_query($mysqli, $query) or die()){         
                                    $proveedores = mysqli_fetch_assoc($resultado);
                                } 

                                $query="SELECT SUM(documentos) as escaneos FROM matriz_control";
                                if( $resultado = mysqli_query($mysqli, $query) or die()){         
                                    $escaneos = mysqli_fetch_assoc($resultado);
                                } 

                                $query="SELECT SUM(val_monto) as egresos FROM matriz_control";
                                if( $resultado = mysqli_query($mysqli, $query) or die()){         
                                    $egresos = mysqli_fetch_assoc($resultado);
                                } 

                            ?>

            <div class="row">
                <div class="col-sm-3 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div>
                                <h2 class="float-left text-primary"><i class="fas fa-folder-open fa-lg"></i></h2>
                                <div class="float-right">
                                    <h2 class="text-primary mb-1"> <?= number_format($expedientes['contratos'], 0, '.', ','); ?></h2>
                                    <p class="text-muted mb-1 mt-2">Expedientes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div>
                                <h2 class="float-left text-danger"><i class="fas fa-id-card fa-lg"></i></h2>
                                <div class="float-right">
                                    <h2 class="text-danger mb-0"> <?= number_format($proveedores['proveedores'], 0, '.', ','); ?></h2>
                                    <p class="text-muted mb-0 mt-2">Proveedores</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div>
                                <h2 class="float-left text-warning"><i class="fas fa-file-import fa-lg"></i></h2>
                                <div class="float-right">
                                    <h2 class="text-warning mb-0">  <?= number_format($escaneos['escaneos'], 0, '.', ','); ?></h2>
                                    <p class="text-muted mb-0 mt-2">Escaneos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div>
                                <h2 class="float-left text-muted"><i class="fas fa-dollar-sign fa-lg"></i></h2>
                                <div class="float-right">
                                    <h2 class="text-muted mb-0">   <?= number_format($egresos['egresos'], 0, '.', ','); ?></h2>
                                    <p class="text-muted mb-0 mt-2">Egresos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-t-0 m-b-30">Principales egresos</h4>

                            <canvas id="bar" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end wrapper -->

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © 2020 - 2021 Dirección de Recursos Materiales, Abastecimientos y Servicios <span class="d-none d-md-inline-block"> </span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!--Morris Chart
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael.min.js"></script>
        -->
        <!-- Chart JS -->
        <script src="assets/plugins/chart.js/chart.min.js"></script>
        <!-- KNOB JS -->
        <script src="assets/plugins/jquery-knob/excanvas.js"></script>
        <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

        <script src="assets/plugins/flot-chart/jquery.flot.min.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.resize.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.pie.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.selection.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.stack.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.crosshair.js"></script>

        <script src="assets/pages/dashboard.js"></script>

        <script src="assets/js/app.js"></script>
        <script>
        /**
            Template Name: Hexzy - Bootstrap 4 Admin Dashboard
            Chartjs
            */


            !function($) {
                "use strict";

                var ChartJs = function() {};

                ChartJs.prototype.respChart = function(selector,type,data, options) {
                    // get selector by context
                    var ctx = selector.get(0).getContext("2d");
                    // pointing parent container to make chart js inherit its width
                    var container = $(selector).parent();

                    // enable resizing matter
                    $(window).resize( generateChart );

                    // this function produce the responsive Chart JS
                    function generateChart(){
                        // make chart width fit with its container
                        var ww = selector.attr('width', $(container).width() );
                        switch(type){

                            case 'Bar':
                                new Chart(ctx, {type: 'bar', data: data, options: options});
                                break;

                        }
                        // Initiate new chart or Redraw

                    };
                    // run function - render chart at first load
                    generateChart();
                },
                //init
                ChartJs.prototype.init = function() {
                    //creating lineChart
                
                    //barchart
                    var barChart = {
                        labels: ["SSCDMX-DGAF-051-2020", "SSCDMX-DGAF-216-2020", "SSCDMX-DGAF-134-2020", "SSCDMX-DGAF-272-B-2020", "SSCDMX-DGAF-132-2020", "SSCDMX-DGAF-273-B-2020", "SSCDMX-DGAF-232-2020"],
                        datasets: [
                            {
                                
                                label: "Costo",
                                locale: 'en-US',
                                backgroundColor: ["#ef5c6a","#df5c6a","#cf5c6a","#bf5c6a","#af5c6a","#9f5c6a","#8f5c6a"],
                                borderColor: "#ef5c6a",
                                borderWidth: 1,
                                hoverBackgroundColor: "#ef9c6a",
                                hoverBorderColor: "#effc6a",
                                data: [348733384.03,  111360000,  97318594,  97078526.40,  95145775.20,  95083712.88,89145609.25, 80000000]
                               
                            }
                        ]
                    };
                    
                    const config = {
                        type: 'bar',
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    };

                    this.respChart($("#bar"),'Bar',barChart, config);

                },
                $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

            }(window.jQuery),

            //initializing
            function($) {
                "use strict";
                $.ChartJs.init()
            }(window.jQuery);

        </script>
</body>

</html>