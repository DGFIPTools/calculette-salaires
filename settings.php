<?php
if (! isset($_SESSION)) {
    session_start();
}

function drawSetting($label, $id, $value)
{
    echo ' <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet mdl-cell--4-col-phone">';
    echo '<div class="mdl-shadow--2dp">';

    echo '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">';
    echo '<input class="mdl-textfield__input"  pattern="[0-9]+[.][0-9]+" type="text" id="' . $id . '" value="' . $value . '"">';
    echo '<label class="mdl-textfield__label" for="' . $id . '">' . $label . '</label>';
    echo '	  </div>';
    #echo '<label id="indicator_'.$id.'">+2%</label>';
    echo '	</div>';

    echo '</div>';
    
}

function loadDefaults()
{}

?>

<script>



  function showSnackbar(clr) {
   var snackbarContainer = document.getElementById('snackbarContainer');
    var data = {message: clr};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
  };

function reset(){
	
	myArray = document.querySelectorAll('.mdl-textfield__input');
	console.log(myArray.length);
	
	idArray = new Array(myArray.length);
	
	
	for (let i = 0; i < myArray.length; i++) {
		idArray[i]=myArray[i].id;
	}
	
	var jsonId = JSON.stringify(idArray);
		
	$.ajax({
		url:'php/updateSettings.php',
		method:'POST',
		data:{
			id:jsonId
		},
		success:function(data){
			document.querySelector("#pointIndice").value = data;
			showSnackbar("Paramètres réinitialisés " +data);
	   },
		 error: function(jqxhr, status, exception) {
			 alert('Exception:', exception+status+jqxhr);
		 }
	   
	});
}

function update() {
	
	myArray = document.querySelectorAll('.mdl-textfield__input');
	console.log(myArray.length);
	
	idArray = new Array(myArray.length);
	valueArray = new Array(myArray.length);
	
	
	for (let i = 0; i < myArray.length; i++) {
		idArray[i]=myArray[i].id;
		valueArray[i]=myArray[i].value;
	}
	
	var jsonId = JSON.stringify(idArray);
	var jsonValue = JSON.stringify(valueArray);
		
	$.ajax({
		url:'php/updateSettings.php',
		method:'POST',
		data:{
			id:jsonId,
			value:jsonValue
		},
		success:function(data){
			showSnackbar("Mise à jour effectuée avec succcès ");
	   },
		 error: function(jqxhr, status, exception) {
			 alert('Exception:', exception+status+jqxhr);
		 }
	   
	});
}

</script>



<div class="mdl-grid">
	<!--   <div class="mdl-layout-spacer"></div> -->
	
 
	
	 <?php
drawSetting("Valeur du point indice", "pointIndice", "" . $_SESSION['pointIndice']);
?>


	
   <!--     <div class="mdl-layout-spacer"></div> -->
</div>

<div class="titleForm">
	<input
		class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white"
		onClick="update()" value="Mettre à jour" name="MAJ" /> <input
		class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white"
		onClick="reset()" value="Réinitialiser" name="RAZ" />
</div>

<div id="snackbarContainer" class="mdl-js-snackbar mdl-snackbar">
	<div class="mdl-snackbar__text"></div>
	<button class="mdl-snackbar__action" type="button"></button>
</div>


