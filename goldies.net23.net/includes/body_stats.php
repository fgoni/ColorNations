<?php
if (isset($_GET['id'])){
	$sql = mysql_query("SELECT * FROM usuarios WHERE id='".$_GET['id']."'");
	if (mysql_num_rows($sql)>0){
		$usuario = mysql_fetch_object($sql);
		$nombre = $usuario->usuario;
		$gold = formatNum($usuario->gold); //Función interna
		$fort = $tech_fort[$usuario->fort];
		$units = formatNum(getTFF(getUnits($usuario))); //Función interna
		$units_type = 'units';
		if ($usuario->race == 0) $units_type = $racestats = constant('string_race0');
			else if ($usuario->race == 1) $units_type = $racestats = constant('string_race1');
			else if ($usuario->race == 2) $units_type = $racestats = constant('string_race2');
			else if ($usuario->race == 3) $units_type = $racestats = constant('string_race3');

		echo 
		"<table class='stats table'>
		<tr>
		<th class='$racestats' width='100%' colspan='2'>$nombre</td>
		</tr>
		<tr class='impar'>
		<td class='titulo' width='30%'>".constant('string_fort')."</td><td>$fort</td>
		</tr>
		<tr class='par'>
		<td class='titulo' width='30%'>".constant('string_units')."</td><td>$units $units_type</td>
		</tr>
		<tr class='impar'>
		<td class='titulo' width='30%'>".constant('string_oro')."</td><td>$gold ".constant('string_moneda')."</td>
		</tr>
		<tr class='impar'>
		<td class='boton' colspan='2'><a href='battle.php?id=$usuario->id'><button class='button medium black'>Attack</button></a></td>
		</tr>
		</table>";
	}
	else {
		echo "<h3>No existe un usuario con ese ID</h3>";
	}
}
?>