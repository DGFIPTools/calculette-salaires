<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
 <link rel="stylesheet" type="text/css" href="styles/adaptive.css"/>
  <link rel="stylesheet" type="text/css" href="styles/formulaire.css"/>
<title>Calcul traitement et salaire Agents Administratifs des Finances Publiques</title>
<META name="keywords" content="salaire, calculateur, AAFIP, IFIP, CFiP, CTRL, Inspecteur des finances publiques">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
</head>

  <body>
    <form action="/AAFIP1.php5" method="post" name="ts" target="_parent">
      
      <p class="titleForm"><a href="mailto:tatam3x@gmail.com">T3X</a>&nbsp; Simulation de salaire des Agents Administratifs des Finances Publiques  &nbsp;</p>
      
      <?php
      include 'utils.php5';
      $echelonClass = new formObject();
		$echelonClass->name = "Echelon";
		$echelonClass->formNameClass = "formName";
		$echelonClass->formValueClass = "formValue";
		$echelonClass->formSelectClass = "autosize";
		$echelonClass->formRequired = "required";
		$echelonClass->formName = "Echelon";
		$echelonClass->formIndexSelected = 0;
		
		$echelonClass->valueArray=array(
		"Agent 1ère classe 1er échelon","Agent 1ère classe 2ème échelon","Agent 1ère classe 3ème échelon",
		"Agent 1ère classe 4ème échelon","Agent 1ère classe 5ème échelon","Agent 1ère classe 6ème échelon",
		"Agent 1ère classe 7ème échelon","Agent 1ère classe 8ème échelon","Agent 1ère classe 9ème échelon",
		"Agent 1ère classe 10ème échelon","Agent 1ère classe 11ème échelon",
		
		"Agent Principal 2ème classe 1er échelon","Agent Principal 2ème classe 2ème échelon","Agent Principal 2ème classe 3ème échelon",
		"Agent Principal 2ème classe 4ème échelon","Agent Principal 2ème classe 5ème échelon","Agent Principal 2ème classe 6ème échelon",
		"Agent Principal 2ème classe 7ème échelon","Agent Principal 2ème classe 8ème échelon","Agent Principal 2ème classee 9ème échelon",
		"Agent Principal 2ème classe 10ème échelon","Agent Principal 2ème classe 11ème échelon","Agent Principal 2ème classe 12ème échelon",
		
		"Agent Principal 1ère classe 1er échelon","Agent Principal 1ère classe 2ème échelon","Agent Principal 1ère classe 3ème échelon",
		"Agent Principal 1ère classe 4ème échelon","Agent Principal 1ère classe 5ème échelon","Agent Principal 1ère classe 6ème échelon",
		"Agent Principal 1ère classe 7ème échelon","Agent Principal 1ère classe 8ème échelon","Agent Principal 1ère classe 9ème échelon","Agent Principal 1ère classe 10ème échelon");
		
		
		$idfClass = new formObject();
		$idfClass->name = "Affectation en Ile de france";
		$idfClass->formNameClass = "formName";
		$idfClass->formRequired = "required";
		$idfClass->formName = "IDF";
		$idfClass->formValueClass = "formValue";
		$idfClass->formSelectClass = "autosize";
		$idfClass->formIndexSelected = 0;
		
		$idfClass->valueArray=array("NON","OUI");
		
		
		$taiClass = new formObject();
		$taiClass->name = "Prime Informaticiens";
		$taiClass->formNameClass = "formName";
		$taiClass->formValueClass = "formValue";
		$taiClass->formSelectClass = "autosize";
		$taiClass->formRequired = "required";
		$taiClass->formName = "TAI";
		$taiClass->formIndexSelected = 0;
		 
		
		$taiClass->valueArray=array("Pas de TAI","PAU depuis moins d'un an",
		"PAU depuis plus d'un an mais moins de 2 ans et demi","PAU au delà de 2ans et demi");
		
		
		$irClass = new formObject();
		$irClass->name = "Indemnité de résidence";
		$irClass->formNameClass = "formName";
		$irClass->formRequired = "required";
		$irClass->formName = "IR";
		$irClass->formIndexSelected = 0;
		
		$irClass->valueArray=array("0%","1%","3%");

		
		$formObjectsArray = array($echelonClass,$taiClass,$irClass,$idfClass);
		
		include 'formulaire.php5';
      ?>
      
     <div class="titleForm">
        <input formtarget="_parent" formmethod="post" value="Lancer la simulation" name="Calcul" type="submit"/>
     </div>
          
    </form>
  </body>
</html>
