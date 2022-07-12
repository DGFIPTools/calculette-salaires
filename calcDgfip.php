<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/jquery-3.4.1.min.js"></script>
<script src="scripts/material.min.js"></script>
<link rel="stylesheet" type="text/css"
	href="styles/material.indigo-pink.min.css">
<!-- Material Design icon font -->
<link rel="stylesheet" type="text/css" href="styles/material_icon.css">
<link rel="stylesheet" type="text/css" href="styles/navbar.css" />
</head>

<?php



// Fonction qui retourne vrai si on a un lien dans la barre d'adresse
function hasLink()
{
    return (isset($_GET['link']) && ! empty($_GET['link']));
}

function getUrlParameters()
{
    return array_slice(explode("/", $_SERVER['REQUEST_URI']), 2);
}

if (! isset($_SESSION['pointIndice'])) {
    $dataGenericFile = 'data/data.xml';
    $xmlGeneric = simplexml_load_file($dataGenericFile);
    $pointIndiceTab = ($xmlGeneric->xpath("//data[@category='pointIndice']/value"));
    $Point = floatval($pointIndiceTab[0]);
    $_SESSION['pointIndice'] = $Point;
}

// Ici la liste des pages TODO: externaliser dans un fichier xml
$listePages = array(
    "AAFIP",
    "CFIP",
    "IFIP"
);
$listePagesArr = array(
    "Agent",
    "Contrôleur",
    "Inspecteur"
);
$listePageName = array(
    "Agents Administratifs des Finances Publiques",
    "Contrôleur des Finances Publiques",
    "Inspecteur des Finances Publiques"
);

// si un lien est fourni, alors on le met dans une variable
if (hasLink()) {
    $pageLinkSelected = $_GET["link"];
} // sinon on lui donne une valeur par défaut
else {
    $pageLinkSelected = $listePages[0];
}

if ($pageLinkSelected == "fichePaie") {
    $pageTitle = "Fiche de paie";
} else if ($pageLinkSelected == "settings") {
    $pageTitle = "Paramètres ( Béta )";
} else {
    for ($i = 0; $i < count($listePages); ++ $i) {
        $pageLink = $listePages[$i];
        if ($pageLink == $pageLinkSelected) {
            $pageTitle = $listePageName[$i];
        }
    }
}

?>


<body
	class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">


		<header class="mdl-layout__header">
			<div class="mdl-layout__header-row">
				<!-- Title -->
				<span id="titlePage" class="mdl-layout-title"><?php echo $pageTitle ?></span>
				<!-- Add spacer, to align navigation to the right -->
				<div class="mdl-layout-spacer"></div>
				<!-- Navigation. We hide it in small screens. -->
				<nav class="mdl-navigation mdl-layout--large-screen-only">
			<?php
// Partie affichage des liens de la navbar
for ($i = 0; $i < count($listePages); ++ $i) {

    $pageNameLink = $listePages[$i];
    $pageName = $listePagesArr[$i];

    if ($pageNameLink == $pageLinkSelected) {
        $pageClass = "active";
    } else {
        $pageClass = "";
    }
    echo '<a  class="mdl-navigation__link ' . $pageClass . '" href="?link=' . $pageNameLink . '">' . $pageName . '</a>';
}
?>
      </nav>
			</div>
		</header>

		<div class="mdl-layout__drawer">
			<span class="mdl-layout-title">Salaire pour ...</span>
			<nav class="mdl-navigation">
			<?php
// Partie affichage des liens de la navbar
for ($i = 0; $i < count($listePages); ++ $i) {

    $pageNameLink = $listePages[$i];
    $pageName = $listePagesArr[$i];

    if ($pageNameLink == $pageLinkSelected) {
        $pageClass = 'active';
    } else {
        $pageClass = "";
    }
    echo '<a  class="mdl-navigation__link ' . $pageClass . '" href="?link=' . $pageNameLink . '">' . $pageName . '</a>';
}
?>
</nav>

			<hr>

			<a class="mdl-button mdl-js-button mdl-js-ripple-effect"
				style="font-weight: bold;" href="?link=settings">Paramètres</a>

			<hr>



			<a href="mailto:tatam3x@gmail.com" id="send-mail2"
				style="font-weight: bold;"
				class="mdl-button mdl-js-button mdl-js-ripple-effect">Une question ?</a>

			<span style="padding: 20px;">
		
		<?php

$historyFile = 'data/historique.xml';
$xmlHistory = simplexml_load_file($historyFile);
$history = ($xmlHistory->xpath("//history[1]"));

echo "Version " . ($history[0]->attributes()->version) . " du " . ($history[0]->attributes()->date);

?>
		
		</span>




		</div>


		<main class="mdl-layout__content">

			<div id="result">
<?php
// si un link est fourni alors on affiche cette page
if (hasLink()) {
    include $pageLinkSelected . ".php";
} else {
    // par défault, on lanche AAFIP.php
    include 'AAFIP.php';
}

?>



	</div>
		</main>
	</div>
</body>

</html>


