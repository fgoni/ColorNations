<?php
include('../includes/connect.php');
include('../includes/reglas.php');
$sql = mysql_query("select * from usuarios");
while ($row = mysql_fetch_object($sql)){
	$untrained = $row->units - $row->berserkers - $row->paladins - $row->merchants - $row->injured;
	$result = mysql_query("select 1 from units where id_usuario = $row->id");
	if (mysql_num_rows($result)>0){
		$update = "update units set untrained = $untrained, injured = $row->injured, berserkers = $row->berserkers, paladins = $row->paladins, merchants = $row->merchants where id_usuario = $row->id";
		$update = mysql_query($update);
	}
	else {
		$insert = "insert into units (id_usuario, untrained, injured, berserkers, paladins, merchants) values ($row->id, $untrained, $row->injured, $row->berserkers, $row->paladins, $row->merchants)";
		$insert = mysql_query($insert);	
	}

}
?>