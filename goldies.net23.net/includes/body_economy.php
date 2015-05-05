<?php
//Input Type Number todavía no tiene aceptación fuera de Chrome. Hay que validar para el resto.
echo "<h2>Economy</h2>";
echo "<div class='tips'>
	<p>You can deposit your ".string_moneda." in the bank at a ".(deposit_rate*100)."% ratio, in ".deposit_interval." ".string_moneda." intervals</p>
	<p>You can withdraw all you want in any way at any time, as long as you have it deposited</p>
	</div>";
if (isset($_SESSION['userid'])){
	if (!isset($usuario)){
		$usuario = mysql_query("select * from usuarios where id='$_SESSION[userid]'");
	}
	if (isset($_POST['submit'])){
		if (isset($_POST['withdraw'])){
			if ($_POST['withdraw'] > 0){
				$withdraw = $_POST['withdraw'];
				$sql = mysql_query("select deposit from bank where id_usuario=$usuario->id");
				if (mysql_num_rows($sql)==1){//Me fijo si ya tiene deposito creado
					$current_deposit = mysql_fetch_object($sql)->deposit;
					if ($withdraw <= $current_deposit){ //Actualizo el deposito del usuario
						$deposit = $current_deposit - $withdraw;
						$sql = "update bank set deposit=$deposit where id_usuario=$usuario->id";
						if (!mysql_query($sql)){
							echo mysql_error().$sql;
						}
						else { //Si todo salió bien, actualizo el oro del usuario.
							$new_gold = $usuario->gold + $withdraw;
							$sql = mysql_query("update usuarios set gold='$new_gold' where id=$usuario->id");
							echo "<div class='exito'>Operation succesful!</div>";
							updateGold($new_gold);
						}
					}
					else { //Si Withdraw > Deposit
						echo "<div class='no-gold'>You can't withdraw more than what you have</div>";
					}
				}
				else { //Si no tiene deposito
					echo "<div class='no-gold'>You don't have any ".constant('string_moneda')."deposited</div>";
				}
			}
			else {
				echo "<div class='no-gold'>Can't withdraw negative values!</div>";
			}

		}
		if (isset($_POST['deposit'])){
			if ($_POST['deposit']>0 && $_POST['deposit'] % deposit_interval == 0){
				if ($_POST['deposit']<=$usuario->gold){
					$sql = mysql_query("select deposit from bank where id_usuario=$usuario->id");
					if (mysql_num_rows($sql)==1){
						$old_deposit = mysql_fetch_object($sql)->deposit;
						$new_deposit = $old_deposit+($_POST['deposit']*deposit_rate);
						$sql = "update bank set deposit=$new_deposit where id_usuario=$usuario->id";
						if (!mysql_query($sql)){
							echo mysql_error().$sql;
						}
						else {
							$new_gold = $usuario->gold - $_POST['deposit'];
							$sql = mysql_query("update usuarios set gold='".$new_gold."' where id=$usuario->id");
							echo "<div class='exito'>Operation succesful!</div>";
							updateGold($new_gold);
						}
					}
					else{
						$sql = "insert into bank (id_usuario, deposit) values ($usuario->id,".$_POST['deposit']*deposit_rate.")";
						if (!mysql_query($sql))
							echo mysql_error().$sql;
						else{
							$new_gold = $usuario->gold - $_POST['deposit'];
							$sql = mysql_query("update usuarios set gold='$new_gold' where id='$usuario->id'");
							echo "<div class='exito'>Operation succesful!</div>";
							updateGold($new_gold);
						}
					}
				}
				else {
					echo "<div class='no-gold'>Can't deposit more than what you have!</div>";
				}
			}
			else {
				echo "<div class='no-gold'>Deposit must be higher than zero and in intervals of ",deposit_interval, " ", string_moneda,"</div>";
			}
		}
	}
	$sql = mysql_query("select deposit from bank where id_usuario=$usuario->id");
	$bank = mysql_fetch_object($sql);
	$bank ? $deposito= $bank->deposit : $deposito=0;
	echo "
	<table class='stats table'>
	<tr class='$racestyle'>
	<th colspan='3'>Bank</th>
	</tr>
	<form action='",$_SERVER['PHP_SELF'],"' method='post'>
	<tr class='impar'>
	<td>Deposit: </td><td><input type='number' name='deposit' min='500' step='500'></td><td><input class='button small black' type='Submit' name='submit' value='Deposit' /></td>
	</tr>
	</form>
	<form action='",$_SERVER['PHP_SELF'],"' method='post'>
	<tr class='par'>
	<td>Withdraw: </td><td><input type='number' name='withdraw' min='500' step='500'></td><td><input class='button small black' type='Submit' name='submit' value='Withdraw' /></td>
	</tr>
	</form>
	<tr class='impar'>
	<th colspan='3'>Current Balance</th>
	</tr>
	<tr class='par'>
	<td colspan='3'>".formatNum($deposito)."</td>
	</tr>
	</table>
	";
	/*
	$world_bank_level =  mysql_fetch_assoc(mysql_query("select level from world_bank"));
	$wbl = $world_bank_level['level'];
	echo "
	<table class='stats'>
	<tr class='$racestyle'>
	<th colspan='3'>World Bank</th>
	</tr>
	<tr class='impar' colspan='3'>
	<th>Current Level</th>
	</tr>
	<tr class='par'>
	<td>$wbl</td>
	</tr>
	<tr class='impar' colspan='3'>
	<th>Current World Income</th>
	</tr>
	<tr class='par'>
	<td>$world_bank[$wbl]</td>
	</table>
	";*/
}
else {
	header('Location: index.php');
}
?>