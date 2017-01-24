<?php session_start();?>
<html>
<head>
<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="js/loadQuery.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="styles/main_menu.css">
</head>

<body>
 <header>
<nav id="menu">
        <ul>
        		<li><a id="aafip" href="?link=AAFIP.php5" link="AAFIP.php5">AAFIP</a></li>
        		<li><a id="cfip" href="?link=CFIP.php5"link="CFIP.php5">CFIP</a></li>
        		<li><a id="ifip" href="?link=IFIP.php5" link="IFIP.php5">IFIP</a></li>
        </ul>

</nav>
</header>

<div id="result">


<?php
// si un link est fourni alors on affiche cette page
if ( isset( $_GET['link'] ) && !empty( $_GET['link'] ) ){
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


