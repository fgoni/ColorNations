<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Color Nations - Reset password</title>
<script type="text/javascript" src="js/funciones.js"></script>
</head>

<body>
<?php
/* Incluye la cabecera de la página*/
require_once 'includes/cabecera.php';
?>
<div class="maqueta">
<h2>Reset Password</h2>
<?php
function generatePassword($length = 8) {
    $chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }
	$result .= mb_substr('123456789',rand(0,8),1);
    return $result;
}
function mailRecuperarPW($dir_correo, $usuario, $npw){
$destinatario = $dir_correo;
$nombre_pagina = "Recursos INSPT";
$asunto = $nombre_pagina." - Recuperación de Contraseña";
$cuerpo = $nombre_pagina.' - Recuperación de Contraseña<h2><br />Hola ';
$cuerpo .= $usuario;
$cuerpo .= '</h2>Se ha modificado su contraseña.<br/>Su nueva contraseña es: <br /><p style="text-align: center;">';
$cuerpo .= '<strong>'.$npw.'</strong>';
$cuerpo .= '</p><br />';
$cuerpo .= 'Inicie sesión con esta contraseña y luego cambiela por una de su elección.<br />';
$cuerpo .= 'Atte. <br /><strong>La Administración</strong>';
//para el envío en formato HTML
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
//dirección del remitente
$headers .= "From: administrador".$nombre_pagina."\r\n";
//dirección de respuesta, si queremos que sea distinta que la del remitente
$headers .= "Reply-To: direccion_respuesta@dominio.com \r\n";
//direcciones que recibián copia
//$headers .= "Cc: correocopia@dominio.com\r\n";
//direcciones que recibirán copia oculta
//$headers .= "Bcc: copiaocula1@dominio.com, copiaocula1@dominio.com \r\n";
mail($destinatario,$asunto,$cuerpo,$headers);
}
    if(!isset($_SESSION['userid']))
    {
		?>
<div class="form_registrar">
<form id="recuperar_mail" class="Texto1 registro formularios" method="post" action="#">
<label for="rec_usuario">Username:</label> <input type="text" id="rec_usuario" name="rec_usuario" />
<br />
<label for="rec_mail">E-Mail:</label> <input type="text" id="rec_mail" name="rec_mail" />
<br />
<br />
<input type="submit" name="submit" value="Send" class="button black medium" />
</form>
</div> <!-- Cierro recuperar_contraseña -->

<?php
		if (isset($_POST['submit'])) {
			echo '<div class="recuperarpw">';
			$mail = $_POST['rec_mail'];
			$usuario = $_POST['rec_usuario'];
			if (isset($mail) && isset($usuario)){
				$sql = mysql_query("SELECT 1 FROM usuarios a WHERE a.mail='$mail' AND a.usuario='$usuario'");
				$n = mysql_num_rows($sql);
					if($n){
						echo 'A temp password has been sent to the e-mail associated with this username<br />'.PHP_EOL;
						$npw = generatePassword();
						mailRecuperarPW($mail,$usuario,$npw);
						$npwcrypt = sha1($npw);
						$sql = mysql_query("UPDATE usuarios SET  password='$npwcrypt' WHERE usuario='$usuario' AND mail='$mail'");
					}
					else {
						echo "Username and e-mail don't match or don't exist";
					}
			}
			echo '</div> <!-- Cierro recuperarpw -->';
		}
	}
	else {
		?>
		<h3>You need to log out to get a new your password.</h3>
        <?php ;
	}
?>
<div class="altas_consejo" id="altas_consejo"> 
	<p>A new password will be sent to your e-mail so you can access your account.</p>
    <p>Once you log in, you can change your password to a new one.</p>
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