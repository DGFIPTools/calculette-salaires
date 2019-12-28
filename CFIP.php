<?php
  session_start();?>
<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
 <link rel="stylesheet" type="text/css" href="styles/adaptive.css"/>
  <link rel="stylesheet" type="text/css" href="styles/formulaire.css"/>
<title>Calcul traitement et salaire Contrôleur des Finances Publiques</title>
<META name="keywords" content="salaire, calculateur, TSPEI, TSDD, TSPDD, TSCDD, TSCEI, IFIP, CFiP, CTRL, Inspecteur des finances publiques">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
</head>

  <body>
	<form action="./traitement_prepare.php" method="post" name="ts" target="_parent">
	


	<input type="hidden" name="data_xml" value="cfip">

	  <h5 class="titleForm">&nbsp; Estimation de votre salaire&nbsp;</h5>
	  
	  

      <?php
	  include 'utils.php';

		$gradeId=(max($_GET['Grade']-1,0));
	  
		# chargement du fichier xml contenant les données
		$dataFile = 'data/cfip.xml';
		$xml = simplexml_load_file($dataFile);

		$dataGenericFile = 'data/data.xml';
		$xmlGeneric = simplexml_load_file($dataGenericFile);
		
		# Echelons
		$quotiteArray=($xmlGeneric->xpath("//data[@category='quotite']/value"));
		$echelonsArray=($xml->xpath("//data[@category='echelons']/items[@index='".$gradeId."']/value/@name"));
		$gradeArray=($xml->xpath("//data[@category='grades']/value"));
		$taiArray=($xml->xpath("//data[@category='tai']/value"));
		$irValueArray=($xmlGeneric->xpath("//data[@category='irs']/value"));
		$stagArray=($xml->xpath("//data[@category='stag']/value/@name"));
		$help_ir=($xmlGeneric->xpath("//data[@category='help_ir']/value")[0]);

		$gradeClass = new formObject();
		$gradeClass->name = "Grade";
		$gradeClass->formNameClass = "formName";
		$gradeClass->formValueClass = "formValue";
		$gradeClass->formSelectClass = "autosize";
		$gradeClass->formRequired = "required";
		$gradeClass->formName = "Grade";
		$gradeClass->formIndexSelected = $gradeId;
		$gradeClass->valueArray=$gradeArray;

		$echelonClass = new formObject();
		$echelonClass->name = "Echelon";
		$echelonClass->formNameClass = "formName";
		$echelonClass->formValueClass = "formValue";
		$echelonClass->formSelectClass = "autosize";
		$echelonClass->formRequired = "required";
		$echelonClass->formName = "Echelon";
		$echelonClass->formIndexSelected = 0;
		$echelonClass->valueArray=$echelonsArray;
		
		$stagClass = new formObject();
		$stagClass->name = "Je suis stagiaire";
		$stagClass->formSelectClass = "autosize";
		$stagClass->formNameClass = "formName";
		$stagClass->formRequired = "required";
		$stagClass->formName = "Stag";
		$stagClass->formIndexSelected = 0;
		$stagClass->valueArray=$stagArray;


		$taiClass = new formObject();
		$taiClass->name = "Prime Informatique";
		$taiClass->formNameClass = "formName";
		$taiClass->formValueClass = "formValue";
		$taiClass->formSelectClass = "autosize";
		$taiClass->formRequired = "required";
		$taiClass->formName = "TAI";
		$taiClass->formIndexSelected = 0;

		$taiClass->valueArray=$taiArray;

		$irClass = new formObject();
		$irClass->helpText=$help_ir;
		$irClass->name = "Indemnité de résidence";
		$irClass->formNameClass = "formName";
		$irClass->formRequired = "required";
		$irClass->formName = "IR";
		$irClass->formIndexSelected = 0;
		$irClass->valueArray=$irValueArray;
		
		$rifClass = new formObject();
		$rifClass->name = "Je travaille en région Ile-de-Françe";
		$rifClass->formNameClass = "formName";
		$rifClass->formRequired = "required";
		$rifClass->formName = "ISRIF";
		$rifClass->formIndexSelected = 0;

		$rifClass->valueArray=array("Non","Oui");

		$quotiteClass = new formObject();
		$quotiteClass->name = "Quotité de travail";
		$quotiteClass->formNameClass = "formName";
		$quotiteClass->formRequired = "required";
		$quotiteClass->formName = "QUOTITE";
		$quotiteClass->formIndexSelected = 0;

		$quotiteClass->valueArray=$quotiteArray;
		
		$pSourceClass = new formObject();
		$pSourceClass->name = "Taux d'imposition";
		$pSourceClass->formType = "number";
		$pSourceClass->formNameClass = "formName";
		$pSourceClass->formRequired = "required";
		$pSourceClass->formName = "PSOURCE";



		$formObjectsArray = array($gradeClass,$echelonClass,$stagClass,$taiClass,$rifClass,$irClass,$quotiteClass,$pSourceClass);

		include 'formulaire.php';
      ?>

     <div class="titleForm">
        <input class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white" formtarget="_parent" formmethod="post" value="Lancer la simulation" name="Calcul" type="submit"/>
     </div>

     <br>

    </form>
	

   </body>
</html>
