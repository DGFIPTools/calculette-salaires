<?php
session_start(); 

$IsStagiaire=$_SESSION["stagiaire"];
$QUALIF=$_SESSION["Qualif"];
$Echelon=$_SESSION["Echelon"];
$Indice=$_SESSION["Indice"];
$Grade=$_SESSION["Grade"];
$quotite=$_SESSION["Quotite"];

?>
<!DOCTYPE html>
<html>
  <head>
  <title>Fiche de paie <?php echo $Grade ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  		<link rel="stylesheet" type="text/css" href="styles/adaptive.css"/>
      <link rel="stylesheet" type="text/css" href="styles/fichePaie.css"/>
  </head>
  <body>
  
	
  	<h5> <?php echo   $Grade." "."$IsStagiaire"."$QUALIF - Echelon : ".$Echelon." (".$Indice.") (".$quotite.")"; ?> </h5>

    <table  border="0" align="center">
      <thead>
         <tr>
            <th class="headTitle"></th>
            <th class="headCel">A PAYER</th>
            <th class="headCel">A DEDUIRE </th>
         </tr>
      </thead>
      <tbody>
      
      
      <?php
      
      $elementFichePaie=$_SESSION["elementFichePaie"];
      
      for($i = 0; $i < count($elementFichePaie); ++$i) {
    		
    		
    		# On affiche une couleur toutes les 2 lignes
    		$titleColor="";
    		$elementColor="";
    		
    		
    		if(($i % 2) == 0){
    			$titleColor="titleFicheColor";
    			$elementColor="celFicheColor";
    		}
    		
    		if( $elementFichePaie[$i]['evaluation']=="+" ){
    			$elementDebit=$elementFichePaie[$i]['value'];
    			$elementCredit="";
    		}
    		else{
    			$elementCredit=$elementFichePaie[$i]['value'];
    			$elementDebit="";
    		}
    		
      	echo "<tr>";
    		echo '<td class="titleFiche '.$titleColor.'">'.$elementFichePaie[$i]['name'].'</td>';
    		echo '<td class="celFiche '.$elementColor.'">'."$elementDebit"."</td>";
    		echo '<td class="celFiche '.$elementColor.'">'."$elementCredit"."</td>";
    		echo "</tr>";
		}
      
       
      
      ?>
      
       
       
       
        
        <tr>
          <td class="footCelColor">TOTAUX</td>
          <td class="footCelColor footCelText"><?php echo $_SESSION["Total_revenues"]; ?></td>
          <td class="footCelColor footCelText"><?php echo $_SESSION["Total_retenues"]; ?></td>
        </tr>
        <tr  class="footSpaceValue">
          <td>
          <td>
          <td>
        </tr>
        <tr>
          <td class="titleFicheColor">NET A PAYER AVANT IMPÔT SUR LE REVENU</td>
          <td class="celFicheColor footCelText"></td>
		   <td id="paye_net" class="footCelText celFicheColor"><?php echo $_SESSION["Total_net"]." &euro;"; ?></td>
        </tr>
		
		 <tr>
          <td class="titleFiche">IMPÔT SUR LE REVENU ( Taux de <?php echo $_SESSION["PLTaux"]."%"?> )</td>
          <td class="celFiche"></td>
         <td class="celFiche" id="impot_revenu"><?php echo $_SESSION["PLSource"]." &euro;"; ?></td>
        </tr>
		
		 <tr>
          <td class="footCelColor">NET A PAYER</td>
          <td class="footCelColor footCelText"></td>
         <td id="paye_net_ps" class="footCelText footCelColor"><?php echo $_SESSION["Total_net_ps"]." &euro;"; ?></td>
        </tr>
      </tbody>
    </table>
    <br/>
<?php 
include 'compteur.php';
?>
<br>

<br>
</p>
  </body>
</html>
