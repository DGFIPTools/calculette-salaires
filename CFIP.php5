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
    <form action="/CFIP1.php5" method="post" name="ts" target="_parent">
      
      <h5 class="titleForm">&nbsp; Estimation de votre salaire&nbsp;</h5>
      
      <?php
      include 'utils.php5';
      $echelonClass = new formObject();
		$echelonClass->name = "Echelon";
		$echelonClass->formNameClass = "formName";
		$echelonClass->formValueClass = "formValue";
		$echelonClass->formSelectClass = "autosize";
		$echelonClass->formRequired = "required";
		$echelonClass->formName = "Echelon";
		$echelonClass->formIndexSelected = 37;
		
		$echelonClass->valueArray=array(
		"Contrôleur 2ème classe 1er échelon","Contrôleur 2ème classe 2ème échelon","Contrôleur 2ème classe 3ème échelon",
		"Contrôleur 2ème classe 4ème échelon","Contrôleur 2ème classe 5ème échelon","Contrôleur 2ème classe 6ème échelon",
		"Contrôleur 2ème classe 7ème échelon","Contrôleur 2ème classe 8ème échelon","Contrôleur 2ème classe 9ème échelon",
		"Contrôleur 2ème classe 10ème échelon","Contrôleur 2ème classe 11ème échelon","Contrôleur 2ème classe 12ème échelon","Contrôleur 2ème classe 13ème échelon",
		"Contrôleur 1ère classe 1er échelon","Contrôleur 1ère classe 2ème échelon","Contrôleur 1ère classe 3ème échelon",
		"Contrôleur 1ère classe 4ème échelon","Contrôleur 1ère classe 5ème échelon","Contrôleur 1ère classe 6ème échelon",
		"Contrôleur 1ère classe 7ème échelon","Contrôleur 1ère classe 8ème échelon","Contrôleur 1ère classe 9ème échelon",
		"Contrôleur 1ère classe 10ème échelon","Contrôleur 1ère classe 11ème échelon","Contrôleur 1ère classe 12ème échelon","Contrôleur 1ère classe 13ème échelon",
		"Contrôleur Principal 1er échelon","Contrôleur Principal 2ème échelon","Contrôleur Principal 3ème échelon",
		"Contrôleur Principal 4ème échelon","Contrôleur Principal 5ème échelon","Contrôleur Principal 6ème échelon",
		"Contrôleur Principal 7ème échelon","Contrôleur Principal 8ème échelon","Contrôleur Principal 9ème échelon",
		"Contrôleur Principal 10ème échelon","Contrôleur Principal 11ème échelon",
		"Contrôleur stagiaire 1er échelon","Contrôleur stagiaire 2ème échelon",
		"Contrôleur stagiaire 3ème échelon","Contrôleur stagiaire 4ème échelon","Contrôleur stagiaire 5ème échelon",
		"Contrôleur stagiaire 6ème échelon","Contrôleur stagiaire 7ème échelon","Contrôleur stagiaire 8ème échelon",
		"Contrôleur stagiaire 9ème échelon","Contrôleur stagiaire 10ème échelon","Contrôleur stagiaire 11ème échelon",
		"Contrôleur stagiaire 12ème échelon","Contrôleur stagiaire 13ème échelon");
		
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
		"Interne Ex-Cat C AAP1 AAP2 ou ex-Cat B ou Ex-Cat A",
		"Interne Ex-Cat C AA1",
		"Interne ex-Cat C AA2");  
		
		$taiClass = new formObject();
		$taiClass->name = "Prime Informaticiens";
		$taiClass->formNameClass = "formName";
		$taiClass->formValueClass = "formValue";
		$taiClass->formSelectClass = "autosize";
		$taiClass->formRequired = "required";
		$taiClass->formName = "TAI";
		$taiClass->formIndexSelected = 0;
		
		$taiClass->valueArray=array("Pas de TAI","Programmeur depuis moins d'un an",
		"Programmeur depuis plus d'un an mais moins de 2 ans et demi","Programmeur au delà de 2ans et demi",
		"PSE  depuis moins d'un an","PSE depuis plus d'un an mais moins de 2 ans et demi","PSE au delà de 2 ans et demi");
		
		
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
        <input class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white" formtarget="_parent" formmethod="post" value="Lancer la simulation" name="Calcul" type="submit"/>
     </div>
     
     <br>
          
    </form>
   </body>
</html>
