<?php
include_once("../includes/connect.php");
include_once("../includes/reglas.php");
include_once("../includes/funciones.php");
$sql = mysql_query("SELECT * FROM usuarios");
$numPlayers = 0;
$totalUP = 0;
while ($row = mysql_fetch_object($sql)){
	$totalUP += $tech_replication[$row->unitprod];
	$numPlayers++;
}
$globalUP = (int)($totalUP / $numPlayers);
echo $globalUP;
?>