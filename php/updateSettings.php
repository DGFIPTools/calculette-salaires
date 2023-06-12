<?php
if(!isset($_SESSION)){ 
  session_start();
}


$id = $_POST['id'];
$idArray = json_decode(stripslashes($id));

// Update
if(isset($_POST['value'])){
    $value = $_POST['value'];
    $valueArray = json_decode(stripslashes($value));

    for ($i = 0; $i <  count($idArray); $i++){
	    $_SESSION[$idArray[$i]]=$valueArray[$i];
        echo "arrayName at[" . $i . "] is: [" .$valueArray[$i] . "]<br>\n";
    }
}

// Reset
else{

    $dataGenericFile = '../data/data.xml';
    $xmlGeneric = simplexml_load_file($dataGenericFile);

     for ($i = 0; $i <  count($idArray); $i++){
        $valueGeneric=($xmlGeneric->xpath("//data[@category='".$idArray[$i]."']/value"));
	    $_SESSION[$idArray[$i]]=(string)$valueGeneric[0];
    }
    echo (string)$valueGeneric[0];
    //echo json_encode($return_arr);

}





?>
