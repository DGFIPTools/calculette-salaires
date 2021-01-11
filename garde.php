<?php
session_start();


// Fonction qui retourne vrai si on a un lien dans la barre d'adresse
function hasLink(){
	return ( isset( $_GET['link'] ) && !empty( $_GET['link'] ) );
}

function getUrlParameters(){
	return array_slice(explode("/", $_SERVER['REQUEST_URI']),2);
}

// Ici la liste des pages TODO: externaliser dans un fichier xml
$listePages=array("AAFIP","CFIP","IFIP");
$listePageName=array("Agents Administratifs des Finances Publiques","Contrôleur des Finances Publiques","Inspecteur des Finances Publiques");      


for($i = 0; $i < count($listePages); ++$i) {

	$pageName=$listePages[$i];

	if( $pageName==$pageLinkSelected ){
		$pageClass='class="active"';
	}
	else{
		$pageClass="";
	}
	echo '<a  class="mdl-navigation__link" '.$pageClass.' href="?link='.$pageName.'">'.$pageName.'</a>';
	
}

?>


