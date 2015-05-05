<?php
$sql = mysql_query("SELECT * FROM usuarios");
$par = 'impar';
echo "<h2>Battlefield</h2>";
echo "<table class='stats'>
	<tr class='$racestyle'>
	<th colspan='4'>Nations</th>
	</tr>
	<tr class='$par'>
	<th width='20%'>User</th><th width='20%'>".constant('string_oro')."</th><th width='20%'>".constant('string_fort')."</th><th width='20%'>".constant('string_units')."</th>
	</th>
	</tr>";
while ($usuario = mysql_fetch_object($sql)){
	$nombre = $usuario->usuario;
	$gold = formatNum($usuario->gold); //Función interna
	$fort = $tech_fort[$usuario->fort];
	$units = formatNum($usuario->units); //Función interna
	$id = $usuario->id;
	($par=='par') ? ($par = 'impar') : ($par = 'par');
	if ($usuario->race == 0) $units_type = constant('string_race0');
		else if ($usuario->race == 1) $units_type = constant('string_race1');
		else if ($usuario->race == 2) $units_type = constant('string_race2');
		else if ($usuario->race == 3) $units_type = constant('string_race3');
	echo
	"<tr class='$par'>
	<td><a href='../stats.php?id=$id'>$nombre</a></td> <td>$gold ".constant('string_moneda')."</td> <td>$fort</td> <td>$units $units_type</td>
	</tr>
	";
	}
echo "</table>";
?>
