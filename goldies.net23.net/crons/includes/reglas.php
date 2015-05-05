<?php
function generateValues($starting, $first, $times, $modifier = 2){
	$aux;
	for ($i = 0; $i<$times; $i++){
		if ($i != 0){
			if ($i != 1)	$aux[$i] = $aux[$i-1]*$modifier;
			else $aux[$i] = $first;
		}
		else $aux[$i] = $starting;
	}
	return $aux;
}
$GLOBALS['siege'] = 0;
$GLOBALS['fort'] = 0;
$GLOBALS['unitprod'] = 0;
$GLOBALS['units'] = 30;
$GLOBALS['gold'] = 300;
$GLOBALS['unit_freq']  = 12;
$GLOBALS['income_freq'] = 30;
$GLOBALS['atk_percent'] = 0.25;
$GLOBALS['def_percent'] = 0.28;

define ('atk_percent',0.25);
define ('def_percent',0.28);
define ('income_freq',30);
define ('unit_freq',12);

$tech_siege = array("None", "Sticks", "Spears", "Chariots", "War Galleys", "Battering Rams", "Siege Towers","Triremes","Ballistae", "Greek Fire", "Trebuchets", "Catapults", "Cannons", "Big Bertha", "Rockets", "ATG Missiles", "Nukes");
$value_siege = generateValues(0, 100, count($tech_siege));
$tech_fort = array("None", "Palisade", "Stone Walls", "Battlements", "Bastion", "Towers", "Moat", "Stronghold", "Citadel", "Trenches", "Fortress", "Bunker", "Shelter", "AEGIS System", "Force Field");
$value_fort = generateValues(0,100,count($tech_fort));
$tech_replication = generateValues(1,2,14);//8192, 32k por dia. 10m upgrade.
$value_repli = generateValues(0,40,count($tech_replication),3);//array(0,20,60,180,540,1620,4860,14580,43740,131220,393660);
$GLOBALS['max_siege'] = count($tech_siege)-1;
$GLOBALS['max_fort'] = count($tech_fort)-1;
$GLOBALS['max_repli'] = count($tech_replication)-1;
$bonus_rojos = "25% Attack Strength";
$bonus_verdes = "25% Defense Strength";
$bonus_azules = "20% Extra Income";
$bonus_naranjas = "20% Cheaper Upgrades";
$racestyle = "";
$site_name = "Color Nations";

$GLOBALS['untrained_atk'] = 4;
$GLOBALS['untrained_def'] = 4;
$GLOBALS['untrained_income'] = 4;
$GLOBALS['berserkers_atk'] = 9;
$GLOBALS['berserkers_def'] = 1;
$GLOBALS['berserkers_income'] = 4;
$GLOBALS['paladins_atk'] = 3;
$GLOBALS['paladins_def'] = 7;
$GLOBALS['paladins_income'] = 4;

$GLOBALS['berserker_cost'] = 50;
$GLOBALS['paladin_cost'] = 50;
$GLOBALS['untrain_cost'] = 10;

//CONSTANTES
define ('string_oro', 'Treasure');
define ('string_moneda', 'gold');
define ('string_units', 'Army');
define ('string_fort', 'Fortification');
define ('string_siege', 'Siege');
define ('string_unitprod', 'Unit Replication');
define ('string_attack', 'Attack Strength');
define ('string_defense', 'Defense Strength');
define ('string_income', 'Income');

define ('string_race0', 'reds');
define ('string_race1', 'greens');
define ('string_race2',  'blues');
define ('string_race3', 'oranges');

define ('untrained_atk', 4);
define ('untrained_def', 4);
define ('untrained_income', 4);
define ('berserkers_atk', 9);
define ('berserkers_def', 1);
define ('berserkers_income', 4);
define ('paladins_atk', 3);
define ('paladins_def', 7);
define ('paladins_income', 4);
define ('berserker_cost',50);
define ('paladin_cost',50);
define ('untrain_cost',10);
define ('merchants_atk',0);
define ('merchants_def',0);
define ('merchants_income',10);
define ('merchants_cost',100);
define ('season', 1);
define ('season_length',90);
//PASAR TODOO A CONSTANTS



//error_reporting(E_ERROR);
?>
