<?php
session_start();


/*Tableau indicaire*/
$Tableau_Echelon=array("0","383","400","418","440","468","505","532","560","590","635","664");

if ($_POST["Stag"]==1)
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

switch ($_POST["Stag"]) {
  # Je ne suis pas stagiaire 
    case 1:
        if ($_POST["Echelon"]<7){
			$PR=($_POST["ISRIF"]==1)?4062.04/12:4376.90/12;
		}
		else if ($_POST["Echelon"]<10){
			$PR=($_POST["ISRIF"]==1)?4971.46/12:5365.40/12;
		}
		else {
			$PR=($_POST["ISRIF"]==1)?5920.42/12:6353.90/12;
		}
        break;
   # Stagiaire Externe sans reprise anciennete
    case 2:
        $PR=129.49;
		$stag=446.5;
        break;
	 # Stagiaire Externe avec reprise anciennete
    case 3:
        $PR=166.67;
		$stag=446.5;
	 # Stagiaire Interne
	case 4:
        $PR=356.30;
		$stag=446.5;
        break;
}
$TPP = 167 ;


include 'calculTraitement.php';


#  Transfert primes points


# Envoie des données a la fiche de paie


$_SESSION["Grade"]="Inspecteur";
$_SESSION["stagiaire"]=($_POST["Stag"]>=2)?"stagiaire ":"";
$_SESSION["Echelon"]=$_POST["Echelon"];
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
			   array( name => "INDEMNITE DE RESIDENCE",
                      value => "$IR",
                      evaluation => "+",
                    ),
               array( name => "IMT",
                      value => "$IMT",
                      evaluation => "+",
                    ),
			   array( name => "PRIME DE RENDEMENT",
                      value => "$PR",
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
       		   array( name => "IND. COMPENSATRICE CSG",
                      value => "$CSG_INDM",
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
               array( name => "TAI",
                      value => "$TAI",
                      evaluation => "+"
                    ),
				array( name => "TRANSFERT PRIMES / POINTS",
                      value => "$TPP",
                      evaluation => "-"
                    )
             );

	$_SESSION["elementFichePaie"]=$elementFichePaie;

    header("Location: ./calcDgfip.php?link=fichePaie.php");
    exit;
?>
