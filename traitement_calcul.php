<?php 

function floor_prec($x, $prec) {
   return floor($x*pow(10,$prec))/pow(10,$prec);
}



/*déclaration des variables*/
$INM="";






$tempPartielObj=$xml->xpath("//data[@category='quotite']/value[@index='".$quotiteIndex."']");
$tempPartiel=floatval($tempPartielObj[0]->attributes()->reel);

# point d'indice chargé depuis le xml
<<<<<<< HEAD
$pointIndiceTab=($xml->xpath("//data[@category='point_indice']/value"));
$Point = floatval($pointIndiceTab[0]);
=======
$IsStagiaire=$_SESSION["stagiaire"];
$Point = $_SESSION["pointIndice"];

>>>>>>> 513fd49... MAJ 2021

# Valeur de la retenu de pension civile
$retenuPcTab=($xml->xpath("//data[@category='retenu_pension_civile']/value"));
$RetenuPC = floatval($retenuPcTab[0]);

# Valeur de l'IMT
$IMTTab=($xml->xpath("//data[@category='imt']/value"));
$IMT = floatval($IMTTab[0])*$tempPartiel;

$echelons=($xmlGrade->xpath("//data[@category='echelons']/items[@index='".$gradeIndex."']/value"));
$echelonDisplay=(string)($echelons[$echelonVal]->attributes()->index);




$TPP_base =floatval($xmlGrade->xpath("//data[@category='tpp_base']/value")[0]);
$TPP_points =floatval($xmlGrade->xpath("//data[@category='tpp_points']/value")[0]);

$gradeValue=($xmlGrade->xpath("//data[@category='pr']/items[@index='".$gradeIndex."']/value[@endEch>=".$echelonVal." and @startEch<=".$echelonVal." and @isRIF=".$isRifIndex."]"));







/*calcul de l'INM de l'IAT de l'IR de l'ACF et la TAI*/
$INM=$echelons[$echelonVal];
$Traitement_indiciaire= $INM*$Point*$tempPartiel;
$IAT=0.0833*$Traitement_indiciaire;

$irValueArray=($xml->xpath("//data[@category='irs']/value[@index='".$irIndex."']"));
$IR_VALUE=floatval($irValueArray[0]->attributes()->reel);
$IR=$IR_VALUE*$Traitement_indiciaire;

#Calcul des primes TAI


$TAI_OBJ=($xmlGrade->xpath("//data[@category='tai']/value")[$taiIndex]);
$BASE_TAI=$Point*12*494/10000;
$QUALIF=$TAI_OBJ->attributes()->qualif;

switch ($stagIndex) {
   # Je ne suis pas stagiaire 
     case 0:
       $TAI=floatval($TAI_OBJ->attributes()->points)*$BASE_TAI*$tempPartiel;
       $stag=0;
       $PR=floatval($gradeValue[0])/12;
       $ACF_ANNUEL=($xmlGrade->xpath("//data[@category='acf']/value"));
       $ACF = floatval($ACF_ANNUEL[0])*$tempPartiel;
       $ACF = $ACF / 12;
       break;
    # Stagiaire 
     default :
         $ACF=0;
         $TAI=0;
         $PR=floatval($xmlGrade->xpath("//data[@category='stag']/value[@index=".$stagIndex."]")[0]);
         $stag=floatval($xmlGrade->xpath("//data[@category='prime_stag']/value")[0]);
         break;
 }



/*calcul des Traitements et cotisations */
$Traitement_Brut=$Traitement_indiciaire+$IMT+$IAT+$PR+$ACF+$IR+$TAI;
$PLSource = ($Traitement_indiciaire+$IMT+$PR+$IR+$ACF) * floatval($psIndex) / 100;
$Traitement_Brut=floor_prec($Traitement_Brut, 2);
$PC=$Traitement_indiciaire*$RetenuPC;
$RIMT=$IMT*20/100;

# CSG
<<<<<<< HEAD
$CSGRawRate=($xml->xpath("//data[@category='csg']/value"));
$CSGRate = floatval($CSGRawRate[0]);
$CSG=$CSGRate*$Traitement_Brut*98.25/100;
=======
$CSGRawRate=($xml->xpath("//data[@category='csg_deductible']/value"));
$CSGNonDeductibleRawRate=($xml->xpath("//data[@category='csg_nondeductible']/value"));
$CSGRate = floatval($CSGRawRate[0]);
$CSGNonDeductibleRate = floatval($CSGNonDeductibleRawRate[0]);

