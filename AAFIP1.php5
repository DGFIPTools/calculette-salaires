<?php
session_start();
function floor_prec($x, $prec) {
   return floor($x*pow(10,$prec))/pow(10,$prec);
}

/*déclaration des variables*/
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
   


/*calcul de l'INM de l'IAT de l'IR de l'ACF et la TAI*/
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
   

   
 /*  $test=$_POST["Echelon"];
   echo $test;*/



/*calcul des Traitements et cotisations */
$Traitement_Brut=$Traitement_indiciaire+$IMT+$IAT+$PR+$ACF+$IR+$TAI;
$Traitement_Brut=floor_prec($Traitement_Brut, 2);
$PC=$Traitement_indiciaire*$RetenuPC;
$RIMT=101.98*20/100;
$CSG=0.075*$Traitement_Brut*98.25/100;
$CRDS=0.005*$Traitement_Brut*98.25/100;

$RAFP_BRUT=($IMT+$IAT+$PR+$ACF+$IR+$TAI);
$RAFP_PLAFOND=$Traitement_indiciaire*0.2;
$RAFP=0.05*(min($RAFP_BRUT,$RAFP_PLAFOND));

$CS_BASE=$Traitement_Brut-($RAFP+$PC+$RIMT);
$CS=0.01*$CS_BASE;



#Round values
$CS=floor_prec($CS, 2);
$stag=floor_prec($stag, 2);
$RIMT=round($RIMT,2);
$IMT=floor_prec($IMT, 2);
$CSG=floor_prec($CSG, 2);
$CRDS=floor_prec($CRDS, 2);
$RAFP=floor_prec($RAFP, 2);
$ACF = floor_prec($ACF, 2);
$IAT= floor_prec($IAT, 2);
$PR = floor_prec($PR, 2);
$PC=floor_prec($PC, 2);
$IR=floor_prec($IR, 2);
$TAI=floor_prec($TAI, 2);




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
             
    header("Location: /fichePaie.php5");
    exit;
?>
