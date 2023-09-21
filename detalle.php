<?php
###session_start(); 
session_start(); 
// $_SESSION['locale']  = "expedientes.php";
// if(!isset($_SESSION['tp_usr'])){
//   echo '
//   <script>
//       window.location="index.php"
//   </script>
//   ';
// }
include('databases_utilities.php');
mysqli_set_charset( $mysqli, 'utf8');
// Check connection

if(isset($_GET["id_exp"])){
    $expediente = $_GET["id_exp"];
}else{
    $expediente = 0;
}


$query="SELECT * FROM adirecta WHERE id_expediente=$expediente";
if( $resultado = mysqli_query($mysqli, $query) or die()){         
    $row_reporte = mysqli_fetch_assoc($resultado);
    $totalRows_reporte = mysqli_num_rows($resultado);
  } 

  $directorio_a_comprimir = "docs/".$row_reporte['year']."/".$row_reporte['contrato']
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Detalle <?= $row_reporte['contrato']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                                <h4 class="page-title m-0">Detalle</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <!-- <div class="panel-heading">
                            <h4>Invoice</h4>
                        </div> -->
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h3 class="m-t-0"><?= $row_reporte['contrato']; ?></h3>
                                        <div class="hidden-print">
                                                <div class="">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                    <a href="javascript:window.close()" class="btn btn-primary waves-effect waves-light">Cerrar</a>
                                                    <h4><a href="<?=$row_reporte['cedula']?>" target="_blank">Cédula</a></h4>
                                                </div>
                                            </div>
                                    </div>
                                             
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                             <h4>
                                                <strong>Proveedor</strong><br>
                                                <?= $row_reporte['proveedor']; ?>
                                            </h4>
                                        </div>
                                        <div class="col-6 text-right">
                                            <h4>
                                                <strong>Monto</strong><br>
                                                $<?= number_format($row_reporte['val_monto'], 2, '.', ','); ?>
                                                
                                            </h4>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <h4>
                                                <strong>Requsición:</strong><br>
                                                <?= $row_reporte['requisicion']; ?>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <strong>Servicio:</strong><br>
                                                <?= $row_reporte['tp_servicio']; ?>
                                            </h4>
                                        </div>
                                        

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title text-dark m-0"><strong>Documentos</strong></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <td><strong>Documentos</strong></td>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                        <?php $avance=0; ?>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['1.1']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['1.1']!=0||!empty($row_reporte['1.1'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 1.1 REQUISICIÓN
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['1.2']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['1.2']!=0||!empty($row_reporte['1.2'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 1.2	ANEXO TÉCNICO
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['2.1']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['2.1']!=0||!empty($row_reporte['2.1'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 2.1	OFICIOS DE INVITACIÓN
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['2.2']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['2.2']!=0||!empty($row_reporte['2.2'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 2.2	COTIZACIONES
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['2.3']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['2.3']!=0||!empty($row_reporte['2.3'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 2.3	SONDEO DE  MERCADO
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['3.1']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['3.1']!=0||!empty($row_reporte['3.1'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 3.1	OFICIO DE SOLICITUD DE SUFICIENCIA PRESUPUESTAL

                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['3.2']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['3.2']!=0||!empty($row_reporte['3.2'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 3.2	SUFICIENCIA PRESUPUESTAL
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['4']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['4']!=0||!empty($row_reporte['4'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 4 SUBCOMITÉ
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['5.1']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['5.1']!=0||!empty($row_reporte['5.1'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 5.1	COMPROBACIÓN DE PROVEEDORES SANCIONADOS Y/O INHABILITACIÓN (LOCAL Y FEDERAL)
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['5.2']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['5.2']!=0||!empty($row_reporte['5.2'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 5.2	MANIFESTACIÓN DE NO CONFLICTO DE INTERESES
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['5.3']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['5.3']!=0||!empty($row_reporte['5.3'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 5.3	OFICIO DE ADJUDICACAIÓN
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.1']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.1']!=0||!empty($row_reporte['6.1'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 6.1	COPIA DEL ACTA CONSTITUTIVA DE LA EMPRESA PARTICIPANTE O ACTA DE NACIMIENTO PARA PERSONA FÍSICA 
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.2']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.2']!=0||!empty($row_reporte['6.2'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?> 6.2	COPIA DEL PODER NOTARIAL PARA ACTOS DE ADMINISTRACIÓN O PODER ESPECIAL EN EL QUE SE INDIQUE EXPRESAMENTE QUE PUEDE FIRMAR CONTRATOS
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.3']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.3']!=0||!empty($row_reporte['6.3'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.3	COPIA DE IDENTIFICACIÓN OFICIAL (DE LA PERSONA QUE FIRMA EL CONTRATO)
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.4']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.4']!=0||!empty($row_reporte['6.4'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.4	COPIA DE RFC Y/O CURP (AMBOS EN EL CASO DE PERSONAS FÍSICAS.) 
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.5']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.5']!=0||!empty($row_reporte['6.5'])){ ?><a href=""><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.5	COPIA DE COMPROBANTE DE DOMICILIO FISCAL. 
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.6']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.6']!=0||!empty($row_reporte['6.6'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.6	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD, EN EL QUE INDIQUE QUE LAS FACULTADES COMO APODERADO O REPRESENTANTE LEGAL NO HA SIDO MODIFICADO, LIMITADO O REVOCADO EL PODER NOTARIAL.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.7']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.7']!=0||!empty($row_reporte['6.7'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.7	MANIFIESTO, BAJO PROTESTA DE DECIR VERDAD, QUE CUENTA CON LOS RECURSOS HUMANOS, TÉCNICOS, FINANCIEROS Y DEMÁS REQUISITOS QUE SE ESTABLECEN EN LA PRESENTE SOLICITUD DE COTIZACIÓN, ASÍ COMO LA CAPACIDAD DE RESPUESTA, PARA ATENDER LOS COMPROMISOS QUE SE DERIVEN DE DICHO OFICIO.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.8']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.8']!=0||!empty($row_reporte['6.8'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.8	MANIFIESTO, MEDIANTE LA CUAL SE RESPONSABILIZA DE LA CALIDAD DE LOS BIENES Y DE QUE CUMPLE TOTALMENTE CON LAS CARACTERÍSTICAS TÉCNICAS SOLICITADAS.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.9']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.9']!=0||!empty($row_reporte['6.9'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.9	MANIFIESTO, BAJO PROTESTA DE DECIR VERDAD, QUE NO SE ENCUENTRA EN NINGUNO DE LOS SUPUESTOS DE IMPEDIMENTO QUE ESTABLECE EL ARTÍCULO 39 DE LA “LEY DE ADQUISICIONES PARA EL DISTRITO FEDERAL”, ASÍ COMO TAMPOCO EN LO CONTEMPLADO POR EL ARTÍCULO 67 DE LA “LEY DE RESPONSABILIDADES ADMINISTRATIVAS DE LA CIUDAD DE MÉXICO”. ASIMISMO, NO SE ENCUENTRA EN LOS SUPUESTOS DE IMPEDIMENTOS LEGALES, INHABILITADA O SANCIONADA POR LA CONTRALORÍA GENERAL DE LA CIUDAD DE MÉXICO, POR LA SECRETARÍA DE LA FUNCIÓN PÚBLICA DE LA ADMINISTRACIÓN PÚBLICA FEDERAL, NI POR LAS AUTORIDADES COMPETENTES DE LOS GOBIERNOS DE LAS ENTIDADES FEDERATIVAS O MUNICIPIOS.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.10']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.10']!=0||!empty($row_reporte['6.10'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.10	MANIFIESTO, BAJO PROTESTA DE DECIR VERDAD, QUE LOS SOCIOS, DIRECTIVOS, ACCIONISTAS, ADMINISTRADORES, COMISARIOS Y DEMÁS PERSONAL DE LOS PROCESOS DE VENTAS, COMERCIALIZACIÓN, RELACIONES PÚBLICAS O SIMILARES, NO TIENEN, NO VAN A TENER EN EL SIGUIENTE AÑO O HAN TENIDO EN EL ÚLTIMO AÑO, RELACIÓN PERSONAL PROFESIONAL, LABORAL, FAMILIAR O DE NEGOCIOS CON LOS SERVIDORES SEÑALADOS EN LA PRESENTE SOLICITUD.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.11']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.11']!=0||!empty($row_reporte['6.11'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.11	MANIFIESTO “BAJO PROTESTA DE DECIR VERDAD” DONDE INDIQUE EL GRADO DE INTEGRACIÓN NACIONAL DE LOS BIENES OBJETO DE LA PRESENTE ADQUISICIÓN.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.12']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.12']!=0||!empty($row_reporte['6.12'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.12	"MANIFIESTO BAJO PROTESTA DE DECIR VERDAD DONDE INDIQUE QUE LA EMPRESA HA CUMPLIDO EN DEBIDA FORMA CON LAS OBLIGACIONES FISCALES SEÑALADAS POR EL CÓDIGO FISCAL DE LA CIUDAD DE MÉXICO, CORRESPONDIENTES  A LOS ÚLTIMOS CINCO EJERCICIOS FISCALES Y CONSTANCIA DE ADEUDOS, EXPEDIDA POR LA ADMINISTRACIÓN TRIBUTARIA QUE LE CORRESPONDA;  O EN SU CASO, POR EL SISTEMA DE AGUAS DE LA CIUDAD DE MÉXICO, DE LAS SIGUIENTES CONTRIBUCIONES:
                                                            A. IMPUESTO PREDIAL
                                                            B. IMPUESTO SOBRE ADQUISICIÓN DE INMUEBLES
                                                            C. IMPUESTO SOBRE NÓMINA
                                                            D. IMPUESTO SOBRE TENENCIA O USO DE VEHÍCULOS
                                                            E. IMPUESTO POR LA PRESTACIÓN DE SERVICIOS DE HOSPEDAJE
                                                            F. DERECHOS POR EL SUMINISTRO DE AGUA.
                                                            G. IMPUESTO POR ADQUISICIÓN DE VEHÍCULOS AUTOMOTORES USADOS
                                                            
                                                            NOTA: EN CASO DE NO SER CAUSANTE DE ALGUNA DE LAS CONTRIBUCIONES SEÑALADAS DEBERÁN MANIFESTARLO BAJO PROTESTA DE DECIR VERDAD, EN EL QUE INDIQUEN  LOS MOTIVOS POR LOS QUE NO ESTÁN OBLIGADOS A LO ANTERIOR; Y EN SU CASO, ADJUNTAR COPIA DE CONTRATO DE ARRENDAMIENTO Y/O OUTSOURCING.   
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.13']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.13']!=0||!empty($row_reporte['6.13'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.13	PARCIALES DE I.S.R. E I.V.A. ÚLTIMOS CUATRO MESES. 
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.14']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.14']!=0||!empty($row_reporte['6.14'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.14	RELACIÓN DE PERSONAL ASEGURADO EN EL I.M.S.S., CEDULA DE DETERMINACIÓN DE CUOTAS, NO MAYOR A UN MES DE ANTELACIÓN A LA FECHA DE LA CONTRATACIÓN Y COMPROBANTES DE PAGO DE LAS CUOTAS OBRERO PATRONALES DE LOS ÚLTIMOS DOS BIMESTRES. (EN EL CASO DE CONTRATACIÓN DE SERVICIOS)
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.15']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.15']!=0||!empty($row_reporte['6.15'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.15	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD, QUE TENDRÁ LA CALIDAD DE PATRÓN, RESPECTO DEL PERSONAL QUE UTILICE PARA LA ENTREGA DE LOS BIENES, OBJETO DE LA PRESENTE SOLICITUD DE COTIZACIÓN, POR LO QUE LA SECRETARIA DE SALUD DE LA CIUDAD DE MÉXICO NO PODRÁ CONSIDERARSE PATRÓN SOLIDARIO O SUSTITUTO DE CUALESQUIERA DE LAS OBLIGACIONES Y RESPONSABILIDADES QUE TENGA CON RESPECTO A SUS TRABAJADORES, EN CASO DE CONTROVERSIA LABORAL CON ALGUNO O VARIOS DE SUS TRABAJADORES, ASUMIRÁ TOTALMENTE LA RESPONSABILIDAD LABORAL Y ECONÓMICA CON RESPECTO A SU PERSONAL.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.16']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.16']!=0||!empty($row_reporte['6.16'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.16	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD QUE, CUENTA CON TODOS Y CADA UNO DE LOS PERMISOS, AUTORIZACIONES O AVISOS QUE EN SU CASO APLIQUEN ANTE LAS DIVERSAS AUTORIDADES PARA PROPORCIONAR LA ENTREGA DE LOS BIENES DE ESTA SOLICITUD DE COTIZACIÓN Y DE QUE  ASUMIRÁ LA RESPONSABILIDAD TOTAL EN CASO DE QUE INFRINJAN PATENTES, MARCAS, CERTIFICADOS DE INVENCIÓN O DERECHOS DE AUTOR DURANTE LA VIGENCIA DEL CONTRATO, SIN RESPONSABILIDAD PARA EL GOBIERNO DE LA CIUDAD DE MÉXICO.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.17']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.17']!=0||!empty($row_reporte['6.17'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.17	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD QUE CONOCE Y ACEPTA EL CONTENIDO DE TODAS Y CADA UNA DE LAS HOJAS DE LA PRESENTE SOLICITUD DE COTIZACIÓN, INCLUYENDO SUS ANEXOS.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.18']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.18']!=0||!empty($row_reporte['6.18'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.18	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD, QUE NO CEDERÁ NI SUBCONTRATARA NI TOTAL NI PARCIALMENTE, LOS DERECHOS Y OBLIGACIONES QUE SE DERIVEN DEL CONTRATO RESPECTIVO, DE CONFORMIDAD CON EL ARTICULO 61 PRIMER PÁRRAFO DE LA LEY DE ADQUISICIONES PARA EL DISTRITO FEDERAL.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.19']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.19']!=0||!empty($row_reporte['6.19'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.19	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD, QUE ME COMPROMETO A NO INCURRIR EN PRACTICAS NO ÉTICAS O ILEGALES DURANTE LA PRESENTE SOLICITUD DE COTIZACIÓN, ASÍ COMO EN EL PROCESO DE FORMALIZACIÓN Y VIGENCIA DEL CONTRATO Y, EN SU CASO, LOS CONVENIOS QUE SE CELEBREN, INCLUYENDO LOS ACTOS QUE DE ESTOS DERIVEN.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.20']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.20']!=0||!empty($row_reporte['6.20'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.20	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD, QUE AUTORIZO A LA SECRETARIA DE SALUD DE LA CIUDAD DE MÉXICO A VERIFICAR ANTE LAS INSTANCIAS CORRESPONDIENTES, LA VERACIDAD DE LOS DOCUMENTOS PRESENTADOS COMO MOTIVO DE ESTA SOLICITUD DE COTIZACIÓN.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.21']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.21']!=0||!empty($row_reporte['6.21'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.21	MANIFESTACIÓN BAJO PROTESTA DE DECIR VERDAD, EN EL QUE PROPORCIONE UN DOMICILIO DENTRO DE LA CIUDAD DE MÉXICO PARA ESCUCHAR Y RECIBIR NOTIFICACIONES. EN EL CASO DE QUE SU DOMICILIO FISCAL SE ENCUTRA FUERA DE LA CIUDAD DE MÉXICO
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.22']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.22']!=0||!empty($row_reporte['6.22'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.22	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD QUE EN CASO DE QUE CAMBIE DE DOMICILIO FISCAL, ESTO SERA NOTIFICADO A SECRETARIA DE SALUD DE LA CIUDAD DE MÉXICO DENTRO DE LOS 15 DÍAS POSTERIORES A DICHO CAMBIO, Y SEÑALARE OPORTUNAMENTE EL NUEVO DOMICILIO, ASÍ COMO EL NÚMERO(S) TELEFÓNICO(S) CORRESPONDIENTE(S).
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.23']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.23']!=0||!empty($row_reporte['6.23'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.23	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD QUE CONOZCO EL CONTENIDO DEL ARTICULO 77 DE LA LEY DE ADQUISICIONES PARA EL DISTRITO FEDERAL.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.24']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.24']!=0||!empty($row_reporte['6.24'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.24	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD QUE NO ME ENCUENTRO EN LOS SUPUESTOS DE IMPEDIMENTOS LEGALES CORRESPONDIENTES, NI INHABILITADOS O SANCIONADO POR LA SECRETARIA DE LA CONTRALORÍA GENERAL DE LA CIUDAD DE MÉXICO, POR LA SECRETARIA DE LA FUNCIÓN PUBLICA DE LA ADMINISTRACIÓN PUBLICA FEDERAL O AUTORIDADES COMPETENTES DE LOS GOBIERNOS DE LAS ENTIDADES FEDERATIVAS O MUNICIPIOS.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.25']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.25']!=0||!empty($row_reporte['6.25'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.25	EN RELACIÓN A LO SEÑALADO EN EL ARTÍCULO 49 FRACCIÓN XV DE LA LEY DE RESPONSABILIDADES ADMINISTRATIVAS DE LA CIUDAD DE MÉXICO, MANIFIESTO BAJO PROTESTA DE DECIR VERDAD SU CONDICIÓN Y/O LA DE LOS SOCIOS O ACCIONISTAS RESPECTO A LOS SIGUIENTES SUPUESTOS:
                                                            NO  DESEMPEÑO EMPLEO, CARGO O COMISIÓN EN EL SERVICIO PÚBLICO.
                                                            NO  DESEMPEÑO EMPLEO, CARGO O COMISIÓN EN EL SERVICIO PÚBLICO, SIN EMBARGO, EN CASO DE RESULTAR ADJUDICADO, CON LA FORMALIZACIÓN DEORRESPONDIENTE NO SE ACTUALIZA UN CONFLICTO DE INTERÉS                                                    
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.26']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.26']!=0||!empty($row_reporte['6.26'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.26	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD QUE CONOCE Y ACEPTA LAS CONDICIONES DE ENTREGA Y TENDRÁ BAJO SU CARGO LA TRANSPORTACIÓN DE LOS BIENES Y LAS MANIOBRAS DE CARGA Y DESCARGA EN EL LUGAR DE ENTREGA, DE CONFORMIDAD CON LO ESTABLECIDO EN EL PRESENTE OFICIO.                            
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.27']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.27']!=0||!empty($row_reporte['6.27'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.27	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD QUE EL LUGAR, PLAZO DE ENTREGA, HORARIOS DE RECEPCIÓN Y VERIFICACIÓN DE LOS BIENES ADJUDICADOS SERA CONFORME A LO ESTABLECIDO EN EL PRESENTE OFICIO.                        
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.28']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.28']!=0||!empty($row_reporte['6.28'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.28	MANIFIESTO BAJO PROTESTA DE DECIR VERDAD QUE CUANDO SE PRESUMAN DESVIACIÓN DE CALIDAD A LOS BIENES INTEGRADOS EL PROVEEDOR ACEPTA QUE LA “SECRETARÍA DE SALUD DE LA CIUDAD DE MÉXICO” PODRÁ REALIZAR EN CUALQUIER MOMENTO PRUEBAS DE CALIDAD A TRAVÉS DE LABORATORIOS CERTIFICADOS POR LA EMA (ENTIDAD MEXICANA DE ACREDITACIÓN) DURANTE LA VIGENCIA DEL CONTRATO Y QUE LO RESULTADOS DE LAS PRUEBAS SERÁN ENTREGADOS A NOMBRE DE LA SECRETARÍA DE SALUD LOS COSTOS DE LAS PRUEBAS SERÁN A CARGO DEL PROVEEDOR.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.29']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.29']!=0||!empty($row_reporte['6.29'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.29	MANIFIESTO BAJO PROTESTA A DECIR VERDAD QUE, EN CASO DE DEVOLUCIÓN O RECHAZO DE LOS BIENES ENTREGADOS, REALIZARA EL CANJE TOTAL DE PRODUCTO POR BIENES DE LA MISMA CALIDAD Y DESCRIPCIÓN QUE LO OFERTADO, EN UN PLAZO NO MAYOR A 5 DÍAS NATURALES CONTADOS A PARTIR DE LA NOTIFICACIÓN POR ESCRITO QUE LA DIRECCIÓN GENERAL DE SERVICIOS MÉDICOS Y URGENCIAS HAGA LA DIRECCIÓN DE MEDICAMENTOS TECNOLOGÍA E INSUMOS Y ESTA ULTIMA A LA DIRECCIÓN DE RECURSOS MATERIALES, ABASTECIMIENTOS Y SERVICIOS.
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.30']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.30']!=0||!empty($row_reporte['6.30'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.30	CURRICULUM EMPRESARIAL
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.31']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.31']!=0||!empty($row_reporte['6.31'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.31	CONSTANCIA DE REGISTRO EN EL PADRÓN DE PROVEEDORES DE LA ADMINISTRACIÓN PÚBLICA DE LA CIUDAD DE MÉXICO Y/O REGISTRO EN EL TIANGUIS DIGITAL DEL GOBIERNO DE LA CIUDAD DE MÉXICO
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.32']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.32']!=0||!empty($row_reporte['6.32'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.32	OPINIÓN POSITIVA DEL SAT 
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.33']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.33']!=0||!empty($row_reporte['6.33'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.33	OPINIÓN POSITIVA DEL IMSS
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.34']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.34']!=0||!empty($row_reporte['6.34'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.34	OPINIÓN POSITIVA DEL INFONAVIT
                                                        </td></tr>
                                                    <!-- 
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['6.35']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['6.35']!=0||!empty($row_reporte['6.35'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>6.35	NÚMERO DE REGISTRO DE ACREEDOR, EN CASO DE NO TENERLO FAVOR DE TRAMITARLE EN LA DIRECCIÓN DE FINANZAS DE LA SECRETARIA DE SALUD
                                                        </td></tr>
                                                        -->
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['7']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['7']!=0||!empty($row_reporte['7'])){ ?><a href="#"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>7 CONTRATO
                                                        </td></tr>
                                                        <tr><td>
                                                        <?php 
                                                        if($row_reporte['8']==0){?><i class="fas fa-file fa-lg text-primary" title="No"></i>
                                                        <?php
                                                        }elseif($row_reporte['8']!=0||!empty($row_reporte['8'])){ ?><a href="<?="docs/".$row_reporte['year']."/".$row_reporte['contrato']."/8.pdf"?>" target="_blank"><i class="fas fa-file fa-lg" title="Cuenta con el documento"></i> </a><?php $avance++;}else{echo'<i class="fas fa-file fa-lg text-primary" title="No"></i>';}; ?>8	GARANTÍA
                                                        </td></tr>

                                            
                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                            <div class="hidden-print">
                                                <div class="float-right">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                    <a href="javascript:window.close()" class="btn btn-primary waves-effect waves-light">Cerrar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h3 class="m-t-0">Archivos</h3>
                                        <form action="descargar_directorio.php" method="post">
                                            <input type="hidden" name="directorio_a_comprimir" value=<?=$directorio_a_comprimir?>>
                                            <button type="submit" name="descargar_zip">Generar ZIP</button>
                                        </form>
                                         <!-- IMPRESION DIRECTORIO -->
                                        
                                                      <div>
                                                     <?php
                                                        
                                                        $ruta= $directorio_a_comprimir;
                                                        error_reporting(0); 
                                                        $directorio = opendir($ruta); //ruta actual
                                                        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
                                                        {
                                                            if (is_dir($archivo))//verificamos si es o no un directorio
                                                            {
                                                                echo ""; //de ser un directorio lo envolvemos entre corchetes
                                                            }
                                                            else
                                                            {
                                                                echo  '<a target="_blank" href="'.$ruta.'/'.$archivo.'" >' .$archivo .' <br /> </a>'  ;
                                                            }
                                                        }
                                                        ?> 
                                                      </div>
                                                    
                                    </div>
                                </div>
                            </div>
                        </div> <!-- panel body -->
                    </div> <!-- end panel -->

                </div> <!-- end col -->

            </div>
            <!-- end row -->





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


        <script src="assets/js/app.js"></script>



</body>

</html>