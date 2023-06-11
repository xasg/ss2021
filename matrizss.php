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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="SS">
        <meta name="author" content="XASG">

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <title>Capturista Promtel</title>


        <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>

        <style type='text/css'>
table {<!--from  w  w w.j a v a 2  s  .  c o m-->
  width: 100%;
}

td {
  border: 1px solid black;
}

td.leftcell {
  width: 20px;
  white-space: nowrap;
}
</style>
    </head>


    <body>

        <!-- Navigation Bar-->
        <header id="topnav">

                        <!--INCUDE nav.php -->
            <?php require_once('nav.php'); ?> 
            

        </header>
        <!-- End Navigation Bar-->

        <?php
                    /**Query a base de datos**/
                    $query="SELECT * FROM matriz_control ORDER BY contrato ASC";
                    if( $resultado = mysqli_query($mysqli, $query) or die()){         
                        
                        $totalRows_reporte = mysqli_num_rows($resultado);
                      } 
                    $query = "SELECT DISTINCT(proveedor) AS Proveedor, COUNT(*) AS Contratos FROM `matriz_control` GROUP BY proveedor ASC "
                ?>
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Contratos cargados: <?= $totalRows_reporte; ?>  </h4>
                    </div>
                </div>

                

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <!--<a href="crear.php?tp_adjudicacion=42">
                                            <i class="fa fa-plus"></i> Nuevo expediente
                            </a>-->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr >
                                        <th class="col-xs-2">Contrato</th>
                                        <th  class="text-center col-xs-1">Requisición</th>
                                        <th  class="text-center col-xs-4">Proveedor</th>
                                        <th  class="text-center col-xs-1">Documentos</th>
                                       <!-- <th  class="text-center col-xs-1">Faltantes</th>-->
                                        <th  class="text-center col-xs-1">%</th>
                                        <th  class="text-center col-xs-1">Consultar</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        while ($row_reporte = mysqli_fetch_assoc($resultado)){
                                    ?>
                                    <tr style="font-size: 12px;">
                                        <td ><b><?=$row_reporte['contrato']?></b></td>
                                        <td class="text-left"><?php echo $row_reporte['requisicion']; ?></td>
                                        <td class="text-left"><?php echo $row_reporte['proveedor']; ?></td>
                                        <td class="text-center"><?php echo $row_reporte['documentos']; ?></td>
                                      <!--  <td class="text-center"><?php echo $row_reporte['faltantes']; ?></td>-->
                                        <!--<td class="text-center"><?php echo number_format((($row_reporte['documentos']/($row_reporte['documentos']+$row_reporte['faltantes']))*100), 2, '.', ''); ?></td>-->
                                        <td class="text-center">100.00</td>
                                        <td class="text-center"><a href="indexcss.php?id_exp=<?=$row_reporte['id_expediente']?>" target="_blank">Ver</a></td>
                                    </tr>
                                       
                                        <?php 
                                        }
                                    ?>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- end col -->
                   
                    

                </div>
                <!--
                <div class="row">
                      <div class="col-lg-12 col-md-12">
                        <div class="card-box widget-user">
                            <div>
                                <img src="assets/images/users/avatar-3.jpg" class="img-responsive img-circle"
                                     alt="user">
                                <div class="wid-u-info">
                                    <h4 class="m-t-0 m-b-5 font-600">Documentos provatorios</h4>
                                    <ol>
                                        <li>04: Anexo técnico del bien y/o servicio.</li>
                                        <li>05: Formato de Constancia de existencias de bienes de almacén FO-CON-02.</li>
                                        <li>06: Formato de requisición de bienes o servicios FO-CON-03.</li>
                                        <li>07: Oficio de Justificación.</li>
                                        <li>07C: Cotizaciones</li>
                                        <li>10: Dictamen de excepción</li>
                                        <li>14: Validación Presupuestal.</li>
                                        <li>24: Notificación de adjudicación del contrato</li>
                                        <li>34: Anexos rubricados.</li>
                                        <li>50: Formato de Autorización de pago a proveedores de bienes y servicios</li>
                                        <li>51: CLC</li>
                                        <li>52: Factura</li>
                                    </ol>
                                    <h4 class="m-t-0 m-b-5 font-600">Proveedor</h4>
                                    <ul>
                                        <li>28: Acta de nacimiento.</li>
                                        <li>29: RFC del proveedor.</li>
                                        <li>30: Comprobante de domicilio.</li>
                                        <li>31: Anexo del 32-D.</li>
                                        <li>33: Contrato firmado y rubricado.</li>
                                    </ul>
                                    <h4 class="m-t-0 m-b-5 font-600">Garantía</h4>
                                    <ul>
                                        <li>35: Garantía de cumplimiento.</li>
                                        <li>36: Garantía de anticipo.</li>
                                        <li>37: Garantiía contra defectos y/o vicios ocultos.</li>
                                        <li>38: Garantía de Responsabilidad Civil.</li>
                                        <li>46: Solicitud del proveedor de cancelación de garantía.</li>
                                        <li>47: Oficio de solicitud al administrador del contrato para cancelar garantía.</li>
                                        <li>48: Contestación del administrador del contrato para cancelar garantía.</li>
                                        <li>49: Oficiio dirigido a la aseguradora o proveedor cancelando garantía.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                    <!-- end col -->
                 </div>


                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                2021 V0.8.
                            </div>
                            <div class="col-xs-6">
                                <ul class="pull-right list-inline m-b-0">
                                    <li>
                                        <a href="#"></a>
                                    </li>
                                    <li>
                                        <a href="#"></a>
                                    </li>
                                    <li>
                                        <a href="#"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div>
            <!-- end container -->



            <!-- Right Sidebar -->
            <div class="side-bar right-bar">
                <a href="javascript:void(0);" class="right-bar-toggle">
                    <i class="zmdi zmdi-close-circle-o"></i>
                </a>
                <h4 class="">Notifications</h4>
                <div class="notification-list nicescroll">
                    <ul class="list-group list-no-border user-list">
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-2.jpg" alt="">
                                </div>
                                <div class="user-desc">
                                    <span class="name">Michael Zenaty</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">2 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-info">
                                    <i class="zmdi zmdi-account"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">New Signup</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">5 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-pink">
                                    <i class="zmdi zmdi-comment"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">New Message received</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">1 day ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item active">
                            <a href="#" class="user-list-item">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-3.jpg" alt="">
                                </div>
                                <div class="user-desc">
                                    <span class="name">James Anderson</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">2 days ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item active">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-warning">
                                    <i class="zmdi zmdi-settings"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">Settings</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">1 day ago</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /Right-bar -->

        </div>


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>

        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="assets/plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

        <!--Morris Chart-->
		<script src="assets/plugins/morris/morris.min.js"></script>
		<script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Dashboard init -->
        <script src="assets/pages/jquery.dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>