<?php
if (isset($_SESSION['userid'])){
	$sql = mysql_query("SELECT * FROM usuarios WHERE usuario='".$_SESSION['nombre']."'");
	$usuario = mysql_fetch_object($sql);
	$gold = $usuario->gold;
	$siege = $usuario->siege;
	$fort = $usuario->fort;
	$replication = $usuario->unitprod;
	echo "<h2>$_SESSION[nombre]'s Technologies</h2>";
	if (isset($_POST['upgrade-siege']))
	{
		$costo = preg_replace('/\D/', '', $_POST['upgrade-siege']);
		if ($gold >= $costo and $siege < $GLOBALS['max_siege']){
			echo "<div class='exito'>Upgrade succesful!</div>";
			$gold = $gold - $costo;
			$sql = mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE usuario='".$_SESSION['nombre']."'");
			$sql = mysql_query("UPDATE usuarios SET siege='".($siege+1)."' WHERE usuario='".$_SESSION['nombre']."'");
			$siege++;
			echo '<script type="text/javascript">'
			   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
			   , '</script>';
		}
		else{
			echo "<div class='no-gold'>No tienes suficiente oro para esa acción</div>";
		}
	}
	else if (isset($_POST['upgrade-fort'])){
		$costo = preg_replace('/\D/', '', $_POST['upgrade-fort']);
		if ($gold >= $costo and $fort < $GLOBALS['max_fort']){
			echo "<div class='exito'>Upgrade succesful!</div>";
			$gold = $gold - $costo;
			$sql = mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE usuario='".$_SESSION['nombre']."'");
			$sql = mysql_query("UPDATE usuarios SET fort='".($fort+1)."' WHERE usuario='".$_SESSION['nombre']."'");
			$fort++;
			echo '<script type="text/javascript">'
			   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
			   , '</script>';
		}
		else{
			echo "<div class='no-gold'>No tienes suficiente oro para esa acción</div>";
		}
	}
	else if(isset($_POST['upgrade-repli'])){
		$costo = preg_replace('/\D/', '', $_POST['upgrade-repli']);
		if ($gold >= $costo and $replication < $GLOBALS['max_repli']){
			echo "<div class='exito'>Upgrade succesful!</div>";
			$gold = $gold - $costo;
			$sql = mysql_query("UPDATE usuarios SET gold='".$gold."' WHERE usuario='".$_SESSION['nombre']."'");
			$sql = mysql_query("UPDATE usuarios SET unitprod='".($replication+1)."' WHERE usuario='".$_SESSION['nombre']."'");
			$replication++;
			echo '<script type="text/javascript">'
			   , 'changeValue("oro","'.constant('string_oro').": ".formatNum($gold)." ".constant('string_moneda').'");'
			   , '</script>';
		}
		else{
			echo "<div class='no-gold'>No tienes suficiente oro para esa acción</div>";
		}
	}
	($usuario->race == 3) ? $mod = 0.8 : $mod = 1;
	$next_siege = ($siege+1<=$GLOBALS['max_siege']) ? $tech_siege[$siege+1]." (*".currentAtkBonus($siege+1).")" : "No more upgrades";
	$next_siege_button = ($siege+1<=$GLOBALS['max_siege']) ? "<input class='button black small' type='Submit' name='upgrade-siege' value='".formatNum($value_siege[$siege+1]*$mod)." ".constant('string_moneda')."'/>" : "No more upgrades";
	$next_fort = ($fort+1<=$GLOBALS['max_fort']) ? $tech_fort[$fort+1]." (*".currentDefBonus($fort+1).")" : "No more upgrades";
	$next_fort_button = ($fort+1<=$GLOBALS['max_fort']) ? "<input class='button black small' type='Submit' name='upgrade-fort' value='".formatNum($value_fort[$fort+1]*$mod)." ".constant('string_moneda')."'/>" : "No more upgrades";
	$next_repli = ($replication+1<=$GLOBALS['max_repli']) ? $tech_replication[$replication+1]." Units every 6 hours" : "No more upgrades";
	$next_repli_button = ($replication+1<=$GLOBALS['max_repli']) ? "<input class='button black small' type='Submit' name='upgrade-repli' value='".formatNum($value_repli[$replication+1]*$mod)." ".constant('string_moneda')."'/>" : "No more upgrades";

	echo "<form name='techs' method='post' action='".$_SERVER['PHP_SELF']."'>
	<table class='stats'>
	<th class='titulo $racestyle' colspan='3'>Siege Technology</td>
	<tr class='impar'>
	<th>Current Siege Tech</th><th>Upgrade</th><th>Next Siege Tech</th>
	</tr>
	<tr class='par'>
	<td width='33%'>".$tech_siege[$siege]." (*".currentAtkBonus($siege).")</td><td width='34%'>".$next_siege_button."</td><td width='33%'>".$next_siege."</td>
	<tr/>
	<th class='titulo $racestyle' colspan='3'>Fortification</td>
	<tr class='impar'>
	<th>Current Fortification Tech</th><th>Upgrade</th><th>Next Fortification</th>
	</tr>
	<tr class='par'>
	<td >".$tech_fort[$fort]." (*".currentDefBonus($fort).")</td><td>".$next_fort_button."</td><td>".$next_fort."</td>
	<tr/>
	<th class='titulo $racestyle' colspan='3'>Unit Replication</td>
	<tr class='impar'>
	<th>Current Replication Tech</th><th>Upgrade</th><th>Next Replication Tech</th>
	</tr>
	<tr class='par'> 
	<td>".$tech_replication[$replication]." Units every 6 hours</td><td>".$next_repli_button."</td><td>".$next_repli."</td>
	<tr/>
	</table>
	</form>";

}

?>