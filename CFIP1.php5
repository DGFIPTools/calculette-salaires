<?php
session_start();


$Tableau_Echelon=array("0","339","344","349","356","366","379","394","413","429","440","453","474","498",
"347","354","361","373","385","398","413","433","452","459","477","500","529",
"389","402","417","437","460","480","504","529","548","569","582",
"326","329","332","335","345","358","371","386","400","422","443","466","486");

# Crade pour le moment, à améliorer plus tard
if ($_POST["Echelon"]<14)
{
	$classe=" 2eme classe";
    $EchelonDisplay=$_POST["Echelon"];
    
}
    else if ($_POST["Echelon"]<27)
   {
   $EchelonDisplay=$_POST["Echelon"]-13;
   $classe=" 1ere classe ";
    }
   
   else if ($_POST["Echelon"]<38)
   {
   $EchelonDisplay=$_POST["Echelon"]-26;
   $classe=" Principal ";
   }
   else{
   	$EchelonDisplay=$_POST["Echelon"]-37;
   }
   
   
   if ($_POST["Echelon"]<38)
{
    $ACF= 2202/12;
    
}
else
{
	$ACF=0;
}


if ($_POST["TAI"]==2)
{$TAI=255.27;$QUALIF="Programmeur";
}
elseif ($_POST["TAI"]==3)
{$TAI=296.44;$QUALIF="Programmeur";}
elseif ($_POST["TAI"]==4)
{$TAI=343.10;$QUALIF="Programmeur";}
elseif ($_POST["TAI"]==5)
{$TAI=381.53;$QUALIF="PSE";}
elseif ($_POST["TAI"]==6)
{$TAI=444.66;$QUALIF="PSE";}
elseif ($_POST["TAI"]==7)
{$TAI=516.03;$QUALIF="PSE";}
if ($_POST["TAI"]==0)
{$TAI=0;}



$stag=0;


if ($_POST["Echelon"]<8)
{
    $PR=2733.32/12;
    
}
    else if ($_POST["Echelon"]<27)
   {$PR=3592.25/12;
    }
   
   else if ($_POST["Echelon"]<38)
   {$PR=4064.54/12;
   }
   
   else if (($_POST["Echelon"]>37) and ($_POST["Stag"]==1))
	{$PR=0;
	 $stag=528.75;
	}
   else if (($_POST["Echelon"]>37) and ($_POST["Stag"]==2))
   {$PR=83.33;
	$stag=528.75;
	}
   else if (($_POST["Echelon"]>37) and ($_POST["Stag"]==3))
   {$PR=258.30;
   $stag=528.75;
	}
   else if (($_POST["Echelon"]>37) and ($_POST["Stag"]==4))
   {$PR=251.71;
   $stag=528.75;
	}
   else if (($_POST["Echelon"]>37) and ($_POST["Stag"]==5))  
   {$PR=248.41;
   $stag=528.75;
	}

include 'calculTraitement.php5';

# Envoie des données a la fiche de paie
$_SESSION["Grade"]="Controleur".$classe;
$_SESSION["stagiaire"]=($_POST["Echelon"]>=38)?"stagiaire ":"";
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
