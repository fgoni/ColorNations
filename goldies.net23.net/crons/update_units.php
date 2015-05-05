<?php
include_once("../includes/connect.php");
include_once("../includes/reglas.php");
include_once("../includes/funciones.php");
$sql = mysql_query("SELECT * FROM usuarios");
while ($row = mysql_fetch_object($sql)){
	$units = getUnits($row);
	$untrained = $units->untrained + $tech_replication[$row->unitprod];
	$update = mysql_query("UPDATE units SET untrained='$untrained' WHERE id_usuario='$row->id'");
}
$sql = mysql_query("SELECT * from bank");
while ($row = mysql_fetch_object($sql)){
	$new_deposit = $row->deposit*1.05;
	$update = mysql_query("update bank set deposit='$new_deposit' where id_usuario=$row->id_usuario");
}
?>