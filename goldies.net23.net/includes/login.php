<?php
/* Barra de navegación derecha: Contiene el Login del usuario.
 */
include_once("reglas.php");
?>

<div class="maqueta_derecha col-md-4">
    <div class="form_usuario">
        <?php
        if (!isset($_SESSION))
            session_start();
        /* Verificar Login: Revisa que el usuario exista y valida su contraseña. Inicia la Session si no existía.
         */

        function verificar_login($usuario, $password, &$result) {
            $usuario_sec = strip_tags(substr($usuario, 0, 32));
            $password_sec = strip_tags(substr($password, 0, 32));
            $pwcrypt = sha1($password);
            $sql = "SELECT * FROM usuarios WHERE usuario='" . mysql_real_escape_string($usuario_sec) . "' and password='" . mysql_real_escape_string($pwcrypt) . "'";
            $rec = mysql_query($sql);
            $count = 0;
            while ($row = mysql_fetch_object($rec)) {
                $count++;
                $result = $row;
            }
            if ($count == 1) {
                return 1;
            } else {
                return 0;
            }
        }

        if (!isset($_SESSION['userid'])) {
            if (isset($_POST['login'])) {
                if (verificar_login($_POST['usuario'], $_POST['password'], $result) == 1) {
                    $_SESSION['userid'] = $result->id;
                    $_SESSION['nombre'] = $result->usuario;
                    $_SESSION['auth'] = $result->auth;
                    header("location:index.php");
                } else {
                    echo '<div class="error_logueo">Su usuario es incorrecto, intente nuevamente.</div>';
                }
            }
            ?> 
            <form action="" method="post" class="login">
                <div class="mensaje_logueado"><label>Username <br /></label><input name="usuario" type="text" /></div>
                <div class="mensaje_logueado"><label>Password <br /></label><input name="password" type="password" /></div>
                <div class="mensaje_logueado"><input name="login" type="submit" value="Log in" class="button medium black" /></div>
            </form> 
            <div class="registrar">
                <br />¿New to the game?<br/>Register <a href="../registrar.php"><strong>here</strong></a>!
                <br />¿Forgot your password? Click <a href="../recuperarpw.php"><strong>here</strong></a> to get a new one
            </div> <!-- Cierro registrar -->
        </div> <!-- Cierro form_usuario -->

    <?php
} else {
    $sql = mysql_query("SELECT * FROM usuarios WHERE usuario='" . $_SESSION['nombre'] . "'");
    $usuario = mysql_fetch_object($sql);
    $gold = $usuario->gold;
    switch ($usuario->race) {
        case 0: $racestyle = "reds";
            break;
        case 1: $racestyle = "greens";
            break;
        case 2: $racestyle = "blues";
            break;
        case 3: $racestyle = "oranges";
            break;
        default: $racestyle = "";
    }
    echo "<p class=\"mensaje_logueado $racestyle welcome\">Welcome <strong>" . $_SESSION['nombre'] . "</strong>!</p>" . PHP_EOL;
    echo "<p id='oro' class=\"mensaje_logueado\"> " . constant('string_oro') . ": " . formatNum($gold) . " " . constant('string_moneda') . "</p>" . PHP_EOL;
    echo "<p class=\"mensaje_logueado2\">Click <a href=\"cambiarpw.php\"><strong>here</strong></a> to change your password</p>" . PHP_EOL;
    echo "<p class=\"mensaje_logueado2\">Click <a href=\"logout.php\"><strong>here</strong></a> to logout</p>" . PHP_EOL;
    echo "<div id=\"timer\"></div>" . PHP_EOL;
    echo "</div> <!-- Cierro form_usuario -->" . PHP_EOL;
}
?>
</div> <!-- Cierro maqueta_derecha -->
