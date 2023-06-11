<?php
session_start(); 
include('databases_utilities.php');
mysqli_set_charset( $mysqli, 'utf8');
if(isset($_POST['user'])&&isset($_POST['psw'])&&isset($_POST['tp_acces'])){
	$user=$_POST['user'];
	$psw=$_POST['psw'];
	$acces=$_POST['tp_acces'];
	$query="SELECT * FROM cat_promtel WHERE data_usr='$user' AND data_psw='$psw'";
	if( $resultado = mysqli_query($mysqli, $query) or die(mysql_error())){         
	    $row_reporte = mysqli_fetch_assoc($resultado);
	    $totalRows_reporte = mysqli_num_rows($resultado);
	  } 

}
// Check connection

?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<title>Administración de requisiciones Promtel</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets2/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets2/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading-0 is-loading-1 is-loading-2">

		<!-- Main -->
			<div id="main">

				<!-- Header -->
					<header id="header">
					<form>
						<h1>Acceso </h1>
						<input type="text" id="user" name="user" placeholder="Usuario" required/><br>
						<input title="Se necesita un nombre" id="psw" type="password" name="psw" placeholder="Contraseña" required/>
						<br>						
						<!-- <button type="button">Iniciar</button> -->
						<input type="submit" value="Ingresar" name="boton" />
					</form>
					<img src="images/fulls/lato1.png" alt="..." class="img" width=100%" style="margin: 0px auto;";> 
					<img src="images/fulls/login.gif" alt="..." class="img" width=100%" style="margin: 0px auto;";> 
					</header>
				<!-- Thumbnail -->
					<section id="thumbnails">
						<article>
							<a class="thumbnail" href="images/fulls/.jpg" data-position="left center"></a>
						</article>
					</section>
				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
						<img src="images/fulls/login.gif" alt="..." class="img"> 
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