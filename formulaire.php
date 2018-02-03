<table class="rmdl-data-table mdl-shadow--2dp" align="center">
	<tbody>

		<!-- Ici on reprend les objets créés  -->	
		<?php
		foreach ($formObjectsArray as $formObject) {
			echo "\n<tr>";
			echo "\n<td class='"."$formObject->formNameClass"."'>"."$formObject->name"."<br></td>";
			echo "\n<td class ='"."$formObject->formValueClass"."'>";
			echo "\n<select class='"."$formObject->formSelectClass"."' required='"."$formObject->formRequired"."' name='"."$formObject->formName"."'>";

			for($i = 0; $i < count($formObject->valueArray); ++$i) {
				($i == ($formObject->formIndexSelected))?$optionSelected=' selected="selected"':$optionSelected='';
    			
    			
				echo "\n<option".$optionSelected." value='".($i+1)."'>".$formObject->valueArray[$i]."</option>";
			}
			echo "\n</select>";
			echo "\n</td>";
			echo "\n</tr>\n";
    	}
		?>
		     
	</tbody>
</table>
<br>
<br>
