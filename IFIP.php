<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
 <link rel="stylesheet" type="text/css" href="styles/adaptive.css"/>
  <link rel="stylesheet" type="text/css" href="styles/formulaire.css"/>
<title>Calcul traitement et salaire Inspecteur des Finances Publiques</title>
<link rel="icon" type="image/png" href="styles/categorie_a.png" />
<META name="keywords" content="salaire, calculateur, TSPEI, TSDD, TSPDD, TSCDD, TSCEI, IFIP, CFiP, CTRL, Inspecteur des finances publiques">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
</head>

  <body>
    <form action="./IFIP1.php" method="post" name="ts" target="_parent">

     <h5 class="titleForm">&nbsp; Estimation de votre salaire&nbsp;</h5>

      <?php
      include 'utils.php';
      $echelonClass = new formObject();
		$echelonClass->name = "Echelon";
		$echelonClass->formNameClass = "formName";
		$echelonClass->formValueClass = "formValue";
		$echelonClass->formSelectClass = "autosize";
		$echelonClass->formRequired = "required";
		$echelonClass->formName = "Echelon";
		$echelonClass->formIndexSelected = 12;

		$echelonClass->valueArray=array("Inspecteur 1er échelon","Inspecteur 2ème échelon","Inspecteur 3ème échelon",
		"Inspecteur 4ème échelon","Inspecteur 5ème échelon","Inspecteur 6ème échelon","Inspecteur 7ème échelon",
		"Inspecteur 8ème échelon","Inspecteur 9ème échelon","Inspecteur 10ème échelon","Inspecteur 11ème échelon");
		
		$stagClass = new formObject();
		$stagClass->name = "Je suis stagiaire";
		$stagClass->formNameClass = "formName";
		$stagClass->formRequired = "required";
		$stagClass->formName = "Stag";
		$stagClass->formIndexSelected = 0;
		$stagClass->valueArray=array("Non","Oui - Externe sans reprise d'ancienneté","Oui - Externe avec reprise d'ancienneté","Oui - Interne");


		$taiClass = new formObject();
		$taiClass->name = "Prime Informatique";
		$taiClass->formNameClass = "formName";
		$taiClass->formValueClass = "formValue";
		$taiClass->formSelectClass = "autosize";
		$taiClass->formRequired = "required";
		$taiClass->formName = "TAI";
		$taiClass->formIndexSelected = 0;

		$taiClass->valueArray=array("Aucune","PSE  depuis moins d'un an",
		"PSE depuis plus d'un an mais moins de 2 ans et demi","PSE au delà de 2 ans et demi",
		"Analyste depuis moins de deux ans","Analyste depuis plus de deux ans mais moins de 4 ans",
		"Analyste au delà de 4 ans");


		$irClass = new formObject();
		$irClass->name = "Indemnité de résidence";
		$irClass->formNameClass = "formName";
		$irClass->formRequired = "required";
		$irClass->formName = "IR";
		$irClass->formIndexSelected = 0;
		$irClass->valueArray=array("0%","1%","3%");
		
		$rifClass = new formObject();
		$rifClass->name = "Je travaille en région Ile-de-Françe";
		$rifClass->formNameClass = "formName";
		$rifClass->formRequired = "required";
		$rifClass->formName = "ISRIF";
		$rifClass->formIndexSelected = 0;

		$rifClass->valueArray=array("Non","Oui");


		$formObjectsArray = array($echelonClass,$stagClass,$taiClass,$rifClass,$irClass);

		include 'formulaire.php';
      ?>

     <div class="titleForm">
        <input class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white" formtarget="_parent" formmethod="post" value="Lancer la simulation" name="Calcul" type="submit"/>
     </div>
    <br>
    </form>


  </body>
</html>
-
