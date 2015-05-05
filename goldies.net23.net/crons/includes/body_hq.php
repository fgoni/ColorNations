<?php
if (isset($_SESSION['userid'])){
	$sql = mysql_query("SELECT * FROM usuarios WHERE usuario='".$_SESSION['nombre']."'");
	$usuario = mysql_fetch_object($sql);
	if ($usuario->race == 0) $units_type = constant('string_race0');
	else if ($usuario->race == 1) $units_type = constant('string_race1');
	else if ($usuario->race == 2) $units_type = constant('string_race2');
	else if ($usuario->race == 3) $units_type = constant('string_race3');
		echo "<h2>$_SESSION[nombre]'s Headquarters</h2>";
		echo "<table class='stats'>";
		echo "<th class='titulo $racestyle' colspan='2'>Stats</th>";
	    echo "<tr class='impar'>";
	        echo "<td><strong>".constant('string_siege')."</strong></td>";
	        echo "<td>".$tech_siege[$usuario->siege]." (*".currentAtkBonus($usuario->siege).")</td>";
	  	echo "</tr>";
	    echo "<tr class='par'>";
	    	echo "<td width='40%'><strong>".constant('string_fort')."</strong></td>";
	        echo "<td>".$tech_fort[$usuario->fort]." (*".currentDefBonus($usuario->fort).")</td>";
	    echo "</tr>";
	  	echo "<tr class='impar'>";
	        echo "<td><strong>".constant('string_unitprod')."</strong></td>";
	        echo "<td>".$tech_replication[$usuario->unitprod]." units every ".unit_freq.(unit_freq > 1  ? " hours" : " hour")."</td>";
	    echo "</tr>";
	    echo "<tr class='par'>";
	        echo "<td><strong>".constant('string_units')."</strong></td>";
	        echo "<td>".$usuario->units." ".$units_type."</td>";
        echo "</tr>";
       	echo "<tr class='impar'>";
	        echo "<td><strong>".constant('string_oro')."</strong></td>";
	        echo "<td>".formatNum($usuario->gold). " ".constant('string_moneda')."</td>";
        echo "</tr>";
        echo "<tr class='par'>";
	        echo "<td><strong>".constant('string_income')."</strong></td>";
	        echo "<td>".formatNum(calcularIncome($usuario))." ".constant('string_moneda')." every ".income_freq.(income_freq > 1  ? " minutes" : " minute")."</td>";
        echo "</tr>";
        echo "<tr class='impar'>";
	        echo "<td><strong>".constant('string_attack')."</strong></td>";
	        echo "<td>".formatNum(calcularAttack($usuario))."</td>";
        echo "</tr>";
        echo "<tr class='par'>";
	        echo "<td><strong>".constant('string_defense')."</strong></td>";
	        echo "<td>".formatNum(calcularDefense($usuario))."</td>";
        echo "</tr>";
        echo "</table>";
        
	$untrained = $usuario->units - $usuario->berserkers - $usuario->paladins - $usuario->merchants;
	$berserkers = $usuario->berserkers;
	$paladins = $usuario->paladins;
	$merchants = $usuario->merchants;
	echo 
	"<table class='stats'>
	<tr>
	<th class='titulo $racestyle' colspan='4'>Current Units</th>
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
}

?>