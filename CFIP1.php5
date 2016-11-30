<?php
session_start();
function floor_prec($x, $prec) {
   return floor($x*pow(10,$prec))/pow(10,$prec);
}

$INM="";
$QUALIF="";

# chargement du fichier xml contenant les données
$dataFile = 'data/data.xml';
$xml = simplexml_load_file($dataFile);

# point d'indice chargé depuis le xml
$pointIndiceTab=($xml->xpath("//data[@category='point_indice']/value"));
$Point = floatval($pointIndiceTab[0]); 

$retenuPcTab=($xml->xpath("//data[@category='retenu_pension_civile']/value"));
$RetenuPC = floatval($retenuPcTab[0]); 

$stag=0;
$classe="";

$Tableau_Echelon=array("0","332","335","338","341","351","364","377","392","406","428","449","472","492",
"327","332","340","348","361","375","390","405","425","445","468","491","515",
"365","380","395","410","428","449","471","494","519","540","562",
"326","329","332","335","345","358","371","386","400","422","443","466","486");


$INM=$Tableau_Echelon[$_POST["Echelon"]];
$Traitement_indiciaire= $INM*$Point;
$IAT=0.0833*$Traitement_indiciaire;
$IMT=101.98;    
if ($_POST["IR"]==1)
{$IR_VALUE=0;}
elseif ($_POST["IR"]==2)
{$IR_VALUE=1;}
elseif ($_POST["IR"]==3)
{$IR_VALUE=3;}

$IR=$IR_VALUE*$Traitement_indiciaire/100;


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
   
 /*  $test=$_POST["Echelon"];
   echo $test;*/


$Traitement_Brut=$Traitement_indiciaire+$IMT+$IAT+$PR+$ACF+$IR+$TAI;
$PC=$Traitement_indiciaire*$RetenuPC;
$RIMT=101.98*20/100;
$CSG=0.075*$Traitement_Brut*98.25/100;
$CRDS=0.005*$Traitement_Brut*98.25/100;
$RAFP=$Traitement_indiciaire/100;
$CS=0.01*($Traitement_indiciaire+$IMT+$IAT+$PR+$ACF+$IR+$TAI-$RIMT-$PC-$RAFP);

$Total_retenues=$PC+$CSG+$CRDS+$RIMT+$RAFP+$CS;
$Total_revenues=$stag+$Traitement_Brut;
$Total_net=$Total_revenues-$Total_retenues;





# Formattage des données
$Traitement_Brut=number_format(($Traitement_Brut), 2, ',', ' ');
$Total_revenues=number_format($Total_revenues, 2, ',', ' ');
$stag=number_format($stag, 2, ',', ' ');
$IMT=number_format($IMT, 2, ',', ' ');
$CSG=number_format($CSG, 2, ',', ' ');
$CRDS=number_format($CRDS, 2, ',', ' ');
$RAFP=number_format($RAFP, 2, ',', ' ');
$RIMT=number_format($RIMT, 2, ',', ' ');
$ACF = number_format($ACF, 2, ',', ' ');
$IAT= number_format($IAT, 2, ',', ' ');
$PR = number_format($PR, 2, ',', ' ');
$PC=number_format($PC, 2, ',', ' ');
$IR=number_format($IR, 2, ',', ' ');
$CS=number_format($CS, 2, ',', ' ');
$TAI=number_format($TAI, 2, ',', ' ');
$Total_net=number_format($Total_net, 2, ',', ' ');
$Total_retenues=number_format($Total_retenues, 2, ',', ' ');
$Traitement_indiciaire= number_format($Traitement_indiciaire, 2, ',', ' ');

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

header("Location: /fichePaie.php5");
exit;

?>
