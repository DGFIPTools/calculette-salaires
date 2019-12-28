<div id="snackbarContainer" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>



<script language="javascript" type="text/javascript">

  function showSnackbar(elmnt,clr) {
   var snackbarContainer = document.getElementById('snackbarContainer');
    var data = {message: clr};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
  };

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}


function doReload(name,value){

	var link2 = getUrlVars();
	var linkUrl ="";

	let cpt = 0;

	if(name == "Grade"){
		link2[name]=value;
	}

	for (var key in link2) {
		if(cpt++ == 0){
			linkUrl="?"+key+"="+link2[key];
		}
		else{
			linkUrl=linkUrl+"&"+key+"="+link2[key]
		}

		cpt++;
	}
	

	var stateObj = history.state;
	if(stateObj == undefined) {
		stateObj = {};
	}
	console.log(""+name)

	if(name == "PSOURCE"){
		stateObj[name]=value;
	}
	else{
		stateObj[name]=value-1;
	}
	
	history.replaceState(stateObj, null, location.origin + location.pathname + linkUrl);
	if(name == "Grade"){
		document.location.reload(true);
	}
}
</script>



<table  class="rmdl-data-table mdl-shadow--2dp" >
	<tbody>

		<!-- Ici on reprend les objets créés  -->	
		<?php
		function startsWith ($string, $startString) 
		{ 
			$len = strlen($startString); 
			return (substr($string, 0, $len) === $startString); 
		} 

		
		foreach ($formObjectsArray as $formObject) {

			$isReload=$formObject->mustRefresh;
			$isReloadTxt="";

			if($isReload=="1"){
				$isReloadTxt="onChange='doReload(\"".$formObject->formName."\",this.value);'";
			}
			
			$isHelp=$formObject->helpText;

			echo "\n<tr>";
			echo "\n<td class='"."$formObject->formNameClass"."'>"."$formObject->name"."<br></td>";
			echo "\n<td>";
			
			# Barre d'aide
			if( ! empty($isHelp)){
				# Si lien alors ouvrir page web
				if(startsWith($isHelp,"http")){
					$onClickAction="window.open('".$isHelp."')";
				}
				# sinon Snackbar
				else{
					$onClickAction="showSnackbar(this, '".$isHelp."')";
				}
				
				echo "\n<button style=\"padding: 0px 0px; min-width: initial;\" type=\"button\" onclick=\"".$onClickAction."\" class=\"mdl-button mdl-js-button mdl-button--min-fab mdl-button--colored\"><i class=\"material-icons\">help</i></button> <br>";

			}
			echo "\n</td>";
			echo "\n<td class ='"."$formObject->formValueClass"."'>";
	
			#
			$isInput=$formObject->formType;			
			if( ! empty($isInput)){
					
					echo '<input '.$isReloadTxt.' type="'.$isInput.'" name='."$formObject->formName".' placeholder="Ex : 5,6" step="0.1" min="0" max="43"></input>';
			}
			# Select classique
			else{
					echo "\n<select ".$isReloadTxt."class='"."$formObject->formSelectClass"."'  required='"."$formObject->formRequired"."' name='"."$formObject->formName"."'>";

					for($i = 0; $i < count($formObject->valueArray); ++$i) {
						($i == ($formObject->formIndexSelected))?$optionSelected=' selected="selected"':$optionSelected='';
						echo "\n<option".$optionSelected." value='".($i+1)."'>".$formObject->valueArray[$i]."</option>";
					}
					echo "\n</select>";
			}
		
			if($isReload=="1"){
				
				if( ! empty($isInput)){
					echo '<script type="text/javascript">',
					'document.getElementsByName("'.$formObject->formName.'")[0].value=history.state["'.$formObject->formName.'"];',
					'</script>';
				}
				else{
					 echo '<script type="text/javascript">',
					'document.getElementsByName("'.$formObject->formName.'")[0].selectedIndex=history.state["'.$formObject->formName.'"];',
					'</script>';
				}
					
	
			}

			echo "\n</td>";
			echo "\n</tr>\n";
    	}
		?>
		     
	</tbody>
</table>
<br>
<br>
