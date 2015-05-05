<?php
if (!isset($_SESSION['userid'])){
?>
	<h1>Welcome to Color Nations!</h1>
	<div class='index'>
		<p>In this game, you manage an army from one of the four color tribes, and your aim is to be the strongest leader at the end of the Season.</p>
		<p>To start, choose one of the tribes with a bonus that most suit your playstyle (be it aggresive, defensive or a bit of both), and start building up a sizeable and powerful Nation!</p>
	</div>
<div><form action="registrar.php" name="form_index" method="post">
<table class="index">
<tr>
<th class="brown" colspan="4">Choose one of the tribes to join them in battle!</th>
</tr>
<tr class="brown">
<th width="25%"><?php echo $bonus_rojos; ?></th><th width="25%"><?php echo $bonus_verdes; ?></th><th width="25%"><?php echo $bonus_azules; ?></th><th width="25%"><?php echo $bonus_naranjas;?></th>
</tr>
<tr>
<td class="reds"><input class="button medium red" type="submit" name="reds" value="Reds" /></td>
<td class="greens"><input class="button medium green" type="submit" name="greens" value="Greens" /></td>
<td class="blues"><input class="button medium blue" type="submit" name="blues" value="Blues" /></td>
<td class="oranges"><input class="button medium orange" type="submit" name="oranges" value="Oranges" /></td>
</tr>
</table>
</form>
</div>

<?php	
}
else{
	$sql  = mysql_query("SELECT 1 FROM usuarios");
	$rows = mysql_num_rows($sql) - 1;
	echo "
	<h1>Welcome to Color Nations!</h1>
	<div class='index'>
	<p>The current Season is:<span class='won'> ".season."</span>.</p>
	<p>There ".($rows > 1 ? "are" : "is")." <span class='won'>$rows</span> other ".($rows > 1 ? "Nations" : "Nation")." in the Battlefield. </p>
	</div>
	";
}
?>
<div class='index'>
	<h2>News</h2>
	<?php
	echo generarNoticia("19/06/2013", "Battles now inccur casualties upon the soldiers. You can heal them at Training page.");
	echo generarNoticia("18/06/2013", "Added Overall Rank: Orders by lowest Rank total, then highest Attack and Defense combined. Rankings update every 30 minutes.");
	echo generarNoticia("18/06/2013", "Added 5% of interest every 12 hours on Deposited ".string_moneda."");
	echo generarNoticia("14/06/2013", "Added Economy page, aimed to save the ".string_moneda." leftovers before logging out");
	echo generarNoticia("11/06/2013", "Enabled Change Race feature, set to 2 per account per season, available at Headquarters");
	echo generarNoticia("10/06/2013", "Logs added, up to 40 battles saved");
	echo generarNoticia("09/06/2013", "Unit Production doubled");
	echo generarNoticia("09/06/2013", "Rankings page added");
	?>
</div>