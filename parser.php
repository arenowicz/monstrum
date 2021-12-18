<?php
//include_once('simple_html_dom.php');
error_reporting(5);

function str_contains($haystack, $needle)
{
	if (strpos($haystack, $needle) !== false) 
	 {return true; } 
else {return false; }
}


if(isset($_POST['input'])) 
{
$data = $_POST['input']; 
}

$patternEach = "/zaatakowałeś.monstrum.*?ta.*?\n/si";
preg_match_all($patternEach, $data, $matches);


$patternExpGained = "/doświadczenia.*/i";


$expGained = array();
$out = "";
$test = "";



$monsters = array (
array("Ogółem",0,0),
array("Bazyliszek",0,0),
array("Sfinks",0,0),
array("Feniks",0,0),
array("Chimera",0,0),
array("Piaskowy",0,0),
array("Lodowy",0,0),
);




foreach ($matches[0] as $m)
{
	
	
	for ($i=1; $i<count($monsters); $i++)
	{
		if (str_contains($m, $monsters[$i][0]))
		{
			if (str_contains($m, "WYGRAŁEŚ"))
			{
				$monsters[0][1]++; // ogolem
				$monsters[$i][1]++;
			}
			else if (str_contains($m, "PRZEGRAŁEŚ"))
			{
				$monsters[0][2]++; // ogolem
				$monsters[$i][2]++;
			}
			
		}
			
		
		
	}
	
	
	
	
	
	preg_match($patternExpGained, $m, $test);
	$test = preg_replace("/doświadczenia /", "", $test[0]);
	array_push($expGained, $test);
	
	
	
}

$expGained = array_filter($expGained);

$battles = 0;

foreach ($expGained as $m)
{
	$exp += $m;
	$battles++;
	
	//$out .= $m . "\n";
}

if ($battles === 0)
{
	$expPerBattle = '';
}
else
{
	$expPerBattle = ceil($exp/$battles);
}



$out .= "<p class=\"wyniki\"><b>" . "Doświadczenie: " . $exp . "<br>Przeciętnie: " . $expPerBattle . "</b></p>";

$out .= "<table class=\"wyniki\"><thead><tr><th>Monstrum</th><th>Walk</th><th>Zwycięstw</th><th>Przegranych</th></tr></thead>";

	for ($i=0; $i<count($monsters); $i++)
	{
	 if ($monsters[$i][1] === 0 && $monsters[$i][2] === 0)
	 {
		 
	 }
	 else
	 {
		$out .= "<tr><td>" . $monsters[$i][0] . "</td><td>" . ($monsters[$i][1]+$monsters[$i][2]) . "</td><td>" . $monsters[$i][1] . "</td><td>" . $monsters[$i][2] . "</td></tr>";
	 }
	}

$out .= "</table>";


echo $out;











?>
