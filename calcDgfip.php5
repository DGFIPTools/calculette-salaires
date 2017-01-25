<?php session_start();?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="styles/navbar.css">
</head>



<body>
	<header>
		<nav id="menu">
			<ul>
			
<?php
// Fonction qui retourne vrai si on a un lien dans la barre d'adresse
function hasLink(){
	return ( isset( $_GET['link'] ) && !empty( $_GET['link'] ) );
}

// Ici la liste des pages TODO: externaliser dans un fichier xml
$listePages=array("AAFIP.php5","CFIP.php5","IFIP.php5");
      

// si un lien est fourni, alors on le met dans une variable
if ( hasLink() ){
	$pageLinkSelected=$_GET["link"];
}
// sinon on lui donne une valeur par défaut
else{
	$pageLinkSelected=$listePages[0];
}


// Partie affichage des liens de la navbar
for($i = 0; $i < count($listePages); ++$i) {

	$pageLink=$listePages[$i];
	$pageName = basename($pageLink, ".php5");
	
	if( $pageLink==$pageLinkSelected ){
		$pageClass='class="active"';
	}
	else{
		$pageClass="";
	}
	
	echo '<li><a '.$pageClass.' href="?link='.$pageLink.'" link="'.$pageLink.'">'.$pageName.'</a></li>';
}
?>
 		
			</ul>
		</nav>
	</header>

	<div id="result">
<?php
// si un link est fourni alors on affiche cette page
if ( hasLink()){
   include $_GET["link"];
}
else{
  // par défault, on lanche AAFIP.php5
   include 'AAFIP.php5';
}

?>

	</div>


</body>

</html>


