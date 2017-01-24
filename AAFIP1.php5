<?php
session_start();

/*Tableau indicaire*/
$Tableau_Echelon=array("0","323","324","325","326","327","329","332","345","354","368","375","382",
"326","327","328","330","332","339","346","360","376","385","398","407",
"338","345","355","370","385","400","422","436","462");


# Crade pour le moment, à améliorer plus tard
if ($_POST["Echelon"]<13)
{
	$classe=" 1ere classe";
	$EchelonDisplay=$_POST["Echelon"];
    
}
else if ($_POST["Echelon"]<25)
{
	$EchelonDisplay=$_POST["Echelon"]-12;
	$classe=" Principal 2eme classe ";
}
else
{
	$EchelonDisplay=$_POST["Echelon"]-24;
	$classe=" Principal 1ere classe ";
}

$ACF= 1211.10/12;

if ($_POST["TAI"]==2)
{$TAI=255.27;}
elseif ($_POST["TAI"]==3)
{$TAI=296.44;}
elseif ($_POST["TAI"]==4)
{$TAI=343.10;}
if ($_POST["TAI"]==0)
{$TAI=0;}
if ($_POST["Echelon"]<8)
{
    $PR=1730.31/12;
    
}

   
   else if ($_POST["Echelon"]<36)
   {$PR=1803.39/12;
   }
   
$stag=0;
   

include 'calculTraitement.php5';

# Envoie des données a la fiche de paie
$_SESSION["Grade"]="Agent".$classe;
$_SESSION["stagiaire"]="";
$_SESSION["Echelon"]=$EchelonDisplay;
$_SESSION["Indice"]=$Tableau_Echelon[$_POST["Echelon"]];
$_SESSION["Qualif"]=$QUALIF;

$_SESSION["Total_revenues"]=$Total_revenues;
$_SESSION["Total_retenues"]=$Total_retenues;
$_SESSION["Total_net"]=$Total_net;


$elementFichePaie = array( 

					array( name => "TRAITEMENT BRUT", 
                      value => "$Traitement_indiciaire",
                      evaluation => "+" 
                    ),
               array( name => "RETENUE PENSION CIVIL", 
                      value => "$PC",
                      evaluation => "-",
                    ),
               array( name => "RETENUE PENSION CIVIL IMT", 
                      value => "$RIMT",
                      evaluation => "-",
                    ),
               array( name => "IMT", 
                      value => "$IMT",
                      evaluation => "+",
                    ),
               array( name => "IFTS", 
                      value => "$IAT",
                      evaluation => "+",
                    ),
               array( name => "ACF TECH.", 
                      value => "$ACF",
                      evaluation => "+",
                    ),
               array( name => "PRIME DE RENDEMENT", 
                      value => "$PR",
                      evaluation => "+",
                    ),
               array( name => "INDEMNITE DE RESIDENCE", 
                      value => "$IR",
                      evaluation => "+",
                    ),
               array( name => "CSG", 
                      value => "$CSG",
                      evaluation => "-",
                    ),
               array( name => "CRDS", 
                      value => "$CRDS",
                      evaluation => "-",
                    ),
               array( name => "RAFP", 
                      value => "$RAFP",
                      evaluation => "-",
                    ),
               array( name => "CONTRIBUTION SOLIDARITE", 
                      value => "$CS",
                      evaluation => "-",
                    ),
               array( name => "TAI", 
                      value => "$TAI",
                      evaluation => "+" 
                    )
             );
             
$_SESSION["elementFichePaie"]=$elementFichePaie;
             
    header("Location: /calcDgfip.php5?link=fichePaie.php5");
    exit;
?>
