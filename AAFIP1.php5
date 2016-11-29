

<?php

$INM="";
# chargement du fichier xml contenant les données
$dataFile = 'data/data.xml';
$xml = simplexml_load_file($dataFile);

# point d'indice chargé depuis le xml
$pointIndiceTab=($xml->xpath("//data[@category='point_indice']/value"));
$Point = floatval($pointIndiceTab[0]); 

$retenuPcTab=($xml->xpath("//data[@category='retenu_pension_civile']/value"));
$RetenuPC = floatval($retenuPcTab[0]); 
$stag=0;

$Tableau_Echelon=array("0","323","324","325","326","327","329","3332","345","354","368","375","382","0","326","327","328","330","332","339","346","360","376","385","398","407","0","338","345","355","370","385","400","422","436","462");

if (isset($_POST["Echelon"]))


$INM=$Tableau_Echelon[$_POST["Echelon"]];
$Traitement_indiciaire= $INM*$Point;
$IAT=0.0833*$Traitement_indiciaire;
$IMT=101.98;    
$IR=$_POST["IR"]*$Traitement_indiciaire/100;
$ACF= 1211.10/12;
    
	
/*echo "<br/><td>"."Traitement indiciaire: ".round ($Traitement_indiciaire,2, PHP_ROUND_HALF_EVEN)."</td>";
$ISS=$CMI*$CS*14.5
$Traitement_Brut=$Traitement_indiciaire+$ISS+$PSR+$SFT+$IR*/
/*echo "INM=$INM<br/>"; */
if ($_POST["TAI"]==1)
{$TAI=255.27;}
elseif ($_POST["TAI"]==2)
{$TAI=296.44;}
elseif ($_POST["TAI"]==3)
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




$Traitement_Brut=$Traitement_indiciaire+$IMT+$IAT+$PR+$ACF+$IR+$TAI;
$PC=$Traitement_indiciaire*$RetenuPC;
$RIMT=101.98*20/100;
$CSG=0.075*$Traitement_Brut*98.25/100;
$CRDS=0.005*$Traitement_Brut*98.25/100;
$RAFP=$Traitement_indiciaire/100;
$CS=0.01*($Traitement_indiciaire+$IMT+$IAT+$PR+$ACF+$IR+$TAI-$RIMT-$PC-$RAFP);



$Total_net=$Traitement_Brut+$stag-($PC+$RIMT+$CSG+$CRDS+$CS+$RAFP);
$Total_retenues=$PC+$CSG+$CRDS+$RIMT+$CS+$RAFP;

$T=$stag+$Traitement_Brut;
$RAFP=number_format($RAFP,2);
$T=number_format($T,2);
$Traitement_Brut=number_format(($Traitement_Brut),2);
$CSG=number_format($CSG,2);
$CRDS=number_format($CRDS,2);
$CS=number_format($CS,2);
$RIMT=number_format($RIMT,2);
$ACF = number_format($ACF,2);
$IAT= number_format($IAT,2);
$PR = number_format($PR,2);
$PC=number_format($PC,2);
$IR=number_format($IR,2);
$TAI=number_format($TAI,2);
$Total_net=number_format($Total_net,2);
$Total_retenues=number_format($Total_retenues,2);
$Traitement_indiciaire= number_format($Traitement_indiciaire,2);
/*echo "<tr><td>Traitement indiciaire=$Traitement_indiciaire</td></tr><br>ACF=$ACF<br/>IAT=$IAT<br/>PR=$PR<br/>IMT=$IMT<br/>Traitement Brut=$Traitement_Brut<br/>PC=$PC<br/>CSG=$CSG<br/>CRDS=$CRDS<br/>RAF¨=$RAFP<br/>CS=$CS<br/>IR=$IR<br/>Total des retenues=$Total_retenues<br/>Total Net=$Total_net";*/

