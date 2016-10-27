
<?php  


$classFighter="";
$classSight="";
$nombreFighters = count($fighterDisplay);

echo "<h2>Vos fighters</h2>";
echo '<li>';
	foreach($fighterDisplay as $fighter){
		echo '<ul> ' . $fighter['name'] . ', vision : '. $fighter['skill_sight'] .' </ul>';
	}
echo '</li>';
echo '<table id="sightTable">';
echo '<caption>Arena</caption>';
for ($i=1; $i < $arenaHeight+1 ; $i++) { 
	echo '<tr class="boardDisplay">';
	for ($k=1; $k < $arenaWidth+1 ; $k++) { 
		if($nombreFighters>0){
			foreach($fighterDisplay as $fighter){
				if($i== $fighter['coordinate_y'] AND $k==$fighter['coordinate_x']){
				 	$classFighter="fighterOnCase";
					$nombreFighters--;
					continue;
				}

			}
		}
		if(isset($fightersSight[$k][$i]) and $fightersSight[$k][$i]==1){
			$classSight="sightFighter";
		}
		echo '<th class="caseDisplay '.$classFighter.' '. $classSight .'"> </th>';
		$classFighter="";
		$classSight="";
	}
	echo'</tr>';
	# code...
}


echo '</table>';




?>