$CSG=$CSGRate*($Traitement_Brut)*98.25/100;
$CSGNonDeductible=$CSGNonDeductibleRate*($Traitement_Brut)*98.25/100;
>>>>>>> 513fd49... MAJ 2021

# CRDS
$CRDSRawRate=($xml->xpath("//data[@category='crds']/value"));
$CRDSRate = floatval($CRDSRawRate[0]);
$CRDS=$CRDSRate*$Traitement_Brut*98.25/100;

$RAFP_BRUT=($IMT+$IAT+$PR+$ACF+$IR+$TAI);
$RAFP_PLAFOND=$Traitement_indiciaire*0.2;
$RAFP=0.05*(min($RAFP_BRUT,$RAFP_PLAFOND));

<<<<<<< HEAD
$CS_BASE=$Traitement_Brut-($RAFP+$PC+$RIMT);
$CS=0.01*$CS_BASE;
=======
$CS=$Traitement_Brut*0.01;
>>>>>>> 513fd49... MAJ 2021

$CSG_INDM = (($Traitement_Brut* 0.016702) - $CS ) * 1.1053;

$PR = $PR * $tempPartiel;
<<<<<<< HEAD
$TPP = ($TPP_base - ($TPP_points*$Point)) / 12;
=======
$TPP = (($TPP_base*$tempPartiel) - ($TPP_points*$Point)) / 12;
>>>>>>> 513fd49... MAJ 2021




#Round values
$CS=floor_prec($CS, 2);
$stag=floor_prec($stag, 2);
$RIMT=round($RIMT,2);
$IMT=round($IMT, 2);
$CSG=floor_prec($CSG, 2);
<<<<<<< HEAD
=======
$CSGNonDeductible=floor_prec($CSGNonDeductible, 2);
>>>>>>> 513fd49... MAJ 2021
$CSG_INDM=floor_prec($CSG_INDM, 2);
$CRDS=floor_prec($CRDS, 2);
$RAFP=floor_prec($RAFP, 2);
$ACF = floor_prec($ACF, 2);
$TPP = floor_prec($TPP, 2);
$IAT= round($IAT, 2);
<<<<<<< HEAD
$PR = floor_prec($PR, 2);
$PC=floor_prec($PC, 2);
$IR=floor_prec($IR, 2);
$TAI=floor_prec($TAI, 2);
$PLSource=floor_prec($PLSource, 2);
$Traitement_indiciaire=round($Traitement_indiciaire,2);

$Total_retenues=$PC+$CSG+$CRDS+$RIMT+$RAFP+$CS+$TPP;
=======
$PR = round($PR, 2);
$PC=floor_prec($PC, 2);
$IR=floor_prec($IR, 2);
$TAI=round($TAI, 2);
$PLSource=floor_prec($PLSource, 2);
$Traitement_indiciaire=round($Traitement_indiciaire,2);

$Total_retenues=$PC+$CSG+$CSGNonDeductible+$CRDS+$RIMT+$RAFP+$TPP;
>>>>>>> 513fd49... MAJ 2021
$Total_revenues=$stag+$Traitement_Brut+$CSG_INDM;
$Total_net=$Total_revenues-$Total_retenues;
$Total_net_ps=$Total_net-$PLSource;

# Formattage des données
$Traitement_Brut=number_format(($Traitement_Brut), 2, ',', ' ');
$Total_revenues=number_format($Total_revenues, 2, ',', ' ');
$stag=number_format($stag, 2, ',', ' ');
$IMT=number_format($IMT, 2, ',', ' ');
$CSG=number_format($CSG, 2, ',', ' ');
<<<<<<< HEAD
=======
$CSGNonDeductible=number_format($CSGNonDeductible, 2, ',', ' ');
>>>>>>> 513fd49... MAJ 2021
$CSG_INDM=number_format($CSG_INDM, 2, ',', ' ');
$TPP=number_format($TPP, 2, ',', ' ');
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
$PLSource=number_format($PLSource, 2, ',', ' ');
$Total_net=number_format($Total_net, 2, ',', ' ');
$Total_retenues=number_format($Total_retenues, 2, ',', ' ');
$Traitement_indiciaire= number_format($Traitement_indiciaire, 2, ',', ' ');
$Total_net_ps=number_format($Total_net_ps, 2, ',', ' ');

?>
