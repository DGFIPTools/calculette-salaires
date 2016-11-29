<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
 <link rel="stylesheet" type="text/css" href="styles/adaptive.css"/>
  <link rel="stylesheet" type="text/css" href="styles/formulaire.css"/>
<title>Calcul traitement et salaire inspecteur des finances publiques</title>
<META name="keywords" content="salaire, calculateur, TSPEI, TSDD, TSPDD, TSCDD, TSCEI, IFIP, CFiP, CTRL, Inspecteur des finances publiques">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
</head>

  <body>
    <form action="/IFIP1.php5" method="post" name="ts" target="_parent">
      
      <p class="titleForm"><a href="mailto:tatam3x@gmail.com">T3X</a>&nbsp; Simulation de salaire des Inspecteurs des finances publiques  &nbsp;</p>
      
      <?php
      include 'utils.php5';
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
		"Inspecteur 8ème échelon","Inspecteur 9ème échelon","Inspecteur 10ème échelon","Inspecteur 11ème échelon",
		"Inspecteur 12ème échelon","Inspecteur stagiaire 1er échelon","Inspecteur stagiaire 2ème échelon",
		"Inspecteur stagiaire 3ème échelon","Inspecteur stagiaire 4ème échelon","Inspecteur stagiaire 5ème échelon",
		"Inspecteur stagiaire 6ème échelon","Inspecteur stagiaire 7ème échelon","Inspecteur stagiaire 8ème échelon",
		"Inspecteur stagiaire 9ème échelon","Inspecteur stagiaire 10ème échelon","Inspecteur stagiaire 11ème échelon",
		"Inspecteur stagiaire 12ème échelon");
		
		$stagClass = new formObject();
		$stagClass->name = "Provenance des stagiaires";
		$stagClass->formNameClass = "formName";
		$stagClass->formValueClass = "formValue";
		$stagClass->formSelectClass = "autosize";
		$stagClass->formRequired = "required";
		$stagClass->formName = "Stag";
		$stagClass->formIndexSelected = 0;
		
		$stagClass->valueArray=array("Externe sans reprise d'ancienneté",
		"Externe avec reprise d'ancienneté",
		"Interne Ex-Cat C AAP1 AAP2 ou ex-Cat B ou Ex-Cat A");
		
		
		$taiClass = new formObject();
		$taiClass->name = "Prime Informaticiens";
		$taiClass->formNameClass = "formName";
		$taiClass->formValueClass = "formValue";
		$taiClass->formSelectClass = "autosize";
		$taiClass->formRequired = "required";
		$taiClass->formName = "TAI";
		$taiClass->formIndexSelected = 0;
		
		$taiClass->valueArray=array("Pas de TAI","PSE  depuis moins d'un an",
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

		
		$formObjectsArray = array($echelonClass,$stagClass,$taiClass,$irClass);
		
		include 'formulaire.php5';
      ?>
      
     <div class="titleForm">
        <input formtarget="_parent" formmethod="post" value="Lancer la simulation" name="Calcul" type="submit"/>
     </div>
          
    </form>
  </body>
</html>
