<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
 <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <!-- Material Design icon font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="styles/navbar.css"/>
</head>

<?php
// Fonction qui retourne vrai si on a un lien dans la barre d'adresse
function hasLink(){
	return ( isset( $_GET['link'] ) && !empty( $_GET['link'] ) );
}

// Ici la liste des pages TODO: externaliser dans un fichier xml
$listePages=array("AAFIP.php","CFIP.php","IFIP.php");
$listePageName=array("Agents Administratifs des Finances Publiques","Contrôleur des Finances Publiques","Inspecteur des Finances Publiques");      

// si un lien est fourni, alors on le met dans une variable
if ( hasLink() ){
	$pageLinkSelected=$_GET["link"];
}
// sinon on lui donne une valeur par défaut
else{
	$pageLinkSelected=$listePages[0];
}

if( $pageLinkSelected=="fichePaie.php" ){
	$pageTitle="Fiche de paie";
}
else{
for($i = 0; $i < count($listePages); ++$i) {
	$pageLink=$listePages[$i];
	if( $pageLink==$pageLinkSelected ){
		$pageTitle=$listePageName[$i];
	}
}
}

?>


<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      
      
      <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title"><?php echo $pageTitle ?></span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
			<?php  // Partie affichage des liens de la navbar
for($i = 0; $i < count($listePages); ++$i) {

	$pageLink=$listePages[$i];
	$pageName = basename($pageLink, ".php");

	if( $pageLink==$pageLinkSelected ){
		$pageClass='class="active"';
	}
	else{
		$pageClass="";
	}
	echo '<a  class="mdl-navigation__link" '.$pageClass.' href="?link='.$pageLink.'">'.$pageName.'</a>';
	
}
?>
      </nav>
    </div>
  </header>
			
 <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Salaire pour ...</span>
        <nav class="mdl-navigation">
			<?php  // Partie affichage des liens de la navbar
for($i = 0; $i < count($listePages); ++$i) {

	$pageLink=$listePages[$i];
	$pageName = basename($pageLink, ".php");

	if( $pageLink==$pageLinkSelected ){
		$pageClass='class="active"';
	}
	else{
		$pageClass="";
	}
	echo '<a  class="mdl-navigation__link" '.$pageClass.' href="?link='.$pageLink.'">'.$pageName.'</a>';
	
}
?>
        </nav>
        <br>
        <hr>
        <br>
         <a href="mailto:tatam3x@gmail.com" id="send-mail2" class="mdl-button mdl-js-button mdl-js-ripple-effect">Une question ?</a>
      </div>
 		
	
 <main class="mdl-layout__content">

	<div id="result">
<?php
// si un link est fourni alors on affiche cette page
if ( hasLink()){
   include $_GET["link"];
}
else{
  // par défault, on lanche AAFIP.php
   include 'AAFIP.php';
}

?>

	</div>
   </main>
</div>
</body>

</html>


