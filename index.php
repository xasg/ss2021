<?php
printf("Iniciando");
$message="";
session_start(); 
$_SESSION['locale'] ="index.php";
$_SESSION['user']  = "";
$_SESSION['tp_usr'] = "";
$_SESSION['instante']   = time();
include('databases_utilities.php');
include('logs.php');
mysqli_set_charset( $mysqli, 'utf8');
	if(isset($_POST['user'])&&isset($_POST['psw'])){
		$message="Entro al IF";
		$user=$_POST['user'];
		$psw=$_POST['psw'];
		systemLogs("USER","Login", "Datos: ".$user."||".$psw);
		$query="SELECT * FROM users WHERE data_usr='$user' AND data_psw='$psw'";
		if( $resultado = mysqli_query($mysqli, $query) or die(mysql_error())){         
		    $row_reporte = mysqli_fetch_assoc($resultado);
		    $totalRows_reporte = mysqli_num_rows($resultado);
		  }
		  if ($totalRows_reporte=="1") {
		  	$target="expedientes.php";
		  	if($row_reporte['tp_usr']=="Observador"){
		  		$target="inicio.php";
		  		$_SESSION['tp_usr'] = "Observador";
		  	}
		  	if($row_reporte['tp_usr']=="Colaborador"){
		  		$target="inicio.php";
		  		$_SESSION['tp_usr'] = "Colaborador";
		  	}
		  	if($row_reporte['tp_usr']=="Admin"){
		  		$target="expedientes.php?year=2022&tp=ad";
		  		$_SESSION['tp_usr'] = "Admin";
		  	}

		  	?>
		  	<script>
		        window.location="<?=$target ?>";
		    </script>
		  	<?php 
		  	systemLogs("USER","Login", "Datos: ".$user."||".$target);

		  }else{
		  	$message="Error en datos de Acceso";
		  	systemLogs("USER","Login", $message.": ".$user."||".$psw);

		  }
		  
	}else{
		//$message="Sin entrar valores POST";
	}
// Check connection

?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<title>Dirección de recursos materiales y servicios generales</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets2/css/main.css" />
		<noscript><link rel="stylesheet" href="assets2/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading-0 is-loading-1 is-loading-2">

		<!-- Main -->
			<div id="main">
				<!-- Header -->
					<header id="header">
					<form method="post">
						<h1>Acceso </h1>
						<!--<label class="styletext">Usuario</label>-->
						<label class="styletext">Usuario</label>
						<input type="text" id="user" name="user" placeholder="Usuario" required/><br>
						<label class="styletext">password</label>
						<input title="Se necesita un nombre" id="psw" type="password" name="psw" placeholder="Contraseña" required/>
						<br>						
						<input type="submit" value="Ingresar" name="boton" />
					</form>
					<?php echo "$message";?><br>
					<img src="imagen.jpeg" alt="..." class="img" width="100%" style="margin: 0px auto;";> 
					<!--<img src="images/fulls/login.gif" alt="..." class="img" width=100%" style="margin: 0px auto;";> -->
					</header>

				<!-- Thumbnail -->
					<section id="thumbnails">
						<article>
							<a class="thumbnail" href="imagen.jpeg" data-position="left center"></a>
						
						</article>
						
						
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets2/js/jquery.min.js"></script>
			<script src="assets2/js/skel.min.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets2/js/main.js"></script>

	</body>
</html>