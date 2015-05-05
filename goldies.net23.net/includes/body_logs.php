<?php
$par = false;
$attacks = mysql_query("SELECT * from logs where attacker_id='".$_SESSION['userid']."' ORDER BY date DESC LIMIT 0,20");
$defenses = mysql_query("SELECT * from logs where defender_id='".$_SESSION['userid']."' ORDER BY date DESC LIMIT 0,20");
echo "
<table class='logs table'>
<tr class='$racestyle'>
<th colspan='7'>Attacks</th>
</tr>
<tr class='".($par ? 'par' : 'impar')."'>
<th width='100px'>Date</th><th>Enemy</th><th>Result</th><th>Your damage</th><th>Enemy damage</th><th width='20px'>Your injured</th><th width='20px'>Enemy injured</th>
</tr>";
while ($row = mysql_fetch_object($attacks)){
	$par ? $par = false : $par = true;
	if ($row->attacker_dmg < $row->defender_dmg) $result = 'Lost'; //Me fijo si ganó o no.
	else $result = formatNum($row->result)." ".constant('string_moneda')." won";  //Formateo si perdió.
	$sql = mysql_query("SELECT id, usuario FROM usuarios WHERE id='".$row->defender_id."'"); //Busco al enemigo en la BDD para mostrar un link en el log.
	$enemy = mysql_fetch_object($sql);
	echo "<tr class='".($par ? 'par' : 'impar')."'><td>$row->date</td><td><a href='../stats.php?id=$enemy->id'>$enemy->usuario</a></td><td>$result</td><td>",formatNum($row->attacker_dmg),"</td><td>",formatNum($row->defender_dmg),"</td><td>$row->attacker_losses</td><td>$row->defender_losses</td></tr>";
}
echo "
</table>
<br />
<br />";

echo "
<table class='logs'>
<tr class='$racestyle'>
<th colspan='7'>Defenses</th>
</tr>
<tr class='".($par ? 'par' : 'impar')."'>
<th width='100px'>Date</th><th>Enemy</th><th>Result</th><th>Your damage</th><th>Enemy damage</th><th width='20px'>Your injured</th><th width='20px'>Enemy injured</th>
</tr>";

while ($row = mysql_fetch_object($defenses)){
	$par ? $par = false : $par = true; //Formateo las filas
	if ($row->defender_dmg > $row->attacker_dmg) $result = 'Defended'; //Me fijo si defendió o no el ataque.
	else $result = formatNum($row->result)." ".constant('string_moneda')." lost";  //Formateo si perdió.
	$sql = mysql_query("SELECT id, usuario FROM usuarios WHERE id='".$row->attacker_id."'"); //Busco al enemigo en la BDD para mostrar un link en el log.
	$enemy = mysql_fetch_object($sql);
	echo "<tr class='".($par ? 'par' : 'impar')."'><td>$row->date</td><td><a href='../stats.php?id=$enemy->id'>$enemy->usuario</a></td><td>$result</td><td>",formatNum($row->defender_dmg),"</td><td>",formatNum($row->attacker_dmg),"</td><td>$row->defender_losses</td><td>$row->attacker_losses</td></tr>";
}

echo "
</table>
";

?>