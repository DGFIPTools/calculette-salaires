<?php
session_start();


/*Tableau indicaire*/
$Tableau_Echelon=array("0","349","376","389","408","431","461","496","524","545","584","626","658",
"349","376","389","408","431","461","496","524","545","584","626","658");

if ($_POST["Echelon"]<13)
{
    $ACF= 3853/12;
    
}
else
{
	$ACF=0;
}

if ($_POST["TAI"]==2)
{$TAI=381.53;$QUALIF="PSE";}
elseif ($_POST["TAI"]==3)
{$TAI=444.66;$QUALIF="PSE";}
elseif ($_POST["TAI"]==4)
{$TAI=516.03;$QUALIF="PSE";}
elseif ($_POST["TAI"]==5)
{$TAI=227.82;$QUALIF="Analyste";}
elseif ($_POST["TAI"]==6)
{$TAI=258.01;$QUALIF="Analyste";}
elseif ($_POST["TAI"]==7)
{$TAI=323.89;$QUALIF="Analyste";}
if ($_POST["TAI"]==0)
{$TAI=0;}



$stag=0;

if ($_POST["Echelon"]<8)
{
    $PR=4062.24/12;
    
}
    else if ($_POST["Echelon"]<11)
   {$PR=4971.46/12;
    }
   
   else if ($_POST["Echelon"]<13)
   {$PR=5920.42/12;
   }
   
   else if (($_POST["Echelon"]>12) and ($_POST["Stag"]==1))
	{$PR=129.49;
	 $stag=446.5;
	}
   else if (($_POST["Echelon"]>12) and ($_POST["Stag"]==2))
   {$PR=166.67;
	$stag=446.5;
	}
   else if (($_POST["Echelon"]>12) and ($_POST["Stag"]==3))
   {$PR=356.30;
   $stag=446.5;
	}


include 'calculTraitement.php5';

# Envoie des données a la fiche de paie


$_SESSION["Grade"]="Inspecteur";
$_SESSION["stagiaire"]=($_POST["Echelon"]>=13)?"stagiaire ":"";
$_SESSION["Echelon"]=($_POST["Echelon"]>=13)?$_POST["Echelon"]-12:$_POST["Echelon"];
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
               array( name => "INDEMNITE STAGE LINEAIRE", 
                      value => "$stag",
                      evaluation => "+",
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

