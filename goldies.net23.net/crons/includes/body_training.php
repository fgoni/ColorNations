<?php
if (isset($_SESSION['userid'])){

/*$sql = mysql_query("SELECT * FROM usuarios WHERE usuario = '".$_SESSION['nombre']."'");
$usuario = mysql_fetch_object($sql);*/
$untrained = $usuario->units - $usuario->berserkers - $usuario->paladins -$usuario->merchants;
$berserkers = $usuario->berserkers;
$paladins = $usuario->paladins;
$merchants = $usuario->merchants;
echo "<h2>$_SESSION[nombre]'s Training camp</h2>";
if (isset($_POST['quantity_berserkers'])){
		$costo = $_POST['quantity_berserkers'] * $GLOBALS['berserker_cost'];
		$gold = $usuario->gold;
		if ($gold>=$costo){
			if ($untrained>=$_POST['quantity_berserkers']){
				$gold  = $gold - $costo;
				$berserkers = $berserkers + $_POST['quantity_berserkers'];
				mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE usuario='".$_SESSION['nombre']."'");
				mysql_query("UPDATE usuarios SET berserkers='".$berserkers."' WHERE usuario='".$_SESSION['nombre']."'");
				$untrained = $usuario->units - $berserkers - $paladins - $merchants;
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
				$paladins = $paladins + $_POST['quantity_paladins'];
				$sql = mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE usuario='".$_SESSION['nombre']."'");
				$sql = mysql_query("UPDATE usuarios SET paladins='".$paladins."' WHERE usuario='".$_SESSION['nombre']."'");
				$untrained = $usuario->units - $berserkers - $paladins - $merchants;
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
				$merchants = $merchants + $_POST['quantity_merchants'];
				$sql = mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE usuario='".$_SESSION['nombre']."'");
				$sql = mysql_query("UPDATE usuarios SET merchants='".$merchants."' WHERE usuario='".$_SESSION['nombre']."'");
				$untrained = $usuario->units - $berserkers - $paladins - $merchants;
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
				$berserkers = $berserkers - $_POST['untrain_berserkers'];
				$sql = mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE usuario='".$_SESSION['nombre']."'");
				$sql = mysql_query("UPDATE usuarios SET berserkers='".$berserkers."' WHERE usuario='".$_SESSION['nombre']."'");
				$untrained = $usuario->units - $berserkers - $paladins - $merchants;
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
				$sql = mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE usuario='".$_SESSION['nombre']."'");
				$sql = mysql_query("UPDATE usuarios SET paladins='".$paladins."' WHERE usuario='".$_SESSION['nombre']."'");
				$untrained = $usuario->units - $berserkers - $paladins - $merchants;
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
				$sql = mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE usuario='".$_SESSION['nombre']."'");
				$sql = mysql_query("UPDATE usuarios SET merchants='".$merchants."' WHERE usuario='".$_SESSION['nombre']."'");
				$untrained = $usuario->units - $berserkers - $paladins - $merchants;
				echo '<script type="text/javascript">'
				   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
				   , '</script>';
			}
			else echo "<div class='no-gold'>Not enough trained units to untrain</div>";
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
"<table class='stats'>
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
}
else {

}
//".$_SERVER['PHP_SELF']."
?>