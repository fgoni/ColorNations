<?php

/*
Conexión a la base de datos.
Me fijo primero si estoy trabajando localmente o remotamente, y seteo las variables según corresponda
*/
if( ($_SERVER["REMOTE_ADDR"]=="127.0.0.1") || ($_SERVER["REMOTE_ADDR"]=="::1") ){
	$local = True;
}else{

    $local = False;
}
if ($local){
	$mysql_host = "localhost"; 
	$mysql_database = "goldies";
	$mysql_user = "root";
	$mysql_password = "";
}
else {
	//Variables de la conexión: Host, BDD, Usuario y Contraseña.
	$mysql_host = "mysql4.000webhost.com"; 
	$mysql_database = "a9169867_Goldies";
	$mysql_user = "a9169867_Facundo";
	$mysql_password = "kashmir89";
}


//Creo una instancia de la conexión.
global $con;
$con = mysql_connect($mysql_host,$mysql_user,$mysql_password);
if (!$con)
{
die('No pudo conectarse a la base de datos: ' . mysql_error());
}
//Elijo la base de datos con la que voy a trabajar.
mysql_select_db($mysql_database, $con);
//Truco para las tildes.
mysql_query("SET NAMES 'utf8'");

?>
