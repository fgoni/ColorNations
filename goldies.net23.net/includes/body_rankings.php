<?php
/*
Creo dos arrays en REGLAS.PHP y los paso por referencia a una función que los modifica, agregandole los valores actuales de los rankings de cada stat.
Recién ahí puedo hacer las llamadas a  getRank().
Habría que ver como hacer para pasarlo a un CRON (la actualización de rankings), para minimizar el abuso de queries.
*/
$sql = mysql_query("SELECT * FROM usuarios WHERE usuario='".$_SESSION['nombre']."'");
$usuario = mysql_fetch_object($sql);
if (isset($_SESSION['userid'])){
	echo "
	<table width='200px' class='stats table'>
	<tr class='$racestyle'>
	<th colspan='2'>Overall Rank</th>
	</tr>
	<tr class='par'><td colspan='2'>".getRank($usuario->id)->overall_rank."</td></tr>
	<tr class='$racestyle'>
	<th>Attack</th><th>Rank</th>
	</tr>
	<tr class='impar'><td>".formatNum(calcularAttack($usuario))."</td><td width='50%'>".getRank($usuario->id)->attack_rank."</td></tr>
	<tr class='$racestyle'>
	<th>Defense</th><th>Rank</th>
	</tr>
	<tr class='par'><td>".formatNum(calcularDefense($usuario))."</td><td width='50%'>".getRank($usuario->id)->defense_rank."</td></tr>
	</table>";
}
else {
	//Ranking general
}
?>