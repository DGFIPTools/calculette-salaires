<link rel="stylesheet" type="text/css" href="styles/compteur.css">



<?php
$counter_name = "counter.txt";

// Check if a text file exists.
// If not create one and initialize it to zero.
if (!file_exists($counter_name)) {
<<<<<<< HEAD
- $f = fopen($counter_name, "w");
- fwrite($f,"0");
- fclose($f);
=======
 $f = fopen($counter_name, "w");
 fwrite($f,"0");
 fclose($f);
>>>>>>> 513fd49... MAJ 2021
}

// Read the current value of our counter file
$f = fopen($counter_name,"r");
$counterVal = fread($f, filesize($counter_name));
fclose($f);

// Has visitor been counted in this session?
// If not, increase counter value by one
if(!isset($_SESSION['hasVisited'])){
<<<<<<< HEAD
- $_SESSION['hasVisited']="yes";
- $counterVal++;
- $f = fopen($counter_name, "w");
- fwrite($f, $counterVal);
- fclose($f);
=======
 $_SESSION['hasVisited']="yes";
 $counterVal++;
 $f = fopen($counter_name, "w");
 fwrite($f, $counterVal);
 fclose($f);
>>>>>>> 513fd49... MAJ 2021
}

$str = "".$counterVal;
$arr1 = str_split($str);

echo "<div class=\"container_inner\" id=\"display_div_id\">";
foreach ($arr1 as $counterValue) {
    echo "<span class=\"num_tiles\">".$counterValue."</span>";
}
<<<<<<< HEAD
echo "<span class=\"num_text\"> visiteurs depuis le 01/11/2019</span>";
=======
echo "<span class=\"num_text\"> visiteurs depuis le 23/09/2019</span>";
>>>>>>> 513fd49... MAJ 2021
echo "</div>";



?>



