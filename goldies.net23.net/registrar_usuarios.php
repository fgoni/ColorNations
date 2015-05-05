<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Color Nations</title>
<?php
require_once 'includes/cabecera.php';
?>

<div class="maqueta">
<h2>User Registration</h2>
<?php
 
$texto_activ = generar_texto(20,false);
$url = "http://www.colornations.com.ar/activar.php?id=" . $texto_activ;
$usuario = validarUsuario($_POST['usuario']) ? $usuario=$_POST['usuario'] : null;
$mail = validarMail($_POST['mail']) ? $mail=$_POST['mail'] : null;
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$password = sha1($password1);
$race = $_POST['race'];

if($usuario){
	if($mail){
		if($password1 && $password2){ //Revisa que estén completos todos los campos
			$q = mysql_query("(SELECT 1 FROM usuarios a WHERE a.usuario='$usuario') UNION (SELECT 1 FROM usuarios_temp b WHERE b.usuario='$usuario')");
		    $n = mysql_num_rows($q);
			if(!$n){ //Revisa si hay usuarios con el mismo nombre
				$q = mysql_query("(SELECT 1 FROM usuarios a WHERE a.mail='$mail') UNION (SELECT 1 FROM usuarios_temp b WHERE b.mail='$mail')");
				$n = mysql_num_rows($q);
				if(!$n){ //Revisa si hay usuarios con el mismo mail.
					if($password2==$password1){ //Revisa si las contraseñas coinciden.
						$sql="INSERT INTO usuarios_temp (usuario, mail, password, fecha_alta, texto_activ, race)
						VALUES
						('$usuario','$mail','$password',CURDATE(),'$texto_activ', '$race')";
						if (!mysql_real_escape_string(mysql_query($sql,$con)))
						  {
							echo "<h3 class=\"error\">There was an error on the registration</h3>";
							error_log('Error: ' . mysql_error() .$sql);
						  }
						else {
							echo "<h3>Succesfully registered!<br/></h2>";
							mailActivacion($_POST['mail'],$_POST['usuario'], $url);
							echo "<h4>To validate your account, click on the link sent to the e-mail you registered.<br/></h4>";
							/*echo "<script> setTimeout(function(){javascript:window.history.back();}, 3000); </script>";*/
						}
					} else {
						echo "<h3 class=\"error\">Passwords do not match</h3>";
		        		}
		        } else {
		            echo "<h3 class=\"error\">E-Mail already in use</h3>";
		            }
		    } else {
		        echo "<h3 class=\"error\">Username already exists</h3>";
		        }
		} else {
		    echo "<h3 class=\"error\">One or more fields are missing</h3>";
		    }
	} else {
	    echo "<h3 class=\"error\">Email is invalid or empty</h3>";
	    }
} else {
	echo "<h3 class='error'>Username is invalid or empty</h3>";
}
mysql_close($con);
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
