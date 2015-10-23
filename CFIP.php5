<?php



# chargement du fichier xml contenant les données
$fichier = 'data/data.xml';
$xml = simplexml_load_file($fichier);

# point d'indice chargé depuis le xml
$gradeList = $xml->xpath("//data[@category='grades']/value");
$taiList = $xml->xpath("//data[@category='tai']/value");
$irList = $xml->xpath("//data[@category='ir']/value");
$echelonMap = $xml->xpath("//data[@category='echelons']/items");

# on récupère les valeurs sauvegardés du grade, du TAI et de l'indemnité de résidence
$gradeRestore = $_GET['grade'];
$taiRestore = $_GET['tai'];
$irRestore = $_GET['ir'];


# au premier lancement l'index du grade est à 0 sinon à la valeur sauvegardée dans l'URL
$echelonList = $echelonMap[$gradeRestore==NULL?0:$gradeRestore]->value;


?>

<script language="Javascript">
	
/** Get the index value of a select element in the document **/
function getValue(name){
	var selectElmt = document.getElementById(name);	
    var selectOpt = selectElmt.options[selectElmt.selectedIndex].value;
    return selectOpt;
}
	
function Actualiser() {
	
	// on recupère le grade
	var gradeString ="grade";
    var selectOpt = getValue(gradeString);

	// on récupère l'url courante
	var dest = window.location.href;

	// on recupère le dernier index du grade (celui ci étant placé en premier).
	var index = dest.lastIndexOf(gradeString);
	if(index >0){
		// on retire les anciennes variables sauvegardées
		dest = dest.substring(0,index-1);
	}
	
	// on sauvegarde le grade, le TAI, ainsi que la résidence pour pouvoir les restaurer par la suite
	var taiString="tai";
	var taiValue=getValue(taiString);
        
    var irString="ir";
	var irValue=getValue(irString);
           
	location.href = dest + "?"+gradeString+"="+selectOpt+"&"+taiString+"="+taiValue+"&"+irString+"="+irValue;
}
</script>


<!DOCTYPE html>
<html>
<head>
<title>Calcul traitement et salaire contrôleur des finances publiques</title>
<META name="keywords" content="salaire, calculateur, TSPEI, TSDD, TSPDD, TSCDD, TSCEI, CFiP, CTRL, Contrôleur des finances publiques">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
</head>

  <body>
    <form action="/CFIP1.php5" method="post" name="ts" target="_parent">
      <div style="text-align: center;"> <span style="font-family: Courier new,Arial,sans-serif;"><br>
        </span></div>
      <br>
      <table style="width: 944px; height: 11px;" border="0" cellpadding="2" cellspacing="1"
        align="center">
        <tbody>
          <tr>
            <td style="background-color: white; text-align: center;" valign="bottom"><font
                size="3"
                face="Arial, Helvetica, sans-serif"><strong><font
                    size="3"
                    face="Arial, Helvetica, sans-serif"><strong><a href="mailto:tatam3x@gmail.com"<span
                        style="color: #2257f6;">T3X</span></a>&nbsp
                      </strong></font>Simulation de salaire des Contrôleurs des finances publiques  &nbsp</strong></font><font size="3" face="Arial, Helvetica, sans-serif"><strong>
                </strong></font></td>
            <td><br>
            </td>
            <td valign="top" align="right"> <br>
              <font size="1" face="Arial, Helvetica, sans-serif" color="#666666"><strong></strong></font>
            </td>
          </tr>
          <tr>
            <td>
              <table width="75%" border="0" cellpadding="0" cellspacing="0" align="left">
              </table>
            </td>
          </tr>
        </tbody>
      </table>
      <table style="width: 740px;" align="center">
        <tbody>
          <tr>
            <td style="text-align: right;">Grade<br>
            </td>
            <td style="text-align: left;">
              <select onchange='Actualiser()' required="required" id="grade" name="grade">
				  <?php 
				  $gradeIndex=0;
				  $isGradeSelected="";
				  
				  # Affiche tous les grades
				  foreach($gradeList as $grade){
					  
					  if($gradeIndex==$gradeRestore){
						  $isGradeSelected='selected="selected"';
					  }
					  else{
						  $isGradeSelected="";
					  }
					  
					  echo '<option '.$isGradeSelected.' value="'.$gradeIndex.'">'.$grade.'</option>';
					  $gradeIndex++;
				  }
				  
				  ?>

              
              </select>
              <br>
            </td>
            <td style="height: 19.6px;"><br>
            </td>
          </tr>
          
          
           <tr>
            <td style="text-align: right;">Echelon<br>
            </td>
            <td style="text-align: left;">
              <select required="required" id="echelon" name="echelon">
				  <?php 
				  $echelonIndex=0;
				  $isEchelonSelected="";
				  
				  
				  # Affiche tous les grades
				  foreach($echelonList as $echelon){
					  $echelonValue=$echelon->attributes();
					 
					  if($echelonIndex==0){
						  $isEchelonSelected='selected="selected"';
					  }
					  else{
						  $isEchelonSelected="";
					  }
					  
					  echo '<option '.$isEchelonSelected.' value="'.$echelon.'">'.$echelonValue.'</option>';
					  $echelonIndex++;
				  }
				  
				  ?>

              
              </select>
              <br>
            </td>
            <td style="height: 19.6px;"><br>
            </td>
          </tr>
         
         
          
		  <tr>
            <td style="text-align: right;">Prime Informaticiens<br>
            </td>
            <td style="width: 137.166px;">
              <select required="required" name="TAI" id="tai">
			  <?php 
				  $taiIndex=0;
				  $isTaiSelected="";
				  
				  
				  # Affiche tous les grades
				  foreach($taiList as $tai){
					  $taiValue=$tai->attributes();
					 
					  if($taiIndex==$taiRestore){
						  $isTaiSelected='selected="selected"';
					  }
					  else{
						  $isTaiSelected="";
					  }
					  
					  echo '<option '.$isTaiSelected.' value="'.$taiValue.'">'.$tai.'</option>';
					  $taiIndex++;
				  }
				  
				  ?>
              </select>
              <br>
            </td>
            <td style="width: 417.033px;"><br>
            </td>
          </tr>
          <tr>
            <td style="text-align: right;">Indemnité de résidence<br>
            </td>
            <td>
              <select required="required" name="IR" id="ir">
                 <?php 
				  $irIndex=0;
				  $isIrSelected="";
				  
				  
				  # Affiche tous les grades
				  foreach($irList as $ir){
					  $irValue=$ir->attributes();
					 
					  if($irIndex==$irRestore){
						  $isIrSelected='selected="selected"';
					  }
					  else{
						  $isIrSelected="";
					  }
					  
					  echo '<option '.$isIrSelected.' value="'.$irValue.'">'.$ir.'</option>';
					  $irIndex++;
				  }
				  
				  ?>
              </select>
              <br>
            </td>
            <td style="background-color: white;"><span style="color: #0000ee;"><span
                  style="text-decoration: underline;"><br>
                </span></span></td>
          </tr>
          <tr>
            <td colspan="2" rowspan="1" style="text-align: center; height: 11px;"><input
                formtarget="_parent"
                formmethod="post"
                value="Lancer la simulation"
                name="Calcul"
                type="submit"><br>
            </td>
            <td><br>
            </td>
          </tr>
          <tr>
            <td style="height: 55px; width: 171.717px;"><br>
            </td>
            <td style="text-align: center; height: 55px;"><br>
            </td>
            <td style="background-color: white;"><br>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </body>
</html>
