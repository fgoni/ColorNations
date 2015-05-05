<?php
	//Game Constants
	echo "<h2>Game Constants</h2>";
	echo "
	<table class='stats'>
	<tr class='impar'>
	<th class='$racestyle' colspan='4'>Economics</th>
	</tr>
	<tr class='par'>
	<td width='60%'>Unit Replication Frequency</td><td>".unit_freq." hours</td>
	</tr>
	<tr class='impar'>
	<td>Income Frequency</td><td>".income_freq." minutes</td>
	</tr>
	</table>";
	//Combat Techs
	echo "
	<table class='stats'>
	<tr class='impar'>
	<th class='$racestyle' colspan='4'>Combat Technologies</th>
	</tr>
	<tr class='par'>
	<td width='60%'>Siege Modifier</td><td>".(100*atk_percent)."%</td>
	</tr>
	<tr class='impar'>
	<td>Fortification Modifier</td><td>".(100*def_percent)."%</td>
	</tr>
	</table>
	";
	//Units
	echo "
	<table class='stats'>
	<tr class='impar'>
	<th class='$racestyle' colspan='4'>Unit Values</th>
	</tr>
	<tr class='par'>
	<td width='25%'>Type</td><td width='25%'>Attack Strength</td><td width='25%'>Defense Strength</td><td width='25%'>Income</td>
	</tr>
	<tr class='impar'>
	<td>Untrained</td><td>".untrained_atk."</td><td>".untrained_def."</td><td>".untrained_income."</td>
	</tr>
	<tr class='par'>
	<td>Berserkers</td><td>".berserkers_atk."</td><td>".berserkers_def."</td><td>".berserkers_income."</td>
	</tr>
	<tr class='impar'>
	<td>Paladins</td><td>".paladins_atk."</td><td>".paladins_def."</td><td>".paladins_income."</td>
	</tr>
	<tr class='par'>
	<td>Merchants</td><td>".merchants_atk."</td><td>".merchants_def."</td><td>".merchants_income."</td>
	</tr>
	</table>
	";
?>