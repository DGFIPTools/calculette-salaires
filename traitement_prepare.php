<?php
  session_start();


# chargement du fichier xml contenant les données
$dataFile = 'data/data.xml';
$xml = simplexml_load_file($dataFile);

# chargement du fichier xml contenant les données ( champ input hidden dans le formulaire)
$dataGradeFile = 'data/'.((string) $_POST["data_xml"]).'.xml';
$xmlGrade = simplexml_load_file($dataGradeFile);

$echelonVal=$_POST["Echelon"]-1;
$gradeIndex=$_POST["Grade"]-1;
$isRifIndex=$_POST["ISRIF"]-1;
$stagIndex=max(0,$_POST["Stag"]-1);
$quotiteIndex=max(1,$_POST["QUOTITE"]);
$irIndex=$_POST["IR"];
$taiIndex=$_POST["TAI"]-1;
$psIndex=$_POST["PSOURCE"];







include 'traitement_calcul.php';


#  Transfert primes points


# Envoie des données a la fiche de paie

$_SESSION["Grade"]=(string) $xmlGrade->xpath("//data[@category='grades']/value[@index='".$gradeIndex."']")[0];
$_SESSION["stagiaire"]=($stagIndex==0)?"":" Stagiaire ";
$_SESSION["Quotite"]=(string) $tempPartielObj[0];
$_SESSION["Echelon"]=$echelonDisplay;
$_SESSION["Indice"]=((string) $echelons[$echelonVal]);
$_SESSION["Qualif"]=(string) $QUALIF;
$_SESSION["Total_revenues"]=$Total_revenues;
$_SESSION["Total_retenues"]=$Total_retenues;
$_SESSION["Total_net"]=$Total_net;
$_SESSION["PLSource"]=$PLSource;
$_SESSION["PLTaux"]=$psIndex;
$_SESSION["Total_net_ps"]=$Total_net_ps;


$elementFichePaie = array(

					array( 'name' => "TRAITEMENT BRUT",
                      'value' => "$Traitement_indiciaire",
                      'evaluation' => "+"
                    ),
               array( 'name' => "RETENUE PENSION CIVIL",
                      'value' => "$PC",
                      'evaluation' => "-",
                    ),
               array( 'name' => "RETENUE PENSION CIVIL IMT",
                      'value' => "$RIMT",
                      'evaluation' => "-",
                    ),
               array( 'name' => "INDEMNITE STAGE LINEAIRE",
                      'value' => "$stag",
                      'evaluation' => "+",
                    ),
			        array( 'name' => "INDEMNITE DE RESIDENCE",
                      'value' => "$IR",
                      'evaluation' => "+",
                    ),
               array( 'name' => "IMT",
                      'value' => "$IMT",
                      'evaluation' => "+",
                    ),
			        array( 'name' => "PRIME DE RENDEMENT",
                      'value' => "$PR",
                      'evaluation' => "+",
                    ),
               array( 'name' => "IFTS",
                      'value' => "$IAT",
                      'evaluation' => "+",
                    ),
               array( 'name' => "ACF TECH.",
                      'value' => "$ACF",
                      'evaluation' => "+",
                    ),
       		   array( 'name' => "IND. COMPENSATRICE CSG",
                      'value' => "$CSG_INDM",
                      'evaluation' => "+",
                    ),
               array( 'name' => "CSG NON DEDUCTIBLE",
                      'value' => "$CSGNonDeductible",
                      'evaluation' => "-",
                    ),
			   array( 'name' => "CSG DEDUCTIBLE",
                      'value' => "$CSG",
                      'evaluation' => "-",
                    ),
               array( 'name' => "CRDS",
                      'value' => "$CRDS",
                      'evaluation' => "-",
                    ),
                    array( 'name' => "RAFP",
                    'value' => "$RAFP",
                    'evaluation' => "-",
                  ),
             array( 'name' => "TAI",
                    'value' => "$TAI",
                    'evaluation' => "+"
                  ),
             array( 'name' => "TRANSFERT PRIMES / POINTS",
                    'value' => "$TPP",
                    'evaluation' => "-"
                  )
             );

  $_SESSION["elementFichePaie"]=$elementFichePaie;
  header('Location: http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . '/calcDgfip.php?link=fichePaie'); 
    exit
?>
