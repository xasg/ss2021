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
        <title>Hexzy - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

            <!-- DataTables -->
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">


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
                                                <h4 class="page-title m-0">Expedientes</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                /**Query a base de datos**/
                                $query="SELECT * FROM matriz_control ORDER BY contrato ASC";
                                if( $resultado = mysqli_query($mysqli, $query) or die()){         
                                    
                                    $totalRows_reporte = mysqli_num_rows($resultado);
                                } 
                               
                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="m-b-30 m-t-0">Contratos cargados: <?= $totalRows_reporte; ?></h4>
                                            <div class="row">
                                                <div class="col-lg-12 col-sm-12 col-12">
                                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; width: 100%;">
                                                        <thead>
                                                        <tr>
                                                            <th>Contrato</th>
                                                            <th>Proveedor</th>
                                                            <th>Documentos</th>
                                                            <th>Monto</th>
                                                            <th>Requisición</th>
                                                            <th>Estatus</th>
                                                            <th>Detalle</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            while ($row_reporte = mysqli_fetch_assoc($resultado)){
                                                        ?>
                                                        <tr >
                                                            <td ><b><?=$row_reporte['contrato']?></b></td>
                                                            <td class="text-left"><?php echo $row_reporte['proveedor']; ?></td>
                                                            <td class="text-center"><?php echo $row_reporte['documentos']; ?></td>
                                                            <td class="text-right">$<?php echo number_format($row_reporte['val_monto'], 2, '.', ','); ?></td>
                                                            <td class="requi"><?php echo $row_reporte['requisicion']; ?></td>
                                                            <td class="text-center"><?php echo $row_reporte['estatus']; ?></td>
                                                            <td class="text-right"><a href="detalle.php?id_exp=<?=$row_reporte['id_expediente']?>" target="_blank">Ver</a></td>
                                                        </tr>
                                                        
                                                        <?php 
                                                            }
                                                        ?>
                                                        </tbody>
                                                    </table>
                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                            </div> <!-- End Row -->
    


                        </div> <!-- end container-fluid -->
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

<!-- Required datatable js-->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>


<!-- Responsive examples -->
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>

<!-- Datatable init js -->
<script src="assets/pages/datatables.init.js"></script>


<script src="assets/js/app.js"></script>
    </body>
</html>