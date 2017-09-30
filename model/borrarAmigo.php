<?php
// Se guarda el dato obtenido
$id_documento=$_GET['id'];
//Se importa el archivo json de sigue_amigos en String
$sigueAmigos_str = file_get_contents("../collections/sigue_amigos.json");
//Se convierte en un objeto JSON
$sigueAmigos = json_decode($sigueAmigos_str,true);
$clave;
// Se recorre el array de sigue_amigos
foreach ($sigueAmigos['sigueAmigos'] as $key => $value) {

    foreach ($value as $campo => $valor) {
        // Si el id documento coincide
        if($id_documento===$valor){

            // Se guarda la clave del array
        	$clave=$key;
        }
    }
}

// Se recorre el array de json
foreach ($sigueAmigos['sigueAmigos'] as $key => $value) {

	if($clave===$key){
		// Se elimina el documento
		unset($sigueAmigos['sigueAmigos'][$key]);
	}
}

// Se borra el documento en la colección llamado sigue_amigos
file_put_contents("../collections/sigue_amigos.json", json_encode($sigueAmigos,TRUE));

?>