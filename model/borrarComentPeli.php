<?php
// Se guarda el dato obtenido
$id_documento=$_GET['id'];
//Se importa el archivo json de criticas en String
$comentsPelis_str = file_get_contents("../collections/criticas.json");
//Se convierte en un objeto JSON
$comentsPelis = json_decode($comentsPelis_str,true);
$clave;
//Se recorre el array json de las peliculas que sigue el usuario
foreach ($comentsPelis['criticas'] as $key => $value) {

	foreach ($value as $campo => $valor) {

		if($id_documento===$valor){

			$clave=$key;
		}

	}
}

// Se recorre el array de json
foreach ($comentsPelis['criticas'] as $key => $value) {

	if($clave===$key){
		// Se elimina el documento
		unset($comentsPelis['criticas'][$key]);
	}
}

// Se borra el documento en la colección llamado criticas
file_put_contents("../collections/criticas.json", json_encode($comentsPelis,TRUE));

?>