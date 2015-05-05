<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Color Nations - Activate account</title>
<?php
/* Incluye la cabecera de la página*/
require_once 'includes/cabecera.php';
?>

<body>

<div class="maqueta">

<?php 
global $con;
$clave = $_GET['id'];

//Contruimos la sentencia para la cónsulta
$sql = "SELECT * FROM usuarios_temp WHERE texto_activ = '$clave'";
//Comprobamos el resultado de la consulta
$resultado=mysql_query($sql) or error_log('Error: ' . mysql_error() .$sql);

/*Recorremos los campos del registro que hemos recuperado de la tabla users_temp*/
while ($registro = mysql_fetch_array($resultado)) {
$usuario = $registro['usuario'];
$mail = $registro['mail'];
$password = $registro['password'];
$auth = $registro['auth'];
$fecha_alta = $registro['fecha_alta'];
$race = $registro['race'];
} // fin del bucle de ordenes
//Liberamos los registros de la tabla
mysql_free_result($resultado);


function activarRegistro($usuario, $mail, $password, $auth, $fecha_alta, $race){
	$sql="INSERT INTO usuarios (usuario, mail, password, auth, fecha_alta, fort, siege, unitprod, gold, race, racechanges)
	VALUES
	('$usuario','$mail','$password',$auth,'$fecha_alta', '".$GLOBALS['fort']."', '".$GLOBALS['siege']."', '".$GLOBALS['unitprod']."', '".$GLOBALS['gold']."', '$race', '".race_changes."')";
	
	$resultado2 = mysql_query($sql) or error_log('Error: ' . mysql_error() .$sql);
	//Comprobamos si el resultado ha ido bien
	if (!$resultado2)
		return false;
	else{
		$result = mysql_fetch_object(mysql_query("select 1 from usuarios where usuario=$usuario"));
		$sql = "insert into units (id_usuario, untrained) values ($result->id, ".units.")";
		return true;
	}
		
}
function borrarRegistro($usuario){
	$sql="DELETE FROM usuarios_temp WHERE usuario='$usuario'";	
	$resultado2 = mysql_query($sql) or error_log('Error: ' . mysql_error() .$sql);
	//Comprobamos si el resultado ha ido bien
	if (!$resultado2)
		return false;
	else
		return true;
}

if (activarRegistro($usuario, $mail, $password, $auth, $fecha_alta, $race)){
	echo '<h2>Your account is now active!</h2>';
	$seBorro = borrarRegistro($usuario); //if !seborro = error;
	echo '<h2> Redirecting to home page... </h2>';
	echo '<script> setTimeout(function(){javascript:window.location.href = "/index.php";}, 4000); </script>';
}
else {
	echo '<h2 style="color: red;">There was an error activating your account, contact an administrator</h2>';
}

?>
</div> <!-- Cierra maqueta -->
</div> <!--Cierra contenedor1 -->
</div> <!-- Cierra contenedor2 -->
<?php
/* Aquí empieza el Footer */

require_once 'includes/footer.php';
?>
</body>
</html>
