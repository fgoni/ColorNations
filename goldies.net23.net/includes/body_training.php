<?php
if (isset($_SESSION['userid'])){

$sql = mysql_query("SELECT * FROM usuarios WHERE id=$_SESSION[userid]");
$usuario = mysql_fetch_object($sql);
$units = getUnits($usuario);
$untrained = $units->untrained;
$berserkers = $units->berserkers;
$paladins = $units->paladins;
$merchants = $units->merchants;
$injured = $units->injured;
echo "<h2>$_SESSION[nombre]'s Training camp</h2>"; //Revisar que los submits sean positivos.
if (isset($_POST['quantity_berserkers'])){
		$costo = $_POST['quantity_berserkers'] * $GLOBALS['berserker_cost'];
		$gold = $usuario->gold;
		if ($gold>=$costo){
			if ($untrained>=$_POST['quantity_berserkers']){
				$gold  = $gold - $costo;
				$berserkers += $_POST['quantity_berserkers'];
				$untrained -= $_POST['quantity_berserkers'];
				mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE id=$usuario->id");
				mysql_query("UPDATE units SET untrained = $untrained,  berserkers=$berserkers WHERE id_usuario=$usuario->id");
				echo '<script type="text/javascript">'
				   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
				   , '</script>';
			}
			else echo "<div class='no-gold'>Not enough untrained units to train</div>";
		}
		else echo "<div class='no-gold'>Not enough gold</div>";
	}
else if(isset($_POST['quantity_paladins'])){
		$costo = $_POST['quantity_paladins'] * $GLOBALS['paladin_cost'];
		$gold = $usuario->gold;
		if ($gold>=$costo){
			if ($untrained>=$_POST['quantity_paladins']){
				$gold  = $gold - $costo;
				$paladins += $_POST['quantity_paladins'];
				$untrained -= $_POST['quantity_paladins'];
				mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE id=$usuario->id");
				mysql_query("UPDATE units SET untrained = $untrained,  paladins=$paladins WHERE id_usuario=$usuario->id");
				echo '<script type="text/javascript">'
			   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
			   , '</script>';
			}
			else echo "<div class='no-gold'>Not enough untrained units to train</div>";
		}
		else echo "<div class='no-gold'>Not enough gold</div>";
	}
else if(isset($_POST['quantity_merchants'])){
		$costo = $_POST['quantity_merchants'] * merchants_cost;
		$gold = $usuario->gold;
		if ($gold>=$costo){
			if ($untrained>=$_POST['quantity_merchants']){
				$gold  = $gold - $costo;
				$merchants += $_POST['quantity_merchants'];
				$untrained -= $_POST['quantity_merchants'];
				mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE id=$usuario->id");
				mysql_query("UPDATE units SET untrained = $untrained,  merchants=$merchants WHERE id_usuario=$usuario->id");
				echo '<script type="text/javascript">'
			   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
			   , '</script>';
			}
			else echo "<div class='no-gold'>Not enough untrained units to train</div>";
		}
		else echo "<div class='no-gold'>Not enough gold</div>";
	}
else if(isset($_POST['untrain_berserkers'])){
		$costo = $_POST['untrain_berserkers'] * untrain_cost;
		$gold = $usuario->gold;
		if ($gold>=$costo){
			if ($berserkers>=$_POST['untrain_berserkers']){
				$gold  = $gold - $costo;
				$berserkers -= $_POST['untrain_berserkers'];
				$untrained += $_POST['untrain_berserkers'];
				mysql_query("UPDATE usuarios SET gold='$gold' WHERE id=$usuario->id");
				mysql_query("UPDATE units SET berserkers=$berserkers, untrained = $untrained WHERE id_usuario = $usuario->id");
				echo '<script type="text/javascript">'
				   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
				   , '</script>';
			}
			else echo "<div class='no-gold'>Not enough trained units to untrain</div>";
		}
		else echo "<div class='no-gold'>Not enough gold</div>";
	}
else if(isset($_POST['untrain_paladins'])){
		$costo = $_POST['untrain_paladins'] * untrain_cost;
		$gold = $usuario->gold;
		if ($gold>=$costo){
			if ($paladins>=$_POST['untrain_paladins']){
				$gold  = $gold - $costo;
				$paladins = $paladins - $_POST['untrain_paladins'];
				$untrained += $_POST['untrain_paladins'];
				mysql_query("UPDATE usuarios SET gold='$gold' WHERE id=$usuario->id");
				mysql_query("UPDATE units SET paladins=$paladins, untrained = $untrained WHERE id_usuario = $usuario->id");
				echo '<script type="text/javascript">'
				   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
				   , '</script>';
			}
			else echo "<div class='no-gold'>Not enough trained units to untrain</div>";
		}
		else echo "<div class='no-gold'>Not enough gold</div>";
	}
else if(isset($_POST['untrain_merchants'])){
		$costo = $_POST['untrain_merchants'] * untrain_cost;
		$gold = $usuario->gold;
		if ($gold>=$costo){
			if ($merchants>=$_POST['untrain_merchants']){
				$gold  = $gold - $costo;
				$merchants = $merchants - $_POST['untrain_merchants'];
				$untrained += $_POST['untrain_merchants'];
				mysql_query("UPDATE usuarios SET gold='$gold' WHERE id=$usuario->id");
				mysql_query("UPDATE units SET merchants=$merchants, untrained = $untrained WHERE id_usuario = $usuario->id");
				echo '<script type="text/javascript">'
				   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
				   , '</script>';
			}
			else echo "<div class='no-gold'>Not enough trained units to untrain</div>";
		}
		else echo "<div class='no-gold'>Not enough gold</div>";
	}
else if(isset($_POST['heal_injured'])){
		$costo = $_POST['heal_injured'] * injured_cost;
		$gold = $usuario->gold;
		if ($gold>=$costo){
			if ($injured>=$_POST['heal_injured']){
				$gold  = $gold - $costo;
				$injured -= $_POST['heal_injured'];
				$untrained += $_POST['heal_injured'];
				mysql_query("UPDATE usuarios SET gold='$gold' WHERE id=$usuario->id");
				mysql_query("UPDATE units SET injured=$injured, untrained = $untrained WHERE id_usuario = $usuario->id");
				echo '<script type="text/javascript">'
				   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
				   , '</script>';
			}
			else echo "<div class='no-gold'>Not enough injured units to heal</div>";
		}
		else echo "<div class='no-gold'>Not enough gold</div>";
	}
echo
"<div class='tips'>
<span class=''>Untrained</span> units are weak both for attacking and defending.<br />
<span class=''>Berserkers</span> have high Attack Strength but provide low Defense.<br />
<span class=''>Paladins</span> are better at defending than attacking.<br />
<span class=''>Merchants</span> provide no combat bonus but a big Income bonus<br />
</div>";

echo //Current 
"<table class='stats table'>
<tr class='$racestyle'>
<th class='titulo' colspan='4'>Current Units</th>
</tr>
<tr class='impar'>
<th width='25%'>Type</th><th width='25%'>Units</th><th width='25%'>Attack Strength</th><th width='25%'>Defense Strength</th>
</tr>
<tr class='par'>
<td>Untrained</td><td>$untrained</td><td>".untrained_atk*$untrained."</td><td>".untrained_def*$untrained."</td>
</tr>
<tr class='impar'>
<td>Berserkers</td><td>$berserkers</td><td>".berserkers_atk*$berserkers."</td><td>".berserkers_def*$berserkers."</td>
</tr>
<tr class='par'>
<td>Paladins</td><td>$paladins</td><td>".paladins_atk*$paladins."</td><td>".paladins_def*$paladins."</td>
</tr>
<tr class='impar'>
<td>Merchants</td><td>$merchants</td><td>".merchants_atk*$merchants."</td><td>".merchants_def*$merchants."</td>
</tr>
<tr class='par'>
<td>Injured</td><td>$injured</td><td>".injured_atk*$injured."</td><td>".injured_def*$injured."</td>
</tr>
</table>";

echo //Train
"
<table class='stats'>
<tr class='$racestyle'>
<th class='titulo' colspan='4'>Train Units</th>
</tr>
<tr class='impar'>
<th width='25%'>Type</th><th width='25%'>Cost</th><th width='25%'>Quantity</th><th width='25%'>Train</th>
</tr>
<form action='".$_SERVER['PHP_SELF']."' name='berserkers' method='post'> 
<tr class='par'>
<td>Berserkers</td><td>".berserker_cost."</td><td><input size='6' type='text' name='quantity_berserkers'/></td><td><input type='submit' class='button black small' value='Train' name='submit'></td>
</tr></form>
<form action='".$_SERVER['PHP_SELF']."' name='paladins' method='post'>
<tr class='impar'>
<td>Paladins</td><td>".paladin_cost."</td><td><input size='6' type='text' name='quantity_paladins'/></td><td><input type='submit' class='button black small' value='Train' name='submit'></td>
</tr></form>
<form action='".$_SERVER['PHP_SELF']."' name='merchants' method='post'>
<tr class='par'>
<td>Merchants</td><td>".merchants_cost."</td><td><input size='6' type='text' name='quantity_merchants'/></td><td><input type='submit' class='button black small' value='Train' name='submit'></td>
</tr></form>
</table>
"; //"htmlentities($_SERVER['PHP_SELF'])"

echo  //Untrain
"
<table class='stats'>
<tr class='$racestyle'>
<th class='titulo' colspan='4'>Untrain Units</th>
</tr>
<tr class='impar'>
<th width='25%'>Type</th><th width='25%'>Cost</th><th width='25%'>Quantity</th><th width='25%'>Train</th>
</tr>
<form action='".$_SERVER['PHP_SELF']."' name='berserkers' method='post'>
<tr class='par'>
<td>Berserkers</td><td>".untrain_cost."</td><td><input size='6' type='text' name='untrain_berserkers'/></td><td><input type='submit' class='button black small' value='Untrain' name='submit'></td>
</tr></form>
<form action='".$_SERVER['PHP_SELF']."' name='paladins' method='post'>
<tr class='impar'>
<td>Paladins</td><td>".untrain_cost."</td><td><input size='6' type='text' name='untrain_paladins'/></td><td><input type='submit' class='button black small' value='Untrain' name='submit'></td>
</tr></form>
<form action='".$_SERVER['PHP_SELF']."' name='merchants' method='post'>
<tr class='par'>
<td>Merchants</td><td>".untrain_cost."</td><td><input size='6' type='text' name='untrain_merchants'/></td><td><input type='submit' class='button black small' value='Untrain' name='submit'></td>
</tr></form>
</table>
";
echo  //Heal Injured
"
<table class='stats'>
<tr class='$racestyle'>
<th class='titulo' colspan='4'>Heal injured</th>
</tr>
<tr class='impar'>
<th width='25%'>Type</th><th width='25%'>Cost</th><th width='25%'>Quantity</th><th width='25%'>Heal</th>
</tr>
<form action='".$_SERVER['PHP_SELF']."' name='injured' method='post'>
<tr class='par'>
<td>Injured</td><td>".injured_cost."</td><td><input size='6' type='text' name='heal_injured'/></td><td><input type='submit' class='button black small' value='Heal' name='submit'></td>
</tr></form>
</table>
";
}
else {

}
//".$_SERVER['PHP_SELF']."
?>