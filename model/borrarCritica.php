<?php
// Se guarda la variable GET id
$id=$_GET['id'];
//Se importa el archivo json de criticas en String
$criticas_str = file_get_contents("../collections/criticas.json");
//Se convierte en un objeto JSON
$criticas = json_decode($criticas_str,true);
$clave;
//Se recorre el array json de las criticas
foreach ($criticas['criticas'] as $key => $value) {

    foreach ($value as $campo => $valor) {

		if($id===$valor){

            $clave=$key;

        }
    }
}
// Se recorre el array de json
foreach ($criticas['criticas'] as $key => $value) {

	if($clave===$key){
		// Se elimina el documento
		unset($criticas['criticas'][$key]);
	}
}
// Se borra el documento en la colección llamado criticas
file_put_contents("../collections/criticas.json", json_encode($criticas,TRUE));

?>