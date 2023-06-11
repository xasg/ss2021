<?php
#Update later
require_once('conec.php');
$mysqli = new mysqli($servername, $username, $password, $dbname);
$result ='';

if( $mysqli->connect_errno )
{
  echo '';
  exit;
}


function add_expediente( $tipo, $pedido , $proveedor, $objeto, $fecha, $vigencia, $monto)
{
global $mysqli;
$sql="INSERT INTO expediente(id_expediente, tp_tipo, nom_descripcion, nom_empresa, inf_servicio,  fh_fin, fh_inicio, inf_monto
) VALUES (null, '{$tipo}', '{$pedido}', '{$proveedor}', '{$objeto}', '{$vigencia}', '{$fecha}', '{$monto}')";
$mysqli->query($sql);
}




function select_expediente($pedido)
{
  global $mysqli;
  $sql = "SELECT * FROM expediente WHERE nom_descripcion = '{$pedido}'";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}

