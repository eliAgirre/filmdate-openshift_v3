<?php
// Se guarda el dato obtenido
$id_documento=$_GET['id'];
//Se importa el archivo json de sigue_peli en String
$siguePeli_str = file_get_contents("../collections/sigue_peli.json");
//Se convierte en un objeto JSON
$siguePeli = json_decode($siguePeli_str,true);
$clave;
//Se recorre el array json de las peliculas que sigue el usuario
foreach ($siguePeli['siguePeli'] as $key => $value) {

	foreach ($value as $campo => $valor) {

		if($id_documento===$valor){

			$clave=$key;
		}

	}
}

// Se recorre el array de json
foreach ($siguePeli['siguePeli'] as $key => $value) {

	if($clave===$key){
		// Se elimina el documento
		unset($siguePeli['siguePeli'][$key]);
	}
}

// Se borra el documento en la colección llamado sigue_peli
file_put_contents("../collections/sigue_peli.json", json_encode($siguePeli,TRUE));

?>