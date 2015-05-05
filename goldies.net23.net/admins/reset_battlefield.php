<?php
include('../includes/connect.php');
include('../includes/reglas.php');
$sql = mysql_query("UPDATE usuarios SET gold='".$GLOBALS['gold']."', units='".$GLOBALS['units']."', fort='".$GLOBALS['fort']."', siege='".$GLOBALS['siege']."', unitprod='".$GLOBALS['unitprod']."', berserkers='0', paladins='0'");

?>