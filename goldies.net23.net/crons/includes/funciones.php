<?php
function calcularIncome($usuario){
	$untrained = $usuario->units - $usuario->berserkers - $usuario->paladins - $usuario->merchants;
	$income = $untrained*untrained_income + $usuario->berserkers*berserkers_income + $usuario->paladins*paladins_income + $usuario->merchants*merchants_income;
	if ($usuario->race == 2) $income = $income*1.2;
	return $income;
}
function calcularAttack($usuario){
	$units = $usuario->units;
	$berserkers = $usuario->berserkers;
	$paladins = $usuario->paladins;
	$untrained = $units - $berserkers - $paladins;
	$force = ($untrained*$GLOBALS['untrained_atk'])+($berserkers*$GLOBALS['berserkers_atk'])+($paladins*$GLOBALS['paladins_atk']);
	$siege = $usuario->siege;
	$attack = $force*currentAtkBonus($siege);
	if ($usuario->race == 0) $attack = $attack * 1.25;
	return round($attack,0);
}
function calcularDefense($usuario){
	$units = $usuario->units;
	$berserkers = $usuario->berserkers;
	$paladins = $usuario->paladins;
	$untrained = $units - $berserkers - $paladins;
	$force = ($untrained*$GLOBALS['untrained_def'])+($berserkers*$GLOBALS['berserkers_def'])+($paladins*$GLOBALS['paladins_def']);
	$fort = $usuario->fort;
	$defense = $force*currentDefBonus($fort);
	if ($usuario->race == 1) $defense = $defense * 1.25;
	return round($defense,0);
}
function formatNum($num){
	return number_format($num,0,",",".");
}
function currentAtkBonus($final){
	if ($final!=0){
		return round(currentAtkBonus($final-1)*(1+$GLOBALS['atk_percent']),2);
	}
	else return 1;
}
function currentDefBonus($final){
	if ($final!=0){
		return round(currentDefBonus($final-1)*(1+$GLOBALS['def_percent']),2);
	}
	else return 1;
}
//current_bonus*(1+$GLOBALS['atk_percent']));
?>
