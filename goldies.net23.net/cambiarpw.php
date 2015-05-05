<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Color Nations - Change Password</title>
<?php
/* Incluye la cabecera de la página*/
require_once 'includes/cabecera.php';
?>
<div class="maqueta">
<h2>Change Password</h2>
<h3>(Remember that when changing passwords the current session will end)</h3>
<?php
    if(isset($_SESSION['userid']))
    {
		?>
<div class="form_registrar">
<form id="cambiarpw" class="formularios" method="post" onsubmit="return validarCambiarPW(this);" action="#">
<label for="old_pass">Current password</label> <input type="password" id="old_pass" name="old_pass" />
<label for="new_pass1">New password</label> <input type="password" id="new_pass1" name="new_pass1" />
<label for="new_pass2">Repeat the new password</label> <input type="password" id="new_pass2" name="new_pass2" />
<br />
<br />
<input type="submit" name="submit" value="Send" class="button black medium" />
</form>
<div id="pswd_info">
<h4>Password must fulfill<br/>the following requirements:</h4>
<ul>
    <li id="letter" class="invalid">At least <strong>one letter</strong></li>
    <li id="number" class="invalid">At least <strong>one number</strong></li>
    <li id="length" class="invalid">At least <strong>8 characters</strong></li>
</ul>
</div> <!-- Cierra pswd_info -->
</div> <!-- Cierro form_registrar -->

<?php
		if (isset($_POST['submit'])) {
			echo '<div class="recuperarpw">';
			$usuario = $_SESSION['nombre'];
			$oldpw = $_POST['old_pass'];
			$newpw1 = $_POST['new_pass1'];
			$newpw2 = $_POST['new_pass2'];
			$oldpwcrypt = sha1($oldpw);
			$newpwcrypt = sha1($newpw1);
			
			if ($newpw1 == $newpw2){
				$sql = mysql_query("SELECT 1 FROM usuarios a WHERE a.usuario='$usuario' AND a.password = '$oldpwcrypt'");
				$n = mysql_num_rows($sql);
					if($n){
						echo 'Su contraseña fue cambiada con éxito.<br />Vuelva a iniciar sesión con su contraseña nueva'.PHP_EOL;
						$sql = mysql_query("UPDATE usuarios SET password = '$newpwcrypt' WHERE usuario  = '$usuario'");
						sleep(3);
						header("location:logout.php");
					}
					else {
						echo 'La contraseña actual no es correcta';
					}
			}
			else {
				echo 'Las contraseñas nuevas no coinciden';
			}
			echo '</div> <!-- Cierro recuperarpw -->';
		}
	}
	else {
		?>
        <h4>Debes iniciar sesión para poder cambiar la contraseña</h4>
        <?php
	}
?>
<div class="altas_consejo" id="altas_consejo"> 
	<p>Try to use a safe password, or better yet, a pass-phrase!</p>
    <p>Some services you can use to help you:</p>
    <p><a href="http://howsecureismypassword.net/" target="_blank">How Secure is my password?</a> or <a href="https://www.microsoft.com/es-es/security/pc-security/password-checker.aspx" target="_blank">Microsoft Checker</a>.</p>
</div> <!-- Cierra altas_consejo -->
</div> <!-- Cierra maqueta -->
</div> <!--Cierra contenedor1 -->
</div> <!-- Cierra contenedor2 -->
<?php
/* Aquí empieza el Footer */

require_once 'includes/footer.php';
?>
</body>
</html>