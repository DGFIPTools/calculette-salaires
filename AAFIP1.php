<?php
session_start();

/*Tableau indicaire*/
$Tableau_Echelon=array("0","325","326","327","328","329","330","332","336","342","354","367",
"328","330","332","336","343","350","364","380","390","402","411","416",
"345","355","365","375","391","400","413","430","445","466");


# Crade pour le moment, à améliorer plus tard
if ($_POST["Echelon"]<12)
{
	$classe=" 1ere classe";
	$EchelonDisplay=$_POST["Echelon"];

}
else if ($_POST["Echelon"]<24)
{
	$EchelonDisplay=$_POST["Echelon"]-11;
	$classe=" Principal 2eme classe ";
}
else
{
	$EchelonDisplay=$_POST["Echelon"]-23;
	$classe=" Principal 1ere classe ";
}
# Calcul ACF
$ACF= 1211.10/12;

# Calcul TAI
if ($_POST["TAI"]==2)
{$TAI=255.27;}
elseif ($_POST["TAI"]==3)
{$TAI=296.44;}
elseif ($_POST["TAI"]==4)
{$TAI=343.10;}
if ($_POST["TAI"]==1)
{$TAI=0;}

#Calcul PR



if ($_POST["IDF"]==1)


{ if ($_POST["Echelon"]<12 )
{
    $PR=1690.77/12;
}
else if (($_POST["Echelon"]>11) and ($_POST["Echelon"]<24))
{
    $PR=1730.31/12;
}
else if  (($_POST["Echelon"]>23) and ($_POST["Echelon"]<36))
   {$PR=1809.39/12;
   }
}



if ($_POST["IDF"]==2)

{
if ($_POST["Echelon"]<12)
{
    $PR=1769.85/12;
}
else if (($_POST["Echelon"]<24) and ($_POST["Echelon"]>11))
{
    $PR=1809.39/12;
}
else  if (($_POST["Echelon"]<36) and ($_POST["Echelon"]>23))
   {
	   $PR=1888.47/12;
   }
}


#Indemnité de stage
$stag=0;

$TPP = 167 ;

include 'calculTraitement.php';

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

    header("Location: ./calcDgfip.php?link=fichePaie.php");
    exit;
?>
