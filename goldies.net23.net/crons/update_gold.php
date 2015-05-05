<?php
include_once("../includes/connect.php");
include_once("../includes/funciones.php");
include_once("../includes/reglas.php");
//$world_bank_level =  mysql_fetch_assoc(mysql_query("select level from world_bank"));
$sql = mysql_query("SELECT * FROM usuarios");
while ($row = mysql_fetch_object($sql)){
	$gold = $row->gold + calcularIncome($row);// + $world_bank[$world_bank_level['level']];
	$update = mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE usuario='".$row->usuario."'");
}
updateRank();
?>