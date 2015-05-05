<?php
function calcularBatalla($attacker, $defender){
	$attack = calcularAttack($attacker);
	$defense = calcularDefense($defender);
	$gold_stolen = $defender->gold;
	$attacker_casualties = 0; //Calcular Casualties iría acá o una función extra.
	$defender_casualties = 0;
	if ($attack>$defense){
		echo
		"<div class='battle'>
		You <span class='won'>won</span> the battle!<br />
		Your attack of $attack triumphed over $defender->usuario's $defense defense!<br />
		You won $gold_stolen ".constant('string_moneda')."!<br />
		The enemy sustained $defender_casualties casualties.<br />
		</div>
		";
		return $gold_stolen;
	}
	else if (calcularDefense($defender)>calcularAttack($attacker)){
		echo
		"<div class='battle'>
		You <span class='lost'>lost</span>...<br />
		$defender->usuario's $defense defense was too much for your $attack attack.<br />
		No gold was taken and you suffered $attacker_casualties casualties.<br />
		Build a stronger army and keep trying!<br />
		</div>
		";
		return 0;
	}
	else{
		echo "<div class='battle'>It's a draw!</div>";
		return 0;
	}
} 
if (isset($_GET['id'])){
	$sql = mysql_query("SELECT * FROM usuarios WHERE id='".$_GET['id']."'");
	if (mysql_num_rows($sql)>0){
		$defender = mysql_fetch_object($sql);
		$sql = mysql_query("SELECT * FROM usuarios WHERE id='".$_SESSION['userid']."'");
		if (mysql_num_rows($sql)>0){ //Si existe el atacante.
			$attacker = mysql_fetch_object($sql);
			if ($defender->id != $attacker->id){//Si el defensor y el atacante no son la misma cuenta.
				$gold_stolen = calcularBatalla($attacker, $defender); //Calculo la batalla, si ganó el atacante, le resto el oro perdido al defensor.
				if ($gold_stolen!=0){ //Si empata o pierde, nada.
					$gold = ($attacker->gold) + $gold_stolen;
					$sql = mysql_query("UPDATE usuarios SET gold='".(($defender->gold) - $gold_stolen)."' WHERE id='".$defender->id."' ");
					$sql = mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE id='".$attacker->id."' ");
					echo '<script type="text/javascript">'
					   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
					   , '</script>';
				}
			}
			else {
				echo "You can't attack yourself!";
			}
		}
		else {
			if (isset($_SESSION['userid'])) header( 'Location: battlefield.php' ) ; //Si está iniciada la sesión, a battlefield, sino a index
				else header('Location: index.php');
		}
	}
	else header( 'Location: battlefield.php' ) ;
}
else header('Location: battlefield.php');
?>
