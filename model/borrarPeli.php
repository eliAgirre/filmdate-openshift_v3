<?php
// Se guarda la variable GET id
$id=$_GET['id'];
//Se importa el archivo json de peliculas en String
$peliculas_str = file_get_contents("../collections/peliculas.json");
//Se convierte en un objeto JSON
$peliculas = json_decode($peliculas_str,true);
$clave;
//Se recorre el array json de las peliculas
foreach ($peliculas['peliculas'] as $key => $value) {

    foreach ($value as $campo => $valor) {

		if($id===$valor){

            $clave=$key;

        }
    }
}
// Se recorre el array de json
foreach ($peliculas['peliculas'] as $key => $value) {

	if($clave===$key){
		// Se elimina el documento
		unset($peliculas['peliculas'][$key]);
	}
}
// Se borra el documento en la colección llamado peliculas
file_put_contents("../collections/peliculas.json", json_encode($peliculas,TRUE));

?>