?><!DOCTYPE html>
<html>
  <head>
   
  </head>
  <body>
    <table style="width: 691px; height: 404px;" border="0" align="center">
      <tbody>
       
	   <tr>
           <td style="margin-left: 257px; width: 443.767px;"><br>
          </td>
          <td style="background-color: #ff8f8c; margin-left: -288px; text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000>A
            PAYER</td>
          <td style="background-color: #ff8f8c; text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000>A DEDUIRE</td>
        </tr>
        <tr>
          <td style="background-color: #ffffcc;"><font size="1" face="Arial, Helvetica, sans-serif">TRAITEMENT BRUT</td>
          <td style="background-color: #ffcccc; width: 177.583px; text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$Traitement_indiciaire"; ?><br>
          </td>
          <td style="background-color: #ffcccc; width: 172.683px; text-align: center;"><br>
          </td>
        </tr>
        <tr>
          <td><font size="1" face="Arial, Helvetica, sans-serif">RETENUE PENSION CIVIL</td>
          <td style="background-color: #ffcccc;"><br>
          </td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$PC"; ?><br>
          </td>
        </tr>
        <tr>
          <td style="background-color: #ffffcc;"><font size="1" face="Arial, Helvetica, sans-serif">RETENUE PENSION CIVIL IMT</td>
          <td style="background-color: #ffcccc;"><br>
          </td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$RIMT"; ?><br>
          </td>
        </tr>
        <tr>
          <td><font size="1" face="Arial, Helvetica, sans-serif">INDEMNITE STAGE LINEAIRE </td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$stag"; ?><br>
          </td>
          <td style="background-color: #ffcccc;text-align: center;"><br>
          </td>
        </tr>
        <tr>
          <td style="background-color: #ffffcc;"><font size="1" face="Arial, Helvetica, sans-serif">IMT</td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$IMT"; ?><br>
          </td>
          <td style="background-color: #ffcccc;"><br>
          </td>
        </tr>
        <tr>
          <td><font size="1" face="Arial, Helvetica, sans-serif">IFTS</td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$IAT"; ?><br>
          </td>
          <td style="background-color: #ffcccc;text-align: center;"><br>
          </td>
        </tr>
        <tr>
          <td style="background-color: #ffffcc;"><font size="1" face="Arial, Helvetica, sans-serif">ACF TECH.</td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$ACF"; ?><br>
          </td>
          <td style="background-color: #ffcccc;text-align: center;"><br>
          </td>
        </tr>
        <tr style="height: 24.2px;">
          <td><font size="1" face="Arial, Helvetica, sans-serif">PRIME DE RENDEMENT</td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$PR"; ?><br>
          </td>
          <td style="background-color: #ffcccc;text-align: center;"><br>
          </td>
        </tr>
        <tr>
          <td style="background-color: #ffffcc;"><font size="1" face="Arial, Helvetica, sans-serif">INDEMNITE DE RESIDENCE</td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$IR"; ?><br>
          </td>
          <td style="background-color: #ffcccc;"><br>
          </td>
        </tr>
        <tr>
          <td><font size="1" face="Arial, Helvetica, sans-serif">CSG</td>
          <td style="background-color: #ffcccc;"><br>
          </td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$CSG"; ?><br>
          </td>
        </tr>
        <tr>
          <td style="background-color: #ffffcc;"><font size="1" face="Arial, Helvetica, sans-serif">CRDS</td>
          <td style="background-color: #ffcccc;"><br>
          </td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$CRDS"; ?><br>
          </td>
        </tr>
         <tr>
          <td><font size="1" face="Arial, Helvetica, sans-serif">RAFP</td>
          <td style="background-color: #ffcccc;"><br>
          </td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$RAFP"; ?><br>
          </td>
        </tr>
       
		 <tr>
          <td style="background-color: #ffffcc;"><font size="1" face="Arial, Helvetica, sans-serif">TAI</td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$TAI"; ?><br>
          </td>
          <td style="background-color: #ffcccc;"><br>
          </td>
   <tr>
          <td><font size="1" face="Arial, Helvetica, sans-serif">C. SOLIDARITE</td>
          <td style="background-color: #ffcccc;"><br>
          </td>
          <td style="background-color: #ffcccc;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$CS"; ?><br>
          </td>
        </tr>
   
        <tr>
          <td style="background-color: #ff8f8c;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000>TOTAUX</td>
          <td style="background-color: #ff8f8c;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$T"; ?><br>
          </td>
          <td style="background-color: #ff8f8c;text-align: center;"><font size="3" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$Total_retenues"; ?><br>
          </td>
        </tr>
        <tr>
          <td><br>
          </td>
          <td style="width: 325.767px;"><br>
          </td>
          <td style="width: 326px;"><br>
          </td>
        </tr>
        <tr>
          <td style="background-color: #ff8f8c;"><font size="4" face="Arial, Helvetica, sans-serif" color=#000000>NET A PAYER</td>
          <td style="background-color: #ff8f8c;"><br>
          </td>
          <td style="background-color: #ff8f8c;text-align: center;"><font size="4" face="Arial, Helvetica, sans-serif" color=#000000><?php echo "$Total_net"; ?><br>
          </td>
        </tr></font>
      </tbody>
    </table>

<script type="text/javascript" src="http://compteur.websiteout.net/js/12/0/10/0">
</script>   visiteurs.
<br>
MAJ le 13/06/2016
<br>
<br>
Version 1.1


<?
/*require("compteur.php");*/
?>
<br>
    </p>
  </body>
</html>
