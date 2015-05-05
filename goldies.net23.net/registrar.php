<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Color Nations - User Registration</title>
<?php
/* Incluye la cabecera de la página*/
require_once 'includes/cabecera.php';
?>
<div class="maqueta">
	<h2>New User Registration</h2>
    
<?php
    if(!isset($_SESSION['userid']))
    { echo '
  <div class="form_registrar">
  <form class="formularios" action="registrar_usuarios.php" method="post" onsubmit="return Validar(this);">
        <div><label for="usuario">Username:</label><input name="usuario" id="usuario" type="text" /></div>
        <div><label for="mail">E-Mail:</label><input name="mail" id="mail" type="text" /></div>
        <div><label for="pass1">Password:</label><input name="password1" id="pass1" type="password" /></div>
        <div><label for="pass2">Repeat password:</label><input name="password2" id="pass2" type="password" /></div>
        <div><label for="race">Tribe:</label>
        <select name="race" id="race">
            <option value="0" '.(isset($_POST['reds']) ? "selected" : "").'>Reds</option>
            <option value="1" '.(isset($_POST['greens'])  ? "selected" : "").'>Greens</option>
            <option value="2" '.(isset($_POST['blues'])  ? "selected" : "").'>Blues</option>
            <option value="3" '.(isset($_POST['oranges'])  ? "selected" : "").'>Oranges</option>
        </select>
        </div>
		<br />
        <div><input name="register" type="submit" value="Register" class="button medium black" /></div>
		</form>
        <div id="pswd_info">
        <h4>Password must fulfill<br/>the following requirements:</h4>
        <ul>
            <li id="letter" class="invalid">At least <strong>one letter</strong></li>
            <li id="number" class="invalid">At least <strong>one number</strong></li>
            <li id="length" class="invalid">At least <strong>8 characters</strong></li>
        </ul>
        </div> <!-- Cierra pswd_info -->
    </div> <!-- Cierra form_registrar -->
	';
	}
	else {
		echo '<h2>To register another user, first log out of your actual account.</h2>';
        echo '<h3>(Remember you can\'t own more than one account!)</h3>';
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
