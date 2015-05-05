<?php
//SI SE INICIO SESIÓN
if (isset($_SESSION['userid'])){
	$sql = mysql_query("SELECT * FROM usuarios WHERE usuario='".$_SESSION['nombre']."'");
	$usuario = mysql_fetch_object($sql);
	$units = getUnits($usuario);
	$tff  = getTFF($units);
	if ($usuario->race == 0) $units_type = constant('string_race0');
	else if ($usuario->race == 1) $units_type = constant('string_race1');
	else if ($usuario->race == 2) $units_type = constant('string_race2');
	else if ($usuario->race == 3) $units_type = constant('string_race3');
		echo "<h2>$_SESSION[nombre]'s Headquarters</h2>";
	//Acá me fijo si se realizó un cambio de raza, y muestro un mensaje
		if(isset($_POST['submit'])){
		$newrace = $_POST['race'];
		$valido = false;
			switch ($newrace){
				case 0:
				case 1:
				case 2:
				case 3: 
					$valido = true;
					break;
				default:
					$newrace = null;
			}
			if ($valido){
				if ($usuario->racechanges > 0){
					if ($newrace!=$usuario->race){
						$racechanges = $usuario->racechanges - 1;
						setRace($newrace);
						$sql = mysql_query("UPDATE usuarios SET race='$newrace', racechanges='$racechanges' WHERE id='$usuario->id'");
						if (!$sql){
							echo "<div class='error'>There was an error on the database query";
						}
						else {
							echo "<div class='exito'>Your race has been changed succesfully! <br/>
							Refreshing site for visual updates in 5 seconds...";
							header("refresh: 5; url=..$_SERVER[PHP_SELF]");
						}
					}
					else echo "<div class='error'>You can't choose your current race!";
				}
				else {
					echo "<div class='error'>You have no more race changes this season";
				}
			}
			else {
				echo "<div class='error'>The new race value was invalid";
			}
			echo "</div>";
		}
		//Aca arrancan las tablas que muestran las estadisticas del jugador.
		echo "<table class='stats table'>";
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
	        echo "<td>".$tff." ".$units_type."</td>";
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
        
	$untrained = $units->untrained;
	$berserkers = $units->berserkers;
	$paladins = $units->paladins;
	$merchants = $units->merchants;
	$injured = $units->injured;
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
	<tr class='par'>
	<td>Injured</td><td>$injured</td><td>".injured_atk*$injured."</td><td>".injured_def*$injured."</td>
	</tr>
	</table>";
	echo "
	<form action='".$_SERVER['PHP_SELF']."' method='post' name='changerace'>
	<table class='changerace'>
	<tr class='$racestyle'>
		<th class='impar' colspan='2'>Change Tribe</th>
	</tr>
	<tr class='impar'>
		<td class='par'><div><label for='race'>New tribe:</label>
        <select name='race' id='race'>
            <option value='0' ".(isset($_POST['reds']) ? 'selected' : '').">Reds</option>
            <option value='1' ".(isset($_POST['greens'])  ? 'selected' : '').">Greens</option>
            <option value='2' ".(isset($_POST['blues'])  ? 'selected' : '').">Blues</option>
            <option value='3' ".(isset($_POST['oranges'])  ? 'selected' : '').">Oranges</option>
        </select>
        </div></td>
        <td>Changes left: $usuario->racechanges</td>
	</tr>
	<tr class='par'>
	<td colspan='2'><input type='submit' class='button black small' value='Change Tribe' name='submit'></td>
	</tr>
	</table>
	</form>
	";
}

?